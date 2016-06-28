@extends('layouts.app')

@section('title', 'Kategorie '.$category->title)

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">

                <a class="btn btn-primary" style="margin-top: -7px;"
                   href="{{ action('CategoryController@create', ['parent_id' => $category->id]) }}">Unterkategorie
                    erstellen</a>
                <a class="btn btn-primary" style="margin-top: -7px;"
                   href="{{ action('QuizController@create', [$category->id]) }}">Quiz erstellen</a>

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
                            <th style="width:30%; min-width: 260px;">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($category->children as $childCategory)
                            <tr>
                                <td>
                                    <a href="{{ action('CategoryController@show', [$childCategory->id]) }}">{{ $childCategory->title }}</a>
                                </td>
                                <td>

                                    {{ Form::open(['action' => ['CategoryController@destroy', $childCategory->id], 'method' => 'delete']) }}
                                    <a class="btn btn-default"
                                       href="{{ action('CategoryController@edit', [$childCategory->id]) }}">Bearbeiten</a>
                                    {{ Form::submit('Löschen', ['class'=>'btn btn-danger']) }}
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
                            <th style="width:30%; min-width: 260px;">Aktionen</th>
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
                                           href="{!! action('QuizController@start', [$category->id, $quiz->id])!!}">Quiz
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
                                       href="{!! action('QuizController@edit', [$category->id, $quiz->id])!!}">Bearbeiten</a>
                                    {!! Form::submit('Löschen', ['class'=>'btn btn-danger']) !!}
                                    @if(!$quiz->questions->isEmpty())
                                        {!! Form::close() !!}
                                        {!! Form::open(['action' => ['ShareController@store'], 'method' => 'POST', 'style' => 'display: inline-block']) !!}
                                        {!! Form::submit('Teilen', ['data-toggle'=>'tooltip', 'class'=>'btn btn-info', 'title'=>'Dieses Quiz für andere Nutzer zur Verfügung stellen', 'data-placement'=>'left']) !!}
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


