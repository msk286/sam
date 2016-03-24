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
	
add_action('wp_ajax_typography_settings','typography_settings');
function typography_settings(){
		
	
	foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');?>
<?php 
					if(isset($action) AND $action == 'typography_settings'){
						$typography_xml = '<typography_settings>';
						$typography_xml = $typography_xml . create_xml_tag('font_google',$font_google);
						//Arabic Fonts
						$typography_xml = $typography_xml . create_xml_tag('arabic_font',$arabic_font);
						$typography_xml = $typography_xml . create_xml_tag('arabic_font_heading',$arabic_font_heading);
						$typography_xml = $typography_xml . create_xml_tag('arabic_fonts_switch',$arabic_fonts_switch);
						$typography_xml = $typography_xml . create_xml_tag('arabic_menu_font',$arabic_menu_font);
						$typography_xml = $typography_xml . create_xml_tag('font_size_normal',$font_size_normal);
						$typography_xml = $typography_xml . create_xml_tag('font_google_heading',$font_google_heading);
						$typography_xml = $typography_xml . create_xml_tag('menu_font_google',$menu_font_google);
						$typography_xml = $typography_xml . create_xml_tag('heading_h1',$heading_h1);
						$typography_xml = $typography_xml . create_xml_tag('heading_h2',$heading_h2);
						$typography_xml = $typography_xml . create_xml_tag('heading_h3',$heading_h3);
						$typography_xml = $typography_xml . create_xml_tag('heading_h4',$heading_h4);
						$typography_xml = $typography_xml . create_xml_tag('heading_h5',$heading_h5);
						$typography_xml = $typography_xml . create_xml_tag('heading_h6',$heading_h6);
						$typography_xml = $typography_xml . create_xml_tag('embed_typekit_code',htmlspecialchars(stripslashes($embed_typekit_code)));
						$typography_xml = $typography_xml . '</typography_settings>';

						
						$font_setting_xml = '<typekit_font>';
						$sidebars = $_POST['typekit_font'];
						foreach($sidebars as $keys=>$values){
							$font_setting_xml = $font_setting_xml . create_xml_tag('typekit_font',$values);
						}
						$font_setting_xml = $font_setting_xml . '</typekit_font>';
						save_option('typokit_settings', get_option('typokit_settings'), $font_setting_xml);
						
						
						if(!save_option('typography_settings', get_option('typography_settings'), $typography_xml)){
						
							die( json_encode($return_data) );
							
						}
						
						die(json_encode( array('success'=>'0') ) );
						
					}
		$font_google = '';
		$arabic_fonts_switch = '';
		$arabic_font = '';
		$font_size_normal = '';
		$menu_font_google = '';
		$arabic_menu_font = '';
		$fonts_array = '';
		$font_google_heading = '';
		$arabic_font_heading = '';
		$heading_h1 = '';
		$heading_h2 = '';
		$heading_h3 = '';
		$heading_h4 = '';
		$heading_h5 = '';
		$heading_h6 = '';
		$embed_typekit_code = '';
		$cp_typography_settings = get_option('typography_settings');
		
		
		if($cp_typography_settings <> ''){
			$cp_typo = new DOMDocument ();
			$cp_typo->loadXML ( $cp_typography_settings );
			$font_google = cp_find_xml_value($cp_typo->documentElement,'font_google');
			$font_size_normal = cp_find_xml_value($cp_typo->documentElement,'font_size_normal');
			$menu_font_google = cp_find_xml_value($cp_typo->documentElement,'menu_font_google');
			
			$arabic_font = cp_find_xml_value($cp_typo->documentElement,'arabic_font');
			$arabic_menu_font = cp_find_xml_value($cp_typo->documentElement,'arabic_menu_font');
			$arabic_fonts_switch = cp_find_xml_value($cp_typo->documentElement,'arabic_fonts_switch');
			$arabic_font_heading = cp_find_xml_value($cp_typo->documentElement,'arabic_font_heading');
			
			
			$font_google_heading = cp_find_xml_value($cp_typo->documentElement,'font_google_heading');
			$heading_h1 = cp_find_xml_value($cp_typo->documentElement,'heading_h1');
			$heading_h2 = cp_find_xml_value($cp_typo->documentElement,'heading_h2');
			$heading_h3 = cp_find_xml_value($cp_typo->documentElement,'heading_h3');
			$heading_h4 = cp_find_xml_value($cp_typo->documentElement,'heading_h4');
			$heading_h5 = cp_find_xml_value($cp_typo->documentElement,'heading_h5');
			$heading_h6 = cp_find_xml_value($cp_typo->documentElement,'heading_h6');
			$embed_typekit_code = cp_find_xml_value($cp_typo->documentElement,'embed_typekit_code');
			
		}?>		

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
				<li class="font_family" id="active_tab"><?php esc_html_e('Font Family', 'mosque_crunchpress'); ?></li>
				<li class="font_size"><?php esc_html_e('Font Size', 'mosque_crunchpress'); ?></li>
				<li class="type_kit_font"><?php esc_html_e('Type Kit Font', 'mosque_crunchpress'); ?></li>
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
            <div class="panel-element"></div>
			<ul class="typography_class">
				<li id="font_family" class="active_tab">
						
						<?php $fonts_array = cp_get_font_array();?>
						<ul class="recipe_class row-fluid">
							
							<li class="panel-input span8">	
								<span class="panel-title">
									<h3 for="font_google"><?php esc_html_e('FONT FAMILY', 'mosque_crunchpress'); ?></h3>
								</span>
								<div class="combobox">
									<select class="font_google" name="font_google" id="font_google">
										<option <?php if( $font_google == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','mosque_crunchpress');?> </h3></option>
										<optgroup label="GOOGLE FONT">
										<?php 
										foreach($fonts_array as $font_key =>$font_value){ 
											if($font_value['type'] == 'Google Font'){ ?>
												<option <?php if( $font_google == esc_html($font_key) ){ echo 'selected'; }?>><?php echo esc_attr($font_key); ?></option>
											<?php
											}
										}	
										?>
										</optgroup>		
										<!--Typekit Font Start -->
										<optgroup label="Typekit font">
										<?php
										$fonts_arr = cp_get_font_array();
										foreach($fonts_arr as $keys=>$values){
											if($values['type'] == 'Used font'){ ?>
												<option <?php if( $font_google == esc_html($keys) ){ echo 'selected'; }?>><?php echo esc_attr($keys); ?></option>
												<?php
											}
										}?>
										</optgroup>							
									</select>
								</div>
								<span class="description "><?php esc_html_e('Please Select font family from dropdown for website body text.','mosque_crunchpress');?></span>
							</li>
							<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','mosque_crunchpress');?></p></li>
						</ul>
					
						<ul class="recipe_class row-fluid">
							<li class="panel-input span8">							
								<span class="panel-title">
									<h3 for="font_google_heading"><?php esc_html_e('FONT FAMILY HEADINGS', 'mosque_crunchpress'); ?></h3>
								</span>
								<div class="combobox">
									<select class="font_google" name="font_google_heading" id="font_google_heading">
										<option <?php if( $font_google_heading == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','mosque_crunchpress');?> </h3></option>
										<optgroup label="GOOGLE FONT">
										<?php 
										foreach($fonts_array as $font_key =>$font_value){ 
												if($font_value['type'] == 'Google Font'){ ?>
												<option <?php if( $font_google_heading == esc_html($font_key) ){ echo 'selected'; }?>><?php echo esc_attr($font_key); ?></option>
											<?php
											}
										}	
										?>
										
										<!--Typekit Font Start -->
										<optgroup label="Typekit font">
										<?php
										$fonts_arr = cp_get_font_array();
										foreach($fonts_arr as $keys=>$values){
											if($values['type'] == 'Typekit font'){ ?>
												<option <?php if( $font_google_heading == esc_html($keys) ){ echo 'selected'; }?>><?php echo esc_attr($keys); ?></option>
												<?php
											}
										}?>
										</optgroup>							
									</select>
								</div>
								<span class="description"><?php esc_html_e('Please select font family from dropdown for website Headings.','mosque_crunchpress');?></span>
							</li>
							<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','mosque_crunchpress');?></p></li>
						</ul>
						<ul class="recipe_class row-fluid">							
							<li class="panel-input span8">	
								<span class="panel-title">
									<h3 for="menu_font_google"><?php esc_html_e('MENU FONT FAMILY', 'mosque_crunchpress'); ?></h3>
								</span>
								<div class="combobox">
									<select class="font_google" name="menu_font_google" id="menu_font_google">
										<option <?php if( $menu_font_google == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','mosque_crunchpress');?> </h3></option>
											
										<div class="clear"></div>
										<optgroup label="GOOGLE FONT">
										<?php 
										foreach($fonts_array as $font_key =>$font_value){ 
											if($font_value['type'] == 'Google Font'){ ?>
												<option <?php if( $menu_font_google == esc_html($font_key) ){ echo 'selected'; }?>><?php echo esc_attr($font_key); ?></option>
											<?php
											}
										}	
										?>
										</optgroup>		
										<!--Typekit Font Start -->
										<optgroup label="Typekit font">
										<?php
										$fonts_arr = cp_get_font_array();
										foreach($fonts_arr as $keys=>$values){
											if($values['type'] == 'Typekit font'){ ?>
												<option <?php if( $menu_font_google == esc_html($keys) ){ echo 'selected'; }?>><?php echo esc_attr($keys); ?></option>
												<?php
											}
										}?>
										</optgroup>							
									</select>
								</div>
								<span class="description"><?php esc_html_e('Please Select font family from dropdown for website Menu.','mosque_crunchpress');?></span>
							</li>
							<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','mosque_crunchpress');?></p></li>
						</ul>
												
				</li>
				<li id="font_size">
					<h3><?php esc_html_e('Font Size Settings','mosque_crunchpress');?></h3>
						<ul class="panel-body recipe_class row-fluid">
							<li class="panel-input span8">
								<span class="panel-title">
									<h3 for="heading_h1" > <?php esc_html_e('BODY TEXT FONT SIZE', 'mosque_crunchpress'); ?> </h3>
								</span>
								<div id="font_size_normal" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="font_size_normal" value="<?php echo esc_attr($font_size_normal);?>">
								<span class="description"><?php esc_html_e('Please manage font body size for your website body text.','mosque_crunchpress');?></span>
							</li>
							<li class="span4" id="slidertext"><p><?php echo esc_attr($font_size_normal);?><?php esc_html_e('px','mosque_crunchpress');?></p></li>
						</ul>
					
						<ul class="panel-body recipe_class row-fluid">
							<li class="panel-input span8">
								<span class="panel-title">
									<h3 for="heading_h1" > <?php esc_html_e('HEADING H1 SIZE', 'mosque_crunchpress'); ?> </h3>
								</span>	
								<div id="heading_h1" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h1" value="<?php echo esc_attr($heading_h1);?>">
								<span class="description"><?php esc_html_e('Please manage font size for website Heading - h1','mosque_crunchpress');?></span>
							</li>
							<li class="span4" id="slidertext"><p><?php echo esc_attr($heading_h1);?><?php esc_html_e('px','mosque_crunchpress');?></p></li>							
						</ul>
					
						<ul class="panel-body recipe_class row-fluid">
							
							<li class="panel-input span8">
								<span class="panel-title">
									<h3 for="heading_h2" > <?php esc_html_e('HEADING H2 SIZE', 'mosque_crunchpress'); ?> </h3>
								</span>	
								<div id="heading_h2" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h2" value="<?php echo esc_attr($heading_h2);?>">
								<span class="description"><?php esc_html_e('Please manage font size for website Heading - h2','mosque_crunchpress');?></span>
							</li>
							<li class="span4" id="slidertext"><p><?php echo esc_attr($heading_h2);?><?php esc_html_e('px','mosque_crunchpress');?></p></li>
						</ul>
						
						<ul class="panel-body recipe_class row-fluid">
							<li class="panel-input span8">
								<span class="panel-title">
									<h3 for="heading_h3" > <?php esc_html_e('HEADING H3 SIZE', 'mosque_crunchpress'); ?> </h3>
								</span>	
								<div id="heading_h3" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h3" value="<?php echo esc_attr($heading_h3);?>">
								<span class="description"><?php esc_html_e('Please manage font size for website Heading - h3','mosque_crunchpress');?> </span>
							</li>
							<li class="span4" id="slidertext"><p><?php echo esc_attr($heading_h3);?><?php esc_html_e('px','mosque_crunchpress');?></p></li>
						</ul>
				
						<ul class="panel-body recipe_class row-fluid">
							<li class="panel-input span8">
								<span class="panel-title">
									<h3 for="heading_h4" > <?php esc_html_e('HEADING H4 SIZE', 'mosque_crunchpress'); ?> </h3>
								</span>	
								<div id="heading_h4" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h4" value="<?php echo esc_attr($heading_h4);?>">
								<span class="description"><?php esc_html_e('Please manage font size for website Heading - h4','mosque_crunchpress');?></span>
							</li>
							<li class="span4" id="slidertext"><p><?php echo esc_attr($heading_h4);?><?php esc_html_e('px','mosque_crunchpress');?></p></li>
						</ul>
						
						<ul class="panel-body recipe_class row-fluid">
							<li class="panel-input span8">
								<span class="panel-title">
									<h3 for="heading_h5" > <?php esc_html_e('HEADING H5 SIZE', 'mosque_crunchpress'); ?> </h3>
								</span>
								<div id="heading_h5" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h5" value="<?php echo esc_attr($heading_h5);?>">
								<span class="description"><?php esc_html_e('Please manage font size for website Heading - h5','mosque_crunchpress');?></span>
							</li>
							<li class="span4" id="slidertext"><p><?php echo esc_attr($heading_h5);?><?php esc_html_e('px','mosque_crunchpress');?></p> </li>
						</ul>
					
						<ul class="panel-body recipe_class row-fluid">
							<li class="panel-input span8">
								<span class="panel-title">
									<h3 for="heading_h6" > <?php esc_html_e('HEADING H6 SIZE', 'mosque_crunchpress'); ?> </h3>
								</span>	
								<div id="heading_h6" class="sliderbar" rel="sliderbar"></div>
								<input type="hidden" name="heading_h6" value="<?php echo esc_attr($heading_h6);?>">
								<span class="description"><?php esc_html_e('Please manage font size for website Heading - h6','mosque_crunchpress');?></span>
							</li>
							<li class="span4" id="slidertext"><p><?php echo esc_attr($heading_h6);?><?php esc_html_e('px','mosque_crunchpress');?></p></li>
						</ul>					
				</li>	
				<li id="type_kit_font">
					<div class="typekit_font_class">
						<h3> <?php esc_html_e('Typekit Font Upload Settings','mosque_crunchpress');?> </h3>
						<div class="type_kit">
							<ul class="panel-body recipe_class row-fluid">
								<li class="panel-input span8">
								<span class="panel-title">
									<h3 for="embed_typekit_code" > <?php esc_html_e('TYPEKIT EMBED CODE', 'mosque_crunchpress'); ?> </h3>
								</span>	
									<textarea name="embed_typekit_code" id="embed_typekit_code" ><?php echo ($embed_typekit_code == '')? esc_html($embed_typekit_code): esc_html($embed_typekit_code);?></textarea>
								</li>
								<li class="span4 right-box-sec"><p><?php esc_html_e('Please paste TypeKit Embeded Code JavaScript Here.','mosque_crunchpress');?></p></li>
							</ul>
							<div class="font_name_bg row-fluid">								
								<div class="panel-input span12">
									<div class="panel-title">
										<h3 for="add-typekit-font" > <?php esc_html_e('Font Name', 'mosque_crunchpress'); ?> </h3>
									</div>	
									<input type="text" id="add-typekit-font" value="type font family here" rel="type font family here">
									<div id="add-typekit-font" class="add-typekit-font"></div>
								</div>
								<div id="selected_typekitfont" class="selected_typekitfont">
									<div class="default_typekit" id="typekit_item">
										<div class="panel-delete-typekitfont"></div>
										<div class="typekitfont_text"></div>
										<input type="hidden" id="typekit_font">
									</div>
								<?php
								//Sidebar addition
								$cp_typekit_settings = get_option('typokit_settings');
								if($cp_typekit_settings <> ''){
									$typekit_xml = new DOMDocument();
									$typekit_xml->loadXML($cp_typekit_settings);
									foreach( $typekit_xml->documentElement->childNodes as $typekit_font ){?>
									<div class="typekit_item" id="typekit_item">
										<div class="panel-delete-typekitfont"></div>
										<div class="typekitfont_text"><?php echo esc_attr($typekit_font->nodeValue); ?></div>
										<input type="hidden" name="typekit_font[]" id="typekit_font" value="<?php echo esc_attr($typekit_font->nodeValue); ?>">
									</div>
								<?php }
								}
								?>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
			<h2><?php esc_html_e('Arabic Fonts','mosque_crunchpress');?> </h2>
			<div class="row-fluid">
				<ul class="panel-body recipe_class span4">
					<li class="panel-input full-width">
					   <span class="panel-title">
						<h3 for="" >
						  <?php esc_html_e('Arabic Fonts', 'mosque_crunchpress'); ?>
						</h3>
					  </span>
						<label for="arabic_fonts_switch">
						<div class="checkbox-switch <?php
									
									echo ($arabic_fonts_switch=='enable' || ($arabic_fonts_switch=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

								?>"></div>
						</label>
						<input type="checkbox" name="arabic_fonts_switch" class="checkbox-switch" value="disable" checked>
						<input type="checkbox" name="arabic_fonts_switch" id="arabic_fonts_switch" class="checkbox-switch" value="enable" 
						<?php if($arabic_fonts_switch=='enable' ){echo '';} echo ($arabic_fonts_switch=='enable' || ($arabic_fonts_switch=='' && empty($default)))? 'checked': ''; ?>>
						<p><?php esc_html_e('You can turn On/Off Arabic Fonts on Site.','mosque_crunchpress');?></p>
					</li>
				</ul>
			</div>
			<ul class="typography_class_2">
				<li id="font_family" class="active_tab">

				<?php
					/* Arabic Fonts  Added For Mosque */
					
					$arabic_fonts = array("Amiri", "Droid Arabic Kufi", "Droid Arabic Naskh", "Lateef" , "Scheherazade" , "Thabit");
					
					$fonts_array = cp_get_font_array();
	
				?>
						
						<ul class="recipe_class row-fluid">
							<li class="panel-input span8">	
								<span class="panel-title">
									<h3 for="arabic_font"><?php esc_html_e('Arabic FONT FAMILY', 'mosque_crunchpress'); ?></h3>
								</span>
								<div class="combobox">
									<select class="arabic_font" name="arabic_font" id="arabic_font">
										<option <?php if( $arabic_font == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','mosque_crunchpress');?> </h3></option>
										<optgroup label="Arabic Fonts Available">
										<?php 
										foreach($arabic_fonts as $font_value){ ?>
												<option <?php if( $arabic_font == esc_html($font_value) ){ echo 'selected'; }?>><?php echo esc_attr($font_value); ?></option>
											<?php
										}	
										?>
										</optgroup>						
									</select>
								</div>
								<span class="description "><?php esc_html_e('Please Select font family from dropdown for website body text.','mosque_crunchpress');?></span>
							</li>
							<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','mosque_crunchpress');?></p></li>
						</ul>
					
						<ul class="recipe_class row-fluid">
							<li class="panel-input span8">							
								<span class="panel-title">
									<h3 for="arabic_font_heading"><?php esc_html_e('Arabic FONT FAMILY HEADINGS', 'mosque_crunchpress'); ?></h3>
								</span>
								<div class="combobox">
									<select class="font_google" name="arabic_font_heading" id="arabic_font_heading">
										<option <?php if( $arabic_font_heading == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','mosque_crunchpress');?> </h3></option>
										<optgroup label="Arabic Fonts Available">
										<?php 
										foreach($arabic_fonts as $font_value){ ?>
												<option <?php if( $arabic_font_heading == esc_html($font_value) ){ echo 'selected'; }?>><?php echo esc_attr($font_value); ?></option>
											<?php
										}	
										?>					
									</select>
								</div>
								<span class="description"><?php esc_html_e('Please select font family from dropdown for website Headings.','mosque_crunchpress');?></span>
							</li>
							<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','mosque_crunchpress');?></p></li>
						</ul>
						<ul class="recipe_class row-fluid">							
							<li class="panel-input span8">	
								<span class="panel-title">
									<h3 for="arabic_menu_font"><?php esc_html_e('Arabic MENU FONT FAMILY', 'mosque_crunchpress'); ?></h3>
								</span>
								<div class="combobox">
									<select class="font_google" name="arabic_menu_font" id="arabic_menu_font">
										<option <?php if( $arabic_menu_font == 'Default' ){ echo 'selected'; }?> value="Default"><h3> <?php esc_html_e('Theme Default','mosque_crunchpress');?> </h3></option>
										<div class="clear"></div>
										<optgroup label="Arabic Font Available">
										<?php 
										foreach($arabic_fonts as $font_value){ ?>
												<option <?php if( $arabic_menu_font == esc_html($font_value) ){ echo 'selected'; }?>><?php echo esc_attr($font_value); ?></option>
											<?php
										}	
										?>
										</optgroup>						
									</select>
								</div>
								<span class="description"><?php esc_html_e('Please Select font family from dropdown for website Menu.','mosque_crunchpress');?></span>
							</li>
							<li class="sample_text span4"><p class="option-font-sample" id="option-font-sample"><?php esc_html_e('SAMPLE TEXT','mosque_crunchpress');?></p></li>
						</ul>
												
				</li>
			</ul>			
			<div class="clear"></div>
            <div class="panel-element-tail">
              <div class="tail-save-changes">
                <div class="loading-save-changes"></div>
                <input type="submit" value="<?php echo esc_html__('Save Changes','mosque_crunchpress') ?>">
                <input type="hidden" name="action" value="typography_settings">
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
