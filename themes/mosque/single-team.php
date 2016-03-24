<?php get_header(); 
 if ( have_posts() ){ while (have_posts()){ the_post();
	
	global $post;
	
	$team_social = '';
	$sidebar = '';
	$left_sidebar = '';
	$right_sidebar = '';
	$team_designation = '';
	
	
	$cp_field_name = get_post_meta($post->ID, 'add_project_xml', true);
	$cp_field_val = get_post_meta($post->ID, 'add_project_field_xml', true);
	// Get Post Meta Elements detail 
	$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
	if($team_detail_xml <> ''){
		$cp_team_xml = new DOMDocument ();
		$cp_team_xml->loadXML ( $team_detail_xml );
		$team_social = cp_find_xml_value($cp_team_xml->documentElement,'team_social');
		$sidebar = cp_find_xml_value($cp_team_xml->documentElement,'sidebar_team');
		$left_sidebar = cp_find_xml_value($cp_team_xml->documentElement,'left_sidebar_team');
		$right_sidebar = cp_find_xml_value($cp_team_xml->documentElement,'right_sidebar_team');
		$team_designation = cp_find_xml_value($cp_team_xml->documentElement,'team_designation');
		$team_facebook = cp_find_xml_value($cp_team_xml->documentElement,'team_facebook');
		$team_caption = cp_find_xml_value($cp_team_xml->documentElement,'team_caption');
		
		$team_linkedin = cp_find_xml_value($cp_team_xml->documentElement,'team_linkedin');
		$google_plus = cp_find_xml_value($cp_team_xml->documentElement,'google_plus');
		$team_twitter = cp_find_xml_value($cp_team_xml->documentElement,'team_twitter');
	}
	
	$select_layout_cp = '';
	$cp_general_settings = get_option('general_settings');
	if($cp_general_settings <> ''){
		$cp_logo = new DOMDocument ();
		$cp_logo->loadXML ( $cp_general_settings );
		$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
	}
	$cp_page_caption = '';
	//Get Sidebar for page
	$cp_sidebar_class = cp_sidebar_func($sidebar);
	$header_style = '';
	$cp_html_class_banner = '';
	$cp_html_class = cp_print_header_class($header_style);
	if($cp_html_class <> ''){$cp_html_class_banner = 'banner';}
	$breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
	//Print Style 6
	if(cp_print_header_html_val($header_style) == 'Style 5'){
		cp_print_header_html($header_style);
	}
	?>
	
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
    	<div class="container">
			<!--MAIN CONTANT ARTICLE START-->
			<?php if($breadcrumbs == 'disable'){
				$cp_class_margin='margin_top_cp_team';
			}else {
				$cp_class_margin='team_bottom_margin';
			}
			?>
            <div class="main-content margin-top-bottom <?php echo esc_attr($cp_class_margin);?>">
				<div class="team-content row">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
					<div id="block_first_left" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php }
					$image_size = array(1140,575);?>
					<!--Blog Detail Page Page Start-->
					<div id="<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> team-member-detail ">
						<div <?php post_class('row'); ?>>
							<div class="col-md-4">
								<div class="team-member-detail-box">
									<div class="frame">
										<a href="#"><?php echo get_the_post_thumbnail($post->ID, array(614, 614));?></a>
									</div>
									<?php
										$children = '';
										$children_title = '';
										$nofields = '';
										//Sidebar addition
										if($cp_field_name <> ''){
											$cp_field_n_xml = new DOMDocument();
											$cp_field_n_xml->loadXML($cp_field_name);
											$cp_field_title = $cp_field_n_xml->documentElement->childNodes;
											$nofields = $cp_field_n_xml->documentElement->childNodes->length;
										}		

										if($cp_field_val <> ''){	
											$cp_field_t_xml = new DOMDocument();
											$cp_field_t_xml->loadXML($cp_field_val);
											$cp_field_val = $cp_field_t_xml->documentElement->childNodes;
										}
										
									  ?>
									<ul>
										<li><strong class="name"><?php echo esc_attr(get_the_title());?></strong></li>
										<li><?php echo esc_attr($team_designation);?></li>
										<?php
										$counter = 0;								
										if($nofields <> ''){
											for($i=0;$i<$nofields;$i++) { 
												$counter++;
												echo '<li> <strong>'.esc_attr($cp_field_title->item($i)->nodeValue).'</strong> '.esc_attr($cp_field_val->item($i)->nodeValue).'</li>';
											}
										}	
										?>
										<li>
											<ul class="member-social">
												<?php if(isset($team_facebook) AND $team_facebook <> ''){?>
												<li><a title="Facebook Sharing" href="<?php echo esc_url($team_facebook)?>" class="social_active" id="fb_hr">
													<i class="fa fa-facebook"></i>
												</a></li>
												<?php }?>
												<?php if(isset($team_twitter) AND $team_twitter <> ''){?>
												<li><a title="Twitter Sharing" href="<?php echo esc_url($team_twitter)?>" class="social_active" id="twitter_hr">
													<i class="fa fa-twitter"></i>
												</a></li>
												<?php }?>
												<?php if(isset($team_linkedin) AND $team_linkedin <> ''){?>
												<li><a title="Linked In Sharing" href="<?php echo esc_url($team_linkedin)?>" class="social_active" id="linked_hr">
													<i class="fa fa-linkedin"></i>
												</a></li>
												<?php }?>
												<?php if(isset($google_plus) AND $google_plus <> ''){?>
												<li><a title="Google In Sharing" href="<?php echo esc_url($google_plus)?>" class="social_active" id="google_hr">
													<i class="fa fa-google-plus"></i>
												</a></li>
												<?php }?>
											</ul>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-8">
								<div class="team-detail-area">
								  <?php the_content();?>
								</div>
							</div>
							<div class="clear"></div>
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
						<?php dynamic_sidebar( $right_sidebar );?>
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
<div class="clear"></div>
<?php get_footer(); ?>