<?php
/**
 *
 * The template for displaying featured posts on the front page
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/frameworks/templates/default/content'
 *
 * @package Saraswathi Lite
 *
 * @since Saraswathi Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div id="article-<?php the_ID(); ?>" <?php saraswathi_content_class( array( 'featured' ) ); ?>>
     <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php saraswathi_article_tag_schema(); ?>>
				<?php saraswathi_summary(); ?>
      </article><!-- #post-## -->
</div>
