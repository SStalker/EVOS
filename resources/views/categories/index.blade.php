@extends('layouts.app')

@section('title', 'Kategorien')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-primary" style="margin-top: -7px;" href="{{ action('CategoryController@create') }}"
                   data-toggle="tooltip"
                   data-placement="left" title="Erstellt eine neue Kategorie.">Kategorie erstellen</a>
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
                            <th style="width:40%">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <a href="{{ action('CategoryController@show', [$category->id]) }}">{{ $category->title }}</a>
                                </td>
                                <td>{{ $category->user->name }}</td>
                                <td>

                                    {{ Form::open(['action' => ['CategoryController@destroy', $category->id], 'method' => 'delete']) }}
                                    <a class="btn btn-default"
                                       href="{{ action('CategoryController@edit', [$category->id]) }}"
                                       data-toggle="tooltip" data-placement="left"
                                       title="Gibt die Möglichkeit den Titel der Kategorie zu ändern.">Kategorietitel
                                        ändern</a>

                                    <a class="btn btn-primary"
                                       href="{{ action('CategoryController@move', [$category->id]) }}"
                                       data-toggle="tooltip" data-placement="left"
                                       title="Gibt die Möglichkeit die Kategorie zu verschieben.">Verschieben</a>
                                    {{ Form::submit('Löschen', ['class'=>'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Löscht die ausgewählte Kategorie']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    Es sind noch keine Kategorien vorhanden. Füge jetzt eine hinzu:<br>
                    <a class="btn btn-primary" href="{{ action('CategoryController@create') }}" data-toggle="tooltip"
                       data-placement="left" title="Erstellt eine neue Kategorie.">Kategorie erstellen</a>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

@endsection
