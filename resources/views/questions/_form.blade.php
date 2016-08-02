<div class="form-group">
    <label for="title">Frage</label>
    {{ Form::text('title', null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    <label for="question">Details</label>
    {{ Form::textarea('question', null, ['id' => 'questionInput', 'class' => 'form-control', 'rows' => 8]) }} <br>
    <a class="btn btn-primary preview" style="margin-top: -7px;" href="" data-toggle="modal"
       data-target="#previewBox" data-preview="questionInput">Vorschau</a>
    <label class="btn btn-default" for="file-selector-question" style="margin-top:-7px">
        <input id="file-selector-question" name="file-selector-question" type="file" class="image-selector"
               style="display:none;" data-target="question">
        Bild anhängen
    </label>
    <a class="btn btn-default addcode" id="insert-source-code" style="margin-top: -7px;" href="#">Quellcode
        einfügen</a>
</div>

<div class="answers">
    <div class="btn-group btn-group-justified answer-switcher" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default active answer-switcher-button" data-id="1">1.
                Antwortmöglichkeit
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default answer-switcher-button" data-id="2">2. Antwortmöglichkeit
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default answer-switcher-button" data-id="3">3. Antwortmöglichkeit
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default answer-switcher-button" data-id="4">4. Antwortmöglichkeit
            </button>
        </div>
    </div>

    <div class="form-group" id="answer-box-1">
        {{ Form::text('answerA', null, ['id' => 'answerA', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="answerA">Vorschau</a>
        <div class="pull-right corrent-answer-box">
            {{ Form::checkbox('answerAbool', null, (isset($question) ? $question->answerABool : null), ['data-id'=>'answerA', 'data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group" id="answer-box-2">
        {{ Form::text('answerB', null, ['id' => 'answerB','class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="answerB">Vorschau</a>
        <div class="pull-right corrent-answer-box">
            {{ Form::checkbox('answerBbool', null, (isset($question) ? $question->answerBBool : null), ['data-id'=>'answerB', 'data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group" id="answer-box-3">
        {{ Form::text('answerC', null, ['id' => 'answerC', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="answerC">Vorschau</a>
        <div class="pull-right corrent-answer-box">
            {{ Form::checkbox('answerCbool', null, (isset($question) ? $question->answerCBool : null), ['data-id'=>'answerC', 'data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
    <div class="form-group" id="answer-box-4">
        {{ Form::text('answerD', null, ['id' => 'answerD', 'class' => 'form-control']) }}<br>
        <a class="btn btn-primary preview" href="" data-toggle="modal"
           data-target="#previewBox" data-preview="answerD">Vorschau</a>
        <div class="pull-right corrent-answer-box">
            {{ Form::checkbox('answerDbool', null, (isset($question) ? $question->answerDBool : null), ['data-id'=>'answerD', 'data-on' => 'richtig', 'data-off' => 'falsch', 'data-toggle' => 'toggle']) }}
        </div>
    </div>
</div>

<div class="form-group">
    <label for="countdown">Countdown</label>
    {{ Form::number('countdown', null, ['class' => 'form-control']) }}
</div>

<div class="pull-right">{{ Form::submit($submitLabel, ['data-toggle'=>'tooltip', 'id'=>'formSubmit','class'=>'btn btn-primary', 'disabled']) }}</div>

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

            var images = text.match(/\[image\((\d+\.[A-Za-z]{1,4})\)\]/g);
            if (images != null) {
                images.forEach(function (image) {
                    var matches = image.match(/.*\((\d+\.[A-Za-z]{1,4})\).*/);
                    var html = '<img src="{{ asset('storage/uploads/') }}/' + matches[1] + '">';
                    text = text.replace(matches[0], html);
                });
            }

            // for some reason matching over multiple lines doesn't work... So we'll go a different way solving this issue.
            text = text.replace(/\[code\]/g, '<pre><code>');
            text = text.replace(/\[\/code\]/g, '</code></pre>');

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

        $('#insert-source-code').on('click', function () {
            if ($('#questionInput').val().length > 0) {
                $('#questionInput').val($('#questionInput').val() + '\n');
            }
            $('#questionInput').val($('#questionInput').val() + '[code]\nFügen Sie ihren Quellcode hier ein!\n[/code]');
        });

        /*
         $('#insert-latex').on('click', function () {
         if ($('#questionInput').val().length > 0) {
         $('#questionInput').val($('#questionInput').val() + '\n');
         }
         $('#questionInput').val($('#questionInput').val() + '$ \\sin(x) $');
         });
         */

        $('.answer-switcher-button').on('click', function () {
            var boxId = $(this).data('id');
            var current = $('.answer-switcher > .btn-group > button.active');
            var currentId = current.data('id');

            current.removeClass('active');
            $(this).addClass('active');
            $('#answer-box-' + currentId).fadeOut(100, function () {
                $('#answer-box-' + boxId).fadeIn(100);
            });
        });
    });
</script>
