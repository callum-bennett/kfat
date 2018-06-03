<?php
/**
 *
 * Enqueue CSS stylesheets for the frontend.
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite


 * ********************
 *	Table of Contents
 *
 *	1.0	-	Framework
 *	2.0	-	Webfonts
 *	3.0	-	RTL Support
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Load styles to the frontend
 */
function saraswathi_frontend_styles() {

	/**
	 *	1.0	- Frameowrk
	 */
		wp_enqueue_style( 'saraswathi-lite', get_template_directory_uri() . '/dist/styles/saraswathi.css', null, null, null );

	/**
	 *	2.0	- Webfonts
	 */
		wp_enqueue_style( 'saraswathi-custom-fonts', saraswathi_custom_fonts_url(), null, null, null );

	/**
	 *	3.0	-	RTL Support
	 */
	if ( is_rtl() ) {
		wp_enqueue_style( 'saraswathi-rtl', get_template_directory_uri() . '/dist/styles/rtl.css', null, null, null );
	}


}
add_action( 'wp_enqueue_scripts', 'saraswathi_frontend_styles' );


