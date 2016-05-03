@extends('layouts.app')

@section('title', 'Frage anzeigen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
                <a class="btn btn-default" style="margin-top: -7px;" href="{{ action('QuestionController@edit', [$question->quiz->id, $question->id]) }}">Bearbeiten</a>
            </div>
            <a href="{!! action('CategoryController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">{!! $question->quiz->category->title !!}</a>
            &raquo;
            <a href="{!! action('QuizController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">{!! $question->quiz->title !!}</a>
            &raquo;
            <a href="{!! action('QuestionController@show', [$question->quiz->category->id, $question->quiz->id, $question->id]) !!}">{!! $question->question !!}</a>
        </div>

        <div class="panel-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>{{ $question->answerA }}</td>
                    <td>{{ $question->answerB }}</td>
                </tr>
                <tr>
                    <td>{{ $question->answerC }}</td>
                    <td>{{ $question->answerD }}</td>
                </tr>
                </tbody>
            </table>

            Countdown: {{ $question->countdown }}
        </div>
    </div>

@endsection