<?php
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

$cmb_quizzes->add_field( array(
    'name'       => esc_html__( 'Nivel del Curso', 'cmb2' ),
    'desc'       => esc_html__( 'Elija el Nivel del Curso', 'cmb2' ),
    'id'         => $prefix . 'curso_nivel',
    'type' => 'select',
    'options' => get_levels(),

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
    'type'       => 'wysiwyg',
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
    'name'       => esc_html__( 'Opción 4:', 'bylablum' ),
    'desc'       => esc_html__( 'Inserte una Opcion de la Pregunta', 'bylablum' ),
    'id'         => $prefix . 'pregunta_option_4',
    'type'       => 'text',
    'classes' => 'cmb-custom-3columns',
    //'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
    // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
    // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
    // 'column'          => true, // Display field value in the admin post-listing columns
] );

$cmb_quizzes->add_group_field( $quiz_field_id, [
    'name'       => esc_html__( 'Opción 5:', 'bylablum' ),
    'desc'       => esc_html__( 'Inserte una Opcion de la Pregunta', 'bylablum' ),
    'id'         => $prefix . 'pregunta_option_5',
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
        '4'   => __( 'Opcion 4', 'cmb2' ),
        '5'     => __( 'Opcion 5', 'cmb2' ),
    ),
    //'show_on_cb' => 'yourprefix_hide_if_no_cats', // function should return a bool value
    // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
    // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
    // 'on_front'        => false, // Optionally designate a field to wp-admin only

    // 'column'          => true, // Display field value in the admin post-listing columns
] );
