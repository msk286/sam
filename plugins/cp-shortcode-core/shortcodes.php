<?php
/*	
*	CrunchPress Shortcodes
*	---------------------------------------------------------------------
* 	@version	1.0
*   @ Package   Shortcode
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file manage to embed the shortcodes to each page
*	based on the content of that page.
*	---------------------------------------------------------------------
*/
	
	//Call Script only at Frontend
	if(!is_admin()){
		add_action('wp_enqueue_scripts','register_short_code');
	}
	
	function register_short_code(){
		//Calling the Css File for Shortcodes
		wp_enqueue_style('cp-shortcode',CP_PATH_URL.'/frontend/shortcodes/css/shortcode.css');
	}
	
	//add_shortcode('frame', 'cp_frame_shortcode');
	add_shortcode('alert', 'cp_message_box_shortcode');
	
	add_shortcode('toggle_box', 'cp_toggle_box_shortcode');
	add_shortcode('toggle_item', 'cp_toggle_item_shortcode');
	
	add_shortcode('tab', 'cp_tab_shortcode');
	add_shortcode('tab_item', 'cp_tab_item_shortcode');
	
	//Salat Times Shortcode
	add_shortcode('salat_times', 'cp_salat_times');
	//Welcome Section
	add_shortcode('welcome', 'cp_welcome_shortcode');
	
	add_shortcode('backtop', 'cp_divider_shortcode');
	
	add_shortcode('heading', 'cp_heading_shortcode');
	
	add_shortcode('locators', 'cp_locators_shortcode');
	add_shortcode('locator', 'cp_locator_shortcode');
	
	add_shortcode('newspost_slider', 'cp_newspost_slider');
	
	//Mosque NewsLetter
	add_shortcode('newsletter', 'cp_newsletter_mosque');
	

	//add_shortcode('font-awesome', 'cp_button_fontawesome');
	add_shortcode('project_slider', 'cp_project_slider');
	add_shortcode('list', 'cp_list_shortcode');
	add_shortcode('social', 'cp_social_shortcode');
	add_shortcode('code', 'cp_code_shortcode');
	add_shortcode('slider', 'cp_slider_shortcode');			
	add_shortcode('slide', 'cp_slide_shortcode');	
	add_shortcode('cp_slider', 'cp_slider_main_shortcode');	
	add_shortcode('newsletter_section', 'cp_newsletter_section');
	add_shortcode('column', 'cp_column_shortcode');
	add_shortcode('acc_item', 'cp_acc_item_shortcode');
	add_shortcode('feature_project', 'cp_feature_shortcode');
	add_shortcode('accordion', 'cp_accordion_shortcode');
	add_shortcode('dropcap', 'cp_dropcap_shortcode');
	add_shortcode('quote', 'cp_quote_shortcode');
	add_shortcode('youtube', 'cp_youtube_shortcode');
	add_shortcode('vimeo', 'cp_vimeo_shortcode');
	add_shortcode('sidebar', 'cp_widget_bar_shortcode');
	add_shortcode('map', 'cp_map_shortcode');
	add_shortcode('person', 'cp_person_shortcode');
	add_shortcode('testimonials', 'cp_testimonials_shortcode');
	add_shortcode('testimonial', 'cp_testi_shortcode');
	add_shortcode('counter_circle', 'cp_progress_shortcode');
	add_shortcode('progress_bar', 'cp_progress_bar_shortcode');			
	add_shortcode('blog', 'cp_blog_shortcode');
	add_shortcode('fullwidth', 'cp_fullwidth_shortcode');
	add_shortcode('flexslider', 'cp_flexslider_shortcode');
	//New Membership Button
	add_shortcode('membership_button', 'cp_membership_shortcode');
	//donation shortcode
	add_shortcode('cp_donation', 'cp_donation_shortcode');
	//Product Category shortcode
	add_shortcode('show_category', 'cp_show_category_shortcode');
	//Product BX Slider shortcode
	add_shortcode('product_BX', 'cp_product_bx_shortcode');

	add_shortcode('lightbox', 'cp_lightbox_shortcode');
	add_shortcode('3dbutton', 'cp_3dbutton_shortcode');			
	add_shortcode('soundcloud', 'cp_soundcloud_shortcode');		
	add_shortcode('content_box', 'cp_content_box_shortcode');	
	add_shortcode('pricing_table', 'cp_pricing_table_shortcode');
	add_shortcode('pricing_header', 'cp_pricing_header_shortcode');
	add_shortcode('pricing_price', 'cp_pricing_price_shortcode');
	add_shortcode('pricing_column', 'cp_pricing_column_shortcode');
	add_shortcode('pricing_row', 'cp_pricing_row_shortcode');
	add_shortcode('pricing_footer', 'cp_pricing_footer_shortcode');
	add_shortcode('title', 'cp_title_shortcode');
	add_shortcode('button', 'cp_buttons_shortcode');
	add_shortcode('metro_button', 'cp_metro_shortcode');
	add_shortcode('counters_circle', 'cp_counters_circle_shortcode');
	add_shortcode('iconset', 'cp_iconset_shortcode');
	add_shortcode('services', 'cp_services_shortcode');
	add_shortcode('imageframe', 'cp_imageframe_shortcode');
	add_shortcode('separator', 'cp_separator_shortcode');
	add_shortcode('tooltip', 'cp_tooltip_shortcode');
	add_shortcode('recent_projects', 'cp_recent_projects_shortcode');
	add_shortcode('products_slider', 'cp_products_slider_shortcode');			
	add_shortcode('images', 'cp_images_shortcode');
	add_shortcode('fontawesome', 'cp_fontawesome_shortcode');
	add_shortcode('text', 'cp_text_shortcode');
	add_shortcode('highlight', 'cp_highlight_shortcode');
	add_shortcode('event_counter', 'cp_event_counter_shortcode');
	add_shortcode('event_counter_box', 'cp_event_counter_box_shortcode');
	// New Project Facts shortcode
	add_shortcode('project_facts', 'cp_project_facts_shortcode');
	
	add_shortcode('checklist', 'cp_checklist_shortcode');
	add_shortcode('recent_posts', 'cp_recent_post_shortcode');
	add_filter('the_content', 'fix_shortcodes');
	
	
	
	function fix_shortcodes($content){   
		$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
	
	//Code HighLighter
	function cp_code_shortcode($atts, $content = null)
	{
	
		$hilighter = "<div class='cp-code'>";
		$hilighter = $hilighter . $content;
		$hilighter = $hilighter . "</div>";
		return $hilighter;
	}

	// ............Project Facts ShortCode Start................
	function cp_project_facts_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'icon' => '',
			'count' => '',
			'text' => '',				
		), $atts));
		
		$counter = rand();
		
		wp_register_script('cp-counter', CP_PATH_URL.'/frontend/shortcodes/js/jquery.counterup.min.js', false, '1.0', true);
		wp_enqueue_script('cp-counter');	
		?>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> 

		<script>
		jQuery(document).ready(function($) {
			"use strict";
				if ($('.counter-<?php echo esc_js($counter); ?>').length) {
						$('.counter-<?php echo esc_js($counter); ?>').counterUp({
						delay: 10,
						time: 1000
					});
				}
		});
		
		</script>		
		<?php				
		//HTML Markup
		 $html = '<div class="fact-box"> 
					<i class="fa '.$icon.'"></i> 
					<strong class="number counter-'.$counter.'">'.$count.'</strong> 
					<a href="#">'.$text.'</a> 
				</div>';
		
		// $html = '
		// <div class="about-fact">
			// <div class="fact-box">
				// <i class="fa '.$icon.'"></i>
				// <span>
					// '.$count.'
				// </span>
				// <a href="#">'.$text.'</a>
			// </div>
		// </div>
		// ';
		
		return $html;
	
	}
	
	//Salat Times Shortcode
	function cp_salat_times ($atts,$content = null){
	
		
			echo do_shortcode('[daily_salat_times]');
	
	
	}
	
	function cp_donation_shortcode($atts,$content = null){
		$donation_button = cp_get_themeoption_value('donation_button','general_settings');
		$donate_btn_text = cp_get_themeoption_value('donate_btn_text','general_settings');
		$donation_page_id = cp_get_themeoption_value('donation_page_id','general_settings');
		$donate_email_id = cp_get_themeoption_value('donate_email_id','general_settings');
		$donate_title = cp_get_themeoption_value('donate_title','general_settings');
		$donation_currency = cp_get_themeoption_value('donation_currency','general_settings');
		
		// <input type="hidden" name="src" value="1" />
		// <input type="hidden" name="sra" value="1" />
		// <input type="hidden" name="p3" value="1" />
		// <input type="hidden" name="t3" value="M" />			
		
		$html_shortcode = '';
		
		$html_shortcode .= '
		<section class="donate-page">
			<div class="donate-form">
			  <form action="https://www.paypal.com/cgi-bin/webscr" class="donate-form-area">
					<input type="hidden" name="cmd" value="_donations" />
					<input type="hidden" name="business" value="'.$donate_email_id.'" />
					<input type="hidden" name="item_name" value="'.$donate_title.'" />
					<input type="hidden" name="return" value="' .get_permalink($donation_page_id). '" />
					<input type="hidden" name="bn" value="Subscribe" />
									
				<h4>'.__("Select Amount","crunchpress").'</h4>        
				<ul>
					
					<li>
						<input type="radio" class="radio" name="amount" id="radio_1" value="5" />
						<label for="radio_1">					
							<span class="show">5</span>
							<span class="show-hover">5</span>
						</label>
					</li>
					<li>
						<input type="radio" class="radio" name="amount" id="radio_2" value="10" />
						<label for="radio_2">					
							<span class="show">10</span>
							<span class="show-hover">10</span>
						</label>
					</li>
					<li>
						<input type="radio" class="radio" name="amount" id="radio_3" value="15" />
						<label for="radio_3">					
							<span class="show">15</span>
							<span class="show-hover">15</span>
						</label>
					</li>
					<li>
						<input type="radio" class="radio" name="amount" id="radio_4" value="18" />
						<label for="radio_4">					
							<span class="show">18</span>
							<span class="show-hover">18</span>
						</label>
					</li>
					<li>
						<input type="radio" class="radio" name="amount" id="radio_5" value="20" />
						<label for="radio_5">					
							<span class="show">20</span>
							<span class="show-hover">20</span>
						</label>
					</li>
					<li>
						<input type="radio" class="radio" name="amount" id="radio_6" value="25" />
						<label for="radio_6">					
							<span class="show">25</span>
							<span class="show-hover">25</span>
						</label>
					</li>
					<li>
						<input type="radio" class="radio" name="amount" id="radio_7" value="30" />
						<label for="radio_7">					
							<span class="show">30</span>
							<span class="show-hover">30</span>
						</label>
					</li>
					<li>
						<input type="radio" class="radio" name="amount" id="radio_8" value="35" />
						<label for="radio_8">					
							<span class="show">35</span>
							<span class="show-hover">35</span>
						</label>
					</li>
				</ul>
				<h3>'.__("OR","crunchpress").'</h3>
				<ul>
					<li>
						<label>'.__("Other Amount","crunchpress").'</label>
						<input name="amount" type="text" class="donate-input" placeholder="Enter Amount">
					</li>
					<li>
						<div>
						  <label for="currency">'.__("Change Currency Type","crunchpress").'</label>
						  <select id="currency" name="currency_code">';
								$options = array(
									'AUD' => 'Australian Dollars (A $)',
									'BRL' => 'Brazilian Real',
									'CAD' => 'Canadian Dollars (C $)',
									'CZK' => 'Czech Koruna',
									'DKK' => 'Danish Krone',
									'EUR' => 'Euros (&euro;)',
									'HKD' => 'Hong Kong Dollar ($)',
									'HUF' => 'Hungarian Forint',
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
							foreach($options as $k=>$val){
								$condition = ($k == $donation_currency)? 'selected' : '';
								$html_shortcode .= '<option '.$condition.' value="'.$k.'">'.$val.'</option>';
							}
						$html_shortcode .= '</select>
						</div>
					</li>
				</ul>
				<input name="submit" type="submit" value="'.__("continue","crunchpress").'" class="donate-btn-submit">
			</form>
		</div>
	</section>';
	return $html_shortcode;
	}
	
	function cp_project_slider($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(			
			'cat_id' => '0',
			'order' => 'desc',						'num_fetch' => '3',
		), $atts));
		
		static $counter_fund_id = 1;
		$counter_fund_id++;
		
		query_posts(array(
			'posts_per_page'=> $num_fetch,
			'post_type'   	=> 'ignition_product',
			'post_status'	=> 'publish',
			'order'			=> $order,
		));
		if(have_posts()){
			
			
		// Only For Islamic Version
		$bg_value_slide = cp_get_themeoption_value('slide_bg_islamic','general_settings');
		
		if ($bg_value_slide == 'enable'){
			$slider_bg_islamic_version_slide = 'islamic-banner';
		}else {
			$slider_bg_islamic_version_slide = '';
		}
	
			echo '	
			<!--Banner Start-->
			  <div id="banner" class = "'.$slider_bg_islamic_version_slide.'">
				<div class="container">
				  <div class="row">
					<div class="col-md-12">';
					  
					  //Calling the Script and required files
						wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
						wp_enqueue_script('cp-bx-slider');	
						wp_register_script('cp-fitvids-slider', CP_PATH_URL.'/frontend/shortcodes/js/jquery.fitvids.js', false, '1.0', true);
						wp_enqueue_script('cp-fitvids-slider');	
						
						wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
						echo '<script type="text/javascript">jQuery(document).ready(function ($) { $("#slider-'.$counter_fund_id.'").bxSlider({adaptiveHeight:true});});</script>
						<ul id="slider-'.$counter_fund_id.'">';
						while( have_posts() ){
							the_post();	
							global $counter,$post;
							$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
							$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
							
							$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);
							
							$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
							
							$ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);
							
							$thumbnail_id = get_post_thumbnail_id( $post->ID, 'ign_project_id', true );
			
							
							
							$getPledge_cp = getPledge_cp($ign_project_id);
							$current_date = date('d-m-Y h:i:s');
							$project_date = new DateTime($ignition_datee);
							$current = new DateTime($current_date);
							$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));
							$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(1600,900) );
							$ign_project_description = get_post_meta( $post->ID, "ign_project_description", true );					
						echo '
							<li class="cp-img-short">
								<img src="'.esc_url($thumbnail[0]).'" alt="img">
								<div class="banner-caption">
									<div class="banner-heading"><strong>'.esc_attr__('Featured','mosque_crunchpress').'</strong></div>
									<strong class="title">'.esc_attr(substr(get_the_title(),0,25)).'</strong>
									<p>'.substr(get_the_content(),0,159).'... <a href="'.esc_url(get_permalink()).'">[+]</a></p>
									<ul>
										<li>Goals: $'.esc_attr($ign_fund_goal).'</li>
										<li>Raised: $'.esc_attr(getPercentRaised_cp($ign_project_id)).'</li>
										<li>Donors: '.esc_attr($getPledge_cp[0]->p_number).'</li>
									</ul>
									<a href="'.esc_url(get_permalink()).'" class="donate">'.esc_attr__('Donate','mosque_crunchpress').'</a>
								</div>
							</li>';
						} wp_reset_postdata();
						echo '
					  </ul>
					</div>
				  </div>
				</div>
			  </div>
			  <!--Banner End-->';
		} //End Condition Check 
		wp_reset_query();
	}
	
	//
	function cp_newspost_slider($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(			
			'cat_id' => '0',
			'num_fetch' => '3',
			'order' => 'desc',						
			
		), $atts));
		
		global $counter;
		
		query_posts(array(
			'posts_per_page'=> $num_fetch,
			'post_type'   	=> 'post',
			'post_status'	=> 'publish',
			'cat'			=>  $cat_id,
			'order'			=> $order,
		));
		
		if(have_posts()){
			echo '	
			<section class="blog-detail news-page">			
				<div class="news-frame">';

					  //Calling the Script and required files
						wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
						wp_enqueue_script('cp-bx-slider');	
						wp_register_script('cp-fitvids-slider', CP_PATH_URL.'/frontend/shortcodes/js/jquery.fitvids.js', false, '1.0', true);
						wp_enqueue_script('cp-fitvids-slider');	
						wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
						
						echo '<script type="text/javascript">jQuery(document).ready(function ($) { $("#news-slider-'.$counter.'").bxSlider({auto: true, controls:true, pager:false});});</script>
					
						<ul id="news-slider-'.$counter.'">';
						
						while( have_posts() ){
							the_post();	
							global $counter,$post;
							$comment_count = wp_count_comments($post->ID);
							echo '<li> '.get_the_post_thumbnail($post->ID, array(1600,900)).'
									  <div class="caption">
										<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
										<div class="detail-row">
										  <ul>
											<li><a href="'.get_the_permalink().'"><i class="fa fa-calendar"></i>'.get_the_date().'</a></li>
											<li><a href="'.get_the_permalink().'"><i class="fa fa-comments-o"></i>'.$comment_count->total_comments.'</a></li>
											<li><a href="'.get_the_permalink().'"><i class="fa fa-heart-o"></i>'.get_post_meta($post->ID,'popular_post_views_count',true).'</a></li>
										  </ul>
										</div>
									  </div>
									</li>';
						} wp_reset_postdata();
						echo '
					</ul>
				</div>
			</section> ';
		} //End Condition Check 
		wp_reset_query();
	}
	
	//Membership Button
	function cp_membership_shortcode($atts,$content = null){
		//Counter
	
		//Fetch Parameters
		extract(shortcode_atts(array(
			'icon' => '',
			'icon_bg_color' => '',
			'textcolor' => '',
			'text_bg_color' => '',
			'link' => '',
			'border_color' => '',
			
			
		), $atts));
		
		static $counter_membership = 1;
		$counter_membership++;
		$html = '';
		
		//$html = '<a style="background-color:'.$backgroundcolor.';color:'.$color.'">'.do_shortcode($content).'</a>';
		if($border_color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$border_color = $color_scheme;
		}
		if($icon_bg_color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$icon_bg_color = $color_scheme;
		}
		if($text_bg_color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$text_bg_color = $color_scheme;
		}
		//HTML Markup
		$html = '
		<div class="sidebar-member">
		<a style="background-color:'.$icon_bg_color.'; border-bottom: 3px solid '.$border_color.';" href="'.$link.'" class="member-icon">
			<i class="fa '.$icon.'"></i>
		</a>
		<a style="background-color:'.$text_bg_color.'; color:'.$textcolor.'; border-bottom: 3px solid '.$border_color.'!important;" href="'.$link.'" class="member-text curl-top-left">'.$content.'</a>
		</div>';
		
		return $html;
	
	}
	
	
	//Product Category Shortcode
	function cp_show_category_shortcode($atts,$content = null){

		//Fetch Parameters
		extract(shortcode_atts(array(
			'title' => '',
			'caption' => '',
			'link' => '',
			'btn_text' => '',
			'image_url' => '',

		), $atts));

		$html = '';
		
		//HTML Markup
		$html = '
		<div class="feature-banners">
            <div class="thumb">
				<div class="thumb-caption"> <strong>'.$caption.'</strong>
					<h3>'.$title.'</h3>
					<p>'.$content.'</p>
					<a href="'.$link.'">'.$btn_text.'</a>
				</div>
                <img src="'.$image_url.'" alt="'.$title.'">			
			</div>
        </div>';
		
		return $html;
	}
	 
	//Product BX Slider Shortcode
	function cp_product_bx_shortcode($atts,$content = null){

		//Fetch Parameters
		extract(shortcode_atts(array(
			'title' => '',
			'gallery_id' => '',
		), $atts));
		
		$counter_images = 0;
		$counter_images++;
		$html = '';
		
		//Register Scripts for BX Slider
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
		
		$html .= '
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$(".ad-slider").bxSlider({mode: "horizontal", pager:"true", controls:"false", auto:"true",});});
		</script>';

		if($gallery_id <> ''){
				$slider_xml_string = get_post_meta($gallery_id,'post-option-gallery-xml', true);
				//print_r($slider_xml_string);
				$slider_xml_dom = new DOMDocument();
				if( !empty( $slider_xml_string ) ){
					$slider_xml_dom->loadXML($slider_xml_string);					
						$children = $slider_xml_dom->documentElement->childNodes;
						$length = $slider_xml_dom->documentElement->childNodes->length;
						//Getting Values in Variables
						$html .=  '<div class="ad-banner"><ul class="ad-slider">';
						for($i=0;$i<$length;$i++) { 
							$thumbnail_id = cp_find_xml_value($children->item($i), 'image');
							$title = cp_find_xml_value($children->item($i), 'title');
							$caption = cp_find_xml_value($children->item($i), 'caption');
							$link_type = cp_find_xml_value($children->item($i), 'linktype');
							$video = cp_find_xml_value($children->item($i), 'video');
							$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
							//Images
							$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(570,300));
							$link = cp_find_xml_value( $children->item($i), 'link');
							
							$html .= '<li><span><strong>'.$title.'</strong><br>'.$caption.'</span><img class ="slider_image" src="'.$image_thumb[0].'" alt="" /></li>';
          
						}
					$html .= '</ul></div>';	
				}
			}

		return $html;
	}
	
	// Project Facts ShortCode Ends
	
	function cp_separator_shortcode($atts,$content = null){
		extract(shortcode_atts(array(
			'style' => '',
			'size' => '1px',
			'margin_top_bottom' => '',
			'color' => '',
			
		), $atts));
		if($color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$color = $color_scheme;
		}
		return '<div class="cp-separator" style="clear:both;width:100%;display:inline-block;margin:'.$margin_top_bottom.' 0px;border:'.$size.' '.$style.' '.$color.'"></div>';
	}
	
	function cp_heading_shortcode($atts,$content = null){
		extract(shortcode_atts(array(
			'align' => '',
			'title' => '',
			'title_color' => '',
			'style' => '',
			'desc_color' => '',
			'description' => '',						
			'tag' => 'h2',
			
		), $atts));
		
		$heading_html = '';
		if($title_color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$title_color = $color_scheme;
		}
		if($desc_color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$desc_color = $color_scheme;
		}
		
		if($style == 'simple-heading'){
			$heading_html = '
			<div class="cp-heading-container" style="text-align:'.$align.'">
				<div class="heading-style-1">
				   <'.$tag.' style="color:'.$title_color.'">'.do_shortcode(html_entity_decode($title)).'</'.$tag.'>
				</div>
				<p style="color:'.$desc_color.'">'.$description.'</p>
			</div>';
		}else if($style == 'eco-heading'){
		$heading_html = '
			<div class="cp-heading-container" style="text-align:'.$align.'">
				<div class="heading-style-5"> 
				  <h2 style="color:'.$title_color.'">'.do_shortcode(html_entity_decode($title)).'</h2>
				</div>
				<p style="color:'.$desc_color.'">'.$description.'</p>
			</div>';
		}else if($style == 'islamic-heading'){
		$heading_html = '
			<div class="cp-heading-container" style="text-align:'.$align.'">
				<div class="heading-style-4">
				 <h2 style="color:'.$title_color.'">'.do_shortcode(html_entity_decode($title)).'</h2>
				</div>
				<p style="color:'.$desc_color.'">'.$description.'</p>
			</div>';
		}else if($style == 'church-heading'){
			$heading_html = '
			<div class="cp-heading-container" style="text-align:'.$align.'">
			<div class="heading-style-3" style="text-align:'.$align.'">
			  <h2 style="color:'.$title_color.'">'.do_shortcode(html_entity_decode($title)).'</h2>
			  <ul>
				<li class="bullet-1"></li>
				<li class="bullet-2"></li>
				<li class="bullet-3"></li>
				<li class="bullet-2"></li>
				<li class="bullet-1"></li>
			  </ul>
			</div>
			<p style="color:'.$desc_color.'">'.$description.'</p>
			</div>
			';
		}else if($style == 'politics-heading'){
		$heading_html = '
			<div class="cp-heading-container" style="text-align:'.$align.'">
				<div class="heading-style-2">
				  <h2 style="color:'.$title_color.'">'.do_shortcode(html_entity_decode($title)).'</h2>
				</div>
				<p style="color:'.$desc_color.'">'.$description.'</p>
			</div>	';
		}else if($style == 'store-heading'){
			$heading_html = '
			<div class="cp-heading-container" style="text-align:'.$align.'">
				<div class="heading-style-7">
				  <h2 style="color:'.$title_color.'">'.do_shortcode(html_entity_decode($title)).'</h2>
				</div>';
				if(!empty($description)){
					$heading_html .= '<p style="color:'.$desc_color.'">'.$description.'</p>';
				}
			$heading_html .= '</div>';
		}else{
		
		}
		
		return $heading_html;
	
	}
	
	//event counter
	function cp_event_counter_shortcode($atts,$content = null){
		$event_html = '';
		static $event_counter = 1;
		$event_counter++;
		extract(shortcode_atts(array(
			'title' => '',
			'event_id' => '',			
			'animation' => 'ticks',
			'color' => '#ffffff',
			'unfilled_color' => '#FFFFFF',
			'filled_color' => '#99CCFF',
			'width' => '500px',
			'height' => '150px',
			'circle_width_filled' => '1.2px',
			'circle_width_unfilled' => '0.1px',
			
		), $atts));
		
		if($color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$color = $color_scheme;
		}
		if($unfilled_color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$unfilled_color = $color_scheme;
		}
		if($filled_color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$filled_color = $color_scheme;
		}
		
		//Select Single Events
		if(class_exists('EM_Events')){
			wp_register_script('cp-timecircles', CP_PATH_URL.'/frontend/shortcodes/js/timecircles.js', false, '1.0', true);
			wp_enqueue_script('cp-timecircles');
			wp_enqueue_style('cp-timecircles',CP_PATH_URL.'/frontend/shortcodes/css/timecircles.css');
			$order = 'DESC';
			$limit = 5;//Default limit
			$offset = '';
			$rowno = 0;
			$event_count = 0;
			if($event_id <> ''){
				$EM_Event = em_get_event($event_id,'post_id');
				//print_r($EM_Event);
				if(isset($EM_Event)){
					$style = "";
					$today = date ( "Y-m-d" );
					//$location_summary = "<b>" . $EM_Event->get_location()->name . "</b> - " . $EM_Event->get_location()->address;
					//echo $event->start;
					$event_month_alpha = date('M',$EM_Event->start);
					$event_day = date('d',$EM_Event->start);					
					
					
					//Get Date in Parts
					$event_year = date('Y',$EM_Event->start);
					$event_month = date('m',$EM_Event->start);
					$event_month_alpha = date('M',$EM_Event->start);
					$event_day = date('d',$EM_Event->start);
					
					// $hour = date('H',$EM_Event->start_time);
					// $min = date('i',$EM_Event->start_time);
					// $sec = date('s',$EM_Event->start_time);
					$month = date('m',$EM_Event->start);
					$day = date('d',$EM_Event->start);
					$year = date('Y',$EM_Event->start);

					$start_date_time = date ( "Y-m-d", $EM_Event->start);
					
					$hour_current = date('H');
					$min_current = date('i');
					$sec_current = date('s');
					$month_current = date('m');
					$day_current = date('d');
					$year_current = date('Y');

					//$start_date_time = mktime($hour, $min, $sec, $month, $day, $year);
					
					//$current = mktime();
					if($today < $start_date_time){
						$event_html = '<div class="circle-time"><script>jQuery(document).ready(function($){  
						$("#countdown-'.$event_counter.'").TimeCircles({
							"animation": "'.$animation.'",
							"bg_width": "'.$circle_width_filled.'",
							"fg_width": "'.$circle_width_unfilled.'",
							"circle_bg_color": "'.$unfilled_color.'",
							"time": {
								"Days": {
									
									"text": "'.__('Days','mosque_crunchpress').'",
									"color": "'.$filled_color.'",
									"show": true
								},
								"Hours": {					
									"text": "'.__('Hours','mosque_crunchpress').'",
									"color": "'.$filled_color.'",
									"show": true
								},
								"Minutes": {
									"text": "'.__('Minutes','mosque_crunchpress').'",
									"color": "'.$filled_color.'",
									"show": true
								},
								"Seconds": {					
									"text": "'.__('Seconds','mosque_crunchpress').'",
									"color": "'.$filled_color.'",
									"show": true
								}
							}
						}); });</script>
						<div class="event-timer">
							<div id="countdown-'.$event_counter.'" data-date="'.$year.'-'.$month.'-'.$day.' 00:00:00" style="width: '.$width.'px; height: '.$height.'px; padding: 0px; box-sizing: border-box;color:'.$color.';"></div>
						</div></div>';											
					}else{
						$event_html = '<h5>There is no upcoming event in current date to show.</h5>';
					}	
				}
			}	
		}
		
		return $event_html;
	
	}
	
	//CountDown Boxed
	function cp_event_counter_box_shortcode($atts,$content = null){
		//Fetch parameters
		extract(shortcode_atts(array(
			'event_id' => '',
			
		), $atts));
		$rowno = '';
		$limit = '';
		$event_count = '';
		$offset = '';
		$counter = '';
		$event_counter_html = '';
		
		static $event_counter_box = 1;
		$event_counter_box++;
		
		
		//Select Single Events
		if(class_exists('EM_Events')){
		
			$EM_Event = em_get_event($event_id,'post_id');
			
			if( ($rowno < $limit || empty($limit)) && ($event_count >= $offset || $offset === 0) ) {
				$rowno++;
				$class = ($rowno % 2) ? 'alternate' : '';
				// FIXME set to american
				$localised_start_date = date_i18n(get_option('dbem_date_format'), $EM_Event->start);
				$localised_end_date = date_i18n(get_option('dbem_date_format'), $EM_Event->end);
				
				$style = "";
				$today = date ( "Y-m-d" );
				
				
				if ($EM_Event->start_date < $today && $EM_Event->end_date < $today){
					$class .= " past";
				}
				//Check pending approval events
				if ( !$EM_Event->status ){
					$class .= " pending";
				}	
				//echo $event->start;
				$event_month_alpha = date('M',$EM_Event->start);
				$event_day = date('d',$EM_Event->start);
				$event_element_id = $counter.$EM_Event->event_id;
				
				
				//Get Date in Parts
				// $event_year = date('Y',$EM_Event->start);
				// $event_month = date('m',$EM_Event->start);
				// $event_month_alpha = date('M',$EM_Event->start);
				// $event_day = date('d',$EM_Event->start);
				
				//Change time format
				//$event_start_time =  date('g,i,s',$EM_Event->start_time);		

				$hour = date('H',intval($EM_Event->start_time));
				$min = date('i',intval($EM_Event->start_time));
				$sec = date('s',intval($EM_Event->start_time));
				$month = date('m',intval($EM_Event->start));
				$day = date('d',intval($EM_Event->start));
				$year = date('Y',intval($EM_Event->start));		


				$hour_end = date('H',intval($EM_Event->end_time));
				$min_end = date('i',intval($EM_Event->end_time));
				$sec_end = date('s',intval($EM_Event->end_time));
				$month_end = date('m',intval($EM_Event->end));
				$day_end = date('d',intval($EM_Event->end));
				$year_end = date('Y',intval($EM_Event->end));

				wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/shortcodes/js/jquery_countdown.js', false, '1.0', true);
				wp_enqueue_script('cp-countdown'); 
				wp_enqueue_style('cp-countdown',CP_PATH_URL.'/frontend/shortcodes/css/jquery_countdown.css');
		
				$event_counter_html = '<div class="counter-box"><script>
					jQuery(function () {
						var austDay = new Date();
						austDay = new Date('.$year.', '.$month.'-1, '.$day.','.$hour.','.$min.');
						jQuery("#countdown-box-'.$event_counter_box.'").countdown({
						labels: ["'. __('Years','mosque_crunchpress').'", "'. __("Months","crunchpress").'", "'. __("Weeks","crunchpress").'", "'. __("Days","crunchpress").'", "'. __("Hours","crunchpress").'", "'. __("Minutes","crunchpress").'", "'. __("Seconds","crunchpress").'"],
						until: austDay
						});
						jQuery("#year").text(austDay.getFullYear());
					});                
				</script>
				<div id="countdown-box-'.$event_counter_box.'"></div></div>
				';										
					
			}
		}
	
	return $event_counter_html;
	
	}
	
	//Full width shortcode start
	function cp_fullwidth_shortcode($atts,$content = null){
		//Fetch parameters
		extract(shortcode_atts(array(
			'color' => '',
			'textalign' => '',
			'backgroundcolor' => '',
			'backgroundimage' => '',
			'backgroundrepeat' => '',
			'backgroundposition' => '',
			'backgroundattachment' => '',
			'bordersize' => '',
			'bordercolor' => '',
			'paddingtop' => '',
			'paddingbottom' => '',
			
		), $atts));
		if($backgroundcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$backgroundcolor = $color_scheme;
		}
		if($color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$color = $color_scheme;
		}
		// HTML for Full width shortcode
		return '<div style="float:left;width:100%;padding-top:'.$paddingtop.';text-align:'.$textalign.';padding-bottom:'.$paddingbottom.';background-repeat:'.$backgroundrepeat.';background-color:'.$backgroundcolor.';background-image:url('.$backgroundimage.');background-attachment:'.$backgroundattachment.';background-position:'.$backgroundposition.';color:'.$color.'" class="full-width"><div class="container">'.do_shortcode($content).'</div></div>';
	
	}
	// Iconset shortcode start
	function cp_iconset_shortcode($atts,$content = null){
			//HTML Markup
			return '<div class="ic-boxes">
				'.do_shortcode($content).'
			</div>';
	}
	
	//Image Frame ShortCode Start
	function cp_imageframe_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'style' => '',
			'bordercolor' => '',
			'bordersize' => '',
			'stylecolor' => '',			
			'align' => '',
			
		), $atts));
		// HTML Markup
		return '<div style="border:" class="imageframe">'.do_shortcode($content).'</div>';
	
	}
	//Checklist ShortCode Start
	function cp_checklist_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'icon' => 'check',
			'iconcolor' => '',		
		), $atts));
				
		$icon_aw = get_fontawesome_code($icon);
		if($iconcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$iconcolor = $color_scheme;
		}
		// Counter for checklist
		static $counter_checklist = 1;
		$counter_checklist++;		
		//HTML Markup
		return '<div class="list-cp-fw"><style scoped>.list-style-cp-'.$counter_checklist.' li:before{color:'.$iconcolor.'; content:"'.$icon_aw.'"}</style><div class="list-style-cp-'.$counter_checklist.' list-style cp-list-style">
		'.$content.'
		</div></div>';
	
	}
	// Services ShortCode Start ingenio
	function cp_services_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'layout' => '',
			'icon' => '',
			'title' => '',
			'excerpt_words' => '',			
			'link' => '',
			'linktext' => '',
			'service_class' => '',
			
		), $atts));
		
		$html = '';
		//HTML Markup
		$excerpt_words = '100';
		
		if ($layout == 'circle-icon-top'){
			$html = '<div class="our-services services-style-2">
			<div class="services-box circle-icon-top '.$layout.'">
				<div class="fa-icon-box"><i class="fa '.$icon.'"></i></div>
				<div class="text-box">
					<h3><a href="'.$link.'">'.$title.'</a></h3>
					<p>'.substr($content , 0 , $excerpt_words).'</p>
					<a class="btn-8" href="'.$link.'">'.$linktext.'</a>
				</div>
			</div>
			</div>
			';

		}else if($layout == 'circle-icon-left'){
			
			if($service_class == 'service1'){
				
				$custom_service_class = "service_1";
				$custom_service_class_2 = '';
				
			}else{
				
				$custom_service_class = "service_2";
				$custom_service_class_2 = 'typo_service_2';
			}
			
			$html = '<div class="more-services">
			<div class="">
				<div class="round-box '.$custom_service_class.'"><i class="fa '.$icon.'"></i></div>
				<div class="text-box pull-left '.$custom_service_class_2.'">
					<h3><a href="'.$link.'">'.$title.'</a></h3>
					<p>'.$content.'</p>
				</div>
			</div>
			</div>
			';
		}else if($layout == 'circle-icon-right'){
			$html = '
			<div class="more-services">
				<div class="service-icon-right '.$layout.'">
					<div class="icon-box"><i class="fa '.$icon.'"></i></div>
					<div class="text-box">
						<h3><a href="'.$link.'">'.$title.'</a></h3>
						<p>'.$content.'</p>
					</div>
				</div>
			</div>';
		}else if($layout == 'box-icon-top'){
			$html = '
			<div class="features-2-box">
				<div class="service-box-icon-top">
					<div class="icon-box"><a href="'.$link.'"><i class="fa '.$icon.'"></i></a></div>
					<h3><a href="'.$link.'">'.$title.'</a></h3>
					<p>'.$content.'</p>
					<a class="btn-more" href="'.$link.'">'.$linktext.'</a>
				</div>
			</div>';
		}else if($layout == 'box-icon-right'){
			$html = '			
			<div class="service-icon-right '.$layout.'">
				<div class="icon-box"><i class="fa '.$icon.'"></i></div>
				<div class="text-area">
					<h3>'.$title.'</h3>
					<p>'.$content.'</p>
				</div>
			</div>			
			';
		}else if($layout == 'icon-right'){
			$html = '
			<div class="features-box">
				<div class="icon-box"><i class="fa '.$icon.'"></i></div>
				<div class="text-box">
					<h2>'.$title.'</h2>
					<p>'.$content.'</p>
				</div>
			</div>';
		}else if($layout == 'top-icon-box-outside'){
			$html = '
			<div class="features-2-box">
				<div class="icon-box">
					<a href="'.$link.'"><i class="fa '.$icon.'"></i></a>
				</div>
				<h3><a href="'.$link.'">'.$title.'</a></h3>
				<p>'.$content.'</p>
				<a class="btn-more" href="'.$link.'">'.$linktext.'</a>
			</div>';
		}else if($layout == 'top-icon-box-outside'){
		$html = '<div class="eco-features-box">
			<div class="frame">
				<a href="'.$link.'"><img alt="img" src="images/features/eco-features-img-2.jpg"></a>
				<div class="eco-icon"><a href="'.$link.'"><i class="fa fa-recycle"></i></a></div>
			</div>
			<div class="text-box">
				<h3><a href="'.$link.'">'.$title.'</a></h3>
				<p>'.$content.'</p>
				<a class="btn-5" href="'.$link.'">'.$linktext.'<i class="fa fa-arrow-right"></i></a>
			</div>
		</div>';
		}else{
			$html = '
				<div class="features-section">
					<div class="inner-box">
						<div class="icon-box"><a href="'.$link.'"><i class="fa '.$icon.'"></i></a></div>
						<h3>'.$title.'</h3>
						<p>'.$content.'</p>
						<a class="btn-8" href="'.$link.'">'.$linktext.'<i class="fa fa-arrow-right"></i></a>
					</div>
				</div>
				';
		}
		return $html;
	
	}
	//'shortcode'=> '[recent_projects title="{{title}}" image_url="{{image_url}}" ][/recent_projects]',
	//Recent Projects ShortCode Start
	function cp_recent_projects_shortcode($atts,$content = null){
		// Fetch Parameters
		global $cp_work_array,$counter;
		$cp_work_array = array();
		do_shortcode($content);
		$num = sizeOf($cp_work_array);
		//Counter
		static $counter_port = 1;
		$counter_port++;
		$html_port = '';
		// Js Script For Portfolio
		$html_port .= '<div class="cp_product_slider">';
				$html_port .= '<script type="text/javascript">
					jQuery(document).ready(function($) {
						if ($("#bxslider-'.$counter_port.'").length) {
							$("#bxslider-'.$counter_port.'").bxSlider({
								minSlides: 3,
								maxSlides: 4,
								slideWidth: 490,
								slideMargin: 0
							});
						}
					});
				</script>';
				wp_enqueue_script('cp-bx-slider');	
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
				
				$html_port .= '<ul class="our-project-slider imglist group" id="bxslider-'.$counter_port.'">';
        
					for ($i = 0; $i < $num; $i++) {
						$html_port .= '
						<li> <a href="'.$cp_work_array[$i]["link"].'"><img class="gs" src="'.$cp_work_array[$i]["image_url"].'" alt="img" /></a>
							<div class="caption"><a href="'.$cp_work_array[$i]["link"].'">'.$cp_work_array[$i]["title"].'</a></div>
						</li>';
						
					}
					
				$html_port .= '</ul>';
			$html_port .= '</div>';
			
		
		return $html_port;
	}
	//Product Slider ShortCode Start
	function cp_products_slider_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'cat_id' => '',
			'number_posts' => '',			
			'show_price' => '',
			'show_buttons' => '',			
			
		), $atts));
		//Counter For Product
		static $counter_product = 1;
		$counter_product++;
		//Calling Required Files
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
		$html_product = '<script type="text/javascript">jQuery(document).ready(function ($) { $("#product-'.$counter_product.'").bxSlider({minSlides: 3,maxSlides: 4,  slideWidth: 285,slideMargin: 10});});</script>';
		// HTML Markup
		$html_product .= '<section class="product_view" id="product_grid">  
						<ul id="product-'.$counter_product.'" class="row-fluid grid-list-view product_image_holder grid-style">';
                
			// If Empty
			query_posts(array( 
				'post_type' => 'product',
				'showposts' => $number_posts,
				'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'terms' => $cat_id,
						'field' => 'term_id',
					)
				),
				'orderby' => 'title',
				'order' => 'ASC' )
			);
			//Team Counter
			$counter_team = 0; 
			while( have_posts() ){
				the_post();
				global $post;
				//Permalink Structure
					global $post,$post_id,$product,$product_url,$woocommerce;
					$permalink_structure = get_option('permalink_structure');
					if($permalink_structure <> ''){
						$permalink_structure = '?';
					}else{
						$permalink_structure = '&';
					}// Pricing Structure
					$regular_price = get_post_meta($post->ID, '_regular_price', true);
					if($regular_price == ''){
						$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
					}
					$sale_price = get_post_meta($post->ID, '_sale_price', true);
					$sku_num = get_post_meta($post->ID, '_sku', true);
					
					if($sale_price == ''){
						$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
					}
					$currency = get_woocommerce_currency_symbol();
					//Show Buttons
					if($show_buttons == 'yes'){
						$show_button = '
						<a href="#" class="basket"><form enctype="multipart/form-data" method="post" class="cart" action="'.get_permalink().$permalink_structure.'add-to-cart='.$post->ID.'">
							<!--<div class="quantity buttons_added"><input type="button" class="minus" value="-">
							<input type="number" class="input-text qty text" title="Qty" value="1" name="quantity" step="1">
							<input type="button" class="plus" value="+"></div>-->
							<button class="add_to_cart_button button product_type_simple added" data-quantity="1" data-product_sku="'.$sku_num.'" data-product_id="'.$post->ID.'" type="submit">'. __("Add to cart","crunchpress").'</button>
						</form>
						</a>
						<a href="'.get_permalink().'" class="wishlist">'.__('Read More','mosque_crunchpress').'</a>';
					}else{
						$show_button = '';
					}
					
					//Show price
					if($show_price == 'yes'){
						$show_price_html = '<h4>'. __("Price:","crunchpress").' '.$currency . $regular_price.'</h4>';
					}else{
						$show_price_html = '';
					}
				//HTML Markup For Products
				$html_product .= '<li id="product-'.$post->ID.'" class="span3 first item">
					<figure>
						'.get_the_post_thumbnail($post_id, array(504,504)).'
						'.$show_button.'
					</figure>
					<div class="text">
						<h3>'.get_the_title().'</h3>
						'.$show_price_html.'
					</div>
				</li>';
			}
		$html_product .= '</ul>
		</div>';
			//Reset Query and Post All Data
		wp_reset_query();
		wp_reset_postdata();
		return $html_product;
	
	}
	
	//FontAwesome ShortCode Start
	function cp_fontawesome_shortcode($atts,$content = null){
		//Counter
		static $counter_font_awesome = 1;
		$counter_font_awesome++;
		$html = '';
		$circle = '';
		//Fetch Parameters
		extract(shortcode_atts(array(
			'icon' => '',
			'circle' => '',			
			'iconcolor' => '',
			'circlecolor' => '',
			'circlebordercolor' => '',
			
		), $atts));
		if($iconcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$iconcolor = $color_scheme;
		}
		$no_circle_box = '';
		//Empty check Conditions
		if($circlebordercolor == ''){$circlebordercolor = 'transparent';}
		if($circlecolor == ''){$circlecolor = 'transparent';}
		if($circle == 'yes'){$circle = 'border-radius:100%;';}else if($circle == 'no'){$circle = 'border-radius:0';}else{$circle = 'border-radius:0';$no_circle_box = 'yes';}
		//if not empty
		if($icon <> ''){
			$html .= '<div class="cp-fontaw-con">';
			if($no_circle_box <> 'yes'){
				$html .= '<style scoped>.cp-color-fontaw-'.$counter_font_awesome.' i{'.$circle.';border-color:'.$circlebordercolor.';background-color:'.$circlecolor.';color:'.$iconcolor.';}</style>';
				$icon_class = 'ic-circle';
			}else{
				$icon_class = '';
				$html .= '';
			}
			$html .= '<span class="cp-color-fontaw-'.$counter_font_awesome.'"><i class="fa  '.$icon_class.' '.$icon.'"></i></span>';
			$html .= '</div>';
		}
		//HTML Markup End
		return $html;
	
	}
	//Text ShortCode Start
	function cp_text_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'align' => '',
		), $atts));
			//HTML Markup
			$html = '';
			$html .= '<p class="cp-paragraph" style="text-align:'.$align.'">';
			$html .= do_shortcode($content);
			$html .= '</p>';
		
		return $html;
	
	}	
	
	
	
	//Team Shortcode
	function cp_person_shortcode($atts,$content = null){
		
		static $counter_team = 1;
		$counter_team++;
		//Fetch Parameters
		extract(shortcode_atts(array(
			'type' => 'default',
			'name' => '',
			'picture' => '',
			'title' => '',
			'facebook' => '',
			'twitter' => '',
			'linkedin' => '',
			'dribbble' => '',
			'link' => '',
			
		), $atts));
		//HTML Markup
		$html_team = '';
		
		$facebook = '<li><a href="'.$facebook.'"><i class="fa fa-facebook"></i></a></li>';
		$twitter = '<li><a href="'.$twitter.'"><i class="fa fa-twitter"></i></a></li>';
		$linkedin = '<li><a href="'.$linkedin.'"><i class="fa fa-google-plus"></i></a></li>';
		$dribbble = '<li><a href="'.$dribbble.'"><i class="fa fa-dribbble"></i></a></li>';

		if($type == 'team-boxed'){
		//Team Boxed
			$html_team = '
			<div class="team gallery-items gallery">
				<div class="about-me-left">
					<ul>
						<li> 
							<a data-gal="prettyPhoto[gallery'.$counter_team.']"  href="'.$picture.'" >
							<img alt="'.$name.' - '.$title.'" src="'.$picture.'">
							<div class="ghover"><span class="pluss"><i class="fa fa-plus"></i></span></div>
							</a> 
						</li>
						<li>
							<h3><a href="'.$link.'">'.$name.'</a></h3>
							<span>'.$title.'</span>
							<p>'.$content.'</p>
						</li>
						<li>
						  <div class="tsocial">
							<ul>
								'.$facebook.$twitter.$linkedin.$dribbble.'
							</ul>
						  </div>
						</li>
					</ul>
				</div>
			</div>	';
		}
		else if($type == 'team-boxed-style-1'){
		//Team Boxed
			$html_team = 
			'<div class="team-02 team-box-02">
				<div class="team-img"> 
					<a data-gal="prettyPhoto[gallery'.$counter_team.']" href="'.$picture.'">
						<img alt="'.$name.' - '.$title.'" src="'.$picture.'">
					</a>
				</div>
				<ul class="box">
					<li>
					  <h3><a href="'.$link.'">'.$name.'</a></h3>
					  <span>'.$title.'</span>
					  <p>'.$content.'</p>
					</li>
					<li>
					  <div class="tsocial">
						<ul>
							'.$facebook.$twitter.$linkedin.$dribbble.'
						</ul>
					  </div>
					</li>
				</ul>
			</div>';
		}
		else if($type == 'team-circle-style'){
		//Team Boxed
			$html_team = '
			<div class="team-02 team-box team-round">
				<div class="team-img"> 
					<a data-gal="prettyPhoto[gallery'.$counter_team.']" href="'.$picture.'">
						<img alt="'.$name.' - '.$title.'" src="'.$picture.'">
					</a>
				</div>
					<ul class="box">
						<li>
							<h3><a href="'.$link.'">'.$name.'</a></h3>
							<span>'.$title.'</span>
							<p>'.$content.'</p>
						</li>
						<li>
							<div class="tsocial">
								<ul>
									'.$facebook.$twitter.$linkedin.$dribbble.'
								</ul>
							</div>
						</li>
					</ul>
			</div>';
		}
		else if($type == 'team-circle-style-1'){
		//Team Boxed
			$html_team = '
			<div class="team team-2 gallery-items">
			<ul>
				<li>
					<a data-gal="prettyPhoto[gallery'.$counter_team.']" href="'.$picture.'" >
						<div class="cirle"><img alt="'.$name.' - '.$title.'" src="'.$picture.'"></div>
					</a> 
				</li>
				<li>
					<h3><a href="'.$link.'">'.$name.'</a></h3>
					<span>'.$title.'</span>
					<p>'.$content.'</p>
				</li>
				<li>
					<div class="tsocial">
						<ul>
							'.$facebook.$twitter.$linkedin.$dribbble.'
						</ul>
					</div>
				</li>
			</ul>
			</div>';
		}
		else{
		//Team Circled
			$html_team =  '<div class="team2 gallery">
				<ul>
					<li>
						<div class="block-image">
							<img alt="'.$name.' - '.$title.'" src="'.$picture.'" class="img-responsive">
							<div class="imgb-overlay pat-override"></div>
							<ol class="static-style">
								<li class="white-rounded">
									<a data-gal="prettyPhoto[gallery'.$counter_team.']" href="'.$picture.'">
										<i class="fa fa-plus"></i>
									</a>
								</li>
							</ol>
						</div>
                    </li>
					<li>
						<h3><a href="'.$link.'">'.$name.'</a></h3>
						<span>'.$title.'</span>
						<p>'.$content.'</p>
					</li>
					<li>
						<div class="tsocial">
							<ul>
								'.$facebook.$twitter.$linkedin.$dribbble.'
							</ul>
						</div>
					</li>
				</ul>
			</div>';
		}
		
		return $html_team;
	}
	
		//Pricing Table ShortCode Start
	function cp_pricing_table_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(			
			'backgroundcolor' => '',
			'bordercolor' => '',
			'dividercolor' => '',
			
		), $atts));	
		static $counter_price = 1;
		$counter_price++;
		if($backgroundcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$backgroundcolor = $color_scheme;
		}
		if($bordercolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$bordercolor = $color_scheme;
		}
		if($dividercolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$dividercolor = $color_scheme;
		}
		
		 
		global $counter;
		
		//HTML Markup
		return '
		<style scoped>

		.plan-heading-color-1-'.$counter.'{
			background-color:'.$backgroundcolor.';
			padding: 20px 0px;
		}
		.amount-color-1-'.$counter.'{
			background-color:'.$bordercolor.'
		}
		.plan-btn-color2-'.$counter.'{
			background-color:'.$dividercolor.'
		}
		
		.amount-color-1-'.$counter.':before {
		  border-left: 127px solid transparent;
		  border-right: 127px solid transparent;
		  border-top: 30px solid '.$bordercolor.';
		  bottom: -30px;
		  content: "";
		  display: block;
		  height: 0;
		  position: absolute;
		  width: 0;
		  
		}
		
		</style>
		
		<div id="" class="plan-box"><div id="" class="">'.do_shortcode($content).'</div></div>';
	
		
	}
	
	//Pricing Table Column ShortCode Start
	function cp_pricing_header_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'title' => '',	
			// 'currency' => '',
			// 'price' => '',			
			// 'time' => '',
		), $atts));
		//HTML Markup
		
		// return '<div class="table_container_cp"><div class="cp_price_table"><div class="table-header">
			// <div class="cp_header_title">
				// <h3>'.$title.'</h3>
			// </div>'.do_shortcode($content).'</div>';
		global $counter;	
		return '<div><div><div>
		
		<div class="plan-heading-color-1-'.$counter.'">
			<h3>'.$title.'</h3>
		</div>'.do_shortcode($content).'</div>';
	}
	
	//Pricing Table Price ShortCode Start
	function cp_pricing_price_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'currency' => '',
			'price' => '',
			'time' => '',			
		), $atts));
		//HTML Markup
		global $counter;
		return '<div class="amount-box amount-color-1-'.$counter.'">
				<strong class="price">'.$currency.$price.'</strong><span class="mnt">'.$time.'</span>
			</div>';
	}
	
	//Pricing Table Col Start
	function cp_pricing_column_shortcode($atts,$content = null){
		return '<ul>'.do_shortcode($content).'</ul></div>';
	}
	
	//Pricing Table Row start
	function cp_pricing_row_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'link' => '',			
		), $atts));
		return '<li>'.do_shortcode($content).'</li>';
	}
	
	//Pricing Table Footer Shortcode
	function cp_pricing_footer_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'link' => '',
		), $atts));
		//HTML Markup 
		
		global $counter;
		return '<a class="btn-2 plan-btn-color2-'.$counter.'" href="'.$link.'">'.do_shortcode($content).'</a></div>';
	}
	
	
	//Feature project
	function cp_feature_shortcode($atts,$content = null){
		extract(shortcode_atts(array(
			'title' => '',
			'feature_id' => '',
		), $atts));
		$html_feature = '';
		static $counter_feature = 1;
		$counter_feature++;
		
		$kode_ign_fund_end = get_post_meta($post->ID, 'ign_fund_end', true);
		$kode_ignition_datee = date('d-m-Y h:i:s',strtotime($kode_ignition_date));
		$kode_ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);
		$kode_ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
		$kode_ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);
		$kode_thumbnail_id = get_post_thumbnail_id( $post->ID, 'ign_project_id', true );
		$kode_getPledge_cp = getPledge_cp($kode_ign_project_id);
		$kode_current_date = date('d-m-Y h:i:s');
		$kode_project_date = new DateTime($kode_ignition_datee);
		$kode_current = new DateTime($kode_current_date);
		$kode_days = round(($kode_project_date->format('U') - $kode_current->format('U')) / (60*60*24));
		$kode_thumbnail = wp_get_attachment_image_src( $kode_thumbnail_id , 'blog-post' );
		
		$html_feature .= '
			<div class="donation-section">
				<div class="holder">
					<strong class="title">'.esc_attr($title).'</strong>
					<h2>'.esc_attr(get_the_title($feature_id)).'</h2>
					<div class="progress-bar-box">
						<div class="progress progress-striped active">
							<div style="width: '.esc_attr(getPercentRaised_cp($kode_ign_project_id)).'%;" class="bar"></div>
						</div>
					</div>
					<strong class="amount">$'.$kode_ign_fund_goal. esc_attr_(' Collected of ','mosque_crunchpress'). getTotalProductFund_cp($kode_ign_project_id).'</strong>
					<a class="btn-3" href="'.esc_url(get_permalink($feature_id)).'">'.esc_attr__('Donate Now','mosque_crunchpress').'</a>
				</div>
			</div>
		';
		
		return $html_feature;
	}
	
	
	//Testimonials ShortCode Start
	function cp_locators_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'name' => '',
			'lat' => '',
			'long' => '',
			'venue' => '',
			'address' => '',

		), $atts));
		
		
		//Counter
		static $counter_locator = 1;
		
		$counter_locator++;
		
		$html_locator = '';
		
		//Calling Required Files
		wp_register_script('cp-locator', CP_PATH_URL.'/frontend/shortcodes/js/location-map-api.js', false, '1.0', true);
		wp_enqueue_script('cp-locator');	
		
		wp_register_script('cp-map', CP_PATH_URL.'/frontend/shortcodes/js/location-map.js', false, '1.0', true);
		wp_enqueue_script('cp-map');
		
		wp_register_script('cp-map', CP_PATH_URL.'/frontend/shortcodes/js/jquery.mCustomScrollbar.concat.min.js', false, '1.0', true);
		wp_enqueue_script('cp-map');
		
		wp_register_script('cp-map', CP_PATH_URL.'/frontend/shortcodes/css/jquery.mCustomScrollbar.css', false, '1.0', true);
		wp_enqueue_script('cp-map');
		?>
		<script src="http://maps.google.com/maps/api/js?sensor=true"></script> 
		<script>
			(function($){
				$(window).load(function(){
					$("#content_1").mCustomScrollbar({
						scrollButtons:{
							enable:true
						}
					});
					$("#content_1").hover(function(){
						$(document).data({"keyboard-input":"enabled"});
						$(this).addClass("keyboard-input");
					},function(){
						$(document).data({"keyboard-input":"disabled"});
						$(this).removeClass("keyboard-input");
					});
					$(document).keydown(function(e){
						if($(this).data("keyboard-input")==="enabled"){
							var activeElem=$(".keyboard-input"),
								activeElemPos=Math.abs($(".keyboard-input .mCSB_container").position().top),
								pixelsToScroll=60;
							if(e.which===38){ //scroll up
								e.preventDefault();
								if(pixelsToScroll>activeElemPos){
									activeElem.mCustomScrollbar("scrollTo","top");
								}else{
									activeElem.mCustomScrollbar("scrollTo",(activeElemPos-pixelsToScroll),{scrollInertia:400,scrollEasing:"easeOutCirc"});
								}
							}else if(e.which===40){ //scroll down
								e.preventDefault();
								activeElem.mCustomScrollbar("scrollTo",(activeElemPos+pixelsToScroll),{scrollInertia:400,scrollEasing:"easeOutCirc"});
							}
						}
					});
				});
			})(jQuery);
		</script> 
		<?php
		
		//Js Script and HTML Markup
		
		$html_locator = '<section class="event-locator"><div id="content_1" class="content">
			<div id="home-sidebar">
				<ul>
				  '.do_shortcode($content).'
				</ul>
			</div>
		</div>
		<div id="map-wrapper">
          <div id="map"> </div>
        </div></section>';
		
		return $html_locator;
	
	}
	
	//Single Testimonial ShortCode Start
	function cp_locator_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'name' => '',
			'lat' => '',
			'long' => '',
			'venue' => '',
			'address' => '',
			
		), $atts));
		//HTML Markup  For Default
		$html_testi = '';
			
		static $counter_locator = 1;

		$html_testi .= '<li>
							<div class="outer"> 
								<span class="lat hide">'.$lat.'</span>
								<span class="long hide">'.$long.'</span> 
								<span class="address hide"> 
									<strong>Venue: 	</strong>'.$venue.'<br />
									<strong>Address: </strong>'.$address.'<br />
								</span> 
								<span class="num">'.$counter_locator.'</span>
							  <address>
								<strong class="title">'.$name.'</strong>
								<p>'.$content.'</p>
							  </address>
							</div>
						</li>';
							$counter_locator++;
		
		return $html_testi;
	}

	
	//Testimonials ShortCode Start
	function cp_testimonials_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'type' => '',

		), $atts));
		
		
		//Counter
		static $counter_testimonial = 1;
		$counter_testimonial++;
		$html_testimonial = '';
		//Calling Required Files
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
		//Js Script and HTML Markup
		if($type == 'no-image'){
			$html_testimonial .= '<script type="text/javascript">jQuery(document).ready(function($){$(".travel-quote-slider'.$counter_testimonial.'").bxSlider({mode: "fade", pager: "true", controls: "false", easing: "swing",auto: "auto"});});</script>';
			$html_testimonial .= '
			<div class="travel-qslider"><i class="fa fa-quote-left"></i>
				<ul class="travel-quote-slider'.$counter_testimonial.'">
					'.do_shortcode($content).'
				</ul>
			</div>';
		} else {
		$html_testimonial .= '<script type="text/javascript">jQuery(document).ready(function($){$("#testimonials'.$counter_testimonial.'").bxSlider({mode: "fade",hideControlOnEnd: true,easing: "swing",auto: "auto"});});</script>';
		$html_testimonial .= '<div class="cp-testimonials"><div class="testimonial-box-1">
		
			<ul id="testimonials'.$counter_testimonial.'">
				'.do_shortcode($content).'
			</ul>
		</div></div>';
		}
		
		return $html_testimonial;
	
	}
	
	//Single Testimonial ShortCode Start
	function cp_testi_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'type' => '',
			'backgroundcolor' => '',
			'name' => '',
			'picture' => '',
			'company' => '',
			'link' => '',
			'target' => '',
			
		), $atts));
		//HTML Markup  For Default
		$html_testi = '';
		if($backgroundcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$backgroundcolor = $color_scheme;
		}
		if($type == 'default'){
		$html_testi .= '
			<div class="single-testimonial">
				<div class="frame-box2">
					<div class="frame">
						<a href="'.$link.'"><img src="'.$picture.'" alt="'.$name.'"></a>
					</div>
					<div class= "testimonial-contentbox">
						<q> <i class="fa fa-quote-left"></i>'.do_shortcode($content).'</q>
						<strong class="name"><a  target="'.$target.'" href="'.$link.'">'.$name.'</a></strong>
						<strong class="title">'.$company.'</strong>
					</div>
				</div>
			</div>';
		  
			//HTML Markup For Custom Style
		}else if($type == 'custom-style'){
			$picture = '
			<div class="frame">
					<a href="'.$link.'"><img src="'.$picture.'" alt="'.$name.'"></a>
				<div class="single-testimonial">';
			$html_testi .= '<li class="style-2">
            <q> <i class="fa fa-quote-left"></i>'.do_shortcode($content).'</q>
            <div class="frame-box2">
              '.$picture.'
			  <a class="name" target="'.$target.'" href="'.$link.'">'.$name.'<strong class="title">'.$company.'</strong></a>
          </div></li>';
			//HTML For Thumbnail
		}else{
			//$picture = '<div class="thumb"><a href="'.$link.'"><img src="'.$picture.'" alt="'.$name.'"></a></div>';
			
			$html_testi .= ' <li>
				<div class="holder">
					<div class="frame-box">
						<div class="frame">
							<img src="'.$picture.'" alt="'.$name.'">
						</div>
							<strong class="name">'.$name.'</strong>
							<strong class="title">'.$company.'</strong>
					</div>
							<q>'.do_shortcode($content).'</q>
				</div>
			</li>';
		}
		return $html_testi;
	
	}
	
	//Recent Post Shortcode Start
	function cp_recent_post_shortcode($atts,$content = null){
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		$html = '';
		//Fetch Parameters
		extract(shortcode_atts(array(
			'layout' => '',
			'columns' => '',
			'number_posts' => '',
			'cat_id' => '',
			'thumbnail' => '',
			'title' => '',
			'post_meta' => '',
			'excerpt' => '',
			'excerpt_words' => '',
			
		), $atts));
		//layout Selection
		if($columns == '1-4'){$post_wrapper = 'row-fluid';}
		$recent_html = '<div class="cp-post '.$post_wrapper.'">';
		
		// If Empty
		query_posts(array( 
			'post_type' => 'post',
			'paged' => $paged,
			'posts_per_page' => $number_posts,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'terms' => $cat_id,
					'field' => 'term_id',
				)
			),
			'orderby' => 'title',
			'order' => 'DESC' )
		);
		$thumbnail_html = '';
		$counter_post = 0;
		while( have_posts() ){
			the_post();
			global $post,$post_id;
			//Post Variables
			$popular_post = get_post_meta($post->ID,'popular_post_views_count',true);
			if($post_id <> ''){
				//$cp_post_class = get_post_class( 'aa', $post_id )[4];
			}
			if($popular_post <> ''){ $popular_post_html = '<li><a href="'.get_permalink().'"><i class="fa fa-heart"></i> '.$popular_post.'</a></li>';}
			//if thumbnail exists
			if($thumbnail == 'yes'){$thumbnail_html = get_the_post_thumbnail($post->ID, array(614,614));$thumbnail_size = get_the_post_thumbnail($post->ID, array(1170,350));}
			if($excerpt == 'yes'){$excerpt_html = strip_tags(substr(get_the_content(),0,$excerpt_words));}
			if($meta == 'yes'){
				$meta_html = '<div class="cp-comments-area">
					<div class="row-fluid">
						<div class="span8">
							<ul class="cp-categories">';
								$variable_category = wp_get_post_terms( $post->ID, 'category');
								$counterr = 0;
								//Loop 
								foreach($variable_category as $values){
									if($counterr == 0){$meta_html .= '<li>Category:  </li>';}
									$counterr++;
									$meta_html .= '<li><a href="'.get_term_link(intval($values->term_id),'category').'">'.$values->name.'</a></li>';
								}
								$meta_html .= '
							</ul>
							
							<ul class="cp-post-detail">
								<li><a href="'.get_permalink().'"><i class="fa fa-clock-o"></i> '.get_the_date().'</a></li>
								'.$popular_post_html.'
							</ul>
						</div>
						<div class="span4">
							<div class="type-icon post-type-bar"><i class="fa fa-file-text-o"></i></div>
						</div>
					</div>
				</div>';
			}
			//Layout Selection Condition For Post
			if($columns == '1-1'){
				//Layout of post
				if($layout == 'default'){
				$recent_html .= '
				<div class="cp-post-type '.$cp_post_class.' '.$layout.'">
					<figure>'.$thumbnail_size.'</figure>
					<div class="cp-post-desc">
						<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>
						'.$meta_html.'
						<div class="cp-text">
							<p>'.$excerpt_html.'</p>
							<a href="'.get_permalink().'" class="cp-btn-normal pink"><i class="fa fa-arrow-right"></i>'.__('Read More','mosque_crunchpress').'</a>
						</div>
					</div>
				</div>';
				// Layout Selection for Thumbnails-on-side
				}else if($layout == 'thumbnails-on-side'){
					$recent_html .= '
						<div class="cp-post-type '.$cp_post_class.' '.$layout.'">
							<div class="row-fluid">
								<div class="span4"><figure>'.$thumbnail_html.'</figure></div>
								<div class="span8">
									<div class="cp-post-desc">
									<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>
										'.$meta_html.'
										<div class="cp-text">
											<p>'.$excerpt_html.'</p>
											<a href="'.get_permalink().'" class="cp-btn-normal pink"><i class="fa fa-arrow-right"></i>'.__('Read More','mosque_crunchpress').'</a>
										</div>
									</div>
								</div>
							</div>
						</div>';
						
				}else{
					$recent_html .= '';
				}
			}else{
				if($layout == 'default'){
					if($counter_post % 3 == 0){$post_class = 'first';$post_clear = '<div class="clear"></div>';}else{$post_class = '';$post_clear = '';}$counter_post++;
					$recent_html .= $post_clear.'<div class="span4 '.$post_class.' '.$layout.'">
						<div class="cp-post">
							<figure>'.$thumbnail_html.'</figure>
							<div class="cp-text">
								<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>
								<ul class="cp-categories">
									<li><a href="'.get_permalink().'">'.get_the_author().'</a></li>
									<li>';
										$variable_category = wp_get_post_terms( $post->ID, 'category');
										$counterr = 0;
										foreach($variable_category as $values){
											if($counterr == 0){ $meta_html .= '<li>Category:  </li>'; }
											$counterr++;
											$recent_html .= '<li><a href="'.get_term_link(intval($values->term_id),'category').'">'.$values->name.'</a></li>';
										}
									$recent_html .= '</li>
								</ul>
								<ul class="cp-post-detail">
									<li><a href="'.get_permalink().'"><i class="fa fa-clock-o"></i>'.get_the_date().'</a></li>
									'.$popular_post_html.'
								</ul>
							</div>
						</div>
					</div>';
					
				}else{
					$recent_html .= '<h3> Please change the layout there is no 1-4 layout for thumbnails-on-side</h3>';
				}			
			}
		}
		$recent_html .= '<div class="cp_load fadeIn">
			'.pagination().'
		</div>';
		$recent_html .= '</div>';
		
		return $recent_html;
		wp_reset_postdata();

	}
	
	//Content Boxes ShortCode Start
	function cp_content_box_shortcode($atts,$content = null){
		$html = '';
		//Fetch Parameters
		extract(shortcode_atts(array(
			'color' => '#ffffff',
			'backgroundcolor' => '#C33C4A',
			'title' => '',
			'icon' => '',
			
		), $atts));
		static $counter_box = 1;
		$counter_box++;
		if($backgroundcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$backgroundcolor = $color_scheme;
		}
		if($color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$color = $color_scheme;
		}
		//HTML Markup
		return '<style scoped>.cp-box-color-'.$counter_box.'{color:'.$color.' !important;}.cp-box-background-'.$counter_box.'{background:'.$backgroundcolor.'}</style><div class="cp-box-background-'.$counter_box.' cp-contant-box-1 cp-box-color-'.$counter_box.'"><h4 class="cp-box-color-'.$counter_box.'"><i class="fa '.$icon.'"></i>'.$title.'</h4>
		<div class="cp-text cp-box-background-'.$counter_box.' cp-box-color-'.$counter_box.'">
			'.do_shortcode($content).'
		</div></div>';
	}
	
	//Welcome Shortcode
	function cp_welcome_shortcode($atts,$content = null){

		//Fetch Parameters
		extract(shortcode_atts(array(
			'title' => '',
			'description'=>'',
			'btn_link' => '',		
			'image_link' => ''

		), $atts));

		//HTML Markup
		$html = '<div class="cp-mosque-welcome">
					<div class="row">
						<div class="col-md-5"><img src="'.$image_link.'" alt="'.$title.'"></div>
						<div class="col-md-7">
							<div class = "welcome-section">
								<h2>'.$title.'</h2>
								<p>'.$description.'</p>
								<a href="'.$btn_link.'" class="cp-mosque-readmore">'.esc_attr('Read More','mosque_crunchpress').'</a>
							</div>
						</div>
					</div>
				</div>';
		return $html;
	}
	
	//Simple Buttons
	function cp_buttons_shortcode($atts,$content = null){
		//Counter Button
		static $counter_brn = 1;
		$counter_brn++;
		//Fetch Parameters
		extract(shortcode_atts(array(
			'icon' => '',
			'style'=>'',
			'size' => '',
			//'align' => '',
			'backgroundcolor' => '',
			'color' => '',			
			'link' => ''

		), $atts));
		

		$btn_class = 'btn-2';	
		if($style == 'simple-btn'){
			$btn_class = 'btn-1';
		}else if($style == 'black'){
			$btn_class = 'btn-1 button_black';
		}else if($style == 'round-conr-btn'){			$btn_class = 'btn-3';		}else if($style == 'round-conr-btn-2'){
			$btn_class = 'btn-4';
		}else if($style == 'plain-btn'){
			$btn_class = 'btn-7';
		}
		if($backgroundcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$backgroundcolor = $color_scheme;
		}
		if($color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$color = $color_scheme;
		}
		//HTML Markup
		$html = '
		<div class="btn-container">
		<style scoped>.cp-color-'.$counter_brn.'{background-color:'.$backgroundcolor.';color:'.$color.';}</style>
		<a href="'.$link.'" class="'.$btn_class.' '.$size.' cp-color-'.$counter_brn.'">';
		if($icon <> ''){
			$html .= '<i class="fa '.$icon.'"></i>';
		}
		$html .= do_shortcode($content).'</a></div>';
	return $html;
	}
	
	//3d Buttons ShortCode Start
	function cp_3dbutton_shortcode($atts,$content = null){
		//Counter
		static $counter_3d = 1;
		$counter_3d++;
		$html = '';
		//Fetch parameters
		extract(shortcode_atts(array(
			'icon' => '',
			'size' => '',
			'backgroundcolor' => '',
			'target' => '_blank',
			'textcolor' => '',
			'link' => '',
			
		), $atts));
		//$html = '<a style="background-color:'.$backgroundcolor.';color:'.$color.'">'.do_shortcode($content).'</a>';
		if($backgroundcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$backgroundcolor = $color_scheme;
		}
		//HTML Markup
		$html = '
		<div class="btn-container">
		<style scoped>.cp-color3d-'.$counter_3d.'{background-color:'.$backgroundcolor.';color:'.$textcolor.';}</style>
		<a target="'.$target.'" href="'.$link.'" class="btn-5 cp-btn '.$size.' cp-color3d-'.$counter_3d.'"><i class="fa '.$icon.'"></i>'.$content.'</a></div>';
		
		return $html;
	
	}
	
	//Image Carousel ShortCode Start
	function cp_images_shortcode($atts,$content = null){
		//Counter
		static $counter_images = 1;
		$counter_images++;
		//Fetch Parameters
		extract(shortcode_atts(array(
			'lightbox' => '',
			'gallery_id' => '',
			
		), $atts));
		//HTML Markup
		$html = '';
		//Lightbox is on
		if($lightbox == 'Yes'){
		//Calling Required Files
			wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/shortcodes/js/jquery.prettyphoto.js', false, '1.0', true);
			wp_enqueue_script('prettyPhoto');

			wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/shortcodes/js/pretty_script.js', false, '1.0', true);
			wp_enqueue_script('cp-pscript');	
			
			wp_enqueue_style('prettyPhoto',CP_PATH_URL.'/frontend/shortcodes/css/prettyphoto.css');
		}
		wp_register_script('cp-jcaro', CP_PATH_URL.'/frontend/shortcodes/js/jquery.jcarousel.min.js', false, '1.0', true);
		wp_enqueue_script('cp-jcaro');	
		// Js Script
		$html .=  '<script> jQuery(document).ready(function($){ $("#mycarousel-'.$counter_images.'").jcarousel({wrap: "circular"}); }); </script>';
			if($gallery_id <> ''){
				$slider_xml_string = get_post_meta($gallery_id,'post-option-gallery-xml', true);
				//print_r($slider_xml_string);
				$slider_xml_dom = new DOMDocument();
				if( !empty( $slider_xml_string ) ){
					$slider_xml_dom->loadXML($slider_xml_string);					
						$children = $slider_xml_dom->documentElement->childNodes;
						$length = $slider_xml_dom->documentElement->childNodes->length;
						//Getting Values in Variables
						$html .=  '<ul id="mycarousel-'.$counter_images.'" class="jcarousel-skin-tango">';
						for($i=0;$i<$length;$i++) { 
							$thumbnail_id = cp_find_xml_value($children->item($i), 'image');
							$title = cp_find_xml_value($children->item($i), 'title');
							$caption = cp_find_xml_value($children->item($i), 'caption');
							$link_type = cp_find_xml_value($children->item($i), 'linktype');
							$video = cp_find_xml_value($children->item($i), 'video');
							//$link = cp_find_xml_value($children->item($i), 'link');
							
							$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
							//Images
							$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(614,614));
							$link = cp_find_xml_value( $children->item($i), 'link');
							
							$html .= '<li><a href="'.$image_full[0].'" data-gal="prettyPhoto[gallery1]"><img src="'.$image_thumb[0].'" alt="" /></a></li>';
          
						}
					$html .= '</ul>';	
				}
			}	
		
		return $html;
	
	}
	
	//Metro Buttons
	function cp_metro_shortcode($atts,$content = null){
		//Counter
		static $counter_metro = 1;
		$counter_metro++;
		$html = '';
		//Fetch Parameters
		extract(shortcode_atts(array(
			'icon' => '',
			'size' => '',
			'backgroundcolor' => '',
			'textcolor' => '',
			'link' => '',
			
		), $atts));
		if($backgroundcolor == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$backgroundcolor = $color_scheme;
		}
		//$html = '<a style="background-color:'.$backgroundcolor.';color:'.$color.'">'.do_shortcode($content).'</a>';
		//HTML Markup
		$html = '
		<div class="btn-container cp-metro-style">
		<style scoped>.cp-color-metro-'.$counter_metro.'{background-color:'.$backgroundcolor.';color:'.$textcolor.';}</style>
		<a href="'.$link.'" class="cp-btn-metro '.$size.' cp-color-metro-'.$counter_metro.'"><i class="fa '.$icon.'"></i>'.$content.'</a></div>';
		
		return $html;
	
	}
	
	//SoundCloud ShortCode Start
	function cp_soundcloud_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'type' => '',
			'width' => '',
			'height' => '',
			'url' => '',			
			'color' => '',
			'auto_play' => '',
			'hide_related' =>'',
			'show_artwork_or_visual' => '',
			
		), $atts));
		if($color == 'theme'){
			$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');
			$color = $color_scheme;
		}
		//Classic Embed HTML Markup
		if($type == "classic-embed"){
			return '<iframe width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.urlencode($url).'&amp;color='.$color.'&amp;auto_play='.$auto_play.'&amp;hide_related='.$hide_related.'&amp;show_artwork='.$show_artwork_or_visual.'"></iframe>';
		}else{
		//Visual Embed HTML Markup
			return '<iframe width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.urlencode($url).'&amp;auto_play='.$auto_play.'&amp;hide_related='.$hide_related.'&amp;visual='.$show_artwork_or_visual.'"></iframe>';
		}	
	}
	
	//Counter Circle ShortCode Start
	function cp_counters_circle_shortcode($atts,$content = null){
		
		return '<div class="skills">'.do_shortcode($content).'</div>';
	}
	 
	//Progress Circle / Counter Circle Shortcode start
	function cp_progress_shortcode($atts,$content = null){
		//fetch parameters
		extract(shortcode_atts(array(
			'filledcolor' => '#000000',
			'unfilledcolor' => '#ffffff',
			'percent' => '10',
			
		), $atts));
			//define count for progress circle
			static $counter_progress = 1;
			$counter_progress++;
			//calling all the scripts for progress circle
			wp_register_script('cp-easy-chart', CP_PATH_URL.'/frontend/shortcodes/js/easy-pie-chart.js', false, '1.0', true);
			wp_enqueue_script('cp-easy-chart');			
			wp_register_script('cp-excanvas', CP_PATH_URL.'/frontend/shortcodes/js/excanvas.js', false, '1.0', true);
			wp_enqueue_script('cp-excanvas');			
			wp_enqueue_style('cp-easy-chart',CP_PATH_URL.'/frontend/shortcodes/css/chart.css');
			
		//HTML Markup For Progress circle
		$html_pro = " <div class='skill-inner'>
			<script type='text/javascript'>
				jQuery(document).ready(function($) {
					if($('#progress_bar-".$counter_progress."').length){
						var trackcolor = $('#progress_bar-".$counter_progress."').attr('data-trackcolor');
						var barcolor = $('#progress_bar-".$counter_progress."').attr('data-barcolor');
						if(!trackcolor.length){var trackcolor = '';}
						if(!barcolor.length){var barcolor = '';}
						$('#progress_bar-".$counter_progress."').easyPieChart({
							animate: 1000,
							barColor: barcolor,
							lineWidth: 10,
							size: 150,
							animate: true,
							trackColor: trackcolor,
							onStep: function() {
								
							}
						});
					};
				});
			</script>
		<div class='chart'>
			<div id='progress_bar-".$counter_progress."' data-trackcolor='".$unfilledcolor."' data-barcolor='".$filledcolor."' class='percentage' data-percent='".$percent."'><span>".$percent."</span>%</div>
			<div class='label'>".do_shortcode($content)."</div>
		</div></div>";
	
		return $html_pro;
		
	}
	
	//Lightbox shortcode
	function cp_lightbox_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'title' => '',
			'href' => '#',			
			'src' => '',
			'align' => '',
			'margin' => '',
			
			
		), $atts));
		
		//Calling the Required Files
		wp_register_script('prettyPhoto', CP_PATH_URL.'/frontend/shortcodes/js/jquery.prettyphoto.js', false, '1.0', true);
		wp_enqueue_script('prettyPhoto');

		wp_register_script('cp-pscript', CP_PATH_URL.'/frontend/shortcodes/js/pretty_script.js', false, '1.0', true);
		wp_enqueue_script('cp-pscript');	
		
		$html = '<div class="frame"> <a href="'.$href.'" data-gal="prettyPhoto[gallery1]" ><img src="'.$src.'" alt="'.$title.'"></a>
		  <div class="caption">
			<div class="inner"> <a href="'.$href.'" data-gal="prettyPhoto[gallery1]" class="view">Quick View</a><a href="'.$href.'" class="title">'.$title.'</a> </div>
		  </div>
		</div>';
		
		return $html;
		
		 // return $html = '<a style="margin:'.$margin.';float:'.$align.'" title="'.$title.'" href="'.$href.'" data-gal="prettyPhoto[gallery1]"><img src="'.$src.'" alt="'.$title.'" /></a>';
	
	}
	//Title ShortCode Start
	function cp_title_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'size' => '',
			
		), $atts));
		//HTML Markup
		return '<'.$size.' class="cp-heading-full">'.do_shortcode($content).'</'.$size.'>';
	
	}
	
	

	//Progress Bar Shortcode Start
	function cp_progress_bar_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'percentage' => '',
			'type' => 'progress-info',			
			
		), $atts));
		
		
		//HTML Markup
		$html_bar = '<div class="progress">
			<div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$percentage.'%">
				<span class="sr-only">'.$percentage.'% Complete </span>
			</div>
		</div>';
			
					// $html_bar = '<div class="progress-bar-box">
						// <div class="progress progress-striped active">
							// <div class="bar" style="width: '.$percentage.'%;"></div>
						// </div>
					// </div>';

			return $html_bar;
	}
		
	//Google maps
	function cp_map_shortcode($atts){
			//Counter
			static $counter_map = 1;
			$counter_map++;
			//Fetch Parameters
			extract(shortcode_atts(array(
				'latitude' => '',
				'longitude' => '',
				'maptype' => 'terrain',
				'width' => '100%',
				'height' => '400px',
				'zoom' => '14',
			), $atts));
		
		// ROADMAP (normal, default 2D map)
		// SATELLITE (photographic map)
		// HYBRID (photographic map + roads and city names)
		// TERRAIN (map with mountains, rivers, etc.)
		//Wordpress Code
		$select_layout_cp = '';
		$color_scheme = '';
		$cp_general_settings = get_option('general_settings');
		if($cp_general_settings <> ''){
			$cp_logo = new DOMDocument ();
			$cp_logo->loadXML ( $cp_general_settings );
			$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
			$color_scheme = cp_find_xml_value($cp_logo->documentElement,'color_scheme');
		}
		//Js Script For Map
		$html = '<div class="cp-map-containter"><script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>';
		$html .= "<script type='text/javascript'>
		jQuery(document).ready(function($) {			
			var map;
			var myLatLng = new google.maps.LatLng(".$latitude.",".$longitude.")
			//Initialize MAP
			var myOptions = {
				zoom: ".$zoom.",
				center: myLatLng,
				disableDefaultUI: true,
				zoomControl: true,
				styles: [{
					saturation: -100,
					lightness: 10
				}],
				scrollwheel: false,
				navigationControl: false,
				mapTypeControl: true,
				scaleControl: false,
				draggable: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
			};
			map = new google.maps.Map(document.getElementById('map_canvas-".$counter_map."'),myOptions);
			//End Initialize MAP
			//Set Marker
			var marker = new google.maps.Marker({
			  position: map.getCenter(),
			  map: map
			});
			marker.getPosition();
			//End marker
			
			//Set info window
			 var infowindow = new google.maps.InfoWindow({
				 content: '',
				 position: myLatLng
			 });
			//infowindow.open(map);
		});
		</script>";
		//HTML Markup
		$html .= '<div style="width:'.$width.';height:'.$height.';" id="map_canvas-'.$counter_map.'" class="map_canvas"></div></div>';
		
		return $html;
	}
	
	
	function cp_slider_main_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			'style' => '',
			'slider_id' => '',
		), $atts));
			$cp_slider_html = '';
			$slider_input_xml = get_post_meta( $slider_id, 'cp-slider-xml', true);
			if($slider_input_xml <> ''){
			$slider_xml_dom = new DOMDocument ();
			$slider_xml_dom->loadXML ( $slider_input_xml );
				$cp_slider_html = crunch_print_bx_slider($slider_xml_dom->documentElement,array(5000,1400),'abc123',$style);
			}
		return $cp_slider_html;
	}
	
	// Slider ShortCode Start
	function cp_slider_shortcode($atts,$content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			'width' => '100%',
			'height' => '350px',
		), $atts));
		
		static $counter_slider_id = 1;
		$counter_slider_id++;
		
		//HTML Markup
		$cp_html_slider = '';
		$short_code_id = 'slider-'.$counter_slider_id;
				
		//Calling the Script and required files
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_register_script('cp-fitvids-slider', CP_PATH_URL.'/frontend/shortcodes/js/jquery.fitvids.js', false, '1.0', true);
		wp_enqueue_script('cp-fitvids-slider');	
		
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
		$cp_html_slider = '<script type="text/javascript">jQuery(document).ready(function ($) { $("#slider-'.$counter_slider_id.'").bxSlider({video: true,useCSS: false});});</script>';
		$cp_html_slider .= '<div class="short_slider"><ul style="width:'.$width.';height:'.$height.'" id="'.$short_code_id.'">'.do_shortcode($content);		
		$cp_html_slider .= '</ul></div>';
		
		//Slider XML Check Condition Ends
		return $cp_html_slider;
	}
	
	function cp_slide_shortcode($atts ,$content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			'type' => '',
			'link' => '',
			'image_url' => '',
			'linktarget' => '',
			'lightbox' => '',
		), $atts));
		
		if($type == 'image'){
			$html_slider = '<li><a href="'.$link.'" target="'.$target.'"><img alt="" src="'.$image_url.'" /></a>'.html_entity_decode($content).'</li>';
		}else{
			$html_slider = '<li>'.do_shortcode(html_entity_decode($content)).'</li>';
		}
		
		
		//Slider XML Check Condition Ends
		return $html_slider;
	}
	
	function cp_newsletter_section($atts ,$content = null){
	//Fetch Parameters
		extract(shortcode_atts(array(
			'type' => '',
			'email' => ''
		), $atts));
		$html = '';
		//Newsletter 
		if($type == 'newsletter-layout1'){
			$html = '
				<div class="newsletter-section">
					<form class="newsletter-form get-touch-form" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(&#34;http://feedburner.google.com/fb/a/mailverify?uri='.$email.'&#34;, &#34;popupwindow&#34;, &#34;scrollbars=yes,width=600,height=550&#34;)">
						<input type="text" class="input-newsletter feedemail-input" name="email" onblur="this.value=this.value==&#34;&#34;?&#34;Enter your email&#34;:this.value;" onfocus="this.value=this.value==&#34;Enter your email&#34;?&#34;&#34;:this.value" value="Enter your email" />
						<input type="hidden" value="'.esc_attr($email).'" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						<input type="submit" value="'.esc_attr__('Subscribe','mosque_crunchpress').'" />
					</form>
				</div>';
		}else if($type == 'newsletter-layout2'){
			$html = '
			<div class="newsletter-section newsletter-section-2">
				<form class="newsletter-form get-touch-form" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(&#34;http://feedburner.google.com/fb/a/mailverify?uri='.$email.'&#34;, &#34;popupwindow&#34;, &#34;scrollbars=yes,width=600,height=550&#34;)">
					<input type="text" class="input-newsletter feedemail-input" name="email" onblur="this.value=this.value==&#34;&#34;?&#34;Enter your email for subscription...&#34;:this.value;" onfocus="this.value=this.value==&#34;Enter your email for subscription...&#34;?&#34;&#34;:this.value" value="Enter your email for subscription..." />
					<input type="hidden" value="'.esc_attr($email).'" name="uri"/>
					<input type="hidden" name="loc" value="en_US"/>
					<input type="submit" value="'.esc_attr__('Subscribe Now','mosque_crunchpress').'" />
				</form>
			</div>';
		}else if($type == 'newsletter-layout3'){
			$html = '<div class="newsletter-form newsletter-2">
						<div class="cp-heading-container" style="text-align: center;">
						<div class="heading-style-3" style="text-align: center">
						  <h2 style="color:#fff;">SUBSCRIBE FOR NEWSLETTER</h2>
						  <ul>
							<li class="bullet-1"></li>
							<li class="bullet-2"></li>
							<li class="bullet-3"></li>
							<li class="bullet-2"></li>
							<li class="bullet-1"></li>
						  </ul>
						</div>
						<p style="color:#fff">Class aptent taciti sociosqu ad litora torquent per conubia nostra</p>
						</div>
					<form class="newsletter-form get-touch-form" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(&#34;http://feedburner.google.com/fb/a/mailverify?uri='.$email.'&#34;, &#34;popupwindow&#34;, &#34;scrollbars=yes,width=600,height=550&#34;)";>
						<input type="text" class="input-newsletter feedemail-input" name="email" onblur="this.value=this.value==&#34;&#34;?&#34Enter your email for subscription...&#34;:this.value;" onfocus="this.value=this.value==&#34;Enter your email for subscription...&#34;?&#34;&#34;:this.value" value="Enter your email for subscription..." />
						<input type="hidden" value="'.esc_attr($email).'" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						<div class = "button-box-2">
							<input type="submit" value="'.esc_attr__('Subscribe Now','mosque_crunchpress').'" />
						</div>
					</form>
				</div>';
		}else if($type == 'newsletter-layout4'){
			$html = '
			<div class="newsletter-section newsletter-section-3">
				<form class="newsletter-form get-touch-form" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(&#34;http://feedburner.google.com/fb/a/mailverify?uri='.$email.'&#34;, &#34;popupwindow&#34;, &#34;scrollbars=yes,width=600,height=550&#34;)">
					<div class="row">
						<div class="col-md-4">
						<input type="text" placeholder="Enter Your Topic" required="" name="topic">
						</div>
						<div class="col-md-4">
						<input type="text" placeholder="Write Your Question" required="" name="question">
						</div>
						<div class="col-md-4">
						<input type="text" placeholder="Enter Your Email to Get Answer" required="" name="email">
						<input type="hidden" value="'.esc_attr($email).'" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						</div>
					</div>
					<div class="button-box">
						<input type="submit" value="'.esc_attr__('Submit Now','mosque_crunchpress').'" />
					</div>
				</form>
			</div>';
		}else if($type == 'newsletter-layout5'){
			$html = '
			<div class="newsletter-section newsletter-2 eco-newsletter">
				<form class="newsletter-form get-touch-form" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(&#34;http://feedburner.google.com/fb/a/mailverify?uri='.$email.'&#34;, &#34;popupwindow&#34;, &#34;scrollbars=yes,width=600,height=550&#34;)">
					<i class="fa fa-envelope"></i>
					<strong class="title">'.esc_attr__('Subscribe For Newsletter','mosque_crunchpress').'</strong>
					<input type="text" placeholder="Enter your email for subscription..." required="" name="email">
					<input type="hidden" value="'.esc_attr($email).'" name="uri"/>
					<input type="hidden" name="loc" value="en_US"/>
					<input type="submit" value="'.esc_attr__('Submit Now','mosque_crunchpress').'" />
				</form>
			</div>';
		}else{

		
		}	

	return $html;
	
	}
	
	
	function cp_newsletter_mosque($atts ,$content = null){
	//Fetch Parameters
		extract(shortcode_atts(array(
			'logo_url' => '',
			'email' => '',
			'facebook_url' => '',
			'twitter_url' => '',
			'rss_url' => ''				
			
		), $atts));
		
		$html = '';

		$html = '
			<div class="newsletter_mosque">
				<img class = "newsletter_logo" src = "'.$logo_url.'" alt = "logo">
				<p>'.do_shortcode($content).'</p>
				<form class="newsletter-form get-touch-form" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(&#34;http://feedburner.google.com/fb/a/mailverify?uri='.$email.'&#34;, &#34;popupwindow&#34;, &#34;scrollbars=yes,width=600,height=550&#34;)">
					<input type="text" class="input-newsletter feedemail-input" name="email" onblur="this.value=this.value==&#34;&#34;?&#34;Enter your email&#34;:this.value;" onfocus="this.value=this.value==&#34;Your Email Address&#34;?&#34;&#34;:this.value" value="Your Email Address" />
					<input type="hidden" value="'.esc_attr($email).'" name="uri"/>
					<input type="hidden" name="loc" value="en_US"/>
					<button type="submit" value=""><i class="fa fa-arrow-right"></i></button>
				</form>
				<div class = "social_icons">
					<ul>
						<li><a href="'.$facebook_url.'" target="_top"><i class="fa fa-facebook-square"></a></i></li>
						<li class = "rss_icon"><a href = "'.$rss_url.'"><i class="fa fa-rss"></i></a></li>
						<li><a href="mailto:'.$email.'" target="_top"><i class="fa fa-envelope"></i></a></li>
						<li><a href="'.$twitter_url.'" target="_top"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>';
		
		return $html;
		
	}
	
	
	
	
	
	//ToolTip ShortCode Start
	function cp_tooltip_shortcode($atts,$content = null){
		//Fetch parameters
		extract(shortcode_atts(array(
			'title' => '',			
		), $atts));	
		//HTML Markup
		return '<span class="cp-tooltip-wrapper"><a href="#" data-toggle="tooltip" title="'.$title.'" class="cp-tooltip">'.do_shortcode($content).'</a></span>';
	
	}

	//Siderbar Shortcode Start
	function cp_widget_bar_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			"name" => ''
		), $atts));
		echo '<div class="row">';
			dynamic_sidebar( $name );
		echo '</div>';
	}
	
	//Siderbar Shortcode Start
	function cp_flexslider_shortcode($atts,$content = null){
		//Fetch Parameters
		extract(shortcode_atts(array(
			"layout" => '',
			"excerpt" => '',
			"category" => '',
			"limit" => '',
			"id" => '',
			"lightbox" => ''
			
		), $atts));
		
	}
	
		
	// 1/2, 1/3, 1/4 etc Column Layout ShortCode Start
	function cp_column_shortcode($atts, $content = null)
	{
			//Fetch Parameters
			extract(shortcode_atts(array(
			"col" => '1/1'
		), $atts));
		//Switch For Selecting the Layout
		switch ($col) {
			case '1/4':
				return '<div class="shortcode1-4">' . do_shortcode($content) . '</div>';
			case '1/3':
				return '<div class="shortcode1-3">' . do_shortcode($content) . '</div>';
			case '1/2':
				return '<div class="shortcode1-2">' . do_shortcode($content) . '</div>';
			case '2/3':
				return '<div class="shortcode2-3">' . do_shortcode($content) . '</div>';
			case '3/4':
				return '<div class="shortcode3-4">' . do_shortcode($content) . '</div>';
			default:
			case '1/1':
				return '<div class="shortcode1">' . do_shortcode($content) . '</div>';
		}
	}
	
			
	
	
	// Accordion ShortCode Start
	function cp_accordion_shortcode($atts, $content = null)
	{
		
		//wp_enqueue_script('jquery-ui-accordion');

		wp_register_script('cp-accordian-script', CP_PATH_URL.'/frontend/shortcodes/js/accordian_script.js', false, '1.0', true);
		wp_enqueue_script('cp-accordian-script');
		
		static $counter_accordion = 1;
		$counter_accordion++;
		$accordion = '';
				$accordion .= '<script type="text/javascript">
       jQuery(document).ready(function($) {

        //custom animation for open/close
        $.fn.slideFadeToggle = function(speed, easing, callback) {
            return this.animate({opacity: "toggle", height: "toggle"}, speed, easing, callback);
        };

        $(".custom_accordion_cp").accordion({
            defaultOpen: "section-1",
            cookieName: "nav",
            speed: "slow",
            animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
                elem.next().stop(true, true).slideFadeToggle(opts.speed);
            },
            animateClose: function (elem, opts) { //replace the standard slideDown with custom function
                elem.next().stop(true, true).slideFadeToggle(opts.speed);
            }
        });
    });
    </script>';
	
		//HTML Markup
		$accordion .= "<div class='cp-accordion'>";
		$accordion .= do_shortcode($content);
		$accordion .= "</div>";
		return $accordion;
	}

	//Accordion ITEM Shortcode Start
	function cp_acc_item_shortcode($atts, $content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			"title" => ''
		), $atts));
		static $acc_count = 1;
			
		//HTML Markup For ITEMS IN Accordion
		$acc_item='';
		
		$acc_item .= '<div class="custom_accordion_cp" id="section'.$acc_count.'">';		
		$acc_item .= '<p>'.$title . "</p><span><i class='fa fa-minus'></i></span></div>";
		$acc_item .= '<div class="container_cp_accor">
							<div class="content_cp_accordian">
								' . do_shortcode($content) . "
							</div>
						</div>";
		$acc_count++;
		return $acc_item;
	}

	
	// shortcode for toggle box
	function cp_toggle_box_shortcode($atts, $content = null)
	{
		
		wp_register_script('cp-accordian-script', CP_PATH_URL.'/frontend/shortcodes/js/accordian_script.js', false, '1.0', true);
		wp_enqueue_script('cp-accordian-script');
		$toggle_box = "<div class='accordion'>";
		$toggle_box = $toggle_box . do_shortcode($content);
		$toggle_box = $toggle_box . "</div>";
		return $toggle_box;
	}
	
	//Toggle Shortcode
	function cp_toggle_item_shortcode($atts, $content = null)
	{
		extract(shortcode_atts(array(
			"title" => '',
			"active" => 'false'
		), $atts));
		$active      = ($active == "true") ? " " : '';
		$toggle_item = "<li class='cp-divider'>";
		$toggle_item = $toggle_item . "<h3 class='accordion-heading'><a href=''>";
		$toggle_item = $toggle_item . "<span class='toggle-box-head-image" . $active . "'></span>";
		$toggle_item = $toggle_item . $title . "</a></h3>";
		$toggle_item = $toggle_item . "<p class='toggle-box-content" . $active . "'>" . do_shortcode($content) . "</p>";
		$toggle_item = $toggle_item . "</li>";
		return $toggle_item;
	}
	
	// shortcode for tab
	//$cp_tab_array = array();
	
	//Tabs ShortCode Start
	function cp_tab_shortcode($atts, $content = null)
	{
		global $cp_tab_array,$counter;
		$cp_tab_array = array();
		do_shortcode($content);
		$num = sizeOf($cp_tab_array);
		//Calling Required Files And Scripts
		wp_enqueue_script('jquery-ui-tabs');
		wp_register_script('cp-tabs-script', CP_PATH_URL.'/frontend/shortcodes/js/tabs_script.js', false, '1.0', true);
		wp_enqueue_script('cp-tabs-script');
		//Loop For Horizontal Tabls
		$tab = "<div id='horizontal-tabss' class='tabs tabs-widget tabs-box'><ul class='cp-divider nav nav-tabs'>";
		for ($i = 0; $i < $num; $i++) {
			$active = ($i == 0) ? 'active' : '';
			$tab_id = str_replace(' ', '-', $cp_tab_array[$i]["title"]);
			$tab    = $tab . '<li><a href="#' . $tab_id.$i . '" class=" ';
			$tab    = $tab . $active . '" >' . $cp_tab_array[$i]["title"] . '</a></li>';
		}
		$tab = $tab . "</ul>";
		// Tab Content
		$tab = $tab . "<ul class='contents tab-content'>";
		for ($i = 0; $i < $num; $i++) {
			$active = ($i == 0) ? 'active' : '';
			$tab_id = str_replace(' ', '-', $cp_tab_array[$i]["title"]);
			$tab    = $tab . '<li id="' . $tab_id.$i . '" class="tabscontent">';
			$tab    = $tab . $cp_tab_array[$i]["content"] . '</li>';
		}
		$tab = $tab . "</ul></div>";
		return $tab;
	}
	
	//Tab ITEM Shortcode Start
	function cp_tab_item_shortcode($atts, $content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			"title" => ''
		), $atts));
		global $cp_tab_array;
			$cp_tab_array[] = array(
			"title" => $title,
			"content" => do_shortcode($content)
		);
	}
	
	// Separator Shortcode Start
	function cp_divider_shortcode($atts)
	{
	//Calling Required Files and Scripts
	wp_register_script('cp-top-script', CP_PATH_URL.'/frontend/shortcodes/js/jquery.scrollTo-min.js', false, '1.0', true);
	wp_enqueue_script('cp-top-script');
		extract(shortcode_atts(array(
			"scroll_text" => ''
		), $atts));
		//HTML Markup
		$divider = '<div class="divider"><div class="scroll-top"><a href="">Back To Top</a>';
		$divider = $divider . $scroll_text . '</div></div>';
		return $divider;
	}
	
	
	//Youtube ShortCode Start
	function cp_youtube_shortcode($atts, $content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			"height" => '',
			"width" => ''
		), $atts));
		$id = array('1'=>'55');
		//HTML MarkUp
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $content, $id);
			$youtube = '';
		if(!empty($id)){
			$youtube .= '<div style="max-width:' . $width .'" >';
			$youtube .= '<iframe src="http://www.youtube.com/embed/' . $id[1] . '?wmode=transparent" width="' . $width . '" height="' . $height . '" ></iframe>';
			$youtube .= '</div>';
		}
		return $youtube;
	}
	
	
	//Vimeo ShortCode Start
	function cp_vimeo_shortcode($atts, $content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			"height" => '',
			"width" => ''
		), $atts));
		$id = array('1'=>'55');
		//fetch_vimeo_id("https://vimeo.com/donialiechti/stranded");
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $content, $id);
		
		$vimeo = '<div style="max-width:' . $width . '" >';
		if(!empty($id)){
		$vimeo = $vimeo . '<iframe src="http://player.vimeo.com/video/' . $id[1] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" ></iframe>';
		}
		$vimeo = $vimeo . '</div>';
		return $vimeo;
	}
	
	// Button ShortCode Start
	function cp_button_shortcode($atts, $content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			"color" => '',
			"size" => 'large',
			"link" => '#',
			'target' => '_self'
		), $atts));
		//HTML Markup
		$button_border = '';
		if (!empty($background)) {
			$button_border = '#' . hexDarker(substr($background, 1), 5);
		}
		return '<a href="' . $link . '" target="' . $target . '" class="cp-button shortcode-' . $size . '-button" style="background-color:' . $color . '; ">' . $content . '</a>';
	}
	

	// function cp_button_fontawesome(){
	
		// extract(shortcode_atts(array(
			// "color" => '',
			// "type" => '',
			// "font_size" => '',
			// "src" => '#',
			// 'target' => '_self'
		// ), $atts));
		// $button_border = '';
		// if (!empty($background)) {
			// $button_border = '#' . hexDarker(substr($background, 1), 5);
		// }
		// return '<a href="' . $src . '"><button class="button-style"><i style="color:'.$color.';font:'.$font_size.'" class="'.$type.'"></i></button></a>';
	// }
	
	
	function cp_list_shortcode($atts, $content = null)
	{
		extract(shortcode_atts(array(
			"type" => 'check'
		), $atts));
		return '<div class="shortcode-list shortcode-list-' . $type . '">' . $content . '</div>';
	}
	
	//Social Icons
	function cp_social_shortcode($atts, $content = null)
	{
		extract(shortcode_atts(array(        
			"size" => 'large',
			"src" => '#',
			"type"=> 'facebook',
		), $atts));
			$social = '<div class="space_btwn socialicons" class="">';
			$social = $social . '<a title="'.$content.'" href="'.$src.'" class="'.$size.' social_active '.$type.'" id=""><span class="da-animate da-slideFromLeft"></span></a></div>';
		return $social;
	}
	
	//BlockQuotes
	function cp_quote_shortcode($atts, $content = null)
	{
		extract(shortcode_atts(array(
			"style" => 'quote-box-2',
			"image" => 'default',
		), $atts));
		if($style == 'quote-box-2'){
			return '<div class="quote-box-2">
				<blockquote> <i class="icon-quote-left"></i>
				  <p>'.$content.' <i class="icon-quote-right"></i></p>
				</blockquote>
			</div>';
		}else if($style == 'quote-box'){
		return '<div class="quote-box">
					<blockquote class="quote"> <i class="icon-quote-right"></i>
						 <p>'.$content.'</p>
					</blockquote>
				</div>';
		}else if($style == 'quote-box-1'){
		
		if($image <> 'default'){$image = '<div class="quote-frame"><img src="'.$image.'" alt=""/></div>';}else{$image = '';}
		return '<div class="quote-row">'.$image.'
		<blockquote> <i class="icon-quote-left"></i>
		  <p>'.$content.'</p>
		</blockquote>
	  </div>';
		}else{
			echo 'Please Add STYLE (quote-box , quote-row , quote-box-2)';
		}
		//return '<div class="blockquote-style quote-' . $align . '" style="color:' . $color . '">' . $content . '</div>';
	}
	
	//ShortCode For Blog Start
	function cp_blog_shortcode($atts, $content = null)
	{
		wp_reset_query();
		wp_reset_postdata();
		
		//Fetch parameters
		extract(shortcode_atts(array(
			"number_posts" => '',
			"cat_id" => '',
			"title" => '',								
			"excerpt_words" => '',
			"pagination" => '',				
		), $atts));			
		query_posts(array( 
			'post_type' => 'portfolio',
			'showposts' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio-category',
					'terms' => $cat_id,
					'field' => 'term_id',
				)
			),
			'orderby' => 'title',
			'order' => 'ASC' )
		);
		
		wp_reset_query();
		wp_reset_postdata();
		
		//return $blog_item_html;
		
	}
	
	function cp_portfolio_shortcode($atts, $content = null)
	{
		extract(shortcode_atts(array(
			"number_posts" => '',
			"cat_id" => '',
			"title" => '',								
			"excerpt_words" => '',
			"pagination" => '',				
		), $atts));			
			query_posts(array( 
				'post_type' => 'portfolio',
				'showposts' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio-category',
						'terms' => $cat_id,
						'field' => 'term_id',
					)
				),
				'orderby' => 'title',
				'order' => 'ASC' )
			);
			while( have_posts() ){
			the_post();
			//Fetching All Tracks from Database
			$track_name_xml = get_post_meta($post->ID, 'add_project_xml', true);
			$track_url_xml = get_post_meta($post->ID, 'add_project_field_xml', true);
			
			//Empty Variables
			//$album_download = '';
			$children = '';
			$children_title = '';

			//Track Name
			if($track_name_xml <> ''){
				$ingre_xml = new DOMDocument();
				$ingre_xml->recover = TRUE;
				$ingre_xml->loadXML($track_name_xml);
				$children_name = $ingre_xml->documentElement->childNodes;
			}		
			
			//Track URL
			if($track_url_xml <> ''){	
				$ingre_title_xml = new DOMDocument();
				$ingre_title_xml->recover = TRUE;
				$ingre_title_xml->loadXML($track_url_xml);
				$children_title = $ingre_title_xml->documentElement->childNodes;
			} 
			$port_class = '';
			if($counter_team % 4 == 0){$port_class= 'first';}else{$post_class = 'no-class';}$counter_team++; ?>
				<!--LIST ITEM START-->
				<li class="span3 <?php echo $port_class;?>">
					<div class="portfolio-wrapper">
						<div class="thumb">
							<?php echo get_the_post_thumbnail($post->ID, array(614,614));?>
							<div class="caption">
								<h5><?php echo get_the_title();?></h5>
								<p><?php 
									$variable_category = wp_get_post_terms( $post->ID, 'portfolio-category');
									$counterr = 0;
									foreach($variable_category as $values){														
										$counterr++;
										echo '<a class="portfolio-tag" href="'.get_term_link(intval($values->term_id),'portfolio-category').'">'.$values->name.'</a>  ';}
									?>
								</p>
								<div class="rating">
									<span>?</span><span>?</span><span>?</span><span>?</span><span>?</span>
								</div>
								<p><?php echo substr(get_the_content(),0,200);?></p>
							</div>
						</div>
						<div class="text">
							<?php
							//Combine Loop
							if($track_name_xml <> '' || $track_url_xml <> ''){
								$counter = 0;
								$nofields = $ingre_xml->documentElement->childNodes->length;
								for($i=0;$i<1;$i++) { 
									$counter++;
									echo '<h5>'.$children_name->item($i)->nodeValue.'</h5>';
									echo '<p>'.$children_title->item($i)->nodeValue.'</p>';
								}
							}		
							?>
							<a href="<?php echo get_permalink();?>" class="view-project"><?php _e('View Project','');?></a>
						</div>
					</div>
				</li>
				<!--LIST ITEM START-->
			<?php
			}
		
		return $port_item_html;
	}
	
	
	//DropCap ShortCode Start
	function cp_dropcap_shortcode($atts, $content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			"color" => '',				
		), $atts));
		static $dropcap = 0;
		$dropcap++;
		//HTML MarkUp
		return '<style scoped>#cp-dropcap-'.$dropcap.'{color:'.$color.';}</style><span id="cp-dropcap-'.$dropcap.'" class="cp-dropcap">' . $content . '</span>';
	}
	
	//Highlight ShortCode Start
	function cp_highlight_shortcode($atts, $content = null)
	{
		//Fetch Parameters
		extract(shortcode_atts(array(
			"color" => '',				
		), $atts));
		static $highlight = 0;
		$highlight++;
		//HTML MarkUp
		return '<style scoped>.highlight-'.$highlight.'{background-color:'.$color.'}</style><mark class="cp-highlight highlight-'.$highlight.'">' . $content . '</mark>';
	}
	
	
	
	//Alert Box ShortCode Start
	function cp_message_box_shortcode($atts, $content = null)
	{
	//Fetch Parameters
		extract(shortcode_atts(array(				
			'icon' => '',
			'color_light' => '',
			'color_dark' => '',
		), $atts));
		static $counter_alert = 1;
		$counter_alert++;
		
		//HTML Markup 
		$message_box = '<style scoped>#alert-'.$counter_alert.':before{content:"'.get_fontawesome_code($icon).'";} 
		#alert-'.$counter_alert.' .close{content:"\f00d";}
		#alert-'.$counter_alert.'{
			background: '.$color_light.';
			background: -webkit-gradient(linear, 0 0, 0 bottom, from('.$color_light.'), to('.$color_dark.'));
			background: -webkit-linear-gradient('.$color_light.', '.$color_dark.');
			background: -moz-linear-gradient('.$color_light.', '.$color_dark.');
			background: -ms-linear-gradient('.$color_light.', '.$color_dark.');
			background: -o-linear-gradient('.$color_light.', '.$color_dark.');
			background: linear-gradient('.$color_light.', '.$color_dark.');
		}</style><div id="alert-'.$counter_alert.'" class="alert error"><button data-dismiss="alert" class="close" type="button"><i class="fa fa-times"></i></button>';
		$message_box = $message_box . '<p class="pull-left">' . $content . '</p>';
		$message_box = $message_box . '</div>';
		return $message_box;
	}
		
		
	function get_fontawesome_code($icon_code = ''){
		// Fontawesome icons list
		$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$fontawesome_path = CP_TINYMCE_DIR . '/css/font-awesome.css';
		if( file_exists( $fontawesome_path ) ) {
			@$subject = file_get_contents($fontawesome_path);
		}

		preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

		foreach($matches as $match){
			//$icons[$match[1]] = $match[2];
			if($match[1] == $icon_code){
				$icon_code = $match[2];
			}
		}
		return $icon_code;
	}