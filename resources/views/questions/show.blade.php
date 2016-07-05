@extends('layouts.app')

@section('title', 'Frage anzeigen')

@section('content')
    <style>
        .row.answer {
            border: 1px solid #dddddd;
            border-left: 0;
            border-bottom: 0px;
        }

        .row.answer:last-child {
            border-bottom: 1px solid #dddddd;
        }

        .row.answer > div {
            border-left: 1px solid #dddddd;
            padding: 8px;
        }
    </style>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="pull-right">
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! action('QuizController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">Zurück</a>
                <a class="btn btn-default" style="margin-top: -7px;"
                   href="{!! action('QuestionController@edit', [$question->quiz->id, $question->id]) !!}">Bearbeiten</a>
            </div>
            <a href="{!! action('CategoryController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">{!! $question->quiz->category->title !!}</a>
            &raquo;
            <a href="{!! action('QuizController@show', [$question->quiz->category->id, $question->quiz->id]) !!}">{!! $question->quiz->title !!}</a>
            &raquo;
            <a href="{!! action('QuestionController@show', [$question->quiz->category->id, $question->id]) !!}">{!! $question->title !!}</a>
        </div>

        <div class="panel-body">
            <div style="font-size: 130%; margin-bottom: 2em;">{{ $question->question }}</div>
            <div class="container-fluid" style="margin-bottom: 1em">
                <div class="row answer">
                    <div class="col-md-6 {{ $question->answerABool ? 'correct-answer' : 'incorrect-answer' }}">{{ $question->answerA }}</div>
                    <div class="col-md-6 {{ $question->answerBBool ? 'correct-answer' : 'incorrect-answer' }}">{{ $question->answerB }}</div>
                </div>
                @if(!empty($question->answerC) || !empty($question->answerD))
                    <div class="row answer">
                        @if(!empty($question->answerC))
                            <div class="col-md-{{ empty($question->answerD) ? '12' : '6' }} {{ $question->answerCBool ? 'correct-answer' : 'incorrect-answer' }}">{{ $question->answerC }}</div>
                        @endif
                        @if(!empty($question->answerD))
                            <div class="col-md-{{ empty($question->answerC) ? '12' : '6' }} {{ $question->answerDBool ? 'correct-answer' : 'incorrect-answer' }}">{{ $question->answerD }}</div>
                        @endif
                    </div>
                @endif
            </div>

            <div>Countdown: {{ $question->countdown }}</div>
        </div>
    </div>

@endsection