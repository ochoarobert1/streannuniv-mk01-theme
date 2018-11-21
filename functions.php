<?php
/* --------------------------------------------------------------
/* THEME ACTIVATION HOOK
-------------------------------------------------------------- */
function streann_activation_callback() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE `{$wpdb->prefix}user_video` (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  user_id mediumint(9) NOT NULL,
  last_video mediumint(9) NOT NULL,
  last_quiz mediumint(9) NOT NULL,
  level_access mediumint(9) NOT NULL,
  certificate_access boolean NOT NULL default 0,
  PRIMARY KEY  (id)
) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    flush_rewrite_rules();
}

add_action('after_switch_theme', 'streann_activation_callback', 10 , 2);
/* --------------------------------------------------------------
    ENQUEUE AND REGISTER CSS
-------------------------------------------------------------- */

require_once('includes/wp_enqueue_styles.php');

/* --------------------------------------------------------------
    ENQUEUE AND REGISTER JS
-------------------------------------------------------------- */

if (!is_admin()) add_action('wp_enqueue_scripts', 'my_jquery_enqueue');
function my_jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
    if ($_SERVER['REMOTE_ADDR'] == '::1') {
        /*- JQUERY ON LOCAL  -*/
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '3.3.1', false);
        /*- JQUERY MIGRATE ON LOCAL  -*/
        wp_register_script( 'jquery-migrate', get_template_directory_uri() . '/js/jquery-migrate.min.js',  array('jquery'), '3.0.1', false);
    } else {
        /*- JQUERY ON WEB  -*/
        wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, '3.3.1', false);
        /*- JQUERY MIGRATE ON WEB  -*/
        wp_register_script( 'jquery-migrate', 'https://code.jquery.com/jquery-migrate-3.0.1.min.js', array('jquery'), '3.0.1', true);
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-migrate');
}

/* NOW ALL THE JS FILES */
require_once('includes/wp_enqueue_scripts.php');

/* --------------------------------------------------------------
    ADD CUSTOM WALKER BOOTSTRAP
-------------------------------------------------------------- */

// WALKER COMPLETO TOMADO DESDE EL NAVBAR COLLAPSE
require_once('includes/class-wp-bootstrap-navwalker.php');

/* --------------------------------------------------------------
    ADD CUSTOM WORDPRESS FUNCTIONS
-------------------------------------------------------------- */

require_once('includes/wp_custom_functions.php');

/* --------------------------------------------------------------
    ADD REQUIRED WORDPRESS PLUGINS
-------------------------------------------------------------- */

require_once('includes/class-tgm-plugin-activation.php');
require_once('includes/class-required-plugins.php');

/* --------------------------------------------------------------
    ADD CUSTOM WOOCOMMERCE OVERRIDES
-------------------------------------------------------------- */

//require_once('includes/wp_woocommerce_functions.php');

/* --------------------------------------------------------------
    ADD THEME SUPPORT
-------------------------------------------------------------- */

load_theme_textdomain( 'streannuniv', get_template_directory() . '/languages' );
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ));
add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form' ) );
add_theme_support( 'custom-background',
                  array(
                      'default-image' => '',    // background image default
                      'default-color' => '',    // background color default (dont add the #)
                      'wp-head-callback' => '_custom_background_cb',
                      'admin-head-callback' => '',
                      'admin-preview-callback' => ''
                  )
                 );

/* --------------------------------------------------------------
    ADD NAV MENUS LOCATIONS
-------------------------------------------------------------- */

register_nav_menus( array(
    'header_menu' => __( 'Menu Header - Principal', 'streannuniv' ),
    'footer_menu' => __( 'Menu Footer - Principal', 'streannuniv' ),
) );

/* --------------------------------------------------------------
    ADD DYNAMIC SIDEBAR SUPPORT
-------------------------------------------------------------- */

add_action( 'widgets_init', 'streannuniv_widgets_init' );
function streannuniv_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar Principal', 'streannuniv' ),
        'id' => 'main_sidebar',
        'description' => __( 'Estos widgets seran vistos en las entradas y páginas del sitio', 'streannuniv' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

    register_sidebars( 4, array(
        'name'          => __('Pie de Pagina %d', 'streannuniv'),
        'id'            => 'sidebar_footer',
        'description'   => __('Sección de Pie de Pagina', 'streannuniv'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>'
    ) );
}

/* --------------------------------------------------------------
    CUSTOM ADMIN LOGIN
-------------------------------------------------------------- */

function custom_admin_styles() {
    $version_remove = NULL;
    wp_register_style('wp-admin-style', get_template_directory_uri() . '/css/custom-wordpress-admin-style.css', false, $version_remove, 'all');
    wp_enqueue_style('wp-admin-style');
}
add_action('login_head', 'custom_admin_styles');
add_action('admin_init', 'custom_admin_styles');


function dashboard_footer() {
    echo '<span id="footer-thankyou">';
    _e ('Gracias por crear con ', 'streannuniv' );
    echo '<a href="http://wordpress.org/" target="_blank">WordPress.</a> - ';
    _e ('Tema desarrollado por ', 'streannuniv' );
    echo '<a href="http://robertochoa.com.ve/?utm_source=footer_admin&utm_medium=link&utm_content=streannuniv" target="_blank">Robert Ochoa</a></span>';
}
add_filter('admin_footer_text', 'dashboard_footer');

/* --------------------------------------------------------------
    ADD CUSTOM METABOX
-------------------------------------------------------------- */

require_once('includes/wp_custom_metabox.php');

/* --------------------------------------------------------------
    ADD CUSTOM POST TYPE
-------------------------------------------------------------- */

require_once('includes/wp_custom_post_type.php');

/* --------------------------------------------------------------
    ADD CUSTOM THEME CONTROLS
-------------------------------------------------------------- */

require_once('includes/wp_custom_theme_control.php');

/* --------------------------------------------------------------
    ADD CUSTOM JS COMPOSER COMPONENTS
-------------------------------------------------------------- */

require_once('includes/wp_jscomposer_extended.php');

/* --------------------------------------------------------------
    ADD CUSTOM IMAGE SIZE
-------------------------------------------------------------- */
if ( function_exists('add_theme_support') ) {
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size( 9999, 400, true);
}
if ( function_exists('add_image_size') ) {
    add_image_size('avatar', 100, 100, true);
    add_image_size('blog_img', 276, 217, true);
    add_image_size('single_img', 636, 297, true );
}

/* --------------------------------------------------------------
/* CHANGE EMAIL SENDER NAME AND EMAIL
-------------------------------------------------------------- */
function wpb_sender_email( $original_email_address ) {
    return 'streann@edu.streann.com';
}

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
    return 'Streann University';
}

// Hooking up our functions to WordPress filters
add_filter( 'wp_mail_from', 'wpb_sender_email' );
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

/* ----------------------------------------------------------- */
/* LOGIN USER
-------------------------------------------------------------- */
function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=> '<strong>' . __('Error:', 'streannuniv') . '</strong> ' . __('Correo electrónico o contraseña incorrecta.', 'streannuniv')));
    } else {
        echo json_encode(array('loggedin'=>true, 'url' => wp_get_referer(), 'message'=> '<strong>' . __('Éxito:', 'streannuniv') . '</strong> ' . __('Bienvenido, iniciando su sesión.', 'streannuniv')));
    }

    die();
}

add_action('wp_ajax_nopriv_ajaxlogin', 'ajax_login' );

/* ----------------------------------------------------------- */
/* LOGIN PAGE USER
-------------------------------------------------------------- */
function ajax_page_login(){

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=> '<strong>' . __('Error:', 'streannuniv') . '</strong> ' . __('Correo electrónico o contraseña incorrecta.', 'streannuniv')));
    } else {
        echo json_encode(array('loggedin'=>true, 'url' => wp_get_referer(), 'message'=> '<strong>' . __('Éxito:', 'streannuniv') . '</strong> ' . __('Bienvenido, iniciando su sesión.', 'streannuniv')));
    }

    die();
}

add_action('wp_ajax_nopriv_ajaxpagelogin', 'ajax_page_login' );

/* --------------------------------------------------------------
    VIMEO CUSTOM FETCHER
-------------------------------------------------------------- */
function streann_vimeo_fetch($link) {
    /* REMOVER PROTOCOLO HTTPS:// */
    $link_protocol = trim($link, 'https://');
    /* SEPARAMOS EL LINK EN PEDAZOS EN ARRAY */
    $link_array = explode('/', $link_protocol, 3);
    /* DEVUELVO EL ID DEL VIDEO */
    return $link_array[1];

}

/* ----------------------------------------------------------- */
/* USER DATA UPDATER
-------------------------------------------------------------- */
function ajax_user_data_updater () {

    // Nonce is checked, get the POST data and sign user on
    $info = array();

    $user_id = $_POST['user_id'];

    if (isset($_POST['first_name'])) {
        update_user_meta($user_id, 'first_name', $_POST['first_name']);
    }

    if (isset($_POST['last_name'])) {
        update_user_meta($user_id, 'last_name', $_POST['last_name']);
    }

    if (isset($_POST['business'])) {
        update_user_meta($user_id, 'business', $_POST['business']);
    }

    echo json_encode(array('message'=> '<strong>' . __('Éxito:', 'streannuniv') . '</strong> ' . __('Los datos han sido actualizados.', 'streannuniv')));

    die();
}

add_action('wp_ajax_user_data_ajax', 'ajax_user_data_updater');

/* ----------------------------------------------------------- */
/* USER SOCIAL UPDATER
-------------------------------------------------------------- */
function ajax_user_social_updater () {

    check_ajax_referer('social-data-nonce', 'social-data-security');
    // Nonce is checked, get the POST data and sign user on
    $info = array();

    $user_id = $_POST['user_id'];

    if (isset($_POST['facebook_user'])) {
        update_user_meta($user_id, 'facebook_user', $_POST['facebook_user']);
    }

    if (isset($_POST['twitter_user'])) {
        update_user_meta($user_id, 'twitter_user', $_POST['twitter_user']);
    }

    if (isset($_POST['instagram_user'])) {
        update_user_meta($user_id, 'instagram_user', $_POST['instagram_user']);
    }

    echo json_encode(array('message'=> '<strong>' . __('Éxito:', 'streannuniv') . '</strong> ' . __('Los datos han sido actualizados.', 'streannuniv')));

    die();
}

add_action('wp_ajax_social_data_ajax', 'ajax_user_social_updater');
