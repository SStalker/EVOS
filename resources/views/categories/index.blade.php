@extends('layouts.app')

@section('title', 'Kategorien')

@section('content')

    <h1>Kategorien</h1>

    <div class="table">
        @if($categories->count() > 0)
            <table class="table table-striped">
                <tbody class="table-hover">
                @foreach($categories as $category)
                    <tr>
                        <td style="vertical-align: middle">
                            <a href="{{ action('CategoryController@show', [$category->id]) }}" class="block-link">{{ $category->title }}</a>
                        </td>
                        <td>
                            <div class="btn-group pull-right">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        Ändern
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <li><a href="{{ action('CategoryController@edit', [$category->id]) }}"
                                               data-toggle="tooltip" data-placement="left"
                                               title="Gibt die Möglichkeit den Titel der Kategorie zu ändern.">Titel
                                                ändern</a></li>
                                        <li>
                                            <a href="#" class="alert-danger delete-button" data-toggle="tooltip" data-placement="left"
                                               title="Löscht die Kategorie" data-cat-id="{{ $category->id }}" data-cat-title="{{ $category->title }}">Löschen</a>
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
        <a class="btn btn-primary" style="margin-top: -7px;" href="{{ action('CategoryController@create') }}"
           data-toggle="tooltip"
           data-placement="left" title="Erstellt eine neue Kategorie.">Kategorie erstellen</a>
    </div>

    <div id="delete-confirmation" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Kategorie löschen</h4>
                </div>
                <div class="modal-body">
                    <p>Soll die Kategorie <i id="category-title"></i> wirklich gelöscht werden?</p>
                </div>
                <div class="modal-footer">
                    {{ Form::open(['method' => 'delete', 'id' => 'delete-form']) }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>
                    {{ Form::submit('Löschen', ['class'=>'btn btn-danger', 'delete-submit', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Löscht die ausgewählte Kategorie']) }}
                    {{ Form::close() }}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
