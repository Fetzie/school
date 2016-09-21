<?php
include 'dbHandler.php';

echo date("Y-M-d G:i:s", time()) . " : [processSelect] page loaded, php works" . "</br>" . PHP_EOL;

$insertString = "TestFirstFirstName', 'TestFirstFamilyName', '2016-08-27', 'customer@email.com";
$insertTable = "customerdata";	
$insertColumns = "firstName, familyname, registrationdate, emailAddress";
$selectString = "SELECT * FROM customerdata";
ImportConnectionTest();

$dbLink = DBLogin("localhost", "root", "", "phpClass", "3306");
$resultInsert = DBInsert($dbLink,$insertTable, $insertColumns, $insertString);

if (!$dbLink){
	echo date("Y-M-d G:i:s", time()) . " : [processSelect] not connected";
}


if (!$resultInsert){
	echo date("Y-M-d G:i:s", time()) . " : [processSelect] insert unsuccessful";
	
}else{
	$resultSelect = DBSelect($dbLink, $insertTable, $insertColumns, "");
}

if (mysqli_num_rows($resultSelect) > 0){
	echo date("Y-M-d G:i:s", time()) . " : [processSelect] contents of table: " . "</br>";
	// output data of each row
	while($row = mysqli_fetch_assoc($resultSelect)) {
		
		echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " ; Family Name: " . $row["familyname"] . " ; registration date: " . $row["registrationdate"] . "<br>";
	}
	} else {
		echo date("Y-M-d G:i:s", time()) . " : [processSelect] 0 results";
}

$loggedOut = DBLogout($dbLink);
if (!$loggedOut){
	echo date("Y-M-d G:i:s", time()) . " : [processSelect] logout failed!" . "</br>";
}echo date("Y-M-d G:i:s", time()) . " : [processSelect] logout successful!" . "</br>";