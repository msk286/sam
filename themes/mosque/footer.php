<?php

/**

 * The template for displaying the footer

 * Contains footer content and the closing of the #main and #page div elements.

 * @package CrunchPress

 * @subpackage Pageant

 */

?>

	<?php 

		global $footer_style,$post;

		if(isset($post)){

			$footer_style = get_post_meta ( $post->ID, "page-option-bottom-footer-style", true );

		}else{

			$footer_style = '';

		}

		cp_footer_html($footer_style);

	?>

<div class="cp_search_overlay"></div>

<div class="clearfix"></div>

</div></div>

<!-- main end -->

<?php wp_footer(); ?>

</body>

</html>