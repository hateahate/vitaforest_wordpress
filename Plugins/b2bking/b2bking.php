<?php
/*
/**
 * Plugin Name:       Vitaforest B2B Solution
 * Plugin URI:        vitaforest.eu
 * Description:       B2B solution for Vitaforest Platform based on B2BKing 3.0.0
 * Version:           0.2.1
 * Author:            WebWizards, DigitalBros
 * Author URI:        webwizards.dev, digitalbros.xyz
 * Domain Path:       /languages
 * WC requires at least: 3.0.0
 * WC tested up to: 4.8.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'B2BKING_DIR', plugin_dir_path( __FILE__ ) );

function b2bking_activate() {
	require_once B2BKING_DIR . 'includes/class-b2bking-activator.php';
	B2bking_Activator::activate();
}
register_activation_hook( __FILE__, 'b2bking_activate' );

require B2BKING_DIR . 'includes/class-b2bking.php';

// Load plugin language
add_action( 'init', 'b2bking_load_language');
function b2bking_load_language() {
   load_plugin_textdomain( 'b2bking', FALSE, basename( dirname( __FILE__ ) ) . '/languages');
}

// Begins execution of the plugin.
function b2bking_run() {
	$plugin = new B2bking();
}

b2bking_run();
