{!! $question->question !!}

<a class="btn btn-primary" style="margin-top: -7px;" href="{!! url('/quizzes/'.$question->quiz->id.'/next') !!}">Nächste Frage</a>