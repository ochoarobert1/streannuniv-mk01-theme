var currentQuizID = 0,
    currentOptionID = 0,
    selectedOptionID = 0,
    multipleOptionVal,
    objResponse,
    OptC,
    nextItem = 0,
    acum = 0,
    quizQuantity = 0,
    decript;

jQuery(document).ready(function () {
    currentQuizID = jQuery('.quiz-beginner').attr('id');
    quizQuantity = jQuery('.quiz-test-results').attr('data-quantity');

    jQuery.ajax({
        type: 'POST',
        url: ajax_object.ajaxurl,
        dataType: 'JSON',
        data: {
            'action': 'get_quiz_right_answers',
            'quiz_id': currentQuizID
        },
        success: function (data) {
            var result = btoa(data);
            jQuery('#quiz-test').attr('data-enc', result);

        }
    });

    jQuery('.btn-quiz').on('click touchstart', function () {
        jQuery('.quiz-beginner').addClass('quiz-test-hidden');
        jQuery('.quiz-test-container').removeClass('quiz-test-hidden');
        jQuery('#quiz-test span').removeClass('opt-green');
        jQuery('#quiz-test span').removeClass('opt-red');
        jQuery("#quiz-test :input").attr("disabled", false);
        jQuery("#quiz-test :input").prop('checked', false);
        jQuery("#item-" + quizQuantity).removeClass('quiz-item-active');
        jQuery("#item-1").addClass('quiz-item-active');
        acum = 0;
    });

    jQuery('input[type=radio]').change(function () {
        selectedOptionID = jQuery(this).val();
        multipleOptionVal = jQuery(this).attr('id').split('_');
        decrypt = '[' + atob(jQuery('#quiz-test').attr('data-enc')) + ']';
        objResponse = JSON.parse(decrypt);

        OptC = objResponse[(multipleOptionVal[1]) - 1];

        if (OptC == selectedOptionID) {
            jQuery(this).next('span').addClass('opt-green');
            acum = acum + 1;
        } else {
            jQuery(this).next('span').addClass('opt-red');
            jQuery("#item-" + multipleOptionVal[1] + " :input").attr("disabled", true);
        }

        setTimeout(function () {
            if (multipleOptionVal[1] != quizQuantity) {
                jQuery("#item-" + multipleOptionVal[1]).removeClass('quiz-item-active');
                nextItem = Number(multipleOptionVal[1]) + 1;
                jQuery("#item-" + nextItem).addClass('quiz-item-active');
            } else {
                jQuery('.quiz-test-container').addClass('quiz-test-hidden');
                jQuery('.quiz-test-results').removeClass('quiz-test-hidden');
                jQuery.ajax({
                    type: 'POST',
                    url: ajax_object.ajaxurl,
                    data: {
                        'action': 'get_quiz_results',
                        'acum': acum,
                        'quantity': quizQuantity,
                        'quiz_id': currentQuizID
                    },
                    success: function (data) {
                        jQuery('.quiz-test-results').html(data);
                        jQuery('.circle-loader').toggleClass('load-complete');
                        jQuery('.checkmark').toggleClass('draw');
                    }
                });
            }
        }, 1000);

    });



});

function repeat_quiz() {
    "use strict";
    jQuery('.quiz-test-results').addClass('quiz-test-hidden');
    jQuery('.quiz-beginner').removeClass('quiz-test-hidden');
}

function repeat_level(level_id) {
    jQuery.ajax({
        type: 'POST',
        url: ajax_object.ajaxurl,
        data: {
            'action': 'repeat_level_by_quiz',
            'level_id': level_id
        },
        success: function (data) {
            window.location = data;
        }
    });


}
