<?php
/***
 * Contains generic functions to manipulate user accounts
 * Functions return the DB_object from the query where applicable when called
 * Events are logged to main output, can be commented out where applicable
 * 
 * 
 * @author tanson anson@starface.de
 * @copyright 2016 - 2017 Thomas Anson
 * Unauthorized distribution and re-use explicitly prohibited without prior written consent from author
 */

/**
 * @param DBSession $DBLink
 * @param String $firstName
 * @param String $LastName
 * @param String $Password
 * @param String $Address1
 * @param int $HouseNumber
 * @param String $City
 * @param String $ZipCode
 * @param String $EmailAddress
 * @return Returns success of user insert
 */
function AddUser($DBLink, $firstName, $LastName, $Password, $Address1, $HouseNumber, $City, $ZipCode, $EmailAddress){
	$HashedPW = HashPW($Password);
	
	$query = "INSERT INTO customers 
			(firstname, lastname, emailaddress, address1, housenumber, city, zipcode, password) VALUES 
			('".$firstName."', '".$LastName."', '".$EmailAddress."', '".$Address1."', '".$HouseNumber."', '"
					.$City."', '".$ZipCode."', '".$HashedPW."');";
	$ResultAddUser = mysqli_query($DBLink, $query);
		if (!$ResultAddUser){
			echo date("Y-M-d G:i:s", time()) . " : [accountHandler.AddUser] insert failed " . "</br>" . PHP_EOL;
			echo date("Y-M-d G:i:s", time()) . " : [accountHandler.AddUser] Debugging Err.No: " . mysqli_errno($DBLink) . "</br>" . PHP_EOL;
			echo date("Y-M-d G:i:s", time()) . " : [accountHandler.AddUser] Debugging Error: " . mysqli_error($DBLink) . "</br>" . PHP_EOL;
			exit;
		}
		echo date("Y-M-d G:i:s", time()) . " : [accountHandler.AddUser] successfully added user " . $firstName . $LastName . "</br>" . PHP_EOL;;
	
	return $ResultAddUser;
}

/**
 * 
 * @param DBSession $DBLink
 * @param String $EmailAddress
 * @return unknown
 */
function DeleteUser($DBLink, $userEmailAddress, $session){
	LogoutUser($session);
	$query = "DELETE FROM customers where email = '".$userEmailAddress."';";
	$ResultDeleteUser = mysqli_query($DBLink, $query);
	
	return $ResultDeleteUser;
	
}

/*
 * Take array from the user data after alteration is submitted
 * compare it to the DB selection for the user
 * update the fields that are different
 * 
 */

function AlterUser($DBLink, $user){
	
	
	
	
	$userID = $user["id"];
	$userFirstName = $user["firstName"];
	$userLastName = $user["lastName"];
	$password = HashPW($user["password"]);
	$address = $user["address1"];
	$houseNumber = $user["houseNumber"];
	$zipCode = $user["zipCode"];
	$city = $user["city"];
	$emailaddress = $user["emailaddress"];
	
	$query = "UPDATE customers SET 'firstName' = " . $userFirstName . 
									" 'lastName' = " . $userLastName . 
									" 'password' = " . $password . 
									" 'address1' = " . $address . 
									" 'houseNumber' = " . $houseNumber . 
									" 'zipCode' = " . $zipCode . 
									" 'city' = " . $city . 
									" 'email' = " . $EmailAddress .
									" WHERE id = '" . $userID . "';";
	$alterResult = mysqli_query($DBLink, $query);
	
	return $alterResult;
	
	
}

function addPaymentMethodForUser($DBLink, $cardType, $name, $cardNumber, $cardSecurity, $cardExpiry, $userID){
	$hashedName = sha1($name);
	$hashedCardNumber = sha1($cardNumber);
	$hashedSecurity = sha1($cardSecurity);
	$hashedCardExpiry = sha1($cardExpiry);
	
	switch (cardType){
		
		case "BANKEINZUG": $cardType = "0";
		case "VISA": $cardType = "1";
		case "MASTERCARD": $cardType = "2";
		case "ONLINE-UEBERWEISUNG": $cardType = "3";
	};
	
	$query = "INSERT INTO customerPayments (customerid, paymentmethod, cardnumber, expires, secNumber, cardname) VALUES '" 
															. $userID . "', "
															. $cardType . "', "		
															. $hashedCardNumber . "', "
															. $hashedCardExpiry . "', "
															. $hashedSecurity . "', "
															. $hashedName . "';";
	$newUserPaymentOption = mysqli_query($DBLink, $query);
	return $newUserPaymentOption;														
}

function deletePaymentMethod(){
	
	
}

function changePassword($DBLink, $password, $emailAddress){
	#$hashedPW = HashPW($password);
	
	$query = "UPDATE customers SET password = '" . $password . "' WHERE emailAddress = '" . $emailAddress . "';";
	
	$alterPassword = mysqli_query($DBLink, $query);
}

function HashPW($password){
	
	$hashValue = sha1($password);
	
	return $hashValue;
	
}

function LogoutUser($session){
	
	$loggedOut = session_destroy($session);
	return $loggedOut;
	
}

function LoginUser($sessionId){
	$session = session_start($sessionId);
	return $session;
}


function AuthenticateUser($login, $DBLink){
	$query = "SELECT password from customers where emailaddress = " . "'" . $login . "';";
	echo $query . PHP_EOL;
	$returnedPw = mysqli_query($DBLink, $query);
	if (!$returnedPw){
		echo date("Y-M-d G:i:s", time()) . " : [accountHandler.AuthenticateUser] Getting AuthData failed " . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [accountHandler.AuthenticateUser] Debugging Err.No: " . mysqli_errno($DBLink) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [accountHandler.AuthenticateUser] Debugging Error: " . mysqli_error($DBLink) . "</br>" . PHP_EOL;
		exit;
	}
	echo date("Y-M-d G:i:s", time()) . " : [accountHandler.AuthenticateUser] Retrieving AuthData successful" . "</br>" . PHP_EOL;
	return $returnedPw;
}