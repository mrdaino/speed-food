<?php
$usePwd=0;
include("../../../_include_first.php");
if(pulisciPost($_POST)==-1){
	$errore = array("errore"=>"inj");
	echo json_encode($errore);
}
$sql="select * from ".TB_LOGIN." where user='".($_POST["id"])."' and pwd='".md5($_POST["pwd"])."' ";
$result=mysqli_query($conn_id,$sql) or die(mysqli_error($conn_id));
if(mysqli_num_rows($result)==1){
	$row = mysqli_fetch_array($result);
	$_SESSION["loggato"]=100;
	$_SESSION["user"]=$row;
	$errore = array("errore"=>100);
	echo json_encode($errore);
}else{
	$errore = array("errore"=>"Username o Password errati");
	echo json_encode($errore);
}


?>