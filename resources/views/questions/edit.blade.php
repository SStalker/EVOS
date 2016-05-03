@extends('layouts.app')

@section('title', 'Frage bearbeiten')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{!! action('CategoryController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">{!! $question->quiz->category->title !!}</a>
            &raquo;
            <a href="{!! action('QuizController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">{!! $question->quiz->title !!}</a>
            &raquo;
            <a href="{!! action('QuestionController@show', [$question->quiz->category->id, $question->quiz->id, $question->id]) !!}">{!! $question->question !!}</a>
            &raquo;
            bearbeiten

            <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="popover" title="Formeln einbinden" data-content="EVOS unterstützt LaTeX und AsciiMath. Nutzen Sie für LaTeX $$[Formel]$$, für AsciiMath ´[Formel]´. " style="cursor:pointer"></span>
        </div>

        {{ Form::model($question, ['action' => ['QuestionController@update', $question->quiz->id, $question->id], 'method' => 'put']) }}
            @include('questions._form', ['submitLabel' => 'Speichern'])
        {{ Form::close() }}
    </div>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>

@endsection