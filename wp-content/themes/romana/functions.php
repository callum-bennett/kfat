<?php
function romana_setup() {
	load_theme_textdomain( 'romana',get_template_directory() . '/languages' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	$romana_defaults = array(
	    'default-image' => '',
	    'default-preset' => 'default',
	    'default-position-x' => 'center',
	    'default-position-y' => 'center',
	    'default-size' => 'auto',
	    'default-repeat' => 'repeat',
	    'default-attachment' => 'scroll',
	    'default-color' => '#fff',
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background',$romana_defaults );
	add_image_size( 'romana-blog-image', 750, 500, true );
	add_image_size( 'romana-thumbnail-avatar', 100, 100, true );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'    => __( 'Top Menu', 'romana' ),
	) );
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => array( 'brandText')
	) );
}
add_action( 'after_setup_theme', 'romana_setup' );
function romana_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'romana_content_width', 640 );
}
add_action( 'after_setup_theme', 'romana_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function romana_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'romana' ),
		'id'            => 'sidebar-1',
		'romana_description'   => __( 'Add widgets here to appear in your sidebar.', 'romana' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s" data-aos="fade-up">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 1', 'romana' ),
		'id'            => 'footer-1',
		'romana_description'   => __( 'Add widgets here to appear in your footer.', 'romana' ),
		'before_widget' => '<div id="%1$s" class="%2$s footer-list">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="list-heading">',
		'after_title'   => '</p>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 2', 'romana' ),
		'id'            => 'footer-2',
		'romana_description'   => __( 'Add widgets here to appear in your footer.', 'romana' ),
		'before_widget' => '<div id="%1$s" class="%2$s footer-list">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="list-heading">',
		'after_title'   => '</p>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 3', 'romana' ),
		'id'            => 'footer-3',
		'romana_description'   => __( 'Add widgets here to appear in your footer.', 'romana' ),
		'before_widget' => '<div id="%1$s" class="%2$s footer-list">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="list-heading">',
		'after_title'   => '</p>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 4', 'romana' ),
		'id'            => 'footer-4',
		'romana_description'   => __( 'Add widgets here to appear in your footer.', 'romana' ),
		'before_widget' => '<div id="%1$s" class="%2$s footer-list">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="list-heading">',
		'after_title'   => '</p>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 5', 'romana' ),
		'id'            => 'footer-5',
		'romana_description'   => __( 'Add widgets here to appear in your footer.', 'romana' ),
		'before_widget' => '<div id="%1$s" class="%2$s footer-list">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="list-heading">',
		'after_title'   => '</p>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer 6', 'romana' ),
		'id'            => 'footer-6',
		'romana_description'   => __( 'Add widgets here to appear in your footer.', 'romana' ),
		'before_widget' => '<div id="%1$s" class="%2$s footer-list">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="list-heading">',
		'after_title'   => '</p>',
	) );
}
add_action( 'widgets_init', 'romana_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 */
function romana_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		esc_html__( 'Read More', 'romana' )
	);
	return $link;
}
add_filter( 'excerpt_more', 'romana_excerpt_more' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function romana_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'romana_pingback_header' );

add_action('admin_menu', 'romana_options_add_page');

function romana_options_add_page() {
  add_theme_page( esc_html__('RomanaPro Features', 'romana'), esc_html__('RomanaPro Features', 'romana'), 'manage_options', 'romanapro-features', 'romana_features', 400 );
}
function romana_features(){ ?>
	<div class="roamanapro-version">
		<a href="<?php echo esc_url('https://indigothemes.com/products/romana-pro-wordpress-theme/'); ?>" target="_blank">
			<img src ="<?php echo esc_url(get_template_directory_uri().'/assets/images/pro-features.jpg') ?>" width="98%" height="auto" />
		</a>
	</div>
<?php }
include get_template_directory().'/inc/enqueues.php';
require get_template_directory() . '/inc/tgm-plugins.php';