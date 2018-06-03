<?php
/**
 *
 * The template for displaying archive pages.
 *
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
get_header(); ?>
<div id="primary" <?php saraswathi_primary_class(); ?>>
     <main id="main" class="site-main" role="main"  <?php saraswathi_main_tag_schema(); ?>>
        <?php if ( have_posts() ) : ?>
            <header class="saras-taxo-header">
                <?php
					the_archive_title( '<h1 class="saras-taxo-title">','</h1>' );
					the_archive_description( '<div class="saras-taxo-description">','</div>' );
				?>
            </header><!-- .page-header -->
         
	<?php do_action( 'saraswathi_after_primary_before_entry_content' ); ?>
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
					 </div>  <!-- saras-content-containter -->
				<?php  do_action( 'saraswathi_after_entry_content' ); ?>
            <?php else : ?>
            <?php saraswathi_get_template_part( 'default','content/content','none' ); ?> 
			<?php endif; ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
