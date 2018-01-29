<!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js ie ie7 lt-ie9 lt-ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="no-js ie ie8 lt-ie9" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html class="no-js" <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <?php $geral = get_option( 'geral' ); ?>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php if($geral['ico'] <> ''){ ?>
        <link href="<?php $ico = wp_get_attachment_image_src($geral['ico'], 'full'); echo $ico[0]; ?>" rel="shortcut icon" />    
        <?php } ?>
        <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/assets/js/html5.js"></script>
        <![endif]-->
        <?php wp_head(); ?>
        <link href='<?php echo get_template_directory_uri(); ?>/assets/css/conversion.css' rel='stylesheet' type='text/css'>
        
        <?php $captura = get_option( 'caixa_captura' ); ?>
        <style>
            .nav li a:hover{background: <?php echo $geral['cor_menu']; ?> !important}
            #header .dropdown-menu> li > a:hover{color: <?php echo $geral['cor_menu']; ?> !important}
            .captura{background: <?php echo $captura['cor_caixa']; ?> !important}
            .captura{background: <?php echo $captura['cor_caixa']; ?> !important}
            #submit-captura{background: <?php echo $captura['cor_botao_captura']; ?> !important}
        </style>
    </head>

    <body <?php body_class(); ?>>
        
        <div class="row margin-0">
            <header id="header" role="banner">
                <div class="container">
                <div class="col-md-4">
                    <div><a href="<?php bloginfo('url'); ?>">
                        <?php if ($geral['logo'] <> ''){ ?>
                            <img src="<?php $image = wp_get_attachment_image_src($geral['logo'], 'full'); echo $image[0]; ?>" title="" />
                        <?php }else{ ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" title="" />
                        <?php } ?>
                        </a></div>
                </div>
                <div class="col-md-8">
                    <nav id="main-navigation" class="navbar navbar-default" role="navigation">
                    <a class="assistive-text" href="#content" title="<?php esc_attr_e('Skip to content', 'odin'); ?>"><?php _e('Skip to content', 'odin'); ?></a>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-navigation">
                            <span class="sr-only"><?php _e('Toggle navigation', 'odin'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php /*

                          <a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

                         */ ?>
                    </div>

                    <div class="collapse navbar-collapse navbar-main-navigation">
                        <?php
                        wp_nav_menu(
                                array(
                                    'theme_location' => 'main-menu',
                                    'depth' => 2,
                                    'container' => false,
                                    'menu_class' => 'nav navbar-nav',
                                    'fallback_cb' => 'Odin_Bootstrap_Nav_Walker::fallback',
                                    'walker' => new Odin_Bootstrap_Nav_Walker()
                                )
                        );
                        ?>

                        
                    </div><!-- .navbar-collapse -->
                </nav><!-- #main-menu -->
                </div>
                        
                </div>
                
            </header><!-- #header -->
        </div>

            <div id="main" class="site-main row margin-0">
