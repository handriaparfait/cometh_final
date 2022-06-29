<?php

class User extends Model{

	public function __construct(){
		$this->table = "users";
		$this->getConnection();
	}

	public function getInformation(){
		$sql = "SELECT * from ". $this->table . " where id = '" . $_SESSION["id"] . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function getPlanning(){
		$sql = "SELECT * from planning";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}
}
 
?>