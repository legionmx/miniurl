<?php
/**
* class/User.php - class User
*/
//namespace miniurl;
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
//global $base; //This is not supposed to be needed

//The next var contains the fields that are persisted in the DB
$USER_FIELDS = array('username','firstName','lastName','dob','email','password');

class User
{
	protected $id;
	protected $username;
	private $password;
	protected $firstName;
	protected $lastName;
	protected $dob; //Date of Birth, fecha de nacimiento
	protected $email;
	protected $role; //The role id for the time being, it should be another object
	protected $active;
	protected $registered;
	private $bd;

	function __construct($user=null)
	{
		//global $base;
		//die("---->".print_r($base,1));

		$this->registered = false; //We assume the user is not registered yet
		$this->active = false; //Until registered, we cannnot truly say it is active
		$this->password = null;
		$this->username = 'anonymous'; //They shouldn't be persisted, this is just a placeholder
		$this->firstName = 'Anonymous';
		//We search the user in the DB to load it
		global $base;
		$sqlUser = null;
		if(!is_null($user)){
			if(is_numeric($user)){
				//We request the user via UID
				$sqlUser = "select * from users where id=$user";
			}
			else{
				//We request the user via username
				$sqlUser = "select * from users where username='$user'";
			}
			//global $base;
			//die(print_r($base,1));
			if(is_null($base)){
				//throw new Exception("The connection to the DB doesn't exist", 1);
				$this->firstName=' ';
			}
			else{
				$rsUser = $base->Execute($sqlUser);
				if($rsUser->RecordCount() == 0){ //The user is not persisted in DB
					//throw new Exception("The user doesn't exist in the DB", 1);
				}
				else{
					$data = $rsUser->fetchNextObject(false);
					$this->active = true;
					$this->registered = true;
					$this->id = $data->id;
					$this->username = $data->username;
					$this->password = $data->password;
					$this->data = $data->password;
					$this->firstName = $data->firstName;
					$this->lastName = $data->lastName;
					$this->dob = $data->dob;
					$this->email = $data->email;
					$this->role = $data->id_role;
					if($data->active != '0') $this->active = true;
				}
			}
		}
	}

	function __toString(){
		//return $this->username.' --- '.$this->firstName.' '.$this->lastName;
		//The above was a test functionality. It is now better to just throw the first name
		return $this->firstName;
	}
	/*** Getters/Setters ***/
	public function getId(){
		return $this->id;
	}
	public function isRegistered(){
		return $this->registered;
	}

	public function matchPassword($givenPassword){
		$hashedPassword = hash('sha256', $givenPassword);
		return $hashedPassword === $this->password;
	}

	public static function create($data){
		global $USER_FIELDS;
		global $base;
		if(!is_array($data)){
			throw new Exception("An array is needed", 1);
		}
		if(!isset($data['username'])){
			throw new Exception("A username is needed", 1);
		}

		try{
			$registeredUser = new User($data['username']);
		} catch (Exception $e){
			//This is in fact a desired exception catch
		}
		//if($registeredUser instanceof User) throw new Exception("The username is already registered", 1);
		if($registeredUser->isRegistered()) throw new Exception("The username is already registered", 1);

		//We prepare the insert
		$insFields = "";
		$insValues = "";
		foreach ($data as $field => $value) {
			if(in_array($field, $USER_FIELDS)){
				if(!empty($insValues)) $insValues.=',';
				if(!empty($insFields)) $insFields.=',';

				//Special handling of password
				if($field=='password'){
					$value = hash('sha256', $value);
				}

				$insFields.="$field";
				if(is_numeric($value)){
					$insValues.="$value";
				}
				else{
					$insValues.="'$value'";
				}
			}
			else{
				// NOP
			}
		}
		$sqlInsUser = "insert into users($insFields) values ($insValues)";

		$rsInsUser = $base->Execute($sqlInsUser);

		return new User($data['username']);
	}
	
	public static function getNamebyId($uid) {
		global $base;
		$queryUser = "select firstName from users where id='$uid'";
		$rsUser = $base->Execute($queryUser);
		
		return $rsUser;
	}
}
//Test
/*$adminUser = new User('admin');
echo $adminUser."<br>";
$datosUsuarioCreado=array('username' => 'usuario1','firstName'=> 'Usua','lastName' => 'Rio Uno','dob' => '2013-11-09','email' => 'usuario1@usuari.os');
//die(User::create($datosUsuarioCreado));
echo User::create($datosUsuarioCreado);*/
?>