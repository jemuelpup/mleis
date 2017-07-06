<?php

class Home extends Controller{
	public function index(){
		//		$this->model('DBAccess');
		$this->model('Home_model');
		echo "nasahomesdf";
	}
	
	public function login(){
		echo "create login here";
		$this->view("home/login");
	}
}