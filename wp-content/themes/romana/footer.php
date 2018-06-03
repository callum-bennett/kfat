<footer>
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
	                <?php for ($romana_i=1; $romana_i <= 6; $romana_i++):
	                if(is_active_sidebar('footer-'.$romana_i)): ?>
	                	<div class="col-md-<?php echo esc_attr(get_theme_mod('romana_footer_layout','3')); ?> col-xs-12 <?php echo $romana_i ?>">
	                		<?php dynamic_sidebar('footer-'.$romana_i); ?>
	                	</div>
	                <?php endif;
	                endfor; ?>
            	</div>   
            </div>
        </div>
        <div class="copyrights_sec">
            <div class="col-md-12">
                <p class="text-center">
                    <?php $romana_copyrights = get_theme_mod('romana_footer_copyrights');
                      if($romana_copyrights){  
                        echo wp_kses_post(get_theme_mod('romana_footer_copyrights')).'<br>';  
                      }  ?>
                    <?php esc_html_e('Powered By ','romana'); ?>
                    <a href="<?php echo esc_url('https://indigothemes.com/products/romana-wordpress-theme/'); ?>" target="_blank"><?php esc_html_e('Romana WordPress Theme','romana'); ?></a>
                </p>
            </div> 
        </div>
    </div>
</footer>
<?php wp_footer(); ?>