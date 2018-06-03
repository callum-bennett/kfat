<?php

/**

 * The template for displaying comments

 *

 * The area of the page that contains both current comments

 * and the comment form.

 *

 * @package WordPress

 * @subpackage o3pink

 * @since o3pink 1.0

 */



/*

 * If the current post is protected by a password and

 * the visitor has not yet entered the password we will

 * return early without loading the comments.

 */

if ( post_password_required() ) {

	return;

}

?>



<div id="comments" class="comments-area">



	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title">
		<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'o3pink' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'o3pink'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>


		</h2>



		<?php o3pink_comment_nav(); ?>



		<ol class="comment-list">

			<?php

				wp_list_comments( array(

					'style'       => 'ol',

					'short_ping'  => true,

					'avatar_size' => 56,

				) );

			?>

		</ol><!-- .comment-list -->



		<?php o3pink_comment_nav(); ?>



	<?php endif; // have_comments() ?>



	<?php

		// If comments are closed and there are comments, let's leave a little note, shall we?

		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :

	?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'o3pink' ); ?></p>

	<?php endif; ?>



	<?php comment_form(); ?>



</div><!-- .comments-area -->
