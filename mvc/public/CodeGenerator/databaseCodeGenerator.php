<?php

class DatabaseCodeGenerator{
	/*
	'fieldName'
	'required'
	'defaultVal'
	'dataType'
	*/
	// creates insert query for serialize array
	public function createInsertQuery($tableData){
		$tableName = "";
		$fields = "";
		foreach($tableData[1] as $fieldData){
			$fields .= $fieldData['fieldName'].",";
		}
		$fields = substr($fields,0,-1);
		$query = "INSERT INTO ".$tableData[0]['tableName']."($fields) VALUES ()";
		echo $query;
	}
	
	public function queryModel($arrayDataHere){
		
	}

	public function createUpdateQuery($tableData){
		echo "UPDATE $tableData[0] SET WHERE 1";
	}
	
	
	
	
	
}