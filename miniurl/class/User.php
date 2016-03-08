<?php
/**
* class/Usuario.php - clase User
*/
//namespace miniurl;
require_once($_SERVER['DOCUMENT_ROOT'].'/const.php');
<<<<<<< HEAD
//The next var contains the fields that are persisted in the DB
$USER_FIELDS = array('username','firstName','lastName','dob','email','password');
=======

//The next var contains the fields that are persisted in the DB
$USER_FIELDS = array('username','firstName','lastName','dob','email','password');

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
class User
{
	protected $id;
	protected $username;
	private $password;
	protected $firstName;
	protected $lastName;
	protected $dob; //Date of Birth, fecha de nacimiento
	protected $email;
<<<<<<< HEAD
	protected $role; //El id por el momento, pero deber’a ser otro objeto
	protected $active;
	protected $registered;
=======
	protected $role; //El id por el momento, pero deberÃ­a ser otro objeto
	protected $active;
	protected $registered;

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
	function __construct($username)
	{
		$this->registered = false; //We assume the user is not registered yet
		$this->active = false; //Until registered, we cannnot truly say it is active
		$this->password = null;
<<<<<<< HEAD
=======

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
		//We search the user in the DB to load it
		global $base;
		$sqlUser = "select * from users where username='$username'";
		$rsUser = $base->Execute($sqlUser);
		if($rsUser->RecordCount() == 0){ //The user is not persisted in DB
			//throw new Exception("The user doesn't exist in the DB", 1);
<<<<<<< HEAD
=======

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
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
<<<<<<< HEAD
	function __toString(){
		return $this->username.' --- '.$this->firstName.' '.$this->lastName;
	}
	/*** Getters/Setters ***/
	public function getId(){
		return $this->id;
	}
	public function isRegistered(){
		return $this->registered;
	}
=======

	function __toString(){
		return $this->username.' --- '.$this->firstName.' '.$this->lastName;
	}

	/*** Getters/Setters ***/

	public function getId(){
		return $this->id;
	}

	public function isRegistered(){
		return $this->registered;
	}

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
	public function matchPassword($givenPassword){
		$hashedPassword = hash('sha256', $givenPassword);
		return $hashedPassword === $this->password;
	}
<<<<<<< HEAD
=======

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
	public static function create($data){
		global $USER_FIELDS;
		global $base;
		if(!is_array($data)){
			throw new Exception("An array is needed", 1);
		}
		if(!isset($data['username'])){
			throw new Exception("A username is needed", 1);
		}
<<<<<<< HEAD
=======

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
		try{
			$registeredUser = new User($data['username']);
		} catch (Exception $e){
			//This is in fact a desired exception catch
		}
		//if($registeredUser instanceof User) throw new Exception("The username is already registered", 1);
		if($registeredUser->isRegistered()) throw new Exception("The username is already registered", 1);
<<<<<<< HEAD
=======

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
		//We prepare the insert
		$insFields = "";
		$insValues = "";
		foreach ($data as $field => $value) {
			if(in_array($field, $USER_FIELDS)){
				if(!empty($insValues)) $insValues.=',';
				if(!empty($insFields)) $insFields.=',';
<<<<<<< HEAD
=======

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
				//Special handling of password
				if($field=='password'){
					$value = hash('sha256', $value);
				}
<<<<<<< HEAD
=======

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
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
<<<<<<< HEAD
		$rsInsUser = $base->Execute($sqlInsUser);
=======

		$rsInsUser = $base->Execute($sqlInsUser);

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
		return new User($data['username']);
	}
}
//Test
/*$adminUser = new User('admin');
echo $adminUser."<br>";
<<<<<<< HEAD
=======

>>>>>>> 59312cc072c4f08aef08dc392ac1fb842db502d4
$datosUsuarioCreado=array('username' => 'usuario1','firstName'=> 'Usua','lastName' => 'Rio Uno','dob' => '2013-11-09','email' => 'usuario1@usuari.os');
//die(User::create($datosUsuarioCreado));
echo User::create($datosUsuarioCreado);*/
?>