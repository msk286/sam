<?php get_header();
 if ( have_posts() ){ while (have_posts()){ the_post();
	global $post;
	
	// Get Post Meta Elements detail 
	$post_social = '';
	$sidebar = '';
	$right_sidebar = '';
	$left_sidebar = '';
	$thumbnail_types = '';
	
	$post_format = get_post_meta($post->ID, 'post_format', true);
	$attractions_detail_xml = get_post_meta($post->ID, 'attractions_detail_xml', true);
	if($attractions_detail_xml <> ''){
		$cp_post_xml = new DOMDocument ();
		$cp_post_xml->loadXML ( $attractions_detail_xml );
		$post_social = cp_find_xml_value($cp_post_xml->documentElement,'post_social');
		$sidebar = cp_find_xml_value($cp_post_xml->documentElement,'sidebars_port');
		$right_sidebar = cp_find_xml_value($cp_post_xml->documentElement,'right_sidebar_port');
		$left_sidebar = cp_find_xml_value($cp_post_xml->documentElement,'left_sidebar_port');
		$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
		$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
		$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');
	}
	
	$select_layout_cp = '';
	$cp_general_settings = get_option('general_settings');
	if($cp_general_settings <> ''){
		$cp_logo = new DOMDocument ();
		$cp_logo->loadXML ( $cp_general_settings );
		$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
	}
	
	$cp_sidebar_class = '';
	$content_class = '';
	
	//Get Sidebar for page
	$cp_sidebar_class = cp_sidebar_func($sidebar);
	$header_style = '';
	$cp_html_class_banner = '';
	$cp_html_class = cp_print_header_class($header_style);
	$breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
	if($cp_html_class <> ''){$cp_html_class_banner = 'banner';}
	
	$header_style = '';
	//Print Style 6
	if(cp_print_header_html_val($header_style) == 'Style 6'){
		cp_print_header_html($header_style);
	}
	?>
	

 <div class="contant">
	<!--Inner Pages Heading Area Start-->
	<section class="inner-titlebg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<?php if(get_the_title() <> ''){ ?>
						<h2><?php echo esc_attr(get_the_title());?></h2>
					<?php }?>
				</div>
			</div>
		</div>
		<?php if($breadcrumbs == 'enable'){ ?>
		<div class="bg_transparent">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<?php if($cp_page_caption <> ''){ ?><h5><?php echo esc_attr($cp_page_caption);?></h5><?php }?>
					</div>
					<div class="col-lg-6 col-md-6">
						 <?php
							if(!is_front_page()){
								echo cp_breadcrumbs();
							}
						?>
					</div>
				</div>	
			</div>
		</div>	
		<?php } ?>
		
	</section>		
	<!--Inner Pages Heading Area End--> 
		<div class="blog-page margin-top-bottom">
			<div class="container">
				<div class="row-fluid">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php if ( is_active_sidebar( $left_sidebar ) ) { 
								 dynamic_sidebar( $left_sidebar ); 
							} ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
						<div id="block_first_left" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php if ( is_active_sidebar( $right_sidebar ) ) { 	
								dynamic_sidebar( $right_sidebar );	
						 } ?>
						</div>
					<?php } ?>
						<?php $image_size = array(1170,350);?>
						<!--Blog Detail Page Page Start-->
						<?php if($breadcrumbs == 'disable'){
							$cp_class_margin='margin_top_cp';
						}else {
							$cp_class_margin='';
						}
						?>
						<div id="<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> timeline-project-box timeline-detail <?php echo esc_attr($cp_class_margin);?><?php echo esc_attr($thumbnail_types);?>">
							<!-- blog post start -->
							<div class="blog-post  travel-locations-details"> 
								<div class="frame"><?php echo get_the_post_thumbnail($post->ID, $image_size);?></div>
								<h3><?php echo esc_attr(get_the_title());?></h3>
								<?php the_content();?>
							</div>
							<div class="related-locations">
								<h2 class="section-title"><?php esc_html_e('Visit Related Places','mosque_crunchpress');?></h2>
								<?php echo related_timeline($post);?>
							</div>
							<div class="blog-comments">
								<div>
									<?php comments_template(); ?>
								</div>
								<div class="hr1"></div>
							</div>
							<!-- blog img end --> 
						</div>	
						<!--Blog Detail Page Page End--> 
						<?php
						if($sidebar == "both-sidebar-right"){?>
							<div class="<?php echo esc_attr($cp_sidebar_class[0]);?> side-bar">

								<?php if ( is_active_sidebar( $left_sidebar ) ) { ?>
									
								<?php dynamic_sidebar( $left_sidebar ); ?>
									
								<?php } ?>

							</div>
							<?php
						}
						if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
							<div class="<?php echo esc_attr($cp_sidebar_class[0]);?> side-bar">
								
								<?php if ( is_active_sidebar( $right_sidebar ) ) { ?>
									
								<?php dynamic_sidebar( $right_sidebar ); ?>
									
								<?php } ?>
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
<?php get_footer(); ?>