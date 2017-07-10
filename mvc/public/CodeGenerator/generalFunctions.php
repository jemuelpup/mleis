<?php

class GeneralFunction{
	public function getDataType($dataType){
		
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
	
}