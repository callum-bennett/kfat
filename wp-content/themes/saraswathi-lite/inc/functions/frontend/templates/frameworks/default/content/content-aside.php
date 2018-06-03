<?php
/**
 * The template for displaying posts in the Aside post format
 *
 * Located in local directory '/wp-content/themes/saraswathi/inc/functions/frontend/templates/frameworks/templates/default/content'
 *
 * @since Saraswathi Lite 1.0.0
 *
 * @package Saraswathi Lite
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div id="article-<?php the_ID(); ?>" <?php saraswathi_content_class(); ?>>
     <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php saraswathi_article_tag_schema(); ?>>
				<?php saraswathi_summary(); ?>
      </article><!-- #post-## -->
</div>
