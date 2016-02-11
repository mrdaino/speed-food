<?php
session_start();

//VARIABILI DA MODIFICARE AL PRIMO ACCESSO
include 'includes/inizialize.php';
//------------------------------------------------
//error_reporting(E_ALL);
$_SERVER["DOCUMENT_ROOT"] = $_SERVER["DOCUMENT_ROOT"].LOCAL2;  //<------- PER LOCALE

if ($usePwd==1){
	if(!isset($_SESSION["loggato"]) || $_SESSION["loggato"]!=100){
		header("Location: ".LOCAL."/admin/utilities/login/login.php");
	}
}

if(isset($_GET["logout"]) && $_GET["logout"]==1){
	unset($_SESSION["loggato"]);
	header("Location: ".LOCAL."/admin/utilities/login/login.php");
}

include($_SERVER['DOCUMENT_ROOT']."/config/conn.php");
include($_SERVER['DOCUMENT_ROOT']."/config/define_admin.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/funzioni/funzioni.php");

?>