<?php
class cp_recent_event_widget extends WP_Widget
{
  function cp_recent_event_widget()
  {
    $widget_ops = array('classname' => 'recent_event', 'description' => 'Show Recent Events in this widget' );
    parent::__construct('cp_recent_event_widget', 'CrunchPress : Event Listing Widget', $widget_ops);
  }
 
  function form($instance)
  {

    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
    $recent_event_category = empty($instance['recent_event_category']) ? ' ' : apply_filters('widget_title', $instance['recent_event_category']);
	$number_of_events = empty($instance['number_of_events']) ? ' ' : apply_filters('widget_title', $instance['number_of_events']);
?>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
	 <?php esc_html_e('Title:','mosque_crunchpress');?>  
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('recent_event_category')); ?>">
	  <?php esc_html_e('Select Category:','mosque_crunchpress');?>
	  <select class="widefat" id="<?php echo esc_attr($this->get_field_id('recent_event_category')); ?>" name="<?php echo esc_attr($this->get_field_name('recent_event_category')); ?>" style="width:225px">
		<?php
		
				foreach ( get_category_list_array('event-categories') as $category){ ?>
                    <option <?php if(esc_attr($recent_event_category) == $category->term_id){echo 'selected';}?> value="<?php echo esc_attr($category->term_id);?>" >
	                    <?php echo substr(esc_attr($category->name), 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('number_of_events')); ?>">
	  <?php esc_html_e('Number of events','mosque_crunchpress');?>
	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('number_of_events')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_events')); ?>" type="text" value="<?php echo esc_attr($number_of_events); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['recent_event_category'] = $new_instance['recent_event_category'];
		$instance['number_of_events'] = $new_instance['number_of_events'];
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$recent_event_category = isset( $instance['recent_event_category'] ) ? esc_attr( $instance['recent_event_category'] ) : '';		
		$number_of_events = isset( $instance['number_of_events'] ) ? esc_attr( $instance['number_of_events'] ) : '';		
		if(!isset($number_of_events)){$number_of_events = '-1';}
		echo html_entity_decode($before_widget);	
		// WIDGET display CODE Start
		if (!empty($title))
			echo html_entity_decode($before_title);
			echo esc_attr($title);
			echo html_entity_decode($after_title);
			wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/shortcodes/js/jquery_countdown.js', false, '1.0', true);
			wp_enqueue_script('cp-countdown');
			?>
	<!-- Links Start -->          
		<div class="event-countdown-list">
			<ul>
                <?php
				global $EM_Events,$bp;
				//Get the Set Array of Events those
				$EM_Events = EM_Events::get( array('category'=>$recent_event_category, 'group'=>'this','scope'=>'future', 'limit' => $number_of_events, 'order' => 'DESC') );
				if($EM_Events <> ''){ 
				$counter_new = 0;
				foreach ( $EM_Events as $event ) {
				$post_id = $event->post_id;
				$counter_new++;
				$location_address = $event->get_location()->location_address;
				$location_name =  $event->get_location()->location_name; ?>
				<li>
                    <div class="text-box"> <a href="<?php echo esc_url($event->guid);?>" class="title"><?php echo substr(esc_attr($event->event_name),0,35);?></a>
                      <div class="frame-2"><a href="<?php echo esc_url($event->guid);?>"><?php echo get_the_post_thumbnail($event->post_id, array(1140,575));?></a>
                      <div class="caption">
                          <?php
								//Get Date in Parts
								$event_year = date('Y',$event->start);
								$event_month = date('m',$event->start);
								$event_month_alpha = date('M',$event->start);
								$event_day = date('d',$event->start);

								//Change time format
								$event_start_time_count = date("G,i,s", strtotime($event->start_time));
							?>
						  <script>
							jQuery(function () {
								var austDay = new Date();
								austDay = new Date(<?php echo esc_js($event_year);?>, <?php echo esc_js($event_month);?>-1, <?php echo esc_js($event_day);?>,<?php echo esc_js($event_start_time_count);?>)
								jQuery('#count_<?php echo esc_js($event->post_id); ?>').countdown({
									labels: ['<?php esc_html_e('YRS','mosque_crunchpress');?>', '<?php esc_html_e('MNTH','mosque_crunchpress');?>', '<?php esc_html_e('Weeks','mosque_crunchpress');?>', '<?php esc_html_e('Days','mosque_crunchpress');?>', '<?php esc_html_e('HRS','mosque_crunchpress');?>', '<?php esc_html_e('MIN','mosque_crunchpress');?>', '<?php esc_html_e('SEC','mosque_crunchpress');?>'],
									until: austDay
								});
								jQuery('#year').text(austDay.getFullYear());
							});                
						</script>
						<div class="defaultCountdown" id="count_<?php echo esc_attr($event->post_id); ?>"></div>
                        </div>
                      </div>
                      <a href="<?php echo esc_url($event->guid);?>"><i class="fa fa-clock-o"></i><?php echo date("g:i a", strtotime($event->start_time)); ?> <?php esc_html_e('to','mosque_crunchpress')?> <?php echo date("g:i a", strtotime($event->end_time)); ?></a> <a href="<?php echo esc_url($event->guid);?>"><i class="fa fa-calendar"></i><?php echo date('l, d F, Y',strtotime($event->start_date));?></a>
					  <?php if($location_address <> ''){ ?><a href="<?php echo esc_url($event->guid);?>"><i class="fa fa-map-marker"></i><?php echo ucfirst($location_address);?></a><?php }?>
					</div>
                </li>
			<?php }?>
			</ul>
		</div>
		<?php }else{ ?>
			<h4><?php esc_html_e('There is no Recent Post to Show','mosque_crunchpress');?></h4>
		 <?php
		}
		 
	wp_reset_query();
	echo html_entity_decode($after_widget);
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("cp_recent_event_widget");') );?>