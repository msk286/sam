<?php
//Condition for Parent Class
if(class_exists('function_library')){
	
	add_action( 'plugins_loaded', 'team_fun_override' );
	function team_fun_override() {
		$team_class = new cp_team_class;
	}

	class cp_team_class extends function_library{
		public $team_array = array(
		
			'image_icon' =>array(

				'type'=> 'image',
				
				'name'=> 'aa',

				'hr'=> 'none',

				'description'=> "fa fa-users"),
			
			"top-bar-div33-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div33'),	

			'header'=>array(

				'title'=> 'TEAM HEADER TITLE',

				'name'=> 'page-option-item-team-header-title',

				'type'=> 'inputtext'),
				
			'category'=>array(

				'title'=>'CHOOSE CATEGORY',

				'name'=>'page-option-category-team',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the team category you want the members to be fetched.'),	
			
			'layout_select'=>array(

				'title'=> 'SELECT LAYOUT',

				'name'=> 'cp-page-option-layout-team',

				'type'=> 'combobox',
				
				//'defualt'=> 'Simple Grid',

				'options'=>array('0'=>'Normal','1'=>'Modern','2'=>'Modern Square','3'=>'Modern Circle','4'=>'Small Members',),

			),	
				
			"top-bar-div33-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div33'),		
			
			"top-bar-div34-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div34'),	
			
			'num_excerpt'=>array(

				'title'=>'NUMBER OF EXCERPT',

				'name'=>'page-option-item-team-excerpt',

				'type'=> 'inputtext',

				'default'=> 200,

				'description'=>'Number of words to show on team member.'),
			
			'pagination'=>array(

				'title'=>'ENABLE PAGINATION',

				'name'=>'page-option-item-team-pagination',

				'type'=> 'combobox',

				'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

				'hr'=> 'none',

				'description'=>'Pagination will only appear when the number of posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),

			'num-fetch'=>array(					

				'title'=> 'NUM OF MEMBERS',

				'name'=> 'page-option-item-team-num-fetch',

				'type'=> 'inputtext',
				
				'class'=>'team-fetch-member',

				'default'=> 9,

				'description'=>'Set the number of team members to display on one page.'),
				
			"top-bar-div34-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div34'),			


		);
		
		public $team_slider = array(
		
			'image_icon' =>array(

				'type'=> 'image',
				
				'name'=> 'aa',

				'hr'=> 'none',

				'description'=> "fa fa-user"),
			
			"top-bar-div33331-open" => array( 'name'=>'div_start','type'=>'open' ,'class'=>'row-fluid','id'=>'cp-top-bar-div33331'),	

			// 'header'=>array(

				// 'title'=> 'TEAM HEADER TITLE',

				// 'name'=> 'page-option-item-team-header-slider',

				// 'type'=> 'inputtext'),
				
			'layout_select'=>array(

					'title'=> 'SELECT LAYOUT',

					'name'=> 'page-option-layout-team-slider',

					'type'=> 'combobox',
					
					'defualt'=> 'Simple Grid',

					'options'=>array('0'=>'Carousel Style','1'=>'2 Column Carousel'),

			),	
							
			'category'=>array(

				'title'=>'CHOOSE CATEGORY',

				'name'=>'page-option-category-team-slider',

				'options'=>array(),

				'type'=>'combobox_category',

				'hr'=> 'none',

				'description'=>'Choose the team category you want the members to be fetched.'),		
			
			'num_excerpt'=>array(

				'title'=>'NUMBER OF EXCERPT',

				'name'=>'page-option-item-team-excerpt-slider',

				'type'=> 'inputtext',

				'default'=> 200,

				'description'=>'Number of words to show on team member.'),
				
			"top-bar-div33331-close" => array( 'name'=>'div_end','type'=>'close','id'=>'cp-top-bar-div33331'),	
			


		);
		
		
		public $team_size_array =  array('element1-1'=>'1/1');			
			
		
		public function page_builder_size_class(){
		global $div_size;
			$div_size['Our-Team'] = $this->team_size_array;	  
			$div_size['Team-Slider'] = $this->team_size_array;	  
			
		}
		
		public function page_builder_element_class(){
		global $page_meta_boxes;
			$page_meta_boxes['Page Item']['name']['Our-Team'] = $this->team_array;
			$page_meta_boxes['Page Item']['name']['Team-Slider'] = $this->team_slider;
			//$page_meta_boxes['Page Item']['name']['Our-Team']['select_feature']['options'] = function_library::get_title_list_array( 'teams' );	
			$page_meta_boxes['Page Item']['name']['Our-Team']['category']['options'] = function_library::get_category_list_array( 'team-category' );
			$page_meta_boxes['Page Item']['name']['Team-Slider']['category']['options'] = function_library::get_category_list_array( 'team-category' );

		}
		
		public function __construct(){
			add_action( 'init', array( $this, 'create_ourteam' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_team_option' ) );
			add_action( 'save_post', array( $this, 'save_team_option_meta' ) );
		}

		
		
		
		public function create_ourteam() {
			//$portfolio_translation = get_option(THEME_NAME_S.'_cp_portfolio_slug','portfolio');
			
			$labels = array(
				'name' => _x('Our Team', 'Our Team General Name', 'mosque_crunchpress'),
				'singular_name' => _x('Our Team', 'Event Singular Name', 'mosque_crunchpress'),
				'add_new' => _x('Add New', 'Add New Our Team Name', 'mosque_crunchpress'),
				'add_new_item' => __('Add New Our Team', 'mosque_crunchpress'),
				'edit_item' => __('Edit Our Team', 'mosque_crunchpress'),
				'new_item' => __('New Our Team', 'mosque_crunchpress'),
				'view_item' => __('View Our Team', 'mosque_crunchpress'),
				'search_items' => __('Search Our Team', 'mosque_crunchpress'),
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
				'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
				'has_archive' => true,
				'rewrite' => array('slug' => '', 'with_front' => false)
			  ); 
			  
			register_post_type( 'team' , $args);	

			register_taxonomy(
				"team-category", array("team"), array(
					"hierarchical" => true,
					"label" => "Team Categories", 
					"singular_label" => "Team Categories", 
					"rewrite" => true));
			register_taxonomy_for_object_type('team-category', 'team');			
		}
		
		
		
		public function add_team_option(){	
		
			add_meta_box('team-option', __('Our Team Options','mosque_crunchpress'), array($this,'add_our_team_element'),
				'team', 'normal', 'high');
				
		}
		public function add_our_team_element(){
			$team_social = '';
			$sidebar_team = '';
			$right_sidebar_team = '';
			$left_sidebar_team = '';
			$team_designation = '';
			$team_facebook = '';
			$team_linkedin = '';
			$team_caption = '';
			$team_twitter = '';
			$google_plus = '';
		
		
		
		foreach($_REQUEST as $keys=>$values){
			$$keys = $values;
		}
		global $post;
		

		$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
		if($team_detail_xml <> ''){
			$cp_team_xml = new DOMDocument ();
			$cp_team_xml->loadXML ( $team_detail_xml );
			$team_social = function_library::cp_find_xml_value($cp_team_xml->documentElement,'team_social');
			$sidebar_team = function_library::cp_find_xml_value($cp_team_xml->documentElement,'sidebar_team');
			$left_sidebar_team = function_library::cp_find_xml_value($cp_team_xml->documentElement,'left_sidebar_team');
			$right_sidebar_team = function_library::cp_find_xml_value($cp_team_xml->documentElement,'right_sidebar_team');
			$team_designation = function_library::cp_find_xml_value($cp_team_xml->documentElement,'team_designation');
			$team_caption = function_library::cp_find_xml_value($cp_team_xml->documentElement,'team_caption');
			
			$team_facebook = function_library::cp_find_xml_value($cp_team_xml->documentElement,'team_facebook');
			$team_linkedin = function_library::cp_find_xml_value($cp_team_xml->documentElement,'team_linkedin');
			$team_twitter = function_library::cp_find_xml_value($cp_team_xml->documentElement,'team_twitter');
			$google_plus = function_library::cp_find_xml_value($cp_team_xml->documentElement,'google_plus');
		}
		?>
		<div class="event_options">
            <div class="op-gap">
				<ul class="panel-body recipe_class row-fluid">
					<li class="panel-input span12">
						<span class="panel-title">
							<h3 for="team_social" > <?php esc_html_e('SOCIAL NETWORKING', 'mosque_crunchpress'); ?> </h3>
						</span>	
						
						<label for="team_social"><div class="checkbox-switch <?php
						
						echo ($team_social=='enable' || ($team_social=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

					?>"></div></label>
					<input type="checkbox" name="team_social" class="checkbox-switch" value="disable" checked>
					<input type="checkbox" name="team_social" id="team_social" class="checkbox-switch" value="enable" <?php 
						
						echo ($team_social=='enable' || ($team_social=='' && empty($default)))? 'checked': ''; 
					
					?>>
					<p><?php esc_html_e('Turn On/Off Social Sharing on Team Detail.', 'mosque_crunchpress'); ?></p>
					</li>
					
				</ul>
				<div class="clear"></div>
				<?php echo function_library::show_sidebar($sidebar_team,'right_sidebar_team','left_sidebar_team',$right_sidebar_team,$left_sidebar_team);?>
				<div class="clear"></div>
				<div class="row-fluid">
					<div class="span6">
						<ul class="panel-body recipe_class">
							<li class="panel-input">
								<span class="panel-title">
									<h3 for="team_designation" > <?php esc_html_e('DESIGNATION', 'mosque_crunchpress'); ?> </h3>
								</span>
								<input type="text" name="team_designation" id="team_designation" value="<?php if($team_designation <> ''){echo $team_designation;};?>" />
								<p><?php esc_html_e('Please Enter Here Designation of the person.', 'mosque_crunchpress'); ?></p>
							</li>
						</ul>
					</div>
					<div class="span6">
						<ul class="panel-body recipe_class">
							<li class="panel-input">
								<span class="panel-title">
									<h3> <?php esc_html_e('Caption', 'mosque_crunchpress'); ?> </h3>
								</span>
								<input type="text" name="team_caption" id="team_caption" value="<?php if($team_caption <> ''){echo $team_caption;};?>" />
								<p><?php esc_html_e('Please Enter Here Caption.', 'mosque_crunchpress'); ?></p>
							</li>
						</ul>
					</div>
				</div>
				<div style="float:left;" class="add-music">
					<!--my start -->
					<ul class="recipe_class row-fluid cp_bg_image">
						<li class="panel-title time-start span5">
							<h4><i class="fa fa-text"></i> <?php _e('Field Name', 'mosque_crunchpress'); ?></h4>
							<input type="text" class="" id="add-track-name" value="Add Field Name" rel="Add Field Name">
						</li>

						<li class="panel-title border_left time_end span5">
							<h4><i class="fa fa-link"></i> <?php _e('Field Data', 'mosque_crunchpress'); ?></h4>
							<input id="upload_image_text" name="add-track-title" class="clearme" rel="<?php _e('Add Field Data','mosque_crunchpress')?>" type="text" value="<?php _e('Add Field Data','mosque_crunchpress')?>" />							
						</li>
						<li class="panel-title border_left delete_btn span2">
							<h4><i class="fa fa-pencil-square-o"></i><?php _e('Add Or Delete','mosque_crunchpress');?></h4>
							<div id="add-more-tracks" class="add-track-element"></div>
						</li>
					</ul>	
					<div class="clear"></div>
					<ul id="selected-element" class="selected-element nut_table_inner">
						<li class="default-element-item" id="element-item">
							<ul class="career_salary_class recipe_class row-fluid">
								<li class="panel-title span5">
									<input class="element-track-name" type="text" id="add-track-name" value="Add Field Name" rel="Add Field Name">
									<!--<span class="ingre-item-text"></span>-->
								</li>	
								<li class="panel-title border_left span5">
									<input id="upload_image_text" class="element-track-title" type="text" value="Add Field Data" rel="Add Field Data" />									
									<!--<input class="element-track-title" type="text" id="add-track-title" value="Add Track URL" rel="Add Track URL">-->
									<!--<span class="ingre-item-text"></span>-->
								</li>								
								<li class="panel-title border_left span2"><span class="panel-delete-element"></span></li>
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
										<li class="panel-title span5">
											<input class="" type="text" name="add-track-name[]" value="<?php echo $children_name->item($i)->nodeValue;?>">
										</li>	
										<li class="panel-title border_left span5">
											<input id="upload_image_text" class="element-track-title" type="text" name="add-track-title[]" value="<?php echo $children_title->item($i)->nodeValue;?>" />											
										</li>
										<li class="panel-title span2 border_left"><span class="panel-delete-element"></span></li>
									</ul>
								</li>
								<?php
							}
						} ?>
					</ul>
				</div>
				<div class="row-fluid">	
					<div class="span3">
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<h3 for="team_facebook" > <?php esc_html_e('Facebook Profile', 'mosque_crunchpress'); ?> </h3>
							</li>				
							<li class="panel-input">
								<input type="text" name="team_facebook" id="team_facebook" value="<?php if($team_facebook <> ''){echo $team_facebook;};?>" />
							</li>
							<p><?php esc_html_e('Please Enter Url for social profile.', 'mosque_crunchpress'); ?></p>
						</ul>	                
					</div>
					<div class="span3">
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<h3 for="team_linkedin" > <?php esc_html_e('Linked In Profile', 'mosque_crunchpress'); ?> </h3>
							</li>				
							<li class="panel-input">
								<input type="text" name="team_linkedin" id="team_linkedin" value="<?php if($team_linkedin <> ''){echo $team_linkedin;};?>" />
							</li>
							<p><?php esc_html_e('Please Enter Url for social profile.', 'mosque_crunchpress'); ?></p>
						</ul>	
					</div>
					<div class="span3">
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<h3 for="team_twitter" > <?php esc_html_e('Twitter Profile', 'mosque_crunchpress'); ?> </h3>
							</li>				
							<li class="panel-input">
								<input type="text" name="team_twitter" id="team_twitter" value="<?php if($team_twitter <> ''){echo $team_twitter;};?>" />
							</li>
							<p><?php esc_html_e('Please Enter Url for social profile.', 'mosque_crunchpress'); ?></p>
						</ul>		                
					</div>
					<div class="span3">
						<ul class="panel-body recipe_class">
							<li class="panel-title">
								<h3> <?php esc_html_e('Google Plus', 'mosque_crunchpress'); ?> </h3>
							</li>				
							<li class="panel-input">
								<input type="text" name="google_plus" id="google_plus" value="<?php if($google_plus <> ''){echo $google_plus;};?>" />
							</li>
							<p><?php esc_html_e('Please Enter Url for social profile.', 'mosque_crunchpress'); ?></p>
						</ul>		                
					</div>
                </div>                		
				<input type="hidden" name="team_submit" value="teams"/>
				<div class="clear"></div>
			</div>	
        </div>
		<?php }
		
		public function save_team_option_meta($post_id){
			
			$team_social = '';
			$sidebars = '';
			$right_sidebar_team = '';
			$left_sidebar_team = '';
			$team_facebook = '';
			$team_linkedin = '';
			$team_twitter = '';
			$google_plus = '';
			
			foreach($_REQUEST as $keys=>$values){
				$$keys = $values;
			}
		
			if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		
				if(isset($team_submit) AND $team_submit == 'teams'){
					$new_data = '<team_detail>';
					$new_data = $new_data . function_library::create_xml_tag('team_social',$team_social);
					$new_data = $new_data . function_library::create_xml_tag('sidebar_team',$sidebars);
					$new_data = $new_data . function_library::create_xml_tag('right_sidebar_team',$right_sidebar_team);
					$new_data = $new_data . function_library::create_xml_tag('left_sidebar_team',$left_sidebar_team);
					$new_data = $new_data . function_library::create_xml_tag('team_designation',$team_designation);
					$new_data = $new_data . function_library::create_xml_tag('team_caption',$team_caption);
					$new_data = $new_data . function_library::create_xml_tag('team_facebook',$team_facebook);
					$new_data = $new_data . function_library::create_xml_tag('team_linkedin',$team_linkedin);
					$new_data = $new_data . function_library::create_xml_tag('team_twitter',$team_twitter);
					$new_data = $new_data . function_library::create_xml_tag('google_plus',$google_plus);
					$new_data = $new_data . '</team_detail>';
				
				//Saving Sidebar and Social Sharing Settings as XML
				$old_data = get_post_meta($post_id, 'team_detail_xml',true);
				function_library::save_meta_data($post_id, $new_data, $old_data, 'team_detail_xml');
				
				
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
		
	//Team Slider	
	function print_team_item_slider($item_xml){
		$layout_select = cp_find_xml_value($item_xml, 'layout_select');
		$category = cp_find_xml_value($item_xml, 'category');
		$num_excerpt = cp_find_xml_value($item_xml, 'num_excerpt');
		
		
		if($category == '0'){
			//Post Query
			query_posts(
				array( 
				'post_type' => 'team',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC' )
			);
		}else{
			//Post Query
			query_posts(
				array( 
				'post_type' => 'team',
				'posts_per_page' => -1,
				'tax_query' => array(
					array(
						'taxonomy' => 'team-category',
						'terms' => $category,
						'field' => 'term_id',
					)
				),
				'orderby' => 'title',
				'order' => 'ASC' )
			);
		}
			
		if ($layout_select == 'Carousel Style'){
			echo '			
				<div class="row">
					<div class="controls">
					  <button class="btn prev"><i class="fa fa-chevron-left"></i></button>
					  <button class="btn next"><i class="fa fa-chevron-right"></i></button>
					</div>
					<div class="frame" id="centered">
						<ul>';
						//Start loop
						while( have_posts() ){
						the_post();	
						
						global $post;
							//Team Detail Other Elements
							$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
							if($team_detail_xml <> ''){
								$cp_team_xml = new DOMDocument ();
								$cp_team_xml->loadXML ( $team_detail_xml );
								$team_designation = cp_find_xml_value($cp_team_xml->documentElement,'team_designation');
								$team_facebook = cp_find_xml_value($cp_team_xml->documentElement,'team_facebook');
								$team_linkedin = cp_find_xml_value($cp_team_xml->documentElement,'team_linkedin');
								$team_twitter = cp_find_xml_value($cp_team_xml->documentElement,'team_twitter');
								$google_plus = cp_find_xml_value($cp_team_xml->documentElement,'google_plus');
								
							}
							
							  echo '<li>'.get_the_post_thumbnail($post->ID, array(270,270)).'
										<div class="cinfo">
											<h4>'.get_the_title().'</h4>
											<strong>'.$team_designation.'</strong>
											<p>'.substr(get_the_content(),0,50).'</p>
											<div class="team-social">';
												if($team_facebook <> ''){
													echo '<a href="'.esc_url($team_facebook).'" title="Facebook"><i class="fa fa-facebook-square"></i></a>';
												}
												if($team_linkedin <> ''){
													echo '<a href="'.esc_url($team_linkedin).'" title="Linkedin"><i class="fa fa-linkedin-square"></i></a>';
												}
												if($google_plus <> ''){
													echo '<a href="'.esc_url($google_plus).'" title="Gplus"><i class="fa fa-google-plus-square"></i></a>';
												}
												if($team_twitter <> ''){
													echo '<a href="'.esc_url($team_twitter).'" title="Twitter"><i class="fa fa-twitter-square"></i></a>';
												}								
											echo '</div>
										</div>
									</li>';
						
						}//End While Loop
			
			echo ' </ul>
			</div>
			<div class="scrollbar">
				<div class="handle">
					<div class="mousearea"></div>
				</div>
			</div>
		</div>';
			
		
		}else {
			echo '
				<div class="cp_our-chefs">
				<script type="text/javascript">
					jQuery(document).ready(function ($) {
						"use strict";
						if ($(".chefs-carousel").length) {
							$(".chefs-carousel").bxSlider({
								auto: true,
								speed: 1600,
								minSlides: 1,
								maxSlides: 2,
								slideWidth: 550,
								autoHover: true,
								slideMargin: 30,
							});
						}
					});
				</script>
				<ul class="chefs-carousel">';
				//Start loop
						$counter_carouel = 0;
						$item_class = '';
						while( have_posts() ){
						the_post();	
						
						global $post;
							$team_designation = '';
							//Team Detail Other Elements
							$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
							if($team_detail_xml <> ''){
								$cp_team_xml = new DOMDocument ();
								$cp_team_xml->loadXML ( $team_detail_xml );
								$team_designation = cp_find_xml_value($cp_team_xml->documentElement,'team_designation');
								$team_facebook = cp_find_xml_value($cp_team_xml->documentElement,'team_facebook');
								$team_linkedin = cp_find_xml_value($cp_team_xml->documentElement,'team_linkedin');
								$team_twitter = cp_find_xml_value($cp_team_xml->documentElement,'team_twitter');
								$google_plus = cp_find_xml_value($cp_team_xml->documentElement,'google_plus');
								
							}
							if($counter_carouel % 2 == 0){$item_class = 'text-left';}else{$item_class = 'text-right';}$counter_carouel++;
					echo '
						<li>
							<div class="chef-info text-left">
								<div class="thumb"> '.get_the_post_thumbnail($post->ID, array(350,350)).' </div>
								<div class="text"> <strong class="title"><a href="'.get_permalink().'">'.get_the_title().'</a></strong> <span>'.$team_designation.'</span>
									<p>'.substr(strip_tags(get_the_content()),0,120).'</p>
									<a href="'.get_permalink().'" class="more">'.esc_html__('More info','mosque_crunchpress').'</a>
									<ul class="social-links">';
										if($team_facebook <> ''){
											echo '<li><a href="'.esc_url($team_facebook).'" title="Facebook"><i class="fa fa-facebook-square"></i></a></li>';
										}
										if($team_linkedin <> ''){
											echo '<li><a href="'.esc_url($team_linkedin).'" title="Linkedin"><i class="fa fa-linkedin-square"></i></a></li>';
										}
										if($google_plus <> ''){
											echo '<li><a href="'.esc_url($google_plus).'" title="Gplus"><i class="fa fa-google-plus-square"></i></a></li>';
										}
										if($team_twitter <> ''){
											echo '<li><a href="'.esc_url($team_twitter).'" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>';
										}	
										if($team_twitter <> ''){
											echo '<li><a href="'.esc_url($team_twitter).'" title="Instagram"><i class="fa fa-instagram"></i></a></li>';
										}	
									echo '</ul>
								</div>
							</div>
						</li>';
					}
					echo '
				</ul></div>';
		
		}	
	} // Function Ends
		
		// Print Event item
		function print_team_item($item_xml){

			
			global $paged,$sidebar,$team_div_size_num_class,$post,$counter;
			
			if(empty($paged)){
				$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
			}
				
			$category = cp_find_xml_value($item_xml, 'category');
			// get the blog meta value		
			$header = cp_find_xml_value($item_xml, 'header');
			$layout_select = cp_find_xml_value($item_xml, 'layout_select');
			
			$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
			$num_excerpt = cp_find_xml_value($item_xml, 'num_excerpt');
			
			if($category == '0'){
				//Post Query
				query_posts(
					array( 
					'post_type' => 'team',
					'posts_per_page' => $num_fetch,
					'paged'	=>	$paged,
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}else{
				//Post Query
				query_posts(
					array( 
					'post_type' => 'team',
					'posts_per_page' => $num_fetch,
					'paged'			=>	$paged,
					'tax_query' => array(
						array(
							'taxonomy' => 'team-category',
							'terms' => $category,
							'field' => 'term_id',
						)
					),
					'orderby' => 'id',
					'order' => 'DESC' )
				);
			}
			$counter_team = 0;
			$wrap_class = '';
			if(have_posts()){
			if($layout_select == 'Normal'){$wrap_class = 'team-member';}else if($layout_select == 'Modern'){$wrap_class = 'team-section-2';}else if($layout_select == 'Modern Square'){$wrap_class='team-member our-staf';}else if($layout_select == 'Modern Circle'){$wrap_class='team-member our-staf';}else{}
			?>
			<div class="<?php echo $wrap_class;?>">
				<div class="row">				
					<?php
					//Print Header
					if(!empty($header)){
						echo '<div class="col-md-12"><h2 class="h-style">' . esc_attr($header) . '</h2></div>';
					}
					//Start loop
					while( have_posts() ){
					the_post();	
					
						global $post;
						//Team Detail Other Elements
						$team_detail_xml = get_post_meta($post->ID, 'team_detail_xml', true);
						if($team_detail_xml <> ''){
							$cp_team_xml = new DOMDocument ();
							$cp_team_xml->loadXML ( $team_detail_xml );
							$team_designation = cp_find_xml_value($cp_team_xml->documentElement,'team_designation');
							$team_facebook = cp_find_xml_value($cp_team_xml->documentElement,'team_facebook');
							$team_linkedin = cp_find_xml_value($cp_team_xml->documentElement,'team_linkedin');
							$team_twitter = cp_find_xml_value($cp_team_xml->documentElement,'team_twitter');
							$google_plus = cp_find_xml_value($cp_team_xml->documentElement,'google_plus');
							
						}
						//Line Break After Every Four Elements
						$first_class = '';
						$clear_div = '';
						//if($counter_team % 4 == 0){$first_class = 'first'; $clear_div = '<div class="clearfix"></div>';}else{}$counter_team++;
						// echo $clear_div;
						//Thumbnail for Team Members
						$thumbnail_id = get_post_thumbnail_id( $post->ID );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(350,350) ); 
						$thumbnail_img = wp_get_attachment_image_src( $thumbnail_id , 'full' );
						if($layout_select == 'Normal'){
							if($counter_team % 2 == 0){echo '<div class="clearfix"></div>';}else{}$counter_team++;
						?>		
						<div class="col-md-6 col-sm-6 ">
							<div class="team-member-box">
								<div class="frame">
									<?php echo get_the_post_thumbnail($post->ID, array(270,270));?>
									<div class="caption">
										<a href="<?php echo esc_url($thumbnail_img[0]);?>" class="zoom" data-gal="prettyPhoto[gallery1]"><i class="fa fa-search-plus"></i></a>
									</div>
								</div>
								<div class="text-box">
									<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
									<?php if($team_designation <> ''){ ?><strong class="destination"><?php echo esc_attr($team_designation);?></strong><?php }?>							
									<p><?php echo mb_substr(esc_attr(get_the_content()),0,$num_excerpt);?> </p>
									<ul class="team-social">
										<?php if(isset($team_facebook) AND $team_facebook <> ''){?>
											<li><a href="<?php echo esc_url($team_facebook);?>"><i class="fa fa-facebook"></i></a></li>
										<?php }?>
										<?php if(isset($team_twitter) AND $team_twitter <> ''){?>
											<li><a href="<?php echo esc_url($team_twitter);?>"><i class="fa fa-twitter"></i></a></li>
										<?php }?>
										<?php if(isset($team_linkedin) AND $team_linkedin <> ''){?>
											<li><a href="<?php echo esc_url($team_linkedin);?>"><i class="fa fa-linkedin"></i></a></li>
										<?php }?>
										<?php if(isset($google_plus) AND $google_plus <> ''){?>
											<li><a href="<?php echo esc_url($google_plus);?>"><i class="fa fa-google-plus"></i></a></li>
										<?php }?>
									</ul>
								</div>
							</div>
						</div>
					<?php 
						}else if($layout_select == 'Modern'){ ?>
						<div class="col-md-4">
							<div class="team-box-2">
								<div class="frame"><a href="<?php echo esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail($post->ID, array(350,350));?></a></div>
								<div class="text-box">
									<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
									<?php if($team_designation <> ''){ ?><strong class="designation"><?php echo esc_attr($team_designation);?></strong><?php }?>								
									<?php echo strip_tags(substr(get_the_content(),0,$num_excerpt));?>
									<ul class="team-social-3">
										<?php if(isset($team_facebook) AND $team_facebook <> ''){?>
											<li><a href="<?php echo esc_url($team_facebook);?>"><i class="fa fa-facebook"></i></a></li>
										<?php }?>
										<?php if(isset($team_twitter) AND $team_twitter <> ''){?>
											<li><a href="<?php echo esc_url($team_twitter);?>"><i class="fa fa-twitter"></i></a></li>
										<?php }?>
										<?php if(isset($team_linkedin) AND $team_linkedin <> ''){?>
											<li><a href="<?php echo esc_url($team_linkedin);?>"><i class="fa fa-linkedin"></i></a></li>
										<?php }?>
										<?php if(isset($google_plus) AND $google_plus <> ''){?>
											<li><a href="<?php echo esc_url($google_plus);?>"><i class="fa fa-google-plus"></i></a></li>
										<?php }?>
										
									</ul>
								</div>
							</div>
						</div>
					<?php
						}else if($layout_select == 'Modern Square'){ ?>
						<div class="col-md-3">
							<div class="box">
								<div class="frame">
									<a href="<?php echo esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail($post->ID, array(350,350));?></a>
									<div class="caption"><a href="<?php echo esc_url(get_permalink());?>" class="link"><i class="fa fa-link"></i></a></div>
								</div>
								<div class="text-box">
									<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
									<?php if($team_designation <> ''){ ?><strong class="designation"><?php echo esc_attr($team_designation);?></strong><?php }?>								
								</div>
							</div>
						</div>	
						<?php
						}else if($layout_select == 'Modern Circle'){ ?>
							<div class="col-md-3">
								<div class="box">
									<div class="frame frame-2">
										<a href="<?php echo esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail($post->ID, array(350,350));?></a>
									</div>
									<div class="text-box">
										<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
										<?php if($team_designation <> ''){ ?><strong class="designation"><?php echo esc_attr($team_designation);?></strong><?php }?>								
									</div>
								</div>
							</div>
						<?php
						}else if($layout_select == 'Small Members'){ ?>
							<div class="col-md-2">
								<div class="other-members-box">
									<div class="frame">
										<a href="<?php echo esc_url(get_permalink());?>"><?php echo get_the_post_thumbnail($post->ID, array(350,350));?></a>
										<div class="caption">
											<h3><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_attr(get_the_title());?></a></h3>
											<?php if($team_designation <> ''){ ?><strong class="designation"><?php echo esc_attr($team_designation);?></strong><?php }?>
										</div>
									</div>
								</div>
							</div>
						<?php
						}else{
						
						}
					}
					wp_reset_postdata();
				}wp_reset_query();	
					?>
				</div>
			</div>	
		<?php
			
		}// End Team Function for Frontend	
		
		
	}
}	
