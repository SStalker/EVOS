@extends('layouts.app')

@section('title', 'Kategorie verschieben')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $category->title }}: bearbeiten
        </div>

        {{ Form::model($category, ['action' => ['CategoryController@update', $category->id], 'method' => 'put']) }}
        <div class="panel-body">
            <div class="form-group">
                <label for="title">Titel</label>
                {{Form::select("category", $recursiveCategories)}}
            </div>
            {{ Form::hidden('parent_id', $parent_id) }}
        </div>

        <div class="panel-footer">
            {{ Form::submit('Verschieben', ['class'=>'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
    </div>

@endsection