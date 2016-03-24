<?php 
 	//Fetch the theme Option Values
	$cp_maintenance_mode = cp_get_themeoption_value('maintenance_mode','general_settings');
	$maintenace_title = cp_get_themeoption_value('maintenace_title','general_settings');
	$countdown_time = cp_get_themeoption_value('countdown_time','general_settings');
	$email_mainte = cp_get_themeoption_value('email_mainte','general_settings');
	$mainte_description = cp_get_themeoption_value('mainte_description','general_settings');
	$social_icons_mainte = cp_get_themeoption_value('social_icons_mainte','general_settings');
	
	if($cp_maintenance_mode <> 'disable'){
		//If Logged in then Remove Maintenance Page
		if ( is_user_logged_in() ) {
			$cp_maintenance_mode = 'disable';
		} else {
			$cp_maintenance_mode = 'enable';
		}
	}
	
	if($cp_maintenance_mode == 'enable'){
		//Trigger the Maintenance Mode Function Here
		cp_maintenance_mode_fun();
	}else{
get_header(); 

if ( have_posts() ){ while (have_posts()){ the_post();
	global $post;
	
	
	//Fetching All Tracks from Database
	$track_name_xml = get_post_meta($post->ID, 'add_project_xml', true);
	$track_url_xml = get_post_meta($post->ID, 'add_project_field_xml', true);

	//Empty Variables
	$children = '';
	$children_title = '';

	//Track Name
	if($track_name_xml <> ''){
		$ingre_xml = new DOMDocument();
		$ingre_xml->recover = TRUE;
		$ingre_xml->loadXML($track_name_xml);
		$children_name = $ingre_xml->documentElement->childNodes;
	}		

	//Track URL
	if($track_url_xml <> ''){	
		$ingre_title_xml = new DOMDocument();
		$ingre_title_xml->recover = TRUE;
		$ingre_title_xml->loadXML($track_url_xml);
		$children_title = $ingre_title_xml->documentElement->childNodes;
	}
	
	$select_layout_cp = '';
	$cp_general_settings = get_option('general_settings');
	if($cp_general_settings <> ''){
		$cp_logo = new DOMDocument ();
		$cp_logo->loadXML ( $cp_general_settings );
		$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
	}
	
	$port_detail_xml = get_post_meta($post->ID, 'port_detail_xml', true);
	if($port_detail_xml <> ''){
		$cp_team_xml = new DOMDocument ();
		$cp_team_xml->loadXML ( $port_detail_xml );
		$sidebar = cp_find_xml_value($cp_team_xml->documentElement,'sidebars_port');
		$right_sidebar = cp_find_xml_value($cp_team_xml->documentElement,'right_sidebar_port');
		$left_sidebar = cp_find_xml_value($cp_team_xml->documentElement,'left_sidebar_port');			
	}
	
	$cp_sidebar_class = '';
	$content_class = '';
	
	//Get Sidebar for page
	$cp_sidebar_class = cp_sidebar_func($sidebar);
	$header_style = '';
	$cp_html_class_banner = '';
	$cp_html_class = cp_print_header_class($header_style);
	if($cp_html_class <> ''){$cp_html_class_banner = 'banner';}
	$header_style = '';
	//Print Style 6
	if(cp_print_header_html_val($header_style) == 'Style 5'){
		cp_print_header_html($header_style);
	}
	$cp_html_class = cp_print_header_class($header_style);
	?>
	<div class="contant">
		<!--Inner Pages Heading Area Start-->
		<section class="inner-titlebg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<?php if(get_the_title() <> ''){ ?>
							<h2><?php echo esc_attr(get_the_title());?></h2>
						<?php }?>
					</div>
				</div>
			</div>
			<div class="bg_transparent">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-md-6">
							<?php if($cp_page_caption <> ''){ ?><h5><?php echo esc_attr($cp_page_caption);?></h5><?php }?>
						</div>
						<div class="col-lg-6 col-md-6">
							 <?php
								if(!is_front_page()){
									echo cp_breadcrumbs();
								}
							?>
						</div>
					</div>	
				</div>
			</div>
		</section>			
		<!--Inner Pages Heading Area End--> 
    	<div class="container">
            <!--MAIN CONTANT ARTICLE START-->
			<?php if($breadcrumbs == 'disable'){
				$cp_class_margin='margin_top_cp';
			}else {
				$cp_class_margin='';
			}
			?>
            <div class="main-content margin-top-bottom <?php echo esc_attr($cp_class_margin);?>">  	
				<div class="single_content row-fluid">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar side-bar<?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php if ( is_active_sidebar( $left_sidebar ) ) { 
								 dynamic_sidebar( $left_sidebar ); 
							} ?>	
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
					<div id="block_first_left" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
						<?php if ( is_active_sidebar( $right_sidebar ) ) { 		
								dynamic_sidebar( $right_sidebar ); 
						} ?>	
					</div>
					<?php } 
					$mask_html = '';
					$no_image_class = 'no-image';
					if(get_the_post_thumbnail($post_id, array(1600,900)) <> ''){
						$mask_html = '<div class="mask">
							<a href="'.esc_url(get_permalink()).'#comments" class="anchor"><span> </span> <i class="fa fa-comment"></i></a>
							<a href="'..esc_url(get_permalink()).'" class="anchor"> <i class="fa fa-link"></i></a>
						</div>';
						$no_image_class = 'image-exists';
					}	?>
					<div id="<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> blog_post_detail cp-portfolio cp-blog <?php echo esc_attr($no_image_class);?>">
						<!--Project Details  Page Start-->
						<section class="project-detail">
						  <div class="container">
							<div class="row-fluid">
							  <div class="span5">
								<h2><?php echo esc_attr(get_the_title());?></h2>
								<ul class="project-detail-list">
								<?php
									//Combine Loop
									if($track_name_xml <> '' || $track_url_xml <> ''){
										$counter = 0;
										$nofields = $ingre_xml->documentElement->childNodes->length;
										for($i=0;$i<$nofields;$i++) { 
											$counter++;
											echo ' <li><strong class="even">'.$children_name->item($i)->nodeValue.'</strong><strong class="odd">'.$children_title->item($i)->nodeValue.'</strong></li>';
										}
									}		
									?>
								</ul>
							  </div>
							  <div class="span7">
								<div class="frame">
								  <div id="project-detail">
									<?php echo get_the_post_thumbnail($post->ID, array(1600,900));?>
								  </div>
								</div>
							  </div>
							</div>
							<div class="content_section">
								<?php the_content();?>
							</div>
						  </div>
						  <?php 
						  wp_reset_query();
						  wp_reset_postdata();
						  if(cp_related_project($post) <> ''){ ?>
						  <div class="other-project">
							  <h3><?php esc_html_e('Other Projects','mosque_crunchpress');?></h3>
								<?php echo cp_related_project($post);?>
						  </div>
						  <?php }?>
						</section>
						<!--Project Details Page End--> 
					</div>
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div class="<?php echo esc_attr($cp_sidebar_class[0]);?> side-bar">
							<?php if ( is_active_sidebar( $left_sidebar ) ) { 
								 dynamic_sidebar( $left_sidebar ); 	
							} ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
					<div class="<?php echo esc_attr($cp_sidebar_class[0]);?> side-bar">
					<?php if ( is_active_sidebar( $right_sidebar ) ) {	
							dynamic_sidebar( $right_sidebar );		
					 } ?>
					</div>
					<?php } ?>						   
				</div>
			</div>
		</div>
	</div>	
<?php 
	}
}
?>
<div class="clear"></div>
<?php get_footer();
}
 ?>