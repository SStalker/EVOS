@extends('layouts.quizbackend')

@section('title', 'Bitte anmelden!')

@section('content')

    <div class="center-block">
        <div id="loading" class="quiz-normal">
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

    URL:


    <script>
        $(function() {
            var wsUrl = '{!! url('/') !!}'.replace(/^http/, 'ws');
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
        });
    </script>

@endsection