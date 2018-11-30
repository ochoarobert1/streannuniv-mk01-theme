var passd = false,
    testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
var onloadCallback = function () {
    grecaptcha.render('g-recaptcha', {
        'sitekey': '6LdcX3wUAAAAADweugW4wHBFaz262IRy6KfvyxlP'
    });
};

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


    jQuery('form#register-page').on('submit', function (e) {
        e.preventDefault();
        passd = true;

        var $el = jQuery('#firstname-page');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        var $el = jQuery('#lastname-page');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        var $el = jQuery('#company-page');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        var $el = jQuery('#email-page');
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

        var $el = jQuery('#register-pass-page');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        var $el = jQuery('#confirm-pass-page');
        if (($el.val() == '') || ($el.val() == null) || ($el.val().length < 2)) {
            $el.next("small").removeClass("d-none");
            $el.next("small").html("El campo no puede estar vacio ni tener menos de dos caracteres");
            passd = false;
        } else {
            $el.next("small").addClass("d-none");
        }

        if (jQuery('#register-pass-page').val() != jQuery('#confirm-pass-page').val()) {
            jQuery('#confirm-pass-page').next("small").removeClass("d-none");
            jQuery('#confirm-pass-page').next("small").html("Las contraseñas no pueden ser distintas");
            passd = false;
        }

        if (passd == true) {
            jQuery('form#register-page div.status').show().html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div><br/>' + ajax_object.loadingmessage);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: {
                    'action': 'ajaxpageregister', //calls wp_ajax_nopriv_ajaxlogin
                    'firstname': jQuery('form#register-page #firstname-page').val(),
                    'lastname': jQuery('form#register-page #lastname-page').val(),
                    'company':  jQuery('form#register-page #company-page').val(),
                    'username': jQuery('form#register-page #email-page').val(),
                    'password': jQuery('form#register-page #register-pass-page').val(),
                    'g-recaptcha-response': grecaptcha.getResponse()
                },
                success: function (data) {
                    jQuery('form#register-page div.status').html(data.message);
                    if (data.registered == true) {
                        document.location.href = data.url;
                    }
                }
            });
        }
    });
}); /* end of as page load scripts */
