<?php
class cp_services_widget extends WP_Widget
{
  function cp_services_widget()
  {
    $widget_ops = array('classname' => 'widget-holder', 'description' => 'Display Your Services' );
    parent::__construct('cp_services_widget', 'CrunchPress : Our Services', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$wid_class = isset( $instance['wid_class'] ) ? esc_attr( $instance['wid_class'] ) : '';
    $title = $instance['title'];
	$number_of_services = isset( $instance['number_of_services'] ) ? esc_attr( $instance['number_of_services'] ) : '';
	$recent_post_category = isset( $instance['recent_post_category'] ) ? esc_attr( $instance['recent_post_category'] ) : '';
	
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('wid_class')); ?>">
			    <?php esc_html_e('Class:','mosque_crunchpress');?> 
			    <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('wid_class')); ?>" name="<?php echo esc_attr($this->get_field_name('wid_class')); ?>" type="text" value="<?php echo esc_attr($wid_class); ?>" />
		    </label>
		</p>
 <p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
	 <?php esc_html_e('Title:','mosque_crunchpress');?>  
	  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
 <label for="<?php echo esc_attr($this->get_field_id('recent_post_category')); ?>">
	  <?php esc_html_e('Select Category:','mosque_crunchpress');?>
	  <select id="<?php echo esc_attr($this->get_field_id('recent_post_category')); ?>" name="<?php echo esc_attr($this->get_field_name('recent_post_category')); ?>" class="widefat">
		<?php
		
				foreach ( get_category_list_array('services-category') as $category){ ?>
                    <option <?php if(esc_attr($recent_post_category) == $category->slug){echo 'selected';}?> value="<?php echo esc_attr($category->slug);?>" >
	                    <?php echo substr(esc_attr($category->name), 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('number_of_services')); ?>">
	  <?php esc_html_e('Number of Services','mosque_crunchpress');?>
	<input class="widefat" size="5" id="<?php echo esc_attr($this->get_field_id('number_of_services')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_services')); ?>" type="text" value="<?php echo esc_attr($number_of_services); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
	$instance['wid_class'] = $new_instance['wid_class'];
    $instance['title'] = $new_instance['title'];
	$instance['number_of_services'] = $new_instance['number_of_services'];	
    $instance['recent_post_category'] = $new_instance['recent_post_category'];	
	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$wid_class = empty($instance['wid_class']) ? ' ' : apply_filters('widget_title', $instance['wid_class']);
		$recent_post_category = isset( $instance['recent_post_category'] ) ? esc_attr( $instance['recent_post_category'] ) : '';		
		$number_of_services = isset( $instance['number_of_services'] ) ? esc_attr( $instance['number_of_services'] ) : '';				
		
		echo html_entity_decode($before_widget);
		// WIDGET display CODE Start
		if (!empty($title))
			echo html_entity_decode($before_title);
			echo esc_attr($title);
			echo html_entity_decode($after_title);
			global $wpdb, $post;

			$category_array = get_term_by('slug', $recent_post_category, 'category');
				global $post, $wp_query;
				$class_odd = '';
					$args = array(
						'posts_per_page'			=> $number_of_services,
						'post_type'					=> 'services',
						'category'					=> $recent_post_category,
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
						);
					query_posts($args);
					
					if ( have_posts() <> "" ) {?>
					<div class="services-list">
						<ul class="slist">
						<?php	
							while ( have_posts() ): the_post();?>
								<li class="list_service">
									<?php echo get_the_post_thumbnail($post->ID, array(80,80));?>
									<div class="spost">
										<strong>
											<a href="<?php echo esc_url(get_permalink());?>">
												<?php  $title = get_the_title();
													if (strlen($title) < 25){ 
														echo esc_attr(get_the_title());
													}
													else {
													echo substr(esc_attr(get_the_title()),0,25);
													echo '...';
												}?>
											</a>
										</strong>
										<p><?php echo strip_tags(mb_substr(esc_attr(get_the_content()),0,40)); echo '...'; ?></p>
									</div>
								</li>
								<?php 
							endwhile;?>
						</ul>
					</div>
							<?php
					}
	wp_reset_query();
	wp_reset_postdata();
	echo html_entity_decode($after_widget);
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("cp_services_widget");') );?>