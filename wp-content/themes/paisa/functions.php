<?php
/**
 * Paisa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Paisa
 */

if ( ! function_exists( 'paisa_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function paisa_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Paisa, use a find and replace
	 * to change 'paisa' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'paisa', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'paisa-720x0', 720, 0, false );
	add_image_size( 'paisa-820x0', 820, 0, false );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'paisa' ),
		'social' => esc_html__( 'Social', 'paisa' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'paisa_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	//Logo
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

}
endif;
add_action( 'after_setup_theme', 'paisa_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function paisa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'paisa_content_width', 820 );
}
add_action( 'after_setup_theme', 'paisa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function paisa_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'paisa' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'paisa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'paisa_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function paisa_scripts() {
	wp_enqueue_style( 'paisa-style', get_stylesheet_uri() );

	wp_enqueue_style( 'paisa-fonts', esc_url( paisa_fonts_url() ), array(), null );

	wp_enqueue_style( 'paisa-icons', get_template_directory_uri() . '/icons/css/fontello.css' );

	wp_enqueue_script( 'paisa-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'paisa-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true );

	wp_enqueue_script( 'paisa-main', get_template_directory_uri() . '/js/main.js', array('jquery', 'imagesloaded'),'', true );

	wp_enqueue_script( 'paisa-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'paisa_scripts' );

/**
 * Enqueue Bootstrap
 */
function paisa_enqueue_bootstrap() {
	wp_enqueue_style( 'paisa-bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'paisa_enqueue_bootstrap', 9 );

/**
 * Google Fonts
 *
 */
if ( ! function_exists( 'paisa_fonts_url' ) ) :
function paisa_fonts_url() {

	$fonts_url 		= '';
	$subsets   		= 'latin,latin-ext,cyrillic'; //Fallback for browsers with no unicode-range support
	$weights 		= array( '400', '400italic', '500', '500italic', '600', '600italic', '700', '700italic' );
	$weights 		= implode(',', $weights);
	$body_font 		= get_theme_mod('body_font_family', 'Nunito');
	$body_font  	= str_replace('+', ' ', $body_font);
	$headings_font 	= get_theme_mod('headings_font_family', 'Poppins');
	$headings_font  = str_replace('+', ' ', $headings_font);

	$fonts     		= array();
	$fonts[] 		= esc_attr($body_font) . ':' . esc_attr($weights);
	$fonts[] 		= esc_attr($headings_font) . ':' . esc_attr($weights);

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Post templates backward compat.
 */
function paisa_exclude_page_templates( $post_templates ) {
    if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
        unset( $post_templates['post-templates/post-fullwidth.php'] );
    }
 
    return $post_templates;
}
 
add_filter( 'theme_page_templates', 'paisa_exclude_page_templates' );

/**
 * Customizer styles
 */
function paisa_customizer_styles() {
    wp_enqueue_script( 'paisa-fonts-customizer', get_template_directory_uri() . '/js/customizer-fonts.js', array('jquery'),'', true );
    wp_enqueue_style( 'paisa-fonts-customizer-styles', get_template_directory_uri() . '/js/customizer-fonts.css' );
}
add_action( 'customize_controls_print_styles', 'paisa_customizer_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Functions
 */
require get_template_directory() . '/inc/functions/loader.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Woocommerce
 */
require get_template_directory() . '/woocommerce/woocommerce.php';