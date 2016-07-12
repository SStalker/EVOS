@extends('layouts.app')

@section('title', 'Kategorie '.$category->title)

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">

                <a class="btn btn-primary" style="margin-top: -7px;"
                   href="{{ action('CategoryController@create', ['parent_id' => $category->id]) }}"
                   data-toggle="tooltip" data-placement="left"
                   title="Erstell in der aktuellen Kategorie eine Unterkategorie.">Unterkategorie
                    erstellen</a>
                <a class="btn btn-primary" style="margin-top: -7px;"
                   href="{{ action('QuizController@create', [$category->id]) }}" data-toggle="tooltip"
                   data-placement="left" title="Erstellt ein neues Quiz.">Quiz erstellen</a>

            </div>
            <a href="{!! action('CategoryController@index', []) !!}">Kategorien</a>
            &raquo;
            <a href="{!! action('CategoryController@show', [$category->id]) !!}">{!! $category->title !!}</a>
        </div>

        <div class="panel-body">
            <div class="table-responsive">

                @if($category->children->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="min-width: 130px;">Unterkategorie</th>
                            <th style="width:40%; min-width: 260px;">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($category->children as $childCategory)
                            <tr>
                                <td>
                                    <a href="{{ action('CategoryController@show', [$childCategory->id]) }}">{{ $childCategory->title }}</a>
                                </td>
                                <td>
                                    {{--
                                                                        {{ Form::open(['action' => ['CategoryController@destroy', $category->id], 'method' => 'delete']) }}
                                    <a class="btn btn-default"
                                       href="{{ action('CategoryController@edit', [$category->id]) }}"
                                       data-toggle="tooltip" data-placement="left"
                                       title="Gibt die Möglichkeit den Titel der Kategorie zu ändern.">Kategorietitel
                                        ändern</a>
                                    {{ Form::submit('Löschen', ['class'=>'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Löscht die ausgewählte Kategorie']) }}
                                    {{ Form::close() }}

                                    --}}

                                    {{ Form::open(['action' => ['CategoryController@destroy', $childCategory->id], 'method' => 'delete']) }}
                                    <a class="btn btn-default"
                                       href="{{ action('CategoryController@edit', [$category->id]) }}"
                                       data-toggle="tooltip" data-placement="left"
                                       title="Gibt die Möglichkeit den Titel der Kategorie zu ändern.">Kategorietitel
                                        ändern</a>
                                    {{ Form::submit('Löschen', ['class'=>'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Löscht die ausgewählte Kategorie']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif

                @if($category->quizzes->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="min-width: 130px;">Quiz</th>
                            <th style="width:40%; min-width: 260px;">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($category->quizzes as $quiz)
                            <tr>
                                <td>
                                    <a href="{{ action('QuizController@show', [$category->id, $quiz->id]) }}">{{ $quiz->title }}</a>
                                </td>
                                <td>
                                    {!! Form::open(['action' => ['QuizController@destroy', $category->id, $quiz->id], 'method' => 'delete', 'style' => 'display: inline-block']) !!}
                                    @if(!$quiz->questions->isEmpty())
                                        <a class="btn btn-primary"
                                           href="{!! action('QuizController@start', [$category->id, $quiz->id])!!}"
                                           data-toggle="tooltip" data-placement="left"
                                           title="Startet das Quiz und gibt Teilnehmern die Möglichkeit am Quiz anzumelden.">Quiz
                                            starten</a>
                                    @else
                                        <a class="btn btn-primary"
                                           href="{!! action('QuizController@start', [$category->id, $quiz->id])!!}"
                                           data-toggle="tooltip" data-placement="left"
                                           title="Das Quiz enthält keine Fragen und kann daher nicht gestartet werden."
                                           disabled>Quiz
                                            starten</a>
                                    @endif
                                    <a class="btn btn-default"
                                       href="{!! action('QuizController@edit', [$category->id, $quiz->id])!!}"
                                       data-toggle="tooltip" data-placement="left"
                                       title="Der Titel des Quiz kann hier geändert werden.">Quiztitel ändern</a>
                                    {!! Form::submit('Löschen', ['class'=>'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Löscht das Quiz.']) !!}
                                    @if(!$quiz->questions->isEmpty())
                                        {!! Form::close() !!}
                                        {!! Form::open(['action' => ['ShareController@store'], 'method' => 'POST', 'style' => 'display: inline-block']) !!}
                                        {!! Form::submit('Teilen', ['data-toggle'=>'tooltip', 'class'=>'btn btn-info', 'title'=>'Dieses Quiz für andere Nutzer zur Verfügung stellen.', 'data-placement'=>'left']) !!}
                                        {!! Form::hidden('quiz_id', $quiz->id) !!}
                                        {!! Form::close() !!}
                                    @else
                                        <a href="#" class="btn btn-info" data-toggle="tooltip" data-placement="left"
                                           title="Das Quiz enthält keine Fragen und kann daher nicht geteilt werden."
                                           disabled>Teilen</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    Es sind noch keine Quizze vorhanden. Füge jetzt eine hinzu:<br>
                    <a class="btn btn-primary" href="{{ action('QuizController@create', [$category->id]) }}">Quiz
                        erstellen</a>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

@endsection


