<?php
include 'session.php';

if ($_POST['controlmethod'] == 'editUser' && ($_POST['kennwort'] == $_POST['kennwortRepeat']) && $_SESSION["eingeloggt"]){
	$hashedPW = HashPW($_POST['kennwort']);
	$mysqliSeparator = "', '";
	$mysqliSeparatorNoTrailingApostrophe = "', ";
	$mysqliSeparatorNoLeadingApostrophe = ", '";
	$query = "UPDATE customers SET
					firstname = '".$_POST['vorname'] . $mysqliSeparatorNoTrailingApostrophe
					. "lastname = '".$_POST['nachname'] . $mysqliSeparatorNoTrailingApostrophe
					. "passcode = '".$hashedPW . $mysqliSeparatorNoTrailingApostrophe
					. "address1 = '".$_POST['strasse'] . $mysqliSeparatorNoTrailingApostrophe
					. "houseNumber = ".$_POST['hausnummer'] . ", "
							. "city = '".$_POST['stadt'] . $mysqliSeparatorNoTrailingApostrophe
							. "zipcode = '".$_POST['plz'] . $mysqliSeparatorNoTrailingApostrophe
							. "emailaddress = '".$_POST['benutzername'] ."'"
									. ");";

									$ResultEditUser = mysqli_query($conn, $query);
									#$newUser = AddUser($conn, $_POST['vorname'], $_POST['nachname'], $hashedPW,
									#$_POST['strasse'], $_POST['hausnummer'], $_POST['stadt'], $_POST['plz'], $_POST['benutzername']);
									if ($ResultEditUser){
										$_SESSION["eingeloggt"] = $_POST['benutzername'];
									}else{
										echo date("Y-M-d G:i:s", time()) . " : [session.editUser] db connection closing failed " . "</br>" . PHP_EOL;
										echo date("Y-M-d G:i:s", time()) . " : [session.editUser] Debugging Err.No: " . mysqli_errno($conn) . "</br>" . PHP_EOL;
										echo date("Y-M-d G:i:s", time()) . " : [session.editUser] Debugging Error: " . mysqli_error($conn) . "</br>" . PHP_EOL;
										echo "Benutzer editieren fehlgeschlagen, bitte überprüfen sie die Eingabe und danach erneut versuchen";
									}

}