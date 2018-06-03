<?php
/**
 *
 * Create additional customizer custom controls to be used with customizer settigs.
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/customizer/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *	Add custom controls to customizer by extending wp customize control.
 *
 * @param wp_customize $wp_customize is an instance of the WP_Customize_Manager class. It is this class object that controls the Theme
 * Customizer screen.
 */
function saraswathi_custom_controls( $wp_customize ) {

	if ( ! class_exists( 'WP_Customize_Control' ) ) {
		return null; }

	/**
	 * Class to create a custom divider
	 */
	class Saraswathi_Divider_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the content on the theme customizer page
		 */
		public function render_content() {
	?>
            <span class="customize-divider-title customize-control-title"><?php saraswathi_sanitize_output_text( wp_kses_post( $this->label ) ); ?></span>
            <span class="customize-divider-desc customize-section-description"><?php saraswathi_sanitize_output_text( wp_kses_post( $this->description ) ); ?> </span>
        <?php
		}
	}


}
// Register the custom control through action.
add_action( 'customize_register', 'saraswathi_custom_controls' );


/**
 *	Add custom controls to customizer by extending wp customize control.
 *
 * @param wp_customize $wp_customize is an instance of the WP_Customize_Manager class. It is this class object that controls the Theme
 * Customizer screen.
 */

	if ( ! class_exists( 'WP_Customize_Control' ) ) {
		return null; }

		/**
	 * Class to create a custom divider
	 */
	class Saraswathi_Pro_Custom_Control extends WP_Customize_Control {

		/**
		 * Render the content on the theme customizer page
		 */
		public function render_content() {
	?>
            <span class="customize-pro-title customize-control-title"><?php saraswathi_sanitize_output_text( wp_kses_post( $this->label ) ); ?></span>
            <span class="customize-pro-desc customize-section-description"><?php saraswathi_sanitize_output_text( wp_kses_post( $this->description ) ); ?> </span> </ br>
            <span class="pro-wrap">
            <span class="pro-inner"></span>
            </span>
        <?php
		}
	}

