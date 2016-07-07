@extends('layouts.app')

@section('title', 'Kategorie verschieben')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Kategorien verschieben
        </div>

        <div class="panel-body">
            <div class="form-group">
                <p>Hier können Sie Ihre Kategorien per Drag 'n Drop entsprechend anpassen</p>
                <div id="CategoryTree">
                    {!! $recursiveCategories !!}
                </div>
                <div id="debug"></div>
            </div>
        </div>
    </div>

    <script>
        $('document').ready(function(){

            // After a drag 'n drop stopped
            $(document).bind("dnd_stop.vakata", function(e, data) {

                var ref = $('#CategoryTree').jstree(true);

                // Required because if node is dragged into another then is the li_attr variable not accessible until parent node opens
                // I can't get >>open_node<< to function only on parent. Instead i'll open all nodes again.
                ref.open_all();

                var droppedNode = ref.get_node(data.element);
                var droppedNodeParent = ref.get_node(droppedNode.parent);

                //console.log("Ausgewähltes Node: " + droppedNode.li_attr.category_id);

                if (typeof droppedNodeParent !== "undefined" && typeof droppedNodeParent.li_attr !== "undefined") {

                    //console.log("Hat auch ElternNode: " + droppedNodeParent.li_attr.category_id);
                    changeCategoryOrder(droppedNode.li_attr.category_id, droppedNodeParent.li_attr.category_id);
                }else{
                    //console.log("Hat keine Eltern Node aktuell");
                    changeCategoryOrder(droppedNode.li_attr.category_id, 0);
                }

            });

            // After the jstree was loaded it opens all nodes
            $('#CategoryTree').bind("loaded.jstree", function (e, data) {
               data.instance.open_all();
            });

            $('#CategoryTree').jstree({
                "core" : { "check_callback" : true }, // so that operations work
                "plugins" : ["dnd", "wholerow", "changed"]
            });
        });

        function changeCategoryOrder(currentID, parentID){
            //console.log(currentID + " : " + parentID);

            $.ajaxSetup({
                headers: { 'X-CSRF-Token' : '{!! csrf_token() !!}' }
            });

            $.ajax({
                method: "POST",
                url: "{{Request::url()}}",
                data: { 'currentID' : currentID, 'parentID': parentID }
            })
            .done(function( msg ) {

            });
        }
    </script>

@endsection