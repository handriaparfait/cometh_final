<?php
class Calendar extends Model{

	public function __construct(){
		$this->table = "users";	#nom de la table dans la base de données
	}

	public function getInformation(){
		$sql = "SELECT * from ". $this->table . " where id = '" . $_SESSION["id"] . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}
}

?>