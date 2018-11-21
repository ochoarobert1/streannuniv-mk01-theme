<?php $levelid = $_GET['levelid']; ?>
<?php $userid = $_GET['user_id']?>
<?php echo get_certificate_pdf($levelid, $userid); ?>
<?php
/* --------------------------------------------------------------
/* CUSTOM REDIRECT IF NOT LOGGED IN
-------------------------------------------------------------- */
if (!is_user_logged_in()) {
    wp_redirect( home_url('/mi-cuenta') );
    exit;
}
?>
<?php get_header('empty'); ?>

<?php get_footer('empty'); ?>
