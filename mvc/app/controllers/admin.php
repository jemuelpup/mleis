<?php
class Admin extends Controller{
	public function index(){
		$this->model('Admin_model');
		$this->view('admin/');
	}
}