<div class="panel-body">
    <div class="form-group">
        <label for="question">Frage</label>
        {{ Form::textarea('question', null, ['id' => 'questionInput', 'class' => 'form-control', 'rows' => 3]) }} <br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#previewBox" data-preview="questionInput">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
    </div>
    <div class="form-group">
        <label for="answerA">Antwort 1</label>
        {{ Form::text('answerA', null, ['id' => 'answerA', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#previewBox" data-preview="answerA">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            {{ Form::checkbox('answerAbool', null, (isset($question) ? $question->answerABool : null), ['data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="answerB">Antwort 2</label>
        {{ Form::text('answerB', null, ['id' => 'answerB','class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#previewBox" data-preview="answerB">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            {{ Form::checkbox('answerBbool', null, (isset($question) ? $question->answerBBool : null), ['data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="answerC">Antwort 3</label>
        {{ Form::text('answerC', null, ['id' => 'answerC', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#previewBox" data-preview="answerC">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            {{ Form::checkbox('answerCbool', null, (isset($question) ? $question->answerCBool : null), ['data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="answerD">Antwort 4</label>
        {{ Form::text('answerD', null, ['id' => 'answerD', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#previewBox" data-preview="answerD">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            {{ Form::checkbox('answerDbool', null, (isset($question) ? $question->answerDBool : null), ['data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="countdown">Countdown</label>
        {{ Form::number('countdown', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="panel-footer">
    {{ Form::submit($submitLabel, ['class'=>'btn btn-primary']) }}
</div>

<!-- Preview for questions and answers -->

<div class="modal fade" id="previewBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Vorschau</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {

        $(".preview").click(function(){
            var id = $(this).data('preview');
            var text = $("#" + id).val();
            $(".modal-body").text(text);

            window.setTimeout(function () {
                MathJax.Hub.Typeset();
            }, 1000);
        });
    });
</script>