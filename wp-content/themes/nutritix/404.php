<?php
get_header(); ?>

    <div id="primary" class="content">
        <main id="main" class="site-main">
            <div class="error-404 not-found">
                <div class="page-content">
                    <div class="error-img404">
                        <img src="<?php echo get_theme_file_uri('assets/images/404/404_image.png') ?>"
                             alt="<?php echo esc_attr__('404 Page', 'nutritix'); ?>">
                    </div>
                    <header class="page-header">
                        <h2 class="sub-title"><?php esc_html_e('Oops! That Page Can’t Be Found.', 'nutritix'); ?></h2>
                    </header><!-- .page-header -->
                    <div class="error-text">
                        <span><?php esc_html_e('The Page you are looking for doesn\'t exitst or an other error occured. Go to ', 'nutritix') ?><a
                                    href="<?php echo esc_url(home_url('/')); ?>"
                                    class="return-home"><?php esc_html_e('Home page', 'nutritix'); ?></a></span>
                    </div>
                </div><!-- .page-content -->
            </div><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php

get_footer();
