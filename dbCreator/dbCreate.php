<?php 
/**
 * executes contents of createDB.sql
 * 
 * @param unknown $fileName
 * @param unknown $host
 * @param unknown $user
 * @param unknown $password
 */
function writeDB($fileName, $host, $user, $password){

	$dbLink = mysqli_connect($host,$user,$password);
	
	if (!$dbLink){
	
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] Connection to " . $database . " failed" . "</br>";
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] Debugging Err.No: " . mysqli_errno($dbLink) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] Debugging Error: " . mysqli_error($dbLink) . "</br>" . PHP_EOL;
		exit;
	}
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] dbconnection to " . $database . " was successful" . "</br>" . PHP_EOL;
	echo date("Y-M-d G:i:s", time()) . " : [dbHandler.DBLogin] host information: " . mysqli_get_host_info($dbLink) . "</br>" . PHP_EOL;
	return $dbLink;
	
	$sql = explode(";",file_get_contents($fileName));

	foreach ($sql as $query)
		mysqli_query($DBLink, $query);
}

writeDB("phpclass.sql", "127.0.0.1", "root", "");

?>
