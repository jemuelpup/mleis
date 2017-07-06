<?php

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
		$placeHolderCode = "";
		echo $tableData[0]['tableName']."<br>";
		
		foreach($tableData[1] as $fieldData){
			$field=trim($fieldData["fieldName"]);
			if($allowPlaceHolder)
				$placeHolderCode = "placeholder='".$fieldData["fieldName"]."'";
			if($field!=''){
//				echo $this->getDataType($fieldData["dataType"]);
				$code = "<input $placeHolderCode type='".$this->getDataType($fieldData["dataType"])."' name='".$fieldData["fieldName"]."' class='validate'".$this->getRequired($fieldData["required"])." value=".$fieldData["defaultVal"].">
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
	private function getDataType($dataType){
		
		if(preg_match("/[a-zA-z]+/", $dataType, $matches)){
			$dataType = $matches[0];
		}
		$numeric = array(
			"INT",
			"TINYINT",
			"SMALLINT",
			"MEDIUMINT",
			"BIGINT",
			"DECIMAL",
			"FLOAT",
			"DOUBLE",
			"REAL",
			"BIT",
			"BOOLEAN",
			"SERIAL");
		$string = array(
			"VARCHAR",
			"TEXT",
			"CHAR",
			"VARCHAR",
			"TINYTEXT",
			"TEXT",
			"MEDIUMTEXT",
			"LONGTEXT",
			"BINARY",
			"VARBINARY",
			"TINYBLOB",
			"MEDIUMBLOB",
			"BLOB",
			"LONGBLOB",
			"ENUM",
			"SET");
		$dateAndTime = array(
			"DATE",
			"DATETIME",
			"TIMESTAMP",
			"TIME",
			"YEAR");
		$spatial = array(
			"GEOMETRY",
			"POINT",
			"LINESTRING",
			"POLYGON",
			"MULTIPOINT",
			"MULTILINESTRING",
			"MULTIPOLYGON",
			"GEOMETRYCOLLECTION");
		
		
		foreach($numeric as $n){if(strcasecmp($n,$dataType)===0){return 'number';}}
		foreach($string as $n){if(strcasecmp($n,$dataType)===0){return 'text';}}
		foreach($dateAndTime as $n){if(strcasecmp($n,$dataType)===0){return 'date';}}
		foreach($spatial as $n){if(strcasecmp($n,$dataType)===0){return 'spacial';}}
		
		
		
	}
	// This function converts html code to text in browser
	private function converthtmlToText($code){
		$code = str_replace("<","&lt;",$code);
		$code = str_replace(">","&gt;",$code);
		return $code;
	}

}