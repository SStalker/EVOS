@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-primary" style="margin-top: -7px;" href="{!! url('/quizzes/create?category_id='.$category->id) !!}">Quiz erstellen</a>
            <a class="btn btn-default" style="margin-top: -7px;" href="{!! URL::previous() !!}">Zurück</a>
        </div>

        {!! $category->title !!}
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            @if($category->quizzes->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Titel</th>
                    <th>Aktionen</th>
                </tr>
                </thead>
                <tbody class="table-hover">
                @foreach($category->quizzes as $quiz)
                    <tr>
                        <td>{!! $quiz->title !!}</td>
                        <td>
                            <a class="btn btn-default" href="{!! url('/quizzes/edit/'.$quiz->id) !!}">Bearbeiten</a>
                            {!! Form::open(['action' => ['QuizController@destroy', $quiz->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Löschen', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                Es sind noch keine Quizze vorhanden. Füge jetzt eine hinzu:<br>
                <a class="btn btn-primary" href="{!! url('/quizzes/create') !!}">Quiz erstellen</a>
            @endif
        </div>
    </div>
</div>

@endsection
