<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('product-list', $product); ?>>
    <?php
    /**
     * Functions hooked in to nutritix_woocommerce_before_shop_loop_item action
     *
     */
    do_action('nutritix_woocommerce_before_shop_loop_item');


    ?>
    <div class="product-transition">
        <div class="product-image">
            <?php
            /**
             * Functions hooked in to nutritix_woocommerce_before_shop_loop_item_title action
             *
             * @see woocommerce_template_loop_product_thumbnail - 15 - woo
             * @see woocommerce_show_product_loop_sale_flash - 20 - woo
             *
             */
            do_action('nutritix_woocommerce_before_shop_loop_item_title');
            ?>
        </div>
    </div>
    <div class="product-caption">
        <?php nutritix_woocommerce_get_product_category(); ?>
        <?php woocommerce_template_loop_product_title(); ?>
        <?php woocommerce_template_loop_rating(); ?>
        <?php woocommerce_template_loop_price(); ?>
        <?php nutritix_woocommerce_get_product_description();  ?>
        <?php woocommerce_template_loop_add_to_cart(); ?>
        <div class="group-action">
            <div class="shop-action">
                <?php nutritix_quickview_button(); ?>
                <?php nutritix_wishlist_button(); ?>
                <?php nutritix_compare_button(); ?>
            </div>
        </div>
    </div>
    <?php
    /**
     * Functions hooked in to nutritix_woocommerce_after_shop_loop_item action
     *
     */
    do_action('nutritix_woocommerce_after_shop_loop_item');
    ?>
</li>
