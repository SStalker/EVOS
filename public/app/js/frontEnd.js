/**
 * Created by davidherzog on 09.04.16.
 */

var url = "127.0.0.1";
var websocket = new WebSocket("ws://"+ url +":8080/EVOS-Sync/sync");
var websocketOk;
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
};

function processLogon(data){
    //DEBUG
    console.log('processLogon');
    if(data.successful != undefined){
        
        if(data.successful !== true) {
            //error, not registered for quiz
            if (data.reason != undefined){
                alert(data.reason);
            }
        }else{
            //waiting for quiz start
        }
    }else{
        //error because of not well formed syns server messages
    }
}

function processQuestion(data) {
    //DEBUG
    console.log('processQuestion');

    //Call function to get next question from Laravel server

}

function processEnd(data) {
    //DEBUG
    console.log('processEnd');

    //show results or something like that, or show evaluation, or show some other sort of end screen
}

$(document).ready(function() {
    var quizPin;
    var jqXhr;
    var name;

    $('#quizAlert').on('click', function() {
        $('#quizAlert').toggleClass('in');
        $('#quizAlert').toggleClass('out');
    });

    $('#nameAlert').on('click', function() {
        $('#nameAlert').toggleClass('in');
        $('#nameAlert').toggleClass('out');
    });

    $('#quizPinBtn').on('click', function(e) {
        
        quizPin = $('#quizPinInput').val();
        jqXhr = $.ajax('/quiz/'+quizPin)
            .done(function(response) {
            
                if (response == 'quiz_exists') {
                    $('#enterQuizPanel').fadeOut(400, function() {
                       $('#enterNamePanel').fadeIn(400);
                    });
                } else if (response == 'wrongpin') {
                    $('#quizAlert').text('Das Quiz existiert nicht!');
                    if ($('#quizAlert').hasClass('out')) {
                        $('#quizAlert').toggleClass('out');
                        $('#quizAlert').toggleClass('in');
                    }
                } else if (response == 'quiz_not_active') {
                    $('#quizAlert').text('Das Quiz ist nicht aktiv!');
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
        name = $('#enterNameInput').val();
        $.ajax({
            url: '/attendee',
            method: 'POST',
            data: {
                'name': name,
                'quiz_id': quizPin
            }
        }).done(function(response) {
            if (response == 'waiting') {

                $('#enterNamePanel').fadeOut(400, function() {
                    $('#waitingPanel').fadeIn(400);
                });

                //Create object for sending purpose
                var data = {
                    type: 'logon',
                    quiz_id: parseInt(quizPin),
                    nickname: name
                }

                sendToSyncServer(data);

            } else {
                console.log(response);
            }
        }).fail(function() {

            if ($('#nameAlert').hasClass('out')) {
                $('#nameAlert').toggleClass('out');
                $('#nameAlert').toggleClass('in');
            }
        });
    })
});