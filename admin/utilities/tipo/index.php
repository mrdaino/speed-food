<?php
    $usePwd=1;
    include("../../_include_first.php");
    include(PATHINCLUDE."/controlliForm.php");
    include (PATHINCLUDE."/header.php");
    include("salva/classi.php");
    include(PATHINCLUDE."/build_index_utilities.php");
?>
<script type="text/javascript" src="../../js/ajax_utilities.js"></script>
<?php
    echo"<script>var template='".$template."'</script>";
?>
<script type="text/javascript" src="../../js/funzioni_index_utilities.js"></script>
<?php
    include (PATHINCLUDE."/view_index_utilities.php");
    include (PATHINCLUDE."/footer.php"); 
?>
