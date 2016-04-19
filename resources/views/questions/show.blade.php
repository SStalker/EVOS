@extends('layouts.app')

@section('title', 'Frage anzeigen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{{ URL::previous() }}">Zurück</a>
                <a class="btn btn-default" style="margin-top: -7px;" href="{{ action('QuestionController@edit', [$question->quiz->id, $question->id]) }}">Bearbeiten</a>
            </div>

            {{ $question->quiz->category->title }} &raquo; {{ $question->quiz->title }} &raquo; {{ $question->question }}
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