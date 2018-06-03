<?php 
/**
 * Template Name: Full Width
**/
get_header(); ?>
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
        <div class="col-md-12 full-width">
            <div class="blog-block">
            	<?php if ( have_posts() ) :
            	while ( have_posts() ) : the_post(); ?>
	                <article data-aos="fade-up" id="post-<?php the_ID(); ?>" <?php post_class('post-publish'); ?>>
	                	<?php if(has_post_thumbnail()): ?>
		                    <div class="post-cover">
		                        <a href="<?php the_permalink(); ?>">
		                            <?php the_post_thumbnail( 'romana-blog-image', array('class' => 'img-responsive') ); ?>
		                        </a>
		                    </div>
		                <?php endif; ?>
	                    <div class="post-content">
	                        <div class="entry-content">
		                        <?php the_content(); ?>
		                    </div>
		                    <?php $romana_cmmnt_count = get_comments_number();
		                    if($romana_cmmnt_count > 0 ): ?>
		                    <div class="entry-footer">
			                    <div class="post-comments">
			                        <a href="#" title="Comments">
			                            <i class="fa fa-commenting-o" aria-hidden="true"></i><?php echo get_comments_number(); esc_html_e(' Comments','romana'); ?>
			                        </a>
			                    </div>
		                	</div>
		                <?php endif; ?>
	            		</div>
	        		</article>
	        		<?php comments_template('', true);
	        		$romana_args = array(
						'mid_size' => 2,
						'screen_reader_text' => '',
						'prev_text' => esc_html__('Previous','romana'),
						'next_text' => esc_html__('Next','romana'),
					);
			        endwhile;
			       endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();