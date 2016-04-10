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

    {!! Form::model($quiz, ['action' => ['QuizController@update', $quiz->category->id, $quiz->id], 'method' => 'put']) !!}
        @include('quizzes._form', ['submitLabel' => 'Speichern'])
    {!! Form::close() !!}
</div>

@endsection