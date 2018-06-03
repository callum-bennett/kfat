<?php
/**
 *
 * CSS output for saraswathi theme
 *
 * Using icon options listed in customizer on design panel and under icons section
 *
 * located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/customizer/css/design'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */

?>
/* Social Icons */
.saras-social-icons .icon {
        background-color: <?php saraswathi_customizer_output_color( 'saras_icons_bg_color', '#455a64' ); ?>;
        color: <?php saraswathi_customizer_output_color( 'saras_icons_text_color', '#ffffff' ); ?>;
 }
.saras-social-icons .icon:hover {
        color: <?php saraswathi_customizer_output_color( 'saras_icons_bg_color', '#455a64' ); ?>;
        background-color: <?php saraswathi_customizer_output_color( 'saras_icons_text_color', '#ffffff' ); ?>;
 }
