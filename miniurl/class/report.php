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
        $query = 'select * from enlaces where activo = 1';
        $result = $base->getAll($query);
        
        $registers = count($result);
        
	
	$index = array_keys($result[0]);
	$fields = count($index);
	
	//print_r($index);
	
	
	
	for($i=0; $i< $fields; $i++){
		if(!is_numeric($index[$i])){
			$headers[] = $index[$i];
		}
		
	}
	
		
	
        
	echo '<pre>';
	print_r($headers);
        
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/csv/downloads/midescarga.csv', 'w');
        
        if ($fp && $result) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="midescarga.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
	    
            fputcsv($fp, $headers);
            
	    $j=0;
            foreach ($result as $campos) {
		if(!is_numeric($campos[$j])){
			fputcsv($fp, array_values($campos),8);
		}
		
		$j++;
	    }
            
        }
        
    }
    
    
}


?>