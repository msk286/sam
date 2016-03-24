<?php

	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
	
	// add action to embeded the panel in to dashboard
	add_action('admin_menu','add_crunchpress_panel');
	function add_crunchpress_panel(){
	
		add_menu_page( 'CrunchPress Option', THEME_NAME_F, 'administrator', 'general_options', 'general_options', '' );
			add_theme_page(  'Typography Settings', 'Typography Settings', 'administrator','typography_settings', 'typography_settings' );
			add_theme_page( 'Slider Settings', 'Slider Settings', 'administrator','slider_settings', 'slider_settings' );
			add_theme_page(  'Social Network', 'Social Network', 'administrator','social_settings', 'social_settings' );
			add_theme_page(  'Sidebar Settings', 'Sidebar Settings', 'administrator','sidebar_settings', 'sidebar_settings' );
			add_theme_page(  'Default Pages Settings', 'Default Pages Settings', 'administrator','default_pages_settings', 'default_pages_settings' );
			add_theme_page(  'Newsletter Settings', 'Newsletter Settings', 'administrator','newsletter_settings', 'newsletter_settings' );
			add_theme_page(  'Import Dummy Data', 'Import Dummy Data', 'administrator','dummydata_import', 'dummydata_import' );
	}
	
		
add_action('wp_ajax_general_options','general_options');
function general_options(){
		
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}

	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
<div class="cp-wrapper bootstrap_admin cp-margin-left"> 

    <!--content area start -->	  
	<div class="hbg top_navigation row-fluid">
		<div class="cp-logo span2">
			<img src="<?php echo CP_PATH_URL;?>/framework/images/logo.png" class="logo" alt="logo" />
		</div>
		<div class="sidebar span10">
			<?php echo cp_top_navigation_html_tooltip();?>
		</div>
	
	</div>
	<div class="content-area-main row-fluid"> 
	 
      <!--sidebar start -->
      <div class="sidebar-wraper span2">
        <div class="sidebar-sublinks">
          <ul id="wp_t_o_right_menu">
            <li id="active_tab" class="logo" >
              <?php esc_html_e('Logo Settings', 'mosque_crunchpress'); ?>
            </li>
            <li class="color_style">
              <?php esc_html_e('Style & Color Scheme', 'mosque_crunchpress'); ?>
              </li>
            <li class="hr_settings">
              <?php esc_html_e('Header Settings', 'mosque_crunchpress'); ?>
              </li>
            <li class="ft_settings">
              <?php esc_html_e('Footer Settings', 'mosque_crunchpress'); ?>
              </li>
            <li class="misc_settings">
              <?php esc_html_e('MISC Settings', 'mosque_crunchpress'); ?>
              </li>
			  <li class="maintenance_mode_settings">
              <?php esc_html_e('Maintenance Mode Settings', 'mosque_crunchpress'); ?>
              </li>
			   <li class="donation_settings">
              <?php esc_html_e('Donation Settings', 'mosque_crunchpress'); ?>
              </li>
			  
            <?php if(!class_exists( 'Envato_WordPress_Theme_Upgrader' )){}else{?>
            <li class="envato_api">
              <?php esc_html_e('User API Settings', 'mosque_crunchpress'); ?>
              </li>
            <?php }?>
          </ul>
        </div>
      </div>
      <!--sidebar end --> 
      <!--content start -->
      <div class="content-area span10">
	  <?php //echo cp_top_navigation_html(); ?>
        <form id="options-panel-form" name="cp-panel-form">
          <div class="panel-elements" id="panel-elements">
            <div class="panel-element" id="panel-element-save-complete">
              <div class="panel-element-save-text">
                <?php esc_html_e('Save Options Complete', 'mosque_crunchpress'); ?>
                .</div>
              <div class="panel-element-save-arrow"></div>
            </div>
            <div class="panel-element">
              <?php 
							if(isset($action) AND $action == 'general_options'){
								$general_logo_xml = '<general_settings>';
								$general_logo_xml = $general_logo_xml . create_xml_tag('header_logo_btn',htmlspecialchars(stripslashes($header_logo_btn)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('header_logo_bg',htmlspecialchars(stripslashes($header_logo_bg)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('logo_text_cp',htmlspecialchars(stripslashes($logo_text_cp)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('logo_bold_text_cp',htmlspecialchars(stripslashes($logo_bold_text_cp)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('logo_subtext',htmlspecialchars(stripslashes($logo_subtext)));								 
								$general_logo_xml = $general_logo_xml . create_xml_tag('header_logo',htmlspecialchars(stripslashes($header_logo)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('logo_width',$logo_width);
								$general_logo_xml = $general_logo_xml . create_xml_tag('logo_height',$logo_height);
								$general_logo_xml = $general_logo_xml . create_xml_tag('header_favicon',htmlspecialchars(stripslashes($header_favicon)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('header_fav_link',htmlspecialchars(stripslashes($header_fav_link)));
								
								$general_logo_xml = $general_logo_xml . create_xml_tag('slide_bg_islamic',htmlspecialchars(stripslashes($slide_bg_islamic)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('salat_time',htmlspecialchars(stripslashes($salat_time)));
								
								$general_logo_xml = $general_logo_xml . create_xml_tag('select_layout_cp',$select_layout_cp);
								$general_logo_xml = $general_logo_xml . create_xml_tag('boxed_scheme',$boxed_scheme);
								$general_logo_xml = $general_logo_xml . create_xml_tag('color_scheme',$color_scheme);
								$general_logo_xml = $general_logo_xml . create_xml_tag('body_color',$body_color);
								$general_logo_xml = $general_logo_xml . create_xml_tag('heading_color',$heading_color);								
								$general_logo_xml = $general_logo_xml . create_xml_tag('select_bg_pat',$select_background_patren);
								$general_logo_xml = $general_logo_xml . create_xml_tag('bg_scheme',$bg_scheme);
								$general_logo_xml = $general_logo_xml . create_xml_tag('body_patren',$body_patren);
								$general_logo_xml = $general_logo_xml . create_xml_tag('color_patren',$color_patren);
								$general_logo_xml = $general_logo_xml . create_xml_tag('body_image',$body_image);
								$general_logo_xml = $general_logo_xml . create_xml_tag('position_image_layout',$position_image_layout);
								$general_logo_xml = $general_logo_xml . create_xml_tag('image_repeat_layout',$image_repeat_layout);
								$general_logo_xml = $general_logo_xml . create_xml_tag('image_attachment_layout',$image_attachment_layout);
								$general_logo_xml = $general_logo_xml . create_xml_tag('contact_us_code',htmlspecialchars(stripslashes($contact_us_code)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('contact_us_code2',htmlspecialchars(stripslashes($contact_us_code2)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('contact_us_code3',htmlspecialchars(stripslashes($contact_us_code3)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('select_header_cp',$select_header_cp);
								$general_logo_xml = $general_logo_xml . create_xml_tag('header_style_apply',$header_style_apply);
								$general_logo_xml = $general_logo_xml . create_xml_tag('header_css_code',htmlspecialchars(stripslashes($header_css_code)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('google_webmaster_code',htmlspecialchars(stripslashes($google_webmaster_code)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('topbutton_icon',$topbutton_icon);
								$general_logo_xml = $general_logo_xml . create_xml_tag('topsocial_icon',$topsocial_icon);
								$general_logo_xml = $general_logo_xml . create_xml_tag('topsign_icon',$topsign_icon);
								$general_logo_xml = $general_logo_xml . create_xml_tag('resv_button',$resv_button);
								$general_logo_xml = $general_logo_xml . create_xml_tag('resv_text',htmlspecialchars(stripslashes($resv_text)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('resv_short',htmlspecialchars(stripslashes($resv_short)));
								


								$general_logo_xml = $general_logo_xml . create_xml_tag('select_footer_cp',$select_footer_cp);
								$general_logo_xml = $general_logo_xml . create_xml_tag('footer_style_apply',$footer_style_apply);
								$general_logo_xml = $general_logo_xml . create_xml_tag('footer_upper_layout',$footer_upper_layout);
								$general_logo_xml = $general_logo_xml . create_xml_tag('copyright_code',htmlspecialchars(stripslashes($copyright_code)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('social_networking',$social_networking);
								
								$general_logo_xml = $general_logo_xml . create_xml_tag('twitter_feed',$twitter_feed);								
								$general_logo_xml = $general_logo_xml . create_xml_tag('twitter_home_button',$twitter_home_button);
								$general_logo_xml = $general_logo_xml . create_xml_tag('twitter_id',$twitter_id);
								$general_logo_xml = $general_logo_xml . create_xml_tag('consumer_key',$consumer_key);
								$general_logo_xml = $general_logo_xml . create_xml_tag('consumer_secret',$consumer_secret);
								$general_logo_xml = $general_logo_xml . create_xml_tag('access_token',$access_token);
								$general_logo_xml = $general_logo_xml . create_xml_tag('access_secret_token',$access_secret_token);
								
								$general_logo_xml = $general_logo_xml . create_xml_tag('footer_col_layout',$footer_col_layout);	
								$general_logo_xml = $general_logo_xml . create_xml_tag('footer_logo',$footer_logo);	
								$general_logo_xml = $general_logo_xml . create_xml_tag('footer_link',$footer_link);	
								$general_logo_xml = $general_logo_xml . create_xml_tag('footer_logo_width',$footer_logo_width);	
								$general_logo_xml = $general_logo_xml . create_xml_tag('footer_logo_height',$footer_logo_height);	

								$general_logo_xml = $general_logo_xml . create_xml_tag('breadcrumbs',$breadcrumbs);	
								$general_logo_xml = $general_logo_xml . create_xml_tag('rtl_layout',$rtl_layout);
								$general_logo_xml = $general_logo_xml . create_xml_tag('site_loader',$site_loader);
								$general_logo_xml = $general_logo_xml . create_xml_tag('element_loader',$element_loader);
								
								$general_logo_xml = $general_logo_xml . create_xml_tag('maintenance_mode',$maintenance_mode);
								$general_logo_xml = $general_logo_xml . create_xml_tag('maintenace_title',htmlspecialchars(stripslashes($maintenace_title)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('countdown_time',$countdown_time);
								$general_logo_xml = $general_logo_xml . create_xml_tag('email_mainte',$email_mainte);
								$general_logo_xml = $general_logo_xml . create_xml_tag('mainte_description',htmlspecialchars(stripslashes($mainte_description)));
								$general_logo_xml = $general_logo_xml . create_xml_tag('cp_comming_soon',htmlspecialchars(stripslashes($cp_comming_soon)));
								
								
								$general_logo_xml = $general_logo_xml . create_xml_tag('social_icons_mainte',$social_icons_mainte);
								$general_logo_xml = $general_logo_xml . create_xml_tag('donation_button',$donation_button);
								$general_logo_xml = $general_logo_xml . create_xml_tag('donate_btn_text',$donate_btn_text);
								$general_logo_xml = $general_logo_xml . create_xml_tag('donation_page_id',$donation_page_id);
								$general_logo_xml = $general_logo_xml . create_xml_tag('donate_email_id',$donate_email_id);
								$general_logo_xml = $general_logo_xml . create_xml_tag('donate_title',$donate_title);
								$general_logo_xml = $general_logo_xml . create_xml_tag('donation_currency',$donation_currency);
								
								
								$general_logo_xml = $general_logo_xml . create_xml_tag('tf_username',$tf_username);	
								$general_logo_xml = $general_logo_xml . create_xml_tag('tf_sec_api',$tf_sec_api);	
								$general_logo_xml = $general_logo_xml . '</general_settings>';

								if(!save_option('general_settings', get_option('general_settings'), $general_logo_xml)){
								
									die( json_encode($return_data) );
									
								}
								
								die( json_encode( array('success'=>'0') ) );
								
							}?>
            </div>
            <?php
				$header_logo_btn = '';
				$logo_text_cp = '';
				$logo_bold_text_cp = '';
				$logo_subtext = '';
				$header_logo_upload = '';
				$logo_width = '';
				$logo_height = '';
				$header_favicon = '';
				$header_fav_link = '';
				$select_layout_cp = '';
				$boxed_scheme = '';
				$select_bg_pat = '';
				$scheme_color_scheme = '';
				$slide_bg_islamic = '';
				$color_scheme = '';
				//$boxed_scheme = '';
				$salat_time = '';
				
				$select_bg_pat = '';
				$scheme_color_scheme = '';
				$color_scheme = '';
				$header_logo = '';
				$header_logo_bg = '';
				$footer_style_apply = '';
				$select_footer_cp = '';
				$body_color = '';
				$heading_color = '';
				//$color_scheme_1 = '';
				$border_color = '';
				$button_color = '';
				$button_hover_color = '';
				$color_patren = '';
				$bg_scheme = '';
				$body_patren = '';
				$body_image = '';
				$position_image_layout = '';
				$image_repeat_layout = '';
				$image_attachment_layout = '';
				$contact_us_code = '';
				$contact_us_code2 = '';
				$contact_us_code3 = '';
				$resv_button = '';
				$resv_text = '';
				$resv_short = '';
				$header_css_code = '';
				$google_webmaster_code = '';
				$topbutton_icon = '';
				$footer_upper_layout = '';
				$select_header_cp = '';
				$header_style_apply = '';
				$about_header = '';
				$topcart_icon = '';
				$topcounter_circle = '';
				$countd_event_category = '';
				$topsocial_icon = '';
				$topsign_icon = '';
				$topsearch_icon = '';
				$copyright_code = '';
				$footer_banner = '';
				$footer_col_layout = '';
				$social_networking = '';
				$twitter_feed = '';
				$twitter_home_button = '';
				$twitter_id = '';
				$consumer_key = '';
				$consumer_secret = '';
				$access_token = '';
				$access_secret_token = '';
				$top_count_header = '';
				
				$footer_link = '';
				$footer_logo = '';
				$footer_logo_width = '';
				$footer_logo_height = '';
				$footer_layout = '';
				$breadcrumbs = '';			
				$rtl_layout = '';
				$site_loader = '';
				$element_loader = '';
				
				$maintenance_mode = '';
				$maintenace_title = '';
				$countdown_time = '';
				$email_mainte = '';
				$mainte_description = '';
				$social_icons_mainte = '';
				$cp_comming_soon = '';

				$donation_button = '';
				$donate_btn_text = '';
				$donation_page_id = '';
				$donate_email_id = '';
				$donate_title = '';
				$donation_currency = '';
				
				$tf_username = '';
				$tf_sec_api = '';
				$cp_general_settings = get_option('general_settings');
				if($cp_general_settings <> ''){
					$cp_logo = new DOMDocument ();
					$cp_logo->loadXML ( $cp_general_settings );
					$header_logo_btn = cp_find_xml_value($cp_logo->documentElement,'header_logo_btn');
					$header_logo_bg = cp_find_xml_value($cp_logo->documentElement,'header_logo_bg');
					$logo_text_cp = cp_find_xml_value($cp_logo->documentElement,'logo_text_cp');
					$logo_bold_text_cp = cp_find_xml_value($cp_logo->documentElement,'logo_bold_text_cp');
					$logo_subtext = cp_find_xml_value($cp_logo->documentElement,'logo_subtext');
					$header_logo = cp_find_xml_value($cp_logo->documentElement,'header_logo');
					$logo_width = cp_find_xml_value($cp_logo->documentElement,'logo_width');
					$logo_height = cp_find_xml_value($cp_logo->documentElement,'logo_height');
					$header_favicon = cp_find_xml_value($cp_logo->documentElement,'header_favicon');
					$header_fav_link = cp_find_xml_value($cp_logo->documentElement,'header_fav_link');
					$salat_time = cp_find_xml_value($cp_logo->documentElement,'salat_time');							
					
					
					$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
					$boxed_scheme = cp_find_xml_value($cp_logo->documentElement,'boxed_scheme');
					$color_scheme = cp_find_xml_value($cp_logo->documentElement,'color_scheme');	
					$slide_bg_islamic = cp_find_xml_value($cp_logo->documentElement,'slide_bg_islamic');					
					$select_bg_pat = cp_find_xml_value($cp_logo->documentElement,'select_bg_pat');
					$bg_scheme = cp_find_xml_value($cp_logo->documentElement,'bg_scheme');					
					$body_color = cp_find_xml_value($cp_logo->documentElement,'body_color');
					$heading_color = cp_find_xml_value($cp_logo->documentElement,'heading_color');
					
					
					$body_patren = cp_find_xml_value($cp_logo->documentElement,'body_patren');
					$color_patren = cp_find_xml_value($cp_logo->documentElement,'color_patren');
					$body_image = cp_find_xml_value($cp_logo->documentElement,'body_image');
					$position_image_layout = cp_find_xml_value($cp_logo->documentElement,'position_image_layout');
					$image_repeat_layout = cp_find_xml_value($cp_logo->documentElement,'image_repeat_layout');
					$image_attachment_layout = cp_find_xml_value($cp_logo->documentElement,'image_attachment_layout');
					$select_header_cp = cp_find_xml_value($cp_logo->documentElement,'select_header_cp');
					$header_style_apply = cp_find_xml_value($cp_logo->documentElement,'header_style_apply');
					// Contact Us Section In Header For GoodWill
					$contact_us_code = cp_find_xml_value($cp_logo->documentElement,'contact_us_code');
					$contact_us_code2 = cp_find_xml_value($cp_logo->documentElement,'contact_us_code2');
					$contact_us_code3 = cp_find_xml_value($cp_logo->documentElement,'contact_us_code3');
					
					$header_css_code = cp_find_xml_value($cp_logo->documentElement,'header_css_code');
					$google_webmaster_code = cp_find_xml_value($cp_logo->documentElement,'google_webmaster_code');
					$topbutton_icon = cp_find_xml_value($cp_logo->documentElement,'topbutton_icon');
					$topcart_icon = cp_find_xml_value($cp_logo->documentElement,'topcart_icon');
					$topsocial_icon = cp_find_xml_value($cp_logo->documentElement,'topsocial_icon');
					$topsign_icon = cp_find_xml_value($cp_logo->documentElement,'topsign_icon');
					
					$resv_button = cp_find_xml_value($cp_logo->documentElement,'resv_button');
					$resv_text = cp_find_xml_value($cp_logo->documentElement,'resv_text');
					$resv_short = cp_find_xml_value($cp_logo->documentElement,'resv_short');
					
					$select_footer_cp = cp_find_xml_value($cp_logo->documentElement,'select_footer_cp');
					$footer_style_apply = cp_find_xml_value($cp_logo->documentElement,'footer_style_apply');
					$footer_upper_layout = cp_find_xml_value($cp_logo->documentElement,'footer_upper_layout');
					$copyright_code = cp_find_xml_value($cp_logo->documentElement,'copyright_code');
					$footer_banner = cp_find_xml_value($cp_logo->documentElement,'footer_banner');
					$footer_col_layout = cp_find_xml_value($cp_logo->documentElement,'footer_col_layout');
					$footer_logo = cp_find_xml_value($cp_logo->documentElement,'footer_logo');
					$footer_link = cp_find_xml_value($cp_logo->documentElement,'footer_link');
					$footer_logo_width = cp_find_xml_value($cp_logo->documentElement,'footer_logo_width');
					$footer_logo_height = cp_find_xml_value($cp_logo->documentElement,'footer_logo_height');
					$social_networking = cp_find_xml_value($cp_logo->documentElement,'social_networking');
					$twitter_feed = cp_find_xml_value($cp_logo->documentElement,'twitter_feed');
					$twitter_home_button = cp_find_xml_value($cp_logo->documentElement,'twitter_home_button');
					$twitter_id = cp_find_xml_value($cp_logo->documentElement,'twitter_id');
					$consumer_key = cp_find_xml_value($cp_logo->documentElement,'consumer_key');
					$consumer_secret = cp_find_xml_value($cp_logo->documentElement,'consumer_secret');
					$access_token = cp_find_xml_value($cp_logo->documentElement,'access_token');
					$access_secret_token = cp_find_xml_value($cp_logo->documentElement,'access_secret_token');
					$breadcrumbs = cp_find_xml_value($cp_logo->documentElement,'breadcrumbs');
					$rtl_layout = cp_find_xml_value($cp_logo->documentElement,'rtl_layout');
					$site_loader = cp_find_xml_value($cp_logo->documentElement,'site_loader');
					$element_loader = cp_find_xml_value($cp_logo->documentElement,'element_loader');
					
					$maintenance_mode = cp_find_xml_value($cp_logo->documentElement,'maintenance_mode');
					$maintenace_title = cp_find_xml_value($cp_logo->documentElement,'maintenace_title');
					$countdown_time = cp_find_xml_value($cp_logo->documentElement,'countdown_time');
					$email_mainte = cp_find_xml_value($cp_logo->documentElement,'email_mainte');
					$mainte_description = cp_find_xml_value($cp_logo->documentElement,'mainte_description');
					$cp_comming_soon = cp_find_xml_value($cp_logo->documentElement,'cp_comming_soon');
					
					
					$donation_button = cp_find_xml_value($cp_logo->documentElement,'donation_button');
					$donate_btn_text = cp_find_xml_value($cp_logo->documentElement,'donate_btn_text');
					$donation_page_id = cp_find_xml_value($cp_logo->documentElement,'donation_page_id');
					$donate_email_id = cp_find_xml_value($cp_logo->documentElement,'donate_email_id');
					$donate_title = cp_find_xml_value($cp_logo->documentElement,'donate_title');
					$donation_currency = cp_find_xml_value($cp_logo->documentElement,'donation_currency');
					
					
					$social_icons_mainte = cp_find_xml_value($cp_logo->documentElement,'social_icons_mainte');
					
					$tf_username = cp_find_xml_value($cp_logo->documentElement,'tf_username');
					$tf_sec_api = cp_find_xml_value($cp_logo->documentElement,'tf_sec_api');
				}
				
			
			?>
            <ul class="logo_tab">
              <li id="logo" class="logo_dimenstion active_tab">
                <div id="header_logo_cp" class="row-fluid">
					<ul class="panel-body recipe_class span3 header_logo_btn">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3><?php esc_html_e('HEADER LOGO', 'mosque_crunchpress'); ?></h3>
							</span>
							<label for="header_logo_btn">
								<div class="checkbox-switch
									<?php echo ($header_logo_btn=='enable' || ($header_logo_btn=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; ?>">
								</div>
							</label>
							<input type="checkbox" name="header_logo_btn" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="header_logo_btn" id="header_logo_btn" class="checkbox-switch" value="enable" <?php 

							echo ($header_logo_btn=='enable' || ($header_logo_btn=='' && empty($default)))? 'checked': ''; 

							?>>
							<div class="clear"></div>
							<p> <?php esc_html_e('You can switch between header logo image and header logo text, turning it on it will show logo as image, turning it off it will disable image and show text which you have entered in wordpress settings.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span3 cp_logo_text">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('LOGO PLAIN TEXT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="logo_text_cp" id="logo_text_cp" value="<?php echo ($logo_text_cp == '')? esc_html($logo_text_cp): esc_html($logo_text_cp);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please paste logo text.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span3 cp_logo_text">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('LOGO BOLD TEXT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="logo_bold_text_cp" id="logo_bold_text_cp" value="<?php echo ($logo_bold_text_cp == '')? esc_html($logo_bold_text_cp): esc_html($logo_bold_text_cp);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please paste logo text.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span3 cp_logo_text">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('LOGO SUBTEXT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="logo_subtext" id="logo_subtext" value="<?php echo ($logo_subtext == '')? esc_html($logo_subtext): esc_html($logo_subtext);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please paste logo subtext.','mosque_crunchpress');?></p>
						</li>
					</ul>
				</div>
				<ul class="panel-body recipe_class logo_upload row-fluid cp_logo">
                  <?php 
					$image_src_head = '';
					if(!empty($header_logo)){ 
						$image_src_head = wp_get_attachment_image_src( $header_logo, 'full' );
						$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
					}
					?>
					<li class="panel-input span8 eql_height">
						<span class="panel-title">
							<h3 for="header_logo" >
							  <?php esc_html_e('Logo', 'mosque_crunchpress'); ?>
							</h3>
						</span>
						<div class="content_con">
							<input name="header_logo" type="hidden" class="clearme" id="upload_image_attachment_id" value="<?php echo esc_attr($header_logo); ?>" />
							<input name="header_link" id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($image_src_head); ?>" />
							<input class="upload_image_button" type="button" value="Upload" />
						</div>
						<p> <?php esc_html_e('Upload logo image here, PNG, Gif, JPEG, JPG format supported only.','mosque_crunchpress');?> </p>  
					</li>
					<li class="panel-right-box span4 eql_height">
						<div class="admin-logo-image">
						  <?php 
							if(!empty($header_logo)){ 
								$image_src_head = wp_get_attachment_image_src( $header_logo, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $header_logo, array(150,150)); ?>
									<img class="clearme img-class" src="<?php if(!empty($image_src_head)){echo esc_url($thumb_src_preview[0]);}?>" alt="logo" />
									<span class="close-me"></span>
						  <?php } ?>
						</div>
					</li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid cp_logo">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3 for="logo_width" >
						  <?php esc_html_e('Width', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
                    <div id="logo_width" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="logo_width" value="<?php echo esc_attr($logo_width);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image width, you can also use Arrow keys UP,Down - Left,Right.','mosque_crunchpress');?> </p>                  
                  </li>
                  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($logo_width);?> <?php esc_html_e('px','mosque_crunchpress');?> </li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid cp_logo">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3 for="logo_height" >
						  <?php esc_html_e('Height', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
                    <div id="logo_height" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="logo_height" value="<?php echo esc_attr($logo_height);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image height, you can also use Arrow keys UP,Down - Left,Right.','mosque_crunchpress');?> </p>  
                  </li>
				  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($logo_height);?> <?php esc_html_e('px','mosque_crunchpress');?> </li>
                </ul>
				<ul class="panel-body recipe_class favi_upload row-fluid">
                  <?php 
					$image_src_head = '';
					if(!empty($header_favicon)){ 
						$image_src_head = wp_get_attachment_image_src( $header_favicon, 'full' );
						$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
					}
					?>
					<li class="panel-input span8 eql_height">
						<span class="panel-title">
							<h3>
							  <?php esc_html_e('Upload Favicon', 'mosque_crunchpress'); ?>
							</h3>
						</span>
						<div class="content_con">
							<input name="header_favicon" type="hidden" class="clearme" id="upload_image_attachment_id" value="<?php echo esc_attr($header_favicon); ?>" />
							<input name="header_fav_link" id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($image_src_head); ?>" />
							<input class="upload_image_button" type="button" value="Upload" />
						</div>
						<p> <?php esc_html_e('Upload Favicon image here, PNG, Gif, JPEG, JPG format supported only.','mosque_crunchpress');?> </p>  
					</li>
					<li class="panel-right-box span4 eql_height">
						<div class="admin-logo-image">
						  <?php 
							if(!empty($header_favicon)){ 
								$image_src_head = wp_get_attachment_image_src( $header_favicon, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $header_favicon, array(150,150)); ?>
									<img class="clearme img-class" src="<?php if(!empty($image_src_head)){echo esc_url($thumb_src_preview[0]);}?>" alt="logo" />
									<span class="close-me"></span>
						  <?php } ?>
						</div>
					</li>
                </ul>
              </li>
              <li id="color_style" class="style_color_scheme">
                <ul class="panel-body recipe_class row-fluid">
                  <li class="panel-input span8">
					<span class="panel-title">
						<h3 for="select_layout_cp">
						  <?php esc_html_e('SELECT LAYOUT', 'mosque_crunchpress'); ?>
						</h3>
					</span>
                    <div class="combobox">
                      <select name="select_layout_cp" class="select_layout_cp" id="select_layout_cp">
                        <option <?php if($select_layout_cp == 'full_layout'){echo 'selected';}?> value="full_layout" class="full_layout"><?php esc_html_e('Full Layout','mosque_crunchpress');?></option>
                       <option <?php if($select_layout_cp == 'boxed_layout'){echo 'selected';}?> value="boxed_layout" class="box_layout"><?php esc_html_e('Box Layout','mosque_crunchpress');?></option>
                      </select>
                    </div>
					<p> <?php esc_html_e('Please select website layout Full or Boxed.','mosque_crunchpress');?> </p>
                  </li>
                  <li class="span4 logo_upload">
					<div class="admin-logo-image">
						<img src="<?php echo CP_PATH_URL;?>/images/full_version.jpg" class="full_v" />
						<img src="<?php echo CP_PATH_URL;?>/images/boxed_version.jpg" class="boxed_v" />
					</div>	
				  </li>
                </ul>
                <div class="clear"></div>
				 <ul id="boxed_layout" class="panel-body recipe_class row-fluid">
                   <li class="panel-input span8">
					<span class="panel-title">
						<h3>
						  <?php esc_html_e('BOXED LAYOUT BACKGROUND', 'mosque_crunchpress'); ?>
						</h3>
					</span>
					<div class="color-picker-container">
						<input type="text" name="boxed_scheme" class="color-picker" value="<?php if($boxed_scheme <> ''){echo esc_attr($boxed_scheme);}?>" />
					</div>
					<p> <?php esc_html_e('Please select any color from color palette to use as color scheme, leaving blank color scheme will be auto selected as default.','mosque_crunchpress');?> </p>
                  </li>
                  <li class="span4 right-box-sec"> </li>
                </ul>
                <div class="clear"></div>
                
				<div class="row-fluid">
					<ul class="recipe_class span4">
						<li class="panel-radioimage panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('COLOR SCHEME', 'mosque_crunchpress'); ?>
								</h3>
							</span>

							<div class="color-picker-container">
								<input type="text" name="color_scheme" class="color-picker" value="<?php if($color_scheme <> ''){echo esc_attr($color_scheme);}?>" />
							</div>
							<p> <?php esc_html_e('Please select any color from color palette to use as color scheme (it will effect on all headings and anchors), leaving blank color scheme will be auto selected as default.','mosque_crunchpress');?> </p>
						</li>
					</ul>
					<ul class="recipe_class span4">
						<li class="panel-radioimage panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('BODY COLOR', 'mosque_crunchpress'); ?>
								</h3>
							</span>

							<div class="color-picker-container">
								<input type="text" name="body_color" class="color-picker" value="<?php if($body_color <> ''){echo esc_attr($body_color);}?>" />
							</div>
							<p> <?php esc_html_e('Please select any color from color palette to use as color scheme (it will effect on all headings and anchors), leaving blank color scheme will be auto selected as default.','mosque_crunchpress');?> </p>
						</li>
					</ul>
					<ul class="recipe_class span4">
						<li class="panel-radioimage panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('HEADING COLOR', 'mosque_crunchpress'); ?>
								</h3>
							</span>

							<div class="color-picker-container">
								<input type="text" name="heading_color" class="color-picker" value="<?php if($heading_color <> ''){echo esc_attr($heading_color);}?>" />
							</div>
							<p> <?php esc_html_e('Please select any color from color palette to use as color scheme (it will effect on all headings and anchors), leaving blank color scheme will be auto selected as default.','mosque_crunchpress');?> </p>
						</li>
					</ul>
				</div>
				<div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid"> 
                  <li class="panel-input span8">
				  <span class="panel-title">
                    <h3>
                      <?php esc_html_e('SELECT BACKGROUND TYPE', 'mosque_crunchpress'); ?>
                    </h3>
                  </span>
                    <div class="combobox">
                      <select name="select_background_patren" class="select_background_patren" id="select_background_patren">
                        <option <?php if($select_bg_pat == 'Background-Patren'){echo 'selected';}?> value="Background-Patren" class="select_bg_patren"> <?php esc_html_e('Background Pattern','mosque_crunchpress');?> </option>
                        <option <?php if($select_bg_pat == 'Background-Color'){echo 'selected';}?> value="Background-Color" class="select_bg_color"> <?php esc_html_e('Background Color','mosque_crunchpress');?> </option>
                        <option <?php if($select_bg_pat == 'Background-Image'){echo 'selected';}?> value="Background-Image" class="select_bg_image"> <?php esc_html_e('Background Image','mosque_crunchpress');?> </option>
                      </select>
                    </div>
					<p> <?php esc_html_e('Please select background pattern or background color.','mosque_crunchpress');?> </p>
                  </li>
                  <li id="select_bg_patren" class="span4 pattern-container">
				  <?php 
								$options = array(
									'1'=>array('value'=>'1', 'image'=>'/framework/images/pattern/pattern-1.png'),
									'2'=>array('value'=>'2','image'=>'/framework/images/pattern/pattern-2.png'),
									'3'=>array('value'=>'3','image'=>'/framework/images/pattern/pattern-3.png'),
									'4'=>array('value'=>'4','image'=>'/framework/images/pattern/pattern-4.png'),
									'5'=>array('value'=>'5','image'=>'/framework/images/pattern/pattern-5.png'),
									'6'=>array('value'=>'6','image'=>'/framework/images/pattern/pattern-6.png'),
									'7'=>array('value'=>'7','image'=>'/framework/images/pattern/pattern-7.png'),
									'8'=>array('value'=>'8','image'=>'/framework/images/pattern/pattern-8.png'),
									'9'=>array('value'=>'9','image'=>'/framework/images/pattern/pattern-9.png'),
									'10'=>array('value'=>'10','image'=>'/framework/images/pattern/pattern-10.png'),
									'11'=>array('value'=>'11','image'=>'/framework/images/pattern/pattern-11.png'),
									'12'=>array('value'=>'12','image'=>'/framework/images/pattern/pattern-12.png'),
									'13'=>array('value'=>'13','image'=>'/framework/images/pattern/pattern-13.png'),
									'14'=>array('value'=>'14','image'=>'/framework/images/pattern/pattern-14.png'),
									'15'=>array('value'=>'15','image'=>'/framework/images/pattern/pattern-15.png'),
									'16'=>array('value'=>'16','image'=>'/framework/images/pattern/pattern-16.png'),
									'17'=>array('value'=>'17','image'=>'/framework/images/pattern/pattern-17.png'),
									'18'=>array('value'=>'18','image'=>'/framework/images/pattern/pattern-18.png'),
									'19'=>array('value'=>'19','image'=>'/framework/images/pattern/pattern-19.png'),
									'20'=>array('value'=>'20','image'=>'/framework/images/pattern/pattern-20.png'),
									'21'=>array('value'=>'21','image'=>'/framework/images/pattern/pattern-21.png'),
									'22'=>array('value'=>'22','image'=>'/framework/images/pattern/pattern-22.png'),
									'23'=>array('value'=>'23','image'=>'/framework/images/pattern/pattern-45.png'),
								);
								$value = '';
								$default = '';
								foreach( $options as $option ){ 
								?>
                    <div class='radio-image-wrapper'>
                      <label for="<?php echo esc_attr($option['value']); ?>">
                      <img src=<?php echo CP_PATH_URL.$option['image']?> class="color_patren" alt="color_patren">
                      <div id="check-list"></div>
                      </label>
                      <input type="radio" class="checkbox_class" name="color_patren" value="<?php echo esc_attr($option['image']); ?>" <?php 
											if($color_patren == $option['image']){
												echo 'checked';
											}else if($color_patren == '' && $default == $option['image']){
												echo 'checked';
											}
										?> id="<?php echo esc_attr($option['value']); ?>" class=""
										>
                    </div>
                    <?php } ?> 
				  </li>
                </ul>
                <div class="clear"></div>
                <ul id="select_bg_color" class="panel-body recipe_class row-fluid">
                  
                  <li class="panel-input span8">
				  <span class="panel-title">
                    <h3 for="bg_scheme" >
                      <?php esc_html_e('BACKGROUND COLOR', 'mosque_crunchpress'); ?>
                    </h3>
                  </span>
                    <div class="color-picker-container">
						<input type="text" name="bg_scheme" class="color-picker" value="<?php if($bg_scheme <> ''){echo esc_attr($bg_scheme);}?>"/>
					</div>
					<p> <?php esc_html_e('Please select any color from color palette to use as background color, leaving blank background will be auto selected as default background.','mosque_crunchpress');?> </p>
                  </li>
                  <li class="span4 right-box-sec"></li>
                </ul>
                <div class="clear"></div>
                <ul id="bg_upload_id" class="recipe_class logo_upload row-fluid">
                  <li class="panel-input span8 ">
					  <span class="panel-title">
						<h3 for="body_patren" >
						  <?php esc_html_e('Upload Background Pattern', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
					  <?php
					  $image_src_head = '';
								
								if(!empty($header_logo)){ 
								
									$image_src_head = wp_get_attachment_image_src( $body_patren, 'full' );
									$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
									
								} 
					  ?>
					<div class="content_con">
						<input name="body_patren" class="emptyme" type="hidden" id="upload_image_attachment_id" value="<?php echo esc_attr($body_patren); ?>" />
						<input id="upload_image_text" class="emptyme upload_image_text" type="text" value="<?php echo esc_url($image_src_head); ?>" />
						<input class="upload_image_button" type="button" value="Upload" />
					</div>
					<p> <?php esc_html_e('Upload background pattern for your theme this option provide you access to put your own image to use as background pattern.','mosque_crunchpress');?> </p>
                  </li>
                  
				   <li class="panel-right-box span4">
					   <div class="admin-logo-image">
						  <?php 
							if(!empty($body_patren)){ 
								$image_src_head = wp_get_attachment_image_src( $body_patren, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $body_patren, array(150,150));?>
						  <img class="clearme img-class" src="<?php if(!empty($image_src_head)){echo esc_url($thumb_src_preview[0]);}?>" /><span class="close-me"></span>
						  <?php } ?>
						</div>
					</li>
                </ul>
                <ul id="image_upload_id" class="recipe_class logo_upload row-fluid">
                 
                  <li class="panel-input span8">
					   <span class="panel-title">
						<h3 for="body_image" >
						  <?php esc_html_e('Upload Background Image', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
					  <?php
					   $image_src_head = '';
								
								if(!empty($body_image)){ 
								
									$image_src_head = wp_get_attachment_image_src( $body_image, 'full' );
									$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
									
								}
						
					  ?>
                    <div class="content_con">
						<input name="body_image" class="clearme" type="hidden" id="upload_image_attachment_id" value="<?php echo esc_attr($body_image); ?>" />
						<input id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($image_src_head); ?>" />
						<input class="upload_image_button" type="button" value="Upload" />
					</div>
					<p> <?php esc_html_e('Upload background Image for your theme this option provide you access to put your own image to use as background Image.','mosque_crunchpress');?> </p>
                  </li>
				   <li class="span4 description" >
					   <div class="admin-logo-image">
						  <?php 
							if(!empty($body_image)){ 
								$image_src_head = wp_get_attachment_image_src( $body_image, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $body_image, array(150,150));?>
						  <img class="clearme img-class" src="<?php if(!empty($image_src_head)){echo esc_url($thumb_src_preview[0]);}?>" /><span class="close-me"></span>
						  <?php } ?>
						</div>
					</li>
					
                </ul>
                <div class="clear"></div>
				<div class="row-fluid">
                <ul class="recipe_class image_upload_options span4">
                 
                  <li class="panel-radioimage panel-input full-width">
				   <span class="panel-title">
                    <h3 for="position_image_layout">
                      <?php esc_html_e('Image Position', 'mosque_crunchpress'); ?>
                    </h3>
                  </span>
				  <div class="combobox cp-select-wrap">
					<select name="position_image_layout" class="position_image_layout" id="position_image_layout">
							<?php 
								$value = '';
								$options = array(
									
									'1'=>array('value'=>'top','title'=>'Position Top'),
									'2'=>array('value'=>'right','title'=>'Position Right'),
									'3'=>array('value'=>'left','title'=>'Position Left'),
									'4'=>array('value'=>'bottom','title'=>'Position Bottom'),
									'5'=>array('value'=>'center','title'=>'Position Center'),
									
								);
								foreach( $options as $option ){ ?>
									<option <?php if($position_image_layout == $option['value']){echo 'selected';}?> value="<?php echo esc_attr($option['value']);?>" class="position_image_layout"><?php echo esc_attr($option['title']);?></option>
								<?php } ?>
                    </select>
					</div>
					<p> <?php esc_html_e('You can manage background image position in this area.','mosque_crunchpress');?> </p>
                  </li>
				  
                </ul>
                <ul class="panel-body recipe_class image_upload_options span4">
                  <li class="panel-input full-width">
				  <span class="panel-title">
                    <h3 for="image_repeat_layout">
                      <?php esc_html_e('SELECT BACKGROUND TYPE', 'mosque_crunchpress'); ?>
                    </h3>
                  </span>
                    <div class="combobox cp-select-wrap">
                      <select name="image_repeat_layout" class="image_repeat_layout" id="image_repeat_layout">
					  			<?php
								$value = '';
								$options = array(
									'1'=>array('value'=>'no-repeat','title'=>'No Repeat'),
									'2'=>array('value'=>'repeat-x','title'=>'Repeat Horizontal'),
									'3'=>array('value'=>'repeat-y','title'=>'Repeat Vertical'),
									'4'=>array('value'=>'repeat','title'=>'Repeat'),
								);
								foreach( $options as $option ){ ?>
							<option <?php if($image_repeat_layout == $option['value']){echo 'selected';}?> value="<?php echo esc_attr($option['value']);?>" class="select_bg_patren"><?php echo esc_attr($option['title']);?></option>
						<?php }?>
                      </select>
                    </div>
					<p> <?php esc_html_e('You can manage your image repeat whether its repeated horizontal verticle or both.','mosque_crunchpress');?> </p>
                  </li>
                </ul>
                <ul class="recipe_class image_upload_options span4">
                  
                  <li class="panel-radioimage panel-input full-width">
				  <span class="panel-title ">
                    <h3 for="image_attachment_layout">
                      <?php esc_html_e('Image Attachment', 'mosque_crunchpress'); ?>
                    </h3>
                  </span>
				  <div class="combobox cp-select-wrap">
				   <select name="image_attachment_layout" class="image_attachment_layout" id="image_attachment_layout">
						<?php 
						$value = '';
						$options = array(
							'1'=>array('value'=>'fixed','title'=>'Fixed'),
							'2'=>array('value'=>'scroll','title'=>'Scroll'),
						);
						foreach( $options as $option ){ ?>
							<option <?php if($image_attachment_layout == $option['value']){echo 'selected';}?> value="<?php echo esc_attr($option['value']);?>" class="image_attachment_layout"><?php echo esc_attr($option['title']);?></option>                   
						<?php } ?>
					</select>
					</div>
					<p> <?php esc_html_e('You can manage your background image attachment fixed or scroll.','mosque_crunchpress');?> </p>
                  </li>
				 
                </ul>
				</div>
              </li>
              <li id="hr_settings" class="logo_dimenstion">
				<div class="row-fluid">
					<ul class="panel-body recipe_class span12">
						<li class="panel-input full-width">
							<?php
								$images = array(
									'1'=>array('value'=>'header_1', 'image'=>'/frontend/header/header_1.jpg'),
									'2'=>array('value'=>'header_2','image'=>'/frontend/header/header_2.jpg'),
									
								);							
								echo '<div class="select_header_img">';
									foreach($images as $keys=>$val){
										echo '<div class="header_image_cp" id="'.$val['value'].'"><img src="'.CP_PATH_URL.$val['image'].'" atl=""></div>';
									}
								echo '</div>';
							?>
							
							<p><?php esc_html_e('Please select website default header style from dropdown below.','mosque_crunchpress');?></p>
						</li>
					</ul>    
				</div>
			<div class="row-fluid">
					<ul class="panel-body recipe_class span8">
						 <li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="select_header_cp">
								  <?php esc_html_e('SELECT HEADER LAYOUT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<div class="combobox">
							  <select name="select_header_cp" class="select_header_cp" id="select_header_cp">
								<option <?php if($select_header_cp == 'Style 1'){echo 'selected';}?> value="Style 1" class="header_1"><?php esc_html_e('Style 1','mosque_crunchpress');?></option>
								<option <?php if($select_header_cp == 'Style 2'){echo 'selected';}?> value="Style 2" class="header_2"><?php esc_html_e('Style 2','mosque_crunchpress');?></option>
							  </select>
							</div>
							<p> <?php esc_html_e('Please select website default header style from dropdown.','mosque_crunchpress');?> </p>
						  </li>
					</ul>    
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="" >
									<?php esc_html_e('Apply Header Style On All Pages', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<label for="header_style_apply">
								<div class="checkbox-switch <?php echo ($header_style_apply=='enable' || ($header_style_apply=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; ?>"></div>
							</label>
							<input type="checkbox" name="header_style_apply" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="header_style_apply" id="header_style_apply" class="checkbox-switch" value="enable" 
							<?php echo ($header_style_apply=='enable' || ($header_style_apply=='' && empty($default)))? 'checked': ''; ?>>
							<p><?php esc_html_e('You can turn On/Off to add above header style apply on all pages turning it off page settings will be apply on each page.','mosque_crunchpress');?></p>
						</li>
					</ul>
				</div>
				<div class="row-fluid">
					<ul class="panel-body recipe_class logo_upload row-fluid">
					  <?php 
						$image_src_head_bg = '';
						if(!empty($header_logo_bg)){ 
							$image_src_head_bg = wp_get_attachment_image_src( $header_logo_bg, 'full' );
							$image_src_head_bg = (empty($image_src_head_bg))? '': $image_src_head_bg[0];
						}
						?>
						<li class="panel-input span8 eql_height">
							<span class="panel-title">
								<h3 for="header_logo" >
								  <?php esc_html_e('Header background', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<div class="content_con">
								<input name="header_logo_bg" type="hidden" class="clearme" id="upload_image_attachment_id" value="<?php echo esc_attr($header_logo_bg); ?>" />
								<input name="header_link_bg" id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($image_src_head_bg); ?>" />
								<input class="upload_image_button" type="button" value="Upload" />
							</div>
							<p> <?php esc_html_e('Upload image for header section background.','mosque_crunchpress');?> </p>  
						</li>
						<li class="panel-right-box span4 eql_height">
							<div class="admin-logo-image">
							  <?php 
								if(!empty($header_logo_bg)){ 
									$image_src_head_bg = wp_get_attachment_image_src( $header_logo_bg, 'full' );
									$image_src_head_bg = (empty($image_src_head_bg))? '': $image_src_head_bg[0];
									$thumb_src_preview = wp_get_attachment_image_src( $header_logo_bg, array(150,150)); ?>
										<img class="clearme img-class" src="<?php if(!empty($image_src_head_bg)){echo esc_url($thumb_src_preview[0]);}?>" alt="header background image" />
										<span class="close-me"></span>
							  <?php } ?>
							</div>
						</li>
					</ul>
				</div>	
				<div class="row-fluid">
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="header_css_code" >
									<?php esc_html_e('HEADER CODE', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<textarea name="header_css_code" id="header_css_code" ><?php echo ($header_css_code == '')? esc_textarea($header_css_code): esc_textarea($header_css_code);?></textarea>
							<p><?php esc_html_e('Please write css code for you theme if you want to put some extra code in css for styling purpose only.','mosque_crunchpress');?></p>
						</li>				 
					</ul>
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="google_webmaster_code" >
									<?php esc_html_e('GOOGLE WEBMASTER VERIFY CODE', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<textarea name="google_webmaster_code" id="google_webmaster_code" ><?php if($google_webmaster_code <> '') { echo esc_textarea($google_webmaster_code);}?></textarea>
							<p><?php esc_html_e('Please paste google, Bing, yahoo etc analytics code here to validate your site in webmaster.','mosque_crunchpress');?></p>
						</li> 
					</ul> 
					<ul class="panel-body recipe_class span4">
					  <li class="panel-input full-width">
						<span class="panel-title">
							<h3 for="" >
								<?php esc_html_e('Prayer Timing On/Off ', 'mosque_crunchpress'); ?>
							</h3>
						</span>
						<label for="salat_time">
							<div class="checkbox-switch <?php echo ($salat_time=='enable' || ($salat_time=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
						</label>
						<input type="checkbox" name="salat_time" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="salat_time" id="salat_time" class="checkbox-switch" value="enable" <?php echo ($salat_time=='enable' || ($salat_time=='' && empty($default)))? 'checked': ''; ?>>
						<p><?php esc_html_e('You can Turn on/off Salat Times','mosque_crunchpress');?></p>
					  </li>
					</ul>
				</div>
				<div class="row-fluid">
				<!--Sign In Sign Out Button -->
					<!--<ul class="panel-body recipe_class span6">
					  <li class="panel-input full-width">
						<span class="panel-title">
							<h3 for="" >
								<?php esc_html_e('Enable Sign In/ Sign Out Option In Header', 'mosque_crunchpress'); ?>
							</h3>
						</span>
						<label for="topsign_icon">
							<div class="checkbox-switch <?php echo ($topsign_icon=='enable' || ($topsign_icon=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
						</label>
						<input type="checkbox" name="topsign_icon" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="topsign_icon" id="topsign_icon" class="checkbox-switch" value="enable" <?php echo ($topsign_icon=='enable' || ($topsign_icon=='' && empty($default)))? 'checked': ''; ?>>
						<p><?php esc_html_e('You can Enable/Disable Sign In & Sign Out Option In Header Section.','mosque_crunchpress');?></p>
					  </li>
					</ul>
					<ul class="panel-body recipe_class span4">
					  <li class="panel-input full-width">
						<span class="panel-title">
							<h3 for="" >
								<?php esc_html_e('TOP SOCIAL NETWORK ICONS', 'mosque_crunchpress'); ?>
							</h3>
						</span>
						<label for="topsocial_icon">
							<div class="checkbox-switch <?php echo ($topsocial_icon=='enable' || ($topsocial_icon=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
						</label>
						<input type="checkbox" name="topsocial_icon" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="topsocial_icon" id="topsocial_icon" class="checkbox-switch" value="enable" <?php echo ($topsocial_icon=='enable' || ($topsocial_icon=='' && empty($default)))? 'checked': ''; ?>>
						<p><?php esc_html_e('You can turn On/Off Top social network icons from main menu.','mosque_crunchpress');?></p>
					  </li>
					</ul>
					<ul class="panel-body recipe_class span4">
					  <li class="panel-input full-width">
						<span class="panel-title">
							<h3 for="" >
								<?php esc_html_e('Slider Background For Header', 'mosque_crunchpress'); ?>
							</h3>
						</span>
						<label for="slide_bg_islamic">
							<div class="checkbox-switch <?php echo ($slide_bg_islamic =='enable' || ($slide_bg_islamic=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
						</label>
						<input type="checkbox" name="slide_bg_islamic" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="slide_bg_islamic" id="slide_bg_islamic" class="checkbox-switch" value="enable" <?php echo ($slide_bg_islamic=='enable' || ($slide_bg_islamic=='' && empty($default)))? 'checked': ''; ?>>
						<p><?php esc_html_e('Turn On/Off Slider Background.','mosque_crunchpress');?></p>
					  </li>
					</ul>-->
				</div>
				<!--Sign In Sign Out Button -->
				<!--<div class="row-fluid">
					<ul class="panel-body recipe_class span12">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('CONTACT US', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="contact_us_code" id="contact_us_code" value="<?php echo ($contact_us_code == '')? esc_html($contact_us_code): esc_html($contact_us_code);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please Paste Here Contact Us For Header Section Text. HTML Tags NOT Allowed.','mosque_crunchpress');?></p>
						</li>
					</ul>
				</div>-->
				<!--<div class="row-fluid">
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Phone:', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="contact_us_code" id="contact_us_code" value="<?php echo ($contact_us_code == '')? esc_html($contact_us_code): esc_html($contact_us_code);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Phone Number For Header Section','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Email:', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="contact_us_code2" id="contact_us_code2" value="<?php echo ($contact_us_code2 == '')? esc_html($contact_us_code2): esc_html($contact_us_code2);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Email Address For Header Section','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Address:', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="contact_us_code3" id="contact_us_code3" value="<?php echo ($contact_us_code3 == '')? esc_html($contact_us_code3): esc_html($contact_us_code3);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Address For Header Section.','mosque_crunchpress');?></p>
						</li>
					</ul>
				</div>-->
				
              </li>
            <li id="ft_settings" class="logo_dimenstion">
				<!--<div class="row-fluid">
					<ul class="panel-body recipe_class span12">
						<li class="panel-input full-width">
							<?php
								$images = array(
									'1'=>array('value'=>'footer_1', 'image'=>'/frontend/footer/footer_1.jpg'),
									'2'=>array('value'=>'footer_2','image'=>'/frontend/footer/footer_2.jpg'),
									'3'=>array('value'=>'footer_3','image'=>'/frontend/footer/footer_3.jpg'),
									'4'=>array('value'=>'footer_4','image'=>'/frontend/footer/footer_4.jpg'),
									'5'=>array('value'=>'footer_5','image'=>'/frontend/footer/footer_5.jpg'),
									'6'=>array('value'=>'footer_6','image'=>'/frontend/footer/footer_6.jpg'),
								);							
								echo '<div class="select_footer_img">';
									foreach($images as $keys=>$val){
										echo '<div class="footer_image_cp" id="'.$val['value'].'"><img src="'.CP_PATH_URL.$val['image'].'" atl=""></div>';
									}
								echo '</div>';
							?>
							
							<p><?php esc_html_e('Please select website default footer style from dropdown.','mosque_crunchpress');?></p>
						</li>
					</ul>    
				</div>
				<!--<div class="row-fluid">
					<ul class="panel-body recipe_class span8">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
								  <?php esc_html_e('SELECT FOOTER LAYOUT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<div class="combobox">
								<select name="select_footer_cp" class="select_footer_cp" id="select_footer_cp">
									<option <?php if($select_footer_cp == 'Style 1'){echo 'selected';}?> value="Style 1" class="footer_1">Style 1</option>
									<option <?php if($select_footer_cp == 'Style 5'){echo 'selected';}?> value="Style 5" class="footer_5">Style 2</option>
									<option <?php if($select_footer_cp == 'Style 3'){echo 'selected';}?> value="Style 3" class="footer_3">Style 3</option>
									<option <?php if($select_footer_cp == 'Style 4'){echo 'selected';}?> value="Style 4" class="footer_4">Style 4</option>
									<option <?php if($select_footer_cp == 'Style 5'){echo 'selected';}?> value="Style 5" class="footer_5">Style 5</option>
									<option <?php if($select_footer_cp == 'Style 6'){echo 'selected';}?> value="Style 6" class="footer_6">Style 6</option>
								</select>
							</div>
							<p><?php esc_html_e('Please select website default footer style from dropdown.','mosque_crunchpress');?></p>
						</li>
					</ul>    
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('APPLY FOOTER STYLE ON ALL PAGES', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<label for="footer_style_apply">
								<div class="checkbox-switch <?php echo ($footer_style_apply=='enable' || ($footer_style_apply=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; ?>"></div>
							</label>
							<input type="checkbox" name="footer_style_apply" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="footer_style_apply" id="footer_style_apply" class="checkbox-switch" value="enable" 
							<?php echo ($footer_style_apply=='enable' || ($footer_style_apply=='' && empty($default)))? 'checked': ''; ?>>
							<p><?php esc_html_e('You can turn On/Off to add above footer style apply on all pages turning it off page settings will be apply on each page.','mosque_crunchpress');?></p>
						</li>
					</ul>
				</div>-->
				<!--<ul class="panel-body recipe_class logo_upload row-fluid">
                  <?php 
					$image_src_head = '';
					if(!empty($footer_logo)){ 
						$image_src_head = wp_get_attachment_image_src( $footer_logo, 'full' );
						$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
					}
					?>
					<li class="panel-input span8 eql_height">
						<span class="panel-title">
							<h3>
							  <?php esc_html_e('Footer Logo', 'mosque_crunchpress'); ?>
							</h3>
						</span>
						<div class="content_con">
							<input name="footer_logo" type="hidden" class="clearme" id="upload_image_attachment_id" value="<?php echo esc_attr($footer_logo); ?>" />
							<input name="footer_link" id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($image_src_head); ?>" />
							<input class="upload_image_button" type="button" value="Upload" />
						</div>
						<p> <?php esc_html_e('Upload logo image here, PNG, Gif, JPEG, JPG format supported only.','mosque_crunchpress');?> </p>  
					</li>
					<li class="panel-right-box span4 eql_height">
						<div class="admin-logo-image">
						  <?php 
							if(!empty($footer_logo)){ 
								$image_src_head = wp_get_attachment_image_src( $footer_logo, 'full' );
								$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
								$thumb_src_preview = wp_get_attachment_image_src( $footer_logo, array(150,150)); ?>
									<img class="clearme img-class" src="<?php if(!empty($image_src_head)){echo esc_url($thumb_src_preview[0]);}?>" alt="logo" />
									<span class="close-me"></span>
						  <?php } ?>
						</div>
					</li>
                </ul>
                <div class="clear"></div>-->
                <!--<ul class="panel-body recipe_class row-fluid">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3>
						  <?php esc_html_e('Width', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
                    <div id="footer_logo_width" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="footer_logo_width" value="<?php echo esc_attr($footer_logo_width);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image width, you can also use Arrow keys UP,Down - Left,Right.','mosque_crunchpress');?> </p>                  
                  </li>
                  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($footer_logo_width);?> <?php esc_html_e('px','mosque_crunchpress');?> </li>
                </ul>
                <div class="clear"></div>
                <ul class="panel-body recipe_class row-fluid">
                  <li class="panel-input span8">
					  <span class="panel-title">
						<h3>
						  <?php esc_html_e('Height', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
                    <div id="footer_logo_height" class="sliderbar" rel="logo_bar"></div>
                    <input type="hidden" name="footer_logo_height" value="<?php echo esc_attr($footer_logo_height);?>">
					<p> <?php esc_html_e('Please scroll Left to Right to adjust logo image height, you can also use Arrow keys UP,Down - Left,Right.','mosque_crunchpress');?> </p>  
                  </li>
				  <li class="span4 right-box-sec" id="slidertext"><?php echo esc_attr($footer_logo_height);?> <?php esc_html_e('px','mosque_crunchpress');?> </li>
                </ul>-->			
				<div class="row-fluid">
					<ul class="panel-body recipe_class span6">
					  <li class="panel-input full-width">
					  <span class="panel-title">
						<h3 for="" >
						  <?php esc_html_e('SOCIAL ICONS', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
						<label for="social_networking">
						<div class="checkbox-switch <?php
									
									echo ($social_networking=='enable' || ($social_networking=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

								?>"></div>
						</label>
						<input type="checkbox" name="social_networking" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="social_networking" id="social_networking" class="checkbox-switch" value="enable" <?php 
									
									echo ($social_networking=='enable' || ($social_networking=='' && empty($default)))? 'checked': ''; 
								
								?>>
								<div class="clear"></div>
							<p> <?php esc_html_e('You can turn On/Off footer social networking profile icons.','mosque_crunchpress');?></p>
					  </li>
					</ul>
					<ul class="panel-body recipe_class span6">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="copyright_code" >
									<?php esc_html_e('COPY RIGHT TEXT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="copyright_code" id="copyright_code" value="<?php echo ($copyright_code == '')? esc_html($copyright_code): esc_html($copyright_code);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please paste here your copy right text.','mosque_crunchpress');?></p>
						</li>
					</ul>
				</div>
				<div class="row-fluid">
					<ul class="recipe_class span6 footer_widget">
						<li class="panel-radioimage panel-input full-width">
							<span class="panel-title">
								<h3 for="">
								  <?php esc_html_e('FOOTER WIDGET LAYOUT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<?php 
								$value = '';
								$options = array(
								'1'=>array('value'=>'footer-style1','image'=>'/framework/images/footer-style1.png'),
								'6'=>array('value'=>'footer-style6','image'=>'/framework/images/footer-style6.png'),
								);
								foreach( $options as $option ){ ?>
							<div class='radio-image-wrapper'>
								<label for="<?php echo esc_attr($option['value']); ?>">
								  <img src=<?php echo CP_PATH_URL.$option['image']?> class="footer_col_layout" alt="footer_col_layout" />
								  <div id="check-list"></div>
								</label>
								<input type="radio" name="footer_col_layout" value="<?php echo esc_attr($option['value']); ?>" id="<?php echo esc_attr($option['value']); ?>" class="dd"
								<?php if($footer_col_layout == $option['value']){ echo 'checked';}?>>
							</div>
							<?php } ?>
							<div class="clear"></div>
							<p> <?php esc_html_e('Please select home page layout style.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<!--<ul class="recipe_class span6 upper_footer_widget">
						<li class="panel-radioimage panel-input full-width">
							<span class="panel-title">
								<h3 for="">
								  <?php esc_html_e('FOOTER UPPER WIDGET LAYOUT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<?php 
								$value = '';
								$options = array(
								'1'=>array('value'=>'footer-style-upper-1','image'=>'/framework/images/footer-style1.png'),
								'6'=>array('value'=>'footer-style-upper-6','image'=>'/framework/images/footer-style6.png'),
								);
								foreach( $options as $option ){ ?>
							<div class='radio-image-wrapper'>
								<label for="<?php echo esc_attr($option['value']); ?>">
								  <img src=<?php echo CP_PATH_URL.$option['image']?> class="footer_upper_layout" alt="footer_upper_layout" />
								  <div id="check-list"></div>
								</label>
								<input type="radio" name="footer_upper_layout" value="<?php echo esc_attr($option['value']); ?>" id="<?php echo esc_attr($option['value']); ?>" class="dd"
								<?php if($footer_upper_layout == $option['value']){ echo 'checked';}?>>
							</div>
							<?php } ?>
							<div class="clear"></div>
							<p> <?php esc_html_e('Please select upper layout style.','mosque_crunchpress');?></p>
						</li>
					</ul>-->
				</div>
            </li>
              <li id="misc_settings">
				<div class="row-fluid">
					<ul class="panel-body recipe_class span6">
					  <li class="panel-input full-width">
					   <span class="panel-title">
						<h3 for="" >
						  <?php esc_html_e('BREADCRUMBS', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
						<label for="breadcrumbs">
						<div class="checkbox-switch <?php
									
									echo ($breadcrumbs=='enable' || ($breadcrumbs=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

								?>"></div>
						</label>
						<input type="checkbox" name="breadcrumbs" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="breadcrumbs" id="breadcrumbs" class="checkbox-switch" value="enable" <?php 
									
									if($breadcrumbs=='enable' ){echo '';} echo ($breadcrumbs=='enable' || ($breadcrumbs=='' && empty($default)))? 'checked': ''; 
								
								?>>
						<p> <?php esc_html_e('You can turn On/Off BreadCrumbs from Top of the page.','mosque_crunchpress');?></p>
					  </li>
					  
					</ul>
					<ul class="panel-body recipe_class span6">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="rtl_layout" >
									<?php esc_html_e('RTL LAYOUTS', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<label for="rtl_layout">
								<div class="checkbox-switch <?php echo ($rtl_layout=='enable' || ($rtl_layout=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
							</label>
							<input type="checkbox" name="rtl_layout" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="rtl_layout" id="rtl_layout" class="checkbox-switch" value="enable" <?php echo ($rtl_layout=='enable' || ($rtl_layout=='' && empty($default)))? 'checked': '';?>>
							<p> <?php esc_html_e('You can turn On/Off RTL Layout of website.','mosque_crunchpress');?> </p>
						</li>
					</ul>
				</div>
              </li>

			  <li id="maintenance_mode_settings">
				<div class="row-fluid">
					<ul class="panel-body recipe_class span3">
						<li class="panel-input full-width">
						   <span class="panel-title">
							<h3 for="" >
							  <?php esc_html_e('Maintenance Mode', 'mosque_crunchpress'); ?>
							</h3>
						  </span>
							<label for="maintenance_mode">
							<div class="checkbox-switch <?php
										
										echo ($maintenance_mode=='enable' || ($maintenance_mode=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

									?>"></div>
							</label>
							<input type="checkbox" name="maintenance_mode" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="maintenance_mode" id="maintenance_mode" class="checkbox-switch" value="enable" 
							<?php if($maintenance_mode=='enable' ){echo '';} echo ($maintenance_mode=='enable' || ($maintenance_mode=='' && empty($default)))? 'checked': ''; ?>>
							<p><?php esc_html_e('You can turn On/Off Maintenance mode from here.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span3">
						 <li class="panel-input full-width">
							<span class="panel-title">
								<h3>
								  <?php esc_html_e('SELECT COMING SOON LAYOUT', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<div class="combobox">
								<select name="cp_comming_soon" class="cp_comming_soon" id="cp_comming_soon">
									<option <?php if('Style 1' == $cp_comming_soon){echo 'selected';}?> value="<?php esc_html_e('Style 1','mosque_crunchpress')?>"><?php esc_html_e('Style 1','mosque_crunchpress');?></option>
									<!--<option <?php if('Style 2' == $cp_comming_soon){echo 'selected';}?> value="<?php esc_html_e('Style 2','mosque_crunchpress')?>"><?php esc_html_e('Style 2','mosque_crunchpress');?></option>-->
								</select>
							</div>
							<p> <?php esc_html_e('Please select coming soon style of your choice.','mosque_crunchpress');?> </p>
						  </li>
					</ul>
					<ul class="panel-body recipe_class span3">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Maintenance Title', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="maintenace_title" id="maintenace_title" value="<?php echo ($maintenace_title == '')? esc_html($maintenace_title): esc_html($maintenace_title);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please add title on maintenance page.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span3">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Countdown Time', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="countdown_time" id="countdown_time" value="<?php echo ($countdown_time == '')? esc_html($countdown_time): esc_html($countdown_time);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please select time span when your site will be live and counter will countdown seconds to mints and days till that on maintenance page.','mosque_crunchpress');?></p>
						</li>
					</ul>
					
				</div>
				<div class="row-fluid">
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Email', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="email_mainte" id="email_mainte" value="<?php echo ($email_mainte == '')? esc_html($email_mainte): esc_html($email_mainte);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Add email where you want to post subscriptions.','mosque_crunchpress');?></p>
						</li>
					</ul>
					
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3 for="mainte_description" >
									<?php esc_html_e('Description', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<textarea name="mainte_description" id="mainte_description" ><?php if($mainte_description <> '') { echo esc_textarea($mainte_description);}?></textarea>
							<p><?php esc_html_e('Please add description text for your website maintenance.','mosque_crunchpress');?></p>
						</li> 
					</ul>    
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
						   <span class="panel-title">
							<h3 for="" >
							  <?php esc_html_e('Social Icons', 'mosque_crunchpress'); ?>
							</h3>
						  </span>
							<label for="social_icons_mainte">
							<div class="checkbox-switch <?php
										
										echo ($social_icons_mainte=='enable' || ($social_icons_mainte=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

									?>"></div>
							</label>
							<input type="checkbox" name="social_icons_mainte" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="social_icons_mainte" id="social_icons_mainte" class="checkbox-switch" value="enable" 
							<?php if($social_icons_mainte=='enable' ){echo '';} echo ($social_icons_mainte=='enable' || ($social_icons_mainte=='' && empty($default)))? 'checked': ''; ?>>
							<p><?php esc_html_e('You can turn On/Off Maintenance mode social icons that are showing at bottom of page.','mosque_crunchpress');?></p>
						</li>
					</ul>
				</div>	
              </li>
			 <li id="donation_settings">
				<div class="row-fluid">
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
						   <span class="panel-title">
							<h3>
							  <?php esc_html_e('Donation Button', 'mosque_crunchpress'); ?>
							</h3>
						  </span>
							<label for="donation_button">
							<div class="checkbox-switch <?php
										
										echo ($donation_button=='enable' || ($donation_button=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

									?>"></div>
							</label>
							<input type="checkbox" name="donation_button" class="checkbox-switch" value="disable" checked>
							<input type="checkbox" name="donation_button" id="donation_button" class="checkbox-switch" value="enable" 
							<?php if($donation_button=='enable' ){echo '';} echo ($donation_button=='enable' || ($donation_button=='' && empty($default)))? 'checked': ''; ?>>
							<p><?php esc_html_e('You can turn On/Off donation button here.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Donation Button text', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="donate_btn_text" id="donate_btn_text" value="<?php echo ($donate_btn_text == '')? esc_html($donate_btn_text): esc_html($donate_btn_text);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please add donation button text here.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span4">
						 <li class="panel-input full-width">
							<span class="panel-title">
								<h3>
								  <?php esc_html_e('SELECT PAGE FOR DONATION', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<div class="combobox">
								<select name="donation_page_id" class="donation_page_id" id="donation_page_id">
								<?php  foreach(get_title_list_array('page') as $values){ ?>
									<option <?php if($values->ID == $donation_page_id){echo 'selected';}?> value="<?php echo esc_attr($values->ID);?>"><?php echo esc_attr($values->post_title);?></option>
									<?php }?>
								</select>
							</div>
							<p> <?php esc_html_e('Please select page on where you have added shortcode for donation.','mosque_crunchpress');?> </p>
						  </li>
					</ul>
				</div>
				<div class="row-fluid">
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Paypal Email ID', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="donate_email_id" id="donate_email_id" value="<?php echo ($donate_email_id == '')? esc_html($donate_email_id): esc_html($donate_email_id);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please add paypal email id here.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
									<?php esc_html_e('Donation Title', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<input type="text" name="donate_title" id="donate_title" value="<?php echo ($donate_title == '')? esc_html($donate_title): esc_html($donate_title);?>" />
							<div class="clear"></div>
							<p><?php esc_html_e('Please add paypal donation title, what cause this donation for.','mosque_crunchpress');?></p>
						</li>
					</ul>
					<ul class="panel-body recipe_class span4">
						<li class="panel-input full-width">
							<span class="panel-title">
								<h3>
								  <?php esc_html_e('DEFAULT CURRENCY', 'mosque_crunchpress'); ?>
								</h3>
							</span>
							<?php
							$value = '';
								$options = array(
									'AUD' => 'Australian Dollars (A $)',
									'BRL' => 'Brazilian Real',
									'CAD' => 'Canadian Dollars (C $)',
									'CZK' => 'Czech Koruna',
									'DKK' => 'Danish Krone',
									'EUR' => 'Euros (&euro;)',
									'HKD' => 'Hong Kong Dollar ($)',
									'HUF' => 'Hungarian Forint',
									'ILS' => 'Israeli New Shekel',
									'JPY' => 'Yen (&yen;)',
									'MYR' => 'Malaysian Ringgit',
									'MXN' => 'Mexican Peso',
									'NOK' => 'Norwegian Krone',
									'NZD' => 'New Zealand Dollar ($)',
									'PHP' => 'Philippine Peso',
									'PLN' => 'Polish Zloty',
									'GBP' => 'Pounds Sterling (&pound;)',
									'RUB' => 'Russian Ruble',
									'SGD' => 'Singapore Dollar ($)',
									'SEK' => 'Swedish Krona',
									'CHF' => 'Swiss Franc',
									'TWD' => 'Taiwan New Dollar',
									'THB' => 'Thai Baht',
									'TRY' => 'Turkish Lira',
									'USD' => 'U.S. Dollars ($)',
								);
							?>
							<div class="combobox">
								<select name="donation_currency" class="donation_currency" id="donation_currency">
								<?php  foreach($options as $k=>$val){ ?>
									<option <?php if($k == $donation_currency){echo 'selected';}?> value="<?php echo esc_attr($k);?>"><?php echo esc_attr($val);?></option>
									<?php }?>
								</select>
							</div>
							<p> <?php esc_html_e('Please select currency for donation.','mosque_crunchpress');?> </p>
						</li>
					</ul>
				</div>
				<div class="row-fluid">
					

				</div>
            </li>
              <?php if(!class_exists( 'Envato_WordPress_Theme_Upgrader' )){}else{?>
              <li id="envato_api" class="envato_api">
                <ul class="panel-body recipe_class">
                 
                  <li class="panel-input">
					   <span class="panel-title">
						<h3 for="tf_username" >
						  <?php esc_html_e('Username', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
                    <input type="text" name="tf_username" id="tf_username" value="<?php echo ($tf_username == '')? esc_html($tf_username): esc_html($tf_username);?>" />
					<span><?php esc_html_e('Please enter your Theme Forest username.','mosque_crunchpress');?>  <br />
                    <p><?php esc_html_e('For example: denonstudio','mosque_crunchpress');?>  </p></span>
                  </li>
                  
                </ul>
                <ul class="panel-body recipe_class">
                  
                  <li class="panel-input">
				  <span class="panel-title">
                    <h3 for="tf_sec_api" >
                      <?php esc_html_e('API Key', 'mosque_crunchpress'); ?>
                    </h3>
                  </span>
                    <input type="text" name="tf_sec_api" id="tf_sec_api" value="<?php echo ($tf_sec_api == '')? esc_html($tf_sec_api): esc_html($tf_sec_api);?>" />
                  </li>
                  <span class="right-box-sec"> <?php esc_html_e('Please paste here your theme forest Secret API Key.','mosque_crunchpress');?>  <br />
                     <p><?php esc_html_e('For example: xxxxxxxav7hny3p1ptm7xxxxxxxx','mosque_crunchpress');?> <p></span>
                </ul>
              </li>
              <?php }?>
            </ul>
            <div class="clear"></div>
            <div class="panel-element-tail">
              <div class="tail-save-changes">
                <div class="loading-save-changes"></div>
                <input type="submit" value="<?php echo esc_html__('Save Changes','mosque_crunchpress') ?>">
                <input type="hidden" name="action" value="general_options">
               
              </div>
            </div>
          </div>
        </form>
      </div>
      <!--content End --> 
    </div>
    <!--content area end --> 
  </div>
<?php
	}

?>
