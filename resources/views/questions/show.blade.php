@extends('layouts.app')

@section('title', 'Frage anzeigen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
            </div>

            {!! $question->question !!}
        </div>

        <div class="panel-body">

        </div>
    </div>

@endsection