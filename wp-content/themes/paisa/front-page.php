<?php
/**
 * @package Paisa
 */

get_header();

$layout = 'masonry-fullwidth';

?>

	<div id="primary" class="content-area <?php echo esc_attr( $layout ); ?>">

		<main id="main" class="site-main" role="main">
            <section class="intro">
                <div class="container">
                    <?php
                    while ( have_posts() ) : the_post();

                        get_template_part( 'template-parts/content', 'home' );

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile;
                    ?>
                </div>
            </section>

            <?php
            $query = new WP_Query( array(
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                'posts_per_page' => 3
            ));

            if ($query->found_posts) : ?>
            <section class="most-popular">
                <div class="container">
                    <h2 class="section-heading text-center">Most popular articles</h2>

                    <div class="most-read-loop row-fluid clearfix">
                        <?php while ( $query->have_posts() ) : $query->the_post() ?>
                            <div class="col-sm-4">
                                <?php

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', 'card');
                                ?>
                            </div>

                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
