<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
    <div class="preloader"><span class="preloader-gif" style=""></span></div>
	<header>
        <div class="header-top header-static">
            <div class="container">
                <!-- Menu -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                    	<div class="logoSite logo-light <?php echo esc_attr(get_theme_mod('romana_logo_position','pull-left')); ?>">
                            <?php if(has_custom_logo()){
                                the_custom_logo();
                            } ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="brandText"><span class="brandText"><h4><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4><small><?php echo esc_html( get_bloginfo( 'description' ) ); ?></small></span></a>
                        </div>
                        <div class="logoSite logo-dark <?php echo esc_attr(get_theme_mod('romana_logo_position','pull-left')); ?>">
                            <?php if(get_theme_mod('romana_upload_drk_logo') != ''){ ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" >
                                    <img src="<?php echo esc_url(get_theme_mod('romana_upload_drk_logo')); ?>" class="img-responsive custom-logo">
                                </a>
                            <?php }
                            elseif(has_custom_logo()){
                                the_custom_logo();
                            } ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="brandText"><span class="brandText"><h4><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h4><small><?php echo esc_html( get_bloginfo( 'description' ) ); ?></small></span></a>
                        </div>
                        <div class="main-menu <?php if(get_theme_mod('romana_logo_position') == 'pull-left' || get_theme_mod('romana_logo_position') == '') { echo 'pull-right'; } else { echo 'pull-left'; } ?>">
                            <!-- Responsive Menu -->
                            <nav id='cssmenu'>
                                <div id="box-top-mobile"></div>
                                <div class="button"></div>
                                <?php $romana_defaults = array(
                                    'theme_location' => 'primary',
                                    'container' => 'ul',
                                    'items_wrap' => '<ul class="offside">%3$s</ul>',
                                );
                                wp_nav_menu($romana_defaults); ?>
                            </nav>
                            <!-- Responsive Menu End -->
                        </div>
                    </div>
                </div>
                <!-- Menu End -->
            </div>
        </div>
    </header>