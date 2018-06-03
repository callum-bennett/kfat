<?php
/**
 * The sidebar containing the main widget area.
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/frameworks/templates/saraswathi/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

if( is_page_template('template-left.php')	){
	$class	=	'right';
} elseif(	is_page_template('template-right.php')	){
	$class	=	'left';
} else {	
	$class	=	saraswathi_sanitize_html_class( saraswathi_get_theme_mod( 'saras_saraswathi_sidebar_layout','right' ) );
}
?>

<div id="secondary" class="widget-area saras-sidebar <?php echo $class; ?> width" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
