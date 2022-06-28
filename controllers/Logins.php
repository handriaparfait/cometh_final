<?php

class Logins extends Controller{
	
	public function connexion(){
		$this->loadModel("Login");
		$this->renderLogin('index');
	}

	public function login($username,$password){
		$this->loadModel("Login");
		$users = $this->Login->connect($username,$password);
		if($users[0] == 1){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
			//$this->render('index', compact('users'));
		}
		else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
			//$this->renderLogin('index');		
		}
	}

}

?>