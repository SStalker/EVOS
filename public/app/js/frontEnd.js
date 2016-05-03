/**
 * Created by davidherzog on 09.04.16.
 */

$(document).ready(function() {
    var jqXhr;
    $('#quizAlert').on('click', function() {
        $('#quizAlert').toggleClass('in');
        $('#quizAlert').toggleClass('out');
    })

    $('#quizPinBtn').on('click', function(e) {
        
        var quizPin = $('#quizPinInput').val();
        jqXhr = $.ajax('/quiz/'+quizPin)
            .done(function(response) {
            
                if (response == 'quiz_exists') {
                    $('#enterQuizPanel').fadeOut(400, function() {
                       $('#enterNamePanel').fadeIn(400);
                    });
                } else if (response == 'wrongpin') {
                    if ($('#quizAlert').hasClass('out')) {
                        $('#quizAlert').toggleClass('out');
                        $('#quizAlert').toggleClass('in');
                    }
                }
            })
            .fail(function() {

                if ($('#quizAlert').hasClass('out')) {
                    $('#quizAlert').toggleClass('out');
                    $('#quizAlert').toggleClass('in');
                }

            });

    });

    $('#enterNameBtn').on('click', function(e) {
        var name = $('#enterNameInput').val();
        $.ajax({
            url: '/attendee',
            method: 'POST',
            data: {
                'name': name
            }
        }).done(function(response) {
            if (response == 'waiting') {
                $('#enterNamePanel').fadeOut(400, function() {
                    $('#waitingPanel').fadeIn(400);
                });
            } else {
                
            }
        })
    })
});