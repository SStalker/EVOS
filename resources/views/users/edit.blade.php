@extends('layouts.app')

@section('title', $user->name . ' bearbeiten')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a style="margin-top: -7px;" class="btn btn-default" href="{{ action('UserController@index') }}">Abbrechen</a>
            </div>

            {{ $user->name }} bearbeiten
        </div>

        {{ Form::model($user, ['action' => ['UserController@update', $user->id], 'method' => 'put']) }}
        @include('users._form')
        {{ Form::close() }}
    </div>

@endsection
