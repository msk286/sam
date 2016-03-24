<?php
/*-----------------------------------------------------------------------------------*/
/*	Default Options
/*-----------------------------------------------------------------------------------*/

// Number of posts array
function cp_shortcodes_range ( $range, $all = true, $default = false, $range_start = 1 ) {
	if($all) {
		$number_of_posts['-1'] = 'All';
	}

	if($default) {
		$number_of_posts[''] = 'Default';
	}

	foreach(range($range_start, $range) as $number) {
		$number_of_posts[$number] = $number;
	}

	return $number_of_posts;
}

// Taxonomies
function cp_shortcodes_categories ( $taxonomy, $empty_choice = false ) {
	if($empty_choice == true) {
		$post_categories[''] = 'Default';
	}

	$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);

	if( ! array_key_exists('errors', $get_categories) ) {
		if( $get_categories && is_array($get_categories) ) {
			foreach ( $get_categories as $cat ) {
				$post_categories[$cat->slug] = $cat->name;
			}
		}

		if(isset($post_categories)) {
			return $post_categories;
		}
	}
}

// return the title list of each post_type
function get_title_list_index( $post_type ){
	
	$posts_title = array();
	$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
	
	foreach ($posts as $post) {
		$posts_title[$post->ID] = $post->post_title;
	}
	
	return $posts_title;

}

//Fetch Categories
function get_category_list_index( $category_name, $parent='' ){
	
	if( empty($parent) ){ 
		$category_list = array();
		$get_category = get_categories( array( 'taxonomy' => $category_name	));
		if($get_category <> ''){
			foreach( $get_category as $category ){
				if(isset($category)){
					$category_list[$category->term_id] = $category->name;
				}
			}
		}
			
		return $category_list;
		
	}else{
		//$category_list = array( '0' =>'All');
		$parent_id = get_term_by('name', $parent, $category_name);
		$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id	));
		$category_list = array( '0' => $parent );
		if($get_category <> ''){
			foreach( $get_category as $category ){
				if(isset($category)){
					$category_list[$category->term_id] = $category->name;
				}
			}
		}
			
		return $category_list;		
	
	}
}

$choices = array('yes' => 'Yes', 'no' => 'No');
$reverse_choices = array('no' => 'No', 'yes' => 'Yes');
$dec_numbers = array('0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' );



//Default wordpress post category
$category = get_category_list_index('category');
//WooCommerce taxonomy
if(class_exists('Woocommerce')){
	$product_cat = get_category_list_index('product_cat');
}else{
	$product_cat = array();
}
//Check Main Function is exist
if(class_exists('function_library')){
	$team_category = get_category_list_index('team-category');
	$testimonial_category = get_category_list_index('testimonial-category');
	//$portfolio_category = get_category_list_index('portfolio-category');
}else{
	$team_category = array();
	$testimonial_category = array();
	$portfolio_category = array();
}

$project_category = get_category_list_index('project_category');
$ignition_product = get_title_list_index('ignition_product');
$cp_slider = get_title_list_index('cp_slider');

if(class_exists('EM_Events')){
	$event_name = get_title_list_index('event');
}else{
	$event_name = array();
}

// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path = CP_TINYMCE_DIR . '/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) {
	@$subject = file_get_contents($fontawesome_path);
}

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
	$icons[$match[1]] = $match[2];
}

$checklist_icons = array ( 'icon-check' => '\f00c', 'icon-star' => '\f006', 'icon-angle-right' => '\f105', 'icon-asterisk' => '\f069', 'icon-remove' => '\f00d', 'icon-plus' => '\f067' );

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Selection Config
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '',
	'popup_title' => ''
);

/*-----------------------------------------------------------------------------------*/
/*	Alert
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		
		'color_light' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Select Gradient Color', 'mosque_crunchpress'),
			'desc' => 'Set color tune of alert background! Gradient Alert Light Color'
		),
		
		'color_dark' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Select Gradient Color', 'mosque_crunchpress'),
			'desc' => 'Set color tune of alert background! Gradient Alert Dark Color'
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Alert Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the alert\'s content', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[alert icon="{{icon}}" color_light="{{color_light}}" color_dark="{{color_dark}}" ]{{content}}[/alert]',
	'popup_title' => __( 'Alert Shortcode', 'mosque_crunchpress' )
);



/*-----------------------------------------------------------------------------------*/
/*	Blog
/*-----------------------------------------------------------------------------------*/
$cp_shortcodes['blog'] = array(
	'no_preview' => true,
	'params' => array(

		'number_posts' => array(
			'type' => 'select',
			'label' => __( 'Number of Posts', 'mosque_crunchpress' ),
			'desc' => __( 'Select number of posts per page', 'mosque_crunchpress' ),
			'options' => cp_shortcodes_range( 25, true, true )
		),
		
		'cat_id' => array(
			'type' => 'select',
			'label' => __( 'Select Category', 'mosque_crunchpress' ),
			'desc' => __( 'Select name of category you want to fetch, and in shortcode it will paste id of selected category', 'mosque_crunchpress' ),
			'options' => $category,
		),
		
		'title' => array(
			'std' => 'Blog Title',
			'type' => 'text',
			'label' => __('Blog Title', 'mosque_crunchpress'),
			'desc' => __('Header or Blog Title of the listing.', 'mosque_crunchpress')
		),
		
		'thumbnail' => array(
			'type' => 'select',
			'label' => __( 'Thumbnail', 'mosque_crunchpress' ),
			'desc' => __( 'Yes or No', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'yes',
				'no' => 'no',
			
			)
		),
				
		'excerpt_words' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Number of excerpt words', 'mosque_crunchpress'),
			'desc' => __('50words to 250words', 'mosque_crunchpress')
		),
			
		'paging' => array(
			'type' => 'select',
			'label' => __( 'Pagination', 'mosque_crunchpress' ),
			'desc' => __( 'Yes or No', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'yes',
				'no' => 'no',
			
			)
		
		),
	),
	'shortcode'=>'[blog number_posts="{{number_posts}}" cat_id="{{cat_id}}" title="{{title}}" thumbnail="{{thumbnail}}" excerpt_words="{{excerpt_words}}" paging="{{paging}}"][/blog]',
	'popup_title' => __( 'Blog Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Headline
/*-----------------------------------------------------------------------------------*/
$cp_shortcodes['heading'] = array(
	'no_preview' => true,
	'params' => array(
		
		// 'scheme' => array(
			// 'type' => 'select',
			// 'label' => __( 'Select Scheme', 'mosque_crunchpress' ),
			// 'desc' => __( 'Select Color Scheme Style', 'mosque_crunchpress' ),
			// 'options' => array(
				// 'theme-default' => 'Theme',
				// 'theme-custom' => 'Custom',
			// )
		// ),
		
		'align' => array(
			'type' => 'select',
			'label' => __( 'Alignment', 'mosque_crunchpress' ),
			'desc' => __( 'Left, Right, Center', 'mosque_crunchpress' ),
			'options' => array(
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center',
			)
		),
		
		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Add Title', 'mosque_crunchpress'),
			'desc' => __('Add title for element here.', 'mosque_crunchpress')
		),
		
		'title_color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Title Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'style' => array(
			'type' => 'select',
			'label' => __( 'Heading Style', 'mosque_crunchpress' ),
			'desc' => __( 'Select Heading Style', 'mosque_crunchpress' ),
			'options' => array(
				//'h1' => 'H1',
				'simple-heading' => 'Simple Style',
				'eco-heading' => 'Eco Style',
				'islamic-heading' => 'Islamic Style',
				'church-heading' => 'Church Style',
				'politics-heading' => 'Political Style',
				'store-heading' => 'Store Style',
			)
		),
		
		'tag' => array(
			'type' => 'select',
			'label' => __( 'Heading Tag', 'mosque_crunchpress' ),
			'desc' => __( 'Select Heading Tag', 'mosque_crunchpress' ),
			'options' => array(
				'h1' => 'h1',
				'h2' => 'h2',
			)
		),
		
		'desc_color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Description Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'description' => array(
			'std' => 'Caption Or Sub Text',
			'type' => 'text',
			'label' => __('Sub Heading or Caption', 'mosque_crunchpress'),
			'desc' => __('Add short sub heading or caption under heading.', 'mosque_crunchpress')
		),
		
	),
	'shortcode'=>'[heading align="{{align}}" tag= "{{tag}}" title="{{title}}"  title_color="{{title_color}}"  style="{{style}}" desc_color="{{desc_color}}" description="{{description}}"][/heading]',
	'popup_title' => __( 'Element Header and Sub Text', 'mosque_crunchpress' )
);


/*-----------------------------------------------------------------------------------*/
/*	Welcome
/*-----------------------------------------------------------------------------------*/
$cp_shortcodes['welcome'] = array(
	'no_preview' => true,
	'params' => array(

	
		'title' => array(
			'std' => 'Title',
			'type' => 'text',
			'label' => __('Add Title', 'mosque_crunchpress'),
			'desc' => __('Add title for element here.', 'mosque_crunchpress')
		),
		
		
		'description' => array(
			'std' => 'Caption Or Sub Text',
			'type' => 'text',
			'label' => __('Sub Heading or Caption', 'mosque_crunchpress'),
			'desc' => __('Add short sub heading or caption under heading.', 'mosque_crunchpress')
		),
		
		'btn_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Read More URL', 'mosque_crunchpress'),
			'desc' => __('Add the button\'s url ex: http://example.com', 'mosque_crunchpress')
		),
		
		'image_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Image', 'mosque_crunchpress'),
			'desc' => __('Add the Image url ex: http://example.com', 'mosque_crunchpress')
		),
		
	),
	'shortcode'=>'[welcome title="{{title}}" description= "{{description}}" image_link="{{image_link}}" btn_link="{{btn_link}}"][/welcome]',
	'popup_title' => __( 'Welcome Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Checklist
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['checklist'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select CheckList Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		
		'iconcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Icon Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
	),	
	'shortcode'=>'[checklist icon="{{icon}}" iconcolor="{{iconcolor}}"]&lt;ul&gt;{{child_shortcode}}&lt;/ul&gt;[/checklist]',
	'popup_title' => __( 'Checklist Shortcode', 'mosque_crunchpress' ),
	
	'child_shortcode' => array(
		'params' => array(		
			'content' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'Content', 'mosque_crunchpress' ),
				'desc' => __( '', 'mosque_crunchpress' ),
			),
		),
		'shortcode' => '&lt;li&gt;{{content}}&lt;/li&gt;',
		'clone_button' => __('Add List Item', 'mosque_crunchpress')
	),
);

/*-----------------------------------------------------------------------------------*/
/*	Button
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['buttons'] = array(
	'no_preview' => true,
	'params' => array(

		
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		
		'style' => array(
			'type' => 'select',
			'label' => __( 'Select Button Style', 'mosque_crunchpress' ),
			'desc' => __( 'Select Button Style from the dropdown list.', 'mosque_crunchpress' ),
			'options' => array(
				'simple-btn' => 'Simple',
				'round-conr-btn' => 'Round Corner 1',
				'round-conr-btn-2' => 'Round Corner 2',
				'plain-btn' => 'Plain',
				'black' => 'Black',
			),
		),
		
		
		
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'mosque_crunchpress' ),
			'desc' => __( 'Select button size', 'mosque_crunchpress' ),
			'options' => array(
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large',
			),
		),
		
		// 'align' => array(
			// 'type' => 'select',
			// 'label' => __( 'Align', 'mosque_crunchpress' ),
			// 'desc' => __( 'Select button align', 'mosque_crunchpress' ),
			// 'options' => array(
				// 'left' => 'Left',
				// 'center' => 'Center',
				// 'right' => 'Right',
			// ),
		// ),
		
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'target' => array(
			'type' => 'select',
			'label' => __( 'target', 'mosque_crunchpress' ),
			'desc' => __( '_self, _blank', 'mosque_crunchpress' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank',
			
			),
		),
			
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Button URL', 'mosque_crunchpress'),
			'desc' => __('Add the button\'s url ex: http://example.com', 'mosque_crunchpress')
		),
		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Alert Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the alert\'s content', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[button icon="{{icon}}" style="{{style}}" size="{{size}}" backgroundcolor="{{backgroundcolor}}" color="{{color}}" target="{{target}}" link="{{link}}"]{{content}}[/button]',
	'popup_title' => __( 'Button Shortcode', 'mosque_crunchpress' )
);
/*-----------------------------------------------------------------------------------*/
/*	Donation
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['cp_donation'] = array(
	'no_preview' => true,
	'params' => array(

	),
	'shortcode'=>'[cp_donation][/cp_donation]',
	'popup_title' => __( 'Alert Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Salat Times
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['salat_times'] = array(
	'no_preview' => true,
	'params' => array(

	),
	'shortcode'=>'[daily_salat_times]',
	'popup_title' => __( 'Salat Times Shortcode', 'mosque_crunchpress' )
);




/*-----------------------------------------------------------------------------------*/
/*	Text
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['text'] = array(
	'no_preview' => true,
	'params' => array(
	
		'align' => array(
			'type' => 'select',
			'label' => __( 'Test Align', 'mosque_crunchpress' ),
			'desc' => __( 'left , right , center , justify', 'mosque_crunchpress' ),
			'options' => array(
				'left' => 'left',
				'right' => 'right',
				'center' => 'center',
				'justify' => 'justify',
			
			)
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[text align="{{align}}"]{{content}}[/text]',
	'popup_title' => __( 'Text Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	IconSet -> skipped
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Event Circle Counter
/*-----------------------------------------------------------------------------------*/
$cp_shortcodes['event_circle_counter'] = array(
	'no_preview' => true,
	'params' => array(
	//[event_counter event_id="216" color="#ffffff" unfilled_color="#005E5E" filled_color="#ffffff" circle_width_filled=".9" circle_width_unfilled="0.09" width="500" height="350"][/event_counter]
		'event_id' => array(
			'type' => 'select',
			'label' => __( 'Event Name', 'mosque_crunchpress' ),
			'desc' =>  __( 'Select event name to fetch its id.', 'mosque_crunchpress' ),
			'options' => $event_name
		),
		
		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Color', 'mosque_crunchpress'),
			'desc' => 'Selcet Text Color'
		),
		'unfilled_color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Unfilled Color', 'mosque_crunchpress'),
			'desc' => 'Select The Unfilled Color In Event Circle'
		),
		
		'filled_color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Filled Color', 'mosque_crunchpress'),
			'desc' => 'Select The Filled Color In Event Circle'
		),
		
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width in Number', 'mosque_crunchpress'),
			'desc' => __('e.g 500', 'mosque_crunchpress')
		),
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Height in Number', 'mosque_crunchpress'),
			'desc' => __('e.g 350', 'mosque_crunchpress')
		),
		
		'circle_width_filled' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Circle Width of Filled Event Circle', 'mosque_crunchpress'),
			'desc' => __('e.g 0.9 ', 'mosque_crunchpress')
		),
		
		'circle_width_unfilled' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Circle Width of UnFilled Event Circle', 'mosque_crunchpress'),
			'desc' => __('e.g 0.01 to 0.1 ', 'mosque_crunchpress')
		),
		
	
	),
	'shortcode'=>'[event_counter event_id="{{event_id}}" color="{{color}}" unfilled_color="{{unfilled_color}}" filled_color="{{filled_color}}" circle_width_filled="{{circle_width_filled}}" circle_width_unfilled="{{circle_width_unfilled}}" width="{{width}}" height="{{height}}"][/event_counter]',
	'popup_title' => __( 'Event Counter Shortcode', 'mosque_crunchpress' )
);


/*-----------------------------------------------------------------------------------*/
/*	Event Counter Box
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['event_counter_box'] = array(
	'no_preview' => true,
	'params' => array(

		'event_id' => array(
			'type' => 'select',
			'label' => __( 'Event Name', 'mosque_crunchpress' ),
			'desc' =>  __( 'Select event name to fetch its id.', 'mosque_crunchpress' ),
			'options' => $event_name
		),
		
	),
	'shortcode'=>'[event_counter_box event_id="{{event_id}}"][/event_counter_box]',
	'popup_title' => __( 'Event Counter box Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Content Box
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['content_box'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Title', 'mosque_crunchpress'),
		),
		
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Color for text', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Content Box Content', 'mosque_crunchpress' ),
		),
		
		
	),
	'shortcode'=>'[content_box title="{{title}}" icon="{{icon}}" backgroundcolor="{{backgroundcolor}}" color="{{color}}"]{{content}}[/content_box]',
	'popup_title' => __( 'Content Box Shortcode', 'mosque_crunchpress' )
);
/*-----------------------------------------------------------------------------------*/
/*	Counters Circle
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['columns'] = array(
	'no_preview' => true,
	'params' => array(
		'col' => array(
			'type' => 'select',
			'label' => __( 'Column', 'mosque_crunchpress' ),
			'desc' =>  __( 'Choose column width from dropdown.', 'mosque_crunchpress' ),
			'options' => array(
				'1/1' => 'Full Column',
				'1/2' => 'Half Column',
				'1/3' => 'One Third Column',
				'1/4' => 'One Forth Column',
				'2/3' => 'Two Third Column',
				'3/4' => 'Three Forth Column',
			)
		),
		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( '', 'mosque_crunchpress' ),
		),
		
	),
	
	'shortcode'=>'[column col="{{col}}"]{{content}}[/column]',
	'popup_title' => __( 'Counters Circle Shortcode', 'mosque_crunchpress' ),
);


/*-----------------------------------------------------------------------------------*/
/*	Counters Circle
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['counters_circle'] = array(
	'no_preview' => true,
	'params' => array(
		/*
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( '', 'mosque_crunchpress' ),
		),*/
	),
	
	
	'shortcode'=>'[counters_circle]{{child_shortcode}}[/counters_circle]',
	'popup_title' => __( 'Counters Circle Shortcode', 'mosque_crunchpress' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
		'filledcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Filled Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
			),
		'unfilledcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('UnFilled Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
			),
		'percent' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Percent in Number', 'mosque_crunchpress'),
			'desc' => __('0 To 100', 'mosque_crunchpress')
			),
			
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( '', 'mosque_crunchpress' ),
			),
		),

		'shortcode'=>'[counter_circle filledcolor="{{filledcolor}}" unfilledcolor="{{unfilledcolor}}" percent="{{percent}}"]{{content}}[/counter_circle]',
		'clone_button' => __('Add Counter Circle', 'mosque_crunchpress')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	DropCap
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['dropcap'] = array(
	'no_preview' => true,
	'params' => array(

		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Filled Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
			),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Word to DropCap', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[dropcap color="{{color}}"]{{content}}[/dropcap]',
	'popup_title' => __( 'DropCap Shortcode', 'mosque_crunchpress' )
);
	
/*-----------------------------------------------------------------------------------*/
/*	Full Width
/*-----------------------------------------------------------------------------------*/

$cp_shortcodes['full_width'] = array(
	'no_preview' => true,
	'params' => array(

		'textalign' => array(
			'type' => 'select',
			'label' => __( 'Test Align', 'mosque_crunchpress' ),
			'desc' => __( 'left , right , center , justify', 'mosque_crunchpress' ),
			'options' => array(
				'left' => 'left',
				'right' => 'right',
				'center' => 'center',
				'justify' => 'justify',
			
			)
		),
		
		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Color of text', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
			
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),

		'backgroundimage' => array(
				'type' => 'uploader',
				'label' => __('Background Image', 'mosque_crunchpress'),
				'desc' => __('Upload the Background image', 'mosque_crunchpress'),
			),
		
		'backgroundrepeat' => array(
			'type' => 'select',
			'label' => __( 'Background Repeat', 'mosque_crunchpress' ),
			'desc' => __( 'no-repeat, repeat', 'mosque_crunchpress' ),
			'options' => array(
				'repeat' => 'repeat',
				'no-repeat' => 'no-repeat',
			)
		),
		
		'backgroundposition' => array(
			'type' => 'select',
			'label' => __( 'Background Position', 'mosque_crunchpress' ),
			'desc' => __( 'left , right , top , bottom', 'mosque_crunchpress' ),
			'options' => array(
				'left' => 'left',
				'right' => 'right',
				'top' => 'top',
				'bottom' => 'bottom',
			
			)
		),
		'backgroundattachment' => array(
			'type' => 'select',
			'label' => __( 'Background Attachment', 'mosque_crunchpress' ),
			'desc' => __( 'scroll, fixed', 'mosque_crunchpress' ),
			'options' => array(
				'scroll' => 'scroll',
				'fixed' => 'fixed',
			)
		),

		'bordersize' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Size of Border', 'mosque_crunchpress'),
			'desc' => __('From 1px to 10px', 'mosque_crunchpress')
		),
		
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Border Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'paddingtop' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Padding Top in pixels', 'mosque_crunchpress'),
			'desc' => __('from 1px to 100px', 'mosque_crunchpress')
		),
		
		'paddingbottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Padding Bottom in pixels', 'mosque_crunchpress'),
			'desc' => __('from 1px to 100px', 'mosque_crunchpress')
		),
		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert content', 'mosque_crunchpress' ),
		),
	),
	
	'shortcode'=>'[fullwidth textalign="{{textalign}}" color="{{color}}" backgroundcolor="{{backgroundcolor}}" backgroundimage="{{backgroundimage}}" backgroundrepeat="{{backgroundrepeat}}" backgroundposition="{{backgroundposition}}" backgroundattachment="{{backgroundattachment}}" bordersize="{{bordersize}}" bordercolor="{{bordercolor}}" paddingtop="{{paddingtop}}" paddingbottom="{{paddingbottom}}"]{{content}}[/fullwidth]',
	'popup_title' => __( 'Full_width Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Flex Slider
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['flexslider'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __( 'Select Layout', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of Layout', 'mosque_crunchpress' ),
			'options' => array(
				'posts' => 'posts',
				'posts-with-excerpt' => 'posts-with-excerpt',
				'attachments' => 'attachments',
			)
		),
		'excerpt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Excerpt Length', 'mosque_crunchpress'),
			'desc' => __('From 250 to Onwards', 'mosque_crunchpress')
		),
		
		'category' => array(
			'type' => 'select',
			'label' => __( 'Category', 'mosque_crunchpress' ),
			'desc' => __( 'Select the Category For FlexSlider', 'mosque_crunchpress' ),
			'options' => array(
				'cat-1' => 'Category',
				'cat-2' => 'Category',
				'cat-3' => 'Category',
			)
		),
		
		'limit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Select the Limit', 'mosque_crunchpress'),
			'desc' => __('3 to onwards', 'mosque_crunchpress')
		),
		
		'id' => array(
			'type' => 'select',
			'label' => __( 'ID', 'mosque_crunchpress' ),
			'desc' => __( 'Select the ID', 'mosque_crunchpress' ),
			'options' => array(
				'id-1' => 'id',
				'id-2' => 'id',
				'id-3' => 'id',
			)
		),
		
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Light Box', 'mosque_crunchpress' ),
			'desc' => __( 'Lightbox Yes, or No(only works with attachments layout)', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'yes',
				'no' => 'no',
			)
		),
		
		
	),
	'shortcode'=>'[flexslider layout="{{layout}}" excerpt="{{excerpt}}" category="{{category}}" limit="{{limit}}" id="{{id}}" lightbox="{{lightbox}}"][/flexslider]',
	'popup_title' => __( 'FlexSlider Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Font Awesome
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['fontawesome'] = array(
	'no_preview' => true,
	'params' => array(
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Circle', 'mosque_crunchpress' ),
			'desc' => __( 'Font required in circle', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'yes',
				'no' => 'no',
			)
		),
		
		'size' => array(
			'type' => 'select',
			'label' => __( 'Select The Size', 'mosque_crunchpress' ),
			'desc' => __( 'Select the size of the icon', 'mosque_crunchpress' ),
			'options' => array(
				'large' => 'large',
				'medium' => 'medium',
				'small' => 'small'
			)
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Select Icon Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'circlecolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Select Circle Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'circlebordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Select Circle Border Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
	),
	'shortcode'=>'[fontawesome icon="{{icon}}" circle="{{circle}}" size="{{size}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}"]',
	'popup_title' => __( 'FontAwesome Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Google Map
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['google_map'] = array(
	'no_preview' => true,
	'params' => array(
		'latitude' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Latitude of your desired location', 'mosque_crunchpress'),
			'desc' => __('Add the Latitude example : eiffel tower latitude  (48.8582)', 'mosque_crunchpress')
		),
		
		'longitude' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Longitude of your desired location', 'mosque_crunchpress'),
			'desc' => __('Add the Latitude example : eiffel tower longitude (2.2945)', 'mosque_crunchpress')
		),
		
		'maptype' => array(
			'type' => 'select',
			'label' => __( 'Select type of the map', 'mosque_crunchpress' ),
			'desc' => __( 'Select Type of the map to display', 'mosque_crunchpress' ),
			'options' => array(
				'ROADMAP' => 'Roadmap',
				'SATELLITE' => 'Satellite',
				'HYBRID' => 'Hybrid',
				'TERRAIN'=> 'Terrain',
			)
		),
		
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Width of the map', 'mosque_crunchpress'),
			'desc' => __('Width of the map in pixel or percentage e.g 500px, 100% ', 'mosque_crunchpress')
		),
		
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Height of the map', 'mosque_crunchpress'),
			'desc' => __('Height of the map in pixel or percentage e.g 500px, 100% ', 'mosque_crunchpress')
		),
		'zoom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Zoom of the map', 'mosque_crunchpress'),
			'desc' => __('set zoom level of the map e.g 14 ', 'mosque_crunchpress')
		),

	),
	'shortcode'=>'[map latitude="{{latitude}}" longitude="{{longitude}}" maptype="{{maptype}}" width="{{width}}" height="{{height}}" zoom="{{zoom}}"][/map]',
	'popup_title' => __( 'Google_Map Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Highlight
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['highlight'] = array(
	'no_preview' => true,
	'params' => array(
		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content to be highlighted', 'mosque_crunchpress' ),
			'desc' => __( 'Insert content to highlight', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[highlight color="{{color}}"]{{content}}[/highlight]',
	'popup_title' => __( 'Highlight Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Sidebar
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['sidebar'] = array(
	'no_preview' => true,
	'params' => array(
		
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('select Name', 'mosque_crunchpress'),
			'desc' => __('Select the name of the sidebar e.g Footer ', 'mosque_crunchpress')
		),
		
	),
	'shortcode'=>'[sidebar name="{{name}}"]',
	'popup_title' => __( 'Sidebar Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Image Frame
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['image_frame'] = array(
	'no_preview' => true,
	'params' => array(
	
		'style' => array(
			'type' => 'select',
			'label' => __( 'Select Style', 'mosque_crunchpress' ),
			'desc' => __( 'Select Style of the image frame', 'mosque_crunchpress' ),
			'options' => array(
				'border' => 'border',
				'glow' => 'glow',
				'border' => 'border',
				'dropshadow' => 'dropshadow',
				'bottomshadow'=> 'bordershadow'
			)
		),
		
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Border Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'bordersize' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Select Border Size', 'mosque_crunchpress'),
			'desc' => __('Select size of the border e.g 1px to 10px ', 'mosque_crunchpress')
		),
		'stylecolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Style Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'align' => array(
			'type' => 'select',
			'label' => __( 'Select Alignment', 'mosque_crunchpress' ),
			'desc' => __( 'left , right , top , bottom', 'mosque_crunchpress' ),
			'options' => array(
				'left' => 'left',
				'right' => 'right',
				'top' => 'top',
				'bottom' => 'bottom',
			
			)
		),
		'content' => array(
				'type' => 'uploader',
				'label' => __('Select Image', 'mosque_crunchpress'),
				'desc' => __('Upload the image', 'mosque_crunchpress'),
				'alt' => __('Image Description', 'mosque_crunchpress'),
			),	
	),
	'shortcode'=>'[imageframe style="{{style}}" bordercolor="{{bordercolor}}" bordersize="{{bordersize}}" stylecolor="{{stylecolor}}" align="{{align}}"]{{content}}[/imageframe]',
	'popup_title' => __( 'Image_frame Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Images Carousel
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['image_carousel'] = array(
	'no_preview' => true,
	'params' => array(
	
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Lightbox', 'mosque_crunchpress' ),
			'desc' => __( 'Yes or No', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'yes',
				'no' => 'no',
			
			)
		),
		'gallery_id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Select Gallery Id', 'mosque_crunchpress'),
			'desc' => __('Select the id of the gallery ', 'mosque_crunchpress')
		),
		
	),
	'shortcode'=>'[images lightbox="{{lightbox}}" gallery_id="{{gallery_id}}"][/images]',
	'popup_title' => __( 'Images_Carousel Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Lightbox
/*-----------------------------------------------------------------------------------*/	

$cp_shortcodes['lightbox'] = array(
	'no_preview' => true,
	'params' => array(
	
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Select Title', 'mosque_crunchpress'),
			'desc' => __('Select the title of the Lightbox ', 'mosque_crunchpress')
		),
		
		'href' => array(
			'type' => 'uploader',
			'label' => __('Select Full Image', 'mosque_crunchpress'),
			'desc' => __('Upload large image this image will shown in lightbox.', 'mosque_crunchpress'),
		),
		
		'src' => array(
			'type' => 'uploader',
			'label' => __('Small Thumbnail', 'mosque_crunchpress'),
			'desc' => __('Upload small thumbnail that will appear as small image.', 'mosque_crunchpress'),
		),
		
		'margin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Margin', 'mosque_crunchpress'),
			'desc' => __('Give Margin e.g 1px to 25px', 'mosque_crunchpress')
		),
		'align' => array(
			'type' => 'select',
			'label' => __( 'Select Alignment', 'mosque_crunchpress' ),
			'desc' => __( 'left , right , center, none', 'mosque_crunchpress' ),
			'options' => array(
				'left' => 'left',
				'right' => 'right',
				'center' => 'center',
				'none' => 'none',			
			)
		)
	),
	'shortcode'=>'[lightbox title="{{title}}" href="{{href}}" src="{{src}}" margin="{{margin}}" align="{{align}}"][/lightbox]',
	'popup_title' => __( 'Lightbox Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Progress Circle
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['progress_circle'] = array(
	'no_preview' => true,
	'params' => array(

		'percent' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Value', 'mosque_crunchpress'),
			'desc' => __('Give value from 0 to 100', 'mosque_crunchpress')
		),
		
		'filledcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Select Filled Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'unfilledcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Select UnFilled Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[counter_circle percent="{{percent}}" filledcolor="{{filledcolor}}" unfilledcolor="{{unfilledcolor}}"]{{content}}[/counter_circle]',
	'popup_title' => __( 'Progress Circle Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['progress_bar'] = array(
	'no_preview' => true,
	'params' => array(

		'percentage' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Percentage', 'mosque_crunchpress'),
			'desc' => __('Give percentage from 0 to 100', 'mosque_crunchpress')
		),
	
		'type' => array(
			'type' => 'select',
			'label' => __( 'Select Type', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of Progress Bar', 'mosque_crunchpress' ),
			'options' => array(
				'progress-info' => 'progress-info',
				'progress-success' => 'progress-success',
				'progress-warning' => 'progress-warning',
				'progress-danger' => 'progress-danger',
			)
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
		),	
	),
	'shortcode'=>'[progress_bar percentage="{{percentage}}" type="{{type}}"]{{content}}[/progress_bar]',
	'popup_title' => __( 'Progress Bar Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Person
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['person'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Select Type', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of Person', 'mosque_crunchpress' ),
			'options' => array(
				'team-boxed' => 'team-boxed-style',
				'team-boxed-style-1' => 'team-boxed-style-1',
				'team-circle-style' => 'team-circle-style',
				'team-circle-style-1' => 'team-circle-style-1',
				'team-circle-style-2' => 'team-circle-style-2',
			)
		),
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Name of the Person', 'mosque_crunchpress'),
			'desc' => __('e.g John Doe', 'mosque_crunchpress')
		),
		'picture' => array(
				'type' => 'uploader',
				'label' => __('Image of the person', 'mosque_crunchpress'),
				'desc' => __('Upload the Person image', 'mosque_crunchpress'),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Designation', 'mosque_crunchpress'),
			'desc' => __('e.g Developer', 'mosque_crunchpress')
		),
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Facebook URL', 'mosque_crunchpress'),
			'desc' => __('Add the facebook address ex: http://facebook.com', 'mosque_crunchpress')
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Twitter URL', 'mosque_crunchpress'),
			'desc' => __('Add the twitter address ex: http://twitter.com', 'mosque_crunchpress')
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('LinkedIn URL', 'mosque_crunchpress'),
			'desc' => __('Add the LinkedIn address ex: http://linkedin.com', 'mosque_crunchpress')
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Dribbble URL', 'mosque_crunchpress'),
			'desc' => __('Add the Dribbble address ex: http://dribbble.com', 'mosque_crunchpress')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('URL', 'mosque_crunchpress'),
			'desc' => __('Add the url ex: http://example.com', 'mosque_crunchpress')
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
		),	

	),
	'shortcode'=>'[person type="{{type}}" name="{{name}}" picture="{{picture}}" title="{{title}}" facebook="{{facebook}}" twitter="{{twitter}}" linkedin="{{linkedin}}" dribbble="{{dribbble}}" link="{{link}}"]{{content}}[/person]',
	'popup_title' => __( 'Person  Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	3D Button
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['3D_button'] = array(
	'no_preview' => true,
	'params' => array(
		
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'mosque_crunchpress' ),
			'desc' => __( 'Select button size', 'mosque_crunchpress' ),
			'options' => array(
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large',
			),
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('URL Here', 'mosque_crunchpress'),
			'desc' => __('Add the url ex: http://example.com', 'mosque_crunchpress')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Text Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Select Target', 'mosque_crunchpress' ),
			'desc' => __( '_blank or _self', 'mosque_crunchpress' ),
			'options' => array(
				'_blank' => '_blank',
				'_self' => '_self',
				
			)
		),
		'content' => array(
			'std' => 'Your Button Text Goes Here',
			'type' => 'textarea',
			'label' => __( 'Button Text', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the Button Text', 'mosque_crunchpress' ),
		),	
		
	),
	'shortcode'=>'[3dbutton icon="{{icon}}" size="{{size}}" link="{{link}}" backgroundcolor="{{backgroundcolor}}" target="{{target}}" textcolor="{{textcolor}}"]{{content}}[/3dbutton]',
	'popup_title' => __( '3D Button  Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Metro Button
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['metro_button'] = array(
	'no_preview' => true,
	'params' => array(
	
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'mosque_crunchpress' ),
			'desc' => __( 'Select button size', 'mosque_crunchpress' ),
			'options' => array(
				'small' => 'Small',
				'medium' => 'Medium',
				'large' => 'Large',
			),
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('URL Here', 'mosque_crunchpress'),
			'desc' => __('Add the url ex: http://example.com', 'mosque_crunchpress')
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Select Target', 'mosque_crunchpress' ),
			'desc' => __( '_blank or _self', 'mosque_crunchpress' ),
			'options' => array(
				'_blank' => '_blank',
				'_self' => '_self',
			
			)
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Text Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'content' => array(
			'std' => 'Your Button Text Goes Here',
			'type' => 'textarea',
			'label' => __( 'Button Text', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the Button Text', 'mosque_crunchpress' ),
		),	
		
	),
	'shortcode'=>'[metro_button icon="{{icon}}" size="{{size}}" link="{{link}}" target="{{target}}" backgroundcolor="{{backgroundcolor}}" textcolor="{{textcolor}}"]{{content}}[/metro_button]',
	'popup_title' => __( 'Metro_Button  Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Membership Button
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['membership_button'] = array(
	'no_preview' => true,
	'params' => array(
	
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
	
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('URL Here', 'mosque_crunchpress'),
			'desc' => __('Add the url ex: http://example.com', 'mosque_crunchpress')
		),
		
		'icon_bg_color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Icon Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'text_bg_color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Text Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		
		'border_color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Bottom Border Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
	
		
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Text Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'content' => array(
			'std' => 'Your Button Text Goes Here',
			'type' => 'textarea',
			'label' => __( 'Button Text', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the Button Text', 'mosque_crunchpress' ),
		),	
		
	),
	'shortcode'=>'[membership_button icon="{{icon}}" link="{{link}}" border_color="{{border_color}}" icon_bg_color="{{icon_bg_color}}" text_bg_color="{{text_bg_color}}" textcolor="{{textcolor}}"]{{content}}[/membership_button]',
	'popup_title' => __( 'Membership Button  Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Newsletter Shortcodes
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['newsletter_section'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Select layout', 'mosque_crunchpress' ),
			'desc' => __( 'select newsletter layout', 'mosque_crunchpress' ),
			'options' => array(
				'newsletter-layout1' => 'Newsletter 1',
				'newsletter-layout2' => 'Newsletter 2',
				'newsletter-layout3' => 'Newsletter 3',
				'newsletter-layout4' => 'Newsletter 4',
				'newsletter-layout5' => 'Newsletter 5',
			)
		),
	
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Email ID', 'mosque_crunchpress'),
			'desc' => __('Please write your email address.', 'mosque_crunchpress')
		),

		
	),
	
	'shortcode'=>'[newsletter_section type="{{type}}" email="{{email}}" ]',
	'popup_title' => __( 'Newsletter  Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Newsletter Mosque
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['newsletter'] = array(
	'no_preview' => true,
	'params' => array(

		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Email ID', 'mosque_crunchpress'),
			'desc' => __('Please write your email address.', 'mosque_crunchpress')
		),
		
		'logo_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Logo URL', 'mosque_crunchpress'),
			'desc' => __('Please Add Logo Image URL.', 'mosque_crunchpress')
		),
		
		'facebook_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Facebook Address', 'mosque_crunchpress'),
			'desc' => __('Please write your Facebook Address.', 'mosque_crunchpress')
		),
		
		'twitter_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Twitter Address', 'mosque_crunchpress'),
			'desc' => __('Please write your Twitter Address.', 'mosque_crunchpress')
		),
		
		'rss_url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('RSS Feed Address', 'mosque_crunchpress'),
			'desc' => __('Please write your RSS Feed Address.', 'mosque_crunchpress')
		),

		'content' => array(
			'std' => 'Your Content',
			'type' => 'textarea',
			'label' => __( 'Content Text', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the Content Text', 'mosque_crunchpress' ),
		),	
		
	),
	'shortcode'=>'[newsletter email="{{email}}" rss_url = "{{rss_url}}" logo_url="{{logo_url}}" facebook_url="{{facebook_url}}" twitter_url="{{twitter_url}}" ]{{content}}[/newsletter]',
	'popup_title' => __( 'Newsletter  Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Show Category Short-code
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['show_category'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Title Here', 'mosque_crunchpress'),
			'desc' => __('Add Title Of Your Category.', 'mosque_crunchpress')
		),
		
		'caption' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Caption', 'mosque_crunchpress'),
			'desc' => __('Add Caption For Your Product Category.', 'mosque_crunchpress')
		),
		
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Product Listing Page URL Here', 'mosque_crunchpress'),
			'desc' => __('Add the URL Of Product Listing Page ex: http://example.com/shop', 'mosque_crunchpress')
		),
		
		'btn_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Text For The Button', 'mosque_crunchpress'),
			'desc' => __('Add Text For The Button.', 'mosque_crunchpress')
		),
		
		'image_url' => array(
			'type' => 'uploader',
			'label' => __('Upload Image', 'mosque_crunchpress'),
			'desc' => __('Upload the slider image', 'mosque_crunchpress'),
		),

		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Add Content For Product Category.', 'mosque_crunchpress' ),
		),	
		
	),
	'shortcode'=>'[show_category title="{{title}}" caption="{{caption}}" link="{{link}}" image_url="{{image_url}}" btn_text="{{btn_text}}"]{{content}}[/show_category]',
	'popup_title' => __( 'Product Category  Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Product Slider bx Shortcode
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['product_BX'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Title Here', 'mosque_crunchpress'),
			'desc' => __('Add Title Of Your Shortcode.', 'mosque_crunchpress')
		),

		'gallery_id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Gallery ID Here', 'mosque_crunchpress'),
			'desc' => __('Add Gallery ID For Fetching Images From That Gallery.', 'mosque_crunchpress')
		),
	),
	'shortcode'=>'[product_BX title="{{title}}" gallery_id="{{gallery_id}}"][/product_BX]',
	'popup_title' => __( 'Product BX Shortcode', 'mosque_crunchpress' )
);


/*-----------------------------------------------------------------------------------*/
/*	Pricing Table
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['pricing_table'] = array(
	'no_preview' => true,
	'params' => array(

		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Border Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'dividercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Divider Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'columns' => array(
			'type' => 'select_col',
			'label' => __('Number of Columns', 'mosque_crunchpress'),
			'desc' => 'Select how many columns to display',
			'options' => array(
				'&lt;br /&gt;[column col=&quot;1/1&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;' => '1 Column',				
				'&lt;br /&gt;[column col=&quot;1/2&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;&lt;br /&gt;[column col=&quot;1/2&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;' => '2 Column',
				'&lt;br /&gt;[column col=&quot;1/3&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;&lt;br /&gt;[column col=&quot;1/3&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;&lt;br /&gt;[column col=&quot;1/3&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;' => '3 Column',
				'&lt;br /&gt;[column col=&quot;1/4&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;&lt;br /&gt;[column col=&quot;1/4&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;&lt;br /&gt;[column col=&quot;1/4&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;&lt;br /&gt;[column col=&quot;1/4&quot;][pricing_header title=&quot;Standard&quot;][pricing_price currency=&quot;$&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][/pricing_header]&lt;br /&gt;[pricing_column]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 1[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 2[/pricing_row]&lt;br /&gt;[pricing_row link=&quot;#&quot;]Feature 3[/pricing_row]&lt;br /&gt;[/pricing_column]&lt;br /&gt;[pricing_footer link=&quot;#&quot;]Signup[/pricing_footer][/column]&lt;br /&gt;' => '4 Column',
			)
		)
	),
	'shortcode' => '[pricing_table backgroundcolor="{{backgroundcolor}}" bordercolor="{{bordercolor}}" dividercolor="{{dividercolor}}"]{{columns}}[/pricing_table]',
	'popup_title' => __( 'Pricing Table Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Feature Projects
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['feature_project'] = array(
	
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Sub Text', 'mosque_crunchpress'),
			'desc' => __('Add Sub Text for the image.', 'mosque_crunchpress')
		),
		'feature_id' => array(
			'type' => 'select',
			'label' => __( 'Select the Project', 'mosque_crunchpress' ),
			'desc' =>  __( 'Choose to Project from the list.', 'mosque_crunchpress' ),
			'options' => $ignition_product
		),
		
		
	),
	'shortcode'=>'[feature_project feature_id="{{feature_id}}" ][/feature_project]',
	'popup_title' => __( 'Feature Project', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Feature Projects
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['cp_slider'] = array(
	
	'no_preview' => true,
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __( 'Select the layout Type', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of alert message', 'mosque_crunchpress' ),
			'options' => array(
				'eco-slider' => 'ECO slider',
				'church-slider' => 'Church Slider',
				'politics-slider' => 'Politics Slider',
			)
		),
		'slider_id' => array(
			'type' => 'select',
			'label' => __( 'Select the slider', 'mosque_crunchpress' ),
			'desc' =>  __( 'Choose to slider from the list.', 'mosque_crunchpress' ),
			'options' => $cp_slider
		),
		
		
	),
	'shortcode'=>'[cp_slider style="{{style}}" slider_id="{{slider_id}}" ][/cp_slider]',
	'popup_title' => __( 'Main Slider', 'mosque_crunchpress' )
);
/*-----------------------------------------------------------------------------------*/
/*	Recent Projects
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['recent_projects'] = array(
	
	'no_preview' => true,
	'params' => array(
		
	),
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Title', 'mosque_crunchpress'),
				'desc' => __('Add caption for the image.', 'mosque_crunchpress')
			),
			
			'image_url' => array(
				'type' => 'uploader',
				'label' => __('Upload Image', 'mosque_crunchpress'),
				'desc' => __('Upload the slider image', 'mosque_crunchpress'),
			),
			
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Link', 'mosque_crunchpress'),
				'desc' => __('Add link here.', 'mosque_crunchpress')
			),
		),
		'shortcode'=> '[recent_projects title="{{title}}" image_url="{{image_url}}" link="{{link}}" ][/recent_projects]',
		'clone_button' => __('Add Another Slide', 'mosque_crunchpress')
			
	),
);

/*-----------------------------------------------------------------------------------*/
/*	Project Facts Shortcode
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['project_facts'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		
		'count' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Title Facts Count', 'mosque_crunchpress'),
			'desc' => __('Add the Count', 'mosque_crunchpress')
		),
		'text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Title Text', 'mosque_crunchpress'),
			'desc' => __('Write The Title Text For Fact', 'mosque_crunchpress')
		),
		
	),
	'shortcode'=>'[project_facts icon="{{icon}}" count="{{count}}" text="{{text}}"][/project_facts]',
	'popup_title' => __( 'Project_Facts', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Project Facts Shortcode
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['project_slider'] = array(
	'no_preview' => true,
	'params' => array(

		'cat_id' => array(
			'type' => 'select',
			'label' => __( 'Select the Project Category', 'mosque_crunchpress' ),
			'desc' =>  __( 'Choose to Project Category', 'mosque_crunchpress' ),
			'options' => $project_category
		),
		
		'num_fetch' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Number Of Posts', 'mosque_crunchpress'),
			'desc' => __('Number Of Posts To Display On The Slider', 'mosque_crunchpress')
		),
		
		'order' => array(
			'type' => 'select',
			'label' => __( 'Select the layout Type', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of alert message', 'mosque_crunchpress' ),
			'options' => array(
				'asc' => 'Ascending Order',
				'desc' => 'Descending Order'
			)
		),
		
	),
	'shortcode'=>'[project_slider cat_id="{{cat_id}}" num_fetch = "{{num_fetch}}" order="{{order}}"][/project_slider]',
	'popup_title' => __( 'Crowd Funding Projects Slider', 'mosque_crunchpress' )
);


/*-----------------------------------------------------------------------------------*/
/*	NewsPost Slider Shortcode
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['newspost_slider'] = array(
	'no_preview' => true,
	'params' => array(

		'cat_id' => array(
			'type' => 'select',
			'label' => __( 'Select the Post Category', 'mosque_crunchpress' ),
			'desc' =>  __( 'Choose to Project Category', 'mosque_crunchpress' ),
			'options' => $category
		),
		
		'num_fetch' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Number Of Posts', 'mosque_crunchpress'),
			'desc' => __('Number Of Posts To Display On The Slider', 'mosque_crunchpress')
		),
		
		'order' => array(
			'type' => 'select',
			'label' => __( 'Select the layout Type', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of alert message', 'mosque_crunchpress' ),
			'options' => array(
				'asc' => 'Ascending Order',
				'desc' => 'Descending Order'
			)
		),
		
	),
	'shortcode'=>'[newspost_slider cat_id="{{cat_id}}" num_fetch = "{{num_fetch}}" order="{{order}}"][/newspost_slider]',
	'popup_title' => __( 'News Post Slider', 'mosque_crunchpress' )
);


/*-----------------------------------------------------------------------------------*/
/*	Services
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['services'] = array(
	'no_preview' => true,
	'params' => array(
	
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Select the layout Type', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of alert message', 'mosque_crunchpress' ),
			'options' => array(
				'circle-icon-top' => 'Circle Icon Top',
				'circle-icon-left' => 'Circle Icon Left',
				'circle-icon-right' => 'Circle Icon Right',
				'box-icon-top' => 'Box Icon Top',
				'box-icon-right' => 'Box Icon Right',
				'icon-right' => 'Icon Right',
				'top-icon-box-outside' => 'Top Icon Box Outside',
				'icon-top-simple' => 'Simple Icon Top',
			)
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __('Select Icon', 'mosque_crunchpress'),
			'desc' => __('Click an icon to select, click again to deselect', 'mosque_crunchpress'),
			'options' => $icons
		),
		
		'service_class' => array(
			'type' => 'select',
			'label' => __( 'Select the Style', 'mosque_crunchpress' ),
			'desc' => __( 'Select the Style For Cicle Icon Left Only', 'mosque_crunchpress' ),
			'options' => array(
				'service1' => 'Style 1',
				'service2' => 'Style 2',
			)
		),
		
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Title Text', 'mosque_crunchpress'),
			'desc' => __('Add the title', 'mosque_crunchpress')
		),
		'excerpt_words' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Excerpt Words', 'mosque_crunchpress'),
			'desc' => __('Select the number of excerpt words', 'mosque_crunchpress')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Link', 'mosque_crunchpress'),
			'desc' => __('Add the url ex: http://example.com', 'mosque_crunchpress')
		),
		'linktext' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Link Text Words', 'mosque_crunchpress'),
			'desc' => __('Read More Text', 'mosque_crunchpress')
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[services layout="{{layout}}" service_class = "{{service_class}}" icon="{{icon}}" title="{{title}}" excerpt_words="{{excerpt_words}}" link="{{link}}" linktext="{{linktext}}"]{{content}}[/services]',
	'popup_title' => __( 'Services Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Posts
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['recent_posts'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Select Layout', 'mosque_crunchpress' ),
			'desc' => __( 'Select the layout option', 'mosque_crunchpress' ),
			'options' => array(
				'default' => 'Default',
				'thumbnails-on-side' => 'Thumbnails-on-side',
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Select Column', 'mosque_crunchpress' ),
			'desc' => __( 'Select the column option', 'mosque_crunchpress' ),
			'options' => array(
				'1-1' => '1-1',
				'1-4' => '1-4',
			)
		),
		
		'number_posts' => array(
			'type' => 'select',
			'label' => __( 'Number of Posts', 'mosque_crunchpress' ),
			'desc' => __( 'Select number of posts', 'mosque_crunchpress' ),
			'options' => cp_shortcodes_range( 25, true, true )
		),
		
		'cat_id' => array(
			'type' => 'select',
			'label' => __( 'Categories', 'mosque_crunchpress' ),
			'desc' => __( 'Select a category or leave blank for all', 'mosque_crunchpress' ),
			'options' => $category
		),
		
		'thumbnail' => array(
			'type' => 'select',
			'label' => __( 'Thumbnail', 'mosque_crunchpress' ),
			'desc' => __( 'Yes or No', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No',
			
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Title Text', 'mosque_crunchpress'),
			'desc' => __('Add Title Here', 'mosque_crunchpress')
		),
		'post_meta' => array(
			'type' => 'select',
			'label' => __( 'Post Meta', 'mosque_crunchpress' ),
			'desc' => __( 'Yes or No (Author, comments, date etc.)', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No',
			
			)
		),
		'excerpt' => array(
			'type' => 'select',
			'label' => __( 'Show Excerpt', 'mosque_crunchpress' ),
			'desc' => __( 'Yes or No', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No',
			
			)
		),
		'excerpt_words' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Number of Characters', 'mosque_crunchpress'),
			'desc' => __('Add number of characters eg. 100 to 400', 'mosque_crunchpress')
		),
		
	),
	'shortcode'=>'[recent_posts layout="{{layout}}" columns="{{columns}}" number_posts="{{number_posts}}" cat_id="{{cat_id}}" thumbnail="{{thumbnail}}" title="{{title}}" post_meta="{{post_meta}}" excerpt="{{excerpt}}" excerpt_words="{{excerpt_words}}"][/recent_posts]',
	'popup_title' => __( 'Recent Posts Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	SoundCloud
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['sound-cloud'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type of Embed', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of Embed', 'mosque_crunchpress' ),
			'options' => array(
				'visual-embed' => 'Visual Embed',
				'classic-embed' => 'Classic Embed',
			)
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('URL of Sound Cloud', 'mosque_crunchpress'),
			'desc' => __('Add the url example: https://api.soundcloud.com/tracks/142314548', 'mosque_crunchpress')
		),
		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'auto_play' => array(
			'type' => 'select',
			'label' => __( 'AutoPlay', 'mosque_crunchpress' ),
			'desc' => __( 'True or False', 'mosque_crunchpress' ),
			'options' => array(
				'true' => 'true',
				'false' => 'false',
			
			)
		),
		'hide_related' => array(
			'type' => 'select',
			'label' => __( 'Hide Related', 'mosque_crunchpress' ),
			'desc' => __( 'True or False', 'mosque_crunchpress' ),
			'options' => array(
				'true' => 'true',
				'false' => 'false',
			
			)
		),
		'show_artwork_or_visual' => array(
			'type' => 'select',
			'label' => __( 'Show Artwork or Visual', 'mosque_crunchpress' ),
			'desc' => __( 'True or False', 'mosque_crunchpress' ),
			'options' => array(
				'true' => 'true',
				'false' => 'false',
			
			)
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Set Width', 'mosque_crunchpress'),
			'desc' => __('Set The Width in percent e.g 100%', 'mosque_crunchpress')
		),
		
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Set Height', 'mosque_crunchpress'),
			'desc' => __('Set The Height e.g 150px', 'mosque_crunchpress')
		),
		
		'iframe' => array(
			'type' => 'select',
			'label' => __( 'Use Iframe', 'mosque_crunchpress' ),
			'desc' => __( 'True or False', 'mosque_crunchpress' ),
			'options' => array(
				'true' => 'true',
				'false' => 'false',
			
			)
		),

	),
	'shortcode'=>'[soundcloud type="{{type}}" url="{{url}}" color="{{color}}" auto_play="{{auto_play}}" hide_related="{{hide_related}}" show_artwork_or_visual="{{show_artwork_or_visual}}" width="{{width}}" height="{{height}}" iframe="{{iframe}}" /]',
	'popup_title' => __( 'SoundCloud Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Slider
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['slider'] = array(
	'no_preview' => true,
	'params' => array(

		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Set Width', 'mosque_crunchpress'),
			'desc' => __('Set The Width in percent e.g 100%', 'mosque_crunchpress')
		),
		
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Set Height', 'mosque_crunchpress'),
			'desc' => __('Set The Height e.g 150px', 'mosque_crunchpress')
		),

	),
	'shortcode'=>'[slider width="{{width}}" height="{{height}}"]{{child_shortcode}}[/slider]',
	'popup_title' => __( 'Slider Shortcode', 'mosque_crunchpress' ),
	'child_shortcode' => array(
		'params' => array(
		
			'slider_type' => array(
				'type' => 'select',
				'label' => __( 'Select Type', 'mosque_crunchpress' ),
				'desc' => __( 'Select the type of slider eg. image, video(Selecting Video link options as well as light box will be deactivate)', 'mosque_crunchpress' ),
				'options' => array(
					'image' => 'Image',
					'video' => 'Video',
				)
			),
			
			'image_url' => array(
				'type' => 'uploader',
				'label' => __('Upload Image', 'mosque_crunchpress'),
				'desc' => __('Upload the slider image', 'mosque_crunchpress'),
			),
			
			'image_target' => array(
				'type' => 'select',
				'label' => __( 'Select Target', 'mosque_crunchpress' ),
				'desc' => __( '_blank or _self (work only with image!)', 'mosque_crunchpress' ),
				'options' => array(
					'_blank' => '_blank',
					'_self' => '_self',
				
				)
			),
			'image_lightbox' => array(
				'type' => 'select',
				'label' => __( 'Select Link Type', 'mosque_crunchpress' ),
				'desc' => __( 'Select the type of image to open in lightbox or link to anyother target (work only with image!)', 'mosque_crunchpress' ),
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				)
			),
			
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add URL', 'mosque_crunchpress'),
				'desc' => __('Add url for image.', 'mosque_crunchpress')
			),
			
			'image_content' => array(
				'std' => 'Image Content',
				'type' => 'textarea',
				'label' => __( 'Add Image Content', 'mosque_crunchpress' ),
				'desc' => __( 'Title and Description', 'mosque_crunchpress' ),
			),
						
			'video_content' => array(
				'std' => 'Your Shortcode Goes Here',
				'type' => 'textarea',
				'label' => __( 'Add Shortcode Here', 'mosque_crunchpress' ),
				'desc' => __( 'Add Video here', 'mosque_crunchpress' ),
			),
		),

		'shortcode'=> '[slide type="{{type}}" image_url="{{image_url}}" link="{{link}}" target="{{image_target}}" lightbox="{{image_lightbox}}"]{{content}}[/slide]',
		'clone_button' => __('Add Another Slide', 'mosque_crunchpress')
	)
		
);

/*-----------------------------------------------------------------------------------*/
/*	Separator
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['separator'] = array(
	'no_preview' => true,
	'params' => array(

		'margin_top_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Margin From Top and Bottom', 'mosque_crunchpress'),
			'desc' => __('Give number from 20px to 50px', 'mosque_crunchpress')
		),
		
		'size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add size of separator', 'mosque_crunchpress'),
			'desc' => __('Give number from 1px to 10px', 'mosque_crunchpress')
		),
		
		'style' => array(
			'type' => 'select',
			'label' => __( 'Select The Style', 'mosque_crunchpress' ),
			'desc' => __( 'Select the style of seperator', 'mosque_crunchpress' ),
			'options' => array(
				'none' => 'none',
				'solid' => 'solid',
				'double' => 'double',
				'dashed' => 'dashed',
				'dotted' => 'dotted',
				'ridge' => 'ridge',
			)
		),
		
		'color' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
	),
	'shortcode'=>'[separator margin_top_bottom="{{margin_top_bottom}}" size ="{{size}}" style="{{style}}" color="{{color}}"]',
	'popup_title' => __( 'Separator Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['tabs'] = array(
	'no_preview' => true,
	'params' => array(

	),
	//'shortcode'=>'[tab]<br>[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br>[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br>[tab_item title="ITEM_TITLE"]ADD_CONTENT_HERE[/tab_item]<br>[/tab]<br /> <br />',
	'shortcode'=>'[tab]{{child_shortcode}}[/tab]',
	'popup_title' => __( 'Tabs Shortcode', 'mosque_crunchpress' ),
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
		
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Set Title', 'mosque_crunchpress'),
				'desc' => __('Item Title', 'mosque_crunchpress')
			),
			
			'content' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'Your Item Content Here', 'mosque_crunchpress' ),
				'desc' => __( 'Item Content', 'mosque_crunchpress' ),
			),
		),

		'shortcode'=> '[tab_item title="{{title}}"]{{content}}[/tab_item]',
		'clone_button' => __('Add Another Tab', 'mosque_crunchpress')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Accordion
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['accordion'] = array(
	'no_preview' => true,
	'params' => array(
		
	),
	
	'shortcode'=> '[accordion]{{child_shortcode}}[/accordion]',
	'popup_title' => __( 'accordion Shortcode', 'mosque_crunchpress' ),
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => 'Item 1',
				'type' => 'text',
				'label' => __('Set Title', 'mosque_crunchpress'),
				'desc' => __('Item Title', 'mosque_crunchpress')
			),
			
			'content' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'Your Item Content Here', 'mosque_crunchpress' ),
				'desc' => __( 'Item Content', 'mosque_crunchpress' ),
			),
		),
		'shortcode'=>'[acc_item title="{{title}}"]{{content}}[/acc_item]',
		'clone_button' => __('Add Another Accordian Tab', 'mosque_crunchpress')
			
	),
	
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonials
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['testimonials'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __( 'Select Type', 'mosque_crunchpress' ),
			'desc' => __( 'Select testimonial type from dropdown.', 'mosque_crunchpress' ),
			'options' => array(
				'slider' => 'Testimonial Slider',
				'grid' => 'Testimonial Grid',
				'no-image' => 'Testimonial Without Image ',
			
				)
		),
	),
	//'shortcode'=>'[testimonials]<br />[testimonial name="John Doe" picture="image path" company="My Company" link="" target=""]"Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consec tetur, adipisci velit, sed quia non numquam eius modi tempora incidunt utis labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minimas veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur slores amet untras vel illum qui."[/testimonial]<br />[testimonial name="John Doe" picture="image path" company="My Company" link="" target=""]"Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consec tetur, adipisci velit, sed quia non numquam eius modi tempora incidunt utis labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minimas veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur slores amet untras vel illum qui."[/testimonial]<br />[/testimonials]',
	
	'shortcode'=>'[testimonials type="{{type}}"]{{child_shortcode}}[/testimonials]',
	'popup_title' => __( 'Testimonials Shortcode', 'mosque_crunchpress' ),
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Name of person', 'mosque_crunchpress'),
				'desc' => __('Add Name', 'mosque_crunchpress')
			),
			'picture' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Image Path', 'mosque_crunchpress'),
				'desc' => __('Add Image Path  ex: http://example.com', 'mosque_crunchpress')
			),
			'company' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Company Name', 'mosque_crunchpress'),
				'desc' => __('Add Company Name Here', 'mosque_crunchpress')
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Image link', 'mosque_crunchpress'),
				'desc' => __('Add Image link here  ex: http://example.com', 'mosque_crunchpress')
			),
			
			'target' => array(
				'type' => 'select',
				'label' => __( 'Select Target', 'mosque_crunchpress' ),
				'desc' => __( '_blank or _self', 'mosque_crunchpress' ),
				'options' => array(
					'_blank' => '_blank',
					'_self' => '_self',
				
				)
			),
			
			'content' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'Content', 'mosque_crunchpress' ),
				'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
			),
		),

		'shortcode'=> '[testimonial name="{{name}}" picture="{{picture}}" company="{{company}}" link="{{link}}" target="{{target}}"]{{content}}[/testimonial]',
		'clone_button' => __('Add Testimonial', 'mosque_crunchpress')
	),
);

/*-----------------------------------------------------------------------------------*/
/*	locators
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['locators'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __( 'Select Type', 'mosque_crunchpress' ),
			'desc' => __( 'Select Locator Type.', 'mosque_crunchpress' ),
			'options' => array(
				'events' => 'Events',
				)
		),
	),
	//'shortcode'=>'[testimonials]<br />[testimonial name="John Doe" picture="image path" company="My Company" link="" target=""]"Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consec tetur, adipisci velit, sed quia non numquam eius modi tempora incidunt utis labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minimas veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur slores amet untras vel illum qui."[/testimonial]<br />[testimonial name="John Doe" picture="image path" company="My Company" link="" target=""]"Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consec tetur, adipisci velit, sed quia non numquam eius modi tempora incidunt utis labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minimas veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur slores amet untras vel illum qui."[/testimonial]<br />[/testimonials]',
	
	'shortcode'=>'[locators type="{{type}}"]{{child_shortcode}}[/locators]',
	'popup_title' => __( 'Locator Shortcode', 'mosque_crunchpress' ),
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
		
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Name', 'mosque_crunchpress'),
				'desc' => __('Add Name For The Event/Occasion', 'mosque_crunchpress')
			),
			'lat' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Latitude', 'mosque_crunchpress'),
				'desc' => __('Add Latitude Of The Location', 'mosque_crunchpress')
			),
			'long' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Longitude', 'mosque_crunchpress'),
				'desc' => __('Add Longitude Of The Location ', 'mosque_crunchpress')
			),
			'venue' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Venue', 'mosque_crunchpress'),
				'desc' => __('Add Venue For The Event', 'mosque_crunchpress')
			),
			'address' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Address', 'mosque_crunchpress'),
				'desc' => __('Add Address Of The Location', 'mosque_crunchpress')
			),

			'content' => array(
				'std' => 'Your Content Goes Here',
				'type' => 'textarea',
				'label' => __( 'Content', 'mosque_crunchpress' ),
				'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
			),
		),

		'shortcode'=> '[locator name="{{name}}" lat="{{lat}}" long="{{long}}" venue="{{venue}}" address="{{address}}"]{{content}}[/locator]',
		'clone_button' => __('Add Location', 'mosque_crunchpress')
	),
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonial
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['testimonial'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Select the type', 'mosque_crunchpress' ),
			'desc' => __( 'Select the type of alert message', 'mosque_crunchpress' ),
			'options' => array(
				'default' => 'default',
				'custom-style' => 'custom-style',
			)
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __('Background Color', 'mosque_crunchpress'),
			'desc' => 'Leave blank for default'
		),
		'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __('Add Name of person', 'mosque_crunchpress'),
				'desc' => __('Add Name', 'mosque_crunchpress')
		),
		'picture' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Image Path', 'mosque_crunchpress'),
			'desc' => __('Add Image Path  ex: http://example.com', 'mosque_crunchpress')
		),
		'company' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Company Name', 'mosque_crunchpress'),
			'desc' => __('Add Company Name Here', 'mosque_crunchpress')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Image link', 'mosque_crunchpress'),
			'desc' => __('Add Image link here  ex: http://example.com', 'mosque_crunchpress')
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Select Target', 'mosque_crunchpress' ),
			'desc' => __( '_blank or _self', 'mosque_crunchpress' ),
			'options' => array(
				'_blank' => '_blank',
				'_self' => '_self',
			
			)
		),
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
		),
		
	),
	
	'shortcode'=>'[testimonial type="{{type}}" backgroundcolor="{{backgroundcolor}}" name="{{name}}" picture="{{picture}}" company="{{company}}" link="{{link}}" target="{{target}}"]{{content}}[/testimonial]',
	'popup_title' => __( 'Testimonial Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Title
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['title'] = array(
	'no_preview' => true,
	'params' => array(

		'size' => array(
			'type' => 'select',
			'label' => __( 'Heading Size', 'mosque_crunchpress' ),
			'desc' => __( 'Select the Heading', 'mosque_crunchpress' ),
			'options' => array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			)
		),
		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[title size="{{size}}"]{{content}}[/title]',
	'popup_title' => __( 'Title Shortcode', 'mosque_crunchpress' )
);


/*-----------------------------------------------------------------------------------*/
/*	Tooltip
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['tooltip'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Text for Tooltip', 'mosque_crunchpress'),
			'desc' => __('Text to appear as tooltip', 'mosque_crunchpress')
		),
		
		'content' => array(
			'std' => 'Your Content Goes Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the content', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[tooltip title="{{title}}"]{{content}}[/tooltip]',
	'popup_title' => __( 'Tooltip Shortcode', 'mosque_crunchpress' )
);


/*-----------------------------------------------------------------------------------*/
/*	Table
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['table'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __('Type', 'mosque_crunchpress'),
			'desc' => __('Select the table style', 'mosque_crunchpress'),
			'options' => array(
				'1' => 'Style 1',
				'2' => 'Style 2',
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __('Number of Columns', 'mosque_crunchpress'),
			'desc' => 'Select how many columns to display',
			'options' => array(
				'1' => '1 Column',
				'2' => '2 Columns',
				'3' => '3 Columns',
				'4' => '4 Columns'
			)
		)
	),
	'shortcode' => '',
	'popup_title' => __( 'Table Shortcode', 'mosque_crunchpress' )
);
/*-----------------------------------------------------------------------------------*/
/*	Vimeo
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(

		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add Width Here', 'mosque_crunchpress'),
			'desc' => __('Add the Width for your video ex: 600px', 'mosque_crunchpress')
		),
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add height Here', 'mosque_crunchpress'),
			'desc' => __('Add the height for your video ex: 350px', 'mosque_crunchpress')
		),
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Video URL', 'mosque_crunchpress'),
			'desc' => __('Add the Video url ex: http://vimeo.com/93120068', 'mosque_crunchpress')
		),
		
	),
	'shortcode'=>'[vimeo width="{{width}}" height="{{height}}"]{{content}}[/vimeo]',
	'popup_title' => __( 'Vimeo Shortcode', 'mosque_crunchpress' )
);


/*-----------------------------------------------------------------------------------*/
/*	Woo Products
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['woo_products'] = array(
	'no_preview' => true,
	'params' => array(

		'cat_id' => array(
			'type' => 'select',
			'label' => __( 'Select the ID', 'mosque_crunchpress' ),
			'desc' =>  __( 'Choose to Category ID', 'mosque_crunchpress' ),
			'options' => $product_cat
		),
		
		'number_posts' => array(
			'type' => 'select',
			'label' => __( 'Number of posts to show', 'mosque_crunchpress' ),
			'desc' => __( 'Select number of posts', 'mosque_crunchpress' ),
			'options' => cp_shortcodes_range( 25, true, true )
		),
		
		'show_price' => array(
			'type' => 'select',
			'label' => __( 'Show Price', 'mosque_crunchpress' ),
			'desc' => __( 'Yes or No', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'yes',
				'no' => 'no',
			)
		),
		'show_buttons' => array(
			'type' => 'select',
			'label' => __( 'Show Buttons', 'mosque_crunchpress' ),
			'desc' => __( 'Yes or No', 'mosque_crunchpress' ),
			'options' => array(
				'yes' => 'yes',
				'no' => 'no',
			)
		),
	),
	'shortcode'=>'[products_slider cat_id="{{cat_id}}" number_posts="{{number_posts}}" show_price="{{show_price}}" show_buttons="{{show_buttons}}"]',
	'popup_title' => __( 'Woo_Products Shortcode', 'mosque_crunchpress' )
);

/*-----------------------------------------------------------------------------------*/
/*	Youtube
/*-----------------------------------------------------------------------------------*/	
$cp_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(

		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add width of the video', 'mosque_crunchpress'),
			'desc' => __('Add the width example : 600px', 'mosque_crunchpress')
		),
		
		'height' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('Add height of the video', 'mosque_crunchpress'),
			'desc' => __('Add the height example : 350px', 'mosque_crunchpress')
		),
		
		'content' => array(
			'std' => 'Enter URL here',
			'type' => 'text',
			'label' => __( 'Youtube URL', 'mosque_crunchpress' ),
			'desc' => __( 'Insert the url', 'mosque_crunchpress' ),
		),
	),
	'shortcode'=>'[youtube width="{{width}}" height="{{height}}"]{{content}}[/youtube]',
	'popup_title' => __( 'youtube Shortcode', 'mosque_crunchpress' )
);
