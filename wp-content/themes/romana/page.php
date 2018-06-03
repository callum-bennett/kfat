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
        <div class="col-md-8 <?php if(get_theme_mod('romana_sidebar_layout') == 0){ echo esc_attr('pull-right'); } ?>">
            <div class="blog-block">
            	<?php if ( have_posts() ) :
            	while ( have_posts() ) : the_post(); ?>
	                <article id="post-<?php the_ID(); ?>" <?php post_class('post-publish'); ?>>
	                	<?php if(has_post_thumbnail()): ?>
		                    <div class="post-cover">
		                       <?php the_post_thumbnail( 'romana-blog-image', array('class' => 'img-responsive') ); ?>
		                    </div>
		                <?php endif; ?>
	                    <div class="post-content">
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
		                    <?php $romana_cmmnt_count = get_comments_number();
			                    if($romana_cmmnt_count > 0 ): ?>
			                    <div class="entry-footer">
				                    <div class="post-comments">
				                        <a href="#" title="<?php esc_attr_e('Comments','romana'); ?>">
				                            <i class="fa fa-commenting-o" aria-hidden="true"></i><?php echo get_comments_number(); esc_html_e(' Comments','romana'); ?>
				                        </a>
				                    </div>
			                	</div>
			                <?php endif; ?>
	            		</div>
	        		</article>
	        <?php comments_template('', true);
	        endwhile;
		endif; ?>
            </div>
        </div>
        <!-- Side bar -->
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer();