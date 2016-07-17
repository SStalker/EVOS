@extends('layouts.app')

@section('title', 'Kategorie bearbeiten')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ action('CategoryController@index') }}">Kategorien</a></li>
        @if($category->parent != null)
            <li><a href="{{ action('CategoryController@show', $category->parent->id) }}">{{ $category->parent->title }}</a></li>
        @endif
        <li><a href="{{ action('CategoryController@show', $category->id) }}">{{ $category->title }}</a></li>
        <li class="active">Kategorienamen ändern</li>
    </ol>
@endsection

@section('content')
    <h1>Titel der Kategorie <i>{{ $category->title }}</i> ändern</h1>

    {{ Form::model($category, ['action' => ['CategoryController@update', $category->id], 'method' => 'put']) }}
    @include('categories._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}
@endsection
