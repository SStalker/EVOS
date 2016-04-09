@extends('layouts.frontend')

@section('frontEndContent')
    <div id="enterQuiz" ng-controller="frontEndController">
        <form class="form-group-sm">
            <input class="form-control" ng-model="quizPin">
            <button class="btn btn-secondary" ngClick="sendQuizPin(quizPin)">Enter Quiz</button>
            <p><%quizPin%></p>
        </form>
    </div>
@endsection