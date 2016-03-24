<?php
/**
 * The template for displaying featured content
 *
 * @package CrunchPress
 * @subpackage Mosque
 */
?>

<div id="sticky-<?php the_ID(); ?>" class="blog-detail sticky-post">
<?php
	/**
	 * Fires before the Twenty Fourteen featured content.
	 *
	 * @since Twenty Fourteen 1.0
	 */
	//do_action( 'twentyfourteen_featured_posts_before' );
	
	$thumbnail_types = '';
	$counter_posts = 1;
	$featured_posts = cp_get_featured_posts();
	foreach ( (array) $featured_posts as $order => $post ) :
		setup_postdata( $post ); 
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
			$mask_html = '';
			$no_image_class = 'no-image';
			if(get_the_post_thumbnail($post->ID, array(1140,575)) <> ''){
				$mask_html = '<div class="mask">
					<a href="'.esc_url(get_permalink()).'#comments" class="anchor"><span> </span> <i class="fa fa-comment"></i></a>
					<a href="'.esc_url(get_permalink()).'" class="anchor"> <i class="fa fa-link"></i></a>
				</div>';
				$no_image_class = 'image-exists';
			}			

			$get_post_cp = get_post($post);
			
			$archive_year  = get_the_time('Y'); $archive_month = get_the_time('m'); $archive_day   = get_the_time('d'); ?>
			<!--BLOG LIST ITEM START-->
			<div <?php post_class('post-listing'); ?>>
				<div class="frame">
					<?php echo cp_print_blog_thumbnail($post->ID,array(1140,575));?>
				</div>
				<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
				<div class="detail-row">
					<ul>
						<li><a href="#"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
						<li><a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day); ?>"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>
						<?php if($get_post_cp->comment_count <> ''){ ?><li class="like"><i class="fa fa-comments-o"></i> <?php echo esc_attr($get_post_cp->comment_count);?></li><?php }
						the_tags('<li class="ptags"><i class="fa fa-list"></i>','','</li>');?>
					</ul>
				</div>
				<div class="clearfix"></div>
				<?php the_content();?>
				<a class="btn-8" href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('Read More','mosque_crunchpress');?></a>
			</div>
			<!--BLOG LIST ITEM START-->				
		<?php
	endforeach;
	
	/**
	 * Fires after the Twenty Fourteen featured content.
	 *
	 * @since Twenty Fourteen 1.0
	 */
	//do_action( 'twentyfourteen_featured_posts_after' );

	wp_reset_postdata();
?>
</div><!-- .featured-content-inner -->
