/**
 * Created by davidherzog on 09.04.16.
 */

var websocket = new WebSocket(url);
var websocketOk;
var quizObj;
var toAnswer = false;
var end = false;
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
                break;
        }
    }else{
        //error or something for undefined response;
    }
}
function processLogon(data){

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


    //Call function to get next question from Laravel server
    $.getJSON(appUrl+'/categories/'+quizObj.category_id+'/quizzes/'+quizObj.id+'/choices')
        .done(function(response) {

            toAnswer = true;
            console.log(response);
            display = document.getElementById('countdown');
            display.setAttribute('aria-valuemax',response['countdown']);
            display.setAttribute('aria-valuemin','0');
            startTimer(response["countdown"], display);

            $('#waitingPanel').fadeOut(400, function() {
                $('#questionPanel').fadeIn(400);
            });
        });
}

function processEnd(data) {
    end = true;

    if ($('#waitingPanel').is(':visible')) {
        $('#waitingPanel').fadeOut(400, function() {
            $('#endQuizPanel').fadeIn(400);
        });
    }else if ($('#questionPanel').is(':visible')) {
        $('#questionPanel').fadeOut(400, function() {
            $('#endQuizPanel').fadeIn(400);
        });
    }
    //show results or something like that, or show evaluation, or show some other sort of end screen
}

function startTimer(duration, display) {
    var timer = --duration, seconds;
    var percent;
    display.setAttribute('aria-valuenow',duration);
    display.style.width = '100%';

    var interval = setInterval(function () {
        seconds = parseInt(timer % 60, 10);
        seconds = seconds < 10 ? "0" + seconds : seconds;

        percent = seconds / (duration+1) * 100;

        display.setAttribute('aria-valuenow',seconds);
        display.style.width = percent+'%';


        console.log(timer);
        console.log(toAnswer);

        if (--timer < 0 || !toAnswer) {
            if(document.getElementById('questionPanel').offsetParent !== null && document.getElementById('endQuizPanel').offsetParent === null && !end){
                $('#questionPanel').fadeOut(400, function() {
                    $('#waitingPanel').fadeIn(400);
                });
            }
            clearInterval(interval);
        }
    }, 1000);
}

function onReturn(name, event) {
    if(event.which === 13){
        $('#'+name).trigger('click');
    }
}


$(document).ready(function() {

    var quizPin;
    var jqXhr;
    var name;
    var enterName = true;


    $("#quizPinInput").keypress(function (event) {
        onReturn('quizPinBtn', event);
    });

    $("#enterNameInput").keypress(function (event) {
        onReturn('enterNameBtn', event);
    });

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

            var data = {
                type: 'answer',
                quiz_id: parseInt(quizPin),
                answer: [this.getAttribute('data-value')]
            };

            sendToSyncServer(data);
            toAnswer = false;

        }
    });

    $('#startNewBtn').on('click', function() {
        location.reload();
    });

    $(window).bind('beforeunload', function() {
        if ($('#questionPanel').is(':visible') || $('#waitingPanel').is(':visible')) {
            return 'Das Quiz läuft noch! Trotzdem die Seite neu laden?';
        }
    });

});