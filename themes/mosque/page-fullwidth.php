<?php
/**
 * Template Name: Full Width Page
 *
 * @package CrunchPress
 * @subpackage Mosque
 */

 	//Fetch the theme Option Values
	// $cp_maintenance_mode = cp_get_themeoption_value('maintenance_mode','general_settings');
	// $maintenace_title = cp_get_themeoption_value('maintenace_title','general_settings');
	// $countdown_time = cp_get_themeoption_value('countdown_time','general_settings');
	// $email_mainte = cp_get_themeoption_value('email_mainte','general_settings');
	// $mainte_description = cp_get_themeoption_value('mainte_description','general_settings');
	// $social_icons_mainte = cp_get_themeoption_value('social_icons_mainte','general_settings');
	//
	// if($cp_maintenance_mode <> 'disable'){
	// 	//If Logged in then Remove Maintenance Page
	// 	if ( is_user_logged_in() ) {
	// 		$cp_maintenance_mode = 'disable';
	// 	} else {
	// 		$cp_maintenance_mode = 'enable';
	// 	}
	// }
	//
	// if($cp_maintenance_mode == 'enable'){
	// 	//Trigger the Maintenance Mode Function Here
	// 	cp_maintenance_mode_fun();
	// }else{
//
// get_header ();


	//Reset all data now
	// wp_reset_query();
	// wp_reset_postdata();

  // Start the loop.
?>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content();
  endwhile; else: ?>
    <p>Sorry, no posts matched your criteria.</p>
  <?php endif; ?>
