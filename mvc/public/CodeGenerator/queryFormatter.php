<?php

class QueryFormatter{

	public function __construct(){
		
	}
	
	public function formatQuery($query){

		$tableName = "";
		$arrayData = [];
		$fields = [];

		if($this->validateQuery($query)){
			$query = str_replace("CREATE TABLE IF NOT EXISTS","",$query);
			$query = str_replace("ENGINE=InnoDB DEFAULT CHARSET=latin1;","",$query);
			$query = $this->removeComment($query);
			$tableName = $this->getTableName($query)[1];
			$query = $this->getTableName($query)[0];// trimed Query
			$query = substr(trim($query), 1, -1);
			$arrayQuery = preg_split("/(?<=,)(?=(?:(?:[^`'\"]*[`'\"]){2})*[^`'\"]*$)/",$query);

			$fieldName = '';
			$required = '';
			$defaultVal = '';
			$dataType = '';
			foreach($arrayQuery as $aq){
				$aq = $this->removeEndComma($aq);
				$fieldName = $this->removeBackqoute($this->getField($aq)[1]); $aq = $this->getField($aq)[0];
				$required = $this->getNotNull($aq)[1]; $aq = $this->getNotNull($aq)[0];
				$defaultVal = $this->getDefault($aq)[1]; $aq = $this->getDefault($aq)[0];
				$dataType = trim($aq);

				array_push($fields,array('fieldName' => $fieldName,'required' => $required,'defaultVal' => $defaultVal,'dataType' => $dataType));
			}
			array_push($arrayData,array("tableName"=>$tableName));
			array_push($arrayData,$fields);
		}
		return $arrayData;
	}
	
	private function removeBackqoute($str){
		return str_replace('`','',$str);
	}
	
	private function removeEndComma($str){
		if(substr($str, -1)==','){
			return rtrim($str,',');
		}
		return $str;
	}

	public function validateQuery($query){
		$charArray = str_split($query);
		$count = 0;
		$parenthesisChecking = false;
		$queryFieldsSection = "";
		foreach($charArray as $c){
			if($c=="("){
				if(!$parenthesisChecking){
					$parenthesisChecking = true;
				}
				$count++;
			}
			elseif($c==")"){
				$count--;
				if($parenthesisChecking and $count == 0){
					$queryFieldsSection .= $c;
					break;
				}
			}
			if($parenthesisChecking){
				$queryFieldsSection .= $c;
			}
		}

		return ($count==0);
	}
	public function removeComment($query){
		if(preg_match_all("/COMMENT.*'/", $query, $matches)){
			foreach($matches as $strMatch){
				$query = str_replace($strMatch,"",$query);
			}
		}
		return $query;
	}
	public function getTableName($query){
		$tableName = '';
		$tableNamePatternRx = "/`\w+`/";
		if(preg_match($tableNamePatternRx, $query, $matches)){
			$tableName = $matches[0];
			$query = str_replace($tableName,"",$query);
		}
		return [$query,$tableName];
	}

	public function getField($query){
		$field = '';
		if(preg_match("/`\w+`/", $query, $matches)){
			$field = $matches[0];
			$query = str_replace($field,"",$query);
		}
		return [$query,$field];
	}

	public function getNotNull($query){
		$notNull = false;
		if(preg_match("/(NOT NULL)/", $query, $matches)){
			$notNull = true;
			$query = str_replace("NOT NULL","",$query);
		}
		return [$query,$notNull];
	}

	public function getDefault($query){
		$defaultVal = '';
		$default = [];
		if(preg_match("/DEFAULT\s'.+'/", $query, $matches)){
//			$query = str_replace($matches[0],"",$query);
//			$default = explode(' ',$matches[0]);
//			print_r($default);
			$matches[0] = "delete123ThisDefault".$matches[0];
			
			$defaultVal = str_replace('delete123ThisDefaultDEFAULT','',$matches[0]);
			$query = str_replace($matches[0],"",$query);
		}
		if(isset($url[1])){
			$defaultVal = $url[1];
		}

		return [$query,$defaultVal];
	}
}
