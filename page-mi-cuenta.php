<?php get_header(); ?>
<?php the_post(); ?>
<main class="container-fluid p-0" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
    <div class="row no-gutters">
        <?php $banner_meta = get_post_meta( get_the_ID(), 'su_page_banner', true); ?>
        <section class="page-banner col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="background: url(<?php echo $banner_meta; ?>);">
            <div class="page-banner-wrapper"></div>
            <div class="container">
                <div class="row">
                    <div class="section-title col-12">
                        <h1 itemprop="headline">
                            <?php the_title(); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </section>
        <section id="post-<?php the_ID(); ?>" class="page-container  col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" role="article" itemscope itemtype="http://schema.org/BlogPosting">
            <div class="container">
                <div class="row">
                    <div class="section-container user-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">
                            <?php if (is_user_logged_in()) { ?>
                            <div class="col-12 col-xl-3 col-lg-3 col-md-3 col-sm-4">
                                <ul class="nav nav-tabs nav-user flex-column" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">
                                            <i class="fa fa-home"></i>
                                            <?php _e('Escritorio', 'streannuniv'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="datapers-tab" data-toggle="tab" href="#datapers" role="tab" aria-controls="datapers" aria-selected="false">
                                            <i class="fa fa-user-o"></i>
                                            <?php _e('Datos Personales', 'streannuniv'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false">
                                            <i class="fa fa-share-alt"></i>
                                            <?php _e('Redes Sociales', 'streannuniv'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="certificate-tab" data-toggle="tab" href="#certificate" role="tab" aria-controls="certificate" aria-selected="false">
                                            <i class="fa fa-certificate"></i>
                                            <?php _e('Certificados', 'streannuniv'); ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-xl-9 col-lg-9 col-md-9 col-sm-8">

                                <div class="tab-content tab-user" id="myTabContent">
                                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <h2>
                                            <?php _e('Escritorio', 'streannuniv'); ?>
                                        </h2>
                                        <div class="row">
                                            <div class="dashboard-item col-4">
                                                <h3>
                                                    <?php _e('Último video visto', 'streannuniv'); ?>
                                                </h3>
                                            </div>
                                            <div class="dashboard-item col-4">
                                                <h3>
                                                    <?php _e('Quiz realizados', 'streannuniv'); ?>
                                                </h3>
                                            </div>
                                            <div class="dashboard-item col-4">
                                                <h3>
                                                    <?php _e('Total tiempo', 'streannuniv'); ?>
                                                </h3>
                                            </div>
                                            <div class="dashboard-item col-12">
                                                <h3>
                                                    <?php _e('Progreso de Certificación', 'streannuniv'); ?>
                                                </h3>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="datapers" role="tabpanel" aria-labelledby="datapers-tab">
                                        <h2>
                                            <?php _e('Datos Personales', 'streannuniv'); ?>
                                        </h2>
                                        <p>
                                            <?php _e('Asegúrese de tener sus datos correctos, ya que los certificados se generan digitalmente a partir de ellos.', 'streannuniv'); ?>
                                        </p>
                                        <form id="user-data" type="POST" action="">
                                            <?php wp_nonce_field( 'user-data-nonce', 'user-data-security' ); ?>
                                            <input type="hidden" name="u_id" id="u_id" value="<?php echo get_current_user_id(); ?>" />
                                            <div class="custom-user-form-field col-12">
                                                <label for="first_name">
                                                    <?php _e('Nombre:', 'streannuniv'); ?></label>
                                                <input type="text" id="first_name" name="first_name" class="form-control" placeholder="<?php _e('Coloque su nombre', 'streannuniv'); ?>" value="<?php echo get_user_meta(get_current_user_id(), 'first_name', true); ?>" />
                                                <small class="d-none danger"></small>
                                            </div>
                                            <div class="custom-user-form-field col-12">
                                                <label for="first_name">
                                                    <?php _e('Apellido:', 'streannuniv'); ?></label>
                                                <input type="text" id="last_name" name="last_name" class="form-control" placeholder="<?php _e('Coloque su apellido', 'streannuniv'); ?>" value="<?php echo get_user_meta(get_current_user_id(), 'last_name', true); ?>" />
                                                <small class="d-none danger"></small>
                                            </div>
                                            <div class="custom-user-form-field col-12">
                                                <label for="first_name">
                                                    <?php _e('Empresa:', 'streannuniv'); ?></label>
                                                <input type="text" id="business" name="business" class="form-control" placeholder="<?php _e('Coloque la empresa a la cual esta laborando', 'streannuniv'); ?>" value="<?php echo get_user_meta(get_current_user_id(), 'business', true); ?>" />
                                                <small class="d-none danger"></small>
                                            </div>
                                            <div class="custom-user-form-field col-12">
                                                <div class="status"></div>
                                                <button class="btn btn-md btn-submit">
                                                    <?php _e('Guardar Cambios', 'streannuniv'); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
                                        <h2>
                                            <?php _e('Redes Sociales', 'streannuniv'); ?>
                                        </h2>
                                        <p>
                                            <?php _e('Manténgase conectado con nosotros, mediante estas redes sociales podrás estar enterado de avances, promociones, nuevos cursos, etc.', 'streannuniv'); ?>
                                        </p>
                                        <form id="social-data" type="POST" action="">
                                            <?php wp_nonce_field( 'social-data-nonce', 'social-data-security' ); ?>
                                            <input type="hidden" name="u_id" id="u_id" value="<?php echo get_current_user_id(); ?>" />
                                            <div class="custom-user-form-field col-12">
                                                <label for="facebook_user">
                                                    <i class="fa fa-facebook-square"></i>
                                                    <?php _e('Perfil de Facebook:', 'streannuniv'); ?></label>
                                                <input type="text" id="facebook_user" name="facebook_user" class="form-control" placeholder="<?php _e('E.G.: https://www.facebook.com/nombre-de-usuario/', 'streannuniv'); ?>" value="<?php echo get_user_meta(get_current_user_id(), 'facebook_user', true); ?>" />
                                                <small class="d-none danger"></small>
                                            </div>
                                            <div class="custom-user-form-field col-12">
                                                <label for="twitter_user">
                                                    <i class="fa fa-twitter"></i>
                                                    <?php _e('Perfil de Twitter:', 'streannuniv'); ?></label>
                                                <input type="text" id="twitter_user" name="twitter_user" class="form-control" placeholder="<?php _e('E.G.: @nombre-de-usuario', 'streannuniv'); ?>" value="<?php echo get_user_meta(get_current_user_id(), 'twitter_user', true); ?>" />
                                                <small class="d-none danger"></small>
                                            </div>
                                            <div class="custom-user-form-field col-12">
                                                <label for="instagram_user">
                                                    <i class="fa fa-instagram"></i>
                                                    <?php _e('Usuario de Instagram:', 'streannuniv'); ?></label>
                                                <input type="text" id="instagram_user" name="instagram_user" class="form-control" placeholder="<?php _e('E.G.: @nombre-de-usuario', 'streannuniv'); ?>" value="<?php echo get_user_meta(get_current_user_id(), 'instagram_user', true); ?>" />
                                                <small class="d-none danger"></small>
                                            </div>
                                            <div class="custom-user-form-field col-12">
                                                <div class="status"></div>
                                                <button class="btn btn-md btn-submit">
                                                    <?php _e('Guardar Cambios', 'streannuniv'); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                                        <h2>
                                            <?php _e('Certificados', 'streannuniv'); ?>
                                        </h2>
                                        <p>
                                            <?php _e('Aquí tiene un listado de los documentos digitales que usted ha generado durante el proceso de certificación', 'streannuniv'); ?>
                                        </p>
                                        <div class="row">
                                            <?php $authorized_levels = get_authorized_levels(); ?>
                                            <?php $args = array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date'); ?>
                                            <?php $nivel_list = new WP_Query($args); ?>
                                            <?php if ($nivel_list->have_posts()) : ?>
                                            <?php while ($nivel_list->have_posts()) : $nivel_list->the_post(); ?>
                                            <?php if (in_array(get_the_ID(), $authorized_levels)) { ?>
                                            <div class="certificate-item col-4">
                                                <div class="certificate-item-wrapper">
                                                    <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                                                    <h3>
                                                        <?php _e('Nivel'); ?>
                                                        <?php echo get_the_title(); ?>
                                                    </h3>

                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php endwhile; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <?php } else { ?>
                            <div class="my-account-login-container col-12">
                                <div class="row align-items-center justify-content-center">
                                    <div class="my-account-login-content col-6">
                                        <form id="login-page" action="login" method="post">
                                            <div class="row align-items-center form-item">
                                                <div class="col-12">
                                                    <p><?php _e('Ingresa con tus datos y empieza a aprender mediante nuestros cursos', 'streannuniv'); ?></p>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" id="username-page" name="username" class="form-control" placeholder="<?php _e('Correo electrónico:', 'streannuniv'); ?>" autocomplete="username" />
                                                    <small class="danger d-none"></small>
                                                </div>
                                            </div>
                                            <div class="row align-items-center form-item">
                                                <div class="col-12">
                                                    <input type="password" id="password-page" name="password" class="form-control" placeholder="<?php _e('Contraseña:', 'streannuniv'); ?>" autocomplete="current-password" />
                                                    <small class="danger d-none"></small>
                                                </div>
                                                <div class="col-12">
                                                    <a class="lost" href="<?php echo wp_lostpassword_url(); ?>"><?php _e('¿Has perdido tu contraseña?'); ?></a>
                                                </div>
                                            </div>
                                            <div class="row align-items-center justify-content-end form-item">
                                                <div class="col-12 status"></div>
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-login"><?php _e('Ingresar', 'streannuniv'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php get_footer(); ?>
