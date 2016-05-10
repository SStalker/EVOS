@extends('layouts.frontend')

@section('frontEndContent')

    <div id="enterQuizPanel" class="container">
        <img src="images/evos.png" class="img-responsive center-block" style="margin-bottom: 10%">
        <label class="control-label">Quiz PIN eingeben: </label>
        <input id='quizPinInput' class="form-control">
        <button id='quizPinBtn' class="btn btn-default center-block">Okay</button>

        <div class="alert alert-danger fade out text-center" id="quizAlert" style="margin-top: 15%">
            Dieses Quiz existiert nicht.
        </div>
    </div>

    <div id ="enterNamePanel" class="container" style="display: none;">
        <img src="images/evos.png" class="img-responsive center-block" style="margin-bottom: 10%">
        <label class="control-label">Namen eingeben: </label>
        <input id='enterNameInput' class="form-control">
        <button id='enterNameBtn' class="btn btn-default center-block">Okay</button>

        <div class="alert alert-danger fade out text-center" id="nameAlert" style="margin-top: 15%">
            Name konnte nicht eingetragen werden.
        </div>
    </div>

    <div id ="waitingPanel" class="container" style="display: none;">
        <img src="images/evos.png" class="img-responsive">
        <p>Und jetzt warten wir mal.....</p>
    </div>

    <div id="questionPanel" class="container-fluid" style="display: none">
        <div class="row">
            <div id="answerA" class="col-md-6">
                <span> A </span>
            </div>
            <div id="answerB" class="col-md-6">
                <span> B </span>
            </div>
            <div class="clearfix"></div>
            <div id="answerC" class="col-md-6">
                <span> C </span>
            </div>
            <div id="answerD" class="col-md-6">
                <span> D </span>
            </div>
        </div>
    </div>
@endsection