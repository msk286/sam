<?php

	/*
	*	CrunchPress Blog Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each blog item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/
	
	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
	
		$cp_blog_div_listing_num_class = array(
			"Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,350), "size2"=>array(770, 265), "size3"=>array(570,300)),
			"Small-Thumbnail" => array("index"=>"2", "class"=>"sixteen", "size"=>array(175,155), "size2"=>array(175,155), "size3"=>array(175,155)));
	
	
	// Print blog item
	function cp_print_blog_item($item_xml){ 
	global $paged,$post,$sidebar,$cp_blog_div_listing_num_class,$counter,$post_id;
	?>
		<div class="blog blog-full" id="content-<?php echo esc_attr($counter);?>">
		<?php
		
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// Post Per Page Default
		$get_default_nop = get_option('posts_per_page');
		
		// get the blog meta value		
		$header = cp_find_xml_value($item_xml, 'header');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
		$category = cp_find_xml_value($item_xml, 'category');
		$layout_select = cp_find_xml_value($item_xml, 'layout_select');
		$pagination = cp_find_xml_value($item_xml, 'pagination');
		

		
		//Pagination default wordpress
		if(cp_find_xml_value($item_xml, "pagination") == 'Wp-Default'){
			$num_fetch = get_option('posts_per_page');
		}else if(cp_find_xml_value($item_xml, "pagination") == 'Theme-Custom'){
			$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		}else{}
		
		
		// print header
		if(!empty($header)){ ?>
				<h2 class="h-style"><?php echo esc_attr($header);?></h2>
		<?php
		}
		
		if ($layout_select == 'List'){ echo '<div class="cp_blog-section"><ul class="blog-list">';}else { echo '<div class="blog_listing  blog-detail">'; }
		
		$counter_blog = 0;
		// Get Post From Database
		if($category == '0'){
			//Popular Post 
			query_posts(
				array( 
				'post_type' => 'post',
				'paged'				=> $paged,
				'posts_per_page' => $num_fetch,
				//'ignore_sticky_posts' => true,
				'orderby' => 'date',
				'order' => 'DESC' )
			);
		}else{
			//Popular Post 
			query_posts(
				array( 
				'post_type' => 'post',
				'posts_per_page' => $num_fetch,
				'paged'				=> $paged,
				//'ignore_sticky_posts' => true,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'terms' => $category,
						'field' => 'term_id',
					)
				),
				'orderby' => 'date',
				'order' => 'DESC' )
			);
		}
		$counter_blog = 0;
		while( have_posts() ){
			the_post();
			global $post, $post_id;
			
			// Get Post Meta Elements detail 
			$post_social = '';
			$sidebar = '';
			$right_sidebar = '';
			$left_sidebar = '';
			$thumbnail_types = '';
			
			$post_format = get_post_meta($post->ID, 'post_format', true);
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
				$audio_url_type = cp_find_xml_value($cp_post_xml->documentElement,'audio_url_type');	
				
			}
			
			// get the item class and size from array
			$item_type = 'Full-Image';
			$item_class = $cp_blog_div_listing_num_class[$item_type]['class'];
			$item_index = $cp_blog_div_listing_num_class[$item_type]['index'];
			if( $sidebar == "no-sidebar" ){
				$item_size = $cp_blog_div_listing_num_class[$item_type]['size'];
			}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
				$item_size = $cp_blog_div_listing_num_class[$item_type]['size2'];
			}else{
				$item_size = $cp_blog_div_listing_num_class[$item_type]['size3'];
				$item_class = 'both_sidebar_class';
			} 
			
			
			if($thumbnail_types == 'Image'){
				$mask_html = '';
				$no_image_class = 'no-image';
				$image_size = array(1170,350);
			}else if($thumbnail_types == 'Slider'){
				$mask_html = '';
				$no_image_class = '';
				$image_size = array(1170,350);
			}else if($thumbnail_types == 'Video'){
				$mask_html = '';
				$no_image_class = '';
				$image_size = array(1170,350);
			}else{
				$mask_html = '';
				$no_image_class = 'no-image';
				$image_size = array(1170,350);
			}
			
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(1170,350));
			$image_thumb = wp_get_attachment_image_src($thumbnail_id, 'full');
			if($image_thumb[1] == '1600'){
				$mask_html = '<div class="mask">
					<a href="'.esc_url(get_permalink()).'#comments" class="anchor"><span> </span> <i class="fa fa-comment"></i></a>
					<a href="'.esc_url(get_permalink()).'" class="anchor"> <i class="fa fa-link"></i></a>
				</div>';
				$no_image_class = 'image-exists';
			}
			$get_post_cp = get_post($post);
			$counter_track = $counter.$post->ID;
			if($layout_select == 'Half Width'){
			$item_class = 'col-md-6';
			$div_class = '';
			if($counter_blog % 2 == 0){ echo '<div class="clearfix clear"></div>';}else{$div_class = '';}$counter_blog++;

			?>
			<div class="col-lg-6 col-md-6">
				<div class="blog-post blog-2col"> 
					<div class="row">
						<div class="date-col"></div>
						<div class="info-col post-title-tags">
							<h2><a title="" href="<?php echo esc_url(get_permalink()); ?>"><?php echo substr(esc_attr(get_the_title()),0,30); ?></a></h2>
							<div class="post-tags">
								<ul>
									<li class="puser"><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_author());?></a></li>
									<li class="pcomment_cp">
										<?php
											if ( comments_open() ) :
											  echo '<p>';
											  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
											  echo '</p>';
											endif;
										?>											
									</li>
									<li class="ptags_cp">
										<?php the_tags('<i class="fa fa-tags"></i>',' ',' ');?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="post-title-tags">
						<div class="date-col">
						<?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
							<div class="date"><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><strong><?php echo get_the_date('j');?></strong> <?php echo get_the_date('M');?></a></div>
							<?php if($get_post_cp->comment_count <> ''){ ?><div class="like"><i class="fa fa-comments-o"></i> <?php echo esc_attr($get_post_cp->comment_count);?></div><?php }?>
						</div>
						<div class="info-col">
							<div class="block-image"> 
								<?php if(cp_print_blog_thumbnail($post->ID,array(1600,900)) <> ''){
									echo cp_print_blog_thumbnail($post->ID,array(1600,900));
								} ?>
								
								<?php if ($thumbnail_types == 'Image'){?>
								<div class="img-overlay-3-up pat-override"></div>
								<div class="img-overlay-3-down pat-override"></div>
								<ol class="static-style">
									<li class="white-rounded"><a href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-link"></i></a> </li>
									<li class="white-rounded"><a data-gal="prettyPhoto[gallery1]" href="<?php echo esc_url($image_thumb[0])?>"><i class="fa fa-plus"></i></a> </li>
								</ol>
								<?php } ?>
							</div>
							<p><?php echo substr(esc_attr(get_the_excerpt()),0,$num_excerpt); ?></p>
							<a class="readmore" href='<?php echo esc_url(get_permalink()); ?>'><?php esc_html_e('Read More', 'mosque_crunchpress'); ?></a>
						</div>
					</div>
					<!-- blog img end --> 
				</div>
			</div>
			<!--BLOG LIST ITEM END-->
			<?php }else if($layout_select == 'Grid Style'){ ?>			
			<div class = "col-md-4">								
			<div class="blog-box cp_grid_view">										
			<div class="frame"> 	
			<strong><?php echo get_the_date('d')?> <span><?php echo get_the_date('M')?></span></strong>		
			<?php echo get_the_post_thumbnail($post_id, array(570,300));?>
			<div class="caption">							
			<div class="inner"> 								
			<a href="<?php echo esc_url($image_thumb[0])?>" class="search" data-rel="prettyPhoto[gallery1]" rel="prettyPhoto[gallery1]"><i class="fa fa-search-plus"></i></a>
			<a class="link" href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-link"></i></a> 
			</div>						
			</div>					
			</div>					
			<div class="text-box">						
			<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo substr(esc_attr(get_the_title()),0,30);?></a></h3>
			<div class="blog-row">
			<ul>								
			<li><a href="#"><i class="fa fa-user"></i><?php echo esc_attr(ucfirst(get_the_author()));?></a></li>
			<li><a href="#"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date(get_option('date_format')))?></a></li>
			
			</ul>
			</div>						
			<p><?php echo strip_tags(mb_substr(esc_attr(get_the_content()),0, $num_excerpt));?></p>
			<a href="<?php echo esc_url(get_permalink());?>" class="btn-read"><?php esc_attr_e ('Read Post','mosque_crunchpress'); ?></a>
			</div>				
			</div>			
			</div>			
			<!-- Blog Listing -->
			<?php }else if($layout_select == 'List'){ ?>
				<li>
					<div class="thumb"> <a class = "link_detail" href="<?php echo esc_url(get_permalink());?>"> <i class="fa fa-link"></i></a> <?php if(get_the_post_thumbnail($post_id, array(570,300)) <> '') {echo get_the_post_thumbnail($post_id, array(570,300));}?></div>
					<div class="text"> <strong class="cp_strong"><a href="<?php echo esc_url(get_permalink());?>"><?php echo substr(esc_attr(get_the_title()),0,30);?></a></strong>
						<ul class="listd">
						<?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
							<li><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><i class="fa fa-user"></i><?php the_author(); ?></a></li>
							<li><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date('d')?> <?php echo get_the_date('F')?> <?php echo get_the_date('Y')?></a></li>
							<li><?php
								if ( comments_open() ) :
								  echo '<p>';
								  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
								  echo '</p>';
								endif;?>
							</li>
						</ul>
						<p><?php echo strip_tags(mb_substr(esc_attr(get_the_content()),0, $num_excerpt));?></p>
						<a href="<?php echo esc_url(get_permalink());?>" class="more-info"><?php esc_attr_e ('Read More','mosque_crunchpress'); ?></a>
					</div>
				</li>
			<?php }else{ ?>
			<!--BLOG LIST ITEM START-->
			<div <?php post_class('post-listing'); ?>>
				<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
				<?php if(cp_print_blog_thumbnail($post->ID,array(1140,575)) <> ''){ ?>
				<div class="frame">
					<?php echo cp_print_blog_thumbnail($post->ID,array(1140,575));?>
				</div>
				<?php }?>
				<div class="detail-row">
					<?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
					
					<ul>
						<li><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
						<li><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>
						<li>
							<?php
								if ( comments_open() ) :
								  echo '<p>';
								  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
								  echo '</p>';
								endif;
							?>
						</li>
						<?php the_tags('<li class="ptags"><i class="fa fa-list"></i>',', ','</li>');?>
					</ul>
					<div class="dropdown">
					<a class="like share-dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share', 'mosque_crunchpress');?></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
							<?php cp_include_social_shares();?> 
						</ul>
					</div>
					<?php if(get_post_meta($post->ID,'popular_post_views_count',true) <> ''){ ?><a class="like" href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-heart-o"></i><?php echo get_post_meta($post->ID,'popular_post_views_count',true);?></a><?php }?>
					<div class="clearfix"></div>
					<p><?php echo substr(get_the_content(), 0 , $num_excerpt); ?></p>
					<a class="btn-8" href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('Read More','mosque_crunchpress');?></a>
				</div>
			</div>
			<!--BLOG LIST ITEM END-->
		<?php
			}
		} wp_reset_query(); //end while
		
		
		if($layout_select == 'List'){ 
			echo '</ul></div>';
		}else{
			echo '</div>';
		}		
		
			
		if( cp_find_xml_value($item_xml, "pagination") == "Theme-Custom" ){	
			echo '<div class="clear clearfix"></div><div class="paging">';
				cp_pagination();
			echo '</div>';
		}

		wp_reset_postdata(); 
		?> 
	</div> 
		
		<?php
	}	
	
	
	// Print blog item
	function cp_print_blog_modern_item($item_xml){
		global $paged,$post,$sidebar,$cp_blog_div_listing_num_class,$counter,$post_id;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		// Post Per Page Default
		$get_default_nop = get_option('posts_per_page');
		
		// get the blog meta value		
		$header = cp_find_xml_value($item_xml, 'header');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		$select_feature = cp_find_xml_value($item_xml, 'select_feature');
		$category = cp_find_xml_value($item_xml, 'category');
		
		//Pagination default wordpress
		if(cp_find_xml_value($item_xml, "pagination") == 'Wp-Default'){
			$num_fetch = get_option('posts_per_page');
		}else if(cp_find_xml_value($item_xml, "pagination") == 'Theme-Custom'){
			$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		}else{}
		
		
		// print header
		if(!empty($header)){ ?>
		<figure class="page_titlen feature_story">
			<div class="span12 first">
				<h2><?php echo esc_attr($header);?></h2>
			</div>
		</figure>
		<?php
		}
		

		//If feature Post selected
		if($select_feature <> '786512'){ 
			$thumbnail_types = '';
			$post_detail_xml = get_post_meta($select_feature, 'post_detail_xml', true);
			if($post_detail_xml <> ''){
				$cp_post_xml = new DOMDocument ();
				$cp_post_xml->loadXML ( $post_detail_xml );
				$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
				$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
				$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');				
			}
			if($thumbnail_types == 'Image'){ ?>
				<ul class="featured-story">
					<li class="span12 featured-slider">
						<?php echo get_the_post_thumbnail($select_feature, array(1170,350));?>
						<div class="post-slide-cap">
							<span class="post-type"><?php get_the_date(get_option('date_format'));?><i class="fa fa-camera"></i></span>
							<strong class="f-post-title"><a href="<?php echo esc_url(get_permalink($select_feature));?>"><mark><?php echo esc_attr(get_the_title($select_feature))?></mark></a></strong>
						</div>
					</li>
				</ul>
			<?php
			}else{ ?>
				<ul class="featured-story">
					<li class="span12 featured-slider">
						<?php echo cp_print_blog_modern_thumbnail($select_feature,array(1170,350));?>
						<div class="post-slide-cap">
							<span class="post-type"><?php get_the_date(get_option('date_format'));?><i class="fa fa-camera"></i></span>
							<strong class="f-post-title"><a href="<?php echo esc_url(get_permalink($select_feature));?>"><mark><?php echo esc_attr(get_the_title($select_feature))?></mark></a></strong>
						</div>
					</li>
				</ul>
			<?php
			}
			
			//Arguments for loop
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'category_name'				=> $category,
				'post_type'					=> 'post',
				'post_status'				=> 'publish',
				'order'						=> 'DESC',
				'post__not_in' => array($select_feature)
			));
		}else{
			query_posts(array(
				'posts_per_page'			=> $num_fetch,
				'paged'						=> $paged,
				'category_name'				=> $category,
				'post_type'					=> 'post',
				'post_status'				=> 'publish',
				'order'						=> 'DESC',
			));
		}
		echo '<ul class="featured-story">';
		$counter_post = 0;
		while( have_posts() ){
			the_post();
			global $post, $post_id;
			
			//Get post parameters
			$thumbnail_types = '';
			$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
			if($post_detail_xml <> ''){
				$cp_post_xml = new DOMDocument ();
				$cp_post_xml->loadXML ( $post_detail_xml );
				$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
				$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
				$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');				
			}
			// get the item class and size from array
			$item_type = 'Full-Image';
			$item_class = $cp_blog_div_listing_num_class[$item_type]['class'];
			$item_index = $cp_blog_div_listing_num_class[$item_type]['index'];
			if( $sidebar == "no-sidebar" ){
				$item_size = array(150,150);
			}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
				$item_size = array(150,150);
			}else{
				$item_size = array(150,150);
				$item_class = 'both_sidebar_class';
			} 
			//Slider Settings
			if($select_slider_type <> 'Slider'){
				//Every Third
				if($counter_post % 3 == 0 ){ ?>	 
					<li class="span4 first"> 
						<?php echo cp_print_blog_modern_thumbnail($post->ID, $item_size);?>
						<div class="post-slide-cap modern-dec">
							<span class="post-type"><?php get_the_date(get_option('date_format'));?><i class="fa fa-camera"></i></span>
							<strong class="f-post-title"><a href="<?php echo esc_url(get_permalink());?>"><mark><?php echo esc_html(get_the_title())?></mark></a></strong>
						</div>
					</li>
				<?php }else{ ?>
					<li class="span4"> 
						<?php echo cp_print_blog_modern_thumbnail($post->ID, $item_size);?>
						<div class="post-slide-cap modern-dec">
							<span class="post-type"><?php get_the_date(get_option('date_format'));?><i class="fa fa-camera"></i></span>
							<strong class="f-post-title"><a href="<?php echo esc_url(get_permalink());?>"><mark><?php echo esc_html(get_the_title())?></mark></a></strong>
						</div>
					</li>
				<?php } $counter_post++;
			}
			
		} wp_reset_query(); //end while
		echo '</ul>';	
		
		wp_reset_postdata(); 		
	}	
	
	
	function cp_print_blog_thumbnail( $postid, $item_size ){
		global $counter;
		
		//Get Post Meta Options
		$img_html = '';
		$thumbnail_types = '';
		$video_url_type = '';
		$select_slider_type = '';
		$post_detail_xml = get_post_meta($postid, 'post_detail_xml', true);
		if($post_detail_xml <> ''){
			$cp_post_xml = new DOMDocument ();
			$cp_post_xml->loadXML ( $post_detail_xml );
			$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
			$audio_url_type = cp_find_xml_value($cp_post_xml->documentElement,'audio_url_type');
			$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
			$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
			//Print Image
			
			if( $thumbnail_types == "Image"){
				if(get_the_post_thumbnail($postid, $item_size) <> ''){
					$img_html = '<div class="post_featured_image thumbnail_image">';
					$img_html = $img_html . get_the_post_thumbnail($postid, $item_size);
					$img_html = $img_html . '</div>';
				}
				
			}else if( $thumbnail_types == "Video" ){
				//Print Video
				if($video_url_type <> ''){
					$img_html = '<div class="post_featured_image thumbnail_image">';
					$img_html = $img_html . '<div class="blog-thumbnail-video">';
					
					if(cp_get_width($item_size) == '350'){
						$img_html = $img_html . cp_get_video($video_url_type, cp_get_width($item_size), '137');
					}else{
						$img_html = $img_html . cp_get_video($video_url_type, cp_get_width($item_size), cp_get_height($item_size));
					}
					$img_html = $img_html . '</div></div>';
				}
			}else if ( $thumbnail_types == "Slider" ){
				//Print Slider
				$slider_xml = get_post_meta( intval($select_slider_type), 'cp-slider-xml', true); 				
				if($slider_xml <> ''){
					$slider_xml_dom = new DOMDocument();
					$slider_xml_dom->loadXML($slider_xml);
					$slider_name='bxslider'.$counter.$postid;
					$audio_counter = $counter.$postid;
					//Included Anything Slider Script/Style
					wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
					wp_enqueue_script('cp-bx-slider');	
					wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
					//Inline Style for Slider Width
					if(cp_get_width($item_size) == '175'){
						$img_html = "<style>#'". $slider_name."'{width:'".cp_get_width($item_size)."'px;height:'".cp_get_height($item_size)."'px;float:left;}</style>";
					}else{
						$img_html = "<style>#'". $slider_name."'{width:100%;height:350px;float:left;}</style>";
					}
					$img_html = '<div class="cp_slider_frame cp_blog_detail">';
					$img_html = $img_html . cp_print_bx_slider($slider_xml_dom->documentElement, $item_size,$slider_name);
					$img_html = $img_html . '</div>';
				}
			}else if($thumbnail_types == "Audio"){ 
				if($audio_url_type <> '' ){
				$audio_counter = $counter.$postid;
					//Jplayer Music Started	
					$img_html =  '<div class="mp3-player-box">';
					$audio_html = '';
					if(strpos($audio_url_type,'soundcloud')){
						$img_html = $img_html . get_audio_track($audio_url_type,$audio_counter);
					}else{
						$img_html = $img_html . get_audio_track($audio_url_type,$audio_counter) . get_the_post_thumbnail($postid, $item_size);
					}
					$img_html = $img_html . '</div>';
				} // No MP3 Song
			}else{				
				if(get_the_post_thumbnail($postid, $item_size) <> ''){
					$img_html = '<div class="post_featured_image thumbnail_image">';
					$img_html = $img_html . get_the_post_thumbnail($postid, $item_size);
					$img_html = $img_html . '</div>';
				}
			}
		}
		return $img_html;
	}
	
	
	// print the blog thumbnail
	function cp_print_blog_modern_thumbnail( $post_id, $item_size ){
		global $counter;
		//Get Post Meta Options
		$img_html = '';
		$thumbnail_types = '';
		$video_url_type = '';
		$select_slider_type = '';
		$post_detail_xml = get_post_meta($post_id, 'post_detail_xml', true);
		if($post_detail_xml <> ''){
			$cp_post_xml = new DOMDocument ();
			$cp_post_xml->loadXML ( $post_detail_xml );
			$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
			$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
			$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
			//Print Image
			if( $thumbnail_types == "Image" || empty($thumbnail_types) ){
				if(get_the_post_thumbnail($post_id, $item_size) <> ''){
					$img_html = '<div class="post_featured_image thumbnail_image">';
					$img_html = $img_html . get_the_post_thumbnail($post_id, $item_size);
					$img_html = $img_html . '</div>';
				}
				
			}else if( $thumbnail_types == "Video" ){
				//Print Video
				if($video_url_type <> ''){
					$img_html = '<div class="post_featured_image thumbnail_image">';
					$img_html = $img_html . '<div class="blog-thumbnail-video">';
					
					if(cp_get_width($item_size) == '175'){
						$img_html = $img_html . cp_get_video($video_url_type, cp_get_width($item_size), cp_get_height($item_size));
					}else{
						$img_html = $img_html . cp_get_video($video_url_type, '100%', cp_get_height($item_size));
					}
					$img_html = $img_html . '</div></div>';
				}
			}else if ( $thumbnail_types == "Slider" ){
				//Print Slider
				$slider_xml = get_post_meta( intval($select_slider_type), 'cp-slider-xml', true); 				
				if($slider_xml <> ''){
					$slider_xml_dom = new DOMDocument();
					$slider_xml_dom->loadXML($slider_xml);
					$slider_name='bxslider'.$counter.$post_id;				
					//Included Anything Slider Script/Style
					wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
					wp_enqueue_script('cp-bx-slider');	
					wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
					if(cp_get_width($item_size) == '175'){
						$img_html = "<style>#'". $slider_name."'{width:'".cp_get_width($item_size)."'px;height:'".cp_get_height($item_size)."'px;float:left;}</style>";
					}else{
						$img_html = "<style>#'". $slider_name."'{width:100%;height:350px;float:left;}</style>";
					}
					$img_html = '<div class="post_featured_image thumbnail_image">';
					$img_html = $img_html . print_bx_post_slider($slider_xml_dom->documentElement, $item_size,$slider_name);
					$img_html = $img_html . '</div>';
				}
			}else if($thumbnail_types == "Audio"){ 
				if(get_the_post_thumbnail($post_id, $item_size) <> ''){
					$img_html = '<div class="post_featured_image thumbnail_image">';
					$img_html = $img_html . get_audio_track($audio);;
					$img_html = $img_html . '</div>';
				}
			}
		}
		return $img_html;
	}
	
	 
	//Print News on Frontpage
	function cp_print_news_item($item_xml){

		
		global $paged,$post,$sidebar,$cp_blog_div_listing_num_class,$post_id;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		//Get Thumbnail Options
		$thumbnail_types = '';
		$post_detail_xml = get_post_meta($post_id, 'post_detail_xml', true);
		if($post_detail_xml <> ''){
			$cp_post_xml = new DOMDocument ();
			$cp_post_xml->loadXML ( $post_detail_xml );
			$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
		}
				
		// get the blog meta value		
		$header = cp_find_xml_value($item_xml, 'header');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
		$news_layout = cp_find_xml_value($item_xml, 'news-layout');
		
		$category = cp_find_xml_value($item_xml, 'category');
		
		// print header
		if(!empty($header)){
			echo '<h2 class="h-style">' . esc_attr($header) . '</h2>';
		}
		
		//Pagination default wordpress
		if(cp_find_xml_value($item_xml, "pagination") == 'Wp-Default'){
			$num_fetch = get_option('posts_per_page');
		}else if(cp_find_xml_value($item_xml, "pagination") == 'Theme-Custom'){
			$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		}else{}
		
		if($category == '0'){
			//Popular Post 
			query_posts(
				array( 
				'post_type' => 'post',
				'paged'				=> $paged,
				'posts_per_page' => $num_fetch,
				//'ignore_sticky_posts' => true,
				'orderby' => 'title',
				'order' => 'DESC' )
			);
		}else{
			//Popular Post 
			query_posts(
				array( 
				'post_type' => 'post',
				'posts_per_page' => $num_fetch,
				'paged'				=> $paged,
				//'ignore_sticky_posts' => true,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'terms' => $category,
						'field' => 'term_id',
					)
				),
				'orderby' => 'date',
				'order' => 'DESC' )
			);
		}
		if($news_layout == 'Grid'){
			echo '<div class="recent-post">';
			echo '<div class="row">';
		}else if($news_layout == 'Modern-Grid'){
			echo '<div class="recent-post recent-post-2">';
			echo '<div class="row">';
		}else if($news_layout == 'Timeline View'){
			echo '<div class="our-history"><div class="holder"><ul>';
		}else{
			echo '<div class="latest-news-post">';
			echo '<div class="blog-detail news-page">';
		}
		
		$counter_news = 0;
		while( have_posts() ){
			the_post();
			$counter_news++;
			global $post, $post_id;
		//Print All post from News
		
			// get the item class and size from array
			$item_type = 'Full-Image';
			$item_class = $cp_blog_div_listing_num_class[$item_type]['class'];
			$item_index = $cp_blog_div_listing_num_class[$item_type]['index'];
			if( $sidebar == "no-sidebar" ){
				$item_size = $cp_blog_div_listing_num_class[$item_type]['size'];
			}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
				$item_size = $cp_blog_div_listing_num_class[$item_type]['size2'];
			}else{
				$item_size = $cp_blog_div_listing_num_class[$item_type]['size3'];
				$item_class = 'both_sidebar_class';
			} 
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(1170,350));
			$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
			if($post_detail_xml <> ''){
				$cp_post_xml = new DOMDocument ();
				$cp_post_xml->loadXML ( $post_detail_xml );
				$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
				$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
				$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');	
			}
			$item_class = '';
			static $multi_counter = 0;
			$multi_counter++;
			if($news_layout == 'Grid'){
			if(cp_print_blog_thumbnail( $post->ID, array(360,300) ) <> ''){ $item_class = 'news-list';}else{$item_class = 'no-image-found';}?>
			<?php if ($multi_counter <> 0){?>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="recent-post-box multi_color_<?php echo esc_attr($multi_counter);?>">
						<div class="inner">
							<strong class="date"><?php echo get_the_date('d');?><span><?php echo get_the_date('M');?></span></strong>
							<div class="frame">
							<?php echo get_the_post_thumbnail($post_id, array(260,300));?>
								<div class="caption"><a class="link" href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-link"></i></a></div>
							</div>
						</div>
						<strong class="title title-color-2"><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(substr(get_the_title(),0,26));?></a></strong>
					</div>
				</div>
			<?php }?>
			<?php
			}else if($news_layout == 'Modern-Grid'){ 
				if($counter_news % 2 == 0 ){ ?>
				<div class="col-md-4">
					<div class="box">
						<div class="frame up-arrow"> <a href="<?php echo esc_url(get_permalink())?>"><?php echo get_the_post_thumbnail($post_id, array(570,300));?></a>
							<div class="caption"><a class="link" href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-link"></i></a></div>
						</div>
						<div class="text-box">
							<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_html(get_the_title());?></a></h3>
							<div class="detail-row">
								<ul>
									<?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
									<li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
									<li><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><i class="fa fa-calendar"></i><?php echo get_the_date();?></a></li>
								</ul>
							</div>
							<p><?php echo substr(esc_attr(get_the_content()),0,$num_excerpt);?></p>
							<a class="btn-read" href="<?php echo esc_url(get_permalink())?>"><?php esc_attr_e('Read More','mosque_crunchpress');?></a>
						</div>
					</div>
				</div>
				
				<?php
				}else{ ?>
				<div class="col-md-4">
					<div class="box">
						<div class="text-box">
							<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_html(get_the_title());?></a></h3>
							<div class="detail-row">
								<ul>
									<?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
									<li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
									<li><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><i class="fa fa-calendar"></i><?php echo get_the_date();?></a></li>
								</ul>
							</div>
							<p><?php echo substr(esc_attr(get_the_content()),0,$num_excerpt);?></p>
							<a class="btn-read" href="<?php echo esc_url(get_permalink())?>"><?php esc_attr_e('Read More','mosque_crunchpress');?></a>
						</div>
						<div class="frame down-arrow"> <a href="<?php echo esc_url(get_permalink())?>"><?php echo get_the_post_thumbnail($post_id, array(570,300));?></a>
							<div class="caption"><a class="link" href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-link"></i></a></div>
						</div>
					</div>
				</div>
				<?php }
			}else if($news_layout == 'Timeline View'){ 
				if($counter_news % 2 == 0 ){ ?>
				<li>
					<div class="history-box">
						<div class="text-box pull-right">
							<h3><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(get_the_title());?></a></h3>
							<p><?php echo esc_attr(strip_tags(substr(get_the_content(),0,$num_excerpt)). '[...]');?></p>
						</div>
						<?php if(get_the_post_thumbnail($post_id, array(570,300)) <> ''){ ?>
						<div class="frame-date pull-left"><div class="year-box"><?php echo esc_attr(get_the_date('Y'));?></div></div>
						<?php }?>
					</div>
				</li>
				<?php
				}else{ ?>
				<li>
					<div class="history-box">
						<div class="text-box pull-left">
							<h3><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(get_the_title());?></a></h3>
							<p><?php echo esc_attr(strip_tags(substr(get_the_content(),0,$num_excerpt)). '[...]');?></p>
						</div>
						<?php if(get_the_post_thumbnail($post_id, array(570,300)) <> ''){ ?>
						<div class="frame-date pull-right"><div class="year-box"><?php echo esc_attr(get_the_date('Y'));?></div></div>
						<?php }?>
					</div>
				</li>
				<?php
				}
			}else{
			if(cp_print_blog_thumbnail( $post->ID, array(360,300) ) <> ''){ $item_class = 'news-list';}else{$item_class = 'no-image-found';}?>
				<div class="<?php echo esc_attr($item_class);?>">
					<?php if(cp_print_blog_thumbnail( $post->ID, array(360,300) ) <> ''){ ?>
					<div class = "row">
						<div class = "col-md-5">
							<div class="<?php if($thumbnail_types == 'Image'){ echo 'frame';}else{echo 'cp_frame';}?>">
								<div class="caption">
									<a href="<?php echo esc_url($image_thumb[0])?>" class="zoom" data-gal="prettyPhoto[gallery1]"><i class="fa fa-link"></i></a>
								</div>							
								<?php echo cp_print_blog_thumbnail( $post->ID, array(360,300) );?>
							</div>
						</div>
						<?php }?>
						<div class = "col-md-7">
							<div class="text-box">
								<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_html(get_the_title());?></a></h3>
								<div class="detail-row">
									<ul>
										<?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
										<li><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>" class="mnt"><i class="fa fa-calendar"></i> <?php echo get_the_date(get_option("date_format"));?></a></li>
									</ul>
								</div>
								<p>
									<?php echo strip_tags(substr(esc_attr(get_the_excerpt()),0, $num_excerpt));?>
									<?php if(strlen(get_the_excerpt() > $num_excerpt)){?> <a href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('[+]','mosque_crunchpress')?></a><?php }?>
								</p>
							</div>
							<div class="detail-row">
								<ul>
									<li><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-user"></i><?php echo get_the_author();?></a></li>
									<li><?php 
										if ( comments_open() ) :
										  echo '<p>';
										  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
										  echo '</p>';
										endif;?>
									</li>
									<?php if(get_post_meta($post->ID,'popular_post_views_count',true) <> ''){ ?><li><a class="like" href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-heart-o"></i><?php echo get_post_meta($post->ID,'popular_post_views_count',true);?></a></li><?php }?>
									
									<li>
										<div class="dropdown">
										<a class="like share-dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share', 'mosque_crunchpress');?></a>
											<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
												<?php cp_include_social_shares();?> 
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>				
		<?php
			} //Condition Ends for Layout
			
		} wp_reset_query(); //end while
		//Avoiding Div Issue On HomePage Charity
		if($news_layout == 'Grid'){
		echo '</div>';
		}else{
			echo '</div>';
		}	
			if( cp_find_xml_value($item_xml, "pagination") == "Theme-Custom" ){	
				cp_pagination();
			}
			
		wp_reset_postdata();
		
		
		if($news_layout == 'Timeline View'){
			echo '<ul></div></div>';
		}else{

			echo '</div>';
		}
				
		echo '<span id="loader"></span>';
		
	
	}	
	
	//Blog Slider 
	function cp_print_blog_slider_item($item_xml){ 
	
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$number_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt'); 
		$blog_slider = cp_find_xml_value($item_xml, 'blog-slider-type'); 

		// Get Post From Database
		if($category == '0'){
			//Popular Post 
			query_posts(
				array( 
				'post_type'			 => 'post',
				'posts_per_page' 	 => $number_fetch,
				'orderby'			 => 'date',
				'order' 			 => 'DESC' )
			);
		}else{
			//Popular Post 
			query_posts(
				array( 
				'post_type' 		=> 'post',
				'posts_per_page' 	=> $number_fetch,
				'tax_query' 		=> array(
					array(
						'taxonomy'	=> 'category',
						'terms' 	=> $category,
						'field' 	=> 'term_id',
					)
				),
				'orderby' 			=> 'date',
				'order' 			=> 'DESC' )
			);
		}
		
		if($blog_slider == 'Carousel'){ ?>
			<div class="latest-news">
			<script type="text/javascript">
				jQuery(document).ready(function ($) {
					"use strict";
					 $("#cp-content-1").mCustomScrollbar({
						horizontalScroll: true
					});
					$(".cp_content.inner").mCustomScrollbar({
						scrollButtons: {
							enable: true
						}
					});
				});
			</script>
			<?php if($header <> ''){ ?><h2 class="section-title"><?php echo esc_attr($header); ?></h2><?php }?>
			<div id="cp-content-1" class="cp_content">
				<div class="new-col-row">
					<?php
					while( have_posts() ){
						the_post();
						global $post, $post_id;
					?>
					<div class="blog-column-4">
						<div class="latest-news-box">
							<div class="inner">
								<strong class="title">
									<a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(substr(get_the_title(),0,30));?></a>
								</strong>
								<strong class="date"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date('D'));?>, <?php echo esc_attr(get_the_date('d'));?> <?php echo esc_attr(get_the_date('M'));?>, <?php echo esc_attr(get_the_date('Y'));?></strong>
							</div>
							<div class="frame">
								<?php echo cp_print_blog_thumbnail($post->ID,array(360,300));?>
								<div class="caption">
									<a href="<?php echo esc_url(get_permalink());?>" class="link"><i class="fa fa-link"></i></a>
								</div>
							</div>
							<div class="inner">
								<p><?php echo esc_attr(strip_tags(mb_substr(get_the_content(),0,$num_excerpt)));?> <a href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('[+]','mosque_crunchpress')?></a></p>
							</div>
							<div class="comment-row">
								<ul>
									<li>
										<?php
											if ( comments_open() ) :
											  echo '<p>';
											  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
											  echo '</p>';
											endif;
										?>
									</li>
									<li><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share','mosque_crunchpress');?></a></li>
								</ul>
							</div>
						</div>
					</div>	
				<?php } wp_reset_query(); //end while ?> 
				</div>
			</div>
		</div>	
		
		<?php }else{ ?>
		<div class="latest-news">
				<?php if($header <> ''){ ?><h2 class="section-title"><?php echo esc_attr($header); ?></h2><?php }?>
				<div class="row">
					<?php
					while( have_posts() ){
						the_post();
						global $post, $post_id; ?>
					<div class="col-md-3">
						<div class="latest-news-box">
							<div class="inner">
								<strong class="title">
									<a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(substr(get_the_title(),0,15));?></a>
								</strong>
								<strong class="date"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date('D'));?>, <?php echo esc_attr(get_the_date('d'));?> <?php echo esc_attr(get_the_date('M'));?>, <?php echo esc_attr(get_the_date('Y'));?></strong>
							</div>
							<div class="frame">
								<?php echo cp_print_blog_thumbnail($post->ID,array(360,300));?>
								<div class="caption">
									<a href="<?php echo esc_url(get_permalink());?>" class="link"><i class="fa fa-link"></i></a>
								</div>
							</div>
							<div class="inner">
								<p><?php echo esc_attr(strip_tags(mb_substr(get_the_content(),0,$num_excerpt)));?> <a href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('[+]','mosque_crunchpress')?></a></p>
							</div>
							<div class="comment-row">
								<ul>
									<li>
										<?php
											if ( comments_open() ) :
											  echo '<p>';
											  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
											  echo '</p>';
											endif;
										?>
									</li>
									<li><a href="#"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share','mosque_crunchpress');?></a></li>
								</ul>
							</div>
						</div>
					</div>	
				<?php } wp_reset_query(); //end while ?> 
				</div>
			</div>	
		
			<?php 
		}
	} //Function Ends Here
	
	
	//Latest Show For DJ
	function cp_print_latest_show_item($item_xml){
		global $post,$counter;
		
		//Fetch elements data from database
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
		
		//Condition for Header
		if($header <> ''){ echo '<h2 class="h-style">'.esc_attr($header).'</h2>';} ?>
		<?php
		//Bx Slider Script Calling
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');?>
		<script type="text/javascript">
		jQuery(document).ready(function ($) {
			"use strict";
			if ($('#news-<?php echo esc_js($counter);?>').length) {
				$('#news-<?php echo esc_js($counter);?>').bxSlider({
					minSlides: 1,
					maxSlides: 1,
					auto:true,
					mode:'fade',
					pagerCustom: '#bx-pager'
				});
			}
		});
		</script>
			<div class="timelines-box">
			<?php
					if($category == '0'){
					//Popular Post 
						query_posts(
							array( 
							'post_type' => 'post',
							'posts_per_page' => 3,
							//'ignore_sticky_posts' => true,
							'orderby' => 'title',
							'order' => 'ASC' )
						);
					
					}else{
						//Popular Post 
						query_posts(
							array( 
							'post_type' => 'post',
							'posts_per_page' => 3,
							//'ignore_sticky_posts' => true,
							'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'terms' => $category,
									'field' => 'term_id',
								)
							),
							'orderby' => 'title',
							'order' => 'ASC' )
						);
					}
			?>
				<ul class="text-parent-cp" id="bx-pager">
				<?php 
					$counter_news = 0;
					while ( have_posts() ) { 
						the_post();
						global $post,$post_id;?>
							<li><a data-slide-index="<?php echo esc_attr($counter_news);?>"><?php echo esc_html(get_the_title());?></a></li>
					<?php 
						$counter_news++;
					}
						
					?>
				</ul>
				<ul id="news-<?php echo esc_attr($counter);?>" class="timelines-slider post-list">
					<?php
					while ( have_posts() ) { 
						the_post();
						global $post,$post_id;
						//Post Extra Information
						$thumbnail_types = '';
						$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$cp_post_xml = new DOMDocument ();
							$cp_post_xml->loadXML ( $post_detail_xml );
							$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
							$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
							$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');				
						}
						$width_class_first = '';
						$thumbnail_id = get_post_thumbnail_id( $post->ID );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(1600,900) );?>
						<li>
							<?php if($thumbnail[1].'x'.$thumbnail[2] == '1600x900'){ ?><figure><a href="<?php echo esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail($post->ID, array(1600,900));?></a></figure>
							<div class="caption">
								<p><?php echo strip_tags(mb_substr(esc_attr(get_the_content()),0,$num_excerpt));?></p>
							</div>
							<?php }?>
						</li>
					<?php }
						wp_reset_query();
						wp_reset_postdata();
					?>	
				</ul>
				
			</div>
		<?php
	}
	
	
              
	
	//Latest News For Site
	function cp_print_featured_item($item_xml){
		global $post,$counter;
		
		//Fetch elements data from database
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$number_posts = cp_find_xml_value($item_xml, 'number-of-posts');
		?>
		<div class="latest_posts acc-style">
		
		<?php 
		//Condition for Header
		if($header <> ''){ echo '<h3>'.esc_attr($header).'</h3>';} ?>
		
			<div class="css3accordion">
				<ul id="feature-<?php echo esc_attr($counter);?>" class="css3accordion-cp">
					<?php
					if($category == '0'){
					//Popular Post 
						query_posts(
							array( 
							'post_type' => 'post',
							'posts_per_page' => 3,
							//'ignore_sticky_posts' => true,
							'orderby' => 'title',
							'order' => 'ASC' )
						);
					
					}else{
						//Popular Post 
						query_posts(
							array( 
							'post_type' => 'post',
							'posts_per_page' => 3,
							//'ignore_sticky_posts' => true,
							'tax_query' => array(
								array(
									'taxonomy' => 'category',
									'terms' => $category,
									'field' => 'term_id',
								)
							),
							'orderby' => 'title',
							'order' => 'ASC' )
						);
					}
					while ( have_posts() ) { 
						the_post();
						global $post,$post_id;
						//Post Extra Information
						$thumbnail_types = '';
						$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$cp_post_xml = new DOMDocument ();
							$cp_post_xml->loadXML ( $post_detail_xml );
							$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
							$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
							$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');				
						}
						$width_class_first = '';
						$thumbnail_id = get_post_thumbnail_id( $post->ID );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(570,300) );?>
						<li>
							<div class="inner-acc">
								<a href="<?php echo esc_url(get_permalink());?>" class="thumb hoverBorder"><?php echo get_the_post_thumbnail($post->ID, array(570,300));?></a>
								<div class="content">
									 <div class="top">
									 <?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
										<a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><strong class="mnt"><i class="fa fa-calendar"></i> <?php echo get_the_date();?></strong></a>
										<?php if($get_post_cp->comment_count <> ''){ ?><div class="like"><i class="fa fa-comments-o"></i> <?php echo esc_attr($get_post_cp->comment_count);?></div><?php }?>
									</div>
									<strong class="title"><?php echo substr(esc_html(get_the_title()),0,26);?></strong>
									<p><?php echo strip_tags(mb_substr(esc_attr(get_the_content()),0,65));?></p>
									<a href="<?php echo esc_url(get_permalink());?>" class="readmore"><?php esc_html_e('Read More','mosque_crunchpress');?></a>
								</div>
							</div>
						</li>
					<?php }wp_reset_query(); ?>	
				</ul>
			</div>
		</div>	
		<?php
	}