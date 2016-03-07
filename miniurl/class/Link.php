<?php
/**
* Class Link
* Represents a web link 
*/
class Link
{
	
	protected $url;
	protected $protocolKey;
	protected $alias = null;
	protected $user;
	protected $hasLog;
	private $db;

	function __construct($url,$protocol,$username = null)
	{
		include_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
		global $base;
		$this->url = $url;
		$this->protocolKey = $protocol;
		$this->db = $base;
		if(!is_null($username)) $this->user = new User($username);
	}

	public function getCompleteURL(){
		include_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
		global $_PROTOCOLS;
		return $_PROTOCOLS[$this->protocolKey].'://'.$this->url;
	}

	public function setAlias($alias){
		$this->alias = $alias;
	}

	public function exists(){
		if(!is_null($this->alias)){
			/*$existsSQL = "select count(*) as cuenta from enlaces where hash='".$this->alias."'";
			$rs = $this->db->Execute($existsSQL);
			if($rs->fields['cuenta']=="0"){
				//echo json_encode(array("existe"=>false,"hash"=>$hash));
				return false;
			}
			else{
				//echo json_encode(array("existe"=>true,"hash"=>$hash));
				return true;
			}*/
			return self::existsInDB($this->alias);
		}
		return false;
	}

	public static function existsInDB($alias){
		include_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
		global $base;
		$existsSQL = "select count(*) as cuenta from enlaces where hash='$alias'";
		$rs = $base->Execute($existsSQL);
		if($rs->fields['cuenta']=="0"){
			return false;
		}
		else{
			return true;
		}
	}
}
?>