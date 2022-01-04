<?php

if (!class_exists('WPSE_WPML_Posts')) {

	class WPSE_WPML_Posts {

		static private $instance = false;

		private function __construct() {
			
		}

		function init() {
			add_action('vg_sheet_editor/save_rows/before_saving_rows', array($this, 'stop_automatic_wpml_syncing'), 10, 2);
			add_action('vg_sheet_editor/save_rows/after_saving_post', array($this, 'sync_translation_fields'));
			add_action('vg_sheet_editor/editor/before_init', array($this, 'register_columns'));
			add_action('vg_sheet_editor/woocommerce/variable_product_updated', array($this, 'sync_translation_fields_after_wc_variable_product_updated'));
			add_action('woocommerce_rest_insert_product_variation_object', array($this, 'sync_translation_fields_after_wc_rest_variation_inserted'), 90, 1);
			add_action('product_variation_linked', array($this, 'sync_translation_fields'), 90, 1);
			add_filter('vg_sheet_editor/save_rows/row_data_before_save', array($this, 'sync_fields_if_new_post'), 10, 3);
			add_action('vg_sheet_editor/provider/post/post_converted_to_product', array($this, 'post_converted_to_product'));
			add_filter('vg_sheet_editor/formulas/sql_execution/can_execute', array($this, 'disable_sql_formulas_to_allow_translation_syncing'), 9999);
			add_action('vg_sheet_editor/formulas/execute_formula/after_execution_on_field', array($this, 'sync_translation_fields_after_formula'));
		}

		function sync_translation_fields_after_formula($post_id) {

			if (!VGSE()->helpers->get_current_provider()->is_post_type) {
				return;
			}
			$this->sync_translation_fields($post_id);
		}

		function disable_sql_formulas_to_allow_translation_syncing($allowed) {
			if (VGSE()->helpers->get_current_provider()->is_post_type) {
				$allowed = false;
			}
			return $allowed;
		}

		function post_converted_to_product($post_id) {
			global $wpdb;
			$wpdb->update($wpdb->prefix . 'icl_translations', array(
				'element_type' => 'post_product'
					), array(
				'element_type' => 'post_post',
				'element_id' => $post_id
			));
		}

		function sync_fields_if_new_post($item, $post_id, $post_type) {
			global $wpdb;
			if (!VGSE()->helpers->get_current_provider()->is_post_type) {
				return $item;
			}

			$sql = "SELECT * FROM {$wpdb->prefix}icl_translations WHERE element_type = 'post_" . esc_sql($post_type) . "' AND element_id = " . (int) $post_id;
			$row_exists = $wpdb->get_row($sql);
			if (!$row_exists) {
				$this->sync_translation_fields($post_id);
			}
			return $item;
		}

		function sync_translation_fields_after_wc_rest_variation_inserted($variation) {
			$this->sync_translation_fields($variation->get_id());
		}

		function sync_translation_fields_after_wc_variable_product_updated($product_data) {
			$variation_ids = wp_list_pluck($product_data['variations'], 'id');
			foreach ($variation_ids as $post_id) {
				$this->sync_translation_fields($post_id);
			}
		}

		function sync_translation_fields($post_id) {
			global $wpml_post_translations, $sitepress;
			if (!VGSE()->helpers->get_current_provider()->is_post_type) {
				return;
			}
			$post = get_post($post_id);
			$main_id = $this->get_main_post_id($post_id);
			$trid = WP_Sheet_Editor_WPML_Obj()->get_main_translation_id($post_id, 'post_' . get_post_type($post_id), true);
			$old_POST = $_POST;
			$_POST['icl_translation_of'] = $main_id ? $main_id : 'none';
			$_POST['icl_trid'] = $trid;
			$_POST['icl_post_language'] = $wpml_post_translations->get_save_post_lang($post_id, $sitepress);
			$wpml_post_translations->save_post_actions($post_id, $post);
			$_POST = $old_POST;
		}

		function get_main_post_id($post_id) {
			global $wpdb;
			$main_trid = (int) WP_Sheet_Editor_WPML_Obj()->get_main_translation_id($post_id, 'post_' . get_post_type($post_id), true);

			$main_id = (int) $wpdb->get_var("SELECT element_id FROM {$wpdb->prefix}icl_translations WHERE trid = " . (int) $main_trid . " AND source_language_code IS NULL");

			return $main_id;
		}

		function stop_automatic_wpml_syncing($data, $post_type) {
			global $wpml_post_translations;
			if (!VGSE()->helpers->get_current_provider()->is_post_type) {
				return;
			}
			remove_action('save_post', array($wpml_post_translations, 'save_post_actions'), 100);
		}

		/**
		 * Register spreadsheet columns
		 */
		function register_columns($editor) {
			global $sitepress;
			if ($editor->provider->key === 'user') {
				return;
			}
			if (!$editor->provider->is_post_type) {
				return;
			}
			$post_types = $editor->args['enabled_post_types'];
			foreach ($post_types as $post_type) {
				if (WP_Sheet_Editor_WPML_Obj()->is_the_default_language()) {
					$editor->args['columns']->register_item('wpml_duplicate', $post_type, array(
						'data_type' => 'meta_data',
						'column_width' => 150,
						'title' => __('WPML - Duplicate', VGSE()->textname),
						'type' => '',
						'supports_formulas' => true,
						'supports_sql_formulas' => false,
						'allow_to_hide' => true,
						'allow_to_rename' => true,
						'allow_plain_text' => true,
						'formatted' => array(
							'comment' => array('value' => __('Enter multiple language codes separated by commas and we will create copies of the main language. For example: en, es. Existing languages will be skipped.', VGSE()->textname))
						),
						'save_value_callback' => array($this, 'duplicate_to_language'),
					));
				}
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
					'is_locked' => WP_Sheet_Editor_WPML_Obj()->is_the_default_language(),
					'allow_to_save' => ( WP_Sheet_Editor_WPML_Obj()->is_the_default_language() ) ? false : true,
				));
				$editor->args['columns']->register_item('wpml_relationship', $post_type, array(
					'data_type' => 'meta_data',
					'column_width' => 150,
					'title' => __('WPML - Relationship', VGSE()->textname),
					'type' => '',
					'supports_formulas' => true,
					'supports_sql_formulas' => false,
					'allow_to_hide' => true,
					'allow_to_rename' => true,
					'allow_plain_text' => true,
					'formatted' => array(
						'editor' => 'select',
						'selectOptions' => array(
							'' => '',
							'duplicate_from_main' => __('Duplicate from the main language', VGSE()->textname),
							'translate_separately' => __('Translate separately', VGSE()->textname),
						)
					),
					'save_value_callback' => array($this, 'set_translation_relationship'),
					'get_value_callback' => array($this, 'get_translation_relationship'),
					'is_locked' => WP_Sheet_Editor_WPML_Obj()->is_the_default_language(),
					'allow_to_save' => ( WP_Sheet_Editor_WPML_Obj()->is_the_default_language() ) ? false : true,
				));
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
					'allow_to_save' => ( WP_Sheet_Editor_WPML_Obj()->is_the_default_language() ) ? false : true,
					'formatted' => array(
						'editor' => 'select',
						'selectOptions' => wp_list_pluck($sitepress->get_active_languages(), 'display_name', 'code'),
						'comment' => ( WP_Sheet_Editor_WPML_Obj()->is_the_default_language() ) ? null : array('value' => __('You can change the language of this post. If the translation for the new language exists, this change will not be applied.', VGSE()->textname))
					),
					'get_value_callback' => array($this, 'get_post_language'),
					'save_value_callback' => array($this, 'save_post_language'),
				));
				$editor->args['columns']->register_item('translation_priority', $post_type, array(
					'data_type' => 'post_terms',
					'column_width' => 150,
					'title' => __('WPML - Translation priority', VGSE()->textname),
					'type' => '',
					'supports_formulas' => true,
					'formatted' => array(
						'type' => 'autocomplete',
						'source' => 'loadTaxonomyTerms'
					),
					'allow_to_hide' => true,
					'allow_to_rename' => true,
				));
			}
		}

		function get_post_language($post, $cell_key, $cell_args) {
			global $wpdb;

			return $wpdb->get_var("SELECT language_code FROM " . $wpdb->prefix . "icl_translations WHERE element_type = 'post_" . esc_sql($post->post_type) . "' AND element_id = " . (int) $post->ID);
		}

		function get_translation_relationship($post, $cell_key, $cell_args) {
			$duplicate_of = (int) get_post_meta($post->ID, '_icl_lang_duplicate_of', true);
			$value = $duplicate_of ? 'duplicate_from_main' : 'translate_separately';
			return $value;
		}

		function get_translation_of_cell($post, $cell_key, $cell_args) {
			$main_id = (int) $this->get_main_post_id($post->ID);
			$value = ( $main_id && $main_id !== $post->ID) ? get_the_title($main_id) : '';
			return $value;
		}

		function update_translation_of_cell($post_id, $cell_key, $data_to_save, $post_type, $cell_args, $spreadsheet_columns) {
			global $wpdb, $sitepress;
			$data_to_save = trim($data_to_save);
			if (empty($data_to_save)) {
				$wpdb->update(
						$wpdb->prefix . 'icl_translations', array(
					'source_language_code' => null,
					'language_code' => $sitepress->get_current_language()
						), array(
					'element_id' => (int) $post_id,
					'element_type' => 'post_' . esc_sql($post_type),
						), array('%s', '%s'), array('%d', '%s')
				);
				return;
			}

			if (is_numeric($data_to_save) && get_post_status((int) $data_to_save)) {
				$main_post_id = (int) $data_to_save;
			} else {
				$main_post_id = (int) $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_type = '" . esc_sql($post_type) . "' AND post_title = '" . esc_sql($data_to_save) . "' LIMIT 1 ");
			}
			if ($main_post_id) {
				$trid = WP_Sheet_Editor_WPML_Obj()->get_main_translation_id($main_post_id, 'post_' . esc_sql($post_type), is_numeric($data_to_save));
				$wpdb->update($wpdb->prefix . 'icl_translations', array(
					'trid' => $trid,
					'source_language_code' => $sitepress->get_default_language()
						), array(
					'element_type' => 'post_' . esc_sql($post_type),
					'element_id' => (int) $post_id
				));
			}
		}

		function set_translation_relationship($post_id, $cell_key, $data_to_save, $post_type, $cell_args, $spreadsheet_columns) {
			global $iclTranslationManagement, $sitepress, $wpdb;

			if ($data_to_save === 'duplicate_from_main') {
				$original_id = (int) $this->get_main_post_id($post_id);
				$iclTranslationManagement->set_duplicate($original_id, $sitepress->get_current_language());
			} elseif ($data_to_save === 'translate_separately') {
				$iclTranslationManagement->reset_duplicate_flag($post_id);
			} else {
				return;
			}
		}

		function duplicate_to_language($post_id, $cell_key, $data_to_save, $post_type, $cell_args, $spreadsheet_columns) {
			global $iclTranslationManagement;
			$mdata = array();
			$mdata['iclpost'] = array($post_id);
			$langs = array_filter(array_map('trim', explode(',', strtolower($data_to_save))));
			foreach ($langs as $lang) {
				$mdata['duplicate_to'][$lang] = 1;
			}
			$iclTranslationManagement->make_duplicates($mdata);
			do_action('wpml_new_duplicated_terms', (array) $mdata['iclpost'], false);
		}

		function save_post_language($post_id, $cell_key, $data_to_save, $post_type, $cell_args, $spreadsheet_columns) {
			global $wpdb, $sitepress;

			$new_language = strtolower($data_to_save);
			if (!icl_is_language_active($data_to_save)) {
				return;
			}
			// We only accept 2 letter language codes
			if (strlen($new_language) > 2) {
				return;
			}

			$translation_for_new_language_exists = (int) $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "icl_translations WHERE language_code = '" . esc_sql($new_language) . "' AND element_type = 'post_" . esc_sql($post_type) . "' AND element_id = " . (int) $post_id);
			if ($translation_for_new_language_exists) {
				return;
			}


			$args = array(
				'language_code' => $new_language,
				'source_language_code' => ( $new_language === $sitepress->get_default_language() ) ? null : $sitepress->get_default_language(),
			);

			$wpdb->update($wpdb->prefix . 'icl_translations', $args, array(
				'element_type' => 'post_' . esc_sql($post_type),
				'element_id' => (int) $post_id
			));
		}

		/**
		 * Creates or returns an instance of this class.
		 */
		static function get_instance() {
			if (null == WPSE_WPML_Posts::$instance) {
				WPSE_WPML_Posts::$instance = new WPSE_WPML_Posts();
				WPSE_WPML_Posts::$instance->init();
			}
			return WPSE_WPML_Posts::$instance;
		}

		function __set($name, $value) {
			$this->$name = $value;
		}

		function __get($name) {
			return $this->$name;
		}

	}

}

if (!function_exists('WPSE_WPML_Posts_Obj')) {

	function WPSE_WPML_Posts_Obj() {
		return WPSE_WPML_Posts::get_instance();
	}

}
WPSE_WPML_Posts_Obj();
