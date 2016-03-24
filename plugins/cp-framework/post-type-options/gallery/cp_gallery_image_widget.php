<?php
class gallery_image_show extends WP_Widget
{
  function gallery_image_show()
  {
    $widget_ops = array('classname' => 'photo-gallery', 'description' => 'Show Gallery Images' );
    parent::__construct('gallery_image_show', 'CrunchPress : Gallery Widget', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	$wid_class = isset( $instance['wid_class'] ) ? esc_attr( $instance['wid_class'] ) : '';		
	$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';		
	$select_gallery = isset( $instance['select_gallery'] ) ? esc_attr( $instance['select_gallery'] ) : '';		
	$nofimages = isset( $instance['nofimages'] ) ? esc_attr( $instance['nofimages'] ) : '';	
	$externallink = isset( $instance['externallink'] ) ? esc_attr( $instance['externallink'] ) : '';	
	
?>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('wid_class')); ?>">
	 <?php esc_html_e('Class:','mosque_crunchpress');?>  
	  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('wid_class')); ?>" name="<?php echo esc_attr($this->get_field_name('wid_class')); ?>" type="text" value="<?php echo esc_attr($wid_class); ?>" />
  </label>
  </p>
  <div class="clear"></div>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
	  <?php esc_html_e('Title:','mosque_crunchpress');?> 
	  <input class="widefat"  id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p>
  <div class="clear"></div>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('select_gallery')); ?>">
	  <?php esc_html_e('Select Gallery:','mosque_crunchpress');?>
	  <select id="<?php echo esc_attr($this->get_field_id('select_gallery')); ?>" name="<?php echo esc_attr($this->get_field_name('select_gallery')); ?>" class="widefat">
		<?php
        global $wpdb,$post;
		$gallery_name = get_title_list_array('gallery');
		foreach ( $gallery_name as $gallery_title){ ?>
                    <option <?php if($select_gallery == $gallery_title->ID){echo 'selected';}?> value="<?php echo esc_attr($gallery_title->ID);?>" >
	                    <?php echo substr(esc_attr($gallery_title->post_title), 0, 20);	if ( strlen($gallery_title->post_title) > 20 ) echo "...";?>
                    </option>						
			<?php }
			?>
      </select>
  </label>
  </p>     
  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('nofimages')); ?>">
	 <?php esc_html_e('Number of Images to Show:','mosque_crunchpress');?> 
	  <input class="widefat" size="5" id="<?php echo esc_attr($this->get_field_id('nofimages')); ?>" name="<?php echo esc_attr($this->get_field_name('nofimages')); ?>" type="text" value="<?php echo esc_attr($nofimages); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
		$instance['wid_class'] = $new_instance['wid_class'];
		$instance['title'] = $new_instance['title'];
		$instance['select_gallery'] = $new_instance['select_gallery'];
		$instance['nofimages'] = $new_instance['nofimages'];
		$instance['externallink'] = $new_instance['externallink'];
		
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$wid_class = isset( $instance['wid_class'] ) ? esc_attr( $instance['wid_class'] ) : '';
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$select_gallery = isset( $instance['select_gallery'] ) ? esc_attr( $instance['select_gallery'] ) : '';
		$nofimages = isset( $instance['nofimages'] ) ? esc_attr( $instance['nofimages'] ) : '';	
		$externallink = isset( $instance['externallink'] ) ? esc_attr( $instance['externallink'] ) : '';	
		
		echo html_entity_decode($before_widget);	
		
		// WIDGET display CODE Start
		if (!empty($title))
			echo html_entity_decode($before_title);
			echo esc_attr($title);
			echo html_entity_decode($after_title);

			$slider_xml_string = get_post_meta($select_gallery,'post-option-gallery-xml', true);
			$slider_xml_dom = new DOMDocument();
			if( !empty( $slider_xml_string ) ){
			$slider_xml_dom->loadXML($slider_xml_string);	
			?>
			
                <div class="flicker">
                  <ul>
						<?php
						$children = $slider_xml_dom->documentElement->childNodes;
						$counter_gallery = 0;
						$counter_limit = 0;
						if($nofimages > $slider_xml_dom->documentElement->childNodes->length){$nofimages = $slider_xml_dom->documentElement->childNodes->length;}
						for($i=0;$i<$nofimages;$i++) { 
						$counter_limit++;
							$link_type = cp_find_xml_value($children->item($i), 'linktype');
							$title = cp_find_xml_value($children->item($i), 'title');
							$thumbnail_id = cp_find_xml_value($children->item($i), 'image');				
							$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);						
							$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(80,80));
							echo '<li><div class="gal-image-cp"><a data-gal="prettyPhoto[]" href="' . $image_full[0] . '"  title=""><img src="' . $image_thumb[0] . '" alt="' . $alt_text . '" /></a></div></li>';
						}?>				
					</ul>
                </div>
              

			<?php
		}	
		
	
	
	echo html_entity_decode($after_widget);
	}
		
}
add_action( 'widgets_init', create_function('', 'return register_widget("gallery_image_show");') );?>