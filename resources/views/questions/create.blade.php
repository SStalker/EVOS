@extends('layouts.app')

@section('title', 'Frage erstellen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
            </div>

        {!! $quiz->category->title !!} -> {!! $quiz->title !!}: Frage erstellen
        </div>

        {!! Form::open(['action' => ['QuestionController@store', $quiz->id], 'method' => 'post']) !!}
            @include('questions._form', ['submitLabel' => 'Speichern'])
        {!! Form::close() !!}
    </div>

@endsection
