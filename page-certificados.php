<?php $levelid = $_GET['levelid']; ?>
<?php $userid = $_GET['user_id']?>
<?php echo get_certificate_pdf($levelid, $userid); ?>
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

<?php get_footer('empty'); ?>
