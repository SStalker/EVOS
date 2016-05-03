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
                <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
                <a class="btn btn-default" style="margin-top: -7px;"
                   href="{!! action('QuestionController@edit', [$question->quiz->id, $question->id]) !!}">Bearbeiten</a>
            </div>

            {!! $question->quiz->category->title !!} &raquo; {!! $question->quiz->title !!} &raquo; {!! $question->question !!}
        </div>

        <div class="panel-body">
            <div class="container-fluid">
                <div class="row answer">
                    <div class="col-md-6">{{ $question->answerA }}</div>
                    <div class="col-md-6">{{ $question->answerB }}</div>
                </div>
                @if(!empty($question->answerC) || !empty($question->answerD))
                    <div class="row answer">
                        @if(!empty($question->answerC))
                            <div class="col-md-{{ empty($question->answerD) ? '12' : '6' }}">{{ $question->answerC }}</div>
                        @endif
                        @if(!empty($question->answerD))
                            <div class="col-md-{{ empty($question->answerC) ? '12' : '6' }}">{{ $question->answerD }}</div>
                        @endif
                    </div>
                @endif
            </div>

            Countdown: {!! $question->countdown !!}
        </div>
    </div>

@endsection