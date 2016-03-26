@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="pull-right">
            <a class="btn btn-primary" style="margin-top: -7px;" href="{!! url('/questions/create') !!}">Frage erstellen</a>
        </div>

        {!! $quiz->title !!}
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            @if($quiz->questions->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>Frage</th>
                        <th>Aktionen</th>
                    </tr>
                    </thead>
                    <tbody class="table-hover">
                    @foreach($quiz->questions as $question)
                        <tr>
                            <td>{!! $question->question !!}</td>
                            <td>
                                <a class="btn btn-default" href="{!! url('/questions/edit/'.$question->id) !!}">Bearbeiten</a>
                                {!! Form::open(['action' => ['QuestionController@destroy', $question->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Löschen', ['class'=>'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                Es sind noch keine Fragen vorhanden. Füge jetzt eine hinzu:<br>
                <a class="btn btn-primary" href="{!! url('/questions/create') !!}">Frage erstellen</a>
            @endif
        </div>
    </div>
</div>

@endsection