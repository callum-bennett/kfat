<?php
/**
 *prevalent Theme Customizer
 *
 * @package Prevalent
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function prevalent_customize_register( $wp_customize ) {
	
	function prevalent_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}	
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';	
	
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#dd3333',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','prevalent'),			
			 'description'	=> __('Change color of the theme','prevalent'),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);	
	
	//Layout Section
	$wp_customize->add_section('layout_option_sec',array(
			'title'	=> __('Prevalent Layout Options','prevalent'),			
			'priority'	=> 1,
	));		
	
	$wp_customize->add_setting('fixlayout_options',array(
			'sanitize_callback' => 'prevalent_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'fixlayout_options', array(
    	   'section'   => 'layout_option_sec',    	 
		   'label'	=> __('Check to Fixed Layout Option','prevalent'),
    	   'type'      => 'checkbox'
     )); //Site Layout Section 
	 
	 $wp_customize->add_setting('add_sidebar',array(
			'sanitize_callback' => 'prevalent_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'add_sidebar', array(
    	   'section'   => 'layout_option_sec',    	 
		   'label'	=> __('Check to add sidebar for front page','prevalent'),
    	   'type'      => 'checkbox'
     )); //Site Layout Section 
	 
	 $wp_customize->add_setting('fixedheader',array(		 		
			'sanitize_callback' => 'prevalent_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'fixedheader', array(
    	   'section'   => 'layout_option_sec',    	 
		   'label'	=> __('Check to disable fixed header','prevalent'),
    	   'type'      => 'checkbox'
     )); //Site Layout Section 
	
	// Slider Section		
	$wp_customize->add_section( 'slider_section', array(
            'title' => __('Slider Settings', 'prevalent'),
            'priority' => null,
            'description'	=> __('Featured Image Size Should be ( 1400x600 ) More slider settings available in PRO Version','prevalent'),		
     ));	
	
	$wp_customize->add_setting('page-setting7',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','prevalent'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','prevalent'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','prevalent'),
			'section'	=> 'slider_section'
	));	// Slider Section
	
	$wp_customize->add_setting('slider_readmore',array(
	 		'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	 ));
	 
	 $wp_customize->add_control('slider_readmore',array(
	 		'settings'	=> 'slider_readmore',
			'section'	=> 'slider_section',
			'label'		=> __('Add text for slide read more button','prevalent'),
			'type'		=> 'text'
	 ));// Slider Read more	
	 
	 $wp_customize->add_setting('slider_shopnow',array(
	 		'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	 ));
	 
	 $wp_customize->add_control('slider_shopnow',array(
	 		'settings'	=> 'slider_shopnow',
			'section'	=> 'slider_section',
			'label'		=> __('Add text for slide shop now button','prevalent'),
			'type'		=> 'text'
	 ));// Slider shop now
	
	$wp_customize->add_setting('disabled_slides',array(
				'default' => true,
				'sanitize_callback' => 'prevalent_sanitize_checkbox',
				'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_slides', array(
			   'settings' => 'disabled_slides',
			   'section'   => 'slider_section',
			   'label'     => __('Uncheck To Enable This Section','prevalent'),
			   'type'      => 'checkbox'
	 ));//Disable Slider Section	
	
	
	// Home Three Boxes Section 	
	$wp_customize->add_section('section_second', array(
		'title'	=> __('Homepage Four Boxes Section','prevalent'),
		'description'	=> __('Select Pages from the dropdown for homepage four boxes section','prevalent'),
		'priority'	=> null
	));		
	
	$wp_customize->add_setting('page-column1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column1',array('type' => 'dropdown-pages',			
			'section' => 'section_second',
	));		
	
	$wp_customize->add_setting('page-column2',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column2',array('type' => 'dropdown-pages',			
			'section' => 'section_second',
	));
	
	$wp_customize->add_setting('page-column3',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column3',array('type' => 'dropdown-pages',			
			'section' => 'section_second',
	));
	
	$wp_customize->add_setting('page-column4',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-column4',array('type' => 'dropdown-pages',		
			'section' => 'section_second',
	));//end four column page boxes	
	
	$wp_customize->add_setting('disabled_pgboxes',array(
			'default' => true,
			'sanitize_callback' => 'prevalent_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_pgboxes', array(
			   'settings' => 'disabled_pgboxes',
			   'section'   => 'section_second',
			   'label'     => __('Uncheck To Enable This Section','prevalent'),
			   'type'      => 'checkbox'
	 ));//Disable page boxes Section	
	
	
	
	// Homepage About Us Section 	
	$wp_customize->add_section('section_about',array(
		'title'	=> __('About Us Section','prevalent'),
		'description'	=> __('Select Page from the dropdown for about us section','prevalent'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('page-setting1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-setting1',array('type' => 'dropdown-pages',			
			'section' => 'section_about',
	));
	
	$wp_customize->add_setting('disabled_aboutpage',array(
			'default' => true,
			'sanitize_callback' => 'prevalent_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_aboutpage', array(
			   'settings' => 'disabled_aboutpage',
			   'section'   => 'section_about',
			   'label'     => __('Uncheck To Enable This Section','prevalent'),
			   'type'      => 'checkbox'
	 ));//Home about Section 
	 
	 
	 // introduction Section 	
	$wp_customize->add_section('intropage_section',array(
		'title'	=> __('Introduction Section','prevalent'),
		'description'	=> __('Select Page from the dropdown for introduction section','prevalent'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('intropage_section',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'intropage_section',array('type' => 'dropdown-pages',			
			'section' => 'intropage_section',
	));
	
	$wp_customize->add_setting('disabled_intropage',array(
			'default' => true,
			'sanitize_callback' => 'prevalent_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_intropage', array(
			   'settings' => 'disabled_intropage',
			   'section'   => 'intropage_section',
			   'label'     => __('Uncheck To Enable This Section','prevalent'),
			   'type'      => 'checkbox'
	 ));//introduction Section 
	 
	 // Why Choose Us Section
	$wp_customize->add_section('section_why_choose_us',array(
		'title'	=> __('Why Choose Us Section','prevalent'),
		'description'	=> __('Select Page from the dropdown for why choose us section','prevalent'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('section_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('section_title',array(
			'label'	=> __('Add section title here','prevalent'),
			'section'	=> 'section_why_choose_us',
			'setting'	=> 'section_title'
	));
	
	$wp_customize->add_setting('subtitle_description',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('subtitle_description',array(
			'label'	=> __('Add some description here','prevalent'),
			'section'	=> 'section_why_choose_us',
			'setting'	=> 'subtitle_description'
	));
	
	$wp_customize->add_setting('page-whychooseus1',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-whychooseus1',array('type' => 'dropdown-pages',			
			'section' => 'section_why_choose_us',
	));
	
	$wp_customize->add_setting('page-whychooseus2',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-whychooseus2',array('type' => 'dropdown-pages',			
			'section' => 'section_why_choose_us',
	));
	
	$wp_customize->add_setting('page-whychooseus3',	array(
			'default'	=> '0',			
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
		));
 
	$wp_customize->add_control(	'page-whychooseus3',array('type' => 'dropdown-pages',			
			'section' => 'section_why_choose_us',
	));
	
	$wp_customize->add_setting('disabled_whychoosepage',array(
			'default' => true,
			'sanitize_callback' => 'prevalent_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'disabled_whychoosepage', array(
			   'settings' => 'disabled_whychoosepage',
			   'section'   => 'section_why_choose_us',
			   'label'     => __('Uncheck To Enable This Section','prevalent'),
			   'type'      => 'checkbox'
	 ));//Home about Section 		
		
}
add_action( 'customize_register', 'prevalent_customize_register' );

function prevalent_custom_css(){
		?>
        	<style type="text/css"> 
					
					a, .blog_lists h2 a:hover,
					#sidebar ul li a:hover,									
					.blog_lists h3 a:hover,
					.cols-4 ul li a:hover, .cols-4 ul li.current_page_item a,
					.recent-post h6:hover,					
					.fourbox:hover h3,
					.footer-icons a:hover,
					.sitenav ul li a:hover, .sitenav ul li.current_page_item a, 
					.postmeta a:hover
					{ color:<?php echo esc_html( get_theme_mod('color_scheme','#dd3333')); ?>;}
					 
					
					.pagination ul li .current, .pagination ul li a:hover, 
					#commentform input#submit:hover,					
					.nivo-controlNav a.active,
					.ReadMore,
					.appbutton:hover,					
					h3.widget-title,								
					#sidebar .search-form input.search-submit,				
					.wpcf7 input[type='submit']					
					{ background-color:<?php echo esc_html( get_theme_mod('color_scheme','#dd3333')); ?>;}
					
					
					.footer-icons a:hover							
					{ border-color:<?php echo esc_html( get_theme_mod('color_scheme','#dd3333')); ?>;}					
					
					
			</style> 
<?php                              
}
         
add_action('wp_head','prevalent_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function prevalent_customize_preview_js() {
	wp_enqueue_script( 'prevalent_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'prevalent_customize_preview_js' );