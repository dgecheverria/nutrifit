<header id="masthead" class="site-header header-1" role="banner">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                nutritix_site_branding();
                if (nutritix_is_woocommerce_activated()) {
                    ?>
                    <div class="site-header-cart header-cart-mobile">
                        <?php nutritix_cart_link(); ?>
                    </div>
                    <?php
                }
                ?>
                <?php nutritix_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php nutritix_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    nutritix_header_account();
                    if (nutritix_is_woocommerce_activated()) {
                        nutritix_header_wishlist();
                        nutritix_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
