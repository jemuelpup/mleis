<?php
$data = $_POST['data'];// get process;
//print_r($data);
processData($data);
function processData($data){
	
	$query = '';
	foreach($data as $fieldAndValue){
		$query .= $fieldAndValue['name']."=".$fieldAndValue['value'].",";
	}
	
	$query = substr($query,0,-1);
	echo $query;
	
	
}