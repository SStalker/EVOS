@extends('layouts.app')

@section('title', 'Frage bearbeiten')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
            </div>

            {!! $question->quiz->category->title !!} -> {!! $question->quiz->title !!} -> {!! $question->question !!} bearbeiten
        </div>

        {!! Form::open(['action' => ['QuestionController@update', $question->id], 'method' => 'put']) !!}
        <div class="panel-body">
            <div class="form-group">
                <label for="question">Frage</label>
                <input type="text" class="form-control" name="question" id="question" value={!! $question->question !!}>
            </div>
            <div class="form-group">
                <label for="answerA">Antwort 1</label>
                <textarea class="form-control" name="answerA" rows="5" id="comment">{!! $question->answerA !!}</textarea>
            </div>
            <div class="form-group">
                <label for="answerB">Antwort 2</label>
                <textarea class="form-control" name="answerB" rows="5" id="comment">{!! $question->answerB !!}</textarea>
            </div>
            <div class="form-group">
                <label for="answerC">Antwort 3</label>
                <textarea class="form-control" name="answerC" rows="5" id="comment">{!! $question->answerC !!}</textarea>
            </div>
            <div class="form-group">
                <label for="answerD">Antwort 4</label>
                <textarea class="form-control" name="answerD" rows="5" id="comment">{!! $question->answerD !!}</textarea>
            </div>
            <div class="form-group">
                <label for="countdown">Countdown</label>
                <input type="number" class="form-control" name="countdown" value={!! $question->countdown !!} id="question">
            </div>
        </div>

        <div class="panel-footer">
            {!! Form::submit('Änderungen übernehmen', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    </div>

@endsection