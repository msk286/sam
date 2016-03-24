<?php
class album_feat_album_show extends WP_Widget
{
  function album_feat_album_show()
  {
    $widget_ops = array('classname' => 'widget-holder', 'description' => 'Feature Music Videos in this widget.' );
    $this->WP_Widget('album_feat_album_show', 'CrunchPress : Music Videos Released', $widget_ops);
  }
 
  function form($instance)
  {
	wp_reset_query();
	wp_reset_postdata();
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$wid_class = isset( $instance['wid_class'] ) ? esc_attr( $instance['wid_class'] ) : '';
    $title = $instance['title'];
	$album_select_feature = isset( $instance['album_select_feature'] ) ? esc_attr( $instance['album_select_feature'] ) : '';
	$album_select = isset( $instance['album_select'] ) ? esc_attr( $instance['album_select'] ) : '';
	$number_of_tracks = isset( $instance['number_of_tracks'] ) ? esc_attr( $instance['number_of_tracks'] ) : '';
?>
 <p>
  <label for="<?php echo $this->get_field_id('wid_class'); ?>">
	  <?php _e('Class:','mosque_crunchpress');?> 
	  <input class="widefat"  id="<?php echo $this->get_field_id('wid_class'); ?>" name="<?php echo $this->get_field_name('wid_class'); ?>" type="text" value="<?php echo esc_attr($wid_class); ?>" />
  </label>
  </p>
 <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	  <?php _e('Title:','mosque_crunchpress');?> 
	  <input class="widefat"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
   <p>
  <label for="<?php echo $this->get_field_id('album_select_feature'); ?>">
	  <?php _e('Select Feature Sermon:','mosque_crunchpress');?>
	  <select class="widefat" id="<?php echo $this->get_field_id('album_select_feature'); ?>" name="<?php echo $this->get_field_name('album_select_feature'); ?>" >
		<?php
				foreach ( get_title_list_array('albums') as $category){ ?>
                    <option <?php if(esc_attr($album_select) == $category->ID){echo 'selected';}?> value="<?php echo $category->ID;?>" >
	                    <?php echo substr($category->post_title, 0, 20);	if ( strlen($category->post_title) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo $this->get_field_id('album_select'); ?>">
	  <?php _e('Select Category:','mosque_crunchpress');?>
	  <select class="widefat" id="<?php echo $this->get_field_id('album_select'); ?>" name="<?php echo $this->get_field_name('album_select'); ?>" >
		<?php
				foreach ( get_category_list_array('album-category') as $category){ ?>
                    <option <?php if(esc_attr($album_select) == $category->term_id){echo 'selected';}?> value="<?php echo $category->term_id;?>" >
	                    <?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
                    </option>						
			<?php }?>
      </select>
  </label>
  </p>  
  
  <p>
  <label for="<?php echo $this->get_field_id('number_of_tracks'); ?>">
	  <?php _e('Number of Sermons','mosque_crunchpress');?>
	<input class="widefat" size="5" id="<?php echo $this->get_field_id('number_of_tracks'); ?>" name="<?php echo $this->get_field_name('number_of_tracks'); ?>" type="text" value="<?php echo esc_attr($number_of_tracks); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
	$instance['wid_class'] = $new_instance['wid_class'];
    $instance['title'] = $new_instance['title'];
	$instance['album_select_feature'] = $new_instance['album_select_feature'];	
    $instance['album_select'] = $new_instance['album_select'];	
	$instance['number_of_tracks'] = $new_instance['number_of_tracks'];	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$wid_class = empty($instance['wid_class']) ? ' ' : apply_filters('widget_title', $instance['wid_class']);
		$album_select_feature = isset( $instance['album_select_feature'] ) ? esc_attr( $instance['album_select_feature'] ) : '';		
		$album_select = isset( $instance['album_select'] ) ? esc_attr( $instance['album_select'] ) : '';		
		$number_of_tracks = isset( $instance['number_of_tracks'] ) ? esc_attr( $instance['number_of_tracks'] ) : '';				
		echo $before_widget;	
		// WIDGET display CODE Start
		wp_reset_query();
		//Empty Check for Album Category
		$category_term = '';
		if(!empty($album_select)){
			$category_term = get_term_by( 'id', $album_select , 'album-category');
			if(!empty($category_term)){
				$album_select = $category_term->slug;
			}else{
				$album_select = '';
			}
		}
		//start leftside
		echo '<div class="left-box">';
			if($album_select_feature <> '786512'){ 
					$album_id = $album_select_feature;
					//Fetch All Tracks
					$track_name_xml = get_post_meta($album_id, 'track_name_xml', true);
					$track_url_xml = get_post_meta($album_id, 'track_url_xml', true);
					$track_des_xml = get_post_meta($album_id, 'track_des_xml', true);
					$track_down_xml = get_post_meta($album_id, 'track_down_xml', true);
					$cp_album_class = new cp_album_class;
					//Get elements by documentElement
					$track_name_array = $cp_album_class->get_album_all_tracks($track_name_xml);
					$track_url_array = $cp_album_class->get_album_all_tracks($track_url_xml);
					$track_lyrics_array = $cp_album_class->get_album_all_tracks($track_des_xml);
					$track_download_array = $cp_album_class->get_album_all_tracks($track_down_xml);?>
				<div class="video-box"><?php echo get_the_post_thumbnail($album_select_feature, array(1170,350));?>
					<ul>
						<li><a href="<?php echo get_permalink($album_select_feature);?>"><strong class="tite"><?php echo get_the_title($album_select_feature);?></strong> <strong class="time"><?php echo get_the_date(get_option('date_format'));?></strong></a></li>
						<li class="headphone-icon"><span class="font-aw"><i class="icon-music"></i></span><?php echo $track_name_array->length;?> <?php _e('Songs','mosque_crunchpress');?></li>
					</ul>
				</div>
			  <?php
			//Arguments for loop
				query_posts(array(
					'posts_per_page'			=> $number_of_tracks,
					'album-category'			=> $album_select,
					'post_type'					=> 'albums',
					'post_status'				=> 'publish',
					'order'						=> 'DESC',
					'post__not_in' => array($album_select_feature)
				));
			}else{
				query_posts(array(
					'posts_per_page'			=> $number_of_tracks,
					'album-category'			=> $album_select,
					'post_type'					=> 'albums',
					'post_status'				=> 'publish',
					'order'						=> 'DESC',
				));
			}
			
			 echo '<ul class="play-list">';
			 $counter_one = 0;
				while( have_posts() ){
					the_post();
					global $post;
					$album_id = $post->ID;
					//Fetch All Tracks
					$track_name_xml = get_post_meta($album_id, 'track_name_xml', true);
					$track_url_xml = get_post_meta($album_id, 'track_url_xml', true);
					$track_des_xml = get_post_meta($album_id, 'track_des_xml', true);
					$track_down_xml = get_post_meta($album_id, 'track_down_xml', true);
					
					//Get elements by documentElement
					$cp_album_class = new cp_album_class;
					//Get elements by documentElement
					$track_name_array = $cp_album_class->get_album_all_tracks($track_name_xml);
					$track_url_array = $cp_album_class->get_album_all_tracks($track_url_xml);
					$track_lyrics_array = $cp_album_class->get_album_all_tracks($track_des_xml);
					$track_download_array = $cp_album_class->get_album_all_tracks($track_down_xml);
					if($counter_one % 2 == 0){
					?>
					<li class="even">
						<div class="frame"><a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail($post->ID, array(60,60));?></a></div>
						<div class="text-box-1">
						  <ul>
							<li>
								<a href="<?php echo get_permalink();?>">
									<h4 class="tite"><?php echo get_the_title();?></h4>
									
								</a>
							</li>
							<li class="headphone-icon"><span class="font-aw"><i class="icon-calendar-empty"></i></span><strong class="time"><?php echo __('Release Date','mosque_crunchpress');?>   -  <?php echo get_the_date(get_option('date_format'));?></strong></li>
							<li class="headphone-icon"><strong class="time"><span class="font-aw"><i class="icon-music"></i></span><?php echo $track_name_array->length;?> <?php _e('Songs','mosque_crunchpress');?></strong>
							</li>
						  </ul>
						</div>
					</li>
					<?php }else{ ?>
					<li class="odd">
						<div class="frame"><a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail($post->ID, array(60,60));?></a></div>
						<div class="text-box-1">
						  <ul>
							<li>
								<a href="<?php echo get_permalink();?>">
									<h4 class="tite"><?php echo get_the_title();?></h4>
									
								</a>
							</li>
							<li class="headphone-icon"><span class="font-aw"><i class="icon-calendar-empty"></i></span><strong class="time"><?php echo __('Release Date','mosque_crunchpress');?>   -  <?php echo get_the_date(get_option('date_format'));?></strong></li>
							<li class="headphone-icon"><strong class="time"><span class="font-aw"><i class="icon-music"></i></span><?php echo $track_name_array->length;?> <?php _e('Songs','mosque_crunchpress');?></strong>
							</li>
						  </ul>
						</div>
					</li>
					<?php } $counter_one++;?>
				<?php } ?>
			</ul>
        </div>
		  <?php 
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("album_feat_album_show");') );?>