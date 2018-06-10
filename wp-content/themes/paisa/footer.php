<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Paisa
 */

?>
		</div><!-- .container -->
	</div><!-- #content -->


	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
		<?php do_action( 'paisa_footer' ); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
<script>
    // @todo put this is correct place
  (function($) {
    var height = window.innerHeight;
    $(window).scroll(function () {
      var scroll = $(window).scrollTop();
      if ((scroll + height*0.1) > height) {
        $('.site-header').addClass('opaque-title');
      } else {
        $('.site-header').removeClass('opaque-title');
      }
      if ((scroll + height*0.25) > height) {
        $('.site-header').addClass('opaque-menu');
      } else {
        $('.site-header').removeClass('opaque-menu');
      }
    });
  })(jQuery);
</script>
</html>
