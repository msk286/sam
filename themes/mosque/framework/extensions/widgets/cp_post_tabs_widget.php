<?php
class cp_post_tabs extends WP_Widget
{
  function cp_post_tabs()
  {
    $widget_ops = array('classname' => 'cp_post_tabs', 'description' => 'Select To Show Posts In Tabs Panel' );
    parent::__construct('cp_post_tabs', 'CrunchPress : Posts In Tabs', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$title2 = isset( $instance['title2'] ) ? esc_attr( $instance['title2'] ) : '';
	$title3 = isset( $instance['title3'] ) ? esc_attr( $instance['title3'] ) : '';
	$nop = isset( $instance['nop'] ) ? esc_attr( $instance['nop'] ) : '';
	
?>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
	 <?php esc_html_e('Title [Popular Post Tab]:','mosque_crunchpress');?>  
	  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>   

  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title2')); ?>">
	 <?php esc_html_e('Title [Recent Post Tab]:','mosque_crunchpress');?>  
	  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title2')); ?>" name="<?php echo esc_attr($this->get_field_name('title2')); ?>" type="text" value="<?php echo esc_attr($title2); ?>" />
  </label>
  </p>
  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title3')); ?>">
	 <?php esc_html_e('Title [Comments Post Tab]:','mosque_crunchpress');?>  
	  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title3')); ?>" name="<?php echo esc_attr($this->get_field_name('title3')); ?>" type="text" value="<?php echo esc_attr($title3); ?>" />
  </label>
  </p>
  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('nop')); ?>">
	 <?php esc_html_e('Number of Posts To Display:','mosque_crunchpress');?> 
	  <input class="widefat" size="2" id="<?php echo esc_attr($this->get_field_id('nop')); ?>" name="<?php echo esc_attr($this->get_field_name('nop')); ?>" type="text" value="<?php echo esc_attr($nop); ?>" />
  </label>
  </p>

<?php
  }
 
  function update($new_instance, $old_instance )
  {
  
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['title2'] = $new_instance['title2'];
	$instance['title3'] = $new_instance['title3'];
	$instance['nop'] = $new_instance['nop'];
	
    
	return $instance;

  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);		
		$title2 = empty($instance['title2']) ? ' ' : apply_filters('widget_title', $instance['title2']);		
		$title3 = empty($instance['title3']) ? ' ' : apply_filters('widget_title', $instance['title3']);	
		$nop = isset( $instance['nop'] ) ? esc_attr( $instance['nop'] ) : '';	
				
		if($nop == ""){$nop = '-1';}
		echo html_entity_decode($before_widget);	
		echo '
		<script>
			jQuery(document).ready(function($) {
				$("#myTab a").click(function (e) {
					e.preventDefault();
					$(this).tab("show");
				});			
			});
		</script>
		<div class="sidebar-tab">
					<ul class="nav nav-tabs" id="myTab">
					  <li class="active"><a href="#tab-1">'.esc_attr($title).'</a></li>
					  <li><a href="#tab-2">'.esc_attr($title2).'</a></li>
					  <li><a href="#tab-3">'.esc_attr($title3).'</a></li>
					</ul>';

		global $wpdb, $post;
		
		?>
		<div class="tab-content">
			<div class="tab-pane active" id="tab-1">
				<div class="sidebar-tab-content">	
					<ul>
						<?php
						$counter_post_cp = 0;
						$popularpost = new WP_Query(
							array(
								'ignore_sticky_posts' => true,
								'posts_per_page' => $nop,
								'post_type'=> 'post',
								'meta_key' => 'popular_post_views_count', 'orderby' => 'popular_post_views_count meta_value_num', 'order' => 'DESC'  )
						);
						
						while ( $popularpost->have_posts() ) : $popularpost->the_post();
						global $post;
						$post_social = '';
						$sidebars = '';
						$right_sidebar_post = '';
						$left_sidebar_post = '';
						$post_thumbnail = '';
						$video_url_type = '';
						$select_slider_type = '';
						$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$cp_post_xml = new DOMDocument ();
							$cp_post_xml->loadXML ( $post_detail_xml );
							$post_social = cp_find_xml_value($cp_post_xml->documentElement,'post_social');
							$sidebars = cp_find_xml_value($cp_post_xml->documentElement,'sidebar_post');
							$right_sidebar_post = cp_find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
							$left_sidebar_post = cp_find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
							$post_thumbnail = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
							$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
							$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
						}
						?>
							<!-- Widget POST Tabs Code -->	
							<li>
								<div class="thumb"><a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail($post->ID, array(80,80));?></a></div>
								<div class="text-box">
									<p><?php echo strip_tags(substr(get_the_content(), 0, 30));?>...</p>
									<a class="mnt" href="<?php echo get_permalink();?>"><?php echo get_the_date(); ?></a>
									<a href="#" class="comment">
										<?php
											if ( comments_open() ) :
											  echo '<p>';
											  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
											  echo '</p>';
											endif;
										?>
									</a>		
								</div>
							</li>
							<!--Widget POST TABs END -->
						<?php endwhile;?>
					</ul>
				</div>
			</div>
		
			<div class="tab-pane" id="tab-2">
				<div class="sidebar-tab-content">
					<ul>
						<?php
						$counter_post_cp = 0;
						$popularpost = new WP_Query(
							array(
								'ignore_sticky_posts' => true,
								'posts_per_page' => $nop,
								'post_type'=> 'post',
								'order' => 'DESC'  )
						);
						
						while ( $popularpost->have_posts() ) : $popularpost->the_post();
						global $post;
						$post_social = '';
						$sidebars = '';
						$right_sidebar_post = '';
						$left_sidebar_post = '';
						$post_thumbnail = '';
						$video_url_type = '';
						$select_slider_type = '';
						$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$cp_post_xml = new DOMDocument ();
							$cp_post_xml->loadXML ( $post_detail_xml );
							$post_social = cp_find_xml_value($cp_post_xml->documentElement,'post_social');
							$sidebars = cp_find_xml_value($cp_post_xml->documentElement,'sidebar_post');
							$right_sidebar_post = cp_find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
							$left_sidebar_post = cp_find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
							$post_thumbnail = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
							$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
							$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
						}
						?>
							<!-- Widget POST Tabs Code -->	
							<li>
								<div class="thumb"><a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail($post->ID, array(80,80));?></a></div>
								<div class="text-box">
									<p><?php echo strip_tags(substr(get_the_content(), 0, 30));?>...</p>
									<a class="mnt" href="<?php echo get_permalink();?>"><?php echo get_the_date(); ?></a>
									<a href="#" class="comment">
										<?php

											if ( comments_open() ) :
											  echo '<p>';
											  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
											  echo '</p>';
											endif;
										?>
									</a>		
								</div>
							</li>
							<!--Widget POST TABs END -->
						<?php endwhile; ?>
					</ul>
				</div>
			</div>	
				
				
			<div class="tab-pane" id="tab-3">
				<div class="sidebar-tab-content">
					<ul>
					<?php
						$counter_post_cp = 0;
						$popularpost = new WP_Query(
							array(
								'ignore_sticky_posts' => true,
								'posts_per_page' => $nop,
								'post_type'=> 'post',
								'orderby' => 'comment_count',
								'order' => 'DESC'  )
						);
							
						while ( $popularpost->have_posts() ) : $popularpost->the_post();
						global $post;
						$post_social = '';
						$sidebars = '';
						$right_sidebar_post = '';
						$left_sidebar_post = '';
						$post_thumbnail = '';
						$video_url_type = '';
						$select_slider_type = '';
						$post_detail_xml = get_post_meta($post->ID, 'post_detail_xml', true);
						if($post_detail_xml <> ''){
							$cp_post_xml = new DOMDocument ();
							$cp_post_xml->loadXML ( $post_detail_xml );
							$post_social = cp_find_xml_value($cp_post_xml->documentElement,'post_social');
							$sidebars = cp_find_xml_value($cp_post_xml->documentElement,'sidebar_post');
							$right_sidebar_post = cp_find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
							$left_sidebar_post = cp_find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
							$post_thumbnail = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
							$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
							$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
						}
					?>
						<!-- Widget POST Tabs Code -->	
							<li>
								<div class="thumb"><a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail($post->ID, array(80,80));?></a></div>
								<div class="text-box">
									<p><?php echo strip_tags(substr(get_the_content(), 0, 30));?>...</p>
									<a class="mnt" href="<?php echo get_permalink();?>"><?php echo get_the_date(); ?></a>
									<a href="#" class="comment">
										<?php
											
											if ( comments_open() ) :
											  echo '<p>';
											  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
											  echo '</p>';
											endif;
										?>
									</a>		
								</div>
							</li>
						<!--Widget POST TABs END -->
					<?php endwhile; ?>
					</ul>
				</div>
			</div>	
				
		</div>
	</div>
		
					
<?php 
	wp_reset_query();
	wp_reset_postdata();
	
	echo html_entity_decode($after_widget);
		}
	}
add_action( 'widgets_init', create_function('', 'return register_widget("cp_post_tabs");') );?>