<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
    <?php /* MAIN STUFF  */ ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset') ?>" />
    <meta name="robots" content="NOODP, INDEX, FOLLOW" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="dns-prefetch" href="//facebook.com" crossorigin />
    <link rel="dns-prefetch" href="//connect.facebook.net" crossorigin />
    <link rel="dns-prefetch" href="//ajax.googleapis.com" crossorigin />
    <link rel="dns-prefetch" href="//google-analytics.com" crossorigin />
    <?php /* FAVICONS */ ?>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" />
    <?php /* THEME NAVBAR COLOR */ ?>
    <meta name="msapplication-TileColor" content="#454545" />
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/images/win8-tile-icon.png" />
    <meta name="theme-color" content="#454545" />
    <meta name="language" content="<?php echo get_bloginfo('language'); ?>" />
    <?php wp_title('|', false, 'right'); ?>
    <?php wp_head() ?>
    <?php /* OPEN GRAPHS INFO - COMMENTS SCRIPTS */ ?>
    <?php if (is_single('post') && get_option('thread_comments')) wp_enqueue_script('comment-reply'); ?>
    <?php /* IE COMPATIBILITIES */ ?>
    <!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7" /><![endif]-->
    <!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8" /><![endif]-->
    <!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9" /><![endif]-->
    <!--[if gt IE 8]><!-->
    <html <?php language_attributes(); ?> class="no-js" />
    <!--<![endif]-->
    <!--[if IE]> <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script> <![endif]-->
    <!--[if IE]> <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script> <![endif]-->
    <!--[if IE]> <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" /> <![endif]-->
    

</head>

<body class="the-main-body <?php echo join(' ', get_body_class()); ?>" itemscope itemtype="http://schema.org/WebPage">
    <div id="fb-root"></div>
    <?php wp_body_open(); ?>
    <header class="container-fluid p-0" role="banner" itemscope itemtype="http://schema.org/WPHeader">
        <div class="row no-gutters">
            <?php if (is_front_page()) {
                $class = 'header-home';
            } else {
                $class = 'header-internal';
            } ?>
            <div class="the-header d-none d-sm-none d-xl-block d-lg-block d-md-none col-xl-12 col-lg-12 col-md-12 <?php echo $class; ?>">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-center no-gutters">
                        <div class="the-navbar col-xl-11 col-lg-11 col-md-11 col-sm-12 col-12">
                            <nav class="navbar navbar-expand-md bg-light" role="navigation">
                                <a class="navbar-brand" href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo('name'); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>" class="img-fluid img-navbar-logo" />
                                </a>
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <?php
                                    wp_nav_menu(array(
                                        'theme_location'    => 'header_menu',
                                        'depth'             => 1, // 1 = with dropdowns, 0 = no dropdowns.
                                        'container'         => 'ul',
                                        'menu_class'        => 'navbar-nav ml-auto mr-auto',
                                    ));
                                    ?>
                                    <?php if (is_user_logged_in()) { ?>
                                        <?php $myaccount_page_id = get_option('streann_myaccount_page_id'); ?>
                                        <?php if ($myaccount_page_id) {
                                            $myaccount_page_url = get_permalink($myaccount_page_id);
                                        } ?>
                                        <a class="btn btn-outline-primary btn-login-navbar my-2 my-sm-0" href="<?php echo $myaccount_page_url; ?>" title="<?php _e('Ir a Mi Cuenta', 'streannuniv'); ?>">
                                            <?php _e('Mi Cuenta', 'streannuniv'); ?>
                                        </a>
                                    <?php } else { ?>
                                        <button class="btn btn-outline-primary btn-login-navbar my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal">
                                            <?php _e('Iniciar Sesión', 'streannuniv'); ?>
                                        </button>
                                    <?php } ?>
                                </div>

                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-mobile col-12 col-sm-12 d-flex d-sm-flex d-md-flex d-lg-none d-xl-none">
                <div class="row">
                    <nav class="the-navbar-mobile col-12" role="navigation">
                        <div id="menu-btn-mobile" class="menu-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <a class="navbar-brand" href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo('name'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>" class="img-fluid img-brand" />
                        </a>
                        <div class="navbar-search-icon">
                            <a id="search_opener"><i class="fa fa-search"></i></a>
                        </div>
                    </nav>
                </div>
                <div class="navbar-mobile-collapse navbar-mobile-collapse-hidden" id="navbarSupportedContent">
                    <div class="menu-menubar-container col-12">
                        <?php
                        wp_nav_menu(array(
                            'theme_location'    => 'header_menu',
                            'depth'             => 1, // 1 = with dropdowns, 0 = no dropdowns.
                            'container'         => 'ul',
                        ));
                        ?>
                    </div>
                    <div class="social-menubar-container col-12">
                        <a href="<?php echo get_option('streannuniv_fb'); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="<?php echo get_option('streannuniv_tw'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="<?php echo get_option('streannuniv_ig'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a href="<?php echo get_option('streannuniv_yt'); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>