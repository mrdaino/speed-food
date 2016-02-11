// JavaScript Document
function controllaForm(){
	var idCampo="";
	//var LOCAL="/hidden/bananas2/admin";
	idCampo="id";
	if(($("#"+idCampo).val()).length<=1){
		alert("Inserisci lo username");
		$("#"+idCampo).focus();
		return;
	}
	
	idCampo="pwd";
	if(($("#"+idCampo).val()).length<=1){
		alert("Inserisci la password");
		$("#"+idCampo).focus();
		return;
	}

	$.ajax({
	type:"post",
    url : 'salva/salva.php',
	dataType: 'json',
    data : $("#formDati").serialize(),   
    success: function (data) {
		if(data.errore==100){
			location.href = LOCAL;
		}else{
			alert(data.errore);
		}
    }
});
	
}
$(document).ready(function(){
    $("#pwd").keypress(function(e){
        if (e.keyCode == 13) {
            controllaForm();
        }
    });
});