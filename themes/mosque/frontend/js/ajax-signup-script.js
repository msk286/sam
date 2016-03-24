jQuery(document).ready(function($) {
	
	"use strict";
	
	// Sign Up
    $('form#sing-up').on('submit', function(e){
        $('form#sing-up p.status').show().text(ajax_signup_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_signup_object.ajaxurl,
            data: { 
                'action': 'ajaxsignup', //calls wp_ajax_nopriv_ajaxlogin
                'nickname': $('form#sing-up #nickname').val(), 
                'first_name': $('form#sing-up #first_name').val(), 
				'last_name': $('form#sing-up #last_name').val(), 
				'user_email': $('form#sing-up #user_email').val(), 
				'user_pass': $('form#sing-up #user_pass').val(), 
				'captcha_code': $('form#sing-up #captcha_code').val(), 
				'ajax_captcha': $('form#sing-up #ajax_captcha').val(), 
                'security': $('form#sing-up #security').val() },
            success: function(data){
                $('form#sing-up p.status').text(data.message);
                if (data.signup == true){
                    document.location.href = ajax_signup_object.redirecturl;
                }
            }
        });
        e.preventDefault();
    });

});
