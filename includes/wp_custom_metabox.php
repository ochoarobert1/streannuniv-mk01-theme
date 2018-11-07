<?php
add_action( 'cmb2_admin_init', 'streannuniv_register_demo_metabox' );
function streannuniv_register_demo_metabox() {
    $prefix = 'su_';

    $cmb_metabox = new_cmb2_box( array(
        'id'            => $prefix . 'page_metabox',
        'title'         => esc_html__( 'Información Extra', 'cmb2' ),
        'object_types'  => array( 'page', 'cursos', 'post' ), // Post type
        // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
        // 'context'    => 'normal',
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

    $cmb_cursos = new_cmb2_box( array(
        'id'            => $prefix . 'cursos_metabox',
        'title'         => esc_html__( 'Información Extra', 'cmb2' ),
        'object_types'  => array( 'cursos' ), // Post type
        // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
        // 'context'    => 'normal',
        // 'priority'   => 'high',
        // 'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // true to keep the metabox closed by default
        // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
        // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
    ) );

    $cmb_cursos->add_field( array(
        'name'       => esc_html__( 'Video URL', 'cmb2' ),
        'desc'       => esc_html__( 'Inserte la dirección URL del video a vincular con el curso', 'cmb2' ),
        'id'         => $prefix . 'curso_link',
        'type' => 'text_url',
        'protocols' => array( 'http', 'https' ), // Array of allowed protocols
    ) );

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

    $cmb_quizzes = new_cmb2_box( array(
        'id'            => $prefix . 'preguntas_metabox',
        'title'         => esc_html__( 'Opciones de la Pregunta', 'bylablum' ),
        'object_types'  => array( 'quiz' ) // Post type
        // 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
        // 'context'    => 'normal',
        // 'priority'   => 'high',
        // 'show_names' => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // true to keep the metabox closed by default
        // 'classes'    => 'extra-class', // Extra cmb2-wrap classes
        // 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
    ) );

    $quiz_field_id = $cmb_quizzes->add_field( [
        'id'      => 'preguntas_group',
        'type'    => 'group',
        'options' => array
        (
            'group_title'   => __('Pregunta {#}', 'cmb2'), // {#} gets replaced by row number
            'add_button'    => __('Agrega otra pregunta', 'cmb2'),
            'remove_button' => __('Remover pregunta', 'cmb2'),
            'sortable'      => true,
        ),
    ] );

    $cmb_quizzes->add_group_field( $quiz_field_id, [
        'name'       => esc_html__( 'Texto de la Pregunta:', 'bylablum' ),
        'desc'       => esc_html__( 'Inserte el argumento de la Pregunta', 'bylablum' ),
        'id'         => $prefix . 'pregunta_text',
        'type'       => 'textarea',
        //'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'column'          => true, // Display field value in the admin post-listing columns
    ] );

    $cmb_quizzes->add_group_field( $quiz_field_id, [
        'name'       => esc_html__( 'Opción 1:', 'bylablum' ),
        'desc'       => esc_html__( 'Inserte una Opcion de la Pregunta', 'bylablum' ),
        'id'         => $prefix . 'pregunta_option_1',
        'type'       => 'text',
        'classes' => 'cmb-custom-3columns',
        //'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'column'          => true, // Display field value in the admin post-listing columns
    ] );

    $cmb_quizzes->add_group_field( $quiz_field_id, [
        'name'       => esc_html__( 'Opción 2:', 'bylablum' ),
        'desc'       => esc_html__( 'Inserte una Opcion de la Pregunta', 'bylablum' ),
        'id'         => $prefix . 'pregunta_option_2',
        'type'       => 'text',
        'classes' => 'cmb-custom-3columns',
        //'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'column'          => true, // Display field value in the admin post-listing columns
    ] );

    $cmb_quizzes->add_group_field( $quiz_field_id, [
        'name'       => esc_html__( 'Opción 3:', 'bylablum' ),
        'desc'       => esc_html__( 'Inserte una Opcion de la Pregunta', 'bylablum' ),
        'id'         => $prefix . 'pregunta_option_3',
        'type'       => 'text',
        'classes' => 'cmb-custom-3columns',
        //'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'column'          => true, // Display field value in the admin post-listing columns
    ] );

    $cmb_quizzes->add_group_field( $quiz_field_id, [
        'name'       => esc_html__( 'Opción Correcta:', 'bylablum' ),
        'desc'       => esc_html__( 'Seleccione la pregunta correcta', 'bylablum' ),
        'id'         => $prefix . 'opcion_correcta',
        'type'             => 'select',
        'show_option_none' => false,
        'default'          => '1',
        'options'          => array(
            '1' => __( 'Opcion 1', 'cmb2' ),
            '2'   => __( 'Opcion 2', 'cmb2' ),
            '3'     => __( 'Opcion 3', 'cmb2' ),
        ),
        //'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
        // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
        // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
        // 'on_front'        => false, // Optionally designate a field to wp-admin only

        // 'column'          => true, // Display field value in the admin post-listing columns
    ] );
}
