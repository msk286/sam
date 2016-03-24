<?php 
/*	
*	CrunchPress Albums Post Type
*	---------------------------------------------------------------------
* 	@version	1.0
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file Contain Custom post type
*	---------------------------------------------------------------------
*/

//Check if the Function Library Parent Class exists
if(class_exists('function_library')){

	//Calling Widget File
	// include_once('cp_playlist_widget.php'); //Playlist Widget
	// include_once('cp_feature_sermons_widget.php'); //Feature Sermons Widget
	// include_once('cp_radio_widget.php'); //Radio Sermons

	//Sermons Extended Class Start
	class cp_sermons_class extends function_library{
	
		//Sermons Element Array Starts
		public $sermons_array =	array(
		
		
		'image_icon' =>array(

				'type'=> 'image','name'=> '',

				'hr'=> 'none',

				'description'=> "fa fa-bank"),
					
			"top-bar-div17-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div17'),	

			'header'=>array(

				'title'=> 'SERMONS HEADER TITLE',

				'name'=> 'page-option-item-sermons-header-title',

				'type'=> 'inputtext'),
				
				
			'category'=>array(

				'title'=>'CHOOSE SERMONS CATEGORY',

				'name'=>'page-option-item-sermons-category',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the sermons category which sermons posts you want to fetched.'),
			
			'num-excerpt'=>array(					

				'title'=> 'LENGHT OF EXCERPT',

				'name'=> 'page-option-item-sermons-num-excerpt',

				'type'=> 'inputtext',

				'default'=> 100,

				'description'=>'Set the sermons description content character length.'),			
				
			"top-bar-div17-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div17'),	
			
			"top-bar-div18-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div18'),			
			
			'sermon_layout'=>array(

				'title'=>'SERMONS LAYOUT',

				'name'=>'page-option-item-sermons-layout',

				'type'=> 'combobox',

				'options'=>array('0'=>'Grid', '1'=>'Full View'),

				'hr'=> 'none',

				'description'=>'Select sermon layout from here, Grid, Or Full Layout.'),
				
			'pagination'=>array(

				'title'=>'ENABLE PAGINATION',

				'name'=>'page-option-item-sermons-pagination',

				'type'=> 'combobox',

				'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

				'hr'=> 'none',

				'description'=>'Pagination will only appear when the number of sermons posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),
			
			'num-fetch'=>array(					

				'title'=> 'NUMBER OF SERMONS TO SHOW',

				'name'=> 'page-option-item-sermons-num-fetch',

				'type'=> 'inputtext',

				'default'=> 5,
				
				'class'=>'sermons-fetch-item',

				'description'=> 'Set the number of sermons you want to fetch on one page.'),	
				
			"top-bar-div18-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div18'),		

		);
		//Array for Songs of the Week to Print its Elemet in page Builder
		public $featured_pastors = array(
		
			'image_icon' =>array(

				'type'=> 'image','name'=> '',

				'hr'=> 'none',

				'description'=> "icon-pastor"),
				
			"top-bar-div19-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div19'),

			'header'=>array(

				'title'=> 'HEADER TITLE',

				'name'=> 'page-option-featured-pastor-title',

				'type'=> 'inputtext'),
				
			'category'=>array(

				'title'=>'CHOOSE CATEGORY',

				'name'=>'page-option-featured-pastor-category',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the category you want the pastor/sermons to be fetched.'),
				
			"top-bar-div19-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div19'),
				
		);
		
		//Array for Newest Sermons to Print its Elemet in page Builder
		public $latest_sermons = array(
		
		'image_icon' =>array(

				'type'=> 'image','name'=> '',

				'hr'=> 'none',

				'description'=> "fa fa-bank"),
				
			"top-bar-div20-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div20'),	

			'header'=>array(

				'title'=> 'SERMONS HEADER TITLE',

				'name'=> 'page-option-latest-sermon-title',

				'type'=> 'inputtext'),
				
			'category'=>array(

				'title'=>'CHOOSE CATEGORY',

				'name'=>'page-option-newest-sermon-category',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the category you want the latest sermon to be fetched.'),
				
			'style'=>array(

				'title'=>'Select Style',

				'name'=>'page-option-item-sermons-style',

				'type'=> 'combobox',

				//'options'=>array('0'=>'Church', '1'=>'Islamic'),
				'options'=>array('0'=>'Islamic'),				
				'hr'=> 'none',

				'description'=>'Select Style Of The Element.'),

			"top-bar-div20-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div20'),
		);
		
		//Array for Newest Sermons to Print its Elemet in page Builder
		public $pastor_gallery = array(
		
		'image_icon' =>array(

				'type'=> 'image','name'=> '',

				'hr'=> 'none',

				'description'=> "icon-sermons"),
				
			"top-bar-div120-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div120'),	

			'header'=>array(

				'title'=> 'PASTORS GALLERY HEADER TITLE',

				'name'=> 'page-option-gal-pastor-title',

				'type'=> 'inputtext'),
				
			'category'=>array(

				'title'=>'CHOOSE CATEGORY',

				'name'=>'page-option-gal-pastor-category',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the category you want the sermons/pastors to be fetched.'),
				
			'num-fetch'=>array(					

				'title'=> 'NUMBER OF SERMONS TO SHOW',

				'name'=> 'page-option-sermons-num-fetch',

				'type'=> 'inputtext',

				'default'=> 5,
				
				'class'=>'sermons-fetch-music',

				'description'=> 'Set the number of sermons you want to fetch on one page.'),		

			"top-bar-div120-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div120'),
		);
		
		
		//Array for Songs of the Week to Print its Elemet in page Builder
		public $sermons_of_week = array(
		
		
		'image_icon' =>array(

				'type'=> 'image','name'=> '',

				'hr'=> 'none',

				'description'=> "icon-sermons"),
				
			"top-bar-div21-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div21'),	

			'header'=>array(

				'title'=> 'HEADER TITLE',

				'name'=> 'page-option-sermons-title',

				'type'=> 'inputtext'),
				
			'song_title'=>array(

				'title'=>'CHOOSE SERMONS',

				'name'=>'page-option-sermons-category',

				'options'=>array(),

				'type'=>'combobox_post',

				'hr'=> 'none',

				'description'=>'Choose the sermons you want to be fetched.'),	
			
			"top-bar-div21-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div21'),	
		);
		//Sermons Element Array Ends
		
		
		//Size Elements Array Starts
		public $sermons_size_array = array('element1-1'=>'1/1', 'element2-3'=>'2/3' );
			
		//Size Elements Array Starts
		public $sermons_newest_array = array('element1-1'=>'1/1',);
		
		public $pastors_size_array = array('element1-1'=>'1/1');	
		
		public $pastorgal_size_array = array('element2-3'=>'2/3','element1-1'=>'1/1');	
		
		public $sermons_song_size_array = array('element1-2'=>'1/2');	
		//Size Elements Array Ends
		
		//Adding Size Array to page Builder Element
		public function page_builder_size_class(){
		global $div_size;
			$div_size['Sermons'] = $this->sermons_size_array;	  
			//$div_size['Pastors'] = $this->pastors_size_array;	  
			//$div_size['Single-Sermon'] = $this->sermons_song_size_array;	
			$div_size['Latest-Sermon'] = $this->sermons_newest_array;	
			//$div_size['Pastor-Gallery'] = $this->pastorgal_size_array;
		}
		
		//Adding Albums Element to Page Builder
		public function page_builder_element_class(){
		global $page_meta_boxes;
		  $page_meta_boxes['Page Item']['name']['Sermons'] = $this->sermons_array;
		  // $page_meta_boxes['Page Item']['name']['Pastors'] = $this->featured_pastors;
		  $page_meta_boxes['Page Item']['name']['Latest-Sermon'] = $this->latest_sermons;
		  // $page_meta_boxes['Page Item']['name']['Pastor-Gallery'] = $this->pastor_gallery;
		  
		  
		  $page_meta_boxes['Page Item']['name']['Sermons']['category']['options'] = function_library::get_category_list_array( 'sermons-category' );
		  // $page_meta_boxes['Page Item']['name']['Pastors']['category']['options'] = function_library::get_category_list_array( 'sermons-category' );
		  $page_meta_boxes['Page Item']['name']['Latest-Sermon']['category']['options'] = function_library::get_category_list_array( 'sermons-category' );
		  // $page_meta_boxes['Page Item']['name']['Pastor-Gallery']['category']['options'] = function_library::get_category_list_array( 'sermons-category' );
		 // $page_meta_boxes['Top Slider Sermons']['options'] = function_library::get_title_list_array( 'sermons' );
		  
		  // $page_meta_boxes['Page Item']['name']['Single-Sermons'] = $this->sermons_of_week;
		  // $page_meta_boxes['Page Item']['name']['Single-Sermons']['sermons_title']['options'] = function_library::get_title_list_array( 'sermons' );
		}
		
		//Adding Add Action Hook Start of Class
		public function __construct(){
			add_action( 'init', array( $this, 'create_sermons' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_sermons_option' ) );
			add_action( 'save_post', array( $this, 'save_sermons_option_meta' ) );
			
			//Add Action Hook to Submit query
			add_action('wp_ajax_nopriv_post-like', array( $this, 'post_like'));
			add_action('wp_ajax_post-like', array( $this, 'post_like'));
			
			add_action('wp_ajax_nopriv_update_rating', array( $this, 'update_rating'));
			add_action('wp_ajax_update_rating', array( $this, 'update_rating'));
		}

		
		//Create Albums	
		public function create_sermons() {
			
			$labels = array(
				'name' => _x('Islamic Teachings', 'Islamic Teachings General Name', 'mosque_crunchpress'),
				'singular_name' => _x('Islamic Teachings Item', 'Islamic Teaching Singular Name', 'mosque_crunchpress'),
				'add_new' => _x('Add New', 'Add New Islamic Teaching Name', 'mosque_crunchpress'),
				'add_new_item' => __('Add New Islamic Teaching', 'mosque_crunchpress'),
				'edit_item' => __('Edit Islamic Teaching', 'mosque_crunchpress'),
				'new_item' => __('New Islamic Teaching', 'mosque_crunchpress'),
				'view_item' => __('View Islamic Teaching', 'mosque_crunchpress'),
				'search_items' => __('Search Islamic Teachings', 'mosque_crunchpress'),
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
				'menu_icon' => 'dashicons-book',
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 100,
				'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields'),
				'rewrite' => array('slug' => 'sermons', 'with_front' => false)
			  ); 
			  
			register_post_type( 'sermons' , $args);
			
			register_taxonomy(
				"sermons-category", array("sermons"), array(
					"hierarchical" => true,
					"label" => "Islamic Teachings Categories", 
					"singular_label" => "Islamic Teachings Categories", 
					"rewrite" => true));
			register_taxonomy_for_object_type('sermons-category', 'sermons');
			
			register_taxonomy(
				"sermons-tag", array("sermons"), array(
					"hierarchical" => false, 
					"label" => "Islamic Teaching Tag", 
					"singular_label" => "Islamic Teachings Tag", 
					"rewrite" => true));
			register_taxonomy_for_object_type('sermons-tag', 'sermons');
			
		}
		
		
		//Extra Field Area Added in Sermons
		public function add_sermons_option(){	
		
			add_meta_box('event-option', __('Islamic Teachings Options','mosque_crunchpress'), array($this,'add_sermons_option_element'),
				'sermons', 'normal', 'high');
				
		}

		//Sermons Extra Fields and Form
		public function add_sermons_option_element(){
		
			//Empty Variables
			$event_detail_xml = '';
			$event_social = '';
			$sidebar_event = '';
			$right_sidebar_event = '';
			$left_sidebar_event = '';
			$event_thumbnail = '';
			$video_url_type = '';
			$select_slider_type = '';
			$amazon_url_type = '';
			$itune_url_type = '';
			$soundcloud_url_type = '';
			
			//All Request Convert into Variable
			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
			
			global $post,$post_id;
			//Fetching Sermons Detail extra field values
			$sermons_detail_xml = get_post_meta($post->ID, 'sermons_detail_xml', true);
			if($sermons_detail_xml <> ''){
				$cp_sermons_xml = new DOMDocument ();
				$cp_sermons_xml->loadXML ( $sermons_detail_xml );
				$event_social = cp_find_xml_value($cp_sermons_xml->documentElement,'event_social');
				$sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'sidebar_event');
				$left_sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'left_sidebar_event');
				$right_sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'right_sidebar_event');
				$video_url_type = cp_find_xml_value($cp_sermons_xml->documentElement,'video_url_type');
				$soundcloud_url_type = cp_find_xml_value($cp_sermons_xml->documentElement,'soundcloud_url_type');
			}
		?>
			<div class="event_options bootstrap_admin " id="event_backend_options" >
                <div class="op-gap"><!--my start -->
					<ul class="event_social_class recipe_class row-fluid">
						<li class="panel-input span12">
							<div>
								<h3 for="event_social" > <?php _e('SOCIAL NETWORKING', 'mosque_crunchpress'); ?> </h3>
							</div>	
							<label for="event_social"><div class="checkbox-switch <?php
							
							echo ($event_social=='enable' || ($event_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

						?>"></div></label>
						<input type="checkbox" name="event_social" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="event_social" id="event_social" class="checkbox-switch" value="enable" <?php 
							
							echo ($event_social=='enable' || ($event_social=='' && empty($default)))? 'checked': ''; 
						
						?>>
						<p><?php _e('You can turn On/Off social sharing from event detail.','mosque_crunchpress'); ?></p>
						</li>
					</ul>
					<div class="clear"></div>
					<?php echo function_library::show_sidebar($sidebar_event,'right_sidebar_event','left_sidebar_event',$right_sidebar_event,$left_sidebar_event);?>
					<div class="clear"></div>
					<div class="row-fluid">
						<!--<ul class="recipe_class span4">
							<li class="panel-input">	
								<div class="panel-title">
									<h3 for="event_thumbnail"><?php _e('Select Type', 'mosque_crunchpress'); ?></h3>
								</div>
								<div class="combobox">
									<select name="event_thumbnail" id="event_thumbnail">
										<option class="Image" value="Image" <?php if( $event_thumbnail == 'Image' ){ echo 'selected'; }?>>Feature Image</option>
										<option class="Video" value="Video" <?php if( $event_thumbnail == 'Video' ){ echo 'selected'; }?>>Video</option>
										<option class="Slider" value="Slider" <?php if( $event_thumbnail == 'Slider' ){ echo 'selected'; }?>>Slider</option>
									</select>
								</div>
								<p><?php _e('Please select your post type of content.', 'mosque_crunchpress'); ?></p>
							</li>
						</ul>
						<ul class="video_class recipe_class span4">
							<li class="panel-input">
								<div class="panel-title">
									<label for="video_url_type" > <?php _e('Video URL', 'mosque_crunchpress'); ?> </label>
								</div>				
								<input type="text" name="video_url_type" id="video_url_type" value="<?php if($video_url_type <> ''){echo $video_url_type;};?>" />
								<p><?php _e('Please paste Youtube or Vimeo url.', 'mosque_crunchpress'); ?></p>
							</li>
						</ul>
						<ul class="select_slider_option recipe_class span4">
							<li class="panel-input">	
								<div class="panel-title">
									<label for="event_thumbnail"><?php _e('Select Images Slide', 'mosque_crunchpress'); ?></label>
								</div>
								<div class="combobox">
									<select name="select_slider_type" id="select_slider_type">
										<?php foreach( function_library::get_title_list_array('cp_slider') as $values){?>
											<option value="<?php echo $values->ID;?>" <?php if($select_slider_type == $values->ID){echo 'selected';}?>><?php echo $values->post_title;?></option>
										<?php }?>
									</select>
								</div>
								<p><?php _e('Please select slide to show in post.', 'mosque_crunchpress'); ?></p>
							</li>
						</ul>-->
					</div>
                </div><!--my end -->
				
				<ul class="recipe_class top-bg">
					<li><h2><?php _e('Islamic Video and SoundCloud URL', 'mosque_crunchpress'); ?></h2></li>
				</ul>
                
                <div class="op-gap row-fluid"><!--my start -->                
					<ul class="recipe_class span6">
						<li class="panel-input">
							<div class="panel-title">
								<h3 for="video_url_type" > <?php _e('Video', 'mosque_crunchpress'); ?> </h3>
							</div>
							<input type="text" name="video_url_type" id="video_url_type" value="<?php if($video_url_type <> ''){echo $video_url_type;};?>" />
							<p><?php _e('Please paste video URL here.', 'mosque_crunchpress'); ?></p>
						</li>
					</ul>
					<ul class="recipe_class span6">
						<li class="panel-input">
							<div class="panel-title">
								<h3 for="soundcloud_url_type" > <?php _e('Sound Cloud', 'mosque_crunchpress'); ?> </h3>
							</div>				
							<input type="text" name="soundcloud_url_type" id="soundcloud_url_type" value="<?php if($soundcloud_url_type <> ''){echo $soundcloud_url_type;};?>" />
							<p><?php _e('Please add islamic ID here For example https://api.soundcloud.com/tracks/142314548 add only numbers (142314548).', 'mosque_crunchpress'); ?></p>
						</li>
					</ul>
				</div> 
				<ul class="recipe_class top-bg">
					<li><h2><?php _e('Islamic Teachings', 'mosque_crunchpress'); ?></h2></li>
				</ul>
                <div class="op-gap add-music">
                
					<!--my start -->
					<ul class="recipe_class row-fluid">
						<li class="panel-title time-start span3">
							<h4><i class="fa fa-music"></i> <?php _e('Track Name', 'mosque_crunchpress'); ?></h4>
							<input type="text" class="" id="add-track-name" value="Add Track Name" rel="Add Track Name">
						</li>

						<li class="panel-title border_left time_end span3 op-upload">
							<h4><i class="fa fa-link"></i> <?php _e('Track URL', 'mosque_crunchpress'); ?></h4>
							<!--<input type="text" class="" id="add-track-title" value="Add Track URL" rel="Add Track URL">-->
							<input name="add-track-title" id="upload_image_text" class="clearme upload_image_text" type="text" value="Add Track URL" />
							<input class="upload_image_button" type="button" value="Add Track" />
						</li>

						<li class="panel-title border_left desc_start span3">
							<h4><i class="fa fa-file-text"></i> <?php _e('Lyrics', 'mosque_crunchpress'); ?></h4>
							<textarea id="add-track-desc" value="Enter Description here" rel="Enter description here" col="5"><?php _e('Add Lyrics Here','mosque_crunchpress');?></textarea>
						</li>

						<li class="panel-title border_left desc_start span2">
							<h4><i class="fa fa-download"></i> <?php _e('Download', 'mosque_crunchpress'); ?></h4>
							<div class="combobox">
								<select id="album_download">
									<option><?php _e('Yes','mosque_crunchpress');?></option>
									<option selected><?php _e('No','mosque_crunchpress');?></option>
								</select>
							</div>
						</li>

						<li class="panel-title border_left delete_btn span1">
							<h4><i class="fa fa-minus"></i> / <i class="fa fa-plus"></i> <?php _e('', 'mosque_crunchpress'); ?></h4>
							<div id="add-more-tracks" class="add-track-element"></div>
						</li>
					</ul>	
                
                
                
					<div class="clear"></div>
					<ul id="selected-element" class="selected-element nut_table_inner">
						<li class="default-element-item" id="element-item">
							<ul class="career_salary_class recipe_class row-fluid">
								<li class="panel-title span3">
									<input class="element-track-name" type="text" id="add-track-name" value="Add Track Name" rel="Add Track Name">
									<!--<span class="ingre-item-text"></span>-->
								</li>	
								<li class="panel-title border_left span3">
									<input id="upload_image_text" class="element-track-title upload_image_text" type="text" value="Add Track URL" />
									<input class="upload_image_button" type="button" value="Add Track" />
									<!--<input class="element-track-title" type="text" id="add-track-title" value="Add Track URL" rel="Add Track URL">-->
									<!--<span class="ingre-item-text"></span>-->
								</li>								
								<li class="panel-title border_left span3">
									<textarea class="element-track-desc" id="add-track-desc" rel="Add Lyrics Here" col="5"></textarea>
									<!--<span class="ingre-item-text"></span>-->
								</li>
								<li class="panel-title  border_left span2">
									<div class="combobox">
										<select class="element-track-download" id="album_download">
											<option><?php _e('Yes','mosque_crunchpress');?></option>
											<option selected><?php _e('No','mosque_crunchpress');?></option>
										</select>
									</div>
								</li>
								<li class="panel-title border_left span1"><span class="panel-delete-element"></span></li>
							</ul>
						</li>
                        
					<?php
						//Fetching All Tracks from Database
						$track_name_xml = get_post_meta($post->ID, 'track_name_xml', true);
						$track_url_xml = get_post_meta($post->ID, 'track_url_xml', true);
						$track_des_xml = get_post_meta($post->ID, 'track_des_xml', true);
						$track_down_xml = get_post_meta($post->ID, 'track_down_xml', true);
						
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
											<input id="upload_image_text" class="element-track-title upload_image_text" type="text" name="add-track-title[]" value="<?php echo $children_title->item($i)->nodeValue;?>" />
											<input class="upload_image_button" type="button" value="Add Track" />
										</li>								
										<li class="panel-title border_left span3">
											<textarea class="element-item-desc" name="add-track-desc[]" col="5"><?php echo $children_des->item($i)->nodeValue;?></textarea>
										</li>
										<li class="panel-title border_left span2">
											<div class="combobox">
												<select name="album_download[]" id="album_download">
													<option <?php if($children_down->item($i)->nodeValue == 'Yes'){echo 'selected';}?>><?php _e('Yes','mosque_crunchpress');?></option>
													<option <?php if($children_down->item($i)->nodeValue == 'No'){echo 'selected';}?>><?php _e('No','mosque_crunchpress');?></option>
												</select>
											</div>
										</li>
										<li class="panel-title span1 border_left"><span class="panel-delete-element"></span></li>
									</ul>
								</li>
								<?php
							}
						} ?>
					</ul>
				</div>
				<div class="clear"></div>
				<input type="hidden" name="sermons_submit" value="sermons"/>
				<div class="clear"></div>
			</div>	
			<div class="clear"></div>
			
		<?php }
	
	//Save Album Function
	public function save_sermons_option_meta($post_id){
		
		//Empty Variables
		$event_social = '';
		$sidebars = '';
		$right_sidebar_event = '';
		$left_sidebar_event = '';
		$event_detail_xml = '';
		$amazon_url_type = '';
		$itune_url_type = '';
		$soundcloud_url_type = '';
		$event_thumbnail = '';
		$video_url_type = '';
		$select_slider_type = '';
		//Empty Variables

		//Fetch All Variables
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
		

		//Autosave
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		
		//If Request Get Album Save these data
		if(isset($sermons_submit) AND $sermons_submit == 'sermons'){
			$new_data = '<sermon_detail>';
			$new_data = $new_data . function_library::create_xml_tag('event_social',$event_social);
			$new_data = $new_data . function_library::create_xml_tag('sidebar_event',$sidebars);
			$new_data = $new_data . function_library::create_xml_tag('right_sidebar_event',$right_sidebar_event);
			$new_data = $new_data . function_library::create_xml_tag('left_sidebar_event',$left_sidebar_event);
			$new_data = $new_data . function_library::create_xml_tag('video_url_type',$video_url_type);
			$new_data = $new_data . function_library::create_xml_tag('soundcloud_url_type',$soundcloud_url_type);
			$new_data = $new_data . '</sermon_detail>';
			//Saving Sidebar and Social Sharing Settings as XML
			$old_data = get_post_meta($post_id, 'sermons_detail_xml',true);
			function_library::save_meta_data($post_id, $new_data, $old_data, 'sermons_detail_xml');
		
			//Track Name
			$track_name_xml = '<add_track_xml>';
			if(isset($_POST['add-track-name'])){
				$track_name_item = $_POST['add-track-name'];
				if(isset($track_name_item)){
					foreach($track_name_item as $keys=>$values){
						$track_name_xml = $track_name_xml . function_library::create_xml_tag('track_name_xml',$values);
					}
				}
			}else{$track_name_xml = '<add_track_xml>';}
			$track_name_xml = $track_name_xml . '</add_track_xml>';
		
			//Save Post
			$old_data = get_post_meta($post_id, 'track_name_xml',true);
			function_library::save_meta_data($post_id, $track_name_xml, $old_data, 'track_name_xml');
			
			
			//Track URL
			$track_url_xml = '<add_url_xml>';
			if(isset($_POST['add-track-title'])){$track_url_item = $_POST['add-track-title'];
				if($track_url_item <> ' '){
					foreach($track_url_item as $keys=>$values){
						$track_url_xml = $track_url_xml . function_library::create_xml_tag('track_url_xml',$values);
					}
				}
			}else{$track_url_xml = '<add_url_xml>';}
			$track_url_xml = $track_url_xml . '</add_url_xml>';
		
			//Save Post
			$old_data = get_post_meta($post_id, 'track_url_xml',true);
			function_library::save_meta_data($post_id, $track_url_xml, $old_data, 'track_url_xml');
			
			//Track Description
			$track_des_xml = '<add_track_des_xml>';
			if(isset($_POST['add-track-desc'])){$track_des_item = $_POST['add-track-desc'];
				if($track_des_item <> ''){
					foreach($track_des_item as $keys=>$values){
						$track_des_xml = $track_des_xml . function_library::create_xml_tag('track_des_xml',$values);
					}
				}
			}else{$track_des_xml = '<add_track_des_xml>';}
			$track_des_xml = $track_des_xml . '</add_track_des_xml>';
		
			//Save Post
			$old_data = get_post_meta($post_id, 'track_des_xml',true);
			function_library::save_meta_data($post_id, $track_des_xml, $old_data, 'track_des_xml');
			
			
			//Track Download Button
			$track_down_xml = '<add_track_button_xml>';
			if(isset($_POST['album_download'])){$track_btn_item = $_POST['album_download'];
				if($track_btn_item <> ''){
					foreach($track_btn_item as $keys=>$values){
						$track_down_xml = $track_down_xml . function_library::create_xml_tag('track_down_xml',$values);
					}
				}
			}else{$track_down_xml = '<add_track_button_xml>';}
			$track_down_xml = $track_down_xml . '</add_track_button_xml>';
		
			//Save Post
			$old_data = get_post_meta($post_id, 'track_down_xml',true);
			function_library::save_meta_data($post_id, $track_down_xml, $old_data, 'track_down_xml');

		}
	}
	
	
		
	//Sermons of the Week Start
	public function print_sermons_latest_item($item_xml){ 
		global $counter;
		
		//Fetching the Values
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$sermons_title = cp_find_xml_value($item_xml, 'sermons_title');
		$style = cp_find_xml_value($item_xml, 'style');
		
		
		if($category == '0'){
			//Popular Post 
			query_posts(
				array( 
					'post_type' => 'sermons',
					'posts_per_page' => 1,
					'orderby' => 'date',
					'order' => 'DESC'
				)
			);
		}else{
			//Popular Post 
			query_posts(
				array( 
				'post_type' => 'sermons',
				'posts_per_page' => 1,
				'tax_query' => array(
					array(
						'taxonomy' => 'sermons-category',
						'terms' => $category,
						'field' => 'term_id',
					)
				),				
				'orderby' => 'date',
				'order' => 'DESC' )
			);
		}
		
		$counter_one = 0;
		if( have_posts() ){
			while( have_posts() ){
			the_post();
			global $post,$post_id;
			
			//Fetching Sermons Detail extra field values
			$sermons_detail_xml = get_post_meta($post->ID, 'sermons_detail_xml', true);
			if($sermons_detail_xml <> ''){
				$cp_sermons_xml = new DOMDocument ();
				$cp_sermons_xml->loadXML ( $sermons_detail_xml );
				$event_social = cp_find_xml_value($cp_sermons_xml->documentElement,'event_social');
				$sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'sidebar_event');
				$left_sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'left_sidebar_event');
				$right_sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'right_sidebar_event');
				$video_url_type = cp_find_xml_value($cp_sermons_xml->documentElement,'video_url_type');
				$soundcloud_url_type = cp_find_xml_value($cp_sermons_xml->documentElement,'soundcloud_url_type');
			}
			//Fetch All Tracks
			$track_name_xml = get_post_meta($post->ID, 'track_name_xml', true);
			$track_url_xml = get_post_meta($post->ID, 'track_url_xml', true);
			$track_des_xml = get_post_meta($post->ID, 'track_des_xml', true);
			$track_down_xml = get_post_meta($post->ID, 'track_down_xml', true);

			//Get elements by documentElement
			$track_name_array = $this->get_sermons_all_tracks($track_name_xml);
			$track_url_array = $this->get_sermons_all_tracks($track_url_xml);
			$track_lyrics_array = $this->get_sermons_all_tracks($track_des_xml);
			$track_download_array = $this->get_sermons_all_tracks($track_down_xml);

			
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
			<div class="row">
				<div class="col-md-5">
					<div class="text-box">
						<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
						<div class="detail-row">
							<ul>
							  <li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-user"></i><?php echo ucfirst(esc_attr(get_the_author()));?></a></li>
							  <li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>
							</ul>
						</div>
						
						<?php //echo esc_attr(substr(get_the_content(),0,510));?>
						<p>
							<?php //Content with Formatting
								$content = get_the_content();
								$content = apply_filters('the_content', $content);
								$content = str_replace(']]>', ']]&gt;', $content);
								 
								echo $content;
							?>
						</p>
						
						<div class="detail-row">
							<ul>
							  <li>
								<?php 
								$cp_variable_category = wp_get_post_terms( $post->ID, 'sermons-category');
								$counterr = 0;
								foreach($cp_variable_category as $values){
									if($counterr == 0){ echo '<i class="fa fa-book"></i>';}
									$counterr++;
									echo ' <a class="sermon-tag" href="'.get_term_link(intval($values->term_id),'sermons-category').'">'.$values->name.'</a>';
								}
								?>
							  </li>
							  <li>
								<?php
									//Get Post Comment 
									comments_popup_link( __('<i class="fa fa-comments-o"></i>0 Comment','mosque_crunchpress'),
									__('<i class="fa fa-comments-o"></i>1 Comment','mosque_crunchpress'),
									__('<i class="fa fa-comments-o"></i>% Comments','mosque_crunchpress'), '',
									__('<i class="fa fa-comments-o"></i>Comments are off','mosque_crunchpress') );										
								?>
								</li>
							  <li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-heart"></i><?php echo get_post_meta($post->ID,'popular_post_views_count',true);?></a></li>
							</ul>
						</div>
						
						
						<?php if($style == 'Islamic'){
							$custom_class = 'player-btn-row-2';
						}else {
							$custom_class = 'player-btn-row';
						}?>
						
						<div class="<?php echo $custom_class;?>">
							<ul>
								<?php if($video_url_type <> ''){ ?>
								<li><a  data-rel="prettyPhoto[gallery1]" rel="prettyPhoto[gallery1]" href="<?php echo $video_url_type;?>"><i class="fa fa-video-camera"></i></a></li><?php }?>
								<li><a id="no-active-list-btn-play-cp" class="cp-play-list-track"><i class="fa fa-headphones"></i></a></li>
								<li><a id= "latest_sermon_lyrics" data-rel="prettyPhoto[inline]" href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-file-text-o"></i></a></li>
								<li><a href="<?php echo $children_title->item(0)->nodeValue;?>"><i class="fa fa-arrow-circle-down"></i></a></li>
								<li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-share-square-o"></i></a></li>
							</ul>
							<?php if(!empty($track_lyrics_array)){ ?>
							<div id="lyrics" class="cp_lyrics hide">
									<h3><?php esc_attr_e('Lyrics','mosque_crunchpress');?></h3>
									<p><?php echo esc_attr($track_lyrics_array->item(0)->nodeValue);?></p>
							</div>
							<?php }?>
						</div>
						<?php if(!empty($track_url_array)){ ?>
							<div class="cp-audio-naat soundcloud-sermon-box">
								<?php echo do_shortcode('[audio mp3="'.esc_url($track_url_array->item(0)->nodeValue).'"][/audio]');?>
							</div>
						<?php }?>
						<?php if($soundcloud_url_type <> ''){ ?>
								<div class="soundcloud-sermon-box">
									<?php echo do_shortcode('[soundcloud type="visual-embed" url="https://api.soundcloud.com/tracks/'.$soundcloud_url_type.'" color="#1e73be" auto_play="false" hide_related="true" show_artwork_or_visual="true" width="100%" height="200" iframe="true" /]');?>
								</div>
							<?php }?>
						<?php 
							if($style == 'Islamic'){
								$custom_class_btn = 'btn-9';
							}else {
								$custom_class_btn = 'btn-3';
							}
						?>
						<a class="<?php echo $custom_class_btn;?>" href="<?php echo esc_url(get_permalink($post->ID))?> "><?php _e('View More Naats','mosque_crunchpress');?></a>
					</div>
				</div>
				<div class="col-md-7">
					<div class="frame">
						<a href="<?php echo get_permalink();?>">
							<?php 
								if($video_url_type <> ''){
									echo do_shortcode('[vimeo width="614" height="614"]'.$video_url_type.'[/vimeo]');
								}else{
									echo get_the_post_thumbnail($post_id, array(614,614));
								}
							?>
						</a>
					</div>
				</div>
			</div>
			
			<?php
			}
			wp_reset_postdata();
		}wp_reset_query();
		
		if( cp_find_xml_value($item_xml, "pagination") == "Theme-Custom" ){	
				echo '<div class="paging">';
							pagination();
				echo '</div>';
		}
		
	}

	//Newest Album Section
	public function print_newest_sermons_item($item_xml){
		
		global $counter,$post,$post_id;
		
		$header = cp_find_xml_value($item_xml, 'header');
		$category_sermons = cp_find_xml_value($item_xml, 'category');
		//Bx Slider Script Calling
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');?>
		<script type="text/JavaScript">
		jQuery(document).ready(function ($) {
			"use strict";
			if ($('#newest-<?php echo $counter?>').length) {
				$('#newest-<?php echo $counter?>').bxSlider({
					minSlides: 1,
					maxSlides: 1,
					auto:true
				});
			}
		});
		</script>
		<?php if($header <> ''){ ?><h2><?php echo $header;?></h2><?php }?>
		<div class="accordian-list">
			<Section id="newest-<?php echo $counter;?>">
				<?php
				query_posts(array( 
					'post_type' => 'sermons',
					'posts_per_page' => 5,
					'tax_query' => array(
						array(
							'taxonomy' => 'sermons-category',
							'terms' => $category_sermons,
							'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
				$counter_one = 0;
				while( have_posts() ){
					the_post();	?>
					<div class="slide">
						<a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail($post_id, array(350,350));?></a>
						<div class="img-cap">
							<h3><?php echo get_the_title();?></h3>
							<strong><?php //echo get_the_expert();?></strong>
						</div>
					</div>
				<?php } //End While loop ?>
			</Section>
		</div>
		<?php
	}
	

	//Newest Album Section
	public function print_gallery_sermons_item($item_xml){
		
		global $counter,$post,$post_id;
		
		$header = cp_find_xml_value($item_xml, 'header');
		$category_sermons = cp_find_xml_value($item_xml, 'category');
		$number_of_sermons = cp_find_xml_value($item_xml, 'num-fetch');
	
		if($header <> ''){ ?>
			<div class="heading-bar2">
				<a>
					<i class="icon-music pull-left"></i>
				</a>
				<strong class="h-title">
					<?php echo $header;?>
				</strong>
				<a id="search-active" class="search_click"><i class="icon-search pull-right"></i></a>
				<div class="search_album page_404">
					<div class="search-header">
						<!--<h2><?php echo __('Search for Sermons or Track','mosque_crunchpress'); ?></h2>-->
						<form class="searchform-default" method="get" id="searchform-album" action="<?php  echo home_url(); ?>/">
							<input  name="s" value="<?php the_search_query(); ?>" placeholder="<?php echo __('Search for Sermons or Track','mosque_crunchpress'); ?>" autocomplete="off" type="text" class="text error-field">
							<button type="submit"><i class="icon-search"></i></button>
						</form>		 
					</div>
				</div>
			</div>
		<?php } ?>		
			<ul class="my-music-list row-fluid">
				<?php 
				//Number of Albums
				if($number_of_sermons == '' || $number_of_sermons == 0){$number_of_sermons = 5;}
				
				//Post Query
				query_posts(
					array( 
					'post_type' => 'sermons',
					'posts_per_page' => $number_of_sermons,
					'tax_query' => array(
						array(
							'taxonomy' => 'sermons-category',
							'terms' => $category_sermons,
							'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
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
						
						//Get elements by documentElement
						$track_name_array = $this->get_album_all_tracks($track_name_xml);
						$track_url_array = $this->get_album_all_tracks($track_url_xml);
						$track_lyrics_array = $this->get_album_all_tracks($track_des_xml);
						$track_download_array = $this->get_album_all_tracks($track_down_xml);
						
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
						
						//JPlayer Scripts
						wp_register_script('cp-jplayer', CP_PATH_URL.'/frontend/js/jquery.jplayer.min.js', false, '1.0', true);
						wp_enqueue_script('cp-jplayer');
						
						wp_register_script('cp-jplayer-playlist', CP_PATH_URL.'/frontend/js/jplayer.playlist.min.js', false, '1.0', true);
						wp_enqueue_script('cp-jplayer-playlist'); 
						
						wp_enqueue_style('cp-music-gallery',CP_PATH_URL.'/frontend/css/music_gallery_player.css');
						
						wp_enqueue_style('album-css-gallery',CP_PATH_URL.'/frontend/css/style_css_album.css');
						
						$cp_album_class = new cp_album_class;
						?>
						
						
					<li class="span4 <?php if($counter_one % 3  ==  0){ echo 'first';}$counter_one++;?>">
						<script type="text/JavaScript">
							jQuery(document).ready(function($) {
								new jPlayerPlaylist({
									jPlayer: "#jquery_jplayer_<?php echo $counter.$album_id;?>",
									cssSelectorAncestor: "#jp_container_<?php echo $counter.$album_id;?>"
								}, [                       
									<?php 
									//Combine Loop
										$img_url_aa = 'http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png';
										if($track_name_xml <> '' || $track_url_xml <> ''){
											$counter_aa = 0;
											$nofields = $ingre_xml->documentElement->childNodes->length;
											for($i=0;$i<$nofields;$i++) {
												echo '{';
												echo 'title:"'.$children_name->item($i)->nodeValue.'",';
												echo 'artist:"'.$children_name->item($i)->nodeValue.'",';
												echo 'mp3:"'.$children_title->item($i)->nodeValue.'",';
												echo 'poster:"'.$img_url_aa.'"';
												echo '},';
											}
										}
									?>
								], 
								{
									playlistOptions: {
										enableRemoveControls: false
									},
									swfPath: "<?php echo CP_PATH_URL?>/frontend/js/Jplayer.swf",
									supplied: "mp3",
									//supplied: "webmv, ogv, m4v, oga, mp3",
									smoothPlayBar: true,
									keyEnabled: true,
									audioFullScreen: true
								});
							});                                                     
						</script>
						
						<div class="flip-container">
							<div class="flipper">
								<div class="front">
									<?php echo get_the_post_thumbnail($album_id, array(570,300));?>
								</div>
								<div class="back" style="background:#121212;">
									<div class="music-detail">
										<a href="<?php echo get_permalink();?>"><em class="song-title"><?php echo get_the_title();?></em></a>
										<figure class="music-gallery">
											<div id="jp_container_<?php echo $counter.$album_id;?>" class="jp-video jp-video-270p">
												<div class="jp-type-playlist">
													<div id="jquery_jplayer_<?php echo $counter.$album_id;?>" class="jp-jplayer"></div>
													<div class="jp-gui">
														<div class="jp-video-play">
															<a href="javascript:;" class="jp-video-play-icon" tabindex="1"><?php _e('play','mosque_crunchpress');?></a>
														</div>
														<div class="jp-interface">
															<div class="jp-progress">
																<div class="jp-seek-bar">
																	<div class="jp-play-bar"></div>
																</div>
															</div>
															<div class="jp-current-time"></div>
															<div class="jp-duration"></div>
															<div class="jp-controls-holder">
																<ul class="jp-controls">
																	<li><a href="javascript:;" class="jp-play" tabindex="1"><?php _e('play','mosque_crunchpress');?></a></li>
																	<li><a href="javascript:;" class="jp-pause" tabindex="1"><?php _e('pause','mosque_crunchpress');?></a></li>
																	<li><a href="javascript:;" class="jp-stop" tabindex="1"><?php _e('stop','mosque_crunchpress');?></a></li>
																	<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute"><?php _e('mute','mosque_crunchpress');?></a></li>
																	<li>
																	<div class="jp-volume-bar">
																	<div class="jp-volume-bar-value"></div>
																</div>
																	</li>
																	<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"><?php _e('unmute','mosque_crunchpress');?></a></li>
																	<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume"><?php _e('max volume','mosque_crunchpress');?></a></li>
																</ul>
																
																<ul class="jp-toggles">
																	<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat"><?php _e('repeat','mosque_crunchpress');?></a></li>
																	<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off"><?php _e('repeat off','mosque_crunchpress');?></a></li>
																</ul>
															</div>
															<div class="cp_title"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></div>
															<div class="jp-title">
																<ul>
																	<li></li>
																</ul>
															</div>
														</div>
													</div>
													<div class="jp-playlist">
														<ul>
															<!-- The method Playlist.displayPlaylist() uses this unordered list -->
															<li></li>
														</ul>
													</div>
													<div class="jp-no-solution">
														<span><?php _e('Update Required','mosque_crunchpress');?></span>
														<?php _e('To play the media you will need to either update your browser to a recent version or update your','mosque_crunchpress');?> <a href="http://get.adobe.com/flashplayer/" target="_blank"><?php _e('Flash plugin','mosque_crunchpress');?></a>.
													</div>
												</div>
											</div>
										</figure>							
									</div>
								</div>
							</div>
						</div>
					</li>
				<?php } //End While loop ?>
			</ul>
		<?php
	}	
		
	public $sermon_div_listing_num_class = array(
		"Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(570, 300), "size2"=>array(350, 350), "size3"=>array(150,150)),
		"Small-Thumbnail" => array("index"=>"2", "class"=>"sixteen", "size"=>array(175,155), "size2"=>array(175,155), "size3"=>array(175,155)));
	
		
	//Newest Album Section
	public function print_sermons_listing_item($item_xml){
		global $counter,$post,$post_id,$paged,$sidebar,$sermon_div_listing_num_class;
		$header = cp_find_xml_value($item_xml, 'header');
		$category_sermons = cp_find_xml_value($item_xml, 'category');
		
		$sermon_layout = cp_find_xml_value($item_xml, 'sermon_layout');
		
		$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
		
		//Pagination Variables
		$pagination = cp_find_xml_value($item_xml, 'pagination');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		
		
		
		//Pagination default wordpress
		if(cp_find_xml_value($item_xml, "pagination") == 'Wp-Default'){
			$num_fetch = get_option('posts_per_page');
		}else if(cp_find_xml_value($item_xml, "pagination") == 'Theme-Custom'){
			$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		}else{}
		
		// Header Title
		if(!empty($header)){echo '<h2 class="h-style">'.$header.'</h2>';} ?>
		
			<?php
			if($category_sermons == '0'){
				//Post Query
				query_posts(
					array( 
					'post_type' => 'sermons',
					'posts_per_page' => $num_fetch,
					'paged'	=>	$paged,
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}else{
				//Post Query
				query_posts(
					array( 
					'post_type' => 'sermons',
					'posts_per_page' => $num_fetch,
					'paged'			=>	$paged,
					'tax_query' => array(
						array(
							'taxonomy' => 'sermons-category',
							'terms' => $category_sermons,
							'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}
			if(have_posts()){
				echo '<div class="sermon-page blog-detail naat-page">
			<ul class="sermon-row">';
			
				$counter_one = 0;
				while( have_posts() ){
					the_post();					
					global $post;				
					
					//Fetching Sermons Detail extra field values
					$sermons_detail_xml = get_post_meta($post->ID, 'sermons_detail_xml', true);
					if($sermons_detail_xml <> ''){
						$cp_sermons_xml = new DOMDocument ();
						$cp_sermons_xml->loadXML ( $sermons_detail_xml );
						$event_social = cp_find_xml_value($cp_sermons_xml->documentElement,'event_social');
						$sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'sidebar_event');
						$left_sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'left_sidebar_event');
						$right_sidebar_event = cp_find_xml_value($cp_sermons_xml->documentElement,'right_sidebar_event');
						$video_url_type = cp_find_xml_value($cp_sermons_xml->documentElement,'video_url_type');
						$soundcloud_url_type = cp_find_xml_value($cp_sermons_xml->documentElement,'soundcloud_url_type');
					}

						//Fetch All Tracks
						$track_name_xml = get_post_meta($post->ID, 'track_name_xml', true);
						$track_url_xml = get_post_meta($post->ID, 'track_url_xml', true);
						$track_des_xml = get_post_meta($post->ID, 'track_des_xml', true);
						$track_down_xml = get_post_meta($post->ID, 'track_down_xml', true);
						
						//Get elements by documentElement
						$track_name_array = $this->get_sermons_all_tracks($track_name_xml);
						$track_url_array = $this->get_sermons_all_tracks($track_url_xml);
						$track_lyrics_array = $this->get_sermons_all_tracks($track_des_xml);
						$track_download_array = $this->get_sermons_all_tracks($track_down_xml);
					if($counter_one % 3 == 0){$item_class = 'first'; $item_div = '<div class="clear"></div>';}else{$item_class = '';$item_div = '';}$counter_one++;
					// if($sermon_layout == 'Grid'){ 
						$item_size = array(360,300);
						// get the item class and size from array
						$item_type = 'Full-Image';
						$item_class = $this->sermon_div_listing_num_class[$item_type]['class'];
						$item_index = $this->sermon_div_listing_num_class[$item_type]['index'];
						if( $sidebar == "no-sidebar" ){
							$item_size = $this->sermon_div_listing_num_class[$item_type]['size'];
						}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
							$item_size = $this->sermon_div_listing_num_class[$item_type]['size2'];
						}else{
							$item_size = $this->sermon_div_listing_num_class[$item_type]['size3'];
							$item_class = 'both_sidebar_class';
						} 
						
						//echo $item_div; ?>
						<li>
							<div class="frame"><a href="<?php echo get_permalink();?>"><?php echo get_the_post_thumbnail($post->ID, array(360,300));?></a></div>
							<div class="text-box">
							  <h3><a href="<?php echo esc_url(get_permalink())?>"><?php echo esc_attr(get_the_title());?></a></h3>
							  <div class="detail-row">
								<ul>
								  <li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
								  <li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>
								  <li>
									<?php 
									$cp_variable_category = wp_get_post_terms( $post->ID, 'sermons-category');
									$counterr = 0;
									foreach($cp_variable_category as $values){
										if($counterr == 0){ echo '<i class="fa fa-book"></i>';}
										$counterr++;
										echo ' <a class="sermon-tag" href="'.get_term_link(intval($values->term_id),'sermons-category').'">'.$values->name.'</a>';
									}
									?>
								  </li>
								 <!--<li>
									<?php
										//Get Post Comment 
										comments_popup_link( __('<i class="fa fa-comments-o"></i>0 Comment','mosque_crunchpress'),
										__('<i class="fa fa-comments-o"></i>1 Comment','mosque_crunchpress'),
										__('<i class="fa fa-comments-o"></i>% Comments','mosque_crunchpress'), '',
										__('<i class="fa fa-comments-o"></i>Comments are off','mosque_crunchpress') );										
									?>
									</li>-->
								  <li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-heart"></i><?php echo get_post_meta($post->ID,'popular_post_views_count',true);?></a></li>
								</ul>
							  </div>
							  <p><?php echo esc_attr(substr(get_the_content(), 0 , $num_excerpt));?></p>
							  <div class="player-btn-row-2">
								<ul>
									<?php if($video_url_type <> ''){ ?><li><a data-rel="prettyphoto" href="<?php echo $video_url_type;?>"><i class="fa fa-video-camera"></i></a></li><?php }?>
									<li><a id="no-active-list-btn-play-cp" class="cp-play-list-track"><i class="fa fa-headphones"></i></a></li>
									<li><a data-rel="prettyPhoto[inline]" href="#lyrics"><i class="fa fa-file-text-o"></i></a></li>
									<li><a href="<?php echo $track_url_array->item(0)->nodeValue;?>"><i class="fa fa-arrow-circle-down"></i></a></li>
									<li><a href="<?php echo esc_url(get_permalink())?>"><i class="fa fa-share-square-o"></i></a></li>
								</ul>
								<?php if(is_array($track_url_array)){ ?>
								<div class="cp-audio-naat">
									<?php echo do_shortcode('[audio mp3="'.$track_url_array->item(0)->nodeValue.'"][/audio]');?>
								</div>
								<?php }?>
								<?php if(!empty($track_lyrics_array)){ ?>
								<div id="lyrics" class="cp_lyrics hide">
									<?php echo $track_lyrics_array->item(0)->nodeValue;?>
								</div>
								<?php }?>
								<!--<?php if($soundcloud_url_type <> ''){ ?>
									<div class="soundcloud-sermon-box">
										<?php echo do_shortcode('[soundcloud type="visual-embed" url="https://api.soundcloud.com/tracks/'.$soundcloud_url_type.'" color="#1e73be" auto_play="false" hide_related="true" show_artwork_or_visual="true" width="100%" height="200" iframe="true" /]');?>
									</div>
								<?php }?>-->
							  </div>
							</div>
						</li>
						<?php //}else{?>
						<?php //}?>
				<?php 
				} //End While loop 
				
			if( cp_find_xml_value($item_xml, "pagination") == "Theme-Custom" ){	
				echo '<div class="paging">';
							pagination();
				echo '</div>';
			}
				
				wp_reset_postdata();
			}wp_reset_query();
			
			
		
			?>
			</ul>
		</div>
		<?php
		
	}
	
	
	//Get All Tracks
	public function get_sermons_all_tracks($track_xml){
			//Track Name
			if($track_xml <> ''){
				$ingre_xml = new DOMDocument();
				$ingre_xml->recover = TRUE;
				$ingre_xml->loadXML($track_xml);
				return $ingre_xml->documentElement->childNodes;
			}		
		}
	
	
	//Print Artist
	public function print_pastor_item_item($item_xml){
		global $counter;
		if(class_exists('cp_album_class')){
			
			$select_layout_cp = '';
			$cp_general_settings = get_option('general_settings');
			if($cp_general_settings <> ''){
				$cp_logo = new DOMDocument ();
				$cp_logo->loadXML ( $cp_general_settings );
				$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
			}
			
			//Initializing Class
			$cp_album_class = new cp_album_class;
			
			//Fetch values from Page Builder
			$header = cp_find_xml_value($item_xml, 'header');
			$category = cp_find_xml_value($item_xml, 'category');
			
			//bx Slider for Artists
			wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
			wp_enqueue_script('cp-bx-slider');	
			wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
			
			wp_register_script('cp-jplayer', CP_PATH_URL.'/frontend/shortcodes/js/jquery.jplayer.min.js', false, '1.0', true);
			wp_enqueue_script('cp-jplayer');		
			
			?>
			<script type="text/JavaScript">
			jQuery(document).ready(function ($) {
				if ($('#slide_element').length) {
					$('#slide_element').bxSlider({
						slideWidth: <?php if($select_layout_cp == 'full_layout'){echo '280';}else{echo '280';}?>,
						minSlides: 1,
						maxSlides: 4,
						slideMargin: <?php if($select_layout_cp == 'full_layout'){echo '17.5';}else{echo '17.5';}?>,
						pager:false,
						auto: true,
						tickerHover:true,
						onSliderLoad: function(){
						}
					});
				}
			});
			</script>
			<div class="featuder-row">
				<h2><?php echo $header;?></h2>
				<section id="slide_element" class="row-fluid slide_element">
					<?php
					if($category == 0){
						//Post Query
						query_posts(
							array( 
							'post_type' => 'sermons',
							'posts_per_page' => 10,
							'orderby' => 'title',
							'order' => 'ASC' )
						);
					
					}else{
						//Post Query
						query_posts(
							array( 
							'post_type' => 'sermons',
							'posts_per_page' => 10,
							'tax_query' => array(
								array(
									'taxonomy' => 'sermons-category',
									'terms' => $category,
									'field' => 'term_id',
								)
							),
							'orderby' => 'title',
							'order' => 'ASC' )
						);
					}
					while( have_posts() ){
					the_post();	
					global $post,$post_id;
					$sermons_id = $post->ID;
					//Fetch All Tracks
					$track_name_xml = get_post_meta($sermons_id, 'track_name_xml', true);
					$track_url_xml = get_post_meta($sermons_id, 'track_url_xml', true);
					$track_des_xml = get_post_meta($sermons_id, 'track_des_xml', true);
					$track_down_xml = get_post_meta($sermons_id, 'track_down_xml', true);
					
					//Get elements by documentElement
					$track_name_array = $this->get_sermons_all_tracks($track_name_xml);
					$track_url_array = $this->get_sermons_all_tracks($track_url_xml);
					$track_lyrics_array = $this->get_sermons_all_tracks($track_des_xml);
					$track_download_array = $this->get_sermons_all_tracks($track_down_xml);?>
					<div class="">
						<div class="item_caro">
							<script type="text/JavaScript">
								//<![CDATA[
								jQuery(document).ready(function($){
									var stream = {
										<?php
											//Loop for Tracks
											if($track_name_xml <> '' || $track_url_xml <> ''){
												$counter_track = 0;
												$nofields = 1;
												for($i=0;$i<$nofields;$i++) {
													$img_url_aa = 'http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png';
													echo 'title:"'.$track_name_array->item($i)->nodeValue.'",';
													echo 'pastor:"'.$track_name_array->item($i)->nodeValue.'",';
													echo 'mp3:"'.$track_url_array->item($i)->nodeValue.'",';
													echo 'poster:"'.$img_url_aa.'"';
												}
											}
										?>
									},
									ready = false;
									$("#jquery_jplayer_<?php echo $sermons_id.$counter;?>").jPlayer({
										ready: function (event) {
											ready = true;
											$(this).jPlayer("setMedia", stream);
										},
										pause: function() {
											$(this).jPlayer("clearMedia");
										},
										error: function(event) {
											if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
												// Setup the media stream again and play it.
												$(this).jPlayer("setMedia", stream).jPlayer("play");
											}
										},
										cssSelectorAncestor: "#jp_container_<?php echo $sermons_id.$counter;?>",
										swfPath: "<?php echo CP_PATH_URL?>/frontend/js/Jplayer.swf",
										supplied: "mp3",
										preload: "none",
										wmode: "window",
										keyEnabled: true
									});									
								});
								//]]>
							</script>
							<div class="artist-box fadeInLeftBig cp_load">
								<div class="frame">
									<?php echo get_the_post_thumbnail($album_id, array(275,290));;?>
								</div>
								<strong class="title"><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></strong>
								<ul class="text-detail">
									<li class="headphone-icon"><span class="font-aw"><i class="icon-headphones"></i></span>
									<a><?php echo $track_name_array->length;?> <?php _e('Sermons','mosque_crunchpress');?></a></li>
									<li class="play-icon">
										<div id="jquery_jplayer_<?php echo $sermons_id.$counter;?>" class="cp_jp-jplayer"></div>
										<div id="jp_container_<?php echo $sermons_id.$counter;?>" class="cp_jp-audio-stream">
											<div class="jp-type-single">
												<div class="jp-gui cp_jp-interface">
													<ul class="cp_jp-controls">
														<li><a href="javascript:;" class="jp-play" tabindex="1"><?php _e('Listen','mosque_crunchpress');?></a></li>
														<li><a href="javascript:;" class="jp-pause" tabindex="1"><?php _e('Pause','mosque_crunchpress');?></a></li>
														<!--<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
														<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
														<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>-->
													</ul>
													<!--<div class="jp-volume-bar">
														<div class="jp-volume-bar-value"></div>
													</div>-->
												</div>
												<!--<div class="jp-title">
													<ul>
														<li>ABC Jazz</li>
													</ul>
												</div>-->
												<div class="jp-no-solution">
													<span><?php echo __('Update Required','mosque_crunchpress'); ?></span>
													<?php echo __('To play the media you will need to either update your browser to a recent version or update your','mosque_crunchpress'); ?> <a href="http://get.adobe.com/flashplayer/" target="_blank"><?php echo __('Flash plugin','mosque_crunchpress'); ?></a>.
												</div>
											</div>
										</div>
									</li>
									<li class="like-icon">
										<?php 
										$cp_album_class = new cp_album_class;
									?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php
					} ?>
				</section>
				<div class="border-line">&nbsp;<a id="no-album-active" class="hide-album"><?php echo __('Click Here','mosque_crunchpress'); ?></a></div>
			</div>	
			<?php
		}
	}
	
	
	//Music Play List Function Stars
	public static function sermons_play_list($album_title=''){
		global $counter;
		$sermons_title = $album_title;
		//Fetching the values from Track
		$track_name_xml = get_post_meta($sermons_title, 'track_name_xml', true);
		$track_url_xml = get_post_meta($sermons_title, 'track_url_xml', true);
		$track_des_xml = get_post_meta($sermons_title, 'track_des_xml', true);
		$track_down_xml = get_post_meta($sermons_title, 'track_down_xml', true);
		
		//Jplayer Scripts Classing After the Function Call
		wp_register_script('cp-jplayer', CP_PATH_URL.'/frontend/js/jquery.jplayer.min.js', false, '1.0', true);
		wp_enqueue_script('cp-jplayer');
		
		//Playlist Script
		wp_register_script('cp-jplayer-playlist', CP_PATH_URL.'/frontend/js/jplayer.playlist.min.js', false, '1.0', true);
		wp_enqueue_script('cp-jplayer-playlist');
		
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
			
		} ?>

		<!--JPlayer Function Starts-->
		<script type="text/JavaScript">
			//Lets make it work
			jQuery(document).ready(function($) {
				new jPlayerPlaylist({
					jPlayer: "#jquery_jplayer_<?php echo $counter.$sermons_title;?>",
					cssSelectorAncestor: "#jp_container_<?php echo $counter.$sermons_title;?>"
				}, [                       
					<?php 
					//Combine Loop
					$img_url_aa = 'http://www.jplayer.org/video/poster/Big_Buck_Bunny_Trailer_480x270.png';
						if($track_name_xml <> '' || $track_url_xml <> ''){
							$counter_aa = 0;
							$nofields = $ingre_xml->documentElement->childNodes->length;
							for($i=0;$i<$nofields;$i++) {
								echo '{';
								echo 'title:"'.$children_name->item($i)->nodeValue.'",';
								echo 'pastor:"'.$children_name->item($i)->nodeValue.'",';
								echo 'mp3:"'.$children_title->item($i)->nodeValue.'",';
								echo 'poster:"'.$img_url_aa.'",';
								echo '},';
							}
						}
					?>
				], 
				{
					playlistOptions: {
						enableRemoveControls: true
					},
					swfPath: "<?php echo CP_PATH_URL?>/frontend/js/Jplayer.swf",
					supplied: "mp3",
					//supplied: "webmv, ogv, m4v, oga, mp3",
					smoothPlayBar: true,
					keyEnabled: true,
					audioFullScreen: true
				});
			});                                                     
		</script>
		<h4><?php echo get_the_title($album_title);?></h4>
		<div id="jp_container_<?php echo $counter.$sermons_title;?>" class="jp-video jp-video-270p">
			<div class="jp-type-playlist">
				<div id="jquery_jplayer_<?php echo $counter.$sermons_title;?>" class="jp-jplayer"></div>
				<div class="jp-gui">
					<div class="jp-video-play">
						<a href="javascript:;" class="jp-video-play-icon" tabindex="1"><?php _e('play','mosque_crunchpress');?></a>
					</div>
					<div class="jp-interface">
						<div class="jp-controls-holder">
							<ul class="jp-controls">
								<li><a href="javascript:;" class="jp-previous" tabindex="1"></a></li>
								<li><a href="javascript:;" class="jp-play" tabindex="1"></a></li>
								<li><a href="javascript:;" class="jp-pause" tabindex="1"></a></li>
								<li><a href="javascript:;" class="jp-next" tabindex="1"></a></li>
								
							</ul>
							<div class="jp-progress">
								<div class="jp-seek-bar">
									<div class="jp-play-bar"></div>
								</div>
							</div>
							<ul class="volume-control">
								<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute"></a></li>
								<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute"></a></li>
								<li class="jp-volume-bar"><div class="jp-volume-bar-value"></div></li>
								<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume"></a></li>
							</ul>
							<ul class="playlist-cp">
								<li><a class="show-playlist"><i class="fa fa-list"></i></a></li>
							</ul>
							<ul class="jp-toggles">
								<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat"></a></li>
								<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off"></a></li>
							</ul>
						</div>
						<div class="jp-title">
							<ul>
								<li></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="jp-playlist">
					<ul>
						<!-- The method Playlist.displayPlaylist() uses this unordered list -->
						<li></li>
					</ul>
				</div>
				<div class="jp-no-solution">
					<span><?php _e('Update Required','mosque_crunchpress');?></span>
					<?php _e('To play the media you will need to either update your browser to a recent version or update your','mosque_crunchpress');?> <a href="http://get.adobe.com/flashplayer/" target="_blank"><?php _e('Flash plugin','mosque_crunchpress');?></a>.
				</div>
			</div>
		</div>	
		<!--JPlayer Function Starts-->
		
	<?php } //End Music Play List
		
}
	
	
	
	// Fire the Code after Base Function	
	add_action( 'plugins_loaded', 'manage_sermons_fun_override' );
	function manage_sermons_fun_override() {
		
		$cp_sermons_class = new cp_sermons_class;
	}	
}