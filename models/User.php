<?php

class User extends Model
{

	public function __construct()
	{
		$this->table = "users";
		$this->getConnection();
	}


	public function create($nom_projet, $date_rendu, $adresse_proj)
	{
		$date_deb = date('y-m-d');
		$etat_prjt = boolval(1);
		$sql = $this->_connexion->prepare('INSERT INTO projet (nom_projet, date_debut, date_rendu, adresse_projet, etat_projet) VALUES (?, ?, ?, ?, ?)');
		return $sql->execute([$nom_projet, $date_deb, $date_rendu,$adresse_proj, $etat_prjt]);
	}

	public function add($nom_tache, $duree, $priori, $id_projet)
	{		
		$stmt = $this->_connexion->prepare('INSERT INTO sous_tache (nom_tache, duree, ordre_priori, doc, id_projet) VALUES (?, ?, ?, ?, ?)');
		return $stmt->execute([$nom_tache, $duree, $priori,'doc', $id_projet]);
	}

	public function edit_tache($id_tache, $nom_tache, $duree, $priori)
	{


		
		$stmt = $this->_connexion->prepare("UPDATE sous_tache SET nom_tache=?,duree=$duree,ordre_priori='$priori',doc='doc' WHERE id_tache=" . intval($id_tache));
		return $stmt->execute([$nom_tache]);
	}

	public function edit_projet($id, $nom_projet, $daterendu, $adresseproj)
	{
		$sql = "UPDATE projet SET nom_projet='$nom_projet',date_rendu='$daterendu',adresse_projet='$adresseproj' WHERE id=" . intval($id);
		return $this->_connexion->exec($sql);
	}

	public function supprimertache($id)
	{
		$sql = "DELETE FROM sous_tache where id_tache = " . intval($id);
		return $this->_connexion->exec($sql);
	}

	public function supprimertouttache($id)
	{
		$sql = "DELETE FROM sous_tache where id_projet = " . intval($id);
		return $this->_connexion->exec($sql);
	}

	public function supprimerprojet($id)
	{
		$sql = "DELETE FROM projet where id = " . intval($id);
		return $this->_connexion->exec($sql);
	}


	public function fichier_projet($nom_fichier, $id_projet, $hash)
	{
		$date_ajout = date('y-m-d');
		$sql = "INSERT INTO fichier_projet (nom_file,id_projet, date_ajout, etat, hashcode ) VALUES ('$nom_fichier', $id_projet, '$date_ajout', 1, '$hash')";
		return $this->_connexion->exec($sql);
	}
	public function fichier_tache($nom_fichier, $id_tache, $hash)
	{
		$date_ajout = date('y-m-d');
		$sql = "INSERT INTO fichier_tache (nom_file,id_tache, date_ajout, etat, hashcode ) VALUES ('$nom_fichier', $id_tache, '$date_ajout', 1, '$hash')";
		return $this->_connexion->exec($sql);
	}


	public function get_file_proj($id)
	{

		$sql = "SELECT * from fichier_projet where id_projet = " . intval($id);
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function get_tache_file($id)
	{

		$sql = "SELECT * from fichier_tache where id_tache = " . intval($id);
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function get_tache_by_id($id)
	{

		$sql = "SELECT * from sous_tache where id_tache = " . intval($id);
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function get_projet_by_id($id)
	{

		$sql = "SELECT * from projet where id = " . intval($id);
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function get_projet()
	{
		$sql = "SELECT * from projet";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function get_tache()
	{
		$sql = "SELECT * FROM sous_tache ORDER BY CASE ordre_priori WHEN 'élevé' THEN 1 WHEN 'moyen' THEN 2 WHEN 'faible' THEN 3  END ASC;";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}


	public function getInformation()
	{
		$sql = "SELECT * from " . $this->table . " where id = '" . $_SESSION["id"] . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function getCurrentPlanning()
	{
		$sql = "SELECT * from planning pl, users us where us.current_plan = pl.plan_id and us.id = '" . $_SESSION["id"] . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return $query->fetchall(PDO::FETCH_OBJ);
		else return "false";
	}

	public function getPlanning()
	{
		$sql = "SELECT * from planning p, planning_users pu where pu.id = '" . $_SESSION["id"] . "' and p.plan_id = pu.plan_id order by p.plan_date";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function getTasks()
	{
		$sql = "SELECT * from tasks t, task_users tu where tu.user_id = '" . $_SESSION["id"] . "' and t.task_id = tu.task_id order by task_level desc";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function startPlanning($idp)
	{
		$sql =  "update planning set ispaused = 0 where plan_id = '" . $idp . "'; ";
		$sql .= "update planning set plan_start = NOW(),  plan_end = NOW() where plan_id = '" . $idp . "'; ";
		$sql .= "update users set current_plan = '" . $idp . "' where id = '" . $_SESSION["id"] . "'; ";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
		else return "false";
	}

	public function pausePlanning($idp)
	{
		$sql =  "update planning set ispaused = 1 where plan_id = '" . $idp . "'; ";
		$sql .= "update planning set plan_end = NOW() where plan_id = '" . $idp . "'; ";
		$sql .= "update planning_users plu inner join planning pl on plu.plan_id = pl.plan_id set total_hour = total_hour + (timediff(pl.plan_end,pl.plan_start)) where plu.plan_id = '" . $idp . "';";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
		else return "false";
	}

	public function endPlanning($idp)
	{
		$sql =  "update planning set ispaused = 0 where plan_id = '" . $idp . "'; ";
		$sql .= "update planning set plan_end = NOW() where plan_id = '" . $idp . "'; ";
		$sql .= "update planning set isended = 1 where plan_id = '" . $idp . "'; ";
		$sql .= "update planning_users plu inner join planning pl on plu.plan_id = pl.plan_id set total_hour = total_hour + (timediff(pl.plan_end,pl.plan_start)) where plu.plan_id = '" . $idp . "';";
		$sql .= "update users set current_plan = NULL where id = '" . $_SESSION["id"] . "'; ";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
		else return "true";
	}


	public function uploadPdf($idpd, $idpl, $data, $name)
	{
		$sql = "update planning set pdf" . $idpd . " = 0 where plan_id = '" . $idpl . "' ; update planning set pdf" . $idpd . " = ? , pdf" . $idpd . "_name = ? where plan_id = '" . $idpl . "'";
		$query = $this->_connexion->prepare($sql);
		$query->bindParam(1, $data);
		$query->bindParam(2, $name);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
		else return "false";
	}

	public function submit($idtask, $status)
	{
		$sql = "";
		if ($status == "true")
			$sql = "update tasks set isdone = 1 where task_id = '" . $idtask . "';";
		else if ($status == "false")
			$sql = "update tasks set isdone = 0 where task_id = '" . $idtask . "';";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
		else return "false";
	}

	public function downloadPdf($idpd, $idpl)
	{
		$sql = "select pdf" . $idpd . " from planning where plan_id = '" . $idpl . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return $query->fetchall(PDO::FETCH_OBJ);
		else return "false";
	}

	public function saveUserInformation($pseudo, $mail)
	{
		$sql = "";
		if ($pseudo != "") #am�liorer avec un regex
			$sql .= "update users set name = '" . $pseudo . "' where id = '" . $_SESSION["id"] . "'; ";
		if ($mail != "") #am�liorer avec un regex
			$sql .= "update users set email '" . $mail . "' where id = '" . $_SESSION["id"] . "';";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
		else return "false";
	}
}
