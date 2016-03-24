<?php 
	/*	

	*	CrunchPress Page Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file create and contains the page post_type meta elements
	*	---------------------------------------------------------------------
	*/

	// a type that each element can be ( also set in page-dragging.js )

	
	$div_size = array(		
	
		'Blog' => array('element1-1'=>'1/1', 'element2-3'=>'2/3'),
		
		'Blog-Slider' => array('element1-1'=>'1/1'),
		
		'Modern-Blog' => array('element1-1'=>'1/1','element3-4'=>'3/4'),
			
		'Timeline' => array('element1-2'=>'1/2','element1-1'=>'1/1'),		

		'Crowd-Funding' => array('element1-1'=>'1/1'),
		
		'Feature-Projects' => array('element1-1'=>'1/1'),
		
		'Crowd-Slider' => array('element1-1'=>'1/1'),

		'News' => array('element1-1'=>'1/1'),

		'Contact-Form' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element3-4'=>'3/4',

			'element1-1'=>'1/1'),
		
		'Content' => array(

			'element1-4'=>'1/4',

			'element1-3'=>'1/3',

			'element1-2'=>'1/2',

			'element2-3'=>'2/3',

			'element1-3'=>'3/4',

			'element1-1'=>'1/1'),
	);

	

	// the element in page options

	$page_meta_boxes = array(
		
		"Top Content Header" => array( 'type'=>'header', 'name'=>'header_start','inner'=>'','title'=>'Page Options','class'=>'content', 'id'=>'cp-show-content-header'),
		
		"Top Content Open" => array( 'type'=>'open', 'name'=>'cp-open','class'=>'container-fluid', 'id'=>'cp-options-content'),
		
		"CP Div0001 Open" => array( 'type'=>'open', 'name'=>'cp-open','class'=>'row-fluid', 'id'=>'cp-div-0001'),
		
		// 'Facebook Fan'=>array(

			// 'title'=>'FACEBOOK FAN PAGE',

			// 'name'=>'page-option-item-facebook-selection',

			// 'options'=>array('0'=>'Yes','1'=>'No'),

			// 'type'=>'combobox',
			
			// 'default' => 'No',
			
			// 'class'=> '',

			// 'hr'=>'none',

			// 'description'=>'Do you want to set this page as facebook fan page.'),
			
		 "Header Style" => array(

			'title'=> esc_html__('Header Style', 'mosque_crunchpress'),

			 'name'=>'page-option-top-header-style',

			// 'options'=>array('1'=>'Style 1','2'=>'Style 2','3'=>'Style 3','4'=>'Style 4','5'=>'Style 5','6'=>'Style 6','7'=>'Style 7'),
			
			'options'=>array('1'=>'Style 1','2'=>'Style 2'),

			 'type'=>'combobox',
			
			 'default'=> 'Style 1',

			 'hr'=>'none',

			 'description' => 'Select page header style from dropdown theme has multiple header style that will help you to built custom layout.'

		 ),	
		 
		 'page-title'=>array(					

			'title'=> 'PAGE TITLE',

			'name'=> 'page-option-item-page-title',

			'type'=> 'inputtext',

			'default'=> '',
			
			'class'=> 'page-title-here',

			'description'=>'Please Write Title For page to show at top of content start.'),
		 
		 'page_caption'=>array(					

				'title'=> 'Page Caption',

				'name'=> 'cp-show-page-caption-pageant',

				'type'=> 'inputtext',
				
				'default'=> 'There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some form.',

				'description'=>'Place Page Caption Here.'),	
		 
		
		"CP Div0001 Close" => array( 'type'=>'close', 'name'=>'cp-close','class'=>'row-fluid', 'id'=>'cp-div-0001'),
		
		
		"CP Div0 Open" => array( 'type'=>'open', 'name'=>'cp-open','class'=>'row-fluid', 'id'=>'cp-div-0'),
		

		"CP Div0 Close" => array( 'type'=>'close', 'name'=>'cp-close','class'=>'row-fluid', 'id'=>'cp-div-0'),
		
		"CP Div Open" => array( 'type'=>'open', 'name'=>'cp-close','class'=>'row-fluid', 'id'=>'cp-div-1'),
		
		"Top Slider On" => array(

			'title'=> esc_html__('MAIN SLIDER', 'mosque_crunchpress'),

			'name'=>'page-option-top-slider-on',

			'options'=>array('0'=>'Yes','1'=>'No'),

			'type'=>'combobox',
			
			'default'=> 'No',

			'hr'=>'none',

			'description' => 'Activate Or Deactivate Main Slider On Page. selecting no page title field will appear where you can add page title.'

		),		
		
		"Top Slider Type" => array(

			'title'=> esc_html__('TOP SLIDER TYPE', 'mosque_crunchpress'),

			'name'=>'page-option-top-slider-types',

			'options'=>array('0'=>'Bx-Slider','1'=>'Layer-Slider','2'=>'Add-Shortcode'),

			'type'=>'combobox',
			
			'default' => 'no-slider',
			
			'class'=>'slider-default-selection',

			'hr'=>'none',

			'description' => 'Top slider is the slider under the main navigation menu and above the page template( so it will always be full width ).'

		),
		
		"Top Slider Images" => array(

			'title'=> esc_html__('TOP SLIDER SLIDE IMAGES', 'mosque_crunchpress'),

			'name'=>'page-option-top-slider-images',

			'options'=>array(),

			'type'=>'combobox_post',
			
			'class'=>'slider-default',

			'hr'=>'none',

			'description' => 'Top slider comes top of the page select image slide for default sliders..'

		),
		
		'post_slider_category'=>array(

			'title'=>'CHOOSE CATEGORY TO FETCH POSTS',

			'name'=>'page-option-post-slider-category-fetch',

			'options'=>array(),

			'type'=>'combobox_category_main',
			
			'class'=> 'post_slider_category_main slider-default',

			'description'=>'Choose the post category you want to fetch the posts to show in Main Slider.'),	
		
		"CP Div Close" => array( 'type'=>'close','name'=>'cp-close','id'=>'cp-div-1'),
		
		"CP Div2 Open" => array( 'type'=>'open', 'name'=>'cp-open','class'=>'row-fluid', 'id'=>'cp-div-2'),
		
		
		"Top Slider Layer" => array(

			'title'=> esc_html__('TOP LAYER SLIDER ID', 'mosque_crunchpress'),

			'name'=>'page-option-top-slider-layer',

			'options'=>array(),

			'type'=>'combobox',
			
			'class'=>'slider-layer',

			'hr'=>'none',

			'description' => 'Top Slider Layer shortcode for main slider.'

		),
		
		"Top Slider Shortcode" => array(

			'title'=> esc_html__('TOP SLIDER SHORTCODE', 'mosque_crunchpress'),

			'name'=>'page-option-top-slider-shortcode',

			'default'=>	'[shortcode_xyz][/shortcode_xyz]',

			'type'=>'inputtext',
			
			'class'=>'slider-none',

			'hr'=>'none',

			'description' => 'Add top slider shortcode if any other slider you want to add other than default sliders.'

		),
		
		
			
		"CP Div2 Close" => array( 'type'=>'close','name'=>'cp-close','id'=>'cp-div-2'),
		
		"CP Div3 Open" => array( 'type'=>'open', 'class'=>'row-fluid', 'id'=>'cp-div-3'),
		
		"schedule_text" => array(

			'title'=> esc_html__('Schedule Text', 'mosque_crunchpress'),

			'name'=>'page-option-schedule-title',			

			'type'=>'inputtext',
			
			'class'=>'slider-default',

			'hr'=>'none',

			'description' => 'Add heading for your schedule.'

		),
			
		"schedule" => array(

				'title'=> esc_html__('Schedule Management', 'mosque_crunchpress'),

				'name'=>'page-option-top-schedule-mana',

				'options'=>array('0'=>'No-Option','1'=>'Classes','2'=>'Events','3'=>'Services'),

				'type'=>'combobox',
				
				'default' => 'Classes',
				
				'class'=>'schedule-selection slider-default',

				'hr'=>'none',

				'description' => 'You can manage your events, classes or services schedule over slider by selecting version of your choice.'

			),
			
		'schedule-category-event'=>array(

			'title'=>'CHOOSE CATEGORY',

			'name'=>'schedule_category_events',

			'options'=>array(),

			'type'=>'combobox_category_main',
			
			'class'=> 'schedule-category-ev manage_schedule_cp slider-default',

			'description'=>'Choose the post category you want to fetch the posts to shwo in news headline.'),	
		
		'schedule-category-classes'=>array(

			'title'=>'CHOOSE CATEGORY',

			'name'=>'schedule_category_class',

			'options'=>array(),

			'type'=>'combobox_category_main',
			
			'class'=> 'schedule-category-cl manage_schedule_cp slider-default',

			'description'=>'Choose the post category you want to fetch the posts to shwo in news headline.'),	
			
		'schedule-category-services'=>array(

			'title'=>'CHOOSE CATEGORY',

			'name'=>'schedule_category_services',

			'options'=>array(),

			'type'=>'combobox_category_main',
			
			'class'=> 'schedule-category-sr manage_schedule_cp slider-default',

			'description'=>'Choose the post category you want to fetch the posts to shwo in news headline.'),		
		
		"CP Div3 Close" => array( 'type'=>'close','id'=>'cp-div-3'),
		
		
		
		"Top Sidebar Header" => array( 'type'=>'header', 'name'=>'header-open','inner'=>'Yes','title'=>'Page Sidebar','class'=>'cp-div-5', 'id'=>'cp-show-sidebar-header'),
		
		"CP Div5 Open" => array( 'type'=>'open', 'name'=>'cp-open','class'=>'row-fluid full_class', 'id'=>'cp-div-5'),	
		
		"Page Sidebar Template" => array(

			'title'=> esc_html__('SELECT LAYOUT', 'mosque_crunchpress'), 

			'name'=>'page-option-sidebar-template', 
			
			'id'=>'page-option-sidebar-template', 

			'type'=>'radioimage', 

			'default'=>'no-sidebar',

			'hr'=>'none',

			'options'=>array(

				'1'=>array('value'=>'right-sidebar','image'=>'/framework/images/right-sidebar.png'),

				'2'=>array('value'=>'left-sidebar','image'=>'/framework/images/left-sidebar.png'),

				'3'=>array('value'=>'both-sidebar','image'=>'/framework/images/both-sidebar.png'),
				
				'4'=>array('value'=>'both-sidebar-left','image'=>'/framework/images/both-sidebar-left.png'),
				
				'5'=>array('value'=>'both-sidebar-right','image'=>'/framework/images/both-sidebar-right.png'),

				'6'=>array('value'=>'no-sidebar','image'=>'/framework/images/no-sidebar.png','default'=>'selected')

			)

		),
		
		"CP Div5 Close" => array( 'type'=>'close','name'=>'cp-close','id'=>'cp-div-5'),
		
		"CP Div6 Open" => array( 'type'=>'open', 'name'=>'cp-open','class'=>'row-fluid half_class', 'id'=>'cp-div-6'),	

		"Choose Left Sidebar" => array(

			'title'=> esc_html__('CHOOSE LEFT SIDEBAR', 'mosque_crunchpress'),

			'name'=>'page-option-choose-left-sidebar',

			'type'=>'combobox',
			
			'class'=> '',

			'hr'=>'none'

		),		

		

		"Choose Right Sidebar" => array(

			'title'=> esc_html__('CHOOSE RIGHT SIDEBAR', 'mosque_crunchpress'),

			'name'=>'page-option-choose-right-sidebar',
			
			'class'=> '',

			'type'=>'combobox',

		),
		
		"CP Div6 Close" => array( 'type'=>'close','name'=>'cp-close','id'=>'cp-div-6'),
		
		
		
		"Top Content Close" => array( 'type'=>'close' ,'name'=>'cp-close','id'=>'cp-show-content-options'),
		
		"Top Page Header" => array( 'type'=>'header', 'name'=>'cp-header','inner'=>'','title'=>'Page Elements','class'=>'common-class', 'id'=>'cp-show-page-header'),
		
		'page-builder-full' => array(					

			'title'=> 'TURN ON/OFF PAGE BUILDER FULL LAYOUT',

			'name'=> 'cp-show-full-layout',

			'type'=> 'combobox',
			
			'class'=>'full-width',
			
			'default'=> 'No',

			'options'=>array('0'=>'Yes','1'=>'No'),

			'description'=>'You can manage your Pagebuilder layout full width and inside container.'),
		
		"Page Item" => array(

			'item'=>'page-option-item-type' ,

			'size'=>'page-option-item-size', 

			'xml'=>'page-option-item-xml', 

			'type'=>'page-option-item',

			'name'=>array(
				
				'Content' => array(
					
					'image_icon' =>array(

						'type'=> 'image',

						'hr'=> 'none',
						
						'name'=> '',

						'description'=> "fa fa-file-text"),
				
					"top-bar-div1-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div1'),
				
					'text'=>array(

						'title'=> 'Content Title / Description',

						'name'=> 'page-option-item-content-text-des',

						'type'=> 'description',

						'hr'=> 'none',

						'description'=> "Please Set your Content Options from bottom Content Title and Content Description."),
						
					'title'=>array(					

						'title'=> 'CONTENT TITLE',

						'name'=> 'cp-show-content-title',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes','1'=>'No'),
						
						'class'=> '',

						'description'=>'You can Turn On/Off Page Title /Content Title On This Page.'),
					
					'description'=>array(					

						'title'=> 'CONTENT DESCRIPTION',

						'name'=> 'cp-show-content-descrip',

						'type'=> 'combobox',

						'options'=>array('0'=>'Yes','1'=>'No'),
						
						'class'=> '',

						'description'=>'You can Turn On/Off Page Description /Content Description  On Page.'),		
					
					"top-bar-div1-close" => array( 'type'=>'close','name'=>'cp-close','id'=>'cp-top-bar-div1'),	
				),
				
				'Crowd-Funding' => array(

					'image_icon' =>array(

						'type'=> 'image','name'=> 'cp-icon',

						'hr'=> 'none',

						'description'=> "fa fa-credit-card"),
					
					"top-bar-div117-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div117'),
					
					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-item-ignition-header-title',

						'type'=> 'inputtext'
					),

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-ignition-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the category you want the Items to be fetched.'
					),
					
					'layout_select'=>array(

						'title'=>'Select Layout',

						'name'=>'page-option-item-ignition-layout',

						'type'=> 'combobox',

						'options'=>array('0'=>'Full Width','1'=>'Grid','2'=>'Grid Compact'),

						'hr'=> 'none',

						'description'=>'Select Causes Layout.'),
					
					
					
					"top-bar-div117-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div117'),
					
					"top-bar-div118-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div118'),	
					
					'num-excerpt'=>array(

						'title'=> 'LENGHT OF EXCERPT',

						'name'=> 'page-option-item-ignition-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 150,

						'description'=>'This is the number of content character to show on each post.'
					),
					
					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-igni-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),			
					
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF POSTS',

						'name'=> 'page-option-item-igni-num-fetch',

						'type'=> 'inputtext',
						
						'class'=> 'igni-fetch-item',

						'default'=> 5,

						'description'=>'Set the number of posts fetched on one page.'),	
						
					"top-bar-div118-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div118'),
					
				),
				
				
				'Feature-Projects' => array(

					'image_icon' =>array(

						'type'=> 'image','name'=> 'cp-icon',

						'hr'=> 'none',

						'description'=> "fa fa-hand-o-up"),
					
					"top-bar-div4117-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div4117'),
					
					'header'=>array(

						'title'=> 'HEADER TITLE',

						'name'=> 'page-option-fea-ignition-header-title',

						'type'=> 'inputtext'
					),

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-fea-ignition-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the category you want the Items to be fetched.'
					),
					
					
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF POSTS',

						'name'=> 'page-option-item-feature-project-num-fetch',

						'type'=> 'inputtext',
						
						'class'=> 'feature-pro-fetch-item',

						'default'=> 5,

						'description'=>'Set the number of projects fetched on one page, leaving blank.'),			
						
					"top-bar-div4117-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div4117'),
					
					"top-bar-div8484-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div8484'),
					
					'view_all_link'=>array(					

						'title'=> 'View All Link',

						'name'=> 'page-option-item-feature-view-all-link',

						'type'=> 'inputtext',
						
						'class'=> 'feature-pro-link-item',

						'description'=>'Add The URL OF The View All Page.'),	
					
					"top-bar-div8484-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div8484'),
					
				),
				
				'Crowd-Slider' => array(

					'image_icon' =>array(

						'type'=> 'image','name'=> 'cp-icon',

						'hr'=> 'none',

						'description'=> "fa fa-sliders"),
					
					"top-bar-div185open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div185'),
					
					'header'=>array(

						'title'=> 'SLIDER TITLE',

						'name'=> 'page-option-item-ignition-slider-title',

						'type'=> 'inputtext'
					),

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-ignition-category-slider',

						'options'=>array(),

						'type'=>'combobox_category',

						'hr'=> 'none',

						'description'=>'Choose the category you want the Items to be fetched.'
					),
					
					'num-fetch'=>array(

						'title'=> 'NUMBER OF POSTS',

						'name'=> 'page-option-item-ignition-num-slider',

						'type'=> 'inputtext',

						'default'=> 150,

						'description'=>'This is the number of posts you want to display.'
					),
					
					"top-bar-div185-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div185'),
					
				),
				

				'Blog'=>array(
				
					'image_icon' =>array(

						'type'=> 'image','name'=> 'cp-icon',

						'hr'=> 'none',

						'description'=> "fa fa-edit"),
					
					"top-bar-div7-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div7'),					

					'header'=>array(

						'title'=> 'BLOG HEADER TITLE',

						'name'=> 'page-option-item-blog-header-title',
						
						'description'=>'Please add header title here it will be shown at top of this element.',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-blog-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the post category you want to fetch its post.'),
						
					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF DESCRIPTION',

						'name'=> 'page-option-item-blog-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 100,

						'description'=>'Set the number of content character of each post.'),		
						
					"top-bar-div7-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div7'),

					"top-bar-div8-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div8'),	

					'layout_select'=>array(

						'title'=>'Select Layout',

						'name'=>'page-option-item-blog-layout',

						'type'=> 'combobox',

						'options'=>array('0'=>'Full Width', '1'=>'Grid Style'),

						'hr'=> 'none',

						'description'=>'Select Blog Layout From Given Options.'),			

					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-blog-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),
					
					'num-fetch'=>array(					

						'title'=> 'NUMBER OF POSTS',

						'name'=> 'page-option-item-blog-num-fetch',

						'type'=> 'inputtext',
						
						'class'=> 'blog-fetch-item',

						'default'=> 5,

						'description'=>'Set the number of posts fetched on one page, leaving blank.'),	
						
					"top-bar-div8-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div8'),

				),
				
				'Blog-Slider'=>array(
				
					'image_icon' =>array(

						'type'=> 'image','name'=> 'cp-icon',

						'hr'=> 'none',

						'description'=> "fa fa-paper-plane"),
					
					"top-bar-div747-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div747'),					

					'header'=>array(

						'title'=> 'BLOG SLIDER HEADER TITLE',

						'name'=> 'page-option-item-blog-slider-header-title',
						
						'description'=>'Please add header title here it will be shown at top of this element.',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-blog-slider-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the post category you want to fetch its post.'),
					
					'blog-slider-type'=>array(

						'title'=>'SELECT LAYOUT',

						'name'=>'page-option-item-blog-slider-layout',

						'type'=> 'combobox',

						'options'=>array('0'=>'Carousel', '1'=>'Simple Grid'),

						'hr'=> 'none',

						'description'=>'Select layout for news, grid and full width layout given.'),

					"top-bar-div747-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div747'),

					"top-bar-div849-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div849'),	
					
					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF DESCRIPTION',

						'name'=> 'page-option-item-blog-slider-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 100,

						'description'=>'Set the number of content character of each post.'),	

					'num-fetch'=>array(					

						'title'=> 'NUMBER OF POSTS',

						'name'=> 'page-option-item-blog-slider-num-fetch',

						'type'=> 'inputtext',

						'description'=>'Set the number of posts fetched on one page, leaving blank.'),	
						
					"top-bar-div849-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div849'),

				),
				
				
				// 'Latest-News'=>array(
				
					// 'image_icon' =>array(

						// 'type'=> 'image','name'=> 'cp-icon',

						// 'hr'=> 'none',

						// 'description'=> "fa fa-bullhorn"),
					
					// "top-bar-div459-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div459'),	

					// 'header'=>array(

						// 'title'=> 'SHOWS HEADER TITLE',

						// 'name'=> 'page-option-item-blog-header-title-feature',
						
						// 'description'=>'Please add header title here it will be shown at top of this element.',

						// 'type'=> 'inputtext'),	

					// 'category'=>array(

						// 'title'=>'CHOOSE CATEGORY',

						// 'name'=>'page-option-item-news-category-feature',

						// 'options'=>array(),

						// 'type'=>'combobox_category',

						// 'description'=>'Choose the post category you want to fetch its posts.'),

					// 'number-of-posts'=>array(

						// 'title'=>'NUMBER OF NEWS',

						// 'name'=>'page-option-item-news-pagination-feature',

						// 'type'=> 'inputtext',

						// 'default'=> 5,

						// 'hr'=> 'none',

						// 'description'=>'number of posts to show in each tab recent and popular.'),	

					// "top-bar-div459-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div459'),

				// ),
				
				'News'=>array(
				
					'image_icon' =>array(

						'type'=> 'image','name'=> 'cp-icon',

						'hr'=> 'none',

						'description'=> "fa fa-exclamation"),
						
					"top-bar-div11-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div11'),	

					'header'=>array(

						'title'=> 'NEWS HEADER TITLE',

						'name'=> 'page-option-item-news-header-title',
						
						'description'=>'Please add header title here it will be shown at top of this element.',

						'type'=> 'inputtext'),			

					'category'=>array(

						'title'=>'CHOOSE CATEGORY',

						'name'=>'page-option-item-news-category',

						'options'=>array(),

						'type'=>'combobox_category',

						'description'=>'Choose the post category you want to fetch its posts.'),

					'news-layout'=>array(

						'title'=>'SELECT LAYOUT',

						'name'=>'page-option-item-news-layout',

						'type'=> 'combobox',

						'options'=>array('0'=>'Full', '1'=>'Grid','2'=>'Modern-Grid','3'=>'Timeline View'),

						'hr'=> 'none',

						'description'=>'Select layout for news, grid and full width layout given.'),
						
					"top-bar-div11-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div11'),	
					
					"top-bar-div12-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div12'),	

					'num-excerpt'=>array(					

						'title'=> 'LENGHT OF DESCRIPTION',

						'name'=> 'page-option-item-news-num-excerpt',

						'type'=> 'inputtext',

						'default'=> 285,

						'description'=>'Set the number of characters of each post.'),
						
					'pagination'=>array(

						'title'=>'ENABLE PAGINATION',

						'name'=>'page-option-item-news-pagination',

						'type'=> 'combobox',

						'options'=>array('0'=>'Wp-Default', '1'=>'Theme-Custom','2'=>'No-Pagination'),

						'hr'=> 'none',

						'description'=>'Pagination will only appear when the number of posts is greater than the number of fetched item in one page you can also select wordpress default pagination that can be added from settings.'),
						
					'num-fetch'=>array(					

						'title'=> 'NUMBERS OF NEWS',

						'name'=> 'page-option-item-news-num-fetch',

						'type'=> 'inputtext',
						
						'class'=> 'news-fetch-item',

						'default'=> 5,

						'description'=>'Set the number of fetched posts on one page.'),	
						
					"top-bar-div12-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div12'),		

				),				
				
				'Contact-Form'=>array(
				
					'image_icon' =>array(

						'type'=> 'image','name'=> 'cp-icon',

						'hr'=> 'none',

						'description'=> "fa fa-envelope"),
						
					"top-bar-div16-open" => array( 'type'=>'open' ,'name'=>'div_start','class'=>'row-fluid','id'=>'cp-top-bar-div16'),	

					"contact_logo" => array(



						'title'=> 'Upload Logo',



						'name'=>'page-option-item-bg-contact-logo',

						

						'class'=> 'enable-image-class',



						'type'=>'upload',



						'description'=>'Upload Site Logo.'),
				
				
				'header'=>array(

						'title'=>'HEADER TITLE',

						'name'=>'page-option-item-header-email',

						'type'=>'inputtext',

						'hr'=>'none',
						
						'description'=>'Please add header title here it will be shown at top of this element.',),
					
					'email'=>array(

						'title'=>'E-MAIL',

						'name'=>'page-option-item-contat-email',

						'type'=>'inputtext',

						'hr'=>'none',

						'description'=>'Add the email address where you want to receive queries for your contact form.'),
						
					"top-bar-div16-close" => array( 'name'=>'div_end','type'=>'close' ,'id'=>'cp-top-bar-div16'),	

				),	
			),

		),
		
		
		
		

		

	);
	
	
	// create Page Option Meta

	add_action('add_meta_boxes', 'add_page_option');

	function add_page_option(){

		add_meta_box('page-option', esc_html__('CP Page Builder','mosque_crunchpress'), 'add_page_option_element',

			'page', 'normal', 'high');

	}

	function add_page_option_element(){

		global $post, $page_meta_boxes;

		$page_meta_boxes['Page Item']['name']['Blog']['category']['options'] = get_category_list_array( 'category' );				
		
		$page_meta_boxes['Page Item']['name']['Blog-Slider']['category']['options'] = get_category_list_array( 'category' );				
		
		$page_meta_boxes['Page Item']['name']['News']['category']['options'] = get_category_list_array( 'category' );
		
		//$page_meta_boxes['Page Item']['name']['Latest-News']['category']['options'] = get_category_list_array( 'category' );
		
		$page_meta_boxes['Page Item']['name']['Feature-Projects']['category']['options'] = get_category_list_array( 'project_category' );
		
		$page_meta_boxes['Page Item']['name']['Crowd-Funding']['category']['options'] = get_category_list_array( 'project_category' );
		
		$page_meta_boxes['Page Item']['name']['Crowd-Slider']['category']['options'] = get_category_list_array( 'project_category' );
		
		$page_meta_boxes['Choose Left Sidebar']['options'] = get_sidebar_name();

		$page_meta_boxes['Choose Right Sidebar']['options'] = get_sidebar_name();
		
		echo '<div id="cp-overlay-wrapper">';

		echo '<div class="bootstrap_admin" id="cp-overlay-content">';
		//echo '<div class="container">';

		

		set_nonce();

		
		//Print Extra Plugins by Extended Classes
		if(count(get_extends_name('function_library')) <> 0){
			$function_library =  new function_library;
			foreach(class_function_layout() as $keys=>$values){
				$$keys = 'dynamic'.$keys;
				$page_mera_variable = $function_library->create_variable($keys, $values);
				$page_mera_variable->page_builder_element_class();
			}
		}

		//print_r($page_meta_boxes);
		global $post, $page_meta_boxes;
		
		if(!class_exists("Woocommerce")){
			unset($page_meta_boxes['Footer-Product-Button']);
			unset($page_meta_boxes['category_product']);
			
		}
		
		//ignitionDeck
		if(!class_exists("Deck")){
			unset($page_meta_boxes['Crowd-Funding']);
			unset($page_meta_boxes['Feature-Projects']);
			unset($page_meta_boxes['Crowd-Slider']);
		}
		
		//function_library
		if(!class_exists("function_library")){
			unset($page_meta_boxes['Top Slider On']);
			unset($page_meta_boxes['Top Slider Type']);
			unset($page_meta_boxes['Top Slider Images']);
			unset($page_meta_boxes['Top Slider Layer']);
			unset($page_meta_boxes['Top Slider Shortcode']);
		}
		
		
		//get value
		$counter_element = 0;
		foreach( $page_meta_boxes as $page_meta_box ){
		
			if( $page_meta_box['type'] == 'page-option-item' ){	

				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['xml'], true);
				
				print_page_default_elements($page_meta_box);
				
				print_page_selected_elements($page_meta_box);

			}

			elseif( $page_meta_box['type'] == 'sidebar' ){ echo 'ok'; die;

				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['xml'], true);
				
				print_page_default_elements($page_meta_box);
				
				print_page_selected_elements($page_meta_box);
				

				echo 'ok';

				

			}else if( $page_meta_box['type'] == 'imagepicker' ){

			

				$slider_xml_string = get_post_meta($post->ID, $page_meta_box['xml'], true);

				if(!empty($slider_xml_string)){

				

					$slider_xml_val = new DOMDocument();

					$slider_xml_val->loadXML( $slider_xml_string );

					$page_meta_box['value'] = $slider_xml_val->documentElement;

					

				}

				print_meta( $page_meta_box );

			

			}else{


				if( empty( $page_meta_box['name'] ) ){ $page_meta_box['name'] = ''; }

				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['name'], true);
				
				print_meta( $page_meta_box );
				
				

			}
			
			//echo "<div class='clear'></div>";

			//echo empty($page_meta_box['hr'])? '<hr class="separator mt20">': '';

		

		}		

		//echo '</div>';
		
		echo '</div>';
		
		echo '</div>';

		

	}

	

	// call when update page with save_post action 

	function save_page_option_meta($post_id){

	
		if(count(get_extends_name('function_library')) <> 0){
			$function_library =  new function_library;
			foreach(class_function_layout() as $keys=>$values){
				//$page_meta_boxes['value'] = get_post_meta($post->ID, $page_meta_boxes['xml'], true);
				$$keys = 'dynamic'.$keys;
				$myvariable = $function_library->create_variable($keys, $values);
				$myvariable->page_builder_element_class();
			}
		}
		
		global $page_meta_boxes;

		$edit_meta_boxes = $page_meta_boxes;

		

		foreach ($edit_meta_boxes as $edit_meta_box){

			if( $edit_meta_box['type'] == 'page-option-item' ){

				if(isset($_POST[$edit_meta_box['size']])){

					$num = sizeof($_POST[$edit_meta_box['size']]);

				}else{

					$num = 0;

				}

				

				$item_xml = '<item-tag>';

				$item_content_num = array();

				for($i=0; $i<$num; $i++){

				

					$item_type_new = $_POST[$edit_meta_box['item']][$i];

					
					$item_xml = $item_xml . '<' . $item_type_new . '>';

					$item_size_new = $_POST[$edit_meta_box['size']][$i];

					$item_xml = $item_xml . create_xml_tag('size',$item_size_new);

					$item_content = $edit_meta_box['name'][$item_type_new];

					if(!isset($item_content_num[$item_type_new])){

						$item_content_num[$item_type_new] = 1 ;

						if($item_type_new == 'Slider'){

							$item_content_num['slider-item'] = 0;

						}else if($item_type_new == 'Accordion'){

							$item_content_num['accordion-item'] = 0;

						}else if($item_type_new == 'Tab'){

							$item_content_num['tab-item'] = 0;

						}else if($item_type_new == 'Toggle-Box'){

							$item_content_num['toggle-box-item'] = 0;

						}

					}

					

					foreach($item_content as $key => $value){					

						if($key == 'slider-item'){

					

							$item_xml = $item_xml . '<' . $key . '>';

							$slider_num = $_POST[$value['slider-num']][$item_content_num[$item_type_new]];

							for($j=0; $j<$slider_num; $j++){

								$item_xml = $item_xml . '<slider>';

								$temp = isset( $_POST[$value['image']][$item_content_num['slider-item']] )? $_POST[$value['image']][$item_content_num['slider-item']] : '';

								$item_xml = $item_xml . create_xml_tag('image', $temp);

								$temp = isset( $_POST[$value['title']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['title']][$item_content_num['slider-item']]) : '';

								$item_xml = $item_xml . create_xml_tag('title', $temp);

								$temp = isset( $_POST[$value['linktype']][$item_content_num['slider-item']] )? $_POST[$value['linktype']][$item_content_num['slider-item']] : '';

								$item_xml = $item_xml . create_xml_tag('linktype', $temp);

								$temp = isset( $_POST[$value['link']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['link']][$item_content_num['slider-item']]) : '';

								$item_xml = $item_xml . create_xml_tag('link', $temp);

								$temp = isset( $_POST[$value['caption']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['caption']][$item_content_num['slider-item']]) : '';

								$item_xml = $item_xml . create_xml_tag('caption', $temp);

								$item_xml = $item_xml . '</slider>';

								$item_content_num['slider-item']++; 

								

							}

							

							$item_xml = $item_xml . '</' . $key . '>';

						}else if($key == "tab-item"){

							$item_xml = $item_xml . '<' . $key . '>';

							if($item_type_new == "Accordion"){

								$tab_type = 'accordion-item';

							}else if($item_type_new == "Toggle-Box"){

								$tab_type = 'toggle-box-item';

							}else{

								$tab_type = 'tab-item';

							}



							$tab_num = $_POST[$value['tab-num']][$item_content_num[$item_type_new]];

							

							for($j=0; $j<$tab_num; $j++){

								$item_xml = $item_xml . '<tab>';

								$temp = isset( $_POST[$value['title']][$item_content_num[$tab_type]] )? htmlspecialchars($_POST[$value['title']][$item_content_num[$tab_type]]) : '';

								$item_xml = $item_xml . create_xml_tag('title', $temp);

								$temp = isset( $_POST[$value['caption']][$item_content_num[$tab_type]] )? htmlspecialchars($_POST[$value['caption']][$item_content_num[$tab_type]]) : '';

								$item_xml = $item_xml . create_xml_tag('caption', $temp);

								$temp = isset( $_POST[$value['active']][$item_content_num[$tab_type]] )? $_POST[$value['active']][$item_content_num[$tab_type]] : '';

								$item_xml = $item_xml . create_xml_tag('active', $temp);

								$item_xml = $item_xml . '</tab>';

								$item_content_num[$tab_type]++;

							}

							

							$item_xml = $item_xml . '</' . $key . '>';

							

						}else{

						

							if(isset($_POST[$value['name']][$item_content_num[$item_type_new]])){

							
							
								$item_value = htmlspecialchars($_POST[$value['name']][$item_content_num[$item_type_new]]);

								$item_xml = $item_xml .  create_xml_tag($key, $item_value);

							}else{

								$item_xml = $item_xml .  create_xml_tag($key, '');

							}

						}

					}

					

					$item_xml = $item_xml . '</' . $item_type_new . '>';

					$item_content_num[$item_type_new]++;

					

				}

				

				$item_xml = $item_xml . '</item-tag>';

				$item_xml_old = get_post_meta($post_id, $edit_meta_box['xml'], true);

				save_meta_data($post_id, $item_xml, $item_xml_old, $edit_meta_box['xml']);

				

			}else if( $edit_meta_box['type'] == 'imagepicker' ){

				if(isset($_POST[$edit_meta_box['name']['image']])){

					$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;

				}else{

					$num = -1;

				}

				

				$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);

				$slider_xml = "<slider-item>";

				

				for($i=0; $i<=$num; $i++){

					$slider_xml = $slider_xml. "<slider>";

					$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);

					$slider_xml = $slider_xml. create_xml_tag('image',$image_new);

					$title_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['title']][$i]));

					$slider_xml = $slider_xml. create_xml_tag('title',$title_new);

					$caption_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['caption']][$i]));

					$slider_xml = $slider_xml. create_xml_tag('caption',$caption_new);

					$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);

					$slider_xml = $slider_xml. create_xml_tag('linktype',$linktype_new);

					$link_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['link']][$i]));

					$slider_xml = $slider_xml. create_xml_tag('link',$link_new);

					$slider_xml = $slider_xml . "</slider>";

				}

				

				$slider_xml = $slider_xml . "</slider-item>";

				save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);

					

			}else if($edit_meta_box['type'] == 'open' || $edit_meta_box['type'] == 'close'){

			

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
	
	

	// print all elements that can be added to selected elements

	function print_page_default_elements($args){

		extract($args); ?>
	<div id="cp-options-common-class">
		<div id="page_builder" class="meta-body custom_page container-fluid">
			<!-- Select Item List -->
			<div class="meta-input bootstrap_admin">
				<div class="page-select-element-list-wrapper combobox box-one container">
					<!--<div class="title_backend"><h2>Custom Post/ Content</h2></div>-->
					<ul class="element_backend parent_width"><?php 
							$counter_pagebuilder = 0;
							if(!class_exists("Woocommerce")){
								unset($name['Woo-Products']);
							}
							//ignitionDeck
							if(!class_exists("Deck")){
								unset($name['Crowd-Funding']);
								unset($name['Feature-Projects']);
								unset($name['Crowd-Slider']);
							}
							
							
							
							foreach( $name as $key => $value ){ ?>
								<li class="drag_able element_width "><a class="dragable" id="" rel="<?php echo esc_attr($key);?>"><span class="inside_fontAw"><i class="<?php echo esc_attr($value['image_icon']['description']);?>"></i></span><span class="text-bg"><?php echo esc_attr($key);?></span></a></li>
					  <?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<!-- Default Item to Clone to-->
		<div class="page-element-lists" id="page-element-lists">
			<?php
				foreach( $name as $key => $value ){
					print_page_elements($args, '', $key);					
				}
			?>
		  <br class="clear">
		</div>
	</div>	
<?php

	}

	

	// chosen elements
	function print_page_selected_elements($args){	

		    extract($args);?>
		
		<div class="page-methodology " id="page-methodology">
		  <div class="page-selected-elements-wrapper">
			<div class="page-selected-elements page-no-sidebar" id="page-selected-elements">
				<div id="selected-image-none" class="bg_title_drop"><?php esc_html_e('Drop Elements Here','mosque_crunchpress');?></div>

			  <?php
				if($value != ''){

					$xml = new DOMDocument();

					$xml->loadXML($value);
					$counter_xml = 0;
					foreach($xml->documentElement->childNodes as $item){
						$counter_xml++;
							print_page_elements($args, $item, $item->nodeName);
					}

				}?>
			</div>
			<br class="clear">
		  </div>
		</div>
	
<?php
	}

	

	// function that manage to print each elements from receiving arguments

	function print_page_elements($args, $xml_val, $item_type){

		$element1_2 = '';

		extract($args);

		
		//echo '<pre>';print_r($args);
		//echo "<pre>";print_r($name['Widget']);

		$head_type = $item_type;

		if(empty($xml_val)){

			$head_size = '';

			$head_name = array('item'=>$item,'size'=>$size,'itemname'=>'','sizename'=>'');

		}else{

			$head_size = cp_find_xml_value($xml_val, 'size');

			$head_name = array('item'=>$item,'size'=>$size,'itemname'=>$item.'[]','sizename'=>$size.'[]');

		}

		

		print_page_item_identical($head_name, $head_size, $head_type);

		?>
<div class="page-element-edit-box" id="page-element-edit-box">
  <?php

				foreach( $name[$item_type] as $input_key => $input_value ){

					

					if( $input_key == 'slider-item' ){

						$slider_value = find_xml_node($xml_val, 'slider-item');

						print_image_picker( array('name'=>$input_value, 'value'=>$slider_value ) );

					  }else if( $input_key == 'tab-item' ){

							   print_box_tab($input_value, find_xml_node($xml_val, 'tab-item'));

				      }else if( $input_key == 'haji-item' ){

							   print_panel_sidebar('lol',$input_value);

				      }else{

					    $input_value['value'] = cp_find_xml_value($xml_val, $input_key);

						$input_value['name'] = $input_value['name'] . '[]';

						print_meta( $input_value );

					}

					if( ( $input_key!= 'open' && $input_key != 'close') ){

						//echo ( empty($input_value['hr']) )? '<hr class="separator mt20">': '';

					}

				}

			?>
</div>
</div>
<?php

		

	}

	
	function print_page_item_identical($item, $size, $text){
		global $div_size;
	//Adding New Sizes
		if(count(get_extends_name('function_library')) <> 0){
			$function_library =  new function_library;
			foreach(class_function_layout() as $keys=>$values){
				$$keys = 'dynamic'.$keys;
				$size_variable = $function_library->create_variable($keys, $values);
				$size_variable->page_builder_size_class();
			}
		}	
		global $div_size;
		
		

		if(empty( $size )) { 

			foreach( $div_size[$text] as $key => $val ){

				$size = $key; 

				break;

			}

		} 

						

		?>
<div class="page-element <?php echo esc_attr($size); ?>" id="page-element" rel="<?php echo esc_attr($text); ?>">
  <div class="page-element-item" id="page-element-item" >
    <div class="item-bar-left">
      <div class="change-element-size-temp">
        <div class="add-element-size" id="add-element-size" ></div>
        <div class="sub-element-size" id="sub-element-size" ></div>
      </div>
    </div>
    <span class="page-element-item-text"> <?php echo esc_attr($text); ?> </span>
    <input type="hidden" id="<?php echo esc_attr($item['item']);?>" class="<?php echo esc_attr($item['item']);?>" value="<?php echo esc_attr($text); ?>" name="<?php echo esc_attr($item['itemname']);?>">
    <input type="hidden" id="<?php echo esc_attr($item['size']);?>" class="<?php echo esc_attr($item['size']);?>" value="<?php echo esc_attr($size); ?>" name="<?php echo esc_attr($item['sizename']);?>">
    <div class="item-bar-right">
      <div class="element-size-text" id="element-size-text"><?php echo esc_attr($div_size[$text][$size]); ?></div>
      <div class="change-element-property"> <a title="Edit">
        <div rel="cp-edit-box" id="page-element-edit-box" class="edit-element"></div>
        </a> <a title="Delete">
        <div class="delete-element" id="delete-element"></div>
        </a> </div>
    </div>
  </div>
  <?php

		

	}

	

	//Print exceptional input element ( from meta-template )

	function print_box_tab($name, $values){

	

		?>
  <div class="meta-body">
    <div class="meta-title meta-tab"><?php esc_html_e('ADD MORE TABS','mosque_crunchpress');?></div>
    <div id="page-tab-add-more" class="page-tab-add-more" />
  </div>
  <br class="clear">
  <div class="meta-input">
    <input type='hidden' class="tab-num" id="tab-num" name='<?php echo esc_attr($name['tab-num']); ?>[]' value=<?php 

					echo empty($values)? 0: $values->childNodes->length;

				?> />
    <div class="added-tab" id="added-tab">
      <ul>
        <li id="page-item-tab" class="default">
          <div class="meta-title meta-tab-title"><?php esc_html_e('TABS TITLE','mosque_crunchpress');?></div>
          <input type="text"  id='<?php echo esc_attr($name['title']); ?>' />
          <br>
          <div class="meta-title meta-tab-title"><?php esc_html_e('TABS TEXT','mosque_crunchpress');?></div>
          <textarea id='<?php echo esc_attr($name['caption']); ?>' ></textarea>
          <br>
          <?php if(!empty($name['active'])){ ?>
          <div class="meta-title meta-tab-title"><?php esc_html_e('Tabs Active','mosque_crunchpress');?></div>
          <div class="combobox">
            <select id='<?php echo esc_attr($name['active']); ?>' >
              <option><?php esc_html_e('Yes','mosque_crunchpress');?></option>
              <option selected><?php esc_html_e('No','mosque_crunchpress');?></option>
            </select>
          </div>
          <?php } ?>
          <div id="unpick-tab" class="unpick-tab"><i class="fa fa-remove-sign"></i></div>
        </li>
        <?php

							

							if(!empty($values)){

								foreach ($values->childNodes as $tab){ 

							?>
        <li id="page-item-tab" class="page-item-tab">
          <div class="meta-title meta-tab-title"><?php esc_html_e('TABS TITLE','mosque_crunchpress');?></div>
          <input type="text" name='<?php echo esc_attr($name['title']); ?>[]' id='<?php echo esc_attr($name['title']); ?>' value="<?php echo cp_find_xml_value($tab, 'title'); ?>" />
          <br>
          <div class="meta-title meta-tab-title"><?php esc_html_e('TABS TEXT','mosque_crunchpress');?></div>
          <textarea name='<?php echo esc_attr($name['caption']); ?>[]' id='<?php echo esc_attr($name['caption']); ?>' ><?php echo cp_find_xml_value($tab, 'caption'); ?></textarea>
          <br>
          <div id="unpick-tab" class="unpick-tab"><i class="fa fa-remove-sign"></i></div>
          <?php if(!empty($name['active'])){ ?>
          <?php $is_active = cp_find_xml_value($tab, 'active'); ?>
          <div class="meta-title meta-tab-title"><?php esc_html_e('Tabs Active','mosque_crunchpress');?></div>
          <div class="combobox">
            <select id='<?php echo esc_attr($name['active']); ?>' name='<?php echo esc_attr($name['active']); ?>[]' >
              <option <?php if($is_active=='Yes'){ echo 'selected'; } ?>><?php esc_html_e('Yes','mosque_crunchpress');?></option>
              <option <?php if($is_active!='Yes'){ echo 'selected'; } ?>><?php esc_html_e('No','mosque_crunchpress');?></option>
            </select>
          </div>
          <?php } ?>
        </li>
        <?php

							

								}

							}

						?>
      </ul>
      <br class=clear>
    </div>
  </div>
  <br class=clear>
</div>
<?php

		

	}

	

	// sidebar => name, value

	function print_panel_sidebar($title, $values){

	

		extract($values);

		

		?>
<div class="panel-body" id="panel-body">
  <div class="panel-body-gimmick"></div>
  <div class="panel-title">
    <label>
      <?php echo esc_attr($title); ?>
    </label>
  </div>
  <div class="panel-input">
    <input type="text" id="add-more-sidebar" value="type title here" rel="type title here">
    <div id="add-more-sidebar" class="add-more-sidebar"></div>
  </div>
  <?php if(isset($description)){ ?>
  <div class="panel-description">
    <?php echo esc_attr($description); ?>
  </div>
  <?php } ?>
  <br class="clear">
  <div id="selected-sidebar" class="selected-sidebar">
    <div class="default-sidebar-item" id="sidebar-item">
      <div class="panel-delete-sidebar"></div>
      <div class="slider-item-text"></div>
      <input type="hidden" id="<?php echo esc_attr($name); ?>">
    </div>
    <?php 

				

				if(!empty($value)){

					

					$xml = new DOMDocument();

					$xml->loadXML($value);

					

					foreach( $xml->documentElement->childNodes as $sidebar_name ){

					

				?>
    <div class="sidebar-item" id="sidebar-item">
      <div class="panel-delete-sidebar"></div>
      <div class="slider-item-text"><?php echo esc_attr($sidebar_name->nodeValue); ?></div>
      <input type="hidden" name="<?php echo esc_attr($name); ?>[]" id="<?php echo esc_attr($name); ?>" value="<?php echo esc_attr($sidebar_name->nodeValue); ?>">
    </div>
    <?php 

					} 

					

				} 

				

				?>
  </div>
</div>
<?php 

		

	}
