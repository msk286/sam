<?php get_header(); 
if ( have_posts() ){ while (have_posts()){ the_post();
	global $post;
	
	// Get Post Meta Elements detail 
	$post_social = '';
	$sidebar = '';
	$right_sidebar = '';
	$left_sidebar = '';
	$thumbnail_types = '';
	
	$cp_field_name = get_post_meta($post->ID, 'cp_field_name', true);
	$cp_field_val = get_post_meta($post->ID, 'cp_field_val', true);
	$post_format = get_post_meta($post->ID, 'post_format', true);
	$service_detail_xml = get_post_meta($post->ID, 'service_detail_xml', true);
	if($service_detail_xml <> ''){
		$cp_post_xml = new DOMDocument ();
		$cp_post_xml->loadXML ( $service_detail_xml );
		$post_social = cp_find_xml_value($cp_post_xml->documentElement,'post_social');
		$sidebar = cp_find_xml_value($cp_post_xml->documentElement,'sidebars_port');
		$right_sidebar = cp_find_xml_value($cp_post_xml->documentElement,'right_sidebar_port');
		$left_sidebar = cp_find_xml_value($cp_post_xml->documentElement,'left_sidebar_port');		
		$thumbnail_types = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
		$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
		$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');	
		$regular_price = cp_find_xml_value($cp_post_xml->documentElement,'regular_price');
		$current_price = cp_find_xml_value($cp_post_xml->documentElement,'current_price');
		$duration = cp_find_xml_value($cp_post_xml->documentElement,'duration');
		$start_time = cp_find_xml_value($cp_post_xml->documentElement,'start_time');
		$end_time = cp_find_xml_value($cp_post_xml->documentElement,'end_time');
		$service_caption = cp_find_xml_value($cp_post_xml->documentElement,'service_caption');
		$product_selected = cp_find_xml_value($cp_post_xml->documentElement,'product_selected');
		$service_btn_title = cp_find_xml_value($cp_post_xml->documentElement,'service_btn_title');
		$service_btn_link = cp_find_xml_value($cp_post_xml->documentElement,'service_btn_link');
	}	
	$cp_page_caption = '';
	$select_layout_cp = '';
	$cp_general_settings = get_option('general_settings');
	if($cp_general_settings <> ''){
		$cp_logo = new DOMDocument ();
		$cp_logo->loadXML ( $cp_general_settings );
		$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
	}
	
	$cp_sidebar_class = '';
	$content_class = '';
	$cp_class_margin = '';
	//Get Sidebar for page
	$cp_sidebar_class = cp_sidebar_func($sidebar);
	$header_style = '';
	$breadcrumbs = cp_get_themeoption_value('breadcrumbs','general_settings');
	//Print Style 6
	if(cp_print_header_html_val($header_style) == 'Style 5'){
		cp_print_header_html($header_style);
	}
	$header_style = '';
	$html_class = cp_print_header_class($header_style);
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
			<?php if($breadcrumbs == 'enable'){?>
				<div class="bg_transparent">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<?php if($service_caption <> ''){ ?><h5><?php echo esc_attr($service_caption);?></h5><?php }?>
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
			<?php } ?>
		</section>	
		<?php 
			if($breadcrumbs == 'disable'){
				$cp_class_margin = 'margin_top_cp';
			}else {
				$cp_class_margin = '';
			}
		?>		
		<!--Inner Pages Heading Area End--> 		
		<div class="services-details <?php echo esc_attr($cp_class_margin);?>">
			<div class="container">
				<!--MAIN CONTANT ARTICLE START-->
				<div class="main-content">
					<div class="row">
						<?php
						if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
							<div id="block_first" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
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
							$image_size = array(570,300);
						?>
						<!--Blog Detail Page Page Start-->
						<div id="<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> blog-content <?php echo esc_attr($thumbnail_types);?>">		
							<div class="row">						
								<?php if(get_the_post_thumbnail($post->ID,$image_size) <> ''){ ?>
									<div class="col-md-5 col-sm-5"><?php echo get_the_post_thumbnail($post->ID,$image_size);?></div>
								<?php } ?>
								<!-- /.details ./-->
								<div class="<?php if(get_the_post_thumbnail($post->ID,$image_size) <> ''){echo 'col-md-7 col-sm-7'; }else{echo 'col-md-12';}?>"> 
									<?php if(get_the_title() <> ''){ ?>
										<strong class="title"> <?php echo esc_attr(get_the_title());?></strong>
									<?php }?>
									<div class="prices">
										<?php if($current_price <> ''){ ?>
											<span class="disc-price"><?php esc_attr_e('Discounted Price:', 'mosque_crunchpress'); ?> <?php echo esc_attr($current_price); ?></span>
											<?php if($regular_price <> ''){ ?><span class="orig-price"><?php esc_html_e('Original Price:', 'mosque_crunchpress'); ?> <?php echo esc_attr($regular_price); ?></span><?php }?>
										<?php }else{ ?> 
											<span class="disc-price"><?php esc_html_e('Price:', 'mosque_crunchpress'); ?> <?php echo esc_attr($regular_price); ?></span>
										<?php }?>
									</div>
									<ul>
									  <li> <strong><?php esc_html_e('Duration: ', 'mosque_crunchpress'); ?></strong><?php echo esc_attr($duration) . ' '; ?><?php esc_html_e('Minutes', 'mosque_crunchpress'); ?></li>
									  <li> <strong><?php esc_html_e('Timings:', 'mosque_crunchpress'); ?></strong> <?php echo esc_attr($start_time);?> - <?php echo esc_attr($end_time);?></li>
									  <?php
										$children = '';
										$children_title = '';
										$nofields = '';
										//Sidebar addition
										if($cp_field_name <> ''){
											$cp_field_n_xml = new DOMDocument();
											$cp_field_n_xml->loadXML($cp_field_name);
											$cp_field_title = $cp_field_n_xml->documentElement->childNodes;
											$nofields = $cp_field_n_xml->documentElement->childNodes->length;
										}		

										if($cp_field_val <> ''){	
											$cp_field_t_xml = new DOMDocument();
											$cp_field_t_xml->loadXML($cp_field_val);
											$cp_field_val = $cp_field_t_xml->documentElement->childNodes;
										}
										$counter = 0;								
										if($nofields <> ''){
											for($i=0;$i<$nofields;$i++) { 
												$counter++;
												echo '<li> <strong>'.esc_attr($cp_field_title->item($i)->nodeValue).'</strong> '.esc_attr($cp_field_val->item($i)->nodeValue).'</li>';
											}
										}	
									  ?>
									</ul>
									<?php if($service_btn_title <> ''){ ?>
										<a href="<?php echo esc_url($service_btn_link);?>" class="readmore"><?php echo esc_attr($service_btn_title); ?></a>
									<?php }else{ ?>
										<a href="<?php echo esc_url($service_btn_link);?>" class="readmore"><?php esc_html_e('More', 'mosque_crunchpress'); ?></a>
									<?php }?>
								</div>							
								<div class="gap-20"></div>
								<div class="col-md-12"> 
									<?php the_content();?>
								</div>
								<div class="blog-share">
									<div class="title"><strong><?php esc_html_e('Share Post','mosque_crunchpress');?></strong></div>
									<div class="social"> 
										<?php cp_include_social_shares();?>
									</div>
								</div>
							</div>
							<strong class="title1"><?php esc_html_e('Other Services','mosque_crunchpress');?></strong>
							<?php echo cp_related_project($post);?>
						</div>
						<!--Blog Detail Page Page End--> 
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
	</div>
<?php 
	}
}
?>
<div class="clear"></div>
<?php get_footer(); ?>