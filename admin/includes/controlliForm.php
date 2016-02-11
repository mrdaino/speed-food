<?php
require_once($_SERVER['DOCUMENT_ROOT']."/config/errorReport.php");
class ElementoForm {
 	public $nome="";
	public $tipo="";
	public $value="";
	public $obbligatorio=true;
	public $nomePost="";
	public $nomeDB="";
	public $dipendeDa="";
	public $valDip="";
	//file
	public $fileMaxSize="";
	public $fileTipiAmmissibili="";
	public $fileMaxNumber="";
	public $fileMinNumber=1;
	public $file="";
	public $percorsoFile="";
	//testo
	public $txtMaxSize="";
	public $txtMinSize="";
	public $txtMatchRegExp="";	//espressione regolare (deve essere in questa forma)
	public $txtBadRegExp="";	//espressione regolare (non deve contenere questi caratteri)
	//data
	public $dataAntecedente="";
	public $dataPostcedente=""; 

	public $permalink="";
	public $valuePermalink="";

	//gabri
	public $ext_tab="";
	public $ext_field="";
}
function creaPdf($html,$nome){
  require_once("../../../pdf/dompdf_config.inc.php");  
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->set_paper("letter", "portrait");
  $dompdf->render();
  $dompdf->stream($nome.".pdf", array("Attachment" => false));
}
//crea elementi in dettaglio
function creaElementi($tipo,$nomeDb,$nomeTr,$descrizione,$n,$arrValue="",$arrValueDesc=""){
	global $row;
	global $template;
	global $array;
	if(get_magic_quotes_gpc()) {
		if(isset($row[$nomeDb]))
		$row[$nomeDb]= html_entity_decode($row[$nomeDb]);
	 }
	$stringa_ret="";
	switch ($tipo) {
		case 'hidden':
			$stringa_ret="<input type='hidden' name='".$nomeDb."' value='".$arrValue."'>";
		break;
		case 'int':;
		case 'text':
			$nomeCampoDB=$nomeDb; 
	        if(isset($row[$nomeCampoDB]))
	            $valoreCampoDB=$row[$nomeCampoDB];
	        else 
	            $valoreCampoDB="";
	        $stringa_ret='
		        <tr>
		            <td>'.$nomeTr.'</td>
		            <td colspan="2">
		            	<p>
		            		<input type="text" maxlength="255" name="'.$nomeCampoDB.'" id="'.$nomeCampoDB.'" value="'.stripcslashes($valoreCampoDB).'"/>
		            	</p>
		            	<p>
		            	'.$descrizione.'
		            	</p>
		            </td>
		            <!--<td style="width:300px">'.$descrizione.'</td>-->
		        </tr>';
			break;
		case 'color':
			$nomeCampoDB=$nomeDb; 
	        if(isset($row[$nomeCampoDB]))
	            $valoreCampoDB=$row[$nomeCampoDB];
	        else {
	            $valoreCampoDB="303030";
	        }
	        $stringa_ret='
		        <tr>
		            <td>'.$nomeTr.'</td>
		            <td colspan="2">
		            	<p>
		            		<input type="text" class="color" name="'.$nomeCampoDB.'" id="'.$nomeCampoDB.'" value="'.stripcslashes($valoreCampoDB).'"/>
		            	</p>
		            	<p>
		            	'.$descrizione.'
		            	</p>
		            </td>
		            <!--<td style="width:300px">'.$descrizione.'</td>-->
		        </tr>';
			break;
		case 'textarea':
			$nomeCampoDB=$nomeDb; 
	        if(isset($row[$nomeCampoDB]))
	            $valoreCampoDB=$row[$nomeCampoDB];
	        else 
	            $valoreCampoDB="";
	        $stringa_ret='
		        <tr>
		            <td>'.$nomeTr.'</td>
		           <td colspan="2">
		            	<textarea class="ckeditor" name="'.$nomeCampoDB.'" id="'.$nomeCampoDB.'" style="height:400px;width:600px">'.stripcslashes($valoreCampoDB).'</textarea>
		            	<p>
		            	'.$descrizione.'
		            	</p>
		           	</td>
		            <!--<td style="width:300px">'.$descrizione.'</td>-->
		        </tr>';
			break;
		case 'textarea2':
			$nomeCampoDB=$nomeDb; 
	        if(isset($row[$nomeCampoDB]))
	            $valoreCampoDB=$row[$nomeCampoDB];
	        else 
	            $valoreCampoDB="";
	        $stringa_ret='
		        <tr>
		            <td>'.$nomeTr.'</td>
		           <td colspan="2">
		            	<textarea name="'.$nomeCampoDB.'" id="'.$nomeCampoDB.'" style="height:400px;width:600px">'.stripcslashes($valoreCampoDB).'</textarea>
		            	<p>
		            	'.$descrizione.'
		            	</p>
		           	</td>
		            <!--<td style="width:300px">'.$descrizione.'</td>-->
		        </tr>';
			break;
		case 'img':
			global $idUtils;
			if(!isset($idUtils))$idDelImg="id";
			else $idDelImg=$idUtils;
			$i=$n;
			$nomeCampoDB=$nomeDb; 
			if(isset($row[$nomeCampoDB])&&$row[$nomeCampoDB]!="")
	          $immagini=preg_split("/;/", $row[$nomeCampoDB]);
	        else{
	        	if($i==0) $immagini=array('');
	        	else $immagini= array_fill(0, $i, '');
	        }
	        for($z=0;$z<count($array);$z++){
				if(strcmp($array[$z]->nomeDB, $nomeDb)==0)break;
			}
	           $id=$nomeDb;
				$stringa_ret= "
					<tr  id='".$id."'>
						<td>".$nomeTr."</td>
						<td id='td_".$id."'>";
						for($j=0;$j<$i; $j++){
							
							$stringa_ret.="
							<div id='".$id."contenitoreImg".$j."' style='overflow: hidden; text-align:center;'>
	                    		<img class='imgP'"; if($immagini[$j]=="") echo" style='display:none;'";
	                    	$stringa_ret.="	 id='".$id."img".$j."' src='".LOCAL."/img/".$immagini[$j]."'>";
	                    	if(($j)>floor($array[$z]->fileMinNumber)||$array[$z]->obbligatorio==false)
									$stringa_ret.="<br/><img class='delP' onclick='eliminaFiles(\"".$nomeDb."\",\"".$template."\",\"".$immagini[$j]."\",\"".$row[$idDelImg]."\",\"img\")' src='".LOCAL."/admin/img/elimina.png'>";
	                		$stringa_ret.="
	                		</div>
	                		<input type='file' class='img_input' name='".$id."imgF".$j."' id='".$id."imgF".$j."' value='".$immagini[$j]."'/>
	                		<script>numImg++; $(document).on('change','#".$id."imgF".$j."',function(event){caricaImg_not_resize('".$id."imgF".$j."','".$j."','".$id."'";
	                		$stringa_ret.=");});</script>
	                		";
						}
						if(count($immagini)==0 && isset($_GET['id']))$contatore=count($immagini);
						else $contatore=count($immagini)-1;
						for(;$j<$contatore; $j++){
							//TODO
							
							$stringa_ret.="
							<div id='".$id."contenitoreImg".$j."' style='overflow: hidden;text-align:center;'>
	                    		<img class='imgP' id='".$id."img".$j."' src='".LOCAL."/img/".$immagini[$j]."'>
	                    		";
	                    		if(($j)>floor($array[$z]->fileMinNumber)||$array[$z]->obbligatorio==false)
									$stringa_ret.="<br/><img class='delP' onclick='eliminaFiles(\"".$nomeDb."\",\"".$template."\",\"".$immagini[$j]."\",\"".$row[$idDelImg]."\",\"img\")' src='".LOCAL."/admin/img/elimina.png'>";
	                		$stringa_ret.="</div>
	                		<input type='file' class='img_input' name='".$id."imgF".$j."' id='".$id."imgF".$j."' value='".$immagini[$j]."'/>
	                		<script>numImg++; $(document).on('change','#".$id."imgF".$j."',function(event){caricaImg_not_resize('".$id."imgF".$j."','".$j."','".$id."'";
	                		$stringa_ret.=");});</script>
	                		";
						}
				$stringa_ret.="	</td>
						<td>
							<p>".$descrizione."</p>";
							if(!isset($_GET['id'])){
								$j=$j-1;
								if($i==0) $j=0;
							}
							$stringa_ret.="<p id='".$id."numaggImg' style='display:none;'>".($j)."</p>
							<span class='aggSpan intMenu' title='Aggiungi ".$nomeTr."' onclick='aggImg_not_resize(\"".$id."\" ";
								if($arrValue!="") $stringa_ret.= ',"'.$arrValue.'"';
	                			if($arrValueDesc!="") $stringa_ret.= ',"'.$arrValueDesc.'"';
							$stringa_ret.=")' style='font-size: 21px; top: 3px; cursor:pointer'>+</span>
						</td>
					</tr>";
				
	        	
			break;
		case 'imgFisso':
			global $idUtils;
			if(!isset($idUtils))$idDelImg="id";
			else $idDelImg=$idUtils;
			$i=$n;
			$nomeCampoDB=$nomeDb; 
			if(isset($row[$nomeCampoDB])&&$row[$nomeCampoDB]!="")
	          $immagini=preg_split("/;/", $row[$nomeCampoDB]);
	        else{
	        	if($i==0) $immagini=array('');
	        	else $immagini= array_fill(0, $i, '');
	        }
	        for($z=0;$z<count($array);$z++){
				if(strcmp($array[$z]->nomeDB, $nomeDb)==0)break;
			}
	           $id=$nomeDb;
				$stringa_ret= "
					<tr  id='".$id."'>
						<td>".$nomeTr."</td>
						<td id='td_".$id."'>";
						for($j=0;$j<$i; $j++){
							
							$stringa_ret.="
							<div id='".$id."contenitoreImg".$j."' style='overflow: hidden; text-align:center;'>
	                    		<img class='imgP'"; if($immagini[$j]=="") $stringa_ret.=" style='display:none;'";
	                    	$stringa_ret.="	 id='".$id."img".$j."' src='".LOCAL."/img/".$immagini[$j]."'>";
	                    	if(($j)>floor($array[$z]->fileMinNumber)||$array[$z]->obbligatorio==false)
									$stringa_ret.="<br/><img class='delP' onclick='eliminaFiles(\"".$nomeDb."\",\"".$template."\",\"".$immagini[$j]."\",\"".$row[$idDelImg]."\",\"img\")' src='".LOCAL."/admin/img/elimina.png'>";
	                		$stringa_ret.="
	                		</div>
	                		<input type='hidden' id='".$id."hidden_img".$j."' name='".$id."hidden_img".$j."'/>
	                		<input type='hidden' name='".$id."dimensioneImg".$j."' id='".$id."dimensioneImg".$j."' value='".$immagini[$j]."'/>
	                		<input type='file' class='img_input' name='".$id."imgF".$j."' id='".$id."imgF".$j."' value='".$immagini[$j]."'/>
	                		<script>numImg++; $(document).on('change','#".$id."imgF".$j."',function(event){caricaImg('".$id."imgF".$j."','".$j."','".$id."'";
	                			if($arrValue!="") $stringa_ret.= ",'$arrValue'";
	                			if($arrValueDesc!="") $stringa_ret.= ",'$arrValueDesc'";
	                		$stringa_ret.=");});</script>
	                		";
						}
						if(count($immagini)==0 && isset($_GET['id']))$contatore=count($immagini);
						else $contatore=count($immagini)-1;
						for(;$j<$contatore; $j++){
							//TODO
							
							$stringa_ret.="
							<div id='".$id."contenitoreImg".$j."' style='overflow: hidden;text-align:center;'>
	                    		<img class='imgP' id='".$id."img".$j."' src='".LOCAL."/img/".$immagini[$j]."'>
	                    		";
	                    		if(($j)>floor($array[$z]->fileMinNumber)||$array[$z]->obbligatorio==false)
									$stringa_ret.="<br/><img class='delP' onclick='eliminaFiles(\"".$nomeDb."\",\"".$template."\",\"".$immagini[$j]."\",\"".$row[$idDelImg]."\",\"img\")' src='".LOCAL."/admin/img/elimina.png'>";
	                		$stringa_ret.="</div>
	                		<input type='hidden' id='".$id."hidden_img".$j."' name='".$id."hidden_img".$j."'/>
	                		<input type='hidden' name='".$id."dimensioneImg".$j."' id='".$id."dimensioneImg".$j."' value='".$immagini[$j]."'/>
	                		<input type='file' class='img_input' name='".$id."imgF".$j."' id='".$id."imgF".$j."' value='".$immagini[$j]."'/>
	                		<script>numImg++; $(document).on('change','#".$id."imgF".$j."',function(event){caricaImg('".$id."imgF".$j."','".$j."','".$id."'";
	                			if($arrValue!="") $stringa_ret.= ",'$arrValue'";
	                			if($arrValueDesc!="") $stringa_ret.= ",'$arrValueDesc'";
	                		$stringa_ret.=");});</script>
	                		";
						}
				$stringa_ret.="	</td>
						<td>
							<p>".$descrizione."</p>";
							if(!isset($_GET['id'])){
								$j=$j-1;
								if($i==0) $j=0;
							}
							$stringa_ret.="<p id='".$id."numaggImg' style='display:none;'>".($j)."</p>
							<span class='aggSpan intMenu' title='Aggiungi ".$nomeTr."' onclick='aggImg(\"".$id."\" ";
								if($arrValue!="") $stringa_ret.= ',"'.$arrValue.'"';
	                			if($arrValueDesc!="") $stringa_ret.= ',"'.$arrValueDesc.'"';
							$stringa_ret.=")' style='font-size: 21px; top: 3px; cursor:pointer'>+</span>
						</td>
					</tr>";
				
	        	
			break;
		case 'fileFisso':
			global $idUtils;
			if(!isset($idUtils))$idDelImg="id";
			else $idDelImg=$idUtils;
			$i=$n;
			$nomeCampoDB=$nomeDb; 
			if(isset($row[$nomeCampoDB])&&$row[$nomeCampoDB]!="")
         		$files=preg_split("/;/", $row[$nomeCampoDB]);
	        else{ 
	           if($i==0) $files=array('');
	           	else $files= array_fill(0, $i, '');
	        }
	        for($z=0;$z<count($array);$z++){
				if(strcmp($array[$z]->nomeDB, $nomeDb)==0)break;
			}
			$id=$nomeDb;
			$stringa_ret= "
			<tr  id='".$id."'>
				<td >".$nomeTr."</td>
				<td id='td_".$id."'>";
			for($j=0;$j<$i; $j++){
				$stringa_ret.=
			    "<a target='blank' ";if($files[$j]=="") $stringa_ret.=" style='display:none;'";
			    $stringa_ret.="id='".$id."fileA".$j."' href='../../../files/".$files[$j]."'><img class='fileP' title='".$files[$j]."' src='../../img/file.png'></a>";
			    if(($j)>floor($array[$z]->fileMinNumber)||$array[$z]->obbligatorio==false)
			    	$stringa_ret.="<br/><img class='delP delFile' onclick='eliminaFiles(\"".$nomeDb."\",\"".$template."\",\"".$files[$j]."\",\"".$row[$idDelImg]."\",\"file\")' src='".LOCAL."/admin/img/elimina.png'>";
				$stringa_ret.="<input type='file' class='file_input' name='".$id."fileF".$j."' id='".$id."fileF".$j."' value='".$files[$j]."'/>".
			    "<script>numFile++; $('#".$id."fileF".$j."').change(function(){caricaFile('".$id."fileF".$j."','".$j."','".$id."');});</script>";
			}
			if(count($files)==0 && isset($_GET['id']))$contatore=count($files);
			else $contatore=count($files)-1;
			for(;$j<$contatore; $j++){
				$stringa_ret.=
			    "<a target='blank' ";if($files[$j]=="") $stringa_ret.=" style='display:none;'";
			    $stringa_ret.="id='".$id."fileA".$j."' href='../../../files/".$files[$j]."'><img class='fileP' title='".$files[$j]."' src='../../img/file.png'></a>";
			    if(($j)>floor($array[$z]->fileMinNumber)||$array[$z]->obbligatorio==false)
					 $stringa_ret.="<br/><img class='delP delFile' onclick='eliminaFiles(\"".$nomeDb."\",\"".$template."\",\"".$files[$j]."\",\"".$row[$idDelImg]."\",\"file\")' src='".LOCAL."/admin/img/elimina.png'>";
				 $stringa_ret.="<input type='file' class='file_input' name='".$id."fileF".$j."' id='".$id."fileF".$j."' value='".$files[$j]."'/>".
			    "<script>numFile++; $('#".$id."fileF".$j."').change(function(){caricaFile('".$id."fileF".$j."','".$j."','".$id."');});</script>";
			}
			$stringa_ret.="</td>".
				"<td style='width:300px'>".$descrizione;
				if(!isset($_GET['id'])){
					$j=$j-1;
					if($i==0) $j=0;
				}
				$stringa_ret.="
					<p id='".$id."numaggFile' style='display:none;'>".($j)."</p>
					<br/><br/>
					<span class='aggSpan intMenu' title='Aggiungi ".$nomeTr."' onclick='aggFile(\"".$id."\")' style='font-size: 21px; top: 3px; cursor:pointer'>+</span>
				</td>".
			"</tr>";
			break;
		case "data":
			$nomeCampoDB=$nomeDb; 
	        if(isset($row[$nomeCampoDB])){
	            $valoreCampoDB=$row[$nomeCampoDB];
	            $data= preg_split("/-/", $row[$nomeCampoDB]);
	        }
	        else {
	            $valoreCampoDB="";
	            $data[0]="";
	            $data[1]="";
	            $data[2]="";
	        }
	        //$data= preg_split("/-/", $row[$nomeCampoDB]);
	        $stringa_ret.='
	        <tr>
	            <td>'.$nomeTr.'</td>
	            <td colspan="2">
	            	<p>
	            		'.genera_data($nomeCampoDB, $data[0], $data[1], $data[2]).'
	            	</p>
	            	<p>
	            	'.$descrizione.'
	            	</p>
	            </td>
	            <!--<td style="width:300px">'.$descrizione.'</td>-->
	        </tr>';
		break;

		case "select":
			$nomeCampoDB=$nomeDb; 
			//print_r($arrValue);
	        if(isset($row[$nomeCampoDB]))
	            $valoreCampoDB=$row[$nomeCampoDB];
	        else 
	            $valoreCampoDB="";
	        //$data= preg_split("/-/", $row[$nomeCampoDB]);
	        $stringa_ret.='
	        <tr>
	            <td>'.$nomeTr.'</td>
	            <td colspan="2">
	            	<p>
	            		'.genera_select($nomeCampoDB,$valoreCampoDB,$arrValue,$arrValueDesc).'
	            	</p>
	            	<p>
	            	'.$descrizione.'
	            	</p>
	            </td>
	            <!--<td style="width:300px">'.$descrizione.'</td>-->
	        </tr>';
		break;
		default:
			# code...
			break;
	}
	return $stringa_ret;
}
//FUNZIONI AGGIUNTE PER CASI PARTICOLARI
function get_tipo($id) {
 switch ($id) {
 	case '0':
 		$rt="Youtube";
 		break;
 	case '1':
 		$rt="SoundCloud";
 		break;
 	default:
 		# code...
 		break;
 }
  return $rt;
}
//---------------------------------------------
function arraySearch( $array, $search ) { 
	$valori=array();
    foreach ($array as $key=>$a ) { 
        if(strstr( $a, $search)){ 
            $valori[]=$key;
        } 
    } 
	if(!$valori) return false;
	else return $valori; 
}
function genera_select($id,$val,$aV,$aD) {

  $stringa='<select style="width:150px;" class="" id="'.$id.'" name="'.$id.'" >
			<option value="0" >Seleziona</option>';
  for($i=0;$i<count($aV);$i++){
  			$stringa.='
			<option ';if(strcmp($val,$aV[$i])==0) $stringa.='selected '; $stringa.='value="'.$aV[$i].'">'.$aD[$i].'</option>
		   ';
  }
  $stringa.='</select>';
  return $stringa;
}

function creaElementiRiep($tipo,$nomeDb,$id,$indice=""){
	global $row;
	global $template;
	global $array;
	$stringa_ret="";
	/*if(get_magic_quotes_gpc()) {
		$row[$nomeDb]= html_entity_decode($row[$nomeDb]);
	}
	*/
	switch ($tipo) {
		case 'antTitolo':
			require_once(dirname(__FILE__) ."../../../import/youtube.php");
			$video = YoutubeDataApi::getVideoResponse($row[$nomeDb]);
			if($video->getTitle()!="")echo"<td>".$video->getTitle()."</td>";
			else $stringa_ret="<td>Il titolo è privato</td>";
			return $stringa_ret=sprintf("%s",$video->getTitle());
		break;
		case 'antImg':
			require_once(dirname(__FILE__) ."../../../import/youtube.php");
			$video = YoutubeDataApi::getVideoResponse($row[$nomeDb]);
			$imgs = $video->getThumbnails();
			if($imgs[0]['url']=="")
					$stringa_ret="<td><img class='imgPrev' src='../../../img/video/default_thumb.jpg'></td>";
			else	$stringa_ret="<td><img class='imgPrev' src='".$imgs[0]['url']."'></td>";	
		break;
		case 'join_tipo':
			$stringa_ret="<td>".get_tipo($row[$nomeDb])."</td>";
		break;
		case 'join':
			$postiLiberi=floor(get_posti_liberi($row[$nomeDb],"pro"));
			//echo "postiliberi".$postiLiberi;
			
			if($postiLiberi<0){
				
				$iscritti=abs($postiLiberi);
			}
			else $iscritti=floor($row['pro_max_iscritti'])-$postiLiberi;
			$stringa_ret="<td>".($iscritti)."/".$row['pro_max_iscritti']." max <br/> <a href='iscritti_provini.php?pro_id=".$row[$nomeDb]."&titolo=".$row['pro_titolo']."'>Iscritti</a></td>";
		break;
		case 'img_nr':
		case 'img':
			for($j=0;$j<count($array);$j++){
				if(strcmp($array[$j]->nomeDB, $nomeDb)==0)break;
			}
			$arrImg= preg_split("/;/", $row[$nomeDb]);
			$stringa_ret="<td>";
			for($i=0;$i<count($arrImg)-1;$i++){
				$stringa_ret.="<div class='divImgP' >
						<img class='imgPrev' title='".$arrImg[$i]."' src='../../../img/".$arrImg[$i]."'>
						<br/>";
						if(($i)>floor($array[$j]->fileMinNumber)||$array[$j]->obbligatorio==false)
						$stringa_ret.="<img class='delP' onclick='eliminaFiles(\"".$nomeDb."\",\"".$template."\",\"".$arrImg[$i]."\",\"".$id."\",\"img\")' src='".LOCAL."/admin/img/elimina.png'>";
				$stringa_ret.="	</div>";
			}
			$stringa_ret.="</td>";
			break;
		case 'data':
			$stringa_ret="<td>".date("d-m-Y",strtotime($row[$nomeDb]))."</td>";
		break;
		case 'int':;
		case 'txt':
			$stringa_ret="<td>".substr($row[$nomeDb],0,100)."</td>";
			break;

		case 'textarea':
			$stringa_ret="<td>".substr(strip_tags($row[$nomeDb]),0,100)."</td>";
			break;
		case 'select':
			$stringa_ret="<td>".substr(strip_tags($row[$nomeDb]),0,100)."</td>";
			break;
		case 'select_gabri':
			global $conn_id;
			$sql = "SELECT ".$indice->ext_field." FROM ".$indice->ext_tab." WHERE id = ".$row[$nomeDb];
			$result = mysqli_query($conn_id,$sql);

			$val = mysqli_fetch_array($result)["nome"];
			$stringa_ret="<td>".substr(strip_tags($val),0,100)."</td>";
			break;
		case 'associazione':
			$id_plus_ass="";
			if(!empty($indice->dipendeDa))$id_plus_ass.="id=".$row[$indice->dipendeDa];
			if(!empty($id_plus_ass))$id_plus_ass.="&";
			if(!empty($indice->nomeDB))$id_plus_ass.="id_plus=".$row[$indice->nomeDB];
			if(!empty($id_plus_ass))$id_plus_ass="?".$id_plus_ass;
			$stringa_ret="
			<td>
				<a href='".$indice->nomePost.$id_plus_ass."'>".$indice->value."</a>
			</td>";
			break;
		case 'file':
			for($j=0;$j<count($array);$j++){
				if(strcmp($array[$j]->nomeDB, $nomeDb)==0)break;
			}
			$arrImg= preg_split("/;/", $row[$nomeDb]);
			$stringa_ret="<td>";
			for($i=0;$i<count($arrImg)-1;$i++){
				$stringa_ret.="
					<div class='divImgP' >
						<a target='blanck' href='../../../files/".$arrImg[$i]."'><img class='fileP' title='".$arrImg[$i]."' src='../../img/file.png'></a>
						<br/>";
						if(($i)>floor($array[$j]->fileMinNumber)||$array[$j]->obbligatorio==false)
						$stringa_ret.="<img class='delP' onclick='eliminaFiles(\"".$nomeDb."\",\"".$template."\",\"".$arrImg[$i]."\",\"".$id."\",\"file\")' src='".LOCAL."/admin/img/elimina.png'>";
					$stringa_ret.="</div>";
			}		
			$stringa_ret.="</td>";
			break;
		case 'radio':
			 $stringa_ret="<td>"; 
			 	if(floor($row[$nomeDb])==1) $stringa_ret.= "Artista In Esclusiva";  
			 	else $stringa_ret.= "Artista In Distribuzione"; 
			 $stringa_ret.="</td>";
			break;
		default:
			# code...
			break;
	}
	return $stringa_ret;
}
function returnFullSize($stringa){
	$arrImg= preg_split("/\./", $stringa);
	return $arrImg[0]."FullSize.".$arrImg[1];
}
function find_extension($filename) {
  $revfile = strrev($filename);
  $extension = strtolower( strrev(substr($revfile,0,strpos($revfile,"."))) );
  return $extension;
}
function safe_filename($filename='',$random='') {
  // sostituisco gli spazi (anche multipli) con _
  $return = str_replace (" ", "_", $filename);
  $conversion_table=array(
    "è" => "e",
    "é" => "e",
    "à" => "a",
    "ì" => "i",
    "ù" => "u",
    "ò" => "o",
    "'" => "_",
    "\"" => "_");

  // Sostituisco tutti i caratteri che fanno da chiavi in $conversion_table con i relativi valori
  // Sistema molto comodo per mantenere/convertire i caratteri con una certa liberta'.
  $return = str_replace (array_keys ($conversion_table),
  array_values ($conversion_table),$return);
  // Elimino tutti i caratteri indesiderati.
  //$return = preg_replace ("/([[:alnum:]_\.-]*)/", "", $return);
  $replace="_";
  $pattern="/([[:alnum:]_\.-]*)/";
  $return=str_replace(str_split(preg_replace($pattern,$replace,$return)),$replace,$return);
  // Nel caso in cui vi siano "_" multipli li sostituisco con uno singolo, un po' "piu' bello" da vedere.
 // $return = preg_replace ("_+", "_", $return);

  if (!empty($random)) {
    $temp_name=substr($return,0,-4);
    $extension=find_extension($return);
    $return=$temp_name.'_'.rand().'.'.$extension;
  }
  return $return;
}
//todo campo id
function controllaForm($v,$template,$update, $idUtils="id"){
	ini_set('memory_limit', '-1');
	$files="";
	$immagini="";
	$files2="";
	$immagini2="";
	$imgPresente=false;
	$filePresente=false;
	global $conn_id;
	/*
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	echo "<pre>";
	print_r($_FILES);
	echo "</pre>";
	echo "<pre>";
	print_r($v);
	echo "</pre>";
	*/
	if($update==""){
		$sql="INSERT INTO ".$template."(";
		$sql2=" VALUES (";
	}
	else{
		$ris=mysqli_query($conn_id,"SELECT * FROM ".$template." WHERE ".$idUtils."=".$update);
		//echo "SELECT * FROM ".$template." WHERE ".$idUtils."=".$update;
		$row2=mysqli_fetch_array($ris);
		$sql="UPDATE ".$template." SET ";
		$sql2=" WHERE ".$idUtils."=".$update;
	}
	for($i=0;$i<count($v);$i++){
		if(isset($_POST[$v[$i]->nomePost])){
			if($update=="") $sql.=$v[$i]->nomeDB;
			else $sql.=$v[$i]->nomeDB."=";
			if(!$v[$i]->obbligatorio||$_POST[$v[$i]->nomePost]!=""){
				if($_POST[$v[$i]->nomePost]!=""){
					//---------------
						if($v[$i]->tipo!="textarea2"){
							$_POST[$v[$i]->nomePost]=strip_tags($_POST[$v[$i]->nomePost],"<a><p><b><em><table><tbody><tr><td><ol><ul><li><strong><br>");
							$_POST[$v[$i]->nomePost]= str_replace('"',"&quot;",$_POST[$v[$i]->nomePost]);
						}
						$_POST[$v[$i]->nomePost] =mysqli_real_escape_string($conn_id,$_POST[$v[$i]->nomePost]);
					//
					if($v[$i]->txtMinSize!=""&&strlen($_POST[$v[$i]->nomePost])<$v[$i]->txtMinSize){
						return "il Campo ".$v[$i]->nome." deve contenere almeno ".$v[$i]->txtMinSize." caratteri";
						
					}
					if($v[$i]->txtMaxSize!=""&&strlen($_POST[$v[$i]->nomePost])>$v[$i]->txtMaxSize){
						return "il Campo ".$v[$i]->nome." non può contenere più di ".$v[$i]->txtMaxSize." caratteri";
						
					}
					if($v[$i]->txtMatchRegExp!=""&&!(preg_match($v[$i]->txtMatchRegExp,$_POST[$v[$i]->nomePost]) ) ){
						return "il Campo ".$v[$i]->nome." non è nella forma indicata";
						
					}
					if($v[$i]->txtBadRegExp!=""&&preg_match($v[$i]->txtBadRegExp,$_POST[$v[$i]->nomePost] ) ){
						return "il Campo ".$v[$i]->nome." non può contenere caratteri questi caratteri ".$v[$i]->txtBadRegExp;
						
					}

					if($v[$i]->permalink!=""){
						$cond_permalink="";
						$trovato=false;
						if($update!=""){
							$cond_permalink=" AND ".$idUtils."!=".$update;
							$sql_permalink="SELECT * FROM $template WHERE ".$idUtils."=".$update;
							if($ris_permalink=mysqli_query($conn_id,$sql_permalink)){
								$row_update_permalink=mysqli_fetch_array($ris_permalink);

								if($_POST[$v[$i]->nomePost]!=$row_update_permalink[$v[$i]->nomeDB]){
									$permalink=permalink($_POST[$v[$i]->nomePost],"'");
								}
								else{
									
									$permalink=$row_update_permalink[$v[$i]->permalink];
									$trovato=true;
								}
							}
							else{
								return "Errore:".mysqli_error($conn_id);
							}
						} 
						else $permalink=permalink($_POST[$v[$i]->nomePost],"'");
						
						while(!$trovato){
							$sql_permalink="SELECT * FROM $template WHERE ".$v[$i]->permalink."='".$permalink."'".$cond_permalink;
							if($ris_permalink=mysqli_query($conn_id,$sql_permalink)){
								if(mysqli_num_rows($ris_permalink)>0){
									$permalink.="-".rand(1,1000);
								}
								else $trovato=true;
							}
							else{
								return "Errore:".mysqli_error($conn_id);
							}
						}
						$v[$i]->valuePermalink="'".$permalink."'";
						
					}



				}
				else{
					if($v[$i]->dipendeDa!="" && $_POST[$v[floor($v[$i]->dipendeDa)]->nomePost]!="" && (strcmp($v[$i]->valDip, "pieno")==0||strcmp($v[$i]->valDip, $_POST[$v[floor($v[$i]->dipendeDa)]->nomePost])==0)){
						return "Per questa situazione il Campo ".$v[$i]->nome." è obbligatorio";
					}
				}
				if($_POST[$v[$i]->nomePost]==""){
					$v[$i]->value="'".$_POST[$v[$i]->nomePost]."'";
					/*
					switch($v[$i]->tipo){
						case "int":;
						case "numero":
							$v[$i]->value="'".$_POST[$v[$i]->nomePost]."'"; 
						break;
						case "img":; 
						case "file":; 
						case "txt":
							 	$v[$i]->value="'".$_POST[$v[$i]->nomePost]."'";
						break;
					}
					*/
					if($update=="") $sql2.="''";
					else $sql.="'',";
				}
				else{
					switch($v[$i]->tipo){
						case "radio":;
						case "int":;
						case "join_tipo":;
						case "numero":
							$v[$i]->value=$_POST[$v[$i]->nomePost];
							if($update=="")	
								$sql2.=$_POST[$v[$i]->nomePost]; 
							else $sql.=$_POST[$v[$i]->nomePost].",";
						break;
						case "img_nr":;
						case "img":; 
						case "file":;
						case "textarea":;
						case "textarea2":;
						case "select":;
						case "select_gabri":;
						case "permalink":;
						case "txt":
							$v[$i]->value="'".$_POST[$v[$i]->nomePost]."'"; 	
							if($update=="")	
								$sql2.="'".$_POST[$v[$i]->nomePost]."'"; 
							else $sql.="'".$_POST[$v[$i]->nomePost]."',";
						break;
						case'data':

							$v[$i]->value="'".$_POST["an_".$v[$i]->nomeDB]."-".$_POST["ms_".$v[$i]->nomeDB]."-".$_POST["gn_".$v[$i]->nomeDB]."'";
							if($update=="")	
								$sql2.="'".$_POST["an_".$v[$i]->nomeDB]."-".$_POST["ms_".$v[$i]->nomeDB]."-".$_POST["gn_".$v[$i]->nomeDB]."'"; 
							else $sql.="'".$_POST["an_".$v[$i]->nomeDB]."-".$_POST["ms_".$v[$i]->nomeDB]."-".$_POST["gn_".$v[$i]->nomeDB]."'".",";
							
						break;
					}
					//$v[$i]->value=cleanDbInput($v[$i]->value);
				}

			}
			else {
				return "il Campo ".$v[$i]->nome." è obbligatorio";
				
			}
		}
		else{
			$v[$i]->value.="'";
			if($update!="")$sql.=$v[$i]->nomeDB."=";
			$nome=$v[$i]->nomePost;
			if($update!=""){
				$fileF=$row2[$v[$i]->nomeDB];
				$fileS=preg_split("/;/", $fileF);
			}
			if($v[$i]->fileMaxNumber=="")$n=1;
			else $n=$v[$i]->fileMaxNumber;
			$cont=0;
			for($j=0;$j<$n;$j++){
				//print_r($fileS);
				if($update!=""){
					if(!isset($_FILES[$nome.$j])&&(isset($fileS[$j])&&$fileS[$j]!="")){
						if(!strcmp($nome, $v[$i]->nomeDB."imgF")) $immagini.=$fileS[$j].";";
						else $files.=$fileS[$j].";";
					}
					if(isset($_FILES[$nome.$j])||(isset($fileS[$j])&&$fileS[$j]!="")){
						$cont++;
					}

				}	
				else{ 
					if(isset($_FILES[$nome.$j])&&is_uploaded_file($_FILES[$nome.$j]["tmp_name"]))$cont++;
				}
			}
			if($v[$i]->obbligatorio&&$cont==0) return "il Campo ".$v[$i]->nome." è obbligatorio";
			if(($v[$i]->obbligatorio||$cont!=0)&&($cont<$v[$i]->fileMinNumber)) return "Devi inserire almeno ".$v[$i]->fileMinNumber." ".$v[$i]->nome;
			if($cont>$n) return "Non puoi inserire più di  ".$v[$i]->fileMaxNumber." ".$v[$i]->nome;
			for($j=0;$j<$n;$j++){
				if (isset($_FILES[$nome.$j])){
					//echo $_FILES[$nome.$j]["name"];
					if($update=="" || ($update!="" && $_FILES[$nome.$j]['error']!=UPLOAD_ERR_NO_FILE)){
						if( $_FILES[$nome.$j]['error']!=UPLOAD_ERR_OK){
							 
							if ($_SERVER['REQUEST_METHOD'] == 'POST') {
							    $name     = $_FILES[$nome.$j]['name'];
							    $type     = $_FILES[$nome.$j]['type'];
							    $tmp_name = $_FILES[$nome.$j]['tmp_name'];
							    $error    = $_FILES[$nome.$j]['error'];
							    $size     = $_FILES[$nome.$j]['size'];
							 
							    switch ($error) {
							        case UPLOAD_ERR_OK:
							            $response = 'There is no error, the file uploaded with success.';
							            break;
							        case UPLOAD_ERR_INI_SIZE:
							            $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
							            break;
							        case UPLOAD_ERR_FORM_SIZE:
							            $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
							            break;
							        case UPLOAD_ERR_PARTIAL:
							            $response = 'The uploaded file was only partially uploaded.';
							            break;
							        case UPLOAD_ERR_NO_FILE:
							            $response = 'No file was uploaded.'.$v[$i]->nome;
							            break;
							        case UPLOAD_ERR_NO_TMP_DIR:
							            $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
							            break;
							        case UPLOAD_ERR_CANT_WRITE:
							            $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
							            break;
							        case UPLOAD_ERR_EXTENSION:
							            $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
							            break;
							        default:
							            $response = 'Unknown error';
							            break;
							    }
							 
							    return $response;
							}
						}
						if ($_FILES[$nome.$j]['size'] > $v[$i]->fileMaxSize) {
							return "il File ".$_FILES[$nome.$j]["name"]." supera la dimensione massima fissata di ".$v[$i]->fileMaxSize;
						}
						if($v[$i]->fileTipiAmmissibili!=""){
							$copyTipi = preg_split("/;/", $v[$i]->fileTipiAmmissibili);
							for($z=0;$z<count($copyTipi);$z++){
								$valid_exts[]=$copyTipi[$z];
							} 
							$ext = strtolower(pathinfo($_FILES[$nome.$j]['name'], PATHINFO_EXTENSION));
							if (!in_array($ext, $valid_exts)) return "il File ".$_FILES[$nome.$j]["name"]." non è in uno di questi formati ".$v[$i]->fileTipiAmmissibili;
						}
						//inizio upload
						$path="../../../../";
						$fullPath="";
						if(strcmp($nome, $v[$i]->nomeDB."imgF")==0){
							if($v[$i]->tipo=="img"){
								$imgPresente=true;
								//todo
									$dimensioni=preg_split("/;/", $_POST["dimensionia".$v[$i]->nomeDB.$j]);
									$nw = $dimensioni[0];
									$nh = $dimensioni[1]; # image with # height
									$size = getimagesize($_FILES[$nome.$j]['tmp_name']);
									$crop = preg_split("/;/", $_POST[$v[$i]->nomeDB."hidden_img".$j]);
									$x = (int) $crop[0];
									$y = (int)  $crop[1];
									$w = (int) $crop[2] ?  $crop[2] : $size[0];
									$h = (int)  $crop[3] ?  $crop[3] : $size[1];
									if($crop[0]!=""){
										$dimensioneImg=preg_split("/;/", $_POST[$v[$i]->nomeDB."dimensioneImg".$j]);
										$w=(int)($size[0] * $w)/$dimensioneImg[0];
										$h=(int)($size[1] * $h)/$dimensioneImg[1];
										$x=(int)($size[0] * $x)/$dimensioneImg[0];
										$y=(int)($size[1] * $y)/$dimensioneImg[1];
									}
									$data = file_get_contents($_FILES[$nome.$j]['tmp_name']);
									$vImg = imagecreatefromstring($data);
									$dstImg = imagecreatetruecolor($nw, $nh);
									imagealphablending( $dstImg, false );
									imagesavealpha( $dstImg, true );
									//$black = imagecolorallocate($dstImg, 0, 0, 0);
									// Make the background transparent
									//imagecolortransparent($dstImg);
									$indice=0;
									//$fullPath=$v[$i]->percorsoFile."/";
									//$fullPath.=safe_filename(strtolower($_FILES[$nome.$j]['name']));
									
									/*while (file_exists($path."img/".$v[$i]->percorsoFile."/img_".$indice."_".$v[$i]->percorsoFile.".".$ext)) {
										$indice++;
									}
									*/
									$nomeimmagine=preg_split("/.".$ext."/", strtolower($_FILES[$nome.$j]['name']));
									$fullPath=$v[$i]->percorsoFile."/".permalink($nomeimmagine[0])."_".$indice.".".$ext;
									while (file_exists($path."img/".$fullPath)) {
										$indice++;
										$nomeimmagine=preg_split("/.".$ext."/", strtolower($_FILES[$nome.$j]['name']));
										$fullPath=$v[$i]->percorsoFile."/".permalink($nomeimmagine[0])."_".$indice.".".$ext;
									}
									if($update!="" && $fileS[$j]!=""){
										@unlink("../../../../img/".$fileS[$j]);
										@unlink("../../../../img/".returnFullSize($fileS[$j]));
									}
									$nomeimmagine=preg_split("/.".$ext."/", strtolower($_FILES[$nome.$j]['name']));
									$fullsize=$v[$i]->percorsoFile."/".permalink($nomeimmagine[0])."_".$indice."FullSize.".$ext;
									$fullsizeGif=$v[$i]->percorsoFile."/".permalink($nomeimmagine[0])."_".$indice."asd.".$ext;
									if($ext!="gif"){
										if(!move_uploaded_file($_FILES[$nome.$j]['tmp_name'], $path."img/".$fullsize)){

										   return "Si &egrave; verificato un errore durante il salvataggio del file";
										}
										imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
										//imagejpeg($dstImg, $path."img/".$v[$i]->percorsoFile."/img_".$indice."_".$v[$i]->percorsoFile.".".$ext);
										imagejpeg($dstImg, $path."img/".$fullPath,70);
										imagedestroy($dstImg);
									}
									else{
										if(!move_uploaded_file($_FILES[$nome.$j]['tmp_name'], $path."img/".$fullPath)){

										   return "Si &egrave; verificato un errore durante il salvataggio del file";
										}
										imagecopyresampled($dstImg, $vImg, 0, 0, $x, $y, $nw, $nh, $w, $h);
										//imagejpeg($dstImg, $path."img/".$v[$i]->percorsoFile."/img_".$indice."_".$v[$i]->percorsoFile.".".$ext);
										imagejpeg($dstImg, $path."img/".$fullsize,70);
										imagedestroy($dstImg);
									}
									$immagini.=$fullPath.";";
									
									$v[$i]->value.=$fullPath.";";
									
									//echo $v[$i]->value;
							}
							elseif($v[$i]->tipo=="img_nr"){
								$indice=0;
								$fullPath=$v[$i]->percorsoFile."/";
								$fullPath.=permalink(substr(strtolower($_FILES[$nome.$j]['name']), -strlen($_FILES[$nome.$j]['name']),-strlen($ext))).".".$ext;
								while (file_exists($path."files/".$fullPath)) {
									$fullPath=$v[$i]->percorsoFile."/".permalink(basename(strtolower($fullPath),".".$ext))."_".$indice.".".$ext;
									$indice++;
								}
								if($update!="" && $fileS[$j]!=""){
									unlink("../../../../img/".$fileS[$j]);
								}
								if(!move_uploaded_file($_FILES[$nome.$j]['tmp_name'], $path."img/".$fullPath)){

								   return "Si &egrave; verificato un errore durante il salvataggio del file";
								}
								$files.=$fullPath.";";

								$v[$i]->value.=$fullPath.";";
							}
						}
						else{
							$filePresente=true;
							$indice=0;
							$fullPath=$v[$i]->percorsoFile."/";
							$fullPath.=permalink(substr(strtolower($_FILES[$nome.$j]['name']), -strlen($_FILES[$nome.$j]['name']),-strlen($ext))).".".$ext;
							while (file_exists($path."files/".$fullPath)) {
								$fullPath=$v[$i]->percorsoFile."/".permalink(substr(strtolower($_FILES[$nome.$j]['name']), -strlen($_FILES[$nome.$j]['name']),-strlen($ext)))."_".$indice.".".$ext;
								$indice++;
							}
							if($update!="" && $fileS[$j]!=""){
								unlink("../../../../files/".$fileS[$j]);
							}
							if(!move_uploaded_file($_FILES[$nome.$j]['tmp_name'], $path."files/".$fullPath)){

							   return "Si &egrave; verificato un errore durante il salvataggio del file";
							}
							$files.=$fullPath.";";

							$v[$i]->value.=$fullPath.";";
							
						}
					}
					if($update!=""){
						if( $_FILES[$nome.$j]['error']==UPLOAD_ERR_NO_FILE){
							if(!strcmp($nome, $v[$i]->nomeDB."imgF")){
								if($fileS[$j]!=""){
									$v[$i]->value.=$fileS[$j].";";
									$immagini.=$fileS[$j].";";
								}
							} 
							else{
								if($fileS[$j]!=""){	
									$v[$i]->value.=$fileS[$j].";";
									$files.=$fileS[$j].";";
								}
							} 
						}
					}
				}
			}

			if($update!=""){
				if($immagini!=""){
					$sql.="'".$immagini."',";
					$immagini="";
				}
				else {
					$sql.="'".$files."',";
					$files="";
				}
			}
			$v[$i]->value.="'";
		}
		if($update==""){
			if($i!=1&&$v[$i]->nomeDB!="img"&&$v[$i]->nomeDB!="file"){
				$sql.=",";
				$sql2.=",";
			}
		}
		

	}
	if($imgPresente){
		
		if($update!=""){
			
		}
		else{
			$sql.=",img";
			$sql2.=",'".$immagini."'";
		}
	}
	if($filePresente){
		if($update==""){
			$sql.=",file";
			$sql2.=",'".$files."'";
		}
	}
	if($update==""){
		$sql.=")";
		$sql2.=")";
	}
	else{
		$sql=substr($sql, 0,strlen($sql)-1);
	}

	//echo $sql.$sql2;

	if($update==""){
		$sql="INSERT INTO ".$template."(";
		$sql2=" VALUES (";
		for($i=0;$i<count($v);$i++){
			if($v[$i]->permalink!=""&&$v[$i]->valuePermalink!=""){
				$sql.=$v[$i]->permalink.",";
				$sql2.=$v[$i]->valuePermalink.",";
			}
			$sql.=$v[$i]->nomeDB.",";
			$sql2.=$v[$i]->value.",";
			//echo "DB:".$v[$i]->nomeDB." valore=".$v[$i]->value."<br/>";
		}
		$sql=substr($sql, 0,strlen($sql)-1);
		$sql2=substr($sql2, 0,strlen($sql2)-1);
		$sql.=")";
		$sql2.=")";
		//echo $sql.$sql2."<br/>";
		if(!mysqli_query($conn_id,$sql.$sql2))
			return "Errore nel salvataggio su DB".mysqli_error($conn_id);
		return "Dati Salvati";
	}
	else{
		//echo $sql.$sql2."<br/>";
		$sql="UPDATE ".$template." SET ";
		$sql2=" WHERE ".$idUtils."=".$update;
		for($i=0;$i<count($v);$i++){
			if($v[$i]->permalink!=""&&$v[$i]->valuePermalink!=""){
				$sql.=$v[$i]->permalink."=".$v[$i]->valuePermalink.",";
			}
			$sql.=$v[$i]->nomeDB."=".$v[$i]->value.",";
		}
		$sql=substr($sql, 0,strlen($sql)-1);
		//echo "<br/>".$sql.$sql2."<br/>";
		if(!mysqli_query($conn_id,$sql.$sql2))
			return " Errore su DB durante la modifica".mysqli_error($conn_id);
		return "Dati Aggiornati";
		
		
	}
	/*if($update==""){
		if(!mysql_query($sql." ".$sql2))
			return "Errore nel salvataggio su DB".mysqli_error($conn_id);
		return "Dati Salvati";
	}
	else{
		if(!mysql_query($sql.$sql2))
			return " Errore su DB durante la modifica".mysqli_error($conn_id);
		return "Dati Aggiornati";
	}
	 */
}
function preventSQLINJ($arrPars){
 return false;
 foreach($arrPars as $k=>$v){
  if(!empty($v)){
  if(preg_match('/\s/', $v)) 
   exit('attack 1'); // no whitespaces
  if(preg_match('/[\'"]/', $v)) 
   exit('attack 2'); // no quotes
  /*if(preg_match('/(and|or|null|not)/i', $v)) 
   exit('attack 4'); // no sqli boolean keywords*/
  if(preg_match('/(union|select|from|where)/i', $v)) 
   exit('attack 5'); // no sqli select keywords
  if(preg_match('/(group|order|having|limit)/i', $v)) 
   exit('attack 6'); //  no sqli select keywords
  if(preg_match('/(into|file|case)/i', $v)) 
   exit('attack 7'); // no sqli operators
  if(preg_match('/(--|#|\/\*)/', $v)) 
   exit('attack 8'); // no sqli comments
  if(preg_match('/(=|&|\|)/', $v)) 
   exit('attack 9'); // no boolean operators
  }
 }
}
function cleanDbInput($value, $dove=null){
 if(!empty($dove)){
  $banlist = array (
   "insert into", "select", "update", "delete", "distinct", "having", "truncate", "replace",
   "handler", "like", "procedure", "limit", "order by", "group by"
  );
 } else {
  $banlist = array ("");
 }
 $replace=trim(str_replace($banlist,'',$value));
 
 if($replace!=trim($value)){
  return TABELLE_INJECTION;
 } else { 
  $value = trim($value);
  $value = str_replace('"',"&quot;",$value);
  $value = str_replace("'","&rsquo;",$value);
  //$value = addslashes($value);
  $value = htmlentities($value,ENT_NOQUOTES,"utf-8");  
  return $value;
 }
}
/*function permalink($string) {
	$string = strtolower($string);
	$string = preg_replace("/[^0-9A-Za-z ]/", "", $string);
	$string = str_replace(" ", "-", $string);
	while (strstr($string, "--")) {
	$string = preg_replace("/--/", "-", $string);
			}
	return(strtolower($string));
}*/
setlocale(LC_ALL, 'en_US.UTF8');
function permalink($str, $replace=array(), $delimiter='-') {
	$str=trim($str);
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return trim($clean,"-");
}
function genera_data($nomeCampoDB,$anno,$mese,$giorno){
$stringa='<select style="width:50px;" class="" id="gn_'.$nomeCampoDB.'" name="gn_'.$nomeCampoDB.'" >
<option value="" ></option>
<option ';if(strcmp($giorno, "01")==0) $stringa.='selected '; $stringa.='value="1">1</option>
<option ';if(strcmp($giorno, "02")==0) $stringa.='selected '; $stringa.='value="2">2</option>
<option ';if(strcmp($giorno, "03")==0) $stringa.='selected '; $stringa.='value="3">3</option>
<option ';if(strcmp($giorno, "04")==0) $stringa.='selected '; $stringa.='value="4">4</option>
<option ';if(strcmp($giorno, "05")==0) $stringa.='selected '; $stringa.='value="5">5</option>
<option ';if(strcmp($giorno, "06")==0) $stringa.='selected '; $stringa.='value="6">6</option>
<option ';if(strcmp($giorno, "07")==0) $stringa.='selected '; $stringa.='value="7">7</option>
<option ';if(strcmp($giorno, "08")==0) $stringa.='selected '; $stringa.='value="8">8</option>
<option ';if(strcmp($giorno, "09")==0) $stringa.='selected '; $stringa.='value="9">9</option>
<option ';if(strcmp($giorno, "10")==0) $stringa.='selected '; $stringa.='value="10">10</option>
<option ';if(strcmp($giorno, "11")==0) $stringa.='selected '; $stringa.='value="11">11</option>
<option ';if(strcmp($giorno, "12")==0) $stringa.='selected '; $stringa.='value="12">12</option>
<option ';if(strcmp($giorno, "13")==0) $stringa.='selected '; $stringa.='value="13">13</option>
<option ';if(strcmp($giorno, "14")==0) $stringa.='selected '; $stringa.='value="14">14</option>
<option ';if(strcmp($giorno, "15")==0) $stringa.='selected '; $stringa.='value="15">15</option>
<option ';if(strcmp($giorno, "16")==0) $stringa.='selected '; $stringa.='value="16">16</option>
<option ';if(strcmp($giorno, "17")==0) $stringa.='selected '; $stringa.='value="17">17</option>
<option ';if(strcmp($giorno, "18")==0) $stringa.='selected '; $stringa.='value="18">18</option>
<option ';if(strcmp($giorno, "19")==0) $stringa.='selected '; $stringa.='value="19">19</option>
<option ';if(strcmp($giorno, "20")==0) $stringa.='selected '; $stringa.='value="20">20</option>
<option ';if(strcmp($giorno, "21")==0) $stringa.='selected '; $stringa.='value="21">21</option>
<option ';if(strcmp($giorno, "22")==0) $stringa.='selected '; $stringa.='value="22">22</option>
<option ';if(strcmp($giorno, "23")==0) $stringa.='selected '; $stringa.='value="23">23</option>
<option ';if(strcmp($giorno, "24")==0) $stringa.='selected '; $stringa.='value="24">24</option>
<option ';if(strcmp($giorno, "25")==0) $stringa.='selected '; $stringa.='value="25">25</option>
<option ';if(strcmp($giorno, "26")==0) $stringa.='selected '; $stringa.='value="26">26</option>
<option ';if(strcmp($giorno, "27")==0) $stringa.='selected '; $stringa.='value="27">27</option>
<option ';if(strcmp($giorno, "28")==0) $stringa.='selected '; $stringa.='value="28">28</option>
<option ';if(strcmp($giorno, "29")==0) $stringa.='selected '; $stringa.='value="29">29</option>
<option ';if(strcmp($giorno, "30")==0) $stringa.='selected '; $stringa.='value="30">30</option>
<option ';if(strcmp($giorno, "31")==0) $stringa.='selected '; $stringa.='value="31">31</option>
</select>    <select style="width:100px;" class="text" id="ms_'.$nomeCampoDB.'" name="ms_'.$nomeCampoDB.'">
<option value="" selected=""></option>
<option ';if(strcmp($mese, "01")==0) $stringa.='selected '; $stringa.='value="1">Gennaio</option>
<option ';if(strcmp($mese, "02")==0) $stringa.='selected '; $stringa.='value="2">Febbraio</option>
<option ';if(strcmp($mese, "03")==0) $stringa.='selected '; $stringa.='value="3">Marzo</option>
<option ';if(strcmp($mese, "04")==0) $stringa.='selected '; $stringa.='value="4">Aprile</option>
<option ';if(strcmp($mese, "05")==0) $stringa.='selected '; $stringa.='value="5">Maggio</option>
<option ';if(strcmp($mese, "06")==0) $stringa.='selected '; $stringa.='value="6">Giugno</option>
<option ';if(strcmp($mese, "07")==0) $stringa.='selected '; $stringa.='value="7">Luglio</option>
<option ';if(strcmp($mese, "08")==0) $stringa.='selected '; $stringa.='value="8">Agosto</option>
<option ';if(strcmp($mese, "09")==0) $stringa.='selected '; $stringa.='value="9">Settembre</option>
<option ';if(strcmp($mese, "10")==0) $stringa.='selected '; $stringa.='value="10">Ottobre</option>
<option ';if(strcmp($mese, "11")==0) $stringa.='selected '; $stringa.='value="11">Novembre</option>
<option ';if(strcmp($mese, "12")==0) $stringa.='selected '; $stringa.='value="12">Dicembre</option>
</select>    <select style="width:75px;" class="text" id="an_'.$nomeCampoDB.'" name="an_'.$nomeCampoDB.'">
<option value="" selected=""></option>
<option ';if(strcmp($anno, "2013")==0) $stringa.='selected '; $stringa.='value="2013">2013</option>
<option ';if(strcmp($anno, "2014")==0) $stringa.='selected '; $stringa.='value="2014">2014</option>
<option ';if(strcmp($anno, "2015")==0) $stringa.='selected '; $stringa.='value="2015">2015</option>
<option ';if(strcmp($anno, "2016")==0) $stringa.='selected '; $stringa.='value="2016">2016</option>
<option ';if(strcmp($anno, "2017")==0) $stringa.='selected '; $stringa.='value="2017">2017</option>
<option ';if(strcmp($anno, "2018")==0) $stringa.='selected '; $stringa.='value="2018">2018</option>
<option ';if(strcmp($anno, "2019")==0) $stringa.='selected '; $stringa.='value="2019">2019</option>
<option ';if(strcmp($anno, "2020")==0) $stringa.='selected '; $stringa.='value="2020">2020</option>
<option ';if(strcmp($anno, "2021")==0) $stringa.='selected '; $stringa.='value="2021">2021</option>
<option ';if(strcmp($anno, "2022")==0) $stringa.='selected '; $stringa.='value="2022">2022</option>
<option ';if(strcmp($anno, "2023")==0) $stringa.='selected '; $stringa.='value="2023">2023</option>
</select> 
' ;
return $stringa;
}
?>