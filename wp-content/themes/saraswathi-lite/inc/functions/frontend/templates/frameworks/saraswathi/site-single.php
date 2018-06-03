<?php
/**
 *
 * The template for displaying all single posts.
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
        <main id="main" class="site-main" role="main"  <?php saraswathi_main_tag_schema(); ?>>
        
		<?php while ( have_posts() ) : the_post(); ?>
            
            <?php do_action( 'saraswathi_after_primary_before_entry_content' );  ?>
            
			<?php saraswathi_get_template_part( 'default','content/content','single' ); ?>
            <?php  do_action( 'saraswathi_after_entry_content' ); ?>
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
