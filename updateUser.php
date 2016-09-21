<?php
include 'accountHandler.php';
include 'dbHandler.php';

$DBLink = DBLogin("localhost", "root", "", "phpClass", "3306");


$table = "customerdata";
$EmailAddress = "customer1@email.com";
$userData = DBSelect($DBLink, $table, "*", "emailAddress = 'customer1@email.com'");
if (mysqli_num_rows($userData) > 0){
	echo date("Y-M-d G:i:s", time()) . " : [processSelect] contents of table: " . "</br>";
	// output data of each row
	while($row = mysqli_fetch_assoc($userData)) {

		echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " ; Family Name: " . $row["familyname"] . " ; registration date: " . $row["registrationdate"] . $row["emailAddress"] . "<br>";
	}
} else {
	echo date("Y-M-d G:i:s", time()) . " : [processSelect] 0 results";
}
$user = mysqli_fetch_assoc($userData);
AlterUser($DBLink, $EmailAddress, $user);