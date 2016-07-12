@extends('layouts.app')

@section('title', 'Quiz '.$quiz->title)

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-primary" style="margin-top: -7px;"
                   href="{{ action('QuestionController@create', [$quiz->id]) }}" data-toggle="tooltip"
                   data-placement="left" title="Fügt eine neue Frage zum aktuellen Quiz hinzu.">Frage erstellen</a>
                @if(!$quiz->questions->isEmpty())
                    <a class="btn btn-primary" style="margin-top: -7px;"
                       href="{!! action('QuizController@start', [$quiz->category->id, $quiz->id]) !!}"
                       data-toggle="tooltip" data-placement="left"
                       title="Startet das Quiz und gibt Teilnehmern die Möglichkeit sich anzumelden.">Quiz starten</a>
                @endif
            </div>
            <a href="{!! action('CategoryController@show', [$quiz->category->id, $quiz->id]) !!}">{!! $quiz->category->title !!}</a>
            &raquo;
            <a href="{!! action('QuizController@show', [$quiz->category->id, $quiz->id]) !!}">{!! $quiz->title !!}</a>
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                @if($quiz->questions->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Frage</th>
                            <th style="width: 30%">Aktionen</th>
                        </tr>
                        </thead>
                        <tbody class="table-hover">
                        @foreach($quiz->questions as $question)
                            <tr>
                                <td>
                                    <a href="{!! action('QuestionController@show', [$quiz->id, $question->id]) !!}">{!! $question->title !!}</a>
                                </td>
                                <td>
                                    {{ Form::open(['action' => ['QuestionController@destroy', $quiz->id, $question->id], 'method' => 'delete']) }}
                                    <a class="btn btn-default"
                                       href="{{ action('QuestionController@edit', [$quiz->id, $question->id]) }}"
                                       data-toggle="tooltip" data-placement="left"
                                       title="Gibt die Möglichkeit die Frage, samit Titel und Antworten zu bearbeiten.">Bearbeiten</a>
                                    {{ Form::submit('Löschen', ['class'=>'btn btn-danger', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Löscht die ausgewählte Frage.']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    Es sind noch keine Fragen vorhanden. Füge jetzt eine hinzu:<br>
                    <a class="btn btn-primary" href="{{ action('QuestionController@create', [$quiz->id]) }}"
                       data-toggle="tooltip" data-placement="left"
                       title="Legt eine neue Frage im aktuellen Quiz an.">Frage erstellen</a>
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