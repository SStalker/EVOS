@extends('layouts.app')

@section('title', 'Quiz erstellen')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
        </div>

        {!! $category->title !!}: Quiz erstellen
    </div>

    {!! Form::open(['action' => ['QuizController@store', $category->id], 'method' => 'post']) !!}
        @include('quizzes._form', ['submitLabel' => 'Speichern'])
    {!! Form::close() !!}
</div>

@endsection
