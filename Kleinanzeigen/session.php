<?php
include("../handler/accountHandler.php");
include("dbMaster.php");
session_start();

function regexMatch($pattern, $subject){
	
	$result = preg_match($pattern, $subject);
	return $result;
	
}

$regexPatternName = "/(^[A-Z]{1})([a-z]+)/";
$regexPatternHouseNumber = "/[A-Za-z]*[ ]?[0-9]+[ ]?([A-Za-z]*)/";
$regexPatternZipCode = "/[0-9]{5}/";
$regexPatternEmail = "/[a-z1-9]*[-_.]*[a-z1-9]*@[a-z0-9]*([.][a-z]*){1,2}/";

if ($_POST["controlmethod"] == "createUser" && !isset($_SESSION["eingeloggt"])){
	
	if(isset($_POST['benutzername'])){
		$hashedPW = HashPW($_POST['kennwort']);
		$exists = false;
		$users = array();
		$userExistsQuery = "SELECT emailaddress from customers;";
		$userExists = mysqli_query($conn, "SELECT emailaddress from customers;");
		
		foreach (mysqli_fetch_row($userExists) as $row){
			array_push($users, $row);
		}
		
#		for ($i = 0; $i < ($row = mysqli_fetch_row($userExists)); $i++){
#
#			array_push($users, $row[$i]);
#		}
		for ($i = 0; $i < count($users); $i++){
			if ($_POST['benutzername'] == $users[$i]){
			
				$exists = true;
				break;
			}
		}
	
		# regex match for checking the data is realistic
		

		
		$matchFirstName = regexMatch($regexPatternName, $_POST['vorname']);
		$matchLastName = regexMatch($regexPatternName, $_POST['nachname']);
		$matchStreet = regexMatch($regexPatternName, $_POST['strasse']);
		$matchHouseNumber = regexMatch($regexPatternHouseNumber, $_POST['hausnummer']);
		$matchTown = regexMatch($regexPatternName, $_POST['stadt']);
		$matchZipCode = regexMatch($regexPatternZipCode, $_POST['plz']);
		$matchEmail = regexMatch($regexPatternEmail, $_POST['benutzername']);
		
		if($matchFirstName = $matchLastName = $matchStreet = $matchHouseNumber = $matchHouseNumber = $matchTown = $matchZipCode = $matchEmail == 1){
			
			if (!$exists && ($_POST['kennwort'] == $_POST['kennwortRepeat'])){
	
				$mysqliSeparator = "', '";
				$mysqliSeparatorNoTrailingApostrophe = "', ";
				$mysqliSeparatorNoLeadingApostrophe = ", '";
				$query = "INSERT INTO customers 
						(firstname, lastname, passcode, address1, housenumber, city, zipcode, emailaddress) 
						VALUES 
						('".$_POST['vorname'].$mysqliSeparator
							.$_POST['nachname'].$mysqliSeparator
							.$hashedPW.$mysqliSeparator
							.$_POST['strasse'].$mysqliSeparator 
							.$_POST['hausnummer'].$mysqliSeparator
							.$_POST['stadt'].$mysqliSeparator
							.$_POST['plz'].$mysqliSeparator
							.$_POST['benutzername']
							."');";
	
				$ResultAddUser = mysqli_query($conn, $query);
				
				if ($ResultAddUser){
					$_SESSION["eingeloggt"] = $_POST['benutzername'];
				}else{
					echo date("Y-M-d G:i:s", time()) . " : [session.createUser] db connection closing failed " . "</br>" . PHP_EOL;
					echo date("Y-M-d G:i:s", time()) . " : [session.createUser] Debugging Err.No: " . mysqli_errno($conn) . "</br>" . PHP_EOL;
					echo date("Y-M-d G:i:s", time()) . " : [session.createUser] Debugging Error: " . mysqli_error($conn) . "</br>" . PHP_EOL;
					echo "Benutzer erstellen fehlgeschlagen, bitte überprüfen sie die Eingabe und danach erneut versuchen";
				}
			}
		}else{
			echo "Ungültige Eingabe, bitte erneut versuchen";
		}
	}
}
	
if ($_POST["controlmethod"] == "logonUser" && !isset($_SESSION["eingeloggt"])){
	 
	
	# regex match for checking the data is realistic

	$matchEmail = regexMatch($regexPatternEmail, $_POST['benutzername']);
	
	if($matchEmail == 1){
	
		$email = null;
		$hashedPW = HashPW($_POST['kennwort']);
		$userdata = array(['username'], ['password']);
	
		$authenticationQuery = "SELECT emailaddress, passcode from customers where emailaddress = " . "'" . $_POST['benutzername'] . "';";
		$returnedPw = mysqli_query($conn, $authenticationQuery);
		while ($row = mysqli_fetch_assoc($returnedPw)){
			//echo $row['emailaddress']."</br>";
			//echo $row['passcode']."</br>";
			$email = $row['emailaddress'];
			$password = $row['passcode'];
			$userdata['username'] = $email;
			$userdata['password'] = $password;

		}
		

		if( $_POST['benutzername'] == $userdata['username'] && $hashedPW == $userdata['password'])
			{
				$_SESSION["eingeloggt"] = $_POST['benutzername'];
			}else{
				/* code jumps in here if login data not correct, else below is just to cover any other circumstances
				 * Right now we simply redirect to ./index which destroys the session
				 * TODO: error message to inform user
				 * Maybe make a landing page that automatically redirects to ./index after x seconds
				 */
				var_dump(http_response_code (401));
				header("Location: ./index.php"); /* Redirect browser */

				

				
					/* echo date("Y-M-d G:i:s", time()) . " : [session.logonUser] db connection failed " . "</br>" . PHP_EOL;
					echo date("Y-M-d G:i:s", time()) . " : [session.logonUser] Debugging Err.No: " . mysqli_errno($conn) . "</br>" . PHP_EOL;
					echo date("Y-M-d G:i:s", time()) . " : [session.logonUser] Debugging Error: " . mysqli_error($conn) . "</br>" . PHP_EOL; */
					exit();
				}
	}else{
		header("Location: ./index.php"); /* Redirect browser */
		$message = "Benutzer einloggen fehlgeschlagen, bitte überprüfen sie die Eingabe und danach erneut versuchen";
		echo "<script type='text/javascript'>alert('$message');</script>";
		exit();

	}
}
	
if ($_POST["controlmethod"] == "editUser" && ($_POST['kennwort'] == $_POST['kennwortRepeat']) && isset($_SESSION["eingeloggt"])){
	
	# regex match for checking the data is realistic
	
	$matchFirstName = regexMatch($regexPatternName, $_POST['vorname']);
	$matchLastName = regexMatch($regexPatternName, $_POST['nachname']);
	$matchStreet = regexMatch($regexPatternName, $_POST['strasse']);
	$matchHouseNumber = regexMatch($regexPatternHouseNumber, $_POST['hausnummer']);
	$matchTown = regexMatch($regexPatternName, $_POST['stadt']);
	$matchZipCode = regexMatch($regexPatternZipCode, $_POST['plz']);
	$matchEmail = regexMatch($regexPatternEmail, $_POST['benutzername']);
	
	if($matchFirstName = $matchLastName = $matchStreet = $matchHouseNumber = $matchHouseNumber
			= $matchTown = $matchTown = $matchZipCode = $matchEmail == 1){
	
	$hashedPW = HashPW($_POST['kennwort']);
	$mysqliSeparator = "', '";
	$mysqliSeparatorNoTrailingApostrophe = "', ";
	$mysqliSeparatorNoLeadingApostrophe = ", '";
	$query = "UPDATE customers SET
					firstname = '".$_POST['vorname'] . $mysqliSeparatorNoTrailingApostrophe 
						. "lastname = '".$_POST['nachname'] . $mysqliSeparatorNoTrailingApostrophe
						. "passcode = '".$hashedPW . $mysqliSeparatorNoTrailingApostrophe
						. "address1 = '".$_POST['strasse'] . $mysqliSeparatorNoTrailingApostrophe
						. "houseNumber = '".$_POST['hausnummer'] . $mysqliSeparatorNoTrailingApostrophe
						. "city = '".$_POST['stadt'] . $mysqliSeparatorNoTrailingApostrophe
						. "zipcode = '".$_POST['plz']
						. "' WHERE emailaddress = '". $_POST['benutzername'] . "';";
	
	$ResultEditUser = mysqli_query($conn, $query);

	if ($ResultEditUser){
		$_SESSION["eingeloggt"] = $_POST['benutzername'];
	}else{
		/* echo date("Y-M-d G:i:s", time()) . " : [session.editUser] db connection closing failed " . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [session.editUser] Debugging Err.No: " . mysqli_errno($conn) . "</br>" . PHP_EOL;
		echo date("Y-M-d G:i:s", time()) . " : [session.editUser] Debugging Error: " . mysqli_error($conn) . "</br>" . PHP_EOL; */
		echo "Benutzer editieren fehlgeschlagen, bitte überprüfen sie die Eingabe und danach erneut versuchen";
		}
	}else{
		echo "Benutzer editieren fehlgeschlagen, bitte überprüfen sie die Eingabe und danach erneut versuchen";
	}
}