<?php
/**
 *
 * The template for displaying 404 pages (not found).
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

get_header(); ?>

<div id="primary" <?php saraswathi_primary_class(); ?>>
    <main id="main" class="site-main" role="main" <?php saraswathi_main_tag_schema(); ?>>
        <?php do_action( 'saraswathi_after_primary_before_entry_content' ); ?>
        <section class="error-404 not-found">
            <header class="page-header text-center">
                <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.','saraswathi-lite' ); ?></h1>
                 <div class="separator"></div>
                <p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the options below or a search?','saraswathi-lite' ); ?></p>
        
            </header><!-- .page-header -->
            <div class="saras-panel text-center">
            <h4><?php _e( 'Try searching to find what you need.','saraswathi-lite' ); ?></h4>
                    <?php get_search_form(); ?>
            </div>
            <div class="page-content saras-flexbox nopad">
                <div class="saras-panel col-2">
     
                    <?php if ( saraswathi_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
                                    <?php endif; ?>
                <?php /** Translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s','saraswathi-lite' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives','dropdown=1',"after_title=</h2>$archive_content" );
					?>
                </div>
                <div class="saras-panel col-2">
                        <?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
                  </div>

                </div><!-- .page-content -->
            </section><!-- .error-404 -->          
        <?php  do_action( 'saraswathi_after_entry_content' ); ?>
    </main><!-- #main -->
</div><!-- #primary -->
 
<?php get_sidebar(); ?>
<?php get_footer(); ?>
