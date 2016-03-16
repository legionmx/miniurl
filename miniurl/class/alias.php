<?php

session_start();

class Alias{
	
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

	function getHash($prot, $urlBase, $code = null, $sameUrl = null, $isLog = null, $catId = null) {
		
		global $base, $_PROTOCOLOS, $_BASEURL;
		$base = $this->base;
		
		if (isset($code) && is_array($code)){

			
			$arrayAlias= array();

			for ($i = 0; $i < count($code); $i++){

				//Sacamos el url completo, incluyendo el protocolo
				$url = $urlBase[$i];
				if (is_array($prot)){
					$idProt = $prot[$i];
					$protocolBase = $_PROTOCOLOS[$prot[$i]];
				}else{
					$idProt = $prot;
				}
				
				$codigo = $code[$i];
				$uid = $_SESSION['uid'];
				$cat = $catId[$i];

				//ponemos si pidio usuario la misma url para todo los registros

				if(isset($sameUrl) && $sameUrl = 'on'){
					$url = $urlBase;
					$protocolBase = $_PROTOCOLOS[$prot];
					if(isset($isLog) && $isLog = 'on'){
						$isLogid = 1;
					}else{
						$isLogid = 0;
					}
				}else{
						
					$isLogid = $isLog[$i];
				
				}

				$urlCompleto = strtolower($protocolBase)."://$url/" . $codigo;
				
				$urlToDb = $url. "/" . $codigo;

				//Usamos md5 para hashear, y sólo tomamos 8 caracteres
				$hash = substr(md5($urlCompleto . time()),0,8);
				
				$dominioBase = "mi.ni/";
				$dominioBase = "localhost:8080/edsa/mini/";
				$dominioBase = $_BASEURL;
				$urlMini = $dominioBase . $hash;

				//Revisamos si el hash existe

				//$rs=$base->Execute("select count(*) as cuenta from enlaces where hash='$hash'");
				$rs=$this->base->Execute("select count(*) as cuenta from enlaces where hash='$hash'");
				if($rs->fields['cuenta']=="0"){
					$arrayAlias[$i] = array(
						"existe"       => "false",
						"id user"      => $uid,
						"url"          => $url,
						"hash"         => $hash,
						"codigo"       => $codigo,
						"url completa" => $urlToDb,
						"url mini"     => $urlMini,
						"protocol"     => $idProt,
						"se logea"     => $isLogid,
						"category"     => $cat
						);
				}
				else{
					$arrayAlias[$i] = array(
						"existe"       => "true",
						"id user"      => $uid,
						"url"          => $url,
						"hash"         => $hash,
						"codigo"       => $codigo,
						"url completa" => $urlToDb,
						"url mini"     => $urlMini,
						"protocol"     => $idProt,
						"se logea"     => $isLogid,
						"category"     => $cat
						);
				}
		
			}

			return $arrayAlias;

		}else{
			//Sacamos el url completo, incluyendo el protocolo
			$url = $url;
			$idProt = $prot;
			$urlCompleto = strtolower($idProt)."://$url";

			//Usamos md5 para hashear, y sólo tomamos 8 caracteres
			$hash = substr(md5($urlCompleto),0,8);
			$dominioBase = "mi.ni/";
			$dominioBase = "localhost:8080/edsa/mini/";
			$dominioBase = CONS::BASEURL;
			$urlMini = $dominioBase.$hash;

			//Revisamos si el hash existe
			$rs=$base->Execute("select count(*) as cuenta from enlaces where hash='$hash'");
			if($rs->fields['cuenta']=="0"){
				echo json_encode(array("existe"=>false,"hash"=>$hash));
			}
			else{
				echo json_encode(array("existe"=>true,"hash"=>$hash));
			}
		}

	}

	function insertAlias($createAlias) {

		$base = $this->base;
		
		$timeStamp = time();

		foreach ($createAlias as $value) {
			
			$query = "insert into `enlaces` (`id_user`, `cve_protocolo`, `url`, `hash`, `seLogea`, `activo`, `id_category`, `code`, `mini_url`, `time_stamp` ) VALUES ('". $value['id user'] . "','" . $value['protocol'] . "', '" . $value['url completa'] . "','" . $value['hash'] . "','" . $value['se logea'] . "','1','" . $value['category'] . "','". $value['codigo'] . "','" . $value['url mini'] . "','" . $timeStamp . "');";
			
			$base->Execute($query);
		}
		
		$querySelect = "Select id, cve_protocolo, url, hash, code, id_category, mini_url from enlaces where time_stamp='$timeStamp'";
		
		$base->SetFetchMode(ADODB_FETCH_ASSOC);
		$result = array();
		$result=$base->getAll($querySelect);
		
		return $result;

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
	function insertCategories($categories){
		$base = $this->base;
		
		foreach($categories as $value){
			
			$queryProt = "INSERT INTO `cat_categories`(`category`, `id_user`, `active`) VALUES ('".$value."',".$_SESSION['uid'].",1);";
			
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