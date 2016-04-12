@extends('layouts.app')

@section('title', 'Frage erstellen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
            </div>

        {!! $quiz->category->title !!} &raquo; {!! $quiz->title !!}: Frage erstellen
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="popover" title="Formeln einbinden" data-content="EVOS unterstützt LaTeX und AsciiMath. Nutzen Sie für LaTeX $$[Formel]$$, für AsciiMath ´[Formel]´. " style="cursor:pointer"></span>
        </div>

        {!! Form::open(['action' => ['QuestionController@store', $quiz->id], 'method' => 'post']) !!}
            @include('questions._form', ['submitLabel' => 'Speichern'])
        {!! Form::close() !!}
    </div>

    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
    </script>

@endsection

