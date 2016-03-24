<?php
	/*
	 * This file will generate 404 error page.
	 */	
	get_header(); 


	//Get Theme Options for Page Layout
	$select_layout_cp = '';
	$cp_general_settings = get_option('general_settings');
	if($cp_general_settings <> ''){
		$cp_logo = new DOMDocument ();
		$cp_logo->loadXML ( $cp_general_settings );
		$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
		$cp_breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
	}
?>

	<div class="contant">
		<!--Inner Pages Heading Area Start-->	
		<div id="banner">
			<div id="inner-banner">
				<div class="container">
					<h1><?php esc_html_e('404 Page Not Found!','mosque_crunchpress');?></h1>
					<?php
						if(!is_front_page()){
							echo cp_breadcrumbs();
						}
					?>
				</div>
			</div>
		</div>		

		<!--Inner Pages Heading Area End--> 
		<!-- /.404 Start ./-->
		<section class="cp_404-section">
			<div class="container">
				<em><?php esc_html_e('OOPs !','mosque_crunchpress');?></em>
				<h2><?php esc_html_e('404','mosque_crunchpress');?></h2>
				<div class="inner-holder">
					<strong><?php esc_html_e('OOPs looks like we are having a problem
						why do not you go back to the homepage and try again.','mosque_crunchpress');?></strong>
					<a href="<?php  echo esc_url(home_url('/')); ?>" class="btn-back"><?php esc_html_e('Go Back to Homepage','mosque_crunchpress');?></a>
					<form method="get" class="error-page-form">
						<input type="text" placeholder="<?php esc_html_e('Enter keywords here...','mosque_crunchpress');?>">
						<input type="submit" value="Search">
					</form>
				</div>
			</div>
		</section>
		  <!-- /.404 End ./-->
		  
		  	
	</div>
	<!-- Main End--> 


<?php get_footer();?>
