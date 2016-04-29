/**
 * Created by davidherzog on 09.04.16.
 */

$(document).ready(function() {
    var jqXhr;
    $('#quizPinBtn').on('click', function(e) {
        
        var quizPin = $('#quizPinInput').val();
        jqXhr = $.ajax('/quiz/'+quizPin).done(function(response) {
            
            if (response == 'quiz_exists') {
                $('#enterQuizPanel').fadeOut(400, function() {
                   $('#enterNamePanel').fadeIn(400);
                });
            }
        });

    });

    $('#enterNameBtn').on('click', function(e) {
        var name = $('#enterNameInput').val();
        $('#enterNamePanel').fadeOut(400, function() {
            $('#waitingPanel').fadeIn(400);
        });
    })
});