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
            var wsUrl = '{!! url('/') !!}/sync'
                    .replace(/^http/, 'ws')
                    .replace(/localhost/, "127.0.0.1");
            var ws = new WebSocket(wsUrl);
            ws.onerror = function (message) {
                $('.quiz-normal').hide();
                $('.error').append("<h1>Beim Verbinden ist ein Fehler aufgetreten!</h1>Das Quiz kann zurzeit aus technischen Gründen nicht gestartet werden. <a href="/">Zur Startseite</a>").show();
            };

            ws.onclose = function (message) {

            };

            ws.onopen = function (message) {
                console.log('BIN VERBUNDEN!');
            };

            ws.onmessage = function (message) {
                if (message.type === undefined) {
                    console.log('Received invalid message! Didn\'t contain a type!');
                    return;
                }

                switch (message.type) {
                    case 'start':
                        handleStart(ws, message);
                        break;
                    case 'logon':
                        handleLogon(ws, message);
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

            }

        });
    </script>

@endsection