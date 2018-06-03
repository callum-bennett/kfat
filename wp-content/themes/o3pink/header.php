<?php

/**

 * The template for displaying the header

 *

 * Displays all of the head element and everything up until the "site-content" div.

 *

 * @package WordPress

 * @subpackage o3pink

 * @since o3pink 1.0

 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">

<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta name="viewport" content="width=device-width">

	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>

</head>


<body <?php body_class(); ?>>
 <div class="header">
    <div class=" container">
				<button class="secondary-toggle"><?php _e( 'Menu and widgets', 'o3pink' ); ?></button>
        <?php $header_image = esc_url(get_header_image());?>
       	 <?php if(!empty($header_image)){?>
		 	<img src="<?php echo esc_url($header_image);?>" class="header_image_size" alt="<?php echo( get_bloginfo( 'title' ) ); ?>">
	    	<?php }?>
   			<div class="site-branding">
   		      <div class="without_head_img_22">
                 <?php o3pink_the_custom_logo();?>
               </div>
		      <div id="content" class="without_head_img_33">
				<h1 class="site_titles">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
                    </a></h1>
                <h3 class="site-descriptions"><?php bloginfo('description'); ?></h3>
                
              </div>
			</div>
            
			 <div class="menu">
   				<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) ) : ?>
                
                	<?php if ( has_nav_menu( 'primary' ) ) : ?>
  					  
					  <?php wp_nav_menu( array('theme_location' => 'primary','menu' => 'main-menu', 'items_wrap' => '<ul class="mega-menu">%3$s</ul>' )); ?>
                      
                	<?php endif; ?>
                    <?php if ( has_nav_menu( 'social' ) ) : ?>
                    	
						<?php wp_nav_menu( array('theme_location' => 'social','menu' => 'main-menu', 'items_wrap' => '<ul class="mega-menu">%3$s</ul>' )); ?>
                        
                	<?php endif; ?>
				<?php endif; ?>
                
    		</div>
    <div class="clear"></div>
    </div>
 </div>
 <?php $banner_img = esc_url(get_option('o3pink_banner'));
		if(!empty($banner_img)):?>
  <img src="<?php echo esc_url(get_option('o3pink_banner'));?>" width="100%" height="500px" >
<?php  endif;?>
	<div id="content" class="site-content">
