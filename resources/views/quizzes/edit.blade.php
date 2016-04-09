@extends('layouts.app')

@section('title', 'Quiz '.$quiz->title)

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
        </div>

        {!! $quiz->title !!} bearbeiten
    </div>

    {!! Form::open(['action' => ['QuizController@update', $quiz->category->id, $quiz->id], 'method' => 'put']) !!}
    <div class="panel-body">
        <div class="form-group">
            <label for="title">Titel</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="z. B. Aufgabenteil 1, Extra-Fragen, Klausur-Teil" value="{{ $quiz->title }}">
        </div>
    </div>

    <div class="panel-footer">
        {!! Form::submit('Erstellen', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>

@endsection