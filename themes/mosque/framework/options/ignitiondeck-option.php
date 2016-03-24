<?php

	/*	
	*	Crunchpress Portfolio Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file create and contains the portfolio post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	//FRONT END RECIPE LAYOUT
	$cp_wooproduct_class = array("Full-Image" => array("index"=>"1", "class"=>"sixteen ", "size"=>array(1170,420), "size2"=>array(770, 400), "size3"=>array(570,300)));

	
	// Print Recipe item
	function print_ignition_item($item_xml){
		wp_reset_query();
		global $paged,$sidebar,$cp_wooproduct_class,$post,$wp_query,$counter;
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
		$cp_sidebar_class = '';
		$layout_set_ajax = '';
		$item_type = 'Full-Image';
		// get the item class and size from array
		$item_class = $cp_wooproduct_class[$item_type]['class'];
		$item_index = $cp_wooproduct_class[$item_type]['index'];
		$full_content = cp_find_xml_value($item_xml, 'show-full-news-post');
		if( $sidebar == "no-sidebar" ){
			$item_size = $cp_wooproduct_class[$item_type]['size'];
			$cp_sidebar_class = 'no_sidebar';
		}else if ( $sidebar == "left-sidebar" || $sidebar == "right-sidebar" ){
			$cp_sidebar_class = 'one_sidebar';
			$item_size = $cp_wooproduct_class[$item_type]['size2'];
		}else{
			$cp_sidebar_class = 'two_sidebar';
			$item_size = $cp_wooproduct_class[$item_type]['size3'];
		}
		
				
		// get the product meta value
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		$layout_select = cp_find_xml_value($item_xml, 'layout_select');
		$num_excerpt = cp_find_xml_value($item_xml, 'num-excerpt');		
		
		
		$pagination = cp_find_xml_value($item_xml, 'pagination');
		$category_name = '';
	
		$custom_class = '';
		if($layout_select == 'Grid'){
			$custom_class= 'cp_causes_grid';
		}else{
			$custom_class = '';
		}
		
		$quan = array();
		$quantity = '';
		$total = '';
		$currency = '';
		if($layout_select <> 'Map View'){
			echo '<div class="causes-listing '.$custom_class.'"><div class="causes-row row">';
			
			wp_register_script('material-menu', CP_PATH_URL.'/frontend/js/materialMenu.min.js', false, '1.0', true);
			wp_enqueue_script('material-menu');
		}
				if($category == '0'){
					query_posts(array(
						'posts_per_page'=> $num_fetch,
						'paged'			=> $paged,
						'post_type'   	=> 'ignition_product',
						'post_status'	=> 'publish',
						'order'			=> 'DESC',
					));
				}else{
					query_posts(array(
						'posts_per_page'=> $num_fetch,
						'paged'	=> $paged,
						'post_type'   => 'ignition_product',
						'tax_query' => array(
								array(
									'taxonomy' => 'project_category',
									'field' => 'term_id',
									'terms' => $category
								)
						),
						'post_status'      => 'publish',
						'order'				=> 'DESC',
					));
				}
				$counter_ignition = 0;
				while( have_posts() ){
					the_post();	
					global $counter,$post;
					$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
					
					$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
					
					$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);
					
					$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
					
					$ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);
					
					$thumbnail_id = get_post_thumbnail_id( $post->ID, 'ign_project_id', true );
	
					
					
					$getPledge_cp = getPledge_cp($ign_project_id);
					$current_date = date('d-m-Y h:i:s');
					$project_date = new DateTime($ignition_datee);
					$current = new DateTime($current_date);
					$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));
					if($layout_select == 'Grid'){
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(360, 300) );
						if($counter_ignition % 4 == 0){ $item_class = 'col-md-4 first';$item_div = '<div class="clearfix"></div>';}else{$item_class = "col-md-4";$item_div = '';}$counter_ignition++;	?>
						<div class="<?php echo esc_attr($item_class);?>">
							<div class="causes-list-box">
								<div class="frame">
									<a href="<?php echo esc_url(get_permalink());?>"><img src="<?php echo esc_url($thumbnail[0]);?>" alt="img"></a>
									<div class="caption"><a class="link" href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-link"></i></a></div>
								</div>
								<div class="text-box">
									<h3>
										<a href="<?php echo esc_url(get_permalink());?>">
										<?php
											if(strlen(get_the_title()) < 25 ){
												echo get_the_title();	
											}else{
												echo substr(get_the_title(), 0 , 25). '...';
											}		
										?>
										</a>
									</h3>
									<a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-user"></i><?php echo get_the_author();?></a>
									<a href="<?php echo esc_url(get_permalink());?>"><i class="fa fa-clock-o"></i><?php echo get_the_date();?></a>
									<p>
										<?php 
											$ign_project_description = get_post_meta( $post->ID, "ign_project_description", true );
											echo substr($ign_project_description,0,$num_excerpt);	
										?>
									</p>
									<div class="causes-tab-tags">
										<ul>
											<?php
											$terms = wp_get_post_terms( $post->ID, 'post_tag');
											$count = 0;
											foreach($terms as $term){
												echo '<li>';
												if($count == 0){
													echo '<i class="fa fa-tag"></i>';	
												}$count++;
												echo '<a href="'.get_term_link($term).'">'.esc_attr($term->name).',</a></li>';
											}
											?>
										</ul>
									</div>
									
									<div class="causes-list-progress">
										<div class="progress">
										  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo esc_attr(getPercentRaised_cp($ign_project_id));?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr(getPercentRaised_cp($ign_project_id));?>%">
											<span class="sr-only"><?php echo esc_attr(getPercentRaised_cp($ign_project_id));?></span>
										  </div>
										</div>
									</div>
								</div>
								<div class="detail-row-2">
									<ul>
										<li><strong class="number"><?php echo esc_attr(getTotalProductFund_cp($ign_project_id));?></strong> <strong class="detail-text"><?php esc_html_e('Pledged','mosque_crunchpress');?></strong></li>
										<li><strong class="number"><?php echo esc_attr($getPledge_cp[0]->p_number);?> </strong> <strong class="detail-text"><?php esc_html_e('Backers','mosque_crunchpress');?></strong></li>
										<li><?php if($days < 1){ echo '<strong class="detail-text">'. esc_attr__('FundRaising Finished','mosque_crunchpress').'</strong>';}else{ ?><?php echo '<strong class="number">'.$days.'</strong>';  echo '<strong class="detail-text">'.esc_attr__('Days To Go','mosque_crunchpress').'</strong>';?><?php }?></li>
									</ul>
								</div>
								<a href="<?php echo esc_url(get_permalink());?>" class="btn-5"><?php esc_attr_e('Back This Project','mosque_crunchpress');?></a>
							</div>
						</div>	
						<?php
					}else if($layout_select == 'Full Width'){
						$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(370, 310) );
						$item_class = 'col-md-12';
						$item_div = ''; ?>
						<!--Crowdfunding START-->
						<?php echo esc_attr($item_div); ?>
						<div class="causes_list <?php echo esc_attr($item_class);?>">
							<div class="causes-list-box row-fluid">
								<div class="cp_ignition_image">
									<div class="frame">
										<a href="<?php echo esc_url(get_permalink());?>"><img src="<?php echo esc_url($thumbnail[0]);?>" alt="img"></a>
										<div class="caption"><a class="back-top" href="<?php echo esc_url(get_permalink());?>"><?php esc_attr_e('Back This Project','mosque_crunchpress');?></a></div>
									</div>
								</div>
								<div class="cp_ignition_content">
									<div class="text-box">
										<h3>
											<a href="<?php echo esc_url(get_permalink());?>">
												<?php
													if(strlen(get_the_title()) < 35 ){	
															echo get_the_title();
													}else{
															echo substr(get_the_title(), 0 , 35). '...';
													}		
												?>
											</a>
										</h3>
										<p>
											<?php 
												$ign_project_description = get_post_meta( $post->ID, "ign_project_description", true );
												echo esc_attr(strip_tags(substr($ign_project_description,0,$num_excerpt)));	
											?>
										</p>
										
										<div class="causes-list-progress">
											<div class="progress">
												  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo esc_attr(getPercentRaised_cp($ign_project_id));?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo esc_attr(getPercentRaised_cp($ign_project_id));?>%">
													<span class="sr-only"><?php echo esc_attr(getPercentRaised_cp($ign_project_id));?></span>
												  </div>
											</div>
											
										</div>
									</div>
									<div class="detail-row-2">
										<ul>
											<li><strong class="number"><?php echo esc_attr(getTotalProductFund_cp($ign_project_id));?></strong> <strong class="detail-text"><?php esc_attr_e('Pledged','mosque_crunchpress');?></strong></li>
											<li> <strong class="number"><?php esc_html_e('$','mosque_crunchpress');?><?php echo esc_attr($ign_fund_goal);?></strong> <strong class="detail-text"><?php esc_html_e(' Goal', 'mosque_crunchpress'); ?></strong> </li>
											
										</ul>
									</div>
									<div class = "cp_ignition_share">
										<ul class = "ignition_social_icons">
											<li><?php esc_html_e('Share','mosque_crunchpress');?></li>
											<?php
											//Getting Values from database
												$cp_social_settings = get_option('social_settings');
												if($cp_social_settings <> ''){
													$cp_social = new DOMDocument ();
													$cp_social->loadXML ( $cp_social_settings );
												
													// Social Sharing Values
													$facebook_sharing = cp_find_xml_value($cp_social->documentElement,'facebook_sharing');
													$twitter_sharing = cp_find_xml_value($cp_social->documentElement,'twitter_sharing');
													$googleplus_sharing = cp_find_xml_value($cp_social->documentElement,'googleplus_sharing');
												}
												
												$currentUrl = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
												if( !empty($_SERVER['HTTPS']) ){
													$currentUrl = "https://" . $currentUrl;
												}else{
													$currentUrl = "http://" . $currentUrl;
												}
												$facebook = 'http://www.facebook.com/share.php?u='.$currentUrl;
												$twitter = 'http://twitter.com/home?status='.str_replace(" ", "%20", get_the_title()).'%20-%20'.$currentUrl;
												$gplus = 'https://plus.google.com/share?url={'.$currentUrl.'}';
											
											?>
											<?php
												if($facebook_sharing == 'enable'){ ?>
													<li><a href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a></li><?php 
												}
												if($twitter_sharing == 'enable'){ ?>
													<li><a href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a></li><?php 
												}
												if($googleplus_sharing == 'enable'){ ?>
													<li><a href="<?php echo esc_url($gplus);?>"><i class="fa fa-google-plus"></i><span></span></a></li><?php 
												}
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						
						<!--Crowdfunding END-->
						<?php
					}else if($layout_select == 'Grid Compact'){						
					
					$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(360, 300) );
						$item_class = 'col-md-4';
						$item_div = ''; ?>
						
						<div class="<?php echo esc_attr($item_class);?>">
							<div class="our-causes-box">
								<div class="frame"><a href="<?php echo esc_url(get_permalink());?>"><img src="<?php echo esc_url($thumbnail[0]);?>" alt="img"></a></div>
								<div class="text-box">
									<h3><?php echo esc_attr(substr(get_the_title(),0,25));?></h3>
									<div class="progress-boar">
										<div class="progress progress-striped active">
											<div style="width:<?php echo esc_attr(getPercentRaised_cp($ign_project_id));?>%;" class="bar"></div>
										</div>
										<strong class="amount"><?php esc_html_e('$','mosque_crunchpress');?><?php echo esc_attr(getPercentRaised_cp($ign_project_id));?></strong>
										<strong class="target"><?php esc_html_e('$','mosque_crunchpress');?><?php echo esc_attr($ign_fund_goal);?></strong>
										<strong class="percentage"><?php echo esc_attr($getPledge_cp[0]->p_number);?> <?php esc_attr_e('Donated','mosque_crunchpress');?></strong>
									</div>
									<a class="btn-1" href="<?php echo esc_url(get_permalink());?>"><?php esc_attr_e('Make A donation','mosque_crunchpress');?></a>
								</div>
							</div>
						</div>	
					<?php
					}else{
						echo '<div id="map-sec"></div>';
					}
				} wp_reset_query(); // End While 
				$pagination = cp_find_xml_value($item_xml, 'pagination'); 
				if($pagination == "Theme-Custom"){	
					cp_pagination();
				}
				wp_reset_postdata();
				
			if($layout_select <> 'Map View'){
				echo '</div></div>';
			}
			?>
			<!--Crowdfunding ROW END-->
		<div class="clear"></div>
		<?php
		if( cp_find_xml_value($item_xml, "pagination") == "Custom"){	
			
		}	
	}
	
	
	function cp_print_ignition_slider_item ($item_xml){
		
		wp_reset_query();
		
		global $paged,$sidebar,$cp_wooproduct_class,$post,$wp_query,$counter;
		
		if(empty($paged)){
			$paged = (get_query_var('page')) ? get_query_var('page') : 1; 
		}
	
		// get the product meta value
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');

		$category_name = '';

		$quan = array();
		$quantity = '';
		$total = '';
		$currency = '';
		
			if($category == '0'){
				query_posts(array(
					'posts_per_page'=> $num_fetch,
					'paged'			=> $paged,
					'post_type'   	=> 'ignition_product',
					'post_status'	=> 'publish',
					'order'			=> 'DESC',
				));
			}else{
				query_posts(array(
					'posts_per_page'=> $num_fetch,
					'paged'	=> $paged,
					'post_type'   => 'ignition_product',
					'tax_query' => array(
							array(
								'taxonomy' => 'project_category',
								'field' => 'term_id',
								'terms' => $category
							)
					),
					'post_status'   => 'publish',
					'order'			=> 'DESC',
				));
			}
				
		?>
		<div class = "cp_charity_slider">
		
			<script type="text/javascript">
				jQuery(document).ready(function ($) {
						"use strict";
						 if ($('.slider1').length) {
							$('.slider1').bxSlider({
								slideWidth: 350,
								minSlides: 2,
								maxSlides: 3,
								slideMargin: 30,
								infiniteLoop: true,
								auto: true,
								pager: true
							});
						}
				});
			</script>
		
		<div class="slider1">
			<?php
				$counter_ignition = 0;
				while( have_posts() ){
					the_post();	
					global $counter,$post;
					$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
					
					$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
					
					$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);
					
					$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
					
					$ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);
					
					$thumbnail_id = get_post_thumbnail_id( $post->ID, 'ign_project_id', true );

					$getPledge_cp = getPledge_cp($ign_project_id);
					$current_date = date('d-m-Y h:i:s');
					$project_date = new DateTime($ignition_datee);
					$current = new DateTime($current_date);
					$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));
					$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(360, 300) );
					
					?>
					<div class="our-causes-box">
						<div class="frame"><a href="<?php echo esc_url(get_permalink());?>"><img src="<?php echo esc_url($thumbnail[0]);?>" alt="img"></a></div>
						<div class="text-box">
							<h3><?php echo esc_attr(substr(get_the_title(),0,25));?></h3>
							<div class="progress-boar">
								<div class="progress progress-striped active">
									<div style="width:<?php echo esc_attr(getPercentRaised_cp($ign_project_id));?>%;" class="bar"></div>									
									
								</div>
								<strong class="amount"><?php esc_html_e('$','mosque_crunchpress');?><?php echo esc_attr(getPercentRaised_cp($ign_project_id));?></strong>
								<strong class="target"><?php esc_html_e('$','mosque_crunchpress');?><?php echo esc_attr($ign_fund_goal);?></strong>
								<strong class="percentage"><?php echo esc_attr($getPledge_cp[0]->p_number);?> <?php esc_attr_e('Donated','mosque_crunchpress');?></strong>
							</div>
							<a class="btn-1" href="<?php echo esc_url(get_permalink());?>"><?php esc_attr_e('Make A donation','mosque_crunchpress');?></a>
						</div>
					</div>
		<?php   }// end while
				wp_reset_postdata();
				wp_reset_query();		?>
		</div>
		</div>
<?php } //Function Ends
	
	

	function cp_feature_projects($item_xml){
		$header = cp_find_xml_value($item_xml, 'header');
		$category = cp_find_xml_value($item_xml, 'category');
		$num_fetch = cp_find_xml_value($item_xml, 'num-fetch');
		$view_all_link = cp_find_xml_value($item_xml, 'view_all_link');
		
		
		$quan = array();
		$quantity = '';
		$total = '';
		$currency = '';
		echo '<div class="eco-features main-causes">';
		if($category == '0'){
			query_posts(array(
				'posts_per_page'=> $num_fetch,
				// 'paged'			=> $paged,
				'post_type'   	=> 'ignition_product',
				'post_status'	=> 'publish',
				'order'			=> 'DESC',
			));
		}else{
			query_posts(array(
				'posts_per_page'=> $num_fetch,
				// 'paged'	=> $paged,
				'post_type'   => 'ignition_product',
				'tax_query' => array(
					array(
						'taxonomy' => 'project_category',
						'field' => 'term_id',
						'terms' => $category
					)
				),
				'post_status'      => 'publish',
				'order'						=> 'DESC',
			));
		}
		//condition for post available or not
		if(have_posts()){
		
			$counter_ignition = 0;
			echo '<ul class="nav nav-tabs" id="myTab">';
				
			
			while( have_posts() ){
				the_post();	
				global $counter,$post;
				$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
				$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
				$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);
				$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
				$ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);
				$thumbnail_id = get_post_thumbnail_id( $post->ID, 'ign_project_id', true );
				$getPledge_cp = getPledge_cp($ign_project_id);
				$current_date = date('d-m-Y h:i:s');
				$project_date = new DateTime($ignition_datee);
				$current = new DateTime($current_date);
				$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(570, 300) );$counter_ignition++;
				echo '<li role="presentation" ><a aria-controls="tab-'.esc_attr($counter_ignition).'" role="tab" data-toggle="tab" href="#tab-'.esc_attr($counter_ignition).'">'.substr(esc_attr(get_the_title()),0,15).'</a></li>';
				
			}
			echo '</ul>';
			$counter_ignition = 0;
			echo '<div class="causes-tab-content">
            <div class="tab-content">';
			while( have_posts() ){
				the_post();	
				global $counter,$post;
				$ignition_date = get_post_meta($post->ID, 'ign_fund_end', true);
				$ignition_datee = date('d-m-Y h:i:s',strtotime($ignition_date));
				$ign_project_id = get_post_meta($post->ID, 'ign_project_id', true);
				$ign_fund_goal = get_post_meta($post->ID, 'ign_fund_goal', true);
				$ign_product_image1 = get_post_meta($post->ID, 'ign_product_image1', true);
				$thumbnail_id = get_post_thumbnail_id( $post->ID, 'ign_project_id', true );
				$getPledge_cp = getPledge_cp($ign_project_id);
				$current_date = date('d-m-Y h:i:s');
				$project_date = new DateTime($ignition_datee);
				$current = new DateTime($current_date);
				$days = round(($project_date->format('U') - $current->format('U')) / (60*60*24));
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , array(570, 300) );
				$item_class = '';
				if($counter_ignition == 0){$item_class = 'active';}else{$item_class = '';}$counter_ignition++;
				
              echo '<div role="tabpanel" class="tab-pane '.esc_attr($item_class).'" id="tab-'.esc_attr($counter_ignition).'">
                <div class="row">
                  <div class="col-md-5">
                    <div class="frame"><a href="'.esc_url(get_permalink()).'"><img src="'.esc_url($thumbnail[0]).'" alt="img"></a></div>
                  </div>
                  <div class="col-md-5">
                    <div class="text-box">
                      '.substr(get_the_content(),0,196).'
                      <div class="progress-box">
                        <div class="progress progress-striped active">
                          <div class="bar" style="width:'.esc_attr(getPercentRaised_cp($ign_project_id)).'%;"></div>
                        </div>
                      </div>
                      <div class="causes-tab-tags"><ul>';
						$terms = wp_get_post_terms( $post->ID, 'project_category');
						$count = 0;
						foreach($terms as $term){
							echo '<li>';
							if($count == 0){
								echo '<i class="fa fa-tag"></i>';	
							}$count++;
							echo '<a href="'.esc_url(get_term_link($term)).'">'.esc_attr($term->name).'</a></li>';
						}
                       echo '</ul></div>
						<a href="#"><i class="fa fa-map-marker"></i>New York, South Africa, Albania, Sweden</a>
					</div>
                  </div>
                  <div class="col-md-2">
                    <div class="donation-detail">
                      <ul>
                        <li> <strong class="number">'.esc_attr(getPercentRaised_cp($ign_project_id)).'%</strong> <strong class="detail">Donated</strong> </li>
                        <li> <strong class="number">$'.esc_attr($ign_fund_goal).'</strong> <strong class="detail">Pledged</strong> </li>
                        <li> <strong class="number">'.esc_attr($getPledge_cp[0]->p_number).'</strong> <strong class="detail">Backers</strong> </li>';
						if($days < 1){
							echo '<li> <strong class="number"></strong> <strong class="detail">Fund Raising Finished</strong> </li>';
						}else {
							  echo '<li> <strong class="number">'.esc_attr($days).'</strong> <strong class="detail">Days To Go</strong> </li>';
						}
                     echo' </ul>
                    </div>
                  </div>
                </div>
                <div class="btn-row">
					<a href="'.esc_url(get_permalink()).'" class="btn-5">'.esc_attr__('Cause Details','mosque_crunchpress').'</a>
					<a href="'.esc_url($view_all_link).'" class="btn-5">'.esc_attr__('View All Causes','mosque_crunchpress').'</a>
				</div>
              </div>
              ';
			} wp_reset_postdata();	
			echo '</div>';
		echo '</div>';
		}wp_reset_query();
		echo '</div>';
	}		// Ignition Deck Slider	
	
	

	function getTotalProductFund_cp($productid) {
		global $wpdb;		
		
		$sql = "Select SUM(prod_price) AS prod_price from ".$wpdb->prefix . "ign_pay_info where product_id='".$productid."'";
		
		$result = $wpdb->get_row($sql);
		if ($result->prod_price != NULL || $result->prod_price != 0)
			return $result->prod_price;
		else
			return 0;
	}

	function getProjectGoal_cp($project_id) {
		global $wpdb;
		$goal_return = array('');
		$goal_query = $wpdb->prepare('SELECT goal FROM '.$wpdb->prefix.'ign_products WHERE id=%d', $project_id);
		$goal_return = $wpdb->get_row($goal_query);
		if($goal_return <> ''){
			return $goal_return->goal;
		}
	}
	function getPledge_cp($project_id) {
		global $wpdb;

		$p_query = "SELECT count(*) as p_number FROM ".$wpdb->prefix . "ign_pay_info where product_id='".$project_id."'";
		$p_counts = $wpdb->get_results($p_query);
		return $p_counts;
	}


	function getPercentRaised_cp($project_id) {
		global $wpdb;
		$total = getTotalProductFund_cp($project_id);
		$goal = getProjectGoal_cp($project_id);
		$percent = 0;
		if ($total > 0) {
			$percent = number_format($total/$goal*100, 2, '.', '');
		}
		return $percent;
	}
	
?>