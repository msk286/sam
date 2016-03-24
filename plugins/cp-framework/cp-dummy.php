<?php
/*
 * CP Dummy Functions
 * File to call the Dummy Data
 */


class cp_dummy_data
{
    
    //Add Action and Remove action
    public function __construct()
    {
        
        //add_action('admin_init', array($this, 'wp_reset_init'));
        //add_action('admin_init', array($this, '_redirect_user'));
    }
    
    private $_nonce = '_wpnonce';
    
    
    private $_tables;
    
    
    private $_wp_tables;
    
    function wp_reset_init($import_filepath = '', $layout = '')
    {
        global $wpdb, $current_user, $pagenow;
        
        // Grab the WordPress database tables
        $this->_wp_tables = $wpdb->tables();
        
        // Check for valid input - goes ahead and drops / resets tables
        require_once(ABSPATH . '/wp-admin/includes/upgrade.php');
        
        // No tables were selected
        // if ( ! isset($_POST['tables']) && empty($_POST['tables']) ) {
        // wp_redirect( admin_url( $pagenow ) . '?page=wp-reset&reset=no-select' ); exit();
        // }
        
        // Get current options
        $blog_title = get_option('blogname');
        $public     = get_option('blog_public');
        
        $admin_user = get_user_by('login', 'admin');
        $user       = (!$admin_user || !user_can($admin_user->ID, 'update_core')) ? $current_user : $admin_user;
        
        // Get the selected tables
        $tables = array(
            'wp_commentmeta',
            'wp_comments',
            'wp_links',
            'wp_options',
            'wp_postmeta',
            'wp_posts',
            'wp_terms',
            'wp_term_relationships',
            'wp_term_taxonomy',
            'wp_usermeta',
            'wp_users'
        );
        
        // Compare the selected tables against the ones in the database
        $this->_tables = array_diff_key($this->_wp_tables, $tables);
        
        // Preserve the data from the tables that are unique
        if (0 < count($this->_tables))
            $backup_tables = $this->_backup_tables($this->_tables);
        
        // Grab the currently active plugins		
        $active_plugins = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM $wpdb->options WHERE option_name = %s", 'active_plugins'));
        
        // Run through the database columns, drop all the tables and
        // install wp with previous settings
        if ($db_tables = $wpdb->get_col("SHOW TABLES LIKE '{$wpdb->prefix}%'")) {
            foreach ($db_tables as $db_table) {
                $wpdb->query("DROP TABLE {$db_table}");
            }
            $keys = wp_install($blog_title, $user->user_login, $user->user_email, $public);
            update_option('template', 'mosque');
            update_option('stylesheet', 'mosque');
            $this->cp_default_settings($layout);
            $this->_wp_update_user($user, $keys);
        }
        
        //Delete and replace tables with the backed up table data		
        // foreach ($wpdb->tables() as $table) {
        // $wpdb->query("DELETE FROM " . $table);
        // }					
        
        if (!empty($active_plugins)) {
            $wpdb->update($wpdb->options, array(
                'option_value' => $active_plugins
            ), array(
                'option_name' => 'active_plugins'
            ));
            $crunch_dummy_data                    = new crunch_dummy_data();
            $crunch_dummy_data->fetch_attachments = true;
            $crunch_dummy_data->import($import_filepath);
        }
        
        //wp_redirect( admin_url() ); exit();
    }
    
    
    
    function _wp_update_user($user, $keys)
    {
        global $wpdb;
        extract($keys, EXTR_SKIP);
        
        $query = $wpdb->prepare("UPDATE $wpdb->users SET user_pass = '%s', user_activation_key = '' WHERE ID = '%d'", $user->user_pass, $user_id);
        
        if ($wpdb->query($query)) {
            // Remove password reminder after installing
            if (get_user_meta($user_id, 'default_password_nag'))
                delete_user_meta($user_id, 'default_password_nag');
            
            wp_clear_auth_cookie();
            wp_set_auth_cookie($user_id);
            
            return true;
        }
        return false;
    }
    
    function _redirect_user()
    {
        if (get_option('wp-reset-activated', false)) {
            delete_option('wp-reset-activated');
            wp_redirect(admin_url('admin.php') . '?page=dummydata_import&reset=success');
        }
    }
    
    function _backup_tables($tables, $type = 'backup')
    {
        global $wpdb;
        
        if (is_array($tables)) {
            switch ($type) {
                case 'backup':
                    $backup_tables = array();
                    foreach ($tables as $table) {
                        $backup_tables[$table] = $wpdb->get_results("SELECT * FROM " . $table);
                    }
                    return $backup_tables;
                    break;
                case 'reset':
                    foreach ($tables as $table_name => $table_data) {
                        foreach ($table_data as $row) {
                            $columns = $values = array();
                            foreach ($row as $column => $value) {
                                $columns[] = $column;
                                $values[]  = esc_sql($value);
                            }
                            $wpdb->query("INSERT INTO $table_name (" . implode(', ', $columns) . ") VALUES ('" . implode("', '", $values) . "')");
                        }
                    }
                    break;
            }
        }
        return;
    }
    
    function cp_default_settings($cp_layout = '')
    {
        if ($cp_layout == 'dummy_xml_6.xml') {
            if(get_option('default_pages_settings') == ''){$default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Right Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";save_option('default_pages_settings', get_option('default_pages_settings'),$default_pages_xml);}if(get_option('general_settings') == ''){$general_settings = "<general_settings><header_logo_btn>disable</header_logo_btn><header_logo_bg>696</header_logo_bg><logo_text_cp>Good</logo_text_cp><logo_bold_text_cp>Will</logo_bold_text_cp><logo_subtext>Nonprofit Multipurpose Theme</logo_subtext><header_logo>698</header_logo><logo_width>187</logo_width><logo_height>114</logo_height><header_favicon>http://crunchpress.com/dummy/pageant/dummy/wp-content/uploads/2015/01/pageant_crown8.png</header_favicon><header_fav_link></header_fav_link><slide_bg_islamic>enable</slide_bg_islamic><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#B93941</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#ffffff</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code>+1 4563 278910</contact_us_code><contact_us_code2>info@charity.com</contact_us_code2><contact_us_code3>27 First St, NewYork, CA 94567, USA</contact_us_code3><select_header_cp>Style 2</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon>enable</topsocial_icon><topsign_icon>enable</topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp>Style 1</select_footer_cp><footer_style_apply>enable</footer_style_apply><footer_upper_layout></footer_upper_layout><copyright_code>GOODWILL© 2015 All Rights Reserved, Designed &amp; Developed  by CrunchPress.com</copyright_code><social_networking>enable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo>713</footer_logo><footer_link></footer_link><footer_logo_width>243</footer_logo_width><footer_logo_height>44</footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>09/23/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>&lt;p&gt;The GoodWill is a high quality web-masterpiece. The main destination of this&lt;br&gt; theme is to serve Charity,
Politics, Online Store, Environmental, Islamic &amp;amp; church&lt;br&gt; services. It also fits in many other branches.&lt;/p&gt;</mainte_description><cp_comming_soon>Style 2</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text></donate_btn_text><donation_page_id>278</donation_page_id><donate_email_id></donate_email_id><donate_title></donate_title><donation_currency>AUD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";save_option('general_settings', get_option('general_settings'),$general_settings);}if(get_option('typography_settings') == ''){$typography_settings = "<typography_settings><font_google>Lato</font_google><font_size_normal>14</font_size_normal><font_google_heading>Raleway</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>36</heading_h1><heading_h2>28</heading_h2><heading_h3></heading_h3><heading_h4></heading_h4><heading_h5></heading_h5><heading_h6></heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";save_option('typography_settings', get_option('typography_settings'),$typography_settings);}if(get_option('slider_settings') == ''){$slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow></bx_slider_settings></slider_settings>";save_option('slider_settings', get_option('slider_settings'),$slider_settings);}if(get_option('social_settings') == ''){$social_settings = "<social_settings><facebook_network>http://www.facebook.com</facebook_network><twitter_network>http://www.twitter.com/</twitter_network><delicious_network>http://www.delicious.com</delicious_network><google_plus_network>http://www.plus.google.com</google_plus_network><linked_in_network>http://www.linkedin.com/</linked_in_network><youtube_network>http://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network></vimeo_network><pinterest_network>http://www.printerest.com</pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network></skype_network><facebook_sharing>disable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>enable</stumble_sharing><delicious_sharing>disable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>enable</digg_sharing><myspace_sharing>enable</myspace_sharing><reddit_sharing>enable</reddit_sharing></social_settings>";save_option('social_settings', get_option('social_settings'),$social_settings);}if(get_option('sidebar_settings') == ''){$sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Dual Sidebar Left</sidebar_name><sidebar_name>Dual Sidebar Right</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Causes Sidebar</sidebar_name><sidebar_name>Calender</sidebar_name></sidebar_settings>";save_option('sidebar_settings', get_option('sidebar_settings'),$sidebar_settings);}
        }
        if ($cp_layout == 'dummy_xml_7.xml') {
          if(get_option('default_pages_settings') == ''){$default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Right Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";save_option('default_pages_settings', get_option('default_pages_settings'),$default_pages_xml);}if(get_option('general_settings') == ''){$general_settings = "<general_settings><header_logo_btn>disable</header_logo_btn><header_logo_bg>696</header_logo_bg><logo_text_cp>GOOD</logo_text_cp><logo_bold_text_cp>Will</logo_bold_text_cp><logo_subtext>NON PROFIT MULTIPURPOSE THEME</logo_subtext><header_logo>NON</header_logo><logo_width>187</logo_width><logo_height>114</logo_height><header_favicon>http://crunchpress.com/dummy/pageant/dummy/wp-content/uploads/2015/01/pageant_crown8.png</header_favicon><header_fav_link></header_fav_link><slide_bg_islamic>enable</slide_bg_islamic><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#faa61a</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#ffffff</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code>+1 4563 278910</contact_us_code><contact_us_code2>info@charity.com</contact_us_code2><contact_us_code3>27 First St, NewYork, CA 94567, USA</contact_us_code3><select_header_cp>Style 6</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon>enable</topsocial_icon><topsign_icon>enable</topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp>Style 5</select_footer_cp><footer_style_apply>enable</footer_style_apply><footer_upper_layout>footer-style-upper-1</footer_upper_layout><copyright_code>GoodWill © 2015 All Rights Reserved, Designed &amp; Developed  by CrunchPress.com</copyright_code><social_networking>enable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo>713</footer_logo><footer_link></footer_link><footer_logo_width>243</footer_logo_width><footer_logo_height>44</footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>09/23/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>&lt;p&gt;The GoodWill is a high quality web-masterpiece. The main destination of this&lt;br&gt; theme is to serve Charity,
			Politics, Online Store, Environmental, Islamic &amp;amp; church&lt;br&gt; services. It also fits in many other branches.&lt;/p&gt;</mainte_description><cp_comming_soon>Style 2</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text></donate_btn_text><donation_page_id>301</donation_page_id><donate_email_id></donate_email_id><donate_title></donate_title><donation_currency>AUD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";save_option('general_settings', get_option('general_settings'),$general_settings);}if(get_option('typography_settings') == ''){$typography_settings = "<typography_settings><font_google>Lato</font_google><font_size_normal>14</font_size_normal><font_google_heading>Raleway</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>36</heading_h1><heading_h2>30</heading_h2><heading_h3></heading_h3><heading_h4></heading_h4><heading_h5></heading_h5><heading_h6></heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";save_option('typography_settings', get_option('typography_settings'),$typography_settings);}if(get_option('slider_settings') == ''){$slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow></bx_slider_settings></slider_settings>";save_option('slider_settings', get_option('slider_settings'),$slider_settings);}if(get_option('social_settings') == ''){$social_settings = "<social_settings><facebook_network>www.facebook.com</facebook_network><twitter_network>www.twitter.com</twitter_network><delicious_network>https://delicious.com/</delicious_network><google_plus_network>https://plus.google.com</google_plus_network><linked_in_network></linked_in_network><youtube_network>https://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network>https://vimeo.com/</vimeo_network><pinterest_network>www.pinterest.com</pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network>www.skype.com</skype_network><facebook_sharing>disable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>enable</stumble_sharing><delicious_sharing>disable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>enable</digg_sharing><myspace_sharing>enable</myspace_sharing><reddit_sharing>enable</reddit_sharing></social_settings>";save_option('social_settings', get_option('social_settings'),$social_settings);}if(get_option('sidebar_settings') == ''){$sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Dual Sidebar Left</sidebar_name><sidebar_name>Dual Sidebar Right</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Causes</sidebar_name><sidebar_name>Event Calender</sidebar_name><sidebar_name>Blog Sidebar</sidebar_name></sidebar_settings>";save_option('sidebar_settings', get_option('sidebar_settings'),$sidebar_settings);}
        }
        if ($cp_layout == 'dummy_xml_1.xml') { //Dummy Installation 1(Charity)
            if(get_option('default_pages_settings') == ''){$default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Right Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";save_option('default_pages_settings', get_option('default_pages_settings'),$default_pages_xml);}if(get_option('general_settings') == ''){$general_settings = "<general_settings><header_logo_btn>disable</header_logo_btn><header_logo_bg>696</header_logo_bg><logo_text_cp>Good</logo_text_cp><logo_bold_text_cp>Will</logo_bold_text_cp><logo_subtext>Nonprofit Multipurpose Theme</logo_subtext><header_logo>698</header_logo><logo_width>187</logo_width><logo_height>114</logo_height><header_favicon>http://crunchpress.com/dummy/pageant/dummy/wp-content/uploads/2015/01/pageant_crown8.png</header_favicon><header_fav_link></header_fav_link><slide_bg_islamic>disable</slide_bg_islamic><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#7CC086</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#ffffff</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code>+1 4563 278910</contact_us_code><contact_us_code2>info@charity.com</contact_us_code2><contact_us_code3>27 First St, NewYork, CA 94567, USA</contact_us_code3><select_header_cp>Style 1</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon>enable</topsocial_icon><topsign_icon>enable</topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp>Style 1</select_footer_cp><footer_style_apply>enable</footer_style_apply><footer_upper_layout></footer_upper_layout><copyright_code>GOODWILL© 2015 All Rights Reserved, Designed &amp; Developed  by  CrunchPress.com</copyright_code><social_networking>enable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo>713</footer_logo><footer_link></footer_link><footer_logo_width>243</footer_logo_width><footer_logo_height>44</footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>01/23/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>&lt;p&gt;The GOODWILL is a high quality web-masterpiece. The main destination of this&lt;br&gt; theme is a Nonprofit Multipurpose Theme,
				Charity, Politics, Online Store, Environmental, Islamic &amp;amp; Church&lt;br&gt; services. It also fits in many other branches.&lt;/p&gt;</mainte_description><cp_comming_soon>Style 1</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text></donate_btn_text><donation_page_id>759</donation_page_id><donate_email_id></donate_email_id><donate_title></donate_title><donation_currency>AUD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";save_option('general_settings', get_option('general_settings'),$general_settings);}if(get_option('typography_settings') == ''){$typography_settings = "<typography_settings><font_google>Lato</font_google><font_size_normal>14</font_size_normal><font_google_heading>Raleway</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>36</heading_h1><heading_h2></heading_h2><heading_h3></heading_h3><heading_h4></heading_h4><heading_h5></heading_h5><heading_h6></heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";save_option('typography_settings', get_option('typography_settings'),$typography_settings);}if(get_option('slider_settings') == ''){$slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow></bx_slider_settings></slider_settings>";save_option('slider_settings', get_option('slider_settings'),$slider_settings);}if(get_option('social_settings') == ''){$social_settings = "<social_settings><facebook_network>http://www.facebook.com</facebook_network><twitter_network>http://www.twitter.com/</twitter_network><delicious_network>http://www.delicious.com</delicious_network><google_plus_network>http://www.plus.google.com</google_plus_network><linked_in_network>http://www.linkedin.com/</linked_in_network><youtube_network>http://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network></vimeo_network><pinterest_network>http://www.printerest.com</pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network></skype_network><facebook_sharing>enable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>enable</stumble_sharing><delicious_sharing>enable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>enable</digg_sharing><myspace_sharing>enable</myspace_sharing><reddit_sharing>enable</reddit_sharing></social_settings>";save_option('social_settings', get_option('social_settings'),$social_settings);}if(get_option('sidebar_settings') == ''){$sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Dual Sidebar Left</sidebar_name><sidebar_name>Dual Sidebar Right</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Naats</sidebar_name><sidebar_name>Causes</sidebar_name><sidebar_name>Events Calendar</sidebar_name><sidebar_name>Blog Sidebar</sidebar_name><sidebar_name>Blog Sidebar Right</sidebar_name></sidebar_settings>";save_option('sidebar_settings', get_option('sidebar_settings'),$sidebar_settings);}
        } else if ($cp_layout == 'dummy_xml_2.xml') { //Dummy Installation 2(Causes)
            if (get_option('default_pages_settings') == '') {
                $default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Right Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";
                save_option('default_pages_settings', get_option('default_pages_settings'), $default_pages_xml);
            }
            if (get_option('general_settings') == '') {
                $general_settings = "<general_settings><header_logo_btn>disable</header_logo_btn><header_logo_bg>696</header_logo_bg><logo_text_cp>Good</logo_text_cp><logo_bold_text_cp>Will</logo_bold_text_cp><logo_subtext>NONPROFIT MULTIPURPOSE THEME</logo_subtext><header_logo>698</header_logo><logo_width>187</logo_width><logo_height>114</logo_height><header_favicon>http://crunchpress.com/dummy/pageant/dummy/wp-content/uploads/2015/01/pageant_crown8.png</header_favicon><header_fav_link></header_fav_link><slide_bg_islamic>disable</slide_bg_islamic><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#4eb9eb</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#ffffff</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code>&lt;ul class=&quot;topleft&quot;&gt; 						&lt;li&gt;&lt;a href=&quot;#&quot;&gt;Branches &lt;/a&gt;&lt;/li&gt; 						&lt;li&gt;&lt;a href=&quot;#&quot;&gt;Reservation&lt;/a&gt;&lt;/li&gt; 						&lt;li&gt;0800 1234 5678&lt;/li&gt; 					&lt;/ul&gt;</contact_us_code><select_header_cp>Style 5</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon>disable</topsocial_icon><topsign_icon>disable</topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp>Style 5</select_footer_cp><footer_style_apply>enable</footer_style_apply><footer_upper_layout>footer-style-upper-1</footer_upper_layout><copyright_code>&lt;p&gt;GOODWILL© 2015 All Rights Reserved, Designed &amp; Developed  by  &lt;a class=&quot;color-1&quot; href=&quot;http://www.crunchpress.com/&quot;&gt; CrunchPress.com&lt;/a&gt;&lt;/p&gt;</copyright_code><social_networking>enable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo>713</footer_logo><footer_link></footer_link><footer_logo_width>243</footer_logo_width><footer_logo_height>44</footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>01/23/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>&lt;p&gt;The GoodWill is a high quality web-masterpiece. The main destination of this&lt;br&gt; theme is to serve Charity,			Politics, Online Store, Environmental, Islamic &amp;amp; church&lt;br&gt; services. It also fits in many other branches.&lt;/p&gt;</mainte_description><cp_comming_soon>Style 2</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text></donate_btn_text><donation_page_id>299</donation_page_id><donate_email_id></donate_email_id><donate_title></donate_title><donation_currency>AUD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";
                save_option('general_settings', get_option('general_settings'), $general_settings);
            }
            if (get_option('typography_settings') == '') {
                $typography_settings = "<typography_settings><font_google>Lato</font_google><font_size_normal>14</font_size_normal><font_google_heading>Raleway</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>36</heading_h1><heading_h2></heading_h2><heading_h3></heading_h3><heading_h4></heading_h4><heading_h5></heading_h5><heading_h6></heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";
                save_option('typography_settings', get_option('typography_settings'), $typography_settings);
            }
            if (get_option('slider_settings') == '') {
                $slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow><video_slider_on_off>enable</video_slider_on_off><video_banner_url>http://crunchpress.com/dummy/goodwill/causes/wp-content/uploads/2015/05/ocean.ogv</video_banner_url><video_banner_caption>If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.</video_banner_caption><video_banner_title>NON PROFIT MULTIPURPOSE THEME</video_banner_title><video_banner_btn_text>Purchase Theme</video_banner_btn_text><video_banner_btn_link>http://crunchpress.com/dummy/goodwill/causes/</video_banner_btn_link><safari_banner>263</safari_banner><safari_banner_link>http://crunchpress.com/dummy/goodwill/causes/wp-content/uploads/2015/05/1014.jpg</safari_banner_link><safari_banner_width></safari_banner_width><safari_banner_height></safari_banner_height></bx_slider_settings></slider_settings>";
                save_option('slider_settings', get_option('slider_settings'), $slider_settings);
            }
            if (get_option('social_settings') == '') {
                $social_settings = "<social_settings><facebook_network>#</facebook_network><twitter_network>#</twitter_network><delicious_network>#</delicious_network><google_plus_network>#</google_plus_network><linked_in_network>#</linked_in_network><youtube_network>#</youtube_network><flickr_network></flickr_network><vimeo_network>#</vimeo_network><pinterest_network>#</pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network></skype_network><facebook_sharing>enable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>enable</stumble_sharing><delicious_sharing>enable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>enable</digg_sharing><myspace_sharing>enable</myspace_sharing><reddit_sharing>enable</reddit_sharing></social_settings>";
                save_option('social_settings', get_option('social_settings'), $social_settings);
            }
            if (get_option('sidebar_settings') == '') {
                $sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Dual Sidebar Left</sidebar_name><sidebar_name>Dual Sidebar Right</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Event-Sidebar</sidebar_name></sidebar_settings>";
                save_option('sidebar_settings', get_option('sidebar_settings'), $sidebar_settings);
            }
        } else if ($cp_layout == 'dummy_xml_3.xml') { //Dummy Installation 3(Church)
            if (get_option('default_pages_settings') == '') {
                $default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Right Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";
                save_option('default_pages_settings', get_option('default_pages_settings'), $default_pages_xml);
            }
            if (get_option('general_settings') == '') {
                $general_settings = "<general_settings><header_logo_btn>disable</header_logo_btn><header_logo_bg>679</header_logo_bg><logo_text_cp>Good</logo_text_cp><logo_bold_text_cp>Will</logo_bold_text_cp><logo_subtext>Nonprofit Multipurpose Theme</logo_subtext><header_logo>698</header_logo><logo_width>187</logo_width><logo_height>114</logo_height><header_favicon>http://crunchpress.com/dummy/pageant/dummy/wp-content/uploads/2015/01/pageant_crown8.png</header_favicon><header_fav_link></header_fav_link><slide_bg_islamic>enable</slide_bg_islamic><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#007D7D</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#ffffff</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code>&lt;ul class=&quot;topleft&quot;&gt; 						&lt;li&gt;&lt;a href=&quot;#&quot;&gt;Branches &lt;/a&gt;&lt;/li&gt; 						&lt;li&gt;&lt;a href=&quot;#&quot;&gt;Reservation&lt;/a&gt;&lt;/li&gt; 						&lt;li&gt;0800 1234 5678&lt;/li&gt; 					&lt;/ul&gt;</contact_us_code><select_header_cp>Style 3</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon>enable</topsocial_icon><topsign_icon>enable</topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp>Style 5</select_footer_cp><footer_style_apply>enable</footer_style_apply><footer_upper_layout>footer-style-upper-1</footer_upper_layout><copyright_code>&lt;p&gt;GOODWILL© 2015 All Rights Reserved, Designed &amp; Developed  by  &lt;a class=&quot;color-1&quot; href=&quot;http://www.crunchpress.com/&quot;&gt; CrunchPress.com&lt;/a&gt;&lt;/p&gt;</copyright_code><social_networking>enable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo>713</footer_logo><footer_link></footer_link><footer_logo_width>243</footer_logo_width><footer_logo_height>44</footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>10/22/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>&lt;p&gt;The GoodWill is a high quality web-masterpiece. The main destination of this&lt;br&gt; theme is to serve Charity,			Politics, Online Store, Environmental, Islamic &amp;amp; church&lt;br&gt; services. It also fits in many other branches.&lt;/p&gt;</mainte_description><cp_comming_soon>Style 2</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text></donate_btn_text><donation_page_id>668</donation_page_id><donate_email_id></donate_email_id><donate_title></donate_title><donation_currency>AUD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";
                save_option('general_settings', get_option('general_settings'), $general_settings);
            }
            if (get_option('typography_settings') == '') {
                $typography_settings = "<typography_settings><font_google>Lato</font_google><font_size_normal>14</font_size_normal><font_google_heading>Raleway</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>36</heading_h1><heading_h2></heading_h2><heading_h3></heading_h3><heading_h4></heading_h4><heading_h5></heading_h5><heading_h6></heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";
                save_option('typography_settings', get_option('typography_settings'), $typography_settings);
            }
            if (get_option('slider_settings') == '') {
                $slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow></bx_slider_settings></slider_settings>";
                save_option('slider_settings', get_option('slider_settings'), $slider_settings);
            }
            if (get_option('social_settings') == '') {
                $social_settings = "<social_settings><facebook_network>http://www.facebook.com</facebook_network><twitter_network>http://www.twitter.com/</twitter_network><delicious_network>http://www.delicious.com</delicious_network><google_plus_network>http://www.plus.google.com</google_plus_network><linked_in_network>http://www.linkedin.com/</linked_in_network><youtube_network>http://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network>https://www.vimeo.com/</vimeo_network><pinterest_network>http://www.printerest.com</pinterest_network><Instagram_network></Instagram_network><github_network>http://www.github.com</github_network><skype_network>http://www.skype.com</skype_network><facebook_sharing>enable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>enable</stumble_sharing><delicious_sharing>enable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>enable</digg_sharing><myspace_sharing>enable</myspace_sharing><reddit_sharing>enable</reddit_sharing></social_settings>";
                save_option('social_settings', get_option('social_settings'), $social_settings);
            }
            if (get_option('sidebar_settings') == '') {
                $sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Dual Sidebar Left</sidebar_name><sidebar_name>Dual Sidebar Right</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Causes Sidebar</sidebar_name><sidebar_name>Event-Calender</sidebar_name><sidebar_name>Sermon-Sidebar</sidebar_name></sidebar_settings>";
                save_option('sidebar_settings', get_option('sidebar_settings'), $sidebar_settings);
            }
        } else if ($cp_layout == 'dummy_xml_4.xml') { //Dummy Installation 4(Eco)
            if (get_option('default_pages_settings') == '') {
                $default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Right Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";
                save_option('default_pages_settings', get_option('default_pages_settings'), $default_pages_xml);
            }
            if (get_option('general_settings') == '') {
                $general_settings = "<general_settings><header_logo_btn>disable</header_logo_btn><header_logo_bg>696</header_logo_bg><logo_text_cp>GOOD</logo_text_cp><logo_bold_text_cp>WILL</logo_bold_text_cp><logo_subtext>NON PROFIT MULTIPURPOSE THEME</logo_subtext><header_logo>698</header_logo><logo_width>187</logo_width><logo_height>114</logo_height><header_favicon>http://crunchpress.com/demo/pageant/dummy/wp-content/uploads/2015/01/pageant_crown8.png</header_favicon><header_fav_link></header_fav_link><slide_bg_islamic>enable</slide_bg_islamic><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#09502E</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#ffffff</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code>&lt;ul class=&quot;topleft&quot;&gt; 						&lt;li&gt;&lt;a href=&quot;#&quot;&gt;Branches &lt;/a&gt;&lt;/li&gt; 						&lt;li&gt;&lt;a href=&quot;#&quot;&gt;Reservation&lt;/a&gt;&lt;/li&gt; 						&lt;li&gt;0800 1234 5678&lt;/li&gt; 					&lt;/ul&gt;</contact_us_code><select_header_cp>Style 4</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon>enable</topsocial_icon><topsign_icon>enable</topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp>Style 1</select_footer_cp><footer_style_apply>enable</footer_style_apply><footer_upper_layout></footer_upper_layout><copyright_code>&lt;p&gt;PAGEANT© 2015 All Rights Reserved, Designed &amp; Developed  by  &lt;a class=&quot;color-1&quot; href=&quot;http://www.crunchpress.com/&quot;&gt; CrunchPress.com&lt;/a&gt;&lt;/p&gt;</copyright_code><social_networking>enable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo>713</footer_logo><footer_link></footer_link><footer_logo_width>243</footer_logo_width><footer_logo_height>44</footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>11/26/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>&lt;p&gt;The GoodWill is a high quality web-masterpiece. The main destination of this&lt;br&gt; theme is to serve Charity,			Politics, Online Store, Environmental, Islamic &amp;amp; church&lt;br&gt; services. It also fits in many other branches.&lt;/p&gt;</mainte_description><cp_comming_soon>Style 2</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text></donate_btn_text><donation_page_id>286</donation_page_id><donate_email_id></donate_email_id><donate_title></donate_title><donation_currency>AUD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";
                save_option('general_settings', get_option('general_settings'), $general_settings);
            }
            if (get_option('typography_settings') == '') {
                $typography_settings = "<typography_settings><font_google>Lato</font_google><font_size_normal>14</font_size_normal><font_google_heading>Raleway</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>36</heading_h1><heading_h2></heading_h2><heading_h3></heading_h3><heading_h4></heading_h4><heading_h5></heading_h5><heading_h6></heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";
                save_option('typography_settings', get_option('typography_settings'), $typography_settings);
            }
            if (get_option('slider_settings') == '') {
                $slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow></bx_slider_settings></slider_settings>";
                save_option('slider_settings', get_option('slider_settings'), $slider_settings);
            }
            if (get_option('social_settings') == '') {
                $social_settings = "<social_settings><facebook_network>http://www.facebook.com</facebook_network><twitter_network>http://www.twitter.com</twitter_network><delicious_network>http://www.delicious.com</delicious_network><google_plus_network>http://www.plus.google.com/</google_plus_network><linked_in_network>http://www.linkedin.com</linked_in_network><youtube_network>http://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network></vimeo_network><pinterest_network>http://www.printerest.com</pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network></skype_network><facebook_sharing>disable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>enable</stumble_sharing><delicious_sharing>disable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>enable</digg_sharing><myspace_sharing>enable</myspace_sharing><reddit_sharing>enable</reddit_sharing></social_settings>";
                save_option('social_settings', get_option('social_settings'), $social_settings);
            }
            if (get_option('sidebar_settings') == '') {
                $sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Dual Sidebar Left</sidebar_name><sidebar_name>Dual Sidebar Right</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Causes</sidebar_name><sidebar_name>Calender</sidebar_name></sidebar_settings>";
                save_option('sidebar_settings', get_option('sidebar_settings'), $sidebar_settings);
            }
        } else if ($cp_layout == 'dummy_xml_5.xml') { //Dummy Installation 5(Islamic)
            
		if(get_option('default_pages_settings') == ''){$default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Islamic Teachings Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";save_option('default_pages_settings', get_option('default_pages_settings'),$default_pages_xml);}if(get_option('general_settings') == ''){$general_settings = "<general_settings><header_logo_btn>enable</header_logo_btn><header_logo_bg>791</header_logo_bg><logo_text_cp>Mosque</logo_text_cp><logo_bold_text_cp></logo_bold_text_cp><logo_subtext>Mosque Islamic Center WordPress Theme</logo_subtext><header_logo>736</header_logo><logo_width>145</logo_width><logo_height>82</logo_height><header_favicon>728</header_favicon><header_fav_link>http://crunchpress.com/dummy/mosque/wp-content/uploads/2015/07/favicon.png</header_fav_link><slide_bg_islamic></slide_bg_islamic><salat_time>enable</salat_time><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#442525</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#f9f0e7</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code></contact_us_code><contact_us_code2></contact_us_code2><contact_us_code3></contact_us_code3><select_header_cp>Style 1</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon></topsocial_icon><topsign_icon></topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp></select_footer_cp><footer_style_apply></footer_style_apply><footer_upper_layout></footer_upper_layout><copyright_code>Islamic Mosque © 2015 All Rights Reserved, Designed &amp; Developed  by CrunchPress.com</copyright_code><social_networking>disable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo></footer_logo><footer_link></footer_link><footer_logo_width></footer_logo_width><footer_logo_height></footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>11/27/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>The Islamic is a high quality web-masterpiece. The main destination of this theme is to Religious and Islamic Themes  It also fits in many other branches.</mainte_description><cp_comming_soon>Style 1</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text>Donate</donate_btn_text><donation_page_id>179</donation_page_id><donate_email_id>example@example.com</donate_email_id><donate_title>Donate</donate_title><donation_currency>USD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";save_option('general_settings', get_option('general_settings'),$general_settings);}if(get_option('typography_settings') == ''){$typography_settings = "<typography_settings><font_google>Lato</font_google><arabic_font>Droid Arabic Kufi</arabic_font><arabic_font_heading>Lateef</arabic_font_heading><arabic_fonts_switch>disable</arabic_fonts_switch><arabic_menu_font>Thabit</arabic_menu_font><font_size_normal>14</font_size_normal><font_google_heading>Berkshire Swash</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>40</heading_h1><heading_h2>36</heading_h2><heading_h3>36</heading_h3><heading_h4></heading_h4><heading_h5>36</heading_h5><heading_h6>36</heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";save_option('typography_settings', get_option('typography_settings'),$typography_settings);}if(get_option('slider_settings') == ''){$slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow><video_slider_on_off>disable</video_slider_on_off><video_banner_url></video_banner_url><video_banner_caption></video_banner_caption><video_banner_title></video_banner_title><video_banner_btn_text></video_banner_btn_text><video_banner_btn_link></video_banner_btn_link><safari_banner></safari_banner><safari_banner_link></safari_banner_link><safari_banner_width></safari_banner_width><safari_banner_height></safari_banner_height></bx_slider_settings></slider_settings>";save_option('slider_settings', get_option('slider_settings'),$slider_settings);}if(get_option('social_settings') == ''){$social_settings = "<social_settings><facebook_network>http://www.facebook.com</facebook_network><twitter_network>http://www.twitter.com</twitter_network><delicious_network></delicious_network><google_plus_network>http://www.plus.google.com/</google_plus_network><linked_in_network>http://www.linkedin.com</linked_in_network><youtube_network>http://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network>http://www.vimeo.com</vimeo_network><pinterest_network></pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network></skype_network><facebook_sharing>enable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>disable</stumble_sharing><delicious_sharing>disable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>disable</digg_sharing><myspace_sharing>disable</myspace_sharing><reddit_sharing>disable</reddit_sharing></social_settings>";save_option('social_settings', get_option('social_settings'),$social_settings);}if(get_option('sidebar_settings') == ''){$sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Products Sidebar</sidebar_name><sidebar_name>Shortcode Sidebar</sidebar_name><sidebar_name>Islamic Teachings Sidebar</sidebar_name><sidebar_name>Features Sidebar</sidebar_name><sidebar_name>Ignitiondeck Sidebar</sidebar_name></sidebar_settings>";save_option('sidebar_settings', get_option('sidebar_settings'),$sidebar_settings);}
		
        } else if ($cp_layout == 'dummy_xml_6.xml') { //Dummy Installation 6(Politics)			
			if(get_option('default_pages_settings') == ''){$default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Right Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";save_option('default_pages_settings', get_option('default_pages_settings'),$default_pages_xml);}						if(get_option('general_settings') == ''){$general_settings = "<general_settings><header_logo_btn>disable</header_logo_btn><header_logo_bg>696</header_logo_bg><logo_text_cp>Good</logo_text_cp><logo_bold_text_cp>Will</logo_bold_text_cp><logo_subtext>Nonprofit Multipurpose Theme</logo_subtext><header_logo>698</header_logo><logo_width>187</logo_width><logo_height>114</logo_height><header_favicon>http://crunchpress.com/dummy/pageant/dummy/wp-content/uploads/2015/01/pageant_crown8.png</header_favicon><header_fav_link></header_fav_link><slide_bg_islamic>enable</slide_bg_islamic><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#B93941</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#ffffff</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code>&lt;address class=&quot;topbar-address&quot;&gt;             &lt;ul&gt;               &lt;li&gt;&lt;i class=&quot;fa fa-phone&quot;&gt;&lt;/i&gt;+1 4563 278910&lt;/li&gt;               &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-envelope&quot;&gt;&lt;/i&gt;info@charity.com&lt;/a&gt;&lt;/li&gt;               &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-map-marker&quot;&gt;&lt;/i&gt;27 First St, NewYork, CA 94567, USA&lt;/a&gt;&lt;/li&gt;             &lt;/ul&gt;             &lt;/address&gt;</contact_us_code><select_header_cp>Style 2</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon>enable</topsocial_icon><topsign_icon>enable</topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp>Style 1</select_footer_cp><footer_style_apply>enable</footer_style_apply><footer_upper_layout></footer_upper_layout><copyright_code>&lt;p&gt;GOODWILL© 2015 All Rights Reserved, Designed &amp; Developed  by  &lt;a class=&quot;color-1&quot; href=&quot;http://www.crunchpress.com/&quot;&gt; CrunchPress.com&lt;/a&gt;&lt;/p&gt;</copyright_code><social_networking>enable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo>713</footer_logo><footer_link></footer_link><footer_logo_width>243</footer_logo_width><footer_logo_height>44</footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>09/23/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>&lt;p&gt;The GoodWill is a high quality web-masterpiece. The main destination of this&lt;br&gt; theme is to serve Charity,			Politics, Online Store, Environmental, Islamic &amp;amp; church&lt;br&gt; services. It also fits in many other branches.&lt;/p&gt;</mainte_description><cp_comming_soon>Style 2</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text></donate_btn_text><donation_page_id>278</donation_page_id><donate_email_id></donate_email_id><donate_title></donate_title><donation_currency>AUD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";save_option('general_settings', get_option('general_settings'),$general_settings);}						if(get_option('typography_settings') == ''){$typography_settings = "<typography_settings><font_google>Lato</font_google><font_size_normal>14</font_size_normal><font_google_heading>Raleway</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>36</heading_h1><heading_h2>28</heading_h2><heading_h3></heading_h3><heading_h4></heading_h4><heading_h5></heading_h5><heading_h6></heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";save_option('typography_settings', get_option('typography_settings'),$typography_settings);}						if(get_option('slider_settings') == ''){$slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow></bx_slider_settings></slider_settings>";save_option('slider_settings', get_option('slider_settings'),$slider_settings);}if(get_option('social_settings') == ''){$social_settings = "<social_settings><facebook_network>http://www.facebook.com</facebook_network><twitter_network>http://www.twitter.com/</twitter_network><delicious_network>http://www.delicious.com</delicious_network><google_plus_network>http://www.plus.google.com</google_plus_network><linked_in_network>http://www.linkedin.com/</linked_in_network><youtube_network>http://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network></vimeo_network><pinterest_network>http://www.printerest.com</pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network></skype_network><facebook_sharing>disable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>enable</stumble_sharing><delicious_sharing>disable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>enable</digg_sharing><myspace_sharing>enable</myspace_sharing><reddit_sharing>enable</reddit_sharing></social_settings>";save_option('social_settings', get_option('social_settings'),$social_settings);}						if(get_option('sidebar_settings') == ''){$sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Dual Sidebar Left</sidebar_name><sidebar_name>Dual Sidebar Right</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Causes Sidebar</sidebar_name><sidebar_name>Calender</sidebar_name></sidebar_settings>";save_option('sidebar_settings', get_option('sidebar_settings'),$sidebar_settings);}		 }else if($cp_layout == 'dummy_xml_7.xml'){ //Dummy Installation 7(Store)			if(get_option('default_pages_settings') == ''){$default_pages_xml = "<default_pages_settings><sidebar_default>right-sidebar</sidebar_default><right_sidebar_default>Right Sidebar</right_sidebar_default><left_sidebar_default>Right Sidebar</left_sidebar_default><default_excerpt></default_excerpt></default_pages_settings>";save_option('default_pages_settings', get_option('default_pages_settings'),$default_pages_xml);}						if(get_option('general_settings') == ''){$general_settings = "<general_settings><header_logo_btn>disable</header_logo_btn><header_logo_bg>696</header_logo_bg><logo_text_cp>GOOD</logo_text_cp><logo_bold_text_cp>Will</logo_bold_text_cp><logo_subtext>NON PROFIT MULTIPURPOSE THEME</logo_subtext><header_logo>NON</header_logo><logo_width>187</logo_width><logo_height>114</logo_height><header_favicon>http://crunchpress.com/dummy/pageant/dummy/wp-content/uploads/2015/01/pageant_crown8.png</header_favicon><header_fav_link></header_fav_link><slide_bg_islamic>enable</slide_bg_islamic><select_layout_cp>full_layout</select_layout_cp><boxed_scheme></boxed_scheme><color_scheme>#faa61a</color_scheme><body_color></body_color><heading_color></heading_color><select_bg_pat>Background-Color</select_bg_pat><bg_scheme>#ffffff</bg_scheme><body_patren></body_patren><color_patren>/framework/images/pattern/pattern-5.png</color_patren><body_image></body_image><position_image_layout>top</position_image_layout><image_repeat_layout>no-repeat</image_repeat_layout><image_attachment_layout>fixed</image_attachment_layout><contact_us_code>&lt;div class=&quot;span4&quot;&gt; &lt;address class=&quot;topbar-address&quot;&gt; &lt;ul&gt; &lt;li&gt;&lt;i class=&quot;fa fa-phone&quot;&gt;&lt;/i&gt;+1 4563 278910&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-envelope&quot;&gt;&lt;/i&gt;info@charity.com&lt;script cf-hash=&quot;f9e31&quot; type=&quot;text/javascript&quot;&gt; /* &lt;![CDATA[ */!function(){try{var t=&quot;currentScript&quot;in document?document.currentScript:function(){for(var t=document.getElementsByTagName(&quot;script&quot;),e=t.length;e--;)if(t[e].getAttribute(&quot;cf-hash&quot;))return t[e]}();if(t&amp;&amp;t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute(&quot;data-cfemail&quot;);if(a){for(e=&quot;&quot;,r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]&gt; */&lt;/script&gt;&lt;/a&gt;&lt;/li&gt; &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;i class=&quot;fa fa-map-marker&quot;&gt;&lt;/i&gt;27 First St, NewYork, CA 94567, USA&lt;/a&gt;&lt;/li&gt; &lt;/ul&gt; &lt;/address&gt; &lt;/div&gt;</contact_us_code><select_header_cp>Style 6</select_header_cp><header_style_apply>enable</header_style_apply><header_css_code></header_css_code><google_webmaster_code></google_webmaster_code><topbutton_icon></topbutton_icon><topsocial_icon>enable</topsocial_icon><topsign_icon>enable</topsign_icon><resv_button></resv_button><resv_text></resv_text><resv_short></resv_short><select_footer_cp>Style 5</select_footer_cp><footer_style_apply>enable</footer_style_apply><footer_upper_layout>footer-style-upper-1</footer_upper_layout><copyright_code>&lt;p&gt;PAGEANT© 2015 All Rights Reserved, Designed &amp; Developed  by  &lt;a class=&quot;color-1&quot; href=&quot;http://www.crunchpress.com/&quot;&gt; CrunchPress.com&lt;/a&gt;&lt;/p&gt;</copyright_code><social_networking>enable</social_networking><twitter_feed></twitter_feed><twitter_home_button></twitter_home_button><twitter_id></twitter_id><consumer_key></consumer_key><consumer_secret></consumer_secret><access_token></access_token><access_secret_token></access_secret_token><footer_col_layout>footer-style1</footer_col_layout><footer_logo>713</footer_logo><footer_link></footer_link><footer_logo_width>243</footer_logo_width><footer_logo_height>44</footer_logo_height><breadcrumbs>enable</breadcrumbs><rtl_layout>disable</rtl_layout><site_loader></site_loader><element_loader></element_loader><maintenance_mode>disable</maintenance_mode><maintenace_title>We Are Coming Soon!</maintenace_title><countdown_time>09/23/2015</countdown_time><email_mainte>support@crunchpress.com</email_mainte><mainte_description>&lt;p&gt;The GoodWill is a high quality web-masterpiece. The main destination of this&lt;br&gt; theme is to serve Charity,			Politics, Online Store, Environmental, Islamic &amp;amp; church&lt;br&gt; services. It also fits in many other branches.&lt;/p&gt;</mainte_description><cp_comming_soon>Style 2</cp_comming_soon><social_icons_mainte>enable</social_icons_mainte><donation_button>enable</donation_button><donate_btn_text></donate_btn_text><donation_page_id>301</donation_page_id><donate_email_id></donate_email_id><donate_title></donate_title><donation_currency>AUD</donation_currency><tf_username></tf_username><tf_sec_api></tf_sec_api></general_settings>";save_option('general_settings', get_option('general_settings'),$general_settings);}						if(get_option('typography_settings') == ''){$typography_settings = "<typography_settings><font_google>Lato</font_google><font_size_normal>14</font_size_normal><font_google_heading>Raleway</font_google_heading><menu_font_google>Lato</menu_font_google><heading_h1>36</heading_h1><heading_h2>30</heading_h2><heading_h3></heading_h3><heading_h4></heading_h4><heading_h5></heading_h5><heading_h6></heading_h6><embed_typekit_code></embed_typekit_code></typography_settings>";save_option('typography_settings', get_option('typography_settings'),$typography_settings);}						if(get_option('slider_settings') == ''){$slider_settings = "<slider_settings><select_slider>default</select_slider><bx_slider_settings><slide_order_bx>slide</slide_order_bx><auto_play_bx>enable</auto_play_bx><pause_on_bx>enable</pause_on_bx><animation_speed_bx>1500</animation_speed_bx><show_bullets>enable</show_bullets><show_arrow>enable</show_arrow></bx_slider_settings></slider_settings>";save_option('slider_settings', get_option('slider_settings'),$slider_settings);}						if(get_option('social_settings') == ''){$social_settings = "<social_settings><facebook_network>www.facebook.com</facebook_network><twitter_network>www.twitter.com</twitter_network><delicious_network>https://delicious.com/</delicious_network><google_plus_network>https://plus.google.com</google_plus_network><linked_in_network></linked_in_network><youtube_network>https://www.youtube.com</youtube_network><flickr_network></flickr_network><vimeo_network>https://vimeo.com/</vimeo_network><pinterest_network>www.pinterest.com</pinterest_network><Instagram_network></Instagram_network><github_network></github_network><skype_network>www.skype.com</skype_network><facebook_sharing>disable</facebook_sharing><twitter_sharing>enable</twitter_sharing><stumble_sharing>enable</stumble_sharing><delicious_sharing>disable</delicious_sharing><googleplus_sharing>enable</googleplus_sharing><digg_sharing>enable</digg_sharing><myspace_sharing>enable</myspace_sharing><reddit_sharing>enable</reddit_sharing></social_settings>";save_option('social_settings', get_option('social_settings'),$social_settings);}						if(get_option('sidebar_settings') == ''){$sidebar_settings = "<sidebar_settings><sidebar_name>Right Sidebar</sidebar_name><sidebar_name>Left Sidebar</sidebar_name><sidebar_name>Dual Sidebar Left</sidebar_name><sidebar_name>Dual Sidebar Right</sidebar_name><sidebar_name>Contact Us Sidebar</sidebar_name><sidebar_name>Events Sidebar</sidebar_name><sidebar_name>Causes</sidebar_name><sidebar_name>Event Calender</sidebar_name><sidebar_name>Blog Sidebar</sidebar_name></sidebar_settings>";save_option('sidebar_settings', get_option('sidebar_settings'),$sidebar_settings);}		 }else{
            
        }
        
    }
    
    
    //eXPORT WIDGETS
    function cp_default_widgets_settings($cp_layout = '')
    {
        if ($cp_layout == 'dummy_xml_1.xml') {
            
			$widget_layerslider_widget = array (
  2 => 
  array (
    'id' => '1',
    'title' => 'LayerSlider',
  ),
  '_multiwidget' => 1,
);$widget_meta = array (
  3 => 
  array (
    'title' => 'Meta',
  ),
  '_multiwidget' => 1,
);$widget_pages = array (
  2 => 
  array (
    'title' => 'pages',
    'sortby' => 'post_title',
    'exclude' => '',
  ),
  3 => 
  array (
    'title' => 'Pages',
    'sortby' => 'post_title',
    'exclude' => '',
  ),
  '_multiwidget' => 1,
);$widget_recent = false;$widget_rss = array (
  2 => 
  array (
    'title' => '',
    'url' => 'http://rssfeeds',
    'link' => '',
    'items' => 10,
    'error' => 'WP HTTP Error: Couldn\'t resolve host \'rssfeeds\'',
    'show_summary' => 0,
    'show_author' => 0,
    'show_date' => 0,
  ),
  3 => 
  array (
    'title' => '',
    'url' => 'http://RSS',
    'items' => 3,
    'show_summary' => 0,
    'show_author' => 0,
    'show_date' => 0,
  ),
  '_multiwidget' => 1,
);$widget_search = array (
  2 => 
  array (
    'title' => 'Search',
  ),
  4 => 
  array (
    'title' => 'Search',
  ),
  '_multiwidget' => 1,
);$widget_tag_cloud = array (
  2 => 
  array (
    'title' => 'tags',
    'taxonomy' => 'post_tag',
  ),
  3 => 
  array (
    'title' => 'TAGS',
    'taxonomy' => 'post_tag',
  ),
  4 => 
  array (
    'title' => 'Tags ',
    'taxonomy' => 'post_tag',
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_widget_cart = array (
  3 => 
  array (
    'title' => 'Cart',
    'hide_if_empty' => 0,
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_layered_nav = array (
  3 => 
  array (
    'title' => 'Filter by',
    'display_type' => 'list',
    'query_type' => 'and',
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_layered_nav_filters = array (
  2 => 
  array (
    'title' => 'Active Filters',
  ),
  3 => 
  array (
    'title' => 'Active Filters',
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_price_filter = array (
  2 => 
  array (
    'title' => 'Filter by price',
  ),
  3 => 
  array (
    'title' => 'Filter by price',
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_product_categories = array (
  2 => 
  array (
    'title' => 'Product Categories',
    'orderby' => 'name',
    'dropdown' => '1',
    'count' => 0,
    'hierarchical' => '1',
    'show_children_only' => 0,
  ),
  3 => 
  array (
    'title' => 'Product Categories',
    'orderby' => 'name',
    'dropdown' => 0,
    'count' => 0,
    'hierarchical' => '1',
    'show_children_only' => 0,
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_product_tag_cloud = array (
  2 => 
  array (
    'title' => 'Product Tags',
  ),
  3 => 
  array (
    'title' => 'Product Tags',
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_recently_viewed_products = array (
  3 => 
  array (
    'title' => 'Recently Viewed Products',
    'number' => '3',
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_recent_reviews = array (
  1 => 
  array (
  ),
  2 => 
  array (
    'title' => 'Recent Reviews',
    'number' => '3',
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_top_rated_products = array (
  3 => 
  array (
    'title' => 'Top Rated Products',
    'number' => '5',
  ),
  '_multiwidget' => 1,
);$widget_text = array (
  2 => 
  array (
    'title' => '',
    'text' => '<div class="box">
<h2><span>Good</span>will</h2>
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
<p>It look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default. Praesent imperdiet vulputate viverra. Pellentesque ut faucibus justo.</p>
</div>',
    'filter' => false,
  ),
  3 => 
  array (
    'title' => 'Text Widget',
    'text' => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.',
    'filter' => false,
  ),
  4 => 
  array (
    'title' => 'Contact Info',
    'text' => '<div class="contact-1">
<address class="border-none">
            <p>The Church Branch,
              123 Lorem Ipsum Avenue, New York
              United States, 012345</p>
            <ul>
              <li><i class="fa fa-phone"></i>0123 456 7890</li>
              <li><i class="fa fa-print"></i>0123 456 7890</li>
              <li><a href="#"><i class="fa fa-envelope-o"></i>info@goodwill.com</a></li>
              <li><i class="fa fa-skype"></i>0123 456 7890</li>
            </ul>
            </address>
</div>',
    'filter' => false,
  ),
  5 => 
  array (
    'title' => '',
    'text' => '<div class="sidebar-bix-1">
<h3>Text Widget</h3>
<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>
</div>',
    'filter' => false,
  ),
  6 => 
  array (
    'title' => '',
    'text' => '<div class="sidebar-bix-1">
<h3>Text Widget</h3>
<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>
</div>',
    'filter' => false,
  ),
  7 => 
  array (
    'title' => '',
    'text' => '<div class="sidebar-bix-1">
<h3>Text Widget</h3>
<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>
</div>',
    'filter' => false,
  ),
  '_multiwidget' => 1,
);$widget_recent_news_show = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Recent Posts',
    'recent_post_category' => 'post',
    'number_of_news' => '4',
  ),
  4 => 
  array (
    'wid_class' => '',
    'title' => 'RECENT POSTS',
    'recent_post_category' => 'blog',
    'number_of_news' => '3',
  ),
  6 => 
  array (
    'wid_class' => '',
    'title' => 'RECENT NEWS',
    'recent_post_category' => 'blog',
    'number_of_news' => '4',
  ),
  7 => 
  array (
    'wid_class' => '',
    'title' => 'RECENT POSTS',
    'recent_post_category' => 'blog',
    'number_of_news' => '4',
  ),
  '_multiwidget' => 1,
);$widget_twitter_widget = array (
  2 => 
  array (
    'title' => 'TWEETS',
    'consumer_key' => '1iUu8muQcbDfv4UAp58rXw',
    'consumer_secret' => 'am535ByNUMFFo8vHQtpkVpgdJz9QgcW4FpWaGDvH5Xw',
    'user_token' => '88209931-h16p4dNkvaXe0UQTRAx8zzPcWgl3L7rXj2XDOT5c2',
    'user_secret' => '3ugAtUwyrCcXK99xleZssr2OkiwVymoB2ceFwknYwLk',
    'username_widget' => 'mosque_crunchpress',
    'num_of_tweets' => '1',
  ),
  '_multiwidget' => 1,
);$widget_flickr_widget = array (
  2 => 
  array (
    'title' => ' FLICKR PHOTOS',
    'type' => 'user',
    'flickr_id' => '68030678@N04',
    'count' => '9',
    'display' => 'latest',
    'size' => 'latest',
    'copyright' => NULL,
  ),
  '_multiwidget' => 1,
);$widget_popular_post = array (
  5 => 
  array (
    'title' => 'Popular Posts',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  6 => 
  array (
    'title' => 'popular posts',
    'get_cate_posts' => NULL,
    'nop' => '',
  ),
  7 => 
  array (
    'title' => 'POPULAR POSTS',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  8 => 
  array (
    'title' => 'POPULAR POSTS',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  9 => 
  array (
    'title' => 'POPULAR POSTS',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  10 => 
  array (
    'title' => 'Popular posts',
    'get_cate_posts' => NULL,
    'nop' => '3',
  ),
  '_multiwidget' => 1,
);$widget_recent_news_news = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Latest News',
    'recent_post_category' => 'blog',
    'number_of_news' => '4',
  ),
  4 => 
  array (
    'wid_class' => '',
    'title' => 'LATEST NEWS',
    'recent_post_category' => 'blog',
    'number_of_news' => '4',
  ),
  5 => 
  array (
    'wid_class' => '',
    'title' => 'Recent News',
    'recent_post_category' => 'blog',
    'number_of_news' => '3',
  ),
  '_multiwidget' => 1,
);$widget_archives = array (
  2 => 
  array (
    'title' => 'Archives',
    'count' => 0,
    'dropdown' => 0,
  ),
  4 => 
  array (
    'title' => 'ARCHIVES',
    'count' => 1,
    'dropdown' => 1,
  ),
  5 => 
  array (
    'title' => 'ARCHIVES',
    'count' => 1,
    'dropdown' => 1,
  ),
  '_multiwidget' => 1,
);$widget_categories = array (
  2 => 
  array (
    'title' => 'Categories',
    'count' => 0,
    'hierarchical' => 0,
    'dropdown' => 0,
  ),
  4 => 
  array (
    'title' => 'CATEGORIES',
    'count' => 0,
    'hierarchical' => 0,
    'dropdown' => 0,
  ),
  '_multiwidget' => 1,
);$widget_newsletter_widget = array (
  2 => 
  array (
    'title' => 'Newsletter',
    'show_name' => NULL,
    'news_letter_des' => '',
  ),
  '_multiwidget' => 1,
);$widget_em_widget = array (
  2 => 
  array (
    'title' => 'Events',
    'limit' => '5',
    'scope' => 'future',
    'orderby' => 'event_start_date,event_start_time,event_name',
    'order' => 'ASC',
    'category' => '0',
    'all_events_text' => 'all events',
    'format' => '<li>#_EVENTLINK<ul><li>#_EVENTDATES</li><li>#_LOCATIONTOWN</li></ul></li>',
    'no_events_text' => '<li>No events</li>',
    'nolistwrap' => false,
    'all_events' => 0,
  ),
  '_multiwidget' => 1,
);$widget_nav_menu = array (
  2 => 
  array (
    'title' => 'custom menu',
    'nav_menu' => 6,
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_products = array (
  2 => 
  array (
    'title' => 'Products',
    'number' => '5',
    'show' => '',
    'orderby' => 'date',
    'order' => 'desc',
    'hide_free' => 0,
    'show_hidden' => 0,
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_product_search = array (
  3 => 
  array (
    'title' => 'product search',
  ),
  '_multiwidget' => 1,
);$widget_post_slider_widget = array (
  2 => 
  array (
    'title' => 'POST SLIDER',
    'select_category' => 'blog',
  ),
  5 => 
  array (
    'title' => 'POST SLIDER',
    'select_category' => 'blog',
  ),
  7 => 
  array (
    'title' => 'POST SLIDER',
    'select_category' => 'widget',
  ),
  '_multiwidget' => 1,
);$widget_recent_event_widget = array (
  3 => 
  array (
    'title' => 'Upcoming Events',
    'recent_event_category' => '10',
    'number_of_events' => '3',
  ),
  5 => 
  array (
    'title' => ' UPCOMING EVENTS',
    'recent_event_category' => '10',
    'number_of_events' => ' 3',
  ),
  '_multiwidget' => 1,
);$widget_gallery_image_show = array (
  3 => 
  array (
    'wid_class' => '',
    'title' => 'Gallery widget',
    'select_gallery' => '545',
    'nofimages' => '8',
    'externallink' => NULL,
  ),
  '_multiwidget' => 1,
);$widget_quick_links_widget = array (
  2 => 
  array (
    'title' => ' Quick Links',
    'select_post_type' => 'Post',
    'number_of_posts' => ' 5',
  ),
  '_multiwidget' => 1,
);$sidebars_widgets=array (
  'custom-sidebar11' => 
  array (
    0 => 'layerslider_widget-2',
    1 => 'meta-3',
    2 => 'pages-3',
    3 => 'recent-comments-4',
    4 => 'recent-posts-2',
    5 => 'rss-3',
    6 => 'search-4',
    7 => 'tag_cloud-4',
    8 => 'woocommerce_widget_cart-3',
    9 => 'woocommerce_layered_nav-3',
    10 => 'woocommerce_layered_nav_filters-3',
    11 => 'woocommerce_price_filter-3',
    12 => 'woocommerce_product_categories-3',
    13 => 'woocommerce_product_tag_cloud-3',
    14 => 'woocommerce_recently_viewed_products-3',
    15 => 'woocommerce_recent_reviews-2',
    16 => 'woocommerce_top_rated_products-3',
  ),
  'wp_inactive_widgets' => 
  array (
  ),
  'sidebar-footer' => 
  array (
    0 => 'text-2',
    1 => 'recent_news_show-4',
    2 => 'twitter_widget-2',
    3 => 'flickr_widget-2',
  ),
  'custom-sidebar0' => 
  array (
    0 => 'text-3',
    1 => 'recent_news_show-2',
    2 => 'popular_post-5',
    3 => 'recent_news_news-2',
    4 => 'archives-2',
    5 => 'categories-2',
  ),
  'custom-sidebar1' => 
  array (
    0 => 'search-2',
    1 => 'newsletter_widget-2',
    2 => 'recent-comments-3',
    3 => 'em_widget-2',
    4 => 'popular_post-6',
    5 => 'nav_menu-2',
    6 => 'pages-2',
    7 => 'woocommerce_price_filter-2',
    8 => 'woocommerce_product_categories-2',
    9 => 'rss-2',
    10 => 'tag_cloud-2',
    11 => 'woocommerce_layered_nav_filters-2',
    12 => 'woocommerce_product_tag_cloud-2',
    13 => 'woocommerce_products-2',
    14 => 'woocommerce_product_search-3',
  ),
  'custom-sidebar2' => 
  array (
  ),
  'custom-sidebar3' => 
  array (
    0 => 'post_slider_widget-7',
  ),
  'custom-sidebar4' => 
  array (
    0 => 'text-4',
  ),
  'custom-sidebar5' => 
  array (
    0 => 'text-6',
    1 => 'popular_post-8',
    2 => 'tag_cloud-3',
  ),
  'custom-sidebar6' => 
  array (
    0 => 'text-5',
    1 => 'recent_news_show-7',
    2 => 'archives-5',
  ),
  'custom-sidebar7' => 
  array (
    0 => 'popular_post-7',
    1 => 'recent_event_widget-3',
    2 => 'post_slider_widget-2',
  ),
  'custom-sidebar8' => 
  array (
    0 => 'recent_event_widget-5',
  ),
  'custom-sidebar9' => 
  array (
    0 => 'text-7',
    1 => 'recent_news_show-6',
    2 => 'popular_post-9',
    3 => 'recent_news_news-4',
    4 => 'archives-4',
    5 => 'categories-4',
    6 => 'post_slider_widget-5',
  ),
  'custom-sidebar10' => 
  array (
    0 => 'gallery_image_show-3',
    1 => 'quick_links_widget-2',
    2 => 'recent_news_news-5',
    3 => 'popular_post-10',
  ),
  'array_version' => 3,
);
$show_on_front = 'page';
$page_on_front = 14;
$theme_mods_goodwill = array (
  0 => false,
  'nav_menu_locations' => 
  array (
    'top-menu' => 38,
    'header-menu' => 6,
  ),
);
		
			update_option('sidebars_widgets', $sidebars_widgets);
            update_option('widget_layerslider_widget', $widget_layerslider_widget);
            update_option('widget_meta', $widget_meta);
            update_option('widget_pages', $widget_pages);
            update_option('widget_recent', $widget_recent);
            update_option('widget_rss', $widget_rss);
            update_option('widget_search', $widget_search);
            update_option('widget_tag_cloud', $widget_tag_cloud);
			
            update_option('widget_woocommerce_widget_cart', $widget_woocommerce_widget_cart);
            update_option('widget_woocommerce_layered_nav', $widget_woocommerce_layered_nav);
			update_option('widget_woocommerce_layered_nav_filters', $widget_woocommerce_layered_nav_filters);
            update_option('widget_woocommerce_price_filter', $widget_woocommerce_price_filter);
            update_option('widget_woocommerce_product_categories', $widget_woocommerce_product_categories);
            update_option('widget_woocommerce_product_tag_cloud', $widget_woocommerce_product_tag_cloud);
            update_option('widget_woocommerce_recently_viewed_products', $widget_woocommerce_recently_viewed_products);
            update_option('widget_woocommerce_recent_reviews', $widget_woocommerce_recent_reviews);
            update_option('widget_woocommerce_top_rated_products', $widget_woocommerce_top_rated_products);
            
			update_option('widget_text', $widget_text);
            update_option('widget_recent_news_show', $widget_recent_news_show);
			update_option('widget_twitter_widget', $widget_twitter_widget);
            update_option('widget_flickr_widget', $widget_flickr_widget);
            update_option('widget_popular_post', $widget_popular_post);
            update_option('widget_recent_news_news', $widget_recent_news_news);
            update_option('widget_archives', $widget_archives);
            update_option('widget_categories', $widget_categories);
            update_option('widget_newsletter_widget', $widget_newsletter_widget);
			
			update_option('widget_em_widget', $widget_em_widget);
            update_option('widget_nav_menu', $widget_nav_menu);
			update_option('widget_woocommerce_products', $widget_woocommerce_products);
			
			update_option('widget_woocommerce_product_search', $widget_woocommerce_product_search);
            update_option('widget_post_slider_widget', $widget_post_slider_widget);
            update_option('widget_recent_event_widget', $widget_recent_event_widget);
            update_option('widget_gallery_image_show', $widget_gallery_image_show);
			update_option('widget_quick_links_widget', $widget_quick_links_widget);
		

            //Default Widgets
            update_option('show_on_front', $show_on_front);
            update_option('page_on_front', $page_on_front);
            update_option('theme_mods_goodwill', $theme_mods_goodwill);
			
			

        } else if ($cp_layout == 'dummy_xml_2.xml') {
            
			$widget_facebook_widget = array (
  2 => 
  array (
    'title' => 'FACEBOOK',
    'pageurl' => 'https://www.facebook.com/crunchpress.themes',
    'showfaces' => 'true',
    'showstream' => 'false',
    'showheader' => NULL,
    'likebox_width' => '250',
    'likebox_height' => '250',
  ),
  '_multiwidget' => 1,
);$widget_tag_cloud = array (
  2 => 
  array (
    'title' => 'TAGS',
    'taxonomy' => 'post_tag',
  ),
  3 => 
  array (
    'title' => 'TAGS',
    'taxonomy' => 'post_tag',
  ),
  '_multiwidget' => 1,
);$widget_quick_links_widget = array (
  2 => 
  array (
    'title' => ' QUICK LINKS',
    'select_post_type' => 'Post',
    'number_of_posts' => ' 6',
  ),
  '_multiwidget' => 1,
);$widget_text = array (
  2 => 
  array (
    'title' => '',
    'text' => '<div class="box">
<h2><span>Good</span>will</h2>
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making. it look like readable English. Many desktop publishing packages.</p>
<a href="#" class="btn-5">Read More</a> </div>',
    'filter' => false,
  ),
  3 => 
  array (
    'title' => '',
    'text' => '<div class="box">
<h2>Contact</h2>
<address>
<p>The Church Branch,
123 Lorem Ipsum Avenue, New York
United States, 012345 </p>
<ul>
<li><i class="fa fa-phone"></i>0123 456 7890</li>
<li><i class="fa fa-print"></i>0123 456 7890</li>
<li><a href="mailto:"><i class="fa fa-envelope-o"></i>info@goodwill/church.com</a></li>
<li><i class="fa fa-skype"></i>0123 456 7890</li>
</ul>
</address>
</div>',
    'filter' => false,
  ),
  4 => 
  array (
    'title' => 'Text Widget',
    'text' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>',
    'filter' => false,
  ),
  5 => 
  array (
    'title' => 'TEXT WIDGET',
    'text' => '<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>',
    'filter' => false,
  ),
  '_multiwidget' => 1,
);$widget_recent_news_show = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Recent Posts',
    'recent_post_category' => 'recent-posts',
    'number_of_news' => '3',
  ),
  3 => 
  array (
    'wid_class' => '',
    'title' => 'Recent Posts',
    'recent_post_category' => 'crowdfunding',
    'number_of_news' => '3',
  ),
  '_multiwidget' => 1,
);$widget_twitter_widget = array (
  2 => 
  array (
    'title' => 'TWEETS',
    'consumer_key' => '1iUu8muQcbDfv4UAp58rXw',
    'consumer_secret' => 'am535ByNUMFFo8vHQtpkVpgdJz9QgcW4FpWaGDvH5Xw',
    'user_token' => '88209931-h16p4dNkvaXe0UQTRAx8zzPcWgl3L7rXj2XDOT5c2',
    'user_secret' => '3ugAtUwyrCcXK99xleZssr2OkiwVymoB2ceFwknYwLk',
    'username_widget' => 'mosque_crunchpress',
    'num_of_tweets' => '1',
  ),
  '_multiwidget' => 1,
);$widget_newsletter_widget = array (
  2 => 
  array (
    'title' => 'GET CONNECTED',
    'show_name' => NULL,
    'news_letter_des' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.
',
  ),
  '_multiwidget' => 1,
);$widget_popular_post = array (
  2 => 
  array (
    'title' => 'Popular Posts',
    'get_cate_posts' => NULL,
    'nop' => '3',
  ),
  3 => 
  array (
    'title' => 'Popular Posts',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  '_multiwidget' => 1,
);$widget_recent_news_news = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Latest News',
    'recent_post_category' => 'crowdfunding',
    'number_of_news' => '3',
  ),
  '_multiwidget' => 1,
);$sidebars_widgets=array (
  'wp_inactive_widgets' => 
  array (
  ),
  'sidebar-footer' => 
  array (
    0 => 'facebook_widget-2',
    1 => 'tag_cloud-2',
    2 => 'quick_links_widget-2',
    3 => 'text-3',
  ),
  'sidebar-upper-footer' => 
  array (
    0 => 'text-2',
    1 => 'recent_news_show-2',
    2 => 'twitter_widget-2',
    3 => 'newsletter_widget-2',
  ),
  'custom-sidebar0' => 
  array (
    0 => 'text-4',
    1 => 'recent_news_show-3',
    2 => 'popular_post-2',
    3 => 'recent_news_news-2',
  ),
  'custom-sidebar1' => 
  array (
  ),
  'custom-sidebar2' => 
  array (
  ),
  'custom-sidebar3' => 
  array (
  ),
  'custom-sidebar4' => 
  array (
  ),
  'custom-sidebar5' => 
  array (
  ),
  'custom-sidebar6' => 
  array (
    0 => 'text-5',
    1 => 'popular_post-3',
    2 => 'tag_cloud-3',
  ),
  'array_version' => 3,
);
$show_on_front = 'page';
$page_on_front = 4;
$theme_mods_goodwill = array (
  0 => false,
  'nav_menu_locations' => 
  array (
    'header-menu' => 14,
  ),
);


            //Widgets
            update_option('sidebars_widgets', $sidebars_widgets);
            update_option('widget_facebook_widget', $widget_facebook_widget);
            update_option('widget_tag_cloud', $widget_tag_cloud);
            update_option('widget_quick_links_widget', $widget_quick_links_widget);
            update_option('widget_text', $widget_text);
            update_option('widget_recent_news_show', $widget_recent_news_show);
            update_option('widget_twitter_widget', $widget_twitter_widget);
            update_option('widget_newsletter_widget', $widget_newsletter_widget);
            update_option('widget_popular_post', $widget_popular_post);
            update_option('widget_recent_news_news', $widget_recent_news_news);
            
            //Default Widgets
            update_option('show_on_front', $show_on_front);
            update_option('page_on_front', $page_on_front);
            update_option('theme_mods_goodwill', $theme_mods_goodwill);
            
        } else if ($cp_layout == 'dummy_xml_3.xml') {
            $widget_facebook_widget     = array(
                2 => array(
                    'title' => 'FACEBOOK',
                    'pageurl' => 'https://www.facebook.com/crunchpress.themes',
                    'showfaces' => 'true',
                    'showstream' => 'false',
                    'showheader' => NULL,
                    'likebox_width' => '250',
                    'likebox_height' => '250'
                ),
                '_multiwidget' => 1
            );
            $widget_tag_cloud           = array(
                2 => array(
                    'title' => 'TAGS',
                    'taxonomy' => 'post_tag'
                ),
                3 => array(
                    'title' => 'TAGS',
                    'taxonomy' => 'post_tag'
                ),
                '_multiwidget' => 1
            );
            $widget_quick_links_widget  = array(
                2 => array(
                    'title' => ' QUICK LINKS',
                    'select_post_type' => 'Post',
                    'number_of_posts' => '6'
                ),
                '_multiwidget' => 1
            );
            $widget_text                = array(
                2 => array(
                    'title' => '',
                    'text' => '<div class="sidebar-bix-1"><h3>Text Widget</h3><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p></div>',
                    'filter' => false
                ),
                3 => array(
                    'title' => '',
                    'text' => '<div class="box"><h2><span>Good</span>will</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p><p>It look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.</p></div>',
                    'filter' => false
                ),
                4 => array(
                    'title' => '',
                    'text' => '<div class="box"><h2>Contact</h2><address><p>The Church Branch,123 Lorem Ipsum Avenue, New YorkUnited States, 012345 </p><ul><li><i class="fa fa-phone"></i>0123 456 7890</li><li><i class="fa fa-print"></i>0123 456 7890</li><li><a href="mailto:"><i class="fa fa-envelope-o"></i>info@goodwill/church.com</a></li><li><i class="fa fa-skype"></i>0123 456 7890</li></ul></address></div>',
                    'filter' => false
                ),
                5 => array(
                    'title' => '',
                    'text' => '<div class="sidebar-bix-1"><h3>Text Widget</h3><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p></div>',
                    'filter' => false
                ),
                6 => array(
                    'title' => '',
                    'text' => '<div class="sidebar-bix-1"><h3>Text Widget</h3><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p></div>',
                    'filter' => false
                ),
                '_multiwidget' => 1
            );
            $widget_recent_news_show    = array(
                2 => array(
                    'wid_class' => '',
                    'title' => 'Recent Posts',
                    'recent_post_category' => 'blog',
                    'number_of_news' => '4'
                ),
                3 => array(
                    'wid_class' => '',
                    'title' => 'RECENT POSTS',
                    'recent_post_category' => 'blog',
                    'number_of_news' => '3'
                ),
                4 => array(
                    'wid_class' => '',
                    'title' => 'Recent Posts',
                    'recent_post_category' => 'blog',
                    'number_of_news' => '4'
                ),
                '_multiwidget' => 1
            );
            $widget_twitter_widget      = array(
                2 => array(
                    'title' => 'Tweets',
                    'consumer_key' => '1iUu8muQcbDfv4UAp58rXw',
                    'consumer_secret' => 'am535ByNUMFFo8vHQtpkVpgdJz9QgcW4FpWaGDvH5Xw',
                    'user_token' => '88209931-h16p4dNkvaXe0UQTRAx8zzPcWgl3L7rXj2XDOT5c2',
                    'user_secret' => '3ugAtUwyrCcXK99xleZssr2OkiwVymoB2ceFwknYwLk',
                    'username_widget' => 'mosque_crunchpress',
                    'num_of_tweets' => '3'
                ),
                '_multiwidget' => 1
            );
            $widget_flickr_widget       = array(
                2 => array(
                    'title' => ' Flickr Photos',
                    'type' => 'user',
                    'flickr_id' => '68030678@N04',
                    'count' => ' 9',
                    'display' => 'latest',
                    'size' => 'latest',
                    'copyright' => NULL
                ),
                '_multiwidget' => 1
            );
            $widget_popular_post        = array(
                2 => array(
                    'title' => 'Popular Posts',
                    'get_cate_posts' => NULL,
                    'nop' => '4'
                ),
                3 => array(
                    'title' => 'POPULAR POSTS',
                    'get_cate_posts' => NULL,
                    'nop' => '4'
                ),
                4 => array(
                    'title' => 'Popular Posts',
                    'get_cate_posts' => NULL,
                    'nop' => '4'
                ),
                5 => array(
                    'title' => 'Latest Sermons',
                    'get_cate_posts' => NULL,
                    'nop' => '4'
                ),
                '_multiwidget' => 1
            );
            $widget_cp_crowd_funding    = array(
                2 => array(
                    'wid_class' => '',
                    'title' => 'Causes',
                    'recent_post_category' => 'crowdfunding',
                    'number_of_news' => '3'
                ),
                3 => array(
                    'wid_class' => '',
                    'title' => 'CAUSES',
                    'recent_post_category' => 'crowdfunding',
                    'number_of_news' => '3'
                ),
                '_multiwidget' => 1
            );
            $widget_recent_news_news    = array(
                2 => array(
                    'wid_class' => '',
                    'title' => 'Latest News',
                    'recent_post_category' => 'blog',
                    'number_of_news' => '4'
                ),
                '_multiwidget' => 1
            );
            $widget_archives            = array(
                3 => array(
                    'title' => 'Archives',
                    'count' => 0,
                    'dropdown' => 0
                ),
                4 => array(
                    'title' => 'Archives',
                    'count' => 0,
                    'dropdown' => 0
                ),
                5 => array(
                    'title' => 'Archives',
                    'count' => 0,
                    'dropdown' => 0
                ),
                '_multiwidget' => 1
            );
            $widget_categories          = array(
                3 => array(
                    'title' => 'Categories',
                    'count' => 0,
                    'hierarchical' => 0,
                    'dropdown' => 0
                ),
                4 => array(
                    'title' => 'Categories',
                    'count' => 0,
                    'hierarchical' => 0,
                    'dropdown' => 0
                ),
                5 => array(
                    'title' => 'Categories',
                    'count' => 0,
                    'hierarchical' => 0,
                    'dropdown' => 0
                ),
                '_multiwidget' => 1
            );
            $widget_recent_event_widget = array(
                2 => array(
                    'title' => 'UpComing Events',
                    'recent_event_category' => '19',
                    'number_of_events' => '4'
                ),
                3 => array(
                    'title' => 'Upcoming Events',
                    'recent_event_category' => '19',
                    'number_of_events' => '3'
                ),
                4 => array(
                    'title' => 'Upcoming Events',
                    'recent_event_category' => '19',
                    'number_of_events' => ' 3'
                ),
                5 => array(
                    'title' => ' Upcoming Events',
                    'recent_event_category' => '19',
                    'number_of_events' => '3'
                ),
                '_multiwidget' => 1
            );
            $widget_post_slider_widget  = array(
                1 => array(),
                2 => array(
                    'title' => '',
                    'select_category' => 'blog'
                ),
                3 => array(
                    'title' => 'Post Slider',
                    'select_category' => 'blog'
                ),
                4 => array(
                    'title' => 'Post Slider',
                    'select_category' => 'blog'
                ),
                '_multiwidget' => 1
            );
            $widget_recent              = false;
            $widget_calendar            = array(
                2 => array(
                    'title' => 'Calender'
                ),
                '_multiwidget' => 1
            );
            $widget_em_widget           = array(
                2 => array(
                    'title' => 'Upcoming Events',
                    'limit' => '2',
                    'scope' => 'future',
                    'orderby' => 'event_start_date,event_start_time,event_name',
                    'order' => 'ASC',
                    'category' => '0',
                    'all_events_text' => 'all events',
                    'format' => '<li>#_EVENTLINK<ul><li>#_EVENTDATES</li><li>#_LOCATIONTOWN</li></ul></li>',
                    'nolistwrap' => false,
                    'all_events' => 0,
                    'no_events_text' => '<li>No events</li>'
                ),
                '_multiwidget' => 1
            );
            $sidebars_widgets           = array(
                'wp_inactive_widgets' => array(),
                'sidebar-footer' => array(
                    0 => 'facebook_widget-2',
                    1 => 'tag_cloud-2',
                    2 => 'quick_links_widget-2',
                    3 => 'text-4'
                ),
                'sidebar-upper-footer' => array(
                    0 => 'text-3',
                    1 => 'recent_news_show-3',
                    2 => 'twitter_widget-2',
                    3 => 'flickr_widget-2'
                ),
                'custom-sidebar0' => array(
                    0 => 'text-2',
                    1 => 'recent_news_show-2',
                    2 => 'popular_post-2',
                    3 => 'cp_crowd_funding-2',
                    4 => 'recent_news_news-2',
                    5 => 'archives-4',
                    6 => 'categories-4',
                    7 => 'recent_event_widget-2',
                    8 => 'post_slider_widget-3'
                ),
                'custom-sidebar1' => array(
                    0 => 'recent-posts-3',
                    1 => 'archives-3',
                    2 => 'calendar-2',
                    3 => 'categories-3',
                    4 => 'em_widget-2'
                ),
                'custom-sidebar2' => array(),
                'custom-sidebar3' => array(),
                'custom-sidebar4' => array(),
                'custom-sidebar5' => array(
                    0 => 'text-5',
                    1 => 'recent_event_widget-4',
                    2 => 'popular_post-4',
                    3 => 'tag_cloud-3'
                ),
                'custom-sidebar6' => array(
                    0 => 'cp_crowd_funding-3',
                    1 => 'popular_post-3',
                    2 => 'recent_event_widget-3',
                    3 => 'post_slider_widget-2'
                ),
                'custom-sidebar7' => array(
                    0 => 'recent_event_widget-5'
                ),
                'custom-sidebar8' => array(
                    0 => 'text-6',
                    1 => 'popular_post-5',
                    2 => 'recent_news_show-4',
                    3 => 'archives-5',
                    4 => 'categories-5',
                    5 => 'post_slider_widget-4'
                ),
                'array_version' => 3
            );
            $show_on_front              = 'page';
            $page_on_front              = 176;
            $theme_mods_goodwill        = array(
                0 => false,
                'nav_menu_locations' => array(
                    'header-menu' => 38
                )
            );
            
            //Widgets
            update_option('sidebars_widgets', $sidebars_widgets);
            update_option('widget_facebook_widget', $widget_facebook_widget);
            update_option('widget_tag_cloud', $widget_tag_cloud);
            update_option('widget_quick_links_widget', $widget_quick_links_widget);
            update_option('widget_text', $widget_text);
            update_option('widget_recent_news_show', $widget_recent_news_show);
            update_option('widget_twitter_widget', $widget_twitter_widget);
            update_option('widget_flickr_widget', $widget_flickr_widget);
            update_option('widget_popular_post', $widget_popular_post);
            update_option('widget_cp_crowd_funding', $widget_cp_crowd_funding);
            update_option('widget_recent_news_news', $widget_recent_news_news);
            update_option('widget_archives', $widget_archives);
            update_option('widget_categories', $widget_categories);
            update_option('widget_recent_event_widget', $widget_recent_event_widget);
            update_option('widget_post_slider_widget', $widget_post_slider_widget);
            update_option('widget_recent', $widget_recent);
            update_option('widget_calendar', $widget_calendar);
            update_option('widget_em_widget', $widget_em_widget);
            
            //Default Widgets
            update_option('show_on_front', $show_on_front);
            update_option('page_on_front', $page_on_front);
            update_option('theme_mods_goodwill', $theme_mods_goodwill);
        } else if ($cp_layout == 'dummy_xml_4.xml') {
            $widget_text                = array(
                2 => array(
                    'title' => '',
                    'text' => '<div class="box">              <h2><span>Good</span>will</h2>              <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The using \'Content here, content here\', making readable content of a page when looking at its layout.</p>              <p>t look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.</p>            </div>',
                    'filter' => false
                ),
                3 => array(
                    'title' => '',
                    'text' => '<div class="sidebar-bix-1"><h3>Text Widget</h3><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p></div>',
                    'filter' => false
                ),
                4 => array(
                    'title' => '',
                    'text' => '<div class="sidebar-bix-1"><h3>Text Widget</h3><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p></div>',
                    'filter' => false
                ),
                '_multiwidget' => 1
            );
            $widget_recent_news_show    = array(
                2 => array(
                    'wid_class' => '',
                    'title' => 'Recent Posts',
                    'recent_post_category' => 'blog',
                    'number_of_news' => '3'
                ),
                3 => array(
                    'wid_class' => '',
                    'title' => 'Recent Posts',
                    'recent_post_category' => 'blog',
                    'number_of_news' => '4'
                ),
                '_multiwidget' => 1
            );
            $widget_twitter_widget      = array(
                2 => array(
                    'title' => 'TWEETS',
                    'consumer_key' => 'LiNR6cJamz1oTq76YCmOCg',
                    'consumer_secret' => '7DziOUahT3cVHjUFZdv9DWGYxgs3dThwQdlxhlBLRo',
                    'user_token' => '95420785-lc52fpbTrJYM02imucymoidZ0xzHabkWP5wEcbXkB',
                    'user_secret' => 'vm642ki1HnOSMw6DTUPW8SrVcUaqCSsVolUhTssGI',
                    'username_widget' => 'mosque_crunchpress',
                    'num_of_tweets' => '2'
                ),
                '_multiwidget' => 1
            );
            $widget_flickr_widget       = array(
                2 => array(
                    'title' => 'FLICKR PHOTOS',
                    'type' => 'user',
                    'flickr_id' => '48508968@N00',
                    'count' => '9',
                    'display' => 'latest',
                    'size' => 'latest',
                    'copyright' => NULL
                ),
                '_multiwidget' => 1
            );
            $widget_cp_crowd_funding    = array(
                2 => array(
                    'wid_class' => '',
                    'title' => 'Causes',
                    'recent_post_category' => '',
                    'number_of_news' => '3'
                ),
                3 => array(
                    'wid_class' => '',
                    'title' => 'Causes',
                    'recent_post_category' => 'evironment',
                    'number_of_news' => '3'
                ),
                '_multiwidget' => 1
            );
            $widget_popular_post        = array(
                2 => array(
                    'title' => 'Popular Posts',
                    'get_cate_posts' => NULL,
                    'nop' => '4'
                ),
                3 => array(
                    'title' => 'Popular Posts',
                    'get_cate_posts' => NULL,
                    'nop' => '4'
                ),
                4 => array(
                    'title' => 'Popular Posts',
                    'get_cate_posts' => NULL,
                    'nop' => '4'
                ),
                '_multiwidget' => 1
            );
            $widget_recent_news_news    = array(
                2 => array(
                    'wid_class' => '',
                    'title' => 'Latest News',
                    'recent_post_category' => 'blog',
                    'number_of_news' => '4'
                ),
                '_multiwidget' => 1
            );
            $widget_archives            = array(
                2 => array(
                    'title' => 'Archives',
                    'count' => 0,
                    'dropdown' => 0
                ),
                '_multiwidget' => 1
            );
            $widget_categories          = array(
                2 => array(
                    'title' => 'Categories',
                    'count' => 0,
                    'hierarchical' => 0,
                    'dropdown' => 0
                ),
                '_multiwidget' => 1
            );
            $widget_recent_event_widget = array(
                2 => array(
                    'title' => 'UpComing Events',
                    'recent_event_category' => '14',
                    'number_of_events' => '4'
                ),
                3 => array(
                    'title' => 'UPCOMING EVENTS',
                    'recent_event_category' => '14',
                    'number_of_events' => ' 3'
                ),
                4 => array(
                    'title' => 'UPCOMING EVENTS',
                    'recent_event_category' => '14',
                    'number_of_events' => '3'
                ),
                5 => array(
                    'title' => 'Upcoming Events',
                    'recent_event_category' => '14',
                    'number_of_events' => '3'
                ),
                '_multiwidget' => 1
            );
            $widget_post_slider_widget  = array(
                2 => array(
                    'title' => 'Post Slider',
                    'select_category' => 'blog'
                ),
                3 => array(
                    'title' => 'Post Slider',
                    'select_category' => 'blog'
                ),
                '_multiwidget' => 1
            );
            $widget_tag_cloud           = array(
                2 => array(
                    'title' => 'TAGS',
                    'taxonomy' => 'post_tag'
                ),
                '_multiwidget' => 1
            );
            $sidebars_widgets           = array(
                'wp_inactive_widgets' => array(),
                'sidebar-footer' => array(
                    0 => 'text-2',
                    1 => 'recent_news_show-2',
                    2 => 'twitter_widget-2',
                    3 => 'flickr_widget-2'
                ),
                'custom-sidebar0' => array(
                    0 => 'text-3',
                    1 => 'recent_news_show-3',
                    2 => 'cp_crowd_funding-2',
                    3 => 'popular_post-3',
                    4 => 'recent_news_news-2',
                    5 => 'archives-2',
                    6 => 'categories-2',
                    7 => 'recent_event_widget-2',
                    8 => 'post_slider_widget-3'
                ),
                'custom-sidebar1' => array(),
                'custom-sidebar2' => array(),
                'custom-sidebar3' => array(),
                'custom-sidebar4' => array(),
                'custom-sidebar5' => array(
                    0 => 'text-4',
                    1 => 'popular_post-4',
                    2 => 'recent_event_widget-5',
                    3 => 'tag_cloud-2'
                ),
                'custom-sidebar6' => array(
                    0 => 'cp_crowd_funding-3',
                    1 => 'popular_post-2',
                    2 => 'recent_event_widget-3',
                    3 => 'post_slider_widget-2'
                ),
                'custom-sidebar7' => array(
                    0 => 'recent_event_widget-4'
                ),
                'array_version' => 3
            );
            $show_on_front              = 'page';
            $page_on_front              = 10;
            $theme_mods_goodwill        = array(
                0 => false,
                'nav_menu_locations' => array(
                    'header-menu' => 17,
                    'top-menu' => 25
                )
            );
            //Widgets
            update_option('sidebars_widgets', $sidebars_widgets);
            update_option('widget_text', $widget_text);
            update_option('widget_recent_news_show', $widget_recent_news_show);
            update_option('widget_twitter_widget', $widget_twitter_widget);
            update_option('widget_flickr_widget', $widget_flickr_widget);
            update_option('widget_cp_crowd_funding', $widget_cp_crowd_funding);
            update_option('widget_popular_post', $widget_popular_post);
            update_option('widget_recent_news_news', $widget_recent_news_news);
            update_option('widget_archives', $widget_archives);
            update_option('widget_categories', $widget_categories);
            update_option('widget_recent_event_widget', $widget_recent_event_widget);
            update_option('widget_post_slider_widget', $widget_post_slider_widget);
            update_option('widget_tag_cloud', $widget_tag_cloud);
            //Default Widgets
            update_option('show_on_front', $show_on_front);
            update_option('page_on_front', $page_on_front);
            update_option('theme_mods_goodwill', $theme_mods_goodwill);
            
        } else if ($cp_layout == 'dummy_xml_5.xml') { //Islamic Version
           
$widget_cp_facebook_widget = array (
  2 => 
  array (
    'title' => 'Facebook',
    'pageurl' => 'https://www.facebook.com/crunchpress.themes',
    'showfaces' => 'true',
    'showstream' => 'false',
    'showheader' => NULL,
    'likebox_width' => '250',
    'likebox_height' => '250',
  ),
  '_multiwidget' => 1,
);$widget_tag_cloud = array (
  2 => 
  array (
    'title' => 'Tags',
    'taxonomy' => 'post_tag',
  ),
  3 => 
  array (
    'title' => 'TAGS',
    'taxonomy' => 'post_tag',
  ),
  4 => 
  array (
    'title' => 'Tags',
    'taxonomy' => 'post_tag',
  ),
  5 => 
  array (
    'title' => 'Product Tags',
    'taxonomy' => 'product_tag',
  ),
  6 => 
  array (
    'title' => 'Tags',
    'taxonomy' => 'post_tag',
  ),
  '_multiwidget' => 1,
);$widget_cp_quick_links_widget = array (
  2 => 
  array (
    'title' => ' Quick Links',
    'select_post_type' => 'Post',
    'number_of_posts' => ' 6',
  ),
  3 => 
  array (
    'title' => '  Quick Links',
    'select_post_type' => 'Event',
    'number_of_posts' => ' 5',
  ),
  4 => 
  array (
    'title' => '  Quick Links',
    'select_post_type' => 'Product',
    'number_of_posts' => ' 6',
  ),
  '_multiwidget' => 1,
);$widget_text = array (
  2 => 
  array (
    'title' => '',
    'text' => '<div class="box">
                <h2>Contact</h2>
                <address>
                <p>The Church Branch,<br>
                  123 Lorem Ipsum Avenue, New York
                  United States, 012345 </p>
                <ul>
                  <li><i class="fa fa-phone"></i>0123 456 7890</li>
                  <li><i class="fa fa-print"></i>0123 456 7890</li>
                  <li><a href="mailto:info@mosque.com"><i class="fa fa-envelope-o"></i>info@mosque.com</a></li>
                  <li><i class="fa fa-skype"></i>0123 456 7890</li>
                </ul>
                </address>
              </div>',
    'filter' => false,
  ),
  3 => 
  array (
    'title' => '',
    'text' => '<div class="sidebar-bix-1">
<h3>Text Widget</h3>
<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>
</div>',
    'filter' => false,
  ),
  4 => 
  array (
    'title' => '',
    'text' => '<div class="contact-1 contact-2">
            <h3>Main Head Office</h3>
            <address>
            <p>The Islamic Mosque,
              123 Lorem Ipsum Avenue, New York
              United States, 012345</p>
            <ul>
              <li><i class="fa fa-phone"></i>0123 456 7890</li>
              <li><i class="fa fa-print"></i>0123 456 7890</li>
              <li><a href="#"><i class="fa fa-envelope-o"></i>info@mosque.com</a></li>
              <li><i class="fa fa-skype"></i>0123 456 7890</li>
            </ul>
            </address>
            <h3>Liaison Office</h3>
            <address class="border-none">
            <p>The Islamic Mosque,
              123 Lorem Ipsum Avenue, New York
              United States, 012345</p>
            <ul>
              <li><i class="fa fa-phone"></i>0123 456 7890</li>
              <li><i class="fa fa-print"></i>0123 456 7890</li>
              <li><a href="#"><i class="fa fa-envelope-o"></i>info@mosque.com</a></li>
              <li><i class="fa fa-skype"></i>0123 456 7890</li>
            </ul>
            </address>
          </div>',
    'filter' => false,
  ),
  5 => 
  array (
    'title' => '',
    'text' => '<div class="box">
             
                <address>
                <p>Islamic Center Branch,
                  123 Lorem Ipsum Avenue, New York
                  United States, 012345 </p>
                <ul>
                  <li><i class="fa fa-phone"></i>0123 456 7890</li>
                  <li><i class="fa fa-print"></i>0123 456 7890</li>
                  <li><a href="mailto:"><i class="fa fa-envelope-o"></i>info@mosque.com</a></li>
                  <li><i class="fa fa-skype"></i>0123 456 7890</li>
                </ul>
                </address>
              </div>',
    'filter' => false,
  ),
  6 => 
  array (
    'title' => '',
    'text' => '<br/>
<div class="widget sidebar_section sidebar-recent-post widget_archive"><h3>Shortcodes</h3>		
<ul>
	<li><a href="http://crunchpress.com/demo/mosque/?page_id=404">>> Typography</a></li>
	<li><a href="http://crunchpress.com/demo/mosque/?page_id=424">>> Table Layout</a></li>
	<li><a href="http://crunchpress.com/demo/mosque/?page_id=428">>> Google Maps</a></li>
	<li><a href="http://crunchpress.com/demo/mosque/?page_id=445">>> Block Quotes</a></li>
	<li><a href="http://crunchpress.com/demo/mosque/?page_id=453">>> Columns</a></li>

<li><a href="http://crunchpress.com/demo/mosque/?page_id=469">>> Content Box</a></li>


<li><a href="http://crunchpress.com/demo/mosque/?page_id=540">>> Alert Box</a></li>


<li><a href="http://crunchpress.com/demo/mosque/?page_id=578">>> Highlight</a></li>
		</ul>
</div>',
    'filter' => false,
  ),
  '_multiwidget' => 1,
);$widget_cp_recent_news_show = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Recent News',
    'recent_post_category' => 'blog',
    'number_of_news' => '3',
  ),
  '_multiwidget' => 1,
);$widget_cp_popular_post = array (
  2 => 
  array (
    'title' => 'Popular Posts',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  3 => 
  array (
    'title' => 'Popular Posts',
    'get_cate_posts' => NULL,
    'nop' => '3',
  ),
  '_multiwidget' => 1,
);$widget_cp_recent_news_news = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Latest News',
    'recent_post_category' => 'blog',
    'number_of_news' => '3',
  ),
  '_multiwidget' => 1,
);$widget_cp_recent_event_widget = array (
  2 => 
  array (
    'title' => '  UpComing Events',
    'recent_event_category' => '18',
    'number_of_events' => ' 3',
  ),
  3 => 
  array (
    'title' => '  Upcoming Events',
    'recent_event_category' => '18',
    'number_of_events' => ' 2',
  ),
  '_multiwidget' => 1,
);$widget_gallery_image_show = array (
  3 => 
  array (
    'wid_class' => '',
    'title' => 'Islamic Gallery',
    'select_gallery' => '104',
    'nofimages' => '9',
    'externallink' => NULL,
  ),
  4 => 
  array (
    'wid_class' => '',
    'title' => 'Islamic Gallery',
    'select_gallery' => '472',
    'nofimages' => '9',
    'externallink' => NULL,
  ),
  5 => 
  array (
    'wid_class' => '',
    'title' => 'Gallery Pictures',
    'select_gallery' => '472',
    'nofimages' => '9',
    'externallink' => NULL,
  ),
  6 => 
  array (
    'wid_class' => '',
    'title' => 'Gallery',
    'select_gallery' => '472',
    'nofimages' => '9',
    'externallink' => NULL,
  ),
  '_multiwidget' => 1,
);$widget_calendar = array (
  2 => 
  array (
    'title' => 'Calendar',
  ),
  '_multiwidget' => 1,
);$widget_search = array (
  2 => 
  array (
    'title' => '',
  ),
  '_multiwidget' => 1,
);$widget_categories = array (
  2 => 
  array (
    'title' => 'Categories',
    'count' => 1,
    'hierarchical' => 0,
    'dropdown' => 0,
  ),
  '_multiwidget' => 1,
);$widget_archives = array (
  5 => 
  array (
    'title' => '',
    'count' => 0,
    'dropdown' => 0,
  ),
  6 => 
  array (
    'title' => 'Archives',
    'count' => 1,
    'dropdown' => 0,
  ),
  '_multiwidget' => 1,
);$sidebars_widgets=array (
  'wp_inactive_widgets' => 
  array (
    0 => 'twitter_widget-4',
    1 => 'cp_crowd_funding-2',
    2 => 'cp_crowd_funding-3',
    3 => 'archives-5',
    4 => 'tag_cloud-2',
    5 => 'tag_cloud-3',
    6 => 'twitter_widget-2',
    7 => 'twitter_widget-3',
  ),
  'sidebar-footer' => 
  array (
    0 => 'cp_facebook_widget-2',
    1 => 'tag_cloud-4',
    2 => 'cp_quick_links_widget-2',
    3 => 'text-2',
  ),
  'custom-sidebar0' => 
  array (
    0 => 'text-3',
    1 => 'cp_recent_news_show-2',
    2 => 'cp_popular_post-2',
    3 => 'cp_recent_news_news-2',
    4 => 'cp_recent_event_widget-2',
  ),
  'custom-sidebar1' => 
  array (
  ),
  'custom-sidebar2' => 
  array (
    0 => 'text-4',
  ),
  'custom-sidebar3' => 
  array (
    0 => 'cp_popular_post-3',
    1 => 'gallery_image_show-5',
    2 => 'cp_quick_links_widget-3',
    3 => 'cp_recent_event_widget-3',
  ),
  'custom-sidebar4' => 
  array (
    0 => 'cp_quick_links_widget-4',
    1 => 'gallery_image_show-3',
    2 => 'tag_cloud-5',
    3 => 'text-5',
  ),
  'custom-sidebar5' => 
  array (
    0 => 'text-6',
  ),
  'custom-sidebar6' => 
  array (
    0 => 'gallery_image_show-4',
    1 => 'calendar-2',
    2 => 'tag_cloud-6',
  ),
  'custom-sidebar7' => 
  array (
  ),
  'custom-sidebar8' => 
  array (
    0 => 'search-2',
    1 => 'categories-2',
    2 => 'archives-6',
    3 => 'gallery_image_show-6',
  ),
  'array_version' => 3,
);
$show_on_front = 'page';
$page_on_front = 862;
$theme_mods_mosque = array (
  0 => false,
  'nav_menu_locations' => 
  array (
    'header-menu' => 34,
    'top-menu' => 40,
  ),
);

            //Widgets
            update_option('sidebars_widgets', $sidebars_widgets);
			update_option('widget_facebook_widget', $widget_cp_facebook_widget);
            update_option('widget_tag_cloud', $widget_tag_cloud);
            update_option('widget_quick_links_widget', $widget_cp_quick_links_widget);
            update_option('widget_text', $widget_text);
            update_option('widget_recent_news_show', $widget_cp_recent_news_show);
            update_option('widget_popular_post', $widget_cp_popular_post);
            update_option('widget_recent_news_news', $widget_cp_recent_news_news);
            update_option('widget_recent_event_widget', $widget_cp_recent_event_widget);
            update_option('widget_gallery_image_show', $widget_gallery_image_show);
			update_option('widget_calendar', $widget_calendar);
			update_option('widget_search', $widget_search);
			update_option('widget_categories', $widget_categories);
            update_option('widget_archives', $widget_archives);

            //Default Widgets
            update_option('show_on_front', $show_on_front);
            update_option('page_on_front', $page_on_front);
            update_option('theme_mods_mosque', $theme_mods_mosque);
            
        } else if ($cp_layout == 'dummy_xml_6.xml') { // Store Version		
            
         $widget_text = array (
  2 => 
  array (
    'title' => '',
    'text' => '<h2><span>Good</span>will</h2>
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
<p>t look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.</p>',
    'filter' => false,
  ),
  3 => 
  array (
    'title' => '',
    'text' => '<div class="sidebar-bix-1">
<h3>Text Widget</h3>
<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>
</div>',
    'filter' => false,
  ),
  4 => 
  array (
    'title' => '',
    'text' => '<div class="sidebar-bix-1">
<h3>Text Widget</h3>
<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>
</div>',
    'filter' => false,
  ),
  '_multiwidget' => 1,
);$widget_recent_news_show = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Recent Posts',
    'recent_post_category' => 'blog',
    'number_of_news' => '3',
  ),
  3 => 
  array (
    'wid_class' => '',
    'title' => 'RECENT POSTS',
    'recent_post_category' => 'blog',
    'number_of_news' => '3',
  ),
  '_multiwidget' => 1,
);$widget_twitter_widget = array (
  2 => 
  array (
    'title' => 'TWEETS',
    'consumer_key' => '1iUu8muQcbDfv4UAp58rXw',
    'consumer_secret' => 'am535ByNUMFFo8vHQtpkVpgdJz9QgcW4FpWaGDvH5Xw',
    'user_token' => '88209931-h16p4dNkvaXe0UQTRAx8zzPcWgl3L7rXj2XDOT5c2',
    'user_secret' => '3ugAtUwyrCcXK99xleZssr2OkiwVymoB2ceFwknYwLk',
    'username_widget' => 'mosque_crunchpress',
    'num_of_tweets' => '3',
  ),
  '_multiwidget' => 1,
);$widget_flickr_widget = array (
  2 => 
  array (
    'title' => 'FLICKR PHOTOS',
    'type' => 'user',
    'flickr_id' => '68030678@N04',
    'count' => '9',
    'display' => 'latest',
    'size' => 'latest',
    'copyright' => NULL,
  ),
  '_multiwidget' => 1,
);$widget_popular_post = array (
  2 => 
  array (
    'title' => 'Popular Posts',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  3 => 
  array (
    'title' => 'POPULAR POSTS',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  4 => 
  array (
    'title' => 'POPULAR POSTS',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  '_multiwidget' => 1,
);$widget_recent_news_news = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Latest News',
    'recent_post_category' => 'blog',
    'number_of_news' => '4',
  ),
  '_multiwidget' => 1,
);$widget_archives = array (
  2 => 
  array (
    'title' => 'Archives',
    'count' => 0,
    'dropdown' => 0,
  ),
  '_multiwidget' => 1,
);$widget_categories = array (
  2 => 
  array (
    'title' => 'Categories',
    'count' => 0,
    'hierarchical' => 0,
    'dropdown' => 0,
  ),
  '_multiwidget' => 1,
);$widget_post_slider_widget = array (
  2 => 
  array (
    'title' => 'POST SLIDER',
    'select_category' => 'blog',
  ),
  3 => 
  array (
    'title' => 'POST SLIDER',
    'select_category' => 'blog',
  ),
  '_multiwidget' => 1,
);$widget_tag_cloud = array (
  2 => 
  array (
    'title' => 'TAGS',
    'taxonomy' => 'post_tag',
  ),
  '_multiwidget' => 1,
);$sidebars_widgets=array (
  'wp_inactive_widgets' => 
  array (
  ),
  'sidebar-footer' => 
  array (
    0 => 'text-2',
    1 => 'recent_news_show-3',
    2 => 'twitter_widget-2',
    3 => 'flickr_widget-2',
  ),
  'custom-sidebar0' => 
  array (
    0 => 'text-3',
    1 => 'recent_news_show-2',
    2 => 'popular_post-2',
    3 => 'recent_news_news-2',
    4 => 'archives-2',
    5 => 'categories-2',
    6 => 'post_slider_widget-3',
  ),
  'custom-sidebar1' => 
  array (
  ),
  'custom-sidebar2' => 
  array (
  ),
  'custom-sidebar3' => 
  array (
  ),
  'custom-sidebar4' => 
  array (
  ),
  'custom-sidebar5' => 
  array (
    0 => 'text-4',
    1 => 'popular_post-4',
    2 => 'tag_cloud-2',
  ),
  'custom-sidebar6' => 
  array (
    0 => 'popular_post-3',
    1 => 'post_slider_widget-2',
  ),
  'custom-sidebar7' => 
  array (
  ),
  'array_version' => 3,
);
$show_on_front = 'page';
$page_on_front = 15;
$theme_mods_goodwill = array (
  0 => false,
  'nav_menu_locations' => 
  array (
    'header-menu' => 17,
    'top-menu' => 26,
  ),
);
	
			
			//Widgets	
			
            update_option('sidebars_widgets', $sidebars_widgets);
            update_option('widget_text', $widget_text);
            update_option('widget_recent_news_show', $widget_recent_news_show);
            update_option('widget_twitter_widget', $widget_twitter_widget);
            update_option('widget_flickr_widget', $widget_flickr_widget);
            update_option('widget_popular_post', $widget_popular_post);
            update_option('widget_recent_news_news', $widget_recent_news_news);
            update_option('widget_archives', $widget_archives);
            update_option('widget_categories', $widget_categories);
            update_option('widget_post_slider_widget', $widget_post_slider_widget);
            update_option('widget_tag_cloud', $widget_tag_cloud);
            
			
			//Default Widgets	
            update_option('show_on_front', $show_on_front);
            update_option('page_on_front', $page_on_front);
            update_option('theme_mods_goodwill', $theme_mods_goodwill);
        }
        
        else if ($cp_layout == 'dummy_xml_7.xml') { //$widget_text = array (  2 =>   array (    'title' => '',    'text' => '<div class="box"><h2><span>Good</span>will</h2><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p><p>It look like readable English. Praesent imperdiet vulputate viverra. Pellentesque ut faucibus justo.</p></div>',    'filter' => false,  ),  3 =>   array (    'title' => '',    'text' => '<div class="sidebar-bix-1"><h3>Text Widget</h3><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p></div>',    'filter' => false,  ),  4 =>   array (    'title' => '',    'text' => '<div class="sidebar-bix-1"><h3>Text Widget</h3><p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p></div>',    'filter' => false,  ),  '_multiwidget' => 1,);$widget_recent_news_show = array (  2 =>   array (    'wid_class' => '',    'title' => 'Recent News',    'recent_post_category' => 'blog',    'number_of_news' => '4',  ),  3 =>   array (    'wid_class' => '',    'title' => 'RECENT POSTS',    'recent_post_category' => 'blog',    'number_of_news' => '3',  ),  '_multiwidget' => 1,);$widget_twitter_widget = array (  2 =>   array (    'title' => 'mosque_crunchpress',    'consumer_key' => '1iUu8muQcbDfv4UAp58rXw',    'consumer_secret' => 'am535ByNUMFFo8vHQtpkVpgdJz9QgcW4FpWaGDvH5Xw',    'user_token' => '88209931-h16p4dNkvaXe0UQTRAx8zzPcWgl3L7rXj2XDOT5c2',    'user_secret' => '3ugAtUwyrCcXK99xleZssr2OkiwVymoB2ceFwknYwLk',    'username_widget' => '',    'num_of_tweets' => '2',  ),  '_multiwidget' => 1,);$widget_newsletter_widget = array (  2 =>   array (    'title' => 'GET CONNECTED',    'show_name' => NULL,    'news_letter_des' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.',  ),  '_multiwidget' => 1,);$widget_woocommerce_products = array (  2 =>   array (    'title' => 'Best Sellers',    'number' => '3',    'show' => '',    'orderby' => 'date',    'order' => 'desc',    'hide_free' => 0,    'show_hidden' => 0,  ),  3 =>   array (    'title' => 'LIMITED EDITIONS',    'number' => '3',    'show' => '',    'orderby' => 'price',    'order' => 'desc',    'hide_free' => 0,    'show_hidden' => 0,  ),  '_multiwidget' => 1,);$widget_woocommerce_top_rated_products = array (  2 =>   array (    'title' => 'Top Rated',    'number' => '3',  ),  '_multiwidget' => 1,);$widget_post_slider_widget = array (  2 =>   array (    'title' => 'POST SLIDER',    'select_category' => 'blog',  ),  3 =>   array (    'title' => 'Post Slider',    'select_category' => 'blog',  ),  4 =>   array (    'title' => 'Featured',    'select_category' => 'blog',  ),  '_multiwidget' => 1,);$widget_popular_post = array (  2 =>   array (    'title' => 'POPULAR POSTS',    'get_cate_posts' => NULL,    'nop' => '3',  ),  3 =>   array (    'title' => 'POPULAR POSTS',    'get_cate_posts' => NULL,    'nop' => '3',  ),  4 =>   array (    'title' => 'POPULAR POSTS',    'get_cate_posts' => NULL,    'nop' => '4',  ),  '_multiwidget' => 1,);$widget_tag_cloud = array (  2 =>   array (    'title' => 'TAGS',    'taxonomy' => 'event-tags',  ),  '_multiwidget' => 1,);$widget_recent_news_news = array (  3 =>   array (    'wid_class' => '',    'title' => 'LATEST NEWS',    'recent_post_category' => 'blog',    'number_of_news' => '3',  ),  '_multiwidget' => 1,);$widget_archives = array (  2 =>   array (    'title' => 'ARCHIVES',    'count' => 0,    'dropdown' => 0,  ),  '_multiwidget' => 1,);$widget_categories = array (  2 =>   array (    'title' => 'CATEGORIES',    'count' => 0,    'hierarchical' => 0,    'dropdown' => 0,  ),  '_multiwidget' => 1,);$sidebars_widgets=array (  'wp_inactive_widgets' =>   array (  ),  'sidebar-footer' =>   array (    0 => 'text-2',    1 => 'recent_news_show-3',    2 => 'twitter_widget-2',    3 => 'newsletter_widget-2',  ),  'sidebar-upper-footer' =>   array (    0 => 'woocommerce_products-2',    1 => 'woocommerce_products-3',    2 => 'woocommerce_top_rated_products-2',    3 => 'post_slider_widget-4',  ),  'custom-sidebar0' =>   array (  ),  'custom-sidebar1' =>   array (  ),  'custom-sidebar2' =>   array (  ),  'custom-sidebar3' =>   array (  ),  'custom-sidebar4' =>   array (  ),  'custom-sidebar5' =>   array (    0 => 'text-3',    1 => 'popular_post-3',    2 => 'tag_cloud-2',  ),  'custom-sidebar6' =>   array (    0 => 'popular_post-2',    1 => 'post_slider_widget-2',  ),  'custom-sidebar7' =>   array (  ),  'custom-sidebar8' =>   array (    0 => 'text-4',    1 => 'recent_news_show-2',    2 => 'popular_post-4',    3 => 'recent_news_news-3',    4 => 'archives-2',    5 => 'categories-2',    6 => 'post_slider_widget-3',  ),  'array_version' => 3,);$show_on_front = 'page';$page_on_front = 14;$theme_mods_goodwill = array (  0 => false,  'nav_menu_locations' =>   array (    'top-menu' => 7,    'header-menu' => 6,  ),);			//Widgets		
            // update_option('sidebars_widgets', $sidebars_widgets);			update_option('widget_text', $widget_text);			update_option('widget_recent_news_show', $widget_recent_news_show);			update_option('widget_twitter_widget', $widget_twitter_widget);			update_option('widget_newsletter_widget', $widget_newsletter_widget);			update_option('widget_woocommerce_products', $widget_woocommerce_products);						update_option('widget_woocommerce_top_rated_products', $widget_woocommerce_top_rated_products);			update_option('widget_post_slider_widget', $widget_post_slider_widget);			update_option('widget_popular_post', $widget_popular_post);			update_option('widget_tag_cloud', $widget_tag_cloud);			update_option('widget_recent_news_news', $widget_recent_news_news);						update_option('widget_archives', $widget_archives);						update_option('widget_categories', $widget_categories);						//Default Widgets		
            // update_option('show_on_front', $show_on_front);			update_option('page_on_front', $page_on_front);			update_option('theme_mods_goodwill', $theme_mods_goodwill);				}else{
            
		$widget_text = array (
  2 => 
  array (
    'title' => '',
    'text' => '<div class="box">
<h2><span>Good</span>will</h2>
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
<p>It look like readable English. Praesent imperdiet vulputate viverra. Pellentesque ut faucibus justo.</p>
</div>',
    'filter' => false,
  ),
  3 => 
  array (
    'title' => '',
    'text' => '<div class="sidebar-bix-1">
<h3>Text Widget</h3>
<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>
</div>',
    'filter' => false,
  ),
  4 => 
  array (
    'title' => '',
    'text' => '<div class="sidebar-bix-1">
<h3>Text Widget</h3>
<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur ullamco laboris nisi ut aliquip.</p>
</div>',
    'filter' => false,
  ),
  '_multiwidget' => 1,
);$widget_recent_news_show = array (
  2 => 
  array (
    'wid_class' => '',
    'title' => 'Recent News',
    'recent_post_category' => 'blog',
    'number_of_news' => '4',
  ),
  3 => 
  array (
    'wid_class' => '',
    'title' => 'RECENT POSTS',
    'recent_post_category' => 'blog',
    'number_of_news' => '3',
  ),
  '_multiwidget' => 1,
);$widget_twitter_widget = array (
  2 => 
  array (
    'title' => 'mosque_crunchpress',
    'consumer_key' => '1iUu8muQcbDfv4UAp58rXw',
    'consumer_secret' => 'am535ByNUMFFo8vHQtpkVpgdJz9QgcW4FpWaGDvH5Xw',
    'user_token' => '88209931-h16p4dNkvaXe0UQTRAx8zzPcWgl3L7rXj2XDOT5c2',
    'user_secret' => '3ugAtUwyrCcXK99xleZssr2OkiwVymoB2ceFwknYwLk',
    'username_widget' => '',
    'num_of_tweets' => '2',
  ),
  '_multiwidget' => 1,
);$widget_newsletter_widget = array (
  2 => 
  array (
    'title' => 'GET CONNECTED',
    'show_name' => NULL,
    'news_letter_des' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.
',
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_products = array (
  2 => 
  array (
    'title' => 'Best Sellers',
    'number' => '3',
    'show' => '',
    'orderby' => 'date',
    'order' => 'desc',
    'hide_free' => 0,
    'show_hidden' => 0,
  ),
  3 => 
  array (
    'title' => 'LIMITED EDITIONS',
    'number' => '3',
    'show' => '',
    'orderby' => 'price',
    'order' => 'desc',
    'hide_free' => 0,
    'show_hidden' => 0,
  ),
  '_multiwidget' => 1,
);$widget_woocommerce_top_rated_products = array (
  2 => 
  array (
    'title' => 'Top Rated',
    'number' => '3',
  ),
  '_multiwidget' => 1,
);$widget_post_slider_widget = array (
  2 => 
  array (
    'title' => 'POST SLIDER',
    'select_category' => 'blog',
  ),
  3 => 
  array (
    'title' => 'Post Slider',
    'select_category' => 'blog',
  ),
  4 => 
  array (
    'title' => 'Featured',
    'select_category' => 'blog',
  ),
  '_multiwidget' => 1,
);$widget_popular_post = array (
  2 => 
  array (
    'title' => 'POPULAR POSTS',
    'get_cate_posts' => NULL,
    'nop' => '3',
  ),
  3 => 
  array (
    'title' => 'POPULAR POSTS',
    'get_cate_posts' => NULL,
    'nop' => '3',
  ),
  4 => 
  array (
    'title' => 'POPULAR POSTS',
    'get_cate_posts' => NULL,
    'nop' => '4',
  ),
  '_multiwidget' => 1,
);$widget_tag_cloud = array (
  2 => 
  array (
    'title' => 'TAGS',
    'taxonomy' => 'event-tags',
  ),
  '_multiwidget' => 1,
);$widget_recent_news_news = array (
  3 => 
  array (
    'wid_class' => '',
    'title' => 'LATEST NEWS',
    'recent_post_category' => 'blog',
    'number_of_news' => '3',
  ),
  '_multiwidget' => 1,
);$widget_archives = array (
  2 => 
  array (
    'title' => 'ARCHIVES',
    'count' => 0,
    'dropdown' => 0,
  ),
  '_multiwidget' => 1,
);$widget_categories = array (
  2 => 
  array (
    'title' => 'CATEGORIES',
    'count' => 0,
    'hierarchical' => 0,
    'dropdown' => 0,
  ),
  '_multiwidget' => 1,
);$sidebars_widgets=array (
  'wp_inactive_widgets' => 
  array (
  ),
  'sidebar-footer' => 
  array (
    0 => 'text-2',
    1 => 'recent_news_show-3',
    2 => 'twitter_widget-2',
    3 => 'newsletter_widget-2',
  ),
  'sidebar-upper-footer' => 
  array (
    0 => 'woocommerce_products-2',
    1 => 'woocommerce_products-3',
    2 => 'woocommerce_top_rated_products-2',
    3 => 'post_slider_widget-4',
  ),
  'custom-sidebar0' => 
  array (
  ),
  'custom-sidebar1' => 
  array (
  ),
  'custom-sidebar2' => 
  array (
  ),
  'custom-sidebar3' => 
  array (
  ),
  'custom-sidebar4' => 
  array (
  ),
  'custom-sidebar5' => 
  array (
    0 => 'text-3',
    1 => 'popular_post-3',
    2 => 'tag_cloud-2',
  ),
  'custom-sidebar6' => 
  array (
    0 => 'popular_post-2',
    1 => 'post_slider_widget-2',
  ),
  'custom-sidebar7' => 
  array (
  ),
  'custom-sidebar8' => 
  array (
    0 => 'text-4',
    1 => 'recent_news_show-2',
    2 => 'popular_post-4',
    3 => 'recent_news_news-3',
    4 => 'archives-2',
    5 => 'categories-2',
    6 => 'post_slider_widget-3',
  ),
  'array_version' => 3,
);
$show_on_front = 'page';
$page_on_front = 14;
$theme_mods_goodwill = array (
  0 => false,
  'nav_menu_locations' => 
  array (
    'top-menu' => 7,
    'header-menu' => 6,
  ),
);


			update_option('sidebars_widgets', $sidebars_widgets);
            update_option('widget_text', $widget_text);
            update_option('widget_recent_news_show', $widget_recent_news_show);
            update_option('widget_twitter_widget', $widget_twitter_widget);
            update_option('widget_newsletter_widget', $widget_newsletter_widget);
            update_option('widget_woocommerce_products', $widget_woocommerce_products);
            update_option('widget_woocommerce_top_rated_products', $widget_woocommerce_top_rated_products);
            update_option('widget_post_slider_widget', $widget_post_slider_widget);
            update_option('widget_popular_post', $widget_popular_post);
            update_option('widget_tag_cloud', $widget_tag_cloud);
            update_option('widget_recent_news_news', $widget_recent_news_news);
            update_option('widget_archives', $widget_archives);
            update_option('widget_categories', $widget_categories); 
			
			//Default Widgets	
			
            update_option('show_on_front', $show_on_front);
            update_option('page_on_front', $page_on_front);
            update_option('theme_mods_goodwill', $theme_mods_goodwill);


	   }
    }
    
    
    
}

// add_action( 'muplugins_loaded', 'cp_dummy_data_override' );

// function cp_dummy_data_override() {

// $cp_dummy_data = new cp_dummy_data;
// }
?>