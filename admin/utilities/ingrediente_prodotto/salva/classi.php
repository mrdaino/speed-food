<?php
/*class ElementoForm {
 	public $nome="";
	public $tipo="";
	public $value="";
	public $obbligatorio=true;
	public $nomePost="";
	public $nomeDB="";
	public $dipendeDa="";
	public $valDip="";
	//file
	public $fileMaxSize="";
	public $fileTipiAmmissibili="";
	public $fileMaxNumber="";
	public $fileMinNumber=1;
	public $file="";
	public $percorsoFile="";
	//testo
	public $txtMaxSize="";
	public $txtMinSize="";
	public $txtMatchRegExp="";	//espressione regolare (deve essere in questa forma)
	public $txtBadRegExp="";	//espressione regolare (non deve contenere questi caratteri)
	//data
	public $dataAntecedente="";
	public $dataPostcedente=""; 
}
*/
$template="ingrediente_prodotto";
	$cambiaOrdine=true;
$idAssociazione="id_prodotto";
$orderBy="order by ordine";
$templateView="Ingredienti di";
$templateViewAssoc['table']="prodotti";
$templateViewAssoc['table-element']="nome";
$templateViewAssoc['link']="javascript:history.back()";
/*
$idAssociazione="id_colori";
$templateView="immagini";
$templateViewAssoc['table']="doro_colori";
$templateViewAssoc['table-element']="colore";
$templateViewAssoc['link']="javascript:history.back()";
se nn sono settate il cms prederà come id il valore id e per order by ""
$idUtils="pro_id";
$orderBy="order by pro_startdate desc";
$aV = array("index","zelig_cabaret","zelig_tv","lab_provini","aziende","video","foto","contatti");
$aD = array("Home","Zelig Cabaret","Zelig Tv","Lab e Provini","Aziende","Video","Foto","Contatti");
*/

function creaElementiDettaglio(){
    $ret="";
	global $conn_id;
	$sql="SELECT * FROM ingredienti WHERE id_users = ".$_SESSION["user"]["id"];
	$result = mysqli_query($conn_id,$sql);
	$aV=array();
	$aD=array();
	while($ingrediente= mysqli_fetch_array($result)){

		$aV[] = $ingrediente["id"];
		$aD[] = $ingrediente["nome"];
	}
	$ret.=creaElementi("select","id_ingrediente","Ingrediente","","",$aV,$aD);

    //$ret.=creaElementi("text","video","Video","(obbligatorio)","");


    //creaElementi("textarea","sub_title","Descrizione","(obbligatorio)","");
    /*creaElementi("color","colore","Colore Sfondo Titolo ","(obbligatorio)","");
    creaElementi("color","colore_html","Colore Sfondo Mostra ","(obbligatorio)","");
    creaElementi("imgFisso","logo","Logo progetto ","(obbligatorio)","1","500","281");
    creaElementi("imgFisso","img","Anteprima progetto ","(obbligatorio)","1");
    $aV = array("0","1");
    $aD = array("Html","Testo/Img");
    creaElementi("select","tipo_inserimento","Tipo inserimento Progetto ","(obbligatorio)","",$aV,$aD);
    creaElementi("textarea2","mostraHtml","Html progetto ","(opzionale)","");
    creaElementi("imgFisso","galleria","Immagini progetto ","(opzionali)","0","800","500");
    */
    return $ret;
}
$ingrediente= new ElementoForm();
$id_prodotto= new ElementoForm();

$ingrediente->nome="Ingrediente ";
$ingrediente->nomePost="id_ingrediente";
$ingrediente->nomeDB="id_ingrediente";
$ingrediente->tipo="select_gabri";
$ingrediente->ext_tab="ingredienti";
$ingrediente->ext_field="nome";

$id_prodotto->nome="Prodotto";
$id_prodotto->nomePost="id_prodotto";
$id_prodotto->nomeDB="id_prodotto";
$id_prodotto->tipo="txt";

/*
$img->nome="Anteprima Progetto";
$img->nomeDB="img";
$img->nomePost=$img->nomeDB."imgF";
$img->fileTipiAmmissibili="png;jpg;jpeg;";
$img->fileMaxNumber=3;
$img->obbligatorio=true;
$img->fileMaxSize=5000000; 
$img->percorsoFile="foto";
$img->tipo="img";
*/

//settare arrIndex con i campi che si vogliono far visualizare nella index altrimenti verranno visualizzati tutti i campi di array
/*
$arrIndex[]=$testo;
$arrIndex[]=$img;
$arrIndex[]=$file;
*/
$arrIndex[]=$ingrediente;

$array[]=$ingrediente;
$array[]=$id_prodotto;
/*$array[]=$colore;
$array[]=$colore_html;
$array[]=$logo;
$array[]=$img;
$array[]=$tipoIns;
$array[]=$mostraHtml;
$array[]=$galleria;
*/

$arrjs=json_encode($array);


?>