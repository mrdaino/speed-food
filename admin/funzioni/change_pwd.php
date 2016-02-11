<?php
	$usePwd=1;
	include("../_include_first.php");
	if(isset($_POST["old_psw"])&&isset($_POST["new_psw"])){
		$old_psw=$_POST["old_psw"];
		$new_psw=$_POST["new_psw"];
		if(pulisciLogin($_POST)==1){
				if($old_psw!=""&&$new_psw!=""){
					$sql="SELECT * FROM admin WHERE user='".$_SESSION["user"]."' AND pwd='".md5($old_psw)."'";
					$result=mysql_query($sql);
					if(mysql_fetch_array($result)){
						if(strlen($new_psw)>10){
							if (preg_match('/[A-Za-z]/', $new_psw) && preg_match('/[0-9]/', $new_psw)){
								$sql="UPDATE admin SET pwd='".md5($new_psw)."' WHERE user='".$_SESSION["user"]."'";
								if(mysql_query($sql)){
									$_SESSION["error"]="Cambio password effettuato con successo.";
									header("Location: ../index.php?change_pwd=1");
								}else{
									$_SESSION["error"]="Si &egrave; verificato un errore inatteso nel salvataggio, riprovare.";
									header("Location: ../index.php?change_pwd=1");
								}
							}else{
								$_SESSION["error"]="La Nuova password deve contenere almeno un numero.";
								header("Location: ../index.php?change_pwd=1");
							}
						}else{
							$_SESSION["error"]="La Nuova password deve avere una lunghezza superiore ai 10 caratteri.";
							header("Location: ../index.php?change_pwd=1");
						}
					}else{
						$_SESSION["error"]="La Vecchia password &egrave; errata.";
						header("Location: ../index.php?change_pwd=1");
					}
				}else{
					$_SESSION["error"]="Bisogna compilare entrambi i campi per poter eseguire l'operazione.";
					header("Location: ../index.php?change_pwd=1");
				}
		}else{
			$_SESSION["error"]="La Vecchia password &egrave; errata.";
			header("Location: ../index.php?change_pwd=1");
		}
	}
?>