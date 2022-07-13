<?php

class Login extends Model{
	
	public function __construct(){
		$this->table = "users";
		$this->getConnection();
	}

	public function connect($username,$password){
		$sql = "SELECT count(*) from ". $this->table . " where name like '" . $username . "' and pwd like '".  $password . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if($query->fetch()[0] == "1"){
			$sql = "SELECT id from ". $this->table . " where name like '" . $username . "' and pwd like '".  $password . "'";
			$query = $this->_connexion->prepare($sql);
			$query->execute();
			$_SESSION["id"] = $query->fetch()[0];
			return "200";
		}
		else return "401";
	}
}
 
?>