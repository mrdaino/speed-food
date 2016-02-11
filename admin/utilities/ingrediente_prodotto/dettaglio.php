<?php
$usePwd=1;
include("../../_include_first.php");
include("../../includes/controlliForm.php");
include("salva/classi.php");
include("salva/json.php");
?>
<script>var update=false;</script>
<?php
if(isset($_GET['id_plus'])){
    if(!preg_match("/[0-9]+(#[0-9]+)*/", $_GET['id_plus'])){
        echo "ACCESSO NEGATO";
        exit();
    }
    else{
        if(!isset($idAssociazione))$idAssociazione="id";
        else{
            $idAssociazione=preg_split("/#/", $idAssociazione);
        }
        $nmG=preg_split("/-/", $_GET['id_plus']);
        if(count($idAssociazione)!=count($nmG)){
            echo "ACCESSO NEGATO ";
            exit();
        }
        else{
            $campi="";

            foreach ($idAssociazione as $key => $value) {

                $campi.="<input type='hidden' name='".$value."' value='".$nmG[$key]."'>";
            }
        }
        //$nmG=mysqli_real_escape_string($conn_id,$_GET['id_plus']);
        $_SESSION["id_plus"]=$_GET['id_plus'];
    }
}
//-------------------------------recupero info da db---------------------------------------------------------
if(isset($idUtils))$Uid=$idUtils;
else $Uid="id";
if(isset($_GET["id"])){
    $update=1;
    ?>
    <script>update=true;</script>
    <?php
    $sql="select * from ".$template." where ".$Uid."='".$_GET["id"]."' ";
    $result=mysqli_query($conn_id,$sql) or die (mysql_error());
    $row=mysqli_fetch_array($result, MYSQL_ASSOC);
}

if(isset($_SESSION["errore"])){
    echo "<script type=\"text/javascript\">alert('".$_SESSION['errore']."');</script>";
    unset($_SESSION["errore"]);
}
//-----------------------------------------------------------------------------------------------------------

include (PATHINCLUDE."/header.php");
?>
<script src="../../js/ckEditor/ckeditor.js"></script>

<script type="text/javascript" src="js/ajax.js"></script>
<?php
$showImg=false;
$showFile=false;
include (PATHINCLUDE."/formaDettaglio.php");
echo creaElementiDettaglio();
if(isset($_GET["id"])){
    echo "<input type='hidden' name='update' value='".$_GET["id"]."'>";
}
if(isset($campi))echo $campi;
?>
</table>
</form>
</div>
<?php include (PATHINCLUDE."/footer.php");

?>
