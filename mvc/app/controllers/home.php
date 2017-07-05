<?php

class Home extends Controller{
	public function index(){
//		$this->model('DBAccess');
		echo "nasahomesdf";
	}
	
	public function login(){
		echo "create login here";
		$this->view("home/login");
	}
}