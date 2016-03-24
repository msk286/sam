<?php

function cldd_register_my_settings_menu_page(){

  // add_menu_page(
  //   $page_title,
  //   $menu_title,
  //   $capability,
  //   $menu_slug,
  //   $function,
  //   $icon_url,
  //   $position
  // );
  add_menu_page(
    'My Settings',
    'My Settings',
    'manage_options',
    'my_settings',
    'cldd_my_settings_page',
    'dashicons-admin-generic',
    81
  );

}

add_action( 'admin_menu','cldd_register_my_settings_menu_page' );


function cldd_my_settings_page(){
  echo "This is my settings page view ";
}

?>
