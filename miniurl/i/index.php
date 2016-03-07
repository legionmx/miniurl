<?php
	//Checamos si hay parametro de peticion
	if(empty($_REQUEST)) die("No hay parametros");

	//El primer parametro debe de estar vacio
	$parametros = array_keys($_REQUEST);
	$primerParam = array_shift($parametros);
	if(empty($_REQUEST[$primerParam])){
		//die("Possible Hash");
		//Incluimos constantes y conexion a BD
		require_once("../const.php");

		//Intentamos el parametro como hash y vemos si existe en BD
		$hash=$primerParam;
		$sql="select catprot.descripcion as prot,url,seLogea as log,id from cat_protocolo as catprot,enlaces where hash='$hash' and catprot.clave = enlaces.cve_protocolo";
		$rs = $base->Execute($sql);
		//TODO: Falta manejar cuando no tira resultados
		$url = strtolower($rs->fields['prot'])."://".$rs->fields['url'];

		//Logeamos
		if($rs->fields['log'] == "1"){
			$ip = $_SERVER['REMOTE_ADDR'];
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
			$browser = get_browser(null,true);
			$nombreBrowser = $browser['browser'];
			$sisop = $browser['platform'];
			$sqlLog = "insert into visitas (ip,user_agent,browser,sisop,id_enlace) values ('$ip','$user_agent','$nombreBrowser','$sisop',".$rs->fields['id'].")";
			//die($sqlLog);
			$rsLog = $base->Execute($sqlLog);
		}
		//die($rs->fields['log']);

		//Redirigimos y salimos del script
		header('Location: '.$url);
		exit();
	}
	else{
		//die("---".$_REQUEST[$primerParam]."+++");
		die("Hash invalido");
	}
?>