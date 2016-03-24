( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#site-title a' ).html( newval );
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	//Update site title color in real time...
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('#site-title a').css('color', newval );
		} );
	} );

	//Update site background color...
	wp.customize( 'background_color', function( value ) {
		value.bind( function( newval ) {
			$('.search-header button, .contact-btn, .heading-bar, .accordian-list .accordion-heading a:hover, .accordian-list .bx-wrapper .bx-pager.bx-default-pager a:hover, .accordian-list .bx-wrapper .bx-pager.bx-default-pager a.active, .post-type, .recent-post-list .nav-tabs > li, .recent-post-list .nav > li > a:hover, .recent-post-list .nav > li > a:focus, .next-e-slider .bx-wrapper .bx-pager.bx-default-pager a:hover, .next-e-slider .bx-wrapper .bx-pager.bx-default-pager a.active, .form-list input[type="submit"], .ui-tabs-active, #vertical-tabs ul li, .g-l-nav li a:hover, #product-:hover .product-img, .category_list_filterable li a:hover, .add_to_cart_button, .product-nav li a, .check-btn, .cart-nav a, .btn-bar-chekout a, .checkout-accordian .accordion-heading, .checkout-accordian .check-btn:hover, .accordion2 .accordion-heading a:hover, .product-opt, .y-bg, .widget_shopping_cart .continue_shopping:hover, .widget_product_categories ul.product-categories li:hover, .widget_product_search #searchsubmit, .widget_tag_cloud .tagcloud a:hover, .widget_meta ul li a:hover, .widget_pages ul li a:hover, .widget_pages ul ul li a:before, .widget_search #searchform > input, .widget_nav_menu ul li a:hover, .widget_archive ul li:hover, .widget_recent_entries ul li:hover, .widget_categories ul li a:hover, .widget_calendar #calendar_wrap caption, .widget_calendar #calendar_wrap table tbody tr td:hover, .widget_calendar #calendar_wrap table tfoot tr td, .story-slider .bx-wrapper .bx-pager.bx-default-pager a:hover, .story-slider .bx-wrapper .bx-pager.bx-default-pager a.active, .calender-box .header, .newsletter-box .heading, .btn-submit, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, .cart_table_holder table thead tr, .product-remove a, .cart_table_holder table tfoot .cbtn, .cart_btn_wrapper input.button, .cart_btn_wrapper input.button.alt, .place-order input.button.alt, .woocommerce a.button, .woocommerce-page a.button, .woocommerce button.button, .woocommerce-page button.button, .woocommerce input.button, .woocommerce-page input.button, .woocommerce #respond input#submit, .woocommerce-page #respond input#submit, .woocommerce #content input.button, .woocommerce-page #content input.button, .woocommerce-info:before, .album-section-2 ul li .text a.buy, .gallery_img .mask .anchor:hover, .comment-respond #commentform #submit, .comment-respond #commentform  .logged-in-as a:hover, .song-list li:hover .extra a, .song-list li:hover .num, .popular_post ul li:hover span, .newsletter .field-holder #btn_newsletter, .newsletter div.message-box-wrapper.red, .jp-play-bar, .jp-volume-bar-value, .widget_recent_comments ul li:hover, .sub-menu > li > a:hover, .sub-menu > li > a:focus, .dropdown-submenu:hover > a, .dropdown-submenu:focus > a, .sub-menu > li > a:hover, .sub-menu > li > a:focus, .dropdown-submenu:hover > a, .dropdown-submenu:focus > a, .sub-menu > .active > a, .sub-menu > .active > a:hover, .sub-menu > .active > a:focus, mark, #event_calander .fc-button-next, .woocommerce-ordering select option, .footer-nav ul li a:hover, .pagination ul > .active > a, .pagination ul > .active > span, .pagination ul > li > a:hover, .pagination ul > li > a:focus, .pagination ul > .active > a, .pagination ul > .active > span , .widget_meta ul li a:hover').css('background-color', newval );
		} );
	} );
	
	//Update site title color in real time...
	wp.customize( 'mytheme_options[link_textcolor]', function( value ) {
		value.bind( function( newval ) {
			$('#stylesheetd').remove();
			$('.news-title, .slider_content h2 span, .widget_recent_comments ul li, .ticker-bar h2, .main-c-holder h2 span, .accordian-list .img-cap h3, .post-nav i, .widget_recent_entries ul li, div.jp-type-playlist div.jp-playlist li.jp-playlist-current a, .jp-current-time, .jp-duration, .widget_archive ul li, .widget_shopping_cart .widget_shopping_cart_content ul li a.trash_icon, .slider-cap h2 span, .support-cap h3, .dontae-btn, .f-title, .story-btn a:hover, .team-sec .team_member p, .team-sec .team_member h3, .type-list, .address-box .title, .address-box p span, .list-nav a, p.y-txt, .y-txt a, .post-author, .widget_onsale ul.product_list_widget li a, .widget_random_products ul.product_list_widget li a, .widget_recent_products ul.product_list_widget li a, .widget_recently_viewed_products ul.product_list_widget li a, .widget_top_rated_products ul.product_list_widget li a, .widget_recent_reviews ul.product_list_widget li a, .widget_calendar #calendar_wrap table tfoot tr td a:hover, .post-author-d h4 span, .comments-list li .comm-title span, .comm-rep, .form label, .woocommerce ul.products div.product .price, .woocommerce-page ul.products div.product .price, .variations td.label label, .price_holder .price, .comment-respond #commentform  .logged-in-as, .popular_post ul li:hover a, div.jp-type-playlist div.jp-playlist a:hover, div.jp-type-playlist div.jp-playlist a.jp-playlist-item-remove, div.jp-type-playlist div.jp-playlist a.jp-playlist-item-remove:hover, div.jp-type-playlist div.jp-playlist span.jp-free-media, div.jp-type-playlist div.jp-playlist span.jp-free-media a, div.jp-type-playlist div.jp-playlist span.jp-free-media a:hover, span.jp-artis, .fc-sun, .price, .breadcrumb li a, .pagination ul > li > a, .pagination ul > li > span, .post-holder:hover .post-type-bar i').css('color', newval );
			
			$('.bx-wrapper .bx-pager.bx-default-pager a, .bx-wrapper .bx-pager.bx-default-pager a:hover, .bx-wrapper .bx-pager.bx-default-pager a.active, .bx-wrapper .bx-viewport, .search-header button, .bg-style, .full_layout .inner-p-nav, .team-sec .team_member, .f-img img, .flickr-list li a:hover img, .woocommerce ul.products div.product:hover, .woocommerce-message, .woocommerce-error, .woocommerce-info, div.jp-type-playlist div.jp-playlist li.jp-playlist-current, .nav-tabs > .active > a, .nav-tabs > .active > a:hover, .nav-tabs > .active > a:focus, .navbar .nav li.dropdown.open > .dropdown-toggle, .navbar .nav li.dropdown.active > .dropdown-toggle, .navbar .nav li.dropdown.open.active > .dropdown-toggle, .navbar-inverse .brand, .navbar-inverse .nav > li.active > a, .navbar-inverse .nav > li > a:focus, .navbar-inverse .nav > li > a:hover, .navbar-inverse .nav-collapse .nav > li > a:hover, .navbar-inverse .nav-collapse .nav > li > a:focus, .navbar-inverse .nav-collapse .sub-menu a:hover, .navbar-inverse .nav-collapse .sub-menu a:focus, .portfolio-item:hover .product-img').css('border-color', newval );
		} );
	} );
	
} )( jQuery );