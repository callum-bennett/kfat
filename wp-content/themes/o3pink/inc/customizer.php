<?php
/**
 * o3pink Theme Customizer
 *
 * @package WordPress
 * @subpackage o3pink
 * @since 1.0
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
  * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function o3pink_register_theme_customizer($wp_customize) {
   // o3pink color options
   $o3pink_colors = array('o3pink_primary_color' => array(
           'id' => 'o3pink_primary_color',
           'default' => '#E85151',
           'title' => __('Primary Color', 'o3pink')
       ),
       'o3pink_link_color' => array(
           'id' => 'o3pink_link_color',
           'default' => '#E85151',
           'title' => __('Link Color', 'o3pink')
   ));
   $i = 20;
   foreach ($o3pink_colors as $o3pink_color) {
      $wp_customize->add_setting(
              $o3pink_color['id'], array(
          'default' => $o3pink_color['default'],
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'o3pink_sanitize_hex_color',
          'sanitize_js_callback' => 'o3pink_sanitize_escaping'
              )
      );
      $wp_customize->add_control(
              new WP_Customize_Color_Control(
              $wp_customize, $o3pink_color['id'], array(
          'label' => $o3pink_color['title'],
          'section' => 'colors',
          'settings' => $o3pink_color['id'],
          'priority' => $i
              )
              )
      );
      $i++;
   }
function o3pink_sanitize_hex_color($color) {
      if ($unhashed = sanitize_hex_color_no_hash($color))
         return '#' . $unhashed;
      return $color;
   }
   function o3pink_sanitize_escaping($input) {
      $input = esc_attr($input);
      return $input;
   }
}
add_action('customize_register', 'o3pink_register_theme_customizer');

function o3pink_customizer_baner( $wp_customize ) {

	// add "Content Options" section
	$wp_customize->add_section( 'o3pink_baner_section' , array(
		'title'      => esc_html__( 'Banner Options', 'o3pink' ),
		'priority'   => 50,
               
	) );
	
	$wp_customize->add_setting('o3pink_banner', array(
		'flex-width'    => true,
		'width'         => 980,
		'flex-height'   => true,
		'height'        => 200,
		'default' 		=> get_template_directory_uri() . '/images/pexels-photo.png',
        'sanitize_callback' => 'esc_url_raw',
        'type'          => 'option',
 
    ));
	 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'o3pink_banner', array(
        'label'    => __('Image Upload for banner on Front page.', 'o3pink'),
        'section'  => 'o3pink_baner_section',
        'settings' => 'o3pink_banner',
    )));
	
	
}
add_action( 'customize_register', 'o3pink_customizer_baner' );



function o3pink_customizer_css() {
   $customizer_css = '';
   $primary_color = esc_attr( get_theme_mod('o3pink_primary_color', '#ffc800') );
$link_color = esc_attr( get_theme_mod('o3pink_link_color', '#6a6a6a') );
   if ($primary_color && $primary_color != '#ffc800') {
      $customizer_css .= '
	     blockquote { border-left: 2px solid ' . $primary_color . '; }
           .post-header .entry-author, .post-header .entry-standard, .post-header .entry-date, .post-header .entry-tag { color: ' . $primary_color . '; }
           .entry-author, .entry-standard, .entry-date { color: ' . $primary_color . '; }
           a:hover { color: ' . $primary_color . '; }
           .widget_recent_entries li:before, .widget_recent_comments li:before { color: ' . $primary_color . '; }
           .underline { background: none repeat scroll 0 0 ' . $primary_color . '; }
           .widget-title { border-left: 3px solid ' . $primary_color . '; }
           .sticky { border: 1px solid ' . $primary_color . '; }
           .footer-background { border-top: 5px solid ' . $primary_color . '; }
           .site-title a:hover { color: ' . $primary_color . '; }
           button, input[type="button"], input[type="reset"], input[type="submit"] { background: none repeat scroll 0 0 ' . $primary_color . '; }
           .breadcrums span { color: ' . $primary_color . '; }
           .button:hover { color: ' . $primary_color . '; }
           .catagory-type a:hover { color: ' . $primary_color . '; }
           .copyright a span { color: ' . $primary_color . '; }
           button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { color: ' . $primary_color . '; }
           .widget_rss li a:hover { color: ' . $primary_color . '; }
           @media screen and (max-width: 768px) { nav li:hover ul li a:hover, nav li a:hover { background: ' . $primary_color . '; } }
           ';
   }
   if ($link_color && $link_color != '#6a6a6a') {
      $customizer_css .= '
           a { color: ' . $link_color . '; }
           .button { color: ' . $link_color . '; }
           .catagory-type a { color: ' . $link_color . '; }
           .widget_rss li a { color: ' . $link_color . '; }
           ';
   }
   ?>
   <style type="text/css"><?php echo $customizer_css; ?></style>
   <?php
/*   if (esc_attr(get_theme_mod('o3pink_custom_css'))) {
      $customizer_css .= esc_attr(get_theme_mod('o3pink_custom_css'));
      echo "<style type=\"text/css\">{$customizer_css}</style>";
   }
*/}
add_action('wp_head', 'o3pink_customizer_css');
?>
