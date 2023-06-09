<?php

class Logins extends Controller{
	
	public function connexion(){
		$this->loadModel("Login");
		$this->renderLogin('index');
	}

	public function login($username,$password){
		$this->loadModel("Login");
		$passwords = hash("sha256",  $password);

		$users = $this->Login->connect($username,$passwords);
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

	public function deconnexion() {
    	session_unset();
    	session_destroy();
		http_response_code(200);
		echo json_encode(["response_code" => 200]);
	}
}

?>