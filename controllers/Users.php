<?php

class Users extends Controller{
	public $users;
	
	public function index(){
		$this->loadModel("User");
		$users = $this->User->getInformation();
		$plannings = $this->User->getPlanning();
		$this->render('index', compact('users'), compact('plannings'));
	}
}

?>