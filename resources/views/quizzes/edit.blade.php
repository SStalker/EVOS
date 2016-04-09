@extends('layouts.app')

@section('title', 'Quiz '.$quiz->title)

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-primary" style="margin-top: -7px;" href="{!! action('QuestionController@create', [$quiz->id]) !!}">Frage erstellen</a>
        </div>
        {!! $quiz->category->title !!} -> {!! $quiz->title !!} bearbeiten
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            @if($quiz->questions->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>Frage</th>
                        <th style="width: 30%;">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    @foreach($quiz->questions as $question)
                        <tr>
                            <td>{!! $question->question !!}</td>
                            <td>
                                {!! Form::open(['action' => ['QuestionController@destroy', $quiz->category->id, $question->id], 'method' => 'delete']) !!}
                                    <a class="btn btn-default" href="{!! action('QuizController@edit', [$quiz->id, $question->id]) !!}">Bearbeiten</a>
                                    {!! Form::submit('Löschen', ['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                Es sind noch keine Fragen vorhanden. Füge jetzt eine hinzu:<br>
                <a class="btn btn-primary" href="{!! action('QuizController@create', [$quiz->id]) !!}">Frage erstellen</a>
            @endif
        </div>
    </div>
</div>

@endsection