<?php

if (!class_exists('WP_Sheet_Editor_Users_WooCommerce')) {

	class WP_Sheet_Editor_Users_WooCommerce {

		static private $instance = false;

		private function __construct() {
			
		}

		function init() {
			add_action('vg_sheet_editor/editor/before_init', array($this, 'register_columns'));
			add_action('vg_sheet_editor/provider/user/data_updated', array($this, 'sync_customer_lookup_table'), 10, 2);
			add_action('vg_sheet_editor/editor/before_init', array($this, 'register_toolbars'));

			// We flush the table very late to make sure WC has loaded fully
			add_action('vg_sheet_editor/editor_page/after_content', array($this, 'maybe_flush_lookup_cache'));
		}

		function maybe_flush_lookup_cache($post_type) {
			global $wpdb;
			if ($post_type !== 'user' || !$this->customer_lookup_exists() || empty($_GET['wpse_wc_customer_lookup_purge'])) {
				return;
			}

			$main_blog_prefix = $wpdb->get_blog_prefix(1);
			$wpdb->query("DELETE FROM {$wpdb->prefix}wc_customer_lookup WHERE user_id > 0 AND user_id NOT IN (SELECT ID FROM {$main_blog_prefix}users)");
			$wpdb->query("DELETE FROM {$wpdb->prefix}wc_customer_lookup WHERE email = '' ");
			\Automattic\WooCommerce\Admin\API\Reports\Cache::invalidate();
		}

		function customer_lookup_exists() {
			$out = true;
			if (!function_exists('WC') || version_compare(WC()->version, '4.0.0') < 0) {
				$out = false;
			}
			return $out;
		}

		function register_toolbars($editor) {

			$post_type = 'user';

			if ($editor->provider->key !== 'user' || !$this->customer_lookup_exists()) {
				return;
			}
			$editor->args['toolbars']->register_item(
					'wc_flush_customers_lookup', array(
				'type' => 'button',
				'url' => add_query_arg('wpse_wc_customer_lookup_purge', 1),
				'allow_in_frontend' => false,
				'content' => __('WC Customers: Flush the cache', VGSE()->textname),
				'icon' => 'fa fa-reload',
				'toolbar_key' => 'secondary',
				'parent' => 'support',
					), $post_type
			);
		}

		function sync_customer_lookup_table($user_id, $values) {
			global $wpdb;

			if (!$this->customer_lookup_exists()) {
				return;
			}
			$email = $values['user_email'];
			$lookup_table_name = \Automattic\WooCommerce\Admin\API\Reports\Customers\DataStore::get_db_table_name();
			if (!empty($values['wpse_status']) && $values['wpse_status'] === 'delete') {

				$customer_ids = $wpdb->get_col($wpdb->prepare("SELECT customer_id FROM $lookup_table_name WHERE email = %s", $email));
				do_action('woocommerce_delete_customer', $user_id);
				foreach ($customer_ids as $customer_id) {
					if (is_numeric($customer_id)) {
						$customer_id = (int) $customer_id;
						\Automattic\WooCommerce\Admin\API\Reports\Customers\DataStore::delete_customer($customer_id);
					}
				}
			} else {
				$customer = new WC_Customer($user_id);
				do_action('woocommerce_update_customer', $user_id, $customer);
			}
			\Automattic\WooCommerce\Admin\API\Reports\Cache::invalidate();
		}

		function register_columns($editor) {

			if (!function_exists('WC')) {
				return;
			}

			$post_type = 'user';

			if ($editor->provider->key !== 'user') {
				return;
			}

			$countries_obj = new WC_Countries();
			$countries = $countries_obj->__get('countries');

			$editor->args['columns']->register_item('billing_first_name', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_first_name',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing first name', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_first_name',),
			));
			$editor->args['columns']->register_item('billing_last_name', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_last_name',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing last name', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_last_name',),
			));
			$editor->args['columns']->register_item('billing_company', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_company',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing company', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_company',),
			));
			$editor->args['columns']->register_item('billing_address_1', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_address_1',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing address 1', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_address_1',),
			));
			$editor->args['columns']->register_item('billing_address_2', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_address_2',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing address 2', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_address_2',),
			));
			$editor->args['columns']->register_item('billing_city', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_city',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing city', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_city',),
			));
			$editor->args['columns']->register_item('billing_postcode', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_postcode',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing post code', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_postcode',),
			));
			$editor->args['columns']->register_item('billing_country', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_country',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing country', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_country', 'editor' => 'select', 'selectOptions' => $countries),
			));
			$editor->args['columns']->register_item('billing_state', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_state',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing state', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_state',),
			));
			$editor->args['columns']->register_item('billing_phone', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_phone',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing phone', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_phone',),
			));
			$editor->args['columns']->register_item('billing_email', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'billing_email',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Billing email', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'billing_email',),
			));

			$editor->args['columns']->register_item('shipping_first_name', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_first_name',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping first name', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_first_name',),
			));
			$editor->args['columns']->register_item('shipping_last_name', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_last_name',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping last name', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_last_name',),
			));
			$editor->args['columns']->register_item('shipping_company', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_company',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping company', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_company',),
			));
			$editor->args['columns']->register_item('shipping_address_1', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_address_1',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping address 1', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_address_1',),
			));
			$editor->args['columns']->register_item('shipping_address_2', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_address_2',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping address 2', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_address_2',),
			));
			$editor->args['columns']->register_item('shipping_city', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_city',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping city', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_city',),
			));
			$editor->args['columns']->register_item('shipping_postcode', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_postcode',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping post code', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_postcode',),
			));
			$editor->args['columns']->register_item('shipping_country', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_country',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping country', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_country', 'editor' => 'select', 'selectOptions' => $countries),
			));
			$editor->args['columns']->register_item('shipping_state', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_state',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping state', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_state',),
			));
			$editor->args['columns']->register_item('shipping_phone', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_phone',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping phone', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_phone',),
			));
			$editor->args['columns']->register_item('shipping_email', $post_type, array(
				'data_type' => 'post_data', //String (post_data,post_meta|meta_data)	
				'unformatted' => array('data' => 'shipping_email',), //Array (Valores admitidos por el plugin de handsontable)
				'column_width' => 210, //int (Ancho de la columna)
				'title' => __('Shipping email', vgse_users()->textname), //String (Titulo de la columna)
				'type' => '', // String (Es para saber si será un boton que abre popup, si no dejar vacio) boton_tiny|boton_gallery|boton_gallery_multiple|(vacio)
				'supports_formulas' => true,
				'allow_to_hide' => true,
				'allow_to_save' => true,
				'allow_to_rename' => true,
				'formatted' => array('data' => 'shipping_email',),
			));
			$editor->args['columns']->register_item('wc_last_order_date', $post_type, array(
				'data_type' => 'post_data',
				'unformatted' => array('renderer' => 'html', 'readOnly' => true),
				'column_width' => 75,
				'title' => __('Last purchase date', VGSE()->textname),
				'type' => '',
				'supports_formulas' => false,
				'allow_to_hide' => true,
				'allow_to_save' => false,
				'allow_to_rename' => false,
				'is_locked' => true,
				'formatted' => array('renderer' => 'html', 'readOnly' => true),
				'get_value_callback' => array($this, 'get_last_purchase_date_for_cell'),
			));
			$editor->args['columns']->register_item('_money_spent', $post_type, array(
				'data_type' => 'post_data',
				'column_width' => 75,
				'title' => __('Total spent', VGSE()->textname),
				'type' => '',
				'supports_formulas' => false,
				'allow_to_hide' => true,
				'allow_to_save' => false,
				'allow_to_rename' => false,
				'is_locked' => true,
				'get_value_callback' => array($this, 'get_total_spent_for_cell'),
			));
			$editor->args['columns']->register_item('_wc_aov', $post_type, array(
				'data_type' => 'post_data',
				'column_width' => 75,
				'title' => __('Average order value', VGSE()->textname),
				'type' => '',
				'supports_formulas' => false,
				'allow_to_hide' => true,
				'allow_to_save' => false,
				'allow_to_rename' => false,
				'is_locked' => true,
				'get_value_callback' => array($this, 'get_aov_for_cell'),
			));
		}

		function get_aov_for_cell($post, $cell_key, $cell_args) {
			global $wpdb;
			$value = (float) $wpdb->get_var("SELECT 
SUM({$wpdb->prefix}wc_order_stats.net_total) / COUNT({$wpdb->prefix}wc_order_stats.order_id) AS avg_order_value 
FROM {$wpdb->prefix}wc_order_stats 
LEFT JOIN {$wpdb->prefix}wc_customer_lookup 
ON {$wpdb->prefix}wc_order_stats.customer_id = {$wpdb->prefix}wc_customer_lookup.customer_id 
WHERE {$wpdb->prefix}wc_customer_lookup.user_id = " . (int) $post->ID . " LIMIT 1");
			return $value;
		}

		function get_total_spent_for_cell($post, $cell_key, $cell_args) {
			global $wpdb;
			$value = (float) $wpdb->get_var("SELECT 
SUM({$wpdb->prefix}wc_order_stats.net_total) as total
FROM {$wpdb->prefix}wc_order_stats 
LEFT JOIN {$wpdb->prefix}wc_customer_lookup 
ON {$wpdb->prefix}wc_order_stats.customer_id = {$wpdb->prefix}wc_customer_lookup.customer_id 
WHERE {$wpdb->prefix}wc_customer_lookup.user_id = " . (int) $post->ID . " LIMIT 1");
			return $value;
		}

		function get_last_purchase_date_for_cell($post, $cell_key, $cell_args) {
			$last_order_data = wc_get_customer_last_order($post->ID);
			$value = is_object($last_order_data) ? $last_order_data->get_date_created()->format('Y-m-d H:i:s') : '';
			return $value;
		}

		/**
		 * Creates or returns an instance of this class.
		 *
		 * @return  Foo A single instance of this class.
		 */
		static function get_instance() {
			if (null == WP_Sheet_Editor_Users_WooCommerce::$instance) {
				WP_Sheet_Editor_Users_WooCommerce::$instance = new WP_Sheet_Editor_Users_WooCommerce();
				WP_Sheet_Editor_Users_WooCommerce::$instance->init();
			}
			return WP_Sheet_Editor_Users_WooCommerce::$instance;
		}

		function __set($name, $value) {
			$this->$name = $value;
		}

		function __get($name) {
			return $this->$name;
		}

	}

}

if (!function_exists('WP_Sheet_Editor_Users_WooCommerce_Obj')) {

	function WP_Sheet_Editor_Users_WooCommerce_Obj() {
		return WP_Sheet_Editor_Users_WooCommerce::get_instance();
	}

}
add_action('vg_sheet_editor/after_init', 'WP_Sheet_Editor_Users_WooCommerce_Obj');
