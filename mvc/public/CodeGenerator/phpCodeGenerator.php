<?php
require_once 'generalFunctions.php';

class PHPCodeGenerator extends DatabaseCodeGenerator{
	
	function createFoldersForMVC($rootDIR,$mvcFileNameArray){
		$this->createMVCFolder($rootDIR);
		foreach($mvcFileNameArray as $mvcFA){
			$this->createView($rootDIR,$mvcFA);
			$this->createController($rootDIR,$mvcFA);
			$this->createModel($rootDIR,$mvcFA);
		}
	}
	
	function getNumberFields($tableData){
		$gFunc = new GeneralFunction;
		$numfields = "";
		foreach($tableData[1] as $fieldData){
			$dataType = $gFunc->getDataType($fieldData["dataType"]);
			if($dataType=='number')
				$numfields .= "\"".trim($fieldData["fieldName"])."\",";
		}
		$numfields = "\$numFields = array($numfields);";
		echo "$numfields";
	}
	
	function createFunctionsCode($fArray){
		foreach($fArray as $fa){
			$fa = str_replace(' ','',$fa);
			$fa = lcFirst($fa);
			echo "function $fa(\$data){<br><br>}<br>";
		}
	}
	
	

	// creates controller file in given directory
	private function createController($rootDIR,$filename){
		$model="";
		if(!file_exists ("$rootDIR/controllers/$filename.php")){
			$className = ucfirst($filename);
			$file = fopen("$rootDIR/controllers/$filename.php", "w");
			$code = "<?php\nclass $className extends Controller{
	public function index(){
	\t\$this->model('".$className."_model');
	\t\$this->view('".lcfirst($className)."/');
	}\n}";
			fwrite($file, $code);
			fclose($file);
		}
	}
	// creates model file in given directory
	private function createModel($rootDIR,$filename){
		if(!file_exists ("$rootDIR/models/$filename.php")){
			$file = fopen("$rootDIR/models/$filename.php", "w");
			$code = "<?php\nclass ".ucfirst($filename)."_model{\n\n}";
			fwrite($file, $code);
			fclose($file);
		}
	}
	// creates model folder and file in given directory
	private function createView($rootDIR,$filename){
		if(!file_exists ("$rootDIR/views/$filename"))
			mkdir("$rootDIR/views/$filename");
		if(!file_exists ("$rootDIR/views/$filename/index.php"))
			fopen("$rootDIR/views/$filename/index.php", "w");
		
	}
	// creates MVC folder
	public function createMVCFolder($rootDIR){
		if(!file_exists ("$rootDIR/models"))
			mkdir("$rootDIR/models");
		if(!file_exists ("$rootDIR/views"))
			mkdir("$rootDIR/views");
		if(!file_exists ("$rootDIR/controllers"))
			mkdir("$rootDIR/controllers");
	}

}
