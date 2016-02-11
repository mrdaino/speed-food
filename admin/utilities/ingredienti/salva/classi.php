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
$template="ingredienti";
$templateView="Ingredienti";
$cambiaOrdine=false;
$orderBy=" WHERE id_users=".$_SESSION["user"]["id"];
/*
se nn sono settate il cms prederà come id il valore id e per order by ""
$idUtils="pro_id";
$orderBy="order by pro_startdate desc";
$aV = array("index","zelig_cabaret","zelig_tv","lab_provini","aziende","video","foto","contatti");
$aD = array("Home","Zelig Cabaret","Zelig Tv","Lab e Provini","Aziende","Video","Foto","Contatti");
*/
function creaElementiDettaglio(){
	$ret="";
    $ret.=creaElementi("text","nome","Nome","massimo 40 caratteri (obbligatorio)","");
    $ret.=creaElementi("textarea","descrizione","Descrizione ","(obbligatorio)","");
	$ret.=creaElementi("hidden","id_users","","","",$_SESSION["user"]["id"]);


	return $ret;
}
$nome = new ElementoForm();
$descrizione = new ElementoForm();
$id_users = new ElementoForm();


$nome->nome="Nome";
$nome->nomePost="nome";
$nome->nomeDB="nome";
$nome->tipo="txt";

$descrizione->nomePost="descrizione";
$descrizione->nomeDB="descrizione";
$descrizione->tipo="textarea";

$id_users->nome="Id Utente";
$id_users->nomePost="id_users";
$id_users->nomeDB="id_users";
$id_users->tipo="int";




//settare arrIndex con i campi che si vogliono far visualizare nella index altrimenti verranno visualizzati tutti i campi di array
/*
$arrIndex[]=$testo;
$arrIndex[]=$img;
$arrIndex[]=$file;
*/
$arrIndex[]=$nome;

$array[]=$nome;
$array[]=$descrizione;
$array[]=$id_users;

$arrjs=json_encode($array);


?>