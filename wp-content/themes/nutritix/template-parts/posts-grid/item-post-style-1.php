<div class="column-item post-style-1">
    <div class="post-inner">
        <?php
        nutritix_post_thumbnail('nutritix-post-grid');
        ?>
        <div class="entry-content">
            <div class="entry-meta">
                <?php nutritix_post_meta(); ?>
            </div>
            <?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
        </div>
    </div>
</div>
