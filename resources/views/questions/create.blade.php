@extends('layouts.app')

@section('title', 'Frage erstellen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
            </div>

            Frage erstellen
        </div>

        {!! Form::open(['action' => ['QuestionController@store'], 'method' => 'post']) !!}
        <div class="panel-body">
            <div class="form-group">
                <label for="question">Frage</label>
                <input type="text" class="form-control" name="question" id="question" placeholder="z. B. Was ist der Sinn des Lebens?">
            </div>
            <div class="form-group">
                <label for="answerA">Antwort 1</label>
                <textarea class="form-control" name="answerA" rows="5" id="comment" placeholder="z. B. Antwort 1"></textarea>
            </div>
            <div class="form-group">
                <label for="answerB">Antwort 2</label>
                <textarea class="form-control" name="answerB" rows="5" id="comment" placeholder="z. B. Antwort 2"></textarea>
            </div>
            <div class="form-group">
                <label for="answerC">Antwort 3</label>
                <textarea class="form-control" name="answerC" rows="5" id="comment" placeholder="z. B. Antwort 3"></textarea>
            </div>
            <div class="form-group">
                <label for="answerD">Antwort 4</label>
                <textarea class="form-control" name="answerD" rows="5" id="comment" placeholder="z. B. Antwort 4"></textarea>
            </div>
            <div class="form-group">
                <label for="countdown">Countdown</label>
                <input type="number" class="form-control" name="countdown" value="30" id="question">
            </div>
        </div>

        <div class="panel-footer">
            {!! Form::submit('Erstellen', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection
