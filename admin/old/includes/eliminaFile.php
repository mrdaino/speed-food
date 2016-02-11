<?php
$usePwd=1;
include("../_include_first.php");
include("controlliForm.php");
$p=$_POST['path'];
$campoDb=$_POST['nomeDB'];
$template=$_POST['template'];
$tipo=$_POST['tipo'];
$id=$_POST['id'];
$sql="SELECT ".$campoDb." FROM ".$template." WHERE id=".$id."";
$result=mysqli_query($conn_id,$sql) or die("Errore durante l'eliminazione del file");
$valueDB="";
$p2=false;
if($row=mysqli_fetch_array($result)){
    $copy=preg_split("/;/", $row[0]);
    for ($i=0; $i < count($copy)-1; $i++){
        if(strcmp($copy[$i], $p)!=0){
            $valueDB.=$copy[$i].";";
        }
    }
}
$sql="UPDATE ".$template." SET ".$campoDb."='". $valueDB."' WHERE id=".$id."";

mysqli_query($conn_id,$sql) or die("Errore durante l'eliminazione del file");
switch($tipo){
    case "img":
        $p1="img";
        $p2=true;
    break;
    case "file":
        $p1="files";
    break;
}
$path="../../".$p1."/".$p;
if(file_exists($path)){
     unlink($path);
     if($p2)
        unlink("../../".$p1."/".returnFullSize($p));
}
else{ 
    echo "Impossibile eliminare il file, il file non esiste";
    return;
}
echo "Il file è stato eliminato con successo";
?>
