<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to nutritix_page action
	 *
	 * @see nutritix_page_header          - 10
	 * @see nutritix_page_content         - 20
	 *
	 */
	do_action( 'nutritix_page' );
	?>
</article><!-- #post-## -->
