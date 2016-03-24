<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new class_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="crunchp-popup">

	<div id="crunchp-shortcode-wrap">

		<div id="crunchp-sc-form-wrap">
<!--
3D_button
accordion
alert
blog
buttons
checklist
content_box
counters_circle
dropcap
event_circle_counter
event_counter_box
flexslider
fontawesome
full_width
google_map
highlight
image_carousel
image_frame
lightbox
metro_button
person
pricing_table
progress_bar
progress_circle
recent_posts
recent_projects
separator
services
sidebar
slider
sound-cloud
table
tabs
testimonial
testimonials
text
title
tooltip
vimeo
woo_products
youtube
-->
			<?php			
				$select_shortcode = array(
					//'select' => 'Choose a Shortcode',
					'1' => array('name' =>'3D Buttons','slug' => '3D_button','icon' => 'fa fa-th-large'),
					'2' => array('name' =>'Accordion','slug' => 'accordion','icon' => 'fa fa-align-justify'),
					'3' => array('name' =>'Alert','slug' => 'alert','icon' => 'fa fa-exclamation-circle'),
					'4' => array('name' =>'Buttons','slug' => 'buttons','icon' => 'fa fa-square'),
					//'5' => array('name' =>'Blog','slug' => 'blog','icon' => 'fa fa-edit'),
					'6' => array('name' =>'Checklist','slug' => 'checklist','icon' => 'fa fa-list-ol'),
					'7' => array('name' =>'Content Box','slug' => 'content_box','icon' => 'fa fa-edit'),
					'8' => array('name' =>'Columns','slug' => 'columns','icon' => 'fa fa-columns'),
					'9' => array('name' =>'Counter Circle','slug' => 'counters_circle','icon' => 'fa fa-circle-o'),
					'10' => array('name' =>'Dropcap','slug' => 'dropcap','icon' => 'fa fa-subscript'),
					'11' => array('name' =>'Donation','slug' => 'cp_donation','icon' => 'fa fa-money'),
					'12' => array('name' =>'Event Circle','slug' => 'event_circle_counter','icon' => 'fa fa-calendar-o'),
					'13' => array('name' =>'Event Counter','slug' => 'event_counter_box','icon' => 'fa fa-calendar'),
					//'14' => array('name' =>'Flexslider','slug' => 'flexslider','icon' => 'fa fa-picture-o'),
					'15' => array('name' =>'Font Awesome','slug' => 'fontawesome','icon' => 'fa fa-flag-o'),
					'16' => array('name' =>'Full Width','slug' => 'full_width','icon' => 'fa fa-arrows-h'),
					'47' => array('name' =>'Feature Project','slug' => 'feature_project','icon' => 'fa fa-user'),
					'17' => array('name' =>'Google Map','slug' => 'google_map','icon' => 'fa fa-map-marker'),
					'18' => array('name' =>'Highlight','slug' => 'highlight','icon' => 'fa fa-star-half-o'),
					'54' => array('name' =>'Heading','slug' => 'heading','icon' => 'fa fa-header'),
					'19' => array('name' =>'Image Carousel','slug' => 'image_carousel','icon' => 'fa fa-picture-o'),
					//'20' => array('name' =>'Image Frames','slug' => 'image_frame','icon' => 'fa fa-tablet'),
					'21' => array('name' =>'Lightbox','slug' => 'lightbox','icon' => 'fa fa-external-link-square'),
					'22' => array('name' =>'Metro Btn','slug' => 'metro_button','icon' => 'fa fa-square-o'),
					'47' => array('name' =>'Member Btn','slug' => 'membership_button','icon' => 'fa fa-user'),
					'51' => array('name' =>'Newsletter','slug' => 'newsletter','icon' => 'fa fa-envelope'),
					'23' => array('name' =>'Our Team','slug' => 'person','icon' => 'fa fa-users'),
					'24' => array('name' =>'Price Table','slug' => 'pricing_table','icon' => 'fa fa-dollar'),
					'25' => array('name' =>'Progress Bar','slug' => 'progress_bar','icon' => 'fa fa-refresh'),
					'26' => array('name' =>'Progress Circle','slug' => 'progress_circle','icon' => 'fa fa-refresh'),
					'27' => array('name' =>'Product Category','slug' => 'show_category','icon' => 'fa fa-user'),
					
					'28' => array('name' =>'Product BX','slug' => 'product_BX','icon' => 'fa fa-user'),
					'29' => array('name' =>'Project Facts','slug' => 'project_facts','icon' => 'fa fa-info-circle'),
					'30' => array('name' =>'CF Slider','slug' => 'project_slider','icon' => 'fa fa-info-circle'),
					//'30' => array('name' =>'Recent Posts','slug' => 'recent_posts','icon' => 'fa fa-bolt'),
					'31' => array('name' =>'Recent Works','slug' => 'recent_projects','icon' => 'fa fa-briefcase'),
					'32' => array('name' =>'Separator','slug' => 'separator','icon' => 'fa fa-minus'),
					'33' => array('name' =>'Services','slug' => 'services','icon' => 'fa fa-truck'),
					'34' => array('name' =>'Sidebar','slug' => 'sidebar','icon' => 'fa fa-exchange'),
					'35' => array('name' =>'Slider','slug' => 'slider','icon' => 'fa fa-folder-open-o'),
					'48' => array('name' =>'Main Slider','slug' => 'cp_slider','icon' => 'fa fa-folder-open-o'),
					'36' => array('name' =>'Sound Cloud','slug' => 'sound-cloud','icon' => 'fa fa-cloud'),
					'37' => array('name' =>'Table','slug' => 'table','icon' => 'fa fa-table'),
					'38' => array('name' =>'Tabs','slug' => 'tabs','icon' => 'fa fa-list-ul'),
					'39' => array('name' =>'Testimonial','slug' => 'testimonial','icon' => 'fa fa-quote-right'),
					'40' => array('name' =>'Testimonials','slug' => 'testimonials','icon' => 'fa fa-quote-left'),
					'41' => array('name' =>'Text','slug' => 'text','icon' => 'fa fa-font'),
					'42' => array('name' =>'Title','slug' => 'title','icon' => 'fa fa-text-width'),
					'43' => array('name' =>'Tooltip','slug' => 'tooltip','icon' => 'fa fa-copy'),
					'44' => array('name' =>'Vimeo','slug' => 'vimeo','icon' => 'fa fa-vimeo-square'),
					//'45' => array('name' =>'Woo Products','slug' => 'woo_products','icon' => 'fa fa-shopping-cart'),
					'46' => array('name' =>'Youtube','slug' => 'youtube','icon' => 'fa fa-youtube'),
					'52' => array('name' =>'Locator','slug' => 'locators','icon' => 'fa fa-map-marker'),
					'53' => array('name' =>'News Post Slider','slug' => 'newspost_slider','icon' => 'fa fa-cloud'),
					'55' => array('name' =>'Salat Times','slug' => 'salat_times','icon' => 'fa fa-circle-o'),
					'56' => array('name' =>'Welcome','slug' => 'welcome','icon' => 'fa fa-copy'),
				);
			?>
			<table id="cp-sc-form-table" class="cp-shortcode-selector bootstrap_admin">
				<tbody>
					<tr class="form-row">
						<td class="field full-width">
							<div class="cp-form-select-field">
								<ul class="element_backend parent_width">
								<!--<select name="fusion_select_shortcode" id="fusion_select_shortcode" class="fusion-form-select crunchp-input">-->
									<?php foreach($select_shortcode as $shortcode_value): ?>
									<?php if($shortcode_value['slug'] == $popup): $selected = 'selected="selected"'; else: $selected = ''; endif; ?>
									<li class="drag_able element_width "><a rel="<?php echo $shortcode_value['slug']; ?>" id="" class="cp_shortcode_icon"><span class="inside_fontAw"><i class="<?php echo $shortcode_value['icon']; ?>"></i></span><span class="text-bg"><?php echo $shortcode_value['name']; ?></span></a></li>
									<?php endforeach; ?>
								<!--</select>-->
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<div id="go-back"><a rel="goback" class="goback-now" onclick="tinyMCE.execCommand('CPPopup');return false;">Back</a></div>
			<form method="post" id="cp-sc-form">

				<table id="cp-sc-form-table">

					<?php echo $shortcode->output; ?>

					<tbody class="cp-sc-form-button">
						<tr class="form-row">
							<td class="field"><a href="#" class="crunchp-insert">Insert Shortcode</a></td>
						</tr>
					</tbody>

				</table>
				<!-- /#cp-sc-form-table -->

			</form>
			<!-- /#crunchp-sc-form -->

		</div>
		<!-- /#crunchp-sc-form-wrap -->

		<div class="clear"></div>

	</div>
	<!-- /#crunchp-shortcode-wrap -->

</div>
<!-- /#crunchp-popup -->

</body>
</html>