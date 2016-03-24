<?php

	/*	
	*	CrunchPress Include Script File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	*   @ Package   Fine Food Theme
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file manage to embed the stylesheet and javascript to each page
	*	based on the content of that page.
	*	---------------------------------------------------------------------
	*/
	
	//Add Scripts in Theme
	if(is_admin()){
		add_action('admin_enqueue_scripts', 'register_meta_script');
		add_action('admin_enqueue_scripts','register_crunchpress_panel_scripts');
		add_action('admin_enqueue_scripts','register_crunchpress_panel_styles');
	}else{
		add_action('wp_enqueue_scripts','register_non_admin_styles');
		add_action('wp_enqueue_scripts','register_non_admin_scripts');

	}

	
	/* 	---------------------------------------------------------------------
	*	This section include the back-end script
	*	---------------------------------------------------------------------
	*/ 
	
	function register_meta_script(){
		global $post_type;
		
		wp_enqueue_style('cp-bootstrap', CP_PATH_URL.'/framework/stylesheet/bootstrap.css');
		wp_enqueue_style('thickbox');
		
		//Font Awesome
		wp_enqueue_style('cp-fontAW',CP_PATH_URL.'/frontend/cp_font/css/font-awesome.css');
		wp_enqueue_style('cp-fontAW',CP_PATH_URL.'/frontend/cp_font/css/font-awesome-ie7.css');
		wp_enqueue_style('cp-svg',CP_PATH_URL.'/frontend/cp_font/style.css');
		
		// register style and script when access to the "page" post_type page
		if( $post_type == 'page' ){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
			wp_enqueue_style('page-dragging',CP_PATH_URL.'/framework/stylesheet/page-dragging.css');
			wp_enqueue_style('image-picker',CP_PATH_URL.'/framework/stylesheet/image-picker.css');
			
			wp_register_script('image-picker', CP_PATH_URL.'/framework/javascript/image-picker.js', false, '1.0', true);
			wp_enqueue_script('image-picker');
		
			wp_register_script('page-dragging', CP_PATH_URL.'/framework/javascript/page-dragging.js', false, '1.0', true);
			wp_enqueue_script('page-dragging');
			
			wp_register_script('edit-box', CP_PATH_URL.'/framework/javascript/edit-box.js', false, '1.0', true);
			wp_enqueue_script('edit-box');
			
			wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('confirm-dialog');
			
			
		// register style and script when access to the "post" post_type page
		}else if( $post_type == 'event' || $post_type == 'post' || $post_type == 'team'  || $post_type == 'portfolio' || $post_type == 'cp_slider' || $post_type == 'gallery' || $post_type == 'product' ){
		
			wp_deregister_style('admin-css');
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
			wp_enqueue_style('image-picker',CP_PATH_URL.'/framework/stylesheet/image-picker.css');
			wp_enqueue_style('confirm-dialog',CP_PATH_URL.'/framework/stylesheet/jquery.confirm.css');
			
			wp_register_script('post-effects', CP_PATH_URL.'/framework/javascript/post-effects.js', false, '1.0', true);
			wp_enqueue_script('post-effects');
			
			wp_register_script('image-picker', CP_PATH_URL.'/framework/javascript/image-picker.js', false, '1.0', true);
			wp_localize_script('image-picker', 'URL', array('mosque_crunchpress' => CP_PATH_URL ));
			wp_enqueue_script('image-picker');
			
			wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_enqueue_script('confirm-dialog');
		
		// register style and script when access to the "testimonial" post_type page		
		}else if( $post_type == 'testimonial' ){
		
			wp_enqueue_style('meta-css',CP_PATH_URL.'/framework/stylesheet/meta-css.css');
		
		}else if($post_type == 'albums'){
		
			wp_register_script('cp-contact-validation', CP_PATH_URL.'/frontend/js/jquery.validate.js', false, '1.0', true);
			wp_enqueue_script('cp-contact-validation');
		}
		
	}
	
	
	// register script in CrunchPress panel
	function register_crunchpress_panel_scripts(){
		global $post_type;
		
	
		if($post_type == 'page'){
		
		}else{
			wp_enqueue_style('cp-bootstrap',CP_PATH_URL.'/framework/stylesheet/bootstrap.css');
			$cp_script_url = CP_PATH_URL.'/framework/javascript/cp-panel.js';
			wp_enqueue_script('cp_scripts_admin', $cp_script_url, array('jquery','media-upload','cp-bootstrap','thickbox', 'jquery-ui-droppable','jquery-ui-datepicker','jquery-ui-tabs', 'jquery-ui-slider','jquery-timepicker','jquery-ui-position','mini-color','confirm-dialog','dummy_content'));

			wp_register_script('cp-bootstrap', CP_PATH_URL.'/framework/javascript/bootstrap.js', false, '1.0', true);
			// wp_enqueue_script('cp-bootstrap');

			//Font Awesome
			wp_enqueue_style('cp-fontAW',CP_PATH_URL.'/frontend/cp_font/css/font-awesome.css');
			wp_enqueue_style('cp-fontAW',CP_PATH_URL.'/frontend/cp_font/css/font-awesome-ie7.css');
		
		
			wp_register_script('mini-color', CP_PATH_URL.'/framework/javascript/jquery.miniColors.js', false, '1.0', true);
			wp_register_script('confirm-dialog', CP_PATH_URL.'/framework/javascript/jquery.confirm.js', false, '1.0', true);
			wp_register_script('jquery-timepicker', CP_PATH_URL.'/framework/javascript/jquery.ui.timepicker.js', false, '1.0', true);
			wp_register_script('dummy_content', CP_PATH_URL.'/framework/javascript/dummy_content.js', false, '1.0', true);
		}		
	}

	// register style in CrunchPress panel
	function register_crunchpress_panel_styles(){
	
		wp_enqueue_style('jquery-ui',CP_PATH_URL.'/framework/stylesheet/jquery-ui.css');
		wp_enqueue_style('cp-panel',CP_PATH_URL.'/framework/stylesheet/cp-panel.css');
		wp_enqueue_style('mini-color',CP_PATH_URL.'/framework/stylesheet/jquery.miniColors.css');
		wp_enqueue_style('confirm-dialog',CP_PATH_URL.'/framework/stylesheet/jquery.confirm.css');
		wp_enqueue_style('jquery-timepicker',CP_PATH_URL.'/framework/stylesheet/jquery.ui.timepicker.css');
		
	}
	
	/* 	---------------------------------------------------------------------
	*	this section include the front-end script
	*	---------------------------------------------------------------------
	*/ 
	
	// Register all stylesheet

	function register_non_admin_styles(){
	
		$cp_page_xml = '';
		$slider_type = '';
	
		global $post,$post_id,$cp_page_xml,$slider_type;
		
		$cp_page_xml = get_post_meta($post_id,'page-option-item-xml', true);
		$slider_type = get_post_meta ( $post_id, "page-option-top-slider-types", true );
		
		wp_deregister_style('ignitiondeck-base');
		
		wp_enqueue_style( 'default-style', get_stylesheet_uri() );  //Default Stylesheet
		
		//svg icons stylesheet
		wp_enqueue_style('cp-svg',CP_PATH_URL.'/frontend/cp_font/style.css');
		
	
		//Material Menu Mosque
		wp_register_script('cp-material-menu', CP_PATH_URL.'/frontend/js/materialMenu.min.js', false, '1.0', true);
		wp_enqueue_script('cp-material-menu');
		
		wp_enqueue_style('cp-material-csmenu',CP_PATH_URL.'/frontend/css/mmenu.min.css');
		
		//PrettyPhoto
		wp_enqueue_style('cp-prettyPhoto',CP_PATH_URL.'/frontend/css/prettyphoto.css');
		wp_register_script('cp-prettyPhoto', CP_PATH_URL.'/frontend/shortcodes/js/jquery.prettyphoto.js', false, '1.0', true);
		wp_enqueue_script('cp-prettyPhoto');
		wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/shortcodes/js/pretty_script.js', false, '1.0', true);
		wp_enqueue_script('cp-pscript');

		//Temp
		wp_register_script('cp-movingjs', CP_PATH_URL.'/frontend/js/bg-moving.js', false, '1.0', true);
		wp_enqueue_script('cp-movingjs');
		
		wp_register_script('cp-video', CP_PATH_URL.'/frontend/js/jquery.vide.js', false, '1.0', true);
		wp_enqueue_script('cp-video');

		wp_enqueue_style('cp-bootstrap',CP_PATH_URL.'/frontend/css/default/bootstrap.css'); //Bootstrap Grid
		
		wp_enqueue_style('cp-wp-cp_default',CP_PATH_URL.'/frontend/css/default/cp_default.css'); //Wordpress Default Widget Style
		wp_enqueue_style('cp-wp-cp_widgets',CP_PATH_URL.'/frontend/css/default/cp_widgets.css'); //Wordpress Default Widget Style
		
		wp_enqueue_style('cp-wp-responsive',CP_PATH_URL.'/frontend/css/default/responsive.css'); //Wordpress Default Widget Style
		
		wp_enqueue_style('cp-wp-commerce',CP_PATH_URL.'/frontend/css/woocommerce.css'); //WooCommerce Default
		wp_enqueue_style('cp-wp-commerce',CP_PATH_URL.'/frontend/css/default/wp-commerce.css'); //WooCommerce Default
		
		wp_enqueue_style('cp-headers',CP_PATH_URL.'/frontend/css/default/headers.css'); //Bootstrap Grid

		wp_enqueue_style('cp-fontAW',CP_PATH_URL.'/frontend/cp_font/css/font-awesome.css');
		wp_enqueue_style('cp-fontAW',CP_PATH_URL.'/frontend/cp_font/css/font-awesome-ie7.css');
	
		$rtl_layout = '';
		$site_loader = '';
		$element_loader = '';
		//General Settings Values
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$rtl_layout = cp_find_xml_value($cp_logo->documentElement,'rtl_layout');
			$site_loader = cp_find_xml_value($cp_logo->documentElement,'site_loader');
			$element_loader = cp_find_xml_value($cp_logo->documentElement,'element_loader');
		}
		
		//Responsive stylesheet
		wp_deregister_style('woocommerce-general');
		wp_deregister_style('ls-google-fonts-css');
		wp_deregister_style('woocommerce-layout');
		wp_deregister_style('woocommerce_frontend_styles');		
		wp_deregister_style('events-manager');		
		wp_deregister_style('mm_font-awesome');		
		

		//Scroll Bar
		wp_enqueue_style('cp-scroll-bar',CP_PATH_URL.'/frontend/shortcodes/css/jquery.mCustomScrollbar.css'); //ScrollBar
		
		
		//RTL Layouts
		if($rtl_layout == 'enable'){
			wp_enqueue_style('cp-rtl',CP_PATH_URL.'/rtl.css');
		}		
		
		
		//Facebook Fan Page Script
		if(isset($post->ID)){
			$facebook_fan = '';
			$facebook_fan = get_post_meta ( $post->ID, "page-option-item-facebook-selection", true );
			if($facebook_fan == 'Yes'){$facebook_fan = 'facebook_fan';
				wp_enqueue_style('cp-style_810',CP_PATH_URL.'/frontend/css/style810.css');
			}
		}	
		
		$cp_maintenance_mode = cp_get_themeoption_value('maintenance_mode','general_settings');				
		if($cp_maintenance_mode == 'enable'){		
			wp_enqueue_style('cp-countdown',CP_PATH_URL.'/frontend/css/jquery.countdown.css');
			wp_enqueue_style('cp-comming_soon',CP_PATH_URL.'/frontend/css/comming_soon.css');
		}

		$twitter_feed = cp_get_themeoption_value('twitter_feed','general_settings');
		if($twitter_feed == 'enable'){ 
			wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
		}

		if(isset($post)){
			$content = strip_tags(get_the_content());
			
			
			if ( has_shortcode( $post->post_content, 'event_counter_box' ) ) { 		
				wp_enqueue_style('cp-countdown',CP_PATH_URL.'/frontend/css/jquery.countdown.css');
			}
			
			if ( has_shortcode( $post->post_content, 'person' ) ) { 		
				wp_enqueue_style('prettyPhoto',CP_PATH_URL.'/frontend/css/prettyphoto.css');
			}
			
			if ( has_shortcode( $post->post_content, 'slider' ) ) { 		
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			}
			
			if ( has_shortcode( $post->post_content, 'counter_circle' ) ) { 		
				wp_enqueue_style('cp-easy-chart',CP_PATH_URL.'/frontend/shortcodes/css/chart.css');
			}

			if ( has_shortcode( $post->post_content, 'counters_circle' ) ) { 		
				wp_enqueue_style('cp-easy-chart',CP_PATH_URL.'/frontend/shortcodes/css/chart.css');
			}			
		}
		
		//Widget Active
		if(is_active_widget( '', '', 'twitter_widget')){			
			wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
		}
	
		if( is_search() || is_archive() ){
		
			wp_enqueue_style('cp-anything-slider',CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
	
		
	
		// Post post_type
		}else if( isset($post) && $post->post_type == 'post' || 
			isset($post) && $post->post_type == 'event' ){
		
				// If using slider (flex slider)	
				if(!is_home()){
					$thumbnail_types = '';
					$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
					if($post_detail_xml <> ''){
						$cp_post_xml = new DOMDocument ();
						$cp_post_xml->loadXML ( $post_detail_xml );
						$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
						
						if( $thumbnail_types == 'Slider'){
					
							wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
							
						}
					}
					
					
					
					$event_detail_xml = get_post_meta($post->ID, 'event_detail_xml', true);
					if($event_detail_xml <> ''){
						$cp_event_xml = new DOMDocument ();
						$cp_event_xml->loadXML ( $event_detail_xml );
						$event_thumbnail = cp_find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
						//Call the CountDown Style
						wp_enqueue_style('cp-countdown',CP_PATH_URL.'/frontend/css/jquery.countdown.css'); //Load Style		
						
					}
					
				}
								
				
			
		// Page post_type
		}else if( isset($post) && $post->post_type == 'page' ){
		
			global $post,$cp_page_xml, $slider_type, $cp_top_slider_type;
			$cp_page_xml = get_post_meta($post->ID,'page-option-item-xml', true);
			$cp_top_slider_switch = get_post_meta($post->ID,'page-option-top-slider-on', true);
			$slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
			$cp_top_slider_type = get_post_meta($post->ID,'page-option-top-slider-types', true);
			
			//Team Slider and Scroller
			if(strpos($cp_page_xml,'<Team-Slider>') > -1){			
				wp_enqueue_style('cp-horizontal',CP_PATH_URL.'/frontend/css/horizontal.css'); //Horizontal Scroll Team
			}	
			
			
			//Layer Slider
			if(strpos($cp_page_xml,'<slider-type>Layer-Slider</slider-type>') > -1 || $slider_type == 'Layer-Slider'){
				//wp_enqueue_style('layerslider_js', CP_PATH_URL.'/frontend/css/layerslider.css');
			}
			
			// If using carousel slider
			if(	strpos($cp_page_xml,'<slider-type>Flex-Slider</slider-type>') > -1 || $slider_type == 'Flex-Slider'){
				wp_enqueue_style('cp-flex-slider',CP_PATH_URL.'/frontend/css/flexslider.css');
			}			
			
			//Bx Slider Condition
			if(strpos($cp_page_xml,'<slider-type>Bx-Slider</slider-type>') > -1 || $slider_type == 'Bx-Slider' ){
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			}
			
			if(strpos($cp_page_xml,'<Column>') > -1){
				
			}

			//Recipe or Services offers
			if(strpos($cp_page_xml,'<Offers>') > -1){
				wp_enqueue_style('cp-mCustomScrollbar',CP_PATH_URL.'/frontend/css/jquery.mCustomScrollbar.css'); //Scroll Bar
			}
			//Bx Slider
			if(strpos($cp_page_xml,'<Event-Slider>') > -1){
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			}
			
			
			//Calender View
			if( strpos($cp_page_xml,'<eventview>Calendar View</eventview>') > -1 ){
				wp_enqueue_style('cp-calender-view', CP_PATH_URL.'/framework/javascript/fullcalendar/fullcalendar.css');
			}

			// If using filterable plugin
			if( strpos($cp_page_xml,'<show-filterable>') > -1 ){
				wp_enqueue_style('cp-style-view', CP_PATH_URL.'/frontend/css/style_animate.css');
			}
			
			// If using Services
			if( strpos($cp_page_xml,'<service-widget-style>Circle-Icon</service-widget-style>') > -1 ){
				wp_enqueue_style('cp-circle-hover',CP_PATH_URL.'/frontend/css/circle-hover.css');
			}
			
			// If using Events
			if( strpos($cp_page_xml,'<Events>') > -1 ){
				wp_enqueue_style('cp-countdown',CP_PATH_URL.'/frontend/css/jquery.countdown.css'); //Load Style				
			}
			
			// If using NewsSlider
			if( strpos($cp_page_xml,'<News-Slider>') > -1 ){
			
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			
			}
			
			// If using Blog Slider
			if( strpos($cp_page_xml,'<Blog_Slider>') > -1 ){
			
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			
			}
			
			// If using NewsSlider
			if( strpos($cp_page_xml,'<Client-Slider>') > -1 ){
			
				wp_enqueue_style('cp-content-slider',CP_PATH_URL.'/frontend/shortcodes/css/content_slider_style.css');
			
			}
			  
			if( strpos($cp_page_xml,'<Portfolio>') > -1 || strpos($cp_page_xml,'<Gallery>') > -1){
			
				wp_enqueue_style('cp-prettyPhoto',CP_PATH_URL.'/frontend/shortcodes/css/prettyphoto.css');
			
			}
			
			if( strpos($cp_page_xml,'<Service>') > -1){
			
				wp_enqueue_style('cp-prettyPhoto',CP_PATH_URL.'/frontend/css/prettyphoto.css');
			
			}
			
			
			wp_enqueue_style('cp-paralux-manager',CP_PATH_URL.'/frontend/css/parallax.css'); //Event Manager
			
			// if using timeline
			if( strpos($cp_page_xml,'<Timeline>') > -1 ){
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			}
			
			if( strpos($cp_page_xml,'<Blog>') > -1 || strpos($cp_page_xml,'<Gallery>') > -1 || strpos($cp_page_xml,'<News>') > -1 || strpos($cp_page_xml,'<Events>') > -1){
				wp_enqueue_style('cp-prettyPhoto',CP_PATH_URL.'/frontend/css/prettyphoto.css');				
			}
			
			if( strpos($cp_page_xml,'<Woo-Products>') > -1 ){
				//WooCommerce Style
				
				wp_enqueue_style('cp-wp-commerce',CP_PATH_URL.'/frontend/css/default/wp-commerce.css'); //WooCommerce Default
				wp_enqueue_style('cp-prettyPhoto',CP_PATH_URL.'/frontend/css/prettyphoto.css');
			}
			
			if( strpos($cp_page_xml,'<Our-Team>') > -1 ){
				wp_enqueue_style('cp-prettyPhoto',CP_PATH_URL.'/frontend/css/default/prettyphoto.css');
			}
			
		}
		
		
		/** Arabic Fonts **/
		
		$arabic_fonts_switch = '';
		$arabic_font = '';
		$arabic_menu_font = '';
		$arabic_font_heading = '';
		
		/** Google Fonts **/
		
		$font_google = '';
		$font_size_normal = '';
		$menu_font_google = '';
		$fonts_array = '';
		$font_google_heading = '';
		$heading_h1 = '';
		$heading_h2 = '';
		$heading_h3 = '';
		$heading_h4 = '';
		$heading_h5 = '';
		$heading_h6 = '';
		$embed_typekit_code = '';
		$cp_typography_settings = get_option('typography_settings');
		
		
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			
			$arabic_font = cp_find_xml_value($cp_typo->documentElement,'arabic_font');
			$arabic_menu_font = cp_find_xml_value($cp_typo->documentElement,'arabic_menu_font');
			$arabic_font_heading = cp_find_xml_value($cp_typo->documentElement,'arabic_font_heading');

			$font_google = cp_find_xml_value($cp_typo->documentElement,'font_google');
			$font_size_normal = cp_find_xml_value($cp_typo->documentElement,'font_size_normal');
			$menu_font_google = cp_find_xml_value($cp_typo->documentElement,'menu_font_google');
			$font_google_heading = cp_find_xml_value($cp_typo->documentElement,'font_google_heading');
			$heading_h1 = cp_find_xml_value($cp_typo->documentElement,'heading_h1');
			$heading_h2 = cp_find_xml_value($cp_typo->documentElement,'heading_h2');
			$heading_h3 = cp_find_xml_value($cp_typo->documentElement,'heading_h3');
			$heading_h4 = cp_find_xml_value($cp_typo->documentElement,'heading_h4');
			$heading_h5 = cp_find_xml_value($cp_typo->documentElement,'heading_h5');
			$heading_h6 = cp_find_xml_value($cp_typo->documentElement,'heading_h6');
			$embed_typekit_code = cp_find_xml_value($cp_typo->documentElement,'embed_typekit_code');
			
		}
		
		
		/* Body Fonts Section 
		
		** Arabic Fonts For BODY 
		
		** Arabic Fonts For Headings
		
		** Arabic Fonts For Menu
		
		*/
		
		$arabic_fonts_array = array("Amiri", "Droid Arabic Kufi", "Droid Arabic Naskh", "Lateef" , "Scheherazade" , "Thabit");
		
		/*** Arabic BODY Font ***/
		$arabic_font = cp_find_xml_value($cp_typo->documentElement,'arabic_font');
		/*** Arabic HEADING Font ***/
		$arabic_font_heading = cp_find_xml_value($cp_typo->documentElement,'arabic_font_heading');
		/*** Arabic MENU Font ***/
		$arabic_menu_font = cp_find_xml_value($cp_typo->documentElement,'arabic_menu_font');
		/*** Arabic Font SWITCH ***/
		$arabic_fonts_switch = cp_get_themeoption_value('arabic_fonts_switch','typography_settings');
		
		if($arabic_fonts_switch == 'enable'){
		
		
		/** BODY Font Arabic Family **/
			
			if( $arabic_font == 'Amiri'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-bodyfont', "https://fonts.googleapis.com/css?family=Amiri:400,400italic,700" );
				
		
			}elseif($arabic_font == 'Droid Arabic Kufi'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-bodyfont', "http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" );
			
			}elseif($arabic_font == 'Droid Arabic Naskh'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-bodyfont', "http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css" );
			
			}elseif($arabic_font == 'Lateef'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-bodyfont', "https://fonts.googleapis.com/css?family=Lateef" );
			
			}elseif($arabic_font == 'Scheherazade'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-bodyfont', "https://fonts.googleapis.com/css?family=Scheherazade" );
			
			}elseif($arabic_font == 'Scheherazade'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-bodyfont', "http://fonts.googleapis.com/earlyaccess/thabit.css" );
			
			}else{
		
			}
			
			
		/** HEADINGS Font Arabic Family **/
			
			if( $arabic_font_heading == 'Amiri'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-headingfont', "https://fonts.googleapis.com/css?family=Amiri:400,400italic,700" );
				
		
			}elseif($arabic_font_heading == 'Droid Arabic Kufi'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-headingfont', "http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" );
			
			}elseif($arabic_font_heading == 'Droid Arabic Naskh'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-headingfont', "http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css" );
			
			}elseif($arabic_font_heading == 'Lateef'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-headingfont', "https://fonts.googleapis.com/css?family=Lateef" );
			
			}elseif($arabic_font_heading == 'Scheherazade'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-headingfont', "https://fonts.googleapis.com/css?family=Scheherazade" );
			
			}elseif($arabic_font_heading == 'Scheherazade'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-headingfont', "http://fonts.googleapis.com/earlyaccess/thabit.css" );
			
			}else{
		
			}
			
		/** MENU Font Arabic Family **/
			
			if( $arabic_menu_font == 'Amiri'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-menufont', "https://fonts.googleapis.com/css?family=Amiri:400,400italic,700" );
				
		
			}elseif($arabic_menu_font == 'Droid Arabic Kufi'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-menufont', "http://fonts.googleapis.com/earlyaccess/droidarabickufi.css" );
			
			}elseif($arabic_menu_font == 'Droid Arabic Naskh'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-menufont', "http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css" );
			
			}elseif($arabic_menu_font == 'Lateef'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-menufont', "https://fonts.googleapis.com/css?family=Lateef" );
			
			}elseif($arabic_menu_font == 'Scheherazade'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-menufont', "https://fonts.googleapis.com/css?family=Scheherazade" );
			
			}elseif($arabic_menu_font == 'Thabit'){
			
				//Arabic Font Body
				wp_enqueue_style('arabic-menufont', "http://fonts.googleapis.com/earlyaccess/thabit.css" );
			
			}else{
		
			}
		
		}
		
		//Body Font Installing
		if(cp_get_font_type($font_google) == 'Google_Font'){
			//Google Font Body
			if($font_google <> ''){
				wp_enqueue_style('googleFonts', cp_get_google_font_url($font_google));
			}	
		} else{
			//Adobe Edge Font (TypeKit) 
			if($font_google <> ''){
				wp_register_script( 'adobe-edge-font', "http://use.edgefonts.net/".$font_google.".js", false, '1.0', false);
				wp_enqueue_script('adobe-edge-font');	
			}
		}
		
		if(cp_get_font_type($font_google_heading) == 'Google_Font'){
			if($font_google_heading <> ''){				
				wp_enqueue_style('googleFonts-heading', cp_get_google_font_url($font_google_heading) );
			}
		}else{
			if($font_google_heading <> ''){
				wp_register_script( 'adobe-edge-heading', "http://use.edgefonts.net/".$font_google_heading.".js", false, '1.0', false);
				wp_enqueue_script('adobe-edge-heading');	
			}
		}

		//Menu Font Installing	
		if(cp_get_font_type($menu_font_google) == 'Google_Font'){
			if($menu_font_google <> ''){
				wp_enqueue_style('menu-googleFonts-heading', cp_get_google_font_url($menu_font_google));
			}
		}else{
			if($menu_font_google <> ''){
				wp_register_script( 'menu-edge-heading', "http://use.edgefonts.net/".$menu_font_google.".js", false, '1.0', false);
				wp_enqueue_script('menu-edge-heading');	
			}
		}
		
	}
		 
    // Register all scripts
	function register_non_admin_scripts(){
		global $post,$post_id;
		global $cp_is_responsive;
		global $crunchpress_element;		
		global $wp_scripts;
		$cp_page_xml = get_post_meta($post_id,'page-option-item-xml', true);
		$slider_type = get_post_meta ( $post_id, "page-option-top-slider-types", true );

		$social_networking = '';
		$site_loader = '';
		$element_loader = '';
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$social_networking = cp_find_xml_value($cp_logo->documentElement,'social_networking');
			$site_loader = cp_find_xml_value($cp_logo->documentElement,'site_loader');
			$element_loader = cp_find_xml_value($cp_logo->documentElement,'element_loader');
			$topweather_icon = cp_find_xml_value($cp_logo->documentElement,'topweather_icon');
			
		}
		
		wp_enqueue_script('jquery');
		
		wp_register_script('cp-modernizr', CP_PATH_URL.'/frontend/shortcodes/js/modernizr.js', false, '1.0', true);
		wp_enqueue_script('cp-modernizr');
		
		wp_register_script('cp-cp_search_classie', CP_PATH_URL.'/frontend/js/cp_search_classie.js', false, '1.0', true);
		wp_enqueue_script('cp-cp_search_classie');
		
		$cp_maintenance_mode = cp_get_themeoption_value('maintenance_mode','general_settings');	
		$cp_comming_soon = cp_get_themeoption_value('cp_comming_soon','general_settings');	
		if($cp_maintenance_mode == 'enable'){
			//Style 1
			if(($cp_comming_soon == 'Style 1') || ($cp_comming_soon == 'Style 2') ){
				//Final Count Down SCript
				wp_register_script('cp-final-countdown', CP_PATH_URL.'/frontend/js/jquery.final-countdown.js', false, '1.0', true);
				wp_enqueue_script('cp-final-countdown');			
				
				//Equal Height Script
				wp_register_script('cp-final-matchHeight', CP_PATH_URL.'/frontend/js/jquery.matchHeight.js', false, '1.0', true);
				wp_enqueue_script('cp-final-matchHeight');
				
				//Equal Height Script
				wp_register_script('cp-final-kinetic', CP_PATH_URL.'/frontend/js/kinetic.js', false, '1.0', true);
				wp_enqueue_script('cp-final-kinetic');		
			}
		}
		
		wp_register_script('cp-singlePageNav', CP_PATH_URL.'/frontend/js/jquery.singlePageNav.js', false, '1.0', true);
		wp_enqueue_script('cp-singlePageNav');
		
		$cp_maintenance_mode = cp_get_themeoption_value('maintenance_mode','general_settings');				
		if($cp_maintenance_mode == 'enable'){
			if($cp_comming_soon == 'Style 2'){			
				wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
				wp_enqueue_script('cp-countdown');
			}
		}
		
		
		
		
		$topcounter_circle = cp_get_themeoption_value('topcounter_circle','general_settings');
		$countd_event_category = cp_get_themeoption_value('countd_event_category','general_settings');
		$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
		if(class_exists('CP_Shortcodes')){
			if($topcounter_circle == 'enable'){
				wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
				wp_enqueue_script('cp-countdown');
			}
		}	

		
		if ( is_singular() && get_option( 'thread_comments' ) ) 	wp_enqueue_script( 'comment-reply' );
			
		//BootStrap Script Loaded
		wp_register_script('cp-bootstrap', CP_PATH_URL.'/frontend/js/bootstrap.js', array('jquery'), '1.0', true);
		wp_localize_script('cp-bootstrap', 'ajax_var', array('url' => admin_url('admin-ajax.php'),'nonce' => wp_create_nonce('ajax-nonce')));
		wp_enqueue_script('cp-bootstrap');
		
		//Custom Script Loaded
		wp_register_script('cp-scripts', CP_PATH_URL.'/frontend/js/frontend_scripts.js', false, '1.0', true);
		wp_enqueue_script('cp-scripts');
		
		wp_register_script('cp-easing', CP_PATH_URL.'/frontend/js/jquery-easing-1.3.js', false, '1.0', true);
		wp_enqueue_script('cp-easing');
		
		//mCustomScrollbar
		wp_register_script('cp-scroll', CP_PATH_URL.'/frontend/shortcodes/js/jquery.mCustomScrollbar.concat.min.js', false, '1.0', true);
		wp_enqueue_script('cp-scroll');
		
		
		
		$twitter_feed = cp_get_themeoption_value('twitter_feed','general_settings');
		if($twitter_feed == 'enable'){ 			
			wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
			wp_enqueue_script('cp-bx-slider');
		}

		
		if(isset($post)){
			$content = strip_tags(get_the_content($post_id));
			
			if ( has_shortcode( $post->post_content, 'event_counter_box' ) ) { 		
				wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/shortcodes/js/jquery_countdown.js', false, '1.0', true);
				wp_enqueue_script('cp-countdown');
			}
			
			if ( has_shortcode( $post->post_content, 'person' ) ) { 		
				wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/shortcodes/js/jquery.prettyphoto.js', false, '1.0', true);
				wp_enqueue_script('prettyPhoto');

				wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/shortcodes/js/pretty_script.js', false, '1.0', true);
				wp_enqueue_script('cp-pscript');
			}
			
			if ( has_shortcode( $post->post_content, 'slider' ) ) { 		
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				wp_register_script('cp-fitvids-slider', CP_PATH_URL.'/frontend/shortcodes/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-fitvids-slider');	
			}
			
			if ( has_shortcode( $post->post_content, 'counter_circle' ) ) {
				wp_register_script('cp-easy-chart', CP_PATH_URL.'/frontend/shortcodes/js/easy-pie-chart.js', false, '1.0', true);
				wp_enqueue_script('cp-easy-chart');
				wp_register_script('cp-excanvas', CP_PATH_URL.'/frontend/shortcodes/js/excanvas.js', false, '1.0', true);
				wp_enqueue_script('cp-excanvas');
			}
			
			if ( has_shortcode( $post->post_content, 'counters_circle' ) ) {
				wp_register_script('cp-easy-chart', CP_PATH_URL.'/frontend/shortcodes/js/easy-pie-chart.js', false, '1.0', true);
				wp_enqueue_script('cp-easy-chart');
				wp_register_script('cp-excanvas', CP_PATH_URL.'/frontend/shortcodes/js/excanvas.js', false, '1.0', true);
				wp_enqueue_script('cp-excanvas');
			}
		}
		
		
		
		//calling all the scripts for progress circle
		
		
		$topcounter_circle = cp_get_themeoption_value('topcounter_circle','general_settings');
		$countd_event_category = cp_get_themeoption_value('countd_event_category','general_settings');
		$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
		if(class_exists('CP_Shortcodes')){
			if($topcounter_circle == 'enable'){
				wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
				wp_enqueue_script('cp-countdown');
			}
		}	
				
		global $wp_scripts,$post;
		wp_register_script('html5shiv',CP_PATH_URL.'/frontend/js/html5shive.js',array(),'1.5.1',false);
		wp_enqueue_script('html5shiv');
		$wp_scripts->add_data( 'html5shiv', 'conditional', 'lt IE 9' );		
					
		//Widget Active
		if(is_active_widget( '', '', 'twitter_widget')){
			wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
			wp_enqueue_script('cp-bx-slider');	

			wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/shortcodes/js/jquery.fitvids.js', false, '1.0', true);
			wp_enqueue_script('cp-bx-fitdiv');			
		}
		
		// Search and archive page
		if( is_search() || is_archive() ){
		
			// wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
			// wp_enqueue_script('cp-anything-slider');	
		
		// Post post_type
		}else if(isset($post) && $post->post_type == 'timeline' ){
				wp_register_script('cp-flexisel-slider', CP_PATH_URL.'/frontend/js/jquery.flexisel.js', false, '1.0', true);
				wp_enqueue_script('cp-flexisel-slider');				
		}else if( isset($post) &&  $post->post_type == 'sermons' && !is_home()){
		
			//Jplayer Music Started	
			wp_register_script('cp-jplayer', CP_PATH_URL.'/frontend/js/jquery.jplayer.min.js', false, '1.0', true);
			wp_enqueue_script('cp-jplayer');
			
			wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
			wp_enqueue_script('prettyPhoto');

			wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
			wp_enqueue_script('cp-pscript');	

			
		
		}else if(isset($post) &&  $post->post_type == 'event' && !is_home()){
		
			//Call the Countdown
			wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/shortcodes/js/jquery_countdown.js', false, '1.0', true);
			wp_enqueue_script('cp-countdown');
		
		}else if(isset($post) &&  $post->post_type == 'service' && !is_home()){
		
			wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
			wp_enqueue_script('prettyPhoto');
		
		}else if(isset($post) &&  $post->post_type == 'post' && !is_home() ){
		
			if(!is_home()){
				$cp_post_thumbnail = '';
				$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
				if($post_detail_xml <> ''){
					$cp_post_xml = new DOMDocument ();
					$cp_post_xml->loadXML ( $post_detail_xml );
					$cp_post_thumbnail = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');						

					if( $cp_post_thumbnail == 'Slider'){

						wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
						wp_enqueue_script('cp-bx-slider');	
						
						wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/shortcodes/js/jquery.fitvids.js', false, '1.0', true);
						wp_enqueue_script('cp-bx-fitdiv');
						
					}
				}
			
				
			}
		
		// Page post_type
		}else if( isset($post) &&  $post->post_type == 'page' ){
			global $post,$cp_page_xml, $slider_type, $cp_top_slider_type;
			$cp_page_xml = get_post_meta($post->ID,'page-option-item-xml', true);
			$cp_top_slider_switch = get_post_meta($post->ID,'page-option-top-slider-on', true);
			$slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
			$cp_top_slider_type = get_post_meta($post->ID,'page-option-top-slider-types', true);
			//$paraluxx = get_post_meta($post->ID,'page-option-attachment-bg-cp', true);

			if(strpos($cp_page_xml,'<Column>') > -1){
			
				// wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/shortcodes/js/jquery_countdown.js', false, '1.0', true);
				// wp_enqueue_script('cp-countdown');
				// wp_register_script('cp-easy-chart', CP_PATH_URL.'/frontend/shortcodes/js/easy-pie-chart.js', false, '1.0', true);
				// wp_enqueue_script('cp-easy-chart');
				// wp_register_script('cp-excanvas', CP_PATH_URL.'/frontend/shortcodes/js/excanvas.js', false, '1.0', true);
				// wp_enqueue_script('cp-excanvas');
				// wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				// wp_enqueue_script('cp-bx-slider');	
				// wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/shortcodes/js/jquery.fitvids.js', false, '1.0', true);
				// wp_enqueue_script('cp-bx-fitdiv');
			}	
			
			//Team Slider and Scroller
			if(strpos($cp_page_xml,'<Team-Slider>') > -1){			
				//Team Scroll Bar Plugin
			
				wp_register_script('cp-sly', CP_PATH_URL.'/frontend/js/sly.min.js', false, '1.0', true);
				wp_enqueue_script('cp-sly');
				
				wp_register_script('cp-plugins_sly', CP_PATH_URL.'/frontend/js/plugins_sly.js', false, '1.0', true);
				wp_enqueue_script('cp-plugins_sly');
				
				wp_register_script('cp-horizontal', CP_PATH_URL.'/frontend/js/horizontal.js', false, '1.0', true);
				wp_enqueue_script('cp-horizontal');
			}		
			
			//Recipe or Services offers
			if(strpos($cp_page_xml,'<Offers>') > -1){
				wp_register_script('cp-mCustomScrollbar', CP_PATH_URL.'/frontend/js/jquery.mCustomScrollbar.concat.min.js', false, '1.0', true);
				wp_enqueue_script('cp-mCustomScrollbar');
			}
				
			// if using Accordions
			if( strpos($cp_page_xml,'<Accordion>') > -1 ){
				wp_register_script('cp-accordian-script', CP_PATH_URL.'/frontend/shortcodes/js/accordian_script.js', false, '1.0', true);
				wp_enqueue_script('cp-accordian-script');
				
			}
			// if using tabs
			if( strpos($cp_page_xml,'<Tab>') > -1 ){
			    //wp_enqueue_script('jquery-ui-accordion');
				wp_enqueue_script('jquery-ui-tabs');
				wp_register_script('cp-tabs-script', CP_PATH_URL.'/frontend/shortcodes/js/tabs_script.js', false, '1.0', true);
				wp_enqueue_script('cp-tabs-script');
				
			}
			
			// if using Testimonial
			if( strpos($cp_page_xml,'<Client-Slider>') > -1 ){
				wp_register_script('cp-content-slider', CP_PATH_URL.'/frontend/shortcodes/js/jquery_content_slider.js', false, '1.0', true);
				wp_enqueue_script('cp-content-slider');	
				
			}
			
			// if using Destination
			if( strpos($cp_page_xml,'<Destinations>') > -1 ){
				wp_register_script('cp-owl-slider', CP_PATH_URL.'/frontend/js/owl.carousel.js', false, '1.0', true);
				wp_enqueue_script('cp-owl-slider');
			}
			 
			// if using timeline
			if( strpos($cp_page_xml,'<Timeline>') > -1 ){
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				
				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');
			}
			
			if(strpos($cp_page_xml,'<Event-Slider>') > -1){
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				
				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');
			}
			
			//Testimonial
			if(strpos($cp_page_xml,'<Client-Slider>') > -1){
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				
				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');
			}
			
			//Product Slider
			if(strpos($cp_page_xml,'<Products_Slider>') > -1){
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				
				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');
			}
			
			
			//Parallax effect 
			if( strpos($cp_page_xml,'<Division_Start>') > -1){			
				wp_register_script('cp-skrollr', CP_PATH_URL.'/frontend/shortcodes/js/skrollr.min.js', false, '1.0', true);
				wp_enqueue_script('cp-skrollr');
			}
			
			//Sermons
			if( strpos($cp_page_xml,'<Sermons>') > -1 ){
				wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
				wp_enqueue_script('prettyPhoto');

				wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
				wp_enqueue_script('cp-pscript');	
				
				//Jplayer Music Started	
				wp_register_script('cp-jplayer', CP_PATH_URL.'/frontend/js/jquery.jplayer.min.js', false, '1.0', true);
				wp_enqueue_script('cp-jplayer');
				
				//Playlist Script
				wp_register_script('cp-jplayer-playlist', CP_PATH_URL.'/frontend/js/jplayer.playlist.min.js', false, '1.0', true);
				wp_enqueue_script('cp-jplayer-playlist');
				
			}
			
			if( strpos($cp_page_xml,'<Our-Team>') > -1 ){
				wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
				wp_enqueue_script('prettyPhoto');

				wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
				wp_enqueue_script('cp-pscript');	
				
			}
			
			
			//Blog Listing
			if( strpos($cp_page_xml,'<Blog>') > -1 ){
				wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
				wp_enqueue_script('prettyPhoto');

				wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
				wp_enqueue_script('cp-pscript');	
			
			}
			
			if( strpos($cp_page_xml,'<Service>') > -1 ){
				wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
				wp_enqueue_script('prettyPhoto');

				wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
				wp_enqueue_script('cp-pscript');	
			
			}
			
			if( strpos($cp_page_xml,'<Gallery>') > -1 ||
				strpos($cp_page_xml,'<Portfolio>') > -1 
				|| strpos($cp_page_xml,'<Portfolio-Gallery>') > -1
				|| strpos($cp_page_xml,'<News>') > -1
				|| strpos($cp_page_xml,'<Events>') > -1
				){
				wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/shortcodes/js/jquery.prettyphoto.js', false, '1.0', true);
				wp_enqueue_script('prettyPhoto');

				wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/shortcodes/js/pretty_script.js', false, '1.0', true);
				wp_enqueue_script('cp-pscript');	
				
			}
		
		
			// If using Flex Slider
			if( strpos($cp_page_xml,'<slider-type>Flex-Slider</slider-type>') > -1 || $slider_type == 'Flex-Slider' AND $cp_top_slider_switch == 'Yes'){				
				wp_register_script('cp-flex-slider', CP_PATH_URL.'/frontend/js/jquery.flexslider.js', false, '1.0', true);
				wp_enqueue_script('cp-flex-slider');
			}
			
			
			// Contact Form
			if( strpos($cp_page_xml,'<Contact-Form>') > -1){
				wp_register_script('contact-validation', CP_PATH_URL.'/frontend/js/jquery.validate.js', false, '1.0', true);
				wp_enqueue_script('contact-validation');
			}
			
			//Layer Slider Scripts
			if(strpos($cp_page_xml,'<slider-type>Layer-Slider</slider-type>') > -1 || $slider_type == 'Layer-Slider' AND $cp_top_slider_switch == 'Yes'){
				if(class_exists('LS_Sliders')){
				// Include in the footer?
					$footer = get_option('ls_include_at_footer', false) ? true : false;

					// Register LayerSlider resources
					wp_register_script('layerslider', LS_ROOT_URL.'/static/js/layerslider.kreaturamedia.jquery.js', array('jquery'), LS_PLUGIN_VERSION, $footer );
					wp_register_script('greensock', LS_ROOT_URL.'/static/js/greensock.js', false, '1.11.2', $footer );
					wp_register_script('layerslider-transitions', LS_ROOT_URL.'/static/js/layerslider.transitions.js', false, LS_PLUGIN_VERSION, $footer );
					wp_enqueue_style('layerslider', LS_ROOT_URL.'/static/css/layerslider.css', false, LS_PLUGIN_VERSION );

					// User resources
					$uploads = wp_upload_dir();
					if(file_exists($uploads['basedir'].'/layerslider.custom.transitions.js')) {
						wp_register_script('ls-user-transitions', $uploads['baseurl'].'/layerslider.custom.transitions.js', false, LS_PLUGIN_VERSION, $footer );
					}

					if(file_exists($uploads['basedir'].'/layerslider.custom.css')) {
						wp_enqueue_style('ls-user-css', $uploads['baseurl'].'/layerslider.custom.css', false, LS_PLUGIN_VERSION );
					}

					if(get_option('ls_conditional_script_loading', false) == false) {
						wp_enqueue_script('layerslider');
						wp_enqueue_script('greensock');
						wp_enqueue_script('layerslider-transitions');
						wp_enqueue_script('ls-user-transitions');
					}
				}
			}
			
			//Bx Slider Scripts
			if(strpos($cp_page_xml,'<slider-type>Bx-Slider</slider-type>') > -1){
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');		

				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');
			}
			
			//Bx Slider Scripts
			if($slider_type == 'Bx-Slider' AND $cp_top_slider_switch == 'Yes'){
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');		

				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');
			}
			
			// If using Events
			if( strpos($cp_page_xml,'<Events>') > -1 ){
				wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
				wp_enqueue_script('cp-countdown');
				
			}
			
			if( strpos($cp_page_xml,'<Event-Slider>') > -1 ){
				wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
				wp_enqueue_script('cp-countdown');
				
			}
			
			
			// If using Anything Slider
			if( strpos($cp_page_xml, '<slider-type>Anything</slider-type>') == 233 || $slider_type == 'Anything' AND $cp_top_slider_switch == 'Yes'){
				wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
				wp_enqueue_script('cp-anything-slider');	
				
				wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', false, '1.0', true);
				wp_enqueue_script('cp-anything-slider-fx');	
			}
			
			// If using NewsSlider
			if( strpos($cp_page_xml,'<News-Slider>') > -1 ){
			
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');		
				
				wp_register_script('cp-bx-fitdiv', CP_PATH_URL.'/frontend/js/jquery.fitvids.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-fitdiv');		
				
			
			}
			
			// If using Blog Slider
			if( strpos($cp_page_xml,'<Blog_Slider>') > -1 ){
			
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
			}
			
			
			// If using filterable plugin
			if( strpos($cp_page_xml,'<filterable>Yes</filterable>') > -1 ){
			
				wp_register_script('filterable', CP_PATH_URL.'/frontend/shortcodes/js/jquery-filterable.js', false, '1.0', true);
				wp_enqueue_script('filterable');
			
			}
			
			// If using filterable plugin
			  
			if( strpos($cp_page_xml,'<Woo-Products>') > -1 || strpos($cp_page_xml,'<Portfolio-Gallery>') > -1 ){
			
				wp_register_script('jquery-easing-1.3', CP_PATH_URL.'/frontend/js/jquery-easing-1.3.js', false, '1.0', true);
				wp_enqueue_script('jquery-easing-1.3');
				
				wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/js/jquery.prettyphoto.js', false, '1.0', true);
				wp_enqueue_script('prettyPhoto');

				wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/js/pretty_script.js', false, '1.0', true);
				wp_enqueue_script('cp-pscript');
			
			}
			
			if( strpos($cp_page_xml,'<eventview>Calendar View</eventview>') > -1 ){
			
				wp_register_script('cp-calender-view', CP_PATH_URL.'/framework/javascript/fullcalendar/fullcalendar.js', false, '1.0', true);
				wp_enqueue_script('cp-calender-view');
			
			}
			
		}
	}

?>