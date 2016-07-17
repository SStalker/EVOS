<div class="form-group">
    <label for="title">Name des Quiz</label>
    {{ Form::text('title', null, ['id' => 'titleInput', 'class' => 'form-control', 'placeholder' => 'z. B. Aufgabenteil 1, Extra-Fragen, Klausur-Teil']) }}
</div>

<div class="pull-right">{{ Form::submit($submitLabel, ['class'=>'btn btn-primary']) }}</div>

<script>
    $(document).ready(function () {
        $("#titleInput").focus();
    })
</script>