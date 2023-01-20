<?php

class Calendars extends Controller{
	public $users;
	public $calendars;
	
	public function index(){
		$this->loadModel("User"); #nom du fichier modèle
		$this->loadModel("Calendar"); 
		$users = $this->User->getInformation();
		$plannings = $this->User->getPlanning();
		$currentplanning = $this->User->getCurrentPlanning();
		$tasks = $this->User->getTasks();
		$this->render('index', compact('users'), compact('plannings'), compact("currentplanning"), compact("tasks"));
	}


}
?>