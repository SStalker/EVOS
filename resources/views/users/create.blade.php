@extends('layouts.app')

@section('title', 'Benutzer anlegen')

@section('breadcrumb')
    <ol class="breadcrumb container">
        <li><a href="{{ action('UserController@index') }}">Benutzerverwaltung</a></li>
        <li class="active">Benutzer anlegen</li>
    </ol>
@endsection

@section('content')

    <h1>Benutzer anlegen</h1>

    {{ Form::open(['action' => ['UserController@store'], 'method' => 'post']) }}
    @include('users._form')
    {{ Form::close() }}

@endsection
