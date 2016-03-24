<?php

	/*	
	*	CrunchPress Comment File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file return the comment list to the selected post_type
	*	---------------------------------------------------------------------
	*/
	 
	function get_comment_list( $comment, $args, $depth ) {
	
		$GLOBALS['comment'] = $comment;
		
		switch ( $comment->comment_type ) :
			case 'pingback'  :
			case 'trackback' :
			?>
				<li class="post pingback">	
					<p>
						<?php esc_html_e( 'Pingback:', 'mosque_crunchpress'); ?>
						<?php comment_author_link(); ?>
						<?php edit_comment_link( esc_html__('(Edit)', 'mosque_crunchpress'), ' ' ); ?>
					</p>
				</li>
			<?php
				break;
				
			default :
			?>
				
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<div class="text-outer">
						<div class="text">
							<div class="comment-frame"><?php echo get_avatar( $comment, 60 ); ?></div>
							<div class="tex-box">
								<span class="reply-icon"><?php comment_reply_link( array_merge( $args, array( 'reply_text'=>'<i class="fa fa-mail-reply"></i>','depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
								<strong class="name"><?php echo get_comment_author_link(); ?></strong>
								<span class="date-time-cp"><i class="fa fa-calendar"></i><?php echo get_comment_time();?> - <?php echo get_comment_date();?></span>
								<?php comment_text(); ?>
							</div>
						</div>
                    </div>
				
				
			<?php
				break;
		endswitch;
		
	}
?>
