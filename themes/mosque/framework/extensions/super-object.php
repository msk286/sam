<?php 
/*	
*	CrunchPress Super Object File
*	---------------------------------------------------------------------
* 	@version	1.0
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file Contain all the custom Built in function 
*	Developer Note: do not update this file.
*	---------------------------------------------------------------------
*/

	//Remove action from prayer box plugin
	if(function_exists('pb_includePublicCSS')){
		remove_action('wp_head', 'pb_includePublicCSS');
	}
	
	//Remove LayerSlider Scripts
	if(class_exists('LS_Sliders')){
		remove_action('wp_enqueue_scripts', 'layerslider_enqueue_content_res');
	}

	//get extended classes name
	function get_extends_name($base){
		$myclass = array();
		foreach(get_declared_classes() as $class){
			 if(is_subclass_of($class,$base)){ 
				$myclass[] = $class;
			 }
		}
		   return $myclass; 
	}
	
	//get number of extended Classes
	function get_extends_number($base){
		$rt=0;
		foreach(get_declared_classes() as $class){
			if(is_subclass_of($class,$base)){ 
				$rt++;
			}
		}
		return $rt;
	}
	// create Page Option Meta
	function class_function_layout(){	
		for($i =0;$i <= get_extends_number('function_library');$i++){
			$new_class = get_extends_name('function_library');
		}
		return $new_class;
	}
	
	// Find the XML value from XML Object
	function cp_find_xml_value($xml, $field){
	
		if(!empty($xml)){
		
			foreach($xml->childNodes as $xmlChild){
			
				if($xmlChild->nodeName == $field){
					if( is_admin() ){
						return $xmlChild->nodeValue;
					}else{
						return $xmlChild->nodeValue;
					}
				}
				
			}
			
		}
		
		return '';
		
	}
	
	// Checking Google Font	
	function verify_font($font_google){
	//print_r($font_google);
	$fonts_array = cp_get_font_array();
		foreach($fonts_array as $keys=>$values){
			if($values == 'Google Font'){
				if($keys == $font_google){
					return 'Google Font';
				}
			}
		}
	}
	
	function verify_google_f($font_google){
		$font_array = cp_get_font_array();
		$google_array_find = array_keys($font_array);
		if($font_google == 'Default'){return 'no_font';}else{
			if(in_array($font_google,$google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	
	function verify_google_para($font_heading){
		$font_array = cp_get_font_array();
		$google_array_find = array_keys($font_array);
		if($font_heading == 'Default'){return 'no_font';}else{
			if(in_array($font_heading,$google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	function verify_google_menu($font_menu){
		$font_array = cp_get_font_array();
		$google_array_find = array_keys($font_array);
		if($font_menu == 'Default'){return 'no_font';}else{
			if(in_array($font_menu,$google_array_find)){
				return 'google_font';
			}else{
				return 'type_kit';
			}
		}
	}
	
	function find_xml_child_nodes($xml_data,$tag_name,$child_node){
		if(!empty($xml_data)){
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $xml_data );
			$element_tag_name = $cp_slider->getElementsByTagName($tag_name);
			foreach($element_tag_name as $element_tag){
				foreach($element_tag->childNodes as $i){
					if($i->tagName == $child_node){
							return $i->nodeValue;
					}
				}
			}
		}
		return '';
	}
	
	//Array Values NodeValue
	function return_xml_array($children_des){
		$array_data = array();
		$counter = 0;
		foreach($children_des as $values){
			$array_data[] = $values->nodeValue;
		}
		return $array_data;
	}
	
	
	
		// return the title list of each post_type
	function get_slug_id( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->ID;
		}
		
		return $posts_title;
	
	}	
	// Find the XML node from XML Object
	function find_xml_node($xml, $node){
	
		if(!empty($xml)){
		
			foreach($xml->childNodes as $xmlChild){
			
				if($xmlChild->nodeName == $node){
				
					return $xmlChild;
					
				}
				
			}
			
		}
		
		return '';
		
	}
	
	// Create tag string from nodename and value
	function create_xml_tag($node, $value){
	
		return '<' . $node . '>' . $value . '</' . $node . '>';
		
	}
	
	// Get array of sidebar name
	function get_sidebar_name(){
	
		global $cp_sidebar;
		$sidebar = array();
		
		if(!empty($cp_sidebar)){
		
			$xml = new DOMDocument();
			$xml->loadXML($cp_sidebar);
			
			foreach( $xml->documentElement->childNodes as $sidebar_name ){
			
				$sidebar[] = $sidebar_name->nodeValue;
				
			}
			
		}
		
		return $sidebar;
		
	}
	cp_get_google_font();
	function cp_get_google_font(){
	
	get_template_part( 'framework/extensions/google', 'font' );
	  
		global $all_font;
		$google_fonts = update_google_font_array();
		
		foreach($google_fonts as $google_font){
		
			$all_font[$google_font['family']] = array('subsets' => $google_font['subsets'],'type'=>'Google Font','variants' => $google_font['variants']);
		
		}
		
	}
	
	// return a link to get the google font
	function cp_get_google_font_url( $font_family ){
		$google_font_list = cp_get_font_array();
		if( !empty($font_family) && !empty($google_font_list[$font_family]) ){
			$google_font = $google_font_list[$font_family];
			$temp_font_name  = str_replace(' ', '+' , $font_family) . ':';
			$temp_font_name .= apply_filters('cp_google_font_weight', implode(',', $google_font['variants'])) . '&subset='; 
			$temp_font_name .= apply_filters('cp_google_font_subset', implode(',', $google_font['subsets'])); 
			
			return CP_HTTP . 'fonts.googleapis.com/css?family=' . $temp_font_name;
		} 
		return '';
	}
	
	function cp_get_font_array( $type = '' ){
		global $all_font;
		
		$cp_typekit_settings = get_option('typokit_settings');
		if($cp_typekit_settings <> ''){
			$typekit_xml = new DOMDocument();
			$typekit_xml->loadXML($cp_typekit_settings);
			foreach( $typekit_xml->documentElement->childNodes as $typekit_font ){
					$all_font[$typekit_font->nodeValue] = array('status'=>'enabled','type'=>'Used font','is-used'=>false,);
			}
		}
		foreach($all_font as $font_name => $font_value){
		
			if(isset($font_value['type']) || $font_value['type'] == 'Google Font'){
				$fonts[$font_name] = $font_value; 
			}
			
		}
			
		return $fonts;
		
	}
	
	function cp_get_font_type( $font_family='' ){
		$font_found = '';
		global $fonts,$all_font;
		if($font_family == 'Default'){ }else{
			if($all_font[$font_family]['type'] == 'Google Font'){
				$font_found = 'Google_Font';
			}
		}		
		
		return $font_found;	
		
	}
	
	// get width and height from string WIDTHxHEIGHT
	function cp_get_width( $size ){
		$size_array = $size;
		return $size_array[0];
	}
	function cp_get_height( $size ){
		$size_array = $size;
		return $size_array[1];
	}
	
	// use ajax to print all of media image
	add_action('wp_ajax_get_media_image','get_media_image');
	function get_media_image(){
	
		$image_width = 60;
		$image_height = 60;
		
		$paged = (isset($_POST['page']))? $_POST['page'] : 1; 	
		if($paged == ''){ $paged = 1; }
		
		$statement = array('post_type' => 'attachment',
			'post_mime_type' =>'image',
			'post_status' => 'inherit', 
			'posts_per_page' => 12,
			'paged' => $paged);
		$media_query = new WP_Query($statement);
	
		?>
		
		<div class="media-title">
			<label><?php esc_html_e('Insert Gallery Items','mosque_crunchpress'); ?></label>
		</div>
		
		<?php
		
		echo '<div class="media-gallery-nav" id="media-gallery-nav">';
		echo '<ul>';
		echo '<a><li class="nav-first" rel="1" ></li></a>';
		
		for( $i=1 ; $i<=$media_query->max_num_pages; $i++){
		
			if($i == $paged){
				echo '<li rel="' . $i . '">' . $i . '</li>';
			}else if( ($i <= $paged+2 && $i >= $paged-2) || $i%10 == 0){
				echo '<a><li rel="' . $i . '">' . $i . '</li></a>';		
			}
			
		}
		echo '<a><li class="nav-last" rel="' . $media_query->max_num_pages . '"></li></a>';
		echo '</ul>';
		echo '</div>';
	
		echo '<ul>';
		
		foreach( $media_query->posts as $image ){ 
		
			$thumb_src = wp_get_attachment_image_src( $image->ID, array(60,60));
			$thumb_src_preview = wp_get_attachment_image_src( $image->ID, array(60,60));
			echo '<li><img src="' . esc_url($thumb_src[0]) .'" title="' . esc_attr($image->post_title) . '" attid="' . esc_attr($image->ID) . '" rel="' . esc_url($thumb_src_preview[0]) . '"/></li>';
		
		}
		
		echo '</ul>';
		
		if(isset($_POST['page'])){ die(''); }
	}
	
	
	//Adding Ajax Url for Dummy Data
	add_action('wp_head','cp_ajax_ajaxurl');
	function cp_ajax_ajaxurl() {?>
		<script type="text/JavaScript">
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var directory_url = '<?php echo get_template_directory_uri(); ?>';
		</script>
	<?php
	}

	// return the slider option array to use with javascript file
	function get_cp_slider_option_array($slider_option){
	
		$slider_setting = array();
	
		foreach($slider_option as $value){
			
			$set_value = get_option($value['name']);
			
			if(isset($value['oldname']) && $set_value){
			
				$slider_setting[$value['oldname']] = $set_value;
			
			}
		}
		
		return $slider_setting;
	}

		// return the array of category
	function get_category_list( $category_name, $parent='' ){
		
		if( empty($parent) ){ 
			
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			$category_list = array( '0' =>'All');
			
			foreach( $get_category as $category ){
				$category_list[] = $category->cat_name;
			}
				
			return $category_list;
			
		}else{
			
			$parent_id = get_term_by('name', $parent, $category_name);
			$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id	));
			$category_list = array( '0' => $parent );
			
			foreach( $get_category as $category ){
				$category_list[] = $category->cat_name;
			}
				
			return $category_list;		
		
		}
	}
	
		// return the array of category
	function get_category_list_array( $category_name, $parent='' ){
		
		if( empty($parent) ){ 
			$category_list = array();
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			if($get_category <> ''){
				foreach( $get_category as $category ){
					$category_list[] = $category;
				}
			}
				
			return $category_list;
			
		}else{
			
			$parent_id = get_term_by('name', $parent, $category_name);
			$get_category = get_categories( array( 'taxonomy' => $category_name, 'child_of' => $parent_id->term_id	));
			$category_list = array( '0' => $parent );
			if($get_category <> ''){
				foreach( $get_category as $category ){
					$category_list[] = $category;
				}
			}
				
			return $category_list;		
		
		}
	}
	
	
	
	
		
	
	// return the title list of each post_type
	function get_title_list( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->post_title;
		}
		
		return $posts_title;
	
	}
	
	function get_title_list_slug( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->post_name;
		}
		
		return $posts_title;
	
	}
	
	// return the title list of each post_type
	function get_title_list_array( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post;
		}
		
		return $posts_title;
	
	}

	
	
	// return the title list of each post_type
	function get_slug_list( $post_type ){
		
		$posts_title = array();
		$posts = get_posts(array('post_type' => $post_type, 'numberposts'=>100));
		
		foreach ($posts as $post) {
			$posts_title[] = $post->post_name;
		}
		
		return $posts_title;
	
	}		

	// return the title list of each post_type
	function layer_slider_title(){
		if(class_exists('LS_Sliders')){
			if(function_exists('layerslider_activation_scripts')){
				global $wpdb;
				$table_name = $wpdb->prefix . "layerslider";
					$sliders = $wpdb->get_results( "SELECT * FROM $table_name
						WHERE flag_hidden = '0' AND flag_deleted = '0'
						ORDER BY date_c ASC LIMIT 100" );
				if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table_name."'"))==1) {
					foreach($sliders as $keys=>$values){
						$post_title[] = $values->name;
										
					}
					return $post_title;
				}
			}
		}
	}
	
	// Return the Id of each slide added in layerslider
	function layer_slider_id(){
		if(class_exists('LS_Sliders')){
			if(function_exists('layerslider_activation_scripts')){
				global $wpdb,$post_id_slider;
				$post_id_slider = '';
				$table_name = $wpdb->prefix . "layerslider";
				$sliders = $wpdb->get_results( "SELECT * FROM $table_name
					WHERE flag_hidden = '0' AND flag_deleted = '0'
					ORDER BY date_c ASC LIMIT 100" );
				if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table_name."'"))==1) {
					foreach($sliders as $keys=>$values){
						$post_id_slider[] = $values->id;
										
					}
					return $post_id_slider;
				}			
			} //Scripts are activated
		} // Check Layer Class Exists
	} //Get LayerSlider Id
	
	
	
	function hexLighter($hex,$factor = 80) { 
		$new_hex = ''; 
		 
		$base['R'] = hexdec($hex{0}.$hex{1}); 
		$base['G'] = hexdec($hex{2}.$hex{3}); 
		$base['B'] = hexdec($hex{4}.$hex{5}); 
		 
		foreach ($base as $k => $v) 
			{ 
			$amount = 255 - $v; 
			$amount = $amount / 100; 
			$amount = round($amount * $factor); 
			$new_decimal = $v + $amount; 
		 
			$new_hex_component = dechex($new_decimal); 
			if(strlen($new_hex_component) < 2) 
				{ $new_hex_component = "0".$new_hex_component; } 
			$new_hex .= $new_hex_component; 
			} 
			 
		return $new_hex;     
	} 
	
	function hexDarker($hex,$factor = 30){
        $new_hex = '';
        
        $base['R'] = hexdec($hex{0}.$hex{1});
        $base['G'] = hexdec($hex{2}.$hex{3});
        $base['B'] = hexdec($hex{4}.$hex{5});
        
        foreach ($base as $k => $v)
                {
                $amount = $v / 100;
                $amount = round($amount * $factor);
                $new_decimal = $v - $amount;
        
                $new_hex_component = dechex($new_decimal);
                if(strlen($new_hex_component) < 2)
                        { $new_hex_component = "0".$new_hex_component; }
                $new_hex .= $new_hex_component;
                }
                
        return $new_hex;        
    }
	
	function show_sidebar($sidebar_name, $right_sidebar,$left_sidebar,$value_right,$value_left){?>
			
			<ul class="panel-body recipe_class row-fluid">
				
				<li class="panel-radioimage span12">
					<div class="panel-title ">
						<h3><?php esc_html_e('Select Sidebar', 'mosque_crunchpress'); ?></h3>
					</div>
					<div class="clear"></div>
					<div class="row-fluid">
					<?php 
					$options = array(
						'1'=>array('value'=>'right-sidebar','image'=>'/framework/images/right-sidebar.png'),
						'2'=>array('value'=>'left-sidebar','image'=>'/framework/images/left-sidebar.png'),
						'3'=>array('value'=>'both-sidebar','image'=>'/framework/images/both-sidebar.png','default'=>'selected'),
						'4'=>array('value'=>'both-sidebar-left','image'=>'/framework/images/both-sidebar-left.png'),
						'5'=>array('value'=>'both-sidebar-right','image'=>'/framework/images/both-sidebar-right.png'),
						'6'=>array('value'=>'no-sidebar','image'=>'/framework/images/no-sidebar.png')
					);
					foreach( $options as $option ){ ?>
						<div class='radio-image-wrapper span2'>
							<span class="head-sec-sidebar"><?php echo str_replace('-',' ',$option['value']); ?></span>
							<label for="<?php echo esc_attr($option['value']); ?>">
								<img src=<?php echo CP_PATH_URL.$option['image']?> class="<?php echo esc_attr($sidebar_name);?>" alt="<?php echo esc_attr($sidebar_name);?>">
								<div id="check-list" <?php 
									if($sidebar_name == $option['value']){
										echo 'class="check-list"';
									}
								?>>
							</div>                                
							</label>
							<input type="radio" name="sidebars" value="<?php echo esc_attr($option['value']); ?>" <?php 
									if($sidebar_name == $option['value']){
										echo 'checked';
									}
							?> id="<?php echo esc_attr($option['value']); ?>" class="<?php echo esc_attr($sidebar_name);?>"
							>                            
						</div>
					<?php } ?>
					</div>
				</li>
			</ul>
			<div class="row-fluid">
				<ul class="cp_right_sidebar recipe_class span6">
					
					<li class="panel-input">	
						<div class="panel-title">
							<h3><?php esc_html_e('Right Sidebar', 'mosque_crunchpress'); ?></h3>
						</div>
						<div class="combobox">
							<select name="<?php echo esc_attr($right_sidebar);?>" id="cp_sidebar_dropdown">								
								<?php
								$cp_sidebar_settings = get_option('sidebar_settings');
								if($cp_sidebar_settings <> ''){
									$sidebars_xml = new DOMDocument();
									$sidebars_xml->loadXML($cp_sidebar_settings);
									foreach( $sidebars_xml->documentElement->childNodes as $sidebar_name ){?>
										<option <?php if($value_right == $sidebar_name->nodeValue){ echo 'selected';}?> value="<?php echo esc_attr($sidebar_name->nodeValue); ?>"><?php echo esc_attr($sidebar_name->nodeValue); ?></option>
								<?php }
								} ?>	
							</select>
						</div>
						<p><?php esc_html_e('Select Slide from dropdown to use in main slider.', 'mosque_crunchpress'); ?></p>
					</li>
					
				</ul>
				<ul class="cp_left_sidebar recipe_class span6">
					
					<li class="panel-input">	
						<div class="panel-title">
							<h3><?php esc_html_e('Left Sidebar', 'mosque_crunchpress'); ?></h3>
						</div>
						<div class="combobox">
							<select name="<?php echo esc_attr($left_sidebar);?>" id="cp_sidebar_dropdown_left">								
								<?php
								if($cp_sidebar_settings <> ''){
									$sidebars_xml = new DOMDocument();
									$sidebars_xml->loadXML($cp_sidebar_settings);
									foreach( $sidebars_xml->documentElement->childNodes as $sidebar_name ){?>
										<option <?php if($value_left == $sidebar_name->nodeValue){ echo 'selected';}?> value="<?php echo esc_attr($sidebar_name->nodeValue); ?>"><?php echo esc_attr($sidebar_name->nodeValue); ?></option>
								<?php }
								} ?>	
							</select>
						</div>
						<p><?php esc_html_e('Select Slide from dropdown to use in main slider.', 'mosque_crunchpress'); ?></p>
					</li>
					
				</ul>
			</div>
			<div class="clear"></div>
<?php } 
	
	//Top Navigation Heading
	function cp_top_navigation_html(){		
		if($_GET['page']=="general_options"){ ?>
			<h2 class="main-title"><?php esc_html_e('General Settings','mosque_crunchpress');?></h2>
		<?php 
		}else if($_GET['page']=="typography_settings"){ ?>
			<h2 class="main-title"><?php esc_html_e('Typography Settings','mosque_crunchpress');?></h2>
		<?php
		
		}else if($_GET['page']=="slider_settings"){ ?>
			<h2 class="main-title"><?php esc_html_e('Slider Settings','mosque_crunchpress');?></h2>
		<?php
		
		}else if($_GET['page']=="sidebar_settings"){ ?>
			<h2 class="main-title"><?php esc_html_e('Sidebar Settings','mosque_crunchpress');?></h2>
		<?php
		
		}else if($_GET['page']=="default_pages_settings"){ ?>
			<h2 class="main-title"><?php esc_html_e('Default Settings','mosque_crunchpress');?></h2>
		<?php
		
		}else if($_GET['page']=="social_settings"){ ?>
			<h2 class="main-title"><?php esc_html_e('Social Settings','mosque_crunchpress');?></h2>
		<?php
		
		}else if($_GET['page']=="newsletter_settings"){ ?>
			<h2 class="main-title"><?php esc_html_e('Newsletter Settings','mosque_crunchpress');?></h2>
		<?php
		
		}else if($_GET['page']=="dummydata_import"){ ?>
			<h2 class="main-title"><?php esc_html_e('Dummy Content Settings','mosque_crunchpress');?></h2>
		<?php
		}			
	}
	
		//Top Navigation Heading
	function cp_top_navigation_html_tooltip(){	?>
		<ul class="tooltip-right">
			<li class="small-icon-tab icon gen_set<?php if($_GET['page']=="general_options"){echo " active";} ?>"><a href="?page=general_options" data-toggle="tooltip" title="" data-original-title="General Settings"> <i class="fa fa-home"></i></a> </li>
			
			<li class="small-icon-tab icon typo_set<?php if($_GET['page']=="typography_settings"){echo " active";} ?>"> <a href="?page=typography_settings" data-toggle="tooltip" title="" data-original-title="Typography" class=""><i class="fa fa-font"></i></a> </li>
			<li class="small-icon-tab icon slid_set<?php if($_GET['page']=="slider_settings"){echo " active";} ?>"> <a href="?page=slider_settings" class="" data-toggle="tooltip" title="" data-original-title="Slider"><i class="fa fa-picture-o"></i></a> </li>
			<li class="small-icon-tab icon side_set<?php if($_GET['page']=="sidebar_settings"){echo " active";} ?>"> <a href="?page=sidebar_settings" class="" data-toggle="tooltip" title="" data-original-title="Sidebar"><i class="fa fa-columns"></i></a> </li>
			<li class="small-icon-tab icon default_set<?php if($_GET['page']=="default_pages_settings"){echo " active";} ?>"> <a href="?page=default_pages_settings" class="" data-toggle="tooltip" title="" data-original-title="Default Pages"><i class="fa fa-file-text"></i></a> </li>
			<li class="small-icon-tab icon social_set<?php if($_GET['page']=="social_settings"){echo " active";} ?>"> <a href="?page=social_settings" class="" data-toggle="tooltip" title="" data-original-title="Social"><i class="fa fa-share"></i></a> </li>
			<li class="small-icon-tab icon news_set<?php if($_GET['page']=="newsletter_settings"){echo " active";} ?>"> <a href="?page=newsletter_settings" class="" data-toggle="tooltip" title="" data-original-title="Newsletter"><i class="fa fa-envelope"></i></a></li>
			<li class="small-icon-tab icon import_ex<?php if($_GET['page']=="dummydata_import"){echo " active";} ?>"> <a href="?page=dummydata_import" class="" data-toggle="tooltip" title="" data-original-title="Import Content"> <i class="fa fa-globe"></i></a></li>
			<?php $mystring = $_SERVER['REQUEST_URI'];
			$findme = 'seo_settings';
			$seo_settings = strpos($mystring, $findme);
			?>
			
		</ul>
	<?php
	}
	
	
	
	//Slider Id for Page Options Array
	function get_slider_id($slider_name){
		
		if(!empty($slider_name)){
		$layer_slider_id = get_post_meta( $slider_name, 'cp-slider-xml', true);
			if($layer_slider_id <> ''){
				$slider_xml_dom = new DOMDocument ();
				$slider_xml_dom->loadXML ( $layer_slider_id );
				return $slider_xml_dom->documentElement;
			}
		}
	}
	
	//Get Popular posts
	function cp_popular_set_post_views($postID) {
		$count_key = 'popular_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
	
	function cp_popular_track_post_views ($post_id) {
		if ( !is_single() ) return;
		if ( empty ( $post_id) ) {
			global $post;
			$post_id = $post->ID;    
		}
		cp_popular_set_post_views($post_id);
	}
	add_action( 'wp_head', 'cp_popular_track_post_views');


	function cp_wpb_get_post_views($postID){
		$count_key = 'popular_post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return esc_html_e('0 View', 'mosque_crunchpress');
		}
		return $count.esc_html_e('View','mosque_crunchpress');
	}
	
	//Page Slider 
	function cp_page_slider(){
	global $post;
		
		$slider_off = '';
		$slider_type = '';
		$slider_slide = '';
		$slider_height = '';
		$slider_off = get_post_meta ( $post->ID, "page-option-top-slider-on", true );
		if($slider_off == 'Yes'){
			//Get Page Main Slider Values
			$slider_type = get_post_meta ( $post->ID, "page-option-top-slider-types", true );
			$slider_layer_id = get_post_meta ( $post->ID, "page-option-top-slider-layer", true );
			$slider_shortcode = get_post_meta ( $post->ID, "page-option-top-slider-shortcode", true );
			
			$slider_slide = get_post_meta ( $post->ID, "page-option-top-slider-images", true );
			$slider_height = get_post_meta ( $post->ID, "page-option-top-slider-height", true );
			$size_new = '';
			//Print Main Slider Values on page
			
			if(!empty($slider_slide)){
				$slider_input_xml = get_post_meta( $slider_slide, 'cp-slider-xml', true);
				if($slider_input_xml <> ''){
				$slider_xml_dom = new DOMDocument ();
				$slider_xml_dom->loadXML ( $slider_input_xml );
					if($slider_type == 'Anything'){
						$slider_name = 'anything_page';
						echo '<div class="main-content anything_page">';
						echo cp_print_anything_slider($slider_name,$slider_xml_dom->documentElement,array(5000,1400));
						echo '</div>';
						
					} else if($slider_type == 'Flex-Slider'){
							echo cp_print_flex_slider($slider_xml_dom->documentElement,array(5000,1400));						
					}else if($slider_type == 'default'){
						echo cp_print_fine_slider($slider_xml_dom->documentElement,$size='980x654');
					}else if($slider_type == 'Bx-Slider'){
						echo '<div class="banner_slider">';
							echo cp_print_bx_slider($slider_xml_dom->documentElement,array(5000,1400),'abc123');
						echo '</div>';
					}
				}
			}
			// Layer SLider
			if($slider_type == 'Layer-Slider'){
				if(class_exists('LS_Sliders')){
					echo do_shortcode('[layerslider id="' . $slider_layer_id . '"]');
				}else{
					echo '<h2>'.esc_html_e('Please install the LayerSlider plugin.','mosque_crunchpress').'</h2>';
				}	
			}else if($slider_type == 'Add-Shortcode'){
				echo do_shortcode($slider_shortcode);
			}
		}
	}
	
	

	//Home Page Slider
	function cp_home_page_slider(){
		$home_slider_on = '';
		$home_select_slider = '';
		$layer_shortcode_text = '';
		$select_slide = '';
		$cp_typography_settings = get_option('homepage_settings');
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$home_slider_on = cp_find_xml_value($cp_typo->documentElement,'home_slider_on');
			$home_select_slider = cp_find_xml_value($cp_typo->documentElement,'home_select_slider');
			$layer_slider_id = cp_find_xml_value($cp_typo->documentElement,'layer_shortcode_text');
			$select_slide = cp_find_xml_value($cp_typo->documentElement,'select_slide');
		}
		if($home_slider_on == 'enable'){
			if($home_select_slider == 'layer_slider'){
				echo '<section class="layer_slider_holder">';
					echo do_shortcode('[layerslider id="' . $layer_slider_id . '"]');	
				echo '</section>';
			}
			
			if(!empty($select_slide)){
				$slider_images = get_post_meta( $select_slide, 'cp-slider-xml', true);
				if($slider_images <> ''){
				$slider_xml_dom = new DOMDocument ();
				$slider_xml_dom->loadXML ( $slider_images );
					if($home_select_slider == 'anything_slider'){
						echo '<div class="main-content anything_page">';
							$slider_name = 'anything';
							//Included Anything Slider Script
							wp_enqueue_style('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/css/anythingslider.css');
							wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
							wp_enqueue_script('cp-anything-slider');	
							wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', false, '1.0', true);
							wp_enqueue_script('cp-anything-slider-fx');	
							
							
							echo cp_print_anything_slider($slider_name,$slider_xml_dom->documentElement,$size='980x654');
						echo '</div>';
					}else if($home_select_slider == 'flex_slider'){
						wp_register_script('cp-flex-slider', CP_PATH_URL.'/frontend/js/jquery.flexslider.js', false, '1.0', true);
						wp_enqueue_script('cp-flex-slider');
						wp_enqueue_style('cp-flex-slider',CP_PATH_URL.'/frontend/css/flexslider.css');
							echo '<div id="homeContent">';
								echo cp_print_flex_slider($slider_xml_dom->documentElement,$size='100x654');
							echo '</div>';
					}else if($home_select_slider == 'default'){
						echo cp_print_fine_slider($slider_xml_dom->documentElement,$size='980x654');
						wp_register_script('cp-Default-Slider', CP_PATH_URL.'/frontend/js/slider.js', false, '1.0', true);
						wp_enqueue_script('cp-Default-Slider');				
						wp_enqueue_style('Default-Slider',CP_PATH_URL.'/frontend/css/slider.css');
					}
				}
			}			
				
		}
	}
	
	

	
	
	function cp_related_posts($cp_post_id){
		$orig_post = $cp_post_id;  
		global $post,$wp_query;  
		//$tags = wp_get_post_tags($post->ID);  
		$tags = '';
		$get_post_type = get_post_type( $orig_post->ID );
		if($get_post_type == 'post'){
			$tag_type = 'post_tag';
			$tags = wp_get_post_terms($orig_post->ID, 'post_tag');
		}else if($get_post_type == 'events'){
			$tag_type = 'event-tag';
			$tags = wp_get_post_terms($orig_post->ID, 'event-tag');
		}else if($get_post_type == 'portfolio'){
			$tag_type = 'portfolio-tag';
			$tags = wp_get_post_terms($orig_post->ID, 'portfolio-tag');
			
		}
      
		if ($tags) {  
		
		
			if ( $tags ) {
				$tax_ids = array();
				foreach( $tags as $individual_tax ) $tax_ids[] = $individual_tax->term_id;
		 
				$args = array(
					'tag__in'               => $tax_ids,
					'post__not_in'          => array( $post->ID ),
					'showposts'             => 4,
					'ignore_sticky_posts'   => 1
				);
		 
				$my_query = new wp_query( $args );
		 
			}
		?>
		<div class="related-posts">
			<ul class="row-fluid gallery">
			<?php
			$query = new WP_Query( $args );
			$counter_post = 0;
				while ( $query->have_posts() ){ $query->the_post(); 
				global $post,$post_id;
					if($orig_post <> $post->ID){
						if($counter_post % 4 == 0){
							$first_class = 'first';
							echo '<div class="clear"></div>';
						}else{
							$first_class = '';
							$clear_class= '';
						}$counter_post++;
						
						$thumbnail_id = get_post_thumbnail_id( $event->post_id );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' ); ?>
						<li class="span3 <?php echo esc_attr($first_class);?>">
							<div class="frame">
								<div class="caption">
									<a data-gal="prettyPhoto[gallery1]" class="zoom" href="<?php echo esc_url($thumbnail[0]);?>"><i class="fa fa-plus"></i></a>
								</div>
								<?php echo get_the_post_thumbnail($post->ID, array(350,350));?>
							</div>
						</li>
					<?php
					} 
				}
				?>
			</ul>
		</div>
	<?php 
		}  
		  
		$post = $orig_post;  
		wp_reset_query();  
    }
	
	
	function cp_related_timeline($cp_post_id){
		$orig_post = $cp_post_id;  
		global $post,$wp_query;  
		
		$tags = '';
		$get_post_type = get_post_type( $post->ID );
		if($get_post_type == 'post'){
			$tag_type = 'post_tag';
			$tags = wp_get_post_terms($post->ID, 'post_tag');
		}else if($get_post_type == 'events'){
			$tag_type = 'event-tag';
			$tags = wp_get_post_terms($post->ID, 'event-tag');
		}else if($get_post_type == 'portfolio'){
			$tag_type = 'portfolio-tag';
			$tags = wp_get_post_terms($post->ID, 'portfolio-tag');
		}else if($get_post_type == 'attractions'){
			$tag_type = 'attractions-tag';
			$tags = wp_get_post_terms($post->ID, 'attractions-tag');
		}
		$html_timeline = '';
		if ($tags) {  
		$tag_ids = array();  
		foreach($tags as $individual_tag){ 		
			$args = array(
				
				'post_type' => $get_post_type,
				'post__not_in'   => array( $orig_post->ID ),
				//'post__not_in'   => $orig_post->ID,
				'tax_query' => array(
					array(
						'taxonomy' => $tag_type,
						'field' => 'slug',
						'terms' => $individual_tag->slug,
						
					)
				)
			);
		}
		
		$query = new WP_Query( $args );
		if($query->have_posts()){
			$html_timeline .= '<div class="row">';
				$counter_post = 0;
				while ( $query->have_posts() ){
				$query->the_post(); 
				global $post,$post_id;
					if($counter_post % 4 == 0){
						$first_class = 'first';
						echo '<div class="clear"></div>';
					}else{
						$first_class = '';
						$clear_class= '';
					}$counter_post++;
					//empty clear div
							
					$thumbnail_id = get_post_thumbnail_id( $post->post_id );
					$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' );
					$html_timeline .= '
					
					<div class="col-md-4">
						<div class="thumb">
							<a href="'.esc_url(get_permalink()).'">
								'.get_the_post_thumbnail($post_id, array(570,300)).'
							</a>
						</div>
						<h4><a href="'.esc_url(get_permalink()).'">'.esc_attr(get_the_title()).'</a></h4>
					</div>';
				}
				wp_reset_postdata();				
				$html_timeline .= '</div>';
			}	
			return $html_timeline;
		}  
		  
		$post = $orig_post;  
		wp_reset_query();
		wp_reset_postdata();  
    }
	
	
	function cp_related_project($cp_post_id){
		$orig_post = $cp_post_id;  
		global $post,$wp_query;  
		//$tags = wp_get_post_tags($post->ID);  
		$tags = '';
		$get_post_type = get_post_type( $post->ID );
		if($get_post_type == 'post'){
			$tag_type = 'post_tag';
			$tags = wp_get_post_terms($post->ID, 'post_tag');
		}else if($get_post_type == 'event'){
			$tag_type = 'event-tag';
			$tags = wp_get_post_terms($post->ID, 'event-tag');
		}else if($get_post_type == 'attractions'){
			$tag_type = 'attractions-tag';
			$tags = wp_get_post_terms($post->ID, 'attractions-tag');
		}else if($get_post_type == 'services'){
			$tag_type = 'services-tag';
			$tags = wp_get_post_terms($post->ID, 'services-tag');
		}
		$html_project = '';
		if ($tags) {  
			$tag_ids = array();  
			foreach($tags as $individual_tag){ 		
				$args = array(
					
					'post_type' => $get_post_type,
					'showposts' => 3,
					'post__not_in'   => array( $orig_post->ID ),
					'tax_query' => array(
						array(
							'taxonomy' => $tag_type,
							'field' => 'slug',
							'terms' => $individual_tag->slug,
							
						)
					)
				);
			}		
		
			$query = new WP_Query( $args );	
			if ( $query->have_posts() ){		
				$html_project .= '<div class="related_services gallery"><div class="row">';				
				$counter_post = 0;
				while ( $query->have_posts() ){
					$query->the_post(); 
					global $post,$post_id;
					if($orig_post->ID <> $post->ID){
						if($counter_post % 3 == 0){
							$first_class = 'first';
							$clear_class= '<div class="clear"></div>';
						}else{
							$first_class = '';
							$clear_class= '';
						}$counter_post++;
						//empty clear div
						
						$service_detail_xml = get_post_meta($post->ID, 'service_detail_xml', true);
						if($service_detail_xml <> ''){
							$cp_service_xml = new DOMDocument ();
							$cp_service_xml->loadXML ( $service_detail_xml );
							$regular_price = cp_find_xml_value($cp_service_xml->documentElement,'regular_price');
							$current_price = cp_find_xml_value($cp_service_xml->documentElement,'current_price');
							$thumbnail_id = get_post_thumbnail_id( $post->ID );
							$image_thumb = wp_get_attachment_image_src($thumbnail_id, 'full');
						} 
						$thumbnail_id = get_post_thumbnail_id( $post->post_id );
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' ); 
						$html_project .= '
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="hservice">
								<ul>
									<li>
										<div class="block-image"> 
											'.get_the_post_thumbnail($post->ID, array(570,300)).'
											<div class="img-overlay-3-up pat-override"></div>
											<div class="img-overlay-3-down pat-override"></div>
											<ol class="static-style">
												<li class="white-rounded"><a href="'.esc_url(get_permalink()).'"><i class="fa fa-link"></i></a> </li>
												<li class="hicon"> <span>$'.esc_attr($regular_price).'</span> <strong>$'.esc_attr($current_price).'</strong> '.esc_html__("Only", "mosque_crunchpress").'</li>
												<li class="white-rounded"><a data-gal="prettyPhoto[gallery-'.esc_attr($post->ID).']" href="'.esc_url($image_thumb[0]).'"><i class="fa fa-plus"></i></a> </li>
											</ol>
										</div>
									</li>
									<li>
										<h4><a href="'.esc_url(get_permalink()).'">'.esc_attr(get_the_title()).'</a></h4>
										<p>'.strip_tags(do_shortcode(substr(esc_attr(get_the_content()),0,120))) . "...".'</p>
									</li>
									<li>
										<a class="readmore" href="'.esc_url(get_permalink()).'">'.esc_html__("Read More", "mosque_crunchpress").'</a>
									</li>
								</ul>
							</div>
						</div>';
					
					} 
				}
				$html_project .= '</div></div>';
			}else{
			
			}
		wp_reset_query();
		wp_reset_postdata();  
		
		}  
		return $html_project;
		
		wp_reset_query();
		wp_reset_postdata();  
		$post = $orig_post;  
		
    }
	
	
	function related_events($cp_post_id){
		$orig_post = $cp_post_id;  
		global $post,$wp_query;  
		//$tags = wp_get_post_tags($post->ID);  
		$tags = '';
		$get_post_type = get_post_type( $post->ID );
		if($get_post_type == 'post'){
			$tag_type = 'post_tag';
			$tags = wp_get_post_terms($post->ID, 'post_tag');
		}else if($get_post_type == 'events'){
			$tag_type = 'event-tag';
			$tags = wp_get_post_terms($post->ID, 'event-tag');
		}else if($get_post_type == 'portfolio'){
			$tag_type = 'portfolio-tag';
			$tags = wp_get_post_terms($post->ID, 'portfolio-tag');
		}
      
		if ($tags) {  
		$tag_ids = array();  
		foreach($tags as $individual_tag){ 		
			$args = array(
				'posts_per_page'=>3,
				'post_type' => $get_post_type,
				'tax_query' => array(
					array(
						'taxonomy' => $tag_type,
						'field' => 'slug',
						'terms' => $individual_tag->slug,
					)
				)
			);
		}?>
		<div class="related-events">
			<h3><?php esc_html_e('Related Events','mosque_crunchpress');?></h3>
			<div class="row-fluid">
			<?php
			$query = new WP_Query( $args );
			$counter_post = 0;
				while ( $query->have_posts() ){ $query->the_post(); 
				global $post,$post_id;
				//Get Date in Parts
				$event_year = date('Y',$event->start);
				$event_month = date('m',$event->start);
				$event_month_alpha = date('M',$event->start);
				$event_day = date('d',$event->start);
				
					if($orig_post <> $post_id){ 
						if($counter_post % 4 == 0){$first_class = 'first';$clear_class= '<div class="clear"></div>';}else{$first_class = '';$clear_class= '';}$counter_post++;
					?>
				<div class="span4">
                  <div class="latest-event-box">
                    <div class="frame"> <a href="#"><?php echo get_the_post_thumbnail($post->ID, array(300,300));?></a>
                      <div class="date"><strong class="dat"><?php esc_html_e('Date','mosque_crunchpress');?></strong><strong class="mnt"><?php esc_html_e('Month','mosque_crunchpress');?></strong></div>
                      <div class="caption">
                        <div class="text-box">
                          <p><?php echo mb_substr($event->post_content,0,120);?></p>
                        </div>
                      </div>
                      <div class="inner-area">
                        <div class="timer-box">
                          <div class="defaultCountdown" id="related_<?php echo esc_attr($EM_Event->post_id); ?>"></div>
                        </div>
                        <div class="text-area"> <strong class="title"><?php esc_html_e('Lorem quis bibendum','mosque_crunchpress');?></strong>
                         <ul>
						  <li><a href="#"><i class="fa fa-calendar"></i><?php echo date(get_option('date_format'),strtotime($EM_Event->start_date));?></a></li>
						  <li><a href="#"><i class="fa fa-clock-o"></i><?php echo date(get_option('date_format'),strtotime($EM_Event->end_date));?></a></li>
						  <li><a href="#"><i class="fa fa-microphone"></i><?php esc_html_e('John Doe, William','mosque_crunchpress');?></a></li>
						  <li><a href="#"><i class="fa fa-tags"></i><?php esc_html_e('Church, Worship','mosque_crunchpress');?></a></li>
						  <li><a href="#"><i class="fa fa-map-marker"></i><?php if($EM_Event->location_id <> 0){ echo esc_attr($EM_Event->get_location()->address); }else{esc_html_e('Location Disabled','mosque_crunchpress');}?></a></li>
						</ul>
						 <a class="btn-participate" href="<?php echo esc_url($event->guid);?>">
							<?php
								if(!empty($event->bookings)){
									if( $event->can_manage('manage_bookings','manage_others_bookings') && get_option('dbem_rsvp_enabled') == 1 && $event->rsvp == 1 ){
										?>
										<?php echo esc_html__("Bookings",'mosque_crunchpress'); ?> &ndash;
										<?php esc_html_e("Booked",'mosque_crunchpress'); ?>: <?php echo esc_attr($event->get_bookings()->get_booked_spaces()."/".$event->get_spaces()); ?>
										<?php if( get_option('dbem_bookings_approval') == 1 ): ?>
											| <?php esc_html_e("Pending",'mosque_crunchpress') ?>: <?php echo esc_attr($event->get_bookings()->get_pending_spaces()); ?>
										<?php endif;
									}
								}else{
									esc_html_e('No Bookings','mosque_crunchpress');
								}
							?></a>
                      </div>
                    </div>
                  </div>
					<?php
						wp_enqueue_style('cp-countdown',CP_PATH_URL.'/frontend/css/jquery.countdown.css'); //Load Style
						wp_register_script('cp-countdown', CP_PATH_URL.'/frontend/js/jquery_countdown.js', false, '1.0', true);
						wp_enqueue_script('cp-countdown');
					?>
					<script>
						jQuery(document).ready(function($){
							//CountDown Element
							if($('#related_<?php echo esc_js($EM_Event->post_id); ?>').length){
								var austDay = new Date();
								austDay = new Date(2014, 7 - 1, 26);
								$('#count_<?php echo esc_js($EM_Event->post_id); ?>').countdown({until: austDay, format: 'dHM'});
								$('#year').text(austDay.getFullYear());
							}
						});
					</script>
                </div>
				<!--Print Post -->
				<div class="span3 <?php echo esc_attr($first_class);?>">
					<a href="<?php echo get_permalink();?>">
						<?php if(get_the_post_thumbnail($post->ID, array(300,300)) <> ''){echo get_the_post_thumbnail($post->ID, array(300,300));?><span><?php echo date('d',strtotime(get_the_date()));?><br><?php echo date('M',strtotime(get_the_date()));?></span><?php }else{echo '<h3>'.substr(get_the_title(),0,16).'</h3>';}?>
						
					</a>
				</div>				
					<?php
					} 
				}
				?>
			</div>
		</div>
	<?php 
		}  
		  
		$post = $orig_post;  
		wp_reset_query();  
    }
	
	$countries = array(
	  "GB" => "United Kingdom",
	  "US" => "United States",
	  "AF" => "Afghanistan",
	  "AL" => "Albania",
	  "DZ" => "Algeria",
	  "AS" => "American Samoa",
	  "AD" => "Andorra",
	  "AO" => "Angola",
	  "AI" => "Anguilla",
	  "AQ" => "Antarctica",
	  "AG" => "Antigua And Barbuda",
	  "AR" => "Argentina",
	  "AM" => "Armenia",
	  "AW" => "Aruba",
	  "AU" => "Australia",
	  "AT" => "Austria",
	  "AZ" => "Azerbaijan",
	  "BS" => "Bahamas",
	  "BH" => "Bahrain",
	  "BD" => "Bangladesh",
	  "BB" => "Barbados",
	  "BY" => "Belarus",
	  "BE" => "Belgium",
	  "BZ" => "Belize",
	  "BJ" => "Benin",
	  "BM" => "Bermuda",
	  "BT" => "Bhutan",
	  "BO" => "Bolivia",
	  "BA" => "Bosnia And Herzegowina",
	  "BW" => "Botswana",
	  "BV" => "Bouvet Island",
	  "BR" => "Brazil",
	  "IO" => "British Indian Ocean Territory",
	  "BN" => "Brunei Darussalam",
	  "BG" => "Bulgaria",
	  "BF" => "Burkina Faso",
	  "BI" => "Burundi",
	  "KH" => "Cambodia",
	  "CM" => "Cameroon",
	  "CA" => "Canada",
	  "CV" => "Cape Verde",
	  "KY" => "Cayman Islands",
	  "CF" => "Central African Republic",
	  "TD" => "Chad",
	  "CL" => "Chile",
	  "CN" => "China",
	  "CX" => "Christmas Island",
	  "CC" => "Cocos (Keeling) Islands",
	  "CO" => "Colombia",
	  "KM" => "Comoros",
	  "CG" => "Congo",
	  "CD" => "Congo, The Democratic Republic Of The",
	  "CK" => "Cook Islands",
	  "CR" => "Costa Rica",
	  "CI" => "Cote D'Ivoire",
	  "HR" => "Croatia (Local Name: Hrvatska)",
	  "CU" => "Cuba",
	  "CY" => "Cyprus",
	  "CZ" => "Czech Republic",
	  "DK" => "Denmark",
	  "DJ" => "Djibouti",
	  "DM" => "Dominica",
	  "DO" => "Dominican Republic",
	  "TP" => "East Timor",
	  "EC" => "Ecuador",
	  "EG" => "Egypt",
	  "SV" => "El Salvador",
	  "GQ" => "Equatorial Guinea",
	  "ER" => "Eritrea",
	  "EE" => "Estonia",
	  "ET" => "Ethiopia",
	  "FK" => "Falkland Islands (Malvinas)",
	  "FO" => "Faroe Islands",
	  "FJ" => "Fiji",
	  "FI" => "Finland",
	  "FR" => "France",
	  "FX" => "France, Metropolitan",
	  "GF" => "French Guiana",
	  "PF" => "French Polynesia",
	  "TF" => "French Southern Territories",
	  "GA" => "Gabon",
	  "GM" => "Gambia",
	  "GE" => "Georgia",
	  "DE" => "Germany",
	  "GH" => "Ghana",
	  "GI" => "Gibraltar",
	  "GR" => "Greece",
	  "GL" => "Greenland",
	  "GD" => "Grenada",
	  "GP" => "Guadeloupe",
	  "GU" => "Guam",
	  "GT" => "Guatemala",
	  "GN" => "Guinea",
	  "GW" => "Guinea-Bissau",
	  "GY" => "Guyana",
	  "HT" => "Haiti",
	  "HM" => "Heard And Mc Donald Islands",
	  "VA" => "Holy See (Vatican City State)",
	  "HN" => "Honduras",
	  "HK" => "Hong Kong",
	  "HU" => "Hungary",
	  "IS" => "Iceland",
	  "IN" => "India",
	  "ID" => "Indonesia",
	  "IR" => "Iran (Islamic Republic Of)",
	  "IQ" => "Iraq",
	  "IE" => "Ireland",
	  "IL" => "Israel",
	  "IT" => "Italy",
	  "JM" => "Jamaica",
	  "JP" => "Japan",
	  "JO" => "Jordan",
	  "KZ" => "Kazakhstan",
	  "KE" => "Kenya",
	  "KI" => "Kiribati",
	  "KP" => "Korea, Democratic People's Republic Of",
	  "KR" => "Korea, Republic Of",
	  "KW" => "Kuwait",
	  "KG" => "Kyrgyzstan",
	  "LA" => "Lao People's Democratic Republic",
	  "LV" => "Latvia",
	  "LB" => "Lebanon",
	  "LS" => "Lesotho",
	  "LR" => "Liberia",
	  "LY" => "Libyan Arab Jamahiriya",
	  "LI" => "Liechtenstein",
	  "LT" => "Lithuania",
	  "LU" => "Luxembourg",
	  "MO" => "Macau",
	  "MK" => "Macedonia, Former Yugoslav Republic Of",
	  "MG" => "Madagascar",
	  "MW" => "Malawi",
	  "MY" => "Malaysia",
	  "MV" => "Maldives",
	  "ML" => "Mali",
	  "MT" => "Malta",
	  "MH" => "Marshall Islands",
	  "MQ" => "Martinique",
	  "MR" => "Mauritania",
	  "MU" => "Mauritius",
	  "YT" => "Mayotte",
	  "MX" => "Mexico",
	  "FM" => "Micronesia, Federated States Of",
	  "MD" => "Moldova, Republic Of",
	  "MC" => "Monaco",
	  "MN" => "Mongolia",
	  "MS" => "Montserrat",
	  "MA" => "Morocco",
	  "MZ" => "Mozambique",
	  "MM" => "Myanmar",
	  "NA" => "Namibia",
	  "NR" => "Nauru",
	  "NP" => "Nepal",
	  "NL" => "Netherlands",
	  "AN" => "Netherlands Antilles",
	  "NC" => "New Caledonia",
	  "NZ" => "New Zealand",
	  "NI" => "Nicaragua",
	  "NE" => "Niger",
	  "NG" => "Nigeria",
	  "NU" => "Niue",
	  "NF" => "Norfolk Island",
	  "MP" => "Northern Mariana Islands",
	  "NO" => "Norway",
	  "OM" => "Oman",
	  "PK" => "Pakistan",
	  "PW" => "Palau",
	  "PA" => "Panama",
	  "PG" => "Papua New Guinea",
	  "PY" => "Paraguay",
	  "PE" => "Peru",
	  "PH" => "Philippines",
	  "PN" => "Pitcairn",
	  "PL" => "Poland",
	  "PT" => "Portugal",
	  "PR" => "Puerto Rico",
	  "QA" => "Qatar",
	  "RE" => "Reunion",
	  "RO" => "Romania",
	  "RU" => "Russian Federation",
	  "RW" => "Rwanda",
	  "KN" => "Saint Kitts And Nevis",
	  "LC" => "Saint Lucia",
	  "VC" => "Saint Vincent And The Grenadines",
	  "WS" => "Samoa",
	  "SM" => "San Marino",
	  "ST" => "Sao Tome And Principe",
	  "SA" => "Saudi Arabia",
	  "SN" => "Senegal",
	  "SC" => "Seychelles",
	  "SL" => "Sierra Leone",
	  "SG" => "Singapore",
	  "SK" => "Slovakia (Slovak Republic)",
	  "SI" => "Slovenia",
	  "SB" => "Solomon Islands",
	  "SO" => "Somalia",
	  "ZA" => "South Africa",
	  "GS" => "South Georgia, South Sandwich Islands",
	  "ES" => "Spain",
	  "LK" => "Sri Lanka",
	  "SH" => "St. Helena",
	  "PM" => "St. Pierre And Miquelon",
	  "SD" => "Sudan",
	  "SR" => "Suriname",
	  "SJ" => "Svalbard And Jan Mayen Islands",
	  "SZ" => "Swaziland",
	  "SE" => "Sweden",
	  "CH" => "Switzerland",
	  "SY" => "Syrian Arab Republic",
	  "TW" => "Taiwan",
	  "TJ" => "Tajikistan",
	  "TZ" => "Tanzania, United Republic Of",
	  "TH" => "Thailand",
	  "TG" => "Togo",
	  "TK" => "Tokelau",
	  "TO" => "Tonga",
	  "TT" => "Trinidad And Tobago",
	  "TN" => "Tunisia",
	  "TR" => "Turkey",
	  "TM" => "Turkmenistan",
	  "TC" => "Turks And Caicos Islands",
	  "TV" => "Tuvalu",
	  "UG" => "Uganda",
	  "UA" => "Ukraine",
	  "AE" => "United Arab Emirates",
	  "UM" => "United States Minor Outlying Islands",
	  "UY" => "Uruguay",
	  "UZ" => "Uzbekistan",
	  "VU" => "Vanuatu",
	  "VE" => "Venezuela",
	  "VN" => "Viet Nam",
	  "VG" => "Virgin Islands (British)",
	  "VI" => "Virgin Islands (U.S.)",
	  "WF" => "Wallis And Futuna Islands",
	  "EH" => "Western Sahara",
	  "YE" => "Yemen",
	  "YU" => "Yugoslavia",
	  "ZM" => "Zambia",
	  "ZW" => "Zimbabwe"
	);
	
	
	
	
	function booking_table_type(){
		global $allowedposttags,$EM_Event;
		$EM_Tickets = $EM_Event->get_bookings()->get_tickets(); //already instantiated, so should be a quick retrieval.
		/*
		 * This variable can be overriden, by hooking into the em_booking_form_tickets_cols filter and adding your collumns into this array.
		 * Then, you should create a em_booking_form_tickets_col_arraykey action for your collumn data, which will pass a ticket and event object.
		 */
		$collumns = $EM_Tickets->get_ticket_collumns(); //array of collumn type => title
		?>
		<table class="em-tickets" cellspacing="0" cellpadding="0">
			<tr>
				<?php foreach($collumns as $type => $name): ?>
				<th class="em-bookings-ticket-table-<?php echo esc_attr($type); ?>"><?php echo esc_attr($name); ?></th>
				<?php endforeach; ?>
			</tr>
			<?php foreach( $EM_Tickets->tickets as $EM_Ticket ): /* @var $EM_Ticket EM_Ticket */ ?>
				<?php if( $EM_Ticket ): ?>
					<?php do_action('em_booking_form_tickets_loop_header', $EM_Ticket); //do not delete ?>
					<tr class="em-ticket" id="em-ticket-<?php echo esc_attr($EM_Ticket->ticket_id); ?>">
						<?php foreach( $collumns as $type => $name ): ?>
							<?php
							//output collumn by type, or call a custom action 
							switch($type){
								case 'type':
									?>
									<td class="em-bookings-ticket-table-type"><?php echo wp_kses_data($EM_Ticket->ticket_name); ?><?php if(!empty($EM_Ticket->ticket_description)) :?><br><span class="ticket-desc"><?php echo wp_kses($EM_Ticket->ticket_description,$allowedposttags); ?></span><?php endif; ?></td>
									<?php
									break;
								case 'price':
									?>
									<td class="em-bookings-ticket-table-price"><?php echo esc_attr($EM_Ticket->get_price(true)); ?></td>
									<?php
									break;
								case 'spaces':
									?>
									<td class="em-bookings-ticket-table-spaces">
										<?php 
											$default = !empty($_REQUEST['em_tickets'][$EM_Ticket->ticket_id]['spaces']) ? $_REQUEST['em_tickets'][$EM_Ticket->ticket_id]['spaces']:0;
											$spaces_options = $EM_Ticket->get_spaces_options(true,$default);
											echo ( $spaces_options ) ? $spaces_options:"<strong>".esc_html__('N/A','mosque_crunchpress')."</strong>";
										?>
									</td>
									<?php
									break;
								default:
									do_action('em_booking_form_tickets_col_'.$type, $EM_Ticket, $EM_Event);
									break;
							}
							?>
						<?php endforeach; ?>
					</tr>		
					<?php do_action('em_booking_form_tickets_loop_footer', $EM_Ticket); //do not delete ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</table>
		<?php
	}
	
	function cp_booking_form_event_manager() {

		global $EM_Notices,$EM_Event;
		//count tickets and available tickets
		$tickets_count = count($EM_Event->get_bookings()->get_tickets()->tickets);
		$available_tickets_count = count($EM_Event->get_bookings()->get_available_tickets());
		//decide whether user can book, event is open for bookings etc.
		$can_book = is_user_logged_in() || (get_option('dbem_bookings_anonymous') && !is_user_logged_in());
		$is_open = $EM_Event->get_bookings()->is_open(); //whether there are any available tickets right now
		$show_tickets = true;
		//if user is logged out, check for member tickets that might be available, since we should ask them to log in instead of saying 'bookings closed'
		if( !$is_open && !is_user_logged_in() && $EM_Event->get_bookings()->is_open(true) ){
			$is_open = true;
			$can_book = false;
			$show_tickets = false;
		}
		?>
		<div id="em-booking" class="em-booking <?php if( get_option('dbem_css_rsvp') ) echo 'css-booking'; ?>">
			<?php 
				// We are firstly checking if the user has already booked a ticket at this event, if so offer a link to view their bookings.
				$EM_Booking = $EM_Event->get_bookings()->has_booking();
			?>
			<?php 
			if(!empty($EM_Event->bookings)){
				if( is_object($EM_Booking) && !get_option('dbem_bookings_double') ): //Double bookings not allowed ?>
					<p>
						<?php echo get_option('dbem_bookings_form_msg_attending'); ?>
						<a href="<?php echo em_get_my_bookings_url(); ?>"><?php echo get_option('dbem_bookings_form_msg_bookings_link'); ?></a>
					</p>
				<?php elseif( !$EM_Event->event_rsvp ): //bookings not enabled ?>
					<p><?php echo get_option('dbem_bookings_form_msg_disabled'); ?></p>
				<?php elseif( $EM_Event->get_bookings()->get_available_spaces() <= 0 ): ?>
					<p><?php echo get_option('dbem_bookings_form_msg_full'); ?></p>
				<?php elseif( !$is_open ): //event has started ?>
					<p><?php echo get_option('dbem_bookings_form_msg_closed');  ?></p>
				<?php else: ?>
					<?php echo esc_attr($EM_Notices); ?>
					<?php if( $tickets_count > 0) : ?>
						<?php //Tickets exist, so we show a booking form. ?>
						<form class="em-booking-form" name='booking-form' method='post' action='<?php echo apply_filters('em_booking_form_action_url',''); ?>#em-booking'>
							<input type='hidden' name='action' value='booking_add'/>
							<input type='hidden' name='event_id' value='<?php echo esc_attr($EM_Event->event_id); ?>'/>
							<input type='hidden' name='_wpnonce' value='<?php echo wp_create_nonce('booking_add'); ?>'/>
							<?php 
								// Tickets Form
								if( $show_tickets && ($can_book || get_option('dbem_bookings_tickets_show_loggedout')) && ($tickets_count > 1 || get_option('dbem_bookings_tickets_single_form')) ){ //show if more than 1 ticket, or if in forced ticket list view mode
									do_action('em_booking_form_before_tickets', $EM_Event); //do not delete
									//Show multiple tickets form to user, or single ticket list if settings enable this
									//If logged out, can be allowed to see this in settings witout the register form 
									em_locate_template('forms/bookingform/tickets-list.php',true, array('EM_Event'=>$EM_Event));
									do_action('em_booking_form_after_tickets', $EM_Event); //do not delete
									$show_tickets = false;
								}
							?>
							<?php if( $can_book ): ?>
								<div class='em-booking-form-details'>
									<?php 
										if( $show_tickets && $available_tickets_count == 1 && !get_option('dbem_bookings_tickets_single_form') ){
											do_action('em_booking_form_before_tickets', $EM_Event); //do not delete
											//show single ticket form, only necessary to show to users able to book (or guests if enabled)
											$EM_Ticket = $EM_Event->get_bookings()->get_available_tickets()->get_first();
											em_locate_template('forms/bookingform/ticket-single.php',true, array('EM_Event'=>$EM_Event, 'EM_Ticket'=>$EM_Ticket));
											do_action('em_booking_form_after_tickets', $EM_Event); //do not delete
										} 
									?>
									<?php
										do_action('em_booking_form_before_user_details', $EM_Event);
										if( has_action('em_booking_form_custom') ){ 
											//Pro Custom Booking Form. You can create your own custom form by hooking into this action and setting the option above to true
											do_action('em_booking_form_custom', $EM_Event); //do not delete
										}else{
											//If you just want to modify booking form fields, you could do so here
											em_locate_template('forms/bookingform/booking-fields.php',true, array('EM_Event'=>$EM_Event));
										}
										do_action('em_booking_form_after_user_details', $EM_Event);
									?>
									<?php do_action('em_booking_form_footer', $EM_Event); //do not delete ?>
									<div class="em-booking-buttons">
										<?php if( preg_match('/https?:\/\//',get_option('dbem_bookings_submit_button')) ): //Settings have an image url (we assume). Use it here as the button.?>
										<input type="image" src="<?php echo get_option('dbem_bookings_submit_button'); ?>" class="em-booking-submit" id="em-booking-submit" />
										<?php else: //Display normal submit button ?>
										<input type="submit" class="em-booking-submit" id="em-booking-submit" value="<?php echo esc_attr(get_option('dbem_bookings_submit_button')); ?>" />
										<?php endif; ?>
									</div>
									<?php do_action('em_booking_form_footer_after_buttons', $EM_Event); //do not delete ?>
								</div>
							<?php else: ?>
								<p class="em-booking-form-details"><?php echo get_option('dbem_booking_feedback_log_in'); ?></p>
							<?php endif; ?>
						</form>	
						<?php 
						if( !is_user_logged_in() && get_option('dbem_bookings_login_form') ){
							//User is not logged in, show login form (enabled on settings page)
							em_locate_template('forms/bookingform/login.php',true, array('EM_Event'=>$EM_Event));
						}
						?>
						<br class="clear" style="clear:left;" />  
					<?php endif; ?>
				<?php endif;
			}
			?>
		</div>
	<?php }
	
	//Maintenance Mode Function Start
	function cp_maintenance_mode_fun(){
	
		$maintenance_mode = cp_get_themeoption_value('maintenance_mode','general_settings');
		$maintenace_title = cp_get_themeoption_value('maintenace_title','general_settings');
		$countdown_time = cp_get_themeoption_value('countdown_time','general_settings');
		$cp_comming_soon = cp_get_themeoption_value('cp_comming_soon','general_settings');
		
		$email_mainte = cp_get_themeoption_value('email_mainte','general_settings');
		$mainte_description = cp_get_themeoption_value('mainte_description','general_settings');
		$social_icons_mainte = cp_get_themeoption_value('social_icons_mainte','general_settings');
		
		//Get Date in Parts
		$event_year = date('Y',strtotime($countdown_time));
		$event_month = date('m',strtotime($countdown_time));
		$event_month_alpha = date('M',strtotime($countdown_time));
		$event_day = date('d',strtotime($countdown_time));

		//Change time format
		$event_start_time_count = date("G,i,s", strtotime($countdown_time));
	?>
		<!DOCTYPE html>
		<!--[if IE 7]>
		<html class="ie ie7" <?php language_attributes(); ?>>
		<![endif]-->
		<!--[if IE 8]>
		<html class="ie ie8" <?php language_attributes(); ?>>
		<![endif]-->
		<!--[if !(IE 7) | !(IE 8) ]><!-->
		<html <?php language_attributes(); ?>>
		<!--<![endif]-->
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<title><?php wp_title( 'Coming Soon', true, 'right' ); ?></title>
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<?php wp_head(); ?>
		</head>
		<body>
		<?php
			$news_letter_des = '';
			$newsletter_config = '';
			$feed_burner_text = '';
			$cp_newsletter_settings = get_option('newsletter_settings');
			if($cp_newsletter_settings <> ''){
				$cp_newsletter = new DOMDocument ();
				$cp_newsletter->loadXML ( $cp_newsletter_settings );
				
				$news_letter_des = cp_find_xml_value($cp_newsletter->documentElement,'news_letter_des');
				$newsletter_config = cp_find_xml_value($cp_newsletter->documentElement,'newsletter_config');
				$feed_burner_text = cp_find_xml_value($cp_newsletter->documentElement,'feed_burner_text');
			}
			
	if($cp_comming_soon == 'Style 1'){ ?>
		<div class="cp_wrapper1">
			<div class="container-fluid">
				<div class="row items-container">
					<div class="col-lg-6 col-md-12 col-xs-12 left-side item">
						<div class="logo">
							<?php cp_default_logo(); ?>
						</div>
						<div class="text description_text">
							<p><?php echo esc_attr($mainte_description);?></p>
						</div>
						<div class="countdown">
							<div class="clock">
								<div class="clock-item clock-days countdown-time-value">
								  <div class="wrap">
									<div class="inner">
									  <div id="canvas-days" class="clock-canvas"></div>
									  <div class="text">
										<p class="val">0</p>
										<p class="type-days type-time"><?php esc_html_e('DAYS','mosque_crunchpress');?></p>
									  </div>
									  <!--.text--> 
									</div>
									<!--.inner--> 
								  </div>
								  <!--.wrap--> 
								</div>
							 <!--.clock-item-->
							<div class="clock-item clock-hours countdown-time-value">
							  <div class="wrap">
								<div class="inner">
								  <div id="canvas-hours" class="clock-canvas"></div>
								  <div class="text">
									<p class="val">0</p>
									<p class="type-hours type-time"><?php esc_html_e('HOURS','mosque_crunchpress');?></p>
								  </div>
								  <!--.text--> 
								</div>
								<!--.inner--> 
							  </div>
							  <!--.wrap--> 
							</div>
							<!--.clock-item-->                    
							<div class="clock-item clock-minutes countdown-time-value">
							  <div class="wrap">
								<div class="inner">
								  <div id="canvas-minutes" class="clock-canvas"></div>
								  <div class="text">
									<p class="val">0</p>
									<p class="type-minutes type-time"><?php esc_html_e('MINUTES','mosque_crunchpress');?></p>
								  </div>
								  <!--.text--> 
								</div>
								<!--.inner--> 
							  </div>
							  <!--.wrap--> 
							</div>
							<!--.clock-item-->
							<div class="clock-item clock-seconds countdown-time-value count-down-time-value-afternone">
							  <div class="wrap">
								<div class="inner">
								  <div id="canvas-seconds" class="clock-canvas"></div>
								  <div class="text">
									<p class="val">0</p>
									<p class="type-seconds type-time"><?php esc_html_e('SECONDS','mosque_crunchpress');?></p>
								  </div>
								  <!--.text--> 
								</div>
								<!--.inner--> 
							  </div>
							  <!--.wrap--> 
							</div>
							<!--.clock-item--> 
						  </div>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-12 col-xs-12 right-side item">
						<div class="newsletter-box">
							<p><?php esc_html_e('Newsletter Subscription','mosque_crunchpress');?></p>
							<form class="form-box" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($feed_burner_text); ?>', 'popupwindow', 'scrollbars=yes,width=600,height=550');return true">
								<p>
								<?php 
									if($news_letter_des != ''){ 
										echo substr($news_letter_des, 0, 120); 
										if ( strlen($news_letter_des) > 120 ) echo "..."; 
									}
								?>
								</p>
								<div class="field-set-section"> <input type="text" class="input-newsletter feedemail-input" name="email" value="<?php esc_html_e('Enter your email','mosque_crunchpress');?>" />
									<input type="hidden" value="<?php echo esc_attr($feed_burner_text) ?>" name="uri"/>
									<input type="hidden" name="loc" value="en_US"/>
									<button class="btn-search btn-submit-news" id="btn_newsletter" ><i class="fa fa-angle-double-right"></i></button>
								</div>
							</form>
							<ul class="social-links">
								<?php 
								$social_icons_mainte = cp_get_themeoption_value('social_icons_mainte','general_settings');
								if($social_icons_mainte == 'enable'){ 
									$facebook_network = cp_get_themeoption_value('facebook_network','social_settings');
									$twitter_network = cp_get_themeoption_value('twitter_network','social_settings');
									$delicious_network = cp_get_themeoption_value('delicious_network','social_settings');
									$google_plus_network = cp_get_themeoption_value('google_plus_network','social_settings');
									$linked_in_network = cp_get_themeoption_value('linked_in_network','social_settings');
									$youtube_network = cp_get_themeoption_value('youtube_network','social_settings');
									$flickr_network = cp_get_themeoption_value('flickr_network','social_settings');
									$vimeo_network = cp_get_themeoption_value('vimeo_network','social_settings');
									$pinterest_network = cp_get_themeoption_value('pinterest_network','social_settings'); 
									$Instagram_network = cp_get_themeoption_value('Instagram_network','social_settings'); 
									$github_network = cp_get_themeoption_value('github_network','social_settings'); 
									$skype_network = cp_get_themeoption_value('skype_network','social_settings'); ?>
										<?php if($facebook_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Facebook" href="<?php echo esc_url($facebook_network);?>"><i class="fa fa-facebook"></i></a></li><?php }?>
										<?php if($twitter_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Twitter" href="<?php echo esc_url($twitter_network);?>"><i class="fa fa-twitter"></i></a></li><?php }?>
										<?php if($delicious_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Delicious" href="<?php echo esc_url($delicious_network);?>"><i class="fa fa-delicious"></i></a></li><?php }?>
										<?php if($google_plus_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Google +" href="<?php echo esc_url($google_plus_network);?>"><i class="fa fa-google-plus"></i></a></li><?php }?>
										<?php if($linked_in_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Linked iN" href="<?php echo esc_url($linked_in_network);?>"><i class="fa fa-linkedin"></i></a></li><?php }?>
										<?php if($youtube_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Youtube" href="<?php echo esc_url($youtube_network);?>"><i class="fa fa-youtube"></i></a></li><?php }?>
										<?php if($flickr_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Flickr" href="<?php echo esc_url($flickr_network);?>"><i class="fa fa-flickr"></i></a></li><?php }?>
										<?php if($vimeo_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Vimeo" href="<?php echo esc_url($vimeo_network);?>"><i class="fa fa-vimeo-square"></i></a></li><?php }?>
										<?php if($pinterest_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Pinterest" href="<?php echo esc_url($pinterest_network);?>"><i class="fa fa-pinterest"></i></a></li><?php }?>
										<?php if($Instagram_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Instagram" href="<?php echo esc_url($Instagram_network);?>"><i class="fa fa-instagram"></i></a></li><?php }?>
										<?php if($github_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Github" href="<?php echo esc_url($github_network);?>"><i class="fa fa-github"></i></a></li><?php }?>
										<?php if($skype_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Skype" href="<?php echo esc_url($skype_network);?>"><i class="fa fa-skype"></i></a></li><?php }?>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }else{ ?>
		
			<div class="cp_wrapper2">
				<div class="container">
					<div class="logo">
					<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(CP_PATH_URL.'/images/logo.png')?>" alt=""></a>
				</div>
					<div class="countdown">
						<div class="clock">
							<div class="clock-item clock-days countdown-time-value">
							  <div class="wrap">
								<div class="inner">
								  <div id="canvas-days" class="clock-canvas"></div>
								  <div class="text">
									<p class="val">0</p>
									<p class="type-days type-time"><?php esc_html_e('DAYS','mosque_crunchpress');?></p>
								  </div>
								  <!--.text--> 
								</div>
								<!--.inner--> 
							  </div>
							  <!--.wrap--> 
							</div>
						 <!--.clock-item-->
						<div class="clock-item clock-hours countdown-time-value">
						  <div class="wrap">
							<div class="inner">
							  <div id="canvas-hours" class="clock-canvas"></div>
							  <div class="text">
								<p class="val">0</p>
								<p class="type-hours type-time"><?php esc_html_e('HOURS','mosque_crunchpress');?></p>
							  </div>
							  <!--.text--> 
							</div>
							<!--.inner--> 
						  </div>
						  <!--.wrap--> 
						</div>
						<!--.clock-item-->                    
						<div class="clock-item clock-minutes countdown-time-value">
						  <div class="wrap">
							<div class="inner">
							  <div id="canvas-minutes" class="clock-canvas"></div>
							  <div class="text">
								<p class="val">0</p>
								<p class="type-minutes type-time"><?php esc_html_e('MINUTES','mosque_crunchpress');?></p>
							  </div>
							  <!--.text--> 
							</div>
							<!--.inner--> 
						  </div>
						  <!--.wrap--> 
						</div>
						<!--.clock-item-->
						<div class="clock-item clock-seconds countdown-time-value count-down-time-value-afternone">
						  <div class="wrap">
							<div class="inner">
							  <div id="canvas-seconds" class="clock-canvas"></div>
							  <div class="text">
								<p class="val">0</p>
								<p class="type-seconds type-time"><?php esc_html_e('SECONDS','mosque_crunchpress');?></p>
							  </div>
							  <!--.text--> 
							</div>
							<!--.inner--> 
						  </div>
						  <!--.wrap--> 
						</div>
						<!--.clock-item--> 
					  </div>
					</div>
					<div class="newsletter-box">
						<p><?php esc_html_e('Newsletter Subscription','mosque_crunchpress');?></p>
						<form class="form-box" id="frm_newsletter" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($feed_burner_text); ?>', 'popupwindow', 'scrollbars=yes,width=600,height=550');return true">
							<p>
							<?php 
								if($news_letter_des != ''){ 
									echo substr($news_letter_des, 0, 120); 
									if ( strlen($news_letter_des) > 120 ) echo "..."; 
								}
							?>
							</p>
							<div class="field-set-section"> 
								<input type="text" class="input-newsletter feedemail-input" name="email" value="<?php esc_html_e('Enter your email','mosque_crunchpress');?>" />
								<input type="hidden" value="<?php echo esc_attr($feed_burner_text) ?>" name="uri"/>
								<input type="hidden" name="loc" value="en_US"/>
								<button class="btn-search btn-submit-news" id="btn_newsletter" ><i class="fa fa-angle-double-right"></i></button>
							</div>
						</form>
						<ul class="social-links">
							<?php 
							$social_icons_mainte = cp_get_themeoption_value('social_icons_mainte','general_settings');
							if($social_icons_mainte == 'enable'){ 
								$facebook_network = cp_get_themeoption_value('facebook_network','social_settings');
								$twitter_network = cp_get_themeoption_value('twitter_network','social_settings');
								$delicious_network = cp_get_themeoption_value('delicious_network','social_settings');
								$google_plus_network = cp_get_themeoption_value('google_plus_network','social_settings');
								$linked_in_network = cp_get_themeoption_value('linked_in_network','social_settings');
								$youtube_network = cp_get_themeoption_value('youtube_network','social_settings');
								$flickr_network = cp_get_themeoption_value('flickr_network','social_settings');
								$vimeo_network = cp_get_themeoption_value('vimeo_network','social_settings');
								$pinterest_network = cp_get_themeoption_value('pinterest_network','social_settings'); 
								$Instagram_network = cp_get_themeoption_value('Instagram_network','social_settings'); 
								$github_network = cp_get_themeoption_value('github_network','social_settings'); 
								$skype_network = cp_get_themeoption_value('skype_network','social_settings'); ?>
									<?php if($facebook_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Facebook" href="<?php echo esc_url($facebook_network);?>"><i class="fa fa-facebook"></i></a></li><?php }?>
									<?php if($twitter_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Twitter" href="<?php echo esc_url($twitter_network);?>"><i class="fa fa-twitter"></i></a></li><?php }?>
									<?php if($delicious_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Delicious" href="<?php echo esc_url($delicious_network);?>"><i class="fa fa-delicious"></i></a></li><?php }?>
									<?php if($google_plus_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Google +" href="<?php echo esc_url($google_plus_network);?>"><i class="fa fa-google-plus"></i></a></li><?php }?>
									<?php if($linked_in_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Linked iN" href="<?php echo esc_url($linked_in_network);?>"><i class="fa fa-linkedin"></i></a></li><?php }?>
									<?php if($youtube_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Youtube" href="<?php echo esc_url($youtube_network);?>"><i class="fa fa-youtube"></i></a></li><?php }?>
									<?php if($flickr_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Flickr" href="<?php echo esc_url($flickr_network);?>"><i class="fa fa-flickr"></i></a></li><?php }?>
									<?php if($vimeo_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Vimeo" href="<?php echo esc_url($vimeo_network);?>"><i class="fa fa-vimeo-square"></i></a></li><?php }?>
									<?php if($pinterest_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Pinterest" href="<?php echo esc_url($pinterest_network);?>"><i class="fa fa-pinterest"></i></a></li><?php }?>
									<?php if($Instagram_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Instagram" href="<?php echo esc_url($Instagram_network);?>"><i class="fa fa-instagram"></i></a></li><?php }?>
									<?php if($github_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Github" href="<?php echo esc_url($github_network);?>"><i class="fa fa-github"></i></a></li><?php }?>
									<?php if($skype_network <> ''){ ?><li><a data-toggle="tooltip" data-original-title="Skype" href="<?php echo esc_url($skype_network);?>"><i class="fa fa-skype"></i></a></li><?php }?>
							<?php }?>
						</ul>
					</div>
				</div>
			</div>
		<?php }?>
		<?php wp_footer();?>
		<script>
			jQuery(document).ready(function ($) {
				cp_countDown_script('<?php echo esc_js($countdown_time);?>');
			});                
		</script>
		</body>
		</html>
	<?php 
	}
	
	function cp_time_table($cp_page_id=""){
	
		$schedule_manager = get_post_meta ( $cp_page_id, "page-option-top-schedule-mana", true );
		$schedule_category_event = get_post_meta ( $cp_page_id, "schedule_category_events", true );
		$schedule_category_class = get_post_meta ( $cp_page_id, "schedule_category_class", true );
		$schedule_category_service = get_post_meta ( $cp_page_id, "schedule_category_services", true );
		
		
		$html_time_table = '<ul class="time-table">';
			$category = '';
			if($schedule_manager == 'Classes'){
				if($schedule_category_class == 78612){
					query_posts(array(
						'posts_per_page' 			=> 8,
						'post_type'					=> 'classes',
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
					));
				}else{
					query_posts( array(
						'posts_per_page' 			=> 8,
						'post_type'					=> 'classes',
						//'classes-category'			=> $schedule_category_class,
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
						'tax_query' => array(
							array(
							'taxonomy' => 'classes-category',
							'terms' => $schedule_category_class,
							'field' => 'term_id',
							)
						),
					));
					
					$category = get_term_link( (int) $schedule_category_class, 'classes-category' );
				}
				$counter_one = 0;
				while( have_posts() ){
					the_post();
					global $post;
					$classes_detail_xml = get_post_meta($post->ID, 'classes_detail_xml', true);
					if($classes_detail_xml <> ''){
						$cp_classes_xml = new DOMDocument ();
						$cp_classes_xml->loadXML ( $classes_detail_xml );
						$start_time = cp_find_xml_value($cp_classes_xml->documentElement,'start_time');
						$end_time = cp_find_xml_value($cp_classes_xml->documentElement,'end_time');
						
					}
					$html_time_table .= '<li> <a href="'.get_permalink().'">'.substr(get_the_title(),0,12).'</a> <span class="ctime">'.$start_time.' - '.$end_time.'</span></li>';				
				} wp_reset_postdata();
				wp_reset_query();
				
			
			}else if('Events' == $schedule_manager){				
				if($schedule_category_event == '78612' || $schedule_category_event == ''){
					$EM_Events = EM_Events::get( array('group'=>'this','scope'=>'all', 'limit'=>'8', 'order' => 'DESC') );	
				}else{
					$EM_Events = EM_Events::get( array('category'=>$schedule_category_event, 'group'=>'this','scope'=>'all', 'limit'=>'8', 'order' => 'DESC') );	
					$category = get_term_link( (int) $schedule_category_event, 'event-categories' );
				}
				foreach ( $EM_Events as $event ) {
					$counter_one = 0;
					$html_time_table .= '<li> <a href="'.$event->guid.'">'.substr(esc_attr($event->event_name),0,18).'</a> <span class="ctime">'.$event->start_time.' - '.$event->end_time.'</span></li>';								
				}		
							
			}else if($schedule_manager == 'Services'){
				
				if($schedule_category_service == 78612){
					query_posts(array(
						'posts_per_page' 			=> 8,
						'post_type'					=> 'services',
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
					));
				}else{
					query_posts(array(
						'posts_per_page' 			=> 8,
						'post_type'					=> 'services',
						//'services-category'			=> $schedule_category_service,
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
						'tax_query' => array(
							array(
							'taxonomy' => 'services-category',
							'terms' => $schedule_category_service,
							'field' => 'term_id',
							)
						),
					));
					$category = get_term_link( (int) $schedule_category_service, 'services-category' );
				}
				$counter_one = 0;
				while( have_posts() ){
					the_post();
					global $post;					
					$start_time = '';
					$end_time = '';
					$service_detail_xml = get_post_meta($post->ID, 'service_detail_xml', true);
					if($service_detail_xml <> ''){
						$cp_services_xml = new DOMDocument ();
						$cp_services_xml->loadXML ( $service_detail_xml );
						$start_time = cp_find_xml_value($cp_services_xml->documentElement,'start_time');			
						$end_time = cp_find_xml_value($cp_services_xml->documentElement,'end_time');	
					
					}
					$html_time_table .= '<li> <a href="'.get_permalink().'">'.substr(get_the_title(),0,15).'</a> <span class="ctime">'.$start_time.' - '.$end_time.'</span></li>';
				} wp_reset_postdata();
				wp_reset_query();
				
			}
		$html_time_table .= '</ul>';
		
		return $html_time_table;
		
	}
	
	
	function cp_get_posts_by_category($term_id='', $taxonomy=''){
		$post_ids = array();
		query_posts(array(
			'posts_per_page'=> -1,
			'post_type'   => 'services',
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'term_id',
					'terms' => $term_id
				)
			),
			'post_status'      	=> 'publish',
			'order'				=> 'DESC'
		));	
		//If posts available
		if(have_posts()){
			while( have_posts() ){
			the_post();
			global $post;
				$post_ids[] = $post->ID;
			}
			wp_reset_postdata();
		} wp_reset_query();
		return $post_ids;
	}
	
	function cp_get_post_by_meta($term_id='', $taxonomy='',$orderby=''){
		$post_ids = array();
		$cp_tags = cp_get_tags_chunk($term_id,'yes');
		
		query_posts(array(
			'posts_per_page'=> -1,
			'post_type'   => 'services',
			'meta_key'   => 'current_price',
			'orderby'    => 'meta_value_num',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => $taxonomy,
					'field' => 'term_id',
					'terms' => $term_id
				),
				array(
					'taxonomy' => 'services-tag',
					'field' => 'term_id',
					'terms' => array($cp_tags)
				)
			),
			'post_status'      	=> 'publish',
			'order'				=> $orderby,
		));	
		//If posts available
		if(have_posts()){
			while( have_posts() ){
			the_post();
			global $post;
				$post_ids[] = $post->ID;
			}
			wp_reset_postdata();
		} wp_reset_query();
		
		return $post_ids;
		
		
	}
	
	function cp_get_tags_chunk($cp_term_id='',$onlyid=""){
		
		$cp_posts = cp_get_posts_by_category($cp_term_id,'services-category');
		$custom_tag = array();
		$custom_name = array();
		foreach($cp_posts as $cp_post){
			$terms = get_the_terms( $cp_post, 'services-tag' );
			if(!empty($terms)){
				foreach($terms as $term){
					if($onlyid == 'yes'){
						$custom_tag[] = $term->term_id;
					}else{
						$custom_tag[$term->term_id] = $term->name;
					}
				}
			}
		}
		return $custom_tag;	
	}
	
	
	/**
	* Adds classes to the array of body classes.
	*
	* @uses body_class() filter
	*/
	function cp_body_parent_class( $classes ) {
		global $post,$post_id;
		$facebook_class = '';
		if($post <> ''){
			$facebook_class = get_post_meta ( $post->ID, "page-option-item-facebook-selection", true );
		}
		if($facebook_class == 'Yes'){$facebook_class = 'facebook_fan';}
		$select_layout_cp = '';	
		$inner_page = '';
		wp_reset_query();
		if(!is_front_page()){ $inner_page = 'inner_page_cp'; }else{$inner_page = ' ';}
		$select_layout_cp = cp_get_themeoption_value('select_layout_cp','general_settings');
		if($select_layout_cp == 'boxed_layout'){
			$select_layout_cp = 'cp_boxed '.$inner_page.' '.$facebook_class;
		}else{
			$select_layout_cp = 'cp_full_width '.$inner_page.' '.$facebook_class;
		}

		$classes[] = $select_layout_cp ;	
		
		return $classes;
	}
	add_filter( 'body_class', 'cp_body_parent_class' );
	
	// update the option if new value is exists and not equal to old one 
	function cp_save_option($name, $old_value, $new_value){
	
		if(empty($new_value) && !empty($old_value)){
		
			if(!delete_option($name)){
			
				return false;
				
			}
			
		}else if($old_value != $new_value){
		
			if(!update_option($name, $new_value)){
			
				return false;
				
			}
			
		}
		
		return true;
		
	}
	
	
function cp_getPurchaseURLfromType($project_id, $page="") {
	$slug = apply_filters('idcf_archive_slug', esc_html__('projects', 'mosque_crunchpress'));
	global $wpdb;
	$purchase_url = '';
	// Set default purchase url in the event we don't have one set
	$purchase_default = get_option('id_purchase_default');
	if (!empty($purchase_default)) {
		if (!empty($purchase_default['option'])) {
			$option = $purchase_default['option'];
			if ($option == 'page_or_post') {
				if (!empty($purchase_default['value'])) {
					$purchase_url = get_permalink($purchase_default['value']);
				}
			}
			else {
				if (isset($purchase_default['value'])) {
					$purchase_url = $purchase_default['value'];
				}
			}
		}
	}
	$project_id = absint($project_id);
	$page = urlencode($page);
	if ($project_id > 0) {
		$post = getPostDetailbyProductID($project_id);
		if (isset($post->ID)) {
			$post_page = get_post_meta($post->ID, 'ign_option_purchase_url', true);
			if (!empty($post_page)) {
				$permalink_structure = get_option('permalink_structure');
				if ($post_page !== 'default') {
					$meta_url = get_post_meta($post->ID, 'purchase_project_URL', true);
					if ($permalink_structure == "") {
						// we no longer set defaults here since they are set above
						if ($post_page == "current_page") {		// If Project URL is the normal Project Page
							if ($page == "purchaseform") {
								$purchase_url = esc_url(home_url('/'))."/?ignition_product=".$post->post_name."&purchaseform=1&prodid=".$project_id;
							}
						} 
						else if ($post_page == "page_or_post") {		// If Project URL is another post or Project page
							$post_name = html_entity_decode(get_post_meta($post->ID, 'ign_purchase_post_name', true));
							$sql_purchase_post = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."posts WHERE post_name = %s AND post_type != 'ignition_product' LIMIT 1", $post_name);
							$purchase_post = $wpdb->get_row($sql_purchase_post);
							if (!empty($purchase_post)) {
								if ($page == "purchaseform") {
									$purchase_url = $purchase_post->guid."&purchaseform=1&prodid=".$project_id;
								}
							}	
						} 
						else if ($post_page == "external_url") {		//If some external URL is set as Project page
							if ($page == "purchaseform" && !empty($meta_url)) {
								$purchase_url = $meta_url."&purchaseform=1&prodid=".$project_id;
							}	
						}
					} 
					else {
						if ($post_page == "current_page") {		// If Project URL is the normal Project Page
							if ($page == "purchaseform") {
								$purchase_url = esc_url(home_url('/'))."/".$slug."/".$post->post_name."/?purchaseform=1&prodid=".$project_id;
							}	
						} 
						else if ($post_page == "page_or_post") {		// If Project URL is another post or Project page

							$post_name = html_entity_decode(get_post_meta($post->ID, 'ign_purchase_post_name', true));

							$sql_purchase_post = $wpdb->prepare("SELECT * FROM ".$wpdb->prefix."posts WHERE post_name = %s AND post_type != 'ignition_product' LIMIT 1", $post_name);
							$purchase_post = $wpdb->get_row($sql_purchase_post);
							if (!empty($purchase_post)) {
								if ($page == "purchaseform") {
									$purchase_url = get_permalink($purchase_post->ID)."?purchaseform=1&prodid=".$project_id;
								}
							}
						} 
						else if ($post_page == "external_url") {		//If some external URL is set as Project page
							if ($page == "purchaseform" && !empty($meta_url)) {
								$purchase_url = $meta_url."?purchaseform=1&prodid=".$project_id;
							}	
						}
					}
				}
				else {
					if (empty($purchase_url)) {
						$purchase_url = get_permalink($post->ID);
					}
					if ($permalink_structure == "") {
						$purchase_url = $purchase_url.'&purchaseform=1&prodid='.$project_id;
					}
					else {
						$purchase_url = $purchase_url.'?purchaseform=1&prodid='.$project_id;
					}
				}
			}
		}
	}
	return $purchase_url;
}