var ordina;
var language_link =  new Array();
$(document).ready(function(){
    $("#elimina").click(function(){
        var delV=[];
        $("input:checkbox:checked").each(function(){
           delV.push($(this).val());
        });
        var risp = confirm("Stai definitivamente eliminando questo/i campo/i. Vuoi continuare?")
        if(risp){
            $.ajax({
                type:"post",
                url : 'cancella/cancella.php',
                dataType: 'json',
                data : 'delete='+delV+'&template='+template,
                success: function (data) {
                    alert(data.errore);
                      location.reload();
                }
            });
        }
    });
    $("#input_cerca").keyup(function(e){
        $.ajax({
            type:"post",
            url : 'salva/search.php',
            dataType: 'json',
            data : 'eDb='+$("#searchE").val()+'&search='+$("#input_cerca").val(),
            complete: function (data) {
                //alert(data);
               $("tbody").html(data.responseText);
            }
        });
    });
    if(cambiaOrdine){
        $("#sOrdina").click(function(){
            if(ordina!=""){
                $.ajax({
                    type:"post",
                    url : 'salva/cambia_ordine.php',
                    dataType: 'html',
                    data : ordina,
                    success: function (data) {
                        alert(data);
                          location.reload();
                    }
                });
            }
        });
        var fixHelper = function(e, ui) {
            ui.children().each(function() {
                $(this).width($(this).width());
            });
            return ui;
        };
        $("#sort tbody").sortable({
            helper: fixHelper,
            update:function(){
                ordina =  $("#sort tbody").sortable('serialize');
            }
        }).disableSelection();
    }
});