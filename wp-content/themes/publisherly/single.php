<?php
/**
 * The template for displaying all single posts.
 *
 * @package publisherly
 */

get_header(); ?>

<div id="content" class="site-content" >

	<div id="primary" class="content-wrapper">

		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single' );

				$args = array(
					'prev_text'          => esc_html__('Previous post: %title', 'publisherly' ),
					'next_text'          => esc_html__('Next post: %title', 'publisherly' ),
				);
				the_post_navigation($args);

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- /main -->

	</div><!-- /content-wrapper -->

	<?php
	get_sidebar();
	?>

</div><!-- /content -->

<?php
get_footer();