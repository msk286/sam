<?php

	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
add_action('wp_ajax_default_pages_settings','default_pages_settings');
function default_pages_settings(){
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}

	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');					

	?>

	<div class="cp-wrapper bootstrap_admin cp-margin-left"> 

    <!--content area start -->	  
	<div class="hbg top_navigation row-fluid">
		<div class="cp-logo span2">
			<img src="<?php echo CP_PATH_URL;?>/framework/images/logo.png" class="logo" />
		</div>
		<div class="sidebar span10">
			<?php echo cp_top_navigation_html_tooltip();?>
		</div>
	
	</div>
	<div class="content-area-main row-fluid"> 
	
      <!--sidebar start -->
      <div class="sidebar-wraper span2">
        <div class="sidebar-sublinks">
			<ul id="wp_t_o_right_menu">
					<li id="active_tab" class="default_pages"><?php esc_html_e('Default Pages Settings', 'mosque_crunchpress'); ?></li>
			</ul>
        </div>
      </div>
      <!--sidebar end --> 
      <!--content start -->
      <div class="content-area span10 default_cate_sec">
        <form id="options-panel-form" name="cp-panel-form">
          <div class="panel-elements" id="panel-elements">
            <div class="panel-element" id="panel-element-save-complete">
              <div class="panel-element-save-text"><?php esc_html_e('Save Options Complete', 'mosque_crunchpress'); ?>.</div>
              <div class="panel-element-save-arrow"></div>
            </div>
            <div class="panel-element">
			<?php
			if(isset($action) AND $action == 'default_pages_settings'){
				$default_pages_xml = '<default_pages_settings>';
				$default_pages_xml = $default_pages_xml . create_xml_tag('sidebar_default',$sidebars);
				$default_pages_xml = $default_pages_xml . create_xml_tag('right_sidebar_default',$right_sidebar_default);
				$default_pages_xml = $default_pages_xml . create_xml_tag('left_sidebar_default',$left_sidebar_default);
				$default_pages_xml = $default_pages_xml . create_xml_tag('default_excerpt',$default_excerpt);
				$default_pages_xml = $default_pages_xml . '</default_pages_settings>';

				if(!save_option('default_pages_settings', get_option('default_pages_settings'), $default_pages_xml)){
				
					die( json_encode($return_data) );
					
				}
				
				die( json_encode( array('success'=>'0') ) );
				
			}
			$sidebar_default = '';
			$right_sidebar_default = '';
			$left_sidebar_default = '';
			$default_excerpt = '';
			$cp_default_settings = get_option('default_pages_settings');
				if($cp_default_settings <> ''){
					$cp_default = new DOMDocument ();
					$cp_default->loadXML ( $cp_default_settings );
					$sidebar_default = cp_find_xml_value($cp_default->documentElement,'sidebar_default');
					$right_sidebar_default = cp_find_xml_value($cp_default->documentElement,'right_sidebar_default');
					$left_sidebar_default = cp_find_xml_value($cp_default->documentElement,'left_sidebar_default');
					$default_excerpt = cp_find_xml_value($cp_default->documentElement,'default_excerpt');
					
				}
			?>	
			</div>
			<h3> <?php esc_html_e('Category Pages, Search, Archives, Taxonomy, Tags.','mosque_crunchpress');?> </h3>
			<div class="sidebar_default_sec">
				<?php echo show_sidebar($sidebar_default,'right_sidebar_default','left_sidebar_default',$right_sidebar_default,$left_sidebar_default);?>
			</div>
			
			<ul class="default_excerpt recipe_class row-fluid">
				<li class="panel-input span8">
					<span class="panel-title">
						<h3 for="default_excerpt" > <?php esc_html_e('Default Excerpt', 'mosque_crunchpress'); ?> </h3>
					</span>	
					<input type="text" name="default_excerpt" id="default_excerpt" value="<?php if($default_excerpt <> ''){echo esc_attr($default_excerpt);};?>" />
				</li>
				<li class="description span4"><p><?php esc_html_e('Please Paste Your Default Excerpt(Number of words).','mosque_crunchpress');?></p></li>
			</ul>
  
            <div class="panel-element-tail">
              <div class="tail-save-changes">
                <div class="loading-save-changes"></div>
                <input type="submit" value="<?php echo esc_html__('Save Changes','mosque_crunchpress') ?>">
                <input type="hidden" name="action" value="default_pages_settings">
              </div>
            </div>
          </div>
        </form>
      </div>
      <!--content End --> 
    </div>
    <!--content area end --> 
  </div>
	<?php
}	
?>
