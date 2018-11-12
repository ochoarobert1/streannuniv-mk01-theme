<?php get_header(); ?>
<main class="container-fluid p-0" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <div class="row no-gutters">
        <?php $banner_meta = get_post_meta( get_the_ID(), 'su_page_banner', true); ?>
        <section class="page-banner taxonomy-banner col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" >
            <div class="page-banner-wrapper"></div>
            <div class="container">
                <div class="row">
                    <div class="taxonomy-logo col-6">

                    </div>
                    <div class="taxonomy-info col-6">
                        <div class="row">
                            <div class="col-12">
                                <h1 itemprop="headline"><?php single_term_title(); ?></h1>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-md btn-curso"><?php _e('Iniciar Curso', 'streannuniv'); ?></a>
                            </div>
                            <div class="col-12">
                                <?php $cursos = get_posts(array(
    'post_type' => 'cursos',
    'numberposts' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'nivel_cursos',
            'field' => 'id',
            'terms' => get_queried_object()->term_id, // Where term_id of Term 1 is "1".
            'include_children' => false
        )
    )
)); ?>
                                <span>1</span> de <span><?php echo count($cursos); ?></span> <?php _e('completados', 'streannuniv'); ?>
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
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
