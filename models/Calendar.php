<?php
class Calendar extends Model{

	public function __construct(){
		$this->table = "users";	#nom de la table dans la base de données
		$this->getConnection();
	}

	public function getInformation(){
		$sql = "SELECT * from ". $this->table . " where id = '" . $_SESSION["id"] . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function getArchivesByDate(){
		$sql = "SELECT DISTINCT date FROM archive_planning_previsio";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function detailArchive($id){
		$sql = "SELECT a.jour, a.horaire, a.id_tache, a.date, s.nom_tache from archive_planning_previsio a natural join sous_tache s  where a.date = '" . $id . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return $query->fetchall(PDO::FETCH_OBJ);
        else return "false";
	}

	public function retirerArchive($id){
		$sql = "DELETE FROM archive_planning_previsio a where a.date = '" . $id . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return $query->fetchall(PDO::FETCH_OBJ);
        else return "false";
	}

	public function getUnderStains(){
		$sql = "SELECT * from sous_tache order by nom_tache";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function getPlanningWeekly(){
		$sql = "SELECT distinct p.jour,p.horaire,s.id_tache,s.nom_tache FROM planning_projet_hebdo p,sous_tache s where p.id_tache = s.id_tache";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function getPlanningPrev(){
		$sql = "SELECT distinct p.jour,p.horaire,s.id_tache,s.nom_tache FROM planning_projet_previsio p,sous_tache s where p.id_tache = s.id_tache";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function addUnderStain($day,$hourly,$id,$ishebdo){
		$sql = "insert into planning_projet_hebdo(jour,horaire,id_tache) values ('$day','$hourly',$id)";
		if($ishebdo == 0){
			$sql = "insert into planning_projet_previsio(jour,horaire,id_tache) values ('$day','$hourly',$id)";
		}
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
        else return "false";
	}

	public function emptyCalendar($ishebdo){
		$sql = "truncate planning_projet_hebdo";
		if($ishebdo == 0){
			$sql = "truncate planning_projet_previsio";
		}
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return $query->fetchall(PDO::FETCH_OBJ);
        else return "false";
	}

	public function archiver($ishebdo){
		$sql = "INSERT IGNORE INTO archive_planning_previsio (jour, horaire, id_tache) SELECT jour, horaire, id_tache FROM planning_projet_previsio";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() >= 0) return $query->fetchall(PDO::FETCH_OBJ);
        else return "false";
	}

	public function removeUnderstain($day,$hourly,$id,$ishebdo){
		$sql = "delete from planning_projet_hebdo where jour = '$day' and horaire = '$hourly' and id_tache = '$id'";
		if($ishebdo == 0){
			$sql = "delete from planning_projet_previsio where jour = '$day' and horaire = '$hourly' and id_tache = '$id'";
		}
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
        else return "false";
	}

	public function submitnewProfit($profit){
		$sql = "update $this->table set profit_per_task = ". $profit . " where id = '" . $_SESSION["id"] . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
        else return "false";
	}
}

?>