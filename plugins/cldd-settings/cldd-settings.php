<?php
/**
 * @package cldd-settings
 * @version 1.0
 */
/*
Plugin Name: ColdAd - My Settings
Plugin URI: https://wordpress.org/plugins/
Description: ColdAd Settings
Author: Mohamed Kawsara
Version: 1.0
Author URI: http://www.coldad.com/
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Include our essential file that take care of includeing dependencies
require_once( plugin_dir_path(__FILE__) . 'inc/index.php');
