<?php
/**
 *
 * CSS output for buttons
 *
 * Using button options listed in customizer on design panel and under buttons section
 *
 * located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/customizer/css/design'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */

?>
button, input[type="button"], input[type="reset"], input[type="submit"], .saras-button, .button , .button-container .button:hover{
        color: <?php saraswathi_customizer_output_color( 'saras_button_text_color_1', '#9e9e9e' ) ?>;
        background-color: <?php saraswathi_customizer_output_color( 'saras_button_color_1', '#fafafa' );?>;
}
.post-navigation .back, button:focus,.button:focus,.saras-button:focus, .button-container .button:focus  {
background: <?php saraswathi_customizer_output_color( 'saras_button_color_1', '#fafafa' ); ?>;
color: <?php saraswathi_customizer_output_color( 'saras_button_text_color_1', '#9e9e9e' ) ?>;
}
input[type="button"]:hover,input[type="reset"]:hover, input[type="submit"]:hover,button::after,.button::after,.saras-button::after,.post-navigation .front,.pagination .page-numbers:hover,.pagination .page-numbers.current,.generatedcontent input.button:hover  {
background-color: <?php saraswathi_customizer_output_color( 'saras_button_color_2', '#455a64' ); ?>;
color: <?php saraswathi_customizer_output_color( 'saras_button_text_color_2', '#ffffff' ); ?>;
}
button:hover,.button:hover,.saras-button:hover, #infinite-handle span button:hover , .button-container .button:hover {
color: <?php saraswathi_customizer_output_color( 'saras_button_text_color_2', '#ffffff' ) ?>;
}
#infinite-handle span button:hover, #infinite-handle span button:focus {
color: <?php saraswathi_customizer_output_color( 'saras_button_text_color_2', '#ffffff' ) ?>!important;
}



