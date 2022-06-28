<?php

class Articles extends Controller{
	
	public function index(){
		$this->loadModel("Article");
		$articles = $this->Article->getAll();
		//$this->render('index', ['articles' => $articles]);
		$this->render('index', compact('articles'));
	}

	public function lire($id){
		$this->loadModel('Article');
		$article = $this->Article->findById($id);
		$this->render('lire', compact('article'));
	}

}

?>