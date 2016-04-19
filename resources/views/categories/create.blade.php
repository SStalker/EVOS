@extends('layouts.app')

@section('title', 'Kategorie erstellen')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-default" style="margin-top: -7px;" href="{{ URL::previous() }}">Zurück</a>
        </div>

        Kategorie erstellen
    </div>

    {{ Form::open(['action' => ['CategoryController@store'], 'method' => 'post']) }}
        @include('categories._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}
</div>

@endsection
