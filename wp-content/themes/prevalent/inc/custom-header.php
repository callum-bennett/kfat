<?php
/**
 * @package Prevalent
 * Setup the WordPress core custom header feature.
 *
 * @uses prevalent_header_style()
 */
function prevalent_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'prevalent_custom_header_args', array(		
		'default-text-color'     => 'fff',
		'width'                  => 1400,
		'height'                 => 280,
		'wp-head-callback'       => 'prevalent_header_style',		
	) ) );
}
add_action( 'after_setup_theme', 'prevalent_custom_header_setup' );

if ( ! function_exists( 'prevalent_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see prevalent_custom_header_setup().
 */
function prevalent_header_style() {
	$header_text_color = get_header_textcolor();
	?>
	<style type="text/css">
	<?php
		//Check if user has defined any header image.
		if ( get_header_image() || get_header_textcolor() ) :
	?>
		.header {
			background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
			background-position: center top;
		}
	<?php endif; ?>	
	</style>
	<?php
}
endif; // prevalent_header_style