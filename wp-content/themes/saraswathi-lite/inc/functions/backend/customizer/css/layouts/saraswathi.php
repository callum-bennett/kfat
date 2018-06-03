<?php
/**
 *
 * CSS output for saraswathi template
 *
 * Using saraswathi template options listed in customizer on layouts panel and under saraswathi section
 *
 * located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/customizer/css/layouts'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */

?>

/* Main Layout */

<?php if ( 'grid' === saraswathi_get_theme_mod( 'saras_saraswathi_site_layout','grid' ) ) : ?>
  @media all and (min-width: 48.0625em) {  
.saras-grid.max {
        max-width: <?php saraswathi_customizer_output_int( 'saras_saraswathi_grid_max_width','1280' )?>px;
}
}
@media all and (min-width: <?php saraswathi_topbar_media_query();?>px) {
.saras-header .saras-topbar-container.right {
			 left: <?php saraswathi_customizer_output_int( 'saras_saraswathi_grid_max_width','1280' );?>px;
}
}
<?php endif; ?>

<?php if ( 'fullwidth' === saraswathi_get_theme_mod( 'saras_saraswathi_site_layout','grid' ) ) : ?>
  @media all and (min-width: 48.0625em) {  
.grid-page.landing .max {
        max-width: <?php saraswathi_customizer_output_int( 'saras_saraswathi_grid_max_width','1280' ); ?>px;
    }
}
 @media all and (min-width: <?php saraswathi_topbar_media_query();?>px) {
  .grid-page.landing .saras-topbar-container.right {
        left: <?php saraswathi_customizer_output_int( 'saras_saraswathi_grid_max_width','1280' ); ?>px;
 }
}
<?php endif; ?>

/* Body Layout */

body {
    background: <?php saraswathi_customizer_output_color( 'saras_saraswathi_body_bg_color','#f9f9f9' ); ?>;
 }



@media only screen and (min-width: 48.0625em) {

.saras-content.width {
	
	 width: <?php if ( 'none' !== saraswathi_get_theme_mod( 'saras_saraswathi_sidebar_layout','right' ) ) {
			saraswathi_customizer_output_int( 'saras_saraswathi_content_width','80' );?>%
<?php
} else {
?>
100%
<?php }	?>;
}
}
  
/* Sidebar Content Layout */

<?php if ( 'none' !== saraswathi_get_theme_mod( 'saras_saraswathi_sidebar_layout','right' ) ) { ?>

@media only screen and (min-width: 48.0625em) {
.saras-sidebar.width {
			width: <?php saraswathi_customizer_output_int( 'saras_saraswathi_sidebar_width','20' )?>%;
        }
}
<?php } else { ?>
.saras-sidebar {
			display:none;
}
<?php } ?>


/* Pace */

.pace { 
    background-color: <?php saraswathi_customizer_output_color( 'saras_saraswathi_body_bg_color','#f9f9f9' ); ?>; 
}
<?php if ( 'grid' === saraswathi_get_theme_mod( 'saras_saraswathi_site_layout','grid' ) ) : ?>
@media only screen and (min-width: 48.0625em) {
.top-bar-section {
	padding-right: 0!important;
	padding-left:0!important;
	margin: 0 auto;
}
}
<?php endif; ?>