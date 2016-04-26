@extends('layouts.app')

@section('title', 'Frage bearbeiten')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
            </div>

            <a href="{!! action('CategoryController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">{!! $question->quiz->category->title !!}</a>
            &raquo;
            <a href="{!! action('QuizController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">{!! $question->quiz->title !!}</a>
            &raquo;
            <a href="{!! action('QuestionController@show', [$question->quiz->category->id, $question->quiz->id, $question->id]) !!}">{!! $question->question !!}</a>
            &raquo;
            bearbeiten
        </div>

        {!! Form::model($question, ['action' => ['QuestionController@update', $question->quiz->id, $question->id], 'method' => 'put']) !!}
            @include('questions._form', ['submitLabel' => 'Speichern'])
        {!! Form::close() !!}
    </div>

@endsection