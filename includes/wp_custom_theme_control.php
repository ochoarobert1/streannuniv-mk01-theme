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
    register_setting( 'streannuniv-settings-group', 'streann_myaccount_page_id' );
}

function my_admin_menu() {
    add_menu_page( 'Escritorio', 'Universidad', 'manage_options', 'streann_dashboard', 'streann_dashboard_callback', get_template_directory_uri() . '/images/plugin-icon.png', 0  );
    add_submenu_page( 'streann_dashboard', __( 'Niveles', 'streannuniv' ), __( 'Niveles', 'streannuniv' ), 'manage_options', 'edit.php?post_type=nivel');
    add_submenu_page( 'streann_dashboard', __( 'Agregar Nivel', 'streannuniv' ), __( 'Agregar Nivel', 'streannuniv' ), 'manage_options', 'post-new.php?post_type=nivel');
    add_submenu_page( 'streann_dashboard', __( 'Cursos', 'streannuniv' ), __( 'Cursos', 'streannuniv' ), 'manage_options', 'edit.php?post_type=cursos');
    add_submenu_page( 'streann_dashboard', __( 'Agregar Curso', 'streannuniv' ), __( 'Agregar Curso', 'streannuniv' ), 'manage_options', 'post-new.php?post_type=cursos');
    add_submenu_page( 'streann_dashboard', __( 'Quizzes', 'streannuniv' ), __( 'Quizzes', 'streannuniv' ), 'manage_options', 'edit.php?post_type=quiz');
    add_submenu_page( 'streann_dashboard', __( 'Agregar Quiz', 'streannuniv' ), __( 'Agregar Quiz', 'streannuniv' ), 'manage_options', 'post-new.php?post_type=quiz');
    add_submenu_page( 'streann_dashboard', __( 'Testimonios', 'streannuniv' ), __( 'Testimonios', 'streannuniv' ), 'manage_options', 'edit.php?post_type=testimonios');
    add_submenu_page( 'streann_dashboard', __( 'Agregar Testimonio', 'streannuniv' ), __( 'Agregar Testimonio', 'streannuniv' ), 'manage_options', 'post-new.php?post_type=testimonios');
    add_submenu_page( 'streann_dashboard', __( 'Opciones del Sitio', 'streannuniv' ), __( 'Opciones del Sitio', 'streannuniv' ), 'manage_options', 'streannuniv_custom_options', 'streannuniv_custom_options_callback');

    /* call register settings function */
    add_action( 'admin_init', 'register_streannuniv_settings' );
}

add_action( 'admin_menu', 'my_admin_menu' );



/* CUSTOM CSS FOR THIS SECTION */
function load_custom_wp_admin_style($hook) {
    //    if( $hook != 'toplevel_page_streannuniv_custom_options' ) {
    //        return;
    //    }
    /* ENQUEUE THE CSS */
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i' );
    wp_enqueue_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/custom-wordpress-admin-style.css' );
    /*- MAIN FUNCTIONS -*/
    wp_enqueue_script('custom_wp_admin_js', get_template_directory_uri() . '/js/admin-dashboard-functions.js', array('jquery'), NULL, true);

    wp_localize_script( 'custom_wp_admin_js', 'ajax_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' )
    ));
}

add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function streann_dashboard_callback() {
   ?>



<div class="admin-custom-area-header">
    <h1>
        <?php echo get_admin_page_title(); ?>
    </h1>
    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo('name');?>" class="img-fluid" />
</div>
<div class="admin-custom-area-content">
    <div class="admin-custom-area-item">
        <?php $usuarios = get_users( array( 'blog_id' => $GLOBALS['blog_id'], 'role' => 'subscriber', 'role__not_in' => 'administrator', 'orderby' => 'ID', 'order' => 'DESC' )); ?>
        <h3>
            <?php _e('Últimos Registros', 'streannuniv'); ?>
            <span class="quantity">Cantidad: <?php echo count($usuarios); ?></span>
        </h3>
        <h2 class="admin-custom-area-button">Haz click aquí para desplegar los usuarios:</h2>
        <div class="admin-custom-area-collapse">
            <table class="custom-admin-table">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                </tr>
                <?php foreach ( $usuarios as $user ) { ?>
                <tr>
                    <td>
                        <?php echo $user->ID; ?>
                    </td>
                    <td>
                        <?php echo get_user_meta($user->ID, 'first_name', true); ?>
                        <?php echo get_user_meta($user->ID, 'last_name', true); ?>
                    </td>
                    <td>
                        <?php echo esc_html( $user->user_email ); ?>
                    </td>
                </tr>
                <?php } ?>
            </table>

        </div>
        <div class="admin-custom-area-item-buttons">
            <button>Generar Reporte</button>
        </div>
    </div>
    <?php $array_courses = new WP_Query(array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date' )); ?>

    <?php if ($array_courses->have_posts()) : $i = 1; ?>
    <?php while ($array_courses->have_posts()) : $array_courses->the_post(); ?>
    <?php $contador = 1; ?>
    <?php $usuarios = get_users( array( 'blog_id' => $GLOBALS['blog_id'], 'role' => 'subscriber', 'role__not_in' => 'administrator', 'orderby' => 'ID', 'order' => 'DESC' )); ?>
    <?php foreach ( $usuarios as $user ) { ?>
    <?php $courses = get_user_meta($user->ID, 'course_approved', true); ?>
    <?php if ((is_array($courses)) && (in_array(get_the_ID(), $courses))) { ?>
    <?php $contador = $contador + 1; ?>
    <?php } ?>
    <?php } ?>
    <div class="admin-custom-area-item">
        <h3>
            <?php _e('Aprobados:', 'streannuniv'); ?>
            <?php the_title(); ?>
            <span class="quantity">Cantidad: <?php echo $contador; ?></span>
        </h3>

        <h2 class="admin-custom-area-button">Haz click aquí para desplegar los usuarios:</h2>
        <div class="admin-custom-area-collapse">
            <table class="custom-admin-table">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                </tr>
                <?php foreach ( $usuarios as $user ) { ?>
                <?php $courses = get_user_meta($user->ID, 'course_approved', true); ?>
                <?php if ((is_array($courses)) && (in_array(get_the_ID(), $courses))) { ?>
                <tr>
                    <td>
                        <?php echo $user->ID; ?>
                    </td>
                    <td>
                        <?php echo get_user_meta($user->ID, 'first_name', true); ?>
                        <?php echo get_user_meta($user->ID, 'last_name', true); ?>
                    </td>
                    <td>
                        <?php echo esc_html( $user->user_email ); ?>
                    </td>
                </tr>
                <?php } ?>
                <?php } ?>
            </table>

        </div>
        <div class="admin-custom-area-item-buttons">
            <a href="<?php echo home_url('admin_report?course_id=') . get_the_ID(); ?>" target="_blank" class="admin_report">Generar Reporte</a>
        </div>
    </div>
    <?php $i++; ?>
    <?php if ($i == 2) { echo '<div class="clearfix-admin"></div>';$i = 0; } ?>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php wp_reset_query(); ?>

</div>

<?php }

/* CUSTOM MENU PAGE CONTENT */
function streannuniv_custom_options_callback() { ?>

<div class="streannuniv_custom_options-header">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>" class="logo-header" />
    <h1>
        <?php echo get_admin_page_title(); ?>
    </h1>
    <div class="custom-clearfix"></div>
</div>
<div class="streannuniv_custom_options-content">
    <form method="post" action="options.php">
        <?php settings_fields( 'streannuniv-settings-group' ); ?>
        <?php do_settings_sections( 'streannuniv-settings-group' ); ?>
        <table class="form-table">

            <tr valign="top">
                <th scope="row">
                    <?php _e('Dirección', 'streannuniv'); ?>
                </th>
                <td><textarea name="streannuniv_dir" cols="95" rows="5"><?php echo esc_attr( get_option('streannuniv_dir') ); ?></textarea></td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Correo Electrónico', 'streannuniv'); ?>
                </th>
                <td><input type="text" size="90" name="streannuniv_email" value="<?php echo esc_attr( get_option('streannuniv_email') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Teléfono', 'streannuniv'); ?>
                </th>
                <td><input type="text" size="90" name="streannuniv_telf" value="<?php echo esc_attr( get_option('streannuniv_telf') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Móvil', 'streannuniv'); ?>
                </th>
                <td><input type="text" size="90" name="streannuniv_mob" value="<?php echo esc_attr( get_option('streannuniv_mob') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row" colspan="2">
                    <h3>
                        <?php _e('Redes Sociales', 'streannuniv'); ?>
                    </h3>
                </th>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Perfil de Facebook', 'streannuniv'); ?>
                </th>
                <td><input type="text" size="90" name="streannuniv_fb" value="<?php echo esc_attr( get_option('streannuniv_fb') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Perfil de Twitter', 'streannuniv'); ?>
                </th>
                <td><input type="text" size="90" name="streannuniv_tw" value="<?php echo esc_attr( get_option('streannuniv_tw') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Perfil de Instagram', 'streannuniv'); ?>
                </th>
                <td><input type="text" size="90" name="streannuniv_ig" value="<?php echo esc_attr( get_option('streannuniv_ig') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Canal de Youtube', 'streannuniv'); ?>
                </th>
                <td><input type="text" size="90" name="streannuniv_yt" value="<?php echo esc_attr( get_option('streannuniv_yt') ); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row" colspan="2">
                    <h3>
                        <?php _e('Pagina de Mi Cuenta', 'streannuniv'); ?>
                    </h3>
                </th>
            </tr>

            <tr valign="top">
                <th scope="row">
                    <?php _e('Seleccionar Pagina para Mi Cuenta', 'streannuniv'); ?>
                </th>
                <td>
                    <select name="streann_myaccount_page_id" id="streann_myaccount_page_id">
                        <?php $arr_pages = new WP_Query(array('post_type' => 'page', 'posts_per_page' => -1)); ?>
                        <?php while ($arr_pages->have_posts()) : $arr_pages->the_post(); ?>
                        <option value="<?php echo get_the_ID(); ?>" <?php selected(get_option( 'streann_myaccount_page_id'), get_the_ID()); ?>><?php the_title(); ?></option>
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                    </select>
                </td>
            </tr>


        </table>
        <?php submit_button(); ?>
    </form>
</div>
<?php }

function streann_admin_report_course_handler($course_level) {
    $level_post = get_post($course_level);
    $nivel = $level_post->post_title;
    //    $first_name = get_user_meta($userid, 'first_name', true);
    //    $last_name = get_user_meta($userid, 'last_name', true);
    //    $nombre = $first_name . ' ' . $last_name;
    require_once('tcpdf.php');
    require_once('course-create-report.php');
}