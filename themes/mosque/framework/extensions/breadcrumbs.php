<?php 
/*	
*	CrunchPress Pagination File
*	---------------------------------------------------------------------
* 	@version	1.0
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file return the Breadcrumbs to the selected post_type
*	---------------------------------------------------------------------
*/
function cp_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = ''; // delimiter between crumbs
  $home = esc_html__('Home','mosque_crunchpress'); // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<li class="current">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb
 
  global $post;
  $homeLink = esc_url(home_url('/'));
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<ul class="breadcrumb pull-right" id="breadcrumb"><li class="home_bread"><a href="' . esc_url($homeLink) . '">'.esc_attr($home).'</a></li></ul>';
 
  } else {
 
    echo '<ul class="breadcrumb pull-right" id="breadcrumb"><li class="home_bread"><a href="' . $homeLink . '">'.$home.'</a> ' . $delimiter . '</li> ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo html_entity_decode($before) . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo html_entity_decode($before) . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li> ';
      echo html_entity_decode($before) . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' </li>';
      echo html_entity_decode($before) . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo html_entity_decode($before) . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
		$post_type = get_post_type_object(get_post_type());
		$cat = array();
		//print_r($post_type->name);
		if($post_type->name == 'event'){
			$categories = get_the_terms( $post->ID, 'event-categories' );
			if($categories <> ''){
				foreach ( $categories as $category ) {
					$cat[] = $category;
				}
			}
			if(isset($cat[0])){$cat = $cat[0];}
			
			if ($showCurrent == 1) echo html_entity_decode($before) . substr(get_the_title(),0,35) . $after;	
		}else if($post_type->name == 'career'){
			$categories = get_the_terms( $post->ID, 'career-category' );
			if($categories <> ''){
				foreach ( $categories as $category ) {
					$cat[] = $category;
				}
			}
			if(isset($cat[0])){$cat = $cat[0];}
			echo '<li><a href="'.get_term_link(intval($cat->term_id),'career-category').'">'.$cat->name.'</a></li>';
			if ($showCurrent == 1) echo html_entity_decode($before) . substr(get_the_title(),0,35) . $after;	
		}else if($post_type->name == 'attraction'){
			$categories = get_the_terms( $post->ID, 'attraction-category' );
			if($categories <> ''){
				foreach ( $categories as $category ) {
					$cat[] = $category;
				}
			}
			if(isset($cat[0])){$cat = $cat[0];}
			echo '<li><a href="'.get_term_link(intval($cat->term_id),'attraction-category').'">'.$cat->name.'</a></li>';
			if ($showCurrent == 1) echo html_entity_decode($before) . substr(get_the_title(),0,35) . $after;	
		}else if($post_type->name == 'testimonial'){
			$categories = get_the_terms( $post->ID, 'testimonial-category' );
			if($categories <> ''){
				foreach ( $categories as $category ) {
					$cat[] = $category;
				}
			}
			if(isset($cat[0])){$cat = $cat[0];}
			echo '<li><a href="'.get_term_link(intval($cat->term_id),'testimonial-category').'">'.$cat->name.'</a></li>';
			if ($showCurrent == 1) echo html_entity_decode($before) . substr(get_the_title(),0,35) . $after;	
		}else if($post_type->name == 'portfolio'){
			$categories = get_the_terms( $post->ID, 'portfolio-category' );
			if($categories <> ''){
				foreach ( $categories as $category ) {
					$cat[] = $category;
				}
			}
			if(isset($cat[0])){$cat = $cat[0];
				echo '<li><a href="'.get_term_link(intval($cat->term_id),'portfolio-category').'">'.$cat->name.'</a></li>';
			}
			if ($showCurrent == 1) echo html_entity_decode($before) . substr(get_the_title(),0,35) . $after;	
		}else{
			global $wp_query,$post;
			
			$post_type = get_post_type_object(get_post_type());
			$slug = $post_type->rewrite;
			echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->name . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . ' </li>' . $before . substr(get_the_title(),0,35) . $after;
		}
      } else {
        $cat = get_the_category(); 
		//print_r($cat);
		$cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo '<li>'.$cats.'</li>';
        if ($showCurrent == 1) echo html_entity_decode($before) . substr(get_the_title(),0,35) . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      echo html_entity_decode($before) . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      //$cat = get_the_category($parent->ID); $cat = $cat[0];
      //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' </li>' . $before . substr(get_the_title(),0,35) . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo html_entity_decode($before) . substr(get_the_title(),0,35) . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . substr(get_the_title($page->ID),0,35) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo html_entity_decode($breadcrumbs[$i]);
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . substr(get_the_title(),0,35) . $after;
 
    } elseif ( is_tag() ) {
      echo html_entity_decode($before) . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo html_entity_decode($before) . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo html_entity_decode($before) . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</ul>';
 
  }
} // end cp_breadcrumbs()

  function cp_archive_title() {
    echo '<h3>';
    if ( is_category() ) {
      echo esc_html__('Category:','mosque_crunchpress');
      echo single_cat_title('', false);
 
    } elseif ( is_search() ) {
	  echo esc_html__('Search results for:','mosque_crunchpress');
      echo get_search_query();
 
    } elseif ( is_day() ) {
	  echo esc_html__('Archive:','mosque_crunchpress');
      echo get_year_link(get_the_time('Y')) . get_the_time('Y');
      echo get_month_link(get_the_time('Y'),get_the_time('m')) .  get_the_time('F');
      echo get_the_time('d');
 
    } elseif ( is_month() ) {
	  echo esc_html__('Archive:','mosque_crunchpress');
	  echo  get_the_time('F') ;
	  echo  ',';
      echo  get_the_time('Y') ;
      
 
    } elseif ( is_year() ) {
	  echo esc_html__('Archive:','mosque_crunchpress');
      echo get_the_time('Y');  
	}
	  echo '</h3>';
  }
?>