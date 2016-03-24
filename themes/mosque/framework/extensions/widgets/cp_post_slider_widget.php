<?php
class cp_post_slider_widget extends WP_Widget
{
  function cp_post_slider_widget()
  {
    $widget_ops = array('classname' => 'post_slider', 'description' => 'Post Slider Widget' );
    parent::__construct('cp_post_slider_widget', 'CrunchPress : Post Slider Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';
?>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
	 <?php esc_html_e('Title:','mosque_crunchpress');?>  
	  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
<p>
  <label for="<?php echo esc_attr($this->get_field_id('select_category')); ?>">
	 <?php esc_html_e('Select Category:','mosque_crunchpress');?> 
	  <select id="<?php echo esc_attr($this->get_field_id('select_category')); ?>" name="<?php echo esc_attr($this->get_field_name('select_category')); ?>" class="widefat">
		<?php
        global $wpdb,$post;
		foreach ( get_category_list_array('category') as $category){ ?>
                    <option <?php if($select_category == $category->slug){echo 'selected';}?> value="<?php echo esc_attr($category->slug);?>" >
	                    <?php echo substr(esc_attr($category->name), 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    $instance['select_category'] = $new_instance['select_category'];	
	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$select_category = isset( $instance['select_category'] ) ? esc_attr( $instance['select_category'] ) : '';		
		
		
		echo html_entity_decode($before_widget);	
		// WIDGET display CODE Start
		echo '<div class="sidebar-bix-1">';
		if (!empty($title))
			echo html_entity_decode($before_title);
			echo '<i class="icon-pushpin"></i>';
			echo '<h3>'.esc_attr($title). '</h3>';
			echo html_entity_decode($after_title);
			global $wpdb, $post;
			//global $counter;
			
			$counter = rand();
			//Bx Slider Script Calling
					
					wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
					wp_enqueue_script('cp-bx-slider');	
					wp_register_script('jquery.bxslider', CP_PATH_URL.'/frontend/js/jquery.bxslider.js', false, '1.0', true);
					wp_enqueue_script('jquery.bxslider');	
					wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/default/jquery.bxslider.css');?>
			
				<script type="text/javascript">
				jQuery(document).ready(function ($) {
						"use strict";
						if ($('#post-slider-<?php echo esc_js($counter); ?>').length) {
							$('#post-slider-<?php echo esc_js($counter); ?>').bxSlider({
								auto:true,
								controls:true,
								pager:false,
								adaptiveHeight: true,
								
							});
						}
					});
				</script>
				<div class= "cp_post_widget_wrap">
					<ul id="post-slider-<?php echo esc_attr($counter);?>">
						<?php
						$category_array = get_term_by('slug', $select_category, 'category');
						global $post, $wp_query;
						$class_odd = '';
							$args = array(
								'posts_per_page'			=> -1,
								'post_type'					=> 'post',
								'category'					=> $select_category,
								'post_status'				=> 'publish',
								'orderby'					=> 'meta_value',
								'order'						=> 'DESC',
								);
							query_posts($args);
							 if ( have_posts() <> "" ) {
							 $counter_new = 0;
								while ( have_posts() ): the_post();
								?>	
								
								<li><?php echo get_the_post_thumbnail($post->ID, array(270,270));;?>
									<!--<div class="caption"><a href="<?php echo esc_url(get_permalink());?>"><?php echo substr(get_the_title(), 0 , 20);?></a></div>-->
								</li>							
								
							<?php 
							endwhile;
								wp_reset_query();
								wp_reset_postdata();
							}else {
								
							}?>
					</ul>
				</div>
			</div>
	<?php
	
	echo html_entity_decode($after_widget);
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("cp_post_slider_widget");') );?>