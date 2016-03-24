<?php get_header(); ?>
<?php if ( have_posts() ){ while (have_posts()){ the_post();
	global $post;
	
	// Get Post Meta Elements detail 
	$post_social = '';
	$sidebar = '';
	$right_sidebar = '';
	$left_sidebar = '';
	$thumbnail_types = '';
	$cp_page_caption = '';
	
	$post_format = get_post_meta($post->ID, 'post_format', true);
	$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
	if($post_detail_xml <> ''){
		$cp_post_xml = new DOMDocument ();
		$cp_post_xml->loadXML ( $post_detail_xml );
		$post_social = cp_find_xml_value($cp_post_xml->documentElement,'post_social');
		$sidebar = cp_find_xml_value($cp_post_xml->documentElement,'sidebar_post');
		$cp_page_caption = cp_find_xml_value($cp_post_xml->documentElement,'page_caption');
		$right_sidebar = cp_find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
		$left_sidebar = cp_find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
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
	$get_post_cp = get_post($post);
	
	//Get Sidebar for page
	$cp_sidebar_class = cp_sidebar_func($sidebar);
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
	
		$cp_header_class = '';
		$cp_header_class = cp_print_header_selected();
		
		if($cp_header_class == 'header-style-3'){
			
				$cp_header_class = 'header-style-3';
		}else{
				$cp_header_class == '';
		}
		
	?>
	<div class="contant <?php echo esc_attr($cp_header_class); ?>">
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
		<?php if($breadcrumbs == 'disable'){
					$cp_class_margin = 'margin_top_cp';
				}else {
					$cp_class_margin = '';
				}
		?>
		<div class="blog-detail margin-top-bottom <?php echo esc_attr($cp_class_margin);?>">
			<div class="container">
			<!--MAIN CONTANT ARTICLE START-->
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
					<?php $image_size = array(1170,350);?>
					<!--Blog Detail Page Page Start-->
					<div id="post-<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> cp_blog_detail">
						<div class="blog-detail post-listing <?php echo esc_attr($thumbnail_types);?>">
							<?php if(cp_print_blog_thumbnail($post->ID,$image_size) <> ''){ ?>
								<div class="frame">
								<strong><?php echo get_the_date('d')?> <span><?php echo get_the_date('M')?></span></strong>	
									 <?php echo cp_print_blog_thumbnail($post->ID,$image_size); ?>
								</div>
							<?php }?>
							
							<div class="detail-row">
								<h3><?php echo esc_attr(get_the_title()); ?></h3>
								<div class = "cp_post_meta_single">
									<ul>
										<li><a href="#"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
										<li><a href="#"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>
										<?php if($get_post_cp->comment_count <> ''){ ?>
										<li class="like">
											<?php
												if ( comments_open() ) :
												  echo '<p>';
												  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
												  echo '</p>';
												endif;
											?>	
										</li>

										<?php }
										$categories = wp_get_post_terms( $post->ID, 'category');
										if($categories <> ''){ ?>
											<li>
											<i class="fa fa-list"></i>
												<?php
												$categories = wp_get_post_terms( $post->ID, 'category');
												foreach($categories as $category){
													echo '<a href="'.esc_url(get_term_link((int) $category->term_id,'category')).'">'.esc_html($category->name).', </a>';
												}
												?>
											</li>
										<?php }?>
									</ul>
								
									 <?php if ($post_social == 'enable'){ ?>
										<div class="dropdown">
												<a class="like share-dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share', 'mosque_crunchpress');?></a>
											<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
												<?php cp_include_social_shares();?> 
											</ul>
										</div>
									<?php } ?>
									<a class="like"><i class="fa fa-heart-o"></i><?php echo get_post_meta($post->ID,'popular_post_views_count',true);?></a>
								</div>
								<div class = "cp_post_content_single">
									<?php the_content();?>
								</div>
								<?php the_tags('<div class="tags"><strong class="title">'.esc_html_e('Tags: ','mosque_crunchpress').'</strong>',' ','</div>');?>
							</div>
							
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
					<!--Blog Detail Page Page End--> 
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