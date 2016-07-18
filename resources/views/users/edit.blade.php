@extends('layouts.app')

@section('title', $user->name . ' bearbeiten')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('UserController@index') }}">Benutzerverwaltung</a></li>
        <li class="active">{{ $user->name }}</li>
    </ol>
@endsection

@section('content')

    <h1>{{ $user->name }}</h1>

    {{ Form::model($user, ['action' => ['UserController@update', $user->id], 'method' => 'put']) }}
    @include('users._form')
    {{ Form::close() }}

@endsection
