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
	
	function cp_footer_style_1_without_upper_footer(){ ?>
		<!--Footer Start-->
  <footer id="footer"> 
    <!--Footer Section 1 Start-->
    <section class="footer-section-1">
      <div class="container">
        <div class="row">
         <?php dynamic_sidebar('sidebar-footer'); ?>
        </div>
      </div>
    </section>
    <!--Footer Section 1 End--> 
    
    <!--Footer Section 2 Start-->
    <section class="footer-section-2">
      <div class="container">
        <div class="row">
          <div class="col-md-6"><?php echo esc_attr(cp_get_themeoption_value('copyright_code','general_settings'));?></div>
          <div class="col-md-6">
			<?php cp_footer_menu('footer-menu','footer-nav');?>
          </div>
        </div>
      </div>
    </section>
    <!--Footer Section 2 End--> 
  </footer>
  <!--Footer End--> 
	<?php }
	
	//For Islamic Version
	function cp_footer_style_1(){ ?>
	<footer id="footer"> 
		<!--Footer Section 4 Start-->
		<section class="footer-section-4">
			<div class="container">
				<div class="holder">
					<div class="row">
						<?php //dynamic_sidebar('Upper-Footer'); ?>
						<?php dynamic_sidebar('sidebar-footer'); ?>
					</div>
				</div>
			</div>
		</section>
		<!--Footer Section 4 End--> 
		
		<!--Footer Section 1 Start-->
		<!--<section class="footer-section-1">
			<div class="container">
				<div class="row">
					<?php //dynamic_sidebar('sidebar-footer'); ?>
				</div>
			</div>
		</section>-->
		<!--Footer Section 1 End--> 
		
		<!--Footer Social Start-->
		<section class="footer-social">
		
		<?php 
		
		$social_networking = cp_get_themeoption_value('social_networking','general_settings');
		if($social_networking == 'enable'){
		
		?>
			<div class="holder">
				<div class="container">
					<?php //cp_footer_logo_int('social');?>					
					<?php cp_social_icons_list_new();?>
				</div>
			</div>
		<?php } ?>
			<div class="container">
				<?php echo esc_attr(cp_get_themeoption_value('copyright_code','general_settings'));?>
			</div>
		</section>
	</footer>
	
	<?php }
	
	function cp_footer_style_3(){ ?>
	<footer id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar('sidebar-footer'); ?>
				</div>
			</div>
		</div>
		<div class="footer-mid text-center">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php cp_footer_logo_int('social');?>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
		  <div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php echo esc_attr(cp_get_themeoption_value('copyright_code','general_settings'));?>
				</div>
			</div>
		  </div>
		</div>
	</footer>
		
	<?php }
	
	function cp_footer_style_4(){ ?>
	<footer id="footer" class="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar('sidebar-footer'); ?>
				</div>
			</div>
		</div>
		<div class="footer-mid">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<?php cp_social_icons_list('social'); ?>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12 pull-right">
						<?php echo esc_attr(cp_get_themeoption_value('copyright_code','general_settings'));?>
					</div>
				</div>
			</div>
		</div>
	</footer>
  
	<?php }
	
	function cp_footer_style_5(){ ?>
		<footer id="footer"> 
    
		<!--Footer Section 4 Start-->
		<section class="footer-section-4">
			<div class="container">
				<div class="holder">
					<div class="row">
						<?php dynamic_sidebar('Upper-Footer'); ?>
					</div>
				</div>
			</div>
		</section>
		<!--Footer Section 4 End--> 
		
		<!--Footer Section 1 Start-->
		<section class="footer-section-1">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar('sidebar-footer'); ?>
				</div>
			</div>
		</section>
		<!--Footer Section 1 End--> 
		
		<!--Footer Social Start-->
		<section class="footer-social">
			<div class="holder">
				<div class="container">
					<?php cp_social_icons_list_new();?>
				</div>
			</div>
			<div class="container">
				<?php echo esc_attr(cp_get_themeoption_value('copyright_code','general_settings'));?>
			</div>
		</section>
		<!--Footer Social End--> 
	</footer>
	<?php }
	
	function cp_footer_style_6(){ ?>
		<footer id="footer" class="footer">
			<div class="footer-mid text-center">
				<div class="container">
					<div class="row">
						<div class="col-md-12">							
							<?php cp_social_icons_anchor('social');?>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<?php echo esc_attr(cp_get_themeoption_value('copyright_code','general_settings'));?>
						</div>
					</div>
				</div>
			</div>
		</footer>
	<?php }
	
	//page-option-bottom-footer-style
	
	function cp_footer_html($footer=""){
		
		$footer_style_apply = cp_get_themeoption_value('footer_style_apply','general_settings');
		if($footer_style_apply == 'enable'){$footer = 'enable';}else{}
		
		if($footer == 'Style 1'){
			cp_footer_style_1();
		}else if($footer == 'Style 2'){
			cp_footer_style_2();
		}else if($footer == 'Style 3'){
			cp_footer_style_3();
		}else if($footer == 'Style 4'){
			cp_footer_style_4();
		}else if($footer == 'Style 5'){
			cp_footer_style_5();
		}else if($footer == 'Style 6'){
			cp_footer_style_6();
		}else{
			$select_footer_cp = cp_get_themeoption_value('select_footer_cp','general_settings');
			if($select_footer_cp == 'Style 1'){
				cp_footer_style_1();
			}else if($select_footer_cp == 'Style 2'){
				cp_footer_style_2();
			}else if($select_footer_cp == 'Style 3'){
				cp_footer_style_3();
			}else if($select_footer_cp == 'Style 4'){
				cp_footer_style_4();
			}else if($select_footer_cp == 'Style 5'){
				cp_footer_style_5();
			}else if($select_footer_cp == 'Style 6'){
				cp_footer_style_6();
			}else{
				cp_footer_style_1();
			}
		}
	}
	
	//Footer Menu
	function cp_footer_menu($location='',$class=''){
	
		// Menu parameters		
		$defaults = array(
		'theme_location'  => $location,
		'menu'            => '', 
		'container'       => '', 
		'container_class' => 'menu-{menu slug}-container', 
		'container_id'    => 'navbar',
		'menu_class'      => 'nav navbar-nav', 
		'menu_id'         => 'footer_nav',
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
			echo '<div id="default-footer-menu" class="'.$class.'">';
				wp_nav_menu( $defaults);
			echo '</div>';
		} //End Condition for Location Set 
	} //End Normal Function Here
	
