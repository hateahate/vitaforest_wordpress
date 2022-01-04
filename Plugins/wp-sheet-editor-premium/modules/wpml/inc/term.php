<?php

if (!class_exists('WPSE_WPML_Term')) {

	class WPSE_WPML_Term {

		static private $instance = false;

		private function __construct() {
			
		}

		function init() {
			add_action('vg_sheet_editor/terms/taxonomy_edited', array($this, 'after_taxonomy_edited'), 10, 4);
			add_action('vg_sheet_editor/editor/before_init', array($this, 'register_columns'));
		}

		/**
		 * Register spreadsheet columns
		 */
		function register_columns($editor) {
			global $sitepress;
			if ($editor->provider->key === 'user') {
				return;
			}
			$post_types = $editor->args['enabled_post_types'];
			foreach ($post_types as $post_type) {
				if (!taxonomy_exists($post_type)) {
					continue;
				}
				if (!WP_Sheet_Editor_WPML_Obj()->is_the_default_language()) {
					$editor->args['columns']->register_item('icl_translation_of', $post_type, array(
						'data_type' => 'meta_data',
						'column_width' => 200,
						'title' => __('WPML - Translation of', VGSE()->textname),
						'type' => '',
						'supports_formulas' => true,
						'supports_sql_formulas' => false,
						'allow_to_hide' => true,
						'allow_to_rename' => true,
						'allow_plain_text' => true,
						'get_value_callback' => array($this, 'get_translation_of_cell'),
						'save_value_callback' => array($this, 'update_translation_of_cell'),
					));
				}
				$editor->args['columns']->register_item('wpml_language', $post_type, array(
					'data_type' => 'meta_data',
					'column_width' => 150,
					'title' => __('WPML - Language', VGSE()->textname),
					'type' => '',
					'supports_formulas' => true,
					'supports_sql_formulas' => false,
					'allow_to_hide' => true,
					'allow_to_rename' => true,
					'allow_plain_text' => true,
					'allow_to_save' => true,
					'formatted' => array(
						'editor' => 'select',
						'selectOptions' => wp_list_pluck($sitepress->get_active_languages(), 'display_name', 'code')
					),
					'get_value_callback' => array($this, 'get_language_for_cell'),
					'save_value_callback' => array($this, 'save_language_for_cell'),
					'comment' => ( WP_Sheet_Editor_WPML_Obj()->is_the_default_language() ) ? null : array('value' => __('You can change the language of this post. If the translation for the new language exists, this change will not be applied.', VGSE()->textname)),
				));
			}
		}

		function get_language_for_cell($post, $cell_key, $cell_args) {
			global $wpdb;

			return $wpdb->get_var("SELECT language_code FROM " . $wpdb->prefix . "icl_translations WHERE element_type = 'tax_" . esc_sql($post->post_type) . "' AND element_id = " . (int) $post->ID);
		}

		function save_language_for_cell($post_id, $cell_key, $data_to_save, $post_type, $cell_args, $spreadsheet_columns) {
			global $wpdb, $sitepress;

			$new_language = strtolower($data_to_save);
			if (!icl_is_language_active($data_to_save)) {
				return;
			}
			// We only accept 2 letter language codes
			if (strlen($new_language) > 2) {
				return;
			}

			$translation_for_new_language_exists = (int) $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "icl_translations WHERE language_code = '" . esc_sql($new_language) . "' AND element_type = 'tax_" . esc_sql($post_type) . "' AND element_id = " . (int) $post_id);
			if ($translation_for_new_language_exists) {
				return;
			}

			$args = array(
				'language_code' => $new_language,
				'source_language_code' => ( $new_language === $sitepress->get_default_language() ) ? null : $sitepress->get_default_language(),
			);

			$wpdb->update($wpdb->prefix . 'icl_translations', $args, array(
				'element_type' => 'tax_' . esc_sql($post_type),
				'element_id' => (int) $post_id
			));
		}

		function get_translation_of_cell($post, $cell_key, $cell_args) {
			global $sitepress;
			$main_id = (int) SitePress::get_original_element_id($post->ID, 'tax_' . $post->post_type);
			$value = '';

			if (!$main_id) {
				return $value;
			}

			$main_language = $sitepress->get_default_language();
			$current_language = $sitepress->get_current_language();
			if ($main_language !== $current_language) {
				$sitepress->switch_lang($main_language);
			}

			$value = VGSE()->helpers->get_current_provider()->get_item_data($main_id, 'name');

			if ($main_language !== $current_language) {
				$sitepress->switch_lang($current_language);
			}
			return $value;
		}

		function get_term_id_from_name($term_name, $taxonomy, $use_main_language = false) {
			global $sitepress;
			$term_id = null;
			$main_language = $sitepress->get_default_language();
			$current_language = $sitepress->get_current_language();
			if ($use_main_language && $main_language !== $current_language) {
				$sitepress->switch_lang($main_language);
			}
			// Try to find the parent by slug, if not found, find by hierarchical name
			$term_query = new WP_Term_Query();
			$terms = $term_query->query(array(
				'taxonomy' => $taxonomy,
				'fields' => 'ids',
				'number' => 1,
				'slug' => $term_name,
				'hide_empty' => false,
				'update_term_meta_cache' => false,
			));

			if (empty($terms)) {
				$term_query = new WP_Term_Query();
				$terms = $term_query->query(array(
					'taxonomy' => $taxonomy,
					'fields' => 'ids',
					'number' => 1,
					'name' => $term_name,
					'hide_empty' => false,
					'update_term_meta_cache' => false,
				));
			}

			if (!empty($terms)) {
				$term_id = (int) current($terms);
			}

			if ($use_main_language && $main_language !== $current_language) {
				$sitepress->switch_lang($current_language);
			}

			return $term_id;
		}

		function update_translation_of_cell($term_id, $cell_key, $data_to_save, $taxonomy, $cell_args, $spreadsheet_columns) {
			global $wpdb, $sitepress;
			$data_to_save = trim($data_to_save);
			if (empty($data_to_save)) {
				$wpdb->update(
						$wpdb->prefix . 'icl_translations', array(
					'source_language_code' => null,
					'language_code' => $sitepress->get_current_language()
						), array(
					'element_id' => $term_id,
					'element_type' => 'tax_' . esc_sql($taxonomy)
						), array('%s'), array('%d')
				);
				return;
			}

			$main_id = $this->get_term_id_from_name($data_to_save, $taxonomy, true);
			if (!$main_id) {
				return;
			}
			$element_type = "tax_" . esc_sql($taxonomy);
			$trid = $sitepress->get_element_trid($main_id, $element_type);

			$sitepress->set_element_language_details((int) $term_id, $element_type, $trid, $sitepress->get_current_language(), $sitepress->get_default_language());
		}

		function after_taxonomy_edited($term_id, $old_taxonomy, $new_taxonomy, $term) {
			global $wpdb;
			$wpdb->update(
					$wpdb->prefix . 'icl_translations', array(
				'element_type' => 'tax_' . $new_taxonomy
					), array(
				'element_id' => $term['term_taxonomy_id'],
				'element_type' => 'tax_' . $old_taxonomy
					), array('%s'), array('%d')
			);
		}

		/**
		 * Creates or returns an instance of this class.
		 */
		static function get_instance() {
			if (null == WPSE_WPML_Term::$instance) {
				WPSE_WPML_Term::$instance = new WPSE_WPML_Term();
				WPSE_WPML_Term::$instance->init();
			}
			return WPSE_WPML_Term::$instance;
		}

		function __set($name, $value) {
			$this->$name = $value;
		}

		function __get($name) {
			return $this->$name;
		}

	}

}

if (!function_exists('WPSE_WPML_Term_Obj')) {

	function WPSE_WPML_Term_Obj() {
		return WPSE_WPML_Term::get_instance();
	}

}
WPSE_WPML_Term_Obj();
