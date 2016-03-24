<?php
if(class_exists('function_library')){

	add_action( 'plugins_loaded', 'event_fun_override' );

	function event_fun_override() {
		// your code here
		$events_class = new cp_events_class;
	}

	//Include the Widget
	//include_once('cp_event_countdown_widget.php');
	
	class cp_events_class extends function_library{
				public $events_array = array(
					
					'image_icon' =>array(

						'type'=> 'image','name'=> '',

						'hr'=> 'none',

						'description'=> "fa fa-calendar-o"),
						
					"top-bar-div2-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div2'),	

					'header'=>array(

						'title'=> 'EVENT HEADER TITLE',

						'name'=> 'page-option-item-event-header-title',
						
						'description'=>'Please add header title here it will be shown at top of this element.',

						'type'=> 'inputtext'),
						
					'eventview'=>array(

						'title'=>'SELECT EVENT VIEW',

						'name'=>'page-option-item-event-view',

						'type'=> 'combobox',

						'options'=>array('0'=>'Listing View', '1'=>'Calendar View', '2'=>'MAP View'),

						'description'=>'This option enable the events show as in listing and in calendar view.'),	
						
					'category'=>array(

						'title'=>'SELECT EVENT CATEGORY',

						'name'=>'page-option-item-event-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the event category you want to fetch its events.'),
					
					"top-bar-div2-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div2'),	

					"top-bar-div3-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div3'),	
					
					'eventtype'=>array(

						'title'=>'SELECT EVENT TYPE',

						'name'=>'page-option-item-event-type',

						'type'=> 'combobox',

						'options'=>array('0'=>'All Events', '1'=>'Upcoming Events','2'=>'Past Events'),

						'description'=>'This option enable the category events that helps you filter the event from past Or future.'),	
						
					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-event-num-excerpt',

						'type'=> 'inputtext',
						
						'class'=> 'event-type-item',

						'default'=> 100,

						'description'=>'Set the event description content character length to each event.'),

					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-event-pagination',

						'type'=> 'combobox',
						
						'class'=> 'event-type-item',

						'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),
					
					"top-bar-div3-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div3'),	

					"top-bar-div4-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div4'),					
					
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF EVENTS TO SHOW',

						'name'=> 'page-option-item-event-num-fetch',

						'type'=> 'inputtext',
						
						'class'=>'event-fetch-item',

						'default'=> 5,

						'description'=> 'Set the number of events you want to fetch on one page.'),	
						
					'event-layout'=>array(

						'title'=>'SELECT EVENT LAYOUT',

						'name'=>'page-option-item-event-layout',

						'type'=> 'combobox',
						
						'class'=>'event-fetch-layout',

						//'options'=>array('1'=>'1 Column','2'=>'2 Columns','3'=>'3 Columns','4'=>'4 Columns'),
						'options'=>array('1'=>'1 Column','2'=>'2 Columns'),

						'description'=>'You can manage your event layout here, grid or full width.'),
					
					"top-bar-div4-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div4'),

				);

				public $upcomming_event = array(
				
					'image_icon' =>array(

						'type'=> 'image','name'=> '',

						'hr'=> 'none',

						'description'=> "fa fa-calendar"),
					
					"top-bar-div5-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div5'),	

					'header'=>array(

						'title'=> 'EVENT HEADER TITLE',

						'name'=> 'page-option-item-event-counter-counter',
						
						'description'=>'Please add header title here it will be shown at top of this element.',

						'type'=> 'inputtext'),
						
					'category'=>array(

						'title'=>'CHOOSE EVENT CATEGORY',

						'name'=>'page-option-item-event-category-counter',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the event category you want to fetch its events.'),	
						
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF EVENTS TO SHOW',

						'name'=> 'page-option-upcoming-event-num-fetch',

						'type'=> 'inputtext',
						
						'class'=>'',

						'default'=> 5,

						'description'=> 'Set the number of events you want to fetch in slider.'),		
					
					"top-bar-div5-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div5'),
					
				);	

				public $next_events = array(
			
				"top-bar-div6-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div6'),
				
					'image_icon' =>array(

						'type'=> 'image','name'=> '',

						'hr'=> 'none',

						'description'=> "fa fa-calendar"),

					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-event-next-name',
						
						'description'=>'Please add header title here it will be shown at top of this element.',

						'type'=> 'inputtext'),
						
					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-event-category-next',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the event category you want the events to be fetched.'),			
					
					"top-bar-div6-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div6'),
					
				);	

				public $events_slider = array(
			
				"top-bar-div10-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div10'),
				
					'image_icon' =>array(

						'type'=> 'image','name'=> '',

						'hr'=> 'none',

						'description'=> "fa fa-recycle"),

					'event-layout'=>array(

						'title'=>'SELECT EVENT SLIDER LAYOUT',

						'name'=>'page-option-item-event-slider-layout',

						'type'=> 'combobox',
						
						'class'=>'event-fetch-layout',

						//'options'=>array('1'=>'1 Column','2'=>'2 Columns','3'=>'3 Columns','4'=>'4 Columns'),
						'options'=>array('1'=>'Layout 1','2'=>'Layout 2'),
					),
						
					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-event-category-slider',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the event category you want the events to be fetched.'),	

					// 'num-fetch'=>array(					

						// 'title'=> 'NUMBER OF EVENTS TO SHOW',

						// 'name'=> 'page-option-item-event-num-fetch-slider',

						// 'type'=> 'inputtext',
						
						// 'class'=>'',

						// 'default'=> 5,

						// 'description'=> 'Set the number of events you want to fetch in slider.'),
						
					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-event-num-excerpt-slider',

						'type'=> 'inputtext',
						
						'class'=> 'event-type-item',

						'default'=> 100,

						'description'=>'Set the event description content character length to each event.'),	
					
					"top-bar-div10-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div10'),
					
					"top-bar-div5654-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div5654'),
					
					'style'=>array(

						'title'=>'SELECT EVENT SLIDER STYLE',

						'name'=>'page-option-item-event-slider-style',

						'type'=> 'combobox',
						
						'class'=>'event-fetch-layout',

						//'options'=>array('1'=>'Church','2'=>'Islamic'),
						
						'options'=>array('1'=>'Islamic'),
					),
					
					"top-bar-div5654-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div5654'),
	
				);		
		
		
		public $events_size = array('element1-1'=>'1/1','element2-3'=>'2/3');
		public $events_counter_size = array('element2-3'=>'2/3');
		public $next_events_size = array('element1-1'=>'1/1','element2-3'=>'2/3');
		public $upcom_event_size = array('element1-1'=>'1/1');
		public $events_slider_size = array('element1-1'=>'1/1','element2-3'=>'2/3');
		
		
		
		
		
		
		//Define Sizes of Pagebuilder elements here	
		public function page_builder_size_class(){
		global $div_size;
			$div_size['Events'] = $this->events_slider_size;	 
			$div_size['Event-Slider'] = $this->upcom_event_size;	 
			//$div_size['Event-Calendar'] = $this->events_counter_size;
			//$div_size['Venue'] = $this->venue_size_array;
			//$div_size['Next-Events'] = $this->next_events_size;
			$div_size['Events-Slider'] = $this->events_size;
			
		}
		
		//Define Parameters of Page Builder Here
		public function page_builder_element_class(){
		global $page_meta_boxes;
			$page_meta_boxes['Page Item']['name']['Events'] = $this->events_array;
			$page_meta_boxes['Page Item']['name']['Events-Slider'] = $this->events_slider;
			//$page_meta_boxes['Page Item']['name']['Event-Calendar'] = $this->events_counter;
			//$page_meta_boxes['Page Item']['name']['Venue'] = $this->events_loc_array;
			//$page_meta_boxes['Page Item']['name']['Next-Events'] = $this->next_events;

			$page_meta_boxes['Page Item']['name']['Events']['category']['options'] = function_library::get_category_list_array( 'event-categories' );
			$page_meta_boxes['Page Item']['name']['Events-Slider']['category']['options'] = function_library::get_category_list_array( 'event-categories'  );
			//$page_meta_boxes['Page Item']['name']['Next-Events']['category']['options'] = function_library::get_category_list_array( 'event-categories'  );
			//$page_meta_boxes['Page Item']['name']['Event-Calendar']['category']['options'] = function_library::get_category_list_array( 'event-categories'  );
			//$page_meta_boxes['Page Item']['name']['Venue']['location']['options'] = function_library::get_title_list_array( 'event_location' );
			$page_meta_boxes['schedule-category-event']['options'] = function_library::get_category_list_array( 'event-categories'  );
			
			
		}
		
		public function __construct(){
			//add_action( 'init', array( $this, 'create_events' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_events_option' ) );
			add_action( 'save_post', array( $this, 'save_event_option_meta' ) );
			//add_action( 'save_post', array( $this, 'save_event_location_meta' ) );
		}

		
		public function create_events() {
			//$portfolio_translation = get_option(THEME_NAME_S.'_cp_portfolio_slug','portfolio');
			
			$labels = array(
				'name' => _x('Events', 'Event General Name', 'mosque_crunchpress'),
				'singular_name' => _x('Event Item', 'Event Singular Name', 'mosque_crunchpress'),
				'add_new' => _x('Add New', 'Add New Event Name', 'mosque_crunchpress'),
				'add_new_item' => __('Add New Event', 'mosque_crunchpress'),
				'edit_item' => __('Edit Event', 'mosque_crunchpress'),
				'new_item' => __('New Event', 'mosque_crunchpress'),
				'view_item' => __('View Event', 'mosque_crunchpress'),
				'search_items' => __('Search Event', 'mosque_crunchpress'),
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
				'menu_icon' => CP_PATH_URL . '/framework/images/calendar-icon.png',
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
				'rewrite' => array('slug' => 'events', 'with_front' => false)
			  ); 
			  
			register_post_type( 'events' , $args);
			
			// adding Manage Location start
					$labels = array(
						'name' => __('Manage Location', 'mosque_crunchpress'),
						'add_new_item' => __('Add New Location (Venue Title)', 'mosque_crunchpress'),
						'edit_item' => __('Edit Location', 'mosque_crunchpress'),
						'new_item' => __('New Location Item', 'mosque_crunchpress'),
						'add_new' => __('Add New Location', 'mosque_crunchpress'),
						'view_item' => __('View Location Item', 'mosque_crunchpress'),
						'search_items' => __('Search Location', 'mosque_crunchpress'),
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
						//'menu_icon' => get_stylesheet_directory_uri() . '/images/calendar.png',
						'show_in_menu' => 'edit.php?post_type=events',
						'show_in_nav_menus'=>true,
						'rewrite' => true,
						'capability_type' => 'post',
						'hierarchical' => false,
						'menu_position' => null,
						'supports' => array('title')
					); 
					register_post_type( 'event_location' , $args );  
				// adding Manage Location end
			
			
			register_taxonomy(
				"event-category", array("events"), array(
					"hierarchical" => true,
					"label" => "Event Categories", 
					"singular_label" => "Event Categories", 
					"rewrite" => true));
			register_taxonomy_for_object_type('events-categories', 'events');
			
			register_taxonomy(
				"event-tag", array("events"), array(
					"hierarchical" => false, 
					"label" => "Event Tag", 
					"singular_label" => "Event Tag", 
					"rewrite" => true));
			register_taxonomy_for_object_type('events-tag', 'events');
			
		}
		
		
		
		public function add_events_option(){	
		
			add_meta_box('event-option', __('Event Options','mosque_crunchpress'), array($this,'add_event_option_element'),
				'event', 'normal', 'high');
				
		}
		
		public function add_event_option_element(){

			$event_detail_xml = '';
			$event_social = '';
			$sidebar_event = '';
			$right_sidebar_event = '';
			$left_sidebar_event = '';
			$event_start_date = '';
			$event_end_date = '';
			$event_start_time = '';
			$event_end_time = '';
			$additional_info = '';
			$entry_level = '';
			$booking_url = '';
			$event_thumbnail = '';
			$video_url_type = '';
			$select_slider_type = '';
			$event_location_select = '';
			$schedule_head = '';
			$schedule_descrip = '';
			$team_parti_head = '';
			$team_parti_descrip = '';
			$name_post_schedule = '';
			$title_post_schedule = '';
			$des_post_schedule = '';
			$sch_select_organizer = '';
			
			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
			global $post,$EM_Event;
			
			$event_detail_xml = get_post_meta($EM_Event->ID, 'event_detail_xml', true);
			if($event_detail_xml <> ''){
				$cp_event_xml = new DOMDocument ();
				$cp_event_xml->loadXML ( $event_detail_xml );
				$event_social = cp_find_xml_value($cp_event_xml->documentElement,'event_social');
				$sidebar_event = cp_find_xml_value($cp_event_xml->documentElement,'sidebar_event');
				$left_sidebar_event = cp_find_xml_value($cp_event_xml->documentElement,'left_sidebar_event');
				$right_sidebar_event = cp_find_xml_value($cp_event_xml->documentElement,'right_sidebar_event');
				$event_thumbnail = cp_find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
				$video_url_type = cp_find_xml_value($cp_event_xml->documentElement,'video_url_type');
				$select_slider_type = cp_find_xml_value($cp_event_xml->documentElement,'select_slider_type');
				
			}
		?>
			<div class="event_options cp-wrapper" id="event_backend_options" >
				<ul class="event_social_class recipe_class row-fluid">
					<li class="panel-input span12">
						<span class="panel-title">
							<h3 for="event_social" > <?php esc_html_e('SOCIAL NETWORKING', 'mosque_crunchpress'); ?> </h3>
						</span>
						<label for="event_social"><div class="checkbox-switch <?php
						
						echo ($event_social=='enable' || ($event_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

					?>"></div></label>
					<input type="checkbox" name="event_social" class="checkbox-switch" value="disable" checked>
					<input type="checkbox" name="event_social" id="event_social" class="checkbox-switch" value="enable" <?php 
						
						echo ($event_social=='enable' || ($event_social=='' && empty($default)))? 'checked': ''; 
					
					?>>
						<p><?php esc_html_e('You can turn On/Off social sharing from event detail.','mosque_crunchpress'); ?></p>
					</li>
				</ul>
				<div class="clear"></div>
				<?php echo function_library::show_sidebar($sidebar_event,'right_sidebar_event','left_sidebar_event',$right_sidebar_event,$left_sidebar_event);?>
				<div class="clear"></div>
				<input type="hidden" name="event_submit" value="events"/>
				<div class="clear"></div>
			</div>	
			<div class="clear"></div>
			
		<?php }
		
		public function save_event_option_meta($post_id){
			
			$event_social = '';
			$sidebars = '';
			$right_sidebar_event = '';
			$left_sidebar_event = '';
			$event_detail_xml = '';
			$event_thumbnail = '';
			$video_url_type = '';
			$select_slider_type = '';
			
			
			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
		
			if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		
				if(isset($event_submit) AND $event_submit == 'events'){
					$new_data = '<event_detail>';
					$new_data = $new_data . function_library::create_xml_tag('event_social',$event_social);
					$new_data = $new_data . function_library::create_xml_tag('sidebar_event',$sidebars);
					$new_data = $new_data . function_library::create_xml_tag('right_sidebar_event',$right_sidebar_event);
					$new_data = $new_data . function_library::create_xml_tag('left_sidebar_event',$left_sidebar_event);
					// $new_data = $new_data . function_library::create_xml_tag('event_thumbnail',$event_thumbnail);
					// $new_data = $new_data . function_library::create_xml_tag('video_url_type',$video_url_type);
					// $new_data = $new_data . function_library::create_xml_tag('select_slider_type',$select_slider_type);
					$new_data = $new_data . '</event_detail>';
					//Saving Sidebar and Social Sharing Settings as XML
					$old_data = get_post_meta($post_id, 'event_detail_xml',true);
					function_library::save_meta_data($post_id, $new_data, $old_data, 'event_detail_xml');
					
				}
		}
		
				//EVENT FRONTEND AREA START
		public $event_div_listing_num_class = array(
			"Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 400), "size3"=>array(570,300)),
			"Small-Thumbnail" => array("index"=>"2", "class"=>"sixteen", "size"=>array(175,155), "size2"=>array(175,155), "size3"=>array(175,155)));

		
	
		//Next Event Section
		public function print_next_events_item($item_xml){
			global $counter;
			$header = cp_find_xml_value($item_xml, 'header');
			$category = cp_find_xml_value($item_xml, 'category');
			if($category == '0'){$category='';} ?>
			
			<?php
			//Bx Slider Script Calling
				// wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
				// wp_enqueue_script('cp-bx-slider');	
				// wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
			?>
			<div class="our-blog">
				<h2 class="bg-purple"><?php echo esc_attr($header);?></h2>
				<div class="next-events" id="next_event-<?php echo esc_attr($counter);?>">
				<?php
					global $EM_Events,$bp;
					$order = 'DESC';
					$limit = 5;//Default limit
					$offset = '';
					$rowno = 0;
					$event_count = 0;
					$EM_Events = EM_Events::get( array('category'=>$category, 'group'=>'this','scope'=>'future', 'limit' => $limit, 'order' => $order) );
					$events_count = count ( $EM_Events );	
					foreach ( $EM_Events as $event ) {
						
						//Print Event Manager Elements
						$localised_start_date = date_i18n(get_option('dbem_date_format'), $event->start);
						$localised_end_date = date_i18n(get_option('dbem_date_format'), $event->end);
						$style = "";
						$today = date ( "Y-m-d" );
						
						if(!empty($event->location_id->name)){
							$location_summary = "<b>" . $event->get_location()->name . "</b><br/>" . $event->get_location()->address . " - " . $event->get_location()->town;
						}else{
							$location_summary = '';
						}
						
						if ($event->start_date < $today && $event->end_date < $today){
							$class .= " past";
						}
						
						//Check pending approval events
						if ( !$event->status ){
							$class .= " pending";
						}	
						
						$event_month_alpha = date('M',$event->start);
						$event_day = date('d',$event->start);
						
						
						//Get Date in Parts
						$event_year = date('Y',$event->start);
						$event_month = date('m',$event->start);
						$event_month_alpha = date('M',$event->start);
						$event_day = date('d',$event->start);
						
						//Change time format
						if($event->start_time <> ''){
							$event_start_time_count = date("G,i,s", strtotime($event->start_time));
						}
						$thumbnail_id = get_post_thumbnail_id( $event->post_id );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(260,300));
						
						$event_element_id = $counter.$event->event_id; ?>
						<div class="blog-data">
							<div class="text">
								<div class="blog-heading">
								<div class="date">
									<i class="fa fa-file-text-o"></i>
									<p><?php echo esc_attr($event_day);?> <?php echo esc_attr($event_month_alpha);?></p>
								</div>
									<h2><a href="<?php echo esc_url($event->guid);?>"><?php echo esc_attr($event->post_title);?></a></h2>
									<p><?php echo esc_attr($event->start_time).' - '.esc_attr($event->end_time);?></p>
								</div>
								<div class="blog-text">
									<p><?php echo strip_tags(mb_substr(esc_attr($event->post_content),0,250));?></p>
									<div class="views">
										<ul>
											<li><a href="<?php echo esc_url($event->guid);?>"><i class="fa fa-share-square-o"></i><?php echo esc_attr($event->start_date);?></a></li>
											<li><a href="<?php echo esc_url($event->guid);?>"><i class="fa fa-eye"></i><?php echo esc_attr($event->end_date);?></a></li>
											<li>
											<?php
												//Get Post Comment 
												comments_popup_link( __('<i class="fa fa-comments-o"></i>0 Comment','mosque_crunchpress'),
												__('<i class="fa fa-comments-o"></i>1 Comment','mosque_crunchpress'),
												__('<i class="fa fa-comments-o"></i>% Comments','mosque_crunchpress'), '',
												__('<i class="fa fa-comments-o"></i>Comments are off','mosque_crunchpress') );
											?>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<?php if($thumbnail[1].'x'.$thumbnail[2] == '260x300'){ ?><figure><?php echo get_the_post_thumbnail($event->post_id, array(260,300));?></figure><?php }?>
						</div>
					<?php
					} //End Foreach Loop
					?>
				</div>
			</div>	
	<?php
		}
		
		//Event CountDown Function Start
		public function print_upcomming_event($item_xml){ 
			$header = cp_find_xml_value($item_xml, 'header');
			$category = cp_find_xml_value($item_xml, 'category');
			if($category == '0'){$category='';}
			global $EM_Events,$bp,$counter;
			?>
			<script>
				$(document).ready(function () {
					"use strict";
					if ($('#upcoming_event-<?php echo esc_js($counter);?>').length) {
						$('#upcoming_event-<?php echo esc_js($counter);?>').bxSlider({
							minSlides: 3,
							maxSlides: 4,
							slideWidth: 375,
							slideMargin: 20,
							controls:true,
						});
					}
				});
			</script>
			<?php
			//Bx Slider Script Calling
				// wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
				// wp_enqueue_script('cp-bx-slider');	
				// wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
			?>
			<?php
			echo '
				<div class="upcoming-heading">
					<h3>'.esc_attr($header).'</h3>
					<ul class="" id="upcoming_event-'.$counter.'">';
			
			$order = 'DESC';
			$limit = 10;//Default limit
			$offset = '';		
			$rowno = 0;
			$event_count = 0;
			$EM_Events = EM_Events::get( array('category'=>'', 'group'=>'this','scope'=>'future', 'limit' => '10', 'order' => $order) );
			$events_count = count ( $EM_Events );	
			foreach ( $EM_Events as $event ) {
				/* @var $event EM_Event */
				if( ($rowno < $limit || empty($limit)) && ($event_count >= $offset || $offset === 0) ) {
					$rowno++;
					$class = ($rowno % 2) ? 'alternate' : '';
					// FIXME set to american
					$localised_start_date = date_i18n(get_option('dbem_date_format'), $event->start);
					$localised_end_date = date_i18n(get_option('dbem_date_format'), $event->end);
					$style = "";
					$today = date ( "Y-m-d" );
					if(!empty($event->location_id->name)){
							$location_summary = "<b>" . $event->get_location()->name . "</b><br/>" . $event->get_location()->address . " - " . $event->get_location()->town;
						}else{
							$location_summary = '';
						}
					if ($event->start_date < $today && $event->end_date < $today){
						$class .= " past";
					}
					//Check pending approval events
					if ( !$event->status ){
						$class .= " pending";
					}	
					
					
					$event_month_alpha = date('M',$event->start);
					$event_day = date('d',$event->start);
					
					
					//Get Date in Parts
					$event_year = date('Y',$event->start);
					$event_month = date('m',$event->start);
					$event_month_alpha = date('M',$event->start);
					$event_day = date('d',$event->start);
					
					//Change time format
					$event_start_time_count = date("G,i,s", strtotime($event->start_time));
					$event_element_id = $counter.$event->event_id;?>
					
					<li class="event-box-slider">
						<script>
							jQuery(function () {
								var austDay = new Date();
								austDay = new Date(<?php echo esc_js($event_year);?>, <?php echo esc_js($event_month);?>-1, <?php echo esc_js($event_day);?>,<?php echo esc_js($event_start_time_count);?>)
								jQuery('.countdown-<?php echo esc_js($event_element_id);?>').countdown({
									labels: ['<?php _e('Years','mosque_crunchpress');?>', '<?php _e('Months','mosque_crunchpress');?>', '<?php _e('Weeks','mosque_crunchpress');?>', '<?php _e('Days','mosque_crunchpress');?>', '<?php _e('Hours','mosque_crunchpress');?>', '<?php _e('Minutes','mosque_crunchpress');?>', '<?php _e('Seconds','mosque_crunchpress');?>'],
									until: austDay
								});
								jQuery('#year').text(austDay.getFullYear());
							});                
						</script>
						<div class="upcoming-box">
							<div class="frame"><a href="<?php echo esc_url($event->guid);?>"><?php echo get_the_post_thumbnail($event->post_id, array(570,300));?></a></div>
							<div class="caption">
								<div class="timer-box">
									<div class="countdown-<?php echo esc_attr($event_element_id);?> defaultCountdown"></div>
								</div>
								<strong class="title"><a href="<?php echo esc_url($event->guid);?>"><?php echo esc_attr($event->post_title);?></a></strong> 
								<strong class="mnt"><span><?php echo date(get_option('date_format'),$event->start);?></span></strong>
							</div>
						</div>					
					</li>
			   
			<?php   
				}
			}
			echo ' </ul>		
      </div>';
		}
		
		
		
		public function page_event_manager_plugin($item_xml){
			global $counter;
			// get the blog meta value		
			$header = cp_find_xml_value($item_xml, 'header');
			$eventview = cp_find_xml_value($item_xml, 'eventview');
			$event_layout = cp_find_xml_value($item_xml, 'event-layout');
			$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
			$category = cp_find_xml_value($item_xml, 'category');
			$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
			$event_type = cp_find_xml_value($item_xml, 'eventtype');

			if(empty($paged)){
				$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
			}
			
			$select_layout_cp = '';
			$color_scheme = '';
			$cp_general_settings = get_option('general_settings');
			if($cp_general_settings <> ''){
				$cp_logo = new DOMDocument ();
				$cp_logo->loadXML ( $cp_general_settings );
				$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
				$color_scheme = cp_find_xml_value($cp_logo->documentElement,'color_scheme');
			}
			
			//Event Type Condition
			if($event_type == 'All Events'){$event_type = 'all';}else if($event_type == 'Upcoming Events'){$event_type = 'future';}else if($event_type == 'Past Events'){$event_type = 'past';}else{}
			
			//Category All
			if($category == '0'){$category = '';}
			if($header <> ''){
				echo '<h2 class="h-style">'.$header.'</h2>';
			}
			//Event View
			if($eventview == 'Listing View'){
			wp_reset_query();
			wp_reset_postdata();
				global $EM_Events,$bp;				
				$limit = $num_fetch;	//Default limit
				$page = ( !empty($_GET['pno']) ) ? $_GET['pno']:1;
				$offset = ( $page > 1 ) ? ($page-1)*$limit + 1 : 0;
				//$args['offset']= ($args['page'] - 1) * $args['limit'] + 1;
				$order = ( !empty($_REQUEST ['order']) ) ? $_REQUEST ['order']:'ASC';
				$EM_Events = EM_Events::get( array('category'=>$category, 'group'=>'this','scope'=>$event_type, 'limit'=>$limit, 'offset' => $offset, 'order' => $order,'pagination'=> true) );
				$events_count = count ( $EM_Events );	
				$rowno = 0;
				$event_count = 0;
				$prev_month = null;
				
				echo '
              <div class="latest-news-post event-listing">                
                <div class="row">';
				foreach ( $EM_Events as $event ) {
					/* @var $event EM_Event */
					//if($prev_month){}
					$this_month = date('F,Y',$event->start);
					if($prev_month != $this_month){
					
					
						if(!is_null($prev_month)){
							
						}
					
					}
					$prev_month = $this_month;
					if( ($rowno < $limit || empty($limit)) && ($event_count >= $offset || $offset === 0) ) {
						$rowno++;
						$class = ($rowno % 2) ? 'alternate' : '';
						// FIXME set to american
						$localised_start_date = date_i18n(get_option('dbem_date_format'), $event->start);
						$localised_end_date = date_i18n(get_option('dbem_date_format'), $event->end);
						//print_r($event);
						$style = "";
						$today = date ( "Y-m-d" );
						//print_R($event);
						if(!empty($event->location_id->name)){
							$location_summary = "<b>" . $event->get_location()->name . "</b><br/>" . $event->get_location()->address . " - " . $event->get_location()->town;
						}else{
							$location_summary = '';
						}
						if ($event->start_date < $today && $event->end_date < $today){
							$class .= " past";
						}
						//Check pending approval events
						if ( !$event->status ){
							$class .= " pending";
						}	
						
						$event_month_alpha = date('M',$event->start);
						$event_day = date('d',$event->start);
						$event_element_id = $counter.$event->event_id;
						//condition for event location lat long
						
						
						$event_month_alpha = date('M',$event->start);
						$event_day = date('d',$event->start);
						
						
						//Get Date in Parts
						$event_year = date('Y',$event->start);
						$event_month = date('m',$event->start);
						$event_month_alpha = date('M',$event->start);
						$event_day = date('d',$event->start);
						
						//Change time format
						$event_start_time_count = date("G,i,s", strtotime($event->start_time));
						//'options'=>array('1'=>'1 Column','2'=>'2 Columns','3'=>'3 Columns','4'=>'4 Columns'),
						//Empty Classes
						$span_class = '';
						$count_val = '1';
						$first_class = '';
						$clear_class = '';
						//if not Column 1 or Full Width then!
						//if($event_layout <> '1 Column'){
						//Condition to manage Event Layouts
						$item_t_size = 'full';
						if($event_layout == '2 Columns'){
							$span_class		= 	"col-md-6 col-sm-6 col-xs-12 mgn_btm-20";
							$count_val		=	2;
							$item_t_size = array(260,300);
						}else if($event_layout == '3 Columns'){								
							$span_class		= 	"span4";
							$count_val		=	3;
						}else if($event_layout == '4 Columns'){								
							$span_class		= 	"span3";
							$count_val		=	4;
						}else{
							$span_class		= 	"col-md-12 mgn_btm-20";
							$count_val		=	1;
							$item_t_size = array(260,300);
						}
						//Count the events in row then break the line
						if($event_count % $count_val == 0){
							$first_class = 'first';
							echo "<div class='clear'></div>";
						}else{} 
						$thumbnail_id = get_post_thumbnail_id( $event->post_id );
						$image_thumb = wp_get_attachment_image_src($thumbnail_id,$item_t_size );
						?>
				<div class="<?php echo esc_attr($span_class);?>">
					<div class="upcoming-events-box cp_inner_events">
						<div class="upcoming-section-2">
							<ul class="event-2-slider">
								<li>
									<div class="holder">
										<div class="frame">
											<a href="<?php esc_url(get_permalink())?>"><?php echo get_the_post_thumbnail($event->post_id, array(370,310));?></a>
											<strong class="date"><?php echo esc_attr(date('d',$event->start));?><span><?php echo esc_attr(date('M',$event->start));?></span></strong>
										</div>
										<div class="text-box">
											<h3>
											<a href="<?php echo esc_url($event->guid);?>">
												<?php if (strlen($event->post_title) < 40 ){echo esc_attr(substr($event->post_title, 0 , 40));}else { echo esc_attr(substr($event->post_title, 0 , 40)) . '...'; }?>
											</a>
											</h3>
											<p><?php echo esc_attr(strip_tags(mb_substr($event->post_content,0,$num_excerpt)));?><a href="<?php echo esc_url($event->guid);?>">...[+]</a></p>
										
											<div class="event-links">
												<a href="<?php echo esc_url($event->guid);?>" class="link"><i class="fa fa-clock-o"></i>
													<?php echo  date(get_option('date_format'),strtotime($event->start_date)); ?> <?php echo date("g:i A", strtotime($event->start_time)); ?></a>
												<a href="<?php echo esc_url($event->guid);?>" class="link"><i class="fa fa-map-marker"></i>
												<?php echo esc_attr($event->get_location()->location_address);?></a>
												
											</div>
											<div class="countdown-box countdown-box-2">
												<script type="text/JavaScript">
													jQuery(function () {
														var austDay = new Date();
														austDay = new Date(<?php echo esc_js($event_year);?>, <?php echo esc_js($event_month);?>-1, <?php echo esc_js($event_day);?>,<?php echo esc_js($event_start_time_count);?>)
														jQuery('.defaultCountdown-<?php echo esc_js($event_element_id);?>').countdown({
															labels: ['<?php _e('Years','mosque_crunchpress');?>', '<?php _e('Months','mosque_crunchpress');?>', '<?php _e('Weeks','mosque_crunchpress');?>', '<?php _e('Days','mosque_crunchpress');?>', '<?php _e('Hrs','mosque_crunchpress');?>', '<?php _e('Min','mosque_crunchpress');?>', '<?php _e('Sec','mosque_crunchpress');?>'],
															until: austDay
														});
														jQuery('#year').text(austDay.getFullYear());
													});                
												</script>
												<div class="defaultCountdown-<?php echo esc_attr($event_element_id);?>"></div>
											</div>
											<div class="btn-row">
												<a class="btn-8" href="<?php echo esc_url($event->guid);?>"><?php echo esc_html_e('View Details','mosque_crunchpress');?></a>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
								
								<!--<div class="frame"> <a href="<?php echo esc_url($event->guid);?>"><?php echo get_the_post_thumbnail($event->post_id, $item_t_size);?></a>
								  <div class="caption"><a href="<?php echo esc_url($event->guid);?>" class="link"><i class="fa fa-link"></i></a></div>
								</div>-->
								<?php if($event_layout <> '2 Columns'){ ?>
								<!--<div class="text-box">
									<div class="date-box">
										<strong class="date"><?php echo date('d',$event->start);?><span><?php echo date('M',$event->start);?></span></strong>
									</div>
									<h3><a class = "cp_upcoming_title" href="<?php echo esc_url($event->guid);?>"><?php echo substr(esc_attr($event->event_name),0,40);?></a></h3>
									<?php
									//Fetching the Description from Database and Printing here
									$content = str_replace(']]>', ']]&gt;',$event->post_content); ?>
									<p> <?php echo esc_attr(substr($event->post_content,0, $num_excerpt)); ?> </p>
									<div class="btn-row">
										<strong class="time"><i class="fa fa-clock-o"></i><?php echo date("g:i a", strtotime($event->start_time)); ?> to <?php echo date("g:i a", strtotime($event->end_time));?></strong>
										<?php
											$location_address = $event->get_location()->location_address;
											$location_name =  $event->get_location()->location_name;
										?>
										<strong class="time"><i class="fa fa-map-marker"></i><?php echo esc_attr($location_address);?></strong>
									</div>
									
									<div class="btn-row">
										<a class="btn-8" href="<?php echo esc_url($event->guid);?>"><?php echo esc_html_e('Event Details','mosque_crunchpress');?></a>
										<a class="btn-8" href="<?php echo esc_url($event->guid);?>"><?php echo esc_html_e('Buy tickets','mosque_crunchpress');?></a>
									</div>
								</div>-->
								<?php }else{ ?>
								<div class="text-box">										
									<div class="date-box">
										<strong class="date"><?php echo date('d',$event->start);?><span><?php echo date('M',$event->start);?></span></strong>
									</div>
									<h3><a class = "cp_upcoming_title" href="<?php echo esc_url($event->guid);?>"><?php echo substr(esc_attr($event->event_name),0,40);?></a></h3>
									<?php
									//Fetching the Description from Database and Printing here
									$content = str_replace(']]>', ']]&gt;',$event->post_content); ?>
									<p> <?php echo substr($event->post_content,0, $num_excerpt ); ?> </p>
									<strong class="time"><i class="fa fa-clock-o"></i><?php echo esc_attr($event->start_time);?>. to <?php echo esc_attr($event->end_time);?></strong>
									<?php
										$location_address = $event->get_location()->location_address;
										$location_name =  $event->get_location()->location_name;
									?>
									<strong class = "time"><i class="fa fa-map-marker"></i><?php echo esc_attr($location_address);?></strong>
									<a class="more" href="<?php echo esc_url($event->guid);?>"><i class="fa fa-arrow-right"></i></a>
								</div>
								<?php }?>
							</div>
						
                <?php
					}
					$event_count++;
				}
				echo '</div>';

				echo '</div>';
				//echo '<div class="cp_load fadeIn">';
				
				// $link = em_add_get_params($_SERVER['REQUEST_URI'], array('pno'=>'%PAGE%'), false); //don't html encode, so em_paginate does its thing
				// echo em_paginate( $link, $events_count, $limit, $page);
				// if( cp_find_xml_value($item_xml, "pagination") == "Theme-Custom" ){	
					// pagination();
				// }
				//echo '</div>';', '2'=>'MAP View
			}else if($eventview == 'Calendar View'){
				global $EM_Events,$bp;
				$order = ( !empty($_REQUEST ['order']) ) ? $_REQUEST ['order']:'ASC';
				$limit = $num_fetch;//Default limit
				$offset = ( $paged > 1 ) ? ($paged-1)*$limit : 0;
				$EM_Events = EM_Events::get( array('category'=>'', 'group'=>'this','scope'=>'all', 'limit' => '100', 'order' => 'ASC') );
				$events_count = count ( $EM_Events );	
				$rowno = 0;
				$event_count = 0;
				wp_enqueue_style('cp-calender-view', CP_PATH_URL.'/framework/javascript/fullcalendar/fullcalendar.css');?>
				<script>
					jQuery(document).ready(function($) {

						$('#calendar_view-<?php echo esc_js($counter);?>').fullCalendar({

							header: {
								left: 'title',
								center: '',
								right: 'prev,next'
							},
							buttonText: {
								prev: "<span class='fc-button-content'>&nbsp;◄&nbsp;</span>",
								next: "<span class='fc-button-content'>&nbsp;►&nbsp;</span>",
							},
							
							disableDragging: true,
							events: [ <?php 
								foreach ( $EM_Events as $event ) {
									// FIXME set to american
									$localised_start_date = date_i18n(get_option('dbem_date_format'), $event->start);
									$localised_end_date = date_i18n(get_option('dbem_date_format'), $event->end);
									$style = "";
									$today = date ( "Y-m-d" );
									$class = '';
									
									if ($event->start_date < $today && $event->end_date < $today){
										$class .= " past";
									}
									//Check pending approval events
									if ( !$event->status ){
										$class .= " pending";
									}
									
									
									$event_month_alpha = date('M',$event->start);
									$event_day = date('d',$event->start);
									$hour_start = date("H", strtotime($event->start_time));
									$mint_start = date("i", strtotime($event->start_time));					
									
									$hour_end = date("H", strtotime($event->end_time));
									$mint_end = date("i", strtotime($event->end_time));					
					
										//Start From
										$year_from = date("Y", $event->start);
										$month_from = date("m", $event->start);
										$day_from = date("d", $event->start);
										
										//Ends on 
										$year_to = date("Y", $event->end);
										$month_to = date("m", $event->end);
										$day_to = date("d", $event->end);
										
									
									?>
										{
										title: '<?php echo html_entity_decode(mb_substr($event->event_name, 0, 30)).'....'?>',
										start: new Date(<?php echo esc_js($year_from);?>, <?php echo esc_js($month_from);?>-1, <?php echo esc_js($day_from);?>, <?php echo esc_js($hour_start);?>, <?php echo esc_js($mint_start);?>),
										end: new Date(<?php echo esc_js($year_to);?>, <?php echo esc_js($month_to);?>-1, <?php echo esc_js($day_to);?>, <?php echo esc_js($hour_end);?>, <?php echo esc_js($mint_end);?>),
										url: '<?php echo html_entity_decode($event->guid); ?>',
										allDay: false

										},
								<?php 
									$event_count++;
								}	
								?>
							]
						});
					});	
				</script>
				<div class="event-calender-mosque" id="calendar_view-<?php echo esc_js($counter);?>"></div>
		<?php 
			}else if($eventview == 'MAP View'){
				global $EM_Events,$bp;				
				$limit = $num_fetch;	//Default limit
				$page = ( !empty($_GET['pno']) ) ? $_GET['pno']:1;
				$offset = ( $page > 1 ) ? ($page-1)*$limit : 0;
				$order = ( !empty($_REQUEST ['order']) ) ? $_REQUEST ['order']:'ASC';
				$EM_Events = EM_Events::get( array('category'=>$category, 'group'=>'this','scope'=>$event_type, 'limit'=>'100', 'order' => $order,'pagination'=>'1',) );
				$events_count = count ( $EM_Events );	
				$rowno = 0;
				$event_count = 0;
				$prev_month = null;
				//wp_enqueue_style('cp-calender-view', CP_PATH_URL.'/framework/javascript/fullcalendar/fullcalendar.css');?>
				<script src="http://maps.google.com/maps/api/js?sensor=false"></script> 
				<script>
						var cp_locations = [ <?php
							foreach ( $EM_Events as $event ) {
								// FIXME set to american
								$localised_start_date = date_i18n(get_option('dbem_date_format'), $event->start);
								$localised_end_date = date_i18n(get_option('dbem_date_format'), $event->end);
								$style = "";
								$today = date ( "Y-m-d" );
								
								
								
								$event_month_alpha = date('M',$event->start);
								$event_day = date('d',$event->start);
								$hour_start = date("H", strtotime($event->start_time));
								$mint_start = date("i", strtotime($event->start_time));					
								
								$hour_end = date("H", strtotime($event->end_time));
								$mint_end = date("i", strtotime($event->end_time));					
				
									//Start From
									$year_from = date("Y", $event->start);
									$month_from = date("m", $event->start);
									$day_from = date("d", $event->start);
									
									//Ends on 
									$year_to = date("Y", $event->end);
									$month_to = date("m", $event->end);
									$day_to = date("d", $event->end);
									$thumbnail_id = get_post_thumbnail_id( $event->post_id );
									$image_thumb = wp_get_attachment_image_src($thumbnail_id,'full' );?>
									["<div class='map-caption'><div class='frame'><a href='<?php echo esc_url($event->guid);?>'><img src='<?php echo esc_url($image_thumb[0]);?>' alt='img'></a></div><div class='text-box'><div class='top-row'><h3><?php echo esc_js(substr($event->event_name,0,35));?></h3></div></div><div class='mid-row'><strong class='title'><?php esc_html_e('Location: ','mosque_crunchpress');?></strong><?php echo esc_js($event->get_location()->location_name);?></div><div class='bottom-row'><ul><li><strong class='title'><?php esc_html_e('Address: ','mosque_crunchpress');?></strong><?php echo esc_js($event->get_location()->location_address);?></li><li><strong class='title'><?php esc_html_e('Event Date: ','mosque_crunchpress');?></strong><?php echo esc_js($event->start_date);?></li><li><strong class='title'><?php esc_html_e('Event Time: ','mosque_crunchpress');?></strong><?php echo esc_js($event->start_time);?></li></ul></div></div>",<?php echo esc_js($event->get_location()->location_latitude);?>,<?php echo esc_js($event->get_location()->location_longitude);?>],
							<?php } ?>								
							];
							// Setup the different icons and shadows
							var iconURLPrefix = "images";
							var icons = [ <?php
							foreach ( $EM_Events as $event ) { ?>
								"<?php echo CP_PATH_URL?>/images/map-icon-2.png", 
							<?php }?>								
							];
						
					function cp_initialize(){
						var icons_length = icons.length;
						var shadow = {
						  anchor: new google.maps.Point(16,16),
						  url: iconURLPrefix + 'msmarker.shadow.png'
						};

						var myOptions = {
						  center: new google.maps.LatLng(16,18),
						  mapTypeId: 'roadmap',
						  mapTypeControl: true,
						  streetViewControl: true,
						  panControl: true,
						  scrollwheel: false,
						  draggable: true,	  
						  styles: [{
								stylers: [{
									hue: '#0073FF'
								}, {
									saturation: -30                        }, {
									lightness: 10                        }]
							}],
						   zoom: 3,
						}
						var map = new google.maps.Map(document.getElementById("map_canvas_cp"), myOptions);
						var infowindow = new google.maps.InfoWindow({
						  maxWidth: 350,
						});
						var marker;
						var markers = new Array();
						var iconCounter = 0;

						// Add the markers and infowindows to the map
						for (var i = 0; i < cp_locations.length; i++) {  
						  marker = new google.maps.Marker({
							position: new google.maps.LatLng(cp_locations[i][1], cp_locations[i][2]),
							map: map,
							icon : icons[iconCounter],
							shadow: shadow
						  });

						  markers.push(marker);
						 
						 google.maps.event.addListener(marker, 'click', (function(marker, i) {
								infowindow.setContent(cp_locations[i][0]);
							  infowindow.open(map, marker);
							return function() {
							  infowindow.setContent(cp_locations[i][0]);
							  infowindow.open(map, marker);
							}
						  })(marker, i));
						  
						  iconCounter++;
						  // We only have a limited number of possible icon colors, so we may have to restart the counter
						  if(iconCounter >= icons_length){
							iconCounter = 0;
						  }
						}
					}
						google.maps.event.addDomListener(window, "load", cp_initialize);
				
				</script>
				<div class="row" id="map-sec"><div style="width: 100%; height:600px;" id="map_canvas_cp"></div></div>
			<?php
			}
		}

		// print the blog thumbnail
		public function print_event_thumbnail( $post_id, $item_size ){
			
			global $counter;
			//Get Post Meta Options
			$img_html = '';
			$event_thumbnail = '';
			$video_url_type = '';
			$select_slider_type = '';
			$event_detail_xml = get_post_meta($post_id, 'event_detail_xml', true);
			if($event_detail_xml <> ''){
				$cp_event_xml = new DOMDocument ();
				$cp_event_xml->loadXML ( $event_detail_xml );
				$event_thumbnail = cp_find_xml_value($cp_event_xml->documentElement,'event_thumbnail');
				$video_url_type = cp_find_xml_value($cp_event_xml->documentElement,'video_url_type');
				$select_slider_type = cp_find_xml_value($cp_event_xml->documentElement,'select_slider_type');		
				//Print Image
				if( $event_thumbnail == "Image" || empty($event_thumbnail) ){
					if(get_the_post_thumbnail($post_id, $item_size) <> ''){
						$img_html = '<div class="post_featured_image thumbnail_image">';
						$img_html = $img_html . get_the_post_thumbnail($post_id, $item_size);
						$img_html = $img_html . '</div>';
					}
					//echo '<div class="mask"><a href="'.get_permalink().'"#comments" class="anchor"><span> </span> <i class="fa fa-comment"></i></a><a href="'. get_permalink().'" class="anchor"> <i class="fa fa-link"></i></a></div>';
				}else if( $event_thumbnail == "Video" ){
					//Print Video
					if($video_url_type <> ''){
						$img_html = '<div class="post_featured_image thumbnail_image">';
						$img_html = $img_html . '<div class="blog-thumbnail-video">';
						//echo cp_get_width($item_size);
						if(cp_get_width($item_size) == '175'){
							$img_html = $img_html . cp_get_video($video_url_type, cp_get_width($item_size), cp_get_height($item_size));
						}else{
							$img_html = $img_html . cp_get_video($video_url_type, '100%', cp_get_height($item_size));
						}
						$img_html = $img_html . '</div></div>';
					}
				}else if ( $event_thumbnail == "Slider" ){
					//Print Slider
					$slider_xml = get_post_meta( intval($select_slider_type), 'cp-slider-xml', true); 				
					if($slider_xml <> ''){
						$slider_xml_dom = new DOMDocument();
						$slider_xml_dom->loadXML($slider_xml);
						$slider_name='bxslider'.$counter.$post_id;				
						//Included Anything Slider Script/Style
						wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
						wp_enqueue_script('cp-bx-slider');	
						wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
						if(cp_get_width($item_size) == '175'){
							$img_html = "<style>#'". $slider_name."'{width:'".cp_get_width($item_size)."'px;height:'".cp_get_height($item_size)."'px;float:left;}</style>";
						}else{
							$img_html = "<style>#'". $slider_name."'{width:100%;height:350px;float:left;}</style>";
						}
						$img_html = '<div class="post_featured_image thumbnail_image">';
						$img_html = $img_html . cp_print_bx_slider($slider_xml_dom->documentElement, $item_size,$slider_name);
						$img_html = $img_html . '</div>';
					}
				}
			}
			return $img_html;	
			
		}
		
		
		
		//Events Slider
		public function print_events_slider($item_xml){ 
			$category = cp_find_xml_value($item_xml, 'category');
			$event_layout = cp_find_xml_value($item_xml, 'event-layout');
			$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
			$style_event = cp_find_xml_value($item_xml, 'style');
			
			if($category == '0'){$category='';}
			global $EM_Events,$bp,$counter;
			?>
			<script>
				jQuery(document).ready(function ($) {
					"use strict";
					if ($('.event-carousel-<?php echo esc_js($counter);?>').length) {
						$('.event-carousel-<?php echo esc_js($counter);?>').bxSlider({
							speed: 1000,
							adaptiveHeight:true,
						});
					}
				});
			</script>
			<?php
			//Bx Slider Script Calling
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');

				wp_register_script('cp-calendar-js', CP_PATH_URL.'/frontend/shortcodes/js/jquery.countdown.min.js', false, '1.0', true);
				wp_enqueue_script('cp-calendar-js');

			if($event_layout == 'Layout 1'){
			echo '
			<div class="upcoming-section-2">
				<ul class="event-2-slider event-carousel-'.$counter.'">';
			
			}else if($event_layout == 'Layout 2'){
			echo '
			<div class="eco-upcoming-events">
				<ul id="eco-events-slider" class="event-carousel-'.$counter.'">';
			
			}else{
			
			}
			

			$order = 'DESC';
			$limit = 20;//Default limit
			$offset = '';		
			$rowno = 0;
			$event_count = 0;
			$EM_Events = EM_Events::get( array('category'=>'', 'group'=>'this','scope'=>'future', 'limit' => '20', 'order' => $order) );
			$events_count = count ( $EM_Events );	
			foreach ( $EM_Events as $event ) {
				/* @var $event EM_Event */
				if( ($rowno < $limit || empty($limit)) && ($event_count >= $offset || $offset === 0) ) {
					$rowno++;
					$class = ($rowno % 2) ? 'alternate' : '';
					// FIXME set to american
					$localised_start_date = date_i18n(get_option('dbem_date_format'), $event->start);
					$localised_end_date = date_i18n(get_option('dbem_date_format'), $event->end);
					$style = "";
					$today = date ( "Y-m-d" );
					if(!empty($event->location_id->name)){
							$location_summary = "<b>" . $event->get_location()->name . "</b><br/>" . $event->get_location()->address . " - " . $event->get_location()->town;
						}else{
							$location_summary = '';
						}
					if ($event->start_date < $today && $event->end_date < $today){
						$class .= " past";
					}
					//Check pending approval events
					if ( !$event->status ){
						$class .= " pending";
					}	
					
					$event_month_alpha = date('M',$event->start);
					$event_day = date('d',$event->start);
					$item_size_img = array(350,350);
					if($event_layout == 'Layout 1'){
						$item_size_img = array(614,614);
					}else if($event_layout == 'Layout 2'){
						$item_size_img = array(570,300);
					}else{
						$item_size_img = array(350,350);
					}
					//if($num_excerpt <> ''){ $num_excerpt = 120;}
					//Get Date in Parts
					$event_year = date('Y',$event->start);
					$event_month = date('m',$event->start);
					$event_month_alpha = date('M',$event->start);
					$event_day = date('d',$event->start);
					
					//Change time format
					$event_start_time_count = date("G,i,s", strtotime($event->start_time));
					$event_element_id = $counter.$event->event_id;?>
					<li>
						<div class="holder">
							
							<div class="frame">
								<a href="<?php esc_url(get_permalink())?>"><?php echo get_the_post_thumbnail($event->post_id, $item_size_img);?></a>
								<strong class="date"><?php echo esc_attr(date('d',$event->start));?><span><?php echo esc_attr(date('M',$event->start));?></span></strong>
							</div>
							<div class="text-box">
								<h3>
								<a href="<?php echo esc_url($event->guid);?>">
									<?php if (strlen($event->post_title) < 40 ){echo esc_attr(substr($event->post_title, 0 , 40));}else { echo esc_attr(substr($event->post_title, 0 , 40)) . '...'; }?>
								</a>
								</h3>
								<p><?php echo esc_attr(strip_tags(mb_substr($event->post_content,0,$num_excerpt)));?><a href="<?php echo esc_url($event->guid);?>">...[+]</a></p>
								
								<?php if($event_layout == 'Layout 1'){
											
											//Only for islamic and church version
											if($style_event == 'Islamic'){
												$event_custom_class = 'countdown-box-2';
											}else{
												$event_custom_class = '';
											}
								?>
								<div class="event-links">
									<a href="<?php echo esc_url($event->guid);?>" class="link"><i class="fa fa-clock-o"></i><?php echo esc_attr($event->start_time);?>. to <?php echo esc_attr($event->end_time);?>.</a>
									<a href="<?php echo esc_url($event->guid);?>" class="link"><i class="fa fa-map-marker"></i>
									<?php echo esc_attr($event->get_location()->location_address);?></a>
									
								</div>
								<div class="countdown-box <?php echo esc_attr($event_custom_class);?>">
									<script type="text/JavaScript">
										jQuery(function () {
											var austDay = new Date();
											austDay = new Date(<?php echo esc_js($event_year);?>, <?php echo esc_js($event_month);?>-1, <?php echo esc_js($event_day);?>,<?php echo esc_js($event_start_time_count);?>)
											jQuery('.defaultCountdown-<?php echo esc_js($event_element_id);?>').countdown({
												labels: ['<?php _e('Years','mosque_crunchpress');?>', '<?php _e('Months','mosque_crunchpress');?>', '<?php _e('Weeks','mosque_crunchpress');?>', '<?php _e('Days','mosque_crunchpress');?>', '<?php _e('Hrs','mosque_crunchpress');?>', '<?php _e('Min','mosque_crunchpress');?>', '<?php _e('Sec','mosque_crunchpress');?>'],
												until: austDay
											});
											jQuery('#year').text(austDay.getFullYear());
										});                
									</script>
									<div class="defaultCountdown-<?php echo esc_attr($event_element_id);?>"></div>
								</div>
								<?php }else{ ?>
								<div class="events-row">
									<a href="<?php echo esc_url($event->guid);?>" class="link"><i class="fa fa-clock-o"></i><?php echo esc_attr($event->start_time);?>. to <?php echo esc_attr($event->end_time);?>.</a>
									<a href="<?php echo esc_url($event->guid);?>" class="link"><i class="fa fa-map-marker"></i><?php echo esc_attr($event->get_location()->name);?>.</a>
								</div>
								<div class="outer">
									<div class="eco-event-time-box">
										<script type="text/JavaScript">
											jQuery(function () {
												var austDay = new Date();
												austDay = new Date(<?php echo esc_js($event_year);?>, <?php echo esc_js($event_month);?>-1, <?php echo esc_js($event_day);?>,<?php echo esc_js($event_start_time_count);?>)
												jQuery('.defaultCountdown-<?php echo esc_js($event_element_id);?>').countdown({
													labels: ['<?php _e('Years','mosque_crunchpress');?>', '<?php _e('Months','mosque_crunchpress');?>', '<?php _e('Weeks','mosque_crunchpress');?>', '<?php _e('Days','mosque_crunchpress');?>', '<?php _e('Hrs','mosque_crunchpress');?>', '<?php _e('Min','mosque_crunchpress');?>', '<?php _e('Sec','mosque_crunchpress');?>'],
													until: austDay
												});
												jQuery('#year').text(austDay.getFullYear());
											});                
										</script>
										<div class="defaultCountdown-<?php echo esc_attr($event_element_id);?>"></div>
									</div>
								</div>
								<?php } ?>
								<div class="btn-container">
									<a href="<?php echo esc_url($event->guid);?>" class="btn-3 large cp-color-3"><?php esc_html_e('Participate','mosque_crunchpress');?></a>
								</div>
							</div>
						</div>
					</li>
			<?php   
				}
			}
			echo ' </ul>		
      </div>';
		}
		
		
		
	}
}