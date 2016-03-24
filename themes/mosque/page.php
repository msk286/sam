<?php
/*
 * This file is used to generate different page layouts set from backend.
 */
 
 	//Fetch the theme Option Values
	$cp_maintenance_mode = cp_get_themeoption_value('maintenance_mode','general_settings');
	$maintenace_title = cp_get_themeoption_value('maintenace_title','general_settings');
	$countdown_time = cp_get_themeoption_value('countdown_time','general_settings');
	$email_mainte = cp_get_themeoption_value('email_mainte','general_settings');
	$mainte_description = cp_get_themeoption_value('mainte_description','general_settings');
	$social_icons_mainte = cp_get_themeoption_value('social_icons_mainte','general_settings');
	
	if($cp_maintenance_mode <> 'disable'){
		//If Logged in then Remove Maintenance Page
		if ( is_user_logged_in() ) {
			$cp_maintenance_mode = 'disable';
		} else {
			$cp_maintenance_mode = 'enable';
		}
	}
	
	if($cp_maintenance_mode == 'enable'){
		//Trigger the Maintenance Mode Function Here
		cp_maintenance_mode_fun();
	}else{
 
get_header ();

	global $post,$post_id;
		$page_builder_full = get_post_meta ( $post->ID, "cp-show-full-layout", true );      
		if($page_builder_full == 'No'){
			$cp_sidebar_class = '';
			$content_class = '';
			$sidebar = get_post_meta ( $post->ID, 'page-option-sidebar-template', true );
			$cp_sidebar_class = cp_sidebar_func($sidebar);
			$left_sidebar = get_post_meta ( $post->ID, "page-option-choose-left-sidebar", true );
			$right_sidebar = get_post_meta ( $post->ID, "page-option-choose-right-sidebar", true );
		}else{
			$cp_sidebar_class = array('0'=>'no-sidebar','1'=>'col-md-12',);
			$content_class = array();
			$sidebar = array();
			$left_sidebar = '';
			$right_sidebar = '';
		}	
		
		
		$slider_off = '';
		$slider_type = '';
		$slider_slide = '';
		$slider_height = '';
		
		//Fetch the data from page
		
		$slider_off = get_post_meta ( $post->ID, "page-option-top-slider-on", true );
		$slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
		$slider_type_album = get_post_meta ( $post->ID, "page-option-top-slider-album", true );
		$page_builder_full = get_post_meta ( $post->ID, "cp-show-full-layout", true );
		$cp_page_title = get_post_meta ( $post->ID, "page-option-item-page-title", true );
		$cp_banner_text = get_post_meta ( $post->ID, "page-option-top-banner-text", true );
		$cp_page_caption = get_post_meta ( $post->ID, "cp-show-page-caption-pageant", true );
		
		
		$cp_class_sch = '';
		$cp_page_title = get_post_meta ( $post->ID, "page-option-schedule-title", true );
		$cp_schedule = get_post_meta ( $post->ID, "page-option-top-schedule-mana", true );
		if($cp_schedule == 'No-Option'){
			$cp_class_sch = '';
		}else{
			$cp_class_sch = 'hide_caption';
		}
		
		$schedule_title = get_post_meta ( $post->ID, "page-option-schedule-title", true );
		$resv_button = cp_get_themeoption_value('resv_button','general_settings');
		$resv_text = cp_get_themeoption_value('resv_text','general_settings');
		$resv_short = cp_get_themeoption_value('resv_short','general_settings');
		
		//Video Banner Settings
		$cp_slider_settings = get_option('slider_settings');
		
		if($cp_slider_settings <> ''){
			$cp_slider = new DOMDocument ();
			
			$cp_slider->loadXML ( $cp_slider_settings );
			
			//Video Banner Values
			$cp_video_slider_on_off = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_slider_on_off');
			$cp_video_banner_url = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_url');
			$cp_video_banner_title = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_title');
			$cp_video_banner_caption = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_caption');
			
			$cp_video_banner_btn_text = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_btn_text');
			$cp_video_banner_btn_link = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_btn_link');
			
			//$safari_banner = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','safari_banner');
			$cp_safari_banner_link = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','safari_banner_link');
			
		}
		
		//Video Banner
		if($cp_video_slider_on_off == 'enable'){
			if($cp_video_banner_url <> ''){
				if (is_front_page()){
					echo '<div id="video-banner">';
						$agent = '';
						$browser = '';
						if(isset($_SERVER['HTTP_USER_AGENT'])){
							 $agent = $_SERVER['HTTP_USER_AGENT'];
						}

						if(strlen(strstr($agent,'Safari')) > 0 ){
							$browser = 'safari';
						   if(strstr($agent,'Chrome')){
							 $browser= 'chrome';
						   }
						}
							if($browser=='safari'){ ?>
								<div class="video-block" style="width:100%; height:900px;" data-vide-bg="" data-vide-options="position: 0% 50%"><img src = "<?php echo esc_url($cp_safari_banner_link); ?>"></div>
							<?php }else{ ?>
								<div class="video-block" style="width:100%; height:900px;" data-vide-bg="<?php echo esc_url($cp_video_banner_url); ?>" data-vide-options="position: 0% 50%"></div>				
							<?php } ?>
							
							<div class="caption">
								<h1><?php echo esc_attr($cp_video_banner_title); ?></h1>
								<p><?php echo esc_attr($cp_video_banner_caption); ?></p>
								<a href="<?php echo esc_url($cp_video_banner_btn_link); ?>" class="btn-purchase"><?php echo esc_attr($cp_video_banner_btn_text); ?></a>
							</div>
						</div>
			<?php }
			}
		}elseif(class_exists('cp_slider_class')){
			//Bx Slider
			if($slider_off == 'Yes'){
					echo '<div class="banner_edu">';
					echo cp_page_slider();
					echo '</div>';
				if($cp_schedule <> 'No-Option'){
					echo '<div class="clearfix"></div>';	
				}
			} //Slider Off			
		}else {
			// Nothing Here
		}
		
		global $post, $post_id;
		if(is_search() || is_404()){
			$header_style = '';
		}else{
			$header_style = get_post_meta ( $post->ID, "page-option-top-header-style", true );
		}
		$html_class = cp_print_header_class($header_style);
		//Print Style 5
		
		if(cp_print_header_html_val($header_style) == 'Style 5'){
			
			cp_print_header_html($header_style);
		}
		$cp_header_class = '';
		$cp_header_class = cp_print_header_selected();
		
		
		
		if($cp_header_class == 'header-style-3'){
			if(is_front_page()){
				$cp_header_class = '';
			}else{
				$cp_header_class == 'header-style-3';
			}
		}
		
		$class_bread_margin = '';
		$breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
		if($breadcrumbs == 'disable'){
			$class_bread_margin = 'margin_top_cp';
		}else{
			$class_bread_margin = '';
		}
	
	?>

	<div class="clear clearfix"></div>
	<!--CONTANT SECTION START-->
	<div class="content crunchpress <?php echo esc_attr($cp_header_class);?>">
		<?php if($slider_off <> 'Yes'){ ?>
			<!--Inner Pages Heading Area Start-->
			<div id="banner">
				<div id="inner-banner">
					<div class="container">
						<?php if(get_the_title() <> ''){ ?>
							<h1><?php echo esc_attr(get_the_title());?></h1>
						<?php }
						//Breadcrumbs
						if($breadcrumbs == 'enable'){
							if(!is_front_page()){
								echo cp_breadcrumbs();
							}
						} ?>
					</div>
				</div>
			</div>
			<!--Inner Pages Heading Area End--> 	
		<?php }?>
		<div class="clearfix"></div>
		<!--BREADCRUMS END--> 
		<div class="<?php if($page_builder_full <> 'Yes'){echo 'container';}else{echo 'container-fluid margin-top-bottom-cp ';}?>">
			<?php if($slider_off == 'No'){ ?>
				<?php if($page_builder_full == 'Yes'){echo '<div class="container">';}?>
				<?php if($cp_page_title <> ''){ ?>
					<h2 class="h-style"><?php echo esc_attr($cp_page_title);?></h2>
				<?php }?>
				<?php if($page_builder_full == 'Yes'){echo '</div>';}?>
			<?php }?>    
			<!--MAIN CONTANT ARTICLE START-->
			<div class="main-content <?php if($page_builder_full <> 'Yes'){echo 'margin-top-bottom-cp';}?>">
				<div class="page_content row">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){ ?>
						<div id="block_first" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
						  <?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
					<?php
					}
					if($sidebar == 'both-sidebar-left'){ ?>
						<div id="block_first_left" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
						  <?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php } ?>
					<div id="block_content_first" class="<?php echo esc_attr($cp_sidebar_class[1]);?>">
						<div class="">
							<div class="<?php if(cp_get_themeoption_value('select_layout_cp','general_settings') == 'boxed_layout'){echo 'row-fluid';}else{echo 'row';}?>">
								<?php
								$cp_page_xml = get_post_meta($post->ID,'page-option-item-xml', true);		
									global $cp_item_row_size;
									$cp_item_row_size = 0;	
									$counter = 0;
									// Page Item Part
									if (! empty ( $cp_page_xml )) {
										$page_xml_val = new DOMDocument ();
										$page_xml_val->loadXML ( $cp_page_xml );
										foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
											$counter++;
											switch ($item_xml->nodeName) {
												case 'Accordion' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm' );
													cp_print_accordion_item ( $item_xml );
													echo '</div>';
													break;
												case 'Blog' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'blog-post');
													cp_print_blog_item ( $item_xml );
													echo '</div>';
												break;
												
												case 'Blog-Slider' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'');
													cp_print_blog_slider_item ( $item_xml );
													echo '</div>';
												break;
												case 'Heading-Banner' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'');
													cp_heading_style ( $item_xml );
													echo '</div>';
												break;
												case 'Offers' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'');
													$cp_service_class = new cp_service_class;
													$cp_service_class->cp_offers_element ( $item_xml );
													echo '</div>';
												break;
												case 'Timeline' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm timeline-posts');
													if(class_exists('cp_timeline_class')){
														$cp_timeline_class = new cp_timeline_class;
														$cp_timeline_class->print_timeline_item($item_xml);
													}													
													echo '</div>';
													break;
												case 'Events-Slider' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm timeline-posts');
													if(class_exists('EM_Events')){
														$cp_events_class = new cp_events_class;
														$cp_events_class->print_events_slider($item_xml);
													}											
													echo '</div>';
													break;
													
												case 'Service' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm timeline-posts');
													if(class_exists('cp_service_class')){
														$cp_service_class = new cp_service_class;
														$cp_service_class->print_service_item($item_xml);
													}													
													echo '</div>';
													break;
													
												case 'Classes' :
												cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm timeline-posts');
												if(class_exists('cp_classes_class')){
													$cp_classes_class = new cp_classes_class;
													$cp_classes_class->print_classes_item($item_xml);
												}													
												echo '</div>';
												break;
												case 'Attractions' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm attractions');
													if(class_exists('cp_attractions_class')){
														$cp_attractions_class = new cp_attractions_class;
														$cp_attractions_class->print_attractions_item($item_xml);
													}													
													echo '</div>';
												break;
												
												case 'Destinations' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm attrac-slider');
													if(class_exists('cp_attractions_class')){
														$cp_attractions_class = new cp_attractions_class;
														$cp_attractions_class->destinations_slider($item_xml);
													}													
													echo '</div>';
												break;
												
												case 'Division_Start' :
													if($page_builder_full == 'Yes'){
														// cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ));
														// echo '</article>';
														cp_print_div_item ( $item_xml );
													}	
													
													break;	
												case 'Division_End' :
													if($page_builder_full == 'Yes'){
														// cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ));
														// echo '</article>';
														cp_print_div_end_item ( $item_xml );
													}	
													break;		
												case 'Events' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'event_calendar-cp mbtm');
													if(class_exists('function_library')){
														if(class_exists('EM_Events')){
															$cp_events_class = new cp_events_class;
															$cp_events_class->page_event_manager_plugin($item_xml);
														}
													}
													echo '</div>';
													break;
												
												case 'Woo-Products' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm woo-produ-cp');
													if(class_exists('function_library')){
														if(class_exists("Woocommerce")){
															print_wooproduct_item ( $item_xml );
														}	
													}
													echo '</div>';
												break;
												
												case 'Store' :
													if(class_exists('function_library')){
														if(class_exists("Woocommerce")){
															cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm woo-produ-cp');
																$cp_products_class = new cp_products_class;
																$cp_products_class->print_store_item ( $item_xml ); 
														}	
													}
													echo '</div>';
												break;
												
												case 'Products_Slider' :
													if(class_exists('function_library')){
														if(class_exists("Woocommerce")){
															cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm home-blog');
																$cp_products_class = new cp_products_class;
																$cp_products_class->print_products_slider_item ( $item_xml ); 
														}	
													}
													echo '</div>';
												break;
												
												case 'Sermons-Gallery' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm sermons-gallery-cp');
													if(class_exists('cp_album_class')){
														$cp_album_class = new cp_album_class;
														$cp_album_class->print_gallery_sermons_item ( $item_xml );
													}
													echo '</div>';
												break;
												case 'Latest-News' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm latest-news-box');
													cp_print_featured_item ( $item_xml );
													echo '</div>';
												break;
												case 'Sermons' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm sermons-cp');
													if(class_exists('cp_sermons_class')){
														$cp_sermons_class = new cp_sermons_class;
														$cp_sermons_class->print_sermons_listing_item ( $item_xml );
													}
													echo '</div>';
												break;
												case 'Events-Counter' :
													if(class_exists('function_library')){
														if(class_exists('EM_Events')){
															cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm');
															$cp_events_class = new cp_events_class;
															$cp_events_class->print_count_events_item ( $item_xml );
															echo '</div>';
														}
													}
												break;
												case 'Latest-Sermon' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm latest-seromns');
													if(class_exists('cp_sermons_class')){
														$cp_sermons_class = new cp_sermons_class;
														$cp_sermons_class->print_sermons_latest_item ( $item_xml );
													}
													echo '</div>';
												break;
												case 'Event-Slider' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm upcoming-events-box');
													if(class_exists('function_library')){
														if(class_exists('EM_Events')){
															$cp_events_class = new cp_events_class;
															$cp_events_class->print_upcomming_event ( $item_xml );
														}
													}
													echo '</div>';
												break;
												case 'Single-Sermons' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm single-sermons-cp');
													if(class_exists('cp_album_class')){
														$cp_album_class = new cp_album_class;
														$cp_album_class->print_sermons_ofweek_item ( $item_xml );
													}
													echo '</div>';
													break;
												case 'Newest-Sermons' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm newest-sermons-cp');
													if(class_exists('cp_album_class')){
														$cp_album_class = new cp_album_class;
														$cp_album_class->print_newest_sermons_item ( $item_xml );
													}
													echo '</div>';
													break;													
												case 'Modern-Blog' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm');
													cp_print_blog_modern_item ( $item_xml );
													echo '</div>';
													break;	
												case 'Sidebar' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm');
													cp_print_sidebar_item ( $item_xml );
													echo '</div>';
													break;		
												case 'Pastors' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'pastors fadeIn cp_load mbtm');
													if(class_exists('cp_album_class')){
														$cp_album_class = new cp_album_class;
														$cp_album_class->print_pastor_item_item ( $item_xml );
													}
													echo '</div>';
													break;		
												case 'News' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm latest-news-cp');
													cp_print_news_item ( $item_xml );
													echo '</div>';
													break;
												case 'Our-Team' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm our-team-cp');
													if(class_exists('cp_team_class')){
													$cp_team_class = new cp_team_class;
														$cp_team_class->print_team_item ( $item_xml );
													}
													echo '</div>';
													break;
												case 'Team-Slider' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm staff-wrapp');
													if(class_exists('cp_team_class')){
													$cp_team_class = new cp_team_class;
														$cp_team_class->print_team_item_slider ( $item_xml );
													}
													echo '</div>';
													break;	
												case 'Contact-Form' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ), 'mt0 signup mbtm' );
													cp_print_contact_form ( $item_xml );
													echo '</div>';
													break;
												case 'Column' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm column' );							cp_print_column_item ( $item_xml );
													echo '</div>';
													break;
												case 'Features' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'feature fadeIn cp_load mbtm' );
													echo cp_print_column_service ( $item_xml );
													echo '</div>';
													break;
												case 'Content' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ) ,'fadeIn cp_load mbtm');
													cp_print_content_item ( $item_xml );
													echo '</div>';
													break;
												case 'Divider' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ), 'wrapper fadeIn cp_load' );
													cp_print_divider ( $item_xml );
													echo '</div>';
													break;
												case 'Gallery' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'overflow_class mbtm');
													cp_print_gallery_item ( $item_xml );
													echo '</div>';
													break;
												case 'Message-Box' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm' );
													cp_print_message_box ( $item_xml );
													echo '</div>';
													break;
												case 'Slider' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ), 'containter_slider fadeIn cp_load mbtm' );
													cp_print_slider_item ( $item_xml );
													echo '</div>';
													break;
												case 'Tab' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'fadeIn cp_load mbtm about' );
													cp_print_tab_item ( $item_xml );
													echo '</div>';
													break;
												case 'Testimonial' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm');
													if(class_exists('cp_testi_class')){
													$cp_testi_class = new cp_testi_class;
														$cp_testi_class->print_testimonial ( $item_xml );
													}
													echo '</div>';
													break;
												case 'Client-Slider' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm quote-bg');
													if(class_exists('cp_testi_class')){
													$cp_testi_class = new cp_testi_class;
														$cp_testi_class->print_testimonial_slider ( $item_xml );
													}
													echo '</div>';
													break;	
												case 'Portfolio' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm portfolio-gallery-cp');
													if(class_exists('cp_portfolio_class')){
													$cp_portfolio_class = new cp_portfolio_class;
														$cp_portfolio_class->print_port_item ( $item_xml );
													}
													echo '</div>';
													break;	
												case 'Portfolio-Gallery' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm');
													if(class_exists('cp_portfolio_class')){
													$cp_portfolio_class = new cp_portfolio_class;
														$cp_portfolio_class->portfolio_gallery ( $item_xml );
													}
													echo '</div>';
													break;
												case 'Carousel' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm');
													if(class_exists('cp_timeline_class')){
													$cp_timeline_class = new cp_timeline_class;
														$cp_timeline_class->timeline_slider ( $item_xml );
													}
													echo '</div>';
													break;	
												case 'Crowd-Funding' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm');
													print_ignition_item($item_xml);
													echo '</div>';
													break;	
												case 'Feature-Projects' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm');
													cp_feature_projects($item_xml);
													echo '</div>';
													break;													case 'Crowd-Slider' :													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm');													cp_print_ignition_slider_item($item_xml);
													echo '</div>';												
													break;	
													
												case 'Toggle-Box' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm' );
													cp_print_toggle_box_item ( $item_xml );
													echo '</div>';
													break;
												case 'DonateNow' :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm' );
													cp_print_donate_item ( $item_xml );
													echo '</div>';
													break;	
												default :
													cp_print_item_size ( cp_find_xml_value ( $item_xml, 'size' ),'mbtm' );
													echo '</div>';
													break;
											}
										}
										//Content Area
										if($page_xml_val->documentElement->childNodes->length == 0){
											echo '<div class="col-md-12">';
												cp_print_default_content_item();
											echo '</div>';
										}										
									}else{
										echo '<div class="col-md-12">';
											cp_print_default_content_item();
										echo '</div>';
									}
							   ?>
							</div>
						</div>
					</div>
					<?php
					wp_reset_postdata();
					wp_reset_query();
					global $post,$post_id;
					$page_builder_full = get_post_meta ( $post->ID, "cp-show-full-layout", true );      
					
					if($page_builder_full == 'No'){
						$cp_sidebar_class = '';
						$content_class = '';
						$sidebar = get_post_meta ( $post->ID, 'page-option-sidebar-template', true );
						$cp_sidebar_class = cp_sidebar_func($sidebar);
						$left_sidebar = get_post_meta ( $post->ID, "page-option-choose-left-sidebar", true );
						$right_sidebar = get_post_meta ( $post->ID, "page-option-choose-right-sidebar", true );
					}else{
						$cp_sidebar_class = array('0'=>'no-sidebar','1'=>'col-md-12',);
						$content_class = array();
						$sidebar = array();
						$left_sidebar = '';
						$right_sidebar = '';
					}	
					if($sidebar == "both-sidebar-right"){ ?>
						<div id="block_second" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
						  <?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
					<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){ ?>
						<div id="block_second_right" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
						  <?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="clear clearfix"></div>
	</div>
	<!--CONTANT SECTION ENDs-->
<?php
	//Reset all data now
	wp_reset_query();
	wp_reset_postdata();
?>
<div class="clear clearfix"></div>
<?php get_footer(); 

}
?>
