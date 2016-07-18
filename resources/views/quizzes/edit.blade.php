@extends('layouts.app')

@section('title', 'Quiz '.$quiz->title)

@section('breadcrumb')
    <ol class="breadcrumb container">
        <li><a href="{{ action('CategoryController@index') }}">Kategorien</a></li>
        <li><a href="{{ action('CategoryController@show', $quiz->category->id) }}">{{ $quiz->category->title }}</a></li>
        <li><a href="{{ action('QuizController@show', [ $quiz->category->id, $quiz->id ]) }}">{{ $quiz->title }}</a></li>
        <li class="active">Quiznamen ändern</li>
    </ol>
@endsection

@section('content')

    <h1>Name von <i>{{ $quiz->title }}</i> ändern</h1>

    {{ Form::model($quiz, ['action' => ['QuizController@update', $quiz->category->id, $quiz->id], 'method' => 'put']) }}
    @include('quizzes._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}

@endsection