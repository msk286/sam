<?php
//Condition for Parent Class
if(class_exists('function_library')){
	
	add_action( 'plugins_loaded', 'timeline_override' );
	function timeline_override() {
		$timeline_class = new cp_timeline_class;
	}

	class cp_timeline_class extends function_library{
		public $timeline_array = array(
		
			'image_icon' =>array(

				'type'=> 'image',
				
				'name'=> 'aa',

				'hr'=> 'none',

				'description'=> "fa fa-clock-o"),
			
			"top-bar-div4541-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div4541'),	

			'header'=>array(

				'title'=> 'TIMELINE HEADER TITLE',

				'name'=> 'page-option-item-timeline-header-title',

				'type'=> 'inputtext'),
				
			'category'=>array(

				'title'=>'CHOOSE CATEGORY',

				'name'=>'page-option-category-timeline',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the Timeline category you want to fetch the Projects.'),		
			
			'num_excerpt'=>array(

				'title'=>'NUMBER OF EXCERPT',

				'name'=>'page-option-item-timeline-excerpt',

				'type'=> 'inputtext',

				'default'=> 200,

				'description'=>'Number of words to show on each project, leaving black default set characters will be displayed.'),
				
			"top-bar-div4541-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div4541'),		
			
			"top-bar-div4351-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div4351'),	
			
			'pagination'=>array(

				'title'=>'ENABLE PAGINATION',

				'name'=>'page-option-item-timeline-pagination',

				'type'=> 'combobox',

				'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

				'hr'=> 'none',

				'description'=>'Pagination will only appear when the number of posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),

			'num-fetch'=>array(					

				'title'=> 'NUM OF PROJECTS',

				'name'=> 'page-option-item-timeline-num-fetch',

				'type'=> 'inputtext',
				
				'class'=>'timeline-fetch-item',

				'default'=> 9,

				'description'=>'Set the number of projects to display on one page.'),
				
			"top-bar-div4351-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div4351'),			


		);	

		public $timeline_gal_array = array(
		
			'image_icon' =>array(

				'type'=> 'image',
				
				'name'=> 'aa',

				'hr'=> 'none',

				'description'=> "fa fa-group"),
			
			"top-bar-div9531-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div9531'),	

			'header'=>array(

				'title'=> 'TIMELINE GALLERY TITLE',

				'name'=> 'page-option-timeline-gal-header-title',

				'type'=> 'inputtext'),
				
			'category'=>array(

				'title'=>'CHOOSE CATEGORY',

				'name'=>'page-option-gal-category-timeline',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the Timeline category you want to fetch the Projects.'),		
				
			"top-bar-div9531-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div9531'),		


		);			
		
		public $timline_size_array =  array('element1-1'=>'1/1');		

	
		
		public function page_builder_size_class(){
			global $div_size;
			$div_size['Timeline'] = $this->timline_size_array;	
			$div_size['Carousel'] = $this->timline_size_array;	

		}
		
		public function page_builder_element_class(){
		global $page_meta_boxes;
			$page_meta_boxes['Page Item']['name']['Timeline'] = $this->timeline_array;	
			$page_meta_boxes['Page Item']['name']['Carousel'] = $this->timeline_gal_array;	

			$page_meta_boxes['Page Item']['name']['Timeline']['category']['options'] = function_library::get_category_list_array( 'timeline-category' );			
			$page_meta_boxes['Page Item']['name']['Carousel']['category']['options'] = function_library::get_category_list_array( 'timeline-category' );			
			
		}
		
		public function __construct(){
			add_action( 'init', array( $this, 'create_timeline' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_timeline_option' ) );	
			add_action( 'save_post', array( $this, 'save_timeline_option_meta' ) );		
		}
		
		
		public function create_timeline() {
			//$portfolio_translation = get_option(THEME_NAME_S.'_cp_portfolio_slug','portfolio');
			
			$labels = array(
				'name' => __('Timeline', 'mosque_crunchpress'),
				'singular_name' => __('Timeline', 'mosque_crunchpress'),
				'add_new' => _x('Add New', 'mosque_crunchpress'),
				'add_new_item' => __('Add New Timeline', 'mosque_crunchpress'),
				'edit_item' => __('Edit Timeline', 'mosque_crunchpress'),
				'new_item' => __('New Timeline', 'mosque_crunchpress'),
				'view_item' => __('View Timeline', 'mosque_crunchpress'),
				'search_items' => __('Search Timeline', 'mosque_crunchpress'),
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
				'menu_icon' => 'dashicons-video-alt',
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 100,
				'supports' => array('title','editor','thumbnail'),
				'has_archive' => true,
				'rewrite' => array('slug' => '', 'with_front' => false)
			  ); 
			  
			register_post_type( 'timeline' , $args);	

			register_taxonomy(
				"timeline-category", array("timeline"), array(
					"hierarchical" => true,
					"label" => "Timeline Categories", 
					"singular_label" => "Timeline Categories", 
					"rewrite" => true));
			register_taxonomy_for_object_type('timeline-category', 'timeline');		

			register_taxonomy(
				"timeline-tag", array("timeline"), array(
					"hierarchical" => false, 
					"label" => "Timeline Tag", 
					"singular_label" => "Timeline Tag", 
					"rewrite" => true));
			register_taxonomy_for_object_type('timeline-tag', 'timeline');			
		}
		
		
	
	public function add_timeline_option(){	
	
		add_meta_box('timeline-option', __('TimeLine Options','mosque_crunchpress'),array($this,'add_timeline_option_element'),
			'timeline', 'normal', 'high');
			
	}
	
	public function add_timeline_option_element(){
		$career_detail_xml = '';
		$career_social = '';
		$sidebar_event = '';
		$right_sidebar_event = '';
		$left_sidebar_event = '';
		$career_city = '';
		$career_salary = '';
		$career_country = '';
		$career_apply = '';
		$date_posted = '';
		$jobs_post_name = '';
		$jobs_post_title = '';
	
	
	
	foreach($_REQUEST as $keys=>$values){
		$$keys = $values;
	}
	global $post,$countries;
	
	
	$sidebars_port = '';
	$right_sidebar_port = '';
	$left_sidebar_port = '';
	$jobs_post_name = get_post_meta($post->ID, 'jobs_post_name', true);
	$jobs_post_title = get_post_meta($post->ID, 'jobs_post_title', true);	
	
	$port_detail_xml = get_post_meta($post->ID, 'port_detail_xml', true);
	if($port_detail_xml <> ''){
		$cp_team_xml = new DOMDocument ();
		$cp_team_xml->loadXML ( $port_detail_xml );
		$sidebars_port = function_library::cp_find_xml_value($cp_team_xml->documentElement,'sidebars_port');
		$right_sidebar_port = function_library::cp_find_xml_value($cp_team_xml->documentElement,'right_sidebar_port');
		$left_sidebar_port = function_library::cp_find_xml_value($cp_team_xml->documentElement,'left_sidebar_port');			
	}
	
	?>
		<div class="event_options">
            <div class="op-gap">
				<?php 
			//Condition for Library
			if(class_exists('function_library')){
			$function_library = new function_library();
				echo $function_library->show_sidebar($sidebars_port,'right_sidebar_port','left_sidebar_port',$right_sidebar_port,$left_sidebar_port);
			}
			?>
			</div>
			<div style="float:left;" class="op-gap add-music">
				<!--my start -->
				<ul class="recipe_class row-fluid cp_bg_image">
					<li class="panel-title time-start span3">
						<h4><i class="fa fa-music"></i> <?php esc_html_e('Field Name', 'mosque_crunchpress'); ?></h4>
						<input type="text" class="" id="add-track-name" value="Add Field Name" rel="Add Field Name">
					</li>

					<li class="panel-title border_left time_end span3">
						<h4><i class="fa fa-link"></i> <?php esc_html_e('Field Data', 'mosque_crunchpress'); ?></h4>
						<input id="upload_image_text" name="add-track-title" class="clearme" rel="<?php esc_html_e('Add Field Data','mosque_crunchpress')?>" type="text" value="<?php esc_html_e('Add Field Data','mosque_crunchpress')?>" />							
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
								<input class="element-track-name" type="text" id="add-track-name" value="Add Field Name" rel="Add Field Name">
								<!--<span class="ingre-item-text"></span>-->
							</li>	
							<li class="panel-title border_left span3">
								<input id="upload_image_text" class="element-track-title" type="text" value="Add Field Data" rel="Add Field Data" />									
								<!--<input class="element-track-title" type="text" id="add-track-title" value="Add Track URL" rel="Add Track URL">-->
								<!--<span class="ingre-item-text"></span>-->
							</li>								
							<li class="panel-title border_left span1"><span class="panel-delete-element"></span></li>
						</ul>
					</li>
					
				<?php
					//Fetching All Tracks from Database
					$track_name_xml = get_post_meta($post->ID, 'add_project_xml', true);
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
			<input type="hidden" name="timeline_submit" value="timeline"/>
			<div class="clear"></div>
		</div>	
	<div class="clear"></div>
		
	<?php }
	
	public function save_timeline_option_meta($post_id){
		
		$career_detail_xml = '';
		$career_social = '';
		$sidebars = '';
		$right_sidebar_port = '';
		$left_sidebar_port = '';
		$date_posted = '';
		$career_city = '';
		$career_country = '';
		$career_apply = '';
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
	
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
	
			if(isset($timeline_submit) AND $timeline_submit == 'timeline'){
			
			$new_data = '<timeline_detail>';
			$new_data = $new_data . function_library::create_xml_tag('sidebars_port',$sidebars);
			$new_data = $new_data . function_library::create_xml_tag('right_sidebar_port',$right_sidebar_port);
			$new_data = $new_data . function_library::create_xml_tag('left_sidebar_port',$left_sidebar_port);
			$new_data = $new_data . '</timeline_detail>';
			//Saving Sidebar and Social Sharing Settings as XML
			$old_data = get_post_meta($post_id, 'timeline_detail_xml',true);
			function_library::save_meta_data($post_id, $new_data, $old_data, 'timeline_detail_xml');
				
			//Track Name
			$add_project_xml = '<add_project_xml>';
			if(isset($_POST['add-track-name'])){
				$track_name_item = $_POST['add-track-name'];
				if(isset($track_name_item)){
					foreach($track_name_item as $keys=>$values){
						$add_project_xml = $add_project_xml . function_library::create_xml_tag('add_project_xml',$values);
					}
				}
			}else{$add_project_xml = '<add_project_xml>';}
			$add_project_xml = $add_project_xml . '</add_project_xml>';
		
			//Save Post
			$old_data = get_post_meta($post_id, 'add_project_xml',true);
			function_library::save_meta_data($post_id, $add_project_xml, $old_data, 'add_project_xml');
			
			
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
		
		
		
		// Print Testimonial item
		public function print_timeline_item($item_xml){

			wp_reset_query();
			global $paged,$sidebar,$team_div_size_num_class,$post,$counter;
			
			if(empty($paged)){
				$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
			}
				
			$category = cp_find_xml_value($item_xml, 'category');
			// get the blog meta value		
			$header = cp_find_xml_value($item_xml, 'header');
			$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
			$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
			if(empty($num_excerpt)){$num_excerpt = '200';}
			
			if(!empty($header)){
				echo '<h2 class="h-style">' . $header . '</h2>';
			}
			echo '
                    <section class="timeline-page">
      <div class="container">
        <div class="even-box">
          <ul>';
				
			
			if($category == '0'){
					query_posts(array(
						'posts_per_page'=> $num_fetch,
						'paged'			=> $paged,
						'post_type'   	=> 'timeline',
						'post_status'	=> 'publish',
						'order'			=> 'DESC',
					));
				}else{
					query_posts(array(
						'posts_per_page'=> $num_fetch,
						'paged'	=> $paged,
						'post_type'   => 'timeline',
						'tax_query' => array(
								array(
									'taxonomy' => 'timeline-category',
									'field' => 'term_id',
									'terms' => $category
								)
						),
						'post_status'      => 'publish',
						'order'						=> 'DESC',
					));
				}
			$counter_team = 0; 
			$counter_team_less = 0; 
			
			while( have_posts() ){
				the_post();
			//Fetching All Tracks from Database
			$track_name_xml = get_post_meta($post->ID, 'add_project_xml', true);
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
			$port_class = '';
			if($counter_team_less % 2 == 0){$less_class= 'margin-less';$item_class="<div class='clear'></div>";}else{$less_class = 'margin-less-2';$item_class="";}$counter_team_less++;
			if($counter_team % 2 == 0){$port_class= 'timeline-first';$item_class="<div class='clear'></div>";}else{$port_class = 'timeline-last';$item_class="";}$counter_team++; 			
			if($counter_team == 1){$less_class = '';}else if($counter_team == 2){$less_class = '';}
			?>
				
				<!--LIST ITEM START-->
				<li class="<?php echo esc_attr($port_class).' '. esc_attr($less_class);?>">
					<div class="frame-outer">
						<div class="frame">
							<a href="<?php echo esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail($post->ID, array(570,300));?></a>
							<div class="caption">
								<h2><?php echo esc_attr(get_the_title());?></h2>
								<p><?php echo strip_tags(do_shortcode(substr(esc_attr(get_the_content()),0,200)));?></p>
							</div>
						</div>
					</div>
					<div class="timeline-round">
						<?php 
						$cp_variable_category = wp_get_post_terms( $post->ID, 'timeline-category');
						$counterr = 0;
						foreach($cp_variable_category as $values){														
						
							if($counterr == 0){
								echo '<strong class="year"><a class="portfolio-tag" href="'.get_term_link(intval($values->term_id),'timeline-category').'">'.$values->name.'</a></strong>';
							}$counterr++;
						}
						?>
					</div>
				</li>
				<!--LIST ITEM START-->
				
				
				
				
		
			<?php
			}
				echo '   </ul>
        </div>
      </div>
    </section>';	
			
		}// End Team Function for Frontend	
		
		public function timeline_slider($item_xml){ 
		
			global $counter;
			$header = cp_find_xml_value($item_xml, 'header');		
			$category = cp_find_xml_value($item_xml, 'category');
			
			wp_reset_query();
			wp_reset_postdata(); 
			
			
			// wp_register_script('cp-flexisel-slider', CP_PATH_URL.'/frontend/js/jquery.flexisel.js', false, '1.0', true);
			// wp_enqueue_script('cp-flexisel-slider');
			?>
			<script>
			 jQuery(document).ready(function ($) {
				"use strict";
				 //Flexslider for Upcoming Evente
				if ($('#flexiselDemo1-<?php $counter?>').length) {
					$("#flexiselDemo1-<?php $counter?>").flexisel({
						visibleItems: 5,
						animationSpeed: 1000,
						autoPlay: false,
						autoPlaySpeed: 3000,
						pauseOnHover: true,
						enableResponsiveBreakpoints: true,
						responsiveBreakpoints: {
							portrait: {
								changePoint: 480,
								visibleItems: 1
							},
							landscape: {
								changePoint: 640,
								visibleItems: 2
							},
							tablet: {
								changePoint: 768,
								visibleItems: 3
							}
						}
					});
				}
			});
			</script>
			<!--Project Timeline Start-->
			<section class="project-timeline">
				<div class="timeline-box">
				  <h3><?php echo esc_attr($header);?></h3>
				  <ul id="flexiselDemo1-<?php $counter?>">
				  <?php
					if($category == '0'){
						query_posts(array(
							'posts_per_page'=> -1,
							'post_type'   	=> 'timeline',
							'post_status'	=> 'publish',
							'order'			=> 'DESC',
						));
						
					}else{
						query_posts(array(
							'posts_per_page'=> -1,
							'post_type'   => 'timeline',
							'tax_query' => array(
									array(
										'taxonomy' => 'timeline-category',
										'field' => 'term_id',
										'terms' => $category
									)
							),
							'post_status'      => 'publish',
							'order'						=> 'DESC',
						));
						
					}
					$counter_product = 0;
					while( have_posts() ){
						the_post();	
						global $post,$post_id;
						$item_color_class = '';
						if($counter_product % 5 == 0){
							$item_color_class = 'color-1';
						}else if($counter_product % 4 == 0){
							$item_color_class = 'color-2';
						}else if($counter_product % 3 == 0){
							$item_color_class = 'color-3';
						}else if($counter_product % 2 == 0){
							$item_color_class = 'color-4';
						}else if($counter_product % 1 == 0){
							$item_color_class = 'color-5';
						}else{
							$item_color_class = 'color-1';
						}$counter_product++; ?>
						<li>
						  <div class="tim-line-container">
							<div class="timeline-head <?php echo esc_attr($item_color_class);?>"><strong class="mnt">
							<?php
								$categories = get_the_terms( $post->ID, 'timeline-category' );
								if($categories <> ''){
									foreach ( $categories as $category ) {
										echo esc_attr($category->name)." ";
									}
								}
							?></strong></div>
							<div class="timeline-frame-outer">
							  <div class="timeline-frame"><a href="<?php echo esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail($post_id, array(150,150));?></a></div>
							  <div class="caption">
								<h4><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h4>
								<p><?php echo strip_tags(substr(esc_attr(get_the_content()),0,101));?></p>
							  </div>
							</div>
						  </div>
						</li>
					<?php }// End While Loop?>
				  </ul>
				</div>			  
			</section>
			<!--Project Timeline End--> 
				
				
			<?php
		} //Function Timline gallery Ends
		
	} // Class ends here
}	