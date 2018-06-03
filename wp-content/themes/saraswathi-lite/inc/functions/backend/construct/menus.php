<?php
/*
* Construct primary and footer menus.
*
* This also includes the custom menu walker used for Saraswathi Mega Menu.
*
* located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/construct/'
*
* @since Saraswathi Lite 1.0.0
*
* @package Saraswathi Lite

******************************************
*	Table of Contents
*
*	1.0 - Add Menu
*
*

*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function saraswathi_main_menu() {

	wp_nav_menu(array(
		'container' => false,                           // remove nav container
		'container_class' => '',                        // class of container
		'menu_class' => 'saras-main-menu',           // adding custom nav class
		'theme_location' => 'primary',                // where it's located in the theme
		'before' => '',                                 // before each link <a>
		'after' => '',                                  // after each link </a>
		'link_before' => '',                            // before each link text
		'link_after' => '',                             // after each link text
		'depth' => 0,                                   // limit the depth of the nav
		'echo' => true,

	));

}
/*
* Footer Menu
*/
function saraswathi_footer_menu() {
	wp_nav_menu(array(
		'container' => false,                           // remove nav container
		'container_class' => '',                        // class of container
		'menu_class' => 'footer-menu inline-list',              // adding custom nav class
		'theme_location' => 'footer',        // where it's located in the theme
		'before' => '',                                 // before each link <a>
		'after' => '',                                  // after each link </a>
		'link_before' => '',                            // before each link text
		'link_after' => '',                             // after each link text
		'depth' => 1,                                   // limit the depth of the nav
		'echo' => true,
	));
}