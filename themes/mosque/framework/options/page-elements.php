<?php

	/*
	*	CrunchPress Page Item File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the function that can print each page item in 
	*	different conditions.
	*	---------------------------------------------------------------------
	*/

	
	// Print the item size <div> with it's class
	function cp_print_item_size($item_size, $addition_class=''){
		global $cp_item_row_size;
		
		$cp_item_row_size = (empty($cp_item_row_size))? 'first': $cp_item_row_size;
		if($cp_item_row_size >= 1){
			$cp_item_row_size = 'first';
		}
		
		switch($item_size){
			case 'element1-4':
				echo '<div class="col-md-3 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 1/4; 
				break;
			case 'element1-3':
				echo '<div class="col-md-4 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 1/3; 
				break;
			case 'element1-2':
				echo '<div class="col-md-6 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 1/2; 
				break;
			case 'element2-3':
				echo '<div class="col-md-8 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 2/3; 
				break;
			case 'element3-4':
				echo '<div class="col-md-9 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 3/4; 
				break;
			case 'element1-1':
				echo '<div class="col-md-12 mbtm ' . $addition_class .' ' .$cp_item_row_size. '">';
				$cp_item_row_size += 1; 
				break;	
		}
		
	}
	
	//Sidebar function
	function cp_sidebar_func($sidebarr){
		if ($sidebarr == "left-sidebar" || $sidebarr == "right-sidebar") {
            $cp_sidebar_class[] = 'col-md-3 content_sidebar sidebar';
			$cp_sidebar_class[1] = 'col-md-9';
        }else if ($sidebarr == "both-sidebar") {
            $cp_sidebar_class[] = "col-md-3 content_sidebar sidebar";
			$cp_sidebar_class[1] = 'col-md-6';
        }else if($sidebarr == "both-sidebar-left") {
		    $cp_sidebar_class[] = "col-md-3 content_sidebar sidebar";
			$cp_sidebar_class[1] = 'col-md-6';
		}else if($sidebarr == "both-sidebar-right") {
		    $cp_sidebar_class[] = "col-md-3 content_sidebar sidebar";
			$cp_sidebar_class[1] = 'col-md-6';
		}else{
			$cp_sidebar_class[1] = 'col-md-12';
		}
		return $cp_sidebar_class;
	}
	
	
	// Print column 
	function cp_print_column_item($item_xml){
		echo do_shortcode(html_entity_decode(cp_find_xml_value($item_xml,'column-text')));
	}

	
	
	
	//Print Sidebar
	function cp_print_sidebar_item($item_xml){ 
	
		$select_layout = cp_find_xml_value($item_xml, 'sidebar-layout-select'); 
		dynamic_sidebar( $select_layout );
		
	
	}
	
	//Division Ends Here
	function cp_print_div_end_item ( $item_xml ){
		
		$divstart_layout = cp_find_xml_value($item_xml, 'divstart_layout'); 
		
		if($divstart_layout == 'Background Video'){
			echo '</div></div></div></div></div>';
		}else{
			echo '</div></div></div></div>';
		}
	}
	
	
	//Division of sections
	function cp_print_div_item ( $item_xml ){
		//Fetch Data from Theme Options
		global $counter;
		$select_type = cp_find_xml_value($item_xml, 'select-type'); 
		$bgimage = cp_find_xml_value($item_xml, 'image'); 
		$bgcolor = cp_find_xml_value($item_xml, 'color'); 
		$opacity = cp_find_xml_value($item_xml, 'opacity'); 
		$repeat = cp_find_xml_value($item_xml, 'repeat'); 
		$bgattachment = cp_find_xml_value($item_xml, 'background-attachment'); 
		$bg_position = cp_find_xml_value($item_xml, 'bg_position'); 
		$paddingtop = cp_find_xml_value($item_xml, 'padding-top'); 
		$paddingbottom = cp_find_xml_value($item_xml, 'padding-bottom'); 
		$one_pos = cp_find_xml_value($item_xml, 'image-parallax-one-pos'); 
		$img_id_one = cp_find_xml_value($item_xml, 'image-parallax-one'); 
		$two_pos = cp_find_xml_value($item_xml, 'image-parallax-two-pos'); 
		$img_id_two = cp_find_xml_value($item_xml, 'image-parallax-two'); 
		$cp_class = cp_find_xml_value($item_xml, 'add-section-class'); 
		$cp_id = cp_find_xml_value($item_xml, 'add-section-id'); 
		$select_moving = cp_find_xml_value($item_xml, 'select_moving');
		$video_url = cp_find_xml_value($item_xml, 'video_url');
		$video_height = cp_find_xml_value($item_xml, 'video_height');

		//Moving Attributes
		if($select_moving == 'Enable'){
		$moving_attr = 'data-id="customizer" data-title="Theme Customizer" data-direction="horizontal"';
		$moving_class = 'movingbg';
		}else{
			$moving_attr = '';
			$moving_class = '';
		}
		//Crunch ID Assigning
		$crunch_id = '';
		if($cp_id == '' || !isset($cp_id)){
			$crunch_id = 'counter_'.$counter;
		}else{
			$crunch_id = $cp_id;
		}
		
		//Background Video
		if($select_type == 'Background Video'){
			$video_class = 'cp_div_video';
		}else{
			$video_class = '';
		}
		

		//Empty Array in Case Image not set
		$one_image = array();
		$two_image = array();
		$image_url = wp_get_attachment_image_src($bgimage, 'full');
		
		//Condition for Image if Found
		if(!empty($img_id_one)){
			$one_image = wp_get_attachment_image_src($img_id_one, 'full');
		}
		
		//Condition for Image if Found
		if(!empty($img_id_two)){
			$two_image = wp_get_attachment_image_src($img_id_two, 'full');
		}
		
		if($select_type == 'Plain'){
			
			echo '
			<div style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';" id="'.$crunch_id.'" class="color_class_cp '.$cp_class.'">
			<div style="float:left;width:100%;" class="full-width">
			<div class="container">
			<div class="row">';
		}else if($select_type == 'Background Color'){
			echo '<div style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';background-color:'.$bgcolor.';" id="'.$crunch_id.'" class="color_class_cp '.$cp_class.'"><div class="bg_full_transparency" style="float:left;width:100%;opacity:'.$opacity.';background-image:url('.$image_url[0].');background-size:cover;background-attachment:'.$bgattachment.';background-repeat:'.$repeat.';"></div><div style="float:left;width:100%;" class="full-width"><div class="container"><div class="row">';
		}else if($select_type == 'Background Video') {
			if($select_type == 'Background Video'){
				
				echo '<div id="'.$crunch_id.'" class= " '.$video_class.' color_class_cp '.$cp_class.'" style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';" >
						<div id="block" style="width: 100%; height:'.$video_height.';" data-vide-bg="'.$video_url.'" data-vide-options="position: 0% 50%">
							<div style="float:left;width:100%;" class="full-width">
								<div class="container">
									<div class="row">';		
				
				
			}else{

				//do nothing						
			}
		}else{
			if($bgattachment == 'Parallax'){
				$html_one_img = '';
				$html_two_img = '';
				if(!empty($one_image)){
					$html_one_img = '<div class="bg1 parallax_class" id="'.$crunch_id.'" style="background-image:url('.$one_image[0].')" data-0="background-position:0px 0px;" data-end="background-position:'.$one_pos.';">&nbsp;</div>';
				}
				
				if(!empty($two_image)){
					
					$html_two_img = '<div class="bg2 parallax_class" style="background-image:url('.$two_image[0].')" data-0="background-position:0px 0px;" data-end="background-position:'.$two_pos.';">&nbsp;</div>';
				}
				echo '<div class="cp_animate"><div style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';background-color:'.$bgcolor.';" id="'.$crunch_id.'" class="color_class_cp '.$cp_class.'">
					'.$html_one_img.'
					'.$html_two_img.'
					<div class="bg_full_transparency" data-0="background-position:0px 0px;" data-end="background-position:'.$bg_position.';" style="float:left;width:100%;opacity:'.$opacity.';background-image:url('.$image_url[0].');background-size:cover;background-repeat:'.$repeat.';"></div>
					
				<div style="float:left;width:100%;" class="full-width"><div class="container"><div class="row">';
			}else{

				echo '<div id="'.$crunch_id.'" style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';background-color:'.$bgcolor.';" class="color_class_cp '.$cp_class.'">
						<div class="bg_full_transparency '.$moving_class.'" '.$moving_attr.' style="float:left;width:100%;opacity:'.$opacity.';background-image:url('.$image_url[0].');background-size:cover;background-attachment:'.$bgattachment.';background-repeat:'.$repeat.';"></div>
							<div style="float:left;width:100%;" class="full-width">
								<div class="container">
									<div class="row">';									
			}
		}
	
	}
	
	
	
	//Division of sections
	function cp_print_div_item_working ( $item_xml ){
		//Fetch Data from Theme Options
		global $counter;
		$select_type = cp_find_xml_value($item_xml, 'select-type'); 
		$bgimage = cp_find_xml_value($item_xml, 'image'); 
		$bgcolor = cp_find_xml_value($item_xml, 'color'); 
		$opacity = cp_find_xml_value($item_xml, 'opacity'); 
		$repeat = cp_find_xml_value($item_xml, 'repeat'); 
		$bgattachment = cp_find_xml_value($item_xml, 'background-attachment'); 
		$bg_position = cp_find_xml_value($item_xml, 'bg_position'); 
		$paddingtop = cp_find_xml_value($item_xml, 'padding-top'); 
		$paddingbottom = cp_find_xml_value($item_xml, 'padding-bottom'); 
		$one_pos = cp_find_xml_value($item_xml, 'image-parallax-one-pos'); 
		$img_id_one = cp_find_xml_value($item_xml, 'image-parallax-one'); 
		$two_pos = cp_find_xml_value($item_xml, 'image-parallax-two-pos'); 
		$img_id_two = cp_find_xml_value($item_xml, 'image-parallax-two'); 
		$cp_class = cp_find_xml_value($item_xml, 'add-section-class'); 
		$cp_id = cp_find_xml_value($item_xml, 'add-section-id'); 
		
		//Crunch ID Assigning
		$crunch_id = '';
		if($cp_id == '' || !isset($cp_id)){
			$crunch_id = 'counter_'.$counter;
		}else{
			$crunch_id = $cp_id;
		}
		

		//Empty Array in Case Image not set
		$one_image = array();
		$two_image = array();
		$image_url = wp_get_attachment_image_src($bgimage, 'full');
		
		//Condition for Image if Found
		if(!empty($img_id_one)){
			$one_image = wp_get_attachment_image_src($img_id_one, 'full');
		}
		
		//Condition for Image if Found
		if(!empty($img_id_two)){
			$two_image = wp_get_attachment_image_src($img_id_two, 'full');
		}
		
		if($select_type == 'Plain'){
			
			echo '
			<div style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';" id="'.$crunch_id.'" class="color_class_cp '.$cp_class.'">
			<div style="float:left;width:100%;" class="full-width">
			<div class="container">
			<div class="row">';
		}else if($select_type == 'Background Color'){
			echo '<div style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';background-color:'.$bgcolor.';" id="'.$crunch_id.'" class="color_class_cp '.$cp_class.'"><div class="bg_full_transparency" style="float:left;width:100%;opacity:'.$opacity.';background-image:url('.$image_url[0].');background-size:cover;background-attachment:'.$bgattachment.';background-repeat:'.$repeat.';"></div><div style="float:left;width:100%;" class="full-width"><div class="container"><div class="row">';
		}else{
			if($bgattachment == 'Parallax'){
				$html_one_img = '';
				$html_two_img = '';
				if(!empty($one_image)){
					$html_one_img = '<div class="bg1 parallax_class" id="'.$crunch_id.'" style="background-image:url('.$one_image[0].')" data-0="background-position:0px 0px;" data-end="background-position:'.$one_pos.';">&nbsp;</div>';
				}
				
				if(!empty($two_image)){
					
					$html_two_img = '<div class="bg2 parallax_class" style="background-image:url('.$two_image[0].')" data-0="background-position:0px 0px;" data-end="background-position:'.$two_pos.';">&nbsp;</div>';
				}
				echo '<div class="cp_animate"><div style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';background-color:'.$bgcolor.';" id="'.$crunch_id.'" class="color_class_cp '.$cp_class.'">
					'.$html_one_img.'
					'.$html_two_img.'
					<div class="bg_full_transparency" data-0="background-position:0px 0px;" data-end="background-position:'.$bg_position.';" style="float:left;width:100%;opacity:'.$opacity.';background-image:url('.$image_url[0].');background-size:cover;background-repeat:'.$repeat.';"></div>
					
				<div style="float:left;width:100%;" class="full-width"><div class="container"><div class="row">';
			}else{
				echo '<div id="'.$crunch_id.'" style="padding-top:'.$paddingtop.';padding-bottom:'.$paddingbottom.';background-color:'.$bgcolor.';" class="color_class_cp '.$cp_class.'"><div class="bg_full_transparency" style="float:left;width:100%;opacity:'.$opacity.';background-image:url('.$image_url[0].');background-size:cover;background-attachment:'.$bgattachment.';background-repeat:'.$repeat.';"></div><div style="float:left;width:100%;" class="full-width"><div class="container"><div class="row">';
			}
		}
	
	}
	
	$gallery_div_size_listing_class = array(
		'Masonry View' => array( 'class'=>'col-md-3', 'class2'=>'col4_gallery_one_sidebar','class3'=>'col4_gallery_two_sidebar','size'=>array(614,614),'size2'=>array(614,614),'size3'=>array(614,614)),
		'4 Column' => array( 'class'=>'col-md-3', 'class2'=>'col4_gallery_one_sidebar','class3'=>'col4_gallery_two_sidebar','size'=>array(614,614),'size2'=>array(614,614),'size3'=>array(614,614)),
		'3 Column' => array( 'class'=>'col-md-4', 'class2'=>'col3_gallery_one_sidebar','class3'=>'col3_gallery_two_sidebar','size'=>array(614,614),'size2'=>array(614,614),'size3'=>array(614,614)),
		'2 Column' => array( 'class'=>'col-md-6', 'class2'=>'col-md-3','class3'=>'col-md-3','size'=>array(570, 360),'size2'=>array(570, 360),'size3'=>array(570, 360)),
		'Modern Gallery' => array( 'class'=>'col-md-6', 'class2'=>'col-md-3','class3'=>'col-md-3','size'=>array(450, 300),'size2'=>array(450, 300),'size3'=>array(450, 300)),
		'Carousel' => array( 'class'=>'span12', 'class2'=>'col-md-3','class3'=>'col-md-3','size'=>array(360,300),'size2'=>array(360,300),'size3'=>array(360,300)),
		
	); 	
	
	// Print gallery
	function cp_print_gallery_item($item_xml){
	
		global $gallery_div_size_listing_class;
		global $paged,$sidebar,$post_id,$wp_query;		

		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		$gal_counter = '';
		
		//Fetch Elements Data from database
		$header = cp_find_xml_value($item_xml, 'header');
		$gallery_page = cp_find_xml_value($item_xml, 'page');
		$gallery_size = cp_find_xml_value($item_xml, 'item-size');
		$num_size = cp_find_xml_value($item_xml, 'num-size');
		$show_pagination = cp_find_xml_value($item_xml, 'show-pagination');
		
		//Count Images per row
		if($gallery_size == '2 Column'){$gal_counter = 2;}else if($gallery_size == '3 Column'){$gal_counter = 3;}else if($gallery_size == '4 Column'){$gal_counter = 4;}else if($gallery_size == 'Catalogue View'){$gal_counter = 1;}else{}		
		
		$gallery_class = $gallery_div_size_listing_class[$gallery_size]['class'];
		if( $sidebar == "no-sidebar" || $sidebar == ''){
			$gallery_class = $gallery_div_size_listing_class[$gallery_size]['class'];
			$item_size = $gallery_div_size_listing_class[$gallery_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$gallery_class = $gallery_div_size_listing_class[$gallery_size]['class'];
			$item_size = $gallery_div_size_listing_class[$gallery_size]['size2'];
		}else{
			$gallery_class = $gallery_div_size_listing_class[$gallery_size]['class'];
			$item_size = $gallery_div_size_listing_class[$gallery_size]['size3'];
		}
		
		
		if(!empty($header)){
			
			
		}

		if($gallery_page <> ''){
		$slider_xml_string = get_post_meta($gallery_page,'post-option-gallery-xml', true);
			if($gallery_size == 'Masonry View'){ 
				echo '<div class="gallery-cp">
                    <div id="container" class="gallery">';						
							wp_register_script('cp-isotop-min', CP_PATH_URL.'/frontend/js/blocksit.min.js', false, '1.0', true);
							wp_enqueue_script('cp-isotop-min');
							echo '<script>
								jQuery(document).ready(function($) {
									if ($("#container").length) {
										$("#container").BlocksIt({
											numOfCol: 4,
											offsetX: 15,
											offsetY: 15
										});
									}
								});
							</script>';
							if($slider_xml_string <> ''){
								$slider_xml_dom = new DOMDocument();
								if( !empty( $slider_xml_string ) ){
									$slider_xml_dom->loadXML($slider_xml_string);
										$children = $slider_xml_dom->documentElement->childNodes;
										if ( empty($wp_query->query['paged']) ) $wp_query->query['paged'] = 1;
											$total_page = '';
											if($num_size > 0){
													$limit_start = $num_size * ($wp_query->query['paged']-1);
													$limit_end = $limit_start + $num_size;
													if ( $limit_end > $slider_xml_dom->documentElement->childNodes->length ) {
														$limit_end = $slider_xml_dom->documentElement->childNodes->length;
													}
													
													if($num_size < $slider_xml_dom->documentElement->childNodes->length){
														$total_page = ceil($slider_xml_dom->documentElement->childNodes->length/$num_size);
													}else{
														$total_page = 1;
													}
											}
											else {
												$limit_start = 0;
												$limit_end = $slider_xml_dom->documentElement->childNodes->length;
											}
											$counter_gal_element = 0;
											for($i=$limit_start;$i<$limit_end;$i++) { 
												$thumbnail_id = cp_find_xml_value($children->item($i), 'image');
												$title = cp_find_xml_value($children->item($i), 'title');
												$caption = cp_find_xml_value($children->item($i), 'caption');
												$link_type = cp_find_xml_value($children->item($i), 'linktype');
												$video = cp_find_xml_value($children->item($i), 'video');
												$image_url = wp_get_attachment_image_src($thumbnail_id, $item_size);
												$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
												
												$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
												$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(614,614));
												$link = cp_find_xml_value( $children->item($i), 'link');
												//Condition for Width and Height for each Masonry Element
												if($counter_gal_element % 4 == 0){$gal_class= 'item-w2 item-h3';}else if($counter_gal_element % 4 == 1){$gal_class= 'item-h2';}else if($counter_gal_element % 4 == 2){$gal_class= 'item-h2';}else if($counter_gal_element % 4 == 3){$gal_class= '';}else{}?>
												<div class="grid">
													<div class="caption"><a href="<?php echo esc_url($image_full[0])?>" class="zoom" data-gal="prettyPhoto[gallery1]"><i class="fa fa-search-plus"></i></a></div>
													<div class="imgholder"> <img src="<?php echo esc_url($image_full[0])?>" alt="<?php echo esc_attr($title);?>"> </div>
												</div>
										<?php $counter_gal_element++;
											} //Foreach loop
								} //Empty Condition check 
							}	//Empty Condition check 
						
                    echo '</div>
                </div>';
			}elseif($gallery_size == 'Carousel'){
				global $counter;
				echo '<div class="our-projects row">';?>
				<?php if($header <> ''){ ?>
				<div class="col-md-12">
					<div style="text-align:left" class="cp-heading-container">
						<div class="heading-style-2">
						  <h2 style="color:#000000"><?php echo esc_attr($header);?></h2>
						</div>
					</div>
				</div>
				<?php }				
							//Bx Slider Script Calling
							wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
							wp_register_script('cp-hoverizr', CP_PATH_URL.'/frontend/js/jquery.hoverizr.js', false, '1.0', true);
							wp_enqueue_script('cp-hoverizr');
							wp_enqueue_script('cp-bx-slider');	
							wp_register_script('cp-grayscale', CP_PATH_URL.'/frontend/js/grayscale.js', false, '1.0', true);
							wp_enqueue_script('cp-grayscale');	
							wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');?>
							<script type="text/javascript">
							jQuery(document).ready(function ($) {
								"use strict";
								if ($('#logo-slider-<?php echo esc_attr($counter)?>').length) {
									$('#logo-slider-<?php echo esc_attr($counter)?>').bxSlider({
										minSlides: 3,
										maxSlides: 4,
										slideWidth: 490,
										slideMargin: 0
									});
								}
								 jQuery("#logo-slider-<?php echo esc_attr($counter);?> a").hover(
									function() {
										$(this).find('.gotcolors').stop().animate({
											opacity: 1
										}, 200);
									},
									function() {
										$(this).find('.gotcolors').stop().animate({
											opacity: 0
										}, 500);
									}
								);
							});
							</script>
							<?php
							echo '<ul id="logo-slider-'.esc_attr($counter).'" class="our-project-slider imglist group">';
							if($slider_xml_string <> ''){
								$slider_xml_dom = new DOMDocument();
								if( !empty( $slider_xml_string ) ){
									$slider_xml_dom->loadXML($slider_xml_string);
										$children = $slider_xml_dom->documentElement->childNodes;
										if ( empty($wp_query->query['paged']) ) $wp_query->query['paged'] = 1;
											$total_page = '';
											if($num_size > 0){
													$limit_start = $num_size * ($wp_query->query['paged']-1);
													$limit_end = $limit_start + $num_size;
													if ( $limit_end > $slider_xml_dom->documentElement->childNodes->length ) {
														$limit_end = $slider_xml_dom->documentElement->childNodes->length;
													}
													
													if($num_size < $slider_xml_dom->documentElement->childNodes->length){
														$total_page = ceil($slider_xml_dom->documentElement->childNodes->length/$num_size);
													}else{
														$total_page = 1;
													}
											}
											else {
												$limit_start = 0;
												$limit_end = $slider_xml_dom->documentElement->childNodes->length;
											}
											$counter_gal_element = 0;
											for($i=$limit_start;$i<$limit_end;$i++) { 
												$thumbnail_id = cp_find_xml_value($children->item($i), 'image');
												$title = cp_find_xml_value($children->item($i), 'title');
												$caption = cp_find_xml_value($children->item($i), 'caption');
												$link_type = cp_find_xml_value($children->item($i), 'linktype');
												$video = cp_find_xml_value($children->item($i), 'video');
												$image_url = wp_get_attachment_image_src($thumbnail_id, $item_size);
												$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
												
												$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
												$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(450,300));
												$link = cp_find_xml_value( $children->item($i), 'link');
												//Condition for Width and Height for each Masonry Element
												if($counter_gal_element % 4 == 0){$gal_class= 'item-w2 item-h3';}else if($counter_gal_element % 4 == 1){$gal_class= 'item-h2';}else if($counter_gal_element % 4 == 2){$gal_class= 'item-h2';}else if($counter_gal_element % 4 == 3){$gal_class= '';}else{}?>
												<li>
													<a href= "<?php echo esc_url($image_thumb[0])?>">
														<img class="gs" src="<?php echo esc_url($image_thumb[0])?>" alt="<?php echo esc_attr($title);?>">
														<div class="caption"><?php if(!empty($title)){ ?><a href="<?php echo esc_url($link);?>"><?php echo esc_attr($title);?></a> <?php } ?> </div>
													</a>
												</li>
										<?php $counter_gal_element++;
											} //Foreach loop
								} //Empty Condition check 
							}	//Empty Condition check 
						
                    echo '</ul>
                </div>';
			}else if($gallery_size == 'Modern Gallery'){
				if($slider_xml_string <> ''){
				echo '<div class="gallery-collection row">';
				echo '<ul class="gallery">';
					$slider_xml_dom = new DOMDocument();
					if( !empty( $slider_xml_string ) ){
						$slider_xml_dom->loadXML($slider_xml_string);
							$children = $slider_xml_dom->documentElement->childNodes;
							if ( empty($wp_query->query['paged']) ) $wp_query->query['paged'] = 1;
								$total_page = '';
								if($num_size > 0){
										$limit_start = $num_size * ($wp_query->query['paged']-1);
										$limit_end = $limit_start + $num_size;
										if ( $limit_end > $slider_xml_dom->documentElement->childNodes->length ) {
											$limit_end = $slider_xml_dom->documentElement->childNodes->length;
										}
										
										if($num_size < $slider_xml_dom->documentElement->childNodes->length){
											$total_page = ceil($slider_xml_dom->documentElement->childNodes->length/$num_size);
										}else{
											$total_page = 1;
										}
								}
								else {
									$limit_start = 0;
									$limit_end = $slider_xml_dom->documentElement->childNodes->length;
								}
								$counter_gal_element = 0;
								for($i=$limit_start;$i<$limit_end;$i++) { 
									$thumbnail_id = cp_find_xml_value($children->item($i), 'image');
									$title = cp_find_xml_value($children->item($i), 'title');
									$caption = cp_find_xml_value($children->item($i), 'caption');
									$link_type = cp_find_xml_value($children->item($i), 'linktype');
									$video = cp_find_xml_value($children->item($i), 'video');
									$image_url = wp_get_attachment_image_src($thumbnail_id, $item_size);
									$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
									
									$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
									$image_thumb = wp_get_attachment_image_src($thumbnail_id, array(450,300));
									$link = cp_find_xml_value( $children->item($i), 'link');
									//Condition for Width and Height for each Masonry Element
									if($counter_gal_element % 4 == 0){$gal_class= 'item-w2 item-h3';}else if($counter_gal_element % 4 == 1){$gal_class= 'item-h2';}else if($counter_gal_element % 4 == 2){$gal_class= 'item-h2';}else if($counter_gal_element % 4 == 3){$gal_class= '';}else{}?>
									<li>
										<div class="collection-box">
											<div class="frame">
												<img alt="img" src="<?php echo esc_url($image_thumb[0])?>">
												<div class="caption"><a data-gal="prettyPhoto[gallery1]" href="<?php echo esc_url($image_thumb[0])?>" class="search"><i class="fa fa-search-plus"></i></a></div>
											</div>
											<div class="text-box">
												<h3><a data-gal="prettyPhoto[gallery1]" href="<?php echo esc_url($image_thumb[0])?>"><?php echo esc_attr($caption);?></a></h3>
												<strong class="name"><?php echo esc_attr($title);?></strong>
											</div>
										</div>
									</li>
							<?php $counter_gal_element++;
								} //Foreach loop
					} //Empty Condition check 
					echo '</ul>';
					echo '</div>';
				}	//Empty Condition check 
			}else{
				if($slider_xml_string <> ''){
				$slider_xml_dom = new DOMDocument();
					if( !empty( $slider_xml_string ) ){
						$slider_xml_dom->loadXML($slider_xml_string);
						echo '<div class="gallery gallery-section row normal_listing cp_'.strtolower(str_replace(' ','_',$gallery_size)).'">';
							$children = $slider_xml_dom->documentElement->childNodes;
							if ( empty($wp_query->query['paged']) ) $wp_query->query['paged'] = 1;
										$total_page = '';
										if($num_size > 0){
											$limit_start = $num_size * ($wp_query->query['paged']-1);
											$limit_end = $limit_start + $num_size;
											if ( $limit_end > $slider_xml_dom->documentElement->childNodes->length ) {
												$limit_end = $slider_xml_dom->documentElement->childNodes->length;
											}
											
											if($num_size < $slider_xml_dom->documentElement->childNodes->length){
												$total_page = ceil($slider_xml_dom->documentElement->childNodes->length/$num_size);
											}else{
												$total_page = 1;
											}
									}
									else {
										$limit_start = 0;
										$limit_end = $slider_xml_dom->documentElement->childNodes->length;
									}
							$counter_gal_element = 0;
							$single_col = 0;
							for($i=$limit_start;$i<$limit_end;$i++) { 
								$thumbnail_id = cp_find_xml_value($children->item($i), 'image');
								$title = cp_find_xml_value($children->item($i), 'title');
								$caption = cp_find_xml_value($children->item($i), 'caption');
								$link_type = cp_find_xml_value($children->item($i), 'linktype');
								$video = cp_find_xml_value($children->item($i), 'video');
								$image_url = wp_get_attachment_image_src($thumbnail_id, $item_size);
								$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);	
								
								if($gallery_size == 'Catalogue View'){
								if($single_col % 3 == 0){$first_class="first";}else{$first_class = '';}$single_col++;
										echo '<div class="margin-bottom gallery-frame span4 '.esc_attr($first_class).'">';
										$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
										$image_thumb = wp_get_attachment_image_src($thumbnail_id, $item_size);
										$link = cp_find_xml_value( $children->item($i), 'link');
										if( $link_type == 'Link to URL' ){
											$link = cp_find_xml_value( $children->item($i), 'link');	?>
											<div class="frame"> <a href="<?php echo esc_url($link); ?>"><img src="<?php echo esc_url($image_thumb[0]);?>" alt="<?php echo esc_attr($alt_text);?>"></a>
												<div class="caption"><strong class="title"><?php echo esc_html($title)?></strong></div>
											</div>
											<div class="text-box"><p><?php echo esc_attr($caption);?></p></div>
										<?php }else if( $link_type == 'Lightbox' ){
											$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
											$image_thumb = wp_get_attachment_image_src($thumbnail_id, $item_size);
											$link = cp_find_xml_value( $children->item($i), 'link'); ?>
											<div class="frame"> <a data-gal="prettyPhoto[gallery1]" href="<?php echo esc_url($image_thumb[0]);?>"><img src="<?php echo esc_url($image_thumb[0]);?>" alt="<?php echo esc_attr($alt_text);?>"></a>
												<div class="caption"><strong class="title"><?php echo esc_attr($title);?></strong></div>
											</div>
											<div class="text-box"><p><?php echo esc_html($caption);?></p></div>
											<?php
										}else if( $link_type == 'Video' ){
											$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
											$image_thumb = wp_get_attachment_image_src($thumbnail_id, $item_size);
											$link = cp_find_xml_value( $children->item($i), 'link');
											echo  cp_get_video($video,700,700);
										}else{
											$link = cp_find_xml_value( $children->item($i), 'link');
											?>
											<div class="frame"> <a data-gal="prettyPhoto[gallery1]" href="<?php echo esc_url($image_thumb[0]);?>"><img src="<?php echo esc_url($image_thumb[0]);?>" alt="<?php echo esc_attr($alt_text);?>"></a>
												<div class="caption"><strong class="title"><?php echo esc_attr($title);?></strong></div>
											</div>
											<div class="text-box"><p><?php echo esc_html($caption);?></p></div>
											<?php
										}
									echo '</div>';
								}else{
									if($counter_gal_element % $gal_counter == 0){echo '<div class="clear"></div>';$item_class = 'first';}else{$item_class = '';}$counter_gal_element++; ?>		
										<!--LIST ITEM START-->
										<div class="list_item margin-bottom <?php echo esc_attr($item_class);?> fadeInUpBig cp_load <?php echo esc_attr($gallery_class);?>">
											<div class="frame">
											<?php 
											$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
											$image_thumb = wp_get_attachment_image_src($thumbnail_id, $item_size);
											$link = cp_find_xml_value( $children->item($i), 'link');
											if( $link_type == 'Link to URL' ){
												$link = cp_find_xml_value( $children->item($i), 'link');
												echo '<img src="' . esc_url($image_thumb[0]) . '" alt="' . esc_attr($alt_text) . '" />'; ?>
												<div class="caption">
													<a class="zoom" href="<?php echo esc_url($link); ?>"><i class="fa fa-link"></i></a>
												</div>
											<?php }else if( $link_type == 'Lightbox' ){
												$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
												$image_thumb = wp_get_attachment_image_src($thumbnail_id, $item_size);
												$link = cp_find_xml_value( $children->item($i), 'link'); ?>
												<?php if($title <> ''){ ?>
													<div class="caption">
														<h2><?php echo esc_html($title);?></h2>
														<p><?php echo esc_html($caption);?></p>
														<a class="zoom" href="<?php echo esc_url($image_full[0]);?>" data-gal="prettyPhoto[gallery1]"><i class="fa fa-search-plus"></i></a>
													</div>
												<?php }else{ ?>
													<div class="caption">
														<a class="zoom" href="<?php echo esc_url($image_full[0]);?>" data-gal="prettyPhoto[gallery1]"><i class="fa fa-search-plus"></i></a>
													</div>
												<?php } ?>
												<img src="<?php echo esc_url($image_thumb[0]);?>" alt="<?php echo esc_attr($alt_text);?>" />
												<?php
											}else if( $link_type == 'Video' ){
												$image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
												$image_thumb = wp_get_attachment_image_src($thumbnail_id, $item_size);
												$link = cp_find_xml_value( $children->item($i), 'link');
												echo cp_get_video($video,700,700);
											}else{
												$link = cp_find_xml_value( $children->item($i), 'link');
												echo '<img src="'.esc_url($image_thumb[0]).'" alt="'.esc_attr($alt_text).'" />';
												echo '<div class="caption">';
														echo '<h3>'.esc_html($title).'</h3>';
														echo '<p>'.esc_html($caption).'</p>';
													echo '</div>';
											}
										?>
											</div>
											<!--LIST ITEM START-->
										</div>	
									<?php 
								}	
							} // End Foreach Loop
						echo '</div>';
						if($show_pagination == 'Yes'){
							echo '<div class="paging">';
								pagination_crunch($pages = $total_page);
							echo '</div>';
						}						
					}
				}
			} //Masonry Condition Ends
		} //Gallery page if not empty ends	
	} // Gallery element function ends
	
	
	
	function cp_heading_style($item_xml,$echo=''){
	
		$heading = cp_find_xml_value($item_xml, 'heading');
		$sub_heading = cp_find_xml_value($item_xml, 'sub_heading');	
		$caption = cp_find_xml_value($item_xml, 'caption');	
		$upload_image = cp_find_xml_value($item_xml, 'upload_image');	
		if(isset($upload_image)){
			$bg_image = wp_get_attachment_image_src($upload_image, 'full');
		}
		
		
		if($echo == 'false'){
			return $html_heading = '
			<div class="thumb-style">
				<img src="'.esc_url($bg_image[0]).'" alt="">
				<div class="caption">
					<h2>'.esc_attr($heading).'</h2>
					<strong>'.esc_attr($sub_heading).'</strong>
					<p>'.esc_attr($caption).'</p>
				</div>
			</div>';
		}else{
			return $html_heading = '
			<div class="thumb-style">
				<img src="'.esc_url($bg_image[0]).'" alt="">
				<div class="caption">
					<h2>'.esc_attr($heading).'</h2>
					<strong>'.esc_attr($sub_heading).'</strong>
					<p>'.esc_attr($caption).'</p>
				</div>
			</div>';
		}	
	
	}
	
	function cp_get_gallery_image_one($post_id, $item_size){
		$thumbnail_id = get_post_thumbnail_id( $post_id );
		$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
		
		if($thumbnail[1].'x'.$thumbnail[2] == $item_size){
			echo get_the_post_thumbnail($post_id, $item_size);
		}else{
			echo get_the_post_thumbnail($post_id, 'full');
		}
	}
	

	//Blog Item
	function cp_print_blog_item_item($item_xml){
		global $counter;
		$num_excerpt = 250;
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
		?>
		<script type="text/javascript">
		jQuery(document).ready(function ($) {
			if ($('#blog_slider-<?php echo esc_attr($counter);?>').length) {
				$('#blog_slider-<?php echo esc_attr($counter);?>').bxSlider({
					minSlides: 1,
					maxSlides: 1
				});
			}
		});
		</script>
		<div class="blog_class" id="blog_store">
			<figure id="blog" class="span12 first">
				<?php if($header <> ''){?><h2 class="title"><?php echo esc_attr($header);?><span class="h-line"></span></h2><?php }?>
				<div id="slider_blog">
					<ul id="blog_slider-<?php echo esc_attr($counter);?>">
					<?php
					query_posts(array(
						'posts_per_page'			=> $num_fetch,
						'post_type'					=> 'post',
						'category'					=> $category,
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
					));
					$event_counter = 0;
					while( have_posts() ){
					the_post();	
					global $post,$post_id;
					?>
						<li>
							<div class="img span4">
								<?php echo get_the_post_thumbnail($post_id, array(175,155));;?>
							</div>
							<div class="content span8">
								<div class="icon_date"> 
									<i class="fa fa-picture"></i>
									<span class="date"><?php echo get_the_date(get_option('date_format'))?></span>
								</div>
								<div class="post_excerpt">
									<h4><a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_html(get_the_title());?></a></h4>
									<p><?php 
									if($num_excerpt <> ''){
										echo strip_tags(substr(get_the_content(),0,$num_excerpt));
									}else{
										echo strip_tags(substr(get_the_content(),0,250));
									}
									
									?></p>
									<a class="readmore" href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('Read More','mosque_crunchpress');?><i class="icon-plus"></i> </a>
								</div>
							</div>
						</li>
					<?php }
					wp_reset_query();
					wp_reset_postdata();
					?>	
					</ul>
				</div>
			</figure>
		</div>	
	<?php
	}
	
	//WooProduct Slider
	function cp_print_woo_product_slider_item($item_xml){ 
		wp_register_script('cp-caroufredsel-slider', CP_PATH_URL.'/frontend/js/caroufredsel.js', false, '1.0', true);
		wp_enqueue_script('cp-caroufredsel-slider');	
		
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		
	
		global $post;
		$facebook_class = '';
		if($post <> ''){
			$facebook_class = get_post_meta ( $post->ID, "page-option-item-facebook-selection", true );
		}
	?>
			
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				<?php if($facebook_class == 'Yes'){?>
				var _visible = 4;
				<?php }else{?>
				var _visible = 6;
				<?php }?>
				var $pagers = $('#pager a');
				var _onBefore = function() {
					$(this).find('img').stop().fadeTo( 300, 1 );
					$pagers.removeClass( 'selected' );
				};

				$('#carousel').carouFredSel({
					items: _visible,
					width: '100%',
					auto: false,
					scroll: {
						duration: 750
					},
					prev: {
						button: '#prev',
						items: 2,
						onBefore: _onBefore
					},
					next: {
						button: '#next',
						items: 2,
						onBefore: _onBefore
					},
				});

				$pagers.click(function( e ) {
					e.preventDefault();
					
					var group = $(this).attr( 'href' ).slice( 1 );
					var slides = $('#carousel div.' + group);
					var deviation = Math.floor( ( _visible - slides.length ) / 2 );
					if ( deviation < 0 ) {
						deviation = 0;
					}

					$('#carousel').trigger( 'slideTo', [ $('#' + group), -deviation ] );
					$('#carousel div img').stop().fadeTo( 300, 1 );
					slides.find('img').stop().fadeTo( 300, 1 );

					$(this).addClass( 'selected' );
				});
			});
		</script>
			<div id="inner">
				<div id="carousel">
				<?php
					query_posts(array(
						'posts_per_page'			=> $num_fetch,
						'post_type'					=> 'product',
						'category'					=> $category,
						'post_status'				=> 'publish',
						'order'						=> 'DESC',
					));
					while( have_posts() ){
					the_post();	
					global $post,$post_id;
					$categories = '';
					$currency = '';
					//Price of Product
					$regular_price = get_post_meta($post->ID, '_regular_price', true);
					if($regular_price == ''){
						$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
					}
					$sale_price = get_post_meta($post->ID, '_sale_price', true);
					if($sale_price == ''){
						$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
					}
					if(function_exists('get_woocommerce_currency_symbol')){
						$currency = get_woocommerce_currency_symbol();
					}
					?>
					<div class="cp_product" id="<?php 
					if(class_exists("Woocommerce")){
						$categories = get_the_terms( $post->ID, 'product_cat' );
							if($categories <> ''){
								foreach ( $categories as $category ) {
									echo esc_attr($category->term_id);
								}
							}
					}	
					?>">
						<?php echo get_the_post_thumbnail($post_id, array(140,200));;?>
						<em><?php echo esc_html(get_the_title());?></em>
						<span class="cp_price"><sup><?php echo esc_attr($currency);?></sup><?php echo esc_attr($regular_price);?></span>
						<a class="view_detail" href="<?php echo esc_url(get_permalink());?>"><?php esc_html_e('View Detail','mosque_crunchpress');?></a>
					</div>
				<?php }?>
				</div>
				<div id="pager">
				<?php
				$category = cp_find_xml_value($item_xml, 'category');
				$category = ( $category == '786512' )? '': $category;
				if( !empty($category) ){
					$category_term = get_term_by( 'name', $category , 'product_cat');
					$category = $category_term->slug;
				}
				if(class_exists("Woocommerce")){
					$categories = get_categories( array('child_of' => $category, 'taxonomy' => 'product_cat', 'hide_empty' => 0) );
					if($categories <> ""){
						foreach($categories as $values){?>
						<a href="#<?php echo esc_attr($values->term_id);?>"><?php echo esc_attr($values->name);?></a>
					<?php
						}
					}
				}
				?>
				</div>
				<a href="#" id="prev"><span class="font_aw"><i class="fa fa-chevron-left"></i></span></a>
				<a href="#" id="next"><span class="font_aw"><i class="fa fa-chevron-right"></i></span></a>
			</div>
	<?php }	
	
	// Print the slider item
	function cp_print_slider_item($item_xml){
		
		global $counter;
		$xml_size = cp_find_xml_value($item_xml, 'size');
		if( $xml_size == 'full-width' ){
			echo '<div class="Full-Image"><div class="thumbnail_image">';
		}else{
			echo '<div class="Full-Image"><div class="thumbnail_image">';
		}
		$slider_xml_dom  = new DOMDocument ();
		$slider_type= cp_find_xml_value($item_xml,'slider-type');
		$slider_width = cp_find_xml_value($item_xml, 'width');
		$slider_height = cp_find_xml_value($item_xml, 'height');
		$slider_slide = cp_find_xml_value($item_xml, 'slider-slide');
		$slider_slide_layer = cp_find_xml_value($item_xml, 'slider-slide-layer');
		
		if(!empty($slider_slide)){
		$slider_xml = get_post_meta( intval($slider_slide), 'cp-slider-xml', true);
			if($slider_xml <> ''){
				$slider_xml_dom = new DOMDocument ();
				$slider_xml_dom->loadXML ( $slider_xml );
			}
		}
		//Determine the width of slider
		if( !empty($slider_width) && !empty($slider_height) ){
			$xml_size = array($slider_width, $slider_height);
		} else if(!empty($slider_height)){
			$xml_size = array(980, $slider_height);
		}else{
			$xml_size = array(980,360);
		}
		//Slider Name
		$slider_name = 'slider'.$counter;
		switch(cp_find_xml_value($item_xml,'slider-type')){
			
			case 'Anything': 
				wp_register_script('cp-anything-slider', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.js', false, '1.0', true);
				wp_enqueue_script('cp-anything-slider');	

				wp_register_script('cp-anything-slider-fx', CP_PATH_URL.'/frontend/anythingslider/js/jquery.anythingslider.fx.js', false, '1.0', true);
				wp_enqueue_script('cp-anything-slider-fx');	
				echo cp_print_anything_slider($slider_name,$slider_xml_dom->documentElement,$size=$xml_size);
				break;
			case 'Flex-Slider': 
				cp_print_flex_slider($slider_xml_dom->documentElement,$size=$xml_size);
				break;
			case 'Default-Slider': 
				cp_print_fine_slider($slider_xml_dom->documentElement,$size=$xml_size);
				break;
			case 'Bx-Slider': 
				echo cp_print_bx_slider($slider_xml_dom->documentElement,$size=$xml_size,$slider_name);				
				break;
			case 'Layer-Slider': 
				if(class_exists('LS_Sliders')){
					echo do_shortcode('[layerslider id="' . esc_attr($slider_slide_layer) . '"]');
				}else{
					echo '<h2>'.esc_html_e('Please install the LayerSlider plugin first.','mosque_crunchpress').'</h2>';
				}	
			break;	
				
		}
		?>
		
		<?php
		
		
		if( cp_find_xml_value($item_xml, 'size') == 'full-width' ){
			echo "</div></div>";
		}else{
		      echo "</div></div>";
		}
		
	}
	
	// Print Content Item
	function cp_print_content_item($item_xml){
		
		$title = cp_find_xml_value($item_xml, 'title');
		$description = cp_find_xml_value($item_xml, 'description');
		
		//Loop for Content Area
		if(have_posts()){
			while(have_posts()){
				the_post();
				global $post;
				if($title == 'Yes'){
					echo '<h2 class="h-style">' . get_the_title() . '</h2>';
				}
				
				if($description == 'Yes'){
					the_content();	
				}
				
			}
		}
	}
	
	// Print Content Item
	function cp_print_default_content_item(){
		
		while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<a href="<?php echo esc_url(get_permalink());?>">
			<?php
				the_title( '<div class="cp-header"><h1 class="entry-title">', '</h1></div>' );
			?>
			</a>
			<div class="entry-content-cp">
				<?php
					the_content();
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'mosque_crunchpress' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );

					edit_post_link( esc_html__( 'Edit', 'mosque_crunchpress' ), '<span class="edit-link">', '</span>' );
				?>
			</div><!-- .entry-content -->
		</div><!-- #post-## -->
		
		<?php
		echo '<div class="comment-box">';
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		echo '</div>';
		endwhile;
	}
	
	// Print Accordion
	function cp_print_accordion_item($item_xml){
		global $counter;
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		$header = cp_find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<div class="heading-bg"><h2 class="h-style">' . esc_attr($header) . '</h2></div>';
		}
		echo '<script type="text/javascript">
			   jQuery(document).ready(function($) {

				//custom animation for open/close
				$.fn.slideFadeToggle = function(speed, easing, callback) {
					return this.animate({opacity: "toggle", height: "toggle"}, speed, easing, callback);
				};

				$(".custom_accordion_cp").accordion({
					defaultOpen: "open_first_1",
					cookieName: "nav",
					speed: "slow",
					animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
						elem.next().stop(true, true).slideFadeToggle(opts.speed);
					},
					animateClose: function (elem, opts) { //replace the standard slideDown with custom function
						elem.next().stop(true, true).slideFadeToggle(opts.speed);
					}
				});
			});
		</script>';
		$counter_accordion = '';
		$counter_accor = 0;
		//echo '<div class="accordion_section">';	
		foreach($tab_xml->childNodes as $accordion){
		if($counter_accor == 0){$counter_accordion = 'open_first_1';}else{$counter_accordion = 'accordion-'.$counter_accor;}$counter_accor++;
			echo '<div class="accor-panel"><div class="custom_accordion_cp" id="'.esc_attr($counter_accordion).'"><p>'.cp_find_xml_value($accordion, 'title').'</p><span><i class="fa fa-minus"></i></span></div>';
			echo '<div class="container_cp_accor"><div class="content_cp_accordian"><p>';
			echo do_shortcode(html_entity_decode(cp_find_xml_value($accordion, 'caption'))) . '</p></div></div></div>';
		}
		
		//echo "</div>";
	
	}
	
	
	
	// Print Divider
	function cp_print_divider($item_xml){
		//Hide me button
		$hide_button = cp_find_xml_value($item_xml, 'hide-bottom-top');
		$margin_top = cp_find_xml_value($item_xml, 'margin-top');
		$margin_bottom = cp_find_xml_value($item_xml, 'margin-bottom');
		
		
		if($hide_button == 'Yes'){
			wp_register_script('cp-easing', CP_PATH_URL.'/frontend/js/jquery-easing-1.3.js', false, '1.0', true);
			wp_enqueue_script('cp-easing');
			wp_register_script('cp-top-script', CP_PATH_URL.'/frontend/js/jquery.scrollTo-min.js', false, '1.0', true);
			wp_enqueue_script('cp-top-script');
			echo '<div style="margin-top:'.esc_attr($margin_top).';margin-bottom:'.esc_attr($margin_bottom).'" class="clear"></div><div class="divider mr10"><div class="scroll-top"><a class="scroll-topp">'.esc_html__('Back to Top','mosque_crunchpress').'</a>';
			echo cp_find_xml_value($item_xml, 'text');
			echo '</div></div>';
		}else{
			echo '<div style="float:left;width:100%;margin-top:'.esc_attr($margin_top).';margin-bottom:'.esc_attr($margin_bottom).'" class="clear"></div>';
		}
	}
	
	// Print Message Box
	function cp_print_message_box($item_xml){
		$box_color = cp_find_xml_value($item_xml, 'color');
		$box_title = cp_find_xml_value($item_xml, 'title');
		$box_content = html_entity_decode(cp_find_xml_value($item_xml, 'content'));
		echo '<div class="message-box-wrapper ' . esc_attr($box_color) . '">';
		echo '<div class="message-box-title">' . esc_attr($box_title) . '</div>';
		echo '<div class="message-box-content">' . esc_attr($box_content) . '</div>';
		echo '</div>';
	}
	
	// Print Toggle Box
	function cp_print_toggle_box_item($item_xml){
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		$header = cp_find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<h3 class="toggle-box-header-title title-color cp-title">' . esc_attr($header) . '</h3>';
		}
		echo "<ul class='toggle-view'>";
		foreach($tab_xml->childNodes as $toggle_box){
			$active = cp_find_xml_value($toggle_box, 'active');
			echo "<li>";
			
			echo "<span class='link";
			echo ($active == 'Yes')? ' active':'';
			echo "' ></span>";
			echo "<h3 class='color'>". cp_find_xml_value($toggle_box, 'title') . "</h3>";
			echo "<div class='panel"; 
			echo ($active == 'Yes')? ' active': '';
			echo "' id='toggle-box-content' >";
			echo do_shortcode(html_entity_decode(cp_find_xml_value($toggle_box, 'caption'))) . '</div>';
			echo "</li>";
		
		}
		echo "</ul>";
	}

	// Print Tab
	function cp_print_tab_item($item_xml){
	
		$tab_xml = find_xml_node($item_xml, 'tab-item');
		
		$tab_widget_title =  html_entity_decode(cp_find_xml_value($item_xml,'tab-widget'));
		$tab_style =  html_entity_decode(cp_find_xml_value($item_xml,'tab-layout-select'));
		$num = 0;
		$tab_title = array();
		$tab_content = array();
		$tab_title[$num] = cp_find_xml_value($item_xml, 'title');
		if( !empty($tab_widget_title) ){
			if(is_front_page()){
				echo '<h2>'.esc_attr($tab_widget_title).'</h2>';
			}else{
				echo '<h2>' . esc_attr($tab_widget_title).  '</h2>';
			}
		}
		if($tab_style == 'Horizontal'){
			echo '<div id="horizontal-tabs" class="tabs tab-area">';
		}else{
			echo '<div id="vertical-tabs" class="tabs tab-area">';
		}
		foreach($tab_xml->childNodes as $toggle_box){
			$tab_title[$num] = cp_find_xml_value($toggle_box, 'title');
			$tab_content[$num] = html_entity_decode(cp_find_xml_value($toggle_box, 'caption'));
			$num++;
		}
		echo "<ul class='nav nav-tabs'>";
           for($i=0; $i<$num; $i++){
				echo '<li><a href="#' . strip_tags(str_replace(' ', '-', $tab_title[$i])) .$i. '" class=" ';
				echo ( $i == 0 )? 'active':'';
				echo '" >' . html_entity_decode($tab_title[$i]) . '</a></li>';
			}
           
         echo "</ul>";
			
			
			echo "<ul class='tab-content'>";
			for($i=0; $i<$num; $i++){
				echo '<li id="' . strip_tags(str_replace(' ', '-', $tab_title[$i])) .$i. '" class="tabscontent ';
				echo ( $i == 0 )? 'active':'';  
				echo '" >' . do_shortcode(html_entity_decode($tab_content[$i])) . '</li>';
			}
			echo "</ul>";	
			echo "</div>";	
		
	}
	
	
	
	
	// Print column service
	function cp_print_column_service($item_xml){		
		$feature_html = '';
		$html_readmore = '';
		
		global $counter;
		
		$title = cp_find_xml_value($item_xml, 'title');
		$fontaw = cp_find_xml_value($item_xml, 'FontAwesome');
		$layout = cp_find_xml_value($item_xml, 'layout');
		
		$descrip = html_entity_decode(cp_find_xml_value($item_xml, 'text'));
		$service_layout = cp_find_xml_value($item_xml, 'service-layout');
		$upload_image = cp_find_xml_value($item_xml, 'upload_image');
		$morelink = cp_find_xml_value($item_xml, 'morelink');
		if($morelink <> ''){$html_readmore = '<a class="readmore" href="'.esc_url($morelink).'">'.esc_html__('Readmore','mosque_crunchpress').'</a>';}
		
		$thumbnail = wp_get_attachment_image_src( $upload_image , array(570,300) );
		if($layout == 'Style 1'){
			$feature_html = '
			<div class="features-box">
				<span><a href="'.esc_url($morelink).'" class="inner"><i class="'.esc_attr($fontaw).'"></i></a></span>
				<div class="text-box">
					<h2>'.esc_html($title).'</h2>
					<p>'.do_shortcode($descrip).'</p>
				</div>
			</div>';
		
		}else if($layout == 'Style 2'){
			$feature_html = '<div class="eco-features-box">
                <div class="frame"> <a href="'.esc_url($morelink).'"><img src="'.esc_url($thumbnail[0]).'" alt="" /></a>
                  <div class="eco-icon"><a href="'.esc_url($morelink).'"><i class="'.esc_attr($fontaw).'"></i></a></div>
                </div>
                <div class="text-box">
                  <h3><a href="'.esc_url($morelink).'">'.esc_html($title).'</a></h3>
                  <p>'.$descrip.'</p>
                  <a class="btn-5" href="'.esc_url($morelink).'">'.esc_attr__('Read More','mosque_crunchpress').'<i class="fa fa-arrow-right"></i></a> </div>
              </div>';
		}else if($layout == 'Style 3'){
			$thumbnail_islamic = wp_get_attachment_image_src( $upload_image , array(270,270) );
			$feature_html = '<div class="islamic-features-box">
                <div class="frame"><a href="'.esc_url($morelink).'"><img src="'.$thumbnail_islamic[0].'" alt="" /></a></div>
                <div class="caption"><a href="'.esc_url($morelink).'">'.esc_html($title).'</a>
                  <div class="shape-1"><i class="'.esc_attr($fontaw).'"></i></div>
                </div>
              </div>';
		
		}else if($layout == 'Style 5'){
				
			$feature_html = '<section id="missions-section-'.esc_attr($counter).'" class="missions-store">
								<div class="missions-frame"> <img src="'.esc_url($thumbnail[0]).'" alt="img">
								  <div class="caption">
									<h2><a href="'.esc_url($morelink).'">'.esc_attr($title).'</a></h2>
									<p>'.esc_attr($descrip).'</p>
								  </div>
								</div>
							</section>';
							
		}else if($layout == 'Style 4'){
			$feature_html = '
			<div class="missions-frame">
				<img src="'.esc_url($thumbnail[0]).'" alt="" />
				<div class="caption"><a href="'.esc_url($morelink).'">'.esc_attr($descrip).'</a></div>
			</div>';
		
		}else{
		
		}
		return $feature_html;
	}

	// Print contact form
	function cp_print_contact_form($item_xml){
		global $post,$counter;
		
		$contact_logo = cp_find_xml_value($item_xml, 'contact_logo');
		$image_url = wp_get_attachment_image_src($contact_logo, 'full');
		
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = $values;
		} ?>
		<script type="text/javascript">			
			jQuery(document).ready(function($) {
				var $form = $(this);
				$('#form_contact').validate({
					submitHandler: function(form) {							
						jQuery.post(ajaxurl,
							$('form#form_contact').serialize() , 
							function(data){
								jQuery("#loading_div").html('');
								jQuery(".frm_area").hide();
								jQuery("#succ_mess").show('');
								jQuery("#succ_mess").html(data);
							}
						);
						return false;
					}
				});				
			});
		</script>
		<?php
		$header = cp_find_xml_value($item_xml, 'header');
		if(!empty($header)){
			echo '<h2 class="h-style">' . esc_html($header) . '</h2><span class="border-line m-bottom"></span>';
		}
		?>
		<div class="newsletter_mosque">
			<img class = "newsletter_logo" src = "<?php echo esc_url($image_url[0]);?>" alt = "logo">
		</div>
		<div id="frm_area" class="leave-reply newsletter_mosque">					
			<form class="newsletter-form" id="form_contact" method="POST">
				<div id="succ_mess"></div>
				<ul class="frm_area row">
					<li class="user col-md-12">
						
						<input type="text" class="required require-field detail-input" value="" id="name_contact" name="name_contact" placeholder="Name*"/>
					</li>
					<li class="mail col-md-12">
						
						<input type="text" class="required email require-field detail-input" value="" id="email_contact" name="email_contact" placeholder="Email*"/>
					</li>
					<li class="web col-md-12">
						
						<input type="text" class="required url require-field detail-input" value="" id="website" name="website" placeholder="Website*"/>
					</li>
					<li class="col-md-12">
						
						<textarea class="required require-field detail-textarea" id="message_comment" name="message_comment" cols="10" rows="10" placeholder="Comments*" ></textarea>
						<input type="submit" id="submit_btn" class="detail-btn-sumbit2" value="<?php echo esc_html__('Submit','mosque_crunchpress'); ?>" /> 
					</li>
				</ul>						
				<div id="loading_div" class=""></div>
				<div class="hide"><input type="hidden" id="receiver" name="receiver" value="<?php echo cp_find_xml_value($item_xml, 'email'); ?>" /></div>
				<div class="hide"><input type="hidden" name="successful_msg_contact" value="Your message has been submitted." /></div>
				<div class="hide"><input type="hidden" name="un_successful_msg_contact" value="Please Provide Correct Information!" /></div>
				<div class="hide"><input type="hidden"  name="form_submitted" value="form_submitted" /></div>
				<div class="hide"><input type="hidden"  name="action" value="cp_contact_submit" /></div>
			</form>
		</div>
			
	<?php
		
	
	}
	
	//News Slider
	function cp_print_news_slider_box($item_xml){
		global $counter;
		$header = cp_find_xml_value($item_xml, 'header');
		$category = html_entity_decode(cp_find_xml_value($item_xml, 'category'));
		$num_fetch = html_entity_decode(cp_find_xml_value($item_xml, 'num-fetch'));
		if($category <> ''){
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
		?>
		<script type="text/javascript">
        jQuery(document).ready(function($) {
			$('#news_slider-<?php echo esc_attr($counter);?>').bxSlider({  minSlides: 1, maxSlides: 1, slideMargin: 18,  speed: 500, });
        });
        </script>
         <!-- Content -->
			<div id="news" class="blog_class">
			<?php if($header <> ''){?><h2 class="title"><?php echo esc_attr($header);?><span class="h-line"></span></h2><?php }?>
				<ul class="news_slider" id="news_slider-<?php echo esc_attr($counter);?>">
				<?php
			global $post;
				query_posts(array( 
				'post_type' => 'post',
				'showposts' => $num_fetch,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'terms' => $category,
						'field' => 'term_id',
					)
				),
				'orderby' => 'title',
				'order' => 'DESC' )
			);
			$counter_team = 0; 
			if ( have_posts() <> "" ) {
				while( have_posts() ){
					the_post();
					global $post; ?>
					<li> 
						<div class="span5 first" id="img_holder"> 
							<div class="img">
								<?php $size = array(260,220); echo function_library::cp_thumb_size($post->ID,$size);?>
							</div>
							<div class="img_title"> 
							<a> <i class="fa fa-plus"></i> </a>
							<a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_html(get_the_title());?></a> 
							<p><?php echo strip_tags(substr(esc_html(get_the_content()),0,10));?></p>
							</div>
						</div>
						<div class="span7 ns_desc"> 
							<a href="<?php echo esc_url(get_permalink());?>" class="title"><?php echo esc_html(get_the_title());?>  <span class="h-line"></span> </a> 
							<p><?php echo strip_tags(substr(esc_html(get_the_content()),0,130));?></p>
							<a href="<?php echo esc_url(get_permalink())?>" class="rm"><?php esc_html_e('View All News &nbsp;','mosque_crunchpress');?><i class="fa fa-plus"></i></a>
						</div> 
					</li>
					<?php } //End while loop
				} wp_reset_query(); //Check Post Condition Ends?>
				</ul>
			</div>
        <?php
		} //if Category Empty
	}
	
	//News Headline Function Starts Here
	function cp_print_news_headline($item_xml){

		global $counter;
		//Fetch All Elements from Element
		$header = cp_find_xml_value($item_xml, 'header');
		$category = html_entity_decode(cp_find_xml_value($item_xml, 'category'));
		$num_fetch = html_entity_decode(cp_find_xml_value($item_xml, 'num-fetch'));
		
		//Condition For Category
		if($category <> ''){
			
			?>
			<!--Runs the Slider Script here -->
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#news_slider-<?php echo esc_attr($counter);?>').bxSlider({  minSlides: 1, maxSlides: 1, slideMargin: 18,  speed: 500, });
				});
			</script>
			 <!-- News Content Start -->
				<div id="news" class="blog_class">
				<?php if($header <> ''){?><h2 class="title"><?php echo esc_attr($header);?><span class="h-line"></span></h2><?php }?>
					<ul class="news_slider" id="news_slider-<?php echo esc_attr($counter);?>">
					<?php
					
					//Arguments for Loop
					global $post;
					query_posts(array( 
						'post_type' => 'post',
						'showposts' => $num_fetch,
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'terms' => $category,
								'field' => 'term_id',
							)
						),
						'orderby' => 'title',
						'order' => 'DESC' )
					);
					if ( have_posts() <> "" ) {
						while ( have_posts() ): the_post();?>
						<li> 
							<div class="span5 first" id="img_holder"> 
								<div class="img">
								<?php $size = array(260,220); echo function_library::cp_thumb_size($post->ID,$size);?>
								</div>
								<div class="img_title"> 
								<a> <i class="fa fa-plus"></i> </a>
								<a href="<?php echo esc_url(get_permalink());?>"><?php echo esc_html(get_the_title());?></a> 
								<p><?php echo strip_tags(substr(esc_html(get_the_content()),0,10));?></p>
								</div>
							</div>
							<div class="span7 ns_desc"> 
								<a href="<?php echo esc_url(get_permalink());?>" class="title"><?php echo esc_html(get_the_title());?>  <span class="h-line"></span> </a> 
								<p><?php echo strip_tags(substr(esc_html(get_the_content()),0,130));?></p>
								<a href="<?php echo esc_url(get_permalink())?>" class="rm"><?php esc_html_e('View All News &nbsp;','mosque_crunchpress');?><i class="fa fa-plus"></i></a>
							</div> 
						</li>
						<?php endwhile;
					}	wp_reset_query();
						?>
					</ul>
				</div>
			<?php
		} //if Category Empty
	} //News Headline Function Ends Here

	
	// Print text widget
	function cp_print_text_widget($item_xml){
		
		$title = cp_find_xml_value($item_xml, 'title');
		$caption = html_entity_decode(cp_find_xml_value($item_xml, 'caption'));
		$button_title =  cp_find_xml_value($item_xml, 'button-title');
		echo '<div class="text-widget-wrapper"><div class="text-widget-content-wrapper ';   
		echo empty($button_title)? 'sixteen columns': 'twelve columns';
		echo ' mt0"><h3 class="text-widget-title">' . $title . '</h3>';
		echo '<div class="text-widget-caption">' . do_shortcode($caption) . '</div>';
		echo '</div>';
		if( !empty($button_title) ){
			$button_margin = (int) cp_find_xml_value($item_xml, 'button-top-margin');
			echo '<div class="text-widget-button-wrapper three columns mt0" >';
			echo '<a class="text-widget-button" style="position:relative; top:' . esc_attr($button_margin) . 'px;" href="' . cp_find_xml_value($item_xml, 'button-link') . '" >';
			echo  esc_attr($button_title) . '</a>';
			echo '</div> '; 
			echo '<br class="clear">';
		}  echo '</div>';
		
	}
	

	// size is when no sidebar, side2 is use when 1 sidebar, side 3 is use when 3 sidebar
	if( $cp_is_responsive ){
		$port_div_size_num_class = array(
			"1/4" => array("class"=>"four columns", "size"=>"390x224", "size2"=>"390x245", "size3"=>"390x247"), 
			"1/3" => array("class"=>"one-third column", "size"=>"390x242", "size2"=>"390x238", "size3"=>"390x247"), 
			"1/2" => array("class"=>"eight columns", "size"=>"450x290", "size2"=>"390x247", "size3"=>"390x247"), 
			"1/1" => array("class"=>"sixteen columns", "size"=>"620x225", "size2"=>"390x182", "size3"=>"390x292"));	
	}else{
		$port_div_size_num_class = array(
			"1/4" => array("class"=>"four columns", "size"=>"210x121", "size2"=>"135x85", "size3"=>"210x135"), 
			"1/3" => array("class"=>"one-third column", "size"=>"290x180", "size2"=>"190x116", "size3"=>"210x135"), 
			"1/2" => array("class"=>"eight columns", "size"=>"450x290", "size2"=>"300x190", "size3"=>"210x135"), 
			"1/1" => array("class"=>"sixteen columns", "size"=>"620x225", "size2"=>"320x150", "size3"=>"180x135"));
	}
	$class_to_num = array(
		"element1-4" => 0.25,
		"1/4"=>0.25,
		"element1-3" => 0.33,
		"1/3"=>0.33,
		"element1-2" => 0.5,
		"1/2"=>0.5,
		"element2-3" => 0.66,
		"2/3"=>0.66,
		"element3-4" => 0.75,
		"3/4"=>0.75,
		"element1-1" => 1,
		"1/1" => 1	
	);
	

	// Print nested page
	function cp_print_page_item($item_xml){		
		
		global $paged;
		global $sidebar;
		global $port_div_size_num_class;	
		global $class_to_num;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
	
		// get the item class and size from array
		$port_size = cp_find_xml_value($item_xml, 'item-size');
		
		// get the item class and size from array
		$item_class = $port_div_size_num_class[$port_size]['class'];
		if( $sidebar == "no-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size'];
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$item_size = $port_div_size_num_class[$port_size]['size2'];
		}else{
			$item_size = $port_div_size_num_class[$port_size]['size3'];
		}

		// get the page meta value
		$header = cp_find_xml_value($item_xml, 'header');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');	

		// page header
		if(!empty($header)){
			echo '<h2><span class="txt-left">' . $header . '</span> <span class="bg-right"></span></h2>';
		}
		global $post;
		$post_temp = query_posts(array('post_type'=>'page', 'paged'=>$paged, 'post_parent'=>$post->ID, 'posts_per_page'=>$num_fetch ));
		// get the portfolio size
		$port_wrapper_size = $class_to_num[cp_find_xml_value($item_xml, 'size')];
		$port_current_size = 0;
		$port_size =  $class_to_num[$port_size];
		
		$port_num_have_bottom = sizeof($post_temp) % (int)($port_wrapper_size/$port_size);
		$port_num_have_bottom = ( $port_num_have_bottom == 0 )? (int)($port_wrapper_size/$port_size): $port_num_have_bottom;
		$port_num_have_bottom = sizeof($post_temp) - $port_num_have_bottom;
		
		echo '<section id="portfolio-item-holder" class="portfolio-item-holder">';
		while( have_posts() ){
			the_post();
			// start printing data
			echo '<figure class="' . $item_class . ' mt0 pt25 portfolio-item">'; 
			$image_type = get_post_meta( $post->ID, 'post-option-featured-image-type', true);
			$image_type = empty($image_type)? "Link to Current Post": $image_type; 
			$thumbnail_id = get_post_thumbnail_id();
			$thumbnail = wp_get_attachment_image_src( $thumbnail_id , $item_size );
			$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
			
			$hover_thumb = "hover-link";
			$pretty_photo = "";
			$permalink = get_permalink();
			

			if( !empty($thumbnail[0]) ){
				echo '<div class="portfolio-thumbnail-image">';
				echo '<div class="overflow-hidden">';
				echo '<a href="' . esc_url($permalink) . '" ' . $pretty_photo . ' title="' . esc_html(get_the_title()) . '">';
				echo '<span class="portfolio-thumbnail-image-hover">';
				echo '<span class="' . $hover_thumb . '"></span>';
				echo '</span>';
				echo '</a>';
				echo '<img src="' . $thumbnail[0] .'" alt="'. $alt_text .'"/>';
				echo '</div>'; //overflow hidden
				echo '</div>'; //portfolio thumbnail image						
			}
			
			
			echo '<div class="portfolio-thumbnail-context">';
			// page title
			if( cp_find_xml_value($item_xml, "show-title") == "Yes" ){
				echo '<h2 class="heading portfolio-thumbnail-title port-title-color cp-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
			}
			// page excerpt
			if( cp_find_xml_value($item_xml, "show-excerpt") == "Yes" ){			
				echo '<div class="portfolio-thumbnail-content">' . mb_substr( get_the_excerpt(), 0, $num_excerpt ) . '</div>';
			}
			// read more button
			if( cp_find_xml_value($item_xml, "read-more") == "Yes" ){
				echo '<a href="' . get_permalink() . '" class="portfolio-read-more cp-button">' . esc_html__('Read More','mosque_crunchpress') . '</a>';
			}
			echo '</div>';
			// print space if not last line
			if($port_current_size < $port_num_have_bottom){
				echo '<div class="portfolio-bottom"></div>';
				$port_current_size++;
			}
			echo '</figure>';

		} wp_reset_query();

		echo "</section>";
		echo '<div class="clear"></div>';
		if( cp_find_xml_value($item_xml, "pagination") == "Yes" ){	
			cp_pagination();
		}		
		
	}
	
	//Donation Box
	function cp_print_donate_item($item_xml){
		$header = cp_find_xml_value($item_xml, 'header');
		$description = cp_find_xml_value($item_xml, 'description');
		$donate_button = cp_find_xml_value($item_xml, 'donate_button_text');
		$button_link = cp_find_xml_value($item_xml, 'button-link');
	?>
	<section id="donation_box">	
		<div class="donation_box">
			<figure class="span10">
				<?php echo esc_attr($description);?>
			</figure>
			<figure class="span2">
					<a href="<?php echo esc_url($button_link);?>" class="donate-now btn btn-large dropdown-toggle" type="submit"><?php echo esc_attr($donate_button);?></a>
			</figure>
		</div>
	</section>
	<?php }
	
	

	// Store Element
	function cp_print_store_item($item_xml){ 
	
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$number_fetch = cp_find_xml_value($item_xml, 'number_fetch');
		$style = cp_find_xml_value($item_xml, 'style'); 	
		//WooCommerce Style
		wp_enqueue_style('woocommerce_frontend_styles',CP_PATH_URL.'/frontend/css/woocommerce.css');
		
		//Query To Database
		if($style == 'Diagonal'){
				if($category == '0'){
					query_posts(
						array( 
						'post_type' 				=> 'product',
						'posts_per_page'			=> $number_fetch,
						'orderby'					=> 'title',
						'order' 					=> 'ASC' )
					);
				}else{
					query_posts(
						array( 
						'post_type' 				=> 'product',
						'posts_per_page'			=> $number_fetch,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'terms' => $category,
								'field' => 'term_id',
							)
						),
						'orderby' => 'title',
						'order' => 'ASC' )
					);
				} 
		?>
		<!-- Element Title -->
		<div class="section-title">
		  <div class="container">
			<h2><?php echo esc_attr($header);?></h2>
		  </div>
		</div>
		
		<!--HTML Markup of Element-->
		<div class="featured-items">
			<div class="container">
				<div class="row">
				<?php	
				$permalink_structure = get_option('permalink_structure');
				if($permalink_structure <> ''){
					$permalink_structure = '?';
				}else{
					$permalink_structure = '&';
				}
				$counter_product = 0;
				
				while( have_posts() ){
					the_post();	
					global $post,$post_id,$product,$product_url;
					$regular_price = get_post_meta($post->ID, '_regular_price', true);
					if($regular_price == ''){
						$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
					}
					$sale_price = get_post_meta($post->ID, '_sale_price', true);
					if($sale_price == ''){
						$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
					}
					$sku_num = get_post_meta($post->ID, '_sku', true);
					$currency = get_woocommerce_currency_symbol();
				?>
				<!-- Inside Loop Content -->	
					<div class="col-md-4">
						<div class="fitem">
							<div class="cart">
								<?php
								echo apply_filters( 'woocommerce_loop_add_to_cart_link',
									sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
										esc_url( $product->add_to_cart_url() ),
										esc_attr( $product->id ),
										esc_attr( $product->get_sku() ),
										$product->is_purchasable() ? 'add_to_cart_button' : '',
										esc_attr( $product->product_type ),
										esc_html( $product->add_to_cart_text() )
									),
								$product );
								?>
							</div>
							<div class="thumb">
								<div class="frame">
									<span class="frame-hover"><a href="<?php echo get_permalink();?>"><i class="fa fa-link"></i></a></span>
										<div class="frame-caption">
											<h3><?php echo get_the_title();?></h3>
											<div class="bottom-row woocommerce">
												<div class="rating">
													<?php if ( $rating_html = $product->get_rating_html() ) : ?>
														<?php echo html_entity_decode($rating_html); ?>
													<?php endif; ?>
												</div>
											</div>
											<strong class="price"><?php echo esc_attr($currency);?><?php if($sale_price <> ''){echo esc_attr($sale_price);}else{echo esc_attr($regular_price);}?></strong> 
										</div>
									<?php echo get_the_post_thumbnail($post_id, array(450,450));?>
								</div>
							</div>
							<div class="like"><a href="<?php echo get_permalink();?>"><i class="fa fa-file-text-o"></i></a></div>
						</div>
					</div>	
			<?php } wp_reset_query(); //End While ?> 	
				</div> <!-- row ends -->
			</div> <!-- Container ends -->
		</div><!-- Parent Div ends -->
	
	<?php } else {

			if($category == '0'){
					query_posts(
						array( 
						'post_type' 				=> 'product',
						'posts_per_page'			=> $number_fetch,
						'orderby'					=> 'date',
						'order' 					=> 'DESC' )
					);
				}else{
					query_posts(
						array( 
						'post_type' 				=> 'product',
						'posts_per_page'			=> $number_fetch,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'terms' => $category,
								'field' => 'term_id',
							)
						),
						'orderby' => 'date',
						'order' => 'DESC' )
					);
				} ?>
				<!-- Element Title -->
				<div class="section-title">
					<div class="container">
						<h2><?php echo esc_attr($header);?></h2>
					</div>
				</div>
				
			<!--HTML Markup of Element-->
			<div class="container">
				<div class="row">	
				<?php	
					$permalink_structure = get_option('permalink_structure');
					if($permalink_structure <> ''){
						$permalink_structure = '?';
					}else{
						$permalink_structure = '&';
					}
					$counter_product = 0;
					
					while( have_posts() ){
						the_post();	
						global $post,$post_id,$product,$product_url;
						$regular_price = get_post_meta($post->ID, '_regular_price', true);
						if($regular_price == ''){
							$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
						}
						$sale_price = get_post_meta($post->ID, '_sale_price', true);
						if($sale_price == ''){
							$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
						}
						$sku_num = get_post_meta($post->ID, '_sku', true);
						$currency = get_woocommerce_currency_symbol();
					?>
						<!-- Inside Loop Content -->
						<div class="col-md-3">
							<div class="pro-box">
								<div class="thumb">
									<div class="thumb-hover"> 
										<span class="cart">
											<?php
												echo apply_filters( 'woocommerce_loop_add_to_cart_link',
													sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
														esc_url( $product->add_to_cart_url() ),
														esc_attr( $product->id ),
														esc_attr( $product->get_sku() ),
														$product->is_purchasable() ? 'add_to_cart_button' : '',
														esc_attr( $product->product_type ),
														esc_html( $product->add_to_cart_text() )
													),
												$product );
												?>
										</span>
										<span class="like"><a href="<?php echo get_permalink();?>"><i class="fa fa-file-text-o"></i></a></span> 
									</div>
									<div class="sale">
										<?php if ( $product->is_on_sale() ) : ?>
											<?php echo apply_filters( 'woocommerce_sale_flash', '<span>' . esc_html__( 'On Sale!', 'mosque_crunchpress' ) . '</span>', $post, $product ); ?>
										<?php endif; ?>
									</div>
									<?php echo get_the_post_thumbnail($post_id, array(260,300));?>
								</div>
								<div class="pro-content">
									<div class="rate"><?php echo esc_attr($currency);?><?php if($sale_price <> ''){echo esc_attr($sale_price);}else{echo esc_attr($regular_price);}?></div>
									<h3><?php echo get_the_title();?></h3>
									<div class="bottom-row woocommerce">
										<div class="rating">
											<?php if ( $rating_html = $product->get_rating_html() ) : ?>
												<?php echo html_entity_decode($rating_html); ?>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
						</div>	
					<?php } //End While ?>
				</div>
			</div>
		<?php } //end ELSE clause 	

		wp_reset_query();
		wp_reset_postdata();
		
	} // Function Ends
	
	
	// Products Slider Element
	function cp_print_ingenio_products_slider_item($item_xml){ 
	
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$number_fetch = cp_find_xml_value($item_xml, 'number_fetch');
		
		//WooCommerce Style
		wp_enqueue_style('woocommerce_frontend_styles',CP_PATH_URL.'/frontend/css/woocommerce.css');
		
		//Query To Database
			if($category == '0'){
				query_posts(
					array( 
					'post_type' 				=> 'product',
					'posts_per_page'			=> $number_fetch,
					'orderby'					=> 'date',
					'order' 					=> 'DESC' )
				);
			}else{
				query_posts(
					array( 
					'post_type' 				=> 'product',
					'posts_per_page'			=> $number_fetch,
					'tax_query' => array(
						array(
							'taxonomy' => 'product_cat',
							'terms' => $category,
							'field' => 'term_id',
						)
					),
					'orderby' => 'date',
					'order' => 'DESC' )
				);
			} 
		?>

		<!--HTML Markup of Element-->
		<div class="gbg">
			<div class="home-blog-container">
			<!--Bx Slider Script Calling-->
			<?php global $counter;
				wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
				wp_enqueue_script('cp-bx-slider');	
				wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css'); ?>
				
				<script type="text/javascript">
				jQuery(document).ready(function ($) {
					"use strict";
					if ($('.home-blog-slider-<?php echo esc_js($counter); ?>').length) {
						$('.home-blog-slider-<?php echo esc_js($counter); ?>').bxSlider({
							auto:false,
							speed: 2000,
							controls: true,
							infiniteLoop: true
						});
					}
				});
				</script>
				
				<ul class="home-blog-slider-<?php echo esc_attr($counter); ?>">				
					<?php	
					$permalink_structure = get_option('permalink_structure');
					if($permalink_structure <> ''){
						$permalink_structure = '?';
					}else{
						$permalink_structure = '&';
					}
					$counter_product = 0;
					
					while( have_posts() ){
						the_post();	
						global $post,$post_id,$product,$product_url;
						$regular_price = get_post_meta($post->ID, '_regular_price', true);
						if($regular_price == ''){
							$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
						}
						$sale_price = get_post_meta($post->ID, '_sale_price', true);
						if($sale_price == ''){
							$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
						}
						$sku_num = get_post_meta($post->ID, '_sku', true);
						$currency = get_woocommerce_currency_symbol();

					?>
					<!-- Inside Loop Content -->	
					<li>
						<div class="thumb"><?php echo get_the_post_thumbnail($post->ID, array(350,350));?></div>
						<div class="blog-content">
						  <h3><?php echo get_the_title();?></h3>
						  <p><?php echo substr(($post->post_excerpt),0,550);?></p>
						  <a href="<?php echo get_permalink();?>" class="read-post"><?php esc_html_e('Read Detail','mosque_crunchpress');?></a> 
						</div>
						<div class="post-meta">
						  <ul> 
							<li><i class="fa fa-money"></i><?php esc_html_e('Price: ','mosque_crunchpress');?><?php echo esc_attr($currency);?><?php if($sale_price <> ''){echo esc_attr($sale_price);}else{echo esc_attr($regular_price);}?></li>
							<li>
								<div class="bottom-row woocommerce">
									<div class="rating">
										<?php if ( $rating_html = $product->get_rating_html() ) : ?>
											<?php echo html_entity_decode($rating_html); ?>
										<?php endif; ?>
									</div>
								</div>
							</li>
							<li><i class="fa fa-calendar"></i><?php echo date('Y-m-d',strtotime($post->post_date)); ?></li>
							<li>
								<?php
								echo esc_html(apply_filters( 'woocommerce_loop_add_to_cart_link',
									sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
										esc_url( $product->add_to_cart_url() ),
										esc_attr( $product->id ),
										esc_attr( $product->get_sku() ),
										$product->is_purchasable() ? 'add_to_cart_button' : '',
										esc_attr( $product->product_type ),
										esc_html( $product->add_to_cart_text() )
									),
								$product ));
								?>
							</li>
						  </ul>
						</div>
					</li>
				<?php } wp_reset_query(); //End While ?>
				</ul>
			</div>
		</div>
		<?php 
	}// Function Ends				
	
	//Crowd Funding Functions to Fetch Products
	function cp_print_funds_item_item($item_xml){ 
		$header = cp_find_xml_value($item_xml, 'header');
		$project = cp_find_xml_value($item_xml, 'project');
		
		//Condition to check Projects are not empty
		if($project <> ''){
			//Fetch All elements here
			$ign_fund_goal = get_post_meta($project, 'ign_fund_goal', true);
			$ign_project_id = get_post_meta($project, 'ign_project_id', true);
			$ign_product_image1 = get_post_meta($project, 'ign_product_image1', true);
			$ignition_date = get_post_meta($project, 'ign_fund_end', true);
			$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
			
			$getPledge_cp = getPledge_cp($ign_project_id);
			$current_date = date('d-m-Y h:i:s');
			$project_date = new DateTime($ignition_datee);
			$current = new DateTime($current_date);
			
			$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));

		?>
		<div id="charity_progress">
			<h3><a href="<?php echo get_permalink($project);?>"><?php echo get_the_title($project);?></a></h3>
			<div id="charity_process_inner">
				<div class="span4 img first">
					<img src="<?php echo esc_url($ign_product_image1);?>" alt="<?php echo get_the_title($project);?>"/>
				</div>
				<div class="span8 progress_report">
				<h2> <?php esc_html_e('$','mosque_crunchpress');?><?php echo getTotalProductFund_cp($ign_project_id);?> </h2>
				<h4><?php esc_html_e('Pledged of','mosque_crunchpress');?> <?php esc_html_e('$','mosque_crunchpress');?><?php echo esc_attr($ign_fund_goal);?> <?php esc_html_e('Goal','mosque_crunchpress');?></h4>
					<div class="progress progress-striped active">  
						<div style="width:<?php echo getPercentRaised_cp($ign_project_id);?>%;" class="bar p80"></div>    
					</div>
					  <div class="info"> 
							<div class="span6 first">
								<i class="fa fa-user"></i> <span> <?php echo esc_attr($getPledge_cp[0]->p_number);?></span> <?php esc_html_e('Pledgers','mosque_crunchpress');?>
							</div>
							<div class="span6 ntr">
								<i class="fa fa-calendar-empty"></i> <span> <?php echo esc_attr($days);?></span> <?php esc_html_e('Days Left','mosque_crunchpress');?>
							</div>
					  </div>
				</div>
			</div>
		</div>	
	<?php
		}// Condition Ends Here
	} // Function ends here
	
	//WooCommerece Feature Products
	function cp_print_woo_product_feature_item($item_xml){ 
		global $counter;
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		
		//BX Slider Scripts
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css');
	?>
		<script type="text/javascript">
		//Run Bx Slider
		jQuery(document).ready(function ($) {
			$('#shop_slider-<?php echo esc_js($counter);?>').bxSlider({
				slideWidth: 140,
				minSlides: 1,
				maxSlides: 3,
				slideMargin: 28
			});
		});	
		</script>
		<figure id="blog_store">
			<?php if($header <> ''){?><h2 class="title"> <?php echo esc_js($header);?><span class="h-line"></span></h2><?php }?>
			<div class="slider_shop" id="slider_shop">
				<ul class="shop_slider" id="shop_slider-<?php echo esc_js($counter);?>">
				<?php
		
			
					$counter_team = 0; 
					query_posts(array( 
						'post_type' => 'product',
						'showposts' => $num_fetch,
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'terms' => $category,
								'field' => 'term_id',
							)
						),
						'orderby' => 'title',
						'order' => 'DESC' )
					);
					while( have_posts() ){
					the_post();
					$currency = '';
					global $post,$product,$product_url;
						$regular_price = get_post_meta($post->ID, '_regular_price', true);
						if($regular_price == ''){
							$regular_price = get_post_meta($post->ID, '_max_variation_regular_price', true);
						}
						$sale_price = get_post_meta($post->ID, '_sale_price', true);
						if($sale_price == ''){
							$sale_price = get_post_meta($post->ID, '_min_variation_sale_price', true);
						}
						if(function_exists('get_woocommerce_currency_symbol')){
							$currency = get_woocommerce_currency_symbol();
						}
					?>
					<li> 
						<div class="img">
							<a href="<?php echo get_permalink();?>">
								<?php $size = array(260,220); echo function_library::cp_thumb_size($post->ID,$size);?>
							</a>
						</div>
						<div class="price_cart"><span class="price"><?php echo esc_attr($currency);?><?php echo esc_attr($sale_price);?></span><a href="<?php echo get_permalink();?>&add-to-cart=<?php echo esc_attr($post->ID);?>"><i class="fa fa-shopping-cart"></i></a></div>
					</li>
					<?php }  wp_reset_query(); ?>
				</ul>
			</div>
		</figure>
	<?php
	}
	
	//News Bar Under Slider
	function cp_news_bar_frontpage($news_button,$news_title,$news_category){

		//BX Slider Scripts
		wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/css/bxslider.css'); ?>
		<script type="text/javascript">
		//Run Bx Slider
		jQuery(document).ready(function ($) {
			$('#slider12').bxSlider({
			pager:false,
			});
		});	
		</script>
		<?php
		$args = array(
			'cat' => $news_category, 
			'posts_per_page'   => 5,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
		);
		// Retrieve posts
		$post_list = get_posts( $args );
		//News Title
		if($news_title <> ''){ ?><strong class="news-title"><?php echo esc_attr($news_title);?></strong><?php }else{ ?><strong class="news-title"><?php esc_html_e('Dont miss','mosque_crunchpress');?></strong><?php } ?>
		<div id="ticker" class="ticker ">
			<div id="slider12">
				<?php
				//Arguments for Loop
				foreach($post_list as $post){ ?>
						<div class="slide">
							<p><?php echo esc_attr($post->post_title);?> &#45; <em><?php echo htmlspecialchars(strip_tags(substr($post->post_content,0,120)));?></em></p>
						</div>
					<?php
				} //If Posts Condition Ends
				?>
			</div>						
		</div> <!-- End News Ticker & Share-search bar -->
		<?php
		wp_reset_query();
		wp_reset_postdata();
	}	//Function ends Here
