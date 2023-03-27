<?php

class Calendars extends Controller{
	public $users;
	public $calendars;
	
	public function index(){
		$this->loadModel("User"); #nom du fichier mod�le
		$this->loadModel("Calendar"); 
		$users = $this->User->getInformation();
		$plannings = $this->User->getPlanning();
		$planningweekly = $this->Calendar->getPlanningWeekly();
		$underStains = $this->Calendar->getUnderStains();		
		$planningPrev = $this->Calendar->getPlanningPrev();
		$archivesByDate = $this->Calendar->getArchivesByDate();
		$this->render('index', compact('users'), compact('plannings'), compact("planningweekly"), compact("underStains"), compact("planningPrev"), compact("archivesByDate"));
	}

	public function addUnderStain($day,$hourly,$id,$ishebdo){
		$this->loadModel("Calendar");
		$answer = $this->Calendar->addUnderStain($day,$hourly,$id,$ishebdo);
		header('Content-Type: application/json');
		if($answer == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function retirerArchive($id){
		$id = str_replace('d', ':', str_replace('t', '-', str_replace('s', ' ', $id)));
		$this->loadModel("Calendar");
		$answer = $this->Calendar->retirerArchive($id);
		header('Content-Type: application/json');
		if($answer == "false"){
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function detailArchive($id){
		$id = str_replace('d', ':', str_replace('t', '-', str_replace('s', ' ', $id)));
		$this->loadModel("Calendar");
		$answer = $this->Calendar->detailArchive($id);
		header('Content-Type: application/json');
		if($answer == "false"){
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}else{
			http_response_code(200);
			$file = "archive_prev.txt";
        	$txt = fopen($file, "w") or die("Impossible d'ouvrir le fichier !");
			$array = json_decode(json_encode($answer), true);
			fwrite($txt, "\n");
			fwrite($txt, "Archive du calendrier prévisionnel du : " . $array[0]['date']);
			fwrite($txt, "\n");
			foreach($array as $element){
				fwrite($txt, $element['jour'] . " ");
				fwrite($txt, $element['horaire'] . " : ");
				fwrite($txt, $element['nom_tache'] . " ");
				fwrite($txt, "\n");
			}
			fclose($txt);
        	header('Content-Description: File Transfer');
        	header('Content-Disposition: attachment; filename='.basename($file));
        	header('Expires: 0');
        	header('Cache-Control: must-revalidate');
        	header('Pragma: public');
        	header('Content-Length: ' . filesize($file));
        	header("Content-Type: text/plain");
        	readfile($file);
		}
	}

	public function removeUnderstain($day,$hourly,$id, $ishebdo){
		$this->loadModel("Calendar");
		//var_dump($day);
		//var_dump($hourly);
		//var_dump($id);
		$answer = $this->Calendar->removeUnderstain($day,$hourly,$id,$ishebdo);
		header('Content-Type: application/json');
		if($answer == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function emptyCalendar($ishebdo){
		$this->loadModel("Calendar");
		$answer = $this->Calendar->emptyCalendar($ishebdo);
		header('Content-Type: application/json');
		if($answer == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function archiver($ishebdo){
		$this->loadModel("Calendar");
		$answer = $this->Calendar->archiver($ishebdo);
		header('Content-Type: application/json');
		if($answer == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function submitnewProfit($profit){
		$this->loadModel("Calendar");
		$answer = $this->Calendar->submitnewProfit($profit);
		header('Content-Type: application/json');
		if($answer == "true"){
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		}else{
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

}
?>