<?php
class Login extends Controller{
	public function index(){
		$this->model('Login_model');
		$this->view('login/');
	}
}