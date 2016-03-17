<?php

class Register {
   
   public $base = '';
	
    function __construct(){
		//require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
		global $base, $_PROTOCOLOS, $_BASEURL;
		if(!isset($base)||!isset($_PROTOCOLOS)||!isset($_BASEURL)){
			//If after global, the global scope variables are still not set, we include const.php
			require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
		}
		$this->base = $base;
		
    }
    
    function getProtocols() {

		$base = $this->base;
		
		$queryProt = "Select * from cat_protocolo where edo_reg = 1";
		
		$base->SetFetchMode(ADODB_FETCH_ASSOC);
		$protocols = array();
		$protocols = $base->getAll($queryProt);
		
		$nameProtocols = array();
		foreach ($protocols as $rowProt) {
			
			$nameProtocols[$rowProt['clave']] = $rowProt['descripcion'];
		}
		
		return $nameProtocols;

    }
    
    
    function insertProtocols($protTxt){
        
        $base = $this->base;
        
	$sqlClave = "select clave as cve_protocolo  from cat_protocolo where descripcion like '$protTxt'";
	$rsCat = $base->Execute($sqlClave);
	$num_filas = 0;
	foreach ($rsCat as $fila) {
		$num_filas++;
		$cve_protocolo = $fila['cve_protocolo'];
	}
        
	if($num_filas === 0){
		//The protocol does not exist. It must be persisted first
		$sqlIns = "insert into cat_protocolo (descripcion) values ('$protTxt')";
		$rsn = $base->Execute($sqlIns);
		$rsCat = $base->Execute($sqlClave);
		foreach ($rsCat as $fila) {
			$cve_protocolo = $fila['cve_protocolo'];
		}
                
                return $cve_protocolo;
	}
	else{
		return $cve_protocolo;
	}
    
    }
    
    
    function insertCategories($categories){
            $base = $this->base;
            if(is_array($categories)){
                foreach($categories as $value){
                        
                        $queryProt = "INSERT INTO `cat_categories`(`category`, `id_user`, `active`) VALUES ('".$value."',".$_SESSION['uid'].",1);";
                        
                        $base->Execute($queryProt);
                }
            }else{
                $queryProt = "INSERT INTO `cat_categories`(`category`, `id_user`, `active`) VALUES ('".$categories."',".$_SESSION['uid'].",1);";
                        
                $base->Execute($queryProt);
            }
            
            
    }
    
    function getCategories (){
            $base = $this->base;
            
            $sqlCategories = "select id_category, category from cat_categories where active = 1 and id_user = " . $_SESSION['uid'];
            $base->SetFetchMode(ADODB_FETCH_ASSOC);
            $rsCat = $base->getAll($sqlCategories);
            
            $catDb = array();
            
            if($rsCat!==false){
                    foreach ($rsCat as $category) {
                            $catDb[$category['category']] = $category['id_category'];
                    }
            }

            return $catDb;
    }
    
    function getNameCat (){
            $base = $this->base;
            
            $sqlCategories = "select id_category, category from cat_categories where active = 1 and id_user = " . $_SESSION['uid'];
            $base->SetFetchMode(ADODB_FETCH_ASSOC);
            $rsCat = $base->getAll($sqlCategories);
            
            $catName = array();
            
            if($rsCat!==false){
                    foreach ($rsCat as $category) {
                            $catName[$category['id_category']] = $category['category'];
                    }
            }
            

            return $catName;
    }
}


?>