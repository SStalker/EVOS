@extends('layouts.app')

@section('title', 'Frage anzeigen')

@section('content')

    @if($errors->any() || (empty($categories) && empty($quizzes) && empty($questions)))
        <h1>Keine Suchergebnisse</h1>
    @else
        <h1>Suche nach &bdquo;{{ $input }}&ldquo;</h1>

        <div class="table">
            <h2>Kategorien</h2>
            <table class="table table-striped table-middle">
                <tbody class="table-hover">
                @foreach($categories as $category)
                    <tr>
                        <td>
                            <a class="block-link" href="{{ action('CategoryController@show', [$category->id]) }}">{{ $category->title }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="table">
            <h2>Quiz</h2>
            <table class="table table-striped table-middle">
                <tbody class="table-hover">
                @foreach($quizzes as $quiz)
                    <tr>
                        <td>
                            <a class="block-link" href="{{ action('QuizController@show', [$quiz->category->id, $quiz->id]) }}">{{ $quiz->title }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="table">
            <h2>Fragen</h2>
            <table class="table table-striped table-middle">
                <tbody class="table-hover">
                @foreach($questions as $question)
                    <tr>
                        <td>
                            <a class="block-link" href="{{ action('QuestionController@show', [$question->quiz->id, $question->id]) }}">{{ $question->question }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection