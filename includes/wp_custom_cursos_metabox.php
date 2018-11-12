<?php



/* --------------------------------------------------------------
/* CUSTOM METABOX - COURSES
-------------------------------------------------------------- */

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

$cmb_cursos->add_field( array(
    'name'       => esc_html__( 'Nivel del Curso', 'cmb2' ),
    'desc'       => esc_html__( 'Elija el Nivel del Curso', 'cmb2' ),
    'id'         => $prefix . 'curso_nivel',
    'type' => 'select',
    'options' => get_levels(),

) );
