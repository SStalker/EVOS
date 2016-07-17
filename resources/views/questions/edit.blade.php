@extends('layouts.app')

@section('title', 'Frage bearbeiten')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('CategoryController@index') }}">Kategorien</a></li>
        <li><a href="{{ action('CategoryController@show', $question->quiz->category->id) }}">{{ $question->quiz->category->title }}</a></li>
        <li><a href="{{ action('QuizController@show', [ $question->quiz->category->id, $question->quiz->id ]) }}">{{ $question->quiz->title }}</a></li>
        <li class="active">{{ $question->title }}</li>
    </ol>
@endsection

@section('content')

    <h1>Frage <i>{{ $question->title }}</i> bearbeiten</h1>

    {{ Form::model($question, ['action' => ['QuestionController@update', $question->quiz->id, $question->id], 'method' => 'put']) }}
    @include('questions._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>

@endsection