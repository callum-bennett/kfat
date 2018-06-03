<?php
/*
* Add and register social media icons widget
*
* @link http://codex.wordpress.org/Function_Reference/register_sidebar
*
* located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/construct/widgets/'
*
* @since Saraswathi Lite 1.0.0
*
* @package Saraswathi Lite


********************************
*   Table of Contents
*
*   1.0 - Extend Widget
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	Extend Widget
 *
 * This class extends WP_Widget::widget(), WP_Widget::update()
 * and WP_Widget::form() inorder to create saraswathi recent content slider widget.
 *
 * @since Saraswathi Lite 1.0.0
 */
class Saraswathi_Social_Icons_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'Saraswathi_Social_Icons_Widget',
			// Widget name will appear in UI
			__( 'Saraswathi Social Widget', 'saraswathi-lite' ),
			// Widget description
			array( 'description' => __( 'Display social media icons.', 'saraswathi-lite' ) )
		);
	}

	/**
	 * Return an associative array of default values
	 *
	 * These values are used in new widgets.
	 *
	 * @return array Array of default values for the Widget's options
	 */
	public function defaults() {
		return array(
			'title'   => __( 'Social Icons', 'saraswathi-lite' ),

		);
	}
	
	/**
	 * Return an associative array of social icons
	 *
	 * @return array Array of social iconss for the Widget's options
	 */
	public function social_icons() {
		
		return array( 
			'twitter'   => __( 'Twitter', 'saraswathi-lite' ),
			'facebook'   => __( 'Facebook', 'saraswathi-lite' ),
			'google'   => __( 'Google', 'saraswathi-lite' ),
			'youtube'   => __( 'Youtube', 'saraswathi-lite' ),
			'vimeo'   => __( 'Vimeo', 'saraswathi-lite' ),
			'github'   => __( 'Github', 'saraswathi-lite' ),
			'behance'   => __( 'Behance', 'saraswathi-lite' ),
			'linkedin'   => __( 'Linkedin', 'saraswathi-lite' ),
			'instagram'   => __( 'Instagram', 'saraswathi-lite' ),
			'vine'   => __( 'Vine', 'saraswathi-lite' ),
			'tumblr'   => __( 'Tumblr', 'saraswathi-lite' ),
			'feed'   => __( 'Feed', 'saraswathi-lite' )
			);
	}
	
	function widget( $args, $ins ) {

		$instance = wp_parse_args( $ins, $this->defaults() );
	
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$html  = array();

		// before and after widget arguments are defined by themes.
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $title . $args['after_title']; }
		// This is where you run the code and display the output.
			foreach ( $this->social_icons() as $icon => $title ) {

				if ( $instance[$icon] != '' && $instance[$icon] != 'http://' && saraswathi_is_url( $instance[$icon]) ) {

					if ( 'twitter' === $icon ) {

						$html[]	= '<a class="icon saras-icon-'.$icon.'" href="'.$instance[$icon].'" target="_blank" title="Follow on twitter" rel="nofollow"><span class="screen-reader-text">'.__( 'Follow on twitter', 'saraswathi-lite' ).'</span></a>';

					} elseif ( 'facebook' === $icon  ) {

						$html[]	= '<a class="icon saras-icon-'.$icon.'" href="'.$instance[$icon].'" target="_blank" title="Like on facebook" rel="nofollow"><span class="screen-reader-text">'.__( 'Like on facebook', 'saraswathi-lite' ).'</span></a>';
					} elseif ( 'google' === $icon ) {

						$html[]	= '<a class="icon saras-icon-'.$icon.'-plus" href="'.$instance[$icon].'" target="_blank" title="Follow on google" rel="publisher"><span class="screen-reader-text">'.__( 'Follow on google', 'saraswathi-lite' ).'</span></a>';
					} else {

						$html[]	= '<a class="icon '.$icon.'" href="'.$instance[$icon].'" target="_blank" title="Visit '.$icon.' profile" rel="nofollow"><span class="screen-reader-text">'.__( 'Visit', 'saraswathi-lite' ).' '.$icon.' </span></a>';
					}
				}
			}		
		
		echo '<div class="saras-social-icons">';
		echo join('', $html);
		echo '</div><!-- .saras-social-icons -->';
		
		echo $args['after_widget'];
	
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		foreach ($this->social_icons() as $icon => $title) {
			$instance[$icon] = esc_url_raw($new_instance[$icon]);
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 

foreach ($this->social_icons() as $icon => $title) {
	if(!isset($instance[$icon])) { $instance[$icon] = ''; }
	elseif($instance[$icon] == 'http://') { $instance[$icon] = ''; }
}	
?>

        <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title:', 'saraswathi-lite' ) ?></label>
			<br/><input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
			<ul class="saras-social-icons">
				<?php foreach ($this->social_icons() as $icon => $title) : ?>
				<li><label for="<?php echo $this->get_field_id($icon); ?>" class="<?php echo $icon; ?>"><?php echo $title; ?>:</label>
					<input class="widefat" type="text" id="<?php echo $this->get_field_id($icon); ?>" name="<?php echo $this->get_field_name($icon); ?>" value="<?php echo esc_attr($instance[$icon]); ?>" placeholder="<?php echo __( 'http://', 'saraswathi-lite' ) ?>" />
				</li>
				<?php endforeach; ?>
			</ul>

		<?php
	}

}
