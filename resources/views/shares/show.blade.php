@extends('layouts.app')

@section('title', 'Freigabe')

@section('content')

    @if(Auth::user()->id != $share->user->id)
        <h1>{{ $share->user->name }} hat ein Quiz für Sie freigegeben.</h1>
        <p>Sie können sich das Quiz anschauen und in Ihre Sammlung aufnehmen.</p>
    @else
        <h1>Sie haben ein Quiz freigegeben.</h1>
        <p>
            Sie können sich die Fragen und die dazugehörigen Antworten noch einmal anschauen.
            Am Ende der Seite finden Sie eine Adresse die Sie an <i>eine</i> Person weitergeben
            können. Diese kann die Quizze dann in ihre/seine Sammlung aufnehmen.
        </p>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ $share->quiz->title }}
        </div>

        <div class="panel-body">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                @foreach($share->quiz->questions as $question)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapse{{ $question->id }}" aria-expanded="false"
                                   aria-controls="collapse{{ $question->id }}">
                                    {{ $question->question }}
                                </a>
                            </h4>
                        </div>
                        <div id="collapse{{ $question->id }}" class="panel-collapse collapse" role="tabpanel"
                             aria-labelledby="heading{{ $question->id }}">
                            <ul class="list-group">
                                <li class="list-group-item {{ $question->getCorrectAnswers()['a'] ? 'correct-answer' : 'incorrect-answer' }}">{{ $question->answerA }}</li>
                                <li class="list-group-item {{ $question->getCorrectAnswers()['b'] ? 'correct-answer' : 'incorrect-answer' }}">{{ $question->answerB }}</li>
                                @if($question->answerC != null)
                                    <li class="list-group-item {{ $question->getCorrectAnswers()['c'] ? 'correct-answer' : 'incorrect-answer' }}">{{ $question->answerC }}</li>
                                @endif
                                @if($question->answerD != null)
                                    <li class="list-group-item {{ $question->getCorrectAnswers()['d'] ? 'correct-answer' : 'incorrect-answer' }}">{{ $question->answerD }}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="panel-footer">
            &nbsp;
            @if(Auth::user()->id != $share->user->id)
                <div class="pull-right">
                    {{ Form::open(['action' => ['ShareController@destroy', $share->id], 'method' => 'delete']) }}
                    {{ Form::submit("In eigener Sammlung speichern", ['id'=>'formSubmit','class'=>'btn btn-primary', 'style' => 'margin-top: -7px']) }}
                    {{ Form::close() }}
                </div>
            @else
                <input class="form-control" id="focusedInput" value="{!! Request::url() !!}" type="text"
                       style="margin-top: -7px" readonly>
            @endif
        </div>
    </div>

    <script>
        $(function () {
            $('#focusedInput').on('focus', function () {
                $(this).select();
            });
        });
    </script>

@endsection
