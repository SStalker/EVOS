@extends('layouts.frontend')

@section('frontEndContent')

    <div id="enterQuiz" class="container" ng-controller="frontEndController">
        <img src="images/evos.png" class="img-responsive">
        <form class="form-horizontal" role=""form">
            <div class="form-group">
                <label class="control-label">Enter Quiz PIN:</label>
                <input class="form-control" ng-model="quizPin">
            </div>
            <div class="form-group">
                <button class="btn btn-default" ng-click="sendQuizPin(quizPin)">Enter Quiz</button>
            </div>
            <p><%quizPin%></p>
        </form>
    </div>
@endsection