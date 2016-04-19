@extends('layouts.app')

@section('title', 'Quiz erstellen')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        {{ $category->title }}: Quiz erstellen
    </div>

    {{ Form::open(['action' => ['QuizController@store', $category->id], 'method' => 'post']) }}
        @include('quizzes._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}
</div>

@endsection
