<?php
/**
 *
 *	The functions include layouts, plugins, & extras for frontend
 *
 *	Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/'
 *
 *	@since Saraswathi 1.0
 *
 *	@package Saraswathi

 * ************************************
 *	Table of Contents
 *
 *	1.0	-	Scripts & Styles
 *	2.0	-	Extra Features
 *	3.0	-	Data Handlers
 *	4.0	-	Template Tags
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Create path to the directory containing the backend functions.
$saras_front_path = get_template_directory().'/inc/functions/frontend';


/**
*	1.0	-	Scripts & Styles
*/


// Required files scripts and stules for frontend.
require_once( $saras_front_path. '/scripts.php' );
require_once( $saras_front_path. '/styles.php' );


/**
*	2.0	-	Extra Features
*/

// Create path to the directory containing the backend functions.
$saras_extra_path = get_template_directory().'/inc/functions/frontend/extras';

// Required files frontend extra functions.
require_once( $saras_extra_path . '/extras.php' );


/**
*	3.0	-	Data Handlers
*/


// Create path to the directory containing the backend functions.
$saras_hand_path = get_template_directory().'/inc/functions/frontend/handlers';

// Required files frontend handler functions.
require_once( $saras_hand_path . '/global.php' );


/**
*	4.0	-	Template Tags
*/

// Create path to the directory containing the backend functions.
$saras_layouts_front_path = get_template_directory().'/inc/functions/frontend/templates';

// Required files frontend layout functions.
require_once( $saras_layouts_front_path . '/template-tags.php' );
