<?php

class SystemProcess{
	public function login(){
		echo 'This is login';
	}
	
	public function logout(){
		echo 'This is logout';
	}
	
}

class DBAccess extends SystemProcess{
	public function __construct(){
		$this->login();
	}
}