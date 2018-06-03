<?php
/**
 * Handlers functions for processing data
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/customizer/handlers/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 *	Validate Data
 */


/**
 * Validates a URL.
 *
 * @param url $url    any url.
 */
function saraswathi_is_url($url) {
	if ( ! filter_var( $url, FILTER_VALIDATE_URL ) === false	) {
		return true;
	} else {
		return false;
	}
}

/**
 * Process Data
 * For Customizer Data
 * Santinize HTML Class ( Numbers without decimal)
 *
 * @param str $class The classname to be sanitized
 */
function saraswathi_sanitize_html_class( $class ) {

	if ( is_string( $class ) ) {
			$class = sanitize_html_class( $class ); // Force the value into integer type.
	}
	return ( $class ) ? $class : '';
}

/**
 *	Santinize integers ( Numbers without decimal)
 *
 * @param int $value    any numeric to be checked and returned as integer.
 */
function saraswathi_sanitize_int( $value ) {

	if ( is_numeric( $value ) ) {
		if ( is_int( $value ) ) {
			$value = absint( $value ); // Force the value into integer type.
		}
	}
	return ( 0 <= $value ) ? $value : '';
}






/**
 *	Sanitize float (12.124 or 99,999 etc )
 *
 * @param float $value    any numeric to be checked and returned as float.
 */
function saraswathi_sanitize_float( $value ) {

	if ( is_numeric( $value ) ) {
		if ( is_float( $value ) ) {
			$value = floatval( $value ); // Force the value into float type.
		}
	}
	return ( 0 <= $value ) ? $value : '';
}


/**
 *	Balance HTML and remove malicious tags
 *
 * @param text $content    any text to be sanitized by balancing tags and removing malicious code.
 */
function saraswathi_sanitize_text( $content ) {
	return wp_kses_post( force_balance_tags( $content ) );
}


/**
 * Make URL is safe to use in database queries, redirects and HTTP requests.
 *
 * @param url $url    any relative url escaped properly before output.
 */
function saraswathi_sanitize_url_raw( $url ) {

	if (	saraswathi_is_url( $url )	) {
		$url = esc_url_raw( $url ); // Similar esc_url() but doesn't mess with display.
	}
	return ( ! empty( $url ) ) ? $url : '';
}

/**
 * Make URL is safe to use in database queries, redirects and HTTP requests.
 *
 * @param url $url    any relative url escaped properly before output.
 */
function saraswathi_sanitize_url( $url ) {

	if (	saraswathi_is_url( $url )	) {

		$url = esc_url( $url );
	}

	return ( ! empty( $url ) ) ? $url : '';
}

/**
 *	4.0 - Customizer Output
 */


/**
 * Echo CSS Color that has already been sanitised ( To avoid false alarms while debugging )
 *
 * @param str $option     ID of option.
 *
 * @param str $default   any color code to be check whether it is hexadecimal..
 */
function saraswathi_customizer_output_color( $option, $default = false ) {

	$color	= saraswathi_get_theme_mod( $option, $default );

	if ( '' === $color ) {
		return ''; }

	/**
		* 3 or 6 hex digits, or the empty string.
		* Copied from //core.trac.wordpress.org/browser/tags/4.2.2/src/wp-includes/class-wp-customize-manager.php#L1541.
		*/
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		echo sanitize_hex_color($color);
	}

	echo '';

}

/**
 * Echo HTML Class that has already been sanitised ( To avoid false alarms while debugging )
 *
 * @param string $option     ID of option.
 *
 * @param string $default   Default value for the option.
 */
function saraswathi_customizer_output_class(  $option, $default = false ) {
	echo saraswathi_sanitize_html_class( saraswathi_get_theme_mod( $option, $default ) );
}


/**
 * Echo integers for CSS that has already been sanitised ( To avoid false alarms while debugging )
 *
 * @param str $option     ID of option.
 *
 * @param str $default   Default value for the option.
 */
function saraswathi_customizer_output_int(  $option, $default = false ) {

	echo saraswathi_sanitize_int( saraswathi_get_theme_mod( $option, $default ) );

}


/**
 * Echo float that has already been sanitised ( To avoid false alarms while debugging )
 *
 * @param str $option     ID of option.
 *
 * @param str $default   any numeric to be checked and echoed as float.
 */
function saraswathi_customizer_output_float( $option, $default = false ) {

	echo saraswathi_sanitize_float( saraswathi_get_theme_mod( $option, $default ) );
}


/**
 *	Echo textarea inputs
 *
 * @param text $text    any HTML content that needs to be sanitized by removing tags and escaping HTML.
 */
function saraswathi_sanitize_output_textarea( $text ) {
	echo saraswathi_sanitize_textarea( $text );
}


/**
 * Echo textarea for customize control that has already been sanitised
 *
 * @param str $option     ID of option.
 *
 * @param str $default   any text to be sanitized and echoed after balancing tags and removing malicious code.
 */
function saraswathi_customizer_output_text( $option, $default  ) {
	echo saraswathi_sanitize_text( saraswathi_get_theme_mod( $option, $default ) );
}

/**
 * Echo text that has already been sanitised
 *
 * @param str $default   any text to be sanitized and echoed after balancing tags and removing malicious code.
 */
function saraswathi_sanitize_output_text( $default  ) {
	echo saraswathi_sanitize_text( $default );
}


/**
 * Return attachment src through ajax for customizer preview
 */
function saraswathi_customizer_get_image_src_callback() {

	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'saras_customizer_preview_ajax_nonce' ) ) {
		die('Nope!'); }
	$attachment 	= wp_prepare_attachment_for_js( $_POST['id'] );
	echo saraswathi_sanitize_url_raw( $attachment[url] );
	exit();
}
add_action( 'wp_ajax_saraswathi_customizer_get_image_src', 'saraswathi_customizer_get_image_src_callback' );


/**
 * Check if it is a single post.
 */
function saraswathi_is_single_post() {
	if ( is_singular( 'post' )	) {
		return true;
	} else {
		return false;
	}
}


/**
 * Check if it is post archive.
 */
function saraswathi_is_post_archiveorhome() {
	if ( (	is_archive()	||	is_home()	) && 'post' === get_post_type()	) {
		return true;
	} else {
		return false;
	}
}


/**
 * Check if sidebar is active.
 */

function saraswathi_is_active_sidebar() {
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Check if site has grid layout.
 */
function saraswathi_is_site_layout_grid() {
	if ( 'grid' === saraswathi_get_theme_mod( 'saras_saraswathi_site_layout' ) ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Check if index widget area enabled.
 */
function saraswathi_is_index_widgetarea() {
	if ( is_front_page() && saraswathi_get_theme_mod( 'saras_enable_index_widgetarea', 0 ) ) {
		return true;
	} else {
		return false;
	}
}


function saraswathi_is_footer_textarea() {
	if ( saraswathi_get_theme_mod( 'saras_enable_footer_textarea', 1 ) ) {
		return true;
	} else {
		return false;
	}
}