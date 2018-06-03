<?php
/**
 *
 *	Enqueue frontend scripts
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite



 * ****************************
 *	Table of Contents
 *
 *	1.0	-	WordPress Library
 *	2.0	-	Theme Default
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 *	1.0	-	WordPress Library
 * Enqueue scripts inbuilt in WordPress
 */
function saraswathi_frontend_wp_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'saraswathi_frontend_wp_scripts' );


/**
 *	2.0	-	Theme Default
 * Scripts required for saraswathi theme
 */
function saraswathi_frontend_scripts() {

	wp_enqueue_script('saraswathi_modernizr', get_template_directory_uri() . '/dist/scripts/modernizr.js', null , null, true);
	
	wp_enqueue_script('saraswathi', get_template_directory_uri() . '/dist/scripts/saraswathi.js', array('jquery','saraswathi_modernizr'), null, true);

}
add_action( 'wp_enqueue_scripts', 'saraswathi_frontend_scripts' );