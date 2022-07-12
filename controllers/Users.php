<?php

class Users extends Controller{
	public $users;
	
	public function index(){
		$this->loadModel("User");
		$users = $this->User->getInformation();
		$plannings = $this->User->getPlanning();
		$currentplanning = $this->User->getCurrentPlanning();
		$tasks = $this->User->getTasks();
		$this->render('index', compact('users'), compact('plannings'), compact("currentplanning"), compact("tasks"));
	}

	public function startPlanning($idp){
		$this->loadModel("User");
		$plans = $this->User->startPlanning($idp);
		header('Content-Type: application/json');
		if($plans == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}
		else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function pausePlanning($idp){
		$this->loadModel("User");
		$plans = $this->User->pausePlanning($idp);
		header('Content-Type: application/json');
		if($plans == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}
		else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function endPlanning($idp){
		$this->loadModel("User");
		$plans = $this->User->endPlanning($idp);
		header('Content-Type: application/json');
		if($plans == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}
		else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}



	public function uploadPdf($id,$idpdf){
		$this->loadModel("User");
		$answer = $this->User->uploadPdf($id,$idpdf,file_get_contents($_FILES["file"]["tmp_name"]),$_FILES["file"]["name"]);
		header('Content-Type: application/json');
		if($answer == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function downloadPdf($id,$idpdf){
		$this->loadModel("User");
		$answer = $this->User->downloadPdf($id,$idpdf);
		header('Content-Type: application/pdf');
		if($answer == "false") echo "Erreur de chargement du document PDF";
		else echo ($answer[0]->{"pdf".$id});
	}

}

?>