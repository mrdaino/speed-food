<?php
$pathUtilities=PATHUTILITIES;
$link_new="dettaglio.php?accesso=1";
/**
        COSTRUZIONE ASSOCIAZIONI
**/
if(isset($_SESSION["id_plus"]))unset($_SESSION["id_plus"]);
if(isset($_GET['id_plus'])){
    if(!preg_match("/[0-9]+(#[0-9]+)*/", $_GET['id_plus'])){
        echo "ACCESSO NEGATO";
        exit();
    }
    else{
        $link_edit="&id_plus=".$_GET['id_plus'];
        if(!isset($idAssociazione))$idAssociazione="id";
        else{
            $idAssociazione=preg_split("/#/", $idAssociazione);
        }
        $nmG=preg_split("/-/", $_GET['id_plus']);
        if(count($idAssociazione)!=count($nmG)){
            echo "ACCESSO NEGATO ";
            exit();
        }
        else{
            $condizione=" WHERE ";

            foreach ($idAssociazione as $key => $value) {

                $condizione.=$value."='".$nmG[$key]."' AND ";
            }
            $condizione=rtrim($condizione," AND ");
        }
        $link_new.="&id_plus=".$_GET['id_plus'];
        $_SESSION["id_plus"]=$_GET['id_plus'];
    }
}
/**
        COSTRUZIONE NOME PAGINA
**/
if(isset($templateView)){
    if(isset($templateViewAssoc)){

        $key_other=preg_split("/-/", $_GET['id_plus']);
        $ris_view=mysqli_query($conn_id,"SELECT * FROM ".$templateViewAssoc['table']." WHERE id=".$key_other[0]);
        $row_view=mysqli_fetch_array($ris_view);

        $temV=$templateView." ".$row_view[$templateViewAssoc['table-element']];
    }
    else{
        $temV=$templateView;
    }
    
}
else{
    $temV=$template;
}
if(isset($templateViewAssoc['link'])){
    //if(isset($_GET['id_plus']))$templateViewAssoc['link']=$templateViewAssoc['link']."?id_plus=".$_GET['id_plus'];
    $temV="<a style='padding:0; box-shadow: none;' href='".$templateViewAssoc['link']."'>". $temV ."</a>";
}

if(!isset($btn_inserisci))$btn_inserisci=true;
if(!isset($btn_modify))$btn_modify=true;
if(!isset($btn_delete))$btn_delete=true;
if(isset($cambiaOrdine)&&$cambiaOrdine){
    echo "<script>var cambiaOrdine=true; </script>";
}
else echo "<script>var cambiaOrdine=false; </script>";

/**
        COSTRUZIONE ELEMENTI PAGINA
**/
if(isset($idUtils))$Uid=$idUtils;
else $Uid="id";
if(isset($orderBy))$ob=$orderBy;
else $ob="";
$sql = "SELECT * FROM ".$template;
if(isset($condizione))$sql.=$condizione;
$sql.=" ".$ob;
$result=mysqli_query($conn_id,$sql) or die (mysqli_error($conn_id));
$num_rows=mysqli_num_rows($result);

if(isset($arrIndex))$arrDI=$arrIndex;
else $arrDI=$array;
$stringa="";
$stringa2="<option value='*'>su tutti i campi</option>";
for($i=0;$i<count($arrDI);$i++){
    $stringa.="<th>".$arrDI[$i]->nome."</th>";
    $stringa2.="<option value='".$arrDI[$i]->nomeDB."''>".$arrDI[$i]->nome."</option>";
}

$print_element="";
if(isset($num_max_inserisci)){
    if($num_rows>=$num_max_inserisci)$btn_inserisci=false;
}
if($num_rows>=1){
    $print_element.="
    <tbody >";
    while($row=mysqli_fetch_array($result, MYSQL_ASSOC)){ 
        $print_element.="
        <tr id='sortable_".$row['id']."'>";
        for($i=0;$i<count($arrDI);$i++){
            $print_element.=creaElementiRiep($arrDI[$i]->tipo,$arrDI[$i]->nomeDB,$row["id"],$arrDI[$i]);
        }
        $link_edit_td="dettaglio.php?id=".$row[$Uid];
        if(isset($link_edit))$link_edit_td.=$link_edit;
        if($btn_modify){
            $print_element.="
                <td><a href='".$link_edit_td."'>Edit</a></td>
            ";
        }
        if($btn_delete){
            $print_element.="
             <td><input type='checkbox' name='delElem[]' value='".$row[$Uid]."'/></td>
             ";
        }
        $print_element.="</tr>";
    } 
    $print_element.="
    </tbody>";

}
else{
    $print_element.="<tr><td>Non ci sono elementi nella tabella.</td></tr>";
}


/**
        COSTRUZIONE MESSAGGI PAGINA
**/
$errore="";
if(isset($_SESSION["error"])){
    $errore=$_SESSION["error"];
    unset($_SESSION["error"]);
}
?>