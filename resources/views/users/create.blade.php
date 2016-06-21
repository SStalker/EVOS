@extends('layouts.app')

@section('title', 'Benutzer anlegen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a style="margin-top: -7px;" class="btn btn-default" href="{{ action('UserController@index') }}">Abbrechen</a>
            </div>

            Benutzer anlegen
        </div>

        {{ Form::open(['action' => ['UserController@store'], 'method' => 'post']) }}
        @include('users._form')
        {{ Form::close() }}
    </div>

@endsection
