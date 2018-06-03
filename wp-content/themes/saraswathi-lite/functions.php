<?php
/**
 *
 * This calls the main setup functions for saraswathi theme.
 *
 * The setup functions are included the setup.php located in local directory '/wp-content/themes/saraswathi/inc/functions/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$saras_func_path = get_template_directory() . '/inc/functions';

require_once( get_template_directory() . '/inc/functions/setup.php' );

