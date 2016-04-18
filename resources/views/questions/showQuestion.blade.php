{!! $question->question !!}

<a class="btn btn-primary" style="margin-top: -7px;" href="{!! action('QuizController@next', [$question->quiz->category->id, $question->quiz->id])  !!}">Nächste Frage</a>
