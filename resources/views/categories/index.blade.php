@extends('layouts.app')

@section('title', 'Kategorien')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-primary" style="margin-top: -7px;" href="{!! url('/categories/create') !!}">Kategorie erstellen</a>
        </div>

        Kategorien
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            @if($categories->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Titel</th>
                    <th>Besitzer</th>
                    <th style="width:30%">Aktionen</th>
                </tr>
                </thead>
                <tbody class="table-hover">
                @foreach($categories as $category)
                    <tr>
                        <td><a href="{!! url('/categories/'.$category->id) !!}">{!! $category->title !!}</a></td>
                        <td>{!! $category->user->name !!}</td>
                        <td>

                            {!! Form::open(['action' => ['CategoryController@destroy', $category->id], 'method' => 'delete']) !!}
                                <a class="btn btn-default" href="{!! url('/categories/'.$category->id.'/edit') !!}">Bearbeiten</a>
                                {!! Form::submit('Löschen', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                Es sind noch keine Kategorien vorhanden. Füge jetzt eine hinzu:<br>
                <a class="btn btn-primary" href="{!! url('/categories/create') !!}">Kategorie erstellen</a>
            @endif
        </div>
    </div>
</div>

@endsection
