<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Paisa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content col-sm-5">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'paisa' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

    <div class="col-sm-6 col-sm-offset-1">
        <img src="http://via.placeholder.com/350x200"/>
        <img src="http://via.placeholder.com/350x200"/>
        <img src="http://via.placeholder.com/350x200"/>
    </div>

</article><!-- #post-## -->
