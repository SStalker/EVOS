<div class="panel-body">
    <div class="form-group">
        <label for="question">Frage</label>
        {!! Form::textarea('question', null, ['class' => 'form-control', 'rows' => 3]) !!} <br>
        <a class="btn btn-primary preview1" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#test">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
    </div>
    <div class="form-group">
        <label for="answerA">Antwort 1</label>
        {!! Form::text('answerA', null, ['class' => 'form-control']) !!}<br>
        <a class="btn btn-primary preview2" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#test">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            <input data-toggle="toggle" data-on="richtig" data-off="falsch" data-position="right" type="checkbox">
        </div>
    </div>
    <div class="form-group">
        <label for="answerB">Antwort 2</label>
        {!! Form::text('answerB', null, ['class' => 'form-control']) !!}<br>
        <a class="btn btn-primary preview3" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#test">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            <input checked data-toggle="toggle" data-on="richtig" data-off="falsch" data-position="right" type="checkbox">
        </div>
    </div>
    <div class="form-group">
        <label for="answerC">Antwort 3</label>
        {!! Form::text('answerC', null, ['class' => 'form-control']) !!}<br>
        <a class="btn btn-primary preview4" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#test">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            <input checked data-toggle="toggle" data-on="richtig" data-off="falsch" data-position="right" type="checkbox">
        </div>
    </div>
    <div class="form-group">
        <label for="answerD">Antwort 4</label>
        {!! Form::text('answerD', null, ['class' => 'form-control']) !!}<br>
        <a class="btn btn-primary preview5" style="margin-top: -7px;" href="" data-toggle="modal" data-target="#test">Vorschau</a>
        <label class="btn btn-default" for="file-selector" style="margin-top:-7px">
            <input id="file-selector" type="file" style="display:none;">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            <input checked data-toggle="toggle" data-on="richtig" data-off="falsch" data-position="right" type="checkbox">
        </div>
    </div>
    <div class="form-group">
        <label for="countdown">Countdown</label>
        {!! Form::number('countdown', null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="panel-footer">
    {!! Form::submit($submitLabel, ['class'=>'btn btn-primary']) !!}
</div>

<!-- Preview for questions and answeres -->

<div class="modal fade" id="test" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Vorschau</h4>
            </div>
            <div class="modal-body">
                blubb ...
            </div>
        </div>
    </div>
</div>

<script>
    // Total doof. Unbedingt überarbeiten.
    $( document ).ready(function() {
        $(".preview1").click(function(){
            var text = $(".question").val();
            $(".modal-body").append();
        });
    });
</script>