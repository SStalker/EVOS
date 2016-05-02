@extends('layouts.app')

@section('title', 'Frage anzeigen')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Suche nach {{ $input }}
        </div>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Kategorien</th>
                        <th style="width:30%">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <a href="{{ action('CategoryController@show', [$category->id]) }}">{{ $category->title }}</a>
                            </td>
                            <td>
                                {{ Form::open(['action' => ['CategoryController@destroy', $category->id], 'method' => 'delete']) }}
                                <a class="btn btn-default" href="{{ action('CategoryController@edit', [$category->id])}}">Bearbeiten</a>
                                {{ Form::submit('Löschen', ['class'=>'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Quizze</th>
                        <th style="width:30%">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    @foreach($quizzes as $quiz)
                        <tr>
                            <td>
                                <a href="{{ action('QuizController@show', [$quiz->category->id, $quiz->id]) }}">{{ $quiz->title }}</a>
                            </td>
                            <td>
                                {{ Form::open(['action' => ['QuizController@destroy', $quiz->category->id, $quiz->id], 'method' => 'delete']) }}
                                <a class="btn btn-default" href="{{ action('QuizController@edit', [$quiz->category->id, $quiz->id])}}">Bearbeiten</a>
                                {{ Form::submit('Löschen', ['class'=>'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Fragen</th>
                        <th style="width:30%">Aktionen</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    @foreach($questions as $question)
                        <tr>
                            <td>
                                <a href="{{ action('QuestionController@show', [$question->quiz->category->id, $question->quiz->id, $question->id]) }}">{{ $question->question }}</a>
                            </td>
                            <td>
                                {{ Form::open(['action' => ['QuestionController@destroy', $question->quiz->category->id, $question->quiz->id, $question->id], 'method' => 'delete']) }}
                                <a class="btn btn-default" href="{{ action('QuestionController@edit', [$question->quiz->category->id, $question->quiz->id, $question->id])}}">Bearbeiten</a>
                                {{ Form::submit('Löschen', ['class'=>'btn btn-danger']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection