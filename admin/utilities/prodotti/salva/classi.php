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
$template="prodotti";
$templateView="Prodotti";
$cambiaOrdine=true;
$orderBy=" WHERE id_users=".$_SESSION["user"]["id"]." order by ordine";
/*
se nn sono settate il cms prederà come id il valore id e per order by ""
$idUtils="pro_id";
$orderBy="order by pro_startdate desc";
$aV = array("index","zelig_cabaret","zelig_tv","lab_provini","aziende","video","foto","contatti");
$aD = array("Home","Zelig Cabaret","Zelig Tv","Lab e Provini","Aziende","Video","Foto","Contatti");
*/
function creaElementiDettaglio(){
	$ret="";
	global $conn_id;
	$sql="SELECT * FROM tipo WHERE id_users = ".$_SESSION["user"]["id"];
	$result = mysqli_query($conn_id,$sql);
	$aV=array();
	$aD=array();
	while($ingrediente= mysqli_fetch_array($result)){

		$aV[] = $ingrediente["id"];
		$aD[] = $ingrediente["nome"];
	}
	$ret.=creaElementi("select","id_tipo","Tipo di prodotto","","",$aV,$aD);
    $ret.=creaElementi("text","nome","Nome","massimo 50 caratteri (obbligatorio)","");
    $ret.=creaElementi("text","prezzo","Prezzo prodotto finito","(obbligatorio)","");
    $ret.=creaElementi("textarea","descrizione","Descrizione ","(obbligatorio)","");
	$ret.=creaElementi("hidden","id_users","","","",$_SESSION["user"]["id"]);

	return $ret;
}
$tipo = new ElementoForm();
$nome = new ElementoForm();
$prezzo = new ElementoForm();
$descrizione = new ElementoForm();
$ass_ingredienti = new ElementoForm();
$id_users = new ElementoForm();


$tipo->nome="Tipo di prodotto";
$tipo->nomePost="id_tipo";
$tipo->nomeDB="id_tipo";
$tipo->tipo="txt";
$tipo->tipo="select_gabri";
$tipo->ext_tab="tipo";
$tipo->ext_field="nome";

$nome->nome="Nome";
$nome->nomePost="nome";
$nome->nomeDB="nome";
$nome->tipo="txt";

$prezzo->nome="Prezzo prodotto finito";
$prezzo->nomePost="prezzo";
$prezzo->nomeDB="prezzo";
$prezzo->tipo="txt";

$descrizione->nome="Descrizione";
$descrizione->nomePost="descrizione";
$descrizione->nomeDB="descrizione";
$descrizione->tipo="textarea";

$ass_ingredienti->nome="Ingredienti";
$ass_ingredienti->nomePost="../ingrediente_prodotto/";
$ass_ingredienti->nomeDB="id";
$ass_ingredienti->value="Gestisci";
$ass_ingredienti->obbligatorio=false;
$ass_ingredienti->tipo="associazione";

$id_users->nome="Utente";
$id_users->nomePost="id_users";
$id_users->nomeDB="id_users";
$id_users->tipo="txt";




//settare arrIndex con i campi che si vogliono far visualizare nella index altrimenti verranno visualizzati tutti i campi di array
/*
$arrIndex[]=$testo;
$arrIndex[]=$img;
$arrIndex[]=$file;
*/
$arrIndex[]=$nome;
$arrIndex[]=$tipo;
$arrIndex[]=$prezzo;
$arrIndex[]=$ass_ingredienti;

$array[]=$nome;
$array[]=$tipo;
$array[]=$prezzo;
$array[]=$descrizione;
$array[]=$id_users;

$arrjs=json_encode($array);


?>