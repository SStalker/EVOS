@extends('layouts.app')

@section('title', 'Quiz '.$quiz->title)

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        {{ $quiz->title }} bearbeiten
    </div>

    {{ Form::model($quiz, ['action' => ['QuizController@update', $quiz->category->id, $quiz->id], 'method' => 'put']) }}
        @include('quizzes._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}
</div>

@endsection