<?php
/*
Note:
- This class separates the url and get the class, method, and prameters
*/
class App{
	/*
	$url[0] = class name/file name
	$url[1] = method
	$url[2...n] = parameter
	*/
	
	protected $controller = 'home';
	
	protected $method = 'index';
	
	protected $params = [];
	
	public function __construct(){
		$hasMethod = false;
		$url = $this->parseUrl();
		if(file_exists('../app/controllers/'.$url[0].'.php')){
			$this->controller = $url[0];
			unset($url[0]);
		}
		require_once '../app/controllers/'.$this->controller.'.php';
		$this->controller = new $this->controller;
		if(isset($url[1])){
			if(method_exists($this->controller,$url[1])){
				$hasMethod = true;
				$this->method = $url[1];
				unset($url[1]);
			}
		}
		$this->params = $url ? array_values($url) : [];
		if($hasMethod){
			call_user_func_array([$this->controller,$this->method],$this->params);
		}
	}
	
	public function parseUrl(){
		if(isset($_GET['url'])){
			return $url = explode('/',filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
		}
	}
}
