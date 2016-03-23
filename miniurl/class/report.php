<?php

ini_set("log_errors", 1);
ini_set("error_log", "../logs/php-error.log");
error_log( "Logs, errors" );

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
switch ($_GET['method']) {
	case 'csvDownload':
            report::csvDownload();
	break;
	
}

class report {
    
    //public $base = '';
    
    static function csvDownload (){
        
        include("../const.php");
        
	//$this->base = $base;
	
	$uid = $_SESSION['uid'];
	
	if (isset($_POST['rangeIds']) && $_POST['rangeIds'] == 'on'){
		
		$range_1 = $_POST['range1'];
		$range_2 = $_POST['range2'];
		$category  = $_POST['category'];
		if($category == 0 && $range_1 != '' && $range_2 != '' ){
			$query = 'select id, cve_protocolo, url, hash, code, id_category, mini_url from enlaces where activo = 1 and id_user = ' . $uid . ' and id BETWEEN ' . $range_1 . ' AND '. $range_2 ;
			
		}elseif($category > 0 && $range_1 == '' && $range_2 == '' ){
			
			$query = 'select id, cve_protocolo, url, hash, code, id_category, mini_url from enlaces where activo = 1 and id_user = ' . $uid . ' AND id_category ='  . $category ;
		}else{
			
			$query = 'select id, cve_protocolo, url, hash, code, id_category, mini_url from enlaces where activo = 1 and id_user = ' . $uid . ' and id BETWEEN ' . $range_1 . ' AND '. $range_2 . ' AND id_category =' . $category;	
		}
		
	}else{
		$query = 'select id, cve_protocolo, url, hash, code, id_category, mini_url from enlaces where activo = 1 and id_user = ' . $uid ;
	}
	
        $result = array();
        $result = $base->getAll($query);
        $registers = count($result);
	
	$index = array_keys($result[0]);
	$fields = count($index);
	
	
	for($i=0; $i< $fields; $i++){
		if(!is_numeric($index[$i])){
			$headers[] = $index[$i];
		}
		
	}
	
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/csv/downloads/midescarga.csv', 'w');
        
        if ($fp && $result) {
            
            fputcsv($fp, $headers);
            
	    $datos = array();
            foreach ($result as $rows) {
		
		$datos['id'] = $rows['id'];
		$datos['cve_protocolo'] = $rows['cve_protocolo'];
		$datos['url'] = $rows['url'];
		$datos['hash'] = $rows['hash'];
		$datos['code'] = $rows['code'];
		$datos['category'] = $rows['id_category'];
		$datos['mini_url'] = $rows['mini_url'];
		
		fputcsv($fp, array_values($datos));
		
	    }

	    //We close the file before changing its name
	    fflush($fp);
	    fclose($fp);

	    $uniq = date("d-m-y") . '-' . time() . '-' .  substr(md5(time()),0,8);
	    $fileName = $_SERVER['DOCUMENT_ROOT']  . '/csv/downloads/midescarga.csv';
	    $fileNameNew = $_SERVER['DOCUMENT_ROOT'] . '/csv/downloads/Down-' . $uniq . '.csv';
	    
	    $rutaNew = '/csv/downloads/Down-' . $uniq . '.csv';
	    
	    $newRoot = rename ($fileName,$fileNameNew);

	    if(!$newRoot) die("There was a problem moving the file to the download zone");
	    
	    /*header('Content-Type: application/force-download');
	    header('Content-Disposition: attachment; filename='.$archivo);
	    header('Content-Transfer-Encoding: binary');
	    header('Content-Length: '.filesize($ruta));*/
	    
	    header ('Location: ' . $rutaNew);
	    
	    
	    
        }else{
		echo 'no se pudo descargar el archivo';
	}
        
    }
    
    
}


?>