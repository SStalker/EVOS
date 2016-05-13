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
                <a id="end-button" class="btn btn-danger" href="#" style="display: none;">Quiz beenden</a>
            </div>
        </div>

        <div id="end" class="quiz-end">
            <h1>Das Quiz wurde beendet.</h1>

            Hier werden ggf. Ergebnisse etc. angezeigt.

            <div class="end-button">
                <a id="leave-button" class="btn btn-primary2" href="{{ url('/categories') }}">Zurück zur Übersicht</a>
            </div>
        </div>
    </div>

    <script>
        var user_id = {{ Auth::id() }};
        var quiz_id = {{ $quiz->id }};
        var session_id = '{{ Session::getId() }}';
        var next_route = '{!! action('QuizController@next', [$quiz->category->id, $quiz->id]) !!}';

        function SyncServer(ws_url) {
            this.attendee_count = 0;
            this.answer_count = 0;
            this.ws = new WebSocket(ws_url);
            this.ws.onerror = this.onError;
            this.ws.onclose = this.onClose;
            this.ws.onopen = this.onOpen;
            this.ws.parent = this;
            this.ws.onmessage = this.onMessage;
        }

        SyncServer.prototype.onError = function (ev) {
            console.log('Error');
            console.log(ev);
        };

        SyncServer.prototype.onClose = function (ev) {
            console.log('Close');
            console.log(ev);
        };

        SyncServer.prototype.onOpen = function (ev) {
            console.log('Opened WebSocket');
            console.log(ev);
            this.parent.startQuiz();
        };

        SyncServer.prototype.onMessage = function (ev) {
            var message = JSON.parse(ev.data);
            if (message.type === undefined) {
                console.log('Received invalid message! It didn\'t contain a type!');
                console.log(message);
                return;
            }

            var that = this.parent;
            switch (message.type) {
                case 'start':
                    that.handleStart(message);
                    break;

                case 'logon':
                    that.handleLogon(message);
                    break;

                case 'answer':
                    that.handleAnswer(message);
                    break;

                default:
                    console.log('Received an invalid message.');
                    console.log(message);
                    break;
            }
        };

        SyncServer.prototype.startQuiz = function () {
            console.log('starting quiz');
            var startMessage = {
                type: 'start',
                user_id: user_id,
                quiz_id: quiz_id,
                session_id: session_id
            };
            this.sendMessage(startMessage);
        };

        SyncServer.prototype.handleStart = function (message) {
            console.log('handle start');
            if (message.successful !== undefined && message.successful === false) {
                console.log('QuizStart was not successful.');
                console.log('Reason: ' + message.reason);
                return false;
            }

            $('.quiz-loading').hide();
            $('.quiz-normal').show();
        };

        SyncServer.prototype.handleLogon = function (message) {
            if (message.successful !== undefined && message.successful === false) {
                console.log('Logon was not successful.');
                console.log('Reason: ' + message.reason);
                return false;
            }

            this.attendee_count++;
            $('#attendee-count').text(this.attendee_count);
        };

        SyncServer.prototype.handleAnswer = function (message) {
            if (message.successful !== undefined && message.successful === false) {
                console.log('Answer was not successful.');
                console.log('Reason: ' + message.reason);
                return false;
            }

            this.answer_count++;
            $('#answer-count').text(this.answer_count);
        };

        SyncServer.prototype.sendMessage = function (msg) {
            try {
                this.ws.send(JSON.stringify(msg));
            }
            catch (e) {
                console.log('Error while sending');
                console.log(e);
            }
        };

        SyncServer.prototype.quiz = function () {
            // Some default settings
            $('#answerA').removeClass("bg-success bg-danger");
            $('#answerB').removeClass("bg-success bg-danger");
            $('#answerC').removeClass("bg-success bg-danger");
            $('#answerD').removeClass("bg-success bg-danger");
            $('#next-button').fadeOut("slow");

            // For every new question the server must be informed
            this.question();

            var self = this;
            $.getJSON(next_route, function (data) {
                console.log(data);

                this.duration = data.countdown;
                var correctAnswers = jQuery.parseJSON(data.correct_answers);

                $('#questionTitle').text(data.question);
                $('#answerA').text(data.answerA || '');
                $('#answerB').text(data.answerB || '');
                $('#answerC').text(data.answerC || '');
                $('#answerD').text(data.answerD || '');

                // Shows the countdown for the current question
                var that = this;
                this.countdown = setInterval(function () {
                    that.duration--;
                    if (that.duration > 0) {
                        $('#countdown').text(that.duration);
                    } else {
                        clearInterval(that.countdown);
                        if(data.last == true) {
                            self.end();
                            $('#end-button').fadeIn("slow");
                        } else {
                            $('#next-button').fadeIn("slow");
                        }
                        $('#countdown').text('Keine verbleibende Zeit');

                        correctAnswers.a ? $('#answerA').addClass("bg-success") : $('#answerA').addClass("bg-danger");
                        correctAnswers.b ? $('#answerB').addClass("bg-success") : $('#answerB').addClass("bg-danger");
                        correctAnswers.c ? $('#answerC').addClass("bg-success") : $('#answerC').addClass("bg-danger");
                        correctAnswers.d ? $('#answerD').addClass("bg-success") : $('#answerD').addClass("bg-danger");
                    }
                }, 1000);
            });
        }

        SyncServer.prototype.question = function () {
            // The user sends the messageType 'question' to induce the server to show a new question
            var questionMessage = {
                type: 'question',
                quiz_id: quiz_id,
                session_id: session_id
            };

            this.sendMessage(questionMessage);
            // For every new question answer_count must be set to 0
            this.answer_count = 0;
        }

        SyncServer.prototype.end = function () {
            var endMessage = {
                type: 'end',
                quiz_id: quiz_id,
                session_id: session_id
            };

            this.sendMessage(endMessage);
        }

        $(function () {
            $('.quiz-normal').hide();
            $('.quiz-question').hide();
            $('.quiz-end').hide();

            var syncServer = new SyncServer('ws://127.0.0.1:8080/EVOS-Sync/sync');

            $('#start-button').click(function () {
                $('.quiz-normal').hide();
                $('.quiz-question').show();

                syncServer.quiz();
            });

            $('#next-button').click(function () {
                syncServer.quiz();
            });

            $('#end-button').click(function () {
                $('.quiz-normal').fadeOut('slow');
                $('.quiz-question').fadeOut('slow', function () {
                    $('.quiz-end').fadeIn('slow');
                });
            });
        });
    </script>

@endsection