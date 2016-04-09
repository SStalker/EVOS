@extends('layouts.app')

@section('title', 'Frage bearbeiten')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
            </div>

            {!! $question->quiz->category->title !!} &raquo; {!! $question->quiz->title !!} &raquo; {!! $question->question !!} bearbeiten
        </div>

        {!! Form::model($question, ['action' => ['QuestionController@update', $question->quiz->id, $question->id], 'method' => 'put']) !!}
            @include('questions._form', ['submitLabel' => 'Speichern'])
        {!! Form::close() !!}
    </div>

@endsection