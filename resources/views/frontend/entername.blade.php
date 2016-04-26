@extends('frontend.blade.php')

@section('frontEndContent')

    <div id="enterQuiz" class="container" ng-controller="frontEndController">
        <img src="images/evos.png" class="img-responsive">
        <form class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label">Enter Name:</label>
                <input class="form-control" ng-model="attandeeName">
            </div>
            <div class="form-group">
                <button class="btn btn-default" ng-click="sendName(attandeeName)">Okay</button>
            </div>
        </form>
    </div>
@endsection