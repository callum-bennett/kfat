<?php
/*
 * Search Template File
 */
get_header(); ?>
<section>
    <div class="page-title-area">
        <div class="container">
            <div class="row">
                 <div class="col-md-12">
                    <div class="page-title">
                        <h1><?php _e('Search results for', 'romana');
                            echo " : " . get_search_query(); ?></h1>
                        <?php echo romana_custom_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-md-8 <?php if(get_theme_mod('romana_sidebar_layout') == 0){ esc_attr('pull-right','romana'); } ?>">
            <div class="blog-block">
                <?php if (have_posts()) : ?>
                    <div class="post-publish">
                        <?php get_search_form(); ?>
                    </div>
                    <?php while(have_posts()): the_post(); ?>
                    <article class="post-publish" data-aos="fade-up">
                        <?php if(has_post_thumbnail()): ?>
                            <div class="post-cover">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'romana-blog-image', array('class' => 'img-responsive') ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="post-content">
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php if(get_theme_mod('romana_hide_date_sec') != 0 || get_theme_mod('romana_hide_author_sec') != 0): ?>
                                <div class="entry-meta">
                                    <?php if(get_theme_mod('romana_hide_date_sec') != 0): ?>
                                    <span class="post-date">
                                        <a href="#"><?php echo esc_html(get_the_date('F d, Y')); ?></a>
                                    </span>
                                    <?php endif;
                                if(get_theme_mod('romana_hide_author_sec') != 0): ?>
                                    <span class="byline"><?php esc_html_e('By ','romana'); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo ucfirst(get_the_author()); ?>"><?php echo ucfirst(get_the_author()); ?></a>
                                    </span>
                                  <?php endif; ?>        
                                </div>
                            <?php endif; ?>    
                                <div class="entry-content">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="entry-footer">
                                    <div class="post-comments">
                                        <a href="<?php the_permalink(); echo esc_attr('#respond'); ?>" title="<?php esc_attr_e('Comments','romana'); ?>">
                                            <i class="fa fa-commenting-o" aria-hidden="true"></i><?php echo get_comments_number(); esc_html_e(' Comments','romana'); ?>
                                        </a>
                                    </div>
                                </div>    
                        </div>
                    </article>
            <?php endwhile;
            else : ?>
                <article class="post-publish" data-aos="fade-up">
                    <div class="search-area">
                        <p class="searchform">
                            <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords', 'romana'); ?>.
                        </p>
                        <?php get_search_form(); ?>
                    </div>
                </article>
            <?php endif; ?>
            </div>
        </div>
        <div><?php get_sidebar(); ?></div>
    </div>
</div>
<?php get_footer();