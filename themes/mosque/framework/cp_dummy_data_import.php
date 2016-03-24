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
	

add_action('wp_ajax_dummydata_import','dummydata_import');
function dummydata_import(){
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	$select_dummy_layout = '';
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
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
					<li class="news_letter" id="active_tab"><?php esc_html_e('Dummy Content Settings', 'mosque_crunchpress'); ?></li>
				</ul>
        </div>
      </div>
      <!--sidebar end --> 
		<div class="content-area span10">
		
			<div class="wrapper_right">
				<ul class="cp_class_dummy">
					<li id="news_letter" class="active_tab">
						<ul class="cp_dummy recipe_class row-fluid">
							<li class="panel-input span8">
								<span class="panel-title">
									<h3><?php esc_html_e('Import Dummy Content', 'mosque_crunchpress'); ?> </h3>
									<p><?php esc_html_e('*Important Note* ---:  We Suggest you to install fresh WordPress 
									and then run this importer after required configuration, in order to use this feature 
									all the previous data will be deleted and then this import will import dummy data into your site.
									*--Make sure you have taken the proper backup of your important data before using this option.
									**--Do Refresh This Page, Before 2nd Attempt of Import.','mosque_crunchpress');?></p>
								</span>
								<input type="hidden" id="cp_nonce_dummy" value="<?php echo wp_create_nonce ('cp_nonce_dummy');?>" name="cp_nonce_dummy" />
								<a class="cp_import_dummy"><?php esc_html_e('Import Content', 'mosque_crunchpress'); ?></a>
								<input type="hidden" value="<?php echo admin_url("admin-ajax.php");?>" name="admin_ajax_url" />						
								<span class="loading"></span>
							</li>
							<li class="span4 right-box-sec"><p><?php esc_html_e('Click on Import button to import your theme dummy content, After Clicking here Dummy Data will be imported. *Note*: If dummy content display any error please make sure your Allowed memory size greater than 64MB.','mosque_crunchpress');?></p></li>
						</ul>
					</li>
				</ul>	
			</div>	
		</div>
	</div>				
</div>		
	<?php
}	



?>
