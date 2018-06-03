<?php

/**

 * The template for displaying the footer

 *

 * Contains the closing of the "site-content" div and all content after.

 *

 * @package WordPress

 * @subpackage o3pink

 * @since o3pink 1.0

 */

?>

</div>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="site-info">
            <a href="<?php echo esc_url( __( 'http://www.o3magazine.com/', 'o3pink' ) ); ?>"><?php printf( __( 'Theme by %s team', 'o3pink' ), ' o3magazine ' ); ?></a>

		</div> 
	</footer>

<?php wp_footer(); ?>

</body>

</html>

