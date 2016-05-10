@extends('layouts.quizbackend')

@section('title', 'Bitte anmelden!')

@section('content')
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{!! asset('images/evos.png') !!}">
                </a>
            </div>
        </div>
    </nav>

    <div class="center-block">

        <div id="loading" class="quiz-loading">
            Verbinde mit Server...
        </div>

        <div id="start" class="quiz-normal">
            <h1>{{ $quiz->title }}</h1>
            <h2>PIN: {{ $quiz->id }}</h2>

            <h3>Angemeldete Teilnehmer: <span id="attendee-count">0</span></h3>
            <div class="row" id="attendee-names">
                {{--
                <div class="col-md-4">.col-md-4</div>
                <div class="col-md-4">.col-md-4</div>
                <div class="col-md-4">.col-md-4</div>
                 --}}
            </div>

            <div class="start-button">
                <a id="start-button" class="btn btn-primary2" href="#">Starten</a>
            </div>
        </div>

        <div id="question" class="quiz-question">
            <h1 id="questionTitle"></h1>
            <table id="question-answers" class="table table-bordered">
                <tbody>
                <tr style="height:150px; text-align: center; font-size: 24px;">
                    <td id="answerA"></td>
                    <td id="answerB"></td>
                </tr>
                <tr style="height:150px; text-align: center; font-size:24px;">
                    <td id="answerC"></td>
                    <td id="answerD"></td>
                </tr>
                </tbody>
            </table>

            <h3>Antworten: <span id="answer-count">0</span></h3>
            <h3>Verbleibende Zeit: <span id="countdown"></span></h3>

            <div class="next-button">
                <a id="next-button" class="btn btn-primary2" href="#" style="display: none;">Nächste Frage</a>
            </div>
        </div>

        <div id="end" class="quiz-end">
            <h1>Das Quiz wurde beendet.</h1>

            Hier werden ggf. Ergebnisse etc. angezeigt.

            <div class="end-button">
                <a id="end-button" class="btn btn-primary2" href="{{ url('/categories') }}">Quiz Beenden</a>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            // This classes must be hidden until the quiz is started successfully
            $('.quiz-normal').hide();
            $('.quiz-question').hide();
            $('.quiz-end').hide();

            // Counts the successfully logged on attendees
            var attendee_count = 0;
            // Counts the answers for one question
            var answer_count = 0;

            var wsUrl = '{{ env('SYNC_SERVER_URL', 'ws://127.0.0.1:8080/EVOS-Sync/sync') }}';
            var ws = new WebSocket(wsUrl);

            ws.onerror = function (message) {
                $('.error').append("<h1>Beim Verbinden ist ein Fehler aufgetreten!</h1>Das Quiz kann zurzeit aus technischen Gründen nicht gestartet werden. <a href=" / ">Zur Startseite</a>").show();
            };

            ws.onclose = function (message) {
                // ...
            };

            ws.onopen = function (message) {
                // If the WebSocked was started successfully, the User has to inform the server
                var startMessage = {
                    type: 'start',
                    user_id: {{ Auth::id() }},
                    quiz_id: {{ $quiz->id }},
                    session_id: '{{ Session::getId() }}'
                };

                sendMsg(startMessage, ws);
            };

            $('#start-button').click(function () {
                $('.quiz-normal').hide();
                $('.quiz-question').show();

                quiz();
            });

            $('#next-button').click(function () {
                quiz();
            });

            // Message received from the server
            ws.onmessage = function (message) {
                message = JSON.parse(message.data);
                console.log(message);

                if (message.type === undefined) {
                    console.log('Received invalid message! Didn\'t contain a type!');
                    return;
                }
                console.log(message);
                switch (message.type) {
                    case 'start':
                        handleStart(ws, message);
                        break;
                    case 'logon':
                        handleLogon(ws, message);
                        break;
                    case 'answer':
                        handleAnswer(ws, message);
                        break;
                    default:
                        console.log('Received an invalid message.');
                }
            };

            // After successfully registering a new quiz, the server informs the user. The user handles this.
            function handleStart(ws, message) {
                // Invalid or failed message
                if (message.successful === undefined) {
                    console.log('Invalid start message');
                    console.log(message);
                    return false;
                }

                if (message.successful === false) {
                    console.log('QuizStart was not successful.');
                    console.log('Reason: ' + message.reason);
                    return false;
                }

                // Successful message.
                // Now we have to inform the attendees by showing the logon view and the quizID.
                $('.quiz-loading').hide();
                $('.quiz-normal').show();
            }

            // Server informs User of new users. User handles this.
            function handleLogon(ws, message) {
                // Invalid or failed message
                if (message.successful !== undefined) {
                    console.log('Invalid logon message');
                    console.log(message);
                    return false;
                }

                if (message.successful === false) {
                    console.log('HandleLogon was not successful.');
                    console.log('Reason: ' + message.reason);
                    return false;
                }

                // For every new attendee the attendee-count increments
                attendee_count++;
                $('#attendee-count').text(attendee_count);
            }

            // User will be informed if one Attendee sends a response for a question
            function handleAnswer(ws, message) {
                if (message.successful === undefined) {
                    console.log('Invalid answer message');
                    console.log(message);
                    return false;
                }

                if (message.successful === false) {
                    console.log('HandleAnswer was not successful.');
                    console.log('Reason: ' + message.reason);
                    return false;
                }

                answer_count++;
                $('#answer-count').text(answer_count);
            }

            // The User sends a question to the server
            function question(ws) {
                // The user sends the messageType 'question' to induce the server to show a new question
                var questionMessage = {
                    type: 'question',
                    quiz_id: {{ $quiz->id }},
                    session_id: '{{ Session::getId() }}'
                };

                sendMsg(questionMessage, ws);

                // For every new question answer_count must be set to 0
                answer_count = 0;
            }

            // The user ends the quiz
            function end(ws) {
                var endMessage = {
                    type: 'end',
                    quiz_id: {{ $quiz->id }},
                    session_id: '{{ Session::getId() }}'
                };

                sendMsg(endMessage, ws);
            }

            function sendMsg(msg, ws) {
                try {
                    ws.send(JSON.stringify(msg));
                } catch (e) {
                    console.log("Message could not be send.");
                    console.log(e);
                }
            }

            function quiz() {
                // Some default settings
                $('#answerA').removeClass("bg-success bg-danger");
                $('#answerB').removeClass("bg-success bg-danger");
                $('#answerC').removeClass("bg-success bg-danger");
                $('#answerD').removeClass("bg-success bg-danger");
                $('#next-button').fadeOut("slow");

                // For every new question the server must be informed
                question(ws);

                $.getJSON('{!! action('QuizController@next', [$quiz->category->id, $quiz->id]) !!}', function (data) {
                    console.log(data);

                    var countdown = (data.countdown * 1000);
                    var correctAnswers = jQuery.parseJSON(data.correct_answers);

                    $('#questionTitle').text(data.question);
                    $('#answerA').text(data.answerA || '');
                    $('#answerB').text(data.answerB || '');
                    $('#answerC').text(data.answerC || '');
                    $('#answerD').text(data.answerD || '');

                    // Shows the countdown for the current question
                    countDown(data.countdown);

                    // Enable next-button after the current question has finished.
                    // Shows the correct answers
                    setInterval(function () {
                        $('#next-button').fadeIn("slow");

                        $('#countdown').text('Keine verbleibende Zeit');

                        correctAnswers.a ? $('#answerA').addClass("bg-success") : $('#answerA').addClass("bg-danger");
                        correctAnswers.b ? $('#answerB').addClass("bg-success") : $('#answerB').addClass("bg-danger");
                        correctAnswers.c ? $('#answerC').addClass("bg-success") : $('#answerC').addClass("bg-danger");
                        correctAnswers.d ? $('#answerD').addClass("bg-success") : $('#answerD').addClass("bg-danger");
                    }, countdown);
                });
            }

            function countDown(duration) {
                var countdown = setInterval(function () {
                    if (--duration) {
                        $('#countdown').text(duration);
                    } else {
                        clearInterval(countdown);
                    }
                }, 1000);
            }

        });
    </script>

@endsection