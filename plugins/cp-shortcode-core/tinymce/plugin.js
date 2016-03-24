tinymce.PluginManager.add('cp_button', function(ed, url) {
    ed.addCommand("CPPopup", function ( a, params )
    {
        var popup = 'shortcode-generator';

        if(typeof params != 'undefined' && params.identifier) {
            popup = params.identifier;
        }
        
        jQuery('#TB_window').hide();

        // load thickbox
        tb_show("CrunchPress Shortcodes", ajaxurl + "?action=cp_shortcodes_popup&popup=" + popup + "&width=" + 800);
    });

    // Add a button that opens a window
    ed.addButton('cp_button', {
        text: '',
        icon: true,
        image: CP_Shortcodes.plugin_folder + '/tinymce/images/icon.png',
        cmd: 'CPPopup'
    });
});