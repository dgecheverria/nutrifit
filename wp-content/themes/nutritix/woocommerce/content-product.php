<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('product-style-default', $product); ?>>
    <div class="product-block">
        <div class="product-transition">
            <?php nutritix_template_loop_product_thumbnail(); ?>
            <?php woocommerce_show_product_loop_sale_flash(); ?>
            <?php nutritix_woocommerce_get_product_label_stock(); ?>
            <div class="group-action top">
                <div class="shop-action vertical">
                    <?php nutritix_wishlist_button(); ?>
                    <?php nutritix_compare_button(); ?>
                    <?php nutritix_quickview_button(); ?>
                </div>
            </div>
            <?php woocommerce_template_loop_product_link_open(); ?>
            <?php woocommerce_template_loop_product_link_close(); ?>
        </div>
        <div class="product-caption">
            <?php nutritix_woocommerce_get_product_category(); ?>
            <?php woocommerce_template_loop_product_title(); ?>
            <?php woocommerce_template_loop_rating(); ?>
            <?php woocommerce_template_loop_price(); ?>
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
    </div>
</li>
