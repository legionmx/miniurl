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
        
        echo'<pre>';
        print_r($result);  
        
        $fields = count($result);

        $headers = array();
        for ($i = 0; $i < $fields; $i++) {
            $headers[] = mysql_field_name($result , $i);
        }
        
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/miniurl/miniurl/csv/downloads/midescarga.csv', 'w');
        
        if ($fp && $result) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="export.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');
            fputcsv($fp, $headers);
            
            while ($row = count($result)) {
                fputcsv($fp, array_values($row));
            }
            
        }
        
    }
    
    
}


?>