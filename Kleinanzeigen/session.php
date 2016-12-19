<?php
include("../handler/accountHandler.php");
include("./dbMaster.php");
session_start();

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
	
#$exists = DoesUserExist($_POST['benutzername'], $conn);
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
	#$newUser = AddUser($conn, $_POST['vorname'], $_POST['nachname'], $hashedPW,
				#$_POST['strasse'], $_POST['hausnummer'], $_POST['stadt'], $_POST['plz'], $_POST['benutzername']);
			if ($ResultAddUser){
				$_SESSION["eingeloggt"] = $_POST['benutzername'];
			}else{
				echo date("Y-M-d G:i:s", time()) . " : [session.createUser] db connection closing failed " . "</br>" . PHP_EOL;
				echo date("Y-M-d G:i:s", time()) . " : [session.createUser] Debugging Err.No: " . mysqli_errno($conn) . "</br>" . PHP_EOL;
				echo date("Y-M-d G:i:s", time()) . " : [session.createUser] Debugging Error: " . mysqli_error($conn) . "</br>" . PHP_EOL;
				echo "Benutzer erstellen fehlgeschlagen, bitte überprüfen sie die Eingabe und danach erneut versuchen";
			}
		}
	}
}
	
if ($_POST["controlmethod"] == "logonUser" && !isset($_SESSION["eingeloggt"])){
	 
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
		
		
		#$userdata = AuthenticateUser($_POST['benutzername'], $conn);
	
		/* for debugging...
		 * echo "username from form: " . $_POST['benutzername'] . "</br>" . PHP_EOL;
		echo "password from form: " . $_POST['kennwort'] . "</br>" . PHP_EOL;
		echo "hashed password from form: " . $hashedPW . "</br>" . PHP_EOL;
		echo "username from db: " . $userdata['username'] . "</br>" . PHP_EOL;
		echo "password from db: " . $userdata['password'] . "</br>" . PHP_EOL;
		*/
		if( $_POST['benutzername'] == $userdata['username'] && $hashedPW == $userdata['password'])
			{
				$_SESSION["eingeloggt"] = $_POST['benutzername'];
			}else{
					echo date("Y-M-d G:i:s", time()) . " : [session.logonUser] db connection failed " . "</br>" . PHP_EOL;
					echo date("Y-M-d G:i:s", time()) . " : [session.logonUser] Debugging Err.No: " . mysqli_errno($conn) . "</br>" . PHP_EOL;
					echo date("Y-M-d G:i:s", time()) . " : [session.logonUser] Debugging Error: " . mysqli_error($conn) . "</br>" . PHP_EOL;
					echo "Benutzer einloggen fehlgeschlagen, bitte überprüfen sie die Eingabe und danach erneut versuchen";
				}
	
}
	
if ($_POST["controlmethod"] == "editUser" && ($_POST['kennwort'] == $_POST['kennwortRepeat']) && isset($_SESSION["eingeloggt"])){
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


/* if(isset($_POST['benutzername']))
{
    if( $_POST['benutzername'] == "admin" && $_POST['kennwort'] == "admin")
    {
        $_SESSION["eingeloggt"] = $_POST['benutzername'];
    }
}
 */


/* logs out when visiting index
 * if(!isset($_SESSION["eingeloggt"]))
{
    header('Location: ./index.php');
    exit;
} */
                
        
/*if (! session_id()) session_start(); 

if (!isset($_SESSION['eingeloggt']) || $_SESSION['eingeloggt'] != true)
{
    header('Location: ./index.php');
    exit;
}
else 
{
    if (isset($_POST['benutzername']) AND isset($_POST['kennwort'] ))
    {
        // Kontrolle, ob Benutzername und Kennwort vorhanden
        // diese werden i.d.R. aus Datenbank ausgelesen
        if ( 
             $_POST['benutzername'] == "admin" 
             AND 
             $_POST['kennwort'] == "admin"
           )
        {
            $_SESSION['benutzername'] = $_POST['benutzername'];
            $_SESSION['eingeloggt'] = true;
            echo "<b>einloggen erfolgreich</b>";
        }
        else
        {
            echo "<b>ung?ltige Eingabe</b>";
            $_SESSION['eingeloggt'] = false;
        }
    }
}*/