<?php
/* --------------------------------------------------------------
CUSTOM AREA FOR OPTIONS DATA - streannuniv
-------------------------------------------------------------- */

/* CUSTOM MENU PAGE AND FUNCTIONS IN ADMIN */
function register_streannuniv_settings() {
    //register our settings
    register_setting( 'streannuniv-settings-group', 'streannuniv_dir' );
    register_setting( 'streannuniv-settings-group', 'streannuniv_email' );
    register_setting( 'streannuniv-settings-group', 'streannuniv_telf' );
    register_setting( 'streannuniv-settings-group', 'streannuniv_mob' );
    register_setting( 'streannuniv-settings-group', 'streannuniv_fb' );
    register_setting( 'streannuniv-settings-group', 'streannuniv_tw' );
    register_setting( 'streannuniv-settings-group', 'streannuniv_ig' );
    register_setting( 'streannuniv-settings-group', 'streannuniv_yt' );
}

function my_admin_menu() {
    add_menu_page( 'Escritorio', 'Universidad', 'manage_options', 'streann_dashboard', 'streann_dashboard_callback', get_template_directory_uri() . '/images/plugin-icon.png', 0  );
    add_submenu_page( 'streann_dashboard', __( 'Cursos', 'streannuniv' ), __( 'Cursos', 'streannuniv' ), 'manage_options', 'edit.php?post_type=cursos');
    add_submenu_page( 'streann_dashboard', __( 'Agregar Curso', 'streannuniv' ), __( 'Agregar Curso', 'streannuniv' ), 'manage_options', 'post-new.php?post_type=cursos');
    add_submenu_page( 'streann_dashboard', __( 'Niveles', 'streannuniv' ), __( 'Niveles', 'streannuniv' ), 'manage_options', 'edit-tags.php?taxonomy=nivel_cursos');
    add_submenu_page( 'streann_dashboard', __( 'Quizzes', 'streannuniv' ), __( 'Quizzes', 'streannuniv' ), 'manage_options', 'edit.php?post_type=quiz');
    add_submenu_page( 'streann_dashboard', __( 'Agregar Quiz', 'streannuniv' ), __( 'Agregar Quiz', 'streannuniv' ), 'manage_options', 'post-new.php?post_type=quiz');
    add_submenu_page( 'streann_dashboard', __( 'Opciones del Sitio', 'streannuniv' ), __( 'Opciones del Sitio', 'streannuniv' ), 'manage_options', 'streannuniv_custom_options', 'streannuniv_custom_options_callback');

    /* call register settings function */
    add_action( 'admin_init', 'register_streannuniv_settings' );
}

add_action( 'admin_menu', 'my_admin_menu' );



/* CUSTOM CSS FOR THIS SECTION */
function load_custom_wp_admin_style($hook) {
    if( $hook != 'toplevel_page_streannuniv_custom_options' ) {
        return;
    }
    /* ENQUEUE THE CSS */
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i' );
    wp_enqueue_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/custom-wordpress-admin-style.css' );
}

add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function streann_dashboard_callback() {

}

/* CUSTOM MENU PAGE CONTENT */
function streannuniv_custom_options_callback() { ?>

<div class="streannuniv_custom_options-header">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>" class="logo-header" />
    <h1><?php echo get_admin_page_title(); ?></h1>
    <div class="custom-clearfix"></div>
</div>
<div class="streannuniv_custom_options-content">
    <form method="post" action="options.php">
        <?php settings_fields( 'streannuniv-settings-group' ); ?>
        <?php do_settings_sections( 'streannuniv-settings-group' ); ?>
        <table class="form-table">

            <tr valign="top">
                <th scope="row"><?php _e('Dirección', 'streannuniv'); ?></th>
                <td><textarea name="streannuniv_dir" cols="95" rows="5"><?php echo esc_attr( get_option('streannuniv_dir') ); ?></textarea></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Correo Electrónico', 'streannuniv'); ?></th>
                <td><input type="text" size="90" name="streannuniv_email" value="<?php echo esc_attr( get_option('streannuniv_email') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Teléfono', 'streannuniv'); ?></th>
                <td><input type="text" size="90" name="streannuniv_telf" value="<?php echo esc_attr( get_option('streannuniv_telf') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Móvil', 'streannuniv'); ?></th>
                <td><input type="text" size="90" name="streannuniv_mob" value="<?php echo esc_attr( get_option('streannuniv_mob') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row" colspan="2"><h3><?php _e('Redes Sociales', 'streannuniv'); ?></h3></th>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Perfil de Facebook', 'streannuniv'); ?></th>
                <td><input type="text" size="90" name="streannuniv_fb" value="<?php echo esc_attr( get_option('streannuniv_fb') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Perfil de Twitter', 'streannuniv'); ?></th>
                <td><input type="text" size="90" name="streannuniv_tw" value="<?php echo esc_attr( get_option('streannuniv_tw') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Perfil de Instagram', 'streannuniv'); ?></th>
                <td><input type="text" size="90" name="streannuniv_ig" value="<?php echo esc_attr( get_option('streannuniv_ig') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php _e('Canal de Youtube', 'streannuniv'); ?></th>
                <td><input type="text" size="90" name="streannuniv_yt" value="<?php echo esc_attr( get_option('streannuniv_yt') ); ?>" /></td>
            </tr>

        </table>
        <?php submit_button(); ?>
    </form>
</div>
<?php }
