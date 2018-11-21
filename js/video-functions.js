var lastvideo = 0,
    lastvideoID,
    iframe,
    player,
    playerid_current = 0,
    playerid_complete_next = 0,
    array_playerid,
    playerid_next = 0;

jQuery(document).ready(function () {
    'use strict';
    iframe = document.querySelector('iframe'),
        player = new Vimeo.Player(iframe),
        playerid_current = iframe.getAttribute('id'),
        playerid_complete_next = jQuery('#video-' + playerid_current).next('div').attr('id'),
        array_playerid = playerid_complete_next.split('-'),
        playerid_next = array_playerid[1];
});

function change_video(videoid) {


    jQuery.ajax({
        type: 'POST',
        url: ajax_object.ajaxurl,
        data: {
            'action': 'get_last_video', //calls wp_ajax_nopriv_ajaxlogin
            'videoid': videoid
        },
        success: function (data) {
            jQuery('.temp-video').attr('data-currentlast', data);
        }
    });

    setTimeout(function () {
        lastvideoID = jQuery('.temp-video').attr('data-currentlast');
        if (videoid == lastvideoID) {
            var userid = jQuery('.video-player-side-content').attr('data-us');
            console.log(userid);
            jQuery.ajax({
                type: 'POST',
                url: ajax_object.ajaxurl,
                data: {
                    'action': 'remove_reprobed_pointer', //calls wp_ajax_nopriv_ajaxlogin
                    'userid': userid,
                    'videoid': videoid
                },
                success: function (data) {
                    jQuery('*[data-video="' + videoid + '"]').find('div').css('display', 'none');
                }
            });
        }
        jQuery.ajax({
            type: 'POST',
            url: ajax_object.ajaxurl,
            data: {
                'action': 'change_current_video', //calls wp_ajax_nopriv_ajaxlogin
                'videoid': videoid
            },
            beforeSend: function () {
                jQuery('#video_container').html('<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
                jQuery('.video-player-level-container div').removeClass('active');
                jQuery('#video-' + videoid).addClass('active');
            },
            success: function (data) {
                jQuery('#video_container').html(data);
            }
        });
    }, 1000);
}
