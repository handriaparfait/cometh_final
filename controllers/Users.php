<?php

class Users extends Controller
{
	public $users;


	public function index()
	{
		$this->loadModel("User");
		$users = $this->User->getInformation();
		$projet = $this->User->get_projet();
		$tache = $this->User->get_tache();
		$plannings = $this->User->getPlanning();
		$currentplanning = $this->User->getCurrentPlanning();
		$tasks = $this->User->getTasks();
		$this->render('index', compact('users'), compact('projet'), compact('tache'), compact('plannings'), compact("currentplanning"), compact("tasks"));
	}

	public function idproj()
	{
		$this->loadModel("User");
		$fileproj = array('fileproj' => $_POST['idproj']);
		$get_projfile = $this->User->get_file_proj($_POST['idproj']);
		$val = compact('get_projfile');
		ob_start();
		extract($val);
		include('http://localhost/cometh/users/index.php');
		$content = ob_get_clean();

		header('Content-Type: application/json');
		echo json_encode($val);
	}

	public function get_file_tache()
	{
		$this->loadModel("User");
		$idtache = array('filetache' => $_POST['idtache']);
		$get_tache_file = $this->User->get_tache_file($_POST['idtache']);
		$filetache = compact('get_tache_file');
		ob_start();
		extract($filetache);
		include('http://localhost/cometh/users/index.php');
		$content = ob_get_clean();

		header('Content-Type: application/json');
		echo json_encode($filetache);
	}




	public function get_tache_by_id()
	{
		$this->loadModel("User");
		$idsoustache = array('idsoustache' => $_POST['idsoustache']);
		$gettache_byid = $this->User->get_tache_by_id($_POST['idsoustache']);
		$tache_byid = compact('gettache_byid');
		ob_start();
		extract($tache_byid);
		include('http://localhost/cometh/users/index.php');
		$content = ob_get_clean();

		header('Content-Type: application/json');
		echo json_encode($tache_byid);
	}





	public function startPlanning($idp)
	{
		$this->loadModel("User");
		$plans = $this->User->startPlanning($idp);
		header('Content-Type: application/json');
		if ($plans == "true") {
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		} else {
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}




	public function pausePlanning($idp)
	{
		$this->loadModel("User");
		$plans = $this->User->pausePlanning($idp);
		header('Content-Type: application/json');
		if ($plans == "true") {
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		} else {
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function endPlanning($idp)
	{
		$this->loadModel("User");
		$plans = $this->User->endPlanning($idp);
		header('Content-Type: application/json');
		if ($plans == "true") {
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		} else {
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}


	public function uploadPdf($id, $idpdf)
	{
		$this->loadModel("User");
		$answer = $this->User->uploadPdf($id, $idpdf, file_get_contents($_FILES["file"]["tmp_name"]), $_FILES["file"]["name"]);
		header('Content-Type: application/json');
		if ($answer == "true") {
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		} else {
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function downloadPdf($id, $idpdf)
	{
		$this->loadModel("User");
		$answer = $this->User->downloadPdf($id, $idpdf);
		header('Content-Type: application/pdf');
		if ($answer == "false") echo "Erreur de chargement du document PDF";
		else echo ($answer[0]->{"pdf" . $id});
	}

	public function submit($idtask, $status)
	{
		$this->loadModel("User");

		$answer = $this->User->submit($idtask, $status);
		header('Content-Type: application/pdf');
		if ($answer == "true") {
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		} else {
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}

	public function saveUserInformation($pseudo, $mail)
	{
		$this->loadModel("User");
		$answer = $this->User->saveUserInformation($pseudo, $mail);
		header('Content-Type: application/pdf');
		if ($answer == "true") {
			http_response_code(200);
			echo json_encode(["response_code" => 200]);
		} else {
			http_response_code(401);
			echo json_encode(["response_code" => 401]);
		}
	}


	public function create()
	{

		$nom_projet = $_POST['nom_projet'];
		$date_rendu = $_POST['date_rendu'];
		$adresse_proj = $_POST['adresse_proj'];



		$this->loadModel("User");
		$create = $this->User->create($nom_projet, $date_rendu, $adresse_proj);
		if ($create == "true") {
			echo ("c est ok");
			echo json_encode($_POST);
		} else {
			echo ("erreur");
		}
	}

	public function add()
	{

		$nom_tache = $_POST['nom_tache'];
		$duree = $_POST['duree'];
		$priori = $_POST['priori'];
		$id_projet = $_POST['id_projet'];



		$this->loadModel("User");
		$add = $this->User->add($nom_tache, $duree, $priori, $id_projet);
		if ($add == "true") {
			echo ("c est ok");
			echo json_encode($_POST);
		} else {
			echo ("erreur");
		}
	}

	public function fichier_projet()
	{

		$id_projet = $_POST['id_projet'];
		$tmp_path = $_FILES['file']['tmp_name'];
		$file_name = $_FILES['file']['name'];

		$file_contents = file_get_contents($tmp_path);
		$salt = bin2hex(random_bytes(16));

		$hashed_name = hash("sha256", $salt . $file_contents);
		$dossier_name = 'C:/xampp/htdocs/cometh/file/projet/' .$hashed_name. '/' . pathinfo($file_name, PATHINFO_FILENAME);
		if (!file_exists($dossier_name)) {
			mkdir($dossier_name, 0777, true);
		}
		$upload_dir = $dossier_name.'/'. basename($_FILES['file']['name']);

		move_uploaded_file($tmp_path, $upload_dir);


		$this->loadModel("User");
		$fichier_projet = $this->User->fichier_projet($file_name, $id_projet, $hashed_name);
		if ($fichier_projet == "true") {
			echo ("c est ok");
			echo json_encode($_POST);
		} else {
			echo ("erreur");
		}
	}


	public function fichier_tache()
	{


		$id_tache = $_POST['id_tache'];
		$tmp_path = $_FILES['filetache']['tmp_name'];
		$file_name = $_FILES['filetache']['name'];
		$file_contents = file_get_contents($tmp_path);
		$salt = bin2hex(random_bytes(16));
		$hashed_name = hash("sha256", $salt . $file_contents);
		$dossier_name = 'C:/xampp/htdocs/cometh/file/tache/'.$hashed_name. '/' . pathinfo($file_name, PATHINFO_FILENAME);
		if (!file_exists($dossier_name)) {
			mkdir($dossier_name, 0777, true);
		}
		$upload_dir = $dossier_name.'/'. basename($_FILES['filetache']['name']);

		move_uploaded_file($tmp_path, $upload_dir);


		$this->loadModel("User");
		$fichier_tache = $this->User->fichier_tache($file_name, $id_tache, $hashed_name);
		if ($fichier_tache == "true") {
			echo ("c est ok");
			echo json_encode($_POST);
		} else {
			echo ("erreur");
		}
	}
}
