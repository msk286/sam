<?php 
/*	
*	CrunchPress Headers File
*	---------------------------------------------------------------------
* 	@version	1.0
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file Contain all the custom Built in function 
*	Developer Note: do not update this file.
*	---------------------------------------------------------------------
*/

	function cp_header_style_1(){ ?>
		<!--Header Start-->
		 <script>
            jQuery(document).ready(function($) {
                "use strict";
                var menu = new Menu;
				
            });
        </script>
		  <header class="header1 cp-header-sec" id="header"> 
			<!--Logo Row Start-->
			<section class="logo-row">
			  <div class="container">
				<div class="row"> 
				  <div class="col-md-2">
					<?php cp_default_logo(); ?>
				  </div>
					<div class = "col-md-10">
					  <!-- Prayer Time -->
                      <div class="cp-top-row-nav">
						<div class= "row">
							<div class = "col-md-12">
                              <ul class="top-prayer">
								<?php 
								$salat_time = cp_get_themeoption_value('salat_time','general_settings');
								if($salat_time == 'enable'){
									echo '<li>'.esc_attr('Prayer Time: ','mosque_crunchpress').'</li> ';
									/* Salat Time Plugin Shortcode */
									echo do_shortcode('[daily_salat_times_header]');
								}
								?>
								<li><div class="burger"> <i class="fa fa-search"></i></div></li>
								<li class= "material_menu">
									<button id="mm-menu-toggle" class="mm-menu-toggle"><i class="fa fa-bars"></i></button>
								</li>
                              </ul>
							</div>
						</div>
                      </div>
					  <!-- Nav Menu --->
                      <div class="cp-main-navrow">
						<div class= "row">
							<div class = "col-md-12">
								<div class="navigation">
									<?php cp_bootstrap_menu('header-menu'); ?>
								</div>
							</div>
						</div>
                      </div>
					</div>
				</div>
				<!--Logo End--> 
			  </div>
			</section>
		  </header>
		  <!-- Search HTML -->
			<div class="search_div">
				<div class = "container">
					<form id="cp-top-search" method="get" action="<?php  echo esc_url(home_url('/')); ?>">
						<input name="s" type="text" class="top-search-input" placeholder="<?php esc_html_e('Search for...','mosque_crunchpress');?>" value="<?php the_search_query(); ?>">
						<button type="submit" value="" class="top-search-btn"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
		  <!--Search Ends -->
		  <!--Material Sidebar Start-->
			<div id="side_bar_nav">
				<div class="wrapper"></div>
				<div class="mm_logo"><?php cp_default_logo(); ?></div>
				<nav id="mm-menu" class="mm-menu">
					<?php wp_nav_menu( array( 'menu'=> 'header-menu', 'menu_class' => 'sidebar-nav mm-menu__items', )); ?>
					<?php //cp_bootstrap_menu('sidebar-nav mm-menu__items'); ?>
				</nav>
				<div class="mm_footer">
					<div class="mm_social_icons"><?php cp_social_icons_list_new('mm_social');?></div>
					<div class="mm_copyright"><?php echo esc_attr(cp_get_themeoption_value('copyright_code','general_settings'));?></div>
				</div>
			</div>
			<!--Material Sidebar Menu End-->
		  <!--Header End-->		
	<?php 
	} 
	
	
	//Header Function 2 Start- Mosque New
	function cp_header_style_2(){ ?>
		<!--Header Start-->
		  <header class="header2 cp-header-sec" id="header"> 
			<!--Header Tobar Start-->
			<section class="header-topbar">
			  <div class="container">
				<div class="row"> 
				  <!--Topbar Navigation Start-->
				  <div class="col-md-6">
					<?php cp_normal_menu('top-menu','topbar-nav');?>
				  </div>
				  <!--Topbar Navigation End--> 
				  <!--Login Bar Start-->
				  <div class="col-md-6">
					<div class="login-bar">
					  <ul>
					  <?php 
						  $topsign_icon = cp_get_themeoption_value('topsign_icon','general_settings');
						  if ($topsign_icon == 'enable'){
								  
							if (!is_user_logged_in()) { ?>
							<li><a data-target=".signin" data-toggle="modal"><i class="fa fa-sign-in"></i><?php esc_html_e('Login','mosque_crunchpress');?></a></li>
							<li><a data-target=".signup" data-toggle="modal"><i class="fa fa-user"></i><?php esc_html_e('Sign Up','mosque_crunchpress');?></a></li>
						<?php } 
						global $current_user;
						if (is_user_logged_in()) { ?>
						<li>
							<a href="<?php echo get_author_posts_url( get_current_user_id() );?>"><?php esc_html_e('Welcome','mosque_crunchpress');?>
							<?php 									
								if(get_the_author_meta( 'first_name', $current_user->ID ) == ''){
									echo get_the_author_meta( 'nickname', $current_user->ID );
								}else{
									echo get_the_author_meta( 'first_name', $current_user->ID ) .' '.get_the_author_meta( 'last_name', $current_user->ID );
								}									
							?>
							</a>
						</li>
						<?php }
						  }
						?>
						<?php echo cp_woo_commerce_cart('Shopping Cart','<i class="fa fa-shopping-cart"></i>','text-icon'); ?>
					  </ul>
					</div>
				  </div>
				  <!--Login Bar End--> 
				</div>
			  </div>
			</section>
			<!--Header Tobar End--> 
			
			<!--Logo Row Start-->
			<section class="logo-row">
			  <div class="container">
				<div class="row"> 
				  <!--Topbar Address Area Start-->
				  <div class="col-md-4">
					<?php echo cp_contact_us_code(); ?>
				  </div>
				  <!--Topbar Address Area End--> 
				  <!--Logo Start-->
				  <div class="col-md-4">
					<?php cp_default_logo(); ?>
					
				  </div>
				  <!--Logo End--> 
				  <!--Top Social And Search Start-->
				  <div class="col-md-4">
					  <?php cp_social_icons_list('top-social','bottom');?>
				  </div>
				  <!--Top Social And Search End--> 
				</div>
			  </div>
			</section>
			<!--Logo Row End--> 
			
			<!--Navigation Start-->
			<div class="navigation bg-color">
				<div class="container">
					<?php cp_bootstrap_menu('header-menu'); ?>
				</div>
			</div>
			<!--Navigation End--> 
		  </header>
		  <!--Header End-->		
	  <?php 
	} 
  
	//Header Function 3
	function cp_header_style_3(){ ?>
		<header class="header3" id="header"> 
			<!--Navigation Start-->
			<div class="navigation-2">
				<div class="container">
					<?php cp_default_logo(); ?>
					<?php cp_bootstrap_menu('header-menu'); ?>
				</div>
			</div>
			<!--Navigation End--> 
		</header>
  <?php 
	} 
  
	//Header Function 4
	function cp_header_style_4(){ ?>
	  <header class="header4" id="header"> 
    <!--Header Tobar Start-->
    <section class="header-topbar">
      <div class="container">
        <div class="row"> 
          <!--Topbar Navigation Start-->
          <div class="col-md-6 col-sm-6">
           <?php cp_normal_menu('top-menu','topbar-nav');?>
          </div>
          <!--Topbar Navigation End--> 
          <!--Login Bar Start-->
          <div class="col-md-6 col-sm-6">
            <div class="login-bar">
              <ul>
			  <?php 
				  $topsign_icon = cp_get_themeoption_value('topsign_icon','general_settings');
				  if ($topsign_icon == 'enable'){
					  
					if (!is_user_logged_in()) { ?>
					<li><a data-target=".signin" data-toggle="modal"><i class="fa fa-sign-in"></i><?php esc_html_e('Login','mosque_crunchpress');?></a></li>
					<li><a data-target=".signup" data-toggle="modal"><i class="fa fa-user"></i><?php esc_html_e('Sign Up','mosque_crunchpress');?></a></li>
				<?php } 
				global $current_user;
				if (is_user_logged_in()) { ?>
				<li>
					<a href="<?php echo get_author_posts_url( get_current_user_id() );?>"><?php esc_html_e('Welcome','mosque_crunchpress');?>
					<?php 									
						if(get_the_author_meta( 'first_name', $current_user->ID ) == ''){
							echo get_the_author_meta( 'nickname', $current_user->ID );
						}else{
							echo get_the_author_meta( 'first_name', $current_user->ID ) .' '.get_the_author_meta( 'last_name', $current_user->ID );
						}									
					?>
					</a>
				</li>
				<?php }
				} ?>
				<?php echo cp_woo_commerce_cart('Shopping Cart','<i class="fa fa-shopping-cart"></i>','text-icon'); ?>
              </ul>
            </div>
          </div>
          <!--Login Bar End--> 
        </div>
      </div>
    </section>
    <!--Header Tobar End--> 
    
    <!--Logo Row Start-->
    <section class="logo-row eco-padding-none">
      <div class="container">
        <div class="row"> 
          <!--Logo Start-->
          <div class="col-md-6">
            <div class="eco-logo-box">
			<?php cp_default_logo(); ?>
			</div>
          </div>
          <!--Logo End--> 
          
          <!--Top Social And Search Start-->
          <div class="col-md-6">
		
            <div class="top-social eco-padding-none"> 
			 <?php
			$donation_button = cp_get_themeoption_value('donation_button','general_settings');
			$donate_btn_text = cp_get_themeoption_value('donate_btn_text','general_settings');
			$donation_page_id = cp_get_themeoption_value('donation_page_id','general_settings');
			$donate_email_id = cp_get_themeoption_value('donate_email_id','general_settings');
			$donate_title = cp_get_themeoption_value('donate_title','general_settings');
			if($donation_button == 'enable'){
				
				echo '<a class="tree" href="'.get_permalink($donation_page_id).'">'.$donate_btn_text.'</a>';
			}
			?>
              <div class="right-social-box">
                <?php cp_social_icons_list('top-social','bottom');?>
                <?php cp_search_html(true);?>
              </div>
            </div>
          </div>
          <!--Top Social And Search End--> 
        </div>
      </div>
    </section>
    <!--Logo Row End--> 
    
    <!--Navigation Start-->
    <div class="navigation">
      <?php cp_bootstrap_menu('header-menu'); ?>
    </div>
    <!--Navigation End--> 
    
  </header>
  <?php 
	} 
   
	//Header Function 5
	function cp_header_style_5(){ ?>
	<header class="causes-header" id="header"> 
		<!--Logo Row Start-->
		<section class="logo-row eco-padding-none">
		  <div class="container">
			<div class="row"> 
				<!--Logo Start-->
				<div class="col-md-3">
					<div class="eco-logo-box">
						<?php cp_default_logo(); ?>
					</div>
				</div>
				<!--Logo End--> 
				<!--Top Social And Search Start-->
				<div class="col-md-9">
					<div class = "cp_causes_nav">
						<div class="navigation">
							<?php cp_bootstrap_menu('header-menu'); ?>
						</div>
					</div>
				</div>
				<!--Top Social And Search End--> 
			</div>
		  </div>
		</section>
		<!--Logo Row End--> 
	</header>
  <?php }
  
	function cp_header_style_6(){ ?>
	
	<header class="header7-bg" id="header"> 
    <!--Header Tobar Start-->
    <section class="header-topbar">
      <div class="container">
        <div class="row"> 
          <!--Topbar Navigation Start-->
          <div class="col-md-6">
            <?php cp_normal_menu('top-menu','topbar-nav');?>
          </div>
          <!--Topbar Navigation End--> 
          <!--Login Bar Start-->
          <div class="col-md-6">
            <div class="login-bar">
              <ul>
			  <?php 
				$topsign_icon = cp_get_themeoption_value('topsign_icon','general_settings');
				if ($topsign_icon == 'enable'){
					if (!is_user_logged_in()) { ?>
						<li><a data-target=".signin" data-toggle="modal"><i class="fa fa-sign-in"></i><?php esc_html_e('Login','mosque_crunchpress');?></a></li>
						<li><a data-target=".signup" data-toggle="modal"><i class="fa fa-user"></i><?php esc_html_e('Sign Up','mosque_crunchpress');?></a></li>
					<?php } 
				global $current_user;
				if (is_user_logged_in()) { ?>
				<li>
					<a href="<?php echo get_author_posts_url( get_current_user_id() );?>"><?php esc_html_e('Welcome','mosque_crunchpress');?>
					<?php 									
						if(get_the_author_meta( 'first_name', $current_user->ID ) == ''){
							echo get_the_author_meta( 'nickname', $current_user->ID );
						}else{
							echo get_the_author_meta( 'first_name', $current_user->ID ) .' '.get_the_author_meta( 'last_name', $current_user->ID );
						}									
					?>
					</a>
				</li>
				<?php }
				} ?>
              </ul>
            </div>
          </div>
          <!--Login Bar End--> 
        </div>
      </div>
    </section>
    <!--Header Tobar End--> 
    
    <!--Logo Row Start-->
    <section class="logo-row store-head">
      <div class="container">
        <div class="row"> 
			<!--Topbar Address Area Start-->
			<div class="col-md-4">
				<?php echo cp_contact_us_code(); ?>
			</div>
			<!--Topbar Address Area End--> 
          
			<!--Logo Start-->
			<div class="col-md-4">
				<div class="eco-logo-box">
					<?php cp_default_logo(); ?>
				</div>
			</div>
			<!--Logo End--> 
          
			<!--Top Social And Search Start-->
			<div class="col-md-4">
				<div class="cart-area">
					<div class="cart-outer">
						<div class="cart-box"><a class="count" href="<?php echo WC()->cart->get_cart_url(); ?>"><?php echo  WC()->cart->cart_contents_count; ?></a></div>
						<strong class="amount"><?php echo WC()->cart->get_cart_total(); ?></strong>
					</div>
					<a class="like" href="<?php echo WC()->cart->get_cart_url(); ?>"><i class="fa fa-heart"></i></a>
				</div>
			</div>
			<!--Top Social And Search End--> 
        </div>
      </div>
    </section>
    <!--Logo Row End--> 
    
    <!--Navigation Start-->
	<div class = "store_nav">
		<div class="navigation">
		  <?php cp_bootstrap_menu('header-menu'); ?>
		</div>
	</div>
    <!--Navigation End--> 
    
  </header>
	
  <?php 
  }


  	 //Header Function html
	function cp_print_header_selected(){
		$header = '';
		$select_header_cp = cp_get_themeoption_value('select_header_cp','general_settings');
		if($select_header_cp == 'Style 3'){
			$header = 'header-style-3';
		}else{
			$header = 'normal-header';
		}
		
		return $header;
	}	
	 //Header Function html
	function cp_print_header_html($header=""){
		
		$header_style_apply = cp_get_themeoption_value('header_style_apply','general_settings');
		if($header_style_apply == 'enable'){$header = 'enable';}else{}
		if($header == 'Style 1'){
			cp_header_style_1();
		}else if($header == 'Style 2'){
			cp_header_style_2();
		}else if($header == 'Style 3'){
			cp_header_style_3();
		}else if($header == 'Style 4'){
			cp_header_style_4();
		}else if($header == 'Style 5'){
			cp_header_style_5();
		}else if($header == 'Style 6'){
			cp_header_style_6();
		}else if($header == 'Style 7'){
			//cp_header_style_7();
		}else if($header == 'Style 8'){
			//cp_header_style_8();
		}else if($header == 'Style 9'){
			//cp_header_style_9();
		}else if($header == 'Style 10'){
			//cp_header_style_10();
		}else if($header == 'Style 11'){
			//cp_header_style_11();
		}else if($header == 'Style 12'){
			//cp_header_style_12();
		}else if($header == 'Style 13'){
			//cp_header_style_13();
		}else if($header == 'Style 14'){
			//cp_header_style_14();
		}else if($header == 'Style 15'){
			//cp_header_style_15();
		}else if($header == 'Style 16'){
			//cp_header_style_16();
		}else if($header == 'Style 17'){
			//cp_header_style_17();
		}else if($header == 'Style 18'){
			//cp_header_style_18();
		}else if($header == 'Style 19'){
			//cp_header_style_19();
		}else if($header == 'Style 20'){
			//cp_header_style_20();
		}else{
			$select_header_cp = cp_get_themeoption_value('select_header_cp','general_settings');
			if($select_header_cp == 'Style 1'){
				cp_header_style_1();
			}else if($select_header_cp == 'Style 2'){
				cp_header_style_2();
			}else if($select_header_cp == 'Style 3'){
				cp_header_style_3();
			}else if($select_header_cp == 'Style 4'){
				cp_header_style_4();
			}else if($select_header_cp == 'Style 5'){
				cp_header_style_5();
			}else if($select_header_cp == 'Style 6'){
				cp_header_style_6();
			}else if($select_header_cp == 'Style 7'){
				//cp_header_style_7();
			}else if($select_header_cp == 'Style 8'){
				//cp_header_style_8();
			}else if($select_header_cp == 'Style 9'){
				//cp_header_style_9();
			}else if($select_header_cp == 'Style 10'){
				//cp_header_style_10();
			}else if($select_header_cp == 'Style 11'){
				//cp_header_style_11();
			}else if($select_header_cp == 'Style 12'){
				//cp_header_style_12();
			}else if($select_header_cp == 'Style 13'){
				//cp_header_style_13();
			}else if($select_header_cp == 'Style 14'){
				//cp_header_style_14();
			}else if($select_header_cp == 'Style 15'){
				//cp_header_style_15();
			}else if($select_header_cp == 'Style 16'){
				//cp_header_style_16();
			}else if($select_header_cp == 'Style 17'){
				//cp_header_style_17();
			}else if($select_header_cp == 'Style 18'){
				//cp_header_style_18();
			}else if($select_header_cp == 'Style 19'){
				//cp_header_style_19();
			}else if($select_header_cp == 'Style 20'){
				//cp_header_style_20();
			}else{
				cp_header_style_1();
			}
		}
	}
	
	
	
	 //Header Function html
	function cp_print_header_html_val($header=""){
		$header_style_apply = cp_get_themeoption_value('header_style_apply','general_settings');
		
		if($header_style_apply == 'enable'){$header = 'enable';}else{}
		if($header == 'enable'){
			$select_header_cp = cp_get_themeoption_value('select_header_cp','general_settings');
			return $select_header_cp;
		}else{
			return $header;
		}
	}
	
	//print header style
	function cp_print_header_class($header=""){
		$cp_banner_class = '';
		$header_style_apply = cp_get_themeoption_value('header_style_apply','general_settings');
		if($header_style_apply == 'enable'){$header = 'enable';}else{}
		if($header == 'Style 1'){
			$cp_banner_class = 'banner-inner';
			
		}else if($header == 'Style 2'){
			$cp_banner_class = 'banner banner-inner';
			
		}else if($header == 'Style 3'){
			$cp_banner_class = 'banner banner-inner';
			
		}else if($header == 'Style 4'){
			$cp_banner_class = 'banner banner-inner';
			
		}else if($header == 'Style 5'){
			$cp_banner_class = '';
		}else if($header == 'Style 6'){
			$cp_banner_class = '';
			
		}else if($header == 'Style 7'){
				$cp_banner_class = '';
		}else if($header == 'Style 8'){
		echo '<style scoped>.inner-titlebg{padding:100px 0 0 !important;}.cp-header8 .logo-nav.cp_sticky{top:0px;}.inner_page_cp .cp-header8 .logo-nav{top:35px;}</style>';
			$cp_banner_class = '';
		}else if($header == 'Style 9'){
			$cp_banner_class = '';
			echo '<style scoped>#cp_header7 .navigation-row.inner_margin{margin:110px 0px;}.wrapper .inner-titlebg{padding:230px 0 0;}.wrapper .inner-titlebg h2{text-align:center;font-weight:800;font-size:36px;}</style>';
		}else if($header == 'Style 10'){
			$cp_banner_class = 'banner banner-inner';
			
		}else if($header == 'Style 11'){
			$cp_banner_class = '';
		}else if($header == 'Style 12'){
			$cp_banner_class = '';
		}else if($header == 'Style 13'){
			$cp_banner_class = '';
		}else if($header == 'Style 14'){
			$cp_banner_class = '';
		}else if($header == 'Style 15'){
			$cp_banner_class = '';
		}else if($header == 'Style 16'){
			$cp_banner_class = '';
		}else if($header == 'Style 17'){
			$cp_banner_class = '';
		}else if($header == 'Style 18'){
			$cp_banner_class = '';
		}else if($header == 'Style 19'){
			$cp_banner_class = '';
		}else if($header == 'Style 20'){
			$cp_banner_class = '';
		}else{
			$select_header_cp = cp_get_themeoption_value('select_header_cp','general_settings');
			if($select_header_cp == 'Style 1'){
				$cp_banner_class = 'banner-inner';
			
			}else if($select_header_cp == 'Style 2'){
				$cp_banner_class = 'banner banner-inner';
				
			}else if($select_header_cp == 'Style 3'){
				$cp_banner_class = 'banner banner-inner';
				
			}else if($select_header_cp == 'Style 4'){
				$cp_banner_class = 'banner banner-inner';
				
			}else if($select_header_cp == 'Style 5'){
				$cp_banner_class = '';
			}else if($select_header_cp == 'Style 6'){
				$cp_banner_class = '';
				
			}else if($select_header_cp == 'Style 7'){
				$cp_banner_class = '';
				
			}else if($select_header_cp == 'Style 8'){
				$cp_banner_class = '';				
				echo '<style scoped>
				.inner-titlebg{
					padding:100px 0 0 !important;					
				}
				.cp-header8 .logo-nav.cp_sticky{
					top:0px;
				}
				.inner_page_cp .cp-header8 .logo-nav{
					top:35px;
				}</style>';
			}else if($select_header_cp == 'Style 9'){
				$cp_banner_class = '';
				echo '<style scoped>#cp_header7 .navigation-row.inner_margin{margin:110px 0px;}.wrapper .inner-titlebg{padding:230px 0 0;}.wrapper .inner-titlebg h2{text-align:center;font-weight:800;font-size:36px;}</style>';
			}else if($select_header_cp == 'Style 10'){
				$cp_banner_class = '';
			}else if($select_header_cp == 'Style 11'){
				$cp_banner_class = '';				
			}else if($select_header_cp == 'Style 12'){
				$cp_banner_class = '';
			}else if($select_header_cp == 'Style 13'){
				$cp_banner_class = '';
			}else if($select_header_cp == 'Style 14'){
				$cp_banner_class = '';
				echo '<style>.woocommerce-breadcrumb{margin-top:30px !important;}</style>';
			}else if($select_header_cp == 'Style 15'){
				$cp_banner_class = '';
				echo '<style>.woocommerce-breadcrumb{margin-top:30px !important;}</style>';
			}else if($select_header_cp == 'Style 16'){
				$cp_banner_class = '';
				echo '<style>.woocommerce-breadcrumb{margin-top:30px !important;}</style>';
			}else if($select_header_cp == 'Style 17'){
				$cp_banner_class = '';
				echo '<style>.woocommerce-breadcrumb{margin-top:30px !important;}</style>';
			}else if($select_header_cp == 'Style 18'){
				$cp_banner_class = '';
				echo '<style>.woocommerce-breadcrumb{margin-top:30px !important;}</style>';
			}else if($select_header_cp == 'Style 19'){
				$cp_banner_class = '';
				echo '<style>.woocommerce-breadcrumb{margin-top:30px !important;}</style>';
			}else if($select_header_cp == 'Style 20'){
				$cp_banner_class = '';
				echo '<style>.woocommerce-breadcrumb{margin-top:30px !important;}</style>';
			}else{
				$cp_banner_class = 'banner-inner';
			}
		}
		return $cp_banner_class;
	}
	
	//header background
	function cp_add_header_bg($header=''){
		$header_style_apply = cp_get_themeoption_value('header_style_apply','general_settings');
		if($header_style_apply == 'enable'){$header = 'enable';}else{}
		global $post;
		if($header == 'Style 2' || $header == 'Style 3'){
			$thumbnail_id = get_post_thumbnail_id( $post->ID );
			if($thumbnail_id <> ''){
				$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' );
				$html_thumb = 'style="background-image:url('.$thumbnail[0].') !important"';
				echo '<style>.banner-inner{height:262px;}</style><section class="banner banner-inner" '.$html_thumb.'></section>';
			}else{
				$html_thumb = '';
			}
		}else{
		
		}
	}
	
	//Bootstrap Menu
	function cp_bootstrap_menu($location='',$class=''){ ?>
		<!-- Collect the nav links, forms, and other content for toggling --> 
		<div class="home-menu">
			<!--<div class="navbar mm"></div>-->
			<nav class="navbar navbar-default"> 
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
						<span class="sr-only"><?php echo esc_html_e('Toggle navigation','mosque_crunchpress');?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<?php 
				// Menu parameters		
				$defaults = array(
				'theme_location'  => $location,
				'menu'            => '', 
				'container'       => '', 
				'container_class' => 'menu-{menu slug}-container', 
				'container_id'    => 'navbar',
				'menu_class'      => 'nav navbar-nav', 
				'menu_id'         => 'nav',
				'echo'            => true,
				'fallback_cb'     => '',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 0,
				'walker'          => '',);				
				if(has_nav_menu($location)){ ?>
				<div id="navbarCollapse" class="collapse navbar-collapse <?php echo esc_attr($class);?>">
					<?php wp_nav_menu( $defaults);?>
				</div>
				<?php }else{
				$args = array(
				'sort_column' => 'menu_order, post_title',
				'include'     => '',
				'exclude'     => '',
				'echo'        => true,
				'show_home'   => false,
				'menu'            => '', 
				'container'       => '', 
				'link_before' => '',
				'link_after'  => '' );?>
				<div id="navbarCollapse" class="collapse navbar-collapse <?php echo esc_attr($class);?>">
					<div id="navbar" class="nav navbar-nav">
						<?php wp_page_menu( $args ); ?>                
					</div>
				</div>	
				<?php } ?>
			</nav>
		</div>
	<?php }
	
	
	//Normal Menu
	function cp_normal_menu($location='',$class=''){
	
		// Menu parameters		
		$defaults = array(
		'theme_location'  => $location,
		'menu'            => '', 
		'container'       => '', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => 'navbar',
		'menu_class'      => 'nav navbar-nav', 
		'menu_id'         => 'normal_nav',
		'echo'            => true,
		'fallback_cb'     => '',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => '',);				
		if(has_nav_menu($location)){ 
			echo '<div id="default-menu" class="'.$class.'">';
				wp_nav_menu( $defaults);
			echo '</div>';
		} //End Condition for Location Set 
	} //End Normal Function Here
	
	
	
	//Social Networking Icons
	function cp_social_icons_list($class='',$data_placement=''){
		
	$cp_social_settings = get_option('social_settings');
		
	$social_networking = cp_get_themeoption_value('topsocial_icon','general_settings');
	
	
	if($social_networking == 'enable'){
		
		if($cp_social_settings <> ''){
			$cp_social = new DOMDocument ();
			$cp_social->loadXML ( $cp_social_settings );
			//Social Networking Values
			$facebook_network = cp_get_themeoption_value('facebook_network','social_settings');
			$twitter_network = cp_get_themeoption_value('twitter_network','social_settings');
			$delicious_network = cp_get_themeoption_value('delicious_network','social_settings');
			$google_plus_network = cp_get_themeoption_value('google_plus_network','social_settings');
			$linked_in_network = cp_get_themeoption_value('linked_in_network','social_settings');
			$youtube_network = cp_get_themeoption_value('youtube_network','social_settings');
			$flickr_network = cp_get_themeoption_value('flickr_network','social_settings');
			$vimeo_network = cp_get_themeoption_value('vimeo_network','social_settings');
			$pinterest_network = cp_get_themeoption_value('pinterest_network','social_settings');
			$Instagram_network = cp_get_themeoption_value('Instagram_network','social_settings'); 
			$github_network = cp_get_themeoption_value('github_network','social_settings'); 
			$skype_network = cp_get_themeoption_value('skype_network','social_settings');
		}
		?>
		<ul class="<?php echo esc_attr($class);?>"> 
			<?php if($facebook_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($facebook_network);?>" title="Facebook"><i class="fa fa-facebook"></i></a></li><?php }?>
			<?php if($twitter_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($twitter_network);?>" title="Twitter"><i class="fa fa-twitter"></i></a></li><?php }?>
			<?php if($delicious_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($delicious_network);?>" title="Delicious"><i class="fa fa-delicious"></i></a></li><?php }?>
			<?php if($google_plus_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($google_plus_network);?>" title="Google Plus"><i class="fa fa-google-plus"></i></a></li><?php }?>
			<?php if($linked_in_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($linked_in_network);?>" title="Linkedin"><i class="fa fa-linkedin"></i></a></li><?php }?>
			<?php if($youtube_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($youtube_network);?>" title="Youtube"><i class="fa fa-youtube"></i></a></li><?php }?> 
			<?php if($flickr_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($flickr_network);?>" title="Flickr"><i class="fa fa-flickr"></i></a></li><?php }?>
			<?php if($vimeo_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($vimeo_network);?>" title="Vimeo"><i class="fa fa-vimeo"></i></a></li><?php }?>
			<?php if($pinterest_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($pinterest_network);?>" title="Pinterest"><i class="fa fa-pinterest"></i></a></li><?php }?>
			<?php if($Instagram_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($Instagram_network);?>" title="Instagram"><i class="fa fa-instagram"></i></a></li><?php }?>
			<?php if($github_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($github_network);?>" title="github"><i class="fa fa-github"></i></a></li><?php }?>
			<?php if($skype_network <> ''){ ?><li><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($skype_network);?>" title="Skype"><i class="fa fa-skype"></i></a></li><?php }?>
		</ul>
	<?php }
	} 
	
	
	//Social Networking Icons
	function cp_social_icons_list_new($class='',$data_placement=''){
		
		$cp_social_settings = get_option('social_settings');
	
		$social_networking = cp_get_themeoption_value('social_networking','general_settings');

		
		if($social_networking == 'enable'){
			
			if($cp_social_settings <> ''){
				$cp_social = new DOMDocument ();
				$cp_social->loadXML ( $cp_social_settings );
				//Social Networking Values
				$facebook_network = cp_get_themeoption_value('facebook_network','social_settings');
				$twitter_network = cp_get_themeoption_value('twitter_network','social_settings');
				$delicious_network = cp_get_themeoption_value('delicious_network','social_settings');
				$google_plus_network = cp_get_themeoption_value('google_plus_network','social_settings');
				$linked_in_network = cp_get_themeoption_value('linked_in_network','social_settings');
				$youtube_network = cp_get_themeoption_value('youtube_network','social_settings');
				$flickr_network = cp_get_themeoption_value('flickr_network','social_settings');
				$vimeo_network = cp_get_themeoption_value('vimeo_network','social_settings');
				$pinterest_network = cp_get_themeoption_value('pinterest_network','social_settings');
				$Instagram_network = cp_get_themeoption_value('Instagram_network','social_settings'); 
				$github_network = cp_get_themeoption_value('github_network','social_settings'); 
				$skype_network = cp_get_themeoption_value('skype_network','social_settings');
			}
		?>
		<ul class="<?php echo esc_attr($class);?>"> 
			<?php if($facebook_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Facebook','mosque_crunchpress');?></a><a  class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($facebook_network);?>" title="Facebook"><i class="fa fa-facebook-square"></i></a></li><?php }?>
			<?php if($twitter_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Twitter','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($twitter_network);?>" title="Twitter"><i class="fa fa-twitter-square"></i></a></li><?php }?>
			<?php if($delicious_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Delicious','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($delicious_network);?>" title="Delicious"><i class="fa fa-delicious"></i></a></li><?php }?>
			<?php if($google_plus_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Google','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($google_plus_network);?>" title="Google Plus"><i class="fa fa-google-plus"></i></a></li><?php }?>
			<?php if($linked_in_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Linked In','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($linked_in_network);?>" title="Linkedin"><i class="fa fa-linkedin"></i></a></li><?php }?>
			<?php if($youtube_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Youtube','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($youtube_network);?>" title="Youtube"><i class="fa fa-youtube"></i></a></li><?php }?> 
			<?php if($flickr_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Flickr','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($flickr_network);?>" title="Flickr"><i class="fa fa-flickr"></i></a></li><?php }?>
			<?php if($vimeo_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Vimeo','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($vimeo_network);?>" title="Vimeo"><i class="fa fa-vimeo-square"></i></a></li><?php }?>
			<?php if($pinterest_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Pinterest','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($pinterest_network);?>" title="Pinterest"><i class="fa fa-pinterest-square"></i></a></li><?php }?>
			<?php if($Instagram_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Instagram','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($Instagram_network);?>" title="Instagram"><i class="fa fa-instagram"></i></a></li><?php }?>
			<?php if($github_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Github','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($github_network);?>" title="github"><i class="fa fa-github"></i></a></li><?php }?>
			<?php if($skype_network <> ''){ ?><li><a href="#"><?php esc_attr_e('Skype','mosque_crunchpress');?></a><a class="icon" data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($skype_network);?>" title="Skype"><i class="fa fa-skype"></i></a></li><?php }?>
		</ul>
	<?php }
	} 

	function cp_social_icons_anchor($class='',$data_placement=''){
		$social_networking = cp_get_themeoption_value('social_networking','general_settings');
		if($social_networking == 'enable'){ 
			$facebook_network = cp_get_themeoption_value('facebook_network','social_settings');
			$twitter_network = cp_get_themeoption_value('twitter_network','social_settings');
			$delicious_network = cp_get_themeoption_value('delicious_network','social_settings');
			$google_plus_network = cp_get_themeoption_value('google_plus_network','social_settings');
			$linked_in_network = cp_get_themeoption_value('linked_in_network','social_settings');
			$youtube_network = cp_get_themeoption_value('youtube_network','social_settings');
			$flickr_network = cp_get_themeoption_value('flickr_network','social_settings');
			$vimeo_network = cp_get_themeoption_value('vimeo_network','social_settings');
			$pinterest_network = cp_get_themeoption_value('pinterest_network','social_settings');
			$Instagram_network = cp_get_themeoption_value('Instagram_network','social_settings'); 
			$github_network = cp_get_themeoption_value('github_network','social_settings'); 
			$skype_network = cp_get_themeoption_value('skype_network','social_settings'); ?>
			<div class="<?php echo esc_attr($class);?>"> 
				<?php if($facebook_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($facebook_network);?>" title="Facebook"><i class="fa fa-facebook-square"></i></a><?php }?>
				<?php if($twitter_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($twitter_network);?>" title="Twitter"><i class="fa fa-twitter-square"></i></a><?php }?>
				<?php if($delicious_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($delicious_network);?>" title="Delicious"><i class="fa fa-delicious"></i></a><?php }?>
				<?php if($google_plus_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($google_plus_network);?>" title="Google Plus"><i class="fa fa-google-plus"></i></a><?php }?>
				<?php if($linked_in_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($linked_in_network);?>" title="Linkedin"><i class="fa fa-linkedin"></i></a><?php }?>
				<?php if($youtube_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($youtube_network);?>" title="Youtube"><i class="fa fa-youtube"></i></a><?php }?> 
				<?php if($flickr_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($flickr_network);?>" title="Flickr"><i class="fa fa-flickr"></i></a><?php }?>
				<?php if($vimeo_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($vimeo_network);?>" title="Vimeo"><i class="fa fa-vimeo-square"></i></a><?php }?>
				<?php if($pinterest_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($pinterest_network);?>" title="Pinterest"><i class="fa fa-pinterest-square"></i></a><?php }?>
				<?php if($Instagram_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($Instagram_network);?>" title="Instagram"><i class="fa fa-instagram"></i></a><?php }?>
				<?php if($github_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($github_network);?>" title="Github"><i class="fa fa-github"></i></a><?php }?>
				<?php if($skype_network <> ''){ ?><a data-placement="<?php echo esc_attr($data_placement);?>" data-rel='tooltip' href="<?php echo esc_url($skype_network);?>" title="Skype"><i class="fa fa-skype"></i></a><?php }?>
			</div>
		<?php }
	}
	
	
	
	function cp_footer_logo_int(){
		$footer_logo = cp_get_themeoption_value('footer_logo','general_settings');
		$footer_link = cp_get_themeoption_value('footer_link','general_settings');
		$footer_logo_width = cp_get_themeoption_value('footer_logo_width','general_settings');
		$footer_logo_height = cp_get_themeoption_value('footer_logo_height','general_settings');
		if($footer_logo_width == '' || $footer_logo_width == ' '){$footer_logo_width = '191';}
		if($footer_logo_height == '' || $footer_logo_height == ' '){$footer_logo_height = '46';}
		?>
		<a class="ft-logo" title="<?php bloginfo('name'); ?><?php wp_title( ' - ', true, 'left' ); ?>" href="<?php echo esc_url(home_url('/')); ?>">
			<?php
			if(!empty($footer_logo)){ 
				$image_src_head = wp_get_attachment_image_src( $footer_logo, 'full' );
				$image_src_head = (empty($image_src_head))? '': $image_src_head[0];
				$thumb_src_preview = wp_get_attachment_image_src( $footer_logo, 'full');
				if($thumb_src_preview[0] <> ''){
					echo '<img width="'.esc_attr($footer_logo_width).'" height="'.esc_attr($footer_logo_height).'" src="'.esc_url($thumb_src_preview[0]).'" alt="'.esc_html_e('Footer Logo','mosque_crunchpress').'" />';
				}else{
					echo '<img src="'.CP_PATH_URL.'/images/footer-logo.png" alt="'.esc_html_e('Footer Logo','mosque_crunchpress').'" />';
				}
			}else{
				echo '<img src="'.CP_PATH_URL.'/images/footer-logo.png" alt="'.esc_html_e('Footer Logo','mosque_crunchpress').'" />';
			}
			?>
		</a>
	<?php 
	}
		
	function cp_default_logo($logo_url =''){ ?>
		<div class="logo-box">
			<?php 
			
				$logo_url == 'logo.png';
			
			$header_logo_btn = cp_get_themeoption_value('header_logo_btn','general_settings');
			if($header_logo_btn == 'enable'){
				$header_logo = cp_get_themeoption_value('header_logo','general_settings');
				$logo_width = cp_get_themeoption_value('logo_width','general_settings');
				$logo_height = cp_get_themeoption_value('logo_height','general_settings');
				//Print Logo
				$image_src = '';
				if(!empty($header_logo)){ 
					$image_src = wp_get_attachment_image_src( $header_logo, 'full' );
					$image_src = (empty($image_src))? '': $image_src[0];			
				} ?>
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img class="logo_img" width="<?php if($logo_width == '' or $logo_width == ' '){ echo '200'; }else{echo esc_attr($logo_width);}?>" height="<?php if($logo_height == '' or $logo_height == ' '){ echo ''; }else{echo esc_attr($logo_height);}?>" src="<?php if($image_src <> ''){echo esc_url($image_src);}else{echo esc_url(CP_PATH_URL.'/images/logo.png');}?>" alt="<?php echo esc_attr(bloginfo( 'name' ));?>">
				</a>
			<?php }else{
				$logo_text_cp = cp_get_themeoption_value('logo_text_cp','general_settings');
				$logo_bold_text_cp = cp_get_themeoption_value('logo_bold_text_cp','general_settings');
				$logo_subtext = cp_get_themeoption_value('logo_subtext','general_settings'); ?>
				
					<strong class="logo">
						<a href="<?php echo esc_url(home_url('/')); ?>">
							<?php echo esc_attr($logo_text_cp);?><span><?php echo esc_attr($logo_bold_text_cp);?></span>
						</a>
					</strong>
					<strong class="slogan"><?php echo esc_attr($logo_subtext);?></strong>
				
			<?php }?>
		</div>
	<?php }
	
	//CP Mega menu
	function cp_mega_menu($location=''){
		if(has_nav_menu($location)){
			echo '<div class="navigation-bar"><div class="container">';
				$defaults = array(
				  'theme_location'  => $location,
				  'menu'            => '', 
				  'container'       => '', 
				  'container_class' => 'menu-{menu slug}-container', 
				  'container_id'    => 'navbar',
				  'menu_class'      => '', 
				  'menu_id'         => 'nav',
				  'echo'            => true,
				  'fallback_cb'     => '',
				  'before'          => '',
				  'after'           => '',
				  'link_before'     => '',
				  'link_after'      => '',
				  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				  'depth'           => 0,
				  'walker'          => '');		
				echo '<div id="custom_mega" class="cp_mega_plugin">';
					wp_nav_menu( $defaults);
				echo '</div>';
			echo '</div></div>';	
		}else if(has_nav_menu('mega_main_sidebar_menu')){
			echo '<div class="side-nav-container"><a id="no-show-menu-cp" class="menu_show_cp"><i class="fa fa-bars"></i></a>';
				$defaults = array(
				  'theme_location'  => 'mega_main_sidebar_menu',
				  'menu'            => '', 
				  'container'       => '', 
				  'container_class' => 'menu-{menu slug}-container', 
				  'container_id'    => 'navbar',
				  'menu_class'      => '', 
				  'menu_id'         => 'nav',
				  'echo'            => true,
				  'fallback_cb'     => '',
				  'before'          => '',
				  'after'           => '',
				  'link_before'     => '',
				  'link_after'      => '',
				  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				  'depth'           => 0,
				  'walker'          => '');		
				echo '<div id="custom_mega" class="cp_mega_plugin">';
					wp_nav_menu( $defaults);
				echo '</div>';
			echo '</div>';		
		}
	}
	
	// Contact us code for header goodwill
	function cp_contact_us_code(){ 
			
			$contact_us_code = cp_get_themeoption_value('contact_us_code','general_settings');
			$contact_us_code2 = cp_get_themeoption_value('contact_us_code2','general_settings');
			$contact_us_code3 = cp_get_themeoption_value('contact_us_code3','general_settings');
		?>
		<address class="topbar-address">  
		   <ul> 
		   <?php if($contact_us_code <> ''){?>    
			   <li><i class="fa fa-phone"></i><?php echo esc_attr($contact_us_code);?></li>    
		   <?php } ?>
		   <?php if($contact_us_code2 <> ''){?> 
			   <li><a href="mailto:"><i class="fa fa-envelope"></i><?php echo esc_attr($contact_us_code2); ?></a></li>  
			<?php } ?>
			 <?php if($contact_us_code3 <> ''){?> 
			   <li><a href="#"><i class="fa fa-map-marker"></i><?php echo esc_attr($contact_us_code3); ?></a></li>  
			   <?php } ?>
		   </ul>            
		</address>
		
	<?php }
	
	function cp_search_html($icon_show=''){
		if($icon_show == false){ ?>											
			<a href="#" id="no-active-btn" class="search cp_search_animate"><span class="hsearch"><i class="fa fa-search"></i></span></a>
		<?php }?>	
			<div id="cp_search" class="cp_search">
				<form class="cp_search-form" action="<?php  echo esc_url(home_url('/')); ?>">
					<input name="s" class="cp_search-input" value="<?php the_search_query(); ?>" type="search" placeholder="<?php esc_html_e('Search...','mosque_crunchpress');?>" />
					<button class="cp_search-submit" type="submit"><i class="fa fa-search"></i></button>
				</form>
				<span id="cp_search-close" class="cp_search-close"></span>
			</div><!-- /cp_search -->
	<?php }
	
	function cp_woo_commerce_cart($shop_text='',$shop_icon='',$shop_val=''){
		$cart_html = '';
		if(class_exists("Woocommerce")){
			$shop_html = '';
			if($shop_val == 'icon'){
				$shop_html = $shop_icon;
			}else if($shop_val == 'text'){
				if($shop_text <> ''){
					$shop_html = $shop_text;
				}else{
					$shop_html = 'Shopping Cart';
				}
			}else if($shop_val == 'text-icon'){
				
				$shop_html = $shop_icon.$shop_text;
			}
			
			global $post,$post_id,$product,$woocommerce;	
			$currency = get_woocommerce_currency_symbol();
			
			if($woocommerce->cart->cart_contents_count <> 0){ 
					$shopping_cart_div = '<div class="widget_shopping_cart_content"></div>';
			}else{ 
					$shopping_cart_div = '<div class="hide_cart_widget_if_empty"></div>';
			 }
				
			$cart_html = '<li class="cart-item">
				<a href="#" class="btn-login" title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Shopping" id="no-active-btn-shopping">
					'.$shop_html.'</a>' .$shopping_cart_div .'</li>';		
		}
		return $cart_html;
	}