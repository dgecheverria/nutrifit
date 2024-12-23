<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">
        <?php
        /**
         * Functions hooked in to nutritix_single_post_top action
         *
         */
        do_action('nutritix_single_post_top');

        /**
         * Functions hooked in to nutritix_single_post action
         * @see nutritix_post_header         - 10
         * @see nutritix_post_thumbnail - 20
         * @see nutritix_post_content         - 30
         */
        do_action('nutritix_single_post');

        /**
         * Functions hooked in to nutritix_single_post_bottom action
         *
         * @see nutritix_post_taxonomy      - 5
         * @see nutritix_single_author      - 10
         * @see nutritix_post_nav            - 15
         * @see nutritix_display_comments    - 20
         */
        do_action('nutritix_single_post_bottom');
        ?>

    </div>

</article><!-- #post-## -->
