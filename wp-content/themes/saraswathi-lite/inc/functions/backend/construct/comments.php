<?php
/*
* Builds the comments HTML.
*
* located in local directory '/wp-content/themes/saraswathi/inc/functions/backend/construct/'
*
* @since Saraswathi Lite 1.0.0
*
* @package Saraswathi Lite
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Output a single comment.
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @see wp_list_comments()
 *
 * @param object $comment Comment to display.
 * @param int    $depth   Depth of comment.
 * @param array  $args    An array of arguments.
 */
function saraswathi_comment($comment, $args, $depth) {
	
	extract( $args, EXTR_SKIP );

	if ( 'div' === $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' !== $args['style'] ) : ?>
	<article id="div-comment-<?php comment_ID() ?>" class="comment-body" itemprop="comment">
	<?php endif; ?>
        <div class="comment-info muted">
            <div class="comment-author vcard">
                <?php if ( 0 !== $args['avatar_size']	) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
                <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>','saraswathi-lite' ), get_comment_author_link() ); ?>
            </div>
            <div class="comment-meta commentmetadata">
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php
					/**
					 * translators: 1: date, 2: time
					 */
					printf( '%1$s', get_comment_date( 'j M Y' ) ); ?></a><?php edit_comment_link( __( '(Edit)','saraswathi-lite' ), '  ', '' );
				?>
            </div>
        </div>
        <div class="comment-text">
            <?php if ( 0 === $comment->comment_approved ) : ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','saraswathi-lite' ); ?></em>
            <br />
            <?php endif; ?>

            <?php comment_text(); // Core function to get comment content. ?>
        </div>
    <div class="reply">
	<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); // Threaded comments. ?>
    </div>
	<?php if ( 'div' != $args['style'] ) : ?>
    </article>
	<?php endif; ?>
<?php
}
