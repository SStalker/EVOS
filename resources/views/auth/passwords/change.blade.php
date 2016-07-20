@extends('layouts.app')

@section('title', 'Passwort ändern')

@section('content')
    <h1>Passwort ändern</h1>

    <div class="table">
        {{ Form::open(['action' => ['Auth\PasswordController@postChangePassword'], 'method' => 'post']) }}
        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
            <label class="control-label">Aktuelles Passwort</label>

            <input type="password" class="form-control" name="current_password">

            @if ($errors->has('current_password'))
                <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
            @endif

        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="control-label">Neues Passwort</label>

            <div>
                <input type="password" class="form-control" name="password" id="newPasswordInput">

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label>Passwort wiederholen</label>

            <input type="password" class="form-control" name="password_confirmation">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
            @endif
        </div>

        <div class="pull-right">{{ Form::submit("Passwort ändern", ['class'=>'btn btn-primary']) }}</div>
        {{ Form::close() }}
    </div>
@endsection
