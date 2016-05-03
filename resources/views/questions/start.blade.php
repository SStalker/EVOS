@extends('layouts.quizbackend')

@section('title', 'Bitte anmelden!')

@section('content')

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
                <a class="btn btn-primary2" href="{!! action('QuizController@next', [$quiz->category->id, $quiz->id]) !!}">Starten</a>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            // The class quiz-normal must be hidden until the quiz is started successfully
            $('.quiz-normal').hide();

            // Counts the successfully loged on attendees
            var attendee_count = 0;
            // Counts the answers for one question
            var answer_count = 0;

            var wsUrl = '{!! url('/') !!}/EVOS-Sync/sync'
                    .replace(/^http/, 'ws')
                    .replace(/:8000\//, ':8080/')
                    .replace(/localhost/, "127.0.0.1");
            var ws = new WebSocket(wsUrl);

            ws.onerror = function (message) {
                $('.error').append("<h1>Beim Verbinden ist ein Fehler aufgetreten!</h1>Das Quiz kann zurzeit aus technischen Gründen nicht gestartet werden. <a href="/">Zur Startseite</a>").show();
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

                ws.send(JSON.stringify(startMessage));
            };

            // TESTEN
            $('.start-button').click(function(){

                // Hier müssen noch UI Elemente ein-/ausgeblendet werden, quiz starten etc.
                // ...

                question(ws);
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
            function handleStart(ws, message){
                // Invalid or failed message
                if(message.successful === undefined) {
                    console.log('Invalid start message');
                    console.log(message);
                    return false;
                }

                if(message.successful === false){
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
            function handleLogon(ws, message){
                // Invalid or failed message
                if(message.successful === undefined) {
                    console.log('Invalid logon message');
                    console.log(message);
                    return false;
                }

                if(message.successful === false){
                    console.log('HandleLogon was not successful.');
                    console.log('Reason: ' + message.reason);
                    return false;
                }

                // For every new attendee the attendee-count increments
                attendee_count ++;
                $('#attendee-count').text(attendee_count);
            }

            // User will be informed if one Attendee sends a response for a question
            function handleAnswer(ws, message){
                if(message.successful === undefined) {
                    console.log('Invalid answer message');
                    console.log(message);
                    return false;
                }

                if(message.successful === false){
                    console.log('HandleAnswer was not successful.');
                    console.log('Reason: ' + message.reason);
                    return false;
                }

                answer_count++;
            }

            // The User sends a question to the server
            function question(ws){
                // The user sends the messageType 'question' to induce the server to show a new question
                var questionMessage = {
                    type: 'question',
                    quiz_id: '{{ $quiz->id }}',
                    session_id: '{{ Session::getId() }}'
                };

                sendMsg(questionMessage, ws);

                // For every new question answer_count must be set to 0
                answer_count = 0;
            }

            // The user ends the quiz
            function end(ws){
                var endMessage = {
                    type: 'end',
                    quiz_id: '{{ $quiz->id }}',
                    session_id: '{{ Session::getId() }}'
                };

                sendMsg(endMessage, ws);
            }

            function sendMsg(msg, ws){
                try {
                    ws.send(JSON.stringify(msg));
                }catch(e){
                    console.log("Message could not be send.");
                    console.log(e);
                }
            }
        });
    </script>

@endsection