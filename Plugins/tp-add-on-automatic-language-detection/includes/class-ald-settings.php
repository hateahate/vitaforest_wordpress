<?php

class TRP_ALD_Settings {
	
	protected $ald_settings;

	/**
	 * Getter function for ALD settings.
	 *
	 * @return array
	 */
	public function get_ald_settings(){
		if ( $this->ald_settings == null ){
			$this->ald_settings = $this->trp_ald_set_settings();
		}
		return $this->ald_settings;
	}

	/**
	 * Returns default option.
	 *
	 * @return array
	 */
	public function get_default_option(){
		return array(
			'detection-method'  => 'browser-ip',
		);
	}

	/**
	 * Return array of all possible methods of detection and their label.
	 *
	 * @return array
	 */
	public function get_detection_methods_array(){
		return apply_filters( 'trp_ald_detection_methods_array', array(
			'browser-ip'    => __( 'First by browser language, then IP address (recommended)', 'translatepress-multilingual'),
			'ip-browser'    => __( 'First by IP address, then by browser language', 'translatepress-multilingual'),
			'browser'       => __( 'Only by browser language', 'translatepress-multilingual'),
			'ip'            => __( 'Only by IP address', 'translatepress-multilingual'),
		) );
	}

	/**
	 * Returns settings option from db.
	 * Sets option in db if not exists.
	 *
	 * @return array
	 */
	protected function trp_ald_set_settings(){
		$settings_option = get_option( 'trp_ald_settings', 'not_set' );

		// initialize default settings
		$default_settings = $this->get_default_option();
		if ( 'not_set' == $settings_option ){
			update_option ( 'trp_ald_settings', $default_settings );
			$settings_option = $default_settings;
		}else{
			foreach ( $default_settings as $key_default_setting => $value_default_setting ){
				if ( !isset ( $settings_option[$key_default_setting] ) ) {
					$settings_option[$key_default_setting] = $value_default_setting;
				}
			}
		}
		return $settings_option;
	}

	/**
	 * Register ALD settings option.
	 */
	public function register_setting(){
		register_setting( 'trp_settings', 'trp_ald_settings', array( $this, 'sanitize_settings' ) );
	}

	/**
	 * Sanitize ALD settings.
	 *
	 * @param $ald_settings
	 *
	 * @return mixed
	 */
	public function sanitize_settings( $submitted_settings ){
		$possible_values = array_keys( $this->get_detection_methods_array() );
		if ( in_array( $submitted_settings['detection-method'], $possible_values ) ){
			$ald_settings['detection-method'] = $submitted_settings['detection-method'];
		}else{
			$default_options = $this->get_default_option();
			$ald_settings['detection-method'] = $default_options['detection-method'];
		}
		return $ald_settings;
	}

	/**
	 * Display ALD settings.
	 *
	 * Hooked to 'trp_extra_settings'
	 *
	 * @param $settings
	 */
	public function addon_settings_ui( $settings ){
		$ald_settings = $this->get_ald_settings();
		$detection_methods = $this->get_detection_methods_array();

		// Called in order to require the necessary files for TRP_IP_Language class
		new TRP_ALD_Determine_Language();
		$trp_ip_language = new TRP_IP_Language();
		$ip = $trp_ip_language->get_current_ip();
		$ip_warning_message = '';
		if ( ! $trp_ip_language->found_ip_in_database( $ip ) ){
			$ip_warning_message = '<div class="warning">'. __( 'WARNING. Cannot determine your language preference based on your current IP.<br>This is most likely because the website is on a local environment.', 'translatepress-multilingual' ).'</div>';
		}

		require_once ( TRP_ALD_PLUGIN_DIR . 'partials/settings-option.php' );
	}
}
