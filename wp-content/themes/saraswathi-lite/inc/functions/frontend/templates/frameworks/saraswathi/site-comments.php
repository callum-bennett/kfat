<?php
/**
 *
 * The template for displaying comments.
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/frameworks/templates/saraswathi/'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
	<?php do_action( 'saraswathi_after_post_nav_before_comments' ); ?>
<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
        <h6 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					printf(
						/* translators: %s: post title */
						esc_html_x( 'One comment', 'comments title', 'saraswathi-lite') 
						);
				} else {
					printf( // WPCS: XSS OK.
						/* translators: 1: number of comments, 2: post title */
						esc_html( _nx(
							'%1$s comments',
							'%1$s comments',
							$comments_number,
							'comments title',
							'saraswathi-lite'
						) ),
						number_format_i18n( $comments_number ),
						'<span>' . get_the_title() . '</span>'
					);
				}

			?>
        </h6>

        <ol class="comment-list">
			<?php
				wp_list_comments( array(
					'walker'            => null,
					'callback'          => 'saraswathi_comment',
					'end-callback'      => null,
					'avatar_size'       => 32,
					'style'             => 'ol',
					'format'            => 'html5',// Or xhtml if no HTML5 theme support.
					'short_ping'        => true,
				) );
			?>
        </ol><!-- .comment-list -->

		<?php saraswathi_comment_nav(); ?>
        <!-- #comment-nav-below -->


	<?php endif; // Have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' !== get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments"><?php _e( 'Comments are closed.','saraswathi-lite' ); ?></p>
	<?php endif; ?>

	<?php 
	global $user_identity;
	$commenter = wp_get_current_commenter();
	$aria_req = "";
	$fields =  array(
		'author' =>
		'<p class="comment-form-author"> ' .
    '<input id="author" placeholder="'.__( 'Name (Required)', 'saraswathi-lite' ).'" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' /></p>',
		
  'email' =>
    '<p class="comment-form-email">' .
    '<input id="email" name="email" placeholder="'.__( 'Email (Required)', 'saraswathi-lite' ).'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>',

  'url' =>
    '<p class="comment-form-url">' .
    '<input id="url" name="url" placeholder="'.__( 'Website', 'saraswathi-lite' ).'" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>',
	);
$args = array(
	
	'id_form'           => 'commentform',
	'id_submit'         => 'submit',
	'class_submit'      => 'submit',
	'name_submit'       => 'submit',
	'title_reply'       => __( 'Leave a Reply', 'saraswathi-lite' ),
	'title_reply_to'    => __( 'Leave a Reply to %s', 'saraswathi-lite' ),
	'cancel_reply_link' => __( 'Cancel Reply', 'saraswathi-lite' ),
	'label_submit'      => __( 'Post Comment', 'saraswathi-lite' ),
  'format'            => 'html5',
	
	'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" placeholder="'.__( 'Comment', 'saraswathi-lite' ).'" name="comment" cols="45" rows="8" aria-required="true">' .
    '</textarea></p>',
	'must_log_in' => '<p class="must-log-in">' .
    sprintf(
      __( 'You must be <a href="%s">logged in</a> to post a comment.','saraswathi-lite' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
    ) . '</p>',
	'logged_in_as' => '<p class="logged-in-as">' .
    sprintf(
    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'saraswathi-lite' ),
      admin_url( 'profile.php' ),
      $user_identity,
      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
    ) . '</p>',

  'comment_notes_before' => '',

  'comment_notes_after' => '',

  'fields' => apply_filters( 'comment_form_default_fields', $fields ),
);
comment_form($args); ?>

</div><!-- #comments -->
	<?php do_action( 'saraswathi_after_comments' ); ?>
