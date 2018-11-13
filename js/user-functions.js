var passd = false,
    testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
jQuery(document).ready(function (jQuery) {
    "use strict";
    /* ----------------------------------------------------------- */
    /* USER DATA UPDATER
    -------------------------------------------------------------- */
    jQuery('form#user-data').on('submit', function (e) {
        e.preventDefault();
        passd = true;

        var $el = jQuery('#first_name');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            if (!$el.val().match(/^[a-zA-Z ]+$/)) {
                $el.next("small").removeClass("d-none");
                $el.next("small").html("<strong>Error:</strong>Solo se permiten caracteres alfabéticos");
                passd = false;
            } else {
                $el.next("small").addClass("d-none");
            }
        }

        var $el = jQuery('#last_name');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            if (!$el.val().match(/^[a-zA-Z ]+$/)) {
                $el.next("small").removeClass("d-none");
                $el.next("small").html("<strong>Error:</strong>Solo se permiten caracteres alfabéticos");
                passd = false;
            } else {
                $el.next("small").addClass("d-none");
            }
        }

        var $el = jQuery('#business');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        if (passd == true) {
            jQuery('form#user-data div.status').show().html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div><br/>' + ajax_object.loadingmessage);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: {
                    'action': 'user_data_ajax', //calls wp_ajax_nopriv_ajaxlogin
                    'user_id': jQuery('form#user-data #u_id').val(),
                    'first_name': jQuery('form#user-data #first_name').val(),
                    'last_name': jQuery('form#user-data #last_name').val(),
                    'business': jQuery('form#user-data #business').val(),
                    'user-data-security': jQuery('form#user-data #user-data-security').val()
                },
                success: function (data) {
                    jQuery('form#user-data div.status').html(data.message);
                }
            });
        }
    });
    /* ----------------------------------------------------------- */
    /* USER DATA UPDATER
    -------------------------------------------------------------- */
    jQuery('form#social-data').on('submit', function (e) {
        e.preventDefault();
        passd = true;

        var $el = jQuery('#facebook_user');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        var $el = jQuery('#twitter_user');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        var $el = jQuery('#instagram_user');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        if (passd == true) {
            jQuery('form#social-data div.status').show().html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div><br/>' + ajax_object.loadingmessage);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: {
                    'action': 'social_data_ajax', //calls wp_ajax_nopriv_ajaxlogin
                    'user_id': jQuery('form#social-data #u_id').val(),
                    'facebook_user': jQuery('form#social-data #facebook_user').val(),
                    'twitter_user': jQuery('form#social-data #twitter_user').val(),
                    'instagram_user': jQuery('form#social-data #instagram_user').val(),
                    'social-data-security': jQuery('form#social-data #social-data-security').val()
                },
                success: function (data) {
                    jQuery('form#social-data div.status').html(data.message);
                }
            });
        }
    });
}); /* end of as page load scripts */
