@extends('layouts.app')

@section('title', 'Kategorie erstellen')

@section('breadcrumb')
    <ol class="breadcrumb container">
        <li><a href="{{ action('CategoryController@index') }}">Kategorien</a></li>
        @if($parentCategory != null)
            <li><a href="{{ action('CategoryController@show', $parentCategory->id) }}">{{ $parentCategory->title }}</a></li>
        @endif
        <li class="active">Neue Kategorie erstellen</li>
    </ol>
@endsection

@section('content')

    <h1>Neue Kategorie erstellen</h1>

    {{ Form::open(['action' => ['CategoryController@store'], 'method' => 'post']) }}
    @include('categories._form', ['submitLabel' => 'Speichern'])
    {{ Form::close() }}


@endsection
