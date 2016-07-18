@extends('layouts.app')

@section('title', 'Kategorie '.$category->title)

@section('breadcrumb')
    <ol class="breadcrumb container">
        <li><a href="{{ action('CategoryController@index') }}">Kategorien</a></li>
        @if($category->parent != null)
            <li><a href="{{ action('CategoryController@show', $category->parent->id) }}">{{ $category->parent->title }}</a></li>
        @endif
        <li class="active">{{ $category->title }}</li>
    </ol>
@endsection

@section('content')
    @if($category->children->count() > 0)
        <h1>Kategorien</h1>

        <div class="table">
            <table class="table table-striped table-middle">
                <tbody class="table-hover">
                @foreach($category->children as $childCategory)
                    <tr>
                        <td>
                            <a href="{{ action('CategoryController@show', [$childCategory->id]) }}"
                               class="block-link">{{ $childCategory->title }}</a>
                        </td>
                        <td>
                            <div class="btn-group pull-right">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button"
                                            id="dropdownMenu1-{{ $childCategory->id }}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        Ändern
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenu1-{{ $childCategory->id }}">
                                        <li><a href="{{ action('CategoryController@edit', [$childCategory->id]) }}"
                                               data-toggle="tooltip" data-placement="left"
                                               title="Gibt die Möglichkeit den Namen der Kategorie zu ändern.">Kategorienamen
                                                ändern</a></li>
                                        <li>
                                            <a href="#" class="alert-danger category-delete-button"
                                               data-toggle="tooltip"
                                               data-placement="left"
                                               title="Löscht die Kategorie" data-cat-id="{{ $childCategory->id }}"
                                               data-cat-title="{{ $childCategory->title }}">Löschen</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h1>Quiz</h1>
    <div class="table">
        @if($category->quizzes->count() > 0)
            <table class="table table-striped table-middle">
                <tbody class="table-hover">
                @foreach($category->quizzes as $quiz)
                    <tr>
                        <td>
                            <a href="{{ action('QuizController@show', [$category->id, $quiz->id]) }}"
                               class="block-link">{{ $quiz->title }}</a>
                        </td>
                        <td>
                            <div class="btn-group pull-right">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button"
                                            id="dropdownMenu2-{{ $quiz->id }}"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        Ändern
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="dropdownMenu2-{{ $quiz->id }}">
                                        <li>
                                            @if($quiz->questions->isEmpty())
                                                <a class="disabled-cursor" data-toggle="tooltip"
                                                   data-placement="left"
                                                   title="Das Quiz enthält keine Fragen und kann daher nicht gestartet werden."></a>
                                            @else
                                                <a href="{{ $quiz->questions->isEmpty() ? '' : action('QuizController@start', [$category->id, $quiz->id]) }}"
                                                   data-toggle="tooltip" data-placement="left"
                                                   title="Das Quiz starten.">Quiz starten</a>
                                            @endif
                                        </li>
                                        <li>
                                            <a href="{{ action('QuizController@edit', [$category->id, $quiz->id]) }}"
                                               data-toggle="tooltip" data-placement="left"
                                               title="Name des Quiz ändern.">Quiznamen ändern</a>
                                        </li>
                                        <li>
                                            @if($quiz->questions->isEmpty())
                                                <a class="alert-info disabled-cursor"
                                                   data-toggle="tooltip" data-placement="left"
                                                   title="Das Quiz enthält keine Fragen und kann daher nicht geteilt werden.">Teilen</a>
                                            @else
                                                <a href="" class="alert-info share-quiz-button" data-toggle="tooltip"
                                                   data-placement="left"
                                                   title="Dieses Quiz für andere Nutzer zur Verfügung stellen.">Teilen</a>
                                            @endif
                                        </li>
                                        <li>
                                            <a href="#" class="alert-danger quiz-delete-button" data-toggle="tooltip"
                                               data-placement="left" title="Dieses Quiz löschen."
                                               data-quiz-id="{{ $quiz->id }}" data-cat-id="{{ $category->id }}"
                                               data-quiz-title="{{ $quiz->title }}">Löschen</a>
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
            Es sind noch keine Quizze vorhanden. Füge jetzt eine hinzu:<br>
            <a class="btn btn-primary" href="{{ action('QuizController@create', [$category->id]) }}">Quiz
                erstellen</a>
        @endif
    </div>


    <div class="pull-right">
        <a class="btn btn-primary" href="{{ action('CategoryController@create', ['parent_id' => $category->id]) }}"
           data-toggle="tooltip" data-placement="left" title="Erstell in der aktuellen Kategorie eine Unterkategorie.">Unterkategorie
            erstellen</a>
        <a class="btn btn-primary" href="{{ action('QuizController@create', [$category->id]) }}" data-toggle="tooltip"
           data-placement="left" title="Erstellt ein neues Quiz.">Quiz erstellen</a>
    </div>

    @include('quizzes._confirmdialog')
    @include('categories._confirmdialog')

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();

            $('.category-delete-button').on('click', function () {
                $('#category-title').text($(this).data('cat-title'));
                $('#delete-form').attr('action', '{{ action('CategoryController@destroy', '') }}/' + $(this).data('cat-id'));
                $('#delete-confirmation').modal();
            });

            $('.quiz-delete-button').on('click', function () {
                $('#quiz-title').text($(this).data('quiz-title'));
                $('#quiz-delete-form').attr('action', '{{ action('QuizController@destroy', ['!!cid!!', '!!qid!!']) }}'
                        .replace(/!!cid!!/, $(this).data('cat-id'))
                        .replace(/!!qid!!/, $(this).data('quiz-id')));
                $('#quiz-delete-confirmation').modal();
            });
        });
    </script>
@endsection


