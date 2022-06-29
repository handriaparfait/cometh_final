<?php

class Article extends Model{

	public function __construct(){
		$this->table = "articles";
		$this->getConnection();
	}

	public function findById(string $id){
		$sql = "SELECT * from ". $this->table . " where id = '" . $id . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
}
 
?>