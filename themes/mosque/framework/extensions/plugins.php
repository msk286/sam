<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme

		// This is an example of how to include a plugin from the WordPress Plugin Repository
		
		array(
            'name'      => 'Wordpress Importer',
            'slug'      => 'wordpress-importer',
            'required'  => true,
			'force_activation' => true,
        ),
		
		array(
            'name'      => 'WooCommerce Shopping',
            'slug'      => 'woocommerce',
            'required'  => false,
        ),
		
		
		array(
            'name'      => 'Event Manager',
            'slug'      => 'events-manager',
            'required'  => false,
        ),
		
		array(
            'name'      => 'contact-form7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
		
		array(
			'name'     				=> 'Layer Slider', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			//'source'   				=> get_stylesheet_directory() . '/framework/extensions/plugins/wordpress-importer.zip', // The plugin source
			'source'   				=> 'http://crunchpress.net/dev/localdirectory/LayerSlider_latest.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		

		
		array(
			'name'     				=> 'CrunchPress Framework', // The plugin name
			'slug'     				=> 'cp-framework', // The plugin slug (typically the folder name)			
			'source'   				=> get_stylesheet_directory() . '/framework/extensions/plugins/cp-framework.zip', // The plugin source
			//'source'   				=> 'http://crunchpress.net/dev/localdirectory/cp-framework.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Salat Times', // The plugin name
			'slug'     				=> 'salat-times', // The plugin slug (typically the folder name)			
			'source'   				=> get_stylesheet_directory() . '/framework/extensions/plugins/salat-times.zip', // The plugin source
			//'source'   			=> 'http://crunchpress.net/dev/localdirectory/cp-framework.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),

		array(
			'name'     				=> 'CrunchPress Shortcodes', // The plugin name
			'slug'     				=> 'cp-shortcode-core', // The plugin slug (typically the folder name)			
			'source'   				=> get_stylesheet_directory() . '/framework/extensions/plugins/cp-shortcode-core.zip', // The plugin source
			//'source'   				=> 'http://crunchpress.net/dev/localdirectory/cp-framework.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
	);
	
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'mosque_crunchpress';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'mosque_crunchpress',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> esc_html__( 'Install Required Plugins', 'mosque_crunchpress' ),
			'menu_title'                       			=> esc_html__( 'Install Plugins', 'mosque_crunchpress' ),
			'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'mosque_crunchpress' ), // %1$s = plugin name
			'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'mosque_crunchpress' ),
			'notice_can_install_required'     			=> _n_noop( esc_html__('This theme requires the following plugin: %1$s.', 'mosque_crunchpress'), esc_html__('This theme requires the following plugins: %1$s.', 'mosque_crunchpress' )), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( esc_html__('This theme recommends the following plugin: %1$s.', 'mosque_crunchpress'), esc_html__('This theme recommends the following plugins: %1$s.', 'mosque_crunchpress' )), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( esc_html__('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'mosque_crunchpress'), esc_html__('Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'mosque_crunchpress' )), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( esc_html__('The following required plugin is currently inactive: %1$s.', 'mosque_crunchpress'), esc_html__('The following required plugins are currently inactive: %1$s.', 'mosque_crunchpress' )), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( esc_html__('The following recommended plugin is currently inactive: %1$s.', 'mosque_crunchpress'), esc_html__('The following recommended plugins are currently inactive: %1$s.', 'mosque_crunchpress' )), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( esc_html__('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'mosque_crunchpress'), esc_html__('Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'mosque_crunchpress' )), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( esc_html__('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'mosque_crunchpress'), esc_html__('The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'mosque_crunchpress' )), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( esc_html__('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'mosque_crunchpress'), esc_html__('Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'mosque_crunchpress' )), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( esc_html__('Begin installing plugin', 'mosque_crunchpress'), esc_html__('Begin installing plugins', 'mosque_crunchpress' )),
			'activate_link' 				  			=> _n_noop( esc_html__('Activate installed plugin', 'mosque_crunchpress'), esc_html__('Activate installed plugins', 'mosque_crunchpress' )),
			'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'mosque_crunchpress' ),
			'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'mosque_crunchpress' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'mosque_crunchpress' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}