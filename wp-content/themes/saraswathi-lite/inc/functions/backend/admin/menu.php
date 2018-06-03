<?php
/**
 * Saraswathi Theme Admin Menu
 *
 * Adds admin menus and pages for Theme.
 *
 * located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/admin/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite

 * *****************************************
 *	Table of Contents
 *
 *	1.0 - Add Menu
 *	2.0 - Main Menu Item Page
 *	3.0 - Backup and Restore Menu Item Page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
*	1.0 - Add Menu
*
*	Output buffering to fix issues with parsing header.
*/
ob_start();
/**
 *	Add Product validation page as the main admin page.
 */
function saraswathi_admin_menu() {

	add_theme_page( __( 'Saraswathi Lite', 'saraswathi-lite' ) , __( 'Saraswathi Lite', 'saraswathi-lite' ) , 'edit_theme_options', 'saraswathi-lite', 'saraswathi_admin_page', get_template_directory_uri() . '/assets/images/icon.png', '50' );

}
add_action( 'admin_menu', 'saraswathi_admin_menu' );





/**
 *
 *	2.0 - Main Menu Item Page
 *
 *	Outputs main admin page for saraswathi theme.
 */
function saraswathi_admin_page() {

	$saraswathiLite = wp_get_theme( 'saraswathi-lite' );
	if ( current_user_can( 'edit_plugins' ) ) {		
	?>
    <div id="saraswathi_admin_page" class="welcome wrap saraswathi">
        <div id="saraswathi-dash">
            <div class="saras-content">
                <header>
									<div class="saras-row">
										<div class="saras-col-2">									
											<h1 style="margin-right: 0;"><strong><?php echo __( 'Saraswathi Lite', 'saraswathi-lite' ) ?></strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;"><?php echo	esc_attr( $saraswathiLite['Version'] )	?></sup></h1>
							
											<p style="font-size: 1.2em;"><span class="dashicons dashicons-smiley"></span> <?php echo __( 'Thank You For Deciding To Use Our Theme & Welcome to the Saraswathi Theme Community!', 'saraswathi-lite' ) ?> </p>
											
											<p>
												
												<?php echo __( 'Saraswathi Lite is a super light WordPress theme developed with WordPress\'s core philosophy in mind of "Clean, Lean and Mean". It integrates with WordPress\'s native Customizer options panel so you can change themes looks without coding. Whether you\'re a normal user, WordPress developer, or both - you will enjoy  using this theme with a extensively commented codebase and minimalistic functional design.', 'saraswathi-lite' ) ?>
											</p>
											<p class="theme-description"><?php echo __( 'Designed by', 'saraswathi-lite' ) ?> <a href="<?php echo esc_url($saraswathiLite['ThemeURI'])	?>" target="_blank"><?php echo $saraswathiLite['Author'] ?></a>.
											</p>
										</div>
										<div class="saras-col-2">
											<img src="<?php echo	esc_url($saraswathiLite->get_screenshot()) ?>" />
										</div>
									</div>

							</header>
							<section class="about">
								<div class="saras-row">
									<div class="saras-col-3">
										<h3><?php echo __( 'Mobile First', 'saraswathi-lite' ) ?></h3>
										<p>
										<?php echo __( 'We made Saraswathi for mobile first. Every pixel designed to progressively scale and remain consistent in performance on all devices, paving way for engaging user experience.', 'saraswathi-lite' ) ?>
												
										</p>
									</div>
									
									<div class="saras-col-3">
										<h3><?php echo __( 'Clean, Lean, and Mean', 'saraswathi-lite' ) ?></h3>
										<p>
										<?php echo __( 'Design is the tip of the iceberg, what never meets the eye is the code underneath.We go to great lengths to keep it clean, lean, and mean.', 'saraswathi-lite' ) ?>
										</p>
									</div>
									
									
									<div class="saras-col-3">
										<h3><?php echo __( 'Ready to go!', 'saraswathi-lite' ) ?></h3>
										<p>
											<?php echo __( 'With all essential features required to create modern & beautiful websites.Saraswathi unites the best of both worlds offers beautiful design & features yet it is incredibly simple to use, with very little setup and no need for coding.', 'saraswathi-lite' ) ?>	
										</p>
									</div>
								
								</div>
							</section>
							<section class="theme">
								<div class="row">
									<div class="pro notes saras-col-2">
										<h4><?php echo __( 'Upgrade to Saraswathi Pro version to unlock the true potential of this theme.', 'saraswathi-lite' ) ?></h4>
										<div class="content">
											<p>
											<?php echo __( 'The Saraswathi Pro gives you further control over the look and feel of your website. Saraswathi is versatile and dynamic,thanks to a powerful modular template framework. This framework acts as a scaffolding to create any design to suit any purpose.With 100s options to tweak such as color, layout, width and widgets no two WordPress website using Saraswathi theme has to ever look the same.', 'saraswathi-lite' ) ?>
											</p>
											
											<p><?php echo __( 'This also means free theme installation & pro email support for a year.', 'saraswathi-lite' ) ?></p>
											
											<p><a href="//www.smartpixels.net/products/saraswathi-theme/?utm_source=saraswathilite&amp;utm_medium=upsell&amp;utm_campaign=saraswathilitewelcome" class="button button-primary">Upgrade To <span class="screen-reader-text"><?php echo __( 'Saraswathi Pro', 'saraswathi-lite' ) ?></span> <?php echo __( 'Saraswathi Pro', 'saraswathi-lite' ) ?></a>
											</p>
										</div>
									</div>
								</div>
							</section>
							<section class="links">
								<div class="row">

									<div class="saras-panel saras-col-2">
										<h3>
											<span class="dashicons dashicons-sos"></span><?php echo __( 'Theme Installation Service', 'saraswathi-lite' ) ?>
										</h3>
										<p class="small saras-excerpt"><?php echo __( 'Paid Theme Installation Services Available Click To Know More', 'saraswathi-lite' ) ?></p>
										<a class="button" href="//www.smartpixels.net/theme-installation-service/" target="_blank"><?php echo __( 'Theme Installation Service', 'saraswathi-lite' ) ?></a> 
										</p>
								</div>	
								</div>
							</section>

    </div>
    <?php

	}
}