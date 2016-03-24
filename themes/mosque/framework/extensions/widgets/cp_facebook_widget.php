<?php
class cp_facebook_widget extends WP_Widget
{
  function cp_facebook_widget()
  {
    $widget_ops = array('classname' => 'facebook_class', 'description' => 'Facebook Like Box Customize Look and Feel According to theme.' );
    parent::__construct('cp_facebook_widget', 'CrunchPress : Facebook', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$pageurl = isset( $instance['pageurl'] ) ? esc_attr( $instance['pageurl'] ) : '';
	$showfaces = isset( $instance['showfaces'] ) ? esc_attr( $instance['showfaces'] ) : '';
	$showstream = isset( $instance['showstream'] ) ? esc_attr( $instance['showstream'] ) : '';
	//$showheader = isset( $instance['showheader'] ) ? esc_attr( $instance['showheader'] ) : '';
	$likebox_width = isset( $instance['likebox_width'] ) ? esc_attr( $instance['likebox_width'] ) : '';						
	$likebox_height = isset( $instance['likebox_height'] ) ? esc_attr( $instance['likebox_height'] ) : '';						
?>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
	  <?php esc_html_e('Title:','mosque_crunchpress');?> 
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" size='40' name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </label>
  </p> 
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('pageurl')); ?>">
	  <?php esc_html_e('Page URL:','mosque_crunchpress');?> 
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('pageurl')); ?>" size='40' name="<?php echo esc_attr($this->get_field_name('pageurl')); ?>" type="text" value="<?php echo esc_attr($pageurl); ?>" />
	<br />
      <small><?php esc_html_e('Please enter your page url example: http://www.facebook.com/profilename OR','mosque_crunchpress');?> <br />
     <?php esc_html_e('https://www.facebook.com/pages/wxyz/123456789101112','mosque_crunchpress');?> 
	</small><br />
  </label>
  </p> 
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('showfaces')); ?>">
	 <?php esc_html_e('Show Faces:','mosque_crunchpress');?> 
	  <select id="<?php echo esc_attr($this->get_field_id('showfaces')); ?>" name="<?php echo esc_attr($this->get_field_name('showfaces')); ?>" class="widefat">
			<option <?php if($showfaces == 'true'){echo 'selected';}?> value="true"><?php esc_html_e('Yes','mosque_crunchpress');?></option>
			<option <?php if($showfaces == 'false'){echo 'selected';}?> value="false"><?php esc_html_e('No','mosque_crunchpress');?></option>
      </select>
  </label>
  </p>  
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('showstream')); ?>">
	  <?php esc_html_e('Show Stream:','mosque_crunchpress');?> 
	   <select id="<?php echo esc_attr($this->get_field_id('showstream')); ?>" name="<?php echo esc_attr($this->get_field_name('showstream')); ?>" class="widefat">
			<option <?php if($showstream == 'true'){echo 'selected';}?> value="true"><?php esc_html_e('Yes','mosque_crunchpress');?></option>
			<option <?php if($showstream == 'false'){echo 'selected';}?> value="false"><?php esc_html_e('No','mosque_crunchpress');?></option>
      </select>
  </label>
  </p> 
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('likebox_width')); ?>">
	  <?php esc_html_e('Like Box Width:','mosque_crunchpress');?>
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('likebox_width')); ?>" size='2' name="<?php echo esc_attr($this->get_field_name('likebox_width')); ?>" type="text" value="<?php echo esc_attr($likebox_width); ?>" />
  </label>
  </p>
  <p>
  <label for="<?php echo esc_attr($this->get_field_id('likebox_height')); ?>">
	  <?php esc_html_e('Like Box Height:','mosque_crunchpress');?>
	  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('likebox_height')); ?>" size='2' name="<?php echo esc_attr($this->get_field_name('likebox_height')); ?>" type="text" value="<?php echo esc_attr($likebox_height); ?>" />
  </label>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['pageurl'] = $new_instance['pageurl'];
	$instance['showfaces'] = $new_instance['showfaces'];	
	$instance['showstream'] = $new_instance['showstream'];
	$instance['showheader'] = $new_instance['showheader'];	
	$instance['likebox_width'] = $new_instance['likebox_width'];	
	$instance['likebox_height'] = $new_instance['likebox_height'];			
    return $instance;
  }
 
	function widget($args, $instance)
	{
		
		extract($args, EXTR_SKIP);
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$pageurl = empty($instance['pageurl']) ? ' ' : apply_filters('widget_title', $instance['pageurl']);
		$showfaces = empty($instance['showfaces']) ? ' ' : apply_filters('widget_title', $instance['showfaces']);
		$showstream = empty($instance['showstream']) ? ' ' : apply_filters('widget_title', $instance['showstream']);
		$showheader = empty($instance['showheader']) ? ' ' : apply_filters('widget_title', $instance['showheader']);
		$likebox_width = empty($instance['likebox_width']) ? ' ' : apply_filters('widget_title', $instance['likebox_width']);													
		$likebox_height = empty($instance['likebox_height']) ? ' ' : apply_filters('widget_title', $instance['likebox_height']);													
		
		echo html_entity_decode($before_widget);	
		// WIDGET display CODE Start
		if (!empty($title))
			echo html_entity_decode($before_title);
			echo esc_attr($title);
			echo html_entity_decode($after_title);
			global $wpdb, $post;?>
			<?php	
			if($likebox_width == ' ' || $likebox_width == ''){$likebox_width = '300';}
			if($likebox_height == ' ' || $likebox_height == ''){$likebox_height = '315';}
			?>         

			<div class="fb-like-box" data-href="<?php echo esc_url($pageurl);?>" data-width="<?php echo esc_attr($likebox_width);?>" data-height="<?php echo esc_attr($likebox_height);?>"  data-show-faces="<?php echo esc_attr($showfaces);?>" data-header="false" data-stream="<?php echo esc_attr($showstream);?>" data-show-border="false"></div>
			<div id="fb-root"></div>
			<script type="text/javascript">(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=482990088401012";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
	<?php echo html_entity_decode($after_widget);
		}
		
	}
add_action( 'widgets_init', create_function('', 'return register_widget("cp_facebook_widget");') );?>