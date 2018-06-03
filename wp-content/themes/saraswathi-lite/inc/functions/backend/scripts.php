<?php
/**
 * Enqueue scripts to be used in the backend (WordPress Admin).
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite


 * ****************************
 *	Table of Contents
 *
 *	1.0	-	Customizer Preview
 *	2.0	-	Customizer Controls
 *	3.0	-	Admin Scripts
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



/**
 *	1.0	-	Customizer Preview
 *	Enqueue scripts needed for customizer preview.
 */
function saraswathi_customize_preview_js() {

	// Contains handlers to make Theme Customizer preview reload changes asynchronously.
	wp_enqueue_script( 'saraswathi_customize_preview', get_template_directory_uri() . '/dist/scripts/customizer.js', array( 'jquery', 'customize-preview' ), null, true );
	
	
	$saras_cust_preview['url']         = admin_url( 'admin-ajax.php' );
	$saras_cust_preview['nonce']       = wp_create_nonce( 'saras_customizer_preview_ajax_nonce' );
	$saras_cust_preview['noPostMetaMsg']      = __( 'Post meta information such as author name, categories, tags etc are shown on single posts.Please browse to a post and then change current option to see preview of those changes in real time.','saraswathi-lite' );
	$saras_cust_preview['noSummaryMetaMsg']      = __( 'These elements are shown on archive pages. Please browse to a post archive page and then change current option to see preview of those changes in real time.','saraswathi-lite' );
	$saras_cust_preview['confirmButtonText']      = __( 'Okay, Got it!','saraswathi-lite' );
	$saras_cust_preview['sorry']      = __( 'Sorry!','saraswathi-lite' );
	$saras_cust_preview['noBgSet']      = __( 'No Background Image has been set','saraswathi-lite' );
	$saras_cust_preview['noSidebar']      = __( 'No Sidebar','saraswathi-lite' );
	$saras_cust_preview['noSidebarText']      = __( 'Either this page does not have sidebar or sidebar is empty.Please browse to a page where the sidebar is visible and then change current option to see preview of those changes in real time.','saraswathi-lite' );
	$saras_cust_preview['noWidgetsText']      = __( 'No widgets were found on the sidebar.Add widgets to sidebar and try changing sidebar layout','saraswathi-lite' );
	$saras_cust_preview['entryDate']      = __( 'Entry date is a post meta information','saraswathi-lite' );
	$saras_cust_preview['noEntryDate']      = __( 'No entry date was found on this post','saraswathi-lite' );
	$saras_cust_preview['entryAuthor']      = __( 'Entry author is a post meta information','saraswathi-lite' );
	$saras_cust_preview['noEntryAuthor']      = __( 'No author meta information was found on this post','saraswathi-lite' );
	$saras_cust_preview['entryCategory']      = __( 'Entry category is a post meta information','saraswathi-lite' );
	$saras_cust_preview['noEntryCategory']      = __( 'No category links information were found on this post','saraswathi-lite' );
	$saras_cust_preview['entryTags']      = __( 'Entry tags is a post meta information','saraswathi-lite' );
	$saras_cust_preview['noEntryTags']      = __( 'No tag links information were found on this post','saraswathi-lite' );
	$saras_cust_preview['entryFormat']      = __( 'Entry format is a post meta information','saraswathi-lite' );
	$saras_cust_preview['noEntryFormat']      = __( 'No post format information was found on this post','saraswathi-lite' );
	$saras_cust_preview['entryComment']      = __( 'Entry comment is a post meta information','saraswathi-lite' );
	$saras_cust_preview['noEntryComment']      = __( 'No comment information was found on this post','saraswathi-lite' );
	$saras_cust_preview['noHeader']      = __( 'No Header','saraswathi-lite' );
	$saras_cust_preview['noHeaderText']      = __( 'Please browse to a page where the header is visible and then change current option to see preview of those changes in real time.','saraswathi-lite' );
	$saras_cust_preview['noLogo']      = __( 'No logo area was found on this page.','saraswathi-lite' );
	$saras_cust_preview['noLogoSection']      = __( 'No logo section was found','saraswathi-lite' );
	$saras_cust_preview['noFooter']      = __( 'No Footer','saraswathi-lite' );
	$saras_cust_preview['noFooterText']      = __( 'Please browse to a page where the footer is visible and then change current option to see preview of those changes in real time.','saraswathi-lite' );
	$saras_cust_preview['noFooterTextArea']      = __( 'No footer text area was found','saraswathi-lite' );


	
	wp_localize_script('saraswathi_customize_preview', 'saraswathi_ajaxvar', $saras_cust_preview );
	
	wp_enqueue_script( 'saraswathi-customizer-backend-js', get_template_directory_uri() . '/dist/scripts/customizer-backend.js', array( 'jquery' ), null, true );

}
add_action( 'customize_preview_init', 'saraswathi_customize_preview_js' );



/**
 *	2.0	-	Customizer Controls
 *	Enqueue scripts needed for theme customizer settings.
 */
function saraswathi_customize_controls_js() {

	// Contains functions that modify elements on customizer preview screen.
	wp_enqueue_script( 'saraswathi_customize_elements', get_template_directory_uri() . '/dist/scripts/customizer-controls-enqueue.js', array( 'jquery', 'customize-controls' ), null, true );

	wp_enqueue_script( 'saraswathi-chosen-backend-js', get_template_directory_uri() . '/dist/scripts/chosen-backend.js', array( 'jquery' ), null, true );

}
add_action( 'customize_controls_enqueue_scripts', 'saraswathi_customize_controls_js' );



/**
 *	3.0	-	Admin Scripts
 * Enqueue scripts needed for admin dashboard
 */
function saraswathi_admin_enqueue_js() {

	// Scripts for saraswathi shortcode plugin.
	global $pagenow;

	if ( in_array($pagenow, array(
		'themes.php',
		'widgets.php',
	)) ) {
		wp_enqueue_script( 'saraswathi-chosen-backend-js', get_template_directory_uri() . '/dist/scripts/chosen-backend.js', array( 'jquery' ), null, true );

	}

}
add_action( 'admin_enqueue_scripts', 'saraswathi_admin_enqueue_js' );