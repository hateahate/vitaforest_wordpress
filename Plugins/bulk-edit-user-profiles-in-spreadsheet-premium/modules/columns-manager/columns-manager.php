<?php
if (!class_exists('WP_Sheet_Editor_Columns_Manager')) {

	/**
	 * Rename the columns of the spreadsheet editor to something more meaningful.
	 */
	class WP_Sheet_Editor_Columns_Manager {

		static private $instance = false;
		var $key = 'vgse_columns_manager';

		private function __construct() {
			
		}

		/**
		 * Creates or returns an instance of this class.
		 */
		static function get_instance() {
			if (null == WP_Sheet_Editor_Columns_Manager::$instance) {
				WP_Sheet_Editor_Columns_Manager::$instance = new WP_Sheet_Editor_Columns_Manager();
				WP_Sheet_Editor_Columns_Manager::$instance->init();
			}
			return WP_Sheet_Editor_Columns_Manager::$instance;
		}

		function init() {

			if (version_compare(VGSE()->version, '2.8.1') < 0) {
				return;
			}

			require __DIR__ . '/inc/column-groups.php';

			// Allow to manage the columns formatting
			// UI
			if (current_user_can('manage_options')) {
				add_action('vg_sheet_editor/columns_visibility/enabled/after_column_action', array($this, 'render_settings_button'), 30, 2);
				add_action('vg_sheet_editor/after_enqueue_assets', array($this, 'enqueue_assets'));
				add_action('vg_sheet_editor/columns_visibility/after_options_saved', array($this, 'save_column_settings'), 10, 2);
				add_action('vg_sheet_editor/frontend/metabox/after_fields_saved', array($this, 'save_column_settings_from_frontend_sheet'), 10, 2);
				add_action('vg_sheet_editor/editor/before_init', array($this, 'register_toolbar_items'));
				add_action('vg_sheet_editor/columns_visibility/after_instructions', array($this, 'render_instructions'));
				add_filter('vg_sheet_editor/custom_columns/columns_detected_settings_before_cache', array($this, 'maybe_detect_column_type_automatically'), 10, 2);
			}

			// Apply formatting settings
			add_filter('vg_sheet_editor/columns/all_items', array($this, 'apply_settings'), 10, 2);
			add_filter('vg_sheet_editor/serialized_addon/column_settings', array($this, 'apply_settings_to_serialized_column'), 10, 5);
			add_filter('vg_sheet_editor/infinite_serialized_column/column_settings', array($this, 'apply_settings_to_infinitely_serialized_column'), 10, 3);
		}

		function are_values_dates($values) {
			$out = array(
				'possible_dates' => array(),
				'is_date' => false,
				'display_format' => 'YYYY-MM-DD', // moment.js format used by the cell's calendar
				'save_format' => false
			);
			$values = array_filter(array_unique($values));
			if (!empty($values)) {
				foreach ($values as $value) {
					if (!is_scalar($value)) {
						continue;
					}
					if (empty($value) || preg_match('/^(\d{4}-\d{2}-\d{2}|\d{10}|\d{8})$/', $value)) {
						$out['possible_dates'][] = $value;
					}
				}

				$out['is_date'] = count($values) === count($out['possible_dates']);
				if (!empty($out['possible_dates'])) {
					$first_value = $out['possible_dates'][0];
					if ($out['is_date']) {
						if (is_numeric($first_value) && strlen($first_value) === 8) {
							$out['save_format'] = 'Ymd';
						} elseif (is_numeric($first_value) && strlen($first_value) === 10) {
							$out['save_format'] = 'U';
						} elseif (preg_match('/^(\d{4}-\d{2}-\d{2})$/', $value)) {
							$out['save_format'] = 'Y-m-d';
						}
					}
				}
			}
			return $out;
		}

		function are_values_media_files($values) {
			$out = array(
				'possible_files' => array(),
				'is_file' => false
			);
			$values = array_filter(array_unique($values));
			if (!empty($values)) {
				foreach ($values as $value) {
					if (!is_scalar($value)) {
						continue;
					}
					if (is_numeric($value) && get_post_type($value) === 'attachment') {
						$out['possible_files'][] = $value;
					} elseif (strpos($value, WP_CONTENT_URL . '/uploads/') === 0) {
						$out['possible_files'][] = $value;
					}
				}

				$out['is_file'] = count($values) === count($out['possible_files']);
			}
			return $out;
		}

		function maybe_detect_column_type_automatically($columns_detected, $post_type) {
			if (!empty(VGSE()->options['disable_automatic_formatting_detection'])) {
				return $columns_detected;
			}

			$new_formatting = array();
			if (isset($columns_detected['normal'])) {
				foreach ($columns_detected['normal'] as $column_key => $column_settings) {
					if ($column_settings['detected_type']['type'] !== 'text') {
						continue;
					}

					// If we have defined formatting previously, don't overwrite it automatically
					$current_format_settings = $this->get_formatted_column_settings($column_key, $post_type);
					if (!empty($current_format_settings)) {
						continue;
					}

					if (!isset($new_formatting[$column_key])) {
						$date_detection = $this->are_values_dates($column_settings['detected_type']['sample_values']);
						if ($date_detection['is_date']) {
							$new_formatting[$column_key] = array(
								'field_type' => 'date',
								'date_format_save' => $date_detection['save_format'],
							);
						}
					}
					if (!isset($new_formatting[$column_key])) {
						$files_detection = $this->are_values_media_files($column_settings['detected_type']['sample_values']);
						if ($files_detection['is_file']) {
							$new_formatting[$column_key] = array(
								'field_type' => 'file',
								'file_saved_format' => is_numeric($files_detection['possible_files'][0]) ? 'id' : 'url',
								'allow_multiple_files' => strpos($files_detection['possible_files'][0], ',') !== false,
								'multiple_files_format' => 'comma',
							);
						}
					}
				}
			}

			if (!empty($new_formatting)) {
				$this->save_column_settings($post_type, array(
					'column_settings' => $new_formatting
				));
			}
			return $columns_detected;
		}

		function render_instructions() {
			_e(' Some columns have the <i class="fa fa-cog"></i> button to change the formatting', VGSE()->textname);
		}

		/**
		 * Register toolbar item to edit columns visibility live on the spreadsheet
		 */
		function register_toolbar_items($editor) {
			$post_types = $editor->args['enabled_post_types'];
			foreach ($post_types as $post_type) {
				$editor->args['toolbars']->register_item('columns_manager', array(
					'type' => 'button',
					'allow_in_frontend' => false,
					'content' => __('Columns manager', VGSE()->textname),
					'toolbar_key' => 'secondary',
					'extra_html_attributes' => 'data-remodal-target="modal-columns-visibility"',
						), $post_type);
			}
		}

		function maybe_apply_settings_to_serialized_column($column_args, $post_type) {
			if (!empty($column_args['key'])) {
				$new_settings = $this->get_formatted_column_settings($column_args['key'], $post_type);
				$column_args = wp_parse_args($new_settings, $column_args);
			}

			return $column_args;
		}

		function apply_settings_to_infinitely_serialized_column($column_args, $serialized_column, $post_type) {
			return $this->maybe_apply_settings_to_serialized_column($column_args, $post_type);
		}

		function apply_settings_to_serialized_column($column_args, $first_set_keys, $field, $key, $post_type) {
			return $this->maybe_apply_settings_to_serialized_column($column_args, $post_type);
		}

		function apply_settings($columns) {
			$options = $this->get_settings();

			if (empty($options)) {
				return $columns;
			}
			foreach ($columns as $post_type_key => $post_type_columns) {
				// Skip if special formatting not defined for this post type
				if (!isset($options[$post_type_key])) {
					continue;
				}
				foreach ($post_type_columns as $key => $column) {
					// Skip if special formatting not defined for this column
					if (empty($options[$post_type_key][$key])) {
						continue;
					}
					// Skip if custom format is not explicitely enabled for this column
					if (empty($column['allow_custom_format'])) {
						continue;
					}
					$new_settings = $this->get_formatted_column_settings($key, $post_type_key);
					$columns[$post_type_key][$key] = wp_parse_args($new_settings, $column);
				}
			}

			return $columns;
		}

		function get_formatted_column_settings($key, $post_type) {
			$column_settings = $this->get_column_settings($key, $post_type);
			$out = array();
			// Skip if field type = automatic
			if (empty($column_settings['field_type'])) {
				return $out;
			}

			if ($column_settings['field_type'] === 'text') {
				$out['formatted'] = array(
					'data' => $key
				);
			} elseif ($column_settings['field_type'] === 'text_editor') {
				$out['formatted'] = array(
					'data' => $key,
					'renderer' => 'wp_tinymce'
				);
			} elseif ($column_settings['field_type'] === 'select' && !empty($column_settings['allowed_values'])) {
				$lines = array_map('trim', preg_split('/\r\n|\r|\n/', $column_settings['allowed_values']));
				$column_options = array();
				foreach ($lines as $line) {
					$line_parts = array_map('trim', explode(':', $line));
					$label = isset($line_parts[1]) ? $line_parts[1] : $line_parts[0];
					$option_key = $line_parts[0];
					$column_options[$option_key] = $label;
				}
				$out['formatted'] = array(
					'data' => $key,
					'editor' => 'select', 'selectOptions' => $column_options
				);
			} elseif ($column_settings['field_type'] === 'checkbox' && !empty($column_settings['checked_template'])) {
				$out['formatted'] = array(
					'data' => $key,
					'type' => 'checkbox',
					'checkedTemplate' => $column_settings['checked_template'],
					'uncheckedTemplate' => $column_settings['unchecked_template'],
				);
				$out['default_value'] = $column_settings['unchecked_template'];
			} elseif ($column_settings['field_type'] === 'date' && !empty($column_settings['date_format_save'])) {
				$out = $this->get_format_settings_for_date_column($key, $column_settings['date_format_save']);
			} elseif ($column_settings['field_type'] === 'file') {
				$out['type'] = $column_settings['allow_multiple_files'] ? 'boton_gallery_multiple' : 'boton_gallery';
				$out['formatted'] = array(
					'data' => $key,
					'renderer' => 'wp_media_gallery'
				);
				$out['wp_media_multiple'] = true;
				$out['prepare_value_for_database'] = array($this, 'prepare_files_for_database');
				$out['prepare_value_for_display'] = array($this, 'prepare_files_for_display');
			}
			return $out;
		}

		function prepare_files_for_display($value, $post, $column_key, $column_settings) {
			$value = VGSE()->helpers->get_gallery_cell_content($post->ID, $column_key, $column_settings['data_type'], $value);
			return $value;
		}

		function get_format_settings_for_date_column($key, $date_format_save) {
			$settings = array();
			$settings['formatted'] = array(
				'data' => $key,
				'type' => 'date',
				'customDatabaseFormat' => $date_format_save,
				'dateFormat' => 'YYYY-MM-DD',
				'correctFormat' => true,
				'defaultDate' => '',
				'datePickerConfig' => array('firstDay' => 0, 'showWeekNumber' => true, 'numberOfMonths' => 1),
			);
			$settings['prepare_value_for_database'] = array($this, 'prepare_date_for_database');
			$settings['prepare_value_for_display'] = array($this, 'format_date_for_cell');
			return $settings;
		}

		function format_date_for_cell($value, $post, $cell_key, $cell_args) {
			$column_settings = $this->get_column_settings($cell_key, $post->post_type);
			if ($column_settings['field_type'] !== 'date') {
				return $value;
			}
			$value = VGSE()->helpers->get_current_provider()->get_item_meta($post->ID, $cell_key, true, 'read');
			if (!empty($value)) {
				$timestamp = preg_match('/^\d{10}$/', $value) ? (int) $value : strtotime($value);
				$value = date('Y-m-d', $timestamp);
			}
			return $value;
		}

		function prepare_date_for_database($post_id, $cell_key, $data_to_save, $post_type, $cell_args, $spreadsheet_columns) {
			$column_settings = $this->get_column_settings($cell_key, $post_type);
			if ($column_settings['field_type'] !== 'date') {
				return $data_to_save;
			}
			if (!empty($data_to_save)) {
				$data_to_save = date($column_settings['date_format_save'], strtotime($data_to_save));
			}
			return $data_to_save;
		}

		function prepare_files_for_database($post_id, $cell_key, $data_to_save, $post_type, $cell_args, $spreadsheet_columns) {
			$column_settings = $this->get_column_settings($cell_key, $post_type);
			if ($column_settings['field_type'] !== 'file') {
				return $data_to_save;
			}
			if (!empty($data_to_save)) {
				$urls = array_map('trim', explode(',', $data_to_save));
				if ($column_settings['file_saved_format'] === 'id') {
					$file_ids = VGSE()->helpers->maybe_replace_urls_with_file_ids($urls, $post_id);
				} else {
					$file_ids = $urls;
				}
				if ($column_settings['allow_multiple_files']) {
					$data_to_save = ($column_settings['multiple_files_format'] === 'comma') ? implode(',', $file_ids) : $file_ids;
				} else {
					$data_to_save = current($file_ids);
				}
			}
			return $data_to_save;
		}

		function get_settings($post_type = '') {

			$existing = get_option($this->key);
			if (empty($existing)) {
				$existing = array();
			}
			if ($post_type && empty($existing[$post_type])) {
				$existing[$post_type] = array();
			}
			return $existing;
		}

		function key_to_regex($column_key) {
			$regex = false;
			if (!empty($column_key) && preg_match('/\d/', $column_key)) {
				$regex = '/' . str_replace('/', '', preg_replace('/[0-9]+/', '\d+', $column_key)) . '/';
			}
			return $regex;
		}

		function save_column_settings_from_frontend_sheet($post_id, $data) {
			$this->save_column_settings($data['vgse_post_type'], $data);
		}

		function save_column_settings($post_type, $data) {
			if (!isset($data['column_settings'])) {
				return;
			}
			$settings = $data['column_settings'];
			$existing = $this->get_settings($post_type);
			$existing[$post_type] = wp_parse_args($settings, $existing[$post_type]);

			foreach ($existing[$post_type] as $column_key => $column_settings) {
				if (empty($column_settings['field_type'])) {
					unset($existing[$post_type][$column_key]);
				}
			}
			$existing = VGSE()->helpers->array_remove_empty($existing);

			update_option($this->key, $existing);
		}

		/**
		 * Enqueue frontend assets
		 */
		function enqueue_assets() {
			wp_enqueue_script('wp-sheet-editor-columns-manager', plugins_url('/assets/js/init.js', __FILE__), array(), VGSE()->version);
		}

		function get_column_settings($column_key, $post_type) {

			$existing_settings = $this->get_settings($post_type);
			if (isset($existing_settings[$post_type][$column_key])) {
				$column_settings = $existing_settings[$post_type][$column_key];
			} else {
				$regex_key = $this->key_to_regex($column_key);
				if ($regex_key) {
					foreach ($existing_settings[$post_type] as $column_key => $raw_column_settings) {
						if (preg_match($regex_key, $column_key)) {
							$column_settings = $raw_column_settings;
							break;
						}
					}
				}
			}
			if (empty($column_settings)) {
				$column_settings = array();
			}

			$default_settings = array(
				'field_type' => '',
				'allowed_values' => '',
				'checked_template' => '',
				'unchecked_template' => '',
				'file_saved_format' => '',
				'allow_multiple_files' => '',
				'multiple_files_format' => '',
				'date_format_save' => '',
			);
			$column_settings = wp_parse_args($column_settings, $default_settings);
			return $column_settings;
		}

		function render_settings_button($column, $post_type) {
			if (empty($column['allow_custom_format'])) {
				return;
			}
			if (!apply_filters('vg_sheet_editor/columns_manager/can_render_button', true, $column, $post_type)) {
				return;
			}
			$column_key = $column['key'];
			$column_settings = $this->get_column_settings($column_key, $post_type);
			?>
			<button class="settings-column column-action" title="<?php echo esc_attr(__('Settings', VGSE()->textname)); ?>"><i class="fa fa-cog"></i></button>
			<div class="column-settings">
				<div class="column-settings-field field-type">
					<label><?php _e('Column format', VGSE()->textname); ?></label>
					<select name="column_settings[<?php echo esc_attr($column_key); ?>][field_type]">
						<option value="" <?php selected(empty($column_settings['field_type'])); ?>><?php _e('Automatic', VGSE()->textname); ?></option>
						<option value="text" <?php selected($column_settings['field_type'], 'text'); ?>><?php _e('Text', VGSE()->textname); ?></option>
						<option value="text_editor" <?php selected($column_settings['field_type'], 'text_editor'); ?>><?php _e('Text editor (tinymce)', VGSE()->textname); ?></option>
						<option value="select" <?php selected($column_settings['field_type'], 'select'); ?>><?php _e('Dropdown with predefined options', VGSE()->textname); ?></option>
						<option value="checkbox" <?php selected($column_settings['field_type'], 'checkbox'); ?>><?php _e('Checkbox', VGSE()->textname); ?></option>
						<option value="file" <?php selected($column_settings['field_type'], 'file'); ?>><?php _e('File upload', VGSE()->textname); ?></option>
						<option value="date" <?php selected($column_settings['field_type'], 'date'); ?>><?php _e('Date', VGSE()->textname); ?></option>
					</select>
				</div>
				<div class="column-settings-field settings-for-type settings-for-select">
					<label><?php _e('Allowed values', VGSE()->textname); ?></label>
					<p><?php _e('Enter each choice on a new line. For more control, you may specify both a value and label like this:<br>red : Red', VGSE()->textname); ?></p>
					<textarea name="column_settings[<?php echo esc_attr($column_key); ?>][allowed_values]"><?php echo $column_settings['allowed_values']; ?></textarea>
				</div>
				<div class="column-settings-field settings-for-type settings-for-checkbox">
					<label><?php _e('What valued is saved when the checkbox is checked?', VGSE()->textname); ?></label>					
					<input value="<?php echo esc_attr($column_settings['checked_template']); ?>" type="text" name="column_settings[<?php echo esc_attr($column_key); ?>][checked_template]">
					<label><?php _e('What valued is saved when the checkbox is unchecked?', VGSE()->textname); ?></label>					
					<input value="<?php echo esc_attr($column_settings['unchecked_template']); ?>" type="text" name="column_settings[<?php echo esc_attr($column_key); ?>][unchecked_template]">
				</div>
				<div class="column-settings-field settings-for-type settings-for-file">
					<label><?php _e('How is the file saved in the database?', VGSE()->textname); ?></label>	
					<p><?php _e('The cell will display the values as URLs and you can edit in the cells using full URLs, file ID, or file name.<br>External URLs are automatically imported into the media library.<br>We will save the value in the format selected here', VGSE()->textname); ?></p>
					<select name="column_settings[<?php echo esc_attr($column_key); ?>][file_saved_format]">
						<option <?php selected($column_settings['file_saved_format'], 'id'); ?> value="id"><?php _e('File ID', VGSE()->textname); ?></option>
						<option <?php selected($column_settings['file_saved_format'], 'url'); ?> value="url"><?php _e('File URL', VGSE()->textname); ?></option>
					</select>
					<br>
					<label><input  <?php checked($column_settings['allow_multiple_files'], 'yes'); ?> value="yes" type="checkbox" name="column_settings[<?php echo esc_attr($column_key); ?>][allow_multiple_files]"> <?php _e('Allow multiple files per field?', VGSE()->textname); ?></label>
					<label><?php _e('How do you want to save the multiple files?', VGSE()->textname); ?></label>
					<select name="column_settings[<?php echo esc_attr($column_key); ?>][multiple_files_format]">
						<option <?php selected($column_settings['multiple_files_format'], 'comma'); ?> value="comma"><?php _e('Saved them separated by comma', VGSE()->textname); ?></option>
						<option <?php selected($column_settings['multiple_files_format'], 'array'); ?> value="array"><?php _e('Save them as serialized array', VGSE()->textname); ?></option>
					</select>
				</div>
				<div class="column-settings-field settings-for-type settings-for-date">					
					<p><?php _e('The cells will display the date in the format: YYYY-MM-DD', VGSE()->textname); ?></p>
					<label><?php _e('What date format do you want to save in the database?', VGSE()->textname); ?></label>	
					<p><?php _e('Enter a date format. <a href="https://www.php.net/date#refsect1-function.date-parameters" target="_blank">List of formats</a>. Example: Y-m-d', VGSE()->textname); ?></p>
					<input value="<?php echo esc_attr($column_settings['date_format_save']); ?>" type="text" name="column_settings[<?php echo esc_attr($column_key); ?>][date_format_save]">
				</div>
			</div>
			<?php
		}

		function __set($name, $value) {
			$this->$name = $value;
		}

		function __get($name) {
			return $this->$name;
		}

	}

	add_action('vg_sheet_editor/initialized', 'vgse_columns_manager_init');

	function vgse_columns_manager_init() {
		WP_Sheet_Editor_Columns_Manager::get_instance();
	}

}