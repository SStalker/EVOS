@extends('layouts.app')

@section('title', 'Frage erstellen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
            </div>

            <a href="{!! action('CategoryController@show', [$quiz->category->id, $quiz->id]) !!}">{!! $quiz->category->title !!}</a>
            &raquo;
            <a href="{!! action('QuizController@show', [$quiz->category->id, $quiz->id]) !!}">{!! $quiz->title !!}</a>
            : Frage erstellen
        </div>

        {!! Form::open(['action' => ['QuestionController@store', $quiz->id], 'method' => 'post']) !!}
            @include('questions._form', ['submitLabel' => 'Speichern'])
        {!! Form::close() !!}
    </div>

@endsection
