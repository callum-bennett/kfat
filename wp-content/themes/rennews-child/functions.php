<?php
	
/**
 * rennews-child functions and definitions
 **/


add_action( 'wp_enqueue_scripts', 'rennews_enqueue_styles' );
function rennews_enqueue_styles() {
		wp_enqueue_style( 'rennews-style', get_template_directory_uri() . '/style.css' );
}

require_once(get_stylesheet_directory() . '/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'rennews_child_register_required_plugins' );
function rennews_child_register_required_plugins() {
	
		$plugins = array(
			array(
	 
				'name'      => 'WP Product Review',
	 
				'slug'      => 'wp-product-review',
	 
				'required'  => false
	 
			),
			
			
			array(
	 
				'name'      => 'Revive Old Post (Former Tweet Old Post)',
	 
				'slug'      => 'tweet-old-post',
	 
				'required'  => false
	 
			)		
			
		);
		
				
	
	$config = array(
        'default_path' => '',                      
        'menu'         => 'tgmpa-install-plugins', 
        'has_notices'  => true,                   
        'dismissable'  => true,                  
        'dismiss_msg'  => '',                   
        'is_automatic' => false,                 
        'message'      => '',     
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'rennews-child' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'rennews-child' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'rennews-child' ), 
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'rennews-child' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'rennews-child' ),
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'rennews-child' ),
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'rennews-child' ),
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'rennews-child' ),
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'rennews-child' ),
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'rennews-child' ), 
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'rennews-child' ), 
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'rennews-child' ), 
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'rennews-child' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'rennews-child' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'rennews-child' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'rennews-child' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'rennews-child' ), 
            'nag_type'                        => 'updated'
        )
    );
 
	tgmpa( $plugins, $config );	
}