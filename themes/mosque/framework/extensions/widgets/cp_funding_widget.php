<?php
class cp_crowd_funding extends WP_Widget
{
  function cp_crowd_funding()
  {
    $widget_ops = array('classname' => 'widget-holder', 'description' => 'Blog/News Post Widget' );
    parent::__construct('cp_crowd_funding', 'CrunchPress : Crowd Funding Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$wid_class = isset( $instance['wid_class'] ) ? esc_attr( $instance['wid_class'] ) : '';
    $title = $instance['title'];
	$recent_post_category = isset( $instance['recent_post_category'] ) ? esc_attr( $instance['recent_post_category'] ) : '';
	$number_of_news = isset( $instance['number_of_news'] ) ? esc_attr( $instance['number_of_news'] ) : '';
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
		
				foreach ( get_category_list_array('project_category') as $category){ ?>
                    <option <?php if(esc_attr($recent_post_category) == $category->slug){echo 'selected';}?> value="<?php echo esc_attr($category->slug);?>" >
	                    <?php echo substr(esc_attr($category->name), 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('number_of_news')); ?>">
	  <?php esc_html_e('Number of News','mosque_crunchpress');?>
	<input class="widefat" size="5" id="<?php echo esc_attr($this->get_field_id('number_of_news')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_news')); ?>" type="text" value="<?php echo esc_attr($number_of_news); ?>" />
  </label>
  </p>
<?php
  }
 
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['wid_class'] = $new_instance['wid_class'];
		$instance['title'] = $new_instance['title'];
		$instance['recent_post_category'] = $new_instance['recent_post_category'];	
		$instance['number_of_news'] = $new_instance['number_of_news'];	
		
		return $instance;
	}
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$wid_class = empty($instance['wid_class']) ? ' ' : apply_filters('widget_title', $instance['wid_class']);
		$recent_post_category = isset( $instance['recent_post_category'] ) ? esc_attr( $instance['recent_post_category'] ) : '';		
		$number_of_news = isset( $instance['number_of_news'] ) ? esc_attr( $instance['number_of_news'] ) : '';				
		echo html_entity_decode($before_widget);	
		// WIDGET display CODE Start
		if (!empty($title))
			echo html_entity_decode($before_title);
			echo esc_attr($title);
			echo html_entity_decode($after_title);
			global $wpdb, $post;
			//print_r($post_slider_slug);
			
				query_posts(array(
					'posts_per_page'=> $number_of_news,
					'post_type'   => 'ignition_product',
					'post_status'   => 'publish',
					'order'			=> 'DESC',
				));
				$counter_ignition = 0; ?>
					<div class="sidebar-recent-post">
						<ul>
						<?php
						$counter_news = 0;		
						while( have_posts() ){
						the_post();	
						global $counter,$post;
						$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
						$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
						$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);
						$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
						$ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);
						$thumbnail_id = get_post_thumbnail_id( $post->ID, 'ign_project_id', true );
						$getPledge_cp = getPledge_cp($ign_project_id);
						$current_date = date('d-m-Y h:i:s');
						$project_date = new DateTime($ignition_datee);
						$current = new DateTime($current_date);
						$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(80, 80) ); ?>
						<li>
							<div class="frame"><a href="<?php echo esc_url(get_permalink());?>"><img src="<?php echo esc_url($thumbnail[0]);?>" alt="img"></a></div>
							<div class="text-box"> 
								<a class="title" href="<?php echo esc_url(get_permalink());?>">							
									<?php									
										if(strlen(get_the_title()) < 22 ){	
											echo get_the_title();									
										}else{ 	
											echo substr(get_the_title(), 0 , 22) . '...';
										}										
									?>							
								</a>
								<div class="progress">								  
									<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow=" <?php echo getPercentRaised_cp($ign_project_id);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo getPercentRaised_cp($ign_project_id);?>%">				<span class="sr-only"> <?php echo getPercentRaised_cp($ign_project_id);?>% </span>								 
									</div>								
								</div>					 							
							</div>
						</li>
						<?php 
						} wp_reset_query(); ?>
						</ul>
					</div>
			<?php
	
	wp_reset_postdata();
	echo html_entity_decode($after_widget);
	}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("cp_crowd_funding");') );?>