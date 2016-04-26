@extends('layouts.app')

@section('title', 'Quiz '.$quiz->title)

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-primary" style="margin-top: -7px;" href="{!! action('QuestionController@create', [$quiz->id]) !!}">Frage erstellen</a>
            @if(!$quiz->questions->isEmpty())
                <a class="btn btn-primary" style="margin-top: -7px;" href="{!! action('QuizController@next', [$quiz->category->id, $quiz->id]) !!}">Quiz starten</a>
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
                            <td><a href="{!! action('QuestionController@show', [$question->quiz->id, $question->id]) !!}">{!! $question->question !!}</a></td>
                            <td>
                                {!! Form::open(['action' => ['QuestionController@destroy', $quiz->id, $question->id], 'method' => 'delete']) !!}
                                    <a class="btn btn-default" href="{!! action('QuestionController@edit', [$quiz->id, $question->id]) !!}">Bearbeiten</a>
                                    {!! Form::submit('Löschen', ['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                Es sind noch keine Fragen vorhanden. Füge jetzt eine hinzu:<br>
                <a class="btn btn-primary" href="{!! action('QuestionController@create', [$quiz->id]) !!}">Frage erstellen</a>
            @endif
        </div>
    </div>
</div>

@endsection