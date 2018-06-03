<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Paisa
 */

/**
 * Jetpack setup function.
 */
function paisa_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'paisa_infinite_scroll_render',
		'footer'    => 'page',
	) );

	add_theme_support( 'jetpack-portfolio' );
}
add_action( 'after_setup_theme', 'paisa_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function paisa_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
}
