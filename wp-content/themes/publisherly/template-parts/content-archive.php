<?php
/**
 * Template part for displaying posts.
 *
 * @package Publisherly
 */

?>

<article id="post-<?php the_ID(); ?>" class="article-posts" <?php post_class(); ?>>

	<!-- Post Thumbnail -->
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'publisherly-big' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry">

		<header class="entry-header">

			<?php
			the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>

		</header>

		<div class="entry-meta">
			
			<?php the_author_meta('display_name'); ?> | <?php echo get_the_date(); ?> | <?php the_category(', ') ?>

		</div>

		<div class="entry-content">

			<?php
			the_content('',TRUE,''); 
			?>

			<div class="more-link"><a href="<?php echo esc_url( get_permalink() ) ?>"><?php esc_html_e( 'Continue reading &raquo;', 'publisherly' ); ?></a></div>

			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'publisherly' ),
				'after'  => '</div>',
			) );
			?>

		</div><!-- /entry-content -->

	</div><!-- /entry -->

</article><!-- /article -->
