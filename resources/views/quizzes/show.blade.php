@extends('layouts.app')

@section('title', 'Quiz '.$quiz->title)

@section('breadcrumb')
    <ol class="breadcrumb container">
        <li><a href="{{ action('CategoryController@index') }}">Kategorien</a></li>
        <li><a href="{{ action('CategoryController@show', $quiz->category->id) }}">{{ $quiz->category->title }}</a></li>
        <li class="active">{{ $quiz->title }}</li>
    </ol>
@endsection

@section('content')

    <h1>Fragen vom Quiz <i>{{ $quiz->title }}</i></h1>

    <div class="table">
        @if($quiz->questions->count() > 0)
            <table class="table table-striped table-middle">
                <tbody class="table-hover">
                @foreach($quiz->questions as $question)
                    <tr>
                        <td>
                            <a class="block-link" href="{!! action('QuestionController@show', [$quiz->id, $question->id]) !!}">{!! $question->title !!}</a>
                        </td>
                        <td>
                            <div class="btn-group pull-right">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button"
                                            id="dropdownMenu1-{{ $question->id }}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        Aktion wählen
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenu1-{{ $question->id }}">
                                        <li><a href="{{ action('QuestionController@edit', [$quiz->id, $question->id]) }}"
                                               data-toggle="tooltip" data-placement="left" title="Fragenamen, Inhalt und Antworten bearbeiten.">Frage bearbeiten</a></li>
                                        <li>
                                            <a href="#" class="alert-danger question-delete-button"
                                               data-toggle="tooltip" data-placement="left" title="Löscht die Kategorie" data-question-id="{{ $question->id }}"
                                               data-quiz-id="{{ $quiz->id }}" data-question-title="{{ $question->title }}">Löschen</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            Das Quiz enthält leider noch keine Fragen. Du kannst nun <a href="{{ action('QuestionController@create', [$quiz->id]) }}">neue Fragen hinzufügen</a>.<br>
        @endif
    </div>

    <div class="pull-right">
        <a class="btn btn-primary" style="margin-top: -7px;"
           href="{{ action('QuestionController@create', [$quiz->id]) }}" data-toggle="tooltip"
           data-placement="left" title="Fügt eine neue Frage zum aktuellen Quiz hinzu.">Frage hinzufügen</a>
        @if(!$quiz->questions->isEmpty())
            <a class="btn btn-primary" style="margin-top: -7px;"
               href="{!! action('QuizController@start', [$quiz->category->id, $quiz->id]) !!}"
               data-toggle="tooltip" data-placement="left"
               title="Startet das Quiz und gibt Teilnehmern die Möglichkeit sich anzumelden.">Quiz starten</a>
        @endif
    </div>

    @include('questions._confirmdialog')

    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $('.question-delete-button').on('click', function () {
                $('#question-title').text($(this).data('question-title'));
                $('#question-delete-form').attr('action', '{{ action('QuestionController@destroy', ['!!qiid!!', '!!qeid!!']) }}'
                        .replace(/!!qiid!!/, $(this).data('quiz-id'))
                        .replace(/!!qeid!!/, $(this).data('question-id')));
                $('#question-delete-confirmation').modal();
            });
        });
    </script>

@endsection