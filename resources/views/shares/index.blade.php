@extends('layouts.app')

@section('title', 'Ihre Freigaben')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active">Freigaben</li>
    </ol>
@endsection

@section('content')

    <h1>Freigaben</h1>

    <div class="table">
        @if($shares->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Titel</th>
                </tr>
                </thead>
                <tbody class="table-hover">
                @foreach($shares as $share)
                    <tr>
                        <td>
                            <a href="{{ action('ShareController@show', [$share->id]) }}">{{ $share->quiz->title }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            Zurzeit haben Sie keine offenen Freigaben mehr. Sie können neue Freigaben erstellen, wenn Sie
            in den <a href="{{ action('CategoryController@index') }}">Kategorien</a> in den Kategorie-Aktionen
            auf die jeweiligen <a href="#" class="btn-xs btn-info">Teilen</a>-Schaltfläche klicken.
        @endif
    </div>

@endsection
