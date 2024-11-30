<?php

defined( 'ABSPATH' ) || exit();

/**
 * Nutritix_Megamenu_Walker
 *
 * extends Walker_Nav_Menu
 */
class Nutritix_Admin_Megamenu_Assets {

	public static function init() {
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ) );
		add_action( 'elementor/editor/after_enqueue_scripts', array( __CLASS__, 'add_scripts_editor' ) );
	}

	public static function add_scripts_editor() {
		global $nutritix_version;
		if ( isset( $_REQUEST['nutritix-menu-editable'] ) && $_REQUEST['nutritix-menu-editable'] ) {
			wp_register_script( 'nutritix-elementor-menu', get_template_directory_uri() . '/inc/megamenu/assets/js/editor.js', [], $nutritix_version );
			wp_enqueue_script( 'nutritix-elementor-menu' );
		}
	}

	/**
	 * enqueue scripts
	 */
	public static function enqueue_scripts( $page ) {
		global $nutritix_version;
		if ( $page === 'nav-menus.php' ) {
			wp_enqueue_script( 'backbone' );
			wp_enqueue_script( 'underscore' );

			$suffix = '.min';
			wp_register_script(
				'jquery-elementor-select2',
				ELEMENTOR_ASSETS_URL . 'lib/e-select2/js/e-select2.full' . $suffix . '.js',
				[
					'jquery',
				],
				'4.0.6-rc.1',
				true
			);
			wp_enqueue_script( 'jquery-elementor-select2' );
			wp_register_style(
				'elementor-select2',
				ELEMENTOR_ASSETS_URL . 'lib/e-select2/css/e-select2' . $suffix . '.css',
				[],
				'4.0.6-rc.1'
			);
			wp_enqueue_style( 'elementor-select2' );
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_register_script( 'nutritix-megamenu', get_template_directory_uri() . '/inc/megamenu/assets/js/admin.js', array(
				'jquery',
				'backbone',
				'underscore'
			), $nutritix_version, true );
			wp_localize_script( 'nutritix-megamenu', 'nutritix_memgamnu_params', apply_filters( 'nutritix_admin_megamenu_localize_scripts', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'i18n'    => array(
					'close' => esc_html__( 'Close', 'nutritix' ),
					'submit' => esc_html__( 'Save', 'nutritix' )
				),
				'nonces'  => array(
					'load_menu_data' => wp_create_nonce( 'nutritix-menu-data-nonce' )
				)
			) ) );
			wp_enqueue_script( 'nutritix-megamenu' );

			wp_enqueue_style( 'nutritix-megamenu', get_template_directory_uri() . '/inc/megamenu/assets/css/admin.css', [], $nutritix_version );
			wp_enqueue_style( 'nutritix-elementor-custom-icon', get_theme_file_uri( '/assets/css/admin/elementor/icons.css' ), [], $nutritix_version );
		}

	}

}

Nutritix_Admin_Megamenu_Assets::init();
