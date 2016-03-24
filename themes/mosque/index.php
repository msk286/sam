<?php
/*
 * This file is used to generate main index page.
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

		@get_header();
		$header_style = '';
		//Print Style 6
		if(cp_print_header_html_val($header_style) == 'Style 5'){
			cp_print_header_html($header_style);
		}
		$cp_header_class = '';
		$cp_header_class = cp_print_header_selected();
		global $post,$post_id;
		$item_class = ''; ?>	
		<!--Inner Pages Heading Area Start-->
			<div id="banner">
				<div id="inner-banner">
					<div class="container">
						<?php if(get_the_title() <> ''){ ?>
							<h1><?php esc_html_e('Blog Posts','mosque_crunchpress');?></h1>
						<?php }?>
					</div>
				</div>
			</div>
		<!--Inner Pages Heading Area End--> 		
		<div class="contant cp-index-page <?php echo esc_attr($cp_header_class);?>">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<!--Starting Post -->
						<div id="post-<?php the_ID(); ?>" class="index-blog-detail">
							<?php
							//Feature Sticky Post	
								if ( is_front_page() && cp_has_featured_posts() ) {
									// Include the featured content template.
									get_template_part( 'featured-content' );
								}
								$mask_html = '';
								$no_image_class = 'no-image';
							
								while ( have_posts() ) : the_post();
								//If image exists print its mask
								global $post;
								$thumbnail_types = '';
								$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
								if($post_detail_xml <> ''){
									$cp_post_xml = new DOMDocument ();
									$cp_post_xml->loadXML ( $post_detail_xml );
									$post_social = cp_find_xml_value($cp_post_xml->documentElement,'post_social');
									$sidebar = cp_find_xml_value($cp_post_xml->documentElement,'sidebar_post');
									$right_sidebar = cp_find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
									$left_sidebar = cp_find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
									$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
									$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
									$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');	
								}
								$thumbnail_id = get_post_thumbnail_id( $post->ID );
								$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(1140,575));
								$image_thumb = wp_get_attachment_image_src($thumbnail_id, 'full');
									$get_post_cp = get_post($post);
									$mask_html = '';
									$no_image_class = 'no-image';
									if(get_the_post_thumbnail($post_id, array(1140,575)) <> ''){
										$mask_html = '<div class="mask">
											<a href="'.esc_url(get_permalink()).'#comments" class="anchor"><span> </span> <i class="fa fa-comment"></i></a>
											<a href="'.esc_url(get_permalink()).'" class="anchor"> <i class="fa fa-link"></i></a>
										</div>';
										$no_image_class = 'image-exists';
									}	
							?>
								<!--BLOG LIST ITEM START-->
								<div <?php post_class('blog_listing blog-detail'); ?>>
									<?php if(cp_print_blog_thumbnail($post->ID,array(1140,575)) <> ''){ ?>
										<div class="frame">
											<?php echo cp_print_blog_thumbnail($post->ID,array(1140,575));?>
										</div>
									<?php }?>
									<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
									<?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
									<div class="detail-row">
										<ul>
											<li><a href="#"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
											<li><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>
											<?php if($get_post_cp->comment_count <> ''){ ?>
											<li class="like"><i class="fa fa-comments-o"></i> <?php echo esc_attr($get_post_cp->comment_count);?></li><?php }?>
											<?php the_tags('<li class="ptags"><i class="fa fa-list"></i> ', ', ', '</li>');
											/* Categories */
											echo '
											<li>
												<i class="fa fa-list"></i> ';
												$categories = get_the_category();
												$catArray = array();
													if($categories){
														foreach($categories as $category) {	
															$catArray[] = '<a href="'.esc_url(get_category_link( $category->term_id )).'" title="' . esc_attr( $category->name  ) . '">'.esc_attr($category->cat_name).'</a>';
														}
															$cat = implode(', ',$catArray);
															echo html_entity_decode($cat);
													} 
											echo '</li>';
											?>
										</ul>
										<a class="like" href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share','mosque_crunchpress');?></a>
										<a class="like"><i class="fa fa-heart-o"></i><?php echo get_post_meta($post->ID,'popular_post_views_count',true);?></a>
									</div>
									<div class="clearfix"></div>
									<?php the_content();?>
									<a class="btn-8" href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('Read More','mosque_crunchpress');?></a>
								</div>	
							<?php endwhile; cp_pagination();?>
						</div>
						<!--Ending Post -->
					</div>
				</div>
			</div>
		</div>	
<?php 
		//Reset all data now
		wp_reset_query();
		wp_reset_postdata();
			
		@get_footer();
}
 ?>