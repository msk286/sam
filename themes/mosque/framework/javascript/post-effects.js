/**
 *	CrunchPress Back End Post Effects File
 *	---------------------------------------------------------------------
 * 	@version	1.0
 * 	@author		CrunchPress
 * 	@link		http://crunchpress.com
 * 	@copyright	Copyright (c) CrunchPress
 * 	---------------------------------------------------------------------
 * 	This file contains the jQuery script that animate the post back end 
 *  elements.
 *	---------------------------------------------------------------------
 */
jQuery(document).ready(function () {
    //Post Thumbnails
    jQuery('select#post-option-thumbnail-types').change(function () {
        var selected_option = jQuery(this).children("option:selected").val();
        if (selected_option == 'Image') {
            jQuery(this).parents("div#post-option-meta").children('div#thumbnail-video, div#thumbnail-slider').slideUp();
            jQuery(this).parents("div#post-option-meta").children('div#thumbnail-feature-image').slideDown();
        } else if (selected_option == 'Video') {
            jQuery(this).parents("div#post-option-meta").children('div#thumbnail-feature-image, div#thumbnail-slider').slideUp();;
            jQuery(this).parents("div#post-option-meta").children('div#thumbnail-video').slideDown();
        } else if (selected_option == 'Slider') {
            jQuery(this).parents("div#post-option-meta").children('div#thumbnail-feature-image, div#thumbnail-video').slideUp();;
            jQuery(this).parents("div#post-option-meta").children('div#thumbnail-slider').slideDown();
        }
    });
    jQuery("select#post-option-thumbnail-types").triggerHandler("change");

    jQuery('select#post-option-inside-thumbnail-types').change(function () {
        var selected_option = jQuery(this).children("option:selected").val();
        if (selected_option == 'Image') {
            jQuery(this).parents("div#post-option-meta").children('div#inside-thumbnail-video, div#inside-thumbnail-slider', 'div#inside-thumbnail-audio').slideUp();
            jQuery(this).parents("div#post-option-meta").children('div#inside-thumbnail-image').slideDown();
        } else if (selected_option == 'Video') {
            jQuery(this).parents("div#post-option-meta").children('div#inside-thumbnail-image, div#inside-thumbnail-slider', 'div#inside-thumbnail-audio').slideUp();
            jQuery(this).parents("div#post-option-meta").children('div#inside-thumbnail-video').slideDown();
        } else if (selected_option == 'Slider') {
            jQuery(this).parents("div#post-option-meta").children('div#inside-thumbnail-audio, div#inside-thumbnail-video').slideUp();
            jQuery(this).parents("div#post-option-meta").children('div#inside-thumbnail-slider').slideDown();
        } else if (selected_option == 'Audio') {
            jQuery(this).parents("div#post-option-meta").children('div#inside-thumbnail-image, div#inside-thumbnail-slider ,div#inside-thumbnail-video').slideUp();
            jQuery(this).parents("div#post-option-meta").children('div#inside-thumbnail-audio').slideDown();
        }

    });
    jQuery("select#post-option-inside-thumbnail-types").triggerHandler("change");

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

     // Template Check List
    jQuery('.radio-image-wrapper input').change(function () {
        jQuery(this).parent().parent().find(".check-list").removeClass("check-list");
        jQuery(this).siblings("label").children("#check-list").addClass("check-list");
        if (jQuery(this).val() == "left-sidebar") {
            jQuery("#post-option-choose-left-sidebar").parents(".meta-body").slideDown();
            jQuery("#post-option-choose-right-sidebar").parents(".meta-body").slideUp();
        } else if (jQuery(this).val() == "right-sidebar") {
            jQuery("#post-option-choose-left-sidebar").parents(".meta-body").slideUp();
            jQuery("#post-option-choose-right-sidebar").parents(".meta-body").slideDown();
        } else if (jQuery(this).val() == "both-sidebar") {
            jQuery("#post-option-choose-left-sidebar").parents(".meta-body").slideDown();
            jQuery("#post-option-choose-right-sidebar").parents(".meta-body").slideDown();
        } else {
            jQuery("#post-option-choose-left-sidebar").parents(".meta-body").slideUp();
            jQuery("#post-option-choose-right-sidebar").parents(".meta-body").slideUp();
        }
    });
    jQuery('.radio-image-wrapper input:checked').triggerHandler("change");

    // Link type of slider
    jQuery("select#post-option-inside-thumbnail-slider-linktype, select#post-option-thumbnail-slider-linktype").change(function () {
        var selected_val = jQuery(this).val();
		var video = jQuery(this).parent().parent().parent().find('.video');
		var url = jQuery(this).parent().parent().parent().find('.url');
        if (selected_val == 'No Link' || selected_val == 'Lightbox') {
			video.slideUp();
			url.slideUp();
        } else {
            if (selected_val == 'Link to URL') {
				video.slideUp();
				url.slideDown();
            } else if(selected_val == 'Video') {
				video.slideDown();
				url.slideUp();
            }else{
				video.slideUp();
				url.slideUp();
			}
        }
    });
    jQuery('select#post-option-inside-thumbnail-slider-linktype, select#post-option-thumbnail-slider-linktype').each(function () {
        var selected_val = jQuery(this).val();
		var video = jQuery(this).parent().parent().parent().find('.video');
		var url = jQuery(this).parent().parent().parent().find('.url');
        if (selected_val == 'No Link' || selected_val == 'Lightbox') {
			video.css('display', 'none');
			url.css('display', 'none');
        } else {
            if (selected_val == 'Link to URL') {
				video.css('display', 'none');
				url.css('display', 'block');
            } else if(selected_val == 'Video') {
				video.css('display', 'block');
				url.css('display', 'none');
            }else {
                video.css('display', 'none');
				url.css('display', 'none');
            }
        }
    });

    // Link type of slider New
    jQuery("select#slider-option-inside-thumbnail-slider-linktype, select#slider-option-thumbnail-slider-linktype").change(function () {
        var selected_val = jQuery(this).val();
		var url = jQuery(this).parent().parent().parent().find('.url');
        if (selected_val == 'No Link' || selected_val == 'Lightbox') {
           url.slideUp();
        } else {
            if (selected_val == 'Link to URL') {
               url.slideDown();
            } else {
                url.slideUp();
            }
        }
    });
    jQuery('select#slider-option-inside-thumbnail-slider-linktype, select#slider-option-thumbnail-slider-linktype').each(function () {
        var selected_val = jQuery(this).val();
		var url = jQuery(this).parent().parent().parent().find('.url');
        if (selected_val == 'No Link' || selected_val == 'Lightbox') {
            url.css('display', 'none');
        } else {
            if (selected_val == 'Link to URL') {
               url.css('display', 'block');
            } else {
                url.css('display', 'none');
            }
        }
    });

    //Thumbnail Image Type
    jQuery('#post-option-featured-image-type').change(function () {
        var choose_url = jQuery(this).parents("#thumbnail-feature-image").find("#post-option-featured-image-url");
        if (jQuery(this).val() == "Link to Current Post" || jQuery(this).val() == "Lightbox to Current Thumbnail") {
            choose_url.parents(".meta-body").slideUp();
        } else {
            choose_url.parents(".meta-body").slideDown();
        }
    });
    jQuery('#post-option-featured-image-type').each(function () {
        var choose_url = jQuery(this).parents("#thumbnail-feature-image").find("#post-option-featured-image-url");
        if (jQuery(this).val() == "Link to Current Post" || jQuery(this).val() == "Lightbox to Current Thumbnail") {
            choose_url.parents(".meta-body").css('display', 'none');
        } else {
            choose_url.parents(".meta-body").css('display', 'block');
        }
    });
});