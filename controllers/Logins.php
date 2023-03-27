<?php

class Logins extends Controller{
	
	public function connexion(){
		$this->loadModel("Login");
		$this->renderLogin('index');
	}

	public function login($username,$password){
		$this->loadModel("Login");
		$users = $this->Login->connect($username,$password);
		header('Content-Type: application/json');
		if($users == "200"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}
		else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}
}

?>