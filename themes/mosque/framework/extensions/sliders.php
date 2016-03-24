<?php

	/*
	*	CrunchPress Misc File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all of the necessary function for the front-end to
	*	easily used. You can see the description of each function below.
	*	---------------------------------------------------------------------
	*/
	
	// Check if url is from youtube or vimeo
	function cp_get_video($url, $width = 640, $height = 480){
	
		$videoHtml = '';
		
		if(strpos($url,'youtube')){		
		
			$videoHtml = get_youtube($url, $width, $height);
		
		}else if(strpos($url,'youtu.be')){
		
			$videoHtml = get_youtube($url, $width, $height, 'youtu.be');
			
		}else{
		
			$videoHtml = get_vimeo($url, $width, $height);
		}
		
		return $videoHtml;
	}
	
	// Print youtube video
	function get_youtube($url, $width = 640, $height = 480, $type = 'youtube'){
		
		if( $type == 'youtube' ){
			preg_match('/[\\?\\&]v=([^\\?\\&]+)/',$url,$id);
		}else{
			preg_match('/youtu.be\/([^\\?\\&]+)/', $url, $id);
		}
		
		$width_html = '';
		if($width  == '100%'){
			$width_html .= 'class="full-width-video"   ';
			$width_html .= 'width="100"';
		}else{
			$width_html = 'width='.$width;
		}
		
		
		
		return '<iframe src="http://www.youtube.com/embed/'.$id[1].'?wmode=transparent" ' .$width_html. ' height="'.$height.'" ></iframe>';
		
		
		
	}
	
	//Get Audio Player OR SoundCloud
	function get_audio_track($url,$counter_track){
		$audio_html = '';
		if(strpos($url,'soundcloud')){
			$audio_html .= do_shortcode('[soundcloud type="visual-embed" url="'.$url.'" color="#1e73be" auto_play="false" hide_related="true" show_artwork_or_visual="true" width="100%" height="300" iframe="true" /]');
		}else{
			if($url <> '' ){
				$audio_html  .= do_shortcode('[audio mp3="'.$url.'"][/audio]');
			} // No MP3 Song
		}
		
		return $audio_html;
	}
	
	// Print vimeo video
	function get_vimeo($url, $width = 640, $height = 480){
		
		preg_match('#https?:\/\/vimeo.com\/(\d+)#', $url, $id);
		
		$cp_full_class = '';
		$cp_width = '';
		if($width  == '100%'){
			$cp_full_class = 'full-width-video';
			$cp_width = '100';
		}else{
			$cp_full_class = 'full-width-video';
			$cp_width = $width;
		}
			
		if(!empty($id)){
			return '<iframe src="http://player.vimeo.com/video/' . $id[1] . '?title=0&amp;byline=0&amp;portrait=0" class="'.$cp_full_class.'" width="' . $cp_width . '" height="' . $height . '"></iframe>';
		}
		
	}

	function cp_print_flex_slider($slider_xml, $size){
		if( empty($slider_xml) ) return;

		$slider_style = 'slider';
		//Getting Slider Settings
		$cp_slider_settings = get_option('slider_settings');
		if($cp_slider_settings <> ''){
			
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $cp_slider_settings );
			$animation_type_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','animation_type_flex');
			$reverse_order_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','reverse_order_flex');
				if($reverse_order_flex == 'disable'){$reverse_order_flex = 'false';}else{$reverse_order_flex = 'true';}
			$startat_flex_slider = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','startat_flex_slider');
			$auto_play_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','auto_play_flex');
				if($auto_play_flex == 'disable'){$auto_play_flex = 'false';}else{$auto_play_flex = 'true';}
			$animation_speed_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','animation_speed_flex');
			$pause_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','pause_on_flex');
			if($pause_on_flex == 'disable'){$pause_on_flex = 'false';}else{$pause_on_flex = 'true';}
			$navigation_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','navigation_on_flex');
			if($navigation_on_flex == 'disable'){$navigation_on_flex = 'false';}else{$navigation_on_flex = 'true';}
			$arrow_on_flex = find_xml_child_nodes($cp_slider_settings,'flex_slider_settings','arrow_on_flex');
			if($arrow_on_flex == 'disable'){$arrow_on_flex = 'false';}else{$arrow_on_flex = 'true';}
			//Anything Slider Values
			$slide_mod_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','slide_mod_anything');
			$auto_play_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','auto_play_anything');
			if($auto_play_anything == 'disable'){$auto_play_anything = 'false';}else{$auto_play_anything = 'true';}
			$pause_on_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','pause_on_anything');
			if($pause_on_anything == 'disable'){$pause_on_anything = 'false';}else{$pause_on_anything = 'true';}
			$animation_speed_anything = find_xml_child_nodes($cp_slider_settings,'anything_slider_settings','animation_speed_anything');
		}
		
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			'use strict';
			$('#flexslider').flexslider({
				animation: '<?php echo esc_js($animation_type_flex);?>',
				reverse: <?php echo esc_js($reverse_order_flex);?>,
				startAt: <?php echo esc_js($startat_flex_slider);?>,
				slideshow: <?php echo esc_js($auto_play_flex);?>,
				animationSpeed: <?php echo esc_js($animation_speed_flex);?>, 
				pauseOnHover: <?php echo esc_js($pause_on_flex);?>, 
				directionNav: <?php echo esc_js($navigation_on_flex);?>, 
				controlNav: <?php echo esc_js($arrow_on_flex);?>, 
				start: function(slider){
				  $('body').removeClass('loading');
				}
			});
		});
		</script>
		
		<?php
		global $cp_is_responsive;
		
			echo '<div id="flexslider" class="flexslider ">';
				echo '<ul class="slides">';		
					foreach($slider_xml->childNodes as $slider){
						$title = cp_find_xml_value($slider, 'title');
						$caption = html_entity_decode(cp_find_xml_value($slider, 'caption'));
						$link = cp_find_xml_value($slider, 'link');
						$link_type = cp_find_xml_value($slider, 'linktype');
						$btn_txt = cp_find_xml_value($slider, 'btn_txt');
						if(cp_get_width($size) == '5000'){
							$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),'full');
						}else{
							$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),$size);
						}
						$alt_text = get_post_meta(cp_find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
						echo '<li class="slide-image">';				
							echo '<img src="' . $image_url[0] . '" alt="' . $alt_text . '" />';
							if( !empty($title) ){
								echo '<div class="caption"><div class="cp-slider-title cp-title">' . $title . '</div>' . substr($caption,0,150) . '</div>'; 
							}
						echo '</li>';
					}
				echo "</ul>";
			echo "</div>";
	}
	
	
	
	function crunch_print_bx_slider($slider_xml,$size,$slider_id='',$layout=''){
		global $post;
		//BX slider
		$slider_html = 'false';
		$slide_order_bx = '';
		$auto_play_bx = '';
		$pause_on_bx = '';
		$animation_speed_bx = '';
		$anchor_hr = '';
		$show_bullets = '';
		$show_arrow = '';
		
		$cp_slider_settings = get_option('slider_settings');
		if($cp_slider_settings <> ''){
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $cp_slider_settings );
			//Bx Slider Values
			$slide_order_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','slide_order_bx');
			$auto_play_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','auto_play_bx');
			if($auto_play_bx == 'enable'){$auto_play_bx = 'true';}else{$auto_play_bx = 'false';}
			$pause_on_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','pause_on_bx');
			if($pause_on_bx == 'enable'){$pause_on_bx = 'true';}else{$pause_on_bx = 'false';}
			$animation_speed_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','animation_speed_bx');
			$show_bullets = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','show_bullets');
			$show_arrow = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','show_arrow');
		}
		$mode_slide = '';
		if($slide_order_bx == 'slide'){$mode_slide = "mode: 'horizontal'";}else{$mode_slide = "mode: 'fade'";}
		if($animation_speed_bx == ''){$animation_speed_bx = '2000';}
		if($show_bullets == 'enable'){$show_bullets = 'true';}else{$show_bullets = 'false';}
		if($show_arrow == 'enable'){$show_arrow = 'true';}else{$show_arrow = 'false';}
		
	
	
		if(!empty($slider_xml)){
			$layout_selected = '';
			if($layout == 'church-slider'){
				$layout_selected = 'short_slider';
			}else if($layout == 'politics-slider'){
				$layout_selected = 'default-slider-cp';
			}else{
				$layout_selected = $layout;
			}
			wp_register_script('cp-bx-slider', CP_PATH_URL.'/frontend/shortcodes/js/bxslider.min.js', false, '1.0', true);
		wp_enqueue_script('cp-bx-slider');	
		wp_register_script('cp-fitvids-slider', CP_PATH_URL.'/frontend/shortcodes/js/jquery.fitvids.js', false, '1.0', true);
		wp_enqueue_script('cp-fitvids-slider');	
		
		wp_enqueue_style('cp-bx-slider',CP_PATH_URL.'/frontend/shortcodes/css/bxslider.css');
		$slider_html = '<div class="cp-banner '.$layout_selected.'">';
		$slider_html = $slider_html . '<script type="text/javascript">jQuery(document).ready(function($){$("#'.$slider_id.$layout.'").bxSlider({'.$mode_slide.',minSlides: 1,maxSlides: 1,pager:'.$show_bullets.',controls:'.$show_arrow.',hideControlOnEnd: true,easing: "swing",auto: '.$auto_play_bx.',autoHover:'.$pause_on_bx.',speed:'.$animation_speed_bx.'});});</script>';
			$slider_html = $slider_html . '<ul id="'.$slider_id.$layout.'" class="banner_sliderr" >';
				foreach($slider_xml->childNodes as $slider){
					$title = cp_find_xml_value($slider, 'title');
					$caption = html_entity_decode(cp_find_xml_value($slider, 'caption'));
					$link = cp_find_xml_value($slider, 'link');
					$link_type = cp_find_xml_value($slider, 'linktype');
					$btn_txt = cp_find_xml_value($slider, 'btn_txt');
					if(cp_get_width($size) == '5000'){
						$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),'full');
					}else{
						$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),$size);
					}
					$alt_text = get_post_meta(cp_find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
					
						if($link_type == 'No Link'){$anchor_hr = '<strong class="title">'. $title.'</strong>';}else if($link_type == 'Link to URL'){$anchor_hr = '<strong class="title"><a href="'.esc_url($link).'">'. $title.'</a></strong>';}else{$anchor_hr = '';}
						//if($link <> ''){$anchor_hr = '<h2><a href="'.esc_url($link).'">'. $title.'</a></h2>';}else{$anchor_hr = '<h2>'. $title.'</h2>';}
						$slider_html = $slider_html  .'<li>';
						
						$slider_html = $slider_html  .'<span><img src="'. $image_url[0].'" alt=""/></span>';
						//$layout
						//Condition for Title and Description if Empty
						if($title <> '' AND $caption <> ''){
							if($layout == 'politics-slider'){
								$slider_html = $slider_html  .'<div class="holder"><div class="caption">';
								$slider_html = $slider_html  .$anchor_hr;
								$slider_html = $slider_html  .'<div class="paragraph-style"><p>'. esc_html($caption).'</p></div>';
								$slider_html = $slider_html  .'<a href="'.$link.'" class="btn-2">'.esc_html__('Learn More','mosque_crunchpress').'</a></div></div>';
							}else if($layout == 'church-slider'){
							$slider_html = $slider_html  .'<div class="caption">';
								$slider_html = $slider_html  .$anchor_hr;
								$slider_html = $slider_html  .'<p>'. esc_html($caption).'</p>
								<a class="btn-more" href="'.$link.'">'.esc_html__('Learn More','mosque_crunchpress').'</a>
							</div>';
							}else if($layout == 'eco-slider'){
								$slider_html = $slider_html  .'
								<div class="caption">
									<strong class="title">'.$title.'</strong>
									<h1>'.$caption.'</h1>
								</div>';
							}else{
							
							}
						}
						
						$slider_html = $slider_html  .'</li>';
				}
				
			$slider_html = $slider_html . '</ul>';
			$slider_html = $slider_html . '</div>';
		
		}
	return $slider_html;
	
	}
	
	function cp_print_bx_slider($slider_xml,$size,$slider_id){
		global $post;
		//BX slider
		$slider_html = 'false';
		$slide_order_bx = '';
		$auto_play_bx = '';
		$pause_on_bx = '';
		$animation_speed_bx = '';
		$anchor_hr = '';
		$show_bullets = '';
		$show_arrow = '';
		
		$cp_slider_settings = get_option('slider_settings');
		if($cp_slider_settings <> ''){
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $cp_slider_settings );
			//Bx Slider Values
			$slide_order_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','slide_order_bx');
			$auto_play_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','auto_play_bx');
			if($auto_play_bx == 'enable'){$auto_play_bx = 'true';}else{$auto_play_bx = 'false';}
			$pause_on_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','pause_on_bx');
			if($pause_on_bx == 'enable'){$pause_on_bx = 'true';}else{$pause_on_bx = 'false';}
			$animation_speed_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','animation_speed_bx');
			$show_bullets = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','show_bullets');
			$show_arrow = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','show_arrow');
		}
		$mode_slide = '';
		if($slide_order_bx == 'slide'){$mode_slide = "mode: 'horizontal'";}else{$mode_slide = "mode: 'fade'";}
		if($animation_speed_bx == ''){$animation_speed_bx = '2000';}
		if($show_bullets == 'enable'){$show_bullets = 'true';}else{$show_bullets = 'false';}
		if($show_arrow == 'enable'){$show_arrow = 'true';}else{$show_arrow = 'false';}
		
	
	
		if(!empty($slider_xml)){
		$slider_html = '<div class="default-slider-cp cp-banner">';
		$slider_html = $slider_html . '<script type="text/javascript">jQuery(document).ready(function($){$("#'.$slider_id.'").bxSlider({'.$mode_slide.',minSlides: 1,maxSlides: 1,pager:'.$show_bullets.',controls:'.$show_arrow.',hideControlOnEnd: true,easing: "swing",auto: '.$auto_play_bx.',autoHover:'.$pause_on_bx.',speed:'.$animation_speed_bx.'});});</script>';
			$slider_html = $slider_html . '<ul id="'.$slider_id.'" class="banner_sliderr" >';
				foreach($slider_xml->childNodes as $slider){
					$title = cp_find_xml_value($slider, 'title');
					$caption = html_entity_decode(cp_find_xml_value($slider, 'caption'));
					$link = cp_find_xml_value($slider, 'link');
					$link_type = cp_find_xml_value($slider, 'linktype');
					$btn_txt = cp_find_xml_value($slider, 'btn_txt');
					if(cp_get_width($size) == '5000'){
						$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),'full');
					}else{
						$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),$size);
					}
					$alt_text = get_post_meta(cp_find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
					
						if($link_type == 'No Link'){$anchor_hr = '<strong class="title">'. $title.'</strong>';}else if($link_type == 'Link to URL'){$anchor_hr = '<strong class="title"><a href="'.esc_url($link).'">'. $title.'</a></strong>';}else{$anchor_hr = '';}
						//if($link <> ''){$anchor_hr = '<h2><a href="'.esc_url($link).'">'. $title.'</a></h2>';}else{$anchor_hr = '<h2>'. $title.'</h2>';}
						$slider_html = $slider_html  .'<li>';
						
						$slider_html = $slider_html  .'<span><img src="'. $image_url[0].'" alt=""/></span>';
						//Condition for Title and Description if Empty
						if($title <> '' AND $caption <> ''){
							$slider_html = $slider_html  .'<div class="holder"><div class="caption">';
							$slider_html = $slider_html  .$anchor_hr;
							$slider_html = $slider_html  .'<div class="paragraph-style"><p>'. esc_html($caption).'</p></div>';
							$slider_html = $slider_html  .'<a href="'.$link.'" class="btn-2">'.esc_html__('Learn More','mosque_crunchpress').'</a></div></div>';
						}
						$slider_html = $slider_html  .'</li>';
				}
				
			$slider_html = $slider_html . '</ul>';
			$slider_html = $slider_html . '</div>';
		
		}
	return $slider_html;
	
	}
	
	function print_bx_post_slider($slider_xml,$size,$slider_id){
		global $post;
		//BX slider
		$slider_html = 'false';
		$slide_order_bx = '';
		$auto_play_bx = '';
		$pause_on_bx = '';
		$animation_speed_bx = '';
		$anchor_hr = '';
		
		$cp_slider_settings = get_option('slider_settings');
		if($cp_slider_settings <> ''){
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $cp_slider_settings );
			//Bx Slider Values
			$slide_order_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','slide_order_bx');
			$auto_play_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','auto_play_bx');
			if($auto_play_bx == 'enable'){$auto_play_bx = 'true';}else{$auto_play_bx = 'false';}
			$pause_on_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','pause_on_bx');
			if($pause_on_bx == 'enable'){$pause_on_bx = 'true';}else{$pause_on_bx = 'false';}
			$animation_speed_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','animation_speed_bx');
		}
		
		if($slide_order_bx == 'slide'){}else{$mode_slide = "mode: 'fade',";}
		if($animation_speed_bx == ''){$animation_speed_bx = '2000';}
	
	
		if(!empty($slider_xml)){
		$slider_html = '<section class="border_slider">';
		$slider_html = $slider_html . '<script type="text/javascript">jQuery(document).ready(function($){var blockexist = $(".post-type-bar");$("#'.$slider_id.'").bxSlider({'.$mode_slide.'minSlides: 1,maxSlides: 1,slideMargin: 0,hideControlOnEnd: true,easing: "swing",auto: '.$auto_play_bx.',autoHover:'.$pause_on_bx.',speed:'.$animation_speed_bx.',onSliderLoad:function(){if(blockexist.length){var para_post = "slider-'.$post->ID.'";equalheight_fun(para_post);}}});});</script>';
			$slider_html = $slider_html . '<ul id="'.$slider_id.'" class="banner_sliderr" >';
				foreach($slider_xml->childNodes as $slider){
					$title = cp_find_xml_value($slider, 'title');
					$caption = html_entity_decode(cp_find_xml_value($slider, 'caption'));
					$link = cp_find_xml_value($slider, 'link');
					$link_type = cp_find_xml_value($slider, 'linktype');
					$btn_txt = cp_find_xml_value($slider, 'btn_txt');
					if(cp_get_width($size) == '5000'){
						$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),'full');
					}else{
						$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),$size);
					}
					$alt_text = get_post_meta(cp_find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
					
						if($link_type == 'No Link'){$anchor_hr = '<strong class="f-post-title">'. $title.'</strong>';}else if($link_type == 'Link to URL'){$anchor_hr = '<strong class="f-post-title"><a href="'.esc_url($link).'">'. $title.'</a></strong>';}else{$anchor_hr = '';}
						//if($link <> ''){$anchor_hr = '<h2><a href="'.esc_url($link).'">'. $title.'</a></h2>';}else{$anchor_hr = '<h2>'. $title.'</h2>';}
						$slider_html = $slider_html  .'<li>';
						$slider_html = $slider_html  .'<img src="'. $image_url[0].'" alt=""/>';
						//Condition for Title and Description if Empty
						if($title <> '' AND $caption <> ''){
							$slider_html = $slider_html  .'<div class="post-slide-cap"><span class="post-type">'.get_the_date(get_option('date_format')).'<i class="icon-facetime-video"></i></span>';
							$slider_html = $slider_html  .$anchor_hr;
							$slider_html = $slider_html  .'</div>';
						}
						$slider_html = $slider_html  .'</li>';
				}
				
			$slider_html = $slider_html . '</ul>';
			$slider_html = $slider_html . '</section>';
		
		}
	return $slider_html;
	
	}
	
	function cp_print_bx_slider_shortcode($slider_xml,$size,$slider_id){
	global $post;
	//BX slider
	$slider_html = 'false';
	$slide_order_bx = '';
	$auto_play_bx = '';
	$pause_on_bx = '';
	$animation_speed_bx = '';
	
	$cp_slider_settings = get_option('slider_settings');
	if($cp_slider_settings <> ''){
		$cp_slider = new DOMDocument ();
		$cp_slider->loadXML ( $cp_slider_settings );
		//Bx Slider Values
		$slide_order_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','slide_order_bx');
		$auto_play_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','auto_play_bx');
		if($auto_play_bx == 'enable'){$auto_play_bx = 'true';}else{$auto_play_bx = 'false';}
		$pause_on_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','pause_on_bx');
		if($pause_on_bx == 'enable'){$pause_on_bx = 'true';}else{$pause_on_bx = 'false';}
		$animation_speed_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','animation_speed_bx');
	}
	
	if($slide_order_bx == 'slide'){ $mode_slide = 'mode: horizontal'; }else{$mode_slide = 'mode: fade';}
	if($animation_speed_bx == ''){$animation_speed_bx = '2000';}
	
	
		if(!empty($slider_xml)){
		$slider_html = '<section class="border_slider">';
		$slider_html = $slider_html . '<script type="text/javascript">jQuery(document).ready(function($){var blockexist = $(".post-type-bar");$("#'.$slider_id.'").bxSlider({'.$mode_slide.',minSlides: 1,maxSlides: 1,slideMargin: 0,hideControlOnEnd: true,easing: "swing",auto: '.$auto_play_bx.',autoHover:'.$pause_on_bx.',speed:'.$animation_speed_bx.',onSliderLoad:function(){if(blockexist.length){var para_post = "slider-'.$post->ID.'";equalheight_fun(para_post);}}});});</script>';
			$slider_html = $slider_html . '<ul id="'.$slider_id.'" class="banner_sliderr" >';
				foreach($slider_xml->childNodes as $slider){
					$title = cp_find_xml_value($slider, 'title');
					$caption = html_entity_decode(cp_find_xml_value($slider, 'caption'));
					$link = cp_find_xml_value($slider, 'link');
					$link_type = cp_find_xml_value($slider, 'linktype');
					$btn_txt = cp_find_xml_value($slider, 'btn_txt');
					if(cp_get_width($size) == '5000'){
						$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),'full');
					}else{
						$image_url = wp_get_attachment_image_src(cp_find_xml_value($slider, 'image'),$size);
					}
					$alt_text = get_post_meta(cp_find_xml_value($slider, 'image') , '_wp_attachment_image_alt', true);
					
						$slider_html = $slider_html  .'<li>';
						$slider_html = $slider_html  .'<img src="'. $image_url[0].'" alt=""/>';
						$slider_html = $slider_html  .'<div class="slider_content">';
						$slider_html = $slider_html  .'<a href="'.esc_url($link).'"><h2">'. $title.' </h2></a>';
						$slider_html = $slider_html  .'<span class="clear"></span>';
						$slider_html = $slider_html  .'<p class="b_green"> '. $caption.'</p>';
						$slider_html = $slider_html  .'</div>';
						$slider_html = $slider_html  .'</li>';
				}
				
			$slider_html = $slider_html . '</ul>';
			$slider_html = $slider_html . '</section>';
		
		}
	return $slider_html;
	
	}
	
	function print_post_slider_item($category_id='',$num_post=''){ 
		
		global $counter;
		
		//BX slider
		$slider_html = 'false';
		$slide_order_bx = '';
		$auto_play_bx = '';
		$pause_on_bx = '';
		$animation_speed_bx = '';
		$anchor_hr = '';
		$show_bullets = '';
		$show_arrow = '';
		
		$cp_slider_settings = get_option('slider_settings');
		if($cp_slider_settings <> ''){
			$cp_slider = new DOMDocument ();
			$cp_slider->loadXML ( $cp_slider_settings );
			//Bx Slider Values
			$slide_order_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','slide_order_bx');
			$auto_play_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','auto_play_bx');
			if($auto_play_bx == 'enable'){$auto_play_bx = 'true';}else{$auto_play_bx = 'false';}
			$pause_on_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','pause_on_bx');
			if($pause_on_bx == 'enable'){$pause_on_bx = 'true';}else{$pause_on_bx = 'false';}
			$animation_speed_bx = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','animation_speed_bx');
			$show_bullets = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','show_bullets');
			$show_arrow = find_xml_child_nodes($cp_slider_settings,'bx_slider_settings','show_arrow');
		}
		$mode_slide = '';
		if($slide_order_bx == 'slide'){}else{$mode_slide = "mode: 'fade',";}
		if($animation_speed_bx == ''){$animation_speed_bx = '2000';}
		if($show_bullets == 'enable'){$show_bullets = 'true';}else{$show_bullets = 'false';}
		if($show_arrow == 'enable'){$show_arrow = 'true';}else{$show_arrow = 'false';}
		$mode_slide = "mode: 'fade',";
		$counter = '1';
		$slider_html = '';
		$slider_html .= '<div class="border_slider cp-banner">';
		$slider_html = '<script type="text/javascript">jQuery(document).ready(function($){$("#recent-slider-'.$counter.'").bxSlider({'.$mode_slide.'minSlides: 1,maxSlides: 1,pager:'.$show_bullets.',controls:'.$show_arrow.',hideControlOnEnd: true,easing: "swing",auto: '.$auto_play_bx.',autoHover:'.$pause_on_bx.',speed:'.$animation_speed_bx.',pagerCustom: "#bx_slider_cap"});});</script>';
		$slider_html .= '<ul id="recent-slider-'.$counter.'" class="banner_sliderr" >';
				
			if($category_id == 'all'){
				//Popular Post 
				query_posts(
					array( 
					'post_type' => 'post',
					'posts_per_page' => $num_post,
					'ignore_sticky_posts' 		=> true,
					//'ignore_sticky_posts' => true,
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}else{
				//Popular Post 
				query_posts(
					array( 
					'post_type' => 'post',
					'posts_per_page' => $num_post,					
					'ignore_sticky_posts'=> true,
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'terms' => $category_id,
							'field' => 'term_id',
						)
					),
					'orderby' => 'title',
					'order' => 'ASC' )
				);
			}

				$counter_post = 0;
				while( have_posts() ){
					the_post();
					global $post, $post_id;
					
						$slider_html .= '<li>';
						$slider_html .= get_the_post_thumbnail($post->ID, 'full');
						
						$slider_html .= '
							<div class="caption-2">
								<div class="holder">
									<div class="inner">
										<h1><a href="'.get_permalink().'">'. get_the_title().'</a></h1>
										<div class="banner-row">
											<a href="'.get_permalink().'"><i class="fa fa-user"></i>'.get_the_author().'</a>
											<a href="'.get_permalink().'"><i class="fa fa-calendar"></i>'.get_the_date(get_option('date_format')).'</a>
										</div>
										<p>'. strip_tags(substr(get_the_content(),0,150)).'</p>
										<a class="btn-read" href="'.get_permalink().'">'.esc_html__('Read Post','mosque_crunchpress').'</a>
									</div>
								</div>
							</div>';

						$slider_html .= '</li>';
				}	
				
			$slider_html .= '</ul>';
			
			$slider_html .= '<div class="bx_pager_cp" id="bx_slider_cap">';
				$slider_pagi = 0;
				while( have_posts() ){
					the_post();
					global $post, $post_id;
					
					$slider_html .= '
					<a data-slide-index="'.$slider_pagi.'" href="" class="rollIn animated">
						'.get_the_post_thumbnail($post->ID, array(80,80)).'
					</a>';		
					$slider_pagi++;
				}
			
			
			$slider_html .= '</div>
		</div>';
		wp_reset_query();
		wp_reset_postdata();
		return $slider_html;
	
	}