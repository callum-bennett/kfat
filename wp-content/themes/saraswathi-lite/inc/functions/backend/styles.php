<?php
/**
 * Enqueue CSS stylesheets to be used in the backend (WordPress Admin).
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/'
 *
 * @since Saraswathi 1.0.0
 *
 * @package Saraswathi


 * ****************************
 *	Table of Contents
 *
 *	1.0	-	Customizer
 *	2.0	-	Widget Options
 *	3.0	-	Admin Dashboard Menu
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! function_exists( 'saraswathi_customize_controls_css' ) ) :
	/**
	 *	1.0	-	Customizer
	 * Styles for customizer preview options and controls.
	 */
	function saraswathi_customize_controls_css() {

		wp_enqueue_style( 'saraswathi-customizer-controls', get_template_directory_uri() . '/dist/styles/customizer-controls.css', null, null, 'all' );

	}
	add_action( 'customize_controls_print_styles', 'saraswathi_customize_controls_css' );
endif;

if ( ! function_exists( 'saraswathi_customize_preview_init_css' ) ) :
	/**
	 * Styles for saraswathi customizer preview.
	 */
	function saraswathi_customize_preview_init_css() {

		wp_enqueue_style( 'saraswathi-customizer-preview', get_template_directory_uri() . '/dist/styles/customizer-preview.css', null, null, 'all' );
		wp_enqueue_style( 'saraswathi-customizer-backend', get_template_directory_uri() . '/dist/styles/customizer-backend.css', null, null, 'all' );

	}
	add_action( 'customize_preview_init', 'saraswathi_customize_preview_init_css' );
endif;

if ( ! function_exists( 'saraswathi_admin_menu_styles' ) ) :
	/**
	 *	3.0	-	Admin Dashboard Menu
	 * Styles for saraswathi admin dashboard menu( product validation and back&restore settings ).
	 */
	function saraswathi_admin_menu_styles() {

		global $pagenow;
		if ( in_array($pagenow, array(
			'themes.php'
		)) ) { // Inline styles for saraswathi widget options.
			wp_enqueue_style( 'saraswathi-menu-backend', get_template_directory_uri() . '/dist/styles/menu-backend.css', true, SARASWATHI_LITE_VERSION );
		}

		if ( in_array($pagenow, array(
			'post-new.php'
		)) ) { // Inline styles for saraswathi widget options.
			wp_enqueue_style( 'saraswathi-editor-backend', get_template_directory_uri() . '/dist/styles/editor-backend.css', true, SARASWATHI_LITE_VERSION );
		}
	}
	add_action( 'admin_enqueue_scripts', 'saraswathi_admin_menu_styles' );
endif;