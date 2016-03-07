<?php

class Alias{

	private $base = '';
	protected $hash = '';

	function __construct($relatedURL){
		$this->hash = $this->generateHash($relatedURL);
	}

	function getHash($prot, $urlBase, $code = null, $sameUrl = null, $isLog = null) {

		include_once($_SERVER['DOCUMENT_ROOT']."/const.php");
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

				//ponemos si pidio usuario la misma url para todo los registros

				if(isset($sameUrl) && $sameUrl = 'on'){
					$url = $urlBase;
					$idProt = $prot;
				}

				$urlCompleto = strtolower($protocolBase)."://$url/" . $codigo;

				//$hash = substr(md5($urlCompleto),0,8);
				$hash = $this->generateHash($urlCompleto);
				$dominioBase = CONS::BASEURL;
				$urlMini = $dominioBase . $hash;

				//Revisamos si el hash existe

				$rs=$base->Execute("select count(*) as cuenta from enlaces where hash='$hash'");
				if($rs->fields['cuenta']=="0"){
					$arrayAlias[$i] = array(
						"existe"       => "false",
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

			//$hash = substr(md5($urlCompleto),0,8);
			$hash = $this->generateHash($urlCompleto);
			//$dominioBase = CONS::BASEURL;
			//$urlMini = $dominioBase.$hash;

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

			$query = "insert into `enlaces` (`cve_protocolo`, `url`, `hash`, `seLogea`, `activo`, `code`) VALUES ('" . $value['protocol'] . "', '" . $value['url completa'] . "','" . $value['hash'] . "','" . $value['se logea'] . "','1','" . $value['codigo'] . "');";
			
			$base->Execute($query);
		}

	}

	/*** String : String ***
	Generates a eight characters hash, based on a complete MD5 one, from a full-length, long URL
	*/
	private function generateHash($URL){
		return substr(md5($URL),0,8);
	}

	/*** void : String***
	Getter of the hash field
	*/
	public function pubGetHash(){
		return $this->hash;
	}



}


?>