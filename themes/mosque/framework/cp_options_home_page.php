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
function table_exists ($table, $db) { 
	$tables = mysql_list_tables ($db); 
	while (list ($temp) = mysql_fetch_array ($tables)) {
		if ($temp == $table) {
			return TRUE;
		}
	}
	return FALSE;
}


add_action('wp_ajax_homepage_settings','homepage_settings');
function homepage_settings(){
		
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
			<?php 
				if(isset($action) AND $action == 'homepage_settings'){
					$homepage_xml = '<homepage_settings>';
					$homepage_xml = $homepage_xml . create_xml_tag('homepage_newsline_on',$homepage_newsline_on);
					$homepage_xml = $homepage_xml . create_xml_tag('header_headline',htmlspecialchars(stripslashes($header_headline)));
					$homepage_xml = $homepage_xml . create_xml_tag('section_headline_category',$section_headline_category);
					$homepage_xml = $homepage_xml . create_xml_tag('homepage_twitter_on',$homepage_twitter_on);
					$homepage_xml = $homepage_xml . create_xml_tag('header_twitter',htmlspecialchars(stripslashes($header_twitter)));
					$homepage_xml = $homepage_xml . create_xml_tag('consumer_key',$consumer_key);
					$homepage_xml = $homepage_xml . create_xml_tag('consumer_secret',$consumer_secret);
					$homepage_xml = $homepage_xml . create_xml_tag('user_token',$user_token);
					$homepage_xml = $homepage_xml . create_xml_tag('user_secret',$user_secret);
					$homepage_xml = $homepage_xml . create_xml_tag('twitter_id',htmlspecialchars(stripslashes($twitter_id)));
					$homepage_xml = $homepage_xml . create_xml_tag('homepage_layout_on',$homepage_layout_on);
					$homepage_xml = $homepage_xml . create_xml_tag('footer_sec_title',htmlspecialchars(stripslashes($footer_sec_title)));
					$homepage_xml = $homepage_xml . create_xml_tag('home_page_layout',$home_page_layout);
					$homepage_xml = $homepage_xml . '</homepage_settings>';

					if(!save_option('homepage_settings', get_option('homepage_settings'), $homepage_xml)){
					
						die( json_encode($return_data) );
						
					}
					
					die(json_encode( array('success'=>'0') ) );
					
				}
				$homepage_newsline_on = '';
				$header_headline = '';
				$section_headline_category = '';
				$homepage_twitter_on = '';
				$header_twitter = '';
				$consumer_key = '';
				$consumer_secret = ''; 
				$user_token = '';
				$user_secret = '';
				$twitter_id = '';
				$homepage_on = '';
				$homepage_layout_on = '';
				$footer_sec_title = '';
				$home_page_layout = '';
				$cp_typography_settings = get_option('homepage_settings');
				if($cp_typography_settings <> ''){
					$cp_typo = new DOMDocument ();
					$cp_typo->loadXML ( $cp_typography_settings );
					$homepage_newsline_on = cp_find_xml_value($cp_typo->documentElement,'homepage_newsline_on');
					$header_headline = cp_find_xml_value($cp_typo->documentElement,'header_headline');
					$section_headline_category = cp_find_xml_value($cp_typo->documentElement,'section_headline_category');
					$homepage_twitter_on = cp_find_xml_value($cp_typo->documentElement,'homepage_twitter_on');
					$header_twitter = cp_find_xml_value($cp_typo->documentElement,'header_twitter');
					$consumer_key = cp_find_xml_value($cp_typo->documentElement,'consumer_key');
					$consumer_secret = cp_find_xml_value($cp_typo->documentElement,'consumer_secret');
					$user_token = cp_find_xml_value($cp_typo->documentElement,'user_token');
					$user_secret = cp_find_xml_value($cp_typo->documentElement,'user_secret');
					$twitter_id = cp_find_xml_value($cp_typo->documentElement,'twitter_id');
					$homepage_layout_on = cp_find_xml_value($cp_typo->documentElement,'homepage_layout_on');
					$footer_sec_title = cp_find_xml_value($cp_typo->documentElement,'footer_sec_title');
					$home_page_layout = cp_find_xml_value($cp_typo->documentElement,'home_page_layout');
				}?>	
<div id="wrapper_backend cp-margin-left">
	<div id="header_theme_options">	
		<span id="backend_logo"><h1> <a href="#"><h3> <?php esc_html_e('CrunchPress Framework','mosque_crunchpress');?> </h3></a> </h1> </span>
	</div>
	<div class="wrapper_1">
		<?php echo cp_top_navigation_html();?>		
	</div>
	<div class="below_wrapper tabs">
		<div class="wrapper_left">
			<ul id="wp_t_o_right_menu">
				<li class="home_layout" id="active_tab"><?php esc_html_e('Home Page Layout', 'mosque_crunchpress'); ?></li>
   				<li class="footer_area"><?php esc_html_e('Footer Layout', 'mosque_crunchpress'); ?></li>
			</ul>
		</div>
		<div class="wrapper_right">
			<form id="options-panel-form" name="cp-panel-form">
				<div class="panel-elements" id="panel-elements">
					<div class="panel-element" id="panel-element-save-complete">
						<div class="panel-element-save-text"><?php esc_html_e('Save Options Complete', 'mosque_crunchpress'); ?>.</div>
						<div class="panel-element-save-arrow"></div>
					</div>
					<ul>
						<li id="home_layout" class="active_tab">
							<h3><h3> <?php esc_html_e('Home Page Layout Settings','mosque_crunchpress');?> </h3></h3>

							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="" > <?php esc_html_e('News Headline', 'mosque_crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="homepage_newsline_on"><div class="checkbox-switch <?php
									
									echo ($homepage_newsline_on=='enable' || ($homepage_newsline_on=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

								?>"></div></label>
								<input type="checkbox" name="homepage_newsline_on" class="checkbox-switch" value="disable" checked>
								<input type="checkbox" name="homepage_newsline_on" id="homepage_newsline_on" class="checkbox-switch" value="enable" <?php 
									
									echo ($homepage_newsline_on=='enable' || ($homepage_newsline_on=='' && empty($default)))? 'checked': ''; 
								
								?>>
								</li>
								<li class="description"><h3> <?php esc_html_e('You can turn On/Off Home Page Widgets from Top of the page.','mosque_crunchpress');?> </h3></li>
							</ul>
                            <div class="clear"></div>
                            <ul class="panel-body recipe_class">
                                <li class="panel-title">
                                    <label for="header_headline" > <?php esc_html_e('News Headline Title', 'mosque_crunchpress'); ?> </label>
                                </li>	
                                <li class="panel-input">
                                    <input type="text" name="header_headline" id="header_headline" value="<?php echo ($header_headline == '')? esc_html($header_headline): esc_html($header_headline);?>" />
                                </li>
                                <li class="description"><h3> <?php esc_html_e('Please enter your news headline title here.','mosque_crunchpress');?> </h3>
</li>
                            </ul>
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="section_headline_category"><?php esc_html_e('News Headline Category', 'mosque_crunchpress'); ?></label>
								</li>
								<li class="panel-input">	
									<div class="combobox">
										<select name="section_headline_category" class="section_headline_category" id="section_headline_category">
											<option value="nocategory" class=""><h3> <?php esc_html_e('---No Category---','mosque_crunchpress');?> </h3></option>
											<?php foreach ( get_category_list_array('category') as $category){?>
												 <option <?php if(esc_attr($section_headline_category) == $category->slug){echo 'selected';}?> value="<?php echo esc_attr($category->slug);?>" >
													<?php echo substr($category->name, 0, 20);	if ( strlen($category->name) > 20 ) echo "...";?>
												</option>		
											<?php }?>
										</select>
									</div>
								</li>
								<li class="description"><h3> <?php esc_html_e('Please select headline category.','mosque_crunchpress');?> </h3></li>
							</ul>
   							<div class="clear"></div>
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="" > <?php esc_html_e('Twitter Feeds', 'mosque_crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="homepage_twitter_on"><div class="checkbox-switch <?php
									
									echo ($homepage_twitter_on=='enable' || ($homepage_twitter_on=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

								?>"></div></label>
								<input type="checkbox" name="homepage_twitter_on" class="checkbox-switch" value="disable" checked>
								<input type="checkbox" name="homepage_twitter_on" id="homepage_twitter_on" class="checkbox-switch" value="enable" <?php 
									
									echo ($homepage_twitter_on=='enable' || ($homepage_twitter_on=='' && empty($default)))? 'checked': ''; 
								
								?>>
								</li>
								<li class="description"><h3> <?php esc_html_e('You can turn On/Off Home Page Widgets from Top of the page.','mosque_crunchpress');?> </h3>
</li>
							</ul>
                            <div class="clear"></div>
                            <ul class="panel-body recipe_class">
                                <li class="panel-title">
                                    <label for="header_twitter" > <?php esc_html_e('Twitter Title', 'mosque_crunchpress'); ?> </label>
                                </li>	
                                <li class="panel-input">
                                    <input type="text" name="header_twitter" id="header_twitter" value="<?php echo ($header_twitter == '')? esc_html($header_twitter): esc_html($header_twitter);?>" />
                                </li>
                                <li class="description"><h3> <?php esc_html_e('Please enter your news headline title here.','mosque_crunchpress');?> </h3>
</li>
                            </ul>
							<div class="clear"></div>
							<ul class="panel-body recipe_class">
                                <li class="panel-title">
                                    <label for="consumer_key" > <?php esc_html_e('Consumer Key', 'mosque_crunchpress'); ?> </label>
                                </li>	
                                <li class="panel-input">
                                    <input type="text" name="consumer_key" id="consumer_key" value="<?php echo ($consumer_key == '')? esc_html($consumer_key): esc_html($consumer_key);?>" />
                                </li>
                                <li class="description"><h3> <?php esc_html_e('Please enter your Consumer Key Here.','mosque_crunchpress');?> </h3>
</li>
                            </ul>
							<ul class="panel-body recipe_class">
                                <li class="panel-title">
                                    <label for="consumer_secret" > <?php esc_html_e('Consumer Secret Key', 'mosque_crunchpress'); ?> </label>
                                </li>	
                                <li class="panel-input">
                                    <input type="text" name="consumer_secret" id="consumer_secret" value="<?php echo ($consumer_secret == '')? esc_html($consumer_secret): esc_html($consumer_secret);?>" />
                                </li>
                                <li class="description"><h3> <?php esc_html_e('Please enter your Consumer Secret Key here here.','mosque_crunchpress');?> </h3>
</li>
                            </ul>
							<ul class="panel-body recipe_class">
                                <li class="panel-title">
                                    <label for="user_token" > <?php esc_html_e('User Token', 'mosque_crunchpress'); ?> </label>
                                </li>	
                                <li class="panel-input">
                                    <input type="text" name="user_token" id="user_token" value="<?php echo ($user_token == '')? esc_html($user_token): esc_html($user_token);?>" />
                                </li>
                                <li class="description"><h3> <?php esc_html_e('Please enter your User Token here.','mosque_crunchpress');?> </h3>
</li>
                            </ul>
							<ul class="panel-body recipe_class">
                                <li class="panel-title">
                                    <label for="user_secret" > <?php esc_html_e('User Secret Token', 'mosque_crunchpress'); ?> </label>
                                </li>	
                                <li class="panel-input">
                                    <input type="text" name="user_secret" id="user_secret" value="<?php echo ($user_secret == '')? esc_html($user_secret): esc_html($user_secret);?>" />
                                </li>
                                <li class="description"><h3> <?php esc_html_e('Please enter your User Secret Token title here.','mosque_crunchpress');?> </h3>
</li>
                            </ul>
                            <ul class="panel-body recipe_class">
                                <li class="panel-title">
                                    <label for="twitter_id" > <?php esc_html_e('Twitter ID', 'mosque_crunchpress'); ?> </label>
                                </li>	
                                <li class="panel-input">
                                    <input type="text" name="twitter_id" id="twitter_id" value="<?php echo ($twitter_id == '')? esc_html($twitter_id): esc_html($twitter_id);?>" />
                                </li>
                                <li class="description"><h3> <?php esc_html_e('Please enter your news headline title here.','mosque_crunchpress');?> </h3>
</li>
                            </ul>
							<div class="clear"></div>
                            </li>	
                            <li id="footer_area">
							<ul class="panel-body recipe_class">
								<li class="panel-title">
									<label for="" > <?php esc_html_e('Footer Widgets', 'mosque_crunchpress'); ?> </label>
								</li>	
								<li class="panel-input">
									<label for="homepage_layout_on"><div class="checkbox-switch <?php
									
									echo ($homepage_layout_on=='enable' || ($homepage_layout_on=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

								?>"></div></label>
								<input type="checkbox" name="homepage_layout_on" class="checkbox-switch" value="disable" checked>
								<input type="checkbox" name="homepage_layout_on" id="homepage_layout_on" class="checkbox-switch" value="enable" <?php 
									
									echo ($homepage_layout_on=='enable' || ($homepage_layout_on=='' && empty($default)))? 'checked': ''; 
								
								?>>
								</li>
								<li class="description"><h3> <?php esc_html_e('You can turn On/Off Home Page Widgets from Top of the page.','mosque_crunchpress');?> </h3>
</li>
							</ul>
							<div class="clear"></div>
                            <ul class="panel-body recipe_class">
                                <li class="panel-title">
                                    <label for="footer_sec_title" > <?php esc_html_e('Footer Section Title', 'mosque_crunchpress'); ?> </label>
                                </li>	
                                <li class="panel-input">
                                    <input type="text" name="footer_sec_title" id="footer_sec_title" value="<?php echo ($footer_sec_title == '')? esc_html($footer_sec_title): esc_html($footer_sec_title);?>" />
                                </li>
                                <li class="description"><h3> <?php esc_html_e('Please enter your footer section title here.','mosque_crunchpress');?> </h3>
</li>
                            </ul>
							<div class="clear"></div>
							<ul class="recipe_class">
								<li class="panel-title">
									<label for=""><?php esc_html_e('Footer Widget Layout', 'mosque_crunchpress'); ?></label>
								</li>
								<li class="panel-radioimage">
									<?php 
									$value = '';
									$options = array(
										'1'=>array('value'=>'home_4_col','image'=>'/framework/images/footer-style1.png'),
										'2'=>array('value'=>'home_3_col','image'=>'/framework/images/footer-style6.png'),
									);
									foreach( $options as $option ){ ?>
										<div class='radio-image-wrapper'>
											<label for="<?php echo esc_attr($option['value']); ?>">
												<img src=<?php echo CP_PATH_URL.$option['image']?> class="home_page_layout" alt="home_page_layout" />
												<div id="check-list"></div>                                
											</label>
											<input type="radio" name="home_page_layout" value="<?php echo esc_attr($option['value']; ?>" id="<?php echo esc_attr($option['value']); ?>" class="dd"
											<?php 
												if($home_page_layout == $option['value']){
													echo 'checked';
												}
											?>
											>                            
										</div>
									<?php } ?>
									<br class="clear">	
								</li>
								<li class="description"><h3> <?php esc_html_e('Please select home page layout style.','mosque_crunchpress');?> </h3>
</li>
							</ul>								
						</li>
						<div class="panel-element-tail">
							<div class="tail-save-changes">
								<div class="loading-save-changes"></div>
								<input type="submit" value="<?php echo esc_html__('Save Changes','mosque_crunchpress') ?>">
								<input type="hidden" name="action" value="homepage_settings">				
							</div>
						</div>
					</ul>
				</div>
			</form>
		</div>	
	</div>
</div>	
	<?php
}	
?>
