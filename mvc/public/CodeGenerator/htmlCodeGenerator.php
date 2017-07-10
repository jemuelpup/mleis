<?php
require_once 'generalFunctions.php';
/*
Notes:
$tableData[0] - contains table name
$tableData[1] - contains table fields
*/

class HTMLCodeGenerator{
	
	// Forms area
/*
	Description: This function generates input fields
	Param:	tableData - array of table and columns
			allowPlaceHolder - boolean
*/
	public function generateInputFields($tableData,$allowPlaceHolder,$convertToText){
		$gFunc = new GeneralFunction;
		$placeHolderCode = "";
		$value = '';
		echo $tableData[0]['tableName']."<br>";
		
		foreach($tableData[1] as $fieldData){
			$field=trim($fieldData["fieldName"]);
			if($fieldData["defaultVal"]!=''){
				$value = " value=".$fieldData["defaultVal"];
			}
			if($allowPlaceHolder)
				$placeHolderCode = "placeholder='".$fieldData["fieldName"]."'";
			if($field!=''){
//				echo $this->getDataType($fieldData["dataType"]);
				$code = "<input $placeHolderCode type='".$gFunc->getDataType($fieldData["dataType"])."' name='".$fieldData["fieldName"]."' class='validate'".$this->getRequired($fieldData["required"])."$value>
				<label for='".$fieldData["fieldName"]."'>".$fieldData["fieldName"]."</label>";
				if($convertToText)
					$code = $this->converthtmlToText($code);
				echo $code."<br>";
			}
		}
	}
	
	public function createReports($tableData){

	}
	
/*************************************************************
* Private functions
*************************************************************/
	
	private function getRequired($required){
		if($required)
			return " required";
		return "";
	}

	// This function converts html code to text in browser
	private function converthtmlToText($code){
		$code = str_replace("<","&lt;",$code);
		$code = str_replace(">","&gt;",$code);
		return $code;
	}

}