<div class="panel-body">
    <div class="form-group">
        <label for="question">Frage</label>
        {!! Form::text('question', null, ['class' => 'form-control']) !!} <br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a> <a class="btn btn-default" style="margin-top: -7px;" href="">Bild anhängen</a>
    </div>
    <div class="form-group">
        <label for="answerA">Antwort 1</label>
        {!! Form::textarea('answerA', null, ['class' => 'form-control', 'rows' => 2]) !!}<br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a> <a class="btn btn-default" style="margin-top: -7px;" href="">Bild anhängen</a>
    </div>
    <div class="form-group">
        <label for="answerB">Antwort 2</label>
        {!! Form::textarea('answerB', null, ['class' => 'form-control', 'rows' => 2]) !!}<br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a> <a class="btn btn-default" style="margin-top: -7px;" href="">Bild anhängen</a>
    </div>
    <div class="form-group">
        <label for="answerC">Antwort 3</label>
        {!! Form::textarea('answerC', null, ['class' => 'form-control', 'rows' => 2]) !!}<br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a> <a class="btn btn-default" style="margin-top: -7px;" href="">Bild anhängen</a>
    </div>
    <div class="form-group">
        <label for="answerD">Antwort 4</label>
        {!! Form::textarea('answerD', null, ['class' => 'form-control', 'rows' => 2]) !!}<br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a> <a class="btn btn-default" style="margin-top: -7px;" href="">Bild anhängen</a>
    </div>
    <div class="form-group">
        <label for="countdown">Countdown</label>
        {!! Form::number('countdown', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="panel-footer">
    {!! Form::submit($submitLabel, ['class'=>'btn btn-primary']) !!}
</div>