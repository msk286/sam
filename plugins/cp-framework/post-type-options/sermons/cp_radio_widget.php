<?php
class album_playlist_show extends WP_Widget
{
  function album_playlist_show()
  {
    $widget_ops = array('classname' => 'widget-holder-show', 'description' => 'Tune your Music Channel Playlist here.' );
    $this->WP_Widget('album_playlist_show', 'CrunchPress : Music Shows Playlist', $widget_ops);
  }
 
  function form($instance)
  {
	wp_reset_query();
	wp_reset_postdata();
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$wid_class = isset( $instance['wid_class'] ) ? esc_attr( $instance['wid_class'] ) : '';
    $title = $instance['title'];
	$album_select = isset( $instance['album_select'] ) ? esc_attr( $instance['album_select'] ) : '';
	$number_of_tracks = isset( $instance['number_of_tracks'] ) ? esc_attr( $instance['number_of_tracks'] ) : '';
	$cp_track_des = isset( $instance['cp_track_des'] ) ? esc_attr( $instance['cp_track_des'] ) : '';
	
?>
 <p>
  <label for="<?php echo $this->get_field_id('wid_class'); ?>">
	 <?php _e('Class:','mosque_crunchpress');?>  
	  <input class="widefat"  id="<?php echo $this->get_field_id('wid_class'); ?>" name="<?php echo $this->get_field_name('wid_class'); ?>" type="text" value="<?php echo esc_attr($wid_class); ?>" />
  </label>
  </p>
 <p>
  <label for="<?php echo $this->get_field_id('title'); ?>">
	 <?php _e('Title: ','mosque_crunchpress');?> 
	  <input class="widefat"  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('album_select'); ?>">
	 <?php _e('Select Sermon:','mosque_crunchpress');?> 
	  <select class="widefat" id="<?php echo $this->get_field_id('album_select'); ?>" name="<?php echo $this->get_field_name('album_select'); ?>" >
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
  <label for="<?php echo $this->get_field_id('number_of_tracks'); ?>">
	 <?php _e(' Number of Tracks','mosque_crunchpress');?>
	<input class="widefat" size="5" id="<?php echo $this->get_field_id('number_of_tracks'); ?>" name="<?php echo $this->get_field_name('number_of_tracks'); ?>" type="text" value="<?php echo esc_attr($number_of_tracks); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo $this->get_field_id('cp_track_des'); ?>">
	 <?php _e('Description:','mosque_crunchpress');?>
	  <textarea rows="2"  cols="35" class="widefat" id="<?php echo $this->get_field_id('cp_track_des'); ?>" name="<?php echo $this->get_field_name('cp_track_des'); ?>"><?php echo esc_attr($cp_track_des); ?></textarea>
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
	$instance['wid_class'] = $new_instance['wid_class'];
    $instance['title'] = $new_instance['title'];
    $instance['album_select'] = $new_instance['album_select'];	
	$instance['number_of_tracks'] = $new_instance['number_of_tracks'];	
	$instance['cp_track_des'] = $new_instance['cp_track_des'];	
	
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$wid_class = empty($instance['wid_class']) ? ' ' : apply_filters('widget_title', $instance['wid_class']);
		$album_select = isset( $instance['album_select'] ) ? esc_attr( $instance['album_select'] ) : '';		
		$number_of_tracks = isset( $instance['number_of_tracks'] ) ? esc_attr( $instance['number_of_tracks'] ) : '';		
		$cp_track_des = isset( $instance['cp_track_des'] ) ? esc_attr( $instance['cp_track_des'] ) : '';		
		
		echo $before_widget;	
		// WIDGET display CODE Start
		if (!empty($title))
			//echo $before_title;
			//echo '<div class="heading-bar"><a href="#"><i class="icon-reply pull-left"></i></a><strong class="h-title">';
				//echo $title;	
			//echo '</strong></div>';
			//echo $after_title;
			global $wpdb, $post;
			wp_reset_query();

		//JPlayer Scripts
		wp_register_script('cp-jplayer', CP_PATH_URL.'/frontend/js/jquery.jplayer.min.js', false, '1.0', true);
		wp_enqueue_script('cp-jplayer');
		
		wp_register_script('cp-jplayer-playlist', CP_PATH_URL.'/frontend/js/jplayer.playlist.min.js', false, '1.0', true);
		wp_enqueue_script('cp-jplayer-playlist'); 
		$cp_album_class = new cp_album_class; ?>
		<div class="jp_cp_default">
			<?php
				//Fetching All Tracks from Database
				$track_name_xml = get_post_meta($album_select, 'track_name_xml', true);
				$track_url_xml = get_post_meta($album_select, 'track_url_xml', true);
				$track_des_xml = get_post_meta($album_select, 'track_des_xml', true);
				$track_down_xml = get_post_meta($album_select, 'track_down_xml', true);
				
				//Empty Variables
				//$album_download = '';
				$children = '';
				$children_title = '';

				//Track Name
				if($track_name_xml <> ''){
					$ingre_xml = new DOMDocument();
					$ingre_xml->recover = TRUE;
					$ingre_xml->loadXML($track_name_xml);
					$children_name = $ingre_xml->documentElement->childNodes;
				}		
				
				//Track URL
				if($track_url_xml <> ''){	
					$ingre_title_xml = new DOMDocument();
					$ingre_title_xml->recover = TRUE;
					$ingre_title_xml->loadXML($track_url_xml);
					$children_title = $ingre_title_xml->documentElement->childNodes;
				}
				
				//Track Description
				if($track_des_xml <> ''){	
					$ingre_des_xml = new DOMDocument();
					$ingre_des_xml->recover = TRUE;
					$ingre_des_xml->loadXML($track_des_xml);
					$children_des = $ingre_des_xml->documentElement->childNodes;
					
				}
				
				//Track Download Fetch
				if($track_down_xml <> ''){	
					$ingre_down_xml = new DOMDocument();
					$ingre_down_xml->recover = TRUE;
					$ingre_down_xml->loadXML($track_down_xml);
					$children_down = $ingre_down_xml->documentElement->childNodes;
					
				}
					?>
		<script>
			jQuery(document).ready(function($) {
				new jPlayerPlaylist({
					jPlayer: "#jquery_jplayer_<?php echo 'radio_'.$album_select;?>",
					cssSelectorAncestor: "#jp_container_<?php echo 'radio_'.$album_select;?>"
				}, [                       
					<?php 
					//Combine Loop
					
						if($track_name_xml <> '' || $track_url_xml <> ''){
							$counter_aa = 0;
							$nofields = $ingre_xml->documentElement->childNodes->length;
							if($number_of_tracks > $nofields){$number_of_tracks =  $nofields;}
							for($i=0;$i<$number_of_tracks;$i++) {
								echo '{';
								$img_url_aa = 'http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png';
								echo 'title:"'.$children_name->item($i)->nodeValue.'",';
								echo 'artist:"'.$children_name->item($i)->nodeValue.'",';
								echo 'mp3:"'.$children_title->item($i)->nodeValue.'",';
								echo 'poster:"'.$img_url_aa.'"';
								echo '},';
							}
						}
					?>
				], {
					playlistOptions: {
						enableRemoveControls: true,
						autoPlay: true
					},
					swfPath: "<?php echo CP_PATH_URL?>/frontend/js/Jplayer.swf",
					supplied: "mp3",
					wmode: "window"
				});
			});                                                     
		</script>
			<div class="play-box">
				<div class="frame"><?php echo get_the_post_thumbnail($album_select, array(60,60));;?></div>
				<div class="text">
					<strong class="title"><?php echo get_the_title($album_select);?></strong>
					<strong class="name"><span><?php _e('By','mosque_crunchpress');?></span> <?php the_author();?></strong>					
					<div class="btn-row">
						<?php $cp_album_class = new cp_album_class;	echo $cp_album_class->getPostLikeLink($album_select);?>
						<div class="btns-row">
							<a href="<?php echo get_permalink($album_select);?>" class="btn-download"><?php _e('Download','mosque_crunchpress');?><i class="icon-plus-sign"></i></a>						
							<a id="playlist-active" class="btn-playlist"><?php _e('Playlist','mosque_crunchpress');?><i class="icon-plus-sign"></i></a>
						</div>
					</div>
				</div>
				
			</div>
			<div id="jquery_jplayer_<?php echo 'radio_'.$album_select;?>" class="jp-jplayer"></div>
            <div id="jp_container_<?php echo 'radio_'.$album_select;?>" class="jp-audio">
              <div class="jp-type-playlist">
                <div class="jp-gui jp-interface">
                  <ul class="jp-controls">
                    <li><a href="javascript:;" class="jp-previous" tabindex="1"><?php _e('previous','mosque_crunchpress');?></a></li>
                    <li><a href="javascript:;" class="jp-play" tabindex="1"><?php _e('play','mosque_crunchpress');?></a></li>
                    <li><a href="javascript:;" class="jp-pause" tabindex="1"><?php _e('pause','mosque_crunchpress');?></a></li>
                    <li><a href="javascript:;" class="jp-next" tabindex="1"><?php _e('next','mosque_crunchpress');?></a></li>
                    <li><a href="javascript:;" class="jp-stop" tabindex="1"><?php _e('stop','mosque_crunchpress');?></a></li>
                    <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute"><?php _e('mute','mosque_crunchpress');?></a></li>
                    <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"><?php _e('unmute','mosque_crunchpress');?></a></li>
                    <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume"><?php _e('max volume','mosque_crunchpress');?></a></li>
                  </ul>
                  <div class="jp-progress">
                    <div class="jp-seek-bar">
                      <div class="jp-play-bar"></div>
                    </div>
                  </div>
                  <div class="jp-volume-bar">
                    <div class="jp-volume-bar-value"></div>
                  </div>
                  <div class="jp-current-time"></div>
                  <div class="jp-duration"></div>
                </div>
                <div class="jp-playlist">
                  <ul>
                    <li></li>
                  </ul>
                </div>
              </div>
            </div>
			<!--Render Bottom HTML Start-->
			<?php if($cp_track_des <> ''){ echo html_entity_decode($cp_track_des);}?>
			<!--Render Bottom HTML End-->
		</div>
	<?php
	
	wp_reset_query();
	wp_reset_postdata();
	echo $after_widget;
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("album_playlist_show");') );?>