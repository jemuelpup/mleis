<?php
class Report extends Controller{
	public function index(){
		$this->model('Report_model');
		$this->view('report/');
	}
}