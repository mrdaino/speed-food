<?php
$usePwd=1;
function search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
	 	if($value->nomeDB===$needle) return true;
	 }
	 return false;
}
include("../../../_include_first.php");
include("../../../includes/controlliForm.php");
include("classi.php");
$cond="";
$search=$_POST['search'];
if(isset($idUtils))$Uid=$idUtils;
else $Uid="id";
if(isset($orderBy))$ob=$orderBy;
else $ob="";
if(strcmp($_POST['eDb'], "*")==0){
	$cond="CONCAT(";
	for($i=0;$i<count($array)-1;$i++){
		$cond.=$array[$i]->nomeDB.",";
	}
	$cond.=$array[$i]->nomeDB.")";
}
else{
	if(search($_POST['eDb'], $array)){
		$cond=$_POST['eDb'];
	}
	else{
		echo "errore";
		return;
	}
}
$cond=mysqli_real_escape_string($conn_id,$cond);
$search=mysqli_real_escape_string($conn_id,$search);
$sql=sprintf("SELECT * FROM %s WHERE %s LIKE '%%%s%%' %s",$template,$cond,$search,$ob);
$result=mysqli_query($conn_id,$sql);
if(isset($arrIndex))$arrDI=$arrIndex;
else $arrDI=$array;
while($row=mysqli_fetch_array($result) or die(mysqli_error($conn_id))){
		echo"<tr>";
        for($i=0;$i<count($arrDI);$i++){
            creaElementiRiep($arrDI[$i]->tipo,$arrDI[$i]->nomeDB,$row[$Uid]);
        }
        echo"   <td><a href='dettaglio.php?id=".$row[$Uid]."'>Edit</a></td>";
        echo"    <td><input type='checkbox' name='delElem[]' value='".$row[$Uid]."'/></td>";
        echo"</tr>";
}
?>