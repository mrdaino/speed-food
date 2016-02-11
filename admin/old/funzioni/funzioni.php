<?php
	function pulisciLogin($post){
		$injections = array ("select","insert","update","order","<",">","&","%","#","'","-",'"',"AND","OR","\\","/","+",".","!","(",")","[","]","=","?","^","|",":",",");
		foreach($post as $v){
			foreach($injections as $inj)
				if(strstr($v, $inj)){
					return -1;
				}
		}
		return 1;
	}
	function pulisciPost($post){
		$injections = array ("select","insert","update","order","#","^","|","&&");
		foreach($post as $v){
			foreach($injections as $inj)
				if(strstr($v, $inj)){
					return -1;
				}
		}
		return 1;
	}
	function getData($data){
		$data=preg_split("/ /", $data);
		$data=preg_split("/-/", $data[0]);
		switch ($data[1]) {
			case 1:$data[1]="Gennaio";break;
			case 2:$data[1]="Febbraio";break;
			case 3:$data[1]="Marzo";break;
			case 4:$data[1]="Aprile";break;
			case 5:$data[1]="Maggio";break;
			case 6:$data[1]="Giugno";break;
			case 7:$data[1]="Luglio";break;
			case 8:$data[1]="Agosto";break;
			case 9:$data[1]="Settembre";break;
			case 10:$data[1]="Ottobre";break;
			case 11:$data[1]="Novembre";break;
			case 12:$data[1]="Dicembre";break;
		}
		$data=array("giorno"=>$data[2],"mese"=>$data[1],"anno"=>$data[0]);
		return $data;
	}

	function pulisciCampo($stringa){
		$stringa=mysql_real_escape_string($stringa);	
		return htmlspecialchars ($stringa);
	}

    function data($data){
        $data = substr($data, 0, 10);
        $arrData = explode("-", $data);
        $data = $arrData[2]."/".$arrData[1]."/".$arrData[0];
        return $data;
    }
    ?>
