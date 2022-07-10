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
		$sql = "SELECT * from planning p, planning_users pu where pu.id = '" . $_SESSION["id"] . "' and p.plan_id = pu.plan_id";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function startPlanning($idp){
		//$sql = "update planning_users set total_hour = TIMEDIFF(select plan_start from planning where plan_id = '". $idp ."' , CURRENT_TIME());";
		$sql =  "update planning set plan_start = NULL where plan_id = '". $idp ."'; ";
		$sql .= "update planning set plan_start = CURRENT_TIME(),  plan_end = CURRENT_TIME() where plan_id = '" . $idp . "'; ";
		$sql .= "update users set current_plan = '". $idp ."' where id = '" . $_SESSION["id"] . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
        else return "false";
	}

	public function stopPlanning($idp){
		$sql = "update planning set plan_end = CURRENT_TIME() where plan_id = '" . $idp . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function uploadPdf($idpd,$idpl,$data,$name){
		$sql = "update planning set pdf".$idpd." = 0 where plan_id = '". $idpl ."' ; update planning set pdf".$idpd." = ? , pdf".$idpd."_name = ? where plan_id = '". $idpl ."'";
		$query = $this->_connexion->prepare($sql);
		$query->bindParam(1,$data);
		$query->bindParam(2,$name);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
        else return "false";
	}

	public function downloadPdf($idpd,$idpl){
		$sql = "select pdf".$idpd." from planning where plan_id = '". $idpl ."'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return $query->fetchall(PDO::FETCH_OBJ);
        else return "false";
	}

}
 
?>