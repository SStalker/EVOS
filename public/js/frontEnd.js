/**
 * Created by davidherzog on 09.04.16.
 */

var websocket = new WebSocket(url);
var websocketOk;
var quizObj;
var toAnswer = false;
websocket.onopen = function(event){
    websocketOk = true;
    //DEBUG
    console.log("open");
};

websocket.onerror = function (error) {

    //If the websocket is closed due some issues set websocketOk to false
    websocketOk = false;
    //DEBUG
    console.log('WebSocket Error');
};

//receive messages from server
websocket.onmessage = function(event){
    //process the received server data
    processMessage(event.data);
};

function sendToSyncServer(data) {
    console.log('send');
    websocket.send(JSON.stringify(data));
}

/* parse/process incoming sync server messages */
function processMessage(data){
    //DEBUG
    console.log(data);
    
    //Parse JSON to Object
    var dataArray = JSON.parse(data);

    if(dataArray.type != undefined){

        switch (dataArray.type){
            case 'logon': processLogon(dataArray);
                break;
            case 'question': processQuestion(dataArray);
                break;
            case 'end': processEnd(dataArray);
                break;
            default: console.log('default');
        }
    }else{
        //error or something for undefined response;
    }
}
function processLogon(data){
    //DEBUG
    console.log('processLogon');
    if(data.successful != undefined){
        
        if(data.successful !== true) {
            //error, not registered for quiz
            if (data.reason != undefined){
                alert(data.reason);
                //reload after error
                location.reload(true);
            }
        }else{

            $('#enterNamePanel').fadeOut(400, function() {
                $('#waitingPanel').fadeIn(400);
            });

        }
    }else{
        //error because of not well formed syns server messages
    }
}

function processQuestion(data) {
    //DEBUG
    console.log('processQuestion');
    console.log(data);

    $('#waitingPanel').fadeOut(400, function() {
        $('#questionPanel').fadeIn(400);
    });

    toAnswer = true;

/*
    //Call function to get next question from Laravel server
    var jqhxr = $.getJSON(appUrl+'/categories/'+quizObj.category_id+'/quizzes/'+quizObj.id+'/choices')
        .done(function() {

            console.log(jqhxr.responseJSON);

            $('#waitingPanel').fadeOut(400, function() {
                $('#questionPanel').fadeIn(400);
            });

            toAnswer = true;

        });
*/
}

function processEnd(data) {
    //DEBUG
    console.log('processEnd');

    if ($('#questionPanel').is(':visible')) {
        $('#questionPanel').fadeOut(400, function() {
            $('#endQuizPanel').fadeIn(400);
        });
    } else if ($('#waitingPanel').is(':visible')) {
        $('#waitingPanel').fadeOut(400, function() {
            $('#endQuizPanel').fadeIn(400);
        });
    }


    //show results or something like that, or show evaluation, or show some other sort of end screen
}

$(document).ready(function() {

    var quizPin;
    var jqXhr;
    var name;
    var enterName = true;


    $('#quizAlert').on('click', function() {
        $('#quizAlert').toggleClass('in').toggleClass('out');
    });

    $('#nameAlert').on('click', function() {
        $('#nameAlert').toggleClass('in').toggleClass('out');
    });

    $('#quizPinBtn').on('click', function(e) {
        
        quizPin = $('#quizPinInput').val();
        jqXhr = $.ajax(appUrl+'/quiz/'+quizPin)
            .done(function(response) {

                if (response == 'wrongpin') {
                    $('#quizAlert').text('Das Quiz existiert nicht!');
                    if ($('#quizAlert').hasClass('out')) {
                        $('#quizAlert').toggleClass('out').toggleClass('in');
                    }
                } else if (response == 'quiz_not_active') {
                    $('#quizAlert').text('Das Quiz ist nicht aktiv!');
                    if ($('#quizAlert').hasClass('out')) {
                        $('#quizAlert').toggleClass('out').toggleClass('in');
                    }
                } else {
                    quizObj = response;
                    console.log(quizObj);
                    $('#enterQuizPanel').fadeOut(400, function () {
                        $('#enterNamePanel').fadeIn(400);
                    });

                }

            })
            .fail(function() {

                if ($('#quizAlert').hasClass('out')) {
                    $('#quizAlert').toggleClass('out').toggleClass('in');
                }

            });

    });

    $('#enterNameBtn').on('click', function(e) {
        if(enterName){
            enterName =false;
            name = $('#enterNameInput').val();
            $.ajax({
                url: appUrl+'/attendee',
                method: 'POST',
                data: {
                    'name': name,
                    'quiz_id': quizPin
                }
            }).done(function(response) {
                if (response == 'waiting') {
                    //Create object for sending purpose
                    var data = {
                        type: 'logon',
                        quiz_id: parseInt(quizPin),
                        nickname: name
                    };

                    sendToSyncServer(data);

                } else {
                    console.log(response);
                }
            }).fail(function() {
                if ($('#nameAlert').hasClass('out')) {
                    enterName = true;
                    $('#nameAlert').toggleClass('out').toggleClass('in');
                }
            });
        }
    });

    /*Mouse click binding for answer boxes*/
    $('.answer').click(function (event) {

        if (toAnswer){
//            console.log(this.getAttribute('data-value'));

            var data = {
                type: 'answer',
                quiz_id: parseInt(quizPin),
                answer: [this.getAttribute('data-value')]
            };

            sendToSyncServer(data);
            toAnswer = false;
            $('#questionPanel').fadeOut(400, function() {
                $('#waitingPanel').fadeIn(400);
            });
        }

    })

    $('#startNewBtn').on('click', function() {
        location.reload();
    });

    $(window).bind('beforeunload', function() {
        if ($('#questionPanel').is(':visible') || $('#waitingPanel').is(':visible')) {
            return 'Das Quiz läuft noch! Trotzdem die Seite neu laden?';
        }
    })

});