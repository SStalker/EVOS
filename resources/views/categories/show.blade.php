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
                            <th>Titel</th>
                            <th>Besitzer</th>
                            <th style="width:30%">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($category->children as $childCategory)
                            <tr>
                                <td>
                                    <a href="{{ action('CategoryController@show', [$childCategory->id]) }}">{{ $childCategory->title }}</a>
                                </td>
                                <td>{{ $childCategory->user->name }}</td>
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
                            <th>Quiz</th>
                            <th style="width:35%">Aktionen</th>
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
                                    @endif
                                    <a class="btn btn-default"
                                       href="{!! action('QuizController@edit', [$category->id, $quiz->id])!!}">Bearbeiten</a>
                                    {!! Form::submit('Löschen', ['class'=>'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                    {!! Form::open(['action' => ['ShareController@store'], 'method' => 'POST', 'style' => 'display: inline-block']) !!}
                                    {!! Form::submit('Teilen', ['class'=>'btn btn-info']) !!}
                                    {!! Form::hidden('quiz_id', $quiz->id) !!}
                                    {!! Form::close() !!}
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

@endsection
