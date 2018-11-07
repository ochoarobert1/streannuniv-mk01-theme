<?php
class VCExtendAddonClass {

    function __construct() {
        // HOOK FOR VC
        add_action( 'init', array( $this, 'integrateWithVC' ) );

        // CREATING SHORTCODE
        add_shortcode( 'custom_item_counter', array( $this, 'render_custom_item_counter' ) );
        add_shortcode( 'custom_media_item', array( $this, 'render_custom_media_item' ) );
        add_shortcode( 'custom_testimonials_slider', array( $this, 'render_custom_testimonials_slider' ) );
        add_shortcode( 'custom_niveles_item', array( $this, 'render_custom_niveles_item' ) );

        // Register CSS and JS
        add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );

    }

    public function integrateWithVC() {
        // Check if WPBakery Page Builder is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Extend WPBakery Page Builder is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }

        /* GET LEVELS */
        $products_array = array();
        $terms = get_terms( array(
            'taxonomy' => 'nivel_cursos',
            'hide_empty' => false,
        ) );
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $niveles_array[$term->name] = $term->term_id;
            }
        }
        /* GET LEVELS */

        /* WPBakery Logic Script */
        vc_map( array(
            'name' => __('Item Contador Especial', 'streannuniv'),
            'description' => __('Shortcode para insertar un contador automático', 'streannuniv'),
            'base' => 'custom_item_counter',
            'class' => '',
            'controls' => 'full',
            'icon' => get_template_directory_uri() . '/images/favicon.png',
            'category' => __('Content', 'js_composer'),
            //'admin_enqueue_js' => get_template_directory_uri() . '/js/wp_composer_extended.js',
            //'admin_enqueue_css' =>  get_template_directory_uri() . '/css/wp_composer_extended.css',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'class' => '',
                    'heading' => __('Ícono del Contador', 'streannuniv'),
                    'param_name' => 'image_icon',
                    'value' => '',
                    'description' => __('Inserte un ícono del contador. Se redimensionará a 50x50', 'streannuniv')
                ),
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => __('Valor Mínimo', 'streannuniv'),
                    'param_name' => 'min_value',
                    'value' => '',
                    'admin_label' => true,
                    'description' => __('Inserte el valor mínimo del contador. E.G.: 0', 'streannuniv')
                ),
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => __('Valor Máximo', 'streannuniv'),
                    'param_name' => 'max_value',
                    'value' => '',
                    'admin_label' => true,
                    'description' => __('Inserte el valor máximo del contador. E.G.: 100.', 'streannuniv')
                ),

                array(
                    'type' => 'textarea_html',
                    'class' => '',
                    'heading' => __( 'Contenido', 'streannuniv' ),
                    'param_name' => 'content',
                    'value' => '',
                    'admin_label' => true,
                    'description' => __('Ingrese el contenido que irá al final del contador', 'streannuniv')
                )
            )
        ) );

        vc_map( array(
            'name' => __('Item Media Especial', 'streannuniv'),
            'description' => __('Shortcode para insertar un elemento tipo media', 'streannuniv'),
            'base' => 'custom_media_item',
            'class' => '',
            'controls' => 'full',
            'icon' => get_template_directory_uri() . '/images/favicon.png',
            'category' => __('Content', 'js_composer'),
            //'admin_enqueue_js' => get_template_directory_uri() . '/js/wp_composer_extended.js',
            //'admin_enqueue_css' =>  get_template_directory_uri() . '/css/wp_composer_extended.css',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'class' => '',
                    'heading' => __('Ícono del Contador', 'streannuniv'),
                    'param_name' => 'image_icon',
                    'value' => '',
                    'description' => __('Inserte un ícono del contador. Se redimensionará a 50x50', 'streannuniv')
                ),

                array(
                    'type' => 'textarea_html',
                    'class' => '',
                    'heading' => __( 'Contenido', 'streannuniv' ),
                    'param_name' => 'content',
                    'value' => '',
                    'admin_label' => true,
                    'description' => __('Ingrese el contenido que irá al final del contador', 'streannuniv')
                )
            )
        ) );

        vc_map( array(
            'name' => __('Slider de Testimonios', 'streannuniv'),
            'description' => __('Shortcode para insertar un Slider de Testimonios', 'streannuniv'),
            'base' => 'custom_testimonials_slider',
            'class' => '',
            'controls' => 'full',
            'icon' => get_template_directory_uri() . '/images/favicon.png',
            'category' => __('Content', 'js_composer'),
            //'admin_enqueue_js' => get_template_directory_uri() . '/js/wp_composer_extended.js',
            //'admin_enqueue_css' =>  get_template_directory_uri() . '/css/wp_composer_extended.css',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'class' => '',
                    'heading' => __('Cantidad de Testimonios', 'streannuniv'),
                    'param_name' => 'entry_quantity',
                    'value' => '',
                    'admin_label' => true,
                    'description' => __('Inserte la Cantidad de Testimonios a cargar', 'streannuniv')
                ),
            )
        ) );

        vc_map( array(
            'name' => __('Items de Niveles de Cursos', 'streannuniv'),
            'description' => __('Shortcode para insertar un Items de Niveles de Cursos', 'streannuniv'),
            'base' => 'custom_niveles_item',
            'class' => '',
            'controls' => 'full',
            'icon' => get_template_directory_uri() . '/images/favicon.png',
            'category' => __('Content', 'js_composer'),
            //'admin_enqueue_js' => get_template_directory_uri() . '/js/wp_composer_extended.js',
            //'admin_enqueue_css' =>  get_template_directory_uri() . '/css/wp_composer_extended.css',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'class' => '',
                    'heading' => __('Banner del Nivel', 'streannuniv'),
                    'param_name' => 'image_icon',
                    'value' => '',
                    'description' => __('Inserte un Banner del Nivel. Se redimensionará a 50x50', 'streannuniv')
                ),
                array(
                    'type' => 'dropdown',
                    'admin_label' => true,
                    "class" => "",
                    'heading' => __( 'Seleccione Nivel', 'redkraniet' ),
                    'description' => __( 'Seleccione Nivel a colocar en el item.', 'redkraniet' ),
                    'param_name' => 'level_selection',
                    'value' => $niveles_array,
                ),
            )
        ) );
    }

    /* Shortcode logic how it should be rendered */
    public function render_custom_item_counter( $atts, $content ) {
        extract( shortcode_atts( array(
            'image_icon' => 'image_icon',
            'min_value' => 'min_value',
            'max_value' => 'max_value', ), $atts ) );
        $output = '';

        $image_object = wp_get_attachment_image_src($image_icon);

        $image_url = $image_object[0];

        $output .= '<div class="custom-counter-item">';
        $output .= '<img src="'. $image_url .'" class="img-fluid"/>';
        $output .= '<span class="timer" data-from="' . $min_value . '" data-to="' . $max_value . '" data-speed="1000" data-refresh-interval="15"></span>';
        $output .= $content;
        $output .= '</div>';

        return $output;
    }



    /* Shortcode logic how it should be rendered */
    public function render_custom_media_item( $atts, $content ) {
        extract( shortcode_atts( array( 'image_icon' => 'image_icon', ), $atts ) );
        $output = '';

        $image_object = wp_get_attachment_image_src($image_icon);

        $image_url = $image_object[0];

        $output .= '<div class="media custom-media">';
        $output .= '<img src="'. $image_url .'" class="align-self-center img-fluid"/>';
        $output .= '<div class="media-body">';
        $output .= $content;
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }

    /* Shortcode logic how it should be rendered */
    public function render_custom_testimonials_slider( $atts, $content ) {
        extract( shortcode_atts( array( 'entry_quantity' => 'entry_quantity', ), $atts ) );
        $output = '';

        if ($entry_quantity == '') {
            $quantity = 4;
        } else {
            $quantity = $entry_quantity;
        }



        $slider_content = new WP_Query(array('post_type' => 'testimonios', 'posts_per_page' => $quantity, 'order' => 'DESC', 'orderby' => 'date'));
        if ($slider_content->have_posts()) :
        $output .= '<div class="custom-testimonial-slider owl-carousel owl-theme">';


        while ($slider_content->have_posts()) : $slider_content->the_post();
        $output .= '<div class="custom-testimonial-slider-item col-12">';
        $output .= '<div class="container"><div class="row align-items-center">';
        $output .= '<div class="custom-testimonial-slider-item-content col-8">';
        $output .= apply_filters('the_content', get_the_content());
        $output .= '</div>';
        $output .= '<div class="custom-testimonial-slider-item-img col-4">';
        $output .= '<div class="media custom-media">';
        $output .= '<img src="'. get_the_post_thumbnail_url(get_the_ID(), array('100', '100')) .'" class="align-self-center img-fluid img-testimonials"/>';
        $output .= '<div class="media-body">';
        $output .= '<h2>' . get_the_title() . '</h2>';
        $output .= '<p>' . get_post_meta(get_the_ID(), 'su_testimonial_position', true) . '</p>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div></div>';
        $output .= '</div>';
        endwhile;


        $output .= '</div>';
        endif;

        return $output;
    }

    /* Shortcode logic how it should be rendered */
    public function render_custom_niveles_item( $atts, $content ) {
        extract( shortcode_atts( array( 'image_icon' => 'image_icon', 'level_selection' => 'level_selection' ), $atts ) );
        $output = '';

        $image_object = wp_get_attachment_image_src($image_icon, array('350', '195'));

        $image_url = $image_object[0];


        $term = get_term_by( 'id', $level_selection, 'nivel_cursos' );

        $cursos = get_posts(array(
            'post_type' => 'cursos',
            'numberposts' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'nivel_cursos',
                    'field' => 'id',
                    'terms' => $level_selection, // Where term_id of Term 1 is "1".
                    'include_children' => false
                )
            )
        ));
        $output .= '<div class="custom-level-item">';
        $output .= '<div class="custom-level-img-wrapper">';
        $output .= '<img src="'. $image_url .'" class="align-self-center img-fluid"/>';
        $output .= '</div>';
        $output .= '<h3>' . $term->name . '</h3>';
        $output .= '<ul>';
        foreach ($cursos as $curso) {
            $output .= '<li>';
            $output .= '<a href="'. get_term_link($term, 'nivel_curso') .'" title="' . esc_html("Leer Más", "streannuniv") . '">';
            $output .= $curso->post_title;
            $output .= '</a>';
            $output .= '</li>';
        }
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }



    /* Load plugin css and javascript files which you may need on front end of your site */
    public function loadCssAndJs() {
        wp_register_style( 'streannuniv_jscomposer_style', get_template_directory_uri() . '/css/streannuniv_jscomposer_style.css' );
        wp_enqueue_style( 'streannuniv_jscomposer_style' );

        // If you need any javascript files on front end, here is how you can load them.
        wp_enqueue_script( 'countTo-js', get_template_directory_uri() . '/js/jquery.countTo.js', array('jquery') );
        wp_enqueue_script( 'streannuniv_jscomposer_functions', get_template_directory_uri() . '/js/streannuniv_jscomposer_functions.js', array('jquery', 'countTo-js', 'owl-js') );
    }
}

// Finally initialize code
new VCExtendAddonClass();
