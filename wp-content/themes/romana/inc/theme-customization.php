<?php

function romana_sanitize_select( $input, $setting ) {
  
  // Ensure input is a slug.
  $input = sanitize_key( $input );
  
  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;
  
  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function romana_sanitize_image( $image, $setting ) {
  /*
   * Array of valid image file types.
   *
   * The array includes image mime types that are included in wp_get_mime_types()
   */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
  // Return an array with file extension and mime_type.
  $file = wp_check_filetype( $image, $mimes );
  // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
* Customization options
**/
function romana_customize_register( $wp_customize ) {
  //Social One
  $wp_customize->add_setting(
    'romana_logo_position',
    array(
      'default' => 'pull-left',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'romana_sanitize_select',
    )
  );
  $wp_customize->add_control(
    'romana_logo_position',
    array(
      'section' => 'title_tagline',
      'label'   =>   esc_html__( 'Logo Position', 'romana' ),
      'type'    => 'select',
      'choices' => array(
        'pull-left' => esc_html__('Left side','romana'),
        'pull-right' => esc_html__('Right side','romana'),
      ),
    )
  );
  $wp_customize->add_panel(
    'romana_footer',
    array(
      'title'   => esc_html__( 'Footer Settings', 'romana' ),
    )
  );
  $wp_customize->add_section(
    'romana_footer_section',
    array(
      'title'   => esc_html__( 'Footer Section', 'romana' ),
      'panel' => 'romana_footer',
    )
  );
  $wp_customize->add_setting(
    'romana_footer_layout',
    array(
      'default' => '3',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'romana_sanitize_select',
    )
  );
  $wp_customize->add_control(
    'romana_footer_layout',
    array(
      'section' => 'romana_footer_section',
      'label'   => esc_html__( 'Footer Layout', 'romana' ),
      'type'    => 'select',
      'choices' => array(
        '12'   => esc_html__('1 Column','romana'),
        '6'   => esc_html__('2 Columns','romana'),
        '4'   => esc_html__('3 Columns','romana'),
        '3'   => esc_html__('4 Columns','romana'),
        '2'   => esc_html__('6 Columns','romana'),
      ),
    )
  );
  $wp_customize->add_setting('romana_footer_copyrights', array(
      'sanitize_callback' => 'wp_kses',
  ));
  $wp_customize->add_control('romana_footer_copyrights', array(
    'label'   => esc_html__('Footer Copy Rights','romana'),
    'section' => 'romana_footer_section',
    'type'    => 'textarea',
  ));
  $wp_customize->add_setting(
    'romana_theme_color',
    array(
      'default' => '#30bced',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'sanitize_hex_color',
    )
  );
  $wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'romana_theme_color', 
    array(
      'label'      => __( 'Theme Color', 'romana' ),
      'section'    => 'colors',
    ) ) 
  );
  /*-----------------Blog Setting----------------------------*/
  $wp_customize->add_panel(
    'romana_blog',
    array(
      'title'   => esc_html__( 'Blog Settings', 'romana' ),
    )
  );
  $wp_customize->add_section(
    'romana_sidebar_section',
    array(
      'title'   => esc_html__( 'Sidebar Position', 'romana' ),
      'panel' => 'romana_blog',
    )
  );
  $wp_customize->add_setting(
    'romana_sidebar_layout',
    array(
      'default' => '0',
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'romana_sanitize_select',
    )
  );
  $wp_customize->add_control(
    'romana_sidebar_layout',
    array(
      'section' => 'romana_sidebar_section',
      'label'   => esc_html__( 'Sidebar Position', 'romana' ),
      'type'    => 'select',
      'choices' => array(
        '1'   => esc_html__('Right','romana'),
        '0'   => esc_html__('Left','romana'),
        'none'=> esc_html__('None','romana')
      ),
    )
  );
  $wp_customize->add_section(
    'romana_meta_section',
    array(
      'title'   => esc_html__( 'Meta Data', 'romana' ),
      'panel' => 'romana_blog',
    )
  );
  $wp_customize->add_setting(
        'romana_hide_date_sec',
        array(
            'default' => '1',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'romana_sanitize_select',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control(
        'romana_hide_date_sec',
        array(
            'section' => 'romana_meta_section',                
            'label'   => __('Date','romana'),
            'type'    => 'select',
            'choices'        => array(
                "1"   => esc_html__( "Show", 'romana' ),
                "0"   => esc_html__( "Hide", 'romana' ),
            ),
        )
    );
    $wp_customize->add_setting(
        'romana_hide_author_sec',
        array(
            'default' => '1',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'romana_sanitize_select',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control(
        'romana_hide_author_sec',
        array(
            'section' => 'romana_meta_section',                
            'label'   => __('Author','romana'),
            'type'    => 'select',
            'choices'        => array(
                "1"   => esc_html__( "Show", 'romana' ),
                "0"   => esc_html__( "Hide", 'romana' ),
            ),
        )
    );
  /*----------------------end blog setting---------------------------------*/
  $wp_customize->add_setting(
        'romana_upload_drk_logo',
        array(
            'default' => '',
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'romana_sanitize_image',
        )
        );
        $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'romana_upload_drk_logo',
           array(
               'label'      => __( 'Upload Dark Logo', 'romana' ),
               'section'    => 'title_tagline',
               'settings'   => 'romana_upload_drk_logo',
               'flex_width'  => true,
                'flex_height' => true,
                'width'       => 120,
                'height'      => 50,
                'priority'    => 10,
                'default-image' => '',
           )
       )
   );
}
add_action( 'customize_register', 'romana_customize_register' );
function romana_custom_css(){ ?>
<style type="text/css">
  .button:before,
  .entry-meta:before,*::selection{
    background: <?php echo esc_attr(get_theme_mod('romana_theme_color','#30bced')) ?>;
  }

  .button:after{
    border-image: <?php echo esc_attr(get_theme_mod('romana_theme_color','#30bced')) ?>;
  }
  blockquote,.post-content .entry-content .more-link,.post-content .entry-content .more-link:hover{ border-color: <?php echo esc_attr(get_theme_mod('romana_theme_color','#30bced')) ?>; }
  .entry-meta::before,#cssmenu ul ul li:hover,.post-content .entry-content .more-link{ background: <?php echo esc_attr(get_theme_mod('romana_theme_color','#30bced')) ?>; }
  .widget ul li > a,
  .widget_categories ul li > a:hover,
  a:hover, a:focus,
  .page-title-area .breadcrumb a,
  .post-content .entry-footer .post-like a:hover .post-like-count, .post-content .entry-footer .post-like a:hover .post-like-icon>i, .entry-footer .post-comments a:hover, .post-content .entry-footer > div.social ul li a:hover,
  #cssmenu > ul > li:hover > a, #cssmenu > ul > li.active > a,.footer-main .footer-list a:hover,.page-numbers .current,.post-content .entry-content .more-link:hover{
    color: <?php echo esc_attr(get_theme_mod('romana_theme_color','#30bced')) ?>;
  }
</style>
<?php }
add_action('wp_head','romana_custom_css',900); ?>