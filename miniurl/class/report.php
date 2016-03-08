<?php

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
        
        $result = array();
        $query = 'select id, cve_protocolo, url, hash, code from enlaces where activo = 1';
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