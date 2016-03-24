<?php 
	/*
	 * This file is used to generate single post page.
	 */	
get_header(); 
if ( have_posts() ){ while (have_posts()){ the_post();

	global $post,$post_id;
	// Get Album Meta Elements detail 
	$sermons_detail_xml = '';
	$event_social = '';
	$sidebar = '';
	$right_sidebar_event = '';
	$left_sidebar_event = '';
	$video_url_type = '';
	$soundcloud_url_type = '';
	$sermons_detail_xml = get_post_meta($post->ID, 'sermons_detail_xml', true);
	if($sermons_detail_xml <> ''){
		$cp_album_xml = new DOMDocument ();
		$cp_album_xml->loadXML ( $sermons_detail_xml );
		$event_social = cp_find_xml_value($cp_album_xml->documentElement,'event_social');
		$sidebar_event = cp_find_xml_value($cp_album_xml->documentElement,'sidebar_event');
		$left_sidebar_event = cp_find_xml_value($cp_album_xml->documentElement,'left_sidebar_event');
		$right_sidebar_event = cp_find_xml_value($cp_album_xml->documentElement,'right_sidebar_event');
		$video_url_type = cp_find_xml_value($cp_album_xml->documentElement,'video_url_type');
		$soundcloud_url_type = cp_find_xml_value($cp_album_xml->documentElement,'soundcloud_url_type');
	}
	
	
	
	$select_layout_cp = '';
	$cp_general_settings = get_option('general_settings');
	if($cp_general_settings <> ''){
		$cp_logo = new DOMDocument ();
		$cp_logo->loadXML ( $cp_general_settings );
		$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
	}
	
	
	$track_name_xml = get_post_meta($post->ID, 'track_name_xml', true);
	$track_url_xml = get_post_meta($post->ID, 'track_url_xml', true);
	$track_des_xml = get_post_meta($post->ID, 'track_des_xml', true);
	$track_down_xml = get_post_meta($post->ID, 'track_down_xml', true);
	$cp_sidebar_class = '';
	$content_class = '';
	

	//Get Sidebar for page
	$cp_sidebar_class = cp_sidebar_func($sidebar_event);
	$header_style = '';
	$cp_html_class_banner = '';
	$cp_html_class = cp_print_header_class($header_style);
	if($cp_html_class <> ''){$cp_html_class_banner = 'banner';}
	$breadcrumbs = '';
	$breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
	$header_style = '';
	//Print Style 6
	if(cp_print_header_html_val($header_style) == 'Style 5'){
		cp_print_header_html($header_style);
	}
	
	$cp_html_class = cp_print_header_class($header_style);
	
	$cp_header_class = '';
		$cp_header_class = cp_print_header_selected();
		
		if($cp_header_class == 'header-style-3'){
			
				$cp_header_class = 'header-style-3';
		}else{
				$cp_header_class == '';
		}
	?>
	<div class="clearfix clear"></div>
	<div class="contant <?php echo esc_attr($cp_header_class);?>">
	<?php 
	if($breadcrumbs == 'enable'){ ?>
		<!--Inner Pages Heading Area Start-->
		<div id="banner">
			<div id="inner-banner">
				<div class="container">
					<?php 
						if(get_the_title() <> ''){ ?>
						<h1>
						<?php 
							if(strlen(get_the_title()) < 30 ) { 
								echo esc_attr(get_the_title());
							}
							else {
								echo substr(esc_attr(get_the_title()),0 ,30) . '...';
							}?>
						</h1>
						<?php }
						if(!is_front_page()){
							echo cp_breadcrumbs();
						}
					?>
				</div>
			</div>
		</div>
	<?php } ?>
		
		<!--Inner Pages Heading Area End--> 	
		<?php }?>
		<div class="<?php if($select_layout_cp == 'full_layout'){echo 'container';}else{echo 'container-boxed';}?>">
			<div class="<?php if($select_layout_cp == 'full_layout'){echo '';}else{echo 'container-fluid';}?>">
				<div id="blockContainer" class="row-fluid">
					<div class="page_content">
						<?php
						if($sidebar_event == "left-sidebar" || $sidebar_event == "both-sidebar" || $sidebar_event == "both-sidebar-left"){?>
							<div id="block_first" class="sidebar <?php echo esc_attr($cp_sidebar_class[0]);?>">
								<?php dynamic_sidebar( $left_sidebar_event ); ?>	
							</div>
							<?php
						}
						if($sidebar_event == 'both-sidebar-left'){?>
						<div id="block_first_left" class="sidebar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $right_sidebar_event );?>	
						</div>
						<?php } ?>
						<div id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> blog-detail naat-detail">
							<div <?php post_class(); ?>>
								<div class="frame">
									<?php echo get_the_post_thumbnail($post->ID, array(1170,350));?>
								</div>
								<h3><?php echo esc_attr(get_the_title());?></h3>
								<div class="detail-row">
									<ul>
										<li><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
										<li><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>
										<li>
											<?php

												if ( comments_open() ) :
												  echo '<p>';
												  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
												  echo '</p>';
												endif;
											?>
										</li>
										<li>
										<?php 
										$cp_variable_category = wp_get_post_terms( $post->ID, 'sermons-category');
										$counterr = 0;
										foreach($cp_variable_category as $values){
											if($counterr == 0){ echo '<i class="fa fa-list"></i>';}
											$counterr++;
											echo '<a class="event-tag" href="'.esc_url(get_term_link(intval($values->term_id),'sermons-category')).'">'.esc_attr($values->name).', </a>';
										}
										?>
										</li>
									</ul>
									
									<div class="dropdown">
											<a class="like share-dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share', 'mosque_crunchpress');?></a>
										<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
											<?php cp_include_social_shares();?> 
										</ul>
									</div>
									<a class="like"><i class="fa fa-heart-o"></i><?php echo get_post_meta($post->ID,'popular_post_views_count',true);?></a>
								</div>
								<?php the_content();?>
								<?php 
								$cp_variable_category = wp_get_post_terms( $post->ID, 'sermons-tag');
								if(!empty($cp_variable_category)){ ?>
								<div class="tags">
									<strong class="title"><?php esc_html_e('Tags:','mosque_crunchpress');?></strong>
									<?php 
									
									$counterr = 0;
									foreach($cp_variable_category as $values){
										$counterr++;
										echo ' <a class="event-tag" href="'.esc_url(get_term_link(intval($values->term_id),'sermons-tag')).'">'.esc_attr($values->name).'</a>';
									}
									?>
								</div>
								<?php }?>
								<!--Related Naats Start-->
								<div class="related-naat">
									<h2><?php esc_attr_e('Related Tracks','mosque_crunchpress');?></h2>
									<ul>
									<?php
									//Fetching All Tracks from Database
									$track_name_xml = get_post_meta($post->ID, 'track_name_xml', true);
									$track_url_xml = get_post_meta($post->ID, 'track_url_xml', true);
									$track_des_xml = get_post_meta($post->ID, 'track_des_xml', true);
									$track_down_xml = get_post_meta($post->ID, 'track_down_xml', true);
									
									//Empty Variables
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
									
									//Track Description
									if($track_des_xml <> ''){	
										$ingre_des_xml = new DOMDocument();
										$ingre_des_xml->recover = TRUE;
										$ingre_des_xml->loadXML($track_des_xml);
										$children_des = $ingre_des_xml->documentElement->childNodes;
									}
									
									//Track Download Fetch
									if($track_down_xml <> ''){	
										$ingre_down_xml = new DOMDocument();
										$ingre_down_xml->recover = TRUE;
										$ingre_down_xml->loadXML($track_down_xml);
										$children_down = $ingre_down_xml->documentElement->childNodes;
										
									}

									//Combine Loop
									if($track_name_xml <> '' || $track_url_xml <> ''){
										$counter_track = 0;
										$nofields = $ingre_xml->documentElement->childNodes->length;
										for($i=0;$i<$nofields;$i++) { 
										$counter_track++; ?>
										<li>
											<div class="related-naat-box">
												<div class="star-box"><a id="no-active-btn-play-cp" class="cp-play-track"><i class="fa fa-play-circle"></i></a></div>
												<div class="star-box pull-right margin-none"><a href="<?php echo esc_url($children_title->item($i)->nodeValue);?>"><i class="fa fa-arrow-circle-down"></i></a></div>
												<div class="star-box pull-right"><a href="#lyrics_class-<?php echo esc_attr($i);?>" data-rel="prettyPhoto[inline]" href="#"><i class="fa fa-file-text-o"></i></a></div>												
												<div id="lyrics_class-<?php echo esc_attr($i);?>" class="hide"><?php echo esc_attr($children_des->item($i)->nodeValue);?></div>
												<div class="text-box">
													<h3><a href="#"><?php echo esc_attr($children_name->item($i)->nodeValue);?></a></h3>
													<p><?php echo esc_attr(substr($children_des->item($i)->nodeValue,0,85));?></p>
												</div>
												<div class="cp-audio-naat">
													<?php echo do_shortcode('[audio mp3="'.$children_title->item($i)->nodeValue.'"][/audio]');?>
												</div>
											</div>
										</li>
										<?php }
									}	
									?>
									</ul>
								</div>
								<!--Related Naats Start-->
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
						
						<?php
						if($sidebar_event == "both-sidebar-right"){?>
							<div class="<?php echo esc_attr($cp_sidebar_class[0]);?>">	
								<?php dynamic_sidebar( $left_sidebar_event ); ?>
							</div>
							<?php
						}
						if($sidebar_event == 'both-sidebar-right' || $sidebar_event == "right-sidebar" || $sidebar_event == "both-sidebar"){?>
							<div class="<?php echo esc_attr($cp_sidebar_class[0]);?>">
								<?php dynamic_sidebar( $right_sidebar_event ); ?>
							</div>
						<?php } ?>						   
					</div>
				</div>	
			</div>
		</div>
	</div>
<?php 
	}

?>
<div class="clear"></div>
<?php get_footer(); ?>
