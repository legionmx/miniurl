<?php

session_start();

switch ($_GET['method']) {
	case 'select':
	if(isset($_REQUEST['from'])) $offset  = $_REQUEST['from'];
	else $offset = 0;
	if(isset($_REQUEST['limit'])) $limit = $_REQUEST['limit'];
	else $limit = 10;
	if(isset($_REQUEST['timeStamp'])) $timestamp = $_REQUEST['timeStamp'];
	else die("There is no valid timestamp requested");
			//Alias::selectPagedResultInsert($timestamp,$offset,$limit);

	require_once($_SERVER['DOCUMENT_ROOT']."/const.php");
	$insertAlias = Alias::selectPagedResultInsert($timestamp,$offset,$limit);
	foreach($insertAlias as $registers){ ?>
												<tr>		
														<?php foreach($registers as $index => $value){ ?>
																
																<?php
																
																if($index == 'cve_protocolo'){
																		//echo '<td>' .  $getProtocols[$value] . '</td>';
																	echo '<td>' .  $_PROTOCOLOS[$value] . '</td>';
																}elseif($index== 'id_category'){
																	//echo '<td>' . $nameCat[$value]. '</td>';
																	echo '<td>' . $_CATEGORIES[$value]. '</td>';
																}else{
																	echo '<td>' .  $value . '</td>'; 
																}
																?>
																 
														
														<?php }?>
														</tr>
												<?php }

		break;
	
}

class Alias{
	
	public $base = '';
	
	function __construct(){
		//require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
		global $base, $_PROTOCOLOS, $_BASEURL;
		if(!isset($base)||!isset($_PROTOCOLOS)||!isset($_BASEURL)){
			//If after global, the global scope variables are still not set, we include const.php
			include_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
		}
		$this->base = $base;
		
	}

	function getHash($prot, $urlBase, $code = null, $sameUrl = null, $isLog = null, $catId = null) {
		
		global $base, $_PROTOCOLOS, $_BASEURL;
		$base = $this->base;
		
		if (isset($code) && is_array($code)){

			
			$arrayAlias= array();
			$regCategories = new Register;
			$getProtocols= $regCategories->getProtocols();
			
			for ($i = 0; $i < count($code); $i++){

				//Sacamos el url completo, incluyendo el protocolo
				
				if (is_array($urlBase)){
					$url = $urlBase[$i];
				}else{
					$url = $urlBase;
				}
				
				if (is_array($prot)){
					$idProt = $prot[$i];
					$protocolBase =  $getProtocols[$prot[$i]];
				}else{
					$idProt = $prot;
				}
				
				$codigo = $code[$i];
				$uid = $_SESSION['uid'];
				
				if (is_array($catId)){
					$cat = $catId[$i];
				}else{
					$cat = $catId;
				}

				//ponemos si pidio usuario la misma url para todo los registros

				if(isset($sameUrl) && $sameUrl = 'on'){
					if(!is_array($urlBase)){
						$url = $urlBase;
					}
					
					if(!is_array($prot)){
						$protocolBase =  $getProtocols[$prot];
						
					}
					
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

	function insertAlias($createAlias, $timeStamp) {

		$base = $this->base;
		
		$timeStamp = $timeStamp;

		foreach ($createAlias as $value) {
			
			$query = "insert into `enlaces` (`id_user`, `cve_protocolo`, `url`, `hash`, `seLogea`, `activo`, `id_category`, `code`, `mini_url`, `time_stamp` ) VALUES ('". $value['id user'] . "','" . $value['protocol'] . "', '" . $value['url completa'] . "','" . $value['hash'] . "','" . $value['se logea'] . "','1','" . $value['category'] . "','". $value['codigo'] . "','" . $value['url mini'] . "','" . $timeStamp . "');";
			
			$base->Execute($query);
		}
		
		$selectInsert = new Alias;
		
		$selectResult = $selectInsert->selectResultInsert($timeStamp);
		
		return $selectResult;

	}
	
	function selectResultInsert ($timeStamp){
		
		$base = $this->base;
		
		$querySelect = "Select id, cve_protocolo, url, hash, code, id_category, mini_url from enlaces where time_stamp='$timeStamp'";
		
		$base->SetFetchMode(ADODB_FETCH_ASSOC);
		$result = array();
		$result=$base->getAll($querySelect);
		
		return $result;
	}
	
	static function selectPagedResultInsert($timeStamp,$offset = 10,$limit = 10){
		$me = new Alias;

		//return $me->selectResultInsert($timeStamp,$offset = 10,$limit = 10)

		$querySelect = "Select id, cve_protocolo, url, hash, code, id_category, mini_url from enlaces where time_stamp='$timeStamp' limit $limit offset $offset";
		$base = $me->base;
		$base->SetFetchMode(ADODB_FETCH_ASSOC);
		$result = array();
		$result=$base->getAll($querySelect);
		
		//die($querySelect);
		return $result;
	}
	
}


?>