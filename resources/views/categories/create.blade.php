@extends('layouts.app')

@section('title', 'Kategorie erstellen')

@section('content')

    <h1>Kategorie erstellen</h1>

    {{ Form::open(['action' => ['CategoryController@store'], 'method' => 'post']) }}
    @include('categories._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}


@endsection
