<article id="post-<?php the_ID(); ?>" <?php post_class('article-default'); ?>>
    <div class="post-inner">
        <?php nutritix_post_thumbnail('post-thumbnail'); ?>
        <div class="post-content">
            <?php
            /**
             * Functions hooked in to nutritix_loop_post action.
             *
             * @see nutritix_post_header          - 15
             * @see nutritix_post_content         - 30
             */
            do_action('nutritix_loop_post');
            ?>
        </div>
    </div>
</article><!-- #post-## -->