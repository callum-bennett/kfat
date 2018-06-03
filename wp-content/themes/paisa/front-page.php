<?php
/**
 * @package Paisa
 */

get_header();

$layout = 'masonry-fullwidth';

?>

	<div id="primary" class="content-area col-md-12 <?php echo esc_attr( $layout ); ?>">
		<main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', 'home' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.


            $query = new WP_Query( array(
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                'posts_per_page' => 3
            ));

            if ($query->found_posts) :

            while ( $query->have_posts() ) : $query->the_post() ?>

                <div class="posts-loop">
                    <?php

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );
                    ?>
                </div>
            <?php

            endwhile;
            endif;

            ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
