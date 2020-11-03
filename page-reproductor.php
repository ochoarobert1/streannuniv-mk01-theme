<?php
/* --------------------------------------------------------------
/* CUSTOM REDIRECT IF NOT LOGGED IN
-------------------------------------------------------------- */
$myaccount_page_id = get_option('streann_myaccount_page_id');
if ( $myaccount_page_id ) {
  $myaccount_page_url = get_permalink( $myaccount_page_id );
}
if (!is_user_logged_in()) {
    wp_redirect( $myaccount_page_url );
    exit;
}
?>
<?php get_header('empty'); ?>
<?php $array_auth = get_authorized_levels(); ?>
<?php $last_approbed = 0; ?>
<?php $level_array = get_posts(array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date', 'post__in' => $array_auth)); ?>
<?php $approved_levels = get_approved_levels(); ?>
<?php $reprobed_times = get_user_meta(get_current_user_id(), 'quiz_reprobred_times', true); ?>
<?php $unlocked_quizzes = (array)get_user_meta(get_current_user_id(), 'quiz_unlocked_level', true);

foreach ($unlocked_quizzes as $key => $value) {
    if (empty($value)) {
        unset($unlocked_quizzes[$key]);
    }
}
if (empty($unlocked_quizzes)) { $unlocked_quizzes = array(); } ?>
<div class="container-fluid p-0">
    <div class="row no-gutters row-player">
        <div class="video-player-side-container col-3">
            <div class="container">
                <div class="row">
                    <div class="video-player-side-content col-12" data-us="<?php echo get_current_user_id(); ?>">
                        <div class="temp-video" data-currentlast=""></div>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Streann University" class="img-fluid" />
                        <a href="<?php echo $myaccount_page_url; ?>" title="<?php _e('Volver a Mi Cuenta', 'streannuniv'); ?>" class="btn btn-md btn-back">
                            <?php _e('Volver a Mi Cuenta', 'streannuniv'); ?></a>
                        <h3 class="main-title">
                            <?php _e('Contenido', 'streannuniv'); ?>
                        </h3>

                        <?php $y = 1; ?>
                        <?php foreach ($level_array as $level_item) { ?>

                        <?php if ($y == 1) { ?>
                        <div class="video-player-level-container">
                            <h3>
                                <?php echo $level_item->post_title; ?>
                            </h3>
                            <?php $array_cursos = get_the_course($level_item->ID); ?>
                            <?php if ($array_cursos->have_posts()) : ?>
                            <?php $count_cursos = $array_cursos->post_count; ?>
                            <?php $i = 1; ?>
                            <?php while ($array_cursos->have_posts()) : $array_cursos->the_post(); ?>
                            <?php if (isset($_GET['curso'])) { $curso_id = $_GET['curso']; ?>
                            <?php if (get_the_ID() == $_GET['curso']) { $active = 'active'; } else { $active = ''; } ?>
                            <?php } else { ?>
                            <?php if (($i == 1) && ($y == 1)) { $curso_id = get_the_ID(); $active = 'active'; } else { $active = ''; } ?>
                            <?php } ?>
                            <?php if ($i == $count_cursos) { $class_last = 'video-player-custom-item-last'; $last_video = get_the_ID(); } else { $class_last = ''; } ?>
                            <div id="video-<?php echo get_the_ID(); ?>" class="video-player-curso-item <?php echo $class_last; ?> <?php echo $active; ?>">
                                <a onclick="change_video(<?php echo get_the_ID(); ?>);" title="<?php _e('Ver Video', 'streannuniv'); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <?php $i++; endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>
                            <?php $array_quiz = get_the_quiz($level_item->ID); ?>
                            <?php if ($array_quiz->have_posts()) : ?>
                            <?php while ($array_quiz->have_posts()) : $array_quiz->the_post(); ?>
                            <div id="quiz-<?php echo get_the_ID(); ?>" class="video-player-quiz-item" data-count="<?php echo $count_cursos; ?>" data-video="<?php echo $last_video; ?>">
                                <?php  if (($reprobed_times < 3) && (in_array($level_item->ID, $unlocked_quizzes))) { ?>
                                <div class="wrapper-lkd-link" style="display: none;"><i class="fa fa-lock"></i></div>
                                <?php } else { /*?>
                                <div class="wrapper-lkd-link"><i class="fa fa-lock"></i></div>
                                <?php */ } ?>
                                <a href="<?php the_permalink(); ?>"><i class="fa fa-file-text" aria-hidden="true"></i>
                                    <?php the_title(); ?></a>

                            </div>
                            <?php endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>
                            <?php if (in_array($level_item->ID, $approved_levels)) { ?>
                            <?php $last_approbed = 1; ?>
                            <?php } else { ?>
                            <?php $last_approbed = 0; ?>
                            <?php } ?>
                        </div>
                        <?php } else { ?>
                        <?php $level_id = $level_item->ID; ?>
                        <?php if (in_array($level_id, $approved_levels, TRUE ) || ($last_approbed == 1)) { ?>
                        <div class="video-player-level-container">
                            <h3>
                                <?php echo $level_item->post_title; ?>
                            </h3>
                            <?php $array_cursos = get_the_course($level_item->ID); ?>
                            <?php if ($array_cursos->have_posts()) : ?>
                            <?php $count_cursos = $array_cursos->post_count; ?>
                            <?php $i = 1; ?>
                            <?php while ($array_cursos->have_posts()) : $array_cursos->the_post(); ?>
                            <?php if (isset($_GET['curso'])) { $curso_id = $_GET['curso']; ?>
                            <?php if (get_the_ID() == $_GET['curso']) { $active = 'active'; } else { $active = ''; } ?>
                            <?php } else { ?>
                            <?php if (($i == 1) && ($y == 1)) { $curso_id = get_the_ID(); $active = 'active'; } else { $active = ''; } ?>
                            <?php } ?>
                            <?php if ($i == $count_cursos) { $class_last = 'video-player-custom-item-last'; $last_video = get_the_ID(); } else { $class_last = ''; } ?>
                            <div id="video-<?php echo get_the_ID(); ?>" class="video-player-curso-item <?php echo $class_last; ?> <?php echo $active; ?>">
                                <a onclick="change_video(<?php echo get_the_ID(); ?>);" title="<?php _e('Ver Video', 'streannuniv'); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </div>
                            <?php $i++; endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>
                            <?php $array_quiz = get_the_quiz($level_item->ID); ?>
                            <?php if ($array_quiz->have_posts()) : ?>
                            <?php while ($array_quiz->have_posts()) : $array_quiz->the_post(); ?>
                            <div id="quiz-<?php echo get_the_ID(); ?>" class="video-player-quiz-item" data-count="<?php echo $count_cursos; ?>" data-video="<?php echo $last_video; ?>">
                                <?php  if (($reprobed_times < 3) && (in_array($level_item->ID, $unlocked_quizzes))) { ?>
                                <div class="wrapper-lkd-link" style="display: none;"><i class="fa fa-lock"></i></div>
                                <?php } else { /* ?>
                                <div class="wrapper-lkd-link"><i class="fa fa-lock"></i></div>
                                <?php */ } ?>
                                <a href="<?php the_permalink(); ?>"><i class="fa fa-file-text" aria-hidden="true"></i>
                                    <?php the_title(); ?></a>

                            </div>
                            <?php endwhile;?>
                            <?php endif; ?>
                            <?php wp_reset_query(); ?>
                            <?php if (in_array($level_item->ID, $approved_levels)) { ?>
                            <?php $last_approbed = 1; ?>
                            <?php } else { ?>
                            <?php $last_approbed = 0; ?>
                            <?php } ?>
                        </div>
                        <?php } else { ?>
                        <div class="video-player-level-container">
                            <h3>
                                <?php echo $level_item->post_title; ?> <span>
                                    <?php _e('Bloqueado', 'streannuniv'); ?></span>
                            </h3>
                            <small>
                                <?php _e('Deberá aprobar el curso anterior', 'streannuniv'); ?></small>
                        </div>
                        <?php } ?>

                        <?php } ?>

                        <?php $y++;  } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="video-player-video-container col-9 align-self-center">

            <div class="container">
                <div class="row">
                    <div class="video-player-video-content col-12">
                        <div id="video_container" class="embed-responsive embed-responsive-16by9">
                            <?php if (isset($_GET['curso'])) { $curso_id = $_GET['curso']; } ?>
                            <?php $video = get_post_meta($curso_id, 'su_curso_link', true); ?>
                            <iframe id="<?php echo $curso_id; ?>" src="https://player.vimeo.com/video/<?php echo streann_vimeo_fetch($video); ?>" class="embed-responsive-item" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen allow="autoplay; encrypted-media"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('empty'); ?>