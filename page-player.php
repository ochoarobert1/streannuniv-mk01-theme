<?php get_header('empty'); ?>
<?php $id_nivel = $_GET['id']; ?>
<?php $level_array = get_posts(array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date')); ?>
<div class="container-fluid p-0">
    <div class="row no-gutters">
        <div class="video-player-side-container col-3">
            <div class="container">
                <div class="row">
                    <div class="video-player-side-content col-12">
                        <h3>
                            <?php _e('Contenido', 'streannuniv'); ?>
                        </h3>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="<?php _e('Buscar video', 'streannuniv'); ?>" aria-label="<?php _e('Buscar video', 'streannuniv'); ?>" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <?php foreach ($level_array as $level_item) { ?>
                        <div class="video-player-level-container col-12">
                            <h3><?php _e('Nivel', 'streannuser'); ?> <?php echo $level_item->post_title; ?></h3>
                            <?php $array_cursos = new WP_Query(array(
    'post_type' => 'cursos',
    'posts_per_page' => -1,
    'order' => 'DESC',
    'orderby' => 'date',
    'meta_query' => array(
        array(
            'key' => 'su_curso_nivel',
            'value' => array($level_item->ID),
            'compare' => 'IN'
        )))); ?>
                            <?php if ($array_cursos->have_posts()) : ?>
                            <?php $i = 1; ?>
                            <?php while ($array_cursos->have_posts()) : $array_cursos->the_post(); ?>
                            <div class="video-player-curso-item">
                                <?php if ($i = 1) { $curso_id = get_the_ID(); }?>
                                <?php the_title(); ?>
                            </div>
                            <?php $i++; endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>

                            <?php $array_quiz = new WP_Query(array(
    'post_type' => 'quiz',
    'posts_per_page' => -1,
    'order' => 'DESC',
    'orderby' => 'date',
    'meta_query' => array(
        array(
            'key' => 'su_curso_nivel',
            'value' => array($level_item->ID),
            'compare' => 'IN'
        )))); ?>
                            <?php if ($array_quiz->have_posts()) : ?>
                            <?php while ($array_quiz->have_posts()) : $array_quiz->the_post(); ?>
                            <div class="video-player-quiz-item">
                                <?php the_title(); ?>
                            </div>
                            <?php endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-player-video-container col-9">
            <div class="container">
                <div class="row">
                    <div class="video-player-video-content col-12">
                        <div class="embed-responsive embed-responsive-16by9">
                            <?php $video = get_post_meta($curso_id, 'su_curso_link', true); ?>
                            <iframe src="https://player.vimeo.com/video/<?php echo streann_vimeo_fetch($video); ?>" class="embed-responsive-item" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('empty'); ?>
