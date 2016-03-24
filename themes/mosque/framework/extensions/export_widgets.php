<?php
/** Load WordPress Bootstrap */
require_once('../../../../../wp-load.php');
	global $wpdb;
	header("Content-Type: text/plain");
	header( 'Content-Disposition: attachment; filename=aaa.txt');
		
	function get_widget_area(){
		$development = get_option('sidebars_widgets');
		unset($development['array_version']);
			foreach($development as $key=>$value){
				$newval = str_replace('wp_inactive_widgets','',$key);
				$widgets[] = str_replace('orphaned_widgets_1','',$newval);
			}
			return array_filter($widgets);
			
	}
	
	function str_before($subject, $needle)
	{
		$p = strpos($subject, $needle);
		return substr($subject, 0, $p);
	}
	
	
	function get_widget_name_value(){
		$development_myval = get_option('sidebars_widgets');
		foreach(get_widget_area() as $val){
			foreach($development_myval[$val] as $keys=>$values){
				$string_val = str_before($values, "-");
				$wid_val[$string_val] = 'widget_'.$string_val;
			}
			
		}
		return $wid_val;
			
	}
	
	echo '<pre>';	
	foreach(get_widget_name_value() as $keys=>$values){
		echo '$widget_'.$keys.' = ';
		echo var_export(get_option($values)).';';
	}
	
	echo '$sidebars_widgets=';
	var_export(get_option('sidebars_widgets')).';';
	
	echo '$show_on_front = ';
	echo get_option('show_on_front').';';
	
	echo '$page_on_front = ';
	echo get_option('page_on_front').';';
	
	$theme_name = 'theme_mods_'.get_option('template');
	echo '$'.$theme_name.' = ';
	var_export(get_option($theme_name)).';';
	
	echo '</pre>';
	
	echo '<pre>';
	//Default Page Settings	
	echo "if(get_option('default_pages_settings') == ''){";
	echo '$default_pages_xml = "' . get_option('default_pages_settings').'";';
		echo "save_option('default_pages_settings', get_option('default_pages_settings'),";echo "$";echo "default_pages_xml"; echo ");";
	echo '}';
	
	//Default Page Settings	
	echo "if(get_option('general_settings') == ''){";
	echo '$general_settings = "' . get_option('general_settings').'";';
		echo "save_option('general_settings', get_option('general_settings'),";echo "$";echo "general_settings"; echo ");";
	echo '}';
	
	//Default Page Settings	
	echo "if(get_option('typography_settings') == ''){";
	echo '$typography_settings = "' . get_option('typography_settings').'";';
		echo "save_option('typography_settings', get_option('typography_settings'),";echo "$";echo "typography_settings"; echo ");";
	echo '}';
	
	
	//Default Page Settings	
	echo "if(get_option('slider_settings') == ''){";
	echo '$slider_settings = "' . get_option('slider_settings').'";';
		echo "save_option('slider_settings', get_option('slider_settings'),";echo "$";echo "slider_settings"; echo ");";
	echo '}';
	
	
	//Default Page Settings	
	echo "if(get_option('social_settings') == ''){";
	echo '$social_settings = "' . get_option('social_settings').'";';
		echo "save_option('social_settings', get_option('social_settings'),";echo "$";echo "social_settings"; echo ");";
	echo '}';
	
	//Default Page Settings	
	echo "if(get_option('sidebar_settings') == ''){";
	echo '$sidebar_settings = "' . get_option('sidebar_settings').'";';
		echo "save_option('sidebar_settings', get_option('sidebar_settings'),";echo "$";echo "sidebar_settings"; echo ");";
	echo '}';
	
	
	
	
	echo '</pre>';
?>
