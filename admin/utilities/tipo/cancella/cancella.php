<?php
$usePwd=1;
include("../../../_include_first.php");
include("../../../includes/controlliForm.php");
include("../salva/classi.php");
if(isset($idUtils))$Uid=$idUtils;
else $Uid="id";
$idDel=preg_split("/,/", $_POST["delete"]);
$template=$_POST['template'];
for($i=0;$i<count($array);$i++){
	if(strcmp(($array[$i]->tipo), "file")==0){
			$files[]="1;".$array[$i]->nomeDB;
	}
	else{
		if(strcmp(($array[$i]->tipo), "img")==0)
			$files[]="2;".$array[$i]->nomeDB;
	}
}
if(!isset($files))$files=array();
for($j=0;$j<count($idDel);$j++){
	$sql="SELECT * FROM ".$template." WHERE ".$Uid."='".$idDel[$j]."' ";
	$result=mysqli_query($conn_id,$sql);
	$row=mysqli_fetch_array($result);
	for($z=0;$z<count($files);$z++){
		$tf=preg_split("/;/", $files[$z]);
		if($row[$tf[1]]!=""){
			$file = preg_split("/;/", $row[$tf[1]]);
			for($y=0;$y<count($file)-1;$y++){
				if($tf[0]=="2"){
					unlink("../../../../img/".$file[$y]);
					unlink("../../../../img/".returnFullSize($file[$y]));
				}
				else
				{
					unlink("../../../../files/".$file[$y]);
				}
					
			}
		}
	}
	$sql="delete from ".$template." where ".$Uid."='".$idDel[$j]."' ";
	mysqli_query($conn_id,$sql) or die( array ("errore"=>mysql_error()));
}
$errore = array ("errore"=>"Dati eliminati");
echo json_encode($errore);

?>