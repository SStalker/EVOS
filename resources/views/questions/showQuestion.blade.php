@extends('layouts.quizbackend')

@section('title', 'Bitte anmelden!')

@section('content')

    {!! $question->question !!}

    <a class="btn btn-primary next-button" href="{!! action('QuizController@next', [$question->quiz->category->id, $question->quiz->id]) !!}">Nächste Frage</a>

@endsection