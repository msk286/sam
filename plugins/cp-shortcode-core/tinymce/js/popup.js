// start the popup specefic scripts
// safe to use $
jQuery(document).ready(function($) {
    window.cp_tb_height = (92 / 100) * jQuery(window).height();
    window.cp_shortcodes_height = (71 / 100) * jQuery(window).height();
    if(window.cp_shortcodes_height > 550) {
        window.cp_shortcodes_height = (74 / 100) * jQuery(window).height();
    }
	

    jQuery(window).resize(function() {
        window.cp_tb_height = (92 / 100) * jQuery(window).height();
        window.cp_shortcodes_height = (71 / 100) * jQuery(window).height();

        if(window.cp_shortcodes_height > 550) {
            window.cp_shortcodes_height = (74 / 100) * jQuery(window).height();
        }
    });

    crunchpress_shortcodes = {
    	loadVals: function()
    	{
    		var shortcode = $('#_crunchp_shortcode').text(),
    			uShortcode = shortcode;
    		
    		// fill in the gaps eg {{param}}
    		$('.crunchp-input').each(function() {
    			var input = $(this),
    				id = input.attr('id'),
    				id = id.replace('crunchp_', ''),		// gets rid of the fusion_ prefix
    				re = new RegExp("{{"+id+"}}","g");
                    var value = input.val();
                    if(value == null) {
                      value = '';
                    }
    			uShortcode = uShortcode.replace(re, value);
    		});

    		// adds the filled-in shortcode as hidden input
    		$('#_crunchp_ushortcode').remove();
    		$('#cp-sc-form-table').prepend('<div id="_crunchp_ushortcode" class="hidden">' + uShortcode + '</div>');
    	},
    	cLoadVals: function()
    	{
    		var shortcode = $('#_crunchp_cshortcode').text(),
    			pShortcode = '';

    			if(shortcode.indexOf("<li>") < 0) {
    				shortcodes = '<br />';
    			} else {
    				shortcodes = '';
    			}

    		// fill in the gaps eg {{param}}
    		$('.child-clone-row').each(function() {
    			var row = $(this),
    				rShortcode = shortcode;
    			
                if($(this).find('#crunchp_slider_type').length >= 1) {
                    if($(this).find('#crunchp_slider_type').val() == 'image') {
                        rShortcode = '[slide type="{{slider_type}}" image_url="{{image_url}}" link="{{link}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]';
                    } else if($(this).find('#crunchp_slider_type').val() == 'video') {
                        rShortcode = '[slide type="{{slider_type}}"]{{video_content}}[/slide]';
                    }
                }
    			$('.crunchp-cinput', this).each(function() {
    				var input = $(this),
    					id = input.attr('id'),
    					id = id.replace('crunchp_', '')		// gets rid of the crunchp_ prefix
    					re = new RegExp("{{"+id+"}}","g");
                        var value = input.val();
                        if(value == null) {
                          value = '';
                        }
    				rShortcode = rShortcode.replace(re, input.val());
    			});

    			if(shortcode.indexOf("<li>") < 0) {
    				shortcodes = shortcodes + rShortcode + '<br />';
    			} else {
    				shortcodes = shortcodes + rShortcode;
    			}
    		});
    		
    		// adds the filled-in shortcode as hidden input
    		$('#_crunchp_cshortcodes').remove();
    		$('.child-clone-rows').prepend('<div id="_crunchp_cshortcodes" class="hidden">' + shortcodes + '</div>');
    		
    		// add to parent shortcode
    		this.loadVals();
    		pShortcode = $('#_crunchp_ushortcode').html().replace('{{child_shortcode}}', shortcodes);
            
    		// add updated parent shortcode
    		$('#_crunchp_ushortcode').remove();
    		$('#cp-sc-form-table').prepend('<div id="_crunchp_ushortcode" class="hidden">' + pShortcode + '</div>');
    	},
    	children: function()
    	{
    		// assign the cloning plugin
    		$('.child-clone-rows').appendo({
    			subSelect: '> div.child-clone-row:last-child',
    			allowDelete: false,
    			focusFirst: false,
                onAdd: function(row) {
                    // Get Upload ID
                    var prev_upload_id = jQuery(row).prev().find('.crunchp-upload-button').data('upid');
                    var new_upload_id = prev_upload_id + 1;
                    jQuery(row).find('.crunchp-upload-button').attr('data-upid', new_upload_id);

                    // activate chosen
                    jQuery('.crunchp-form-multiple-select').chosen({
                        width: '100%',
                        placeholder_text_multiple: 'Select Options or Leave Blank for All'
                    });

                    // activate color picker
                    jQuery('.wp-color-picker-field').wpColorPicker({
                        change: function(event, ui) {
                            crunchpress_shortcodes.loadVals();
                            crunchpress_shortcodes.cLoadVals();
                        }
                    });

                    // changing slide type
                    var type = $(row).find('#crunchp_slider_type').val();
                    if(type == 'video') {
                        $(row).find('#crunchp_image_content, #crunchp_image_url, #crunchp_image_target, #crunchp_image_lightbox').closest('li').hide();
                        $(row).find('#crunchp_video_content').closest('li').show();

                        $(row).find('#_crunchp_cshortcode').text('[slide type="{{slider_type}}"]{{video_content}}[/slide]');
                    }

                    if(type == 'image') {
                        $(row).find('#crunchp_image_content, #crunchp_image_url, #crunchp_image_target, #crunchp_image_lightbox').closest('li').show();
                        $(row).find('#crunchp_video_content').closest('li').hide();
                        $(row).find('#_crunchp_cshortcode').text('[slide type="{{slider_type}}" image_url="{{image_url}}" link="{{link}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]');   
                    }

                    crunchpress_shortcodes.loadVals();
                    crunchpress_shortcodes.cLoadVals();
                }
    		});
    		
    		// remove button
    		$('.child-clone-row-remove').live('click', function() {
    			var	btn = $(this),
    				row = btn.parent();
    			
    			if( $('.child-clone-row').size() > 1 )
    			{
    				row.remove();
    			}
    			else
    			{
    				alert('You need a minimum of one row');
    			}
    			
    			return false;
    		});
    		
    		// assign jUI sortable
    		$( ".child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row',
                cancel: 'div.iconpicker, input, select, textarea, a'
			});
    	},
    	resizeTB: function()
    	{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				fusionPopup = $('#crunchp-popup');

            tbWindow.css({
                height: window.cp_tb_height,
                width: fusionPopup.outerWidth(),
                marginLeft: -(fusionPopup.outerWidth()/2)
            });

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: window.cp_tb_height,
				overflow: 'auto', // IMPORTANT
				width: fusionPopup.outerWidth()
			});

            tbWindow.show();

			$('#crunchp-popup').addClass('no_preview');
            $('#crunchp-sc-form-wrap #cp-sc-form').height(window.cp_shortcodes_height);
			
			
			
    	},
    	load: function()
    	{
    		var	crunchp = this,
    			popup = $('#crunchp-popup'),
    			form = $('#cp-sc-form', popup),
    			shortcode = $('#_crunchp_shortcode', form).text(),
    			popupType = $('#_crunchp_popup', form).text(),
    			uShortcode = '';
    		
            // if its the shortcode selection popup
            if($('#_crunchp_popup').text() == 'shortcode-generator') {
                $('.crunchp-sc-form-button').hide();
				$('#cp-sc-form').hide();
				$('#go-back').hide();
            }else{
				$('#cp-sc-form-table').hide();
				$('#cp-sc-form').show();
				$('#go-back').show();
			}

    		// resize TB
    		crunchpress_shortcodes.resizeTB();
    		$(window).resize(function() { crunchpress_shortcodes.resizeTB() });
    		
    		// initialise
            crunchpress_shortcodes.loadVals();
    		crunchpress_shortcodes.children();
    		crunchpress_shortcodes.cLoadVals();
    		
    		// update on children value change
    		$('.crunchp-cinput', form).live('change', function() {
    			crunchpress_shortcodes.cLoadVals();
    		});
    		
    		// update on value change
    		$('.crunchp-input', form).live('change', function() {
    			crunchpress_shortcodes.loadVals();
    		});

            // change shortcode when a user selects a shortcode from choose a dropdown field
            $('#crunchp_select_shortcode').change(function() {
                var name = $(this).val();
                var label = $(this).text();
                
                if(name != 'select') {
                    tinyMCE.activeEditor.execCommand("CPPopup", false, {
                        title: label,
                        identifier: name
                    });

                    $('#TB_window').hide();
                }
            });
			
			$('.cp_shortcode_icon').click(function() {
                var name = $(this).attr('rel');
                var label = $(this).val();
                
                if(name != 'select') {
                    tinyMCE.activeEditor.execCommand("CPPopup", false, {
                        title: label,
                        identifier: name
                    });

                    $('#TB_window').hide();
                }
            });			

            // activate chosen
            $('.crunchp-form-multiple-select').chosen({
                width: '100%',
                placeholder_text_multiple: 'Select Options'
            });

            // update upload button ID
            jQuery('.crunchp-upload-button:not(:first)').each(function() {
                var prev_upload_id = jQuery(this).data('upid');
                var new_upload_id = prev_upload_id + 1;
                jQuery(this).attr('data-upid', new_upload_id);
            });
    	}
	}
    
    // run
    $('#crunchp-popup').livequery(function() {
        crunchpress_shortcodes.load();

        $('#crunchp-popup').closest('#TB_window').addClass('cp-shortcodes-popup');

        $('#crunchp_video_content').closest('li').hide();

            // activate color picker
            $('.wp-color-picker-field').wpColorPicker({
                change: function(event, ui) {
                    setTimeout(function() {
                        crunchpress_shortcodes.loadVals();
                        crunchpress_shortcodes.cLoadVals();
                    },
                    1);
                }
            });
    });

    // when insert is clicked
    $('.crunchp-insert').live('click', function() {                        
        if(window.tinyMCE)
        {
            window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, $('#_crunchp_ushortcode').html());
            tb_remove();
        }
    });
	
	

    //tinymce.init(tinyMCEPreInit.mceInit['fusion_content']);
    //tinymce.execCommand('mceAddControl', true, 'fusion_content');
    //quicktags({id: 'fusion_content'});

    // activate upload button
    $('.crunchp-upload-button').live('click', function(e) {
	    e.preventDefault();

        upid = $(this).attr('data-upid');

        if($(this).hasClass('remove-image')) {
            $('.crunchp-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', '').hide();
            $('.crunchp-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', '');
            $('.crunchp-upload-button[data-upid="' + upid + '"]').text('Upload').removeClass('remove-image');

            return;
        }

        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select Image',
            button: {
                text: 'Select Image',
            },
	        frame: 'post',
            multiple: false  // Set to true to allow multiple files to be selected
        });

	    file_frame.open();

        file_frame.on( 'select', function() {
            var selection = file_frame.state().get('selection');
                selection.map( function( attachment ) {
                attachment = attachment.toJSON();

                $('.crunchp-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
                $('.crunchp-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

                crunchpress_shortcodes.loadVals();
                crunchpress_shortcodes.cLoadVals();
            });

            $('.crunchp-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
            $('.media-modal-close').trigger('click');
        });

	    file_frame.on( 'insert', function() {
		    var selection = file_frame.state().get('selection');
		    var size = jQuery('.attachment-display-settings .size').val();

		    selection.map( function( attachment ) {
			    attachment = attachment.toJSON();

			    if(!size) {
				    attachment.url = attachment.url;
			    } else {
				    attachment.url = attachment.sizes[size].url;
			    }

			    $('.crunchp-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
			    $('.crunchp-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

			    crunchpress_shortcodes.loadVals();
			    crunchpress_shortcodes.cLoadVals();
		    });

		    $('.crunchp-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
		    $('.media-modal-close').trigger('click');
	    });
    });

    // activate iconpicker
    $('.iconpicker i').live('click', function(e) {
        e.preventDefault();

        var iconWithPrefix = $(this).attr('class');
        var fontName = $(this).attr('data-name').replace('icon-', '');

        if($(this).hasClass('active')) {
            $(this).parent().find('.active').removeClass('active');

            $(this).parent().parent().find('input').attr('value', '');
        } else {
            $(this).parent().find('.active').removeClass('active');
            $(this).addClass('active');

            $(this).parent().parent().find('input').attr('value', fontName);
        }

        crunchpress_shortcodes.loadVals();
        crunchpress_shortcodes.cLoadVals();
    });

    // table shortcode
    $('#cp-sc-form-table .crunchp-insert').live('click', function(e) {
        e.stopPropagation();

        var shortcodeType = $('#_crunchp_popup').text();

        if(shortcodeType == 'table') {
            var type = $('#cp-sc-form-table #crunchp_type').val();
            var columns = $('#cp-sc-form-table #crunchp_columns').val();

            var text = '<div class="table-' + type + '"><table width="100%"><thead><tr>';

            for(var i=0;i<columns;i++) {
                text += '<th>Column ' + (i + 1) + '</th>';
            }

            text += '</tr></thead><tbody>';

            for(var i=0;i<columns;i++) {
                text += '<tr>';
                if(columns >= 1) {
                    text += '<td>Item #' + (i + 1) + '</td>';
                }
                if(columns >= 2) {
                    text += '<td>Description</td>';
                }
                if(columns >= 3) {
                    text += '<td>Discount:</td>';
                }
                if(columns >= 4) {
                    text += '<td>$' + (i + 1) + '.00</td>';
                }
                text += '</tr>';
            }

            text += '<tr>';
            
            if(columns >= 1) {
                text += '<td><strong>All Items</strong></td>';
            }
            if(columns >= 2) {
                text += '<td><strong>Description</strong></td>';
            }
            if(columns >= 3) {
                text += '<td><strong>Your Total:</strong></td>';
            }
            if(columns >= 4) {
                text += '<td><strong>$10.00</strong></td>';
            }
            text += '</tr>';
            text += '</tbody></table></div>';

            if(window.tinyMCE)
            {
                window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, text);
                tb_remove();
            }
        }
    });
	
    // slider shortcode
    $('#crunchp_slider_type').live('change', function(e) {
        e.preventDefault();

        var type = $(this).val();
        if(type == 'video') {
            $(this).parents('ul').find('#crunchp_image_content, #crunchp_image_url, #crunchp_image_target, #crunchp_image_lightbox').closest('li').hide();
            $(this).parents('ul').find('#crunchp_video_content').closest('li').show();

            $('#_crunchp_cshortcode').text('[slide type="{{slider_type}}"]{{video_content}}[/slide]');
        }

        if(type == 'image') {
            $(this).parents('ul').find('#crunchp_image_content, #crunchp_image_url, #crunchp_image_target, #crunchp_image_lightbox').closest('li').show();
            $(this).parents('ul').find('#crunchp_video_content').closest('li').hide();

            $('#_crunchp_cshortcode').text('[slide type="{{slider_type}}" image_url="{{image_url}}" link="{{link}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]');   
        }
    });

    $('.crunchp-add-video-shortcode').live('click', function(e) {
        e.preventDefault();

        var shortcode = $(this).attr('href');
        var content = $(this).parents('ul').find('#crunchp_video_content');
        
        content.val(content.val() + shortcode);
    });

    $('#crunchp-popup textarea').live('focus', function() {
        var text = $(this).val();

        if(text == 'Your Content Goes Here') {
            $(this).val('');
        }
    });

    $('.crunchp-gallery-button').live('click', function(e) {
	    var gallery_file_frame;

        e.preventDefault();

	    alert('To add images to this post or page for attachments layout, navigate to "Upload Files" tab in media manager and upload new images.');

        gallery_file_frame = wp.media.frames.gallery_file_frame = wp.media({
            title: 'Attach Images to Post/Page',
            button: {
                text: 'Go Back to Shortcode',
            },
            frame: 'post',
            multiple: true  // Set to true to allow multiple files to be selected
        });

	    gallery_file_frame.open();

        $('.media-menu-item:contains("Upload Files")').trigger('click');

        gallery_file_frame.on( 'select', function() {
            $('.media-modal-close').trigger('click');

            crunchpress_shortcodes.loadVals();
            crunchpress_shortcodes.cLoadVals();
        });
    });
});