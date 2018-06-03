<?php
/**
 *
 * The functions include construct, customizer, & data handlers
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite

 * ************************************
 *	Table of Contents
 *
 *	1.0	-	Scripts & Styles
 *	2.0	-	Admin
 *	3.0	-	Construct
 *	4.0	-	Customizer
 *	5.0	-	Handlers
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Create path to the directory containing the backend functions.
$saras_back_path = get_template_directory().'/inc/functions/backend';

/**
*	1.0	-	Scripts & Styles
*/


// Required files scripts and stules for backend functions.
require_once( $saras_back_path . '/scripts.php' );
require_once( $saras_back_path . '/styles.php' );


/**
*	2.0	-	Admin
*/


// Create path to the directory containing the admin functions.
$saras_backend_admin_path = get_template_directory().'/inc/functions/backend/admin';

// Call the files containing the functions.

require_once( $saras_backend_admin_path . '/menu.php' );


/**
*	3.0	-	Construct
*/


// Create path to the directory containing the construct functions.
$saras_construct_path = get_template_directory().'/inc/functions/backend/construct';

// Required files construct functions.
require_once( $saras_construct_path . '/comments.php' );
require_once( $saras_construct_path . '/menus.php' );
require_once( $saras_construct_path . '/widgets/social-icons.php' );
require_once( $saras_construct_path . '/widgets.php' );




/**
*	4.0	-	Customizer
*/


// Create path to the directory containing the customizer functions.
$saras_customizer_path = get_template_directory().'/inc/functions/backend/customizer';

// Required files for register and output of panels, sections, options and settings.
require_once( $saras_customizer_path . '/controls.php' );
require_once( $saras_customizer_path . '/customizer.php' );

// Create path to the directory containing the customizer functions.
$saras_customizer_css_path = get_template_directory().'/inc/functions/backend/customizer/css';

// Required files for composing CSS.
require_once( $saras_customizer_css_path . '/css.php' );

/**
*	5.0	-	Handlers
*/

// Create path to the directory containing the handlers functions.
$saras_back_handler_path = get_template_directory().'/inc/functions/backend/handlers';

// Required files for handling data.
require_once( $saras_back_handler_path . '/data.php' );
require_once( $saras_back_handler_path . '/process.php' );