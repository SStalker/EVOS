@extends('layouts.app')

@section('title', 'Kategorie erstellen')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        Kategorie erstellen
    </div>

    {{ Form::open(['action' => ['CategoryController@store'], 'method' => 'post']) }}
        @include('categories._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}
</div>

@endsection
