<?php
/**
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/frameworks/[Name of framework selected]/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php saraswathi_get_template_part( 'saraswathi', 'site', 'page' ); ?>
