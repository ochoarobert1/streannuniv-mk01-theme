var passd = false,
    scrollHeight = 0,
    lastScrollTop = 0,
    flag = false,
    st = jQuery(document).scrollTop(),
    secondaryNav = jQuery('.home-menu-section-content'),
    secondaryNavTopPosition = secondaryNav.offset().top,
    testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
jQuery(document).ready(function (jQuery) {
    "use strict";
    jQuery(window).on('scroll', function () {
        //        st > lastScrollTop ? jQuery(".floating-nav").addClass("is-hidden") : jQuery(window).scrollTop() > 200 ? (jQuery(".floating-nav").removeClass("is-hidden"), setTimeout(function () {}, 200)) : jQuery(".floating-nav").addClass("is-hidden"), lastScrollTop = st, 0 == jQuery(this).scrollTop() && jQuery(".floating-nav").addClass("is-hidden");

        if (jQuery(window).scrollTop() > 10) {
            jQuery('.header-mobile').addClass('fixed-mobile');
        } else {
            jQuery('.header-mobile').removeClass('fixed-mobile');
        }

        if (jQuery(window).scrollTop() > secondaryNavTopPosition) {
            secondaryNav.addClass('is-fixed');
            setTimeout(function () {
                jQuery('.home-menu-logo').removeClass('hidden');
                jQuery('.home-menu-bar').removeClass('hidden');
                jQuery('.home-menu-logo').addClass('slide-in-left');
                jQuery('.home-menu-bar').addClass('slide-in-right');
            }, 50);
        } else {
            secondaryNav.removeClass('is-fixed');
            setTimeout(function () {
                jQuery('.home-menu-logo').removeClass('slide-in-left');
                jQuery('.home-menu-bar').removeClass('slide-in-right');
                jQuery('.home-menu-logo').addClass('hidden');
                jQuery('.home-menu-bar').addClass('hidden');
            }, 50);
        }
    });

    jQuery('#menu_icon').on('click touchstart', function () {
        jQuery(this).toggleClass('open');
        jQuery('.home-menu-extra').toggleClass('home-menu-extra-hidden');
    });

    jQuery('#menu-btn-mobile').on('click touchstart', function () {
        if (!flag) {
            flag = true;
            jQuery(this).toggleClass('open');
            jQuery('.navbar-mobile-collapse').toggleClass('navbar-mobile-collapse-hidden');
            jQuery('.header-mobile').toggleClass('fixed-click-mobile');
            setTimeout(function () {
                flag = false;
            }, 300);
        }
    });



    jQuery('#search_opener').on('click touchstart', function () {
        jQuery('.search-container').removeClass('search-container-hidden');
    });

    jQuery('#search_closer').on('click touchstart', function () {
        jQuery('.search-container').addClass('search-container-hidden');
    });

     jQuery('#menu_icon').on('click touchstart', function () {
        jQuery(this).toggleClass('open');
        jQuery('.home-menu-extra').toggleClass('home-menu-extra-hidden');
    });

    jQuery('#menu-btn-mobile').on('click touchstart', function () {
        if (!flag) {
            flag = true;
            jQuery(this).toggleClass('open');
            jQuery('.navbar-mobile-collapse').toggleClass('navbar-mobile-collapse-hidden');
            jQuery('.header-mobile').toggleClass('fixed-click-mobile');
            setTimeout(function () {
                flag = false;
            }, 300);
        }
    });

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
