<?php







	// Ajax to include font infomation



	add_action('wp_ajax_nopriv_cp_color_bg', 'cp_color_bg');



	add_action('wp_ajax_cp_color_bg','cp_color_bg');



	function cp_color_bg($recieve_color='',$bg_texture='',$navi_color='',$head_text_color='',$color_font_body='',$select_layout_cp = '',$backend_on_off=''){



	



		global $html_new;



		



		/*



		================================================



						Create StyleSheet



		================================================



		*/



		$html_new .= '<style id="stylesheet">';



			



				/*



				================================================



							TEXT SELECTION COLOR 



				================================================



				*/







				$html_new .= '::selection {



					background: '.$recieve_color.'; /* Safari */



					color:#fff;



				}







				::-moz-selection {



					background: '.$recieve_color.'; /* Firefox */



					color:#fff;



				}';



				



				$html_new .= '/*Background Color Start*/



				.header4 .navigation,.header4 .navigation .navbarCollapse,.header4 .navigation .navbar-default, .header-topbar, .navigation .navbar-inverse .navbar-inner, #welcome-section, .our-causes-box .progress-striped .bar, .upcoming-events-box .text-box .date-box, .recent-post-box strong.title, .map-section .head, .latest-news .mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar, .latest-news .mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar, .mCSB_scrollTools .mCSB_dragger.mCSB_dragger_onDrag .mCSB_dragger_bar, .footer-section-1 .box ul li strong.date, .heading-style-3 ul li, #main .upcoming-events-box .text-box a.more:hover, a.btn-3:hover, .features-2-box .icon-box a:hover, .our-projects .bx-wrapper .bx-prev, .our-projects .bx-wrapper .bx-next, .team-social-3 li a:hover, .other-members-box .frame .caption, .navigation .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-submenu:hover > a, .dropdown-submenu:focus > a, .logo-box-2, .navigation-2 .dropdown-menu > li > a:hover, .player-btn-row ul li a:hover, .parallax-area, .upcoming-section-2 .text-box strong.date,  .islamic-features-box .frame:before, .donation-bg .progress-bar-box .progress-striped .bar, .eco-icon:hover, #main .eco-tab-area .nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus, #main .eco-tab-area .nav > li > a:hover, .main-causes .nav-tabs > .active > a, .main-causes .nav > li > a:hover, .nav > li > a:focus, .progress-box .progress-striped .bar, .causes-list-progress .progress-striped .bar, .cart-box a.count, .cart-area a.like, #banner-7 .caption strong.title, .featured-items .frame, .featured-items .frame:hover:before, .garments-collection .collection-box .frame .caption:before, .adds-banner .frame .caption, .blog-box .frame .caption:before, .new-arrivals .bx-wrapper .bx-controls-direction a:hover, .footer-section-4 .bx-wrapper .bx-controls-direction a:hover, #features-section .inner-box .icon-box:hover,.accordion-open, .accordion_cp:hover,.more-services .icon-box:hover, .plan-heading-color-1, .comments .text a.replay:hover, .sidebar-bix-1 strong.date, .sidebar-bix-1 .progress-striped .bar, .sidebar-bix-1 .caption, .blog-detail .bx-wrapper .bx-controls-direction a:hover, .mp3-player-box .audioplayer:not(.audioplayer-mini) .audioplayer-playpause, .audioplayer-volume-adjust div div, .audioplayer-bar-played, .audioplayer-volume-adjust div div, .audioplayer-bar-played, .tags li a:hover, .date-box strong.date, .awesome-icon:hover, .event-calender .fc-state-highlight, .event-calender thead, #main .player-btn-row-2 ul li:hover, .player-btn-row-2 ul li:hover:before, .star-box:hover, .star-box:hover:before, .event-locator .mCSB_scrollTools .mCSB_dragger:hover .mCSB_dragger_bar, .event-locator .mCSB_scrollTools .mCSB_dragger:active .mCSB_dragger_bar, .fram-box .text-box .progress, .fram-box .progress-striped .bar, #wrapper #main .btn-color, .fa-icon-box:hover, .services-style-2 .services-box:hover, .member-box, .garments-collection .bx-wrapper .bx-controls-direction a:hover, .features-2-box:hover .icon-box, #features-section-2 .features-2-box:hover a.btn-more, .map-caption .text-box .top-row .progress .bar, .navigation .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .dropdown-submenu:hover > a, .dropdown-submenu:focus > a, #banner .bx-wrapper, #banner-2 .bx-wrapper, #banner-5 .bx-wrapper, #banner-7 .bx-wrapper, #main .eco-features-box:hover .eco-icon, .awesome-hover, .round-box:hover, .header2.cp-header-sec #navbar .menu, .cp-header-sec #navbar .menu li:hover > a, .cp-header-sec #navbar .menu li ul li a:hover, .cp-header-sec #navbar .menu li ul li:hover > a, #footer .tagcloud a:hover, #main-woo .product-listing .onsale, .category_list_filterable a:hover, .category_list_filterable .gdl-button.active, .modern-grid .pro-content .rate, .bar > span, .navigation .sub-menu > li > a:hover, .navigation .sub-menu > li > a:focus, .navigation .dropdown-submenu:hover > a, .navigation .dropdown-submenu:focus > a, .features-section .inner-box .icon-box:hover, .blog-detail .tags a:hover, .mp3-player-box .mejs-controls .mejs-time-rail .mejs-time-current, .mp3-player-box .mejs-button.mejs-playpause-button.mejs-play, .cp_charity_slider .bx-wrapper .bx-pager.bx-default-pager a:hover, .cp_charity_slider .bx-wrapper .bx-pager.bx-default-pager a.active, .widget_recent_entries ul li span, .upcoming-events-box .text-box a.more:hover, .multi_color_1 .date, #footer .sidebar-recent-post ul li strong.date, .navigation-2 .sub-menu > li > a:hover, .sub-menu > li > a:focus, .sub-menu:hover > a, .sub-menu:focus > a, .cp_islamic_parallex_2 .progress-bar-warning, .cp_store .frame:hover:before, .eco-features-box:hover .eco-icon, .cp_eco_tabs #vertical-tabs .nav > li > a:hover, .cp_eco_tabs #vertical-tabs .nav > li > a:focus, .comments-list .tex-box a.comment-reply-link:hover, .player-btn-row-2 ul li:hover, #footer .sidebar-recent-post ul li strong.date, .sidebar_section #searchform input[type="submit"], .sidebar_section #frm_newsletter button, .sidebar_section .tagcloud a:hover, .sidebar_section .woocommerce-product-search input[type="submit"], .sidebar_section strong.date, .upcoming-events-box .text-box a.more:hover, .cp-accordion-2 .accordion-open, .cp-accordion-2 .custom_accordion_cp:hover, .cp_404-section .btn-back, .cp_404-section .error-page-form [type="submit"], .widget_shopping_cart_content p.buttons a,

				 a.btn-4:hover, .newsletter-section-3 .newsletter-form input[type="submit"]:hover, .causes-list-progress .progress-bar-success, .sidebar-recent-post .progress-bar-success, 
				 .event-calender-mosque .fc-grid .fc-event-inner, .ui-tabs-active.ui-state-active a.ui-tabs-anchor,

				#header .cp_donate_button:hover, .blog-detail .frame strong, .cp-mosque-readmore, .btn-9, .upcoming-section-2 .btn-container a.btn-3, 
				.upcoming-section-2 .frame .date, .donation-section .progress-bar-warning, .donation-section a.btn-4, .newsletter_mosque .detail-btn-sumbit2, .footer-social,
				.cp_about_mosque #vertical-tabs .nav-tabs > li > a:hover, .blog-detail a.btn-8, .cp_ignition_share .ignition_social_icons, .cp_ignition_content .causes-list-progress .progress .sr-only, .alert.success

				

				



				



				



				{



					background-color:'.$recieve_color.';



				}



				.our-causes .bx-wrapper .bx-pager.bx-default-pager a:hover, .cp_sercvice1 a.btn-1:hover {



					background:'.$recieve_color.' !important;



				}



				/*Background Color End*/







				/*Text Color Start*/



				.php-string, .eco-logo-box .logo-box a,.top-social ul li a:hover, #main-features ul li a:hover, .progress-boar strong.percentage, #main .latest-news-box strong.title:hover a, #main .latest-news-box p a:hover, .comment-row ul li a:hover, #main .team-member-box .text-box h3:hover a, #footer .footer-section-1 h2 span, .heading-style-3 h2 span, .features-2-box .icon-box a, #banner-3 #home-banner > li .caption a.btn-more:hover, .detail-row ul li a:hover, .recent-post-2 .box .text-box a.btn-read:hover, .upcoming-section-2 .text-box p a, .upcoming-section-2 .text-box a.link:hover, .upcoming-section-2 .bx-wrapper .bx-next:hover:before, .upcoming-section-2 .bx-wrapper .bx-prev:hover:before, .newsletter-2 .newsletter-form input[type="submit"]:hover, .heading-style-4 h2 span, strong.eco-logo a, #wrapper .navigation a.btn-donate, #banner-5 .caption .banner-heading-2 h1, #banner-5 .bx-wrapper .bx-prev:hover:before, #banner-5 .bx-wrapper .bx-next:hover:before, .heading-style-5 h2 span, .eco-upcoming-events .bx-wrapper .bx-prev:hover:before, .eco-upcoming-events .bx-wrapper .bx-next:hover:before, .eco-testimonials-box blockquote .fa, .causes-header strong.eco-slogan, .causes-tab-tags ul li a:hover, .get-connected-form .fa, .rating-star li a, .blog-row ul li a:hover, .blog-box .text-box a.btn-read:hover, .footer-section-4 .box .text-box span.price, .about-welcome blockquote:after, .more-services .text-box a:hover, .blog-detail a.like:hover, .blog-detail blockquote:before, .sidebar-bix-1 .text-box a.title:hover, .sidebar-bix-1 span.percentage, .blog-detail h3 .fa, .sidebar-bix-1 ul li a:hover, .team-member-detail-box ul li:hover, .team-member-detail-box ul li:hover a, .team-detail-area blockquote:before, .contact-1 address ul li:hover, .contact-1 address ul li a:hover, .our-time ul li:hover strong, .check-box label a:hover, .parallax-box .text-box a.btn-1, .parallax-box .text-box .btn-2, .features-2-box:hover h3, #features-section-2 .features-2-box:hover h3 a, #footer .box-1 cite, #footer #calendar_wrap #wp-calendar td#today, #footer #calendar_wrap #wp-calendar td a, .woocommerce-product-rating a, .cp-woocommerce .star-rating, .cart-collaterals .cart_totals .order-total, .woocommerce-message a, .entry-content-cp a, 
				.donors-list-box strong.amount a, a.btn-1.button_black, .sidebar_section span.percentage, #wp-calendar a, .cp_politics .features-2-box:hover h3 a, .politics_mid_banner .btn-2, 
				#footer .widget_text h2 span, #footer .widget_products .product_list_widget li del span.amount, #footer .widget_products .product_list_widget li span.amount, 
				#footer .widget_top_rated_products .product_list_widget li del span.amount, #footer .widget_top_rated_products .product_list_widget li span.amount, .welcome-sec h1 span, 
				.cp-woocommerce .star-rating span, .cp-woocommerce .star-rating::before, .single-testimonial .name, .single-testimonial .title a, p a:hover, .sidebar_section ul li a:hover, 
				.cp_404-section h2, .newsletter_mosque .social_icons ul li a:hover, .post-listing .detail-row ul li a .fa, .post-listing .detail-row ul li .fa, .blog-detail a.like .fa,
				body .cp-mosque-welcome h2, .features-box > span:hover .inner, .upcoming-section-2 .text-box h3, .upcoming-section-2 .text-box h3 a, .upcoming-section-2 .text-box a.link,
				.upcoming-section-2 .bx-wrapper .bx-prev:before, .upcoming-section-2 .bx-wrapper .bx-next:before, .detail-row ul li a, body .latest-seromns .text-box h3 a, .player-btn-row-2 ul li a, .detail-row ul li,
				.blog-row ul li a, .team-member.our-staf .designation, .welcome-sec.cp_about h1 span, .blog_listing.blog-detail .detail-row h3 a:hover
				
				 {



					color:'.$recieve_color.' !important;



				}



				/*Text Color End*/







				/*Border Color Start*/



				a.btn-1:hover, .heading-style-2:before, #banner .banner-caption a.donate:hover, .cart-box:before, .cart-box:after, .cart-box, .cart-box a.count:before, .missions-store .missions-frame .caption h2, .heading-style-7:after, .about-welcome blockquote, .about-welcome blockquote:before, .more-services .icon-box:hover, .team-detail-area blockquote, .team-detail-area blockquote:after, #banner .banner-caption a.donate, .round-box:hover, .upcoming-section-2 .btn-container a.btn-3:hover, a.btn-4:hover, .newsletter_mosque .newsletter-form input[type="text"], #footer {



					border-color:'.$recieve_color.';



				}



				/*Border Color End*/







				/*Button Color Start*/



				#banner .banner-caption a.donate, a.btn-1, #banner .banner-caption a.donate:hover, .features-2-box a.btn-more:hover, .newsletter-section-2 .newsletter-form input[type="submit"], #banner-3 #home-banner > li .caption a.btn-more, a.btn-5:hover, #video-banner .caption .btn-purchase, .footer-section-1 .box a.btn-5, .get-connected-form input[type="submit"], a.btn-7:hover, .footer-section-1 a.btn-7, a.btn-8:hover, .comment-form input[type="submit"], #main .event-listing a.btn-8:hover, .sign-up-form input[type="submit"], .btn-cp, .transfer-form input[type="submit"], #main .button-box-3 input[type="submit"], .button-box-3 .fa, .donate-form-area input[type="submit"], #footer #searchform input[type="submit"]:hover, .related.products .products .rel-box .add_to_cart_button:hover, .woocommerce .shop_table.cart .actions .button, .woocommerce .shipping_calculator .button, #order_review #payment .button, .woocommerce .login .button, .entry-content-cp .checkout_coupon .button, .summary.entry-summary .button, .wrapper .woocommerce #respond input#submit.submit, .wrapper .woocommerce-page #respond #submit.submit, .lost_reset_password input[type="submit"]:hover, #wrapper .btn-color, .donate-btn-submit, .cp_politics .features-2-box:hover .btn-more, a.btn-2, a.btn-3:hover, .field-set-section button, #main-woo .products li a.button:hover, .modal-footer input[type="submit"], .modal-body input[type="submit"] {



					background-color:'.$recieve_color.';



				}



				/*Button Color End*/







				/*Outline Color Start*/



				a.btn-1, #banner .banner-caption a.donate, a.btn-2:hover {



					outline-color:'.$recieve_color.';



				}



				/*Outline Color End*/







				.pagination-box .pagination ul > li > a:hover, .pagination ul > li > a:focus, .pagination ul > .active > a, .pagination ul > .active > span, .paging .pagination > li > span.current, .paging .pagination > li > a:hover, .paging .pagination > li > span:hover, .paging .pagination > li > a:focus, .paging .pagination > li > span:focus, .paging .pagination-box .pagination ul > li > a:hover, .paging .pagination ul > li > a:focus, .paging .pagination ul > .active > a, .paging .pagination ul > .active > span, .cp_pagination .page-numbers.current, .cp_pagination .pagination > li > a:hover, .cp_pagination .pagination > li > span:hover, .cp_pagination .pagination > li > a:focus, .cp_pagination .pagination > li > span:focus {



					box-shadow:0 -3px 0 0 '.$recieve_color.';



				}';







				if($select_layout_cp == 'boxed_layout'){



				$boxed_scheme = cp_get_themeoption_value('boxed_scheme','general_settings');



				if($boxed_scheme == ''){



					$boxed_scheme = '#ffffff';



				}



				$html_new .= '



				#custom_mega .mmm_fullwidth_container{



					width:auto !important;



				}



				.banner_edu{



					overflow:hidden;



				}



				#wrapper{



					width:1280px;



					margin:0 auto;



					background:'.$boxed_scheme.';



					float:none;



					box-shadow:0px 0px 10px 0px rgba(0,0,0,0.2);



					-moz-box-shadow:0px 0px 10px 0px rgba(0,0,0,0.2);



					-webkit-box-shadow:0px 0px 10px 0px rgba(0,0,0,0.2);



				}';



				}else{



				



				}



				/*Text Color End*/







				



				



				







		$html_new .= '</style>';



		



		//Color Picker Is Installed 



		if($backend_on_off <> 1){



			die(json_encode($html_new));



		}else{



			return $html_new;



		}



		



	}







	// Add Style to Frontend



	function add_font_code(){



		global $pagenow;



		



		//Style tag Start



		echo '<style type="text/css">';



			



			//Attach Background



			$select_bg_pat = cp_get_themeoption_value('select_bg_pat','general_settings');



			$body_image = cp_get_themeoption_value('body_image','general_settings');



			$image_repeat_layout = cp_get_themeoption_value('image_repeat_layout','general_settings');



			$position_image_layout = cp_get_themeoption_value('position_image_layout','general_settings');



			$image_attachment_layout = cp_get_themeoption_value('image_attachment_layout','general_settings');



			



			 if($select_bg_pat == 'Background-Image'){



				$image_src_head = '';							



				if(!empty($body_image)){ 



					$image_src_head = wp_get_attachment_image_src( $body_image, 'full' );



					$image_src_head = (empty($image_src_head))? '': $image_src_head[0];



					$thumb_src_preview = wp_get_attachment_image_src( $body_image, 'full');



				}



				echo 'body{



				background-image:url('.$thumb_src_preview[0].');



				background-repeat:'.$image_repeat_layout.';



				background-position:'.$position_image_layout.';



				background-attachment:'.$image_attachment_layout.';



				background-size:cover; }';



			}else if($select_bg_pat == 'Background-Color'){ 



				$bg_scheme = cp_get_themeoption_value('bg_scheme','general_settings');



				echo 'body{background:'.$bg_scheme.' !important;} .inner-pages h2 .txt-left{background:'.$bg_scheme.';}';



			}else if($select_bg_pat == 'Background-Patren'){



				$body_patren = cp_get_themeoption_value('body_patren','general_settings');



				$color_patren = cp_get_themeoption_value('color_patren','general_settings');



				//render Body Pattern



				if(!empty($body_patren)){



					$image_src_head = wp_get_attachment_image_src( $body_patren, 'full' );



					$image_src_head = (empty($image_src_head))? '': $image_src_head[0];



					$thumb_src_preview = wp_get_attachment_image_src( $body_patren, array(60,60));



					//Custom patterm



					if($thumb_src_preview[0] <> ''){ echo 'body{background:url('.$thumb_src_preview[0].') repeat !important;}'; }



				}else{ 



					$bg_scheme = cp_get_themeoption_value('bg_scheme','general_settings');



					$color_patren = cp_get_themeoption_value('color_patren','general_settings');



					//Default patterns



					echo 



					'body{background:'.$bg_scheme.' url('.CP_PATH_URL.$color_patren.') repeat;} 



					.inner-pages h2 .txt-left{background:'.$bg_scheme.' url('.CP_PATH_URL.$color_patren.') repeat;}'; 



				}



			}



			



			//Heading Variables



			$heading_h1 = cp_get_themeoption_value('heading_h1','typography_settings');



			$heading_h2 = cp_get_themeoption_value('heading_h2','typography_settings');



			$heading_h3 = cp_get_themeoption_value('heading_h3','typography_settings');



			$heading_h4 = cp_get_themeoption_value('heading_h4','typography_settings');



			$heading_h5 = cp_get_themeoption_value('heading_h5','typography_settings');



			$heading_h6 = cp_get_themeoption_value('heading_h6','typography_settings');



			



			//Render Heading sizes



			if($heading_h1 <> ''){ echo 'h1{ font-size:'.$heading_h1.'px !important; }'; }



			if($heading_h2 <> ''){ echo 'h2{ font-size:'.$heading_h2.'px !important; }'; }



			if($heading_h3 <> ''){ echo 'h3{ font-size:'.$heading_h3.'px !important; }'; }



			if($heading_h4 <> ''){ echo 'h4{ font-size:'.$heading_h4.'px !important; }'; }



			if($heading_h5 <> ''){ echo 'h5{ font-size:'.$heading_h5.'px !important; }'; }



			if($heading_h6 <> ''){ echo 'h6{ font-size:'.$heading_h6.'px !important; }'; }



			



			//Body Font Size



			$font_size_normal = cp_get_themeoption_value('font_size_normal','typography_settings');



			if($font_size_normal <> ''){ echo 'body{font-size:'.$font_size_normal.'px !important;}'; }



			



			//Body Font Size

			$font_size_normal = cp_get_themeoption_value('font_size_normal','typography_settings');

			if($font_size_normal <> ''){ echo 'body{font-size:'.$font_size_normal.'px !important;}'; }

			//Body Font Family
			
			$arabic_fonts_switch = cp_get_themeoption_value('arabic_fonts_switch','typography_settings');
			
			
			/** BODY FONTS **/
			
			if($arabic_fonts_switch == "enable"){
			
				//Arabic Font
				$font_google = cp_get_themeoption_value('arabic_font','typography_settings');

			
			}else{
			
				//Google Font
				$font_google = cp_get_themeoption_value('font_google','typography_settings');


			}
			


			if($font_google <> 'Default'){ echo '.classes-page .skill-inner .label, body,.comments-list li .text p, .header-4-address strong.info,.header-4-address a.email,strong.copy,.widget-box-inner p,.blog-post-box .text p,.box-1 p, .box-1 .textwidget,.get-touch-form input,.get-touch-form strong.title,.footer-copyright strong.copy,#inner-banner p,.welcome-text-box p,.about-me-text p,.about-me-text blockquote q,.team-box .text p,.accordition-box .accordion-inner p,.facts-content-box p,.our-detail-box p,.our-detail-box ul li,.widget_em_widget ul li,.sidebar-recent-post ul li p,blockquote p,blockquote q,.author-box .text p,.contact-page address ul li strong.title,.contact-page address ul li strong.ph,.contact-page address ul li strong.mob,.contact-page address ul li a.email,a.comment-reply-link,.timeline-project-box > .text p,.comments .text p,.event-row .text p,.project-detail p,.news-box .text p,.error-page p,.cp-columns p,.cp-list-style ul li,.customization-options ul li,.cp-accordion .accordion-inner strong,.list-box ul li,.list-box2 ul li,.list-box3 ul li,.tab-content p, .tab-content-area p,.blockquote-1 q,.blockquote-2 q,.map h3,.even-box .caption p,.header-4-address strong.info,.header-4-address a.email,strong.copy,.widget-box-inner p { font-family:"'.$font_google.'";}'; }else{ 



			echo '';



			}



			



			//Body Font Size



			$boxed_scheme = cp_get_themeoption_value('boxed_scheme','general_settings');



			$select_layout_cp = cp_get_themeoption_value('select_layout_cp','general_settings');



			if($select_layout_cp == 'box_layout'){ echo '.boxed{background:'.$boxed_scheme.';}'; }



			



			//Heading Font Family
			
			$font_google_heading = '';

			$font_google_heading = cp_get_themeoption_value('font_google_heading','typography_settings');
			
		

			if($font_google_heading <> 'Default'){ 

				/** HEADING FONTS **/

				if($arabic_fonts_switch == "enable"){
				
					//Arabic Font
					$font_google_heading = cp_get_themeoption_value('arabic_font_heading','typography_settings');

				
				}else{
				
					//Google Font
					$font_google_heading = cp_get_themeoption_value('font_google_heading','typography_settings');


				}



			echo '



			h1, h2, h3, h4, h5, h6, 



			.head-topbar .left ul li strong.number,



			.head-topbar .left ul li a,.navigation-area a.btn-donate-2,.footer-menu li a,.footer-menu2 li a,#nav-2 li a,#nav-2 li ul li a,.navigation-area a.btn-donate3,.top-search-input,a.btn-donate5,.navigation-area a.btn-donate,.top-search-input,.cp-banner .caption h1,.cp-banner .caption h2,.cp-banner .caption strong.title,.cp-banner .caption a.view,.widget-box-inner h2,.entry-header > h1,.h-style,.latest-news-box h3,.css3accordion .content .top a,.css3accordion .content .top strong.mnt,.css3accordion .content .top a.comment,.css3accordion .content strong.title,.css3accordion .content p,.css3accordion .content a.readmore,.upcoming-heading h3,.upcoming-box .caption strong.title,.upcoming-box .caption strong.mnt,.upcoming-events-box a.btn-view,.countdown_holding span,.countdown_period,.our-project a.btn-view,.our-project h3,.portfolio-filter li a,.gallery-box .caption strong.title,.timeline-box h3,.timeline-head strong.mnt,.timeline-frame-outer .caption h4,.timeline-frame-outer .caption p,.blog-post h3,.blog-post-box .caption strong.date,.blog-post-box .caption strong.comment,.blog-post-box .text strong.title,.blog-post-box .text h4,.blog-post-box .text a.readmore,.blog-post-share strong.title1,.name-box strong.name,.name-box-inner strong,.text-row strong.title,.text-row strong.time,.twitter-info-box ul li strong.number,.twitter-info-box ul li a.tweet,.box-1 h4,.box-1 a.btn-readmore,.box-1 .text strong.title,.box-1 .text strong.mnt,#inner-banner h1,.welcome-text-box h2,.about-me-left .text ul li h3,.about-me-left .text ul li strong.title,.about-me-socila strong.title,.about-me-text h3,.team-member-box h3,.team-box .text h4,.team-box .text h4 a,.team-box .text strong.title,.heading h3,.our-facts-box strong.number,.our-facts-box a.detail,.our-detail-box h4,.accordition-box .accordion-heading .accordion-toggle strong,.facts-tab-box .nav-tabs > li > a, .nav-pills > li > a,.blog-box-1 strong.title,.bottom-row .left span,.bottom-row .left a,.bottom-row .left ul li a,.bottom-row .right strong.title,.blog-box-1 .text h2,.blog-box-1 .text a.readmore,.pagination-all.pagination ul > li > a, .pagination ul > li > span,.sidebar-input,.sidebar-member a.member-text,.sidebar-recent-post h3,.sidebar-recent-post ul li:hover .text strong.title,.widget_em_widget ul li a,.sidebar-recent-post ul li .text strong.title,.sidebar-recent-post ul li a.mnt,.sidebar-recent-post ul li a.readmore,.list-area ul li a,.archive-box ul li a,.tagcloud a,.share-socila strong.title,.author-box .text strong.title,.contact-me-row strong.title,.blog-detail-form h3,.form-area label,.detail-input,.detail-textarea,.detail-btn-sumbit,.post-password-form input[type="submit"],#searchsubmit,.detail-btn-sumbit2,a.comment-reply-link,.donate-page h2,.donate-form ul li a,.donate-form-area ul li label,.donate-input,.donate-btn-submit,.timeline-project-box .holder .heading-area,.timeline-project-box .blog-box-1 > .text h2,.comment-box h3,.comments .text strong.title,.comments .text a.date,.comments .text a.reply,.timer-area ul li a,.event-detail-timer .countdown-amount,.contact-me-row2 strong.title,.contact-me-row2 ul li a,.related-event-box h3,.related-box .text strong.title,.related-box .text a.date,.member-input,.member-input-2,.member-input-3,.member-form label,.check-box strong.title,.member-btn-submit,.event-heading a,.event-row .text h2,.detail-row li a,.map-row a.location,.project-detail h2,.project-detail-list li .even,.project-detail-list li .odd,.other-project h3,.news-box .text-top-row span,.news-box .text-top-row a,.news-box .text-top-row a,.news-box .text h2,.news-box .text a.readmore,.slide-out-div h3,.error-page h2,.cp-columns h2,.cp-columns strong.title,.customization-options h2,.cp-highlighter h2,.cp-accordion .accordion-heading .accordion-toggle strong,.cp-testimonials h2,.frame-box strong.name,.frame-box strong.title,.testimonial-box-1 blockquote q,.single-testimonial blockquote q,.frame-box2 strong.name,.frame-box2 strong.title,.button-box a,.typography h1,h2.cp-heading-full,.typography h2,h3.cp-heading-full,.typography h3,h4.cp-heading-full,.typography h4,h5.cp-heading-full,.typography h5,h6.cp-heading-full,.typography h6,.tabs-box .nav-tabs > li > a, .nav-pills > li > a,#wp-calendar caption,.even-box .caption h2,.timeline-round strong.year,#search-text input[type="text"],.sidebar-recent-post select,.content_section .review-final-score h3,.content_section .review-final-score h4, #cp_header7 .navigation-row .navbar-default li a, 



			.thumb-style .caption h2, .thumb-style .caption strong, .services-box .cp_strong, .food-title h2, .food-title strong, .cp_special-menu .text h2, .cp_special-menu .btn-light,



			.cp_our-menu .nav-tabs > li > a, .food-title h2, .chef-info .text strong.title, .event-carousel-holder .event-info .cp_strong, .event-carousel-holder .countdown-amount,



			.our-facts-box strong, .cp_blog-section .blog-list .cp_strong, .cp_blog-section .more-info, .cp-few-words .cp-heading-full, .footer-top h2



			



			



			



			{ font-family:"'.$font_google_heading.'";}'; }else{ echo 'h1, h2, h3, h4, h5, h6{}';}



			


			//Menu Font Family

			$menu_font_google = cp_get_themeoption_value('menu_font_google','typography_settings');
			
			
			/** MENU FONTS **/
			
			if($arabic_fonts_switch == "enable"){
			
				//Arabic Font
				$menu_font_google = cp_get_themeoption_value('arabic_menu_font','typography_settings');

			
			}else{
			
				//Google Font
				$menu_font_google = cp_get_themeoption_value('menu_font_google','typography_settings');


			}
			

			if($menu_font_google <> 'Default'){ echo '#mega_main_menu.main-menu > .menu_holder > .menu_inner > .nav_logo > .mobile_toggle > .mobile_button, #mega_main_menu.main-menu > .menu_holder > .menu_inner > ul > li > .item_link, #mega_main_menu.main-menu > .menu_holder > .menu_inner > ul > li > .item_link .link_text, #mega_main_menu.main-menu > .menu_holder > .menu_inner > ul > li.nav_search_box *, #mega_main_menu.main-menu > .menu_holder > .menu_inner > ul > li .post_details > .post_title, #mega_main_menu.main-menu > .menu_holder > .menu_inner > ul > li .post_details > .post_title > .item_link, .navigation ul{font-family:"'.$menu_font_google.' !important";}';}else{ echo '#nav{font-family:"Open Sans",sans-serif;}';}



			



			//Header Section Image Background



			$header_logo_bg = cp_get_themeoption_value('header_logo_bg','general_settings');







			$image_src = '';



			if(!empty($header_logo_bg)){ 



				$image_src = wp_get_attachment_image_src( $header_logo_bg, 'full' );



				$image_src = (empty($image_src))? '': $image_src[0];			



			}







			if($header_logo_bg <> ''){



				if($image_src <> ''){



					echo '#inner-banner {background: url('.$image_src.') bottom right !important;}';



				}



			}



			else{



				$path =  CP_PATH_URL;



				echo '#inner-banner {background: url('.$path.'"/cp_images/inner-banner.png") right center;}';



			}







			



			



			



			



			



		echo '</style>';



		//Style Tag End



		



		



		$color_scheme = cp_get_themeoption_value('color_scheme','general_settings');	



		$body_color = cp_get_themeoption_value('body_color','general_settings');



		$heading_color = cp_get_themeoption_value('heading_color','general_settings');



		$select_layout_cp = cp_get_themeoption_value('select_layout_cp','general_settings');



		



		$recieve_color = '';



		$recieve_an_color = '';



		$html_new = '';



		$backend_on_off = 1;



		//Color Scheme



		echo cp_color_bg($color_scheme,$bg_texture='',$navi_color='',$heading_color,$body_color,$select_layout_cp,$backend_on_off);



	}







	//Add Style in Footer



	global $pagenow;



	if( $GLOBALS['pagenow'] != 'wp-login.php' ){



		if(!is_admin()){



			//for Frontend only



			add_action('wp_head', 'add_font_code');



		}



	}