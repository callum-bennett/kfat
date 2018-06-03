<?php
/**
 *
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
            <section class="search-header-section">
                <header class="search-header">
                    <h1 class="search-title"><?php printf( __( 'Search Results for: %s','saraswathi-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->
                <div class="search-form-container">
                    <p><?php _e( 'If this search was not satisfactory, try searching again with a different search keyword','saraswathi-lite' ); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </section>
            <section class="search-content">
                <?php /** Start the Loop */ ?>
                <?php do_action( 'saraswathi_after_primary_before_entry_content' ); ?>
                
                <div class="search-items">
                <?php while ( have_posts() ) : the_post(); ?>
                <?php saraswathi_get_template_part( 'default','content/content','search' ); ?>              
                <?php endwhile; ?>
                </div>                       
                <?php do_action( 'saraswathi_after_entry_content' ); ?>
                <?php else : ?>
                <?php do_action( 'saraswathi_after_primary_before_entry_content' ); ?>
                <?php saraswathi_get_template_part( 'default','content/content','none' ); ?>
                <?php do_action( 'saraswathi_after_entry_content' ); ?>
               </section>
            <?php endif; ?>
        </main><!-- #main -->
</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
