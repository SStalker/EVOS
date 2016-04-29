@extends('layouts.frontend')

@section('frontEndContent')

    <div id="enterQuizPanel" class="container">
        <img src="images/evos.png" class="img-responsive">
        <label class="control-label">Quiz PIN eingeben: </label>
        <input id='quizPinInput' class="form-control">
        <button id='quizPinBtn' class="btn btn-default">Okay</button>
    </div>

    <div id ="enterNamePanel" class="container" style="display: none;">
        <img src="images/evos.png" class="img-responsive">
        <label class="control-label">Namen eingeben: </label>
        <input id='enterNameInput' class="form-control">
        <button id='enterNameBtn' class="btn btn-default">Okay</button>
    </div>

    <div id ="waitingPanel" class="container" style="display: none;">
        <img src="images/evos.png" class="img-responsive">
        <p>Und jetzt warten wir mal.....</p>
    </div>
@endsection