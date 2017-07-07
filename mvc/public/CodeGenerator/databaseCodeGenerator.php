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
		
		$query = "UPDATE deduction_tbl SET id=[value-1],name=[value-2],active=[value-3],placeholder=[value-4],inModal=[value-5],taxDeductable=[value-6],deleted=[value-7] WHERE 1";
	}
	
	
	
	
	
}