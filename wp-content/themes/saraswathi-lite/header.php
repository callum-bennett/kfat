<?php
/**
 *
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="saras-content-wrap">
 *
 * located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/frameworks/[Name of framework selected]/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php saraswathi_get_template_part( 'saraswathi', 'site', 'header' ); ?>
