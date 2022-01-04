<?php
/*
Plugin Name: TranslatePress - Automatic User Language Detection Add-on
Plugin URI: https://translatepress.com/
Description: Automatically redirects new visitors to their preferred language based on browser settings or IP address and remembers the last visited language.
Version: 1.0.8
Author: Cozmoslabs, Razvan Mocanu
Author URI: https://translatepress.com/
License: GPL2

== Copyright ==
Copyright 2020 Cozmoslabs (www.cozmoslabs.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/



function trp_ald_run(){

	/** Initialize update here in the main plugin file. It is a must **/
	// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
	define( 'TRP_ALD_STORE_URL', 'https://translatepress.com' );
	// the name of your product. This should match the download name in EDD exactly
	define( 'TRP_ALD_ITEM_NAME', 'Automatic User Language Detection' );
	if( !class_exists( 'TRP_EDD_ALD_Plugin_Updater' ) ) {
		// load our custom updater
		include( dirname( __FILE__ ) . '/includes/class-edd-ald-plugin-updater.php' );
	}
	// retrieve our license key from the DB
	$license_key = trim( get_option( 'trp_license_key' ) );
	// add-on version number
	define( 'TRP_ALD_PLUGIN_VERSION', '1.0.8' );
	// setup the updater
	$edd_updater = new TRP_EDD_ALD_Plugin_Updater( TRP_ALD_STORE_URL, __FILE__, array(
						'version' 	=> TRP_ALD_PLUGIN_VERSION, 		// current version number
						'license' 	=> $license_key, 	// license key (used get_option above to retrieve from DB)
						'item_name' => TRP_ALD_ITEM_NAME, 	// name of this plugin
						'item_id'   => '3663',
						'author' 	=> 'Cozmoslabs',  // author of this plugin
						'beta' 		=> false
						)
			);
	/** End the update initialization here **/
	
    require_once plugin_dir_path( __FILE__ ) . 'class-automatic-language-detection.php';
    if ( class_exists( 'TRP_Translate_Press' ) && !isset( $_GET['trp-edit-translation'] ) ) {
	    new TRP_Automatic_Language_Detection();
    }
}
add_action( 'plugins_loaded', 'trp_ald_run', 0 );
