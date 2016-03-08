<?php

include('../class/alias.php');

switch ($_GET['method']) {
	case 'transformCsv':
			FileUp::transformCsv();
		break;
	
}

class FileUp{

	function readCsv(){

		$target_dir = "../csv/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
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
		 
		    echo "Leidos " . count($registros) . " registros <br>";
		 	
		 	$regProt = array();
		 	$regUrl = array();
		    
		    for ($i = 0; $i < count($registros); $i++) {
		        $regProt[$i] = $registros[$i]["protocolo"];
		        $regUrl[$i] = $registros[$i]["url"];
		        $regCode[$i] = $registros[$i]["codigo"];

		    }

		    if(isset($_POST['sameUrl']) && $_POST['sameUrl'] == 'on'){
		    	$sameUrl = $_POST['sameUrl'];
		    	$regProt = $_POST['protocolo'];
		    	$regUrl = $_POST['url'];
		    	$regLog = $_POST['conLog'];
		    	
		    }

		    $hashAlias = new Alias;
		    $createAlias = $hashAlias->getHash($regProt, $regUrl, $regCode, $sameUrl, $regLog);

		    $insertAlias = $hashAlias->insertAlias($createAlias);

		    

		}
	}

	static function transformCsv (){

		$target_dir = "../csv/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		// revisa si ya existe el archivo
		if (file_exists($target_file)) {
		    echo "Error, ya existe un archivo con el mismo nombre.";
		    $uploadOk = 0;
		}

		// Checa si el formato es el correcto
		if($imageFileType != "csv") {
		    echo "Revisa que la extenci&oacute; sea la correcta, solo se admiten archivos csv.";
		    $uploadOk = 0;
		}

		// si $uploadOk esta seteado a 0 regresar error
		if ($uploadOk == 0) {
		    echo "Error, tu archivo no pudo cargarse.";

		// if everything is ok, try to upload file
		} else {

		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		        FileUp::readCsv();
		    } else {
		        echo "Error, hubo un problema al subir tu archivo.";
		    }

		}

	}

}

?>