<?php
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
		$query = 'select id, cve_protocolo, url, hash, code, id_category from enlaces where activo = 1 and id_user = ' . $uid . ' and id BETWEEN ' . $range_1 . ' AND '. $range_2 ;
	}else{
		$query = 'select id, cve_protocolo, url, hash, code, id_category from enlaces where activo = 1 and id_user = ' . $uid ;
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
		$datos['category'] = $_CATEGORIES[$rows['id_category']];
		
		fputcsv($fp, array_values($datos));
		
	    }
	    
	    $archivo = basename('midescarga.csv');

	    $ruta = $_SERVER['DOCUMENT_ROOT'] . '/csv/downloads/'.$archivo;

	    
	    /*header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="midescarga.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');*/
	    
	    header('Content-Type: application/force-download');
	    header('Content-Disposition: attachment; filename='.$archivo);
	    header('Content-Transfer-Encoding: binary');
	    header('Content-Length: '.filesize($ruta));
	    
	    
	    
	    
        }
        
    }
    
    
}


?>