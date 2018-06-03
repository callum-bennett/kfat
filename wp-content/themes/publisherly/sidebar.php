<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Publisherly
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>
	<aside id="sidebar-right" class="widget-area" role="complementary">

		<?php dynamic_sidebar( 'sidebar' ); ?>

	</aside>
	<!-- /aside -->
