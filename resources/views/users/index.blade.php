@extends('layouts.app')

@section('title', 'Benutzerverwaltung')

@section('breadcrumb')
    <ol class="breadcrumb container">
        <li class="active">Benutzerverwaltung</li>
    </ol>
@endsection

@section('content')

    <h1>Benutzerverwaltung</h1>

    <div class="table">
        <table class="table table-striped table-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Ist Administrator</th>
                <th>Aktionen</th>
            </tr>
            </thead>
            <tbody class="table-hover">
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="glyphicon glyphicon-{{ $user->isAdmin ? 'ok text-success' : 'remove text-danger' }}"
                              aria-hidden="true" data-toggle="tooltip" data-placement="top"
                              title="{{ $user->isAdmin ? 'Ist Administrator' : 'Ist kein Administrator' }}"></span>
                    </td>
                    <td>
                        <div class="btn-group pull-right">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button"
                                        id="dropdownMenu{{ $user->id }}"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    Ändern
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right"
                                    aria-labelledby="dropdownMenu{{ $user->id }}">
                                    <li>
                                        <a href="{{ action('UserController@edit', [$user->id]) }}" data-toggle="tooltip"
                                           data-placement="left" title="Den Benutzer bearbeiten.">Bearbeiten</a>
                                    </li>
                                    <li>
                                        <a href="#" class="alert-danger delete-button" data-toggle="tooltip"
                                           data-placement="left" title="Löscht den Benutzer"
                                           data-user-id="{{ $user->id }}"
                                           data-user-name="{{ $user->name }}">Löschen</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="pull-right">
        <a class="btn btn-primary" href="{{ action('UserController@create') }}">Benutzer anlegen</a>
    </div>

    @include('users._confirmdialog')

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $('.delete-button').on('click', function () {
                $('#user-name').text($(this).data('user-name'));
                $('#user-delete-form').attr('action', '{{ action('UserController@destroy', '') }}/' + $(this).data('user-id'));
                $('#user-delete-confirmation').modal();
            });
        });
    </script>

@endsection
