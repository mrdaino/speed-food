<?php
$usePwd=1;
//$template="prova_inserimento";
include("../../../_include_first.php");
include("../../../includes/controlliForm.php");
include("classi.php");
if(isset($idUtils))$Uid=$idUtils;
else $Uid="id";
$ordine=$_POST['sortable'];
//echo $search[0];
for($i=0;$i<count($ordine);$i++){
	$sql="UPDATE ".$template." SET ordine='".($i+1)."' WHERE ".$Uid."=".$ordine[$i];
	mysqli_query($conn_id,$sql) or die("Errore nel salvataggio alcuni elementi potrebbero essere stati salvati altri no");
}
echo "L'ordine degli elementi è stato modificato con successo";
?>