<?php
/**
 * =================================================
 * Hook nutritix_page
 * =================================================
 */
add_action('nutritix_page', 'nutritix_page_header', 10);
add_action('nutritix_page', 'nutritix_page_content', 20);

/**
 * =================================================
 * Hook nutritix_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook nutritix_single_post
 * =================================================
 */
add_action('nutritix_single_post', 'nutritix_post_header', 10);
add_action('nutritix_single_post', 'nutritix_post_thumbnail', 20);
add_action('nutritix_single_post', 'nutritix_post_content', 30);

/**
 * =================================================
 * Hook nutritix_single_post_bottom
 * =================================================
 */
add_action('nutritix_single_post_bottom', 'nutritix_post_taxonomy', 5);
add_action('nutritix_single_post_bottom', 'nutritix_single_author', 10);
add_action('nutritix_single_post_bottom', 'nutritix_post_nav', 15);
add_action('nutritix_single_post_bottom', 'nutritix_display_comments', 20);

/**
 * =================================================
 * Hook nutritix_loop_post
 * =================================================
 */
add_action('nutritix_loop_post', 'nutritix_post_header', 15);
add_action('nutritix_loop_post', 'nutritix_post_content', 30);

/**
 * =================================================
 * Hook nutritix_footer
 * =================================================
 */
add_action('nutritix_footer', 'nutritix_footer_default', 20);

/**
 * =================================================
 * Hook nutritix_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'nutritix_template_account_dropdown', 1);
add_action('wp_footer', 'nutritix_mobile_nav', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'nutritix_pingback_header', 1);

/**
 * =================================================
 * Hook nutritix_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook nutritix_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook nutritix_content_top
 * =================================================
 */

/**
 * =================================================
 * Hook nutritix_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook nutritix_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook nutritix_sidebar
 * =================================================
 */
add_action('nutritix_sidebar', 'nutritix_get_sidebar', 10);

/**
 * =================================================
 * Hook nutritix_loop_after
 * =================================================
 */
add_action('nutritix_loop_after', 'nutritix_paging_nav', 10);

/**
 * =================================================
 * Hook nutritix_page_after
 * =================================================
 */
add_action('nutritix_page_after', 'nutritix_display_comments', 10);

/**
 * =================================================
 * Hook nutritix_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook nutritix_woocommerce_before_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook nutritix_woocommerce_after_shop_loop_item
 * =================================================
 */
