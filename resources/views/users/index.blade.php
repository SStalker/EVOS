@extends('layouts.app')

@section('title', 'Benutzerverwaltung')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a style="margin-top: -7px;" class="btn btn-primary" href="{{ action('UserController@create') }}">Benutzer
                    anlegen</a>
            </div>

            Benutzer
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
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
                                {{ Form::open(['action' => ['UserController@destroy', $user->id], 'method' => 'delete']) }}
                                <a href="{{ action('UserController@edit', $user->id) }}" class="btn btn-default">Bearbeiten</a>
                                {{ Form::submit('Löschen', ['class'=>'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection
