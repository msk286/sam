<?php session_start();?>
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
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">		
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Philosopher:400,700" media="screen">
	<?php
		global $post_id,$post;
		//Favicon
		$cp_header_favicon = cp_get_themeoption_value('header_favicon','general_settings');
		$cp_header_fav_link = cp_get_themeoption_value('header_fav_link','general_settings');
		if($cp_header_favicon <> '' && $cp_header_fav_link <> ''){
			/* For WordPress 4.3 or Later Only*/
			if ( ! function_exists( 'wp_site_icon' ) || ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
				// Output old, custom favicon feature.
				echo '<link rel="shortcut icon" href="'.esc_url($cp_header_fav_link).'" />';
			}	
		}
		wp_head(); ?>
</head>
<body id="home" <?php body_class(); ?>>
	<!--Wrapper Start-->
	<div id="wrapper" class="wrapper">
     <div class="sidy">
		<?php 
		//Print Header
		global $post, $post_id;	
		if(is_search() || is_404()){	
			$cp_header_style = '';		
		}else{
			$cp_header_style = get_post_meta ( $post->ID, "page-option-top-header-style", true );		
		}				
		if(cp_print_header_html_val($cp_header_style) <> 'Style 5'){			
			cp_print_header_html($cp_header_style);		
		}
		

?>