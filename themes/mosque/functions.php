<?php 
	
	/*	
	*	CrunchPress function.php
	*	---------------------------------------------------------------------
	* 	@version	1.0
	*   @ Package   Mosque Theme
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all important functions and features of the theme.
	*	---------------------------------------------------------------------
	*/
	
	add_image_size('cp-Post-Image1',1140,575, true);
	add_image_size('cp-Blog-Post1',1600,900, true);
	add_image_size('cp-gallery-1',614,614, true);
	add_image_size('cp-Post-widget',270,270, true);
	add_image_size('cp-Post-Image3',570, 300, true);
	add_image_size('cp-causes-Thumb',450, 300, true);
	add_image_size('cp-Small-Image1',360, 300, true);
	add_image_size('cp-Team-Album3',370, 310, true);
	add_image_size('cp-Small-Thumb',80, 80, true);
	
	// constants
	define('THEME_NAME_S','cp');                                   // Short name of theme (used for various purpose in CP framework)
	define('THEME_NAME_F','CP Theme Panel');                           // Full name of theme (used for various purpose in CP framework)
	// logical location for CP framework
	if(!defined( 'CP_PATH_URL' )){ define('CP_PATH_URL', get_template_directory_uri());}
	// Physical location for CP framework
	if(!defined( 'CP_PATH_SER' )){define('CP_PATH_SER', get_template_directory() );}            
	// Define URL path of framework directory
	if(!defined( 'CP_FW_URL' )){define( 'CP_FW_URL', CP_PATH_URL . '/framework' );}
	// Define server path of framework directory             
	if(!defined( 'CP_FW' )){define( 'CP_FW', CP_PATH_SER . '/framework' );}
	// Define admin url
	if(!defined( 'AJAX_URL' )){define('AJAX_URL', admin_url( 'admin-ajax.php' ));}
	//define('FONT_SAMPLE_TEXT', 'Font Family'); 				       // Demo font text of the CrunchPress panel
	
	$date_format = get_option(THEME_NAME_S.'_default_date_format','F d, Y');                     // Get default date format
	$widget_date_format = get_option(THEME_NAME_S.'_default_widget_date_format','M d, Y');       // Get default date format for widgets
	define('GDL_DATE_FORMAT', $date_format);
	define('GDL_WIDGET_DATE_FORMAT', $widget_date_format);
 
	$cp_is_responsive = 'enable';
	$cp_is_responsive = ($cp_is_responsive == 'enable')? true: false;
	
	$default_post_sidebar = get_option(THEME_NAME_S.'_default_post_sidebar','post-no-sidebar');   // Get default post sidebar
	$default_post_sidebar = str_replace('post-', '', $default_post_sidebar);               
	$default_post_left_sidebar = get_option(THEME_NAME_S.'_default_post_left_sidebar','');        // Get option for left sidebar
	$default_post_right_sidebar = get_option(THEME_NAME_S.'_default_post_right_sidebar','');      // Get option for right sidebar
	
	if ( !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ) {
		define('CP_HTTP', 'https://');
	}else{
		define('CP_HTTP', 'http://');
	}

	
	if( !function_exists('cp_get_root_directory') ){      
	/* Get file path ( to support child theme ) */
		function cp_get_root_directory( $path ){
			if( file_exists( get_stylesheet_directory() . '/' . $path ) ){
				return get_stylesheet_directory() . '/';
			}else{
				return get_stylesheet_directory() . '/';
			}
		}
	}
	
	
	add_filter( 'wpcf7_support_html5_fallback', '__return_true' ); 
	
	// include essential files to enhance framework functionality
	include_once(CP_FW.	'/script-handler.php');							// It includes all javacript and style in theme
	include_once(CP_FW.	'/extensions/super-object.php'); 				// Super object function
	include_once(CP_FW.	'/cp-functions.php'); 							// Registered CP framework functions
	
	include_once(CP_FW.	'/cp-option.php');								// CP framework control panel
	include_once(CP_FW.	'/cp_options_typography.php');					// CP Typography control panel
	include_once(CP_FW.	'/cp_options_slider.php');						// CP Slider control panel
	include_once(CP_FW.	'/cp_options_social.php');						// CP Social Sharing
	include_once(CP_FW.	'/cp_options_sidebar.php');						// CP Sidebar Option Page
	include_once(CP_FW.	'/cp_options_default_pages.php');				// CP Default Options control panel
	include_once(CP_FW.	'/cp_options_newsletter.php');					// CP Newsletter control panel
	include_once(CP_FW.	'/cp_dummy_data_import.php');					// CP Dummy Data control panel
	
	// dashboard option
	include_once(CP_FW. '/options/meta-template.php'); 					// templates for post portfolio and gallery
	include_once(CP_FW. '/options/post-option.php');					// Register meta fields for post_type
	include_once(CP_FW. '/options/page-option.php'); 					// Register meta fields page post_type	
	include_once(CP_FW. '/options/product-option.php');					// WooCommerce Elements
	include_once(CP_FW. '/options/ignitiondeck-option.php');			// WooCommerce Elements
	
	

	
	include_once(CP_FW. '/extensions/widgets/cp_popular_posts_widget.php'); // Custom Popular Posts
	include_once(CP_FW. '/extensions/widgets/cp_facebook_widget.php'); // Custom Facebook Widget
	include_once(CP_FW. '/extensions/widgets/cp_newsletter_widget.php'); // Custom NewsLetter
	include_once(CP_FW. '/extensions/widgets/cp_news_widget.php'); // Custom News Widget
	include_once(CP_FW. '/extensions/widgets/cp_recent_news_widget.php'); // Custom Recent News Widget
	include_once(CP_FW. '/extensions/widgets/cp_flickr_widget.php'); // Custom Flicker Widget
	include_once(CP_FW. '/extensions/widgets/cp_events_widget.php'); // Custom Event Widget
	include_once(CP_FW. '/extensions/widgets/cp_funding_widget.php'); // Custom cp_service_widget
	include_once(CP_FW. '/extensions/widgets/cp_quick_links_widget.php'); // Custom cp_quick_links_widget
	include_once(CP_FW. '/extensions/widgets/cp_post_slider_widget.php'); // Custom post_slider_widget
	include_once(CP_FW. '/extensions/widgets/cp_post_tabs_widget.php'); // Custom Post Tabs Widget
	//include_once(CP_FW. '/extensions/widgets/cp_post_slider_widget.php'); // Post Slider Widget

	include_once(CP_FW. '/extensions/contact_submit.php'); 				// Custom Or External Plugins
	include_once(CP_FW. '/extensions/plugins.php'); 				// Custom Or External Plugins

	if(!is_admin()){
		include_once(CP_FW. '/extensions/sliders.php');	                            // Functions to print sliders
		include_once(CP_FW. '/options/page-elements.php');	                        // Organize page item element
		include_once(CP_FW. '/options/blog-elements.php');							// Organize blog item element
	    include_once(CP_FW. '/extensions/comment.php'); 							// function to get list of comment
		include_once(CP_FW. '/extensions/pagination.php'); 							// Register pagination plugin
		include_once(CP_FW. '/extensions/social-shares.php'); 						// Register social shares 
		include_once(CP_FW.	'/extensions/loadstyle.php');                  // Register breadcrumbs navigation
		include_once(CP_FW.	'/extensions/breadcrumbs.php');                  // Register breadcrumbs navigation
		include_once(CP_FW.	'/extensions/featured-content.php');                  // Register Feature content
		include_once(CP_FW. '/extensions/cp-headers.php'); // Registered CP Header style
		include_once(CP_FW. '/extensions/cp-footers.php'); // Registered CP Header style
	}
	

	function cp_get_themeoption_value($para_val='',$get_option=''){
		//Fetch Data from Theme Options
		$cp_general_settings = get_option($get_option);
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			return cp_find_xml_value($cp_logo->documentElement,$para_val);
		}else{
			return $para_val;
		}
	}

	
	// Custom Function
	add_filter('get_avatar','cp_add_avatar_css');

	function cp_add_avatar_css($class) {
		$class = str_replace("class='avatar", "class='avatar avatar-96 photo team-img margin", $class) ;
		return $class;		
	}
	
	
	//Declare WooCommerce Support
	add_theme_support( 'woocommerce' );
	
	add_action('woocommerce_before_main_content', 'cp_my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'cp_my_theme_wrapper_end', 10);

	function cp_my_theme_wrapper_start() {

		$select_layout_cp = '';	
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
			
		}
		$breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
		$header_style = '';
		//Print Style 6
		if(cp_print_header_html_val($header_style) == 'Style 5'){
			cp_print_header_html($header_style);
		}
		$header_style = '';
		$html_class = cp_print_header_class($header_style);
		?>
		
		<div class="contant">
		<!--Inner Pages Heading Area Start-->
		<div id="banner">
			<div id="inner-banner">
				<div class="container">
					<h1><?php if(is_single()){ echo esc_attr(get_the_title());}else{ woocommerce_page_title();};?></h1>
					<?php echo do_action('woo_custom_breadcrumb');?>
				</div>
			</div>
		</div>
		<!--Inner Pages Heading Area End--> 
		<div class="container cp-woocommerce" id="main-woo">			
<?php
	  
	}

	function cp_my_theme_wrapper_end() {
	  echo '</div>';
	}
	
	//Reposition WooCommerce breadcrumb 
	function cp_woocommerce_remove_breadcrumb(){
		remove_action('woocommerce_before_main_content', 'cp_woocommerce_breadcrumb', 20);
	}
	add_action('woocommerce_before_main_content', 'cp_woocommerce_remove_breadcrumb');

	function cp_woocommerce_custom_breadcrumb(){
		cp_woocommerce_breadcrumb();
	}

	add_action( 'woo_custom_breadcrumb', 'cp_woocommerce_custom_breadcrumb' );
	

	//Theme Dummy Data Installation	
	function cp_dummy_import(){

		foreach ($_REQUEST as $keys=>$values) {
			$$keys = trim($values);
		}
		$cp_layout = 'dummy_xml_5';
		if(wp_verify_nonce( $cp_nonce_dummy, 'cp_nonce_dummy' )){
			require_once CP_FW . '/extensions/importer/dummy_data.inc.php';
			die('dummy_import');
		}else{
			die('Not Loaded');
		}
	}
	add_action('wp_ajax_cp_dummy_import', 'cp_dummy_import');
		
	
/**
	 * Contains methods for customizing the theme customization screen.
	 * 
	 * @link http://codex.wordpress.org/Theme_Customization_API
	 * @since MyTheme 1.0
	 */
	class cp_MyTheme_Customize {
	   /**
		* This hooks into 'customize_register' (available as of WP 3.4) and allows
		* you to add new sections and controls to the Theme Customize screen.
		* 
		* Note: To enable instant preview, we have to actually write a bit of custom
		* javascript. See live_preview() for more.
		*  
		* @see add_action('customize_register',$func)
		* @param \WP_Customize_Manager $wp_customize
		* @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
		* @since MyTheme 1.0
		*/
	   public static function cp_register ( $wp_customize ) {
		  //1. Define a new section (if desired) to the Theme Customizer
		  $wp_customize->add_section( 'mytheme_options', 
			 array(
				'title' => esc_html__( 'MyTheme Options', 'mosque_crunchpress' ), //Visible title of section
				'priority' => 35, //Determines what order this appears in
				'capability' => 'edit_theme_options', //Capability needed to tweak
				'description' => esc_html__('Allows you to customize some example settings for crunchpress.', 'mosque_crunchpress'), //Descriptive tooltip
			 ) 
		  );
		  
		  //2. Register new settings to the WP database...
		  $wp_customize->add_setting( 'mytheme_options[link_textcolor]', //Give it a SERIALIZED name (so all theme settings can live under one db record)
			 array(
				'default' => '#2BA6CB', //Default setting/value to save
				'type' => 'option', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				'sanitize_callback' => 'example_sanitize_text',
			 ) 
		  );      
				
		  //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
		  $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
			 $wp_customize, //Pass the $wp_customize object (required)
			 'mytheme_link_textcolor', //Set a unique ID for the control
			 array(
				'label' => esc_html__( 'Link Color & Button Color', 'mosque_crunchpress' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'mytheme_options[link_textcolor]', //Which setting to load and manipulate (serialized is okay)
				'priority' => 10, //Determines the order this control appears in for the specified section
			 ) 
		  ) );
		  
		  
		  //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
		  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		  $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	   }

	   /**
		* This will output the custom WordPress settings to the live theme's WP head.
		* 
		* Used by hook: 'wp_head'
		* 
		* @see add_action('wp_head',$func)
		* @since MyTheme 1.0
		*/
	   public static function cp_header_output() {
		  ?>
		  <!--Customizer CSS--> 
		  <style type="text/css">
			   <?php self::cp_generate_css('#site-title a', 'color', 'header_textcolor', '#'); ?> 
			   <?php self::cp_generate_css('body', 'background-color', 'background_color', '#'); ?> 
			   <?php self::cp_generate_css('a', 'color', 'mytheme_options[link_textcolor]'); ?>
		  </style> 
		  <!--/Customizer CSS-->
		  <?php
	   }
	   
	   /**
		* This outputs the javascript needed to automate the live settings preview.
		* Also keep in mind that this function isn't necessary unless your settings 
		* are using 'transport'=>'postMessage' instead of the default 'transport'
		* => 'refresh'
		* 
		* Used by hook: 'customize_preview_init'
		* 
		* @see add_action('customize_preview_init',$func)
		* @since MyTheme 1.0
		*/
	   public static function cp_live_preview() {
		  wp_enqueue_script( 
			   'mytheme-themecustomizer', // Give the script a unique ID
			   get_template_directory_uri() . '/frontend/js/theme-customizer.js', // Define the path to the JS file
			   array(  'jquery', 'customize-preview' ), // Define dependencies
			   '', // Define a version (optional) 
			   true // Specify whether to put in footer (leave this true)
		  );
	   }

		/**
		 * This will generate a line of CSS for use in header output. If the setting
		 * ($mod_name) has no defined value, the CSS will not be output.
		 * 
		 * @uses get_theme_mod()
		 * @param string $selector CSS selector
		 * @param string $style The name of the CSS *property* to modify
		 * @param string $mod_name The name of the 'theme_mod' option to fetch
		 * @param string $prefix Optional. Anything that needs to be output before the CSS property
		 * @param string $postfix Optional. Anything that needs to be output after the CSS property
		 * @param bool $echo Optional. Whether to print directly to the page (default: true).
		 * @return string Returns a single line of CSS with selectors and a property.
		 * @since MyTheme 1.0
		 */
		public static function cp_generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
		  $return = '';
		  $mod = get_theme_mod($mod_name);
		  if ( ! empty( $mod ) ) {
			 $return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix.$mod.$postfix
			 );
			 if ( $echo ) {
				echo html_entity_decode($return);
			 }
		  }
		  return $return;
		}
	}

	// Setup the Theme Customizer settings and controls...
	add_action( 'customize_register' , array( 'cp_MyTheme_Customize' , 'cp_register' ) );

	// Output custom CSS to live site
	add_action( 'wp_head' , array( 'cp_MyTheme_Customize' , 'cp_header_output' ) );

	// Enqueue live preview javascript in Theme Customizer admin screen
	add_action( 'customize_preview_init' , array( 'cp_MyTheme_Customize' , 'cp_live_preview' ) );

	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'cp_get_featured_posts',
		'max_posts' => 6,
	) );
	
	//Add Custom Field to user profile
	function cp_modify_contact_methods($profile_fields) {

		// Add new fields
		$profile_fields['twitter'] = 'Twitter URL';
		$profile_fields['facebook'] = 'Facebook URL';
		$profile_fields['gplus'] = 'Google+ URL';
		$profile_fields['linked'] = 'Linked in URL';
		$profile_fields['skype'] = 'Skype ID';
		
		//unset($profile_fields['aim']);

		return $profile_fields;
	}
	add_filter('user_contactmethods', 'cp_modify_contact_methods');

	
	//Feature Post function
	function cp_get_featured_posts() {
		return apply_filters( 'cp_get_featured_posts', array() );
	}
	//Feature Post function
	function cp_has_featured_posts() {
		return ! is_paged() && (bool) cp_get_featured_posts();
	}



 // Register your custom function to override some LayerSlider data
    add_action('layerslider_ready', 'cp_my_layerslider_overrides');
 
    function cp_my_layerslider_overrides() {
 
        // Disable auto-updates
        $GLOBALS['lsAutoUpdateBox'] = false;
    }
	
	function cp_admin_notice_framework() { ?>
		<div class="updated">
			<p><strong><?php esc_html_e( 'Please install theme required plug-ins to use all functionalities of theme', 'mosque_crunchpress' ); ?></strong> - <?php esc_html_e('in case of deactivating the theme required plug-ins you may not able to use theme extra functionality.','mosque_crunchpress');?></p>
		</div>
		<?php
	}
	
	
	//Maintenance Mode Admin Notice
	$mm = cp_get_themeoption_value('maintenance_mode','general_settings');
	if($mm == 'enable'){
		add_action( 'admin_notices', 'cp_admin_notice_maintenance_mode' );
	}
	function cp_admin_notice_maintenance_mode() { ?>
		<div class="error">
			<p><strong><?php esc_html_e( 'Theme has activated maintenance mode!', 'mosque_crunchpress' ); ?></strong> - <?php esc_html_e('Please turn it off from Cp Theme Panel > General Settings > Maintenance Mode Settings > Maintenance Mode (On/Off).','mosque_crunchpress');?></p>
		</div>
		<?php
	}
	
	
	
	function cp_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() ) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 ) {
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'mosque_crunchpress' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'cp_wp_title', 10, 2 );	
	

	function cp_vimeo_video($post_id = '', $size= '', $video_url = ''){
		
		if($video_url <> ''){
			
			$img_html = '<div class="post_featured_image thumbnail_image">';
			$img_html = $img_html . '<div class="blog-thumbnail-video">';
			
			if(cp_get_width($size) == '175'){
				$img_html = $img_html . cp_get_video($video_url, cp_get_width($size), cp_get_height($size));
			}else{
				$img_html = $img_html . cp_get_video($video_url, '100%', cp_get_height($size));
			}
			$img_html = $img_html . '</div></div>';
		}
		
	}