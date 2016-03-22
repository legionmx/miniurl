<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
include('../class/alias.php');
include('../class/Register.php');

switch ($_GET['method']) {
	case 'transformCsv':
			FileUp::transformCsv();
		break;
	
}

class FileUp{

	static function readCsv(){
		
		$target_dir = $_SERVER['DOCUMENT_ROOT'] .  "/csv/";
		$uniq = date("d-m-y") . '-' . time() . '-' .  substr(md5($_FILES["fileToUpload"]["name"]),0,8);
		$target_file = $target_dir . $uniq .  basename($_FILES["fileToUpload"]["name"]);
		$registros = array();

		if (($fichero = fopen($target_file, "r")) !== FALSE) {

		    // Lee los nombres de los campos
		    $nombres_campos = fgetcsv($fichero, 0, ",", "\"", "\"");
		    $num_campos = count($nombres_campos);
			
		    // Lee los registros
		    while (($datos = fgetcsv($fichero, 0, ",", "\"", "\"")) !== FALSE) {

		        // Crea un array asociativo con los nombres y valores de los campos
		        for ($icampo = 0; $icampo < $num_campos; $icampo++) {
		            $registro[$nombres_campos[$icampo]] = $datos[$icampo];
		        }

		        // Añade el registro leido al array de registros
		        $registros[] = $registro;
		    }

		    fclose($fichero);
		 
		 
		 
		    echo "<p id='readSms'>" . count($registros) . " records have been read. </p>";
		 	
		 	$regProt = array();
		 	$regUrl = array();
			$regLog = array();
			$categories = array();
			
		    $registers = new Register;
		    
		    
		    for ($i = 0; $i < count($registros); $i++) {
			
			switch ($registros[$i]["protocolo"]){
				case 'http':
					$regProt[$i] = 1;
					break;
				case 'https':
					$regProt[$i] = 2;
					break;
				default:
					$protInsert = $registers->insertProtocols($registros[$i]["protocolo"]);
					$regProt[$i] = $protInsert;
					break;
				
			}
			
			$regLog[$i] = $registros[$i]["log"];
		        $regUrl[$i] = $registros[$i]["url"];
		        $regCode[$i] = $registros[$i]["codigo"];
			$categories[$i] = $registros[$i]["categoria"];

		    }
		    
		    //echo '<pre>'; print_r($registros); die();
		    
		    $regCategories = new Register;
		    $catUniq = array_unique($categories);
		    
		    
		    if(isset($_POST['sameUrl']) && $_POST['sameUrl'] == 'on'){
			
		    	$sameUrl = $_POST['sameUrl'];
			
			if(isset($_POST['url']) && $_POST['url']!=''){
				$regUrl = $_POST['url'];
			}
		    	
			
			if($_POST['protocolo'] > 0 ){
				
				if($_POST['protocolo'] == 3){
					$protInsert = $registers->insertProtocols($_POST['prot_propio']);
					$regProt = $protInsert;
				}else{
					$regProt = $_POST['protocolo'];
				}
			}
			
			
			if($_POST['category'] == 0 && $_POST['category'] != 'off'){
				$insertCat = $regCategories->insertCategories($_POST['category_new']);
				$selectCat = $regCategories->getCategories();
				$catId = $selectCat[$_POST['category_new']];
				
			}elseif($_POST['category'] > 0 && $_POST['category'] != 'off'){
				$catId = $_POST['category'];
			}else{
				$insertCat = $regCategories->insertCategories($catUniq);
				$selectCat = $regCategories->getCategories();
				
	    
				for ($i = 0; $i < count($categories); $i++) {
				
				    $catId[$i] = $selectCat[$categories[$i]];
				
				}
			}
			
			
			if (isset($_POST['conLog'])){
				$regLog = $_POST['conLog'];
			}else{
				$regLog = null;
			}
		    	
		    	
		    }else{
			
			$insertCat = $regCategories->insertCategories($catUniq);
			$selectCat = $regCategories->getCategories();
			
    
			for ($i = 0; $i < count($categories); $i++) {
			
			    $catId[$i] = $selectCat[$categories[$i]];
			
			}
			
			$sameUrl = null;
		    }
		    
		    
		    
		    $getProtocols= $regCategories->getProtocols();
		    
		    $hashAlias = new Alias;
		    $createAlias = $hashAlias->getHash($regProt, $regUrl, $regCode, $sameUrl, $regLog, $catId);
		    $timeStamp = time();
		    $insertAlias = $hashAlias->insertAlias($createAlias, $timeStamp);
		    
		    $totalInserts = count($insertAlias);
		    
		    $insertHeaders = array();
		    
		    foreach ($insertAlias as $rows) {
			
			$insertHeaders['id'] = $rows['id'];
			$insertHeaders['Protocol'] = $rows['cve_protocolo'];
			$insertHeaders['Url'] = $rows['url'];
			$insertHeaders['Alias'] = $rows['hash'];
			$insertHeaders['Code'] = $rows['code'];
			$insertHeaders['Category'] = $rows['id_category'];
			$insertHeaders['Short Url'] = $rows['mini_url'];
		    }
		    
		    $nameCat = $regCategories->getNameCat();
		    
		    include_once($_SERVER['DOCUMENT_ROOT'].'/upload/success.php');

		}
	}

	static function transformCsv (){
		
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/csv/";
		$uniq = date("d-m-y") . '-' . time() . '-' . substr(md5($_FILES["fileToUpload"]["name"]),0,8);
		$target_file = $target_dir . $uniq .  basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		// revisa si ya existe el archivo
		if (file_exists($target_file)) {
		    echo "<p id='errorUpload'>Error, ya existe un archivo con el mismo nombre.</p>";
		    $uploadOk = 0;
		}

		// Checa si el formato es el correcto
		if($imageFileType != "csv") {
		    echo "<p id='errorUpload'>Revisa que la extenci&oacute; sea la correcta, solo se admiten archivos csv.</p>";
		    $uploadOk = 0;
		}

		// si $uploadOk esta seteado a 0 regresar error
		if ($uploadOk == 0) {
		    echo "<p id='errorUpload'>Error, tu archivo no pudo cargarse.<p>";

		// if everything is ok, try to upload file
		} else {

		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        echo "<p id='successUpload'>The file ". basename( $_FILES["fileToUpload"]["name"]). " was uploaded correctly. </p>";
		        FileUp::readCsv();
		    } else {
		        echo "<p id='errorUpload'>Error, hubo un problema al subir tu archivo.</p>";
		    }

		}

	}

}

?>