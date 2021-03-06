<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package publisherly
 */

?>

<article id="post-<?php the_ID(); ?>" class="clearfix" <?php post_class(); ?>>

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

			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

		</header><!-- /entry-header -->

		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'publisherly' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'publisherly' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
				?>
			</div><!-- /entry-content -->

	</div><!-- /entry -->

</article><!-- /article -->
