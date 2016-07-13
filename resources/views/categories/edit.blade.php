@extends('layouts.app')

@section('title', 'Kategorie bearbeiten')

@section('content')
    <h1>Titel der Kategorie <i>{{ $category->title }}</i> ändern</h1>

    {{ Form::model($category, ['action' => ['CategoryController@update', $category->id], 'method' => 'put']) }}
    @include('categories._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}
@endsection
