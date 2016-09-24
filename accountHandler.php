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
function AddUser(DBSession $DBLink, String $firstName, String $LastName, String $Password, String $Address1, int $HouseNumber, String $City, String $ZipCode, String $EmailAddress){
	$HashedPW = HashPW($password);
	$query = "INSERT INTO customers 
			(firstname, lastname, email, password, address1, housenumber, city, zipcode) VALUES 
			('".$firstName."', '".$LastName."', ".$HashedPW."', '".$Address1."', '".$HouseNumber."', '"
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
function DeleteUser(DBSession $DBLink, String $EmailAddress){
	
	$Query = "DELETE FROM customers where email = '".$EmailAddress."';";
	$ResultDeleteUser = mysqli_query($DBLink, $Query);
	return $ResultDeleteUser;
	
}

/*
 * Take array from the user data after alteration is submitted
 * compare it to the DB selection for the user
 * update the fields that are different
 * 
 */

function AlterUser($DBLink, $EmailAddress, Array $user){
	
	$userID = $user["id"];
	$userFirstName = $user["firstName"];
	$userLastName = $user["lastName"];
	$password = HashPW($user["password"]);
	$address = $user["address1"];
	$houseNumber = $user["houseNumber"];
	$zipCode = $user["zipCode"];
	$city = $user["city"];
	
	$query = "UPDATE customers SET 'firstName' = " . $userFirstName . 
									" 'lastName' = " . $userLastName . 
									" 'password' = " . $password . 
									" 'address1' = " . $address . 
									" 'houseNumber' = " . $houseNumber . 
									" 'zipCode' = " . $zipCode . 
									" 'city' = " . $city . 
									" WHERE emailAddress = '" . $EmailAddress . "';";
	$alterResult = mysqli_query($DBLink, $query);
	
	return $alterResult;
	
	
}

function HashPW(String $password){
	
	$hashValue = sha1($password);
	return $HashValue;
	
}