
var ElementoForm=function(){
	this.nome="";
	this.tipo="";
	this.value="";
	this.obbligatorio=true;
	this.dipendeDa="";
	this.valDip="";
	this.nomePost="";
	this.nomeDB="";
	//file
	this.fileMaxSize="";
	this.fileTipiAmmissibili="";
	this.fileMaxNumber="";
	this.fileMinNumber=1;
	this.file="";
	//testo
	this.txtMaxSize="";
	this.txtMinSize="";
	this.txtMatchRegExp="";	//espressione regolare (deve essere in questa forma)
	this.txtBadRegExp="";	//espressione regolare (non deve contenere questi caratteri)
	//data
	this.dataAntecedente="";
	this.dataPostcedente="";

};

$(document).ready(function(){
	//apertura menu appartenente all'utilities
	var pathname = window.location.pathname;
	var res = pathname.split("/");
	if(res[3] !== undefined && res[2]=="utilities")
		$('#menu_left a[href*="'+res[3]+'"]').parent().parent().slideToggle();
	// end
	//smooth scroll
	$(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
     //end
	$("#annullaImg").click(function(){
		var nImg=parseInt($('#valNumImg').val());
		var id=$('#idChangeImg').val();
		$('#'+id+'imgF'+nImg).replaceWith("<input type='file' value='' id='"+id+"imgF"+nImg+"' name='"+id+"imgF"+nImg+"' class='img_input'>");
		
		$(".imgareaselect-selection").parent().fadeOut(); 	
		$(".imgareaselect-handle").fadeOut(); 	
		$(".imgareaselect-outer").fadeOut();
		$("#popUpImg").fadeOut();
		
	});
	$(document).on("click", "#popUpImgCont",function(event){
		//$("#popUpImgCont").remove();
		 event.stopPropagation();
	});
	
function isset ( strVariableName ) { 

    try { 
        eval( strVariableName );
    } catch( err ) { 
        if ( err instanceof ReferenceError ) 
           return false;
    }

    return true;

 } 	
 	if(!(typeof larghezza == 'undefined' || altezza == null)){
	$('img#uploadPreview').imgAreaSelect({ 
	
		aspectRatio: larghezza+':'+altezza, 
		onSelectChange: preview,
		handles: true,
		parent:"#popUpImgCont"
	});
	}
	/*$("#annullaImg").click(function(){
		var nImg=parseInt($('#valNumImg').val());
		var id=$('#idChangeImg').val();
		$('#'+id+'imgF'+nImg).replaceWith("<input type='file' value='' id='"+id+"imgF"+nImg+"' name='"+id+"imgF"+nImg+"' class='img_input'>");
	
		});
*/
	$("#insImg").click(function(){
		var nImg=parseInt($('#valNumImg').val());
		var id=$('#idChangeImg').val();
		var modificato=false;
		
		$('#'+id+'dimensioneImg'+nImg).val($('#uploadPreview').width()+";"+$('#uploadPreview').height());
		if($('#'+id+'img'+nImg).css('display')!="none") modificato=true;
		$('#'+id+'img'+nImg).attr('src',$('#preview img').attr('src')).fadeIn();
		$('#'+id+'img'+nImg).css({
			width: $('#preview img').width()/3,
			height: $('#preview img').height()/3,
			marginLeft: parseInt($('#preview img').css("margin-left"))/3,
			marginTop: parseInt($('#preview img').css("margin-top"))/3
		});
		$("#"+id+"contenitoreImg"+nImg).css({
			width:$('#preview').width()/3,
			height:$('#preview').height()/3
		});
		$(".imgareaselect-selection").parent().fadeOut(); 	
		$(".imgareaselect-handle").fadeOut(); 	
		$(".imgareaselect-outer").fadeOut();
		$("#popUpImg").fadeOut();
		
		//$("#tr_img"+nImg).fadeIn();
		$(id+nImg).fadeIn();
		$("#"+id+"hidden_img"+nImg).val($('#x').val()+";"+$('#y').val()+";"+$('#w').val()+";"+$('#h').val());
		if(!modificato) $("#"+id+"numaggImg").text(parseInt($("#"+id+"numaggImg").text())+1);
		if($("#"+id+"updateImgH"+numImg).val()==""){
		   $("#"+id+"updateImgH"+numImg).val("1")
			numImg++;
			
		}

	});
});

function preview(img, selection) {
	if (!selection.width || !selection.height)
		return;
	var scaleX = $("#preview").width()/ selection.width;
	var scaleY = $("#preview").height() / selection.height;
	$('#preview img').css({
		width: Math.round(scaleX * $("#uploadPreview").width()),
		height: Math.round(scaleY * $("#uploadPreview").height()),
		marginLeft: -Math.round(scaleX * selection.x1),
		marginTop: -Math.round(scaleY * selection.y1)
	});
	$('#x').val(selection.x1);
	$('#y').val(selection.y1);
	$('#w').val(selection.width);
	$('#h').val(selection.height);

	

} 
function getImg(id){
	var ret="";
	var stringa="";
	num=parseInt($("#"+id+"numaggImg").text());
	if(update)num--;
	for(i=0;i<num;i++){
		if($("#"+id+"imgF"+i).val()!="")
			ret+=$("#"+id+"imgF"+i).val()+";";

	}
	if($("#tr_img"+i).css("display")=="none")
		$("#tr_img"+i).remove();
	/*
    $( ".img_input" ).each(function( index ) {
		ret+=$(this).val()+";";
	});*/
	return ((ret==";")?"":ret);
}
function getElemImg(id){
	var ret="";
	num=parseInt($("#"+id+"numaggImg").text());
	if(update)num--;
   for(i=0;i<num;i++){
		ret+=id+"imgF"+i+";";
	}
	return ((ret==";")?"":ret);
}
function getFile(id){
    //cicla sui file e restituisce una stringa
    var ret="";
	var stringa="";
	num=parseInt($("#"+id+"numaggFile").text());
	for(i=0;i<num;i++){
		if($("#"+id+"fileF"+i).val()!="")
		ret+=$("#"+id+"fileF"+i).val()+";";
	}
	return ((ret==";")?"":ret);
}
function getElemFile(id){
	var ret="";
	num=parseInt($("#"+id+"numaggFile").text());
	if(update)num--;
   for(i=0;i<num;i++){
		ret+=id+"fileF"+i+";";
	}
	return ((ret==";")?"":ret);
}
function caricaImg(id,nimg,idP,lg,al){
	 	if (lg === undefined) lg="";
	 	if (al === undefined) al="";
		altezzaCopy=altezza;
		larghezzaCopy=larghezza;
		$("#valNumImg").val(nimg);
		$("#idChangeImg").val(idP);
	    var oFReader = new FileReader();
	    var oggettoCaricato=document.getElementById(id).files[0];
    	var tipo=oggettoCaricato.type.split("/");
    	var width=0;
    	var height=0;
    	if(al!="" && lg!=""){
    		altezzaCopy=al;
    		larghezzaCopy=lg;
    		
    	}
    	if($('#dimensionia'+idP+nimg).length==0)$("#formDati").append("<input type='hidden' id='dimensionia"+idP+nimg+"' name='dimensionia"+idP+nimg+"' value='"+larghezzaCopy+";"+altezzaCopy+"'/>");
		else $('#dimensionia'+idP+nimg).val(""+larghezzaCopy+";"+altezzaCopy+"");
    	$('img#uploadPreview').imgAreaSelect({ 
			aspectRatio: larghezzaCopy+':'+altezzaCopy, 
			onSelectChange: preview,
			handles: true,
			parent:"#popUpImgCont"
		});
    	if(tipo[0]=="image"){
			var p = $('#uploadPreview');
			$(window).scrollTop(0);
			$("#popUpImg").fadeIn();
			$('#divImgPre').fadeIn();
		    p.fadeOut();
		    $('#preview').fadeOut();
		    oFReader.readAsDataURL(oggettoCaricato);
		    oFReader.onload = function (oFREvent) {
		       	p.attr('src', oFREvent.target.result).fadeIn();
		       	$(p).load(function(){
		       		width=$("#uploadPreview").css("max-width");
		       		height=$("#uploadPreview").css("max-height");
		       		width=parseInt(width);
		       		height=parseInt(height);
	       			$('#preview').fadeIn();
			       	$('#preview img').attr('src',oFREvent.target.result).fadeIn();
			       	if(altezzaCopy>larghezzaCopy){
				   		$("#preview").css("height",height/1.5);
				       	$("#preview img").css("height",height/1.5);
				   		var larg_rel=(larghezzaCopy/altezzaCopy)*height/1.5;
				   		$("#preview").css("width",larg_rel);
				       	$("#preview img").css("width",larg_rel);
			       	}else{
				   		$("#preview").css("width",width);//era heigth
				       	$("#preview img").css("width",width);
				   		var alt_rel=(width)/(larghezzaCopy/altezzaCopy);
				   		$("#preview").css("height",alt_rel);//era width
				       	//$("#preview img").css("width",width/2);
				       	$("#preview img").css("height",alt_rel);
			       	}
			       	$("#preview img").css("margin-left","0px");
			       	$("#preview img").css("margin-top","0px");
		       	});
		       

	    	};
		}else{
	    	alert("Il file caricato non è un'immagine");
	    }
	
}
function eliminaFiles(nomeDB,template,campoF, id,tipo){
	//alert("nomeDB:"+nomeDB+"template:"+template+"campo:"+campoF+"id:"+id);
	var risp = confirm("Stai definitivamente eliminando questo file. Vuoi continuare?")
    if(risp){
		 $.ajax({
	        type:"post",
	        url : '../../includes/eliminaFile.php',
	        //"path="+campoF+"&nomeDB="+nomeDB+"&template="+template+"&tipo="+tipo+"&id="+id+""
	        data: { path: campoF,nomeDB:nomeDB,template:template,tipo:tipo,id:id} ,
	        success: function (data) {
	            alert(data);
	            //location.href = "index.php";
	           window.location.reload();
	        }
	    });
	}
}
function aggImg(id,lg,al){
	if (lg === undefined) lg="";
	if (al === undefined) al="";
	num=parseInt($("#"+id+"numaggImg").text());
	var prova=id;
	if(!(typeof $("#"+id+"imgF"+num).val() == 'undefined' || $("#"+id+"imgF"+num).val() == null)){
		if($("#"+id+"imgF"+num).val()==""){
			$("#"+id+"imgF"+num).click();
			return;
		}
		else num=num+1;
	}
	for(var i=0;i<array2.length;i++){
		if(array2[i].nomeDB==id)break;
	}
	if(parseInt(num)<array2[i].fileMaxNumber){
		//num=parseInt(num+1);
		$("#td_"+id).append(""+
            "<div id='"+id+"contenitoreImg"+num+"' style='overflow: hidden;'>"+
        	"	 <img style='display:none;' class='imgP' id='"+id+"img"+num+"' src=''>"+
    		"</div>"+
    		"<input type='hidden' id='"+id+"hidden_img"+num+"' name='"+id+"hidden_img"+num+"'/>"+
    		"<input type='hidden' name='"+id+"dimensioneImg"+num+"' id='"+id+"dimensioneImg"+num+"' value=''/>"+
    		"<input type='file' class='img_input' name='"+id+"imgF"+num+"' id='"+id+"imgF"+num+"' value=''/>"+
    		"<script> $('#"+id+"imgF"+num+"').click(); $(document).on('change','#"+id+"imgF"+num+"',function(event){caricaImg('"+id+"imgF"+num+"','"+num+"','"+id+"','"+lg+"','"+al+"');});</script>"
	    );
		//$("#"+id+"numaggImg").text(num);
	}else{
		alert("Puoi inserire fino ad un massimo di "+array2[i].fileMaxNumber+" immagine/i");
	}
	
	
}

function aggFile(id){
	num=parseInt($("#"+id+"numaggFile").text());
	var prova=id;
	if(!(typeof $("#"+id+"fileF"+num).val() == 'undefined' || $("#"+id+"fileF"+num).val() == null)){
		if($("#"+id+"fileF"+num).val()==""){
			$("#"+id+"fileF"+num).click();
			return;
		}
		else num=num+1;
	}
	for(var i=0;i<array2.length;i++){
		if(array2[i].nomeDB==id)break;
	}
	if(parseInt(num)<array2[i].fileMaxNumber){
		//num=parseInt(num+1);
		$("#td_"+id).append(""+
            "<a target='blanck' style='display:none;' id='"+id+"fileA"+num+"' href='../../../files/'><img class='fileP' title='' src='../../img/file.png'></a>"+
			"<input type='file' class='file_input' name='"+id+"fileF"+num+"' id='"+id+"fileF"+num+"' value=''/></td>"+
		    "<script>$('#"+id+"fileF"+num+"').click(); $('#"+id+"fileF"+num+"').change(function(){caricaFile('"+id+"fileF"+num+"','"+num+"','"+id+"');});</script>"
	    );
		//$("#"+id+"numaggImg").text(num);
	}else{
		alert("Puoi inserire fino ad un massimo di "+array2[i].fileMaxNumber+" immagine/i");
	}
	/*
	if(numFile<=img.fileMaxNumber){
		$("#tr_file"+numFile).remove();
		$("#tbUtilis").append(""+
			"<tr style='display:none' id='tr_file"+numFile+"'>"+
	            "<td>File</td>"+
	            "<td>"+
	            "<a target='blanck' id='fileA"+numFile+"' href=''><img class='fileP' title='' src='../../img/file.png'></a>"+
	        	"<input type='file' class='file_input' name='fileF"+numFile+"' id='fileF"+numFile+"' value=''/></td>"+
	            "<td style='width:300px'>Inserisci qui il file</td>"+
	        "</tr>"+
	        "<script>$('#fileF"+numFile+"').click();$('#fileF"+numFile+"').change(function(){caricaFile('"+numFile+"',this);});</script>"
			);
		//$(document).on("click",)
	}else{
		alert("Puoi inserire fino ad un massimo di "+file.fileMaxNumber+" files");
	}
	*/
}
function caricaFile(id,nimg,idP){

	//$("#tr_file"+numFile).fadeIn();
	var modificato=false;
	if($('#'+idP+'fileA'+nimg).css('display')!="none") modificato=true;
	if(!modificato)
		$("#"+idP+"numaggFile").text(parseInt($("#"+idP+"numaggFile").text())+1);
	//$(id).attr("value","update");
	var oggettoCaricato=document.getElementById(id).files[0];
	var reader = new FileReader();
	reader.readAsDataURL(oggettoCaricato);
    reader.onloadend = function(evt) {
    	$('#'+idP+'fileA'+nimg).attr('href', evt.target.result).fadeIn();
    }
}
function controllaFormNew(v){
	var idCanc=[];
	for(i=0;i<v.length;i++){
		if(!v[i].obbligatorio||v[i].value!=""||(update&&(v[i].nomePost=="imgF"||v[i].nomePost=="fileF"))){
			if(v[i].value!=""){
				if(v[i].txtMinSize != "" && v[i].value.length < v[i].txtMinSize){
					alert("il Campo "+v[i].nome+" deve contenere almeno "+v[i].txtMinSize+" caratteri");
					return false;
				}
				if(v[i].txtMaxSize!=""&&v[i].value.length>v[i].txtMaxSize){
					alert("il Campo "+v[i].nome+" non può contenere più di "+v[i].txtMaxSize+" caratteri");
					return false;
				}
				if(v[i].txtMatchRegExp!=""&&!(v[i].value.match(v[i].txtMatchRegExp))){
					alert("il Campo "+v[i].nome+" non è nella forma indicata");
					return false;
				}
				if(v[i].txtBadRegExp!=""&&(v[i].value.match(v[i].txtBadRegExp))){
					alert("il Campo "+v[i].nome+" non può contenere caratteri questi caratteri "+v[i].txtBadRegExp);
					return false;
				}
				if(v[i].file!=""){
					var copyFile=v[i].file;
					var copyValue=v[i].value;
					var af = copyFile.split(';');
					var afname = copyValue.split(';');
					if((afname.length-1)<v[i].fileMinNumber){
						alert("Devi inserire almeno "+v[i].fileMinNumber+" "+v[i].nome);
						return false;
					}
					else{
						for(var j=0;j<af.length-1;j++){
							 if(update && (typeof document.getElementById(af[j]).files[0] == 'undefined' || document.getElementById(af[j]).files[0] == null)) 
							 	continue;
							 if(!update && (typeof document.getElementById(af[j]).files[0] == 'undefined' || document.getElementById(af[j]).files[0] == null)){
							 	idCanc.push(af[j]);
							 	continue;
							 }
							 if(v[i].fileMaxSize!="" && document.getElementById(af[j]).files[0].size > v[i].fileMaxSize){
							 	alert("il File "+afname[j]+" supera la dimensione fissata di: "+v[i].fileMaxSize);
								return false;
							 }
							 if(v[i].fileTipiAmmissibili!=""){
							 	var copyTipi=v[i].fileTipiAmmissibili;
							 	var stringIf="";
							 	var aT=copyTipi.split(";");
							 	var err=true;
							 	for(var z=0;z<aT.length;z++){
							 		if(document.getElementById(af[j]).files[0].type==aT[z])err=false;	
							 	}
							 	if(err){
							 		alert(document.getElementById(af[j]).files[0].type+"il File "+afname[j]+" non è in uno di questi formati "+v[i].fileTipiAmmissibili);
							 		return false;
							 	}
								
							 }
						}
						
					}
				}
			}
			else{
				if(v[i].dipendeDa!="" && v[parseInt(v[i].dipendeDa)].value!="" && (v[i].valDip=="pieno"||v[i].valDip==v[v[i].dipendeDa].value)){
					if(!update){
						alert("Per questa situazione il Campo "+v[i].nome+" è obbligatorio");
						return false;
					}
				}
			}

		}
		else {
			alert("il Campo "+v[i].nome+" è obbligatorio");
			return false;
		}
	}
	//$("#hidden_json").val(JSON.stringify(v));
	for(var h=0;h<idCanc.length;h++){
		$("#"+idCanc).remove();
	}
	//$("#formDati").append("<input type='hidden' name='dimensioni' value='"+larghezza+";"+altezza+"'/>");
    $("#formDati").submit();
}