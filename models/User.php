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

	public function getCurrentPlanning(){
		$sql = "SELECT * from planning pl, users us where us.current_plan = pl.plan_id and us.id = '" . $_SESSION["id"] . "'";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return $query->fetchall(PDO::FETCH_OBJ);
        else return "false";
	}

	public function getPlanning(){
		$sql = "SELECT * from planning p, planning_users pu where pu.id = '" . $_SESSION["id"] . "' and p.plan_id = pu.plan_id order by p.plan_date";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}
	
	public function getTasks(){
		$sql = "SELECT * from tasks t, task_users tu where tu.user_id = '" . $_SESSION["id"] . "' and t.task_id = tu.task_id order by task_level desc";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		return $query->fetchall(PDO::FETCH_OBJ);
	}

	public function startPlanning($idp){
		$sql =  "update planning set ispaused = 0 where plan_id = '". $idp ."'; ";
		$sql .= "update planning set plan_start = NOW(),  plan_end = NOW() where plan_id = '". $idp ."'; ";
		$sql .= "update users set current_plan = '". $idp ."' where id = '" . $_SESSION["id"] . "'; ";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
        else return "false";
	}

	public function pausePlanning($idp){
		$sql =  "update planning set ispaused = 1 where plan_id = '". $idp ."'; ";
		$sql .= "update planning set plan_end = NOW() where plan_id = '" . $idp . "'; ";
		$sql .= "update planning_users plu inner join planning pl on plu.plan_id = pl.plan_id set total_hour = total_hour + (timediff(pl.plan_end,pl.plan_start)) where plu.plan_id = '". $idp ."';";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
        else return "false";
	}

	public function endPlanning($idp){
		$sql =  "update planning set ispaused = 0 where plan_id = '". $idp ."'; ";
		$sql .= "update planning set plan_end = NOW() where plan_id = '" . $idp . "'; ";
		$sql .= "update planning_users plu inner join planning pl on plu.plan_id = pl.plan_id set total_hour = (timediff(pl.plan_end,pl.plan_start)) where plu.plan_id = '". $idp ."';";
		$sql .= "update users set current_plan = NULL where id = '" . $_SESSION["id"] . "'; ";
		$query = $this->_connexion->prepare($sql);
		$query->execute();
		if ($query->rowCount() > 0) return "true";
        else return "true";
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

	public function submit($idtask,$status){
		$sql = "";
		if($status == "true")
			$sql = "update tasks set isdone = 1 where task_id = '". $idtask ."';";
		else if($status == "false")
			$sql = "update tasks set isdone = 0 where task_id = '". $idtask ."';";
		$query = $this->_connexion->prepare($sql);
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