@extends('layouts.app')

@section('title', $user->name . 's Passwort ändern')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('UserController@index') }}">Benutzerverwaltung</a></li>
        <li><a href="{{ action('UserController@show', $user->id) }}">{{ $user->name }}</a></li>
        <li class="active">Passwort ändern</li>
    </ol>
@endsection

@section('content')

    <h1>{{ $user->name }}</h1>

    {{ Form::open(['action' => ['UserController@postEditPassword', $user->id], 'method' => 'post']) }}
    <div class="form-group">
        <label for="password">Neues Passwort</label>
        <input type="password" class="form-control" name="password" id="password"
               placeholder="Passwort123 ist ein schlechtes Passwort!">
    </div>

    <div class="pull-right">
        {{ Form::submit("Speichern", ['class'=>'btn btn-primary']) }}
    </div>
    {{ Form::close() }}

@endsection
