<div class="panel-body">
    <div class="form-group">
        <label for="title">Titel</label>
        {{ Form::text('title', null, ['id' => 'titleInput', 'class' => 'form-control', 'placeholder' => 'z. B. KBSE, Mathe3, SWE-Projekt']) }}
    </div>
    {{ Form::hidden('parent_id', $parent_id) }}
</div>

<div class="panel-footer">
    {{ Form::submit($submitLabel, ['class'=>'btn btn-primary']) }}
</div>

<script>
    $(document).ready(function(){
        $("#titleInput").focus();
    })
</script>