<?php

	/*	
	*	Crunchpress Function Registered File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file use to register the wordpress function to the framework,
	*	and also use filter to hook some necessary events.
	*	---------------------------------------------------------------------
	*/
	
	
	if (function_exists('register_sidebar')){	
	
		// default sidebar array
		$sidebar_attr = array(
			'name' => '',
			'description' => '',
			'before_widget' => '<div class="widget sidebar-recent-post sidebar_section %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		);

			
		$footer_col_layout = '';
		$footer_col_layout = cp_get_themeoption_value('footer_col_layout','general_settings');
		
		$sidebar_id = 0;
		$cp_sidebar = array();
		//Print Footer Widget Areas
		$select_footer_cp = cp_get_themeoption_value('select_footer_cp','general_settings');
		//For Islamic Version Only
		$select_footer_cp = 'Style 1';
		
		if($select_footer_cp == 'Style 1'){
			$cp_sidebar = array("Footer");
			$cp_sidebar_upper = array();
		}else if($select_footer_cp == 'Style 6'){
			$cp_sidebar = array();
			$cp_sidebar_upper = array();
		}else{
			$cp_sidebar = array("Footer");
			$cp_sidebar_upper = array();
		}
		//Home Page Layout		
		if($footer_col_layout == 'footer-style1'){
			
			foreach( $cp_sidebar as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name;
				$sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
				$sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
				$sidebar_attr['before_widget'] = '<div class="col-md-3"><div class="widget box-1 %2$s">' ;
				$sidebar_attr['before_title'] = '<h4>' ;
				$sidebar_attr['after_widget'] = '</div></div>' ;
				$sidebar_attr['after_title'] = '</h4>' ;
				$sidebar_attr['description'] = 'Please place widget here' ;				
				register_sidebar($sidebar_attr);
			}
		}else{
			
			foreach( $cp_sidebar as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name;
				$sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
				$sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
				$sidebar_attr['before_widget'] = '<div class="col-md-4"><div class="widget box-1 %2$s">' ;
				$sidebar_attr['after_widget'] = '</div></div>' ;
				$sidebar_attr['before_title'] = '<h2>';
				$sidebar_attr['after_title'] = '<span class="h-line"></span></h2>' ;
				$sidebar_attr['description'] = 'Please place widget here' ;
				register_sidebar($sidebar_attr);
			}
		}

		$footer_upper_layout = cp_get_themeoption_value('footer_upper_layout','general_settings');
		//Home Page Layout		
		if($footer_upper_layout == 'footer-style-upper-1'){
			
			foreach( $cp_sidebar_upper as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name;
				$sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
				$sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
				$sidebar_attr['before_widget'] = '<div class="col-md-3"><div class="widget %2$s">' ;
				$sidebar_attr['before_title'] = '<h2>';
				$sidebar_attr['after_widget'] = '</div></div>' ;
				$sidebar_attr['after_title'] = '<span class="h-line"></span></h2>' ;
				$sidebar_attr['description'] = 'Please place widget here' ;				
				register_sidebar($sidebar_attr);
			}
		}else{
			
			foreach( $cp_sidebar_upper as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name;
				$sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
				$sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
				$sidebar_attr['before_widget'] = '<div class="col-md-4 %2$s">' ;
				$sidebar_attr['after_widget'] = '</div>' ;
				$sidebar_attr['before_title'] = '<h2>';
				$sidebar_attr['after_title'] = '<span class="h-line"></span></h2>' ;
				$sidebar_attr['description'] = 'Please place widget here' ;
				register_sidebar($sidebar_attr);
			}
		}			
		
		
		
		$cp_sidebar = '';
		$cp_sidebar = get_option('sidebar_settings');
		
		
		if(!empty($cp_sidebar)){
			$xml = new DOMDocument();
			$xml->loadXML($cp_sidebar);
			foreach( $xml->documentElement->childNodes as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name->nodeValue;
				$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
				$sidebar_attr['before_widget'] = '<div class="widget sidebar_section sidebar-recent-post %2$s">' ;
				$sidebar_attr['after_widget'] = '</div>' ;
				$sidebar_attr['before_title'] = '<h3>' ;
				$sidebar_attr['after_title'] = '</h3>' ;
				register_sidebar($sidebar_attr);
			}
		}
		
		
		
		
	}
	
	
	//Add Theme Support
	if(function_exists('add_theme_support')){
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list',) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		
		//add_theme_support( 'post-formats', array('aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery') );
		
		// enable featured image
		add_theme_support('post-thumbnails');
		
		// enable editor style
		add_editor_style('editor-style.css');
		
		// enable navigation menu
		add_theme_support('menus');
		register_nav_menus(array('header-menu'=>'Main Menu'));
		
		//Theme check recommended
		add_theme_support( "title-tag" );
	}
	
	// add filter to hook when user press "insert into post" to include the attachment id
	add_filter('media_send_to_editor', 'add_para_media_to_editor', 20, 2);
	function add_para_media_to_editor($html, $id){

		if(strpos($html, 'href')){
			$pos = strpos($html, '<a') + 2;
			$html = substr($html, 0, $pos) . ' attid="' . $id . '" ' . substr($html, $pos);
		}
		
		return $html ;
		
	}
	
	// enable theme to support the localization
	add_action('init', 'cp_word_translation');
	function cp_word_translation(){
		load_theme_textdomain( 'mosque_crunchpress', get_template_directory() . '/languages/' );		
	}

	// excerpt filter
	add_filter('excerpt_length','cp_excerpt_length');
	function cp_excerpt_length(){
		return 1000;
	}
	


	
	add_action('wp_footer', 'add_header_code');
	// Header Style or Script
	function add_header_code(){
		$header_css_code = '';
		//Get Options
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$header_css_code = cp_find_xml_value($cp_logo->documentElement,'header_css_code');
		}
		echo esc_attr($header_css_code);
	}
	
	add_action('wp_footer', 'cp_add_typekit_code');
	// Google Analytics
	function cp_add_typekit_code(){
		$embed_typekit_code = '';
		$cp_typography_settings = get_option('typography_settings');
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$embed_typekit_code = cp_find_xml_value($cp_typo->documentElement,'embed_typekit_code');
		}
		echo esc_attr($embed_typekit_code);
	
	}
	
	// Custom Post type Feed
	add_filter('request', 'cp_myfeed_request');
	function cp_myfeed_request($qv) {
		if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'portfolio');
		return $qv;
	}

	// Translate the wpml shortcode
	function cp_webtreats_lang_test( $atts, $content = null ) {
		extract(shortcode_atts(array( 'lang' => '' ), $atts));
		
		$lang_active = ICL_LANGUAGE_CODE;
		
		if($lang == $lang_active){
			return $content;
		}
	}
	
	
	
	// Add Another theme support
	add_filter('widget_text', 'do_shortcode');
	add_theme_support( 'automatic-feed-links' );	
	
	if ( ! isset( $content_width ) ){ $content_width = 980; }
	
	// update the option if new value is exists and not equal to old one 
	function save_option($name, $old_value, $new_value){
	
		if(empty($new_value) && !empty($old_value)){
		
			if(!delete_option($name)){
			
				return false;
				
			}
			
		}else if($old_value != $new_value){
		
			if(!update_option($name, $new_value)){
			
				return false;
				
			}
			
		}
		
		return true;
		
	}
	
	
	
	
	
	/* Flush rewrite rules for custom post types. */
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){
			//$wp_rewrite->flush_rules();
			
			if(get_option('default_pages_settings') == ''){$default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Islamic Teachings Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";save_option('default_pages_settings', get_option('default_pages_settings'),$default_pages_xml);}if(get_option('general_settings') == ''){$general_settings = "<general_settings><header_logo_btn>enable</header_logo_btn><header_logo_bg>791</header_logo_bg><logo_text_cp>Mosque</logo_text_cp><logo_bold_text_cp></logo_bold_text_cp><logo_subtext>Mosque Islamic Center WordPress Theme</logo_subtext><header_logo>736</header_logo><logo_width>145</logo_width><logo_height>82</logo_height><header_favicon>728</header_favicon><header_fav_link>http://crunchpress.com/dummy/mosque/wp-content/uploads/2015/07/favicon.png</header_fav_link><slide_bg_islamic></slide_bg_islamic><salat_time>disable</salat_time><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#442525</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#f9f0e7</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code></contact_us_code><contact_us_code2></contact_us_code2><contact_us_code3></contact_us_code3><select_header_cp>Style 1</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon></topsocial_icon><topsign_icon></topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp></select_footer_cp><footer_style_apply></footer_style_apply><footer_upper_layout></footer_upper_layout><copyright_code>Islamic Mosque © 2015 All Rights Reserved, Designed &amp; Developed  by CrunchPress.com</copyright_code><social_networking>disable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo></footer_logo><footer_link></footer_link><footer_logo_width></footer_logo_width><footer_logo_height></footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>11/27/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>The Islamic is a high quality web-masterpiece. The main destination of this theme is to Religious and Islamic Themes  It also fits in many other branches.</mainte_description><cp_comming_soon>Style 1</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text>Donate</donate_btn_text><donation_page_id>179</donation_page_id><donate_email_id>example@example.com</donate_email_id><donate_title>Donate</donate_title><donation_currency>USD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";save_option('general_settings', get_option('general_settings'),$general_settings);}if(get_option('typography_settings') == ''){$typography_settings = "<typography_settings><font_google>Lato</font_google><arabic_font>Droid Arabic Kufi</arabic_font><arabic_font_heading>Lateef</arabic_font_heading><arabic_fonts_switch>disable</arabic_fonts_switch><arabic_menu_font>Thabit</arabic_menu_font><font_size_normal>14</font_size_normal><font_google_heading>Berkshire Swash</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>40</heading_h1><heading_h2>36</heading_h2><heading_h3>36</heading_h3><heading_h4></heading_h4><heading_h5>36</heading_h5><heading_h6>36</heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";save_option('typography_settings', get_option('typography_settings'),$typography_settings);}if(get_option('slider_settings') == ''){$slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow><video_slider_on_off>disable</video_slider_on_off><video_banner_url></video_banner_url><video_banner_caption></video_banner_caption><video_banner_title></video_banner_title><video_banner_btn_text></video_banner_btn_text><video_banner_btn_link></video_banner_btn_link><safari_banner></safari_banner><safari_banner_link></safari_banner_link><safari_banner_width></safari_banner_width><safari_banner_height></safari_banner_height></bx_slider_settings></slider_settings>";save_option('slider_settings', get_option('slider_settings'),$slider_settings);}if(get_option('social_settings') == ''){$social_settings = "<social_settings><facebook_network>http://www.facebook.com</facebook_network><twitter_network>http://www.twitter.com</twitter_network><delicious_network></delicious_network><google_plus_network>http://www.plus.google.com/</google_plus_network><linked_in_network>http://www.linkedin.com</linked_in_network><youtube_network>http://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network>http://www.vimeo.com</vimeo_network><pinterest_network></pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network></skype_network><facebook_sharing>enable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>disable</stumble_sharing><delicious_sharing>disable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>disable</digg_sharing><myspace_sharing>disable</myspace_sharing><reddit_sharing>disable</reddit_sharing></social_settings>";save_option('social_settings', get_option('social_settings'),$social_settings);}if(get_option('sidebar_settings') == ''){$sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Products Sidebar</sidebar_name><sidebar_name>Shortcode Sidebar</sidebar_name><sidebar_name>Islamic Teachings Sidebar</sidebar_name><sidebar_name>Features Sidebar</sidebar_name><sidebar_name>Ignitiondeck Sidebar</sidebar_name></sidebar_settings>";save_option('sidebar_settings', get_option('sidebar_settings'),$sidebar_settings);}
			
		}

		//Custom background Support	
		$args = array(
			'default-color'          => '',
			'default-image'          => '',
			'wp-head-callback'       => '_custom_background_cb',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		);

		//Custom Header Support	
		$defaults = array(
			'default-image'          => '',
			'random-default'         => false,
			'width'                  => 950,
			'height'                 => 200,
			'flex-height'            => false,
			'flex-width'             => false,
			'default-text-color'     => '',
			'header-text'            => true,
			'uploads'                => true,
			'wp-head-callback'       => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => '',
		);
		global $wp_version;
		if ( version_compare( $wp_version, '3.4', '>=' ) ){ 
			add_theme_support( 'custom-background', $args );
			add_theme_support( 'custom-header', $defaults );
		}
	
	
	
	
	function cp_maintenance_mode(){
	
	
		
	}		
	
	function ajax_login(){

		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-login-nonce', 'security' );

		// Nonce is checked, get the POST data and sign user on
		$info = array();
		$info['user_login'] = $_POST['username'];
		$info['user_password'] = $_POST['password'];
		$info['remember'] = true;

		$user_signon = wp_signon( $info, false );
		if ( is_wp_error($user_signon) ){
			echo json_encode(array('loggedin'=>false, 'message'=> esc_html__('Wrong username or password.', 'mosque_crunchpress')));
		} else {
			echo json_encode(array('loggedin'=>true, 'message'=> esc_html__('Login successful, Now Redirecting...','mosque_crunchpress')));
		}

		die();
	}	
	
	function ajax_login_init(){

		wp_register_script('ajax-login-script', CP_PATH_URL.'/frontend/js/ajax-login-script.js', array('jquery') ); 
		wp_enqueue_script('ajax-login-script');

		wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'redirecturl' => esc_url(home_url('/')),
			'loadingmessage' => esc_html__('Sending user info, please wait...','mosque_crunchpress')
		));

		// Enable the user with no privileges to run ajax_login() in AJAX
		add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
	}	
	
	// Execute the action only if the user isn't logged in
	if (!is_user_logged_in()) {
		add_action('init', 'ajax_login_init');		
	}
	
	
	
	
	
	function ajax_signup(){
		
		// First check the nonce, if it fails the function will break
		
		// Nonce is checked, get the POST data and sign user on
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = $values;
		}
		$default_role = get_option('default_role');
		//$info = array();
		$nickname = $_POST['nickname'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$user_email = $_POST['user_email'];
		$user_pass = $_POST['user_pass'];
		$captcha_code = $_POST['captcha_code'];
		$ajax_captcha = $_POST['ajax_captcha'];
		

		$userdata = array(
			'user_login'    => $nickname,
			'first_name'  => $first_name,
			'last_name'  => $last_name,
			'user_email'  => $user_email,
			'user_pass'  => $user_pass,
			'role' => $default_role
		);
		$user_signup = wp_insert_user( $userdata );
		$exists = email_exists($user_email);
		if ( !$exists ){
			if(strtolower($captcha_code) == strtolower($ajax_captcha)){
				if ( is_wp_error($user_signup) ){
					echo json_encode(array('signup'=>false, 'message'=>esc_html__('Please verify the details you are providing.','mosque_crunchpress')));
				} else {
					echo json_encode(array('signup'=>true, 'message'=>esc_html__('Your request submitted successfully, Redirecting you to login page!','mosque_crunchpress')));
				}
			}else{
				echo json_encode(array('signup'=>false, 'message'=>esc_html__('Notice: Invalid Captcha','mosque_crunchpress')));
			}
		}else{
			echo json_encode(array('signup'=>false, 'message'=>esc_html__('Notice: Email already exists!','mosque_crunchpress')));
		}

		die();
	}	
	
	function ajax_signup_init(){

		wp_register_script('ajax-signup-script', CP_PATH_URL.'/frontend/js/ajax-signup-script.js', array('jquery') ); 
		wp_enqueue_script('ajax-signup-script');

		wp_localize_script( 'ajax-signup-script', 'ajax_signup_object', array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'redirecturl' => esc_url(home_url('/')),
			'loadingmessage' => esc_html__('Sending user info, please wait...','mosque_crunchpress')
		));
		
		// Enable the user with no privileges to run ajax_login() in AJAX
		add_action('wp_ajax_ajaxsignup', 'ajax_signup');
		add_action( 'wp_ajax_nopriv_ajaxsignup', 'ajax_signup' );
	}
	
	add_action('init', 'ajax_signup_init');	


	function CP_SIGN_UP(){ ?>
		<div id="signup" class="modal fade signup" tabindex="-1" role="dialog" aria-labelledby="signup" aria-hidden="true">		
			<div class="modal-dialog modal-sm">
				<?php
				$users_can_register = get_option('users_can_register');
				if($users_can_register <> 1){ ?>
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#120;</button>
							<h3><?php esc_html_e('Sign up not allowed by admin.','mosque_crunchpress');?></h3>
						</div>
						<div class="modal-body">
							<p><?php esc_html_e('Please contact admin for registration.','mosque_crunchpress');?></p>
						</div>
						<div class="modal-footer">
							
						</div>
					</div>	
				<?php }else{ 
				//Start Session for Captcha
				$session_variable = '';
				$_SESSION = array();
				include_once(CP_FW. '/extensions/captcha/default/cp_default_captcha.php'); // Custom Facebook Widget 
				$_SESSION['captcha'] = simple_php_captcha();
				if(isset($_SESSION['captcha'])){
					$session_variable = $_SESSION['captcha']['image_src'];
				}
				?>
				<form id="sing-up" action="signup" method="post">					
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#120;</button>
							<h3><?php esc_html_e('SIGN UP','mosque_crunchpress');?></h3>
						</div>
						<div class="modal-body">
							
							<label><?php esc_html_e('First Name','mosque_crunchpress');?></label>
							<input name="first_name" id="first_name" type="text" class="input-block-level" />	
							
							<label><?php esc_html_e('Last Name','mosque_crunchpress');?></label>
							<input name="last_name" id="last_name" type="text" class="input-block-level" />	
							
							<label><?php esc_html_e('Email Address','mosque_crunchpress');?></label>
							<input name="user_email" id="user_email" type="text" class="input-block-level" />	
							
							<label><?php esc_html_e('Username','mosque_crunchpress');?></label>
							<input name="nickname" id="nickname" type="text" class="input-block-level" />	
							
							<label><?php esc_html_e('Password','mosque_crunchpress');?></label>
							<input name="user_pass" id="user_pass" type="password" class="input-block-level" />	
							
							<?php wp_nonce_field( 'ajax-signup-nonce', 'security_signup_password' ); ?>
							<div class="clear clearfix"></div>
							<img src="<?php echo esc_attr($session_variable);?>" alt="CAPTCHA CODE" />
							<label><?php esc_html_e('Enter Captcha Code','mosque_crunchpress');?></label>
							<input name="captcha_code" id="captcha_code" type="text" class="input-block-level" />
							
							<?php wp_nonce_field( 'ajax-signup-nonce', 'security_signup' ); ?>
							<input class="btn-style" type="submit" value="<?php esc_html_e('Sign Up','mosque_crunchpress');?>" name="submit">
							<input type="hidden" id="ajax_captcha" name="ajax_captcha" value="<?php echo esc_attr($_SESSION['captcha']['code']);?>"/>
							
						</div>
						<div class="modal-footer">
							<p class="status"></p>
						</div>
					</div>
				</form>	
				<?php }?>
			</div>
		</div>	
	<?php
	}
	
	function CP_SIGN_IN(){ ?>
		<!--LOGIN BOX START-->
		<div id="signin" class="modal signin fade" tabindex="-1" role="dialog" aria-labelledby="signin" aria-hidden="true">
			<div class="modal-dialog modal-sm">
				<?php if (is_user_logged_in()) { ?>
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#120;</button>
							<h3><?php esc_html_e('You are logged in','mosque_crunchpress');?></h3>
						</div>
						<div class="modal-body">
							<p><?php esc_html_e('For logout click on following logout link.','mosque_crunchpress');?></p>
						</div>
						<div class="modal-footer">
							<a class="btn-style login_button" href="<?php echo wp_logout_url( home_url('/') ); ?>"><?php esc_html_e('Logout','mosque_crunchpress');?></a>
						</div>
					</div>	
				<?php } else { ?>
				<form id="login" action="login" method="post">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&#120;</button>
							<h3><?php esc_html_e('SIGN IN','mosque_crunchpress');?></h3>
						</div>
						<div class="modal-body">
							<label for="username"><?php esc_html_e('User Name','mosque_crunchpress');?></label>
							<input name="username" id="username" type="text" class="input-block-level">
							
							<label for="password"><?php esc_html_e('Password','mosque_crunchpress');?></label>
							<input name="password" id="password" type="password" class="input-block-level">
							
							<a class="lost" href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?','mosque_crunchpress');?></a>
						</div>
						<div class="modal-footer">
							<p class="status"></p>
							<input class="btn-style" type="submit" value="<?php esc_html_e('Sign In','mosque_crunchpress');?>" name="submit">
						</div>
						<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
					</div>	
				</form> 
				<?php }?>
			</div>
		</div>
		<!--LOGIN BOX END-->
   <?php }	