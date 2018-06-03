<?php
/**
 * Functions that provide extra features apart from core theme.
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/extras'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite


 * ****************************
 *	Table of Contents
 *
 *	1.0	-	Class Attribute
 *	2.0	-	Schema.org Attribute
 *	3.0	-	Miscellaneous
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
*	1.0	-	Class Attribute
*/

if ( ! function_exists( 'saraswathi_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function saraswathi_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}

		if (	saraswathi_get_theme_mod( 'saras_enable_site_animation', 1 )	) {
			$classes[] = 'saras-animate';
		}

		return $classes;
	}

	add_filter( 'body_class', 'saraswathi_body_classes' );

endif;

/**
*	2.0	-	Schema.org Attribute
*/


if ( ! function_exists( 'saraswathi_tags_list_keywords' ) ) :
	/**
	 * Add itemprop to tag links
	 *
	 * @param string $links Termlist links.
	 */
	function saraswathi_tags_list_keywords($links) {

		$links = str_replace( '<a ','<a itemprop="keywords" ',	$links );
	}

	add_filter( 'term_links-$taxonomy', 'saraswathi_tags_list_keywords', 999, 1 );

endif;



if ( ! function_exists( 'saraswathi_itemprop_discussion_url' ) ) :
	/**
	 * Add itemprop to discussion url
	 *
	 * @param attribute $attr attributes ued on discussion url.
	 */
	function saraswathi_itemprop_discussion_url( $attr ) {

		$attr	.= ' itemprop="discussionUrl" rel="nofollow"';
		return $attr;
	}

	add_filter( 'comments_popup_link_attributes', 'saraswathi_itemprop_discussion_url' );

endif;


/**
*	3.0	-	Miscellaneous
*/


if ( ! function_exists( 'saraswathi_video_container' ) ) :
	/**
	 * Wrap Oembed in a container
	 *
	 * @param iframe $html oEmbed Iframe before wrapping it in DIV.
	 */
	function saraswathi_video_container($html) {

		return '<div class="video-wrapper">' . $html . '</div>';
	}

	add_filter( 'embed_oembed_html', 'saraswathi_video_container', 999, 1 );

endif;

add_filter( 'widget_tag_cloud_args', 'saraswathi_tag_cloud_font_size' );
/**
 * Change default font size for tag cloud
 *
 * @param array $args array of arguments for the tag widget filter.
 */
function saraswathi_tag_cloud_font_size ( $args ){
	
	$args['smallest'] = 9;
	$args['largest'] = 11;	
	return $args;
}


/**
* Register meta box(es).
*/
function saraswathi_register_meta_boxes() {
    add_meta_box( 'saras-page-meta-box', __( 'Saraswathi Options', 'saraswathi-lite' ), 'saraswathi_meta_display_callback','page', 'side','high' );
	
}
add_action( 'add_meta_boxes', 'saraswathi_register_meta_boxes' );
 

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function saraswathi_meta_display_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field('saras_meta_box','saras_meta_box_nonce' );

	// Check if its a post.
	if ( isset( $post->post_type ) && 'page' == $post->post_type ) {
		
		/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$sarasMeta = (int) get_post_meta($post->ID, 'saras_hide_title', true );
	$hideTitle = isset( $sarasMeta ) ? $sarasMeta : 0;

?>
		<div id="postMeta"><ul><li><h3><?php echo __('Hide Title!', 'saraswathi-lite')?></h3>
			<?php echo __('This will hide page title from display', 'saraswathi-lite')?></li><li><br>	
			<div class="fpswitch">
				<input type="checkbox" name="hidetitle" class="fpswitch-checkbox" id="hidetitle" value="1"<?php checked( $hideTitle, 1 ); ?> />		
    		<label class="fpswitch-label" for="hidetitle">
					<span class="fpswitch-slider"></span>
					<span class="fpswitch-switch"></span>
    		</label>
			</div>
			</li></ul>
		</div>

	<?php
	}
}
 
/**
 * Save post metadata when a post is saved.
 *
 * @param int $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 */
function saraswathi_page_save_meta_box( $post_id, $post, $update ) {
    // Save logic goes here. Don't forget to include nonce checks!
		// Check if our nonce is set.
	if ( ! isset( $_POST['saras_meta_box_nonce'] ) ) {
		return;
	}
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( isset($_POST['hidetitle']) ) {
	
			// Check the user's permissions.
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		
			/* OK, its safe for us to save the data now. 
		 Update the meta field in the database. */
			update_post_meta( $post_id, 'saras_hide_title', 1 );
	} 
	else {		
			/* OK, its safe for us to save the data now. 
		 Update the meta field in the database. */
			delete_post_meta( $post_id, 'saras_hide_title' );
	}
}
add_action( 'save_post', 'saraswathi_page_save_meta_box', 10, 3 );


