<?php
/**
 * Theme Customizer
 *
 * @package publisherly
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function publisherly_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'publisherly_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function publisherly_customize_preview_js() {
    wp_enqueue_script( 'publisherly_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'publisherly_customize_preview_js' );

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function publisherly_sanitize_checkbox( $checked ) {
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
* Customizer: Remove Unecessary Controls
*/
function publisherly_remove_customizer_settings( $wp_customize ){

    /*
     * Failsafe is safe
     */
    if ( ! isset( $wp_customize ) ) {
        return;
    }

    $wp_customize->remove_section( 'background_image');

}
add_action( 'customize_register', 'publisherly_remove_customizer_settings', 20 );

/**
* Customizer: Add Panels
*/
function publisherly_register_customizer_panels( $wp_customize ){

    /*
     * Failsafe is safe
     */
    if ( ! isset( $wp_customize ) ) {
        return;
    }

}
add_action( 'customize_register', 'publisherly_register_customizer_panels' );

/**
* Customizer: Add Sections
*/
function publisherly_register_customizer_sections( $wp_customize ) {

    /*
     * Failsafe is safe
     */
    if ( ! isset( $wp_customize ) ) {
        return;
    }

		/**
     * Add Social Links Section.
     */
    $wp_customize->add_section(
        // $id
        'publisherly_section_header_options',
        // $args
        array(
            'title'         => esc_html__( 'Header Options', 'publisherly' ),
            'description'   => esc_html__( 'Customize various Header options with the settings within this section.', 'publisherly' ),
            'priority'      => 90,
        )
    );

		/**
     * Add Footer Section.
     */
    $wp_customize->add_section(
        // $id
        'publisherly_section_footer_options',
        // $args
        array(
            'title'         => esc_html__( 'Footer Options', 'publisherly' ),
            'description'   => esc_html__( 'Customize various Footer options with the settings within this section.', 'publisherly' ),
            'priority'      => 101,
        )
    );

}
add_action( 'customize_register', 'publisherly_register_customizer_sections' );


/**
* Customizer: Add Settings and Controls
*/
function publisherly_register_customizer_settings_controls( $wp_customize ) {

    /*
     * Failsafe is safe
     */
    if ( ! isset( $wp_customize ) ) {
        return;
    }

		// Display Header Top Bar
    $wp_customize->add_setting(
        // $id
        'publisherly_display_top_bar',
        // $args
        array(
            'default'           => false,
            'type'              => 'theme_mod',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'publisherly_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        // $id
        'publisherly_display_top_bar',
        // $args
        array(
            'settings'      => 'publisherly_display_top_bar',
            'section'       => 'publisherly_section_header_options',
            'type'          => 'checkbox',
            'label'         => esc_html__( 'Display theme top bar?', 'publisherly' )
        )
    );


		    // Social Links Twitter
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_twitter',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_twitter',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_twitter',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Twitter URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Twitter social page.', 'publisherly' )
		        )
		    );

		    // Social Links Facebook
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_facebook',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_facebook',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_facebook',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Facebook URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Facebook social page.', 'publisherly' )
		        )
		    );

		    // Social Links Google Plus
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_googleplus',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_googleplus',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_googleplus',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Google+ URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Google+ social page.', 'publisherly' )
		        )
		    );

		    // Social Links Pinterest
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_pinterest',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_pinterest',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_pinterest',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Pinterest URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Pinterest social page.', 'publisherly' )
		        )
		    );

		    // Social Links YouTube
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_youtube',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_youtube',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_youtube',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'YouTube URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your YouTube social page.', 'publisherly' )
		        )
		    );

		    // Social Links Instagram
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_instagram',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_instagram',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_instagram',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Instagram URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Instagram social page.', 'publisherly' )
		        )
		    );

		    // Social Links LinkedIn
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_linkedin',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_linkedin',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_linkedin',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'LinkedIn URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your LinkedIn social page.', 'publisherly' )
		        )
		    );

		    // Social Links Behance
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_behance',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_behance',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_behance',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Behance URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Behance social page.', 'publisherly' )
		        )
		    );

		    // Social Links Tumblr
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_tumblr',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_tumblr',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_tumblr',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Tumblr URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Tumblr social page.', 'publisherly' )
		        )
		    );

		    // Social Links Vimeo
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_vimeo',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_vimeo',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_vimeo',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Vimeo URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Vimeo social page.', 'publisherly' )
		        )
		    );

		    // Social Links Dribble
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_social_media_dribble',
		        // $args
		        array(
		            'default'           => '',
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_social_media_dribble',
		        // $args
		        array(
		            'settings'      => 'publisherly_social_media_dribble',
		            'section'       => 'publisherly_section_header_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Dribble URL', 'publisherly' ),
		            'description'   => esc_html__( 'Link to your Dribble social page.', 'publisherly' )
		        )
		    );

		    // Footer Copyright Left Content
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_copyright_text',
		        // $args
		        array(
		            'default'           => esc_html__( 'Copyright 2017 - All rights reserved', 'publisherly' ),
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_copyright_text',
		        // $args
		        array(
		            'settings'      => 'publisherly_copyright_text',
		            'section'       => 'publisherly_section_footer_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Copyright Text', 'publisherly' ),
		            'description'   => esc_html__( 'Copyright or other text to be displayed in the footer left side. HTML allowed.', 'publisherly' )
		        )
		    );

		    // Footer Copyright Right Content
		    $wp_customize->add_setting(
		        // $id
		        'publisherly_design_by',
		        // $args
		        array(
		            'default'           => esc_html__( 'publisherly Theme made by <a href="https://mightywp.com/themes/publisherly/">Mighty WP</a>', 'publisherly' ),
		            'type'              => 'theme_mod',
		            'capability'        => 'edit_theme_options',
		            'sanitize_callback' => 'wp_kses_post',
		        )
		    );

		    $wp_customize->add_control(
		        // $id
		        'publisherly_design_by',
		        // $args
		        array(
		            'settings'      => 'publisherly_design_by',
		            'section'       => 'publisherly_section_footer_options',
		            'type'          => 'text',
		            'label'         => esc_html__( 'Text on the right', 'publisherly' ),
		            'description'   => esc_html__( 'Design Author text or other text to be displayed in the footer right side. HTML allowed.', 'publisherly' )
		        )
		    );

		}
		add_action( 'customize_register', 'publisherly_register_customizer_settings_controls' );


		/**
		 * Sanitization callback for 'select' and 'radio' type controls.
		 *
		 * @source https://github.com/WPTRT/code-examples/blob/master/customizer/sanitization-callbacks.php#L262-L288
		 */
		if ( ! function_exists( 'publisherly_sanitize_select' ) ) {
		    function publisherly_sanitize_select( $input, $setting ) {

		        // Ensure input is a slug.
		        $input = sanitize_key( $input );

		        // Get list of choices from the control associated with the setting.
		        $choices = $setting->manager->get_control( $setting->id )->choices;

		        // If the input is a valid key, return it; otherwise, return the default.
		        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
		    }
		}
