<?php
/* IMAGES RESPONSIVE ON ATTACHMENT IMAGES */
function image_tag_class($class) {
    $class .= ' img-fluid';
    return $class;
}
add_filter('get_image_tag_class', 'image_tag_class' );

/* ADD CONTENT WIDTH FUNCTION */

if ( ! isset( $content_width ) ) $content_width = 1170;

/* ADD CONTENT WIDTH FUNCTION */

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
    $classes[] = 'nav-item';
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

// let's add our custom class to the actual link tag

function atg_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'topnav') {
        $classes[] = 'nav-link';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

function add_menuclass($ulclass) {
    return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');

/* --------------------------------------------------------------
/* CUSTOM COURSE LEVEL ARRAY
-------------------------------------------------------------- */
function get_levels() {
    $list_nivel = array();
    $array_nivel= new WP_Query(array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date'));
    if ($array_nivel->have_posts()) :
    while ($array_nivel->have_posts()) : $array_nivel->the_post();
    $list_nivel[get_the_ID()] = get_the_title();
    endwhile;
    endif;

    return $list_nivel;
}

/* --------------------------------------------------------------
/* ADD CUSTOM FIELDS TO USERS
-------------------------------------------------------------- */
function load_user_scripts_styles($hook_suffix) {
    if($hook_suffix == 'profile.php') {
        wp_register_style( 'select2-css-admin', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', false, '4.0.6' );
        wp_enqueue_style( 'select2-css-admin');

        wp_enqueue_script('select2-js-admin', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array('jquery'), '4.0.6', true);

        wp_enqueue_script('admin-user-functions', get_template_directory_uri() . '/js/admin-user-functions.js', array('jquery', 'select2-js-admin'), NULL, true);
    }
}

add_action( 'admin_enqueue_scripts', 'load_user_scripts_styles' );

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<h3>
    <?php _e('Información Adicional del Usuario', 'streannuniv'); ?>
</h3>

<table class="form-table">
    <tr>
        <th><label for="course_selection">
            <?php _e("Selección de Cursos"); ?></label></th>
        <td>
            <?php $args = array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date'); ?>
            <?php $nivel_list = new WP_Query($args); ?>
            <?php $array_selected = (array)get_user_meta($user->ID, 'course_selection', true); ?>
            <?php if ($nivel_list->have_posts()) : ?>
            <select class="js-example-basic-multiple regular-text" name="course_selection[]" multiple="multiple">
                <?php while ($nivel_list->have_posts()) : $nivel_list->the_post(); ?>
                <?php if (in_array(get_the_ID(), $array_selected)) { $class = 'selected="selected"'; } else { $class = ''; } ?>
                <option value="<?php echo get_the_ID(); ?>" <?php echo $class; ?>>
                    <?php echo get_the_title(); ?>
                </option>
                <?php endwhile; ?>
            </select>
            <?php endif; ?>
            <?php /* echo esc_attr( get_the_author_meta( 'course_selection', $user->ID ) ); */ ?><br />
            <span class="description">
                <?php _e('Seleccione los cursos al cual el usuario tendrá acceso.', 'streannuniv'); ?></span>
        </td>
    </tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    update_user_meta( $user_id, 'course_selection', $_POST['course_selection'] );
}

/* --------------------------------------------------------------
/* CUSTOM FUNCTION TO GET AUTHORIZED LEVELS
-------------------------------------------------------------- */
function get_authorized_levels() {
    $user_id = get_current_user_id();
    $authorized_levels = (array)get_user_meta($user_id, 'course_selection', true);
    return $authorized_levels;
}
