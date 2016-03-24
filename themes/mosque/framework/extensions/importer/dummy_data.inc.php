<?php
/** 
     * @author Roy Stone
     * @copyright roshi[www.themeforest.net/user/crunchpress]
     * @version 2013
     */

if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

require_once ABSPATH . 'wp-admin/includes/import.php';
$import_filepath = get_template_directory()."/framework/extensions/importer/".$cp_layout;
$errors = false;
if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) )
	{
		require_once($class_wp_importer);
	}
	else
	{
		$errors = true;
	}
}
if ( !class_exists( 'WP_Import' ) ) {
	$wp_importer = CP_FW. '/extensions/importer/wordpress-importer.php';
	if ( file_exists( $wp_importer ) )
	{
		require_once($wp_importer);
	}
	else
	{
		$errors = true;
	}
}

if($errors){
   echo "Errors while loading classes. Please use the standard wordpress importer."; 
}else{
    
	include_once('default_dummy_data.inc.php');
	if(!is_file($import_filepath.'.xml'))
	{
		echo "Problem with dummy data file. Please check the permissions of the xml file";
	}
	else
	{  
	   if(class_exists( 'WP_Import' )){
	       global $wp_version;
			$cp_dummy_data = new cp_dummy_data();
			$cp_dummy_data->wp_reset_init($import_filepath.'.xml',$cp_layout.'.xml');
			$cp_dummy_data->cp_default_widgets_settings($cp_layout.'.xml');			
        }
	}    
}


?>