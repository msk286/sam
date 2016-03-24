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
	
	if($maintenance_mode == 'enable'){
		//Trigger the Maintenance Mode Function Here
		cp_maintenance_mode_fun();
	}else{
get_header(); 
 if ( have_posts() ){ while (have_posts()){ the_post();
	
	global $paged,$post,$sidebar,$counter,$wp_query;	
	$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
	$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));

	$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);

	$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
	
	$thumbnail_id = get_post_thumbnail_id( $post->ID, 'ign_project_id', true );
	
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' );


	$getPledge_cp = getPledge_cp($ign_project_id);
	$current_date = date('d-m-Y h:i:s');
	$project_date = new DateTime($ignition_datee);
	$current = new DateTime($current_date);
	$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));
	

	$post_social = '';
	$sidebar = '';
	$right_sidebar = '';
	$left_sidebar = '';
	$ignition_product_detail_xml = get_post_meta($post->ID, 'ignition_product_detail_xml', true);
	if($ignition_product_detail_xml <> ''){
		$cp_post_xml = new DOMDocument ();
		$cp_post_xml->loadXML ( $ignition_product_detail_xml );
		$igni_social = cp_find_xml_value($cp_post_xml->documentElement,'igni_social');
		$sidebars = cp_find_xml_value($cp_post_xml->documentElement,'sidebar_post');
		$right_sidebar_post = cp_find_xml_value($cp_post_xml->documentElement,'right_sidebar_post');
		$left_sidebar_post = cp_find_xml_value($cp_post_xml->documentElement,'left_sidebar_post');
		$post_thumbnail = cp_find_xml_value($cp_post_xml->documentElement,'post_thumbnail');
		$video_url_type = cp_find_xml_value($cp_post_xml->documentElement,'video_url_type');
		$select_slider_type = cp_find_xml_value($cp_post_xml->documentElement,'select_slider_type');			
	}
	$currency = get_option('currency_code_default');
	$purchase_url = '';
	//Get Default Excerpt
	$purchaseform = '';
	$cp_sidebar_class = '';
	$content_class = '';
	//Sidebar for archives
	$cp_sidebar_class = cp_sidebar_func($sidebar);
	
	//Fetch Layout Options
	$select_layout_cp = '';
	$cp_general_settings = get_option('general_settings');
	if($cp_general_settings <> ''){
		$cp_logo = new DOMDocument ();
		$cp_logo->loadXML ( $cp_general_settings );
		$select_layout_cp = cp_find_xml_value($cp_logo->documentElement,'select_layout_cp');
	}
	$thumbnail_types = '';
	$header_style = '';
	$cp_html_class_banner = '';
	$html_class = cp_print_header_class($header_style);
	if($html_class <> ''){$cp_html_class_banner = 'banner';}
	
	$header_style = '';
	//Print Style 5
	if(cp_print_header_html_val($header_style) == 'Style 5'){
		cp_print_header_html($header_style);
	}
	
	$html_class = cp_print_header_class($header_style);
	
		$cp_header_class = '';
		$cp_header_class = cp_print_header_selected();
		
		if($cp_header_class == 'header-style-3'){
			
				$cp_header_class = 'header-style-3';
		}else{
				$cp_header_class == '';
		}
	
	?>
	<div class="contant <?php echo esc_attr($cp_header_class);?>">
		<!--Inner Pages Heading Area Start-->
		<div id="banner">
			<div id="inner-banner">
				<div class="container">
					<?php if(get_the_title() <> ''){ ?>
						<h1><?php echo esc_attr(get_the_title());?></h1>
					<?php }
						if(!is_front_page()){
							echo cp_breadcrumbs();
						}
					?>
				</div>
			</div>
		</div>
		<!--Inner Pages Heading Area End--> 		
		<?php 
		$breadcrumbs = '';
		if($breadcrumbs == 'disable'){
					$cp_class_margin = 'margin_top_cp';
				}else {
					$cp_class_margin = '';
				}
		?>
		<div class="causes-detail blog-detail <?php echo esc_attr($cp_class_margin);?>">
			<div class="container">
			<!--MAIN CONTANT ARTICLE START-->
				<div class="row">
					<?php
					if($sidebar == "left-sidebar" || $sidebar == "both-sidebar" || $sidebar == "both-sidebar-left"){?>
						<div id="block_first" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-left'){?>
						<div id="block_first_left" class="sidebar side-bar <?php echo esc_attr($cp_sidebar_class[0]);?>">
							<?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php } ?>
					<?php $image_size = array(1140,575);?>
					<!--Blog Detail Page Page Start-->
					<div id="<?php the_ID(); ?>" class="<?php echo esc_attr($cp_sidebar_class[1]);?> ignitiondeck <?php echo esc_attr($thumbnail_types);?>">
						<div <?php post_class(); ?>>
							<?php 
							if (isset($_GET['purchaseform'])) {
								echo do_shortcode('[project_purchase_form]');
							}else{  ?>
							
							<div class="fram-box">
								<div class="frame"><a href="<?php echo esc_url(get_permalink());?>"><img src="<?php echo esc_url($thumbnail[0]);?>" alt="img"></a></div>
								<div class="text-box">
									<div class="progress progress-striped active">
										<div class="bar" style="width:<?php echo esc_attr(getPercentRaised_cp($ign_project_id));?>%;"><span><?php echo esc_attr(getPercentRaised_cp($ign_project_id));?>%</span></div>
									</div>
									<div class="detail-row-2">
										<ul>
											<li> <strong class="number"><?php echo esc_attr(getTotalProductFund_cp($ign_project_id));?></strong> <strong class="detail-text"><?php esc_html_e(' Pledged', 'mosque_crunchpress'); ?></strong> </li>
											<li> <strong class="number"><?php esc_html_e('$','mosque_crunchpress');?><?php echo esc_attr($ign_fund_goal);?></strong> <strong class="detail-text"><?php esc_html_e(' Goal', 'mosque_crunchpress'); ?></strong> </li>
											<li> <strong class="number"><?php echo esc_attr($getPledge_cp[0]->p_number);?></strong> <strong class="detail-text"><?php esc_html_e('Pledgers','mosque_crunchpress');?></strong> </li>
										<?php 
											if($days < 1){ ?>
												<li> <strong class="number"></strong> <strong class="detail-text"><?php esc_html_e('Fund Raising Finished','mosque_crunchpress');?></strong> </li>
											<?php }else{ ?>
											<li> <strong class="number"><?php echo esc_attr($days);?></strong> <strong class="detail-text"><?php esc_html_e('Days To Go','mosque_crunchpress');?></strong> </li>
										<?php } ?>
											<li class="btn-color"><a href="<?php echo esc_url(cp_getPurchaseURLfromType($ign_project_id, "purchaseform"));?>" class="btn-back"><?php esc_html_e('Back This','mosque_crunchpress');?> <span><?php esc_html_e('Project','mosque_crunchpress');?></span></a></li>
										</ul>
									</div>
								</div>
								<?php
									echo '<div class="short_dec">';
									$ign_product_video = get_post_meta( $post->ID, "ign_product_video", true );
									echo do_shortcode(html_entity_decode($ign_product_video));
									echo '</div>';
								?>
							</div>
							<h3><?php echo esc_attr(get_the_title());?></h3>
							<div class="detail-row">
								<ul>
									<li><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-user"></i><?php echo esc_attr(get_the_author());?></a></li>
									<li><a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-calendar"></i><?php echo esc_attr(get_the_date());?></a></li>									
									<li>
										<?php
										if ( comments_open() ) :
										  echo '<p>';
										  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');
										  echo '</p>';
										endif;
										?>
									</li>
									<?php $terms = wp_get_post_terms( $post->ID, 'project_type' );
									if(!empty($terms)){ ?> 
									<li>
										<i class="fa fa-list"></i>
										<?php foreach($terms as $term){
												$tags[] = $term->name. ' ';
											}
											$final = implode(', ',$tags);
											echo esc_attr($final);
										?>
	
									</li>
									<?php }?>
								</ul>
								<div class="dropdown">	
								<a class="like share-dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#"><i class="fa fa-share-square-o"></i><?php esc_html_e('Share', 'mosque_crunchpress');?></a>	
								<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">										
								<?php cp_include_social_shares();?> 									
								</ul>									
								</div>															
								<a href="" class="like"><i class="fa fa-heart-o"></i><?php echo get_post_meta($post->ID,'popular_post_views_count',true);?></a>
							</div>
							<p><?php echo do_shortcode(get_the_content());?></p>
							<h3><?php esc_html_e('Level Base Project','mosque_crunchpress');?></h3>
							<?php
							$project_type = get_post_meta( $post->ID, "ign_project_type", true );
							$meta_no_levels = get_post_meta( $post->ID, $name="ign_product_level_count", true );
							if($project_type == 'level-based'){
							?>
							<div class="donation-rank-box">
								<div class="donors-list-box">
									<ul id="tiers">
										<?php
										$meta_title = stripslashes(get_post_meta( $post->ID, $name="ign_product_title", true ));
										$meta_limit = get_post_meta( $post->ID, $name="ign_product_limit", true );
										$meta_price = get_post_meta( $post->ID, $name="ign_product_price", true );
										$meta_desc = stripslashes(get_post_meta( $post->ID, $name="ign_product_details", true ));
										?>
										<li><strong class="number"><?php echo esc_attr($meta_limit);?></strong><strong class="name"><?php echo esc_attr($meta_title);?><span><?php echo esc_attr($meta_desc);?></span></strong><strong class="amount"><span><?php echo esc_attr($meta_price);?></span> <a href="<?php echo cp_getPurchaseURLfromType($ign_project_id, "purchaseform");?>" class="btn-donate"><?php esc_html_e('Donate','mosque_crunchpress');?></a></strong></li>
										<?php
										for ($i=2 ; $i <= $meta_no_levels ; $i++) {
											$meta_title = stripslashes(get_post_meta( $post->ID, $name="ign_product_level_".($i)."_title", true ));
											$meta_limit = get_post_meta( $post->ID, $name="ign_product_level_".($i)."_limit", true );
											$meta_price = get_post_meta( $post->ID, $name="ign_product_level_".($i)."_price", true );
											$meta_desc = stripslashes(get_post_meta( $post->ID, $name="ign_product_level_".($i)."_desc", true ));
											?>
											<li><strong class="number"><?php echo esc_attr($meta_limit);?></strong><strong class="name"><?php echo esc_attr($meta_title);?><span><?php echo esc_attr($meta_desc);?></span></strong><strong class="amount"><span><?php echo esc_attr($meta_price);?></span> <a href="<?php echo cp_getPurchaseURLfromType($ign_project_id, "purchaseform").'&level='.$i;?>" class="btn-donate"><?php esc_html_e('Donate','mosque_crunchpress');?></a></strong></li>
											<?php
										} ?>
									</ul>
								</div>
							</div>	
							<?php } 
							echo '<div class="short_dec"><h3>'.esc_html__('Short Description','mosque_crunchpress').'</h3>';
								echo '<p>'.do_shortcode(html_entity_decode(get_post_meta( $post->ID, "ign_project_description", true ))).'</p>';
							echo '</div>';
							
							$ign_product_image2 = get_post_meta($post->ID, 'ign_product_image2', true);
							$ign_product_image3 = get_post_meta($post->ID, 'ign_product_image3', true);
							$ign_product_image4 = get_post_meta($post->ID, 'ign_product_image4', true);
							if($ign_product_image2 <> ''){ ?>
							<div class="extra-images gallery">
								<?php if($ign_product_image2 <> ''){ ?><a data-rel="prettyphoto[]" href="<?php echo esc_url($ign_product_image2);?>"><img src="<?php echo esc_url($ign_product_image2);?>" alt=""></a><?php } ?>
								<?php if($ign_product_image3 <> ''){ ?><a data-rel="prettyphoto[]" href="<?php echo esc_url($ign_product_image3);?>"><img src="<?php echo esc_url($ign_product_image3);?>" alt=""></a><?php } ?>
								<?php if($ign_product_image4 <> ''){ ?><a data-rel="prettyphoto[]" href="<?php echo esc_url($ign_product_image4);?>"><img src="<?php echo esc_url($ign_product_image4);?>" alt=""></a><?php } ?>
							</div>
							<?php }
							$terms = wp_get_post_terms( $post->ID, 'post_tag' );
							if(!empty($terms)){ ?> 
							<ul class="tags">
								<li><strong class="title"><?php esc_html_e('Tags:','mosque_crunchpress');?></strong></li>
								
								<?php foreach($terms as $term){
									echo '<li><a href="'.get_term_link($term).'">'.esc_attr($term->name).'</a></li>';
								} ?>
							</ul>
							<?php }?>
							<div class="comment-box">
								<h3><?php esc_html_e('About Post Author','mosque_crunchpress');?></h3>
								<div class="author-row">
									<div class="cp-frame">
										<a href="<?php echo esc_url(get_permalink());?>"><?php echo get_avatar(get_the_author_meta('ID'));?></a>
									</div>
									<div class="text-box">
										<strong class="name">
											<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author(); ?></a>
										</strong>
										<p><?php echo mb_substr(esc_html(get_the_author_meta( 'description' )),0,360);?></p>
									</div>
								</div>
								<!--COMMENT FORM START-->
								<?php comments_template(); ?>
								<!--COMMENT FORM END--> 
							</div>
						<?php }?>
						</div>
						<!--Blog Detail Page Page End--> 
					</div>
					<?php
					if($sidebar == "both-sidebar-right"){?>
						<div class="<?php echo esc_attr($cp_sidebar_class[0]);?> side-bar">
							<?php dynamic_sidebar( $left_sidebar ); ?>
						</div>
						<?php
					}
					if($sidebar == 'both-sidebar-right' || $sidebar == "right-sidebar" || $sidebar == "both-sidebar"){?>
						<div class="<?php echo esc_attr($cp_sidebar_class[0]);?> side-bar">
							<?php dynamic_sidebar( $right_sidebar );?>
						</div>
					<?php } ?>				
				</div>
			</div>
		</div>
	</div>
<?php 
	}
}
	}
?>
<div class="clear"></div>
<?php get_footer(); ?>