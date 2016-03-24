/**
 *	CrunchPress Page Dragging File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		CrunchPress
 * 	@link		http://crunchpress.com
 * 	@copyright	Copyright (c) CrunchPress
 * 	---------------------------------------------------------------------
 * 	This file contains the jQuery script for Page Dragging
 *	---------------------------------------------------------------------
 */
jQuery(document).ready(function () {

    // All of size that div can be (text, class, value)
    var DIV_SIZE = [
        ['1/4', 'element1-4', 1 / 4, ['Features','Column','Sidebar','Gallery', 'Contact-Form', 'Content', 'Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue']],
        ['1/3', 'element1-3', 1 / 3, ['Features','Sidebar','Heading-Banner','Column', 'Gallery', 'Contact-Form', 'Content','Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue']],
        ['1/2', 'element1-2', 1 / 2, ['News','Features','Timeline','Sidebar','Contact-Form', 'Column', 'Gallery',  'Single-Album','Content','Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue']],
        ['2/3', 'element2-3', 2 / 3, ['Blog', 'Events-Slider','Next-Events','Sidebar','Event-Calendar','Events','Music-Gallery','Features','Column', 'Gallery', 'Contact-Form', 'Content', 'Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue']],
        ['3/4', 'element3-4', 3 / 4, ['Features','Column', 'Gallery','Sidebar','Contact-Form', 'Content','Modern-Blog','Slider', 'Accordion', 'Tab', 'Message-Box', 'Toggle-Box','Venue']],
        ['1/1', 'element1-1', 1, ['Crowd-Slider', 'Events-Slider', 'Blog-Slider', 'Products_Slider','Store','Latest-News','Crowd-Funding','Timeline','Feature-Projects','Woo-Products','Next-Events','Sidebar','Artists','Features', 'Column', 'Gallery', 'Content', 'Blog','Events','Music-Gallery', 'News', 'Albums', 'Slider', 'Accordion', 'Tab', 'Divider', 'Message-Box', 'Toggle-Box', 'Contact-Form','Carousel']],
    ];

    var page_item_list = jQuery("#page-element-lists");
    var page_methodology = jQuery('#page-methodology');
    var page_alignment_val = '';

    //Sidebar Script For Show and Hide
    jQuery('input[name="page-option-sidebar-template"]').change(function () {
        jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
        jQuery(this).siblings("label").children("#check-list").addClass("check-list");
        if (jQuery(this).val() == "left-sidebar") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").removeClass('default-slider-hide');
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").addClass('default-slider-hide');
        } else if (jQuery(this).val() == "right-sidebar") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").addClass('default-slider-hide');
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").removeClass('default-slider-hide');
        } else if (jQuery(this).val() == "both-sidebar") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").removeClass('default-slider-hide');
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").removeClass('default-slider-hide');
        } else if (jQuery(this).val() == "both-sidebar-left") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").removeClass('default-slider-hide');
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").removeClass('default-slider-hide');
        } else if (jQuery(this).val() == "both-sidebar-right") {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").removeClass('default-slider-hide');
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").removeClass('default-slider-hide');
        } else {
            jQuery("#page-option-choose-left-sidebar").parents(".meta-body").addClass('default-slider-hide');
            jQuery("#page-option-choose-right-sidebar").parents(".meta-body").addClass('default-slider-hide');
        }
    });
    jQuery('input[name="page-option-sidebar-template"]:checked').triggerHandler("change");

    // Change the style of <select>
    if (!jQuery.browser.opera) {
        jQuery('.meta-input .combobox select').each(function () {
            var title = jQuery(this).attr('title');
            if (jQuery('option:selected', this).val() != '') title = jQuery('option:selected', this).text();
            jQuery(this)
                .css({
                'z-index': 10,
                'opacity': 0,
                '-khtml-appearance': 'none'
            })
                .after('<span rel="combobox">' + title + '</span>')
                .change(function () {
                val = jQuery('option:selected', this).text();
                jQuery(this).next().text(val);
            })
        });
    };

    //Bind the delete element button
    var init_object = jQuery("div#cp-overlay-wrapper");
    init_object.find(".delete-element").click(function () {

        var deleted_element = jQuery(this).parents('#page-element');

        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_element.fadeOut(function () {
                            jQuery(this).remove();
                        });
                    }
                },
                'Cancel': {
                    'class': 'confirm-no',
                    'action': function () {
                        return false;
                    }
                }
            }
        });
    });

    //Add Element Size
    init_object.find(".add-element-size").click(function () {
        jQuery(this).cpPageAddElementSize();
    });
    jQuery.fn.cpPageAddElementSize = function () {
        var click_object = jQuery(this).parents('#page-element');
        var object_type = click_object.attr('rel');
        var is_upper_style = false;
        var current_style = '';
        for (var i = 0; i < DIV_SIZE.length - 1; i++) {
            if (click_object.hasClass(DIV_SIZE[i][1])) {
                is_upper_style = true;
                current_style = DIV_SIZE[i][1];
            }
            if (is_upper_style && jQuery.inArray(object_type, DIV_SIZE[i + 1][3]) > -1) {
                if (i < DIV_SIZE.length - 2) {
                    click_object.removeClass(current_style).addClass(DIV_SIZE[i + 1][1]);
                    click_object.find("#element-size-text").html(DIV_SIZE[i + 1][0]);
                    click_object.find("#page-option-item-size").val(DIV_SIZE[i + 1][1])
                } else if (i == DIV_SIZE.length - 2) {
                    click_object.removeClass(current_style).addClass(DIV_SIZE[i + 1][1]);
                    click_object.find("#element-size-text").html(DIV_SIZE[i + 1][0]);
                    click_object.find("#page-option-item-size").val(DIV_SIZE[i + 1][1])
                }
                break;
            }
        }
    }

    //Subtract Element size
    init_object.find(".sub-element-size").click(function () {
        jQuery(this).cpPageSubElementSize();
    });
    jQuery.fn.cpPageSubElementSize = function () {
        var click_object = jQuery(this).parents('#page-element');
        var object_type = click_object.attr('rel');
        var is_lower_style = false;
        var current_style = '';
        for (var i = DIV_SIZE.length - 1; i > 0; i--) {
            if (click_object.hasClass(DIV_SIZE[i][1])) {
                is_lower_style = true;
                current_style = DIV_SIZE[i][1];
            }
            if (is_lower_style && jQuery.inArray(object_type, DIV_SIZE[i - 1][3]) > -1) {
                if (i > 1) {
                    click_object.removeClass(current_style).addClass(DIV_SIZE[i - 1][1]);
                    click_object.find("#element-size-text").html(DIV_SIZE[i - 1][0]);
                    click_object.find("#page-option-item-size").val(DIV_SIZE[i - 1][1])
                } else if (i == 1) {
                    click_object.removeClass(current_style).addClass(DIV_SIZE[i - 1][1]);
                    click_object.find("#element-size-text").html(DIV_SIZE[i - 1][0]);
                    click_object.find("#page-option-item-size").val(DIV_SIZE[i - 1][1])
                }
                break;
            }
        }
    }

    //Bind Add Items
	var counter = 0;
    jQuery("a.dragable").click(function () {
        //var selectd_list = jQuery(this).siblings(".page-select-element-list-wrapper").children("select");
        var selectd_list = jQuery(this).text();

        var clone_item = page_item_list.find('div[rel="' + selectd_list + '"]').clone(true);
        if (clone_item) {
            clone_item.find("#page-option-item-size").attr('name', function () {
                return jQuery(this).attr('id') + '[]';
            });
            clone_item.find("#page-option-item-type").attr('name', function () {
                return jQuery(this).attr('id') + '[]';
            });
            clone_item.css("display", "none");
			page_methodology.find("#page-selected-elements").find('.bg_title_drop').hide();
			var dd = page_methodology.find('#page-selected-elements').html();
            page_methodology.find("#page-selected-elements").append(clone_item);
            page_methodology.find(".page-element").fadeIn();
        }
    });
	var selected_element = page_methodology.find("#page-selected-elements").find('#page-element').attr('id');
	if(selected_element == 'page-element'){
		page_methodology.find("#page-selected-elements").find('.bg_title_drop').hide();
	}
    page_methodology.find("#page-selected-elements").sortable({
        forcePlaceholderSize: true,
        placeholder: 'placeholder'
    });

    //jQuery("a[rel='dd']").click(function(){jQuery("input#page-add-item-button").click(function(){
    //var selectd_list = jQuery(this).siblings(".page-select-element-list-wrapper").children("select");
    //var selectd_list = jQuery(this).text();

    //var clone_item = page_item_list.find('div[rel="' + selectd_list + '"]').clone(true);
    //if( clone_item ){
    //clone_item.find("#page-option-item-size").attr('name',function(){
    //return jQuery(this).attr('id')+ '[]';
    //});
    //clone_item.find("#page-option-item-type").attr('name',function(){
    //return jQuery(this).attr('id')+ '[]';
    //});
    //clone_item.css("display","none");
    //page_methodology.find("#page-selected-elements").append(clone_item);
    //page_methodology.find(".page-element").fadeIn();
    //}
    //});

    //page_methodology.find("#page-selected-elements").sortable({ forcePlaceholderSize: true, placeholder: 'placeholder' });


    // Button effects;
    jQuery(".add-element-size").hover(function () {
        jQuery(this).addClass("add-element-size-hover");
    }, function () {
        jQuery(this).removeClass("add-element-size-hover");
    });
    jQuery(".sub-element-size").hover(function () {
        jQuery(this).addClass("sub-element-size-hover");
    }, function () {
        jQuery(this).removeClass("sub-element-size-hover");
    });

    // Tab chooser
    jQuery('.page-item-tab').css('display', 'block');
    jQuery(".page-tab-add-more").click(function () {
        var added_tab = jQuery(this).siblings(".meta-input").children("#added-tab");
        var clone_tab = added_tab.find(".default").clone(true);
        clone_tab.attr('class', 'page-item-tab');
        clone_tab.find('input, textarea, select').attr('name', function () {
            return jQuery(this).attr('id') + '[]';
        });
        added_tab.siblings("#tab-num").val(function () {
            return parseInt(jQuery(this).val()) + 1;
        });
        added_tab.children("ul").append(clone_tab);
        added_tab.find('.page-item-tab').slideDown();

    });
    jQuery(".unpick-tab").click(function () {
        var deleted_tab = jQuery(this);

        jQuery.confirm({
            'message': 'Are you sure to do this?',
            'buttons': {
                'Confirm': {
                    'class': 'confirm-yes',
                    'action': function () {
                        deleted_tab.parents('#page-item-tab').slideUp(function () {
                            jQuery(this).remove();
                        });
                        deleted_tab.parents("#added-tab").siblings("#tab-num").val(function () {
                            return parseInt(jQuery(this).val()) - 1;
                        });
                    }
                },
                'Cancel': {
                    'class': 'confirm-no',
                    'action': function () {
                        return false;
                    }
                }
            }
        });
    });

   

    jQuery('select#page-option-item-slider-linktype, select#page-option-top-slider-linktype').each(function () {
        var selected_val = jQuery(this).val();
        if (selected_val == 'No Link' || selected_val == 'Lightbox') {
            jQuery(this).parent().siblings('div').css('display', 'none');
        } else {
            if (selected_val == 'Link to URL') {
                jQuery(this).parent().siblings('div').not('[rel="video"]').css('display', 'block');
                jQuery(this).parent().siblings('div[rel="video"]').css('display', 'none');
            } else {
                jQuery(this).parent().siblings('div').not('[rel="url"]').css('display', 'block');
                jQuery(this).parent().siblings('div[rel="url"]').css('display', 'none');
            }
        }
    });

	
	// Inside Element Condition for The Column on Full width
    jQuery("div.combobox #page-option-item-full-width").change(function () {
		var image_class = jQuery(this).parent().parent().parent().parent().parent().children().find('.enable-image-class');
		var color_class = jQuery(this).parent().parent().parent().parent().siblings().find('.enable-color-class');
		if (jQuery(this).val() == 'Plain') {
			image_class.parent().addClass('default-slider-hide');
			color_class.parent().addClass('default-slider-hide');
		} else if(jQuery(this).val() == 'Background Image'){
			color_class.parent().removeClass('default-slider-hide');
			image_class.parent().removeClass('default-slider-hide');
		}else if(jQuery(this).val() == 'Background Color'){
			color_class.parent().removeClass('default-slider-hide');
			image_class.parent().addClass('default-slider-hide');
		}
    });
	
	// Inside Element Condition for The Column on Full width on Load
    jQuery("div.combobox #page-option-item-full-width").each(function () {
		var image_class = jQuery(this).parent().parent().parent().parent().parent().children().find('.enable-image-class');
		var color_class = jQuery(this).parent().parent().parent().parent().siblings().find('.enable-color-class');
		if (jQuery(this).val() == 'Plain') {
			image_class.parent().addClass('default-slider-hide');
			color_class.parent().addClass('default-slider-hide');
		} else if(jQuery(this).val() == 'Background Image'){
			color_class.parent().removeClass('default-slider-hide');
			image_class.parent().removeClass('default-slider-hide');
		}else if(jQuery(this).val() == 'Background Color'){
			color_class.parent().removeClass('default-slider-hide');
			image_class.parent().addClass('default-slider-hide');
		}
    });
	
	
	
		// Inside Element Condition for The Column on Full width
    jQuery("div.combobox #page-option-select-services-layout").change(function () {
		var image_class = jQuery(this).parent().parent().parent().parent().parent().children().find('.enable-image-class');
		var font_class = jQuery(this).parent().parent().parent().parent().parent().find('.enable-font-class');
		//var color_class = jQuery(this).parent().parent().parent().parent().siblings().find('.enable-color-class');
		if (jQuery(this).val() == 'Style 3') {
			image_class.parent().removeClass('default-slider-hide');
			font_class.parent().addClass('default-slider-hide');
		}else if(jQuery(this).val() == 'Style 4'){
			image_class.parent().removeClass('default-slider-hide');
			font_class.parent().addClass('default-slider-hide');
		}else{
			image_class.parent().addClass('default-slider-hide');
			font_class.parent().removeClass('default-slider-hide');
		}
    });
	
	// Inside Element Condition for The Column on Full width on Load
    jQuery("div.combobox #page-option-select-services-layout").each(function () {
		var image_class = jQuery(this).parent().parent().parent().parent().parent().children().find('.enable-image-class');
		var font_class = jQuery(this).parent().parent().parent().parent().parent().find('.enable-font-class');
		if (jQuery(this).val() == 'Style 3') {
			image_class.parent().removeClass('default-slider-hide');
			font_class.parent().addClass('default-slider-hide');
		}else if(jQuery(this).val() == 'Style 4'){
			image_class.parent().removeClass('default-slider-hide');
			font_class.parent().addClass('default-slider-hide');
		}else{
			image_class.parent().addClass('default-slider-hide');
			font_class.parent().removeClass('default-slider-hide');
		}
    });
	

	
	
	
	// Footer Product Toogle Script Start On Load 
    var selected_class = jQuery("#cp-show-footer-product option:selected").attr("rel");
    if (selected_class == 'Yes') {
        jQuery('#cp-footer-product-slider').slideDown();
    } else {
        jQuery('#cp-footer-product-slider').slideUp();
    }

    // Footer Product Toogle Script Start On Change
    jQuery('#cp-show-footer-product').change(function () {
        var option_class = jQuery("#cp-show-footer-product option:selected").attr("rel");
        if (option_class == 'Yes') {
			jQuery('#cp-footer-product-slider').slideDown();
        } else {
            jQuery('#cp-footer-product-slider').slideUp();
        }
    });
    // Footer Product Toogle Script Ends
	
	
	// News Headline Script On Load
    var selected_class = jQuery("#cp-show-full-layout option:selected").attr("rel");
    if (selected_class == 'Yes') {
		jQuery('.cp-options-cp-div-5').addClass('default-slider-hide');
		
		jQuery('a[rel="Division_Start"]').parent().removeClass('default-slider-hide');
		jQuery('a[rel="Division_End"]').parent().removeClass('default-slider-hide');
		
		jQuery('div[rel="Division_Start"]').removeClass('default-slider-hide');
		jQuery('div[rel="Division_End"]').removeClass('default-slider-hide');
		
    } else {
        jQuery('.cp-options-cp-div-5').removeClass('default-slider-hide');
		
		//Page Builder Element
		jQuery('a[rel="Division_Start"]').parent().addClass('default-slider-hide');
		jQuery('a[rel="Division_End"]').parent().addClass('default-slider-hide');
		//page Builder Dropped Element
		jQuery('div[rel="Division_Start"]').addClass('default-slider-hide');
		jQuery('div[rel="Division_End"]').addClass('default-slider-hide');
		
    }

    // News Headline Script On Change Start
    jQuery('#cp-show-full-layout').change(function () {
        var option_class = jQuery("#cp-show-full-layout option:selected").attr("rel");
		if (option_class == 'Yes') {
			//Sidebar complete element
			jQuery('.cp-options-cp-div-5').addClass('default-slider-hide');
			//Page Builder Element
			jQuery('a[rel="Division_Start"]').parent().removeClass('default-slider-hide');
			jQuery('a[rel="Division_End"]').parent().removeClass('default-slider-hide');
			//Page Builder Dropped Element
			jQuery('div[rel="Division_Start"]').removeClass('default-slider-hide');
			jQuery('div[rel="Division_End"]').removeClass('default-slider-hide');
		} else {
			//Sidebar
			jQuery('.cp-options-cp-div-5').removeClass('default-slider-hide');
			//Page Builder Element
			jQuery('a[rel="Division_Start"]').parent().addClass('default-slider-hide');		
			jQuery('a[rel="Division_End"]').parent().addClass('default-slider-hide');
			//page Builder Dropped Element
			jQuery('div[rel="Division_Start"]').addClass('default-slider-hide');
			jQuery('div[rel="Division_End"]').addClass('default-slider-hide');
		}
    });
    // News Headline Script On Change Ends
	
	// Footer Product Script On Load
    var selected_class = jQuery("#cp-show-footer-product option:selected").attr("rel");
    if (selected_class == 'No') {
        jQuery('.footer-product-here').parent().addClass('default-slider-hide');
    } else {
        jQuery('.footer-product-here').parent().removeClass('default-slider-hide');
    }

    // Footer Product Script On Change Start
    jQuery('#cp-show-footer-product').change(function () {
        var option_class = jQuery("#cp-show-footer-product option:selected").attr("rel");
        if (option_class == 'No') {
			jQuery('.footer-product-here').parent().addClass('default-slider-hide');
        } else {
            jQuery('.footer-product-here').parent().removeClass('default-slider-hide');
        }
    });
    // Footer Product Script On Change Start
	
	jQuery("#meta-header > a").click(function () {
		//Active Class
		var page_builder = jQuery(this).attr('class');
		if(jQuery(this).attr('id') == 'active'){
			jQuery('#'+page_builder).hide();
			jQuery(this).attr('id','no-active');
		}else{
			jQuery('#'+page_builder).show();
			jQuery(this).attr('id','active');
		}
	});
	
	
	// PageBuilder Conditional Options Script On load
	
	
	
    var selected_class = jQuery("#page-option-top-slider-on option:selected").attr("rel");
	var layer_sisel = jQuery("#page-option-top-slider-types option:selected").attr("rel");
	var schedule_manage = jQuery("#page-option-top-schedule-mana option:selected").attr("rel");
    if (selected_class == 'No') {
		jQuery('.slider-default').parent().addClass('default-slider-hide');
		jQuery('.slider-layer').parent().addClass('default-slider-hide');
		jQuery('.slider-default-selection').parent().addClass('default-slider-hide');
		jQuery('.page-title-here').parent().removeClass('default-slider-hide');
		jQuery('.slider-none').parent().addClass('default-slider-hide');
		jQuery('.banner-text-here').parent().addClass('default-slider-hide');
		jQuery('.manage_schedule_cp').parent().hide();
		jQuery('.post_slider_category_main').parent().hide();
    } else {
		//Condition if layerSlider is selected
		if(layer_sisel == 'Layer-Slider'){
			jQuery('.slider-layer').parent().removeClass('default-slider-hide');
			jQuery('.slider-default').parent().addClass('default-slider-hide');
			jQuery('.slider-none').parent().addClass('default-slider-hide');
			jQuery('#page-option-top-slider-images').parent().parent().parent().show();
			jQuery('.post_slider_category_main').parent().hide();
		}else if(layer_sisel == 'Add-Shortcode'){
			jQuery('.slider-layer').parent().addClass('default-slider-hide');
			jQuery('.slider-default').parent().addClass('default-slider-hide');
			jQuery('.slider-none').parent().removeClass('default-slider-hide');
			jQuery('#page-option-top-slider-images').parent().parent().parent().show();
			jQuery('.post_slider_category_main').parent().hide();
		}else if(layer_sisel == 'Post-Slider'){
			jQuery('#page-option-top-slider-images').parent().parent().parent().hide();
			jQuery('.post_slider_category_main').parent().show();
			jQuery('.post_slider_category_main').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.slider-layer').parent().addClass('default-slider-hide');
			jQuery('.slider-default').parent().removeClass('default-slider-hide');
			jQuery('.slider-none').parent().addClass('default-slider-hide');
			jQuery('#page-option-top-slider-images').parent().parent().parent().show();
			jQuery('.post_slider_category_main').parent().hide();
		}
		if(schedule_manage == 'No-Option'){
			jQuery('.schedule-category-ev').parent().hide();
			jQuery('.schedule-category-cl').parent().hide();
			jQuery('.schedule-category-sr').parent().hide();
		}else if(schedule_manage == 'Classes'){
			jQuery('.schedule-category-ev').parent().hide();
			jQuery('.schedule-category-cl').parent().show();
			jQuery('.schedule-category-sr').parent().hide();
		}else if(schedule_manage == 'Events'){
			jQuery('.schedule-category-ev').parent().show();
			jQuery('.schedule-category-cl').parent().hide();
			jQuery('.schedule-category-sr').parent().hide();
		}else if(schedule_manage == 'Services'){
			jQuery('.schedule-category-ev').parent().hide();
			jQuery('.schedule-category-cl').parent().hide();
			jQuery('.schedule-category-sr').parent().show();
		}
		jQuery('.slider-default-selection').parent().removeClass('default-slider-hide');
		jQuery('.page-title-here').parent().addClass('default-slider-hide');
		jQuery('.banner-text-here').parent().removeClass('default-slider-hide');
    }
	// PageBuilder Conditional Options Script On load Ends
	jQuery('#page-option-top-schedule-mana').change(function () {
		var schedule_manage = jQuery("#page-option-top-schedule-mana option:selected").attr("rel");
		if(schedule_manage == 'No-Option'){
			jQuery('.schedule-category-ev').parent().hide();
			jQuery('.schedule-category-cl').parent().hide();
			jQuery('.schedule-category-sr').parent().hide();
		}else if(schedule_manage == 'Classes'){
			jQuery('.schedule-category-ev').parent().hide();
			jQuery('.schedule-category-cl').parent().show();
			jQuery('.schedule-category-sr').parent().hide();
		}else if(schedule_manage == 'Events'){
			jQuery('.schedule-category-ev').parent().show();
			jQuery('.schedule-category-cl').parent().hide();
			jQuery('.schedule-category-sr').parent().hide();
		}else if(schedule_manage == 'Services'){
			jQuery('.schedule-category-ev').parent().hide();
			jQuery('.schedule-category-cl').parent().hide();
			jQuery('.schedule-category-sr').parent().show();
		}
	});
    // PageBuilder Conditional Options Script On Change
    jQuery('#page-option-top-slider-on').change(function () {
        var option_class = jQuery("#page-option-top-slider-on option:selected").attr("rel");
		var layer_sisel = jQuery("#page-option-top-slider-types option:selected").attr("rel");
		var schedule_manage = jQuery("#page-option-top-schedule-mana option:selected").attr("rel");		
        if (option_class == 'No') {
			jQuery('.slider-default').parent().addClass('default-slider-hide');
			jQuery('.slider-layer').parent().addClass('default-slider-hide');
			jQuery('.slider-default-selection').parent().addClass('default-slider-hide');
			jQuery('.page-title-here').parent().removeClass('default-slider-hide');
			jQuery('.slider-none').parent().addClass('default-slider-hide');
			jQuery('.banner-text-here').parent().addClass('default-slider-hide');
			jQuery('.manage_schedule_cp').parent().hide();
			jQuery('.post_slider_category_main').parent().hide();
        } else {
			//Condition if layerSlider is selected
			if(layer_sisel == 'Layer-Slider'){
				jQuery('.slider-layer').parent().removeClass('default-slider-hide');
				jQuery('.slider-default').parent().addClass('default-slider-hide');
				jQuery('.slider-none').parent().addClass('default-slider-hide');
				jQuery('#page-option-top-slider-images').parent().parent().parent().show();
				jQuery('.post_slider_category_main').parent().hide();
			}else if(layer_sisel == 'Add-Shortcode'){
				jQuery('.slider-layer').parent().addClass('default-slider-hide');
				jQuery('.slider-default').parent().addClass('default-slider-hide');
				jQuery('.slider-none').parent().removeClass('default-slider-hide');
				jQuery('#page-option-top-slider-images').parent().parent().parent().show();
				jQuery('.post_slider_category_main').parent().hide();
			}else if(layer_sisel == 'Post-Slider'){
				jQuery('#page-option-top-slider-images').parent().parent().parent().hide();
				jQuery('.post_slider_category_main').parent().show();
				jQuery('.post_slider_category_main').parent().removeClass('default-slider-hide');
			}else{
				jQuery('.slider-layer').parent().addClass('default-slider-hide');
				jQuery('.slider-default').parent().removeClass('default-slider-hide');
				jQuery('.slider-none').parent().addClass('default-slider-hide');
				jQuery('#page-option-top-slider-images').parent().parent().parent().show();
				jQuery('.post_slider_category_main').parent().hide();
			}
			if(schedule_manage == 'No-Option'){
				jQuery('.schedule-category-ev').parent().hide();
				jQuery('.schedule-category-cl').parent().hide();
				jQuery('.schedule-category-sr').parent().hide();
			}else if(schedule_manage == 'Classes'){
				jQuery('.schedule-category-ev').parent().hide();
				jQuery('.schedule-category-cl').parent().show();
				jQuery('.schedule-category-sr').parent().hide();
			}else if(schedule_manage == 'Events'){
				jQuery('.schedule-category-ev').parent().show();
				jQuery('.schedule-category-cl').parent().hide();
				jQuery('.schedule-category-sr').parent().hide();
			}else if(schedule_manage == 'Services'){
				jQuery('.schedule-category-ev').parent().hide();
				jQuery('.schedule-category-cl').parent().hide();
				jQuery('.schedule-category-sr').parent().show();
			}
			jQuery('.slider-default-selection').parent().removeClass('default-slider-hide');
			jQuery('.page-title-here').parent().addClass('default-slider-hide');
			jQuery('.banner-text-here').parent().removeClass('default-slider-hide');
        }
    });
    // PageBuilder Conditional Options Script On Change Ends
	
	// PageBuilder Conditional Options Script On Change Slider Type
    jQuery('#page-option-top-slider-types').change(function () {
        var option_class = jQuery("#page-option-top-slider-types option:selected").attr("rel");
        if (option_class == 'Bx-Slider') {
			jQuery('.slider-layer').parent().addClass('default-slider-hide');
			jQuery('.slider-default').parent().removeClass('default-slider-hide');
			jQuery('.slider-none').parent().addClass('default-slider-hide');
        } else if(option_class == 'Layer-Slider'){
			jQuery('.slider-layer').parent().removeClass('default-slider-hide');
			jQuery('.slider-default').parent().addClass('default-slider-hide');
			jQuery('.slider-none').parent().addClass('default-slider-hide');
		}else if(option_class == 'Add-Shortcode'){
			jQuery('.slider-layer').parent().addClass('default-slider-hide');
			jQuery('.slider-default').parent().addClass('default-slider-hide');
			jQuery('.slider-none').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.slider-layer').parent().addClass('default-slider-hide');
			jQuery('.slider-default').parent().addClass('default-slider-hide');
			jQuery('.slider-none').parent().addClass('default-slider-hide');
        }
    });
    // PageBuilder Conditional Options Script On Change Slider Type Ends
	
	// Inside Condition for hide and show elements
    jQuery("div.combobox #page-option-item-album-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.album-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.album-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.album-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements Album On Load
    jQuery("div.combobox #page-option-item-album-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.album-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.album-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.album-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements
    jQuery("div.combobox #page-option-item-port-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.portfolio-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.portfolio-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.portfolio-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements Album On Load
    jQuery("div.combobox #page-option-item-port-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.portfolio-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.portfolio-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.portfolio-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	
	// Woo-Commerce Products
    jQuery("div.combobox #page-option-item-product-layout").change(function () {	
		var product_fetch_item_pagi = jQuery(this).parent().parent().parent().parent().parent().find('.product-fetch-item-pagination-store');		
		var product_fetch_item = jQuery(this).parent().parent().parent().parent().parent().find('.product-fetch-item-store');
		var product_fetch_item_filter = jQuery(this).parent().parent().parent().parent().parent().find('.cp-product-class-filter');
         if (jQuery(this).val() == 'Modern Grid Diagonal') {
			product_fetch_item_filter.parent().addClass('default-slider-hide');
			product_fetch_item_pagi.parent().removeClass('default-slider-hide');
			product_fetch_item.parent().removeClass('default-slider-hide');
        }else{
			var filter_sel_val = product_fetch_item_filter.find('option:selected').val();
			if(filter_sel_val == 'Yes'){
				product_fetch_item_pagi.parent().addClass('default-slider-hide');
				product_fetch_item.parent().addClass('default-slider-hide');
			}else{
				product_fetch_item_pagi.parent().removeClass('default-slider-hide');
				product_fetch_item.parent().removeClass('default-slider-hide');
			}
			product_fetch_item_filter.parent().removeClass('default-slider-hide');
        }
    });
	
	// Woo-Commerce Products
    jQuery("div.combobox #page-option-item-product-layout").each(function () {
		var product_fetch_item_pagi = jQuery(this).parent().parent().parent().parent().parent().find('.product-fetch-item-pagination-store');		
		var product_fetch_item = jQuery(this).parent().parent().parent().parent().parent().find('.product-fetch-item-store');
		var product_fetch_item_filter = jQuery(this).parent().parent().parent().parent().parent().find('.cp-product-class-filter');
         if (jQuery(this).val() == 'Modern Grid Diagonal') {
			product_fetch_item_filter.parent().addClass('default-slider-hide');
			product_fetch_item_pagi.parent().removeClass('default-slider-hide');
			product_fetch_item.parent().removeClass('default-slider-hide');
        }else{
			var filter_sel_val = product_fetch_item_filter.find('option:selected').val();
			if(filter_sel_val == 'Yes'){
				product_fetch_item_pagi.parent().addClass('default-slider-hide');
				product_fetch_item.parent().addClass('default-slider-hide');
			}else{
				product_fetch_item_pagi.parent().removeClass('default-slider-hide');
				product_fetch_item.parent().removeClass('default-slider-hide');
			}
			product_fetch_item_filter.parent().removeClass('default-slider-hide');
        }
    });
	
	// Woo-Commerce Products
    jQuery("div.combobox #page-option-item-product-filterable").change(function () {	
		var product_fetch_item_pagi = jQuery(this).parent().parent().parent().parent().parent().find('.product-fetch-item-pagination-store');		
		var product_fetch_item = jQuery(this).parent().parent().parent().parent().parent().find('.product-fetch-item-store');
        if (jQuery(this).val() == 'Yes') {
			product_fetch_item_pagi.parent().addClass('default-slider-hide');
			product_fetch_item.parent().addClass('default-slider-hide');
        }else{
			product_fetch_item_pagi.parent().removeClass('default-slider-hide');
			product_fetch_item.parent().removeClass('default-slider-hide');
        }
    });
	
	// Woo-Commerce Products
    jQuery("div.combobox #page-option-item-product-filterable").each(function () {	
		var product_fetch_item_pagi = jQuery(this).parent().parent().parent().parent().parent().find('.product-fetch-item-pagination-store');		
		var product_fetch_item = jQuery(this).parent().parent().parent().parent().parent().find('.product-fetch-item-store');
        if (jQuery(this).val() == 'Yes') {
		
			product_fetch_item_pagi.parent().addClass('default-slider-hide');
			product_fetch_item.parent().addClass('default-slider-hide');
        }else{
			product_fetch_item_pagi.parent().removeClass('default-slider-hide');
			product_fetch_item.parent().removeClass('default-slider-hide');
        }
    });
	
	
	
	
	
	// Inside Condition for hide and show elements
    jQuery("div.combobox #page-option-item-testi-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.testi-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.testi-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.testi-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements Album On Load
    jQuery("div.combobox #page-option-item-testi-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.testi-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.testi-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.testi-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	
	// Inside Condition for hide and show elements
    jQuery("div.combobox #page-option-item-testi-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.testi-client-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.testi-client-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.testi-client-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements Album On Load
    jQuery("div.combobox #page-option-item-testi-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.testi-client-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.testi-client-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.testi-client-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	
	// Inside Condition for hide and show Pagination elements
    jQuery("div.combobox #page-option-item-event-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.event-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.event-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.event-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements Event Pagination On load
    jQuery("div.combobox #page-option-item-event-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.event-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.event-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.event-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show Pagination elements
    jQuery("div.combobox #page-option-item-igni-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.igni-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.igni-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.igni-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements Event Pagination On load
    jQuery("div.combobox #page-option-item-igni-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.igni-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.igni-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.igni-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements
    jQuery("div.combobox #page-option-item-event-view").change(function () {
        if (jQuery(this).val() == 'Listing View') {
			jQuery('.event-type-item').parent().removeClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Calendar View'){
			jQuery('.event-type-item').parent().addClass('default-slider-hide');
		}else{
			jQuery('.event-type-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements Event on Load
    jQuery("div.combobox #page-option-item-event-view").each(function () {
        if (jQuery(this).val() == 'Listing View') {
			jQuery('.event-type-item').parent().removeClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Calendar View'){
			jQuery('.event-type-item').parent().addClass('default-slider-hide');
		}else{
			jQuery('.event-type-item').parent().addClass('default-slider-hide');
        }
    });
	
	
	// Inside Condition for hide and show elements of Blog
    jQuery("div.combobox #page-option-item-blog-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.blog-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.blog-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.blog-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements of Blog On Load
    jQuery("div.combobox #page-option-item-blog-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.blog-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.blog-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.blog-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	
		// Inside Condition for hide and show elements of News
    jQuery("div.combobox #page-option-item-news-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.news-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.news-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.news-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements of News On Load
    jQuery("div.combobox #page-option-item-news-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.news-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.news-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.news-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	
	// Inside Condition for hide and show elements of Product
    jQuery("div.combobox #page-option-item-product-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.product-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.product-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.product-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements of Product On Load
    jQuery("div.combobox #page-option-item-product-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.product-fetch-item').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.product-fetch-item').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.product-fetch-item').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements of Team
    jQuery("div.combobox #page-option-item-team-pagination").change(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.team-fetch-member').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.team-fetch-member').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.team-fetch-member').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements of Team On Load
    jQuery("div.combobox #page-option-item-team-pagination").each(function () {
        if (jQuery(this).val() == 'Wp-Default') {
			jQuery('.team-fetch-member').parent().addClass('default-slider-hide');
        } else if(jQuery(this).val() == 'Theme-Custom'){
			jQuery('.team-fetch-member').parent().removeClass('default-slider-hide');
		}else{
			jQuery('.team-fetch-member').parent().addClass('default-slider-hide');
        }
    });
	
	
	
	// Store Pagination Condtion
    // jQuery("div.combobox #page-option-item-store-pagination").change(function () {
        // if (jQuery(this).val() == 'Wp-Default') {
			// jQuery('.store-fetch-member').parent().addClass('default-slider-hide');
        // } else if(jQuery(this).val() == 'Theme-Custom'){
			// jQuery('.store-fetch-item').parent().removeClass('default-slider-hide');
		// }else{
			// jQuery('.store-fetch-item').parent().removeClass('default-slider-hide');
        // }
    // });
	
	// Store Pagination Condtion
    // jQuery("div.combobox #page-option-item-store-pagination").each(function () {
        // if (jQuery(this).val() == 'Wp-Default') {
			// jQuery('.store-fetch-item').parent().addClass('default-slider-hide');
        // } else if(jQuery(this).val() == 'Theme-Custom'){
			// jQuery('.store-fetch-item').parent().removeClass('default-slider-hide');
		// }else{
			// jQuery('.store-fetch-item').parent().removeClass('default-slider-hide');
        // }
    // });
	
	// Product Layout
    // jQuery("div.combobox #page-option-item-product-layout").change(function () {
        // if (jQuery(this).val() == 'Wp-Default') {
			// jQuery('.store-fetch-member').parent().addClass('default-slider-hide');
        // } else if(jQuery(this).val() == 'Theme-Custom'){
			// jQuery('.store-fetch-item').parent().removeClass('default-slider-hide');
		// }else{
			// jQuery('.store-fetch-item').parent().removeClass('default-slider-hide');
        // }
    // });
	
	// Product Layout
    // jQuery("div.combobox #page-option-item-store-pagination").each(function () {
        // if (jQuery(this).val() == 'Wp-Default') {
			// jQuery('.store-fetch-item').parent().addClass('default-slider-hide');
        // } else if(jQuery(this).val() == 'Theme-Custom'){
			// jQuery('.store-fetch-item').parent().removeClass('default-slider-hide');
		// }else{
			// jQuery('.store-fetch-item').parent().removeClass('default-slider-hide');
        // }
    // });
	
	
	
	// Inside Condition for hide and show elements of News
    jQuery("div.combobox #page-option-item-product-filterable").change(function () {
        if (jQuery(this).val() == 'Yes') {
			jQuery('.product-fetch-item').parent().addClass('default-slider-hide');
			jQuery('.product-fetch-item-pagination').parent().addClass('default-slider-hide');
        }else{
			jQuery('.product-fetch-item').parent().removeClass('default-slider-hide');
			jQuery('.product-fetch-item-pagination').parent().removeClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements of News On Load
    jQuery("div.combobox #page-option-item-product-filterable").each(function () {
        if (jQuery(this).val() == 'Yes') {
			jQuery('.product-fetch-item').parent().addClass('default-slider-hide');
			jQuery('.product-fetch-item-pagination').parent().addClass('default-slider-hide');
        }else{
			jQuery('.product-fetch-item').parent().removeClass('default-slider-hide');
			jQuery('.product-fetch-item-pagination').parent().removeClass('default-slider-hide');
        }
    });
	
	
		// Inside Condition for hide and show elements of News
    jQuery("div.combobox #page-option-item-slider-type").change(function () {
        if (jQuery(this).val() == 'Bx-Slider') {
			jQuery('.layer-slider-style-class').parent().addClass('default-slider-hide');
			jQuery('.default-slider-style-class').parent().removeClass('default-slider-hide');
        }else if(jQuery(this).val() == 'Layer-Slider'){
			jQuery('.layer-slider-style-class').parent().removeClass('default-slider-hide');
			jQuery('.default-slider-style-class').parent().addClass('default-slider-hide');
        }
    });
	
	// Inside Condition for hide and show elements of News On Load
    jQuery("div.combobox #page-option-item-slider-type").each(function () {
        if (jQuery(this).val() == 'Bx-Slider') {
			jQuery('.layer-slider-style-class').parent().addClass('default-slider-hide');
			jQuery('.default-slider-style-class').parent().removeClass('default-slider-hide');
        }else if(jQuery(this).val() == 'Layer-Slider'){
			jQuery('.layer-slider-style-class').parent().removeClass('default-slider-hide');
			jQuery('.default-slider-style-class').parent().addClass('default-slider-hide');
        }
    });
	
	
	
    // Upload Image
    jQuery("input#upload_image_text_meta").change(function () {
        jQuery(this).siblings("input[type='hidden']").val(jQuery(this).val());
    });
    jQuery('input:button.upload_image_button_meta').click(function () {
        example_image = jQuery(this).siblings("#meta-input-example-image");
        upload_text = jQuery(this).siblings("#upload_image_text_meta");
        attachment_id = jQuery(this).siblings("#upload_image_attachment_id");
        tb_show('Upload Media', 'media-upload.php?post_id=&type=image&amp;TB_iframe=true');

        var oldSendToEditor = window.send_to_editor;
        window.send_to_editor = function (html) {
            image_url = jQuery(html).attr('href');
            thumb_url = jQuery('img', html).attr('src');
            attid = jQuery(html).attr('attid');

            upload_text.val(image_url);
            attachment_id.val(attid);
            example_image.html('<img class="img_size_50x50" src=' + thumb_url + ' />');
            tb_remove();

            window.send_to_editor = oldSendToEditor;
        }
        return false;
    });

    // Testimonial Option
    jQuery("div.combobox #page-option-item-testimonial-display-type").change(function () {
        var cp_category = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-category");
        var cp_specific = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-specific");
        if (jQuery(this).val() == 'Testimonial Category') {
            cp_specific.parents(".meta-body").slideUp();
            cp_category.parents(".meta-body").slideDown();
        } else {
            cp_category.parents(".meta-body").slideUp();
            cp_specific.parents(".meta-body").slideDown();
        }
    });
    jQuery("div.combobox #page-option-item-testimonial-display-type").each(function () {
        var cp_category = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-category");
        var cp_specific = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-testimonial-specific");
        if (jQuery(this).val() == 'Testimonial Category') {
            cp_specific.parents(".meta-body").css('display', 'none');
            cp_category.parents(".meta-body").css('display', 'block');
        } else {
            cp_category.parents(".meta-body").css('display', 'none');
            cp_specific.parents(".meta-body").css('display', 'block');
        }
    });
	
	
	// Attraction Option
    jQuery("div.combobox #page-option-item-attraction-view").change(function () {
        var cp_location = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-attraction-location");
        var cp_category = jQuery(this).parents(".meta-body").parent().find("#hide_show_element");
		var cp_pagination = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-attraction-pagination");
        if (jQuery(this).val() == 'Listing View') {
            cp_location.parents(".meta-body").slideUp();
            cp_category.slideDown();			
        } else {
            cp_category.slideUp();
			cp_location.parents(".meta-body").slideDown();
        }
    });
    jQuery("div.combobox #page-option-item-attraction-view").each(function () {
        var cp_location = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-attraction-location");
        var cp_complete = jQuery(this).parents(".meta-body").parent().find("#hide_show_element");
		var cp_pagination = jQuery(this).parents(".meta-body").siblings(".meta-body").find("#page-option-item-attraction-pagination");
        if (jQuery(this).val() == 'Listing View') {
            cp_location.parents(".meta-body").css('display', 'none');
            cp_complete.css('display', 'block');
        } else {
			cp_complete.css('display', 'none');
            cp_location.parents(".meta-body").css('display', 'block');
        }
    });
	
	// Event Option
    jQuery("div.combobox #page-option-item-event-view").change(function () {
        var cp_event_listing = jQuery(this).parents(".meta-body").parent().find("#event_type_open");
        if (jQuery(this).val() == 'Listing View') {
            cp_event_listing.slideDown();			
        } else {
            cp_event_listing.slideUp();			
        }
    });
    jQuery("div.combobox #page-option-item-event-view").each(function () {
        var cp_event_listing = jQuery(this).parents(".meta-body").parent().find("#event_type_open");
        if (jQuery(this).val() == 'Listing View') {
            cp_event_listing.css('display', 'block');
        } else {
			cp_event_listing.css('display', 'none');
        }
    });
	
	// Filterable Condition for PRoduct Option
    jQuery("div.combobox #page-option-item-product-filterable").change(function () {
        var cp_product_listing = jQuery(this).parents(".meta-body").parent().parent().find("#product-type-hide");
        if (jQuery(this).val() == 'No') {
            cp_product_listing.slideDown();			
        } else {
            cp_product_listing.slideUp();			
        }
    });
    jQuery("div.combobox #page-option-item-product-filterable").each(function () {
        var cp_product_listing = jQuery(this).parents(".meta-body").parent().parent().find("#product-type-hide");
        if (jQuery(this).val() == 'No') {
            cp_product_listing.css('display', 'block');
        } else {
			cp_product_listing.css('display', 'none');
        }
    });
	
	
	jQuery("div.combobox #page-option-item-product-layout").change(function () {
        var cp_product_listing_filter = jQuery(this).parents(".meta-body").parent().find("#product-type-filterable");
		var cp_product_pagi = jQuery(this).parents(".meta-body").parent().find("#product-type-hide");
        if (jQuery(this).val() == 'Grid') {
            cp_product_listing_filter.slideDown();
			cp_product_pagi.slideDown();
        } else {
            cp_product_listing_filter.slideUp();
			cp_product_pagi.slideDown();
        }
    });
    jQuery("div.combobox #page-option-item-product-layout").each(function () {
        var cp_product_listing_filter = jQuery(this).parents(".meta-body").parent().find("#product-type-filterable");
		var cp_product_pagi = jQuery(this).parents(".meta-body").parent().find("#product-type-hide");
        if (jQuery(this).val() == 'Grid') {
            cp_product_listing_filter.css('display', 'block');
			cp_product_pagi.css('display', 'block');
        } else {
			cp_product_listing_filter.css('display', 'none');
			cp_product_pagi.css('display', 'block');
        }
    });
	
   
	// Slider Toogle Script Start
    var selected_class = jQuery("#page_template option:selected").val();
    if (selected_class == 'page-fullwidth.php') {
         jQuery("#page-option").slideUp();
    }else{
			jQuery("#page-option").slideDown();
	}
	
	
    // Page Template Choose
    jQuery("#page_template").change(function () {
        if (jQuery(this).val() == 'page-fullwidth.php') {
            jQuery("#page-option").slideUp();
        } else{
		    jQuery("#page-option").slideDown();
		}
    });

});