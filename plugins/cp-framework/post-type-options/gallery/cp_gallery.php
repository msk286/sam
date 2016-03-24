<?php
//Condition for Parent Class
if(class_exists('function_library')){
	
	//Include the Widget
	include_once('cp_gallery_image_widget.php');
	
	add_action( 'plugins_loaded', 'gallery_fun_override' );
	function gallery_fun_override() {
		$gallery_class = new cp_gallery_class;
	}
	
	class cp_gallery_class extends function_library{

		public $gallery_array = array(
		
		'image_icon' =>array(

				'type'=> 'image','name'=> '',

				'hr'=> 'none',

				'description'=> "fa fa-file-picture-o"),

			"top-bar-div22-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div22'),			

			'header'=>array(

				'title'=> 'GALLERY HEADER TITLE',

				'name'=> 'page-option-item-gallery-header-title',

				'type'=> 'inputtext'),	

			'item-size'=>array(

				'title'=> 'GALLERY TYPE',

				'name'=> 'page-option-item-gallery-item-size',

				'type'=> 'combobox',

				'options'=> array('Carousel','2 Column', '3 Column', '4 Column','Modern Gallery',)

			),
			
			'num-size'=>array(

				'title'=> 'NUMBER OF IMAGES',

				'name'=> 'page-option-item-gallery-num-size',

				'default'=> 5,

				'type'=> 'inputtext'),	
			
			"top-bar-div22-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div22'),
			
			"top-bar-div23-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div23'),			

			'page'=> array(

				'title'=> 'CHOOSE GALLERY',

				'name'=> 'page-option-item-gallery-page',

				'type'=> 'combobox_post',

				'options'=> array(),

				'hr'=>'none'

			),

			'show-pagination'=> array(

				'title'=> 'SHOW PAGINATION',

				'name'=> 'page-option-item-gallery-page-pagination',

				'type'=> 'combobox',

				'options'=> array('Yes', 'No'),

				'hr'=>'none'

			),					

			"top-bar-div23-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div23'),			

		);
		
		
		
		public $gallery_size_array = array(
			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1');
			
		public function page_builder_size_class(){
		global $div_size;
			$div_size['Gallery'] = $this->gallery_size_array;	  
		}
		
		public function page_builder_element_class(){
		global $page_meta_boxes;
			$page_meta_boxes['Page Item']['name']['Gallery'] = $this->gallery_array;
			$page_meta_boxes['Page Item']['name']['Gallery']['page']['options'] = function_library::get_title_list_array( 'gallery' );
			//$page_meta_boxes['Gallery Slideshow']['options'] = function_library::get_title_list_array('gallery');
		}
		
		public function __construct(){
			add_action( 'init', array( $this, 'create_gallery' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_gallery_option' ) );
			add_action( 'save_post', array( $this, 'save_gallery_option_meta' ) );
			//echo 'class is '.__CLASS__.' working';
		}

		
		public function create_gallery() {
		
			$labels = array(
				'name' => _x('Gallery', 'Gallery General Name', 'mosque_crunchpress'),
				'singular_name' => _x('Gallery Item', 'Gallery Singular Name', 'mosque_crunchpress'),
				'add_new' => _x('Add New', 'Add New Gallery Name', 'mosque_crunchpress'),
				'add_new_item' => __('Add New Gallery', 'mosque_crunchpress'),
				'edit_item' => __('Edit Gallery', 'mosque_crunchpress'),
				'new_item' => __('New Gallery', 'mosque_crunchpress'),
				'view_item' => '',
				'search_items' => __('Search Gallery', 'mosque_crunchpress'),
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
				'rewrite' => array('slug' => 'cpgallery', 'with_front' => false)
			); 
			  
			register_post_type( 'gallery' , $args);
			
		}
		
		public $gallery_meta_box = array(	
			"Gallery Picker" => array(
				'type'=>'gallerypicker',
				'title'=> 'SELECT IMAGES',
				'xml'=>'post-option-gallery-xml',
				'name'=>array(
					'image'=>'post-option-inside-thumbnail-slider-image',
					'title'=>'post-option-inside-thumbnail-slider-title',
					'caption'=>'post-option-inside-thumbnail-slider-caption',
					'link'=>'post-option-inside-thumbnail-slider-link',
					'linktype'=>'post-option-inside-thumbnail-slider-linktype',
					'video'=> 'post-option-inside-thumbnail-slider-video'),
				'hr'=>'none'
			)	
		);
		
		
		public function add_gallery_option(){
		
			add_meta_box('gallery-option', __('Gallery','mosque_crunchpress'), array($this,'add_gallery_option_element'),
				'gallery', 'normal', 'high');
				
		}
		
		public function add_gallery_option_element(){
		
			$gallery_meta_box = $this->gallery_meta_box;
			global $post;
			echo '<div id="cp-overlay-wrapper">';
			
			?> <div class="gallery-option-meta" id="gallery-option-meta"> <?php
			
				//set_nonce();
				
				foreach($gallery_meta_box as $meta_box){
				//echo '<pre>';print_r($meta_box);die;

					if( $meta_box['type'] == 'gallerypicker' ){
					
						$xml_string = get_post_meta($post->ID, $meta_box['xml'], true);
						if( !empty($xml_string) ){

							$xml_val = new DOMDocument();
							$xml_val->loadXML( $xml_string );
							$meta_box['value'] = $xml_val->documentElement;
				
							
						}
						self::print_gallery_picker($meta_box);
						
					}else{
					
						$meta_box['value'] = get_post_meta($post->ID, $meta_box['name'], true);
						print_meta($meta_box);
					
					}				
					
				}
				
			?> 
			<input type="hidden" name="gallery_post" value="gallery">
			</div> <?php
			
			echo '</div>';
			
		}
		
		public function save_gallery_option_meta($post_id){
		
			$gallery_meta_box = $this->gallery_meta_box;
			
			$edit_meta_boxes = $gallery_meta_box;
			
			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
			
			// save
			foreach ($edit_meta_boxes as $edit_meta_box){
			
				// save function for slider
				if( $edit_meta_box['type'] == 'gallerypicker' ){
				
					if(isset($_POST[$edit_meta_box['name']['image']])){
					
						$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;
						
					}else{
					
						$num = -1;
						
					}
					
					if(isset($gallery_post) AND $gallery_post == 'gallery'){
						$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);
						$slider_xml = "<slider-item>";
						
						for($i=0; $i<=$num; $i++){
						
							$slider_xml = $slider_xml. "<slider>";
							$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);
							$slider_xml = $slider_xml. create_xml_tag('image',$image_new);
							$title = stripslashes($_POST[$edit_meta_box['name']['title']][$i]);
							$slider_xml = $slider_xml. create_xml_tag('title',$title);
							$description = stripslashes($_POST[$edit_meta_box['name']['caption']][$i]);
							$slider_xml = $slider_xml. create_xml_tag('caption',$description);
							$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);
							$slider_xml = $slider_xml. create_xml_tag('linktype',$linktype_new);
							$link_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['link']][$i]));
							$slider_xml = $slider_xml. create_xml_tag('link',$link_new);
							$video = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['video']][$i]));
							$slider_xml = $slider_xml. create_xml_tag('video',$video);
							$slider_xml = $slider_xml . "</slider>";
							
						}
						
						$slider_xml = $slider_xml . "</slider-item>";
						function_library::save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);
					}
				}else{
				
					if(isset($_POST[$edit_meta_box['name']])){
					
						$new_data = stripslashes($_POST[$edit_meta_box['name']]);
						
					}else{
					
						$new_data = '';
						
					}
					
					$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
					function_library::save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);
					
				}
				
			}
			
		}

		// gallerypicker => title, name=>array(num,image,title,caption,link)
		public function print_gallery_picker($args){
		
			extract($args);
			global $post;
			//Shortcode Generator
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
								<div id="selected-image-none"><?php _e('No Gallery Items Inserted','mosque_crunchpress');?></div>
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
										<div id="slider-detail" class="slider-detail"> 	<br class="clear">
											<div class="meta-title meta-detail-title"><?php _e('Title', 'mosque_crunchpress'); ?></div> 
											<div class="meta-detail-input meta-input"><input type="text" id='<?php echo $name['title']; ?>' /></div>
											<hr class="separator"><br class="clear">
											<div class="meta-title meta-detail-title"><?php _e('Image Caption', 'mosque_crunchpress'); ?></div>
											<div class="meta-input meta-detail-input"><textarea id='<?php echo $name['caption']; ?>' ></textarea></div><hr class="separator"><br class="clear">
											<div class="meta-title meta-detail-title"><?php _e('Link Type', 'mosque_crunchpress'); ?></div> 
											<div class="meta-input meta-detail-input">
												<div class="combobox">
													<select id='<?php echo $name['linktype']; ?>'>
														<option><?php _e('No Link','mosque_crunchpress');?></option>
														<option selected><?php _e('Lightbox','mosque_crunchpress');?></option>
														<option><?php _e('Link to URL','mosque_crunchpress');?></option>	
														<option><?php _e('Video','mosque_crunchpress');?></option>
													</select>
												</div>
											</div><br class="clear">
											<div class="url">
												<div class="meta-title meta-detail-title" rel="url"><?php _e('URL Path', 'mosque_crunchpress'); ?></div> 
												<div class="meta-input meta-detail-input"><input class="mt10" type="text"  id='<?php echo $name['link']; ?>' /></div><br class="clear">
											</div>
											<div class="video">
												<div class="meta-title meta-detail-title" rel="embed"><?php _e('Video URL', 'mosque_crunchpress'); ?></div> 
												<div class="meta-input meta-detail-input"><input class="mt10" type="text"  id='<?php echo $name['video']; ?>' /></div><br class="clear">
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
														<div class="meta-title meta-detail-title"><?php esc_html_e('Title', 'mosque_crunchpress'); ?></div> 
														<div class="meta-detail-input meta-input"><input type="text" name='<?php echo $name['title']; ?>[]' id='<?php echo $name['title']; ?>[]' value="<?php echo cp_find_xml_value($slider, 'title'); ?>" /></div><br class="clear">
														<hr class="separator">
														<div class="meta-title meta-detail-title"><?php esc_html_e('Image Caption', 'mosque_crunchpress'); ?></div>
														<div class="meta-detail-input meta-input"><textarea name='<?php echo $name['caption']; ?>[]' id='<?php echo $name['caption']; ?>[]' ><?php echo cp_find_xml_value($slider, 'caption'); ?></textarea></div><br class="clear">
														<div class="meta-title meta-detail-title"><?php esc_html_e('Link Type', 'mosque_crunchpress'); ?></div>
														<div class="meta-input meta-detail-input">
															<div class="combobox">
																<?php $linktype_val =  function_library::cp_find_xml_value($slider, 'linktype'); ?>
																<select name='<?php echo $name['linktype']; ?>[]' id='<?php echo $name['linktype']; ?>' >
																	<option <?php echo ($linktype_val == 'No Link')? "selected" : ''; ?> ><?php esc_html_e('No Link', 'mosque_crunchpress'); ?></option>
																	<option <?php echo ($linktype_val == 'Lightbox')? "selected" : ''; ?>><?php esc_html_e('Lightbox', 'mosque_crunchpress'); ?></option>
																	<option <?php echo ($linktype_val == 'Link to URL')? "selected" : ''; ?>><?php esc_html_e('Link to URL', 'mosque_crunchpress'); ?></option>
																	<option <?php echo ($linktype_val == 'Video')? "selected" : ''; ?>><?php esc_html_e('Video', 'mosque_crunchpress'); ?></option>
																</select>
															</div>
														</div>
														<div class="url">
															<div class="meta-title meta-detail-title"><?php esc_html_e('URL Path', 'mosque_crunchpress'); ?></div> 
															<div class="meta-detail-input meta-input ml0 mt5"><input class="" type="text" name='<?php echo $name['link']; ?>[]' id='<?php echo $name['link']; ?>[]' value="<?php echo cp_find_xml_value($slider, 'link'); ?>" /></div>
														</div>
														<br class="clear">
														<div class="video">
															<div id="video" class="meta-title meta-detail-title"><?php esc_html_e('Video URL', 'mosque_crunchpress'); ?></div> 
															<div class="meta-detail-input meta-input"><input class="" type="text" name='<?php echo $name['video']; ?>[]' id='<?php echo $name['video']; ?>[]' value="<?php echo cp_find_xml_value($slider, 'video'); ?>" /></div>
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
								<br class=clear>
								<div id="show-media" class="show-media">
									<span id="show-media-text"></span>
									<div id="show-media-image"></div>
								</div>
							</div>
							<div class="media-image-gallery-wrapper">
							<input class="upload_image_button white_color" type="button" value="Upload" />
								<div class="media-image-gallery" id="media-image-gallery">
									<?php get_media_image(); ?>
									
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