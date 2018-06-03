<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Publisherly
 */

?>


<footer id="colophon" class="site-footer" role="contentinfo">

	<div class="footer-wrapper">

	    <?php
	    // Show widget
	    if ( is_active_sidebar( 'publisherly-footer-widget-1' ) ) { ?>

	      <div class="footer-column">

	        <div class="column-wrapper">

	          <?php dynamic_sidebar('publisherly-footer-widget-1'); ?>

	        </div>
	      
	      </div>

	    <?php
	    }
	    ?>

	    <?php
	    // Show widget
	    if ( is_active_sidebar( 'publisherly-footer-widget-2' ) ) { ?>

	      <div class="footer-column">

	        <div class="column-wrapper">

	          <?php dynamic_sidebar('publisherly-footer-widget-2'); ?>

	        </div>
	      
	      </div>

	    <?php
	    }
	    ?>

	    <?php
	    // Show widget
	    if ( is_active_sidebar( 'publisherly-footer-widget-3' ) ) { ?>

	      <div class="footer-column">

	        <div class="column-wrapper">

	          <?php dynamic_sidebar('publisherly-footer-widget-3'); ?>

	        </div>
	      
	      </div>

	    <?php
	    }
	    ?>

	    <?php
	    // Show widget
	    if ( is_active_sidebar( 'publisherly-footer-widget-4' ) ) { ?>

	      <div class="footer-column">

	        <div class="column-wrapper">

	          <?php dynamic_sidebar('publisherly-footer-widget-4'); ?>

	        </div>
	      
	      </div>

	    <?php
	    }
	    ?>

	</div><!-- /footer-wrapper -->

</footer>
<!-- /footer -->

<div class="copyright">

    <div class="copyright-wrapper">

     	<div class="copyright-text">

			<?php echo wp_kses_post( get_theme_mod( 'publisherly_copyright_text', sprintf( esc_html__( 'Copyright 2017 - All rights reserved', 'publisherly' ) ) ) ); ?>

     	</div>

     	<div class="design-by">

     	<?php
     		/* translators: %s: designer name link. */
			echo wp_kses_post( get_theme_mod( 'publisherly_design_by', sprintf( esc_html__( 'Publisherly Theme made by %s', 'publisherly' ), '<a href="https://mightywp.com/themes/publisherly/" rel="designer">Mighty WP</a>' ) ) ); ?>

     	</div>

    </div>

</div>
<!-- /copyright -->


<?php wp_footer(); ?>

</body>
</html>
