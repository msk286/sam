<?php get_header(); ?>
<?php if ( have_posts() ){ while (have_posts()){ the_post();
	global $post,$EM_Event;
	
	// Get Post Meta Elements detail 
	$event_social = '';
	$sidebar = '';
	$left_sidebar = '';
	$right_sidebar = '';
	$event_thumbnail = '';
	$video_url_type = '';
	$select_slider_type = '';
	$event_detail_xml = get_post_meta($post->ID, 'event_detail_xml', true);
	if($event_detail_xml <> ''){
		$cp_event_xml = new DOMDocument ();
		$cp_event_xml->loadXML ( $event_detail_xml );
		$event_social = cp_find_xml_value($cp_event_xml->documentElement,'event_social');
		$sidebar = cp_find_xml_value($cp_event_xml->documentElement,'sidebar_event');
		$left_sidebar = cp_find_xml_value($cp_event_xml->documentElement,'left_sidebar_event');
		$right_sidebar = cp_find_xml_value($cp_event_xml->documentElement,'right_sidebar_event');
		$event_thumbnail = cp_find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
		$video_url_type = cp_find_xml_value($cp_event_xml->documentElement,'video_url_type');
		$select_slider_type = cp_find_xml_value($cp_event_xml->documentElement,'select_slider_type');
	}
	
	
	$select_layout_cp = '';
	$color_scheme = '';
	$cp_general_settings = get_option('general_settings');
	if($cp_general_settings <> ''){
		$cp_logo = new DOMDocument ();
		$cp_logo->loadXML ( $cp_general_settings );
		$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
		$color_scheme = cp_find_xml_value($cp_logo->documentElement,'color_scheme');
	}
	$breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
	$thumbnail_types = '';
	$cp_sidebar_class = '';
	$content_class = '';
	
	//Get Sidebar for page
	$cp_sidebar_class = cp_sidebar_func($sidebar);
	$location_summary = '';
	
	if(!empty($EM_Event->location_id->name)){
		$location_summary = "<b>" . $EM_Event->get_location()->name . "</b><br/>" . $EM_Event->get_location()->address . " - " . $EM_Event->get_location()->town;
	}
	$location_address = $EM_Event->get_location()->location_address;
	$location_name =  $EM_Event->get_location()->location_name;
	$EM_Tickets = $EM_Event->get_bookings()->get_tickets();
	$header_style = '';
	//Print Style 6
	if(cp_print_header_html_val($header_style) == 'Style 5'){
		cp_print_header_html($header_style);
	}
	
	$html_class = cp_print_header_class($header_style);
	
	$cp_header_class = '';
		$cp_header_class = cp_print_header_selected();
		
		if($cp_header_class == 'header-style-3'){
			
				$cp_header_class = 'header-style-3';
		}else{
				$cp_header_class == '';
		}
	?>
	<div class="contant <?php echo esc_attr($cp_header_class);?>">
		<!--Inner Pages Heading Area Start-->
		<div id="banner">
			<div id="inner-banner">
				<div class="container">
					<?php if(get_the_title() <> ''){ ?>
						<h1><?php echo esc_attr(get_the_title());?></h1>
					<?php }?>
					<?php
						if(!is_front_page()){
							echo cp_breadcrumbs();
						}
					?>
				</div>
			</div>
		</div>
		<!--Inner Pages Heading Area End--> 		
		<?php 	if($breadcrumbs == 'disable'){
					$cp_class_margin='margin_top_cp';
				}else {
					$cp_class_margin='';
				}
		?>
		<div class="blog bdetails margin-top-bottom <?php echo esc_attr($cp_class_margin);?>">
			<div class="container">
				<div class="row">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
						<div id="block_first_left" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $right_sidebar ); ?>	
						</div>
					<?php } ?>
					
					<?php $image_size = array(1140,575);?>
					<!--Event Detail Page Page Start-->					
					<div id="event-<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> <?php echo esc_attr($thumbnail_types);?>">
						<div <?php post_class('blog-detail event-detail'); ?>>
							<div class="frame"><a href="<?php echo esc_url($EM_Event->guid);?>"><?php echo get_the_post_thumbnail($EM_Event->post_id, array(1140,575));?></a></div>
							<div class="date-box">
								<strong class="date"><?php echo date('d',strtotime($EM_Event->start_date));?> <span><?php echo date('M',strtotime($EM_Event->start_date));?></span></strong>
								<div class="icon-outer">
									<div class="awesome-icon"><i class="fa fa-ticket"></i></div>
								</div>
							</div>
							<div class="text-box">
								<div class="map-row">
									<div id="event-detail-map" class="map-box">
										<?php echo do_shortcode('[map latitude="'.$EM_Event->get_location()->location_latitude.'" longitude="'.$EM_Event->get_location()->location_longitude.'" maptype="ROADMAP" width="100%" height="150" zoom="14"][/map]');?>
									</div>
									<div class="countdown-box">
										<?php
											//Get Date in Parts
											$event_year = date('Y',$EM_Event->start);
											$event_month = date('m',$EM_Event->start);
											$event_month_alpha = date('M',$EM_Event->start);
											$event_day = date('d',$EM_Event->start);

											//Change time format
											$event_start_time_count = date("G,i,s", strtotime($EM_Event->start_time));
										?>
										<script>
											jQuery(function () {
												var austDay = new Date();
												austDay = new Date(<?php echo esc_js($event_year);?>, <?php echo esc_js($event_month);?>-1, <?php echo esc_js($event_day);?>,<?php echo esc_js($event_start_time_count);?>)
												jQuery('#count_<?php echo esc_attr($EM_Event->post_id); ?>').countdown({
													labels: ['<?php esc_html_e('YRS','mosque_crunchpress');?>', '<?php esc_html_e('MNTH','mosque_crunchpress');?>', '<?php esc_html_e('Weeks','mosque_crunchpress');?>', '<?php esc_html_e('Days','mosque_crunchpress');?>', '<?php esc_html_e('HRS','mosque_crunchpress');?>', '<?php esc_html_e('MIN','mosque_crunchpress');?>', '<?php esc_html_e('SEC','mosque_crunchpress');?>'],
													until: austDay
												});
												jQuery('#year').text(austDay.getFullYear());
											});                
										</script>
										<div class="defaultCountdown" id="count_<?php echo esc_attr($EM_Event->post_id); ?>"></div>
									</div>
								</div>
								<h3><?php echo esc_attr($EM_Event->post_title);?></h3>
								<div class="detail-row">
									<ul>
										<li><a href="<?php echo esc_url($EM_Event->guid);?>"><i class="fa fa-user"></i><?php echo get_the_author();?></a></li>
										<li><a href="<?php echo esc_url($EM_Event->guid);?>"><i class="fa fa-clock-o"></i><?php echo esc_attr($EM_Event->start_time);?> <?php esc_html_e('to','mosque_crunchpress');?> <?php echo esc_attr($EM_Event->end_time);?></a></li>
										<?php if($location_address <> ''){ ?><li><a href="<?php echo esc_url($EM_Event->guid);?>"><i class="fa fa-map-marker"></i><?php echo esc_attr($location_address);?></a></li><?php }?>
									</ul>
								</div>	
								<?php
								//Fetching the Description from Database and Printing here
								$content = str_replace(']]>', ']]&gt;',$EM_Event->post_content); ?>
								<p> <?php echo do_shortcode($content); ?> </p>
							</div>
							<div class="tags">
								<strong class="title"><?php esc_html_e('Tags:','mosque_crunchpress');?></strong>
								<?php 
									$cp_variable_category = wp_get_post_terms( $EM_Event->post_id, 'event-tags');
									$counterr = 0;
									foreach($cp_variable_category as $values){
										$counterr++;
										echo ' <a class="event-tag" href="'.esc_url(get_term_link(intval($values->term_id),'event-tags')).'">'.esc_attr($values->name).'</a>';
									}
									?>
							</div>
							<div class="booking_form">
								<?php cp_booking_form_event_manager(); ?>
							</div>
							<div class="clearfix"></div>
							
							<div class="comment-box comment-form">
								<h3><?php esc_html_e('About Post Author','mosque_crunchpress');?></h3>
								<div class="author-row">
									<div class="cp-frame">
										<a href="<?php echo esc_url(get_permalink());?>"><?php echo get_avatar(get_the_author_meta('ID'));?></a>
									</div>
									<div class="text-box">
										<strong class="name">
											<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author(); ?></a>
										</strong>
										<p><?php echo mb_substr(esc_html(get_the_author_meta( 'description' )),0,360);?></p>
									</div>
								</div>
								<!--COMMENT FORM START-->
								<?php comments_template(); ?>
								<!--COMMENT FORM END--> 
								<?php
									if ( is_user_logged_in() ) {
										echo '';
									} else {
										echo '</div>';
									}
								?>
							
						</div>
					</div>
					<!--Blog Detail Page Page End--> 
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div class="<?php echo esc_attr($cp_sidebar_class[0]);?> side-bar">
							<?php dynamic_sidebar( $left_sidebar ); ?>	
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
						<div class="<?php echo esc_attr($cp_sidebar_class[0]);?> side-bar">
							<?php dynamic_sidebar( $right_sidebar ); ?>	
						</div>
					<?php } ?>	
				</div>
			</div>
		</div>
	</div>
<?php 
	}
}
?>
<div class="clearfix"></div>
<?php get_footer(); ?>