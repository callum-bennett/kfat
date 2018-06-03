<?php
/**
 *
 * Global CSS output for template
 *
 * Combines the CSS output files.
 *
 * located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/customizer/css/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite

 * ***********************************
 *	Table of Contents
 *
 *	1.0 - Saraswathi Customizer CSS
 *	2.0 - User Customizer CSS
 *	3.0 - Sanitize CSS
 *	4.0 - Inline Customizer CSS
 *	5.0 - Reset Cached CSS
 */

/**
 *	1.0 - Saraswathi Customizer CSS
 *
 * This function outputs the customizer generated CSS to frontend through wp_head filter.
 *
 * @param CSS $css css to be added through the filter.
 */
function saraswathi_customizer_global_css($css = null) {

	$customizer_css_path = get_template_directory() . '/inc/functions/backend/customizer/css';

	// Start output buffering.
	ob_start();
	require_once($customizer_css_path . '/design/button.php');
	require_once($customizer_css_path . '/design/header.php');
	require_once($customizer_css_path . '/design/icons.php');
	require_once($customizer_css_path . '/design/typography.php');
	require_once($customizer_css_path . '/layouts/saraswathi.php');
	$css .= ob_get_clean(); // End output buffer.

	return $css;

}

// Add generated CSS from customizer controls.
add_filter( 'saraswathi_customizer_styles_filter', 'saraswathi_customizer_global_css' );



/**
 *
 *	2.0 - Sanitize CSS
 *
 * Function to clean CSS before output removes whitespace, comments, colons and other unneccessary characters.
 *
 * @param CSS $css css to be sanitized.
 */
function saraswathi_sanitize_customizer_css($css = null) {

	// Remove comments.
	$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
	// Remove space after colons.
	$css = str_replace( ': ', ':', $css );
	// Remove whitespace.
	$css = str_replace(array(
		"\r\n",
		"\r",
		"\n",
		"\t",
		'  ',
		'    ',
		'    ',
	), '', $css);

		$css	= wp_kses_post( $css );

	$css = trim( $css );

	// Sanitize and then output.
	return $css;
}
add_filter( 'saraswathi_customizer_styles_filter', 'saraswathi_sanitize_customizer_css', 12 );
add_filter( 'saraswathi_editor_styles_filter', 'saraswathi_sanitize_customizer_css', 12 );



/**
 *
 *	4.0	- Add Customizer Inline CSS 
 *
 * Use the filter customizer styles
 */
function saraswathi_customizer_css_cache() {

	$customizer_css = apply_filters( 'saraswathi_customizer_styles_filter', null );
	
	wp_add_inline_style( 'saraswathi-lite', $customizer_css );

}
add_action( 'wp_enqueue_scripts', 'saraswathi_customizer_css_cache', 99 );
