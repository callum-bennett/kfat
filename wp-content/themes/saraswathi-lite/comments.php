<?php
/**
 *
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/frameworks/[Name of framework selected]/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly..
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

?>
<?php saraswathi_get_template_part( 'saraswathi', 'site', 'comments' ); ?>
