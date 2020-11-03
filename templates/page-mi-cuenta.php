<?php
/**
* Template Name: Template - Mi Cuenta
*
* @package streannuniv
* @subpackage streannuniv-mk01-theme
* @since Mk. 1.0
*/
?>
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
                                        <a class="nav-link" id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">
                                            <i class="fa fa-th"></i>
                                            <?php _e('Cursos Disponibles', 'streannuniv'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="certificate-tab" data-toggle="tab" href="#certificate" role="tab" aria-controls="certificate" aria-selected="false">
                                            <i class="fa fa-certificate"></i>
                                            <?php _e('Certificados', 'streannuniv'); ?></a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo wp_logout_url( get_permalink() ); ?>" class="nav-link">
                                            <i class="fa fa-user"></i>
                                            <?php _e('Cerrar Sesión', 'streannuniv'); ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-xl-9 col-lg-9 col-md-9 col-sm-8">

                                <div class="tab-content tab-user" id="myTabContent">
                                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                        <h2 class="main-title">
                                            <?php _e('Escritorio', 'streannuniv'); ?>
                                        </h2>
                                        <div class="row">
                                            <?php $course_approbed = get_approved_levels(); ?>
                                            <?php $user_altered = get_user_meta(get_current_user_id(), 'user_altered', true); ?>
                                            <?php if (!empty($course_approbed)) { ?>

                                            <div class="dashboard-item col-12">
                                                <h2>
                                                    <?php _e('Cursos Aprobados', 'streannuniv')?>
                                                </h2>
                                                <div class="row">
                                                    <?php foreach ($course_approbed as $course_item) { ?>
                                                    <?php $course_post = get_post($course_item); ?>
                                                    <div class="my-account-course-item col">
                                                        <div class="course-item-wrapper">
                                                            <h3>
                                                                <?php echo $course_post->post_title; ?>
                                                            </h3>
                                                            <a href="<?php echo home_url('/certificados'); ?><?php echo '?levelid=' . $course_post->ID . '&user_id=' . get_current_user_id(); ?>" class="btn btn-md btn-certificate" target="_blank">
                                                                <?php _e('Imprimir Certificado', 'streannuniv'); ?></a>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <?php  } else { ?>
                                            <?php if ($user_altered == 2) { ?>
                                            <div class="not-started col-12">
                                                <h4>
                                                    <?php _e('Todavía no ha completado satisfactoriamente ninguno de los cursos asignados. Para comenzar, haga clic en "Iniciar Certificación"', 'streannuniv'); ?>
                                                </h4>
                                                <a href="<?php echo home_url('/reproductor'); ?>" class="btn btn-md btn-certificate">
                                                    <?php _e('Iniciar Certificación', 'streannuniv'); ?></a>
                                            </div>
                                            <?php } ?>
                                            <?php if ($user_altered == 1) { ?>
                                            <div class="not-started col-12">
                                                <h4>
                                                    <?php _e('Los cursos que debe realizar han sido habilitados. Haga clic en "Iniciar Certificación" para comenzar', 'streannuniv')?>
                                                </h4>
                                                <a href="<?php echo home_url('/reproductor'); ?>" class="btn btn-md btn-certificate">
                                                    <?php _e('Iniciar Certificación', 'streannuniv'); ?></a>
                                                <?php update_user_meta(get_current_user_id(), 'user_altered', 2); ?>
                                            </div>
                                            <?php } ?>
                                            <?php if ($user_altered == 0) { ?>
                                            <div class="not-started col-12">
                                                <h4>
                                                    <?php _e('En las próximas horas se le habilitará los cursos que debe realizar. Si pasadas 24 horas no se le han habilitado, por favor contáctenos en', 'streannuniv')?> <a href="mailto:edu@streann.com">edu@streann.com</a></h4>
                                            </div>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php $array_auth = get_authorized_levels(); ?>
                                            <?php $level_array = get_posts(array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date', 'post__in' => $array_auth)); ?>
                                            <?php if (empty($course_approbed)) { ?>
                                            <?php $total_approbed = 0; ?>
                                            <?php } else { ?>
                                            <?php $total_approbed = count($course_approbed); ?>
                                            <?php } ?>

                                            <?php if (empty($level_array)) { ?>
                                            <?php $total_levels = 0; ?>
                                            <?php } else { ?>
                                            <?php $total_levels = count($level_array); ?>
                                            <?php } ?>
                                            <div class="dashboard-item col-12">
                                                <h2>
                                                    <?php _e('Progreso de Certificación', 'streannuniv'); ?>
                                                </h2>
                                                <div class="progress">
                                                    <?php if ($total_approbed === 0 ) { ?>
                                                    <?php $total = 0; ?>
                                                    <?php } else { ?>
                                                    <?php $total = ($total_approbed * 100) / $total_levels; ?>
                                                    <?php } ?>

                                                    <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: <?php echo number_format($total, 0); ?>%;" aria-valuenow="<?php echo number_format($total, 0); ?>" aria-valuemin="0" aria-valuemax="100">
                                                        <?php echo number_format($total, 0); ?>%</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="datapers" role="tabpanel" aria-labelledby="datapers-tab">
                                        <h2 class="main-title">
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
                                        <h2 class="main-title">
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
                                    <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                                        <h2 class="main-title">
                                            <?php _e('Cursos Disponibles', 'streannuniv'); ?>
                                        </h2>
                                        <p>
                                            <?php _e('Aquí tiene un listado de los cursos / niveles que tiene disponible', 'streannuniv'); ?>
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
                                                        <?php echo get_the_title(); ?>
                                                    </h3>
                                                    <a href="<?php echo home_url('/reproductor'); ?>" class="btn btn-md btn-certificate" target="_blank">
                                                        <?php _e('Iniciar Certificación', 'streannuniv'); ?></a>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <?php endwhile; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="certificate" role="tabpanel" aria-labelledby="certificate-tab">
                                        <h2 class="main-title">
                                            <?php _e('Certificados', 'streannuniv'); ?>
                                        </h2>
                                        <p>
                                            <?php _e('Aquí tiene un listado de los documentos digitales que usted ha generado durante el proceso de certificación', 'streannuniv'); ?>
                                        </p>
                                        <div class="row">
                                            <?php $authorized_levels = get_approved_levels(); ?>
                                            <?php $args = array('post_type' => 'nivel', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'date'); ?>
                                            <?php $nivel_list = new WP_Query($args); ?>
                                            <?php if ($nivel_list->have_posts()) : ?>
                                            <?php while ($nivel_list->have_posts()) : $nivel_list->the_post(); ?>
                                            <?php if (in_array(get_the_ID(), $authorized_levels)) { ?>
                                            <div class="certificate-item col-4">
                                                <div class="certificate-item-wrapper">
                                                    <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                                                    <h3>
                                                        <?php echo get_the_title(); ?>
                                                    </h3>
                                                    <a href="<?php echo home_url('/certificados'); ?><?php echo '?levelid=' . get_the_ID() . '&user_id=' . get_current_user_id(); ?>" class="btn btn-md btn-certificate" target="_blank">
                                                        <?php _e('Imprimir Certificado', 'streannuniv'); ?></a>
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
                            <div class="my-account-login-container col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row align-items-center justify-content-center">
                                    <div class="my-account-login-content col-xl-10 col-lg-10 col-md-10 col-sm-12 col-12">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="form-login-image col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/account-login.png" alt="Login" class="img-fluid" />
                                            </div>
                                            <div class="form-login-container col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                                                <h4>
                                                    <?php _e('Iniciar Sesión', 'streannuniv'); ?>
                                                </h4>
                                                <form id="login-page" action="login" method="post">
                                                    <div class="row align-items-center form-item">
                                                        <div class="col-12">
                                                            <p>
                                                                <?php _e('Ingresa con tus datos y empieza a aprender mediante nuestros cursos', 'streannuniv'); ?>
                                                            </p>
                                                        </div>
                                                        <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <input type="text" id="username-page" name="username" class="form-control" placeholder="<?php _e('Correo electrónico:', 'streannuniv'); ?>" autocomplete="username" />
                                                            <small class="danger d-none"></small>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center form-item">
                                                        <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <input type="password" id="password-page" name="password" class="form-control" placeholder="<?php _e('Contraseña:', 'streannuniv'); ?>" autocomplete="current-password" />
                                                            <small class="danger d-none"></small>
                                                        </div>
                                                        <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">
                                                                <?php _e('¿Has perdido tu contraseña?', 'streannuniv'); ?></a>
                                                        </div>
                                                    </div>
                                                    <div class="row align-items-center justify-content-end form-item">
                                                        <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 status"></div>
                                                        <div class=" col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                            <button class="btn btn-md btn-login">
                                                                <?php _e('Ingresar', 'streannuniv'); ?></button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="register-container  col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <hr>
                                                    <h4>
                                                        <?php _e('¿ No posee una cuenta? Registrese aquí', 'streannuniv'); ?>
                                                    </h4>
                                                    <form id="register-page" method="post">
                                                        <div class="row align-items-center form-item">
                                                            <div class="col-12">
                                                                <input type="text" id="firstname-page" name="firstname" class="form-control" placeholder="<?php _e('Nombre:', 'streannuniv'); ?>" autocomplete="firstname" />
                                                                <small class="danger d-none"></small>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center form-item">
                                                            <div class="col-12">
                                                                <input type="text" id="lastname-page" name="lastname" class="form-control" placeholder="<?php _e('Apellido:', 'streannuniv'); ?>" autocomplete="lastname" />
                                                                <small class="danger d-none"></small>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center form-item">
                                                            <div class="col-12">
                                                                <input type="text" id="company-page" name="company" class="form-control" placeholder="<?php _e('Compañía:', 'streannuniv'); ?>" autocomplete="company" />
                                                                <small class="danger d-none"></small>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center form-item">
                                                            <div class="col-12">
                                                                <input type="text" id="email-page" name="email" class="form-control" placeholder="<?php _e('Correo electrónico:', 'streannuniv'); ?>" autocomplete="email" />
                                                                <small class="danger d-none"></small>
                                                            </div>
                                                        </div>
                                                        <div class="row align-items-center form-item">
                                                            <div class="col-12">
                                                                <input type="password" id="register-pass-page" name="password" class="form-control" placeholder="<?php _e('Contraseña:', 'streannuniv'); ?>" autocomplete="current-password" />
                                                                <small class="danger d-none"></small>
                                                            </div>

                                                        </div>
                                                        <div class="row align-items-center form-item">
                                                            <div class="col-12">
                                                                <input type="password" id="confirm-pass-page" name="password" class="form-control" placeholder="<?php _e('Confirmar Contraseña:', 'streannuniv'); ?>" autocomplete="current-password" />
                                                                <small class="danger d-none"></small>
                                                            </div>
                                                        </div>


                                                        <div id="g-recaptcha"></div>
                                                        <div class="row align-items-center justify-content-end form-item">
                                                            <div class="col-12 status"></div>
                                                            <div class="col-12">
                                                                <button class="btn btn-md btn-login">
                                                                    <?php _e('Registrarse', 'streannuniv'); ?></button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
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
