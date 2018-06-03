<?php
/**
 *prevalent About Theme
 *
 * @package Prevalent
 */

//about theme info
add_action( 'admin_menu', 'prevalent_abouttheme' );
function prevalent_abouttheme() {    	
	add_theme_page( __('About Theme Info', 'prevalent'), __('About Theme Info', 'prevalent'), 'edit_theme_options', 'prevalent_guide', 'prevalent_mostrar_guide');   
} 

//guidline for about theme
function prevalent_mostrar_guide() { 
?>
<div class="wrap-GT">
	<div class="gt-left">
   		   <div class="heading-gt">
			  <?php _e('About Theme Info', 'prevalent'); ?>
		   </div>
          <p><?php _e(' Prevalent is a Free Travel WordPress theme. It is Perfect for all Professional, Corporate,travel, restaurant and any type of business. It is user friendly customizer options and Compatible in wordPress Latest Version. also Compatible with WooCommerce, Nextgen gallery ,Contact Form 7 and many WordPress popular plugins.','prevalent'); ?></p>
<div class="heading-gt"> <?php _e('Theme Features', 'prevalent'); ?></div>
 

<div class="col-2">
  <h4><?php _e('Theme Customizer', 'prevalent'); ?></h4>
  <div class="description"><?php _e('The built-in customizer panel quickly change aspects of the design and display changes live before saving them.', 'prevalent'); ?></div>
</div>

<div class="col-2">
  <h4><?php _e('Responsive Ready', 'prevalent'); ?></h4>
  <div class="description"><?php _e('The themes layout will automatically adjust and fit on any screen resolution and looks great on any device. Fully optimized for iPhone and iPad.', 'prevalent'); ?></div>
</div>

<div class="col-2">
<h4><?php _e('Cross Browser Compatible', 'prevalent'); ?></h4>
<div class="description"><?php _e('Our themes are tested in all mordern web browsers and compatible with the latest version including Chrome,Firefox, Safari, Opera, IE11 and above.', 'prevalent'); ?></div>
</div>

<div class="col-2">
<h4><?php _e('E-commerce', 'prevalent'); ?></h4>
<div class="description"><?php _e('Fully compatible with WooCommerce plugin. Just install the plugin and turn your site into a full featured online shop and start selling products.', 'prevalent'); ?></div>
</div>

</div><!-- .gt-left -->
	
	<div class="gt-right">			
			<div style="font-weight:bold;">				
				<a href="<?php echo PREVALENT_LIVE_DEMO; ?>" target="_blank"><?php _e('Live Demo', 'prevalent'); ?></a> | 
				<a href="<?php echo PREVALENT_PROTHEME_URL; ?>"><?php _e('Purchase Pro', 'prevalent'); ?></a> | 
				<a href="<?php echo PREVALENT_THEME_DOC; ?>" target="_blank"><?php _e('Documentation', 'prevalent'); ?></a>
                <div style="height:5px"></div>
				<hr />  
                <ul>
                 <li><?php _e('Theme Customizer', 'prevalent'); ?></li>
                 <li><?php _e('Responsive Ready', 'prevalent'); ?></li>
                 <li><?php _e('Cross Browser Compatible', 'prevalent'); ?></li>
                 <li><?php _e('E-commerce', 'prevalent'); ?></li>
                 <li><?php _e('Contact Form 7 Plugin Compatible', 'prevalent'); ?></li>  
                 <li><?php _e('User Friendly', 'prevalent'); ?></li> 
                 <li><?php _e('Translation Ready', 'prevalent'); ?></li>
                 <li><?php _e('Many Other Plugins  Compatible', 'prevalent'); ?></li>   
                </ul>              
               
			</div>		
	</div><!-- .gt-right-->
    <div class="clear"></div>
</div><!-- .wrap-GT -->
<?php } ?>