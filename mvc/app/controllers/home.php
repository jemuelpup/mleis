<?php
class Home extends Controller{
	public function index(){
		$this->model('Home_model');
		$this->view('home/');
	}
}