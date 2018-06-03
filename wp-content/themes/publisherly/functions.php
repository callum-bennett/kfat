<?php
/**
 * components functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Publisherly
 */

if ( ! function_exists( 'publisherly_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the aftercomponentsetup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function publisherly_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'publisherly' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'publisherly', get_template_directory() . '/languages' );

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
    set_post_thumbnail_size( 800, 485, true ); // set featured image size
    add_image_size( 'publisherly-big', 800, 400, array( 'center', 'center' ) ); // thumbnail index page

	/*
	 * This theme uses wp_nav_menu()
	 */
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'publisherly' ),
		'secondary' => esc_html__( 'Secondary Menu', 'publisherly' ),
	) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', apply_filters( 'publisherly_custom_logo_args', array(
		'width'       => 300,
		'height'      => 60,
		'flex-height' => true,
		'flex-width'  => true
	) ) );

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
	add_theme_support( 'custom-background', apply_filters( 'publisherly_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif;
add_action( 'after_setup_theme', 'publisherly_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function publisherly_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'publisherly_content_width', 800 );
}
add_action( 'after_setup_theme', 'publisherly_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function publisherly_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'publisherly' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Widgets in this area will be shown in the sidebar.', 'publisherly' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );

	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Footer Widget Area 1', 'publisherly' ),
			'id' 			=> 'publisherly-footer-widget-1',
			'description' 	=> esc_html__( 'Appears on all pages at the bottom of site.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Footer Widget Area 2', 'publisherly' ),
			'id' 			=> 'publisherly-footer-widget-2',
			'description' 	=> esc_html__( 'Appears on all pages at the bottom of site.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Footer Widget Area 3', 'publisherly' ),
			'id' 			=> 'publisherly-footer-widget-3',
			'description' 	=> esc_html__( 'Appears on all pages at the bottom of site.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

	register_sidebar(
		array(
			'name' 			=> esc_html__( 'Footer Widget Area 4', 'publisherly' ),
			'id' 			=> 'publisherly-footer-widget-4',
			'description' 	=> esc_html__( 'Appears on all pages at the bottom of site.', 'publisherly' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
		)
	);

}
add_action( 'widgets_init', 'publisherly_widgets_init' );

/**
 * Register Google fonts
 *
 * @return string Encoded Google fonts URL
 */
if ( ! function_exists( 'publisherly_fonts' ) ) {

	function publisherly_fonts() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		$fonts[] = 'Lato:400,700';
		$fonts[] = 'Open Sans:400,700';

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
}

/**
 * Enqueue scripts and styles.
 */
function publisherly_scripts() {

	// Load Main Stylesheet
	wp_enqueue_style( 'publisherly-stylesheet', get_stylesheet_uri(), array() );

	// Add Google fonts
	wp_enqueue_style( 'publisherly-fonts', publisherly_fonts(), array(), null );

	// Font Awesome
	wp_enqueue_style( 'publisherly-fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css', array(), null );

	// Makes "skip to content" link work correctly
	wp_enqueue_script( 'publisherly-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array( 'jquery' ), null, true );

	// JS file for main navigation
	wp_enqueue_script( 'publisherly-script', get_template_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), null, true );

	wp_localize_script( 'publisherly-script', 'publisherlyScreenReaderText', array(
		'expand'   => __( 'expand child menu', 'publisherly' ),
		'collapse' => __( 'collapse child menu', 'publisherly' ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'publisherly_scripts' );

/**
 * Custom functions.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load admin theme page.
 */
require get_template_directory() . '/inc/admin.php';
