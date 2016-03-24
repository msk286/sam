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
	
add_action('wp_ajax_social_settings','social_settings');
function social_settings(){
		
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
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
					<li class="social_networking" id="active_tab"><?php esc_html_e('Social Networking', 'mosque_crunchpress'); ?></li>
					<li class="social_sharing"><?php esc_html_e('Social Sharing', 'mosque_crunchpress'); ?></li>
				</ul>
        </div>
      </div>
		  <!--sidebar end --> 
		  <!--content start -->
		  <div class="content-area span10">
		 
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
			//Social Sharing and Networking Values Saving as XML 
			if(isset($action) AND $action == 'social_settings'){
				$social_xml = '<social_settings>';
				$social_xml = $social_xml . create_xml_tag('facebook_network',htmlspecialchars(stripslashes($facebook_network)));
				$social_xml = $social_xml . create_xml_tag('twitter_network',htmlspecialchars(stripslashes($twitter_network)));
				$social_xml = $social_xml . create_xml_tag('delicious_network',htmlspecialchars(stripslashes($delicious_network)));
				$social_xml = $social_xml . create_xml_tag('google_plus_network',htmlspecialchars(stripslashes($google_plus_network)));
				$social_xml = $social_xml . create_xml_tag('linked_in_network',htmlspecialchars(stripslashes($linked_in_network)));
				$social_xml = $social_xml . create_xml_tag('youtube_network',htmlspecialchars(stripslashes($youtube_network)));
				$social_xml = $social_xml . create_xml_tag('flickr_network',htmlspecialchars(stripslashes($flickr_network)));
				$social_xml = $social_xml . create_xml_tag('vimeo_network',htmlspecialchars(stripslashes($vimeo_network)));
				$social_xml = $social_xml . create_xml_tag('pinterest_network',htmlspecialchars(stripslashes($pinterest_network)));
				$social_xml = $social_xml . create_xml_tag('Instagram_network',htmlspecialchars(stripslashes($Instagram_network)));
				$social_xml = $social_xml . create_xml_tag('github_network',htmlspecialchars(stripslashes($github_network)));
				$social_xml = $social_xml . create_xml_tag('skype_network',htmlspecialchars(stripslashes($skype_network)));
				

				//Social Sharing
				$social_xml = $social_xml . create_xml_tag('facebook_sharing',htmlspecialchars(stripslashes($facebook_sharing)));
				$social_xml = $social_xml . create_xml_tag('twitter_sharing',htmlspecialchars(stripslashes($twitter_sharing)));
				$social_xml = $social_xml . create_xml_tag('stumble_sharing',htmlspecialchars(stripslashes($stumble_sharing)));
				$social_xml = $social_xml . create_xml_tag('delicious_sharing',htmlspecialchars(stripslashes($delicious_sharing)));
				$social_xml = $social_xml . create_xml_tag('googleplus_sharing',htmlspecialchars(stripslashes($googleplus_sharing)));
				$social_xml = $social_xml . create_xml_tag('digg_sharing',htmlspecialchars(stripslashes($digg_sharing)));
				$social_xml = $social_xml . create_xml_tag('myspace_sharing',htmlspecialchars(stripslashes($myspace_sharing)));
				$social_xml = $social_xml . create_xml_tag('reddit_sharing',htmlspecialchars(stripslashes($reddit_sharing)));
				$social_xml = $social_xml . '</social_settings>';

				if(!save_option('social_settings', get_option('social_settings'), $social_xml)){
				
					die( json_encode($return_data) );
					
				}
				
				die( json_encode( array('success'=>'0') ) );
				
			}
			//Social Networking
			$facebook_network = '';
			$twitter_network = '';
			$delicious_network = '';
			$google_plus_network = '';
			$su_network = '';
			$linked_in_network = '';
			$digg_network = '';
			$myspace_network = '';
			$reddit_network = '';
			$youtube_network = '';
			$flickr_network = '';
			$picasa_network = '';
			$vimeo_network = '';
			$pinterest_network = '';
			$Instagram_network = '';
			$github_network = '';
			$skype_network = '';
			
			//Social Sharing 
			$facebook_sharing = '';
			$twitter_sharing = '';
			$stumble_sharing = '';
			$delicious_sharing = '';
			$googleplus_sharing = '';
			$digg_sharing = '';
			$myspace_sharing = '';
			$reddit_sharing = '';		
			
			//Getting Values from database
			$cp_social_settings = get_option('social_settings');
			if($cp_social_settings <> ''){
				$cp_social = new DOMDocument();
				$cp_social->loadXML ( $cp_social_settings );
				
				//Social Networking Values
				$facebook_network = cp_find_xml_value($cp_social->documentElement,'facebook_network');
				$twitter_network = cp_find_xml_value($cp_social->documentElement,'twitter_network');
				$delicious_network = cp_find_xml_value($cp_social->documentElement,'delicious_network');
				$google_plus_network = cp_find_xml_value($cp_social->documentElement,'google_plus_network');
				$linked_in_network = cp_find_xml_value($cp_social->documentElement,'linked_in_network');
				$youtube_network = cp_find_xml_value($cp_social->documentElement,'youtube_network');
				$vimeo_network = cp_find_xml_value($cp_social->documentElement,'vimeo_network');
				$pinterest_network = cp_find_xml_value($cp_social->documentElement,'pinterest_network');
				
				
				// Social Sharing Values
				$facebook_sharing = cp_find_xml_value($cp_social->documentElement,'facebook_sharing');
				$twitter_sharing = cp_find_xml_value($cp_social->documentElement,'twitter_sharing');
				$stumble_sharing = cp_find_xml_value($cp_social->documentElement,'stumble_sharing');
				$delicious_sharing = cp_find_xml_value($cp_social->documentElement,'delicious_sharing');
				$googleplus_sharing = cp_find_xml_value($cp_social->documentElement,'googleplus_sharing');
				$digg_sharing = cp_find_xml_value($cp_social->documentElement,'digg_sharing');
				$myspace_sharing = cp_find_xml_value($cp_social->documentElement,'myspace_sharing');
				$reddit_sharing = cp_find_xml_value($cp_social->documentElement,'reddit_sharing');
				
			}
			?>
				
				</div>
						<ul class="social_networking">
							<!--Social Networking Start -->
							<li id="social_networking" class="social_network_class active_tab">
								<div class="row-fluid">
									<ul class="panel-body recipe_class span4">											
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="facebook_network" > <?php esc_html_e('Facebook', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<input type="text" name="facebook_network" id="facebook_network" value="<?php if($facebook_network <> ''){echo esc_url($facebook_network);};?>" />
											<div class="admin-social-image">
												<span class="facebook"><i class="fa fa-facebook"></i></span>
											</div>
											<p><?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?></p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span4">
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="twitter_network" > <?php esc_html_e('Twitter', 'mosque_crunchpress'); ?> </h3>
											</span>
											<input type="text" name="twitter_network" id="twitter_network" value="<?php if($twitter_network <> ''){echo esc_url($twitter_network);};?>" />
											<div class="admin-social-image">
												<span class="twitter"><i class="fa fa-twitter"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span4">	
										<li class="panel-input full-width">
											<span class="panel-title">
												<h3 for="delicious_network" > <?php esc_html_e('Delicious', 'mosque_crunchpress'); ?> </h3>
											</span>
											<input type="text" name="delicious_network" id="delicious_network" value="<?php if($delicious_network <> ''){echo esc_url($delicious_network);};?>" />
											<div class="admin-social-image">
												<span class="delicious"><i class="fa fa-delicious"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?></p> 
										</li>
									</ul>
								</div>
								<div class="row-fluid">
									<ul class="panel-body recipe_class span4">												
										<li class="panel-input full-width ">
											<span class="panel-title">
												<h3 for="google_plus_network" > <?php esc_html_e('Google Plus', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<input type="text" name="google_plus_network" id="google_plus_network" value="<?php if($google_plus_network <> ''){echo esc_url($google_plus_network);};?>" />
											<div class="admin-social-image">
												<span class="googleplus"><i class="fa fa-google-plus"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>

									<ul class="panel-body recipe_class span4">
												
										<li class="panel-input full-width ">
											<span class="panel-title">
											<h3 for="linked_in_network" > <?php esc_html_e('Linked In', 'mosque_crunchpress'); ?> </h3>
										</span>	
											<input type="text" name="linked_in_network" id="linked_in_network" value="<?php if($linked_in_network <> ''){echo esc_url($linked_in_network);};?>" />
											<div class="admin-social-image">
												<span class="linkedin"><i class="fa fa-linkedin"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>
							
									
									<ul class="panel-body recipe_class span4">
														
										<li class="panel-input full-width">
										<span class="panel-title">
											<h3 for="youtube_network" > <?php esc_html_e('Youtube', 'mosque_crunchpress'); ?> </h3>
										</span>
											<input type="text" name="youtube_network" id="youtube_network" value="<?php if($youtube_network <> ''){echo esc_url($youtube_network);};?>" />
											<div class="admin-social-image">
												<span class="youtube"><i class="fa fa-youtube"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>
								</div>
								<div class="row-fluid">
									<ul class="panel-body recipe_class span4">
													
										<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="flickr_network" > <?php esc_html_e('Flickr', 'mosque_crunchpress'); ?> </h3>
										</span>	
											<input type="text" name="flickr_network" id="flickr_network" value="<?php if($flickr_network <> ''){echo esc_url($flickr_network);};?>" />
											<div class="admin-social-image">
												<span class="flickr"><i class="fa fa-flickr"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>
									
								
									<ul class="panel-body recipe_class span4">
											
										<li class="panel-input full-width ">
											<span class="panel-title">
											<h3 for="vimeo_network" > <?php esc_html_e('Vimeo', 'mosque_crunchpress'); ?> </h3>
										</span>		
											<input type="text" name="vimeo_network" id="vimeo_network" value="<?php if($vimeo_network <> ''){echo esc_url($vimeo_network);};?>" />
											<div class="admin-social-image">
												<span class="vimeo"><i class="fa fa-vimeo-square"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span4">
													
										<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="pinterest_network" > <?php esc_html_e('Pinterest', 'mosque_crunchpress'); ?> </h3>
										</span>	
											<input type="text" name="pinterest_network" id="pinterest_network" value="<?php if($pinterest_network <> ''){echo esc_url($pinterest_network);};?>" />
											<div class="admin-social-image">
												<span class="pinterest"><i class="fa fa-pinterest"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>	
								</div>
								<div class="row-fluid">
									<ul class="panel-body recipe_class span4">
													
										<li class="panel-input full-width ">
										<span class="panel-title">
											<h3> <?php esc_html_e('Instagram', 'mosque_crunchpress'); ?> </h3>
										</span>	
											<input type="text" name="Instagram_network" id="Instagram_network" value="<?php if($Instagram_network <> ''){echo esc_url($Instagram_network);};?>" />
											<div class="admin-social-image">
												<span class="instagram"><i class="fa fa-instagram"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span4">
										<li class="panel-input full-width ">
											<span class="panel-title">
											<h3> <?php esc_html_e('Github', 'mosque_crunchpress'); ?> </h3>
										</span>		
											<input type="text" name="github_network" id="github_network" value="<?php if($github_network <> ''){echo esc_url($github_network);};?>" />
											<div class="admin-social-image">
												<span class="github"><i class="fa fa-github"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span4">
										<li class="panel-input full-width ">
										<span class="panel-title">
											<h3> <?php esc_html_e('Skype', 'mosque_crunchpress'); ?> </h3>
										</span>	
											<input type="text" name="skype_network" id="skype_network" value="<?php if($skype_network <> ''){echo esc_url($skype_network);};?>" />
											<div class="admin-social-image">
												<span class="skype"><i class="fa fa-skype"></i></span>
											</div>
											<p> <?php esc_html_e('Please paste your Profile URl','mosque_crunchpress');?> </p>
										</li>
									</ul>	
								</div>
							</li>
							<!--Social Sharing Start -->
							<li id="social_sharing" class="social_sharing_class">
								<div class="row-fluid">
									<ul class="panel-body recipe_class span4">
										<li class="panel-input full-width ">
											<span class="panel-title">
												<h3 for="facebook_sharing" > <?php esc_html_e('FACEBOOK SHARING', 'mosque_crunchpress'); ?> </h3>
											</span>
											<label for="facebook_sharing">
												<div class="checkbox-switch <?php echo ($facebook_sharing=='enable' || ($facebook_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="facebook_sharing" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="facebook_sharing" id="facebook_sharing" class="checkbox-switch" value="enable" <?php	echo ($facebook_sharing=='enable' || ($facebook_sharing==''))? 'checked': '';?>>
											<div class="admin-social-image">
												<span class="facebook">&nbsp;</span>
											</div>
											<p> <?php esc_html_e('Please turn On/Off sharing on post detail page.','mosque_crunchpress');?></p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span4">
										<li class="panel-input full-width ">
											<span class="panel-title">
												<h3 for="twitter_sharing" > <?php esc_html_e('TWITTER SHARING', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<label for="twitter_sharing">
												<div class="checkbox-switch <?php echo ($twitter_sharing=='enable' || ($twitter_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="twitter_sharing" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="twitter_sharing" id="twitter_sharing" class="checkbox-switch" value="enable" <?php	echo ($twitter_sharing=='enable' || ($twitter_sharing==''))? 'checked': '';?>>
											<div class="admin-social-image">
												<span class="twitter">&nbsp;</span>
											</div>
											<p> <?php esc_html_e('Please turn On/Off sharing on post detail page.','mosque_crunchpress');?> </p>
										</li>
									</ul>												
									<ul class="panel-body recipe_class span4">
										<li class="panel-input full-width ">
											<span class="panel-title">
												<h3 for="stumble_sharing" > <?php esc_html_e('STUMBLEUPON SHARING', 'mosque_crunchpress'); ?> </h3>
											</span>
											<label for="stumble_sharing">
												<div class="checkbox-switch <?php echo ($stumble_sharing=='enable' || ($stumble_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="stumble_sharing" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="stumble_sharing" id="stumble_sharing" class="checkbox-switch" value="enable" <?php	echo ($stumble_sharing=='enable' || ($stumble_sharing==''))? 'checked': '';?>>
											<div class="admin-social-image">
												<span class="stumble">&nbsp;</span>
											</div>
											<p> <?php esc_html_e('Please turn On/Off sharing on post detail page.','mosque_crunchpress');?> </p>
										</li>
									</ul>
								</div>	
								<div class="row-fluid">							
									<ul class="panel-body recipe_class span4">									
										<li class="panel-input full-width ">
											<span class="panel-title">
												<h3 for="delicious_sharing" > <?php esc_html_e('DELICIOUS SHARING', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<label for="delicious_sharing">
												<div class="checkbox-switch <?php echo ($delicious_sharing=='enable' || ($delicious_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="delicious_sharing" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="delicious_sharing" id="delicious_sharing" class="checkbox-switch" value="enable" <?php	echo ($delicious_sharing=='enable' || ($delicious_sharing==''))? 'checked': '';?>>
											<div class="admin-social-image">
												<span class="delicious">&nbsp;</span>
											</div>
											<p> <?php esc_html_e('Please turn On/Off sharing on post detail page.','mosque_crunchpress');?></p>
										</li>
									</ul>											
									<ul class="panel-body recipe_class span4">
											
										<li class="panel-input full-width ">
										<span class="panel-title">
											<h3 for="googleplus_sharing" > <?php esc_html_e('GOOGLE PLUS SHARING', 'mosque_crunchpress'); ?> </h3>
										</span>
											<label for="googleplus_sharing">
												<div class="checkbox-switch <?php echo ($googleplus_sharing=='enable' || ($googleplus_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="googleplus_sharing" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="googleplus_sharing" id="googleplus_sharing" class="checkbox-switch" value="enable" <?php	echo ($googleplus_sharing=='enable' || ($googleplus_sharing==''))? 'checked': '';?>>
											<div class="admin-social-image">
												<span class="googleplus">&nbsp;</span>
											</div>
											<p> <?php esc_html_e('Please turn On/Off sharing on post detail page.','mosque_crunchpress');?> </p>
										</li>
										
									</ul>											
									<ul class="panel-body recipe_class span4">
										<li class="panel-input full-width ">
											<span class="panel-title">
												<h3 for="digg_sharing" > <?php esc_html_e('DIGG SHARING', 'mosque_crunchpress'); ?> </h3>
											</span>
											<label for="digg_sharing">
												<div class="checkbox-switch <?php echo ($digg_sharing=='enable' || ($digg_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="digg_sharing" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="digg_sharing" id="digg_sharing" class="checkbox-switch" value="enable" <?php	echo ($digg_sharing=='enable' || ($digg_sharing==''))? 'checked': '';?>>
											<div class="admin-social-image">
												<span class="digg">&nbsp;</span>
											</div>
											<p> <?php esc_html_e('Please turn On/Off sharing on post detail page.','mosque_crunchpress');?></p>
										</li>
									</ul>
								</div>	
								<div class="row-fluid">										
									<ul class="panel-body recipe_class span4">									
										<li class="panel-input full-width ">
											<span class="panel-title">
												<h3 for="myspace_sharing" > <?php esc_html_e('MYSPACE SHARING', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<label for="myspace_sharing">
												<div class="checkbox-switch <?php echo ($myspace_sharing=='enable' || ($myspace_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="myspace_sharing" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="myspace_sharing" id="myspace_sharing" class="checkbox-switch" value="enable" <?php	echo ($myspace_sharing=='enable' || ($myspace_sharing==''))? 'checked': '';?>>
											<div class="admin-social-image">
												<span class="myspace">&nbsp;</span>
											</div>
											<p> <?php esc_html_e('Please turn On/Off sharing on post detail page.','mosque_crunchpress');?> </p>
										</li>
									</ul>
									<ul class="panel-body recipe_class span4">
										<li class="panel-input full-width ">
											<span class="panel-title">
												<h3 for="reddit_sharing" > <?php esc_html_e('REDDIT SHARING', 'mosque_crunchpress'); ?> </h3>
											</span>	
											<label for="reddit_sharing">
												<div class="checkbox-switch <?php echo ($reddit_sharing=='enable' || ($reddit_sharing==''))? 'checkbox-switch-on': 'checkbox-switch-off';?>"></div>
											</label>
											<input type="checkbox" name="reddit_sharing" class="checkbox-switch" value="disable" checked>
											<input type="checkbox" name="reddit_sharing" id="reddit_sharing" class="checkbox-switch" value="enable" <?php	echo ($reddit_sharing=='enable' || ($reddit_sharing==''))? 'checked': '';?>>
											<div class="admin-social-image">
												<span class="reddit">&nbsp;</span>
											</div>
											<p> <?php esc_html_e('Please turn On/Off sharing on post detail page.','mosque_crunchpress');?> </p>
										</li>
									</ul>
								</div>							
							</li>
					
					<div class="panel-element-tail">
						<div class="tail-save-changes">
							<div class="loading-save-changes"></div>
							<input type="submit" value="<?php echo esc_html__('Save Changes','mosque_crunchpress') ?>">
							<input type="hidden" name="action" value="social_settings">
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