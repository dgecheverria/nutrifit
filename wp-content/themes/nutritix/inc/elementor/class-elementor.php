<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Nutritix_Elementor')) :

    /**
     * The Nutritix Elementor Integration class
     */
    class Nutritix_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'customs_widgets'));
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);
            add_action('wp_enqueue_scripts', [$this, 'animations_scroll_style_src'], 20);

            // Elementor Fix Noitice WooCommerce
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/controls_registered', [$this, 'add_icons']);

            // Add Breakpoints
            add_action('wp_enqueue_scripts', 'nutritix_elementor_breakpoints', 9999);

            require trailingslashit(get_template_directory()) . 'inc/elementor/background-column.php';

            if (!nutritix_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/custom-css.php';
                require trailingslashit(get_template_directory()) . 'inc/elementor/sticky-section.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
            }

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);
            add_action('wp_enqueue_scripts', [$this, 'elementor_kit']);
        }

        public function elementor_kit() {
            $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
            Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
            $myvals = get_post_meta($active_kit_id, '_elementor_page_settings', true);
            if (!empty($myvals)) {
                $css = '';
                foreach ($myvals['system_colors'] as $key => $value) {
                    $css .= $value['color'] !== '' ? '--' . $value['_id'] . ':' . $value['color'] . ';' : '';
                }

                $var = "body{{$css}}";
                wp_add_inline_style('nutritix-style', $var);
            }
        }

        public function additional_fonts($fonts) {
            $fonts["Plus Jakarta Sans"]     = 'system';
            $fonts["Nutritix Heading"]     = 'system';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = esc_html__('Shortcode', 'nutritix');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            global $nutritix_version;
            wp_enqueue_script('nutritix-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $nutritix_version);
        }

        public function add_style_editor() {
            global $nutritix_version;
            wp_enqueue_style('nutritix-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $nutritix_version);
        }

        public function add_scripts() {
            global $nutritix_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('nutritix-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $nutritix_version);
            wp_style_add_data('nutritix-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/vendor/TweenMax.min.js'), array('jquery'), '1.11.1');
            wp_register_script('parallaxmouse', get_theme_file_uri('/assets/js/vendor/jquery-parallax.js'), array('jquery'), $nutritix_version);

            if (nutritix_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('tweenmax');
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/vendor/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }
        }


        public function register_auto_scripts_frontend() {
            global $nutritix_version;
            wp_register_script('nutritix-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-dokan-store', get_theme_file_uri('/assets/js/elementor/dokan-store.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-image-gallery', get_theme_file_uri('/assets/js/elementor/image-gallery.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-product-categories', get_theme_file_uri('/assets/js/elementor/product-categories.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-product-tab', get_theme_file_uri('/assets/js/elementor/product-tab.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-tabs', get_theme_file_uri('/assets/js/elementor/tabs.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-team-box', get_theme_file_uri('/assets/js/elementor/team-box.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
            wp_register_script('nutritix-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $nutritix_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'nutritix-addons',
                array(
                    'title' => esc_html__('Nutritix Addons', 'nutritix'),
                    'icon'  => 'fa fa-plug',
                ),
                1);
        }

        public function add_animations_scroll($animations) {
            $animations['Nutritix Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        public function animations_scroll_style_src() {
            global $nutritix_version;
            $animations = [
                'opal-move-up',
                'opal-move-down',
                'opal-move-left',
                'opal-move-right',
                'opal-flip',
                'opal-helix',
                'opal-scale-up',
                'opal-am-popup',
            ];
            foreach ($animations as $animation) {
                wp_deregister_style('e-animation-' . $animation);
                wp_register_style('e-animation-' . $animation, get_theme_file_uri('/assets/css/base/animations/'.$animation.'.css'), [], $nutritix_version);
            }
        }

        public function customs_widgets() {
            $files = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function woocommerce_fix_notice() {
            if (nutritix_is_woocommerce_activated()) {
                remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
                remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"nutritix-icon-account":"account","nutritix-icon-address":"address","nutritix-icon-angle-down":"angle-down","nutritix-icon-angle-left":"angle-left","nutritix-icon-angle-right":"angle-right","nutritix-icon-angle-up":"angle-up","nutritix-icon-arrow-drop-down-fill":"arrow-drop-down-fill","nutritix-icon-arrow-left":"arrow-left","nutritix-icon-arrow-right":"arrow-right","nutritix-icon-authentic":"authentic","nutritix-icon-calendar":"calendar","nutritix-icon-calling-1":"calling-1","nutritix-icon-cart":"cart","nutritix-icon-chat":"chat","nutritix-icon-check-square-solid":"check-square-solid","nutritix-icon-chevron-double-left":"chevron-double-left","nutritix-icon-chevron-double-right":"chevron-double-right","nutritix-icon-clock":"clock","nutritix-icon-close":"close","nutritix-icon-compare":"compare","nutritix-icon-config":"config","nutritix-icon-delivery-1":"delivery-1","nutritix-icon-eye":"eye","nutritix-icon-facebook-f":"facebook-f","nutritix-icon-featured":"featured","nutritix-icon-filter-ul":"filter-ul","nutritix-icon-google-plus-g":"google-plus-g","nutritix-icon-headphone":"headphone","nutritix-icon-heart-1":"heart-1","nutritix-icon-home-1":"home-1","nutritix-icon-import":"import","nutritix-icon-linkedin-in":"linkedin-in","nutritix-icon-list-ul":"list-ul","nutritix-icon-mail":"mail","nutritix-icon-map-marker-alt":"map-marker-alt","nutritix-icon-message-circle":"message-circle","nutritix-icon-nutrition":"nutrition","nutritix-icon-organic":"organic","nutritix-icon-package":"package","nutritix-icon-payment-1":"payment-1","nutritix-icon-pen":"pen","nutritix-icon-phone":"phone","nutritix-icon-plane":"plane","nutritix-icon-play-1":"play-1","nutritix-icon-play-circle":"play-circle","nutritix-icon-popular":"popular","nutritix-icon-product":"product","nutritix-icon-quality":"quality","nutritix-icon-quote":"quote","nutritix-icon-right-arrow-cicrle":"right-arrow-cicrle","nutritix-icon-shopping-bag":"shopping-bag","nutritix-icon-sliders-v":"sliders-v","nutritix-icon-star-alt":"star-alt","nutritix-icon-support-1":"support-1","nutritix-icon-time-spare-1":"time-spare-1","nutritix-icon-twitte-1":"twitte-1","nutritix-icon-visually":"visually","nutritix-icon-360":"360","nutritix-icon-bars":"bars","nutritix-icon-cart-empty":"cart-empty","nutritix-icon-check-square":"check-square","nutritix-icon-circle":"circle","nutritix-icon-cloud-download-alt":"cloud-download-alt","nutritix-icon-comment":"comment","nutritix-icon-comments":"comments","nutritix-icon-contact":"contact","nutritix-icon-credit-card":"credit-card","nutritix-icon-dot-circle":"dot-circle","nutritix-icon-edit":"edit","nutritix-icon-envelope":"envelope","nutritix-icon-expand-alt":"expand-alt","nutritix-icon-external-link-alt":"external-link-alt","nutritix-icon-file-alt":"file-alt","nutritix-icon-file-archive":"file-archive","nutritix-icon-filter":"filter","nutritix-icon-folder-open":"folder-open","nutritix-icon-folder":"folder","nutritix-icon-frown":"frown","nutritix-icon-gift":"gift","nutritix-icon-grid":"grid","nutritix-icon-grip-horizontal":"grip-horizontal","nutritix-icon-heart-fill":"heart-fill","nutritix-icon-heart":"heart","nutritix-icon-history":"history","nutritix-icon-home":"home","nutritix-icon-info-circle":"info-circle","nutritix-icon-instagram":"instagram","nutritix-icon-level-up-alt":"level-up-alt","nutritix-icon-list":"list","nutritix-icon-map-marker-check":"map-marker-check","nutritix-icon-meh":"meh","nutritix-icon-minus-circle":"minus-circle","nutritix-icon-minus":"minus","nutritix-icon-mobile-android-alt":"mobile-android-alt","nutritix-icon-money-bill":"money-bill","nutritix-icon-pencil-alt":"pencil-alt","nutritix-icon-plus-circle":"plus-circle","nutritix-icon-plus":"plus","nutritix-icon-random":"random","nutritix-icon-reply-all":"reply-all","nutritix-icon-reply":"reply","nutritix-icon-search-plus":"search-plus","nutritix-icon-search":"search","nutritix-icon-shield-check":"shield-check","nutritix-icon-shopping-basket":"shopping-basket","nutritix-icon-shopping-cart":"shopping-cart","nutritix-icon-sign-out-alt":"sign-out-alt","nutritix-icon-smile":"smile","nutritix-icon-spinner":"spinner","nutritix-icon-square":"square","nutritix-icon-star":"star","nutritix-icon-store":"store","nutritix-icon-sync":"sync","nutritix-icon-tachometer-alt":"tachometer-alt","nutritix-icon-thumbtack":"thumbtack","nutritix-icon-ticket":"ticket","nutritix-icon-times-circle":"times-circle","nutritix-icon-times-square":"times-square","nutritix-icon-times":"times","nutritix-icon-trophy-alt":"trophy-alt","nutritix-icon-truck":"truck","nutritix-icon-user":"user","nutritix-icon-video":"video","nutritix-icon-wishlist-empty":"wishlist-empty","nutritix-icon-adobe":"adobe","nutritix-icon-amazon":"amazon","nutritix-icon-android":"android","nutritix-icon-angular":"angular","nutritix-icon-apper":"apper","nutritix-icon-apple":"apple","nutritix-icon-atlassian":"atlassian","nutritix-icon-behance":"behance","nutritix-icon-bitbucket":"bitbucket","nutritix-icon-bitcoin":"bitcoin","nutritix-icon-bity":"bity","nutritix-icon-bluetooth":"bluetooth","nutritix-icon-btc":"btc","nutritix-icon-centos":"centos","nutritix-icon-chrome":"chrome","nutritix-icon-codepen":"codepen","nutritix-icon-cpanel":"cpanel","nutritix-icon-discord":"discord","nutritix-icon-dochub":"dochub","nutritix-icon-docker":"docker","nutritix-icon-dribbble":"dribbble","nutritix-icon-dropbox":"dropbox","nutritix-icon-drupal":"drupal","nutritix-icon-ebay":"ebay","nutritix-icon-facebook":"facebook","nutritix-icon-figma":"figma","nutritix-icon-firefox":"firefox","nutritix-icon-google-plus":"google-plus","nutritix-icon-google":"google","nutritix-icon-grunt":"grunt","nutritix-icon-gulp":"gulp","nutritix-icon-html5":"html5","nutritix-icon-joomla":"joomla","nutritix-icon-link-brand":"link-brand","nutritix-icon-linkedin":"linkedin","nutritix-icon-mailchimp":"mailchimp","nutritix-icon-opencart":"opencart","nutritix-icon-paypal":"paypal","nutritix-icon-pinterest-p":"pinterest-p","nutritix-icon-reddit":"reddit","nutritix-icon-skype":"skype","nutritix-icon-slack":"slack","nutritix-icon-snapchat":"snapchat","nutritix-icon-spotify":"spotify","nutritix-icon-trello":"trello","nutritix-icon-twitter":"twitter","nutritix-icon-vimeo":"vimeo","nutritix-icon-whatsapp":"whatsapp","nutritix-icon-wordpress":"wordpress","nutritix-icon-yoast":"yoast","nutritix-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $nutritix_version;
            $tabs['opal-custom'] = [
                'name'          => 'nutritix-icon',
                'label'         => esc_html__('Nutritix Icon', 'nutritix'),
                'prefix'        => 'nutritix-icon-',
                'displayPrefix' => 'nutritix-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $nutritix_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Nutritix_Elementor();
