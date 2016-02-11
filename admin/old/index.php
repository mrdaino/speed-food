<?php
$usePwd=1;
include("_include_first.php");
include (PATHINCLUDE."/header.php");
if(isset($_GET["change_pwd"]) && $_GET["change_pwd"]==1){
	include(PATHINCLUDE."change_pwd.php");
}
include (PATHINCLUDE."/footer.php");
?>
