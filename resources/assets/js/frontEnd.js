/**
 * Created by davidherzog on 09.04.16.
 */

var debug = true;
var websocketOk = false;
var quizObj;
var toAnswer = false;
var end = false;
var clickedAnswer = '';
var quizPin = null;

var websocket = null;

/**
 * Funktion zum starten der Websocketverbindung
 */

function startWs() {

    websocket = new WebSocket(url);

    websocket.onopen = function (event) {
        websocketOk = true;

        if($('#webSocketError').hasClass('in')){
            $('#webSocketError').toggleClass('in').toggleClass('out');
        }

        if(quizPin != null){
            logon();
        }
    };

    websocket.onerror = function (error) {
        websocketOk = false;
    };

    websocket.onclose = function (event) {
        websocketOk = false;
        if ($('#webSocketError').hasClass('out')) {
            $('#webSocketError').toggleClass('out').toggleClass('in');
        }
        setTimeout(function(){
            startWs();

        }, 5000);
    };

    websocket.onmessage = function (event) {
        processMessage(event.data);
    };
}

/**
 * Funktion zum Debuggen und zur fehlerausgabe im frontend, speziell für Mobile clienten hilfreich
 *
 * @param msg       Fehler der ausgegeben werden soll.
 */

function debugErrorOutup(msg) {

    if(debug){
        var debugPanel = $('#DebugPanel');

        if(msg === ""){
            debugPanel.hide();
        }else if(!debugPanel.is(':visible')){
            debugPanel.show()
        }
        $('#errorText').text(msg);
    }
}

/**
 * Funktion zum Senden der Daten als JSON an den EVOS-Sync Server via Websocket.
 *
 * @param data      Die ausgehenden Daten.
 */
function sendToSyncServer(data) {
    if(websocket.readyState === websocket.OPEN){
        websocket.send(JSON.stringify(data));
    }else{
        location.href = '/error';
    }
}

/**
 * Funktion zum senden der Logon-daten um sich an einem Quiz anzumelden
 */

function logon() {
    //Create object for sending purpose
    var data = {
        type: 'logon',
        quiz_id: parseInt(quizPin),
        nickname: name,
        session_id: phpSession
    };

    sendToSyncServer(data);
}

/**
 * Diese Funktion entscheidet darüber, wie mit der eingehenden Nachricht verfahren wird.
 *
 * @param data      Eingehende Nachricht.
 */
function processMessage(data) {
    var dataArray = JSON.parse(data);
    if (dataArray.type != undefined) {
        switch (dataArray.type) {
            case 'logon':
                processLogon(dataArray);
                break;
            case 'question':
                processQuestion(dataArray);
                break;
            case 'end':
                processEnd(dataArray);
                break;
            default:
                debugErrorOutup("Unbekannte WebSocket Nachricht! Bitte dem Dozenten melden");
                break;
        }
    } else {
        debugErrorOutup('Fehler beim verarbeiten der eingehenden WebSocket Nachricht!');
    }
}

/**
 * Funktion zur Verarbeitung einer erfolgreichen Anmeldung via Websocket am EVOS-Sync Server.
 * In Fehlerfällen wird ein Alarm ausgegeben und die Seite wird neu geladen.
 *
 * @param data      Antwort vom Server
 */
function processLogon(data) {
    if (data.successful !== undefined) {
        if (data.successful !== true) {
            if (data.reason !== undefined) {
                debugErrorOutup(data.reason + ' in der processLogon()');
                location.reload(true);
            }
        } else {
            $('#enterNamePanel').fadeOut(400, function () {
                $('#waitingPanel').fadeIn(400);
            });
        }
    } else {
        debugErrorOutup('Fehlerhafte Nachricht erhalten!')
    }
}

/**
 * Anfrage an den Webserver für eine neue Frage.
 *
 * Der EVOS-Sync Server sendet via Websocket eine Nachricht als Signal zum abholen einer neuen Frage.
 * Das Verarbeiten dieses eingehenden Packetes erfolgt in dieser Funktion.
 *
 * @param data      unbenutzt
 */
function processQuestion(data) {
    $.getJSON(appUrl + '/categories/' + quizObj.category_id + '/quizzes/' + quizObj.id + '/choices')
        .done(function (response) {
            if(response['answerA']) {
                $('#answerA').parent().show();
                $('#answerA .panel-body').text(response['answerA']);
                $('#answerA .panel-body').attr("data-value", response['answerA']);
            }else{ $('#answerA').parent().hide(); }
            if(response['answerB']) {
                $('#answerB').parent().show();
                $('#answerB .panel-body').text(response['answerB']);
                $('#answerB .panel-body').attr("data-value", response['answerB']);
            }else{ $('#answerB').parent().hide(); }
            if(response['answerC']) {
                $('#answerC').parent().show();
                $('#answerC .panel-body').text(response['answerC']);
                $('#answerC .panel-body').attr("data-value", response['answerC']);
            }else{ $('#answerC').parent().hide(); }
            if(response['answerD']) {
                $('#answerD').parent().show()
                $('#answerD .panel-body').text(response['answerD']);
                $('#answerD .panel-body').attr("data-value", response['answerD']);
            }else{ $('#answerD').parent().hide(); }

            toAnswer = true;

            var display = document.getElementById('countdown');

            display.setAttribute('aria-valuemax', response['countdown']);
            display.setAttribute('aria-valuenow', response['countdown']);
            display.setAttribute('aria-valuemin', '0');

            if(response['countdown'] == 0)
                infiniteTimer(display);
            else
                startTimer(response["countdown"], display);

            console.log(response);
            window.setTimeout(function () {
                MathJax.Hub.Typeset();
                buttonResize();
            }, 1000);
            $('#waitingPanel').fadeOut(400, function () {
                $('#questionPanel').fadeIn(400);
            });
        })
        .fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            debugErrorOutup("Anfrage Fehler: " + err + "\n Bitte dem Dozenten melden." );
        });
}

/**
 * Diese Funktion ist nur dafür zuständig, ein Div auszublenden und ein anderes einzublenden. Zudem wird der globale
 * boolsche Wert "end" auf true gesetzt.
 *
 * @param data      unbenutzt
 */
function processEnd(data) {
    end = true;
    if ($('#waitingPanel').is(':visible')) {
        $('#waitingPanel').fadeOut(400, function () {
            $('#endQuizPanel').fadeIn(400);
        });
    } else if ($('#questionPanel').is(':visible')) {
        $('#questionPanel').fadeOut(400, function () {
            $('#endQuizPanel').fadeIn(400);
        });
    }
}

function switchQuestionPanelToWaitingPanel() {
    if (document.getElementById('questionPanel').offsetParent !== null && document.getElementById('endQuizPanel').offsetParent === null && !end) {
        $('#questionPanel').fadeOut(400, function () {
            if (clickedAnswer != '') {
                $('#clickedAnswer').empty();
                $('#clickedAnswer').append('<p>Deine Antwort:</p><br/>')
                $('#clickedAnswer').append(clickedAnswer);
                $('#clickedAnswer').show();
                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            } else {
                $('#clickedAnswer').empty();
                $('#clickedAnswer').show();
                $('#clickedAnswer').append("Keine Antwort gewählt!");
            }
            $('#waitingPanel').fadeIn(400);
            clickedAnswer = '';
            $('.answer-cell .panel').height('');
        });
    }
}

/**
 * Diese Funktion startet den Timer für eine Frage die keinen Countdown besitzt. Sekündlich wird geprüft ob eine Antwort ausgewählt wurde,
 * und wenn ja, wird die gewählte Antwort für die Darstellung im "waitingPanel" gespeichert.
 *
 * @param display       Element in dem der Timer angezeigt wird
 */
function infiniteTimer(display) {
    display.style.width = '100%';
    var interval = setInterval(function () {

        if (!toAnswer) {
            switchQuestionPanelToWaitingPanel();
            clearInterval(interval);
        }
    }, 1000);
}

/**
 * Diese Funktion startet den Timer für eine Frage. Sekündlich wird geprüft ob eine Antwort ausgewählt wurde,
 * und wenn ja, wird die gewählte Antwort für die Darstellung im "waitingPanel" gespeichert.
 *
 * @param duration      Zeit für die Frage in Sekunden
 * @param display       Element in dem der Timer angezeigt wird
 */
function startTimer(duration, display) {
    var timer = --duration, seconds;
    var percent;
    display.setAttribute('aria-valuenow', duration);
    display.style.width = '100%';
    var interval = setInterval(function () {
        seconds = timer;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        percent = seconds / (duration + 1) * 100;
        display.setAttribute('aria-valuenow', seconds);
        display.style.width = percent + '%';
        if (--timer < 0 || !toAnswer) {
            switchQuestionPanelToWaitingPanel();
            clearInterval(interval);
        }
    }, 1000);
}

/**
 * Diese Funktion wandelt einen Tastendruck auf Enter in ein Click event um.
 *
 * @param name      ID des angeklickten Elements
 * @param event     ID des Taste die betätigt wurde
 */
function onReturn(name, event) {
    if (event.which === 13) {
        $('#' + name).trigger('click');
    }
}

/**
 * Diese Funktion passt die Höhe der div-Elemente die die Antwortmöglichkeiten anzeigen an das jeweils größte an.
 *
 */
function buttonResize() {

    var buttonpanel = $('.answer-cell .panel');

    //Clear old height
    buttonpanel.height('');

    var maxHeight = 0;
    var allButtons = $('.answer-cell');
    allButtons.each(function () {
        var height = $(this).outerHeight();
        maxHeight = height > maxHeight ? height : maxHeight;
    });
    buttonpanel.height(maxHeight);
}

/**
 * Diese Funktion wird ausgeführt, sobald das Fenster vollständig geladen wurde. In ihr werden die onClick
 * Listener für die betreffenden Buttons und "Antworten-Div's" definiert. Ebenso werden die div's für Fehlermeldungen
 * auf den Handy bei entsprechender Antwort des Server eingeblendet.
 *
 */
$(document).ready(function () {
    //start the websocket
    startWs();

    $('[data-toggle="tooltip"]').tooltip();

    $("#quizPinInput").focus();
    var jqXhr;
    var name;
    var enterName = true;

    //debugErrorOutup(websocket.readyState);

    if(WebSocket !== undefined){
        $("#quizPinInput").keypress(function (event) {
            onReturn('quizPinBtn', event);
        });
        $("#enterNameInput").keypress(function (event) {
            onReturn('enterNameBtn', event);
        });
        $('#quizPinBtn').on('click', function (e) {
            quizPin = $('#quizPinInput').val();
            jqXhr = $.ajax(appUrl + '/quiz/' + quizPin)
                .done(function (response) {
                    if (response == 'wrongpin') {
                        $('#quizAlert').text('Das Quiz existiert nicht!');
                        if ($('#quizAlert').hasClass('out')) {
                            $('#quizAlert').toggleClass('out').toggleClass('in');
                            setTimeout(function() {
                                $('#quizAlert').toggleClass('in').toggleClass('out');
                            }, 3000);
                        }
                    } else if (response == 'quiz_not_active') {
                        $('#quizAlert').text('Das Quiz ist nicht aktiv!');
                        if ($('#quizAlert').hasClass('out')) {
                            $('#quizAlert').toggleClass('out').toggleClass('in');
                            setTimeout(function() {
                                $('#quizAlert').toggleClass('in').toggleClass('out');
                            }, 3000);
                        }
                    } else {
                        quizObj = response;
                        console.log(quizObj);
                        $('#enterQuizPanel').fadeOut(400, function () {
                            // For comfort reasons: Skip the enterName Page..
                            //$('#enterNamePanel').fadeIn(400);
                            //$("#enterNameInput").focus();

                            // New lines begin
                            $.ajax({
                                url: appUrl + '/attendee',
                                method: 'POST',
                                data: {
                                    'name': '',
                                    'quiz_id': quizPin
                                }
                            }).done(function (response) {
                                if (response == 'waiting') {
                                    logon();
                                } else {
                                    console.log(response);
                                }
                            }).fail(function () {
                                if ($('#nameAlert').hasClass('out')) {
                                    enterName = true;
                                    $('#nameAlert').toggleClass('out').toggleClass('in');
                                    setTimeout(function() {
                                        $('#nameAlert').toggleClass('in').toggleClass('out');
                                    }, 3000);
                                }
                            });
                            //New lines end
                        });
                    }
                })
                .fail(function () {
                    if ($('#quizAlert').hasClass('out')) {
                        $('#quizAlert').toggleClass('out').toggleClass('in');
                        setTimeout(function() {
                            $('#quizAlert').toggleClass('in').toggleClass('out');
                        }, 3000);
                    }
                });
        });
        $('#enterNameBtn').on('click', function (e) {
            if (enterName) {
                enterName = false;
                name = $('#enterNameInput').val();
                $.ajax({
                    url: appUrl + '/attendee',
                    method: 'POST',
                    data: {
                        'name': name,
                        'quiz_id': quizPin
                    }
                }).done(function (response) {
                    if (response == 'waiting') {
                        logon();
                    } else {
                        console.log(response);
                    }
                }).fail(function () {
                    if ($('#nameAlert').hasClass('out')) {
                        enterName = true;
                        $('#nameAlert').toggleClass('out').toggleClass('in');
                        setTimeout(function() {
                            $('#nameAlert').toggleClass('in').toggleClass('out');
                        }, 3000);
                    }
                });
            }
        });
        /*Mouse click binding for answer boxes*/
        $('.answer').click(function (event) {
            if (toAnswer) {
                var data = {
                    type: 'answer',
                    quiz_id: parseInt(quizPin),
                    answer: [this.getAttribute('data-value')]
                };
                //save the look of the clicked box for displaying purposes
                clickedAnswer = $('div[data-value='+data.answer+'] .panel-body').attr('data-value');
                sendToSyncServer(data);
                toAnswer = false;
            }
        });
        $('#startNewBtn').on('click', function () {
            location.reload();
        });
        $(window).bind('beforeunload', function () {
            if ($('#questionPanel').is(':visible') || $('#waitingPanel').is(':visible')) {
                return 'Das Quiz läuft noch! Trotzdem die Seite neu laden?';
            }
        });

    }else{
        //$('#enterQuizPanel').css("display", "none");
        //debugErrorOutup("Der Browser unterstützt keine Websockets. Bitte benutze einen Browser der Websockets unterstützt!");
        location.href = '/error';
    }
});
