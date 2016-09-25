<?php
/**
 * Contains generic functions to perform database operations to the selected database
 * Functions return the DB_object from the query where applicable when called
 * Events are logged to main output, can be commented out where applicable
 * 
 * 
 * @author tanson anson@starface.de
 * @copyright 2016 - 2017 Thomas Anson
 * Unauthorized distribution and re-use explicitly prohibited without prior written consent from author
 * 
 */


function ImportConnectionTest(){
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.importConnectionTest] import works" . "</br>" . PHP_EOL;
}


/**
 * 
 * @param unknown $host
 * @param unknown $user
 * @param unknown $password
 * @param unknown $database
 * @param unknown $port
 * @return unknown
 */
function DBLogin($host, $user, $password, $database, $port){
	
	
	$dbLink = mysqli_connect($host,$user,$password,$database,$port);
	
	// return error if unsuccessful
	if (!$dbLink){
		
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] Connection to " . $database . " failed" . "</br>";
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] Debugging Err.No: " . mysqli_errno($dbLink) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] Debugging Error: " . mysqli_error($dbLink) . "</br>" . PHP_EOL;
		exit;
	}
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] dbconnection to " . $database . " was successful" . "</br>" . PHP_EOL;
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] host information: " . mysqli_get_host_info($dbLink) . "</br>" . PHP_EOL;
	return $dbLink;
	
}

// close db connection
function DBLogout($dbLink){
	
	$closeResult = mysqli_close($dbLink);
	if (!$closeResult){
			
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogout] db connection closing failed " . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogout] Debugging Err.No: " . mysqli_errno($dbLink) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogout] Debugging Error: " . mysqli_error($dbLink) . "</br>" . PHP_EOL;
		exit;
	}
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogout] successfully closed connection" . "</br>" . PHP_EOL;
	return $closeResult;
	
}

/**
 * @param dbConnection $dbLink is the connection token obtained after establishing dbconnection
 * @param string $insertTable is the table into which data should be inserted
 * @param string $insertColumns is a string containing a comma separated list of columns for which data is inserted
 * @param string $insertValues is a string containing a comma separated list of values to be inserted
 * @return mysqli_result $resultInsert returns the contents
 */ 
function DBInsert($dbLink, $insertTable, $insertColumns, $insertValues){
	
	$insertString = "INSERT INTO " . $insertTable . " (" . $insertColumns . ") VALUES ('" . $insertValues . "');";
	$resultInsert = mysqli_query($dbLink, $insertString);
	if (!$resultInsert){
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBInsert] insert failed " . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBInsert] Debugging Err.No: " . mysqli_errno($dbLink) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBInsert] Debugging Error: " . mysqli_error($dbLink) . "</br>" . PHP_EOL;
		exit;
	}
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBInsert] successfully inserted " . $insertString . "</br>" . PHP_EOL;
	return $resultInsert;
}

/**
 * 
 * @param dbconnection $dbLink
 * @param String $updateTable
 * @param String $updateColumns
 * @param String $updateValues
 * @param String $updateFilter
 * @return mysqli_result $resultUpdate
 */
function DBUpdate($dbLink, String $updateTable, String $updateColumns, String $updateValues, String $updateFilter){
	
	if ($updateFilter != ""){
		$updateString = "UPDATE " . $updateTable . "SET " . $updateColumns . " = ('" . $updateValues . "')" . " WHERE " . $updateFilter . ";";
	}else {
		$updateString = "UPDATE " . $updateTable . "SET " . $updateColumns . " = ('" . $updateValues . "');";
	}
	$resultUpdate = mysqli_query($dbLink, $updateString);
	if (!$resultUpdate){
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBUpdate] update failed " . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBUpdate] Debugging Err.No: " . mysqli_errno($dbLink) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBUpdate] Debugging Error: " . mysqli_error($dbLink) . "</br>" . PHP_EOL;
		exit;
	}
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBUpdate] successfully updated " . $updateString . "</br>" . PHP_EOL;
	return $resultUpdate;
}


/**
 * 
 * @param unknown $dbLink
 * @param String $selectTable
 * @param String $selectColumns
 * @param String $selectFilter
 * @return mysqli_result $selectResult
 */
function DBSelect($dbLink, $selectTable, $selectColumns, $selectFilter){
	if ($selectFilter != ""){
		$selectString = "SELECT " . $selectColumns . " FROM " . $selectTable . " WHERE " . $selectFilter . ";";
		
	}
	$selectString = "SELECT " . $selectColumns . " FROM " . $selectTable . ";";
	$resultSelect = mysqli_query($dbLink, $selectString);
	$selection = mysqli_result::mysqli_fetch_assoc($resultSelect);
	if (!$resultSelect){
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBSelect] select failed " . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBSelect] Debugging Err.No: " . mysqli_errno($dbLink) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBSelect] Debugging Error: " . mysqli_error($dbLink) . "</br>" . PHP_EOL;
		exit;
	}else{
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBSelect] successfully selected " . $selectString . "</br>" . PHP_EOL;
	
	return $selection;
	}
}


/**
 * @param unknown $dbLink
 * @param String $deleteTable
 * @param String $deleteFilter
 * @return mysqli_result $deleteResult
 */
function DBDelete($dbLink, String $deleteTable, String $deleteFilter){
	
	$deleteString = "DELETE FROM " . $deleteTable . " WHERE " . $deleteFilter . ";";
	$resultDelete = mysqli_query($dbLink, $deleteString);
	if (!$resultDelete){
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBDelete] Delete failed " . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBDelete] Debugging Err.No: " . mysqli_errno($dbLink) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBDelete] Debugging Error: " . mysqli_error($dbLink) . "</br>" . PHP_EOL;
		exit;
	}
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBDelete] successfully deleted using " . $deleteString . "</br>" . PHP_EOL;
	return $resultDelete;
	
}