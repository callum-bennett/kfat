<?php
/**
 * Saraswathi Theme Customizer
 *
 * Adds panels,sections,settings,and controls for Theme Customizer.
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/customizer/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite







 * ************************************
 *	Table of Contents
 *
 *	1.0 - Panels
 *	2.0 - Sections
 *	3.0 - Variables
 *	4.0	-	Settings & Controls
 *			4.1		-	Saraswathi Framework
 *					4.1.1	-	Site Layout
 *					4.1.2	-	Site Background
 *					4.1.3	-	Topbar
 *					4.1.4	-	Content
 *					4.1.5	-	Sidebar
 *					4.1.6	-	Widget
 *					4.1.7	-	Footer
 *  		4.2 	- Content Layout
 *					4.2.1 - Potfolio Content
 *			4.3		-	Widget Area
 *			4.4		-	Typography
 *			4.5		-	Site Header
 *			4.6		-	Site Footer
 *			4.7		-	Form
 *			4.8		-	Button
 *			4.9	-	Icons
 *			4.10	-	Custom Code
 *	5.0	-	Add Panels
 *	6.0	-	Add Sections
 *	7.0	-	Add Settings
 *	8.0	- Add Controls
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the panels, sections, controls, & settings to the $wp_customize object
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function saraswathi_customize_register( $wp_customize ) {

	/**
* Remove pre-existing sections
*/

	global $wp_customize;

	$wp_customize->remove_section( 'colors' );
	$wp_customize->get_section( 'background_image' )->panel = 'scr_panel_layouts';
	$wp_customize->get_section( 'title_tagline' )->panel = 'scr_panel_design';

	/*  Panels to group sections together   */

	$saras['panel'][] = array(
		'id'								=> 'scr_panel_layouts',
		'title' 						=> __( 'Layouts','saraswathi-lite' ),
		'priority'          => 1,
		'description'       => __( 'Select from any of these unique templates for your website','saraswathi-lite' ),
	);
	$saras['panel'][] = array(
		'id'								=> 'scr_panel_design',
		'title' 						=> __( 'Design','saraswathi-lite' ),
		'priority'          => 2,
		'description'       => __( 'Settings for site\'s design like fonts and colours','saraswathi-lite' ),
	);


	$saras['panel'][] = array(
		'id'								=> 'scr_panel_plugin',
		'title' 						=> __( 'Plugins','saraswathi-lite' ),
		'priority'          => 3,
		'description'       => __( 'Customize plugins','saraswathi-lite' ),
	);

	$saras['panel'][] = array(
		'id'								=> 'scr_panel_upgrade',
		'title' 						=> __( 'Upgrade','saraswathi-lite' ),
		'priority'          => 4,
		'description'       => __( 'Upgrade saraswathi theme to Pro Version','saraswathi-lite' ),
	);
	/**
* Sections are arranged under panels.
*/

	$saras['section'][] = array(
		'id'								=> 'scr_section_saraswathi',
		'title' 						=> __( 'Theme Layout','saraswathi-lite' ),
		'priority'          => 2,
		'panel'          		=> 'scr_panel_layouts',
	);



	$saras['section'][] = array(
		'id'								=> 'scr_section_content',
		'title' 						=> __( 'Content','saraswathi-lite' ),
		'priority'          => 3,
		'panel'          		=> 'scr_panel_layouts',
	);
	$saras['section'][] = array(
		'id'								=> 'scr_section_widgetareas',
		'title' 						=> __( 'Widgetarea','saraswathi-lite' ),
		'priority'          => 4,
		'panel'          		=> 'scr_panel_layouts',
		'description'       => __( 'Customize layout for various widget areas','saraswathi-lite' ),
	);
    	$saras['section'][] = array(
		'id'								=> 'scr_section_typography',
		'title' 						=> __( 'Typography','saraswathi-lite' ),
		'priority'          => 5,
		'panel'          		=> 'scr_panel_design',
		'description'       => __( 'Customize typography of site','saraswathi-lite' ),
	);
	$saras['section'][] = array(
		'id'								=> 'scr_section_header',
		'title' 						=> __( 'Header','saraswathi-lite' ),
		'priority'          => 6,
		'panel'          		=> 'scr_panel_design',
	);
	$saras['section'][] = array(
		'id'								=> 'scr_section_footer',
		'title' 						=> __( 'Footer','saraswathi-lite' ),
		'priority'          => 7,
		'panel'          		=> 'scr_panel_design',
	);

	$saras['section'][] = array(
		'id'								=> 'scr_section_button',
		'title' 						=> __( 'Button','saraswathi-lite' ),
		'priority'          => 9,
		'panel'          		=> 'scr_panel_design',
		'description'       => '',
	);
	$saras['section'][] = array(
		'id'								=> 'scr_section_media',
		'title' 						=> __( 'Media','saraswathi-lite' ),
		'priority'          => 10,
		'panel'          		=> 'scr_panel_design',
	);

	$saras['section'][] = array(
		'id'								=> 'scr_section_icons',
		'title' 						=> __( 'Icons','saraswathi-lite' ),
		'priority'          => 11,
		'panel'          		=> 'scr_panel_design',
	);

	$saras['section'][] = array(
		'id'								=> 'scr_section_pro',
		'title' 						=> __( 'Upgrade','saraswathi-lite' ),
		'priority'          => 12,

	);

	$saras_site_layouts_list = array(
		'grid' 							=> __( 'Grid','saraswathi-lite' ),
		'fullwidth' 				=> __( 'Fullwidth','saraswathi-lite' ),
	);

	$saras_sidebar_layouts_list = array(
		'left' 							=> __( 'Left Sidebar','saraswathi-lite' ),
		'right' 						=> __( 'Right Sidebar','saraswathi-lite' ),
		'none' 							=> __( 'No sidebar','saraswathi-lite' ),
	);

	$saras_index_widget_cols   = array(
		2 									=> __( 'Two','saraswathi-lite' ),
		3 									=> __( 'Three','saraswathi-lite' ),
		4 									=> __( 'Four','saraswathi-lite' ),
	);

	$saras_featured_media_size    = array(
		'thumbnail' 				=> __( 'Thumbnail','saraswathi-lite' ),
		'medium' 						=> __( 'Medium','saraswathi-lite' ),
		'large' 						=> __( 'Large','saraswathi-lite' ),
		'full' 							=> __( 'Full','saraswathi-lite' ),
	);	
	
	$saras_footer_position = array(
		'left' 							=> __( 'Left','saraswathi-lite' ),
		'right' 						=> __( 'Right','saraswathi-lite' ),
	);
	
	$saras_scroll_position = array(
		'left' 							=> __( 'Left','saraswathi-lite' ),
		'right' 						=> __( 'Right','saraswathi-lite' ),
		'none' 							=> __( 'Center','saraswathi-lite' ),
	);

	$saras_page_widget_position = array(
		'above' 						=> __( 'Above Content','saraswathi-lite' ),
		'below' 						=> __( 'Below Content','saraswathi-lite' ),
		'both' 							=> __( 'Above & Below Content','saraswathi-lite' ),
	);

	$saras_fonts_select = array(
		'Merriweather'       		   => __( 'Merriweather','saraswathi-lite' ),
		'Lato'    	                   => __( 'Lato','saraswathi-lite' ),
		'Roboto'      	               => __( 'Roboto','saraswathi-lite' ),
        'Raleway'      	               => __( 'Raleway','saraswathi-lite' ),
	);

/**
*	4   -   Settings & Controls
*/

	/**
*	4.1	-	Framework Settings
*/

	/**
*	4.1.1	-	Site Layout Settings
*/

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_site_layout',
		'default' 					=> 'grid',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_saraswathi_site_layout',
		'type'          		=> 'radio',
		'label'         		=> __( 'Site Layout','saraswathi-lite' ),
		'section'       		=> 'scr_section_saraswathi',
		'choices'       		=> $saras_site_layouts_list,
		'description'   		=> __( 'Choose your layout style','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_grid_max_width',
		'default' 					=> '1280',
		'sanitize_callback' => 'saraswathi_sanitize_int',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_saraswathi_grid_max_width',
		'type'          		=> 'number',
		'section'       		=> 'scr_section_saraswathi',
		'label'         		=> __( 'Grid Max Width','saraswathi-lite' ),
		'description'   		=> __( 'Set maximum width for grid (px)','saraswathi-lite' ),
		'input_attrs'   		=> array(
		'min'       				=> '768',
		'step'      				=> 1,
		),
		'active_callback'		=> 'saraswathi_is_site_layout_grid',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_content_width',
		'default' 					=> '75',
		'sanitize_callback' => 'saraswathi_sanitize_int',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_saraswathi_content_width',
		'type'          		=> 'number',
		'section'       		=> 'scr_section_saraswathi',
		'label'         		=> __( 'Content Width','saraswathi-lite' ),
		'description'   		=> __( 'Set width for content (%)(Note: For content to align with sidebar <strong>Content Width + Sidebar Width</strong> should be 100 or below, If content is 80 then sidebar is 20 or lower. Likewise 75 for content means 25 or lower for sidebar.)','saraswathi-lite' ),
		'input_attrs'   		=> array(
		'min'       				=> '50',
		'max'       				=> '100',
		'step'      				=> 1,
		),
	);

	/**
*	4.1.2	-	Site Background Settings
*/

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_body_animated_gradient_trend_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_saraswathi_body_animated_gradient_trend_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Trending Colours','saraswathi-lite' ),
		'section'      			=> 'scr_section_saraswathi',
		'description'  			=> __( '&#x3C;strong&#x3E;Hint:&#x3C;/strong&#x3E; Find trending colour swatches at &#x3C;a href=&#x22;://color.adobe.com/explore/most-popular/?time=all&#x22; target=&#x22;_blank&#x22;&#x3E; Adobe colour &#x3C;/a&#x3E;','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_body_bg_color',
		'default' 					=> '#f9f9f9',
		'transport' 				=> 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_saraswathi_body_bg_color',
		'type'							=> 'color',
		'label'        			=> __( 'Background Colour','saraswathi-lite' ),
		'section'      			=> 'scr_section_saraswathi',
		'description'  			=> __( 'Set the background colour for site','saraswathi-lite' ),
	);


/**
*	4.1.3	-	Topbar Settings
*/


	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_topbar_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_saraswathi_topbar_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Topbar','saraswathi-lite' ),
		'section'      			=> 'scr_section_saraswathi',
		'description'  			=> __( 'Enable topbar search','saraswathi-lite' ),
	);


	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_enable_topbar_search',
		'default' 					=> 1,
	);
	$saras['control'][] = array(
		'id'									=> 'saras_saraswathi_enable_topbar_search',
		'type'	       				=> 'checkbox',
		'label'        				=> __( 'Enable Topbar Search','saraswathi-lite' ),
		'section'      				=> 'scr_section_saraswathi',
	);


/**
*	4.1.5	-	Sidebar Settings
*/

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_sidebar_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_saraswathi_sidebar_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Sidebar','saraswathi-lite' ),
		'section'      			=> 'scr_section_saraswathi',
		'description'  			=> __( 'Options to customize sidebar','saraswathi-lite' ),
		'active_callback'		=> 'saraswathi_is_active_sidebar',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_sidebar_layout',
		'default' 					=> 'right',
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_saraswathi_sidebar_layout',
		'type'          		=> 'radio',
		'label'         		=> __( 'Sidebar Layout','saraswathi-lite' ),
		'section'       		=> 'scr_section_saraswathi',
		'choices'       		=> $saras_sidebar_layouts_list,
		'description'   		=> __( 'Set the appreance of sidebar alongside content','saraswathi-lite' ),
		'active_callback'		=> 'saraswathi_is_active_sidebar',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_sidebar_width',
		'default' 					=> '25',
		'sanitize_callback' => 'saraswathi_sanitize_int',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_saraswathi_sidebar_width',
		'type'          		=> 'number',
		'section'       		=> 'scr_section_saraswathi',
		'label'         		=> __( 'Sidebar Width','saraswathi-lite' ),
		'description'   		=> __( 'Set width for sidebar (%) (Note: For sidebar to align with content <strong>Sidebar Width + Content Width</strong> should be 100, If sidebar width is 20 then content is 80. Likewise 25 for sidebar means 75 for content.)','saraswathi-lite' ),
		'input_attrs'   		=> array(
		'min'       				=> '10',
		'max'       				=> '100',
		'step'      				=> 1,
		),
		'active_callback'		=> 'saraswathi_is_active_sidebar',
	);

		/**
*	4.1.6	-	Widget Settings
*/


		/**
*	4.2 	- Content Layout Settings
*/

	$saras['setting'][] = array(
		'id'								=> 'saras_content_animations_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_content_animations_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Animation','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'description'  			=> __( 'Enable or disable site animations.','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_enable_site_animation',
		'default' 					=> 1,
	);
	$saras['control'][] = array(
		'id'								=> 'saras_enable_site_animation',
		'type'	       			=> 'checkbox',
		'label'        			=> __( 'Enable Animations','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
	);


	$saras['setting'][] = array(
		'id'								=> 'saras_post_meta_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_post_meta_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Post Meta','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'description'  			=> __( 'Show or hide post meta information such as author name, categories, tags etc show on every posts at the beginning and end.','saraswathi-lite' ),
		'active_callback' 	=> 'saraswathi_is_single_post',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_disable_entry_date',
		'default' 					=> 0,
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_disable_entry_date',
		'type'	       			=> 'checkbox',
		'label'        			=> __( 'Hide Entry Date','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'active_callback' 	=> 'saraswathi_is_single_post',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_disable_entry_author',
		'default' 					=> 0,
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_disable_entry_author',
		'type'	       			=> 'checkbox',
		'label'        			=> __( 'Hide Author Box','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'active_callback' 	=> 'saraswathi_is_single_post',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_disable_entry_category',
		'default' 					=> 0,
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_disable_entry_category',
		'type'	       			=> 'checkbox',
		'label'        			=> __( 'Hide Category Links','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'active_callback' 	=> 'saraswathi_is_single_post',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_disable_entry_tags',
		'default' 					=> 0,
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_disable_entry_tags',
		'type'	       			=> 'checkbox',
		'label'        			=> __( 'Hide Tags Links','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'active_callback' 	=> 'saraswathi_is_single_post',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_disable_entry_format',
		'default' 					=> 0,
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_disable_entry_format',
		'type'	       			=> 'checkbox',
		'label'        			=> __( 'Hide Post Format Icon','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'active_callback' 	=> 'saraswathi_is_single_post',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_disable_entry_comment',
		'default' 					=> 0,
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_disable_entry_comment',
		'type'	       			=> 'checkbox',
		'label'        			=> __( 'Hide Comment Link','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'active_callback' 	=> 'saraswathi_is_single_post',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_content_layout_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_content_layout_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Post Archive Layouts','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'description'  			=> __( 'Change the settings below to change the layout of archives pages for posts','saraswathi-lite' ),
		'active_callback' 	=> 'saraswathi_is_post_archiveorhome',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_featured_media_size',
		'default' 					=> 'large',
	);
	$saras['control'][] = array(
		'id'         	  		=> 'saras_featured_media_size',
		'type'          		=> 'select',
		'label'         		=> __( 'Media Size','saraswathi-lite' ),
		'section'       		=> 'scr_section_content',
		'choices'       		=> $saras_featured_media_size,
		'description'   		=> __( 'Set the featured media sizes for summary on archive pages','saraswathi-lite' ),
		'active_callback' 	=> 'saraswathi_is_post_archiveorhome',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_enable_index_sidebar_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_enable_index_sidebar_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Sidebar On Index','saraswathi-lite' ),
		'section'      			=> 'scr_section_content',
		'description'  			=> __( 'This will disable sidebar only on index. If you want to completely remove sidebar on all pages please select No sidebar in main template options customizer - > layout - > saraswathi -> No sidebar','saraswathi-lite' ),
		'active_callback' 	=> 'is_front_page',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_enable_index_sidebar',
		'default' 					=> 1,
	);
	$saras['control'][] = array(
		'id'									=> 'saras_enable_index_sidebar',
		'type'	       				=> 'checkbox',
		'label'        				=> __( 'Enable sidebar on blog page.','saraswathi-lite' ),
		'section'      				=> 'scr_section_content',
		'active_callback' 		=> 'is_front_page',
	);		

/**
*	4.3		-	Widget Area
*/

	$saras['setting'][] = array(
		'id'								=> 'saras_content_widget_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_content_widget_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Hint','saraswathi-lite' ),
		'section'      			=> 'scr_section_widgetareas',
		'description'  			=> __( 'You can add any widget of your choice and arrange them in grids/columns.','saraswathi-lite' ),
	);
    
   
    $saras['setting'][] = array(
		'id'								=> 'saras_index_widgetarea_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_index_widgetarea_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Index Widget Area','saraswathi-lite' ),
		'section'      			=> 'scr_section_widgetareas',
		'description'  			=> __( 'A widget area to add any widget of your choice and arrange them in grids/columns on frontpage/index.','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_enable_index_widgetarea',
		'default' 					=> 0,
	);
	$saras['control'][] = array(
		'id'									=> 'saras_enable_index_widgetarea',
		'type'	       				=> 'checkbox',
		'label'        				=> __( 'Enable Index Widget Area','saraswathi-lite' ),
		'section'      				=> 'scr_section_widgetareas',
		'active_callback' 		=> 'is_front_page',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_default_content_widgetarea_position',
		'default' 					=> 'both',
	);
	$saras['control'][] = array(
		'id'         	  		=> 'saras_default_content_widgetarea_position',
		'type'          		=> 'select',
		'label'         		=> __( 'Widget Area Position','saraswathi-lite' ),
		'section'       		=> 'scr_section_widgetareas',
		'choices'       		=> $saras_page_widget_position,
		'description'   		=> __( 'Change the position of widget area. Should it be above or below content','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_default_content_widget_cols',
		'default' 					=> '4',
		'sanitize_callback' => 'saraswathi_sanitize_int',
	);
	$saras['control'][] = array(
		'id'         	  		=> 'saras_default_content_widget_cols',
		'type'          		=> 'select',
		'label'         		=> __( 'Widget Area Columns','saraswathi-lite' ),
		'section'       		=> 'scr_section_widgetareas',
		'choices'       		=> $saras_index_widget_cols,
		'description'   		=> __( 'Set the number of columns for widget rows. Hint: Widths and float will be automatically set for all widgets with position "Auto Grid"','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_default_above_index_widgetarea_count',
		'default' 					=> '1',
		'sanitize_callback' => 'saraswathi_sanitize_int',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_default_above_index_widgetarea_count',
		'type'          		=> 'number',
		'section'       		=> 'scr_section_widgetareas',
		'label'         		=> __( 'Above Index Widget Areas','saraswathi-lite' ),
		'description'   		=> __( 'Set number of default above index content widget area ( rows ) for all index ','saraswathi-lite' ),
		'input_attrs'   		=> array(
		'min'       				=> '1',
		'max'       				=> '10',
		'step'      				=> 1,
		),
		'active_callback' 		=> 'saraswathi_is_index_widgetarea',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_default_below_index_widgetarea_count',
		'default' 					=> '1',
		'sanitize_callback' => 'saraswathi_sanitize_int',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_default_below_index_widgetarea_count',
		'type'          		=> 'number',
		'section'       		=> 'scr_section_widgetareas',
		'label'         		=> __( 'Below Index Widget Areas','saraswathi-lite' ),
		'description'   		=> __( 'Set number of default below index content  widget area ( rows ) for all index ','saraswathi-lite' ),
		'active_callback' 	=> 'is_front_page',
		'input_attrs'   		=> array(
		'min'       				=> '1',
		'max'       				=> '10',
		'step'      				=> 1,
		),
		'active_callback' 		=> 'saraswathi_is_index_widgetarea',
	);
		


/**
*	4.4		-	Typography
*/


	$saras['setting'][] = array(
		'id'								=> 'saras_typo_enable_custom_fonts_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_typo_enable_custom_fonts_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Enable Custom Fonts','saraswathi-lite' ),
		'section'      			=> 'scr_section_typography',
		'description'  			=> __( 'Choose the whether to enable custom fonts for your website','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saraswathi_enable_custom_fonts',
		'default' 					=> 1,
	);
	$saras['control'][] = array(
		'id'									=> 'saraswathi_enable_custom_fonts',
		'type'	       				=> 'checkbox',
		'label'        				=> __( 'Enable Custom Fonts','saraswathi-lite' ),
		'section'      				=> 'scr_section_typography',
	);

    $saras['setting'][] = array(
		'id'								=> 'saras_custom_fonts_select',
		'default' 					=> 'Merriweather',
	);
	$saras['control'][] = array(
		'id'         	  		=> 'saras_custom_fonts_select',
		'type'          		=> 'select',
		'label'         		=> __( 'Select Font','saraswathi-lite' ),
		'section'       		=> 'scr_section_typography',
		'choices'       		=> $saras_fonts_select,
		'description'   		=> __( 'Select the font type to be used for this site','saraswathi-lite' ),
	);

 
/**
*	4.5		-	Site Header
*/

	$saras['setting'][] = array(
		'id'								=> 'saras_header_logo_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_header_logo_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Logo','saraswathi-lite' ),
		'section'      			=> 'scr_section_header',
		'description'  			=> __( 'By default your blog title will be your logo but you use an image instead.Recommended size 180x30','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_logo_max_width',
		'default' 					=> '200',
		'sanitize_callback' => 'saraswathi_sanitize_int',
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_logo_max_width',
		'type'          		=> 'number',
		'section'       		=> 'scr_section_header',
		'label'         		=> __( 'Logo Max Width','saraswathi-lite' ),
		'description'   		=> __( 'Set maximum width for logo image(px).If you are not using image use logo font size typography option to control size of logo','saraswathi-lite' ),
		'input_attrs'   		=> array(
		'min'       				=> '0',
		'max'       				=> '500',
		'step'      				=> '1',
		),
		'active_callback'   => 'saraswathi_is_logo_image',
	);

		/**
*	4.6		-	Site Footer
*/

	$saras['setting'][] = array(
		'id'								=> 'saras_footer_menu_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_footer_menu_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Navigation','saraswathi-lite' ),
		'section'      			=> 'scr_section_footer',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_enable_footer_scrolltop',
		'default' 					=> 1,
	);
	$saras['control'][] = array(
		'id'									=> 'saras_enable_footer_scrolltop',
		'type'	       				=> 'checkbox',
		'label'        				=> __( 'Enable Scroll To Top','saraswathi-lite' ),
		'section'      				=> 'scr_section_footer',
	);


	$saras['setting'][] = array(
		'id'								=> 'saras_footer_widget_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_footer_widget_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Footer Widgetarea','saraswathi-lite' ),
		'section'      			=> 'scr_section_footer',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_enable_footer_widgetarea',
		'default' 					=> 1,
	);
	$saras['control'][] = array(
		'id'									=> 'saras_enable_footer_widgetarea',
		'type'	       				=> 'checkbox',
		'label'        				=> __( 'Enable Footer Widgets','saraswathi-lite' ),
		'section'      				=> 'scr_section_footer',
	);



/**
*	4.8		-	Button
*/


	$saras['setting'][] = array(
		'id'								=> 'saras_button_color_1',
		'default' 					=> '#fafafa',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_button_color_1',
		'type'							=> 'color',
		'label'        			=> __( 'Primary Background','saraswathi-lite' ),
		'section'      			=> 'scr_section_button',
		'description'  			=> __( 'Set primary background colour for button','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_button_text_color_1',
		'default' 					=> '#9e9e9e',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_button_text_color_1',
		'type'							=> 'color',
		'label'        			=> __( 'Primary Text Color','saraswathi-lite' ),
		'section'      			=> 'scr_section_button',
		'description'  			=> __( 'Set primary text colour for button text(Hint:it is also user for 3D effect)','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_button_color_2',
		'default' 					=> '#455a64',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_button_color_2',
		'type'							=> 'color',
		'label'        			=> __( 'Secondary Background','saraswathi-lite' ),
		'section'      			=> 'scr_section_button',
		'description'  			=> __( 'Set secondary background color for button','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_button_text_color_2',
		'default' 					=> '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_button_text_color_2',
		'type'							=> 'color',
		'label'        			=> __( 'Secondary Text Color','saraswathi-lite' ),
		'section'      			=> 'scr_section_button',
		'description'  			=> __( 'Set secondary text colour for button text','saraswathi-lite' ),
	);

		/**
*	4.9	-	Icons
*/

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_site_tile_color',
		'default' 					=> '#008299',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport' 				=> 'postMessage',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_icons_site_tile_color',
		'type'							=> 'color',
		'label'        			=> __( 'Tile Background','saraswathi-lite' ),
		'section'      			=> 'title_tagline',
		'description'  			=> __( 'Set the background colour for site icon tiles','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_site_icons_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_icons_site_icons_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Social Icons','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
		'description'  			=> __( 'Set social icons','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_bg_color',
		'default' 					=> '#455a64',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_icons_bg_color',
		'type'							=> 'color',
		'label'        			=> __( 'Social Icon Background','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
		'description'  			=> __( 'Set the background colour for social icons','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_text_color',
		'default' 					=> '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$saras['control'][] = array(
		'id'								=> 'saras_icons_text_color',
		'type'							=> 'color',
		'label'        			=> __( 'Social Icon Text','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
		'description'  			=> __( 'Set the colour for social icon text','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_divider',
	);
	$saras['control'][] = array(
		'id'        	 			=> 'saras_icons_social_media_divider',
		'type'         			=> 'divider',
		'label'        			=> __( 'Social Media','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
		'description'  			=> __( 'Enter social media profile links','saraswathi-lite' ),
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_twitter',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_twitter',
		'type'         			=> 'url',
		'label'        			=> __( 'Twitter','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_facebook',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_facebook',
		'type'         			=> 'url',
		'label'        			=> __( 'Facebook','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_google',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_google',
		'type'         			=> 'url',
		'label'        			=> __( 'Google','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_youtube',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_youtube',
		'type'         			=> 'url',
		'label'        			=> __( 'Youtube','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_vimeo',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_vimeo',
		'type'         			=> 'url',
		'label'        			=> __( 'Vimeo','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_github',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_github',
		'type'         			=> 'url',
		'label'        			=> __( 'Github','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_linkedin',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_linkedin',
		'type'         			=> 'url',
		'label'        			=> __( 'Linkedin','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_behance',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_behance',
		'type'         			=> 'url',
		'label'        			=> __( 'Behance','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_instagram',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_instagram',
		'type'         			=> 'url',
		'label'        			=> __( 'Instagram','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_vine',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_vine',
		'type'         			=> 'url',
		'label'        			=> __( 'Vine','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_tumblr',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_tumblr',
		'type'         			=> 'url',
		'label'        			=> __( 'Tumblr','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_icons_social_media_feed',
		'sanitize_callback' => 'esc_url_raw',
	);
	$saras['control'][] = array(
		'id'         				=> 'saras_icons_social_media_feed',
		'type'         			=> 'url',
		'label'        			=> __( 'RSS Feed','saraswathi-lite' ),
		'section'      			=> 'scr_section_icons',
	);

	$saras['setting'][] = array(
		'id'								=> 'saras_saraswathi_upgrade_pro_divider',
		'default' 					=> 'Go Pro!',
	);
	$saras['control'][] = array(
		'id'          			=> 'saras_saraswathi_upgrade_pro_divider',
		'type'          		=> 'divider',
		'label'         		=> __( 'Going Pro!','saraswathi-lite' ),
		'section'       		=> 'scr_section_pro',
		'description'   		=> sprintf( __( 'Hi, This is Arul. Founder of Smartpixels, Pagespeedify and TopRated WordPress Dev & Optimization Expert at UpWork. I wanted to give you the <strong>"Power Users"</strong> an extensive array of exclusive features at your disposal to level up your blogging game.Hence, I created <strong>Saraswathi</strong><br><br> The full version of this theme has all the bells and whistles that you would expect from any modern WordPress theme, but what sets apart <strong>Saraswathi</strong> is how incredibly optimized it is for speed and SEO.I hate bloated software whereas love speed and that in essence captures the core of what I am trying to achieve with Saraswathi theme.I also pledge heroic to every pro user.<br><h3>To learn more about full version of </h3> %1$sSaraswathi Theme%2$s','saraswathi-lite' ),'<a target="_blank" class="button button-primary" href="' . esc_url( '//www.smartpixels.net/products/saraswathi-theme/' ) . '">', '</a>'),
	);


			/**
*	WP Customizer API.
*/

			/**
*	5.0	-	Add Panels
*/

			/**
	 * Filter the panel list for saras customizer.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $saras['panel'] An array of panels to be included in saras customizer.
	 */
			$panels 	= apply_filters( 'saraswathi_customizer_panels', $saras['panel'] );

			foreach ( $panels as $panel ) {
				if ( ! empty($panel['id']) ) {
					$wp_customize->add_panel( $panel['id'],array_splice( $panel, array_search( 'id', array_keys( $panel ) ) ) );
				}
			}

			/**
*	6.0	-	Add Sections
*/

			/**
	 * Filter the section list for saras customizer.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $saras['section'] An array of sections to be included in saras customizer.
		*/
			$sections 	= apply_filters( 'saraswathi_customizer_sections', $saras['section'] );

			foreach ( $sections as $section ) {
				if ( ! empty($section['id']) ) {
					$wp_customize->add_section( $section['id'], array_splice( $section, array_search( 'id', array_keys( $section ) ) ) );
				}
			}

			/**
*	7.0	-	Add Settings
*/

			/**
		 * Filter the settings list for saras customizer.
		 *
		 * @since 1.0.0
		 *
		 * @param array  $saras['setting'] An array of settings to be included in saras customizer.
	 	*/
			$settings 	= apply_filters( 'saraswathi_customizer_settings', $saras['setting'] );

			foreach ( $settings as $setting ) {

				$wp_customize->add_setting( $setting['id'],array(
					'type'  						=> 'theme_mod',
					'capability'        => 'manage_options',
					'default'           => isset($setting['default']) ? $setting['default'] : null,
					'transport'         => isset($setting['transport']) ? $setting['transport'] : 'refresh',
					'sanitize_callback' => isset($setting['sanitize_callback']) ? $setting['sanitize_callback'] : null,
				));
			}

			$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
			$wp_customize->get_setting( 'custom_logo' )->transport          = 'refresh';
			
			$wp_customize->selective_refresh->add_partial( 'blogname', array('selector' => '.site-title a','render_callback' => 'saraswathi_customize_partial_blogname',	) );

			/**
*	8.0	- Add Controls
*/

			/**
		 * Filter the controls list for saras customizer.
		 *
		 * @since 1.0.0
		 *
		 * @param array  $saras['control'] An array of controls to be included in saras customizer.
		*/
			$controls 	= apply_filters( 'saraswathi_customizer_controls', $saras['control'] );

			foreach ( $controls as $control ) {

				static $i = 1;

				if ( ! saraswathi_get_theme_mod( 'saras_default_enable_contexual_controls',0 )	) {
					$control['active_callback']	= null;
				}

				if ( 'divider' === $control['type'] || 'image' === $control['type'] || 'color' === $control['type']	) {

					$default_control['settings'] = $control['id'];
				}
				$default_control['priority']	= $i;

				$merged = array_merge( $control, $default_control );

				if ( 'radio' === $control['type'] ) {

					$wp_customize->add_control( $control['id'],array(
						'type'          		=> isset($control['type']) ? $control['type'] : null,
						'label'         		=> isset($control['label']) ? $control['label'] : null,
						'section'       		=> isset($control['section']) ? $control['section'] : null,
						'priority'      		=> isset($control['priority']) ? $control['priority'] : $i,
						'choices'      			=> isset($control['choices']) ? $control['choices'] : null,
						'description'   		=> isset($control['description']) ? $control['description'] : null,
						'input_attrs'   		=> isset($control['input_attrs']) ? $control['input_attrs'] : null,
						'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,
					));
				} elseif ( 'select' === $control['type'] ) {
					$wp_customize->add_control( $control['id'],array(
						'type'          		=> isset($control['type']) ? $control['type'] : null,
						'label'         		=> isset($control['label']) ? $control['label'] : null,
						'section'       		=> isset($control['section']) ? $control['section'] : null,
						'priority'      		=> isset($control['priority']) ? $control['priority'] : $i,
						'choices'       		=> isset($control['choices']) ? $control['choices'] : null,
						'description'   		=> isset($control['description']) ? $control['description'] : null,
						'input_attrs'   		=> isset($control['input_attrs']) ? $control['input_attrs'] : null,
						'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

					));
				} elseif ( 'number' === $control['type'] ) {
					$wp_customize->add_control( $control['id'],array(
						'type'          		=> isset($control['type']) ? $control['type'] : null,
						'priority'      		=> isset($control['priority']) ? $control['priority'] : $i,
						'section'       		=> isset($control['section']) ? $control['section'] : null,
						'label'         		=> isset($control['label']) ? $control['label'] : null,
						'description'   		=> isset($control['description']) ? $control['description'] : null,
						'input_attrs'   		=> isset($control['input_attrs']) ? $control['input_attrs'] : null,
						'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

					));
				} elseif ( 'range' === $control['type'] ) {
					$wp_customize->add_control( $control['id'],array(
						'type'          		=> isset($control['type']) ? $control['type'] : null,
						'priority'      		=> isset($control['priority']) ? $control['priority'] : $i,
						'section'       		=> isset($control['section']) ? $control['section'] : null,
						'label'         		=> isset($control['label']) ? $control['label'] : null,
						'description'   		=> isset($control['description']) ? $control['description'] : null,
						'input_attrs'   		=> isset($control['input_attrs']) ? $control['input_attrs'] : null,
						'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

					));
				} elseif ( 'text' === $control['type'] ) {
					$wp_customize->add_control( $control['id'],array(
						'type'         			=> isset($control['type']) ? $control['type'] : null,
						'label'        			=> isset($control['label']) ? $control['label'] : null,
						'section'      			=> isset($control['section']) ? $control['section'] : null,
						'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
						'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

					));
				} elseif ( 'textarea' === $control['type'] ) {
					$wp_customize->add_control( $control['id'],array(
						'type'	       			=> isset($control['type']) ? $control['type'] : null,
						'label'        			=> isset($control['label']) ? $control['label'] : null,
						'section'      			=> isset($control['section']) ? $control['section'] : null,
						'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
						'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

					));
				} elseif ( 'checkbox' === $control['type'] ) {
					$wp_customize->add_control( $control['id'],array(
						'type'         			=> isset($control['type']) ? $control['type'] : null,
						'label'        			=> isset($control['label']) ? $control['label'] : null,
						'section'      			=> isset($control['section']) ? $control['section'] : null,
						'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
						'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

					));
				} elseif ( 'url' === $control['type']  ) {
					$wp_customize->add_control( $control['id'],array(
						'type'         			=> isset($control['type']) ? $control['type'] : null,
						'label'        			=> isset($control['label']) ? $control['label'] : null,
						'section'      			=> isset($control['section']) ? $control['section'] : null,
						'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
						'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

					));
				} elseif ( 'color' === $control['type'] && class_exists( 'WP_Customize_Color_Control' )  ) {
					$wp_customize->add_control(
						new WP_Customize_Color_Control( $wp_customize,$control['id'],array(
							'label'        			=> isset($control['label']) ? $control['label'] : null,
							'section'      			=> isset($control['section']) ? $control['section'] : null,
							'settings'     			=> $control['id'],
							'description'  			=> isset($control['description']) ? $control['description'] : null,
							'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
							'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

						))
					);
				} elseif ( 'divider' === $control['type'] && class_exists( 'Saraswathi_Divider_Custom_Control' ) ) {
					$wp_customize->add_control(
						new Saraswathi_Divider_Custom_Control( $wp_customize,$control['id'],array(
							'label'        			=> isset($control['label']) ? $control['label'] : null,
							'section'      			=> isset($control['section']) ? $control['section'] : null,
							'settings'     			=> $control['id'],
							'description'  			=> isset($control['description']) ? $control['description'] : null,
							'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
							'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

						))
					);
				} elseif ( 'pro' === $control['type'] && class_exists( 'Saraswathi_Pro_Custom_Control' ) ) {
					$wp_customize->add_control(
						new Saraswathi_Pro_Custom_Control( $wp_customize,$control['id'],array(
							'label'        			=> isset($control['label']) ? $control['label'] : null,
							'section'      			=> isset($control['section']) ? $control['section'] : null,
							'settings'     			=> $control['id'],
							'description'  			=> isset($control['description']) ? $control['description'] : null,
							'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
							'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

						))
					);
				} elseif ( 'image' === $control['type'] && class_exists( 'WP_Customize_Image_Control' ) ) {
					$wp_customize->add_control(
						new WP_Customize_Image_Control( $wp_customize,$control['id'],array(
							'label'        			=> isset($control['label']) ? $control['label'] : null,
							'section'      			=> isset($control['section']) ? $control['section'] : null,
							'settings'     			=> $control['id'],
							'description'  			=> isset($control['description']) ? $control['description'] : null,
							'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
							'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

						))
					);

				} elseif ( 'media' === $control['type'] &&	class_exists( 'WP_Customize_Media_Control' )	) {
					$wp_customize->add_control(
						new WP_Customize_Media_Control( $wp_customize,$control['id'],array(
							'label'        			=> isset($control['label']) ? $control['label'] : null,
							'section'      			=> isset($control['section']) ? $control['section'] : null,
							'settings'     			=> $control['id'],
							'mime_type' 				=> isset($control['mime_type']) ? $control['mime_type'] : 'image',
							'description'  			=> isset($control['description']) ? $control['description'] : null,
							'priority'     			=> isset($control['priority']) ? $control['priority'] : $i,
							'active_callback' 	=> isset($control['active_callback']) ? $control['active_callback'] : null,

						))
					);

				} elseif (	'cropped_image' === $control['type']	&& class_exists( 'WP_Customize_Cropped_Image_Control' )	) {
					$wp_customize->add_control(
						new WP_Customize_Cropped_Image_Control( $wp_customize, $control['id'], array(
							'label'       => isset($control['label']) ? $control['label'] : null,
							'section'     => isset($control['section']) ? $control['section'] : null,
							'flex_width'  => isset($control['flex_width']) ? $control['flex_width'] : false,
							'flex_height' => isset($control['flex_height']) ? $control['flex_height'] : false,
							'priority'    => isset($control['priority']) ? $control['priority'] : $i,
							'width'       => isset($control['width']) ? $control['width'] : 1024,
							'height'      => isset($control['height']) ? $control['height'] : 1024,
						) ) );

				}
				$i++;
			}
}

add_action( 'customize_register','saraswathi_customize_register' );
