<?php 
	/*
	 * This file is used to generate comments form.
	 */	

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (post_password_required()){
		?> <p class="nopassword"><?php echo esc_html__('This post is password protected. Enter the password to view comments.','mosque_crunchpress'); ?></p> <?php
		return;
	}
if ( have_comments() ) : ?>
	<h3><?php comments_number(esc_html__('No Comment','mosque_crunchpress'), esc_html__('One Comment','mosque_crunchpress'), esc_html__('% Comments','mosque_crunchpress') );?></h3>
	<ul id="comments" class="comments-list">
		<?php wp_list_comments(array('callback' => 'get_comment_list')); ?>
	</ul>
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<br>
		<div class="comments-navigation">
			<div class="previous"> <?php previous_comments_link('Older Comments'); ?> </div>
			<div class="next"> <?php next_comments_link('Newer Comments'); ?> </div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<?php 

	$comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<li class="comment-form-author col-md-4">' .
						'<label for="author">' . esc_html__( 'Name', 'mosque_crunchpress' ) . ( $req ? '<span class="required">*</span>' : '' ).'</label> ' .
						'<input class="comm-field" id="author" name="author" type="text" value="' .
						esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .						
						'<div class="clear"></div>' .
						'</li><!-- #form-section-author .form-section -->',
			'email'  => '<li class="comment-form-email col-md-4">' .
						'<label for="email">' . esc_html__( 'Email', 'mosque_crunchpress' ) . ( $req ? '<span class="required">*</span>' : '' ) .'</label> ' .
						'<input id="email" class="comm-field" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />' .						
						'</li><!-- #form-section-email .form-section -->',
			'url'    => '<li class="comment-form-url col-md-4">' .
						'<label for="url">' . esc_html__( 'Website', 'mosque_crunchpress' ) . '</label>' .
						'<input id="url" class="comm-field" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .						
						'<div class="clear"></div>' .
						'</li><li class="comment-form-comment col-md-12"><!-- #form-section-url .form-section -->' ) ),
			'comment_field' => '' .
						'<div class="textarea-cp "><label for="comment">' . esc_html__( 'Comment Here', 'mosque_crunchpress' ) . '</label>' .
						'<textarea cols="60" rows="10" class="comm-area" id="comment" name="comment" aria-required="true"></textarea></div>' .
						'',
		'comment_notes_before' => '<div class="cp-comments"><ul class="form-list row">',
		'comment_notes_after' => '</li></ul></div><!-- #form-section-comment .form-section -->',
		'title_reply' => esc_html__('Leave a Reply','mosque_crunchpress'),
	);
	
	
	
	comment_form($comment_form, $post->ID); 
	

?>