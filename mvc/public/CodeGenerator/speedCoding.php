<?php

class HTMLCodeGenerator{
	public function generateInputFields($tableData){
		
	}
	public function createReports($tableData){
		
	}
}

class DatabaseCodeGenerator{
	public function __construct($tableData){
		
	}
	
	public function createInsertQuery($tableData){
		
	}
	
	public function createUpdateQuery($tableData){
		
	}
}

class PHPCodeGenerator extends DatabaseCodeGenerator{
	
	
}

class QueryFormatter{

	function formatQuery($query){

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
				$fieldName = $this->getField($aq)[1]; $aq = $this->getField($aq)[0];
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
	
	function validateQuery($query){
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
	function removeComment($query){
		if(preg_match_all("/COMMENT.*'/", $query, $matches)){
			foreach($matches as $strMatch){
				$query = str_replace($strMatch,"",$query);
			}
		}
		return $query;
	}
	function getTableName($query){
		$tableName = '';
		$tableNamePatternRx = "/`\w+`/";
		if(preg_match($tableNamePatternRx, $query, $matches)){
			$tableName = $matches[0];
			$query = str_replace($tableName,"",$query);
		}
		return [$query,$tableName];
	}
	
	function getField($query){
		$field = '';
		if(preg_match("/`\w+`/", $query, $matches)){
			$field = $matches[0];
			$query = str_replace($field,"",$query);
		}
		return [$query,$field];
	}

	function getNotNull($query){
		$notNull = false;
		if(preg_match("/(NOT NULL)/", $query, $matches)){
			$notNull = true;
			$query = str_replace("NOT NULL","",$query);
		}
		return [$query,$notNull];
	}

	function getDefault($query){
		$defaultVal = '';
		$default = [];
		if(preg_match("/DEFAULT\s'.+'/", $query, $matches)){
			$query = str_replace($matches[0],"",$query);
			$default = explode(' ',$matches[0]);
			$query = str_replace($matches[0],"",$query);
		}
		if(isset($url[1])){
			$defaultVal = $url[1];
		}

		return [$query,$defaultVal];
	}
}


$query = "
CREATE TABLE IF NOT EXISTS `tbl_overtime_request` (
`ot_request_id` int(11) NOT NULL,
  `ot_hours` int(11) NOT NULL COMMENT 'Minutes',
  `ot_timelog_id` int(11) NOT NULL,
  `ot_user_id` int(11) NOT NULL,
  `ot_filing_date` datetime NOT NULL,
  `ot_date` datetime NOT NULL,
  `ot_approval_date` date NOT NULL,
  `ot_reason` longtext NOT NULL,
  `ot_status_id` int(11) NOT NULL DEFAULT '3' COMMENT '3 = Pending | 2 = Disapproved | 1 = Approved',
  `ot_approveby_id` int(11) NOT NULL,
  `final_approved` int(11) NOT NULL DEFAULT '0' COMMENT '0 = pending | 1 = tl approved | 2 = manager approved',
  `ot_token` varchar(100) DEFAULT 'JEMUEL, ELIMANCO' NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$qf = new QueryFormatter;


print_r($qf->formatQuery($query));

//$htmlCG = new HTMLCodeGenerator();


?>