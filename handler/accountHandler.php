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
 * @return Returns success of user insert (bool)
 */
function AddUser($DBLink, $firstName, $LastName, $Password, $Address1, $HouseNumber, $City, $ZipCode, $EmailAddress){
	$ResultAddUser = false;
	$query = "INSERT INTO customers 
			(firstname, lastname, passcode, address1, housenumber, city, zipcode, emailaddress) VALUES 
			('".$firstName."', '".$LastName."', ".$Password."', '".$Address1."', '".$HouseNumber."', '"
					.$City."', '".$ZipCode."', '".$EmailAddress."');";
	
	$ResultAddUser = mysqli_query($DBLink, $query);
	
	return $ResultAddUser;
}

/**
 * 
 * @param DBSession $DBLink
 * @param String $EmailAddress
 * @return unknown
 */
function DeleteUser($DBLink, $userid, $session){
	LogoutUser($session);
	$Query = "DELETE FROM customer where email = '".$userid."';";
	$ResultDeleteUser = mysqli_query($DBLink, $Query);
	
	return $ResultDeleteUser;
	
}

/*
 * Take array from the user data after alteration is submitted
 * compare it to the DB selection for the user
 * update the fields that are different
 * 
 */

function AlterUser($DBLink, Array $user){
	
	$userID = $user["id"];
	$userFirstName = $user["firstName"];
	$userLastName = $user["lastName"];
	$password = HashPW($user["password"]);
	$address = $user["address1"];
	$houseNumber = $user["houseNumber"];
	$zipCode = $user["zipCode"];
	$city = $user["city"];
	$emailaddress = $user["email"];
	
	$query = "UPDATE customers SET firstName = '" . $userFirstName . 
									" ' lastName = '" . $userLastName . 
									" ' password = '" . $password . 
									" ' address1 = '" . $address . 
									" ' houseNumber = '" . $houseNumber . 
									" ' zipCode = '" . $zipCode . 
									" ' city = '" . $city . 
									" ' email = '" . $EmailAddress .
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

function DoesUserExist($emailaddress, $DBLink){
	$exists = false;
	$users = array();
	$userexists = mysqli_query($DBLink, "SELECT emailaddress from customers;");
	for ($i = 0; $i < ($row = mysqli_fetch_row($userexists)); $i++){

	array_push($users, $row[$i]);
	}
	for ($i = 0; $i < count($users); $i++){
		if ($emailaddress == $users[$i]){
			
			$exists = true;
			break;
		}
	}return $exists;
	
}function AuthenticateUser($login, $DBLink){
	$query = "SELECT emailaddress, passcode from customers where emailaddress = " . "'" . $login . "';";
	$userdata = array(['username'], ['password']);
	$returnedPw = mysqli_query($DBLink, $query);
	while ($row = mysqli_fetch_assoc($returnedPw)){
		//echo $row['emailaddress']."</br>";
		//echo $row['passcode']."</br>";
		$email = $row['emailaddress'];
		$password = $row['passcode'];
		$userdata['username'] = $email;
		$userdata['password'] = $password;
	}		
	return $userdata;
}

?>