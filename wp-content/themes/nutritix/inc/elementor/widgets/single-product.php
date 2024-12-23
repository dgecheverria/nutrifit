<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

/**
 * Elementor Single product.
 *
 * @since 1.0.0
 */
class Nutritix_Elementor_Single_Product extends Elementor\Widget_Base {

    public function get_categories() {
        return ['nutritix-addons'];
    }

    public function get_name() {
        return 'nutritix-single-product';
    }

    public function get_title() {
        return esc_html__('Nutritix Single Product', 'nutritix');
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'nutritix'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'id_product',
            [
                'label' => esc_html__('Products name', 'nutritix'),
                'type' => 'products',
                'label_block' => true,
                'multiple' => false,
            ]
        );

        $this->add_responsive_control(
            'width_title',
            [
                'label' => esc_html__('Width Title', 'nutritix'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woosb-products .woosb-product .woosb-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!$settings['id_product']) {
            return;
        }
        wp_enqueue_script('wc-single-product');

        $args = array(
            'posts_per_page'      => 1,
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'no_found_rows'       => 1,
            'post__in'            => [$settings['id_product']]
        );

        $products = new WP_Query($args);


        $this->add_render_attribute('wrapper', 'class', 'nutritix-elementor-single-product');

        remove_action('woocommerce_after_add_to_cart_button', 'nutritix_wishlist_button', 31);
        remove_action('woocommerce_after_add_to_cart_button', 'nutritix_compare_button', 32);
        ?>
        <div <?php echo nutritix_elementor_get_render_attribute_string('wrapper', $this); ?>>
            <?php
            while ($products->have_posts()) {
                $products->the_post();
                global $product;
                do_action('woocommerce_' . $product->get_type() . '_add_to_cart');
                ?>
            <?php } ?>
        </div>
        <?php
        wp_reset_postdata();
    }
}

$widgets_manager->register(new Nutritix_Elementor_Single_Product());
