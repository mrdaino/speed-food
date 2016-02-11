<form action="<?php echo LOCAL;?>/admin/funzioni/change_pwd.php" method="post">
	<table style="margin-top:100px">
		<tr><th style="height: 48px; font-size: 19px; padding-left: 9px;">Cambia Password</th></tr>
		<tr><td>Inserisci la Vecchia password</td><td style="width: 230px;"><input type="password" name="old_psw" /></td></tr>
		<tr><td>Inserisci la Nuova password<br>(deve contenere almeno un numero ed essere lunga almeno 10 caratteri)</td><td><input type="password" name="new_psw" /></td></tr>
		<tr><td><input type="submit" value="Cambia"></td><td></td></tr>
	</table>
</form>
<?php
	if(isset($_SESSION["error"])){
		echo $_SESSION["error"];
		unset($_SESSION["error"]);
	}
?>