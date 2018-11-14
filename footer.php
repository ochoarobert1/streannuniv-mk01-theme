<footer class="container-fluid p-0" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
    <div class="row no-gutters">
        <div class="the-footer col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="container">
                <div class="row align-items-center">
                    <div class="footer-item footer-fixed col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="<?php echo home_url('/');?>" title="<?php _e('Volver al Inicio', 'streannuniv'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo('name'); ?>" class="img-fluid" />
                        </a>
                    </div>
                    <div class="footer-item footer-fixed footer-social col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href=""><i class="fa fa-facebook"></i></a>
                        <a href=""><i class="fa fa-twitter"></i></a>
                        <a href=""><i class="fa fa-instagram"></i></a>
                        <a href=""><i class="fa fa-youtube"></i></a>
                    </div>
                </div>
                <div class="row">
                    <?php if ( is_active_sidebar( 'sidebar_footer' ) ) : ?>
                    <div class="footer-item col">
                        <ul id="sidebar-footer">
                            <?php dynamic_sidebar( 'sidebar_footer' ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'sidebar_footer-2' ) ) : ?>
                    <div class="footer-item col">
                        <ul id="sidebar-footer">
                            <?php dynamic_sidebar( 'sidebar_footer-2' ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'sidebar_footer-3' ) ) : ?>
                    <div class="footer-item col">
                        <ul id="sidebar-footer">
                            <?php dynamic_sidebar( 'sidebar_footer-3' ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <?php if ( is_active_sidebar( 'sidebar_footer-4' ) ) : ?>
                    <div class="footer-item col">
                        <ul id="sidebar-footer">
                            <?php dynamic_sidebar( 'sidebar_footer-4' ); ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="footer-copyright col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="container p-0">
                <div class="row no-gutters align-items-center">
                    <div class="footer-copyright-inline col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <h5>Copyright 2018 - Streann.com - Todos los derechos reservados</h5>
                    </div>
                    <div class="footer-copyright-menu col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <a href="">Terms of Use</a><a href="">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php if ( !is_user_logged_in() ) { ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><?php _e('Iniciar Sesión', 'srteannuniv'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="login" action="login" method="post">
                    <div class="row align-items-center form-item">
                        <div class="col-12">
                            <p><?php _e('Ingresa con tus datos y empieza a aprender mediante nuestros cursos', 'streannuniv'); ?></p>
                        </div>
                        <div class="col-12">
                            <input type="text" id="username" name="username" class="form-control" placeholder="<?php _e('Correo electrónico:', 'streannuniv'); ?>" autocomplete="username" />
                            <small class="danger d-none"></small>
                        </div>
                    </div>
                    <div class="row align-items-center form-item">
                        <div class="col-12">
                            <input type="password" id="password" name="password" class="form-control" placeholder="<?php _e('Contraseña:', 'streannuniv'); ?>" autocomplete="current-password" />
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
                    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php wp_footer() ?>
</body>

</html>
