<?php

/**

 * The default template for displaying content

 *

 * Used for both single and index/archive/search.

 *

 * @package WordPress

 * @subpackage o3pink

 * @since o3pink 1.0

 */

?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php

		// Post thumbnail.

		o3pink_post_thumbnail();

	?>



	<header class="entry-header">

		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'o3pink' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->



	<div class="entry-content">

		<?php

			/* translators: %s: Name of current post */

			the_content( sprintf(

				__( 'Continue reading %s', 'o3pink' ),

				the_title( '<span class="screen-reader-text">', '</span>', false )

			) );



			wp_link_pages( array(

				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'o3pink' ) . '</span>',

				'after'       => '</div>',

				'link_before' => '<span>',

				'link_after'  => '</span>',

				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'o3pink' ) . ' </span>%',

				'separator'   => '<span class="screen-reader-text">, </span>',

			) );

		?>

	</div><!-- .entry-content -->



	<?php

		// Author bio.

		if ( is_single() && get_the_author_meta( 'description' ) ) :

			get_template_part( 'author-bio' );

		endif;

	?>



	<footer class="entry-footer">

		<?php o3pink_entry_meta(); ?>

		<?php edit_post_link( __( 'Edit', 'o3pink' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->



</article><!-- #post-## -->

