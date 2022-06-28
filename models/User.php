<?php

class User extends Model{

	public function __construct(){
		$this->table = "user";
		$this->getConnection();
	}
}
 
?>