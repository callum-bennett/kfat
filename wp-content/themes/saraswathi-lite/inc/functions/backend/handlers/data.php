<?php
/**
 *
 * Handlers functions for retriving and returning data
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/customizer/handlers/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite

 * ******************
 *	Table of Contents
 *
 *	1.0 - Theme Mod
 *	2.0 - Framework
 *	3.0 - Post Meta
 *	4.0	-	Fonts
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
*	1.0 - Theme Mod
*/
if ( ! function_exists( 'saraswathi_get_theme_mod' ) ) :
	/**
	 * Get saved option.
	 *
	 * @param str|int|float $mod     ID of theme mod.
	 *
	 * @param str|int|float $default   Default value for the option.
	 */
	function saraswathi_get_theme_mod( $mod, $default = false ) {

		$output = get_theme_mod( $mod, $default );

		return apply_filters( 'saraswathi_get_' . $mod, $output );
	}
endif;

/**
*	3.0 - Post Meta
*/
if ( ! function_exists( 'saraswathi_get_post_meta' ) ) :
	/**
	 * Santinize post meta for input and output
	 *
	 * @param str|int|float $value     Post meta key.
	 */
	function saraswathi_get_post_meta( $value ) {

		global $post;
		$field = get_post_meta( $post->ID, $value, 'true' );

		if ( ! empty( $field ) ) {

			return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
		} else {

			return false;
		}
	}
endif;




/**
*	4.0	-	Fonts
*/

if ( ! function_exists( 'saraswathi_custom_fonts_url' ) ) :
	/**
	 * Google fonts for Saraswathi Theme.
	 *
	 * @since Saraswathi 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function saraswathi_custom_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = array('latin');

		$fonts[] = saraswathi_get_theme_mod( 'saras_custom_fonts_select','Merriweather' ).':'.'900';
		$fonts[] = saraswathi_get_theme_mod( 'saras_custom_fonts_select','Merriweather' ).':'.'300';
		$fonts[] = saraswathi_get_theme_mod( 'saras_custom_fonts_select','Merriweather' ).':'.'700';
		$fonts[] = saraswathi_get_theme_mod( 'saras_custom_fonts_select','Merriweather' ).':'.'400';

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', array_unique( $fonts ) ) ),
				'subset' => urlencode( implode( ',', array('latin') ) ),
			), 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;


if ( ! function_exists( 'saraswathi_enable_custom_fonts' ) ) :
	/**
	 * Check Enabled Fonts
	 */
	function saraswathi_enable_custom_fonts () {

		if ( saraswathi_get_theme_mod( 'saraswathi_enable_custom_fonts',1 ) ) {

			return true;
		} else {

			return false;
		}
	}
endif;


if ( ! function_exists( 'saraswathi_topbar_media_query' ) ) :
	/**
	 * Create media query variable for topbar
	 */
	function saraswathi_topbar_media_query() {

		if ( 'saraswathi' === saraswathi_get_theme_mod( 'saras_framework', 'saraswathi' ) ) {

			if ( saraswathi_get_theme_mod( 'saras_saraswathi_site_layout','grid' ) ) {

				$grid = absint( saraswathi_get_theme_mod( 'saras_saraswathi_grid_max_width','1280' ) );
				echo absint( $grid + 250 ); // Returns grid width + topbar width.
			} else {

				echo null;
			}
		}
	}
endif;

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Saraswathi 1.0.2
 * @see twentyseventeen_customize_register()
 *
 * @return void
 */
function saraswathi_customize_partial_blogname() {
	bloginfo( 'name' );
}