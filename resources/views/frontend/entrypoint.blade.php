@extends('layouts.frontend')

@section('frontEndContent')
    <div class="wrapper">
        <div id="enterQuizPanel" class="container">
            <img src="{{ asset('images/evos.png') }}" class="img-responsive center-block" style="margin-bottom: 10%">
            <label class="control-label">Quiz PIN </label>
            <input id='quizPinInput' class="form-control">
            <button id='quizPinBtn' class="btn btn-default center-block">Weiter</button>

            <div class="alert alert-danger fade out text-center" id="quizAlert" style="margin-top: 15%">
                Dieses Quiz existiert nicht.
            </div>
        </div>

        <div id="enterNamePanel" class="container" style="display: none;">
            <img src="{{ asset('images/evos.png') }}" class="img-responsive center-block" style="margin-bottom: 10%">
            <label class="control-label">Name </label>
            <input id='enterNameInput' class="form-control">
            <button id='enterNameBtn' class="btn btn-default center-block">Weiter</button>

            <div class="alert alert-danger fade out text-center" id="nameAlert" style="margin-top: 15%">
                Name konnte nicht eingetragen werden.
            </div>
        </div>

        <div id="waitingPanel" class="container" style="display: none;">
            <img src="{{ asset('images/evos.png') }}" class="img-responsive" style="margin: auto;">
            <div id="loadingGif"><img src="{{asset('images/loading.gif')}}"></div>
            <p>Bitte warten...</p>

            <!--Debug purpose for Smartphones (no console)-->
            <div class="alert alert-danger fade out text-center" id="nextQuestionAlert" style="margin-top: 15%">
                "question" wurde empfangen!
            </div>
            <!--Debug end-->
        </div>

        <div id="questionPanel" class="container-fluid" style="display: none">

            <div class="logoTimer">
                <!--img src="{{ asset('images/evos.png') }}" class="img-responsive center-block"-->
                <div class="progress center-block">
                    <div id="countdown" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0"
                         aria-valuemin="0" aria-valuemax="1" style="width: 100%"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    <div id="answerA" data-value="a" class="answer panel panel-default">
                        <div class="panel-body"> A</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="answerB" data-value="b" class="answer panel panel-default">
                        <div class="panel-body"> B</div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6 ">
                    <div id="answerC" data-value="c" class="answer panel panel-default">
                        <div class="panel-body"> C</div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div id="answerD" data-value="d" class="answer panel panel-default">
                        <div class="panel-body"> D</div>
                    </div>
                </div>
            </div>
        </div>

        <div id="endQuizPanel" class="container" style="display: none; text-align: center;">
            <img src="{{ asset('images/evos.png') }}" class="img-responsive center-block">
            <p style="margin-top: 2%">Das Quiz ist zu Ende!</p>
            <button id='startNewBtn' class="btn btn-default center-block" style="margin-top: 2%">Neue PIN eingeben!
            </button>
        </div>

        <div id="WebsocketErrorPanel" class="container" style="display: none; text-align: center;">
            <img src="{{ asset('images/evos.png') }}" class="img-responsive center-block">
            <p style="margin-top: 2%">Der Browser unterstützt keine Websockets. Bitte benutze einen Browser der
                Websockets unterstützt!</p>
        </div>
    </div>


@endsection