<?php
/**
 *
 * The footer for page templates with footer for full width pages.
 *
 * Contains the closing of the .saras-content-wrap div and all content after
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
                                    </div><!-- #content wrap -->
                                </div><!-- #content -->
							<?php do_action( 'saraswathi_after_content_before_footer' ); ?>
							 <footer id="colophon" <?php saraswathi_footer_class( array( 'full-width' ) ); ?> role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
								<?php saraswathi_footer(); ?>
                             </footer>
                    </div>  <!-- #page-wrap -->
                </div><!-- #page -->
			<?php do_action( 'saraswathi_after_footer' ); ?>
		<?php wp_footer(); ?>
    </body>
</html>
