@extends('layouts.app')

@section('title', 'Kategorien')

@section('content')

    <h1>Kategorien</h1>

    <div class="table">
        @if($categories->count() > 0)
            <table class="table table-striped table-middle">
                <tbody class="table-hover">
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <a href="{{ action('CategoryController@show', [$category->id]) }}"
                               class="block-link">{{ $category->title }}</a>
                        </td>
                        <td>
                            <div class="btn-group pull-right">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu{{ $category->id }}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        Ändern
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu{{ $category->id }}">
                                        <li><a href="{{ action('CategoryController@edit', [$category->id]) }}"
                                               data-toggle="tooltip" data-placement="left"
                                               title="Gibt die Möglichkeit den Name der Kategorie zu ändern.">Frage bearbeiten
                                                ändern</a></li>
                                        <li>
                                            <a href="#" class="alert-danger delete-button" data-toggle="tooltip"
                                               data-placement="left"
                                               title="Löscht die Kategorie" data-cat-id="{{ $category->id }}"
                                               data-cat-title="{{ $category->title }}">Löschen</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            Es sind noch keine Kategorien vorhanden. Bitte füge neue Kategorien hinzu.
        @endif
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ action('CategoryController@create') }}"
           data-toggle="tooltip" data-placement="left" title="Erstellt eine neue Kategorie.">Kategorie erstellen</a>
        <a class="btn btn-primary" href="{{ action('CategoryController@getMove') }}"
           data-toggle="tooltip" data-placement="left"
           title="Gibt die Möglichkeit die Kategorie zu sortieren.">Kategorien sortieren</a>
    </div>

    @include('categories._confirmdialog')

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $('.delete-button').on('click', function () {
                $('#category-title').text($(this).data('cat-title'));
                $('#delete-form').attr('action', '{{ action('CategoryController@destroy', '') }}/' + $(this).data('cat-id'));
                $('#delete-confirmation').modal();
            });
        })
    </script>

@endsection
