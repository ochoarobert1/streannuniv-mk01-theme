<?php

function streannuniv_custom_post_type() {

    $labels = array(
        'name'                  => _x( 'Cursos', 'Post Type General Name', 'streannuniv' ),
        'singular_name'         => _x( 'Curso', 'Post Type Singular Name', 'streannuniv' ),
        'menu_name'             => __( 'Cursos', 'streannuniv' ),
        'name_admin_bar'        => __( 'Cursos', 'streannuniv' ),
        'archives'              => __( 'Archivo de Cursos', 'streannuniv' ),
        'attributes'            => __( 'Atributos de Cursos', 'streannuniv' ),
        'parent_item_colon'     => __( 'Curso Padre:', 'streannuniv' ),
        'all_items'             => __( 'Todos los Cursos', 'streannuniv' ),
        'add_new_item'          => __( 'Agregar Nuevo Curso', 'streannuniv' ),
        'add_new'               => __( 'Agregar Nuevo', 'streannuniv' ),
        'new_item'              => __( 'Nuevo Curso', 'streannuniv' ),
        'edit_item'             => __( 'Editar Curso', 'streannuniv' ),
        'update_item'           => __( 'Actualizar Curso', 'streannuniv' ),
        'view_item'             => __( 'Ver Curso', 'streannuniv' ),
        'view_items'            => __( 'Ver Cursos', 'streannuniv' ),
        'search_items'          => __( 'Buscar Curso', 'streannuniv' ),
        'not_found'             => __( 'No hay Resultados', 'streannuniv' ),
        'not_found_in_trash'    => __( 'No hay Resultados en Papelera', 'streannuniv' ),
        'featured_image'        => __( 'Imagen Descriptiva', 'streannuniv' ),
        'set_featured_image'    => __( 'Colocar Imagen Descriptiva', 'streannuniv' ),
        'remove_featured_image' => __( 'Remover Imagen Descriptiva', 'streannuniv' ),
        'use_featured_image'    => __( 'Usar como Imagen Descriptiva', 'streannuniv' ),
        'insert_into_item'      => __( 'Insertar en Curso', 'streannuniv' ),
        'uploaded_to_this_item' => __( 'Cargado a este Curso', 'streannuniv' ),
        'items_list'            => __( 'Listado de Cursos', 'streannuniv' ),
        'items_list_navigation' => __( 'Navegación del Listado de Cursos', 'streannuniv' ),
        'filter_items_list'     => __( 'Filtro del Listado de Cursos', 'streannuniv' ),
    );
    $args = array(
        'label'                 => __( 'Curso', 'streannuniv' ),
        'description'           => __( 'Cursos Ofrecidos por la Academia', 'streannuniv' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'comments', 'excerpt', 'thumbnail',  'comments' ),
        'taxonomies'            => array( 'nivel_cursos' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 154,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'cursos', $args );


    $labels = array(
        'name'                  => _x( 'Quizzes', 'Post Type General Name', 'streannuniv' ),
        'singular_name'         => _x( 'Quiz', 'Post Type Singular Name', 'streannuniv' ),
        'menu_name'             => __( 'Quizzes', 'streannuniv' ),
        'name_admin_bar'        => __( 'Quizzes', 'streannuniv' ),
        'archives'              => __( 'Archivo de Quizzes', 'streannuniv' ),
        'attributes'            => __( 'Atributos de Quizzes', 'streannuniv' ),
        'parent_item_colon'     => __( 'Quiz Padre:', 'streannuniv' ),
        'all_items'             => __( 'Todos los Quizzes', 'streannuniv' ),
        'add_new_item'          => __( 'Agregar Nuevo Quiz', 'streannuniv' ),
        'add_new'               => __( 'Agregar Nuevo', 'streannuniv' ),
        'new_item'              => __( 'Nuevo Quiz', 'streannuniv' ),
        'edit_item'             => __( 'Editar Quiz', 'streannuniv' ),
        'update_item'           => __( 'Actualizar Quiz', 'streannuniv' ),
        'view_item'             => __( 'Ver Quiz', 'streannuniv' ),
        'view_items'            => __( 'Ver Quizzes', 'streannuniv' ),
        'search_items'          => __( 'Buscar Podcast', 'streannuniv' ),
        'not_found'             => __( 'No hay resultados', 'streannuniv' ),
        'not_found_in_trash'    => __( 'No hay resultados en papelera', 'streannuniv' ),
        'featured_image'        => __( 'Imagen del Quiz', 'streannuniv' ),
        'set_featured_image'    => __( 'Colocar Imagen del Quiz', 'streannuniv' ),
        'remove_featured_image' => __( 'Remover Imagen del Quiz', 'streannuniv' ),
        'use_featured_image'    => __( 'Usar como Imagen del Quiz', 'streannuniv' ),
        'insert_into_item'      => __( 'Insertar en Quiz', 'streannuniv' ),
        'uploaded_to_this_item' => __( 'Cargado a este Quiz', 'streannuniv' ),
        'items_list'            => __( 'Listado de Quizzes', 'streannuniv' ),
        'items_list_navigation' => __( 'Navegación del listado de Quizzes', 'streannuniv' ),
        'filter_items_list'     => __( 'Filtro del Listado de Quizzes', 'streannuniv' ),
    );
    $args = array(
        'label'                 => __( 'Quiz', 'streannuniv' ),
        'description'           => __( 'Quiz dentro del site', 'streannuniv' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => false,
        'menu_position'         => 140,
        'menu_icon'             => 'dashicons-awards',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'quiz', $args );

    $labels = array(
        'name'                       => _x( 'Nivel', 'Taxonomy General Name', 'streannuniv' ),
        'singular_name'              => _x( 'Nivel', 'Taxonomy Singular Name', 'streannuniv' ),
        'menu_name'                  => __( 'Niveles', 'streannuniv' ),
        'all_items'                  => __( 'Todos los Niveles', 'streannuniv' ),
        'parent_item'                => __( 'Nivel Padre', 'streannuniv' ),
        'parent_item_colon'          => __( 'Nivel Padre:', 'streannuniv' ),
        'new_item_name'              => __( 'Nuevo Nivel', 'streannuniv' ),
        'add_new_item'               => __( 'Agregar Nueva Nivel', 'streannuniv' ),
        'edit_item'                  => __( 'Editar Nivel', 'streannuniv' ),
        'update_item'                => __( 'Actualizar Nivel', 'streannuniv' ),
        'view_item'                  => __( 'Ver Nivel', 'streannuniv' ),
        'separate_items_with_commas' => __( 'Separar Niveles por comas', 'streannuniv' ),
        'add_or_remove_items'        => __( 'Agregar o remover Niveles', 'streannuniv' ),
        'choose_from_most_used'      => __( 'Escoger de los más usados', 'streannuniv' ),
        'popular_items'              => __( 'Niveles Populares', 'streannuniv' ),
        'search_items'               => __( 'Buscar Niveles', 'streannuniv' ),
        'not_found'                  => __( 'No hay resultados', 'streannuniv' ),
        'no_terms'                   => __( 'No hay Niveles', 'streannuniv' ),
        'items_list'                 => __( 'Listado de Niveles', 'streannuniv' ),
        'items_list_navigation'      => __( 'Navegación del Listado de Niveles', 'streannuniv' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => false,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'nivel_cursos', array( 'cursos' ), $args );
}
add_action( 'init', 'streannuniv_custom_post_type', 0 );