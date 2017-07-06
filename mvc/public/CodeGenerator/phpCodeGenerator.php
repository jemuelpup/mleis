<?php

class PHPCodeGenerator extends DatabaseCodeGenerator{
	
	function createFoldersForMVC($rootDIR,$mvcFileNameArray){
		$this->createMVCFolder($rootDIR);
		foreach($mvcFileNameArray as $mvcFA){
			
			$this->createView($rootDIR,$mvcFA);
			$this->createController($rootDIR,$mvcFA);
			$this->createModel($rootDIR,$mvcFA);
			echo $mvcFA;
		}
	}
	
	
	
	

	// creates controller file in given directory
	private function createController($rootDIR,$filename){
		if(!file_exists ("$rootDIR/controllers/$filename.php")){
			$file = fopen("$rootDIR/controllers/$filename.php", "w");
			$code = "<?php\nclass ".ucfirst($filename)."{\n\n}";
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
