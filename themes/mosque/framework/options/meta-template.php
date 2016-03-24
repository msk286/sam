<?php

	/*	
	*	CrunchPress Meta Template File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the template of meta box for each input type.
	* 	The framework will use it when create meta box for each post_type.
	*	---------------------------------------------------------------------
	*/
	
	// decide to print each meta box type
	function print_meta($meta_box){
	
		if(empty($meta_box['default'])) $meta_box['default'] = '';
		
		switch($meta_box['type']){
		
			case "open" : print_meta_open_div($meta_box); break;
			case "close" : print_meta_close_div($meta_box); break;
			//case "label": print_meta_label($meta_box); break;
			case "header": print_meta_header($meta_box); break;
			case "text": print_meta_text($meta_box); break;
			case "description": print_description($meta_box); break;
			case "inputtext": print_meta_input_text($meta_box); break;
			case "upload": print_meta_upload($meta_box); break;
			case "textarea": print_meta_input_textarea($meta_box); break;
			case "checkbox": print_meta_input_checkbox($meta_box); break;
			case "combobox": print_meta_input_combobox($meta_box); break;
			case "combobox_category": print_meta_input_combobox_category($meta_box); break;
			case "combobox_category_main": print_meta_input_combobox_category_main($meta_box); break;
			case "combobox_post": print_meta_input_combobox_post($meta_box); break;
			case "radioenabled": print_meta_input_radioenabled($meta_box); break;
			case "radioimage": print_meta_input_radioimage($meta_box); break;
			case "imagepicker": print_image_picker($meta_box); break;
			case "image": print_set_image_picker($meta_box); break;
			case "colorpicker": print_set_color_picker($meta_box); break;

		}
		
	}
	
	// nonce Verification	
	function set_nonce(){
	
		wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename');
		
	}
	
	//Select Color
	function print_set_color_picker($meta_box){
	
	extract($meta_box); ?>
	
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>" ><?php echo esc_attr($title); ?></label>
				</div>
			
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<input class="color-picker" type="text" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" value="<?php 
						echo ($value == '')? esc_html($default): esc_html($value);
						?>" />
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"> <?php echo esc_attr($description); ?> </div>
				<?php } ?>
			</div>
	<?php
	
	}
	
	//Image on box
	function print_set_image_picker($meta_box){
		
	
	}
	
	// header => name, title
	function print_meta_header($args){
	
		extract($args);
		$meta_id = (isset($meta_id))? $meta_id : '';
		if($inner == 'Yes'){echo '</div>';}
		?>	
			
			<div id="meta-header" class="<?php echo 'cp-options-'.$class; ?>">
				<h2 class="heading"><span class="font-aw-hr"><i class="fa fa-hand-up"></i></span><?php echo esc_attr($title); ?></h2>
				<a id="no-active" class="<?php echo 'cp-options-'.$class; ?>"><span class="font-aw"><i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i></span></a>
			</div>
			
		<?php 
		if($inner == 'Yes'){echo '<div id="cp-options-'.$class.'" class="container-fluid">';}
		
	}

	// text => name, text
	function print_meta_text($args){
	
		extract($args); 
		
		?>
		
			<div class="meta-body span4">
				<div class="meta-title pb10">
					<?php echo esc_attr($title); ?>
				</div>
			</div>
			
		<?php 
		
	}
	
	// text => name, title, value, default
	function print_meta_input_text($args){
		
		$class = '';
		extract($args);
		
		?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>" ><?php echo esc_attr($title); ?></label>
				</div>
			
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<input type="text" name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" value="<?php 
						echo ($value == '')? esc_html($default): esc_html($value);
						?>" />
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"> <?php echo esc_attr($description); ?> </div>
				<?php } ?>
			</div>
			
		<?php
		
	}

	// text => name, title, value, default
	function print_description($args){
		extract($args);
		
		?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label><?php echo esc_attr($title); ?></label>
				</div>
				<div class="only-description"> <?php echo esc_attr($description); ?> </div>
				
			</div>
			
		<?php
		
	}	
		
	// text => name, title, value
	function print_meta_upload($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>" ><?php echo esc_attr($title); ?></label>
				</div>
				
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="meta-input-example-image" id="meta-input-example-image">
						<?php 
							$image_src = '';
							if(!empty($value)){
							
								$image_src = wp_get_attachment_image_src( $value, array(60,60) );
								$thumb_src_preview = wp_get_attachment_image_src( $value, array(60,60));
								echo '<img src="' . $thumb_src_preview[0] . '" />';
							} 
							
						?>		
					</div>
					<input name="<?php echo esc_attr($name); ?>" type="hidden" id="upload_image_attachment_id" value="<?php 
						echo (empty($value))? esc_html($default): esc_html($value);
					?>" />
					<input id="upload_image_text_meta" class="upload_image_text_meta" type="text" value="<?php echo (empty($image_src[0]))? '': $image_src[0]; ?>" />
					<input class="upload_image_button_meta" type="button" value="Upload" />
			</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
				
			</div>
			
		<?php
		
	}
	
	// textarea => name, title, value, default
	function print_meta_input_textarea($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php if(isset($class) AND $class == 'cp-full-width'){echo 'span12';}else{echo 'span4';}?> <?php echo str_replace('[]','',$name); ?>-wrapper">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';}?>">
					<textarea name="<?php echo esc_attr($name); ?>" id="<?php echo esc_attr($name); ?>" class="<?php echo str_replace('[]','',$name); ?>"><?php
						echo ($value == '')? esc_html($default): esc_html($value);
					?></textarea>
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// checkbox => name, title, value
	function print_meta_input_checkbox($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body span4">
			
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<?php echo esc_html__('Not yet implement','mosque_crunchpress'); ?>
				</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
				
			</div>
			
		<?php
	}	
	
	// combobox => name, title, value, options[]
	function print_meta_input_combobox($args){
		$class= '';
		extract($args);
		
		$value = (empty($value))? $default: $value;
		
		?>
			
			<div class="meta-body <?php if($class == 'full-width'){echo 'cp-full-width';}else{echo 'span4';}?>">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class) AND $class <> 'full-width'){echo esc_attr($class);}else{$class = '';};?>">	
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<?php 
							foreach($options as $option){ ?>
								<option rel="<?php echo esc_attr($option) ; ?>" <?php if( $option==esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}	
	
		// combobox => name, title, value, options[]
	function print_meta_input_combobox_category($args){
	
		extract($args);
		
		//$value = (empty($value))? $default: $value;
		if($value <> ''){
			$fetched_value = $value;
		}else{
			$fetched_value = '';
		}
		?>
			
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0" rel="0" <?php if( esc_html($fetched_value) == '0' ){ echo 'selected'; }?> ><?php echo esc_html__('All','mosque_crunchpress'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option->term_id); ?>" rel="<?php echo esc_attr($option->term_id); ?>" <?php if( $option->term_id == esc_html($fetched_value) ){ echo 'selected'; }?> ><?php echo esc_attr($option->name) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}	
	
	
		// combobox => name, title, value, options[]
	function print_meta_input_combobox_category_main($args){
	
		extract($args);
		
		//$value = (empty($value))? $default: $value;
		if($value <> ''){
			$fetched_value = $value;
		}else{
			$fetched_value = '';
		}
		?>
			
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="78612" rel="78612" <?php if( esc_html($fetched_value) == '78612' ){ echo 'selected'; }?> ><?php echo esc_html__('All','mosque_crunchpress'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option->term_id); ?>" rel="<?php echo esc_attr($option->term_id); ?>" <?php if( $option->term_id == esc_html($fetched_value) ){ echo 'selected'; }?> ><?php echo esc_attr($option->name) ; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}	
	
			// combobox => name, title, value, options[]
	function print_meta_input_combobox_post($args){
	
		extract($args);
		
				$value = (empty($value))? $default: $value;
		
		?>
			
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<div class="combobox">
						<select name="<?php echo esc_attr($name); ?>" id="<?php echo str_replace('[]', '', $name); ?>">
							<option value="0"><?php echo esc_html__('--Select Any--','mosque_crunchpress'); ?></option>
							<?php foreach($options as $option){ ?>
								<option value="<?php echo esc_attr($option->ID) ; ?>" rel="<?php echo esc_attr($option->ID) ; ?>" <?php if( $option->ID == esc_html($value) ){ echo 'selected'; }?> ><?php echo esc_attr($option->post_title); ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}
	
	// radioenabled => name, title, value
	function print_meta_input_radioenabled($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body span4">
				<div class="meta-title">
					<label for="<?php echo esc_attr($name); ?>"><?php echo esc_attr($title); ?></label>
				</div>
				<div class="meta-input <?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>">
					<input type="radio" name="<?php echo esc_attr($name); ?>" value="enabled" <?php if($value=='enabled' || $value=='') echo 'checked'; ?>><?php echo esc_html__('Enable','mosque_crunchpress'); ?>  &nbsp&nbsp&nbsp
					<input type="radio" name="<?php echo esc_attr($name); ?>" value="disable" <?php if($value=='disable') echo 'checked'; ?>><?php echo esc_html__('Disable','mosque_crunchpress'); ?> 
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo esc_attr($description); ?></div>
				<?php } ?>
				
			</div>
			
		<?php
		
	}	

	
	
	function print_meta_input_radioimage($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body span12">
				<div class="meta-input row-fluid">
					<?php foreach( $options as $option ){ ?>
						<div class='radio-image-wrapper span2'>
						<span class="head-sec-sidebar"><?php echo str_replace('-',' ',$option['value']); ?></span>
							<label for="<?php echo esc_attr($option['value']); ?>">
								<img src=<?php echo CP_PATH_URL.$option['image']?> alt=<?php echo esc_attr($name);?>>
								<div id="check-list"></div>
							</label>
							<input type="radio" name="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($option['value']);?>" <?php 
								if($value == $option['value']){
									echo 'checked';
								}else if($value == '' && $default == $option['value']){
									echo 'checked';
								}
							?> id="<?php echo esc_attr($option['value']); ?>" class="<?php echo esc_attr($name); ?>" > 
						</div>
					<?php } ?>
					
				</div>
				
			</div>
		<?php
	}	
	
	// imagepicker => title, name=>array(num,image,title,caption,link)
	function print_image_picker($args){
		extract($args);
		?>	
			<div class="meta-body image-picker-wrapper">
				<div class="meta-input-slider">
					<div class="image-picker" id="image-picker">
						<input type='hidden' class="slider-num" id="slider-num" name='<?php 
							echo (isset($name['slider-num']))? $name['slider-num'] . '[]' : '' ; 
						?>' value=<?php 
							echo empty($value)? 0: $value->childNodes->length;
						?> />
						<div class="selected-image" id="selected-image">
							<div id="selected-image-none"><?php echo esc_html__('No Gallery Items Inserted','mosque_crunchpress'); ?></div>
							<ul>
								<li id="default" class="default">
									<div class="selected-image-wrapper">
										<img src="" alt="" />
										<div class="selected-image-element">
											<div id="edit-image" class="edit-image"></div>
											<div id="unpick-image" class="unpick-image"></div>
											<br class="clear">
										</div>
									</div>
									<input type="hidden" class='slider-image-url' id='<?php echo esc_url($name['image']); ?>' />
									<div id="slider-detail-wrapper" class="slider-detail-wrapper">
									<div id="slider-detail" class="slider-detail"> 	
										<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER TITLE', 'mosque_crunchpress'); ?></div> 
										<div class="meta-detail-input meta-input"><input type="text" id='<?php echo esc_attr($name['title']); ?>' /></div><br class="clear">
										<hr class="separator">
										<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER CAPTION', 'mosque_crunchpress'); ?></div>
										<div class="meta-detail-input meta-input"><textarea id='<?php echo esc_attr($name['caption']); ?>' ></textarea></div><br class="clear">
										<hr class="separator">
										<div class="meta-title meta-detail-title"><?php esc_htmlesc_html_e('LINK TYPE', 'mosque_crunchpress'); ?></div> 
										<div class="meta-input meta-detail-input">
											<div class="combobox">
												<select id='<?php echo esc_attr($name['linktype']); ?>'>
													<option selected ><?php echo esc_html__('No Link','mosque_crunchpress'); ?></option>
													<option><?php echo esc_html__('Lightbox','mosque_crunchpress'); ?></option>
													<option><?php echo esc_html__('Link to URL','mosque_crunchpress'); ?></option>	
													<option><?php echo esc_html__('Link to Video','mosque_crunchpress'); ?></option>
												</select>
											</div>
											<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php esc_htmlesc_html_e('URL PATH', 'mosque_crunchpress'); ?></div> 
											<div class="meta-title meta-detail-title ml0 mt5" rel="video"><?php esc_htmlesc_html_e('VIDEO PATH (ONLY FOR ANYTHING SLIDER)', 'mosque_crunchpress'); ?></div> 
											<div><input class="mt10" type="text"  id='<?php echo esc_attr($name['link']); ?>' /></div>
										</div>
										<br class="clear">
										<div class="meta-detail-done-wrapper">
											<input type="button" id="cp-detail-edit-done" class="cp-button" value="Done" /><br class="clear">
										</div>
									</div>
									</div>
								</li>
								
								<?php 								
									if(!empty($value)){
										
										foreach ($value->childNodes as $slider){ ?> 
										
											<li class="slider-image-init">
												<div class="selected-image-wrapper">
													<img src="<?php 
													
														$thumb_src_preview = wp_get_attachment_image_src( cp_find_xml_value($slider, 'image'), '160x110');
														echo esc_url($thumb_src_preview[0]); 
														
													?>"/>
													<div class="selected-image-element">
														<div id="edit-image" class="edit-image"></div>
														<div id="unpick-image" class="unpick-image"></div>
														<br class="clear">
													</div>
												</div>
												<input type="hidden" class='slider-image-url' name='<?php echo esc_attr($name['image']); ?>[]' id='<?php echo esc_attr($name['image']); ?>[]' value="<?php echo cp_find_xml_value($slider, 'image'); ?>" /> 
												<div id="slider-detail-wrapper" class="slider-detail-wrapper">
												<div id="slider-detail" class="slider-detail">								
													<div class="meta-title meta-detail-title"><?php esc_htmlesc_html_e('SLIDER TITLE', 'mosque_crunchpress'); ?></div> 
													<div class="meta-detail-input meta-input"><input type="text" name='<?php echo esc_attr($name['title']); ?>[]' id='<?php echo esc_attr($name['title']); ?>[]' value="<?php echo cp_find_xml_value($slider, 'title'); ?>" /></div><br class="clear">
													<hr class="separator">
													<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER CAPTION', 'mosque_crunchpress'); ?></div>
													<div class="meta-detail-input meta-input"><textarea name='<?php echo esc_attr($name['caption']); ?>[]' id='<?php echo esc_attr($name['caption']); ?>[]' ><?php echo cp_find_xml_value($slider, 'caption'); ?></textarea></div><br class="clear">
													<hr class="separator">
													<div class="meta-title meta-detail-title"><?php esc_html_e('LINK TYPE', 'mosque_crunchpress'); ?></div>
													<div class="meta-input meta-detail-input">
														<div class="combobox">
															<?php $linktype_val =  cp_find_xml_value($slider, 'linktype'); ?>
															<select name='<?php echo esc_attr($name['linktype']); ?>[]' id='<?php echo esc_attr($name['linktype']); ?>' >
																<option <?php echo ($linktype_val == 'No Link')? "selected" : ''; ?> ><?php echo esc_html__('No Link','mosque_crunchpress'); ?></option>
																<option <?php echo ($linktype_val == 'Lightbox')? "selected" : ''; ?>><?php echo esc_html__('Lightbox','mosque_crunchpress'); ?></option>
																<option <?php echo ($linktype_val == 'Link to URL')? "selected" : ''; ?>><?php echo esc_html__('Link to URL','mosque_crunchpress'); ?></option>
																<option <?php echo ($linktype_val == 'Link to Video')?  "selected" : ''; ?>><?php echo esc_html__('Link to Video','mosque_crunchpress'); ?></option>
															</select>
														</div>
														<div class="meta-title meta-detail-title ml0 mt5" rel="url"><?php esc_html_e('URL PATH', 'mosque_crunchpress'); ?></div> 
														<div class="meta-title meta-detail-title ml0 mt5" rel="video"><?php esc_html_e('VIDEO PATH (ONLY FOR ANYTHING SLIDER)', 'mosque_crunchpress'); ?></div> 
														<div><input class="mt10" type="text" name='<?php echo esc_attr($name['link']); ?>[]' id='<?php echo esc_attr($name['link']); ?>[]' value="<?php echo cp_find_xml_value($slider, 'link'); ?>" /></div>
													</div>
													
													<br class="clear">
													
													<div class="meta-detail-done-wrapper">
														<input type="button" id="cp-detail-edit-done" class="cp-button" value="Done" /><br class="clear">
													</div>
												</div>
												</div>
												</li> 
												
											<?php
											
										}
										
									}
									
								?>	
								
							</ul>
							
							<div id="show-media" class="show-media">
								<span id="show-media-text"></span>
								<div id="show-media-image"></div>
							</div>
						</div>
						<div class="media-image-gallery-wrapper">
							<div class="media-image-gallery" id="media-image-gallery">
								<?php get_media_image(); ?>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			

<?php }
	// open => id
	function print_meta_open_div($args){
		extract($args);
		?>
	<div id="<?php echo esc_attr($id); ?>" class="<?php if(isset($class)){echo esc_attr($class);}else{$class = '';};?>" >
<?php }
	
	// close
	function print_meta_close_div($args){	
	?>		
	</div>			
<?php }
	
	// save option function that trigger when saving each post
	add_action('save_post','save_option_meta');
	function save_option_meta($post_id){
	
		// Verification
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		if(!isset($_POST['myplugin_noncename'])) return;
		if(!wp_verify_nonce($_POST['myplugin_noncename'], plugin_basename( __FILE__ ))) return;
		
		// Save data of page
		if('page' == $_POST['post_type']){
			if(!current_user_can('edit_page', $post_id)) return;
			save_page_option_meta($post_id);
		// Save data of post
		}else if('post' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_post_option_meta($post_id);
		}else if('portfolio' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_portfolio_option_meta($post_id);
		}else if('testimonial' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_testimonial_option_meta($post_id);
		}else if('price_table' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_price_table_option_meta($post_id);
		}else if('gallery' == $_POST['post_type']){
			if(!current_user_can('edit_post', $post_id)) return;
			save_gallery_option_meta($post_id);
					
		}
	}
	
	// function that save the meta to database if new data exists and is not equals to old one
	function save_meta_data($post_id, $new_data, $old_data, $name){
		if($new_data == $old_data){
			add_post_meta($post_id, $name, $new_data, true);
		}else if(!$new_data){
			delete_post_meta($post_id, $name, $old_data);
		}else if($new_data != $old_data){
			update_post_meta($post_id, $name, $new_data, $old_data);
		}
	}
?>