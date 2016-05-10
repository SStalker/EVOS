@extends('layouts.app')

@section('title', 'Kategorie bearbeiten')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        {{ $category->title }}: bearbeiten
    </div>

    {{ Form::model($category, ['action' => ['CategoryController@update', $category->id], 'method' => 'put']) }}
        @include('categories._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}
</div>

@endsection
