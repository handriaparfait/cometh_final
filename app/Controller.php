<?php

abstract class Controller{
	
	public function loadModel(string $model){
        require_once(ROOT.'models/'.$model.'.php');
        $this->$model = new $model();
	}

	public function render(string $file, array $data = [], array $data2 = []){
		extract($data);
		extract($data2);
		ob_start();
		require_once(ROOT.'views/' . strtolower(get_class($this)) . '/' . $file . '.php');
		$content = ob_get_clean();
		require_once(ROOT.'views/layouts/default.php');
	}

	public function renderLogin(string $file){
		require_once(ROOT.'views/' . strtolower(get_class($this)) . '/' . $file . '.php');
	}
}

?>