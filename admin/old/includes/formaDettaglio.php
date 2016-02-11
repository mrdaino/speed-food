<?php
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        if(!is_numeric($_GET["id"])){
            echo "ACESSO NEGATO ";
            exit;
        } 
        else{
            $idG=$_GET["id"];
        }
    }
?>
<div id='popUpImg'>"
    <div id='popUpImgCont'>
        <span>Caricamento immagini</span>
        <div id="divImgPre">
            <div id="viewImg">
                <span>clicca e trascina per selezionare un area</span>
                <img id='uploadPreview' style='display:none;'/> 

            </div>
            <div id="viewPrevImg">
                <span>anteprima selezione</span>
                <div id="preview">
                    <img id="imgP">
                </div>
            </div>
        </div>
        <input type='file' id='uploadImage' />
        <p id="valNumImg" style="display:none;"></p>
        <p id="idChangeImg" style="display:none;"></p>
        <div class="btnPop"><p id="insImg">OK</p></div>
        <div class="btnPop" id="annulla"><p id="annullaImg">ANNULLA</p></div>
    </div>
</div>
<div id="intestazione_menu">
    <?php
        if(isset($templateView)){
            $temV=$templateView;
        }
        else{
            $temV=$template;
        }
    ?>
    <span class="intMenu" title="Torna al riepilogo" style="font-size: 21px; top: 3px; padding:0px;"><a href='index.php'><?php echo $temV; ?></a></span>
    <a onclick="clickSalva()" class="intMenu" style="font-size:21px;top: 3px;">SALVA</a>
    <?php if($showImg) echo'<span style="font-size: 21px; top: 3px; cursor:pointer" onclick="aggImg()">Aggiungi immagine</span>';
          if($showFile) echo'<span style="font-size: 21px; top: 3px; cursor:pointer" onclick="aggFile()">Aggiungi file</span>';
    ?>
</div>
<div class="" id="content">
<div class"">
<input type="hidden" id="x" name="x" />
<input type="hidden" id="y" name="y" />
<input type="hidden" id="w" name="w" />
<input type="hidden" id="h" name="h" />
<input type="hidden" id="idImg" name="idImg" />
<form id="formDati" enctype="multipart/form-data" method="post" action="salva/salva.php">
    <?php if(isset($idG)){ ?> <input type="hidden" name="update" value="<?php echo $idG; ?>" /> <?php }?>
    <table border="outset" id="tbUtilis">