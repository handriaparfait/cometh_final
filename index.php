<?php

//On génère une constante qui contiendra le chemin vers index.php
define('ROOT' , str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Controller.php');

//on sépare les paramètres
session_start();
$params = explode('/', $_GET['p']);

if($params[0] != ""){
	$controller = ucfirst($params[0]);
	$action = isset($params[1]) ? $params[1] : 'index';
	require_once(ROOT.'controllers/'.$controller.'.php');
	$controller = new $controller();
	if(method_exists($controller, $action)){
		//$controller->$action();
		unset($params[0]);
		unset($params[1]);
		call_user_func_array([$controller,$action],$params);
	}
	else{
		http_response_code(404);
		echo "La page demandé n'existe pas";
	}
}
else{
    if(!isset($_SESSION["id"])){
        $params = [];
        $controller    = "Logins";
        require_once(ROOT.'controllers/'.$controller . ".php");
        $action = "connexion";
        $controller = new $controller();
        call_user_func_array([$controller,$action], $params);
    }
    else{
        //rester sur la meme page
        header ("Location: users");
    }
}

?>