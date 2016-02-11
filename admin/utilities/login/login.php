<?php 
$usePwd=0;
$template="login";
include("../../_include_first.php");

include (PATHINCLUDE."/header.php");
echo "<script>var LOCAL='".LOCAL_LOGIN."'</script>";
?>
<script type="text/javascript" src="js/ajax.js"></script>
<div class="column centered five">
	<form id="formDati">
		<label for="id">Username</label>
		<input type="text" name="id" id="id"/>

		<label for="pwd">Password</label>
	    <input type ="password" name="pwd" id="pwd"/>

	    <input type="button" class="button" value="Login" onClick="controllaForm()" />
	</form>
</div>

<?php
include (PATHINCLUDE."/footer.php");

?>