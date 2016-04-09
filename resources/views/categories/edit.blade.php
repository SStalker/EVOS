@extends('layouts.app')

@section('title', 'Kategorie bearbeiten')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
        </div>

        {!! $category->title !!}: bearbeiten
    </div>

    {!! Form::model($category, ['action' => ['CategoryController@update', $category->id], 'method' => 'put']) !!}
        @include('categories._form', ['submitLabel' => 'Speichern'])
    {!! Form::close() !!}
</div>

@endsection
