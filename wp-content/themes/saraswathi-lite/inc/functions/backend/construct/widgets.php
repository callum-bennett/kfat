<?php
/*
* Register widget areas and widgets
*
* @link http://codex.wordpress.org/Function_Reference/register_sidebar
*
* located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/construct/'
*
* @since Saraswathi Lite 1.0.0
*
* @package Saraswathi Lite


********************************
*	Table of Contents
*
*	1.0 - Register Widget Areas
*	2.0	- Register Widget
*	3.0 - Add Widget Options
*	4.0 - Update and Save options
*	5.0	- Widget Display
*
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 *
 *	1.0 - Register Widget Areas
 *
 * Register all of the WordPress widget areas on startup.
 */
function saraswathi_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'saraswathi-lite' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	));


		// Register Footer Widgets.
	if ( saraswathi_get_theme_mod( 'saras_enable_footer_widgetarea',1 ) ) {

		for ( $i = 1; $i <= 3; $i++ ) {

			register_sidebar( array(
				'name'          => sprintf( __( 'Footer Widget Area %s', 'saraswathi-lite'), $i ),
				'id'            => 'footer-widget-'.$i.'',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			));

		}
	}

	// Register Home Page Widgets.
	if ( saraswathi_get_theme_mod( 'saras_enable_index_widgetarea',0 ) ) {

		for ( $i = 1; $i <= saraswathi_get_theme_mod( 'saras_default_above_index_widgetarea_count','1' ); $i++ ) {

			register_sidebar( array(
				'name'          => sprintf( __( 'Above Index Widget Area %s', 'saraswathi-lite' ) , $i ),
				'id'            => 'above-index-widget-'.$i.'',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			));

		}

		for ( $i = 1; $i <= saraswathi_get_theme_mod( 'saras_default_below_index_widgetarea_count', '1' ); $i++ ) {

			register_sidebar( array(
				'name'          => sprintf( __( 'Below Index Widget Area %s', 'saraswathi-lite' ) , $i ),
				'id'            => 'below-index-widget-'.$i.'',
				'description'   => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h6 class="widget-title">',
				'after_title'   => '</h6>',
			));

		}
	}
	/**
 *	2.0	- Register Widget
 *
 * Register and load the widgets.
*/


		register_widget( 'Saraswathi_Social_Icons_Widget' );

}

add_action( 'widgets_init', 'saraswathi_widgets_init' );


/**
 *	3.0 - Add Widget Options
 *
 * Fires at the end of the widget control form.
 *
 * Adds saraswathi widget option fields to the widget form.
 *
 * Note: If the widget has no form, the text echoed from the default
 * form method can be hidden using CSS.
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @param WP_Widget $widget     The widget instance, passed by reference.
 * @param null      $return   Return null if new fields are added.
 * @param array     $instance An array of the widget's settings.
 */
function saraswathi_add_fields_widget_form($widget, $return, $instance) {
	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', '_saras_widget_position' => 'none' ) );

	if ( ! isset($instance['_saras_widget_position']	) ) {
		$instance['_saras_widget_position'] = null;
	}
	if ( ! isset($instance['classes']) ) {
		$instance['classes'] = null;
	}
	if ( ! isset($instance['_saras_widget_width'] ) ) {
		$instance['_saras_widget_width'] = null;
	}

	if ( ! isset($instance['_saras_widget_classes']) ) {
		$instance['_saras_widget_classes'] = null;
	}

	// Check values.
	if ( $instance ) {
		$title = esc_attr( $instance['title'] );
		$text = esc_attr( $instance['text'] );
		$widget_position = $instance['_saras_widget_position'];
		$width = saraswathi_sanitize_float( $instance['_saras_widget_width'] ) ? saraswathi_sanitize_float( $instance['_saras_widget_width'] ) : '100';
		$classes = saraswathi_sanitize_html_class( $instance['_saras_widget_classes'] ) ? saraswathi_sanitize_html_class( $instance['_saras_widget_classes'] ) : null;
	} else {
		$title = '';
		$text = '';
		$widget_position = '';
		$width  = ''; // Added.
		$classes = '';
	}

	?>
    <div class="saras_admin_widget_fields">
        <h4><?php echo __( 'Saraswathi Theme Widget Options', 'saraswathi-lite' ) ?></h4>
    <p>
        <label for="<?php echo $widget->get_field_id( '_saras_widget_width' ); ?>"><?php _e( 'Width (in %)', 'saraswathi-lite' ); ?></label>
        <input id="<?php echo $widget->get_field_id( '_saras_widget_width' ); ?>" class="widefat" name="<?php echo $widget->get_field_name( '_saras_widget_width' ); ?>" type="number" value="<?php  echo $width; ?>" min="1" max="100"/>
       
    </p>
    <p>
        <label for="<?php echo $widget->get_field_id( '_saras_widget_position' ); ?>"><?php echo __( 'Position:', 'saraswathi-lite' ) ?></label>
        <select id="<?php echo $widget->get_field_id( '_saras_widget_position' ); ?>" class="chosen widefat" name="<?php echo $widget->get_field_name( '_saras_widget_position' ); ?>">
            <option <?php selected( $widget_position, 'none' );?> value="none"><?php echo __( 'None', 'saraswathi-lite' ) ?></option>
            <option <?php selected( $widget_position, 'left' );?>value="left"><?php echo __( 'Left', 'saraswathi-lite' ) ?></option>
            <option <?php selected( $widget_position, 'right' );?> value="right"><?php echo __( 'Right', 'saraswathi-lite' ) ?></option>
            <option <?php selected( $widget_position, 'grid' );?> value="grid"><?php echo __( 'Autogrid', 'saraswathi-lite' ) ?></option>
        </select>
    </p>
    <p>
        <label for="<?php echo $widget->get_field_id( '_saras_widget_classes' ); ?>"><?php echo __( 'CSS Classes:', 'saraswathi-lite' ) ?></label>
        <input type="text" name="<?php echo $widget->get_field_name( '_saras_widget_classes' ); ?>" id="<?php echo $widget->get_field_id( '_saras_widget_classes' ); ?>" class="widefat" value="<?php echo $classes; ?>" />
    </p>
    </div>
    <?php
	$retrun = null;
	return array( $widget,$return,$instance );
}


/**
 *	4.0 - Update and Save options
 *
 * Update saraswathi widget's settings before saving.
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @param array $instance     The current widget instance's settings.
 * @param array $new_instance Array of new widget settings.
 * @param array $old_instance Array of old widget settings.
 */

function saraswathi_widget_form_fields_update($instance, $new_instance, $old_instance) {
	$instance['_saras_widget_width'] = absint( $new_instance['_saras_widget_width'] );
	$instance['_saras_widget_position'] = sanitize_text_field( $new_instance['_saras_widget_position'] );
	$instance['_saras_widget_classes'] = sanitize_text_field( $new_instance['_saras_widget_classes'] );
	return $instance;
}



/**
 *	5.0	- Widget Display
 *
 * Screen  widgets and add the neccessary parameters generated by saraswathi theme through a widget display callback
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @param array $params {
 *     @type array $args  {
 *         An array of widget display arguments.
 *
 *         @type string $name          Name of the sidebar the widget is assigned to.
 *         @type string $id            ID of the sidebar the widget is assigned to.
 *         @type string $description   The sidebar description.
 *         @type string $class         CSS class applied to the sidebar container.
 *         @type string $before_widget HTML markup to prepend to each widget in the sidebar.
 *         @type string $after_widget  HTML markup to append to each widget in the sidebar.
 *         @type string $before_title  HTML markup to prepend to the widget title when displayed.
 *         @type string $after_title   HTML markup to append to the widget title when displayed.
 *         @type string $widget_id     ID of the widget.
 *         @type string $widget_name   Name of the widget.
 *     }
 *     @type array $widget_args {
 *         An array of multi-widget arguments.
 *
 *         @type int $number Number increment used for multiples of the same widget.
 *     }
 * }
 */
function saraswathi_dynamic_sidebar_params($params) {
	global $wp_registered_widgets;
	$widget_id = $params[0]['widget_id'];
	$widget_obj = $wp_registered_widgets[ $widget_id ];
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name );
	$widget_num = $widget_obj['params'][0]['number'];
	$position = $classes = $style = null;
	if ( isset($widget_opt[ $widget_num ]['_saras_widget_position']) ) {
		$position = $widget_opt[ $widget_num ]['_saras_widget_position'];
	}
	if ( isset($widget_opt[ $widget_num ]['_saras_widget_classes']) ) {
		$classes  = $widget_opt[ $widget_num ]['_saras_widget_classes'];
	}
	if ( 'grid' !== $position  ) {
		if ( isset($widget_opt[ $widget_num ]['_saras_widget_width']) && null !== saraswathi_sanitize_float( $widget_opt[ $widget_num ]['_saras_widget_width'] ) ) {
			$width = saraswathi_sanitize_float( $widget_opt[ $widget_num ]['_saras_widget_width'] );
		} else {
			$width = null;
		}
		if ( isset($widget_opt[ $widget_num ]['_saras_widget_classes']) ) {
			$classes = str_replace( 'grid', '', $widget_opt[ $widget_num ]['_saras_widget_classes'] );
		}
		$columns = null;
	} else {
		$width = null;
		if ( saraswathi_sanitize_int(saraswathi_get_theme_mod( 'saras_default_content_widget_cols','4' ) ) ) {
			
			$columns = ' col-'.saraswathi_sanitize_int(saraswathi_get_theme_mod( 'saras_default_content_widget_cols','4' )).' ';
		}
		
	}

	if ( null !== $width ) {
		$style = 'style="max-width:'.$width.'%;"';
	}

	if ( isset($position) ) {
		$classes .= ' '.$position.$columns.' ';
	}

			$replace = $style.' class="'.$classes;

			$params[0]['before_widget'] = str_replace( 'class="', $replace, $params[0]['before_widget'] );

	return $params;
}

// Add input fields.
add_action( 'in_widget_form', 'saraswathi_add_fields_widget_form',5,3 );
// Callback function for options update.
add_filter( 'widget_update_callback', 'saraswathi_widget_form_fields_update',5,3 );
// add class names.
add_filter( 'dynamic_sidebar_params', 'saraswathi_dynamic_sidebar_params' );
