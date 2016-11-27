<?php
include '..\handler\accountHandler.php';
include '..\handler\dbHandler.php';


function updateUser($emailAddress){
$DBLink=DBLogin();
$querySelectionUser = "SELECT * from customers WHERE emailaddress = " . "'" . $emailAddress . "';";
$selectUser = mysqli_query($DBLink, $querySelectionUser);
$oldUser=array(
		$selectUser["id"], 
		$selectUser["firstname"], 
		$selectUser["lastname"], 
		$selectUser["password"], 
		$selectUser["address1"],
		$selectUser["housenumber"],
		$selectUser["city"],
		$selectUser["zipcode"],
		$selectUser["emailaddress"]
		);



$newfirstName="admin";
$newLastName="admin";
$newPassword=HashPW($password);
$newAddress1="adminstreet";
$newHouseNumber=0;
$newCity="adminville";
$newZipCode="12345";
$newEmailAddress="admin@example.com";

$user=array(
		$selectUser["id"], 
		$newfirstName, 
		$newLastName, 
		$newPassword, 
		$newAddress1, 
		$newHouseNumber, 
		$newCity, 
		$newZipCode, 
		$newEmailAddress);

$userUpdate=array_merge($oldUser, $user);

$updatedUser = AlterUser($DBLink, $userUpdate);

if (!$updatedUser){
	echo date("Y-M-d G:i:s", time()) . " : [newCustomer.newUser] user update failed " . "</br>" . PHP_EOL;
	echo date("Y-M-d G:i:s", time()) . " : [newCustomer.newUser] Debugging Err.No: " . mysqli_errno($DBLink) . "</br>" . PHP_EOL;
	echo date("Y-M-d G:i:s", time()) . " : [newCustomer.newUserr] Debugging Error: " . mysqli_error($DBLink) . "</br>" . PHP_EOL;
	exit;
}else{
	echo date("Y-M-d G:i:s", time()) . " : [newCustomer.newUser] successfully updated user with login " . $$EmailAddress . "</br>" . PHP_EOL;
}

DBLogout($DBLink);

}