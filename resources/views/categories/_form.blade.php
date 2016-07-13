<div class="form-group">
    <label for="title">Titel der Kategorie</label>
    {{ Form::text('title', null, ['id' => 'titleInput', 'class' => 'form-control', 'placeholder' => 'z. B. KBSE, Mathe3, SWE-Projekt']) }}
</div>
{{ Form::hidden('parent_id', $parent_id) }}


<div class="pull-right">
    {{ Form::submit($submitLabel, ['class'=>'btn btn-primary']) }}
</div>


<script>
    $(document).ready(function () {
        $("#titleInput").focus();
    })
</script>