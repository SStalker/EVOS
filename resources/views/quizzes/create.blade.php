@extends('layouts.app')

@section('title', 'Quiz erstellen')

@section('content')

    <h1>Neues Quiz erstellen</h1>

    {{ Form::open(['action' => ['QuizController@store', $category->id], 'method' => 'post']) }}
    @include('quizzes._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}

@endsection
