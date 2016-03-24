jQuery(document).ready(function ($) {
   
// Load Example Font
    jQuery(".cp_import_dummy").click(function () {
		var cp_import = jQuery(this);
		jQuery.confirm({
            'message': 'All the data added already will be lost!  <br /> <br />Are you sure you want to Import?',
            'buttons': {
                'Yes': {
                    'class': 'confirm-yes',
                    'action': function () {
						//var cp_sel_layout = cp_import.parent('.cp_dummy').siblings().children('#select_dummy_layout').find("option:selected").attr('value');
						var cp_sel_layout = cp_import.parent().parent().parent().parent().parent().find('#select_dummy_layout').find("option:selected").attr('value');	
						var cp_sel_layout = 'dummy_xml_5';
						var nonce = cp_import.parent().parent().parent().parent().parent().find('#cp_nonce_dummy').attr('value');
						jQuery('.loading').show();
						jQuery.post(ajaxurl, {
							action: 'cp_dummy_import',
							layout: cp_sel_layout,
							cp_nonce_dummy: nonce,							
						}, function (data) {
							
							console.log(data);
							
							if (data) {
								if(data = 'dummy_import'){
									var d_upload = '';
									jQuery.confirm({
										'message': 'Thank you for Waiting Dummy Content Successfully Added!',
										'buttons': {
											'Okay': {
												'class': 'confirm-no',
												'action': function () {
													return false;
												}
											}
										}
									});
								}else{
									jQuery.confirm({
										'message': 'There is some error in Loading Dummy Data!',
										'buttons': {
											'OK': {
												'class': 'confirm-no',
												'action': function () {
													return false;
												}
											}
										}
									});
								}
								jQuery('.loading').hide();
							}
						});
                    }
                },
                'No': {
                    'class': 'confirm-no',
                    'action': function () {
                        return false;
                    }
                }
            }
        });
        
    });
	
	var selected_class = jQuery("#select_dummy_layout option:selected").attr("class");
	if (selected_class == 'layout_1') {
		jQuery('#layout_img_1').slideDown();
		jQuery('#layout_img_2').slideUp();
		jQuery('#layout_img_3').slideUp();
		jQuery('#layout_img_4').slideUp();
		jQuery('#layout_img_5').slideUp();
		jQuery('#layout_img_6').slideUp();
		jQuery('#layout_img_7').slideUp();
	}else if (selected_class == 'layout_2') {
		jQuery('#layout_img_2').slideDown();
		jQuery('#layout_img_1').slideUp();
		jQuery('#layout_img_3').slideUp();
		jQuery('#layout_img_4').slideUp();
		jQuery('#layout_img_5').slideUp();
		jQuery('#layout_img_6').slideUp();
		jQuery('#layout_img_7').slideUp();
	}else if (selected_class == 'layout_3') {
		jQuery('#layout_img_3').slideDown();
		jQuery('#layout_img_1').slideUp();
		jQuery('#layout_img_2').slideUp();
		jQuery('#layout_img_4').slideUp();
		jQuery('#layout_img_5').slideUp();
		jQuery('#layout_img_6').slideUp();
		jQuery('#layout_img_7').slideUp();
	}else if (selected_class == 'layout_4') {
		jQuery('#layout_img_4').slideDown();
		jQuery('#layout_img_1').slideUp();
		jQuery('#layout_img_2').slideUp();
		jQuery('#layout_img_3').slideUp();
		jQuery('#layout_img_5').slideUp();
		jQuery('#layout_img_6').slideUp();
		jQuery('#layout_img_7').slideUp();
	}else if (selected_class == 'layout_5') {
		jQuery('#layout_img_5').slideDown();
		jQuery('#layout_img_1').slideUp();
		jQuery('#layout_img_2').slideUp();
		jQuery('#layout_img_3').slideUp();
		jQuery('#layout_img_4').slideUp();
		jQuery('#layout_img_6').slideUp();
		jQuery('#layout_img_7').slideUp();
	}else if (selected_class == 'layout_6') {
		jQuery('#layout_img_6').slideDown();
		jQuery('#layout_img_1').slideUp();
		jQuery('#layout_img_2').slideUp();
		jQuery('#layout_img_3').slideUp();
		jQuery('#layout_img_4').slideUp();
		jQuery('#layout_img_5').slideUp();
		jQuery('#layout_img_7').slideUp();
	}else if (selected_class == 'layout_7') {
		jQuery('#layout_img_7').slideDown();
		jQuery('#layout_img_1').slideUp();
		jQuery('#layout_img_2').slideUp();
		jQuery('#layout_img_3').slideUp();
		jQuery('#layout_img_4').slideUp();
		jQuery('#layout_img_5').slideUp();
		jQuery('#layout_img_6').slideUp();
	}else{
	
	}
	
	
	 //Slider theme options drop down
    jQuery('#select_dummy_layout').change(function () {
        var option_class = jQuery("#select_dummy_layout option:selected").attr("class");
		if (option_class == 'layout_1') {
			jQuery('#layout_img_1').slideDown();
			jQuery('#layout_img_2').slideUp();
			jQuery('#layout_img_3').slideUp();
			jQuery('#layout_img_4').slideUp();
			jQuery('#layout_img_5').slideUp();
			jQuery('#layout_img_6').slideUp();
			jQuery('#layout_img_7').slideUp();
		}else if (option_class == 'layout_2') {
			jQuery('#layout_img_2').slideDown();
			jQuery('#layout_img_1').slideUp();
			jQuery('#layout_img_3').slideUp();
			jQuery('#layout_img_4').slideUp();
			jQuery('#layout_img_5').slideUp();
			jQuery('#layout_img_6').slideUp();
			jQuery('#layout_img_7').slideUp();
		}else if (option_class == 'layout_3') {
			jQuery('#layout_img_3').slideDown();
			jQuery('#layout_img_1').slideUp();
			jQuery('#layout_img_2').slideUp();
			jQuery('#layout_img_4').slideUp();
			jQuery('#layout_img_5').slideUp();
			jQuery('#layout_img_6').slideUp();
			jQuery('#layout_img_7').slideUp();
		}else if (option_class == 'layout_4') {
			jQuery('#layout_img_4').slideDown();
			jQuery('#layout_img_1').slideUp();
			jQuery('#layout_img_2').slideUp();
			jQuery('#layout_img_3').slideUp();
			jQuery('#layout_img_5').slideUp();
			jQuery('#layout_img_6').slideUp();
			jQuery('#layout_img_7').slideUp();
		}else if (option_class == 'layout_5') {
			jQuery('#layout_img_5').slideDown();
			jQuery('#layout_img_1').slideUp();
			jQuery('#layout_img_2').slideUp();
			jQuery('#layout_img_3').slideUp();
			jQuery('#layout_img_4').slideUp();
			jQuery('#layout_img_6').slideUp();
			jQuery('#layout_img_7').slideUp();
		}else if (option_class == 'layout_6') {
			jQuery('#layout_img_6').slideDown();
			jQuery('#layout_img_1').slideUp();
			jQuery('#layout_img_2').slideUp();
			jQuery('#layout_img_3').slideUp();
			jQuery('#layout_img_4').slideUp();
			jQuery('#layout_img_5').slideUp();
			jQuery('#layout_img_7').slideUp();
		}else if (option_class == 'layout_7') {
			jQuery('#layout_img_7').slideDown();
			jQuery('#layout_img_1').slideUp();
			jQuery('#layout_img_2').slideUp();
			jQuery('#layout_img_3').slideUp();
			jQuery('#layout_img_4').slideUp();
			jQuery('#layout_img_5').slideUp();
			jQuery('#layout_img_6').slideUp();
		}else{
		
		}
    });	
	
});
