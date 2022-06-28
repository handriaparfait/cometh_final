<?php

class Login extends Model{
	
	public function __construct(){
		$this->table = "user";
		$this->getConnection();
	}

	public function connect($username,$password){
		$sql = "SELECT count(*) from ". $this->table . " where name = '" . $username . "' and pwd = '".  $password . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
}
 
?>