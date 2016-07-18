@extends('layouts.app')

@section('title', 'Frage erstellen')

@section('breadcrumb')
    <ol class="breadcrumb container">
        <li><a href="{{ action('CategoryController@index') }}">Kategorien</a></li>
        <li><a href="{{ action('CategoryController@show', $quiz->category->id) }}">{{ $quiz->category->title }}</a></li>
        <li><a href="{{ action('QuizController@show', [ $quiz->category->id, $quiz->id ]) }}">{{ $quiz->title }}</a></li>
        <li class="active">Frage hinzufügen</li>
    </ol>
@endsection

@section('content')

    <h1>Frage zum Quiz <i>{{ $quiz->title }} hinzufügen</i></h1>

    {{ Form::open(['action' => ['QuestionController@store', $quiz->id], 'method' => 'post', 'id' => 'question-form']) }}
    @include('questions._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>

@endsection

