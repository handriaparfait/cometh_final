<?php

class Users extends Controller{
	
	public function index(){
		$this->loadModel("User");
		$users = $this->User->getAll();
		//$this->render('index', ['articles' => $articles]);
		$this->render('index', compact('users'));
	}
}

?>