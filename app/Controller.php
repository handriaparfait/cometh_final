<?php

abstract class Controller{
	
	public function loadModel(string $model){
        require_once(ROOT.'models/'.$model.'.php');
        $this->$model = new $model();
	}

	public function render(string $file, array $data = [], array $data2 = [], array $data3 = [], array $data4 =[], array $data5 = [], array $data6 = []){
		extract($data);
		extract($data2);
		extract($data3);
		extract($data4);
		extract($data5);
		extract($data6);
		ob_start();
		require_once(ROOT.'views/' . strtolower(get_class($this)) . '/' . $file . '.php');
		$content = ob_get_clean();
		require_once(ROOT.'views/layouts/default.php'); #pour toujours afficher le menu lat�ral peu importe la page
	}

	public function renderLogin(string $file){
		require_once(ROOT.'views/' . strtolower(get_class($this)) . '/' . $file . '.php');
	}
}

?>