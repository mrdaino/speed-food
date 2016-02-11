<div id="msg_div">
    <?php
        echo $errore;
    ?>
</div>
<div id="intestazione_menu">
    <span class="IUtilis" style="font-size: 21px; top: 3px;"><?php echo $temV; ?></span>
    <span class="IUtilis">
        <select id="searchE">
            <?php
                echo $stringa2;
            ?>
        </select>
    </span>
    <span class="IUtilis">
        <input style="margin:0" type="text" placeHolder="Cerca" id="input_cerca"/>
    </span>
    <?php if($btn_inserisci){?>
    <a class="intMenu" style="font-size: 20px; top: 2px;" title="Inserisci un elemento" href="<?php echo $link_new;?>" >
        +
    </a>
    <?php }?>
    <?php if($btn_delete){?>
    <a  class="intMenu" id='elimina' style="font-size: 20px; top: 2px;" title="Elimina Elementi">
        X
    </a>
    <?php }?>
    <?php if(isset($cambiaOrdine)&&$cambiaOrdine){?>
    <a  class="intMenu" id='sOrdina' style="font-size: 20px; top: 2px;" title="Memorizza l'ordine degli elementi">
       Memorizza Ordine
    </a>
     <?php }?>
</div>
<div class="" id="content">
    <table border="outset" id="sort">
       <thead id="menuT">
            <tr>
                <?php
                    echo $stringa;
                ?>
                <th>Modifica</th>
                <?php if($btn_delete){?>
                <th>Elimina</th>
                 <?php }?>
            <tr>
        </thead>
        <?php
        echo $print_element;
    	?>
    </table>
</div>
