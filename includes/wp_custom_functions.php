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
    if(($hook_suffix == 'profile.php') || ($hook_suffix == 'user-new.php') || ($hook_suffix == 'user-edit.php')) {
        wp_register_style( 'select2-css-admin', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', false, '4.0.6' );
        wp_enqueue_style( 'select2-css-admin');

        wp_enqueue_script('select2-js-admin', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', array('jquery'), '4.0.6', true);

        wp_enqueue_script('admin-user-functions', get_template_directory_uri() . '/js/admin-user-functions.js', array('jquery', 'select2-js-admin'), NULL, true);
    }
}

add_action( 'admin_enqueue_scripts', 'load_user_scripts_styles' );


add_action( 'user_new_form', 'extra_user_profile_fields' );
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

add_action('user_register', 'save_extra_user_profile_fields');
add_action('profile_update', 'save_extra_user_profile_fields');
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    update_user_meta( $user_id, 'course_selection', $_POST['course_selection'] );
    update_user_meta( $user_id, 'user_altered', 1);
}

/* --------------------------------------------------------------
/* CUSTOM FUNCTION TO GET AUTHORIZED LEVELS
-------------------------------------------------------------- */
function get_authorized_levels() {
    $user_id = get_current_user_id();
    if( current_user_can('editor') || current_user_can('administrator') ) {
        $level_array = new WP_Query(array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date'));
        while ($level_array->have_posts()) : $level_array->the_post();
        $authorized_levels[] = get_the_ID();
        endwhile;
    } else {
        $authorized_levels = (array)get_user_meta($user_id, 'course_selection', true);
        foreach ($authorized_levels as $key => $value) {
            if ((empty($value)) || ($value == 0)) {
                unset($authorized_levels[$key]);
            }
        }
        if (empty($authorized_levels)) {
            $level_array = new WP_Query(array('post_type' => 'nivel', 'posts_per_page' => 1, 'order' => 'ASC', 'orderby' => 'date'));
            while ($level_array->have_posts()) : $level_array->the_post();
            $authorized_levels[] = get_the_ID();
            endwhile;
        }
    }
    return $authorized_levels;
}

/* --------------------------------------------------------------
/* CUSTOM FUNCTION TO GET APPROVED LEVELS
-------------------------------------------------------------- */
function get_approved_levels() {
    $user_id = get_current_user_id();
    $approved_levels = array();
    if( current_user_can('editor') || current_user_can('administrator') ) {
        $level_array = new WP_Query(array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date'));
        while ($level_array->have_posts()) : $level_array->the_post();
        $approved_levels[] = get_the_ID();
        endwhile;
    } else {
        $approved_levels = (array)get_user_meta($user_id, 'course_approved', true);
        foreach ($approved_levels as $key => $value) {
            if ((empty($value)) || ($value == 0)) {
                unset($approved_levels[$key]);
            }
        }
    }
    return $approved_levels;
}

/* --------------------------------------------------------------
/* CUSTOM FUNCTION TO GET COURSES
-------------------------------------------------------------- */
function get_the_course($course_id) {
    $array_courses = new WP_Query(array(
        'post_type' => 'cursos',
        'posts_per_page' => -1,
        'order' => 'DESC',
        'orderby' => 'date',
        'meta_query' => array(
            array(
                'key' => 'su_curso_nivel',
                'value' => array($course_id),
                'compare' => 'IN'
            ))));
    return $array_courses;
}

/* --------------------------------------------------------------
/* CUSTOM FUNCTION TO GET QUIZZES
-------------------------------------------------------------- */
function get_the_quiz($course_id) {
    $array_quiz = new WP_Query(array(
        'post_type' => 'quiz',
        'posts_per_page' => -1,
        'order' => 'DESC',
        'orderby' => 'date',
        'meta_query' => array(
            array(
                'key' => 'su_curso_nivel',
                'value' => array($course_id),
                'compare' => 'IN'
            ))));

    return $array_quiz;
}

/* --------------------------------------------------------------
/* CUSTOM CHANGE VIDEO
-------------------------------------------------------------- */
function change_current_video() {
    $video_id = $_POST['videoid'];
    $video = get_post_meta($video_id, 'su_curso_link', true);
    $video_html = '<iframe id="' . $video_id . ' "src="https://player.vimeo.com/video/' . streann_vimeo_fetch($video) . '" class="embed-responsive-item" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media"></iframe>';
    echo $video_html;
    die();
}

add_action('wp_ajax_change_current_video', 'change_current_video');
add_action('wp_ajax_change_next_video', 'change_current_video');


/* --------------------------------------------------------------
/* CUSTOM QUIZ OPTIONS FETCHER
-------------------------------------------------------------- */
function custom_quiz_question_fetcher ($array) {
    foreach($array as $key => $value){
        $exp_key = explode('su_pregunta_option_', $key);
        if($exp_key[0] == ''){
            $arr_result[] = $value;
        }
    }
    return $arr_result;
}

/* --------------------------------------------------------------
/* CUSTOM QUIZ GET RIGHT ANSWERS
-------------------------------------------------------------- */
function get_quiz_right_answers_callback() {
    $quiz_id = $_POST['quiz_id'];
    $array_questions = (array)get_post_meta($quiz_id, 'preguntas_group', true);
    foreach ($array_questions as $question_item) {
        $right_answers[] = $question_item['su_opcion_correcta'];
    }
    echo json_encode($right_answers);
    die();
}

add_action('wp_ajax_get_quiz_right_answers', 'get_quiz_right_answers_callback');

/* --------------------------------------------------------------
/* CUSTOM QUIZ GET RESULTS
-------------------------------------------------------------- */
function get_quiz_results_callback() {
    $score = $_POST['acum'];
    $quantity = $_POST['quantity'];
    $quiz_id = $_POST['quiz_id'];
    $user_id = get_current_user_id();
    $level_id = get_post_meta($quiz_id, 'su_curso_nivel', true);

    $percentage = ($score * 100) / $quantity;
    if ($percentage > 70) {
        $quizzes = get_approved_levels();
        if (!in_array($level_id, $quizzes)) {
            $quizzes[] = $level_id; //I'm sure you would do more processing here
        }

        update_user_meta($user_id, 'course_approved', $quizzes);
        update_user_meta($user_id, 'quiz_reprobred_times', 0);
?>
<div class="container">

    <div class="row align-items-center justify-content-center">
        <div class="quiz-test-result-content col-6">
            <div class="svg-container">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#73AF55" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <polyline class="path check" fill="none" stroke="#73AF55" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" points="100.2,40.2 51.5,88.8 29.8,67.5 " />
                </svg>
            </div>
            <h2>
                <?php _e('Ud ha aprobado el curso', 'streannuniv'); ?>
            </h2>
            <p>
                <?php _e('Te invitamos a continuar con el siguiente nivel de estudio para completar tu certificación', 'streannuniv'); ?>
            </p>
            <?php $level_array = get_posts(array('post_type' => 'nivel', 'posts_per_page' => 1, 'order' => 'ASC', 'orderby' => 'date', 'offset' => 1)); ?>
            <button onclick="next_level(<?php echo $level_array[0]->ID; ?>)" class="btn btn-md btn-quiz">
                <?php _e('Siguiente Nivel', 'streannteam'); ?></button>
        </div>
    </div>
</div>

<?php
    } else {
        $reprobred_times = get_user_meta($user_id, 'quiz_reprobred_times', true);
        $reprobred_times = $reprobred_times + 1;
        update_user_meta($user_id, 'quiz_reprobred_times', $reprobred_times);
        if ($reprobred_times < 3) {
?>
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="quiz-test-result-content col-6">
            <div class="svg-container">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#ad0000" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <line class="path line" fill="none" stroke="#ad0000" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                    <line class="path line" fill="none" stroke="#ad0000" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                </svg>
            </div>
            <h2>
                <?php _e('Ud no ha aprobado el curso', 'streannuniv'); ?>
            </h2>
            <p>
                <?php _e('Te invitamos a repetir el nivel para poder aprobar este quiz y completar tu certificación', 'streannuniv'); ?>
            </p>
            <button onclick="repeat_quiz()" class="btn btn-md btn-repeat">
                <?php _e('Repetir Qüiz', 'streannteam'); ?></button>
        </div>
    </div>
</div>
<?php
                                  } else {
?>
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="quiz-test-result-content col-6">
            <div class="svg-container">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
                    <circle class="path circle" fill="none" stroke="#ad0000" stroke-width="6" stroke-miterlimit="10" cx="65.1" cy="65.1" r="62.1" />
                    <line class="path line" fill="none" stroke="#ad0000" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="34.4" y1="37.9" x2="95.8" y2="92.3" />
                    <line class="path line" fill="none" stroke="#ad0000" stroke-width="6" stroke-linecap="round" stroke-miterlimit="10" x1="95.8" y1="38" x2="34.4" y2="92.2" />
                </svg>
            </div>
            <h2>
                <?php _e('Ud no ha aprobado el curso', 'streannuniv'); ?>
            </h2>
            <p>
                <?php _e('Deberás repetir el nivel antes de intentar de nuevo este quiz', 'streannuniv'); ?>
            </p>
            <button onclick="repeat_level(<?php echo $level_id; ?>)" class="btn btn-md btn-repeat">
                <?php _e('Repetir Nivel', 'streannteam'); ?></button>
        </div>
    </div>
</div>
<?php
                                         }
    }
    die();
}
add_action('wp_ajax_get_quiz_results', 'get_quiz_results_callback');
add_action('wp_ajax_nopriv_get_quiz_results', 'get_quiz_results_callback');

function repeat_level_by_quiz_callback() {
    $level_ID = $_POST['level_id'];
    $args = array('post_type' => 'cursos', 'posts_per_page' => 1, 'order' => 'DESC', 'date', 'meta_query' => array(array('key' => 'su_curso_nivel', 'value' => array($level_ID), 'compare' => 'IN')));
    $first_video = new WP_Query($args);
    while ($first_video->have_posts()) : $first_video->the_post();
    $curso_id = get_the_ID();
    endwhile;
    $link = home_url('/reproductor?curso=' . $curso_id);
    echo esc_url($link);
    die();
}


add_action('wp_ajax_repeat_level_by_quiz', 'repeat_level_by_quiz_callback');

/* --------------------------------------------------------------
/* CREATE CERTIFICATE DOCUMENT
-------------------------------------------------------------- */
function get_certificate_pdf($levelid, $userid) {
    ob_start();
    $level_post = get_post($levelid);
    $nivel = $level_post->post_title;
    $first_name = get_user_meta($userid, 'first_name', true);
    $last_name = get_user_meta($userid, 'last_name', true);
    $nombre = $first_name . ' ' . $last_name;

    require_once('tcpdf.php');
    require_once('create-cert.php');
    ob_end_flush();

}

function remove_reprobed_pointer_callback() {
    $user_id = $_POST['userid'];
    $videoid = $_POST['videoid'];
    update_user_meta($user_id, 'quiz_reprobred_times', 0);
    $level_id = get_post_meta($videoid, 'su_curso_nivel', true);
    $levels = get_user_meta($user_id, 'quiz_unlocked_level', true);
    if(is_array($levels))
        $levels[] = $level_id; //I'm sure you would do more processing here
    else
        $levels = array($level_id);
    update_user_meta($user_id, 'quiz_unlocked_level', $levels);

    die();
}

add_action('wp_ajax_remove_reprobed_pointer', 'remove_reprobed_pointer_callback');


function get_last_video_callback() {
    $videoid = $_POST['videoid'];
    $level_id = get_post_meta($videoid, 'su_curso_nivel', true);
    $args = array('post_type' => 'cursos', 'posts_per_page' => 1, 'order' => 'ASC', 'date', 'meta_query' => array(array('key' => 'su_curso_nivel', 'value' => array($level_id), 'compare' => 'IN')));
    $first_video = new WP_Query($args);
    while ($first_video->have_posts()) : $first_video->the_post();
    $curso_id = get_the_ID();
    endwhile;
    echo $curso_id;
    die();
}

add_action('wp_ajax_get_last_video', 'get_last_video_callback');

function quiz_next_level_callback() {
    $levelid = $_POST['level_id'];
    $url = home_url('/reproductor?level_id=') . $levelid;
    echo $url;
    die();
}

add_action('wp_ajax_quiz_next_level', 'quiz_next_level_callback');
