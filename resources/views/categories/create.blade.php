@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="pull-right">
                        <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
                    </div>

                    Kategorie erstellen
                </div>

                {!! Form::open(['action' => ['CategoryController@store'], 'method' => 'post']) !!}
                <div class="panel-body">
                        <div class="form-group">
                            <label for="title">Titel</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="z. B. KBSE, Mathe3, SWE-Projekt">
                        </div>
                </div>

                <div class="panel-footer">
                    {!! Form::submit('Erstellen', ['class'=>'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
