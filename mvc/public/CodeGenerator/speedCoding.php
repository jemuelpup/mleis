<html><head><style>html{background-color: #f1f1f1;}</style></head></html>


<?php
	require_once 'databaseCodeGenerator.php';
	require_once 'phpCodeGenerator.php';
	require_once 'htmlCodeGenerator.php';
	require_once 'queryFormatter.php';

	// Variable Declaration
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
	$tableData = [];
	$fileNamesArray = array("admin","home","login","report");

	$functionNameArray = array("addTeams","addPositions","addEmployees","addCustomers","update Emplyoyee",
"update Position",
"update Teams",
"update customers",
"add account",
"add transaction",
"add reports","get positions","get teams","get customers","get employees",
"Login");



	// Class instantiation
	$qf = new QueryFormatter;
	$htmlCG = new HTMLCodeGenerator;
	$phpCG = new PHPCodeGenerator;
	$dbcg = new DatabaseCodeGenerator;
	$tableData = $qf->formatQuery($query);
	


// Operations
	if(count($tableData)){
		
		// create mvc folders and files
//		$phpCG->createFoldersForMVC("tempFiles",$fileNamesArray);
		
		// create input forms
//		$htmlCG->generateInputFields($tableData,true,false);
		
		// insert query function
		$dbcg->createInsertQuery($tableData);echo "<br>";
		
		// this is query formatter function
//		$phpCG->getNumberFields($tableData);echo "<br>";
		
		// create function code here
//		$phpCG->createFunctionsCode($functionNameArray);
		
	}
	


	// Function calls



?>
































