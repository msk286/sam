<?php
/*
 * This file is used to generate WordPress standard archive/category pages.
 */
 
get_header ();
	
	//Get Default Option for Archives, Category, Search.
	$cp_num_excerpt = '';
	$cp_default_settings = get_option('default_pages_settings');
	
	if($cp_default_settings != ''){
		$cp_default = new DOMDocument ();
		$cp_default->loadXML ( $cp_default_settings );
		$sidebar = cp_find_xml_value($cp_default->documentElement,'sidebar_default');
		$right_sidebar = cp_find_xml_value($cp_default->documentElement,'right_sidebar_default');
		$left_sidebar = cp_find_xml_value($cp_default->documentElement,'left_sidebar_default');
		$cp_num_excerpt = cp_find_xml_value($cp_default->documentElement,'default_excerpt');
		
	}	
	//Get Default Excerpt
	$cp_num_excerpt = 250;
	
	if(empty($paged)){
		$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
	}
	global $paged,$post,$sidebar,$blog_div_size_num_class,$counter,$wp_query;	
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
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
		$html_class = cp_print_header_class($header_style);
		if($html_class <> ''){$cp_html_class_banner = 'banner';}
		$breadcrumbs = '';
		$breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
		$cp_page_caption = '';
		$header_style = '';
		//Print Style 6
		if(cp_print_header_html_val($header_style) == 'Style 5'){
			cp_print_header_html($header_style);
		}
	?>
	<div class="contant">
		<!--Inner Pages Heading Area Start-->
		<div id="banner">
			<div id="inner-banner">
				<div class="container">
					<?php if (is_category()) { ?>
						<h1><?php esc_html_e('Categories', 'mosque_crunchpress'); ?> <?php echo esc_attr(single_cat_title()); ?></h1>
					<?php } elseif (is_day()) { ?>
						<h1><?php esc_html_e('Archive for', 'mosque_crunchpress'); ?> 
						<?php echo get_the_date(get_option("date_format")); ?></h1>
					<?php } elseif (is_month()) { ?>
						<h1><?php esc_html_e('Archive for', 'mosque_crunchpress'); ?> <?php echo get_the_date(get_option("date_format")); ?></h1>
					<?php } elseif (is_year()) { ?>
						<h1><?php esc_html_e('Archive for', 'mosque_crunchpress'); ?> <?php echo get_the_date(get_option("date_format")); ?></h1>
					<?php }elseif (is_search()) { ?>
						<h1><?php esc_html_e('Search results for', 'mosque_crunchpress'); ?> : <?php echo get_search_query() ?></h1>
					<?php } elseif (is_tag()) { ?>
						<h1><?php esc_html_e('Tag Archives', 'mosque_crunchpress'); ?> : <?php echo esc_attr(single_tag_title('', true)); ?></h1>
					<?php }elseif (is_author()) { ?>
						<h1><?php esc_html_e('Archive by Author', 'mosque_crunchpress'); ?></h1>
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
            <div class="main-content main-content-area blog blog-full">
				<div class="single_content row">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
						<div id="block_first_left" class="sidebar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php } ?>
					<div id="archive-<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> blog-detail">						
							<?php if (is_author()) { 
								if ( have_posts() ) {
									the_post();?>
									<div class="clear"></div>
									<!--DETAILED TEXT END-->
									<div class="comment-box">
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
											<div class="share-it">
												<h5><?php esc_html_e('Follow Me','mosque_crunchpress');?></h5>
												<?php 
													$facebook = get_the_author_meta('facebook');
													$twitter = get_the_author_meta('twitter');
													$gplus = get_the_author_meta('gplus');
													$linked = get_the_author_meta('linked');
													$skype = get_the_author_meta('skype');
												?>
												<?php if($facebook <> ''){ ?><a title="" data-toggle="tooltip" href="<?php echo esc_url($facebook);?>" data-original-title="facebook"><i class="fa fa-facebook"></i></a><?php }?>
												<?php if($twitter <> ''){ ?><a title="" data-toggle="tooltip" href="<?php echo esc_url($twitter);?>" data-original-title="Twitter"><i class="fa fa-twitter"></i></a><?php }?>
												<?php if($gplus <> ''){ ?><a title="" data-toggle="tooltip" href="<?php echo esc_url($gplus);?>" data-original-title="Google Plus"><i class="fa fa-google-plus"></i></a><?php }?>
												<?php if($linked <> ''){ ?><a title="" data-toggle="tooltip" href="<?php echo esc_url($linked);?>" data-original-title="Linkedin"><i class="fa fa-linkedin"></i></a><?php }?>
												<?php if($skype <> ''){ ?><a title="" data-toggle="tooltip" href="<?php echo esc_url($skype);?>" data-original-title="skype"><i class="fa fa-skype"></i></a><?php }?>
											</div>
										</div>
									</div>
								<?php
								} 
							}
						if ( have_posts() ){ while ( have_posts() ) : the_post();
								//Image dimenstion
							global $post, $post_id;	
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
							
							$mask_html = '';
							$no_image_class = 'no-image';
							if(get_the_post_thumbnail($post_id, array(1140,575)) <> ''){
								$mask_html = '<div class="mask">
									<a href="'.esc_url(get_permalink()).'#comments" class="anchor"><span> </span> <i class="fa fa-comment"></i></a>
									<a href="'.esc_url(get_permalink()).'" class="anchor"> <i class="fa fa-link"></i></a>
								</div>';
								$no_image_class = 'image-exists';
							}	
							$cp_arc_div_archive_listing_class = array("Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1140,575), "size2"=>array(570, 300), "size3"=>array(570,300)));
							$item_type = 'Full-Image';
							$item_class = $cp_arc_div_archive_listing_class[$item_type]['class'];
							$item_index = $cp_arc_div_archive_listing_class[$item_type]['index'];		
							if( $sidebar == "no-sidebar" ){
								$item_size = $cp_arc_div_archive_listing_class[$item_type]['size'];
							}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
								$item_size = $cp_arc_div_archive_listing_class[$item_type]['size2'];
							}else{
								$item_size = $cp_arc_div_archive_listing_class[$item_type]['size3'];
							}										
							$get_post_cp = get_post($post_id);
							$thumbnail_id = get_post_thumbnail_id( $post->ID );
							
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, 'full');
							?>
							<!--BLOG LIST ITEM START-->
							<div <?php post_class('post-listing'); ?>>
								<div class="frame">
									<?php echo cp_print_blog_thumbnail($post->ID,array(1140,575));?>
								</div>
								<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
								<?php $archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
								<div class="detail-row">
									<ul>
										<li><a href="#"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
										<li><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>
										<?php if($get_post_cp->comment_count <> ''){ ?><li class="like"><i class="fa fa-comments-o"></i> <?php echo esc_attr($get_post_cp->comment_count);?></li><?php }?>
										<?php the_tags('<li class="ptags"><i class="fa fa-list"></i>','','</li>');?>
									</ul>
									<a class="like" href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share','mosque_crunchpress');?></a>
								</div>
								<div class="clearfix"></div>
								<?php the_content();?>
								<a class="btn-8" href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('Read More','mosque_crunchpress');?></a>
							</div>	
							<!--BLOG LIST ITEM END-->
								<?php 
							//End while
							endwhile; 
							//Condition Ends
						}else{ ?>
							
							<section class="cp_404-section">
								<div class="">
									<h2><?php esc_html_e('Sorry!','mosque_crunchpress');?></h2>
									<em><?php esc_html_e('Nothing Found','mosque_crunchpress');?></em>
									<div class="inner-holder">
										<strong><?php esc_html_e('It looks like we are having a problem
											why do not you go back to the homepage and try again.','mosque_crunchpress');?></strong>
										<a href="<?php  echo esc_url(home_url('/')); ?>" class="btn-back"><?php esc_html_e('Go Back to Homepage','mosque_crunchpress');?></a>
										<form method="get" class="error-page-form">
											<input type="text" placeholder="<?php esc_html_e('Enter keywords here...','mosque_crunchpress');?>">
											<input type="submit" value="Search">
										</form>
									</div>
								</div>
							</section>
					<?php	}
							//Pagination
							cp_pagination();
						?>						
					</div>	
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div class="<?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
					<div class="<?php echo esc_attr($cp_sidebar_class[0]);?>">
						<?php dynamic_sidebar( $right_sidebar );?>
					</div>
					<?php } ?>						   
				</div>
			</div>
		</div>
	</div>	
<div class="clear"></div>
<?php get_footer(); ?>