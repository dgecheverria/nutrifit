<?php

use Elementor\Controls_Manager;
use Elementor\Element_Base;
use Elementor\Group_Control_Border;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Nutritix_Background_Column {

    public function __construct() {
        add_action('elementor/element/column/section_style/before_section_end', [$this, 'register_controls']);
    }

    public function register_controls(Element_Base $element) {
        $element->add_control(
            'nutritix_background_switcher',
            [
                'label'        => esc_html__('Theme Background', 'nutritix'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'nutritix-custom-background-',
                'separator' => 'before',
            ]
        );

        $element->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name'      => 'nutritix_background',
                'selector'  => '{{WRAPPER}}.nutritix-custom-background-yes > .elementor-widget-wrap:before',
                'condition' => [
                    'nutritix_background_switcher' => 'yes'
                ]
            ]
        );

        $element->add_control(
            "transform_skew_popover",
            [
                'label' => esc_html__( 'Skew', 'nutritix' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition' => [
                    'nutritix_background_switcher' => 'yes'
                ]
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            "transform_skewX_effect",
            [
                'label' => esc_html__( 'Skew X', 'nutritix' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'condition' => [
                    "transform_skew_popover!" => '',
                ],
                'selectors' => [
                    "{{WRAPPER}}.nutritix-custom-background-yes > .elementor-widget-wrap:before" => 'transform: skewX({{SIZE}}deg);',
                ],
            ]
        );

        $element->add_responsive_control(
            "transform_skewY_effect",
            [
                'label' => esc_html__( 'Skew Y', 'nutritix' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'condition' => [
                    "transform_skew_popover!" => '',
                ],
                'selectors' => [
                    "{{WRAPPER}}.nutritix-custom-background-yes > .elementor-widget-wrap:before" => 'transform: skewY({{SIZE}}deg);',
                ],
            ]
        );

        $element->end_popover();

        $element->add_control(
            'nutritix_background_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'nutritix'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}.nutritix-custom-background-yes > .elementor-widget-wrap:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'nutritix_background_switcher' => 'yes'
                ],
            ]
        );
    }
}

new Nutritix_Background_Column();
