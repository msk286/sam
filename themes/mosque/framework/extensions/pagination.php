<?php 
/*	
*	CrunchPress Pagination File
*	---------------------------------------------------------------------
* 	@version	1.0
* 	@author		CrunchPress
* 	@link		http://crunchpress.com
* 	@copyright	Copyright (c) CrunchPress
*	---------------------------------------------------------------------
*	This file return the Pagination to the selected post_type
*	---------------------------------------------------------------------
*/
	
	if( !function_exists('cp_pagination') ){
		function cp_pagination($pages = '', $range = 4)
		{
			
			// Don't print empty markup if there's only one page.
			if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
				return;
			}

			$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
			$pagenum_link = html_entity_decode( get_pagenum_link() );
			$query_args   = array();
			$url_parts    = explode( '?', $pagenum_link );

			if ( isset( $url_parts[1] ) ) {
				wp_parse_str( $url_parts[1], $query_args );
			}

			$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
			$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

			$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
			$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

			// Set up paginated links.
			$links = paginate_links( array(
				'base'     => $pagenum_link,
				'format'   => $format,
				'total'    => $GLOBALS['wp_query']->max_num_pages,
				'current'  => $paged,
				'mid_size' => 1,
				'add_args' => array_map( 'urlencode', $query_args ),
				'prev_text' => esc_html__( '<', 'mosque_crunchpress' ),
				'next_text' => esc_html__( '>', 'mosque_crunchpress' ),
			) );

			if ( $links ) :

			?>
			<div class="pagination-all cp_pagination" role="navigation">
				<ul class='pagination'>
					<li>
						<?php echo html_entity_decode($links); ?>
					</li>
				</ul><!-- .pagination -->
			</div><!-- .navigation -->
			<?php
			endif;

		}
	}
	
	
	if( !function_exists('cp_post_nav') ){
		function cp_post_nav() {
			// Don't print empty markup if there's nowhere to navigate.
			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}

			?>			
			<div class="nav-links">
				<?php
				if ( is_attachment() ) :
					previous_post_link( '%link', esc_html__( '<span class="meta-nav">Published In</span>%title', 'mosque_crunchpress' ) );
				else :
					previous_post_link( '%link', esc_html__( '<span class="meta-nav">Previous Post</span>%title', 'mosque_crunchpress' ) );
					next_post_link( '%link', esc_html__( '<span class="meta-nav">Next Post</span>%title', 'mosque_crunchpress' ) );
				endif;
				?>
			</div><!-- .nav-links -->			
			<?php
		}
	}
	
	
	if( !function_exists('cp_post_next') ){
		function cp_post_next() {
			// Don't print empty markup if there's nowhere to navigate.
			$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}

				if ( is_attachment() ) :
					echo '<div class="portfolio-thumb">';
					previous_post_link( '%link', esc_html__( '<span class="meta-nav">Published In</span>%title', 'mosque_crunchpress' ) );
					echo '</div>';
				else :
					echo '<div class="portfolio-thumb">';
					previous_post_link( '%link', esc_html__( '<span class="meta-nav">Previous Post</span>%title', 'mosque_crunchpress' ) );
					next_post_link( '%link', esc_html__( '<span class="meta-nav">Next Post</span>%title', 'mosque_crunchpress' ) );
					echo '</div>';
				endif;
		}
	}
	
	if( !function_exists('pagination_crunch') ){
		function pagination_crunch($pages = '', $range = 4)
		{
			 $showitems = ($range * 2)+1;  
		 
			 global $paged;
			 if(empty($paged)) $paged = 1;
	
			 if($pages == '')
			 {
				 global $wp_query;
				 
				 $pages = $wp_query->max_num_pages;
				 
				 if(!$pages)
				 {
					 $pages = 1;
				 }
			 }   
		 
			 if(1 != $pages)
			 {		
				echo '<div class="pagination-all cp_pagination" role="navigation">
				<ul class="pagination">';
				 
				 if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo; First</a></li>";
				 if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a></li>";
		 
				 for ($i=1; $i <= $pages; $i++)
				 {
					 if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
					 {
						 echo ($paged == $i)? "<li class=\"active\"><a href='".get_pagenum_link($i)."'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
					 }
				 }
		 
				 if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a></li>";
				 if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Last &raquo;</a></li>";
				 echo "</ul>\n";
				 echo '</div>';
			 }
		}
	}
?>