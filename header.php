<!DOCTYPE html>
<html <?php language_attributes() ?>>
    <head>
        <?php /* MAIN STUFF */ ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset') ?>" />
        <meta name="robots" content="NOODP, INDEX, FOLLOW" />
        <meta name="HandheldFriendly" content="True" />
        <meta name="MobileOptimized" content="320" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="dns-prefetch" href="//connect.facebook.net" />
        <link rel="dns-prefetch" href="//facebook.com" />
        <link rel="dns-prefetch" href="//googleads.g.doubleclick.net" />
        <link rel="dns-prefetch" href="//pagead2.googlesyndication.com" />
        <link rel="dns-prefetch" href="//google-analytics.com" />
        <?php /* FAVICONS */ ?>
        <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon">
        <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png" />
        <?php /* THEME NAVBAR COLOR */ ?>
        <meta name="msapplication-TileColor" content="#EE8706" />
        <meta name="theme-color" content="#EE8706" />
        <?php /* AUTHOR INFORMATION */ ?>
        <meta name="language" content="<?php echo get_bloginfo('language'); ?>" />
        <meta name="author" content="ADMIN_SITIO" />
        <meta name="copyright" content="DIRECCION_URL" />
        <meta name="geo.position" content="10.333333;-67.033333" />
        <meta name="ICBM" content="10.333333, -67.033333" />
        <meta name="geo.region" content="VE" />
        <meta name="geo.placename" content="DIRECCION_AUTOR" />
        <meta name="DC.title" content="<?php if (is_home()) { echo get_bloginfo('name') . ' | ' . get_bloginfo('description'); } else { echo get_the_title() . ' | ' . get_bloginfo('name'); } ?>" />
        <?php /* MAIN TITLE - CALL HEADER MAIN FUNCTIONS */ ?>
        <?php wp_title('|', false, 'right'); ?>
        <?php wp_head() ?>
        <?php /* OPEN GRAPHS INFO - COMMENTS SCRIPTS */ ?>
        <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
        <?php /* IE COMPATIBILITIES */ ?>
        <!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7" /><![endif]-->
        <!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8" /><![endif]-->
        <!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9" /><![endif]-->
        <!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js" /><!--<![endif]-->
        <!--[if IE]> <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script> <![endif]-->
        <!--[if IE]> <script type="text/javascript" src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script> <![endif]-->
        <!--[if IE]> <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" /> <![endif]-->
        <?php get_template_part('includes/fb-script'); ?>
        <?php get_template_part('includes/ga-script'); ?>
    </head>
    <body class="the-main-body <?php echo join(' ', get_body_class()); ?>" itemscope itemtype="http://schema.org/WebPage">
        <div id="fb-root"></div>
        <header class="container-fluid p-0" role="banner" itemscope itemtype="http://schema.org/WPHeader">
            <div class="row no-gutters">
                <div class="the-header col-12">
                    <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
                        <a class="navbar-brand" href="<?php echo home_url('/');?>" title="<?php echo get_bloginfo('name'); ?>">Navbar</a>
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'header_menu',
                            'depth'             => 1, // 1 = with dropdowns, 0 = no dropdowns.
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse',
                            'container_id'      => 'bs-example-navbar-collapse-1',
                            'menu_class'        => 'navbar-nav mr-auto',
                            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                            'walker'            => new WP_Bootstrap_Navwalker()
                        ) );
                        ?>

                    </nav>
                </div>
            </div>
        </header>
