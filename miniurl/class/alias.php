<?php

session_start();

class Alias{
	
	public $base = '';

	function getHash($prot, $urlBase, $code = null, $sameUrl = null, $isLog = null) {

		include("../const.php");
		$this->base = $base;

		if (isset($code) && is_array($code)){

			if($isLog == 'on'){
				$isLog = 1;
			}else{
				$isLog = 0;
			}

			$arrayAlias= array();

			for ($i = 0; $i < count($code); $i++){

				//Sacamos el url completo, incluyendo el protocolo
				$url = $urlBase[$i];
				$idProt = $prot[$i];
				$codigo = $code[$i];
				$protocolBase = $_PROTOCOLOS[$i+1];
				$uid = $_SESSION['uid'];

				//ponemos si pidio usuario la misma url para todo los registros

				if(isset($sameUrl) && $sameUrl = 'on'){
					$url = $urlBase;
					$idProt = $prot;
				}

				$urlCompleto = strtolower($protocolBase)."://$url/" . $codigo;

				//Usamos md5 para hashear, y sólo tomamos 8 caracteres
				$hash = substr(md5($urlCompleto),0,8);
				$dominioBase = "mi.ni/";
				$dominioBase = "localhost:8080/edsa/mini/";
				$dominioBase = CONS::BASEURL;
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
						"url completa" => $urlCompleto,
						"url mini"     => $urlMini,
						"protocol"     => $idProt,
						"se logea"     => $isLog
						);
				}
				else{
					$arrayAlias[$i] = array(
						"existe"       => "true",
						"id user"      => $uid,
						"url"          => $url,
						"hash"         => $hash,
						"codigo"       => $codigo,
						"url completa" => $urlCompleto,
						"url mini"     => $urlMini,
						"protocol"     => $idProt,
						"se logea"     => $isLog
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

			$query = "insert into `enlaces` (`id_user`, `cve_protocolo`, `url`, `hash`, `seLogea`, `activo`, `code`) VALUES ('". $value['id user'] . "','" . $value['protocol'] . "', '" . $value['url completa'] . "','" . $value['hash'] . "','" . $value['se logea'] . "','1','" . $value['codigo'] . "');";
			
			$base->Execute($query);
		}

	}

}


?>