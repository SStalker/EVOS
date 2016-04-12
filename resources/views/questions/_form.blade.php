<div class="panel-body">
    <div class="form-group">
        <label for="question">Frage</label>
        {!! Form::textarea('question', null, ['class' => 'form-control', 'rows' => 3]) !!} <br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
    </div>
    <div class="form-group">
        <label for="answerA">Antwort 1</label>
        {!! Form::text('answerA', null, ['class' => 'form-control']) !!}<br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
    </div>
    <div class="form-group">
        <label for="answerB">Antwort 2</label>
        {!! Form::text('answerB', null, ['class' => 'form-control']) !!}<br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
    </div>
    <div class="form-group">
        <label for="answerC">Antwort 3</label>
        {!! Form::text('answerC', null, ['class' => 'form-control']) !!}<br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
    </div>
    <div class="form-group">
        <label for="answerD">Antwort 4</label>
        {!! Form::text('answerD', null, ['class' => 'form-control']) !!}<br>
        <a class="btn btn-primary" style="margin-top: -7px;" href="">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
    </div>
    <div class="form-group">
        <label for="countdown">Countdown</label>
        {!! Form::number('countdown', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="panel-footer">
    {!! Form::submit($submitLabel, ['class'=>'btn btn-primary']) !!}
</div>