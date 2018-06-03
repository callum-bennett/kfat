<?php
/**
 *
 * Main setup file
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 
 * **********************************
 *	Table of Contents
 *
 *	1.0	-	Define Theme Version
 *	2.0	- Include	Functions
 *	3.0	-	Setup Theme Defaults
 *	4.0	-	Register WordPress Defaults
 *				4.1	-	Textdomain
 *				4.2	-	Feed
 *				4.3	-	Thumbnails
 *				4.4	-	HTML5
 *				4.5	-	Post Formats
 *				4.6	-	Title
 *				4.7	-	Editor Style
 *	5.0	-	Register Navigation Menus
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}



/**
 *	1.0	-	Define Theme Version
 */

define('SARASWATHI_LITE_VERSION', '1.0.13');




/**
 *	2.0	- Include	Functions
 */


// Create Local Path Variables.
$saras_func_path = get_template_directory() . '/inc/functions';
$saras_js_path   = get_template_directory() . '/js';
$saras_img_path  = get_template_directory() . '/img';
$saras_css_path  = get_template_directory() . '/styles/css';


// Required files to call frontend and backend functions.
require_once($saras_func_path . '/backend/functions.php');
require_once($saras_func_path . '/frontend/functions.php');



/**
 *	3.0	-	Setup Theme Defaults
 */


/*
 * Set the content width for oembeds.
 *
 * @since Saraswathi Lite 1.0.0.
 */
if (!isset($content_width)) {
    $content_width = 660;
}



/**
 *	4.0	-	Register WordPress Defaults
 */



if (!function_exists('saraswathi_setup')): /**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */ 
    function saraswathi_setup()
    {
        
        /**
         *	4.1	-	Textdomain
         *	Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Saraswathi, use a find and replace
         * to change 'saraswathi' to the name of your theme in all the template files
         */
        
        load_theme_textdomain('saraswathi-lite', get_template_directory() . '/languages');
        
        /**
         * 4.2	-	Feed
         *	Add default posts and comments RSS feed links to head.
         */
        
        add_theme_support('automatic-feed-links');

        /**
         *	4.3	-	Thumbnails
         *	Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        
        add_theme_support('post-thumbnails');
        
        /**
         *	4.4	-	HTML5
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ));
        
			
        /**
         *	4.5	-	Post Formats
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        
        add_theme_support('post-formats', array(
            'image',
            'video'
        ));
        

        // Add theme support for Custom Logo.
        $logo_width = saraswathi_get_theme_mod('saras_logo_max_width', 200);
        add_theme_support( 'custom-logo', array(
            'width'       => $logo_width,
            'height'      => 30,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description', 'site-branding-text','brands' ),
    
        ) );

        add_theme_support( 'custom-background' );

        // Add theme support for selective refresh for widgets.
	    add_theme_support( 'customize-selective-refresh-widgets' );
        
        /**
         *	4.6	-	Title
         * Since WordPress 4.1
         * Add Support For Title Tags        
         */       
        add_theme_support('title-tag');
   
        
               
        /**
         *	5.0	-	Register Navigation Menus
         * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
         */
        
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'saraswathi-lite'),
            'footer' => __('Footer', 'saraswathi-lite')
        ));
}
endif;

add_action('after_setup_theme', 'saraswathi_setup');
