<?php
	/**
	 *
	 * The header for page templates that are full width.
	 *
	 * Displays all of the <head> section and everything up till <div class="saras-content-wrap">
	 *
	 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/frameworks/templates/default/pages'
	 *
	 * @since Saraswathi Lite 1.0.0
	 *
	 * @package Saraswathi Lite
	 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?> <?php saraswathi_body_tag_schema(); ?>>
		<div id="page" class="hfeed site">
			<div id="page-wrap" class="full-width-page landing">
				<?php do_action( 'saraswathi_before_header' ); ?>
					<?php saraswathi_header(); ?>
						<?php do_action( 'saraswathi_before_content_after_header' ); ?>
							<div id="content" class="site-content">
								<div <?php saraswathi_content_wrap_class( array( 'full-width', 'landing' ) );  ?>>
									<?php do_action( 'saraswathi_after_header_before_primary' ); ?>
