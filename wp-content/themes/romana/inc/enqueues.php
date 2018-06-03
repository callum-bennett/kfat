<?php function romana_enqueues(){
	$romana_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	wp_enqueue_style( 'google-fonts-open-sans', '//fonts.googleapis.com/css?family=Open+Sans', array(), '1.0.0' );
	wp_enqueue_style('bootstrap',get_template_directory_uri().'/assets/css/bootstrap'.$romana_suffix.'.css', array(), null, 'all' );
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/font-awesome'.$romana_suffix.'.css', array(), null, 'all' );
	wp_enqueue_style('romana',get_template_directory_uri().'/assets/css/default.css', array(), null, 'all' );
	wp_enqueue_style('romana-style', get_stylesheet_uri(), array());
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	wp_enqueue_script('bootstrap',get_template_directory_uri().'/assets/js/bootstrap'.$romana_suffix.'.js', array('jquery'), null, true);
	wp_enqueue_script('romana',get_template_directory_uri().'/assets/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts','romana_enqueues');
include get_template_directory().'/inc/theme-customization.php';
include get_template_directory().'/inc/breadcrumbs.php';