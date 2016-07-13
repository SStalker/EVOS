<div id="quiz-delete-confirmation" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Quiz löschen</h4>
            </div>
            <div class="modal-body">
                <p>Soll das Quiz <i id="quiz-title"></i> wirklich gelöscht werden?</p>
            </div>
            <div class="modal-footer">
                <form method="POST" id="quiz-delete-form">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>
                    <input data-original-title="Löscht das Quiz." class="btn btn-danger" data-toggle="tooltip"
                           data-placement="left" title="Löscht das ausgewählte Quiz" value="Löschen" type="submit">
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->