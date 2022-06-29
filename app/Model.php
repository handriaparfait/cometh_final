<?php

abstract class Model{
	
	// Information de base de données
	private $host = "localhost";
	private $db_name = "cometh";
	private $username = "root";
	private $password = "";

	// Propriété contenant la connexoin
	protected $_connexion;

	// Propriété contenant les informations de requêtes
	public $table;
	public $id;

	public function getConnection(){
		$this->_connexion = null;
		try{
			$this->_connexion = new PDO('mysql:host='. $this->host . '; dbname='. $this->db_name, $this->username, $this->password);
			$this->_connexion->exec('set names utf8');
		}
		catch(PDOException $exception){
			echo 'Erreur : ' . $exception->getMessage();
		}
	}

	public function getAll(){
		$sql = "SELECT * from ". $this->table;
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}

	public function getOne(){
		$sql = "SELECT * from ". $this->table . " where id = " . $this->id;
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
}

?>