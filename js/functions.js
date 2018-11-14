var passd = false,
    testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
jQuery(document).ready(function (jQuery) {
    "use strict";
    // Perform AJAX login on form submit
    jQuery('form#login').on('submit', function (e) {
        e.preventDefault();
        passd = true;

        var $el = jQuery('#username');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            if (testEmail.test($el.val())) {
                $el.next("small").addClass("d-none");
            } else {
                $el.next("small").removeClass("d-none");
                $el.next("small").html("El correo es invalido. recuerde que debe colocar un correo válido");
                passd = false;
            }
        }

        var $el = jQuery('#password');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        if (passd == true) {
            jQuery('form#login div.status').show().html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div><br/>' + ajax_object.loadingmessage);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: {
                    'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                    'username': jQuery('form#login #username').val(),
                    'password': jQuery('form#login #password').val(),
                    'security': jQuery('form#login #security').val()
                },
                success: function (data) {
                    jQuery('form#login div.status').html(data.message);
                    if (data.loggedin == true) {
                        document.location.href = data.url;
                    }
                }
            });
        }
    });

    jQuery('form#login-page').on('submit', function (e) {
        e.preventDefault();
        passd = true;

        var $el = jQuery('#username-page');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            if (testEmail.test($el.val())) {
                $el.next("small").addClass("d-none");
            } else {
                $el.next("small").removeClass("d-none");
                $el.next("small").html("El correo es invalido. recuerde que debe colocar un correo válido");
                passd = false;
            }
        }

        var $el = jQuery('#password-page');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        if (passd == true) {
            jQuery('form#login-page div.status').show().html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div><br/>' + ajax_object.loadingmessage);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: {
                    'action': 'ajaxpagelogin', //calls wp_ajax_nopriv_ajaxlogin
                    'username': jQuery('form#login-page #username-page').val(),
                    'password': jQuery('form#login-page #password-page').val(),
                },
                success: function (data) {
                    jQuery('form#login-page div.status').html(data.message);
                    if (data.loggedin == true) {
                        document.location.href = data.url;
                    }
                }
            });
        }
    });


}); /* end of as page load scripts */

function change_video(videoid) {
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
}
