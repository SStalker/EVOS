@extends('layouts.app')

@section('title', 'Frage anzeigen')

@section('breadcrumb')
    <ol class="breadcrumb container">
        <li><a href="{{ action('CategoryController@index') }}">Kategorien</a></li>
        <li><a href="{{ action('CategoryController@show', $question->quiz->category->id) }}">{{ $question->quiz->category->title }}</a></li>
        <li><a href="{{ action('QuizController@show', [ $question->quiz->category->id, $question->quiz->id ]) }}">{{ $question->quiz->title }}</a></li>
        <li class="active">{{ $question->title }}</li>
    </ol>
@endsection

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

    <h1>{{ $question->title }}</h1>

    <div style="font-size: 130%; margin-bottom: 2em;" id="question-body">{{ $question->question }}</div>
    <div>
        <label>Antwortmöglichkeiten</label>
        <div class="container-fluid" style="margin-bottom: 2em">
            <div class="row answer" style="visibility: hidden" >
                <div class="answer-cell col-md-6 {{ $question->answerABool ? 'correct-answer' : 'incorrect-answer' }}"><div class="answer-panel">{{ $question->answerA }}</div></div>
                <div class="answer-cell col-md-6 {{ $question->answerBBool ? 'correct-answer' : 'incorrect-answer' }}"><div class="answer-panel">{{ $question->answerB }}</div></div>
            </div>
            @if(!empty($question->answerC) || !empty($question->answerD))
                <div class="row answer" style="visibility: hidden">
                    @if(!empty($question->answerC))
                        <div class="answer-cell col-md-{{ empty($question->answerD) ? '12' : '6' }} {{ $question->answerCBool ? 'correct-answer' : 'incorrect-answer' }}"><div class="answer-panel">{{ $question->answerC }}</div></div>
                    @endif
                    @if(!empty($question->answerD))
                        <div class="answer-cell col-md-{{ empty($question->answerC) ? '12' : '6' }} {{ $question->answerDBool ? 'correct-answer' : 'incorrect-answer' }}"><div class="answer-panel">{{ $question->answerD }}</div></div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <div class="form-group"><label>Countdown</label>
        <div>{{ $question->countdown }} Sekunden</div>
    </div>

    <div class="pull-right">
        <a class="btn btn-primary"
           href="{!! action('QuestionController@edit', [$question->quiz->id, $question->id]) !!}">Bearbeiten</a>
    </div>

    <script>
        $(function () {

            var questionBody = $('#question-body').text();
            var images = questionBody.match(/\[image\((\d+\.[A-Za-z]{1,4})\)\]/g);
            if (images != null) {
                images.forEach(function (image) {
                    var matches = image.match(/.*\((\d+\.[A-Za-z]{1,4})\).*/);
                    var html = '<img src="{{ asset('storage/uploads/') }}/' + matches[1] + '">';
                    questionBody = questionBody.replace(matches[0], html);
                });
            }

            // for some reason matching over multiple lines doesn't work... So we'll go a different way solving this issue.
            questionBody = questionBody.replace(/\[code\]/g, '<pre><code>');
            questionBody = questionBody.replace(/\[\/code\]/g, '</code></pre>');
            $('#question-body').html(questionBody);

            //Resize after MathJax has done its work
            MathJax.Hub.Register.StartupHook("End", function () {
                //Equal height of answer divs
                var answerCell = $('.answer-cell');

                var answers = $('.answer');
                console.log(answers);
                var maxHeight = 0;
                answers.each(function () {
                    var height = $(this).outerHeight();
                    maxHeight = height > maxHeight ? height : maxHeight;
                    console.log($(this));
                    console.log(height);
                });
                answerCell.height(maxHeight);

                $('.container-fluid .answer').css("visibility", "");
            });

        })
    </script>

@endsection