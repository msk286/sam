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
	
add_action('wp_ajax_newsletter_settings','newsletter_settings');
function newsletter_settings(){
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars variable on the server.');?>
	<div class="cp-wrapper bootstrap_admin cp-margin-left"> 

    <!--content area start -->	  
	<div class="hbg top_navigation row-fluid">
		<div class="cp-logo span2">
			<img src="<?php echo CP_PATH_URL;?>/framework/images/logo.png" class="logo" />
		</div>
		<div class="sidebar span10">
			<?php echo cp_top_navigation_html_tooltip();?>
		</div>
	 <?php //echo cp_top_navigation_html(); ?>
	</div>
	<div class="content-area-main row-fluid"> 
	
      <!--sidebar start -->
      <div class="sidebar-wraper span2">
        <div class="sidebar-sublinks">
   <ul id="wp_t_o_right_menu">
				<li id="active_tab" class="news_letter" ><?php esc_html_e('Newsletter Settings', 'mosque_crunchpress'); ?></li>
			</ul>
        </div>
      </div>
      <!--sidebar end --> 
      <!--content start -->
      <div class="content-area span10">
	  <?php //echo cp_top_navigation_html(); ?>
        <form id="options-panel-form" name="cp-panel-form">
          <div class="panel-elements" id="panel-elements">
            <div class="panel-element" id="panel-element-save-complete">
              <div class="panel-element-save-text">
                <?php esc_html_e('Save Options Complete', 'mosque_crunchpress'); ?>
                .</div>
              <div class="panel-element-save-arrow"></div>
            </div>
            <div class="panel-element">
				<?php
				if(isset($action) AND $action == 'newsletter_settings'){
					$newsletter_xml = '<newsletter_settings>';
					$newsletter_xml = $newsletter_xml . create_xml_tag('newsletter_config',$newsletter_config);
					$newsletter_xml = $newsletter_xml . create_xml_tag('feed_burner_text',$feed_burner_text);
					$newsletter_xml = $newsletter_xml . '</newsletter_settings>';

					if(!save_option('newsletter_settings', get_option('newsletter_settings'), $newsletter_xml)){
					
						die( json_encode($return_data) );
						
					}
					
					die( json_encode( array('success'=>'0') ) );
					
				}
				$newsletter_config = '';
				$feed_burner_text = '';
				$cp_newsletter_settings = get_option('newsletter_settings');
				if($cp_newsletter_settings <> ''){
					$cp_newsletter = new DOMDocument ();
					$cp_newsletter->loadXML ( $cp_newsletter_settings );
					$newsletter_config = cp_find_xml_value($cp_newsletter->documentElement,'newsletter_config');
					$feed_burner_text = cp_find_xml_value($cp_newsletter->documentElement,'feed_burner_text');
				}
				?>
			</div>
				<ul class="newsletter_class">
					<li id="news_letter" class="active_tab">
						<ul class="feedburner_id recipe_class row-fluid">
							<li class="panel-input span8">
								<span class="panel-title">
									<h3> <?php esc_html_e('Feed Burner ID', 'mosque_crunchpress'); ?> </h3>
								</span>
								<input type="text" name="feed_burner_text" id="feed_burner_text" value="<?php if($feed_burner_text <> ''){echo esc_attr($feed_burner_text);};?>" />
							</li>
							<li class="right-box-sec span4"><?php esc_html_e('Please enter your google feed burner id in text field.','mosque_crunchpress');?></li>
						</ul>
					</li>				
				</ul>
				
            <div class="panel-element-tail">
              <div class="tail-save-changes">
                <div class="loading-save-changes"></div>
                <input type="submit" value="<?php echo esc_html__('Save Changes','mosque_crunchpress') ?>">
                <input type="hidden" name="action" value="newsletter_settings">
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
