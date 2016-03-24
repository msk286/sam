<?php
//Condition for Parent Class
if(class_exists('function_library')){
	
	add_action( 'plugins_loaded', 'slider_fun_override' );
	function slider_fun_override() {
		$slider_class = new cp_slider_class;
	}

	class cp_slider_class extends function_library{
		public $slider_array =	array(
		
				'image_icon' =>array(

				'type'=> 'image','name'=> '',

				'hr'=> 'none',

				'description'=> "fa fa-laptop"),

			"top-bar-div31-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div31'),	

			'slider-type'=>array(

				'title'=>'SLIDER TYPE',

				'name'=>'page-option-item-slider-type',

				'options'=>array('0'=>'Bx-Slider','1'=>'Layer-Slider'),
				/*'options'=>array('0'=>'Anything','1'=>'Flex-Slider','2'=>'Default-Slider','3'=>'Layer-Slider'),*/
				
				/*'options'=>array('0'=>'Anything','1'=>'Flex-Slider','2'=>'Default-Slider'),*/

				'type'=>'combobox',

				'hr'=>'none',
				
				'description'=>'Select Slider from the dropdown list.',

				),
				
			'slider-slide'=>array(

				'title'=>'SELECT SLIDE IMAGES',

				'name'=>'page-option-item-slider-images',

				'options'=>array(),

				'type'=>'combobox_post',
				
				'class'=> 'default-slider-style-class',

				'hr'=>'none',
				
				'description'=>'Select Slider Image Gallery from the dropdown list.',

				),
			
			'slider-slide-layer'=>array(

				'title'=>'SELECT LAYER SLIDER ID',

				'name'=>'page-option-item-slider-layer',

				'options'=>array(),

				'type'=>'combobox',
				
				'class'=> 'layer-slider-style-class',

				'hr'=>'none',
				
				'description'=>'Select Layer Slider Images slide.',

				),	
				
			"top-bar-div31-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div31'),	
			
			"top-bar-div32-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div32'),
			
			'width'=>array(

				'title'=>'SLIDER WIDTH',

				'name'=>'page-option-item-slider-width',

				'type'=>'inputtext',

				'default'=>'940',
				
				'description'=>'Please enter the width of the slider.',

				'hr'=>'none'),

			'height'=>array(

				'title'=>'SLIDER HEIGHT',

				'name'=>'page-option-item-slider-height',

				'type'=>'inputtext',

				'default'=>'360',
				
				'description'=>'Please enter the Height of the slider.',

				'hr'=>'none'),
				
			"top-bar-div32-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div32'),	

		);
		
		
		
		public $slider_size_array = array(
			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-4'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1');
			
		public function page_builder_size_class(){
		global $div_size;
			$div_size['Slider'] = $this->slider_size_array;	  
		}
		
		public function page_builder_element_class(){
		global $page_meta_boxes;
			$page_meta_boxes['Page Item']['name']['Slider'] = $this->slider_array;
			$page_meta_boxes['Page Item']['name']['Slider']['slider-slide']['options'] = function_library::get_title_list_array('cp_slider');
			$page_meta_boxes['Top Slider Images']['options'] = function_library::get_title_list_array('cp_slider');
			if(class_exists('LS_Sliders')){
				$page_meta_boxes['Page Item']['name']['Slider']['slider-slide-layer']['options'] = function_library::layer_slider_id();
				$page_meta_boxes['Top Slider Layer']['options'] = function_library::layer_slider_id();
			}
		}
		
		public function __construct(){
			add_action( 'init', array( $this, 'create_slider' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_slider_option' ) );
			add_action( 'save_post', array( $this, 'save_slider_option_meta' ) );
		}

		public function create_slider() {
		
			$labels = array(
				'name' => _x('Slider', 'Slider General Name', 'mosque_crunchpress'),
				'singular_name' => _x('Slider Item', 'Slider Singular Name', 'mosque_crunchpress'),
				'add_new' => _x('Add New', 'Add New Slider Name', 'mosque_crunchpress'),
				'add_new_item' => __('Add New Slider', 'mosque_crunchpress'),
				'edit_item' => __('Edit Slider', 'mosque_crunchpress'),
				'new_item' => __('New Slider', 'mosque_crunchpress'),
				'view_item' => '',
				'search_items' => __('Search Slider', 'mosque_crunchpress'),
				'not_found' =>  __('Nothing found', 'mosque_crunchpress'),
				'not_found_in_trash' => __('Nothing found in Trash', 'mosque_crunchpress'),
				'parent_item_colon' => ''
			);
			
			$args = array(
				'labels' => $labels,
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_icon' => '',
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 100,
				"show_in_nav_menus" => false,
				'supports' => array('title','thumbnail','custom-fields'),
				'rewrite' => array('slug' => 'cpslider', 'with_front' => false)
			); 
			  
			register_post_type( 'cp_slider' , $args);
			
		}
		
		public $slider_meta_box = array(	
			"Slider Picker" => array(
				'type'=>'sliderpicker',
				'title'=> 'SELECT IMAGES',
				'xml'=>'cp-slider-xml',
				'name'=>array(
					'image'=>'slider-option-inside-thumbnail-slider-image',
					'title'=>'slider-option-inside-thumbnail-slider-title',
					'caption'=>'slider-option-cp-slider-caption',
					'link'=>'slider-option-inside-thumbnail-slider-link',
					'linktype'=>'slider-option-inside-thumbnail-slider-linktype',
					//'btn_txt'=>'slider-option-inside-btn-slider-txt',
					),
				'hr'=>'none'
			)	
		);
		
		
		public function add_slider_option(){
		
			add_meta_box('cp_slider_option', __('Slider Images','mosque_crunchpress'), array( $this, 'add_slider_option_element' ),
				'cp_slider', 'normal', 'high');
				
		}
		
		public function add_slider_option_element(){
			$slider_meta_box = $this->slider_meta_box;
			
			global $post;
			echo '<div id="cp-overlay-wrapper">';
			
			?> <div class="gallery-option-meta" id="gallery-option-meta"> <?php
			
				//set_nonce();
				
				foreach($slider_meta_box as $meta_box){
				//echo '<pre>';print_r($meta_box);die;

					if( $meta_box['type'] == 'sliderpicker' ){
					
						$xml_string = get_post_meta($post->ID, $meta_box['xml'], true);
						if( !empty($xml_string) ){

							$xml_val = new DOMDocument();
							$xml_val->loadXML( $xml_string );
							$meta_box['value'] = $xml_val->documentElement;
							
						}
						self::print_slider_picker($meta_box);
						
					}else{
					
						$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
						print_meta($meta_box);
					
					}				
					
				}
				
			?> </div> <?php
			
			echo '</div>';
			
		}
		
		public function save_slider_option_meta($post_id){
			
			$slider_meta_box = $this->slider_meta_box;
			//global $slider_meta_box;
			$edit_meta_boxes = $slider_meta_box;
			
			// save
			foreach ($edit_meta_boxes as $edit_meta_box){
			
				// save function for slider
				if( $edit_meta_box['type'] == 'sliderpicker' ){
				
					if(isset($_POST[$edit_meta_box['name']['image']])){
					
						$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;
						
					}else{
					
						$num = -1;
						
					}
					
					$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);
					if(isset($_POST[$edit_meta_box['name']['image']])){
						$slider_xml = "<slider-item>";
						
						for($i=0; $i<=$num; $i++){
						
							$slider_xml = $slider_xml. "<slider>";
							$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);
							$slider_xml = $slider_xml. function_library::create_xml_tag('image',$image_new);
							$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);
							$slider_xml = $slider_xml. function_library::create_xml_tag('linktype',$linktype_new);
							$link_new = stripslashes(esc_html($_POST[$edit_meta_box['name']['link']][$i]));
							$slider_xml = $slider_xml. function_library::create_xml_tag('link',$link_new);
							$title_new = stripslashes(esc_html($_POST[$edit_meta_box['name']['title']][$i]));
							$slider_xml = $slider_xml. function_library::create_xml_tag('title',$title_new);
							$caption_new = stripslashes(esc_html($_POST[$edit_meta_box['name']['caption']][$i]));
							$slider_xml = $slider_xml. function_library::create_xml_tag('caption',$caption_new);
							//$btn_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['btn_txt']][$i]));
							//$slider_xml = $slider_xml. function_library::create_xml_tag('btn_txt',$btn_new);
							$slider_xml = $slider_xml . "</slider>";
							
						}
						
						$slider_xml = $slider_xml . "</slider-item>";
						save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);
					}
					
					
				}else{
				
					if(isset($_POST[$edit_meta_box['name']])){
					
						$new_data = stripslashes($_POST[$edit_meta_box['name']]);
						
					}else{
					
						$new_data = '';
						
					}
					
					$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
					save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
					
				}
				
			}
			
		}

		// gallerypicker => title, name=>array(num,image,title,caption,link)
		public function print_slider_picker($args){
		
			extract($args);
			
			global $post;
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
								<div id="selected-image-none"><?php _e('No Image Inserted', 'mosque_crunchpress'); ?></div>
								<ul>
									<li id="default" class="default">
										<div class="selected-image-wrapper">
											<img src="#"/>
											<div class="selected-image-element">
												<div id="edit-image" class="edit-image"></div>
												<div id="unpick-image" class="unpick-image"></div>
												<br class="clear">
											</div>
										</div>
										<input type="hidden" class='slider-image-url' id='<?php echo $name['image']; ?>' />
										
										<div id="slider-detail-wrapper" class="slider-detail-wrapper">									
										<div id="slider-detail" class="slider-detail"> 	
										<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER TITLE', 'mosque_crunchpress'); ?></div> 
											<div class="meta-detail-input meta-input"><input type="text" id='<?php echo $name['title']; ?>' /></div><br class="clear">
											<hr class="separator">
											<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER CAPTION', 'mosque_crunchpress'); ?></div>
											<div class="meta-detail-input meta-input"><textarea id='<?php echo $name['caption']; ?>' ></textarea></div><br class="clear">
											<hr class="separator">
											<div class="meta-title meta-detail-title"><?php esc_html_e('LINK TYPE', 'mosque_crunchpress'); ?></div> 
											<div class="meta-input meta-detail-input">
												<div class="combobox">
													<select id='<?php echo $name['linktype']; ?>'>
														<option><?php esc_html_e('No Link', 'mosque_crunchpress'); ?></option>
														<option><?php esc_html_e('Link to URL', 'mosque_crunchpress'); ?></option>	
													</select>
												</div>
											</div><br class="clear">
											<div class="url">
												<div class="meta-title meta-detail-title" rel="url"><?php esc_html_e('URL PATH', 'mosque_crunchpress'); ?></div> 
												<div class="meta-detail-input meta-input"><input class="mt10" type="text"  id='<?php echo $name['link']; ?>' /></div>
											</div>
											<hr class="separator">
											<!--<div class="meta-title meta-detail-title"><?php //_e('SLIDER BUTTON TEXT', 'mosque_crunchpress'); ?></div> 
											<div class="meta-detail-input meta-input"><input type="text" id='<?php //echo $name['btn_txt']; ?>' /></div><br class="clear">-->
											<hr class="separator">
											<br class="clear">
											<div class="meta-detail-done-wrapper">
												<input type="button" id="cp-detail-edit-done" class="cp-button" value="Done" /><br class="clear">
											</div>
												<input type="hidden" id="cp-detail-edit-done" class="cp-button" name="submit_button" value="submit_button" /><br class="clear">
										</div>
										</div>
									</li>
									
									<?php 
									
										if(!empty($value)){
											
											foreach ($value->childNodes as $slider){ ?> 
											
												<li class="slider-image-init">
													<div class="selected-image-wrapper">
														<img src="<?php 
														
															$thumb_src_preview = wp_get_attachment_image_src( function_library::cp_find_xml_value($slider, 'image'), '160x110');
															echo $thumb_src_preview[0]; 
															
														?>"/>
														<div class="selected-image-element">
															<div id="edit-image" class="edit-image"></div>
															<div id="unpick-image" class="unpick-image"></div>
															<br class="clear">
														</div>
													</div>
													<input type="hidden" class='slider-image-url' name='<?php echo $name['image']; ?>[]' id='<?php echo $name['image']; ?>[]' value="<?php echo cp_find_xml_value($slider, 'image'); ?>" /> 
													<div id="slider-detail-wrapper" class="slider-detail-wrapper">
													<div id="slider-detail" class="slider-detail">
														<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER TITLE', 'mosque_crunchpress'); ?></div> 
														<div class="meta-detail-input meta-input"><input type="text" name='<?php echo $name['title']; ?>[]' id='<?php echo $name['title']; ?>[]' value="<?php echo cp_find_xml_value($slider, 'title'); ?>" /></div><br class="clear">
														<hr class="separator">
														<div class="meta-title meta-detail-title"><?php esc_html_e('SLIDER CAPTION', 'mosque_crunchpress'); ?></div>
														<div class="meta-detail-input meta-input"><textarea name='<?php echo $name['caption']; ?>[]' id='<?php echo $name['caption']; ?>[]' ><?php echo cp_find_xml_value($slider, 'caption'); ?></textarea></div><br class="clear">
														<hr class="separator">												
														<div class="meta-title meta-detail-title"><?php esc_html_e('LINK TYPE', 'mosque_crunchpress'); ?></div>
														<div class="meta-input meta-detail-input">
															<div class="combobox">
																<?php $linktype_val =  function_library::cp_find_xml_value($slider, 'linktype'); ?>
																<select name='<?php echo $name['linktype']; ?>[]' id='<?php echo $name['linktype']; ?>' >
																	<option <?php echo ($linktype_val == 'No Link')? "selected" : ''; ?> ><?php esc_html_e('No Link', 'mosque_crunchpress'); ?></option>
																	<option <?php echo ($linktype_val == 'Link to URL')? "selected" : ''; ?>><?php esc_html_e('Link to URL', 'mosque_crunchpress'); ?></option>
																</select>
															</div>
														</div><br class="clear">
														<div class="url">
															<div class="meta-title meta-detail-title" rel="url"><?php esc_html_e('URL PATH', 'mosque_crunchpress'); ?></div> 
															<div class="meta-detail-input meta-input"><input class="mt10" type="text" name='<?php echo $name['link']; ?>[]' id='<?php echo $name['link']; ?>[]' value="<?php echo esc_url(cp_find_xml_value($slider, 'link')); ?>" /></div>
														</div>
														<div class="clear"></div>
														<!--<div class="meta-title meta-detail-title"><?php esc_html_e('BUTTON TEXT', 'mosque_crunchpress'); ?></div> 
														<div class="meta-detail-input meta-input"><input class="" type="text" name='<?php //echo $name['btn_txt']; ?>[]' id='<?php //echo $name['btn_txt']; ?>[]' value="<?php //echo cp_find_xml_value($slider, 'btn_txt'); ?>" /></div>-->
														<input type="hidden" value="slider_images" name="slider_images">
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
								<br class=clear>
								<div id="show-media" class="show-media">							
									<span id="show-media-text"></span>
									
									<div id="show-media-image"></div>
								</div>
							</div>
							<div class="media-image-gallery-wrapper">
							<input class="upload_image_button white_color" type="button" value="Upload" />
								<div class="media-image-gallery" id="media-image-gallery">
									<?php function_library::get_media_image(); ?>
								</div>
							</div>
						</div>
					</div>
					<br class=clear>
				</div>
				
			<?php
			
		}	

	}
}	