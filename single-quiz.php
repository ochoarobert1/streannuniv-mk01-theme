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
<?php the_post(); ?>
<?php $level_id = get_post_meta(get_the_ID(), 'su_curso_nivel', true); ?>
<div class="quiz-main-container">
    <div class="container">
        <div class="row row-quiz">
            <div id="<?php echo get_the_ID(); ?>" class="quiz-beginner col-12">
                <?php $reprobred_times = get_user_meta(get_current_user_id(), 'quiz_reprobred_times', true); ?>
                <?php if ($reprobred_times < 3) { ?>
                <h1>
                    <?php the_title(); ?>
                </h1>
                <?php the_content(); ?>
                <button class="btn btn-md btn-quiz">
                    <?php _e('Iniciar Quiz', 'streannuniv'); ?></button>
                <?php } else { ?>
                <h1>
                    <?php the_title(); ?>
                </h1>
                <?php the_content(); ?>
                <p>
                    <?php _e('Te invitamos a repetir el nivel para poder aprobar este quiz y completar tu certificación', 'streannuniv'); ?>
                </p>
                <button onclick="repeat_level(<?php echo $level_id; ?>)" class="btn btn-md btn-repeat">
                    <?php _e('Repetir Qüiz', 'streannteam'); ?></button>
                <?php } ?>
            </div>
            <div class="quiz-test-container quiz-test-hidden col-12">
                <h1 class="text-center">
                    <?php the_title(); ?>
                </h1>
                <div class="progress custom-progress">
                    <div id="quiz_progress" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <form id="quiz-test" method="post" data-enc="">
                    <?php $array_questions = (array)get_post_meta(get_the_ID(), 'preguntas_group', true); ?>
                    <?php $i = 1; ?>

                    <?php foreach ($array_questions as $question_item) { ?>
                    <?php if ($i == 1) { $active = 'quiz-item-active'; } else { $active = ''; }?>
                    <div id="item-<?php echo $i; ?>" class="quiz-item <?php echo $active; ?> col-12">
                        <h4>
                            <?php _e('Pregunta:', 'streannuniv'); ?>
                            <?php echo $i; ?>
                        </h4>
                        <?php echo apply_filters('the_content', $question_item['su_pregunta_text']); ?>
                        <?php $options_array = custom_quiz_question_fetcher($question_item); ?>
                        <?php $y = 1; ?>
                        <?php foreach ($options_array as $options_item) { ?>
                        <?php if ($options_item != '') { ?>
                        <div class="custom-form-control-container">
                            <label><input type="radio" class="custom-form-control" type="radio" name="pregunta_<?php echo $i; ?>" id="pregunta_<?php echo $i; ?>_option_<?php echo $y; ?>" value="<?php echo $y; ?>" />
                                <span>
                                    <?php echo $options_item; ?></span></label>
                        </div>
                        <?php } ?>
                        <?php $y++; } ?>

                    </div>
                    <?php $i++; } ?>
                </form>
            </div>
            <div class="quiz-test-results quiz-test-hidden col-12" data-quantity="<?php echo ($i - 1); ?>">

            </div>
        </div>
    </div>
</div>
<?php get_footer('empty'); ?>
