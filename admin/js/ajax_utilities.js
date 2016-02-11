var numImg=1;
var numFile=1;
var imgArr=[];
var img = new ElementoForm();
if(arrayJs===undefined){
var arrayJs="";
}
else{
	var aj=arrayJs;
	var array2=[];
	var array=[];
	for(var i=0;i<aj.length;i++){
       	array2.push(JSON.parse(JSON.stringify(aj[i])));
       }
}
function clickSalva(){
	for(var i=0;i<array2.length;i++){
		if(array2[i].txtMatchRegExp!=""){
			re = new RegExp(array2[i].txtMatchRegExp);
			array2[i].txtMatchRegExp="^([1-9][0-9]*|0)(\.[0-9]{2})?$";
		}
		switch(array2[i].tipo){
			case "img":
				array2[i].nomePost="imgF";
				array2[i].fileTipiAmmissibili="image/png;image/jpg;image/jpeg;";
				array2[i].value=getImg(array2[i].nomeDB);
				array2[i].file=getElemImg(array2[i].nomeDB);
			break;
			case "file":
				array2[i].nomePost="fileF";
				array2[i].fileTipiAmmissibili="application/pdf;";
				array2[i].value=getFile(array2[i].nomeDB);
				array2[i].file=getElemFile(array2[i].nomeDB);
			break;
			case "textarea":
				var nome=array2[i].nomeDB;
				array2[i].value=CKEDITOR.instances[nome].getData();
			break;
			default:
				array2[i].value=$("#"+array2[i].nomePost).val();
			break;
		}
		array.push(array2[i]);
	}
    return controllaFormNew(array);
}
var altezza="";
var larghezza="";

