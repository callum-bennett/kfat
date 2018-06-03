<?php
/**
 * Global functions to handle dynamic data.
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/handlers'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite

 * ************************
 *	Table of Contents
 *
 *	1.0	-	Template Classes
 *	2.0	-	Framework Data
 *	3.0	-	Template Elements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



/**
 *	1.0	-	Template Classes
 */


/**
 * Display the classes for the topbar div.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function saraswathi_topbar_class( $class = '', $post_id = null ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', saraswathi_get_topbar_class( $class, $post_id ) ) . '"';
}



/**
 * Retrieve the classes for the topbar div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 */
function saraswathi_get_topbar_class( $class = '', $post_id = null ) {
	$post = get_post( $post_id );

	$classes = array();
	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	}


	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filter the list of CSS classes for the current post.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $classes An array of topbar classes.
	 * @param string $class   A comma-separated list of additional classes added to the topbar section.
	 * @param int    $post_id The post ID.
	 */
	$classes = apply_filters( 'saraswathi_topbar_class', $classes, $class, $post_id );

	return array_unique( $classes );
}



/**
 * Display the classes for the content wrap div.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function saraswathi_content_wrap_class( $class = '', $post_id = null ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', saraswathi_get_content_wrap_class( $class, $post_id ) ) . '"';
}



/**
 * Retrieve the classes for the content wrap div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 */
function saraswathi_get_content_wrap_class( $class = '', $post_id = null ) {
	$post = get_post( $post_id );

	$classes = array();
	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	}
	$classes[]   = 'saras-content-wrap';
    $classes[]   = 'is-not-fixed';


		if ( 'grid' === saraswathi_get_theme_mod( 'saras_saraswathi_site_layout', 'grid' ) ) {
			$classes[]   = 'saras-grid';
		     $classes[]		= 'width';
				 $classes[]		= 'max';
		}

	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filter the list of CSS classes for the current post.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $classes An array of content wrap classes.
	 * @param string $class   A comma-separated list of additional classes added to the content wrap DIV.
	 * @param int    $post_id The post ID.
	 */
	$classes = apply_filters( 'saraswathi_content_wrap_class', $classes, $class, $post_id );

	return array_unique( $classes );
}


/**
 * Display the classes for the content div.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function saraswathi_content_class( $class = '', $post_id = null, $args = null ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', saraswathi_get_content_class( $class, $post_id,	$args ) ) . '"';
}



/**
 * Retrieve the classes for the content div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 * @param array        $args array of arguments for post layout.
 */
function saraswathi_get_content_class( $class = '', $post_id = null, $args = null ) {
	$post = get_post( $post_id );
	$size						= isset( $args['size']	)	?	$args['size']	:	saraswathi_get_theme_mod( 'saras_featured_media_size','large' );
	$layout					= 'regular';
	$custom					= isset(	$args['custom']	)	?	$args['custom']	:	false;
	$classes = array();
	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	}

	$classes[]		= $post->post_type;
	$classes[]   	= 'content-wrapper';

	if ( 'post' === $post->post_type ) {
		$classes[]   = $size;
	}

	if ( ! is_singular() || $custom ) {
			$classes[]   = saraswathi_get_content_layout_grid( $args );
	}

	$classes = array_map( 'esc_attr', $classes );
	/**
	 * Filter the list of CSS classes for the current post.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $classes An array of post classes.
	 * @param string $class   A comma-separated list of additional classes added to the post.
	 * @param int    $post_id The post ID.
	 */
	$classes = apply_filters( 'saraswathi_content_class', $classes, $class, $post_id );

	return array_unique( $classes );
}

/**
 * Display the classes for the primary content div.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function saraswathi_primary_class( $class = '', $post_id = null ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', saraswathi_get_primary_class( $class, $post_id ) ) . '"';
}
/**
 * Retrieve the classes for the primary content div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 */
function saraswathi_get_primary_class( $class = '', $post_id = null ) {
	$post = get_post( $post_id );

	$classes = array();
	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	}

	$classes[]   = 'content-area';
	$classes[]	 = 'saras-content';

	if ( ! in_array( 'no-sidebar' , $classes ) ) {
			$classes[]   = saraswathi_get_theme_mod( 'saras_saraswathi_sidebar_layout', 'left' );
		 	$classes[]		= 'width';
	}

	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filter the list of CSS classes for the current post.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $classes An array of primary content classes.
	 * @param string $class   A comma-separated list of additional classes added to the post.
	 * @param int    $post_id The post ID.
	 */
	$classes = apply_filters( 'saraswathi_primary_class', $classes, $class, $post_id );

	return array_unique( $classes );
}


/**
 * Display the classes for the primary content div.
 *
 * @since 1.0.0
 *
 * @param string|array $class One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 */
function saraswathi_footer_class( $class = '', $post_id = null ) {
	// Separates classes with a single space, collates classes for post DIV
	echo 'class="' . join( ' ', saraswathi_get_footer_class( $class, $post_id ) ) . '"';
}



/**
 * Retrieve the classes for the footer div as an array.
 *
 * @since 1.0.0
 *
 * @param string|array $class   One or more classes to add to the class list.
 * @param int|WP_Post  $post_id Optional. Post ID or post object.
 * @return array Array of classes.
 */
function saraswathi_get_footer_class( $class = '', $post_id = null ) {
	$post = get_post( $post_id );

	$classes = array();
	if ( $class ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_map( 'esc_attr', $class );
	}
	$classes[]	 = 'site-footer';
	$classes[]	 = 'saras-footer';
	$classes[]		= 'saras-grid';

		if ( ! in_array( 'no-header' , $classes ) ) {
			$classes[]   = 'none';
		}
		if ( ! in_array( 'full-width' , $classes )  && 'grid' === saraswathi_get_theme_mod( 'saras_saraswathi_site_layout','grid' ) ) {
			$classes[]		= 'width';
			 $classes[]		= 'max';
		}


	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filter the list of CSS classes for the current post.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $classes An array of footer classes.
	 * @param string $class   A comma-separated list of additional classes added to the post.
	 * @param int    $post_id The post ID.
	 */
	$classes = apply_filters( 'saraswathi_footer_class', $classes, $class, $post_id );

	return array_unique( $classes );
}


/**
*	2.0	-	Framework
*/


if ( ! function_exists( 'saraswathi_get_template_part' ) ) :
	/**
	 * A function that use WP's native get template part and wraps it aroud with actions.
	 * Source: https://core.trac.wordpress.org/browser/tags/4.2.2/src/wp-includes/general-template.php#L0
	 *
	 * @param string $template Template part to be added to a template.
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template..
	 */
	function saraswathi_get_template_part( $template, $slug, $name = null ) {
		$action = $template . '_' . $slug . ( ( empty( $name ) ) ? '' : '_' . $name );
		do_action( 'saraswathi_before_' . $action );
		get_template_part( 'inc/functions/frontend/templates/frameworks/' . $template . '/' . $slug,$name );
		do_action( 'saraswathi_after_' . $action );
	}
endif;



if ( ! function_exists( 'saraswathi_get_content_layout_grid' ) ) :
	/**
	 * Get Layout Grids Classes for templates
	 *
	 * @param array $args array of arguments for post layout.
	 */
	function saraswathi_get_content_layout_grid( $args  = null ) {

			return 'col-regular';

	}
endif;

if ( ! function_exists( 'saraswathi_get_content_layout_style' ) ) :
	/**
	 * Get Layout Style for templates
	 *
	 * @param string $prefix CSS classes to add at the beginning of string.
	 * @param string $suffix CSS classes to add at the end of string.
	 */
	function saraswathi_get_content_layout_style( $prefix  = null, $suffix  = null ) {
		return esc_attr ( $prefix.saraswathi_get_theme_mod( 'saras_default_content_layout','regular' ).$suffix );
	}
endif;

if ( ! function_exists( 'saraswathi_get_layout_grid' ) ) :
	/**
	 * Get Layout Grids Classes templates
	 *
	 * @param string $layout Type of content layout.
	 * @param string $grids Number of grid columns for grid layout.
	 * @param string $prefix CSS classes to add at the beginning of string.
	 * @param string $suffix CSS classes to add at the end of string.
	 */
	function saraswathi_get_layout_grid( $layout = null, $grids = null, $prefix  = null, $suffix  = null ) {
		if ( 'grid' === saraswathi_get_theme_mod( $layout ,'grid' ) ) {
			return esc_attr( $prefix.saraswathi_get_theme_mod( $grids ,'2' ).$suffix );
		} else {
			return esc_attr ( $prefix.'regular'.$suffix );
		}
	}
endif;



/**
*	3.0	-	Template Elements
*/


if ( ! function_exists( 'saraswathi_get_social_icons' ) ) :
	/**
	 * Get social icons for templates
	 */
	function saraswathi_get_social_icons() {
		$icons = array( 'twitter','facebook','google','youtube','vimeo','github','behance','linkedin','instagram','vine','tumblr','feed' );
		foreach ( $icons as $icon ) {
			$icons_url[ $icon ] = esc_url ( saraswathi_get_theme_mod( 'saras_icons_social_media_'.$icon.'' ) );
		}
		return $icons_url;
	}
endif;



if ( ! function_exists( 'saraswathi_post_thumbnail' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @param string $size Size of media wanted.
	 *
	 * @since Saraswathi Lite 1.0.0
	 */
	function saraswathi_post_thumbnail( $size = null ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( empty ( $size ) ) {
			$size = esc_attr(saraswathi_get_theme_mod( 'saras_featured_media_size','large' ));
		}

		if ( is_singular() ) :
		?>
		<div class="post-<?php echo $size; ?>">
		<?php the_post_thumbnail( $size ); ?>
	</div><!-- .post-thumbnail -->
	<?php else : ?>
	<a class="post-<?php echo $size; ?> overlay-link" href="<?php esc_url( the_permalink() ); ?>" aria-hidden="true">
		<?php
		the_post_thumbnail( $size, array( 'alt' => get_the_title() ) );
		?>
	</a>
	<?php endif; // End is_singular().
	}
endif;
