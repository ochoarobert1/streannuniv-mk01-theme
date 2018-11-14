jQuery(document).ready(function () {
    var iframe = document.querySelector('iframe'),
        player = new Vimeo.Player(iframe),
        playerid_current = iframe.getAttribute('id'),
        playerid_complete_next = jQuery('#video-' + playerid_current).next('div').attr('id'),
        array_playerid = playerid_complete_next.split('-'),
        playerid_next = array_playerid[1];

    player.on('play', function () {
        iframe = document.querySelector('iframe');
        player = new Vimeo.Player(iframe);
        playerid_current = iframe.getAttribute('id');
        playerid_complete_next = jQuery('#video-' + playerid_current).next('div').attr('id');
        array_playerid = playerid_complete_next.split('-');
        playerid_next = array_playerid[1];
    });

    player.on('ended', function () {
        auto_change_video(playerid_next);
        setTimeout(function() {
            var iframe_new = document.querySelector('iframe');
            var player_new = new Vimeo.Player(iframe_new);
            console.log(iframe_new);
            player_new.getVideoTitle().then(function(title) {
                console.log('title:', title);
            });
            player_new.play().then(function() {
                console.log('Listo');
            });
        }, 1000);
    });
});

function auto_change_video(videoid) {
    jQuery.ajax({
        type: 'POST',
        url: ajax_object.ajaxurl,
        data: {
            'action': 'change_next_video', //calls wp_ajax_nopriv_ajaxlogin
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
}
