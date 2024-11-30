<div class="column-item post-style-2">
    <div class="post-inner">
        <?php
        nutritix_post_thumbnail('nutritix-post-grid');
        ?>
        <div class="entry-content">
            <div class="top-content">
                <div class="entry-meta">
                    <?php nutritix_post_meta(); ?>
                </div>
                <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
            </div>
            <div class="bottom-content">
                <?php echo '<div class="more-link-wrap"><a class="more-link" href="' . get_permalink() . '"><span>' . esc_html__('Read more', 'nutritix') . '</span></a></div>'; ?>
            </div>
        </div>
    </div>
</div>
