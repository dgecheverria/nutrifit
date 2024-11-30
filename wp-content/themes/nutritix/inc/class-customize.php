<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Nutritix_Customize')) {

    class Nutritix_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_nutritix_blog($wp_customize);

            $this->init_nutritix_social($wp_customize);

            if (nutritix_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }

            do_action('nutritix_customize_register', $wp_customize);
        }


        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_nutritix_blog($wp_customize) {

            $wp_customize->add_section('nutritix_blog_archive', array(
                'title' => esc_html__('Blog', 'nutritix'),
            ));

            // =========================================
            // Select Style
            // =========================================

            $wp_customize->add_setting('nutritix_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_blog_style', array(
                'section' => 'nutritix_blog_archive',
                'label'   => esc_html__('Blog style', 'nutritix'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'nutritix'),
                    //====start_premium
                    'style-1'  => esc_html__('Blog Grid', 'nutritix'),
                    'style-2'  => esc_html__('Blog Overlay', 'nutritix'),
                    //====end_premium
                ),
            ));

            $wp_customize->add_setting('nutritix_options_blog_columns', array(
                'type'              => 'option',
                'default'           => 1,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_blog_columns', array(
                'section' => 'nutritix_blog_archive',
                'label'   => esc_html__('Colunms', 'nutritix'),
                'type'    => 'select',
                'choices' => array(
                    1 => esc_html__('1', 'nutritix'),
                    2 => esc_html__('2', 'nutritix'),
                    3 => esc_html__('3', 'nutritix'),
                    4 => esc_html__('4', 'nutritix'),
                ),
            ));

            $wp_customize->add_setting('nutritix_options_blog_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'right',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_blog_archive_sidebar', array(
                'section' => 'nutritix_blog_archive',
                'label'   => esc_html__('Sidebar Position', 'nutritix'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'nutritix'),
                    'right' => esc_html__('Right', 'nutritix'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_nutritix_social($wp_customize) {

            $wp_customize->add_section('nutritix_social', array(
                'title' => esc_html__('Socials', 'nutritix'),
            ));
            $wp_customize->add_setting('nutritix_options_social_share', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_social_share', array(
                'type'    => 'checkbox',
                'section' => 'nutritix_social',
                'label'   => esc_html__('Show Social Share', 'nutritix'),
            ));
            $wp_customize->add_setting('nutritix_options_social_share_facebook', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_social_share_facebook', array(
                'type'    => 'checkbox',
                'section' => 'nutritix_social',
                'label'   => esc_html__('Share on Facebook', 'nutritix'),
            ));
            $wp_customize->add_setting('nutritix_options_social_share_twitter', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_social_share_twitter', array(
                'type'    => 'checkbox',
                'section' => 'nutritix_social',
                'label'   => esc_html__('Share on Twitter', 'nutritix'),
            ));
            $wp_customize->add_setting('nutritix_options_social_share_linkedin', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_social_share_linkedin', array(
                'type'    => 'checkbox',
                'section' => 'nutritix_social',
                'label'   => esc_html__('Share on Linkedin', 'nutritix'),
            ));
            $wp_customize->add_setting('nutritix_options_social_share_google-plus', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_social_share_google-plus', array(
                'type'    => 'checkbox',
                'section' => 'nutritix_social',
                'label'   => esc_html__('Share on Google+', 'nutritix'),
            ));

            $wp_customize->add_setting('nutritix_options_social_share_pinterest', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_social_share_pinterest', array(
                'type'    => 'checkbox',
                'section' => 'nutritix_social',
                'label'   => esc_html__('Share on Pinterest', 'nutritix'),
            ));
            $wp_customize->add_setting('nutritix_options_social_share_email', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_social_share_email', array(
                'type'    => 'checkbox',
                'section' => 'nutritix_social',
                'label'   => esc_html__('Share on Email', 'nutritix'),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'nutritix'),
            ));

            $wp_customize->add_section('nutritix_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'nutritix'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('nutritix_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_woocommerce_archive_layout', array(
                'section' => 'nutritix_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'nutritix'),
                'type'    => 'select',
                'choices' => array(
                    'default'   => esc_html__('Sidebar', 'nutritix'),
                    //====start_premium
                    'canvas'    => esc_html__('Canvas Filter', 'nutritix'),
                    'dropdown'  => esc_html__('Dropdown Filter', 'nutritix'),
                    //====end_premium
                ),
            ));

            $wp_customize->add_setting('nutritix_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_woocommerce_archive_sidebar', array(
                'section' => 'nutritix_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'nutritix'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'nutritix'),
                    'right' => esc_html__('Right', 'nutritix'),

                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('nutritix_woocommerce_single', array(
                'title'      => esc_html__('Single Product', 'nutritix'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('nutritix_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('nutritix_options_single_product_gallery_layout', array(
                'section' => 'nutritix_woocommerce_single',
                'label'   => esc_html__('Style', 'nutritix'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal' => esc_html__('Horizontal', 'nutritix'),
                    //====start_premium
                    'vertical'   => esc_html__('Vertical', 'nutritix'),
                    'gallery'    => esc_html__('Gallery', 'nutritix'),
                    'sticky'     => esc_html__('Sticky', 'nutritix'),
                    //====end_premium
                ),
            ));

            $wp_customize->add_setting('nutritix_options_single_product_content_meta', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'nutritix_sanitize_editor',
            ));

            $wp_customize->add_control(new Nutritix_Customize_Control_Editor($wp_customize, 'nutritix_options_single_product_content_meta', array(
                'section' => 'nutritix_woocommerce_single',
                'label'   => esc_html__('Single extra description', 'nutritix'),
            )));


            // =========================================
            // Product
            // =========================================

            $wp_customize->add_section('nutritix_woocommerce_product', array(
                'title'      => esc_html__('Product Block', 'nutritix'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('nutritix_options_wocommerce_block_style', array(
                'type'              => 'option',
                'default'           => '',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('nutritix_options_wocommerce_block_style', array(
                'section' => 'nutritix_woocommerce_product',
                'label'   => esc_html__('Style', 'nutritix'),
                'type'    => 'select',
                'choices' => array(
                    ''  => esc_html__('Style 1', 'nutritix'),
                ),
            ));

            $wp_customize->add_setting('nutritix_options_woocommerce_product_hover', array(
                'type'              => 'option',
                'default'           => 'none',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('nutritix_options_woocommerce_product_hover', array(
                'section' => 'nutritix_woocommerce_product',
                'label'   => esc_html__('Animation Image Hover', 'nutritix'),
                'type'    => 'select',
                'choices' => array(
                    'none'          => esc_html__('None', 'nutritix'),
                    'bottom-to-top' => esc_html__('Bottom to Top', 'nutritix'),
                    'top-to-bottom' => esc_html__('Top to Bottom', 'nutritix'),
                    'right-to-left' => esc_html__('Right to Left', 'nutritix'),
                    'left-to-right' => esc_html__('Left to Right', 'nutritix'),
                    'swap'          => esc_html__('Swap', 'nutritix'),
                    'fade'          => esc_html__('Fade', 'nutritix'),
                    'zoom-in'       => esc_html__('Zoom In', 'nutritix'),
                    'zoom-out'      => esc_html__('Zoom Out', 'nutritix'),
                ),
            ));

            $wp_customize->add_setting('nutritix_options_wocommerce_row_laptop', array(
                'type'              => 'option',
                'default'           => 3,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_wocommerce_row_laptop', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row Laptop', 'nutritix'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('nutritix_options_wocommerce_row_tablet', array(
                'type'              => 'option',
                'default'           => 2,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_wocommerce_row_tablet', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row tablet', 'nutritix'),
                'type'    => 'number',
            ));

            $wp_customize->add_setting('nutritix_options_wocommerce_row_mobile', array(
                'type'              => 'option',
                'default'           => 1,
                'transport'         => 'postMessage',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('nutritix_options_wocommerce_row_mobile', array(
                'section' => 'woocommerce_product_catalog',
                'label'   => esc_html__('Products per row mobile', 'nutritix'),
                'type'    => 'number',
            ));
        }
    }
}
return new Nutritix_Customize();
