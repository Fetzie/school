<?php
include '..\handler\accountHandler.php';
include '..\handler\dbHandler.php';



$DBLink=DBLogin();
$querySelectionUser = "SELECT * from customers WHERE emailaddress = "
$selectUser = mysqli_query($DBLink, )

$firstName="admin";
$LastName="admin";
$Password="admin";
$Address1="adminstreet";
$HouseNumber=0;
$City="adminville";
$ZipCode="12345";
$EmailAddress="admin@example.com";

$newUser = AlterUser($DBLink, $firstName, $LastName, $Password, $Address1, $HouseNumber, $City, $ZipCode, $EmailAddress);

if (!$newUser){
	echo date("Y-M-d G:i:s", time()) . " : [newCustomer.newUser] user creation failed " . "</br>" . PHP_EOL;
	echo date("Y-M-d G:i:s", time()) . " : [newCustomer.newUser] Debugging Err.No: " . mysqli_errno($DBLink) . "</br>" . PHP_EOL;
	echo date("Y-M-d G:i:s", time()) . " : [newCustomer.newUserr] Debugging Error: " . mysqli_error($DBLink) . "</br>" . PHP_EOL;
	exit;
}else{
	echo date("Y-M-d G:i:s", time()) . " : [newCustomer.newUser] successfully added user with login " . $$EmailAddress . "</br>" . PHP_EOL;
}

DBLogout($DBLink);