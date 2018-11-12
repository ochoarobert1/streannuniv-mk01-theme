<?php
add_action( 'cmb2_admin_init', 'streannuniv_register_demo_metabox' );
function streannuniv_register_demo_metabox() {
    $prefix = 'su_';

    $cmb_metabox = new_cmb2_box( array(
        'id'            => $prefix . 'page_metabox',
        'title'         => esc_html__( 'Información Extra', 'cmb2' ),
        'object_types'  => array( 'page', 'cursos', 'post' ), // Post type
        // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
        'context'    => 'side',
        // 'priority'   => 'high',
        // 'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // true to keep the metabox closed by default
        // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
        // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
    ) );

    $cmb_metabox->add_field( array(
        'name'    => esc_html__( 'Información Extra', 'cmb2' ),
        'desc'    => esc_html__( 'Cargue una imagen que será usada como banner', 'cmb2' ),
        'id'      => $prefix . 'page_banner',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => esc_html__( 'Cargar Banner', 'cmb2' ),
        ),
        // query_args are passed to wp.media's library query.
        'query_args' => array(
            'type' => array(
                'image/gif',
                'image/jpeg',
                'image/png',
            ),
        ),
        'preview_size' => 'large', // Image size to use when previewing in the admin.
    ) );

    /* COURSES METABOXES */
    require_once('wp_custom_cursos_metabox.php');

    /* QUIZZES METABOXES */
    require_once('wp_custom_quiz_metabox.php');


    $cmb_testimonios = new_cmb2_box( array(
        'id'            => $prefix . 'testimonios_metabox',
        'title'         => esc_html__( 'Información Extra', 'cmb2' ),
        'object_types'  => array( 'testimonios' ), // Post type
        // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
        // 'context'    => 'normal',
        // 'priority'   => 'high',
        // 'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // true to keep the metabox closed by default
        // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
        // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
    ) );

    $cmb_testimonios->add_field( array(
        'name'       => esc_html__( 'Cargo / Posición', 'cmb2' ),
        'desc'       => esc_html__( 'Inserte el cargo o la posición de la persona', 'cmb2' ),
        'id'         => $prefix . 'testimonial_position',
        'type' => 'text',
        'protocols' => array( 'http', 'https' ), // Array of allowed protocols
    ) );


}
