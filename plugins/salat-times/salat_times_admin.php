<?php

function salat_times_options_page() {
	?>
    <div class="wrap">
    <h1 style="margin-bottom:5px;">Salat Times Settings <a href="#how" class="button button-secondary">How to use?</a> <a href="#help" class="button button-secondary">Help</a></h1>
    <br/>
    
    <?php if($_POST["restore_defaults"] == "1") { delete_option('st_options'); } ?>
    
    <form method="post" action="options.php">
    
    <?php
    settings_fields( 'salat-times-settings-group' );
	
	  $st_options = get_option("st_options");
  if (!is_array($st_options)) {
    $st_options = array(
        'lat_long_tz' => '23.7 90.4 6',
		'lat' => '23.7',
        'long' => '90.4',
		'custom_loc' => '0',
		'calc_method' => '1',
		'asr_method' => '0',
		'time_format' => '1',
		'time_zone' => '6',
		'wgt_title1' => 'Salat Times',
		'location' => 'Dhaka, Bangladesh',
		'show_date' => '1',
		'width' => '100%',
		'halign' => 'center',
		'talign' => 'center',
		'walign' => 'left',
		'scheme' => '#4189dd #ffffff #4472C4 #ffffff #B4C6E7 #D9E2F3 #000000',
		'custom' => 'Salat-Time-Fajr-Sunrise-Zuhr-Asr-Magrib-Isha',
		'lang' => 'en' );
   }
   ?>
    
    <div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Location Settings</span></h3>
<div class="inside">
	<p align="justify">You can select a city from the dropdown list below or use Custom Location (if you know your location's latitude, longitude and time zone). </p>
    <table class="form-table">
        <tr valign="top">
        <td><input type="radio" id="custom_loc0" name="st_options[custom_loc]" value="0"<?php if($st_options['custom_loc'] == "0") { echo " checked"; } ?>><label for="custom_loc0">Select City:</label></td>
        <td>
        <select name="st_options[lat_long_tz]">
        <option value="24.467 54.367 4"<?php if($st_options['lat_long_tz'] == "24.467 54.367 4") { echo " selected"; } ?>>Abu Dhabi, UAE</option>
        <option value="9.066667, 7.483333 1"<?php if($st_options['lat_long_tz'] == "9.066667, 7.483333 1") { echo " selected"; } ?>>Abuja, Nigeria</option>
        <option value="5.55, -0.2 0"<?php if($st_options['lat_long_tz'] == "5.55, -0.2 0") { echo " selected"; } ?>>Accra, Ghana</option>
        <option value="9.03, 38.74 3"<?php if($st_options['lat_long_tz'] == "9.03, 38.74 3") { echo " selected"; } ?>>Addis Ababa, Ethiopia</option>
        <option value="36.766667, 3.216667 1"<?php if($st_options['lat_long_tz'] == "36.766667, 3.216667 1") { echo " selected"; } ?>>Algiers, Algeria</option>
        <option value="31.94972 35.93278 2"<?php if($st_options['lat_long_tz'] == "31.94972 35.93278 2") { echo " selected"; } ?>>Amman, Jordan</option>
        <option value="52.366667, 4.9 1"<?php if($st_options['lat_long_tz'] == "52.366667, 4.9 1") { echo " selected"; } ?>>Amsterdam, Netherlands</option>
        <option value="39.933333, 32.866667 2"<?php if($st_options['lat_long_tz'] == "39.933333, 32.866667 2") { echo " selected"; } ?>>Ankara, Turkey</option>
        <option value="-18.933333, 47.516667 3"<?php if($st_options['lat_long_tz'] == "-18.933333, 47.516667 3") { echo " selected"; } ?>>Antananarivo, Madagascar</option>
        <option value="-13.833333, -171.75 13"<?php if($st_options['lat_long_tz'] == "-13.833333, -171.75 13") { echo " selected"; } ?>>Apia, Samoa</option>
        <option value="15.333333, 38.933333 3"<?php if($st_options['lat_long_tz'] == "15.333333, 38.933333 3") { echo " selected"; } ?>>Asmara, Eritrea</option>
        <option value="39.933 32.867 2"<?php if($st_options['lat_long_tz'] == "39.933 32.867 2") { echo " selected"; } ?>>Ankara, Turkey</option>
        <option value="-18.933333, 47.516667 3"<?php if($st_options['lat_long_tz'] == "-18.933333, 47.516667 3") { echo " selected"; } ?>>Antananarivo, Madagascar</option>
        <option value="-13.833333, -171.75 13"<?php if($st_options['lat_long_tz'] == "-13.833333, -171.75 13") { echo " selected"; } ?>>Apia, Samoa</option>
        <option value="51.166667, 71.433333 6"<?php if($st_options['lat_long_tz'] == "51.166667, 71.433333 6") { echo " selected"; } ?>>Astana, Kazakhstan</option>
        <option value="37.966667, 23.716667 2"<?php if($st_options['lat_long_tz'] == "37.966667, 23.716667 2") { echo " selected"; } ?>>Athens, Greece</option>
        <option value="33.333 44.433 3"<?php if($st_options['lat_long_tz'] == "33.333 44.433 3") { echo " selected"; } ?>>Bagdad, Iraq</option>
        <option value="13.75, 100.466667 7"<?php if($st_options['lat_long_tz'] == "13.75, 100.466667 7") { echo " selected"; } ?>>Bangkok, Thailand</option>
        <option value="39.913889, 116.391667 8"<?php if($st_options['lat_long_tz'] == "39.913889, 116.391667 8") { echo " selected"; } ?>>Beijing, China</option>
        <option value="33.9 35.533 2"<?php if($st_options['lat_long_tz'] == "33.9 35.533 2") { echo " selected"; } ?>>Bairut, Lebanon</option>
        <option value="52.516667, 13.383333 1"<?php if($st_options['lat_long_tz'] == "52.516667, 13.383333 1") { echo " selected"; } ?>>Berlin, Germany</option>
        <option value="-15.793889, -47.882778 -3"<?php if($st_options['lat_long_tz'] == "-15.793889, -47.882778 -3") { echo " selected"; } ?>>Brasília, Brazil</option>
        <option value="47.4925, 19.051389 1"<?php if($st_options['lat_long_tz'] == "47.4925, 19.051389 1") { echo " selected"; } ?>>Budapest, Hungary</option>
        <option value="-34.603333, -58.381667 -3"<?php if($st_options['lat_long_tz'] == "-34.603333, -58.381667 -3") { echo " selected"; } ?>>Buenos Aires, Argentina</option>
        <option value="30.05 31.233 2"<?php if($st_options['lat_long_tz'] == "30.05 31.233 2") { echo " selected"; } ?>>Cairo, Egypt</option>
        <option value="-35.3075, 149.124417 10"<?php if($st_options['lat_long_tz'] == "-35.3075, 149.124417 10") { echo " selected"; } ?>>Canberra, Australia</option>
        <option value="10.5, -66.916667 -4.5"<?php if($st_options['lat_long_tz'] == "10.5, -66.916667 -4.5") { echo " selected"; } ?>>Caracas, Venezuela</option>
        <option value="14.692778, -17.446667 0"<?php if($st_options['lat_long_tz'] == "14.692778, -17.446667 0") { echo " selected"; } ?>>Dakar, Senegal</option>
        <option value="33.51306 36.29194 2"<?php if($st_options['lat_long_tz'] == "33.51306 36.29194 2") { echo " selected"; } ?>>Damascus, Syria</option>
        <option value="23.7 90.4 6"<?php if($st_options['lat_long_tz'] == "23.7 90.4 6") { echo " selected"; } ?>>Dhaka, Bangladesh</option>
        <option value="25.28667 51.53333 3"<?php if($st_options['lat_long_tz'] == "25.28667 51.53333 3") { echo " selected"; } ?>>Doha, Qatar</option>
        <option value="53.347778, -6.259722 0"<?php if($st_options['lat_long_tz'] == "53.347778, -6.259722 0") { echo " selected"; } ?>>Dublin, Ireland</option>
        <option value="21.033333, 105.85 7"<?php if($st_options['lat_long_tz'] == "21.033333, 105.85 7") { echo " selected"; } ?>>Hanoi, Vietnam</option>
        <option value="-17.863889, 31.029722 2"<?php if($st_options['lat_long_tz'] == "-17.863889, 31.029722 2") { echo " selected"; } ?>>Harare, Zimbabwe</option>
        <option value="60.170833, 24.9375 2"<?php if($st_options['lat_long_tz'] == "60.170833, 24.9375 2") { echo " selected"; } ?>>Helsinki, Finland</option>
        <option value="33.7 73.1 5"<?php if($st_options['lat_long_tz'] == "33.7 73.1 5") { echo " selected"; } ?>>Islamabad, Pakistan</option>
        <option value="-6.2, 106.816667 7"<?php if($st_options['lat_long_tz'] == "-6.2, 106.816667 7") { echo " selected"; } ?>>Jakarta, Indonesia</option>
        <option value="31.783 35.217 2"<?php if($st_options['lat_long_tz'] == "31.783 35.217 2") { echo " selected"; } ?>>Jerusalem, Israel</option>
        <option value="31.783 35.217 2"<?php if($st_options['lat_long_tz'] == "31.783 35.217 2") { echo " selected"; } ?>>Jerusalem, Palestine</option>
        <option value="4.85, 31.6 3"<?php if($st_options['lat_long_tz'] == "4.85, 31.6 3") { echo " selected"; } ?>>Juba, South Sudan</option>
        <option value="34.533 69.167 4.5"<?php if($st_options['lat_long_tz'] == "34.533 69.167 4.5") { echo " selected"; } ?>>Kabul, Afghanistan</option>
        <option value="0.313611, 32.581111 3"<?php if($st_options['lat_long_tz'] == "0.313611, 32.581111 3") { echo " selected"; } ?>>Kampala, Uganda</option>
        <option value="27.7, 85.333333 5.75"<?php if($st_options['lat_long_tz'] == "27.7, 85.333333 5.75") { echo " selected"; } ?>>Kathmandu, Nepal</option>
        <option value="15.633333, 32.533333 3"<?php if($st_options['lat_long_tz'] == "15.633333, 32.533333 3") { echo " selected"; } ?>>Khartoum, Sudan</option>
        <option value="50.45, 30.523333 2"<?php if($st_options['lat_long_tz'] == "50.45, 30.523333 2") { echo " selected"; } ?>>Kiev, Ukraine</option>
        <option value="17.983333, -76.8 -5"<?php if($st_options['lat_long_tz'] == "17.983333, -76.8 -5") { echo " selected"; } ?>>Kingston, Jamaica</option>
        <option value="3.1475 101.69333 8"<?php if($st_options['lat_long_tz'] == "3.1475 101.69333 8") { echo " selected"; } ?>>Kuala Lampur, Malaysia</option>
        <option value="29.36972 47.97833 3"<?php if($st_options['lat_long_tz'] == "29.36972 47.97833 3") { echo " selected"; } ?>>Kuwait City, Kuwait</option>
        <option value="38.713889, -9.139444 0"<?php if($st_options['lat_long_tz'] == "38.713889, -9.139444 0") { echo " selected"; } ?>>Lisbon, Portugal</option>
        <option value="51.50722 0.1275 0"<?php if($st_options['lat_long_tz'] == "51.50722 0.1275 0") { echo " selected"; } ?>>London, United Kingdom</option>
        <option value="4.17528 75.50889 5"<?php if($st_options['lat_long_tz'] == "4.17528 75.50889 5") { echo " selected"; } ?>>Male, Maldives</option>
        <option value="26.217 50.583 3"<?php if($st_options['lat_long_tz'] == "26.217 50.583 3") { echo " selected"; } ?>>Manama, Bahrain</option>
        <option value="55.75, 37.616667 3"<?php if($st_options['lat_long_tz'] == "55.75, 37.616667 3") { echo " selected"; } ?>>Moscow, Russia</option>
        <option value="23.60861 58.59194 4"<?php if($st_options['lat_long_tz'] == "23.60861 58.59194 4") { echo " selected"; } ?>>Muscat, Oman</option>
        <option value="28.61389 77.20889 5.5"<?php if($st_options['lat_long_tz'] == "28.61389 77.20889 5.5") { echo " selected"; } ?>>New Delhi, India</option>
        <option value="24.633 46.717 3"<?php if($st_options['lat_long_tz'] == "24.633 46.717 3") { echo " selected"; } ?>>Riyadh, Saudi Arabia</option>
        <option value="1.283 103.833 8"<?php if($st_options['lat_long_tz'] == "1.283 103.833 8") { echo " selected"; } ?>>Singapore, Singapore</option>
        <option value="32.9 13.186 1"<?php if($st_options['lat_long_tz'] == "32.9 13.186 1") { echo " selected"; } ?>>Tripoli, Libya</option>
        <option value="38.895 77.037 -5"<?php if($st_options['lat_long_tz'] == "38.895 77.037 -5") { echo " selected"; } ?>>Washington, United States</option>
        </select> (More city soon...)
        </td>
        </tr>
        <tr valign="top">
        <td><input type="radio" id="custom_loc1" name="st_options[custom_loc]" value="1"<?php if($st_options['custom_loc'] == "1") { echo " checked"; } ?>><label for="custom_loc1">Custom Location:</label></td>
        <td>
        Latitude:<input type="text" maxlength="7" size="5" name="st_options[lat]" value="<?php echo $st_options['lat']; ?>" /> Longitude:<input type="text" maxlength="7" size="5" name="st_options[long]" value="<?php echo $st_options['long']; ?>" /> Time Zone:<select name="st_options[time_zone]">
        <option value="-12"<?php if($st_options['time_zone'] == "-12") { echo " selected"; } ?>>GMT -12</option>
        <option value="-11"<?php if($st_options['time_zone'] == "-11") { echo " selected"; } ?>>GMT -11</option>
        <option value="-10"<?php if($st_options['time_zone'] == "-10") { echo " selected"; } ?>>GMT -10</option>
        <option value="-9"<?php if($st_options['time_zone'] == "-9") { echo " selected"; } ?>>GMT -9</option>
        <option value="-8"<?php if($st_options['time_zone'] == "-8") { echo " selected"; } ?>>GMT -8</option>
        <option value="-7"<?php if($st_options['time_zone'] == "-7") { echo " selected"; } ?>>GMT -7</option>
        <option value="-6"<?php if($st_options['time_zone'] == "-6") { echo " selected"; } ?>>GMT -6</option>
        <option value="-5"<?php if($st_options['time_zone'] == "-5") { echo " selected"; } ?>>GMT -5</option>
        <option value="-4.5"<?php if($st_options['time_zone'] == "-4.5") { echo " selected"; } ?>>GMT -4:30</option>
        <option value="-4"<?php if($st_options['time_zone'] == "-4") { echo " selected"; } ?>>GMT -4</option>
        <option value="-3.5"<?php if($st_options['time_zone'] == "-3.5") { echo " selected"; } ?>>GMT -3:30</option>
        <option value="-3"<?php if($st_options['time_zone'] == "-3") { echo " selected"; } ?>>GMT -3</option>
        <option value="-2"<?php if($st_options['time_zone'] == "-2") { echo " selected"; } ?>>GMT -2</option>
        <option value="-1"<?php if($st_options['time_zone'] == "-1") { echo " selected"; } ?>>GMT -1</option>
        <option value="0"<?php if($st_options['time_zone'] == "0") { echo " selected"; } ?>>GMT 0</option>
        <option value="1"<?php if($st_options['time_zone'] == "1") { echo " selected"; } ?>>GMT +1</option>
        <option value="2"<?php if($st_options['time_zone'] == "2") { echo " selected"; } ?>>GMT +2</option>
        <option value="3"<?php if($st_options['time_zone'] == "3") { echo " selected"; } ?>>GMT +3</option>
        <option value="3.5"<?php if($st_options['time_zone'] == "3.5") { echo " selected"; } ?>>GMT +3:30</option>
        <option value="4"<?php if($st_options['time_zone'] == "4") { echo " selected"; } ?>>GMT +4</option>
        <option value="4.5"<?php if($st_options['time_zone'] == "4.5") { echo " selected"; } ?>>GMT +4:30</option>
        <option value="5"<?php if($st_options['time_zone'] == "5") { echo " selected"; } ?>>GMT +5</option>
        <option value="5.5"<?php if($st_options['time_zone'] == "5.5") { echo " selected"; } ?>>GMT +5:30</option>
        <option value="5.75"<?php if($st_options['time_zone'] == "5.75") { echo " selected"; } ?>>GMT +5:45</option>
        <option value="6"<?php if($st_options['time_zone'] == "6") { echo " selected"; } ?>>GMT +6</option>
        <option value="6.5"<?php if($st_options['time_zone'] == "6.5") { echo " selected"; } ?>>GMT +6:30</option>
        <option value="7"<?php if($st_options['time_zone'] == "7") { echo " selected"; } ?>>GMT +7</option>
        <option value="8"<?php if($st_options['time_zone'] == "8") { echo " selected"; } ?>>GMT +8</option>
        <option value="9"<?php if($st_options['time_zone'] == "9") { echo " selected"; } ?>>GMT +9</option>
        <option value="9.5"<?php if($st_options['time_zone'] == "9.5") { echo " selected"; } ?>>GMT +9:30</option>
        <option value="10"<?php if($st_options['time_zone'] == "10") { echo " selected"; } ?>>GMT +10</option>
        <option value="10.5"<?php if($st_options['time_zone'] == "10.5") { echo " selected"; } ?>>GMT +10:30</option>
        <option value="11"<?php if($st_options['time_zone'] == "11") { echo " selected"; } ?>>GMT +11</option>
        <option value="12"<?php if($st_options['time_zone'] == "12") { echo " selected"; } ?>>GMT +12</option>
        <option value="13"<?php if($st_options['time_zone'] == "13") { echo " selected"; } ?>>GMT +13</option>
        </select>
        </td>
        </tr>
        </table>
        </div></div>
        
    <div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Calculation Settings</span></h3>
<div class="inside">
    <table class="form-table">
        <tr valign="top">
        <td><label for="jm">Juristic Method</label> (<a href="#help">?</a>):</td>
        <td>
        <select name="st_options[asr_method]" id="jm">
        <option value="0"<?php if($st_options['asr_method'] == "0") { echo " selected"; } ?>>Standard</option>
        <option value="1"<?php if($st_options['asr_method'] == "1") { echo " selected"; } ?>>Hanafi</option>
        </select> (For <span style="color: green;">Asr</span> time.)
        </td>
        </tr>
        <tr valign="top">
        <td><label for="cm">Calculation Method</label> (<a href="#help">?</a>):</td>
        <td>
        <select name="st_options[calc_method]" id="cm">
        <option value="0"<?php if($st_options['calc_method'] == "0") { echo " selected"; } ?>>Shia Ithna Ashari (Jafari)</option>
        <option value="1"<?php if($st_options['calc_method'] == "1") { echo " selected"; } ?>>University of Islamic Sciences, Karachi</option>
        <option value="2"<?php if($st_options['calc_method'] == "2") { echo " selected"; } ?>>Islamic Society of North America (ISNA)</option>
        <option value="3"<?php if($st_options['calc_method'] == "3") { echo " selected"; } ?>>Muslim World League (MWL)</option>
        <option value="4"<?php if($st_options['calc_method'] == "4") { echo " selected"; } ?>>Umm al-Qura, Makkah</option>
        <option value="5"<?php if($st_options['calc_method'] == "5") { echo " selected"; } ?>>Egyptian General Authority of Survey</option>
        <option value="7"<?php if($st_options['calc_method'] == "7") { echo " selected"; } ?>>Institute of Geophysics, University of Tehran</option>
        </select>
        </td>
        </tr>
        </table>
        </div></div>
        
    <div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Widget Settings</span></h3>
<div class="inside">
    <table class="form-table">
        <tr valign="top">
        <td><label for="wgt_title">Widget Title:</label></td>
        <td><input id="wgt_title" type="text" maxlength="99" name="st_options[wgt_title1]" value="<?php echo $st_options['wgt_title1']; ?>" /> </td>
        </tr>
        <tr valign="top">
        <td><label for="ln">Location Name:</label></td>
        <td><input id="ln" type="text" maxlength="99" name="st_options[location]" value="<?php echo $st_options['location']; ?>" /> <span style="color: green;">(Will be displayed on widget.)</span></td>
        </tr>
        <tr valign="top">
        <td><label for="tf">Time Format:</label></td>
        <td>
        <select name="st_options[time_format]" id="tf">
        <option value="0"<?php if($st_options['time_format'] == "0") { echo " selected"; } ?>>24 Hour</option>
        <option value="1"<?php if($st_options['time_format'] == "1") { echo " selected"; } ?>>12 Hour</option>
        <option value="2"<?php if($st_options['time_format'] == "2") { echo " selected"; } ?>>12 Hour (No suffix)</option>
        <option value="3"<?php if($st_options['time_format'] == "3") { echo " selected"; } ?>>Floating point number</option>
        </select> Use "<span style="color: red;">12 Hour (No suffix)</span>" for "<span style="color: red;">Bengali</span>" language.
        </td>
        </tr>
        <tr valign="top">
        <td><label for="sd">Show Date:</label></td>
        <td><input id="sd" type="checkbox" id="show_date" name="st_options[show_date]" value="1" <?php if($st_options['show_date']==1) echo('checked="checked"'); ?>/><label for="show_date">Gregorian Date</label></td>
        </tr>
        <tr valign="top">
        <td><label for="lang">Language:</label></td>
        <td>
        <select name="st_options[lang]" id="lang">
        <option value="en"<?php if($st_options['lang'] == "en") { echo " selected"; } ?>>English</option>
        <option value="bn"<?php if($st_options['lang'] == "bn") { echo " selected"; } ?>>Bengali</option>
        <option value="custom"<?php if($st_options['lang'] == "custom") { echo " selected"; } ?>>Custom (Set below)</option>
        </select>
        </td>
        </tr>
        <tr valign="top">
        <td><label for="cl">Custom Language:</label></td>
        <td>
        <p>Change the text: <span style="color: red;">Salat-Time-Fajr-Sunrise-Zuhr-Asr-Magrib-Isha</span></p>
        <p><input id="cl" type="text" name="st_options[custom]" value="<?php echo $st_options['custom']; ?>" /></p>
        </td>
        </tr>
        </table>
        </div></div>
        
     <div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Widget Style</span></h3>
<div class="inside">
    <table class="form-table">
    <tr valign="top">
     <td><label for="scheme"><strong>Color Scheme:</strong></label></td>
     <td>
     <select name="st_options[scheme]" id="scheme">
     <option value="#313232 #ffffff #181818 #ffffff #313232 #585858 #ffffff"<?php if($st_options['scheme'] == "#313232 #ffffff #181818 #ffffff #313232 #585858 #ffffff") { echo " selected"; } ?>>Black</option>
     <option value="#4189dd #ffffff #4472C4 #ffffff #B4C6E7 #D9E2F3 #000000"<?php if($st_options['scheme'] == "#4189dd #ffffff #4472C4 #ffffff #B4C6E7 #D9E2F3 #000000") { echo " selected"; } ?>>Blue</option>
     <option value="#4189dd #ffffff #5b9bd5 #ffffff #bdd6ee #deeaf6 #000000"<?php if($st_options['scheme'] == "#4189dd #ffffff #5b9bd5 #ffffff #bdd6ee #deeaf6 #000000") { echo " selected"; } ?>>Light Blue</option>
     <option value="#778496 #ffffff #65707f #ffffff #dddcdc #f0f0f0 #000000"<?php if($st_options['scheme'] == "#778496 #ffffff #65707f #ffffff #dddcdc #f0f0f0 #000000") { echo " selected"; } ?>>Gray</option>
     <option value="#48ae03 #ffffff #70ad47 #ffffff #c5e0b3 #e2efd9 #000000"<?php if($st_options['scheme'] == "#48ae03 #ffffff #70ad47 #ffffff #c5e0b3 #e2efd9 #000000") { echo " selected"; } ?>>Green</option>
     <option value="#ee6204 #ffffff #ed7d31 #ffffff #f7caac #fbe4d5 #000000"<?php if($st_options['scheme'] == "#ee6204 #ffffff #ed7d31 #ffffff #f7caac #fbe4d5 #000000") { echo " selected"; } ?>>Orange</option>
     </select>
     </td>
    </tr>
    <tr valign="top">
        <td><strong><label for="halign">Text Alignment:</label></strong></td>
        <td><label for="halign">Header: </label><select name="st_options[halign]" id="halign"><option value="left"<?php if($st_options['halign'] == "left") { echo " selected"; } ?>>Left</option><option value="center"<?php if($st_options['halign'] == "center") { echo " selected"; } ?>>Center</option><option value="right"<?php if($st_options['halign'] == "right") { echo " selected"; } ?>>Right</option></select></td>
        <td><label for="talign">Title: </label><select name="st_options[talign]" id="talign"><option value="left"<?php if($st_options['talign'] == "left") { echo " selected"; } ?>>Left</option><option value="center"<?php if($st_options['talign'] == "center") { echo " selected"; } ?>>Center</option><option value="right"<?php if($st_options['talign'] == "right") { echo " selected"; } ?>>Right</option></select></td>
        <td><label for="walign">Wakto/Time: </label><select name="st_options[walign]" id="walign"><option value="left"<?php if($st_options['walign'] == "left") { echo " selected"; } ?>>Left</option><option value="center"<?php if($st_options['walign'] == "center") { echo " selected"; } ?>>Center</option><option value="right"<?php if($st_options['walign'] == "right") { echo " selected"; } ?>>Right</option></select></td>
    </tr>
    <tr valign="top">
        <td><label for="width">Widget width:</label></td>
        <td colspan="3"><input id="width" type="text" maxlength="5" name="st_options[width]" value="<?php echo $st_options['width']; ?>" /> (Example: 90%, 200px etc.)</td>
        </tr>
    </table>
    </div></div>
    
    <?php submit_button(); ?>
    </form>
    
    <form method="post" action="options.php">
	<?php settings_fields( 'salat-times-settings-group' ); ?>
    
    <input type="hidden" name="restore_defaults" value="1">
    <input type="submit" value="Restore Default Settings" class="button button-secondary">
    </form>
    <br />
    
    <a name="how"></a>
    <div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>How To Use</span></h3>
	<div class="inside">
    <table class="form-table">
    <tr valign="top">
        <td>
        <p>Go to: Appearance > <a href="<?php admin_url(); ?>widgets.php">Widgets</a> to use this (Daily Salat Times) widget.</p>
        <p>Insert this shortcode in post/page: <code><span style="color: #000000"><span style="color: #0000BB">[daily_salat_times]</span></span></code></p>
        <p>Or, PHP code: <code><span style="color: #000000"><span style="color: #0000BB">   &#60;&#63;php echo do_shortcode&#40;&#39;[daily_salat_times]&#39;&#41;; </span><span style="color: #0000BB">&#63;&#62;</span></span></code></p>
        </td>
    </tr>
    </table>
    </div></div>
    
    <a name="help"></a>
    <div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span><a name="help"></a>Help</span></h3>
	<div class="inside">
    <p><strong><u>Juristic Methods</u>:</strong></p>
    <p align="justify">There are two main opinions on how to calculate Asr time. The majority of schools (including Shafi'i, Maliki, Ja'fari, and Hanbali) say it is at the time when the length of any object's shadow equals the length of the object itself plus the length of that object's shadow at noon. The dominant opinion in the Hanafi school says that Asr begins when the length of any object's shadow is twice the length of the object plus the length of that object's shadow at noon.</p>
    <p><strong><u>Calculation Methods</u>:</strong></p>
    <p align="justify">There are different conventions for calculating prayer times. The following table lists several well-known conventions currently in use in various regions:</p>
    <table style="border-collapse:collapse;">
    <tr><th style="border: 1px solid silver; background-color: #CCC;">Method</th><th style="border: 1px solid silver; background-color: #CCC;">Region Used</th></tr>
    <tr><td style="border: 1px solid silver; padding-left: 5px;">Muslim World League</td><td style="border: 1px solid silver; padding-left: 5px;">Europe, Far East, parts of US</td></tr>
    <tr><td style="border: 1px solid silver; padding-left: 5px;">Islamic Society of North America</td><td style="border: 1px solid silver; padding-left: 5px;">North America (US and Canada)</td></tr>
    <tr><td style="border: 1px solid silver; padding-left: 5px;">Egyptian General Authority of Survey </td><td style="border: 1px solid silver; padding-left: 5px;"> Africa, Syria, Lebanon, Malaysia</td></tr>
    <tr><td style="border: 1px solid silver; padding-left: 5px;">Umm al-Qura University, Makkah </td><td style="border: 1px solid silver; padding-left: 5px;"> Arabian Peninsula</td></tr>
    <tr><td style="border: 1px solid silver; padding-left: 5px;">University of Islamic Sciences, Karachi</td><td style="border: 1px solid silver; padding-left: 5px;">Pakistan, Afganistan, Bangladesh, India</td></tr>
    <tr><td style="border: 1px solid silver; padding-left: 5px;">Institute of Geophysics, University of Tehran</td><td style="border: 1px solid silver; padding-left: 5px;">Iran, Some Shia communities</td></tr>
    <tr><td style="border: 1px solid silver; padding-left: 5px;">Shia Ithna Ashari, Leva Research Institute, Qum &nbsp;</td><td style="border: 1px solid silver; padding-left: 5px;">Some Shia communities worldwide</td></tr>
    </table>
    </div></div>
    
    <div class="postbox">
	<h3 class="hndle" style="padding: 10px; margin: 0;"><span>Credits</span></h3>
	<div class="inside">
    <table class="form-table">
        <tr valign="top">
        <td>
    <p>Developer: <a href="http://facebook.com/imran2w">M.A. IMRAN</a><br />
    E-Mail: imran2w@gmail.com<br />
    Web: <a href="http://i-onlinemedia.net">www.i-onlinemedia.net</a></p><br/>
    <p align="justify">This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or ( at your option) any later version. This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the <a href="http://www.gnu.org/licenses/gpl.txt">GNU General Public License</a> for more details.</p><br/>
    <p align="justify">A project of <a href="http://i-onlinemedia.net">Islamic Online Media</a> - An extra-ordinary Islamic website of Bangladesh based on pure tawheed and sahih sunnah.</p>
    </td>
    <td>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=330291150372591&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div class="fb-like-box" data-href="https://www.facebook.com/islamiconlinemedia" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
    </td>
    </tr>
    </table>
    </div></div>

</div>
<?php
}

function salat_times_help($contextual_help, $screen_id, $screen) { //Contextual Help

	global $salat_times_hook;
	if ($screen_id == $salat_times_hook) {

		$contextual_help = 'For any help related to this plugin, contact <a href="http://facebook.com/imran2w">M.A. IMRAN</a>.<br/>E-Mail: imran2w@gmail.com<br/>Web: <a href="http://i-onlinemedia.net">www.i-onlinemedia.net</a><br/>View: <a href="http://wordpress.org/support/plugin/salat-times">Support Forum</a> | <a href="http://wordpress.org/extend/plugins/salat-times/changelog/">Changelog</a><br/>Wordpress Plugins Directory: <a href="http://wordpress.org/plugins/salat-times">http://wordpress.org/plugins/salat-times</a><br/><span style="color: red;">Please always keep this plugin up to date.</span>';
	}
	return $contextual_help;
}


function salat_times_admin() {
	
	global $salat_times_hook;
	$salat_times_hook = add_options_page('Salat Times Settings', 'Salat Times', 8, 'salat_times', 'salat_times_options_page');
}
	
function register_salat_times_settings() {
	register_setting( 'salat-times-settings-group', 'st_options' );
}

add_action('admin_menu', 'salat_times_admin');
add_action('admin_init', 'register_salat_times_settings');
add_filter('contextual_help', 'salat_times_help', 10, 3);
?>
