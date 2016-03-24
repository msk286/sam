<?php

function optimatec_enqueue_style() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [ ] );
	wp_enqueue_style( 'freelancer', get_template_directory_uri() . '/css/freelancer.css', [ 'bootstrap' ] );
	wp_enqueue_style( 'fa', get_template_directory_uri() . 'font-awesome/css/font-awesome.min.css', [ 'bootstrap' ] );
	wp_enqueue_style( 'google-font-Montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700', [ ] );
	wp_enqueue_style( 'google-font-Lato', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic', [ ] );

	wp_enqueue_style( 'core', 'style.css', false );
}

//function themeslug_enqueue_script() {
//	wp_enqueue_script( 'my-js', 'filename.js', false );
//}

add_action( 'wp_enqueue_scripts', 'optimatec_enqueue_style' );
//add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );


$defaults = [
	'theme_location' => 'primary',
	'menu'           => 'primary',
	'container_id'   => 'div',
	'menu_class'     => 'foobar',
	'menu_id'        => 'baz',
	'echo'           => true,
	'fallback_cb'    => 'wp_page_menu',
	'before'         => '',
	'after'          => '',
	'link_before'    => '',
	'link_after'     => '',
	'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'          => 0,
	'walker'         => '',
];

wp_nav_menu( $defaults );