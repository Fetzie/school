<?php
include("../handler/accountHandler.php");
include("./dbMaster.php");
session_start();


if(isset($_POST['benutzername'])){
	$hashedPW = HashPW($_POST['kennwort']);
	$exists = DoesUserExist($_POST['benutzername'], $conn);
/* 	if ($exists = false){
	
		$newUser = AddUser($conn, $_POST['vorname'], $_POST['nachname'], $hashedPW,
				$_POST['strasse'], $_POST['hausnummer'], $_POST['stadt'], $_POST['plz'], $_POST['benutzername']);
		if ($newUser){
			$_SESSION["eingeloggt"] = $_POST['benutzername'];
		}else{
			echo "Benutzer erstellen fehlgeschlagen, bitte überprüfen sie die Eingabe und danach erneut versuchen";
		}
	}else */
	{
	
		$userdata = AuthenticateUser($_POST['benutzername'], $conn);
	
		echo "username from form: " . $_POST['benutzername'] . PHP_EOL;
		echo "password from form: " . $_POST['kennwort'] . PHP_EOL;
		echo "hashed password from form: " . $hashedPW . PHP_EOL;
		echo "username from db: " . $userdata['emailaddress'] . PHP_EOL;
		echo "password from db: " . $userdata['password'] . PHP_EOL;
		if( $_POST['benutzername'] == $userdata['emailaddress'] && $hashedPW == $userdata['password'])
			{
				$_SESSION["eingeloggt"] = $_POST['benutzername'];
			}
	
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
if(!isset($_SESSION["eingeloggt"]))
{
    header('Location: ./index.php');
    exit;
}
                
        
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