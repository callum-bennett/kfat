<?php get_header(); ?>
<section>
    <div class="page-title-area">
        <div class="container">
            <div class="row">
                 <div class="col-md-12">
                    <div class="page-title">
                        <h1><?php the_title(); ?></h1>
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
            	<?php if ( have_posts() ) :
            	while ( have_posts() ) : the_post(); ?>
	                <article  id="post-<?php the_ID(); ?>" <?php post_class('post-publish'); ?>>
	                	<?php if(has_post_thumbnail()): ?>
		                    <div class="post-cover">
                                <?php the_post_thumbnail(); ?>
		                    </div>
		                <?php endif; ?>
	                    <div class="post-content">
	                        <h3 class="entry-title"><?php the_title(); ?></h3>
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
    	                        <?php the_content(); 
                                wp_link_pages( array(
                                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'romana' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'romana' ) . ' </span>%',
                                    'separator'   => '<span class="screen-reader-text">, </span>',
                                ) ); ?> 
    	                    </div>
                            <div class="entry-footer">
        	                    <div class="post-comments">
        	                        <a href="#" title="<?php esc_attr_e('Comments','romana'); ?>">
        	                            <i class="fa fa-commenting-o" aria-hidden="true"></i><?php echo get_comments_number(); esc_html_e(' Comments','romana'); ?>
        	                        </a>
        	                    </div>
                                <div class="social">
                                    <?php echo get_the_tag_list('<ul><li>','</li><li>','</li></ul>'); ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php the_post_navigation( array(
                            'prev_text'                 => esc_html__( 'previous', 'romana' ),
                            'next_text'                 => esc_html__( 'next', 'romana' ),
                            'screen_reader_text'        => esc_html__(' ', 'romana'),
                        ) );
                comments_template('', true);

            endwhile;
            the_posts_pagination( array(
            'type'  => 'list',
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="fa fa-long-arrow-left"></i>',
            'next_text'          => '<i class="fa fa-long-arrow-right"></i>',
        ) );
		endif; ?>
            </div>
        </div>
        <!-- Side bar -->
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer();