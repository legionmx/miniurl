<?php

session_start();

class Alias{
	
	public $base = '';

	function getHash($prot, $urlBase, $code = null, $sameUrl = null, $isLog = null) {
		
		require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
		$this->base = $base;

		if (isset($code) && is_array($code)){
			
			$isLogid = 1;
			
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

				//ponemos si pidio usuario la misma url para todo los registros

				if(isset($sameUrl) && $sameUrl = 'on'){
					$url = $urlBase;
					$protocolBase = $_PROTOCOLOS[$prot];
					if(isset($isLog) && $isLog = 'on'){
						$isLogid = 1;
					}else{
						$isLogid = 0;
					}
				}

				$urlCompleto = strtolower($protocolBase)."://$url/" . $codigo;
				
				$urlToDb = $url. "/" . $codigo;

				//Usamos md5 para hashear, y sólo tomamos 8 caracteres
				$hash = substr(md5($urlCompleto),0,8);
				$dominioBase = "mi.ni/";
				$dominioBase = "localhost:8080/edsa/mini/";
				$dominioBase = $_BASEURL;
				$urlMini = $dominioBase . $hash;

				//Revisamos si el hash existe

				$rs=$base->Execute("select count(*) as cuenta from enlaces where hash='$hash'");
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
						"se logea"     => $isLogid
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
						"se logea"     => $isLogid
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

		foreach ($createAlias as $value) {

			$query = "insert into `enlaces` (`id_user`, `cve_protocolo`, `url`, `hash`, `seLogea`, `activo`, `code`, `mini_url`) VALUES ('". $value['id user'] . "','" . $value['protocol'] . "', '" . $value['url completa'] . "','" . $value['hash'] . "','" . $value['se logea'] . "','1','" . $value['codigo'] . "','" . $value['url mini'] . "');";
			
			$base->Execute($query);
		}

	}

}


?>