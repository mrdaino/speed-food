<?php
$usePwd=1;
$img="";
include("../../../_include_first.php");
include("../../../includes/controlliForm.php");
include("classi.php");
$update="";
if(isset($_POST["update"]))
    $update=$_POST["update"];
//$array=[$ordine,$testo,$img,$file];
//echo  controllaForm($array,$template,$update);
$_SESSION["error"]= controllaForm($array,$template,$update,"id");
if(isset($_SESSION["id_plus"]))
    header("location: ../?id_plus=".$_SESSION["id_plus"]);
else
    header("location: ../");
?>