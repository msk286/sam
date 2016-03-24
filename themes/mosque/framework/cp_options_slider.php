<?php

	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
add_action('wp_ajax_slider_settings','slider_settings');
function slider_settings(){

	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
					$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');
					
					
					?>		
<div class="cp-wrapper bootstrap_admin cp-margin-left"> 

    <!--content area start -->	  
	<div class="hbg top_navigation row-fluid">
		<div class="cp-logo span2">
			<img src="<?php echo CP_PATH_URL;?>/framework/images/logo.png" class="logo" />
		</div>
		<div class="sidebar span10">
			<?php echo cp_top_navigation_html_tooltip();?>
		</div>
	 <?php //echo cp_top_navigation_html(); ?>
	</div>
	<div class="content-area-main row-fluid"> 
	
      <!--sidebar start -->
      <div class="sidebar-wraper span2">
        <div class="sidebar-sublinks">
      <ul id="wp_t_o_right_menu">
				<li class="slide_settings" id="active_tab"><?php esc_html_e('Slider Settings', 'mosque_crunchpress'); ?></li>
			</ul>
        </div>
      </div>
		  <!--sidebar end --> 
      <!--content start -->
      <div class="content-area span10">
	  
        <form id="options-panel-form" name="cp-panel-form">
          <div class="panel-elements" id="panel-elements">
            <div class="panel-element" id="panel-element-save-complete">
              <div class="panel-element-save-text">
                <?php esc_html_e('Save Options Complete', 'mosque_crunchpress'); ?>
                .</div>
              <div class="panel-element-save-arrow"></div>
            </div>
            <div class="panel-element">
			<?php
			if(isset($action) AND $action == 'slider_settings'){
				$slider_settings_xml = '<slider_settings>';
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('select_slider',$select_slider);
				$slider_settings_xml = $slider_settings_xml . '<bx_slider_settings>';
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('slide_order_bx',$slide_order_bx);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('auto_play_bx',$auto_play_bx);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('pause_on_bx',$pause_on_bx);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('animation_speed_bx',$animation_speed_bx);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('show_bullets',$show_bullets);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('show_arrow',$show_arrow);
				
				//Video Banner
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('video_slider_on_off',$video_slider_on_off);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('video_banner_url',$video_banner_url);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('video_banner_caption',$video_banner_caption);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('video_banner_title',$video_banner_title);
				
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('video_banner_btn_text',$video_banner_btn_text);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('video_banner_btn_link',$video_banner_btn_link);			
				
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('safari_banner',$safari_banner);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('safari_banner_link',$safari_banner_link);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('safari_banner_width',$safari_banner_width);
				$slider_settings_xml = $slider_settings_xml . create_xml_tag('safari_banner_height',$safari_banner_height);
			
				
				$slider_settings_xml = $slider_settings_xml . '</bx_slider_settings>';
				$slider_settings_xml = $slider_settings_xml . '</slider_settings>';
				
				

				if(!save_option('slider_settings', get_option('slider_settings'), $slider_settings_xml)){
				
					die( json_encode($return_data) );
					
				}
				
				die( json_encode( array('success'=>'0') ) );
				
			}
			$select_slider = '';
			
			//Flex slider
			$animation_type_flex = '';
			$reverse_order_flex = '';
			$startat_flex_slider = '';
			$auto_play_flex = '';
			$animation_speed_flex = '';
			$pause_on_flex = '';
			$navigation_on_flex = '';
			$arrow_on_flex = '';
			
			//Anything slider
			$slide_mod_anything = '';
			$auto_play_anything = '';
			$pause_on_anything = '';
			$animation_speed_anything = '';
			
			//Video Banner
			$video_slider_on_off = '';
			$video_banner_url = '';
			$video_banner_title = '';
			$video_banner_caption = '';
			$video_banner_btn_text = '';
			$video_banner_btn_link = '';
			
			//safari banner
			$safari_banner_link = '';
			$safari_banner = '';
			$safari_banner_width = '';
			$safari_banner_height = '';
			
			
			//BX slider
			$slide_order_bx = '';
			$auto_play_bx = '';
			$pause_on_bx = '';
			$animation_speed_bx = '';
			$show_bullets = '';
			$show_arrow = '';
			
			$cp_slider_settings = get_option('slider_settings');
			
			if($cp_slider_settings <> ''){
				$cp_slider = new DOMDocument ();
				$cp_slider->preserveWhiteSpace = FALSE;
				$cp_slider->loadXML ( $cp_slider_settings );

				//Bx Slider Values
				$slide_order_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','slide_order_bx');
				$auto_play_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','auto_play_bx');
				$pause_on_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','pause_on_bx');
				$animation_speed_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','animation_speed_bx');
				$show_bullets = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','show_bullets');
				$show_arrow = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','show_arrow');
				
				//Video Banner
				$video_slider_on_off = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_slider_on_off');
				$video_banner_url = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_url');
				$video_banner_caption = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_caption');
				$video_banner_title = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_title');

				$video_banner_btn_text = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_btn_text');
				$video_banner_btn_link = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','video_banner_btn_link');
				
				$safari_banner = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','safari_banner');
				$safari_banner_link = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','safari_banner_link');
				$safari_banner_width = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','safari_banner_width');
				$safari_banner_height = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','safari_banner_height');
			} 
			?>
			</div>
					<ul class="slide_settings">
						<li id="slide_settings" class="slider_settings_class active_tab">
							<ul class="recipe_class row-fluid">
								<li class="panel-input span8">	
									<span class="panel-title">
										<h3 for="select_slider"><?php esc_html_e('SELECT SLIDER', 'mosque_crunchpress'); ?></h3>
									</span>
									<div class="combobox">
										<select name="select_slider" id="select_slider">
											<option value="default" selected class="default"> <?php esc_html_e('--No Slider--','mosque_crunchpress');?> </option>
											<option value="bx_slider" class="bx_slider"> <?php esc_html_e('BX Slider','mosque_crunchpress');?> </option>
											<option value="video_banner" class="video_banner"> <?php esc_html_e('Video Banner','mosque_crunchpress');?> </option>
										</select>
									</div>
								</li>
								<li class="span4 right-box-sec"><p> <?php esc_html_e('Select slider for configuration.','mosque_crunchpress');?> </p></li>
							</ul>	

							<div class="clear"></div>
							<div class="bx_slider_box">
								<h4> <?php esc_html_e('BX Slider Configurations','mosque_crunchpress');?> </h4>
								<div class="row-fluid">
									<ul class="recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="slide_order_bx"><?php esc_html_e('Slider Effect', 'mosque_crunchpress'); ?></h3>
											</span>
											<div class="combobox">
												<select name="slide_order_bx" id="slide_order_bx">
													<option value="slide" <?php if( $slide_order_bx == 'false' ){ echo 'selected'; }?>> <?php esc_html_e('Slide','mosque_crunchpress');?> </option>
													<option value="fade" <?php if( $slide_order_bx == 'false' ){ echo 'selected'; }?>> <?php esc_html_e('Fade','mosque_crunchpress');?> </option>
												</select>
											</div>
											<p><?php esc_html_e('Please select slider image order.','mosque_crunchpress');?></p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="auto_play_bx" > <?php esc_html_e('AUTO PLAY', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<label for="auto_play_bx">
												<div class="checkbox-switch <?php echo ($auto_play_bx=='enable' || ($auto_play_bx==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="auto_play_bx" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="auto_play_bx" id="auto_play_bx" class="checkbox-switch" value="enable" <?php echo ($auto_play_bx=='enable' || ($auto_play_bx==''))? 'checked': ''; ?>>
											<p> <?php esc_html_e('Please turn on/off Slider autoplay.','mosque_crunchpress');?><p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="pause_on_bx"><?php esc_html_e('PAUSE ON HOVER', 'mosque_crunchpress'); ?></h3>
											</span>	
											<label for="pause_on_bx">
												<div class="checkbox-switch <?php echo ($pause_on_bx=='enable' || ($pause_on_bx==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="pause_on_bx" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="pause_on_bx" id="pause_on_bx" class="checkbox-switch" value="enable" <?php echo ($pause_on_bx=='enable' || ($pause_on_bx==''))? 'checked': ''; ?>>
											<p> <?php esc_html_e('Please On/Off slider pause on hover.','mosque_crunchpress');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="animation_speed_bx" > <?php esc_html_e('ANIMATION SPEED', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<input type="text" name="animation_speed_bx" id="animation_speed_bx" value="<?php if($animation_speed_bx <> ''){echo esc_attr($animation_speed_bx);};?>" />
											<p> <?php esc_html_e('Please define animation speed for slider.','mosque_crunchpress');?> </p>
										</li>									
									</ul>
								</div>
								<div class="row-fluid">
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="show_bullets"><?php esc_html_e('SHOW BULLETS NAVIGATION', 'mosque_crunchpress'); ?></h3>
											</span>	
											<label for="show_bullets">
												<div class="checkbox-switch <?php echo ($show_bullets=='enable' || ($show_bullets==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="show_bullets" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="show_bullets" id="show_bullets" class="checkbox-switch" value="enable" <?php echo ($show_bullets=='enable' || ($show_bullets==''))? 'checked': ''; ?>>
											<p> <?php esc_html_e('Please On/Off slider pause on hover.','mosque_crunchpress');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="show_arrow"><?php esc_html_e('SHOW ARROW NAVIGATION', 'mosque_crunchpress'); ?></h3>
											</span>	
											<label for="show_arrow">
												<div class="checkbox-switch <?php echo ($show_arrow=='enable' || ($show_arrow==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="show_arrow" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="show_arrow" id="show_arrow" class="checkbox-switch" value="enable" <?php echo ($show_arrow=='enable' || ($show_arrow==''))? 'checked': ''; ?>>
											<p> <?php esc_html_e('Please On/Off slider pause on hover.','mosque_crunchpress');?> </p>
										</li>
									</ul>
								</div>
							</div>
								<!-- Video Slider Section Ingenio -->
							<div class="video_slider">
								<h4> <?php esc_html_e('Video Banner Configurations','mosque_crunchpress');?> </h4>
								<div class="row-fluid">
									<ul class="panel-body recipe_class span3">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="video_slider_on_off" > <?php esc_html_e('Video Banner', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<label for="video_slider_on_off">
												<div class="checkbox-switch <?php echo ($video_slider_on_off=='enable' || ($video_slider_on_off==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="video_slider_on_off" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="video_slider_on_off" id="video_slider_on_off" class="checkbox-switch" value="enable" <?php echo ($video_slider_on_off=='enable' || ($video_slider_on_off==''))? 'checked': ''; ?>>
											<p> <?php esc_html_e('Please turn on/off Video Banner.','mosque_crunchpress');?><p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span9">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="video_banner_url" > <?php esc_html_e('Video Banner URL', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<input type="text" name="video_banner_url" id="video_banner_url" value="<?php if($video_banner_url <> ''){echo esc_url($video_banner_url);};?>" />
											<p> <?php esc_html_e('Please Add Video Banner URL, .mp4 and .ojv supported i.e http://themeink.com/demo/goodwill/causes/wp-content/uploads/2015/05/ocean.ogv','mosque_crunchpress');?> </p>
										</li>									
									</ul>									
								</div>
								
								<div class="row-fluid">
									<ul class="panel-body recipe_class span6">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="video_banner_title" > <?php esc_html_e('Video Banner Title', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<input type="text" name="video_banner_title" id="video_banner_title" value="<?php if($video_banner_title <> ''){echo esc_attr($video_banner_title);};?>" />
											<p> <?php esc_html_e('Please Add Video Banner Title','mosque_crunchpress');?> </p>
										</li>									
									</ul>	
									<ul class="panel-body recipe_class span6">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="video_banner_caption" > <?php esc_html_e('Video Banner Caption', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<textarea name="video_banner_caption" id="video_banner_caption" value="<?php if($video_banner_caption <> ''){echo esc_attr($video_banner_caption);};?>"> </textarea>
											<p> <?php esc_html_e('Please Add Video Banner Caption','mosque_crunchpress');?> </p>
										</li>									
									</ul>		
											
								</div>
								<div class="row-fluid">
									<?php 
									$image_src_head = '';
									if(!empty($safari_banner)){ 
										$image_src_head = wp_get_attachment_image_src( $safari_banner, 'full' );
										$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
									}		
									?>
									<ul class="panel-body recipe_class span6">
										<li class="panel-input full-width">
												<span class="panel-title">
													<h3 for="safari_banner_link" > <?php esc_html_e(' Banner for Safari', 'mosque_crunchpress'); ?> </h3>
												</span>	
											<div class="content_con">
												<input name="safari_banner" type="hidden" class="clearme" id="upload_image_attachment_id" value="<?php echo esc_attr($safari_banner); ?>" />
												<input name="safari_banner_link" id="upload_image_text" class="clearme upload_image_text" type="text" value="<?php echo esc_url($image_src_head); ?>" />
												<input class="upload_image_button" type="button" value="Upload" />
											</div>
											<p> <?php esc_html_e('Please Add Banner For Safari','mosque_crunchpress');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span6">
										<li class="panel-input full-width">
											<div class="admin-logo-image text-right">
											  <?php 
												if(!empty($safari_banner)){ 
													$image_src_head = wp_get_attachment_image_src( $safari_banner, 'full' );
													$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
													$thumb_src_preview = wp_get_attachment_image_src( $safari_banner, array(150,150)); ?>
														<img class="clearme img-class" src="<?php if(!empty($image_src_head)){echo esc_url($thumb_src_preview[0]);}?>" alt="banner_safari" />
														
											  <?php } ?>
										 
											</div>
										</li>									
									</ul>		
								</div>
								<div class="row-fluid">
									<ul class="panel-body recipe_class span6">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="video_banner_btn_text" > <?php esc_html_e('Video Banner Button Text', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<input type="text" name="video_banner_btn_text" id="video_banner_btn_text" value="<?php if($video_banner_btn_text <> ''){echo esc_attr($video_banner_btn_text);};?>" />
											<p> <?php esc_html_e('Please Add Video Banner Button Text','mosque_crunchpress');?> </p>
										</li>									
									</ul>
									<ul class="panel-body recipe_class span6">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="video_banner_btn_link" > <?php esc_html_e('Video Banner Button Link', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<input type="text" name="video_banner_btn_link" id="video_banner_btn_link" value="<?php if($video_banner_btn_link <> ''){echo esc_attr($video_banner_btn_link);};?>" />
											<p> <?php esc_html_e('Please Add Video Banner Button Link','mosque_crunchpress');?> </p>
										</li>									
									</ul>											
								</div>
							</div>
						</li>
					</ul>
          
            <div class="panel-element-tail">
              <div class="tail-save-changes">
                <div class="loading-save-changes"></div>
                <input type="submit" value="<?php echo esc_html__('Save Changes','mosque_crunchpress') ?>">
                <input type="hidden" name="action" value="slider_settings">
              </div>
            </div>
          </div>
        </form>
      </div>
      <!--content End --> 
    </div>
    <!--content area end --> 
  </div>
	<?php
	
}	
?>
