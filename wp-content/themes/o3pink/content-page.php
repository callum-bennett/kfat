<?php

/**

 * The template used for displaying page content

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

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->



	<div class="entry-content">

		<?php the_content(); ?>

		<?php

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



	<?php edit_post_link( __( 'Edit', 'o3pink' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer><!-- .entry-footer -->' ); ?>



</article><!-- #post-## -->

