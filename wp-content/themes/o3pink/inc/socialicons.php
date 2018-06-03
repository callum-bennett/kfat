<?php

/**
 * Social Navigation Menu 
 */

/**
 * Register Social Icon menu
 */
add_action( 'init', 'o3pink_register_social_menu' );

function o3pink_register_social_menu() {
	register_nav_menu( 'social-menu', _x( 'Social Menu', 'nav menu location', 'o3pink' ) );
}

if ( ! function_exists( 'o3pink_social_icons' ) ) :
/**
 * Display social links in footer and widgets
 *
 * @package o3pink
 */
function o3pink_social_icons(){
  if ( has_nav_menu( 'social-menu' ) ) {
  	wp_nav_menu(
  		array(
  			'theme_location'  => 'social-menu',
  			'container'       => 'nav',
  			'container_id'    => 'social',
  			'container_class' => 'social-icons',
  			'menu_id'         => 'menu-social-items',
  			'menu_class'      => 'social-menu',
  			'depth'           => 1,
  			'fallback_cb'     => '',
                        'link_before'     => '<i class="social_icon fa"><span>',
                        'link_after'      => '</span></i>'
  		)
	  );
  }
}
endif;