<div class="panel-body">
    <div class="form-group">
        <label for="question">Frage</label>
        {{ Form::textarea('question', null, ['id' => 'questionInput', 'class' => 'form-control', 'rows' => 3]) }} <br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="questionInput">Vorschau</a>
        <label class="btn btn-default" for="file-selector-question" style="margin-top:-7px">
            <input id="file-selector-question" name="file-selector-question" type="file" class="image-selector"
                   style="display:none;" data-target="question">
            Bild anhängen
        </label>
    </div>
    <div class="form-group">
        <label for="answerA">Antwort 1</label>
        {{ Form::text('answerA', null, ['id' => 'answerA', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="answerA">Vorschau</a>
        <label class="btn btn-default" for="file-selector-answer-a" style="margin-top:-7px">
            <input id="file-selector-answer-a" type="file" class="image-selector" style="display:none;"
                   data-target="answerA">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            {{ Form::checkbox('answerAbool', null, (isset($question) ? $question->answerABool : null), ['data-id'=>'answerA', 'data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="answerB">Antwort 2</label>
        {{ Form::text('answerB', null, ['id' => 'answerB','class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="answerB">Vorschau</a>
        <label class="btn btn-default" for="file-selector-answer-b" style="margin-top:-7px">
            <input id="file-selector-answer-b" type="file" class="image-selector" style="display:none;"
                   data-target="answerB">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            {{ Form::checkbox('answerBbool', null, (isset($question) ? $question->answerBBool : null), ['data-id'=>'answerB', 'data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="answerC">Antwort 3</label>
        {{ Form::text('answerC', null, ['id' => 'answerC', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="answerC">Vorschau</a>
        <label class="btn btn-default" for="file-selector-answer-c" style="margin-top:-7px">
            <input id="file-selector-answer-c" type="file" class="image-selector" style="display:none;"
                   data-target="answerC">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            {{ Form::checkbox('answerCbool', null, (isset($question) ? $question->answerCBool : null), ['data-id'=>'answerC', 'data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="answerD">Antwort 4</label>
        {{ Form::text('answerD', null, ['id' => 'answerD', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="answerD">Vorschau</a>
        <label class="btn btn-default" for="file-selector-answer-d" style="margin-top:-7px">
            <input id="file-selector-answer-d" type="file" class="image-selector" style="display:none;"
                   data-target="answerD">
            Bild anhängen
        </label>
        <div class="pull-right" style="margin-top:-7px;">
            {{ Form::checkbox('answerDbool', null, (isset($question) ? $question->answerDBool : null), ['data-id'=>'answerD', 'data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group">
        <label for="countdown">Countdown</label>
        {{ Form::number('countdown', null, ['class' => 'form-control']) }}
    </div>
</div>

<div class="panel-footer">
    {{ Form::submit($submitLabel, ['data-toggle'=>'tooltip', 'id'=>'formSubmit','class'=>'btn btn-primary', 'disabled']) }}
</div>

<!-- Preview for questions and answers -->

<div class="modal fade" id="previewBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Vorschau</h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    //check if submit can be enabled
    function enableSubmit() {

        //get references
        var answerA = $("#answerA").val();
        var answerB = $("#answerB").val();

        var isToggled = false;

        //Check if any answer is toggled right
        $.each($('.toggle.btn input[type=checkbox]'), function () {

            //If checkbox is checked
            if ($(this).prop('checked')) {
                //Get id of answer for this checkbox
                var answer = $(this).attr('data-id');

                //If answer of checkbox is not empty
                if ($('#' + answer).val() !== "") {
                    isToggled = true;
                }

            }
        });

        //Enable or disable the button
        if (answerA != "" && answerB != "" && isToggled) {
            document.getElementById("formSubmit").disabled = false;
            // delete tooltip
            $('#formSubmit').attr('title', '');
        } else {
            document.getElementById("formSubmit").disabled = true;
            // set tooltip
            $('#formSubmit').attr('title', 'Nicht genügend Eingabedaten vorhanden.');
        }
    }

    $(document).ready(function () {

        $("#questionInput").focus();

        $('[data-toggle="tooltip"]').tooltip();

        //Check if submit button should be enabled
        enableSubmit();

        //Check enableSubmit each time an input is done and every end every check of right answer
        $("input[id^='answer']").on('keyup', enableSubmit);
        $('.toggle.btn input[type=checkbox]').on('change', enableSubmit);

        $(".preview").click(function () {
            var id = $(this).data('preview');
            var text = $("#" + id).val();
            console.log(text);

            var images = text.match(/\[image\((\d+\.[A-Za-z]{1,4})\)\]/g);
            images.forEach(function (image) {
                var matches = image.match(/.*\((\d+\.[A-Za-z]{1,4})\).*/);
                var html = '<img src="{{ asset('storage/uploads/') }}/' + matches[1] + '">';
                text = text.replace(matches[0], html);
            });
            $(".modal-body").html(text);

            window.setTimeout(function () {
                MathJax.Hub.Typeset();
            }, 1000);
        });

        $('.image-selector').on('change', function () {
            if ($(this).hasClass('disabled')) {
                return;
            }

            $(this).parent().addClass('disabled');
            var fd = new FormData();
            fd.append('image', $(this)[0].files[0]);

            var that = this;
            $.ajax({
                url: '{{ action('ImageController@store') }}',
                data: fd,
                processData: false,
                contentType: false,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (filename) {
                    console.log('#' + $(that).data('target'));
                    var imageCode = '[image(' + filename + ')]';
                    $('[name=' + $(that).data('target') + ']').val($('[name=' + $(that).data('target') + ']').val() + imageCode);
                    $(that).parent().removeClass('disabled');
                },
                fail: function () {
                    alert('Bild konnte nicht hochgeladen werden. Bitte an einen Administrator wenden!');
                    $(that).parent().removeClass('disabled');
                }
            });
        });
    });
</script>
