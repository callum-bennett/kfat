<?php
/**
 *
 * The main template file for saraswathi template.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
get_header();

if ( ! saraswathi_get_theme_mod( 'saras_enable_index_sidebar',1 ) ) {
	$class = array( 'no-sidebar' );
} else {
	$class = null;
}
?>

<div id="primary" <?php saraswathi_primary_class( $class ); ?>>
    <main id="main" class="site-main" role="main"  <?php saraswathi_main_tag_schema(); ?>>
        <?php do_action( 'saraswathi_after_primary_before_entry_content' ); ?>
        <?php if ( have_posts() ) : ?>
        <?php /** Start the Loop */ ?>
        <div id="saras-post-load" class="saras-content-container">
            <?php while ( have_posts() ) : the_post(); ?>
            
            <?php
					/** Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
			saraswathi_get_template_part( 'default','content/content',get_post_format() );
			?>
            <?php endwhile; ?>
        </div> <!-- saras-content-containter -->
        
        <?php endif; ?>
       
        <?php  do_action( 'saraswathi_after_entry_content' ); ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php if ( saraswathi_get_theme_mod( 'saras_enable_index_sidebar',1 ) ) { get_sidebar(); } ?>
<?php get_footer(); ?>
