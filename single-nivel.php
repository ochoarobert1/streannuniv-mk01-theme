<?php get_header(); ?>
<?php the_post(); ?>
<main class="container-fluid p-0" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <div class="row no-gutters">
        <?php $banner_meta = get_post_meta( get_the_ID(), 'su_page_banner', true); ?>
        <section class="page-banner taxonomy-banner col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-banner-wrapper"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="taxonomy-logo col-6">
                        <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                    </div>
                    <div class="taxonomy-info col-6">
                        <div class="row">
                            <div class="col-12">
                                <h1 itemprop="headline">
                                    <?php the_title(); ?>
                                </h1>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-md btn-curso" href="<?php echo home_url('/reproductor'); ?>">
                                    <?php _e('Iniciar Curso', 'streannuniv'); ?></a>
                            </div>
                            <div class="taxonomy-counter col-12">
                                <?php $cursos = get_posts(array(
    'post_type' => 'cursos',
    'numberposts' => -1,
    'meta_query' => array(
        array(
            'key' => 'su_curso_nivel',
            'value' => array(get_the_ID()),
            'compare' => 'IN'
        )
    )
)); ?>
                                <span>1</span> de <span>
                                    <?php echo count($cursos); ?></span>
                                <?php _e('elementos completados', 'streannuniv'); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="taxonomy-container  col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" role="article" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="section-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="desc-tab" data-toggle="tab" href="#desc" role="tab" aria-controls="desc" aria-selected="true">
                                    <?php _e('Descripción', 'streannuniv'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="false">
                                    <?php _e('Contenido', 'streannuniv'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="material-tab" data-toggle="tab" href="#material" role="tab" aria-controls="material" aria-selected="false">
                                    <?php _e('Material de Apoyo', 'streannuniv'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="more-tab" data-toggle="tab" href="#more" role="tab" aria-controls="more" aria-selected="false">
                                    <?php _e('Más Información', 'streannuniv'); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="desc" role="tabpanel" aria-labelledby="desc-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="nivel-descarea-content col-12">
                                            <h2>
                                                <?php _e('Descripción del curso', 'streannuniv'); ?>
                                            </h2>
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="content" role="tabpanel" aria-labelledby="content-tab">
                                <div class="container">
                                    <div class="row">
                                        <div class="nivel-contentarea-content col-12">
                                            <h2>
                                                <?php _e('Contenido', 'streannuniv'); ?>
                                            </h2>
                                            <?php $array_cursos = get_the_course(get_the_ID()); ?>
                                            <?php if ($array_cursos->have_posts()) : ?>
                                            <?php $i = 1; ?>
                                            <?php while ($array_cursos->have_posts()) : $array_cursos->the_post(); ?>
                                            <div class="nivel-curso-item col-12">
                                                <a href="<?php echo home_url('/reproductor?curso=' . get_the_ID());?>" title="<?php _e('Ver Video', 'streannuniv'); ?>"><h4><span>
                                                        <?php echo $i; ?>.-</span>
                                                    <?php the_title(); ?>
                                                </h4></a>
                                                <?php the_content(); ?>
                                            </div>
                                            <?php $i++; endwhile; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="material" role="tabpanel" aria-labelledby="material-tab">...</div>
                            <div class="tab-pane fade" id="more" role="tabpanel" aria-labelledby="more-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
