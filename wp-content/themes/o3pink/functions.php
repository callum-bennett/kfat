<?php
/**
 * o3pink functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage o3pink
 * @since o3pink 1.0
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since o3pink 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}
/**
 * o3pink only works in WordPress 4.1 or later.
 */
if ( ! function_exists( 'o3pink_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since o3pink 1.0
 */
function o3pink_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on o3pink, use a find and replace
	 * to change 'o3pink' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'o3pink');
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'o3pink' ),
		'social'  => __( 'Social Links Menu', 'o3pink' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );
	
		$default_color ='#fff';
	add_theme_support( 'custom-background', apply_filters( 'o3pink_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );
	
	 $args = array(
				'flex-width'    => true,
				'width'         => 980,
				'flex-height'    => true,
				'height'        => 200,
				'default-image' => get_template_directory_uri() . '/images/4-825x510.png',
			);
	add_theme_support( 'custom-header', $args );

	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'o3pink' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'o3pink' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	$starter_content = apply_filters( 'o3pink_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );







	$args = array(
			'default-color' => '#fff',
			'default-image' => '',
		);
	add_theme_support( 'custom-background', $args );
	
	add_theme_support( 'custom-logo' );
		
	add_theme_support( 'custom-logo', array(
		  'header-text' => array( 'site-title', 'site-description' ),
		) );
		
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', o3pink_fonts_url() ) );
}
endif; // o3pink_setup
add_action( 'after_setup_theme', 'o3pink_setup' );

if ( ! function_exists( 'o3pink_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function o3pink_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}


endif;



















/**
 * Register widget area.
 *
 * @since o3pink 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function o3pink_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'o3pink' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'o3pink' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'o3pink_widgets_init' );
if ( ! function_exists( 'o3pink_fonts_url' ) ) :
/**
 * Register Google fonts for o3pink.
 *
 * @since o3pink 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function o3pink_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'o3pink' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'o3pink' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'o3pink' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}
	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'o3pink' );
	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}
	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since o3pink 1.1
 */
function o3pink_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'o3pink_javascript_detection', 0 );


/**
 * Enqueue scripts and styles.
 *
 * @since o3pink 1.0
 */
function o3pink_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'o3pink-fonts', o3pink_fonts_url(), array(), null );
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );
	// Load our main stylesheet.
	wp_enqueue_style( 'o3pink-style', get_stylesheet_uri() );
	wp_style_add_data( 'o3pink-style', 'rtl', 'replace' );
	
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'o3pink-ie', get_template_directory_uri() . '/css/ie.css', array( 'o3pink-style' ), '20141010' );
	wp_style_add_data( 'o3pink-ie', 'conditional', 'lt IE 9' );
	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'o3pink-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'o3pink-style' ), '20141010' );
	wp_style_add_data( 'o3pink-ie7', 'conditional', 'lt IE 8' );
	
	wp_enqueue_script( 'o3pink-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && esc_url(get_option('thread_comments'))) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'o3pink-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}
	wp_enqueue_script( 'o3pink-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	
	wp_localize_script( 'o3pink-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'o3pink' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'o3pink' ) . '</span>',
	) );
	
}
add_action( 'wp_enqueue_scripts', 'o3pink_scripts' );
/**
 * Add featured image as background image to post navigation elements.
 *
 * @since o3pink 1.0
 *
 * @see wp_add_inline_style()
 */
function o3pink_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';
	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}
	wp_add_inline_style( 'o3pink-style', $css );
}
add_action( 'wp_enqueue_scripts', 'o3pink_post_nav_background' );
/**
 * Display descriptions in main navigation.
 *
 * @since o3pink 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function o3pink_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'o3pink_nav_description', 10, 4 );
/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since o3pink 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function o3pink_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'o3pink_search_form_modify' );

/**
 * Implement the Baner feature.
 *
 * @since o3pink 1.0
 */
 
/**
 * Custom template tags for this theme.
 *
 * @since o3pink 1.0
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Customizer additions.
 *
 * @since o3pink 1.0
 */
require get_template_directory() . '/inc/customizer.php';
?>