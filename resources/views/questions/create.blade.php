@extends('layouts.app')

@section('title', 'Frage erstellen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{!! action('CategoryController@show', [$quiz->category->id, $quiz->id]) !!}">{!! $quiz->category->title !!}</a>
            &raquo;
            <a href="{!! action('QuizController@show', [$quiz->category->id, $quiz->id]) !!}">{!! $quiz->title !!}</a>
            : Frage erstellen

            <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="popover" title="Formeln einbinden" data-content="EVOS unterstützt LaTeX und AsciiMath. Nutzen Sie für LaTeX $$[Formel]$$, für AsciiMath ´[Formel]´. " style="cursor:pointer"></span>
        </div>

        {{ Form::open(['action' => ['QuestionController@store', $quiz->id], 'method' => 'post', 'id' => 'question-form']) }}
            @include('questions._form', ['submitLabel' => 'Speichern'])
        {{ Form::close() }}
    </div>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>

@endsection

