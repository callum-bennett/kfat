<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package romana
 */
get_header(); ?>
<section>
	<div class="page-title-area">
        <div class="container">
            <div class="row">
                 <div class="col-md-12">
                    <div class="page-title">
                        <h1><?php esc_html_e( "Oops! That page can't be found.", "romana" ); ?></h1>
                        <?php echo romana_custom_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-8 <?php if(get_theme_mod('romana_sidebar_layout') == 0){ echo esc_attr('pull-right'); } ?>">
            <div class="blog-block">
                <article class="post-publish" data-aos="fade-up">
                    <div class="search-area">
                        <p class="searchform">
                            <?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'romana'); ?>.
                        </p>
                        <?php get_search_form(); ?>
                    </div>
                </article>    
            </div>
		</div>
        <div><?php get_sidebar(); ?></div>
	</div>
</div>
<?php get_footer();