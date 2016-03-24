<?php
//Condition for Parent Class
if(class_exists('function_library')){
	
	add_action( 'plugins_loaded', 'testimonial_override' );
	function testimonial_override() {
		$testi_class = new cp_testi_class;
	}

	class cp_testi_class extends function_library{
		//public $testi_array = array(
		
			// 'image_icon' =>array(

				// 'type'=> 'image',
				
				// 'name'=> 'aa',

				// 'hr'=> 'none',

				// 'description'=> "fa fa-comments"),
			
			// "top-bar-div331-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div331'),	

			// 'header'=>array(

				// 'title'=> 'TESTIMONIAL HEADER TITLE',

				// 'name'=> 'page-option-item-testi-header-title',

				// 'type'=> 'inputtext'),
				
			// 'category'=>array(

				// 'title'=>'CHOOSE CATEGORY',

				// 'name'=>'page-option-category-testi',

				// 'options'=>array(),

				// 'type'=>'combobox_category',

				// 'hr'=> 'none',

				// 'description'=>'Choose the testimonial category you want to fetch the testimonials.'),		
			
			// 'num_excerpt'=>array(

				// 'title'=>'NUMBER OF EXCERPT',

				// 'name'=>'page-option-item-testi-excerpt',

				// 'type'=> 'inputtext',

				// 'default'=> 200,

				// 'description'=>'Number of words to show on each testimonial, leaving black all characters will be displayed.'),
				
			// "top-bar-div331-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div331'),		
			
			// "top-bar-div341-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div341'),	
			
			// 'pagination'=>array(

				// 'title'=>'ENABLE PAGINATION',

				// 'name'=>'page-option-item-testi-pagination',

				// 'type'=> 'combobox',

				// 'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

				// 'hr'=> 'none',

				// 'description'=>'Pagination will only appear when the number of posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),

			// 'num-fetch'=>array(					

				// 'title'=> 'NUM OF TESTIMONIALS',

				// 'name'=> 'page-option-item-testi-num-fetch',

				// 'type'=> 'inputtext',
				
				// 'class'=>'testi-fetch-item',

				// 'default'=> 9,

				// 'description'=>'Set the number of testimonials to display on one page.'),
				
			// "top-bar-div341-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div341'),			


		//);
		
		public $testi_slider_array = array(
		
			'image_icon' =>array(

				'type'=> 'image',
				
				'name'=> 'aa',

				'hr'=> 'none',

				'description'=> "fa fa-smile-o"),
			
			"top-bar-div362-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div362'),
			
			'variation'=>array(

				'title'=>'SELECT VARIATION',

				'name'=>'page-option-item-variation-testi',

				'type'=> 'combobox',

				'options'=>array('0'=>'Layout 1', '1'=>'Layout 2', '2'=>'Layout 3'),

				'hr'=> 'none',

				'description'=>'.'),
				
			'header'=>array(

				'title'=> 'TEAM HEADER TITLE',

				'name'=> 'page-option-testi-slider-header-title',

				'type'=> 'inputtext'),
				
			'category'=>array(

				'title'=>'CHOOSE CATEGORY',

				'name'=>'page-option-category-testi-slider',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the testimonial category you want to fetch the testimonials.'),		
			
			
			
			"top-bar-div362-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div362'),
			
			"top-bar-div361-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div361'),	

			
			'num-fetch'=>array(					

				'title'=> 'NUM OF TESTIMONIALS',

				'name'=> 'page-option-testi-slider-num-fetch',

				'type'=> 'inputtext',
				
				'class'=>'cp-testi-client-fetch-item',

				'default'=> 5,

				'description'=>'Set the number of testimonials to display on one page.'),
				
			"top-bar-div361-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div361'),		


		);
		
		
		public $testi_size_array =  array('element1-1'=>'1/1');		
		public $slider_testi_size_array =  array('element1-1'=>'1/1');		

	
		
		public function page_builder_size_class(){
			global $div_size;
			//$div_size['Testimonial'] = $this->testi_size_array;	  
			$div_size['Client-Slider'] = $this->slider_testi_size_array;	  
		}
		
		public function page_builder_element_class(){
		global $page_meta_boxes;
			//$page_meta_boxes['Page Item']['name']['Testimonial'] = $this->testi_array;
			$page_meta_boxes['Page Item']['name']['Client-Slider'] = $this->testi_slider_array;
			//$page_meta_boxes['Page Item']['name']['Our-Team']['select_feature']['options'] = function_library::get_title_list_array( 'teams' );	
			//$page_meta_boxes['Page Item']['name']['Testimonial']['category']['options'] = function_library::get_category_list_array( 'testimonial-category' );
			$page_meta_boxes['Page Item']['name']['Client-Slider']['category']['options'] = function_library::get_category_list_array( 'testimonial-category' );
			
			

		}
		
		public function __construct(){
			add_action( 'init', array( $this, 'create_testi' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_testi_option' ) );	
			add_action( 'save_post', array( $this, 'save_testimonial_option_meta' ) );	
		}
		
		
		public function create_testi() {
			//$portfolio_translation = get_option(THEME_NAME_S.'_cp_portfolio_slug','portfolio');
			
			$labels = array(
				'name' => _x('Testimonial', 'Testimonial General Name', 'mosque_crunchpress'),
				'singular_name' => _x('Testimonial', 'Event Singular Name', 'mosque_crunchpress'),
				'add_new' => _x('Add New', 'Add New Testimonial Name', 'mosque_crunchpress'),
				'add_new_item' => __('Add New Testimonial', 'mosque_crunchpress'),
				'edit_item' => __('Edit Testimonial', 'mosque_crunchpress'),
				'new_item' => __('New Testimonial', 'mosque_crunchpress'),
				'view_item' => __('View Testimonial', 'mosque_crunchpress'),
				'search_items' => __('Search Testimonial', 'mosque_crunchpress'),
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
				'menu_icon' => 'dashicons-format-quote',
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 100,
				'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
				'has_archive' => true,
				'rewrite' => array('slug' => '', 'with_front' => false)
			  ); 
			  
			register_post_type( 'testimonial' , $args);	

			register_taxonomy(
				"testimonial-category", array("testimonial"), array(
					"hierarchical" => true,
					"label" => "Testimonial Categories", 
					"singular_label" => "Testimonial Categories", 
					"rewrite" => true));
			register_taxonomy_for_object_type('testimonial-category', 'testimonial');			
		}
		
		public function add_testi_option(){	
		
			add_meta_box('testi-option', __('Testimonial Options - Add Icons with their URLs','mosque_crunchpress'),array($this,'add_testimonial_option_element'),
				'testimonial', 'normal', 'high');
				
		}
		
		public function add_testimonial_option_element(){
			
			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
			global $post,$countries;
			
			$designation_text = get_post_meta($post->ID, 'designation_text', true);
		
		?>
			<div class="event_options">		
				<div class="row-fluid">
					<ul class="designation_class recipe_class span12">
						<li class="panel-input">
							<span class="panel-title">
								<h3> <?php esc_html_e('DESIGNATION', 'mosque_crunchpress'); ?> </h3>
							</span>
							<input type="text" name="designation_text" id="designation_text" value="<?php if($designation_text <> ''){echo $designation_text;};?>" />
							<p><?php esc_html_e('Add designation text here.', 'mosque_crunchpress'); ?></p>
						</li>
					</ul>
				</div>			
				<div style="float:left;" class="op-gap add-music">
					<!--my start -->
					<ul class="recipe_class row-fluid cp_bg_image">
						<li class="panel-title time-start span3">
							<h4><i class="fa fa-music"></i> <?php esc_html_e('Icon Name', 'mosque_crunchpress'); ?></h4>
							<input type="text" class="" id="add-track-name" value="e.g. fa fa-lock" rel="Add Field Name">
						</li>

						<li class="panel-title border_left time_end span3">
							<h4><i class="fa fa-link"></i> <?php esc_html_e('Add URL', 'mosque_crunchpress'); ?></h4>
							<!--<input type="text" class="" id="add-track-title" value="Add Track URL" rel="Add Track URL">-->
							<input id="upload_image_text" name="add-track-title" class="clearme" rel="Add Field Data" type="text" value="#" />							
						</li>
						
						<li class="panel-title border_left delete_btn span1">
							<h4><i class="fa fa-minus"></i> / <i class="fa fa-plus"></i></h4>
							<div id="add-more-tracks" class="add-track-element"></div>
						</li>
					</ul>	
					<div class="clear"></div>
					<ul id="selected-element" class="selected-element nut_table_inner">
						<li class="default-element-item" id="element-item">
							<ul class="career_salary_class recipe_class row-fluid">
								<li class="panel-title span3">
									<input class="element-track-name" type="text" id="add-track-name" value="e.g. fa fa-lock" rel="Add Field Name">
									<!--<span class="ingre-item-text"></span>-->
								</li>	
								<li class="panel-title border_left span3">
									<input id="upload_image_text" class="element-track-title" type="text" value="#" rel="Add Field Data" />									
									<!--<input class="element-track-title" type="text" id="add-track-title" value="Add Track URL" rel="Add Track URL">-->
									<!--<span class="ingre-item-text"></span>-->
								</li>								
								<li class="panel-title border_left span1"><span class="panel-delete-element"></span></li>
							</ul>
						</li>
						
					<?php
						//Fetching All Tracks from Database
						$track_name_xml = get_post_meta($post->ID, 'add_icon_xml', true);
						$track_url_xml = get_post_meta($post->ID, 'add_project_field_xml', true);
						
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
					
						
						//Combine Loop
						if($track_name_xml <> '' || $track_url_xml <> ''){
							$counter = 0;
							$nofields = $ingre_xml->documentElement->childNodes->length;
							for($i=0;$i<$nofields;$i++) { 
								$counter++;?>
								<li class="" style="display: block;">
									<ul class="career_salary_class recipe_class row-fluid">
										<li class="panel-title span3">
											<input class="" type="text" name="add-track-name[]" value="<?php echo $children_name->item($i)->nodeValue;?>">
										</li>	
										<li class="panel-title border_left span3">
											<input id="upload_image_text" class="element-track-title" type="text" name="add-track-title[]" value="<?php echo $children_title->item($i)->nodeValue;?>" />											
										</li>
										<li class="panel-title span1 border_left"><span class="panel-delete-element"></span></li>
									</ul>
								</li>
								<?php
							}
						} ?>
					</ul>
				</div>
				<input type="hidden" name="testimonial_submit" value="testimonial"/>
				<div class="clear"></div>
			</div>	
			<div class="clear"></div>
		<?php }
		
		
		public function save_testimonial_option_meta($post_id){
			
	
			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
		
			if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		
				if(isset($testimonial_submit) AND $testimonial_submit == 'testimonial'){
				
					//Saving Sidebar and Social Sharing Settings as XML
					$old_data = get_post_meta($post_id, 'designation_text',true);
					save_meta_data($post_id, $designation_text, $old_data, 'designation_text');
					
					//Track Name
					$add_icon_xml = '<add_icon_xml>';
					if(isset($_POST['add-track-name'])){
						$track_name_item = $_POST['add-track-name'];
						if(isset($track_name_item)){
							foreach($track_name_item as $keys=>$values){
								$add_icon_xml = $add_icon_xml . function_library::create_xml_tag('add_icon_xml',$values);
							}
						}
					}else{$add_icon_xml = '<add_icon_xml>';}
					$add_icon_xml = $add_icon_xml . '</add_icon_xml>';
				
					//Save Post
					$old_data = get_post_meta($post_id, 'add_icon_xml',true);
					function_library::save_meta_data($post_id, $add_icon_xml, $old_data, 'add_icon_xml');
					
					
					//Track URL
					$track_url_item = array();
					$add_project_field_xml = '<add_project_field_xml>';
					if(isset($_POST['add-track-title'])){
						$track_url_item = $_POST['add-track-title'];
						if(is_array($track_url_item)){
							foreach($track_url_item as $keys=>$values){
								$add_project_field_xml = $add_project_field_xml . function_library::create_xml_tag('add_project_field_xml',$values);
							}
						}
					}else{$add_project_field_xml = '<add_project_field_xml>';}
					$add_project_field_xml = $add_project_field_xml . '</add_project_field_xml>';
				
					//Save Post
					$old_data = get_post_meta($post_id, 'add_project_field_xml',true);
					function_library::save_meta_data($post_id, $add_project_field_xml, $old_data, 'add_project_field_xml');
				}
		}

		// Print Testimonial Slider		
		public function print_testimonial_slider($item_xml){
			global $counter;
			$header = cp_find_xml_value($item_xml, 'header');
			$category = cp_find_xml_value($item_xml, 'category');
			$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
			$variation = cp_find_xml_value($item_xml, 'variation');
			
		if($variation == 'Layout 1'){
			if($category == '0'){
				query_posts(
					array( 
					'post_type' => 'testimonial',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}else{
				query_posts(
					array( 
					'post_type' => 'testimonial',
					'posts_per_page' => -1,
					//'ignore_sticky_posts' => true,
					'tax_query' => array(
						array(
							'taxonomy' => 'testimonial-category',
							'terms' => $category,
							'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}
			if ( have_posts() <> "" ) {
				//Bx Slider Script Calling
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
				
				?>
				<div class="causes-testimonials">
					<script type="text/javascript">
					jQuery(document).ready(function ($) {
						"use strict";
						if ($('#testimonial-<?php echo $counter?>').length) {
							$('#testimonial-<?php echo $counter?>').bxSlider({
								// minSlides: 1,
								// maxSlides: 1,
								auto:true
							});
						}
					});
					</script>
					<!--TESTIMONIALS section START-->				
					<ul id="testimonial-<?php echo $counter?>" class="">
						<?php
						while ( have_posts() ): the_post();
						global $post,$post_id;
						$designation_text = get_post_meta($post->ID, 'designation_text', true);
						
						?>
							<li>
								<div class="holder">
									<i class="fa fa-quote-left"></i>
									<p><?php echo substr(esc_attr(get_the_content()),0,279);?></p>
									<?php echo esc_attr($designation_text);?>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
					<!--TESTIMONIALS section END-->
				</div>
		<?php }
		}else if($variation == 'Layout 2'){

		
			if($category == '0'){
				query_posts(
					array( 
					'post_type' => 'testimonial',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}else{
				query_posts(
					array( 
					'post_type' => 'testimonial',
					'posts_per_page' => -1,
					//'ignore_sticky_posts' => true,
					'tax_query' => array(
						array(
							'taxonomy' => 'testimonial-category',
							'terms' => $category,
							'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}
		
					
			if ( have_posts() <> "" ) {
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			?>
			<script type= "text/javascript" >
				jQuery(document).ready(function ($) {
					"use strict";
					if ($('#testi_slider-<?php echo esc_js($counter);?>').length) {
						$('#testi_slider-<?php echo esc_js($counter);?>').bxSlider({
							// minSlides: 1,
							// maxSlides: 1,
							auto:true
						});
					}
				});
			</script>
			<!--TESTIMONIALS ARTICLE START-->
			
			<div class="testimonials testimonials-section">        	
				<?php if($header <> ''){ ?><h2><?php echo esc_attr($header);?></h2><?php }?>
				<ul id="testi_slider-<?php echo $counter;?>">				
					<?php 
					$testi_monial_slider = 0;
					while ( have_posts() ): the_post();global $post,$post_id;
					$designation_text = get_post_meta($post->ID, 'designation_text', true);
					?>
					<!--LIST ITEM START-->
					
					<li>
						<div class="holder">
							<div class="heading-style-1">
								<h2><?php echo esc_attr(get_the_title());?></h2>
							</div>
							<p><?php echo substr(esc_attr(get_the_content()),0,90);?></p>					
							<div class="frame">
								<a href="<?php echo esc_url(get_permalink());?>">
									<?php echo get_the_post_thumbnail($post_id, array(230,160));?>
								</a>
							</div>
							<strong class="title"><?php echo substr(esc_attr(get_the_excerpt()),0,279);?></strong>
							<?php echo esc_attr($designation_text);?>
						</div>
					</li>
					<!--LIST ITEM END-->
					<?php 
					$testi_monial_slider++;
					endwhile; ?>
				</ul>
			</div>
			<!--TESTIMONIALS ARTICLE END-->
		<?php } // If Have Posts 
		}else{
			if($category == '0'){
				query_posts(
					array( 
					'post_type' => 'testimonial',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}else{
				query_posts(
					array( 
					'post_type' => 'testimonial',
					'posts_per_page' => -1,
					//'ignore_sticky_posts' => true,
					'tax_query' => array(
						array(
							'taxonomy' => 'testimonial-category',
							'terms' => $category,
							'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}
		
					
			if ( have_posts() <> "" ) {
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			?>
				<script type="text/javascript">
				jQuery(document).ready(function ($) {
					"use strict";
					if ($('#testi_slider-<?php echo $counter;?>').length) {
						$('#testi_slider-<?php echo $counter;?>').bxSlider({
							minSlides: 1,
							maxSlides: 4,
							slideWidth:545,
							slideMargin:30,
							//auto:true
						});
					}
				});
				</script>
				<!--TESTIMONIALS ARTICLE START-->
				<div class="eco-testimonials-section">        	
					<?php if($header <> ''){ ?><h2><?php echo esc_attr($header);?></h2><?php }?>
					<ul id="testi_slider-<?php echo $counter;?>">				
						<?php 
						$testi_monial_slider = 0;
						while ( have_posts() ): the_post();global $post,$post_id;
						$designation_text = get_post_meta($post->ID, 'designation_text', true);
						?>
						<!--LIST ITEM START-->
						<li>
							<div class="holder">
								<div class="eco-testimonials-box">
									<blockquote> <i class="fa fa-quote-left"></i>
										<p><?php echo substr(esc_attr(get_the_content()),0,90);?></p>
										<div class="frame">
											<a href="<?php echo esc_url(get_permalink());?>">
												<?php echo get_the_post_thumbnail($post_id, array(230,160));?>
											</a>
										</div>
										<?php echo esc_attr($designation_text);?>
									</blockquote>
								</div>
							</div>								
						</li>
						<!--LIST ITEM END-->
						<?php 
						$testi_monial_slider++;
						endwhile; ?>
					</ul>
				</div>
				<!--TESTIMONIALS ARTICLE END-->
			<?php
			}
		}	
		wp_reset_query();
		wp_reset_postdata();
		
		
		
		
		}
		
		// Print Testimonial
		 public function print_testimonial($item_xml){

			 $header = cp_find_xml_value($item_xml, 'header');
			 $category = cp_find_xml_value($item_xml, 'category');
			 $num_excerpt = cp_find_xml_value($item_xml, 'num_excerpt');
			 $pagination = cp_find_xml_value($item_xml, 'pagination');
			 $num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
			 if(!empty($header)){
				 echo '<h2 class="heading">' . $header . '</h2>';
			 }
			
			 if(empty($paged)){
				 $paged = (get_query_var('page')) ? get_query_var('page') : 1; 
			 }
				
			 $args = array(
				 'posts_per_page'			=> $num_fetch,
				 'paged'						=> $paged,
				 'post_type'					=> 'testimonial',
				 'testimonial-category'		=> $category,
				 'post_status'				=> 'publish',
				 'order'						=> 'DESC',
				 );
			 query_posts($args);
			 if ( have_posts() <> "" ) { 
				 echo '<div class="testimonials-list"><ul>';
					 while ( have_posts() ): the_post();
						 echo '
						 <li>
							 <h4>'.esc_attr(get_the_title()).'</h4>
							 <p>'.substr(esc_attr(get_the_content()),0,$num_excerpt).'</p>
						</li>';
					 endwhile;			
				echo '
                     </ul>
                 </div>                
				 ';
			 }
		}
		
	}
}	