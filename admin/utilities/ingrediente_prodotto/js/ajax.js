//inizializzazione campi
var numImg=1;
var numFile=1;
var imgArr=[];

var img = new ElementoForm();
//var link= new ElementoForm();


/*link.nome="Link"; 
link.nomePost="link";
link.nomeDB="link"; 
link.tipo="txt";
link.obbligatorio=false;
*/
/*img.nome="Immagini";
img.nomePost="imgF";
img.nomeDB="img";
img.fileTipiAmmissibili="image/png;image/jpg;image/jpeg;";
img.fileMaxNumber=1;
img.fileMaxSize=2000000;
img.tipo="txt";
*/
if(arrayJs===undefined){
var arrayJs="";
}
else{
	//var aj=JSON.stringify(arrayJs);
	var aj=arrayJs;
	var array2=[];
	var array=[];
	for(var i=0;i<aj.length;i++){
		//alert(aj[i]);
        //var obj = JSON.parse(JSON.stringify(aj[i]));
       	//eval('var ' + obj.nomeDB + ' = '+JSON.parse(JSON.stringify(aj[i]))+';');
       	array2.push(JSON.parse(JSON.stringify(aj[i])));
       	//eval('var ' + obj.nomeDB + ' = '+JSON.parse(JSON.stringify(aj[i]))+';');
       	/*eval('var ' + obj.nomeDB +';');
       	alert(obj.nome);
       	eval(obj.nomeDB +'.nome="'+obj.nome+'"');
       	*/

       	//jQuery.extend(obj.nomeDB,obj);
		/*for (var key in obj) {
	    	var value = obj[key];
	    	// now you can use key as the key, value as the... you guessed right, value
		}
		*/
	
	}
	//alert(link.nome);
	//alert(JSON.stringify(arrayJs));
	//var contact = JSON.parse(jsontext);
}
//var array2=new Array(img,link);
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
    /*img.value=getImg(img.nomeDB);
    img.file=getElemImg(img.nomeDB);
    link.value=$("#"+link.nomePost).val();
    var array=new Array(img,link);
    */
    return controllaFormNew(array);
    /*("#formDati").submit();
    return true;
    */
}
var altezza=400;
var larghezza=800;

