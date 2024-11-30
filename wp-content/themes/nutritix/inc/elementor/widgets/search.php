<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Nutritix_Elementor_Search extends Elementor\Widget_Base {
    public function get_name() {
        return 'nutritix-search';
    }

    public function get_title() {
        return esc_html__('Nutritix Search Form', 'nutritix');
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return array('nutritix-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'search-form-style',
            [
                'label' => esc_html__('Style', 'nutritix'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__('Layout Style', 'nutritix'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'nutritix'),
                    'layout-2' => esc_html__('Layout 2', 'nutritix'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_responsive_control(
            'border_width',
            [
                'label'      => esc_html__('Border width', 'nutritix'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} form input[type=search]' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => esc_html__('Border Color', 'nutritix'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color_focus',
            [
                'label'     => esc_html__('Border Color Focus', 'nutritix'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_form',
            [
                'label'     => esc_html__('Background Form', 'nutritix'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form input[type=search]' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_button',
            [
                'label'     => esc_html__('Background Button', 'nutritix'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} form button[type=submit]' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color_iconbutton',
            [
                'label'     => esc_html__('Color Icon Button', 'nutritix'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .widget form button[type=submit] i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_form',
            [
                'label'     => esc_html__('Color Icon', 'nutritix'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .widget_product_search form::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius_input',
            [
                'label'      => esc_html__('Border Radius Input', 'nutritix'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .widget_product_search form input[type=search]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ($settings['layout_style'] === 'layout-1'):{
            if(nutritix_is_woocommerce_activated()){
                nutritix_product_search();
            }else{
                ?>
                <div class="site-search widget_search">
                    <?php get_search_form(); ?>
                </div>
                <?php
            }

        }
        endif;

        if ($settings['layout_style'] === 'layout-2'):{
            wp_enqueue_script('nutritix-search-popup');
            add_action('wp_footer', 'nutritix_header_search_popup', 1);
            ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup">
                    <i class="nutritix-icon-search"></i>
                    <span class="content"><?php echo esc_html__('Search', 'nutritix'); ?></span>
                </a>
            </div>
            <?php
        }
        endif;
    }
}

$widgets_manager->register(new Nutritix_Elementor_Search());
