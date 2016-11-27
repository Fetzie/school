<?php

include './handler/accounthandler.php';
include './handler/dbHandler.php';

if (! session_id()) session_start(); 

if (!isset($_SESSION['eingeloggt']) || $_SESSION['eingeloggt'] != true)
{
    header('Location: http://localhost/Kleinanzeigen/index.php');
    exit;
}
else 
{
    if (isset($_POST['benutzername']) AND isset($_POST['kennwort'] ))
    {
        // Kontrolle, ob Benutzername und Kennwort vorhanden
        // diese werden i.d.R. aus Datenbank ausgelesen
        
    	$login=$_POST['benutzername'];
    	$password=$_POST['kennwort'];
    	$DBLink=DBLogin();
        $userStatus=AuthenticateUser($login, $DBLink);
        while ($row = mysqli_fetch_assoc($userStatus)){
        	if (HashPW($password) == $row['password']){
        		$_SESSION['benutzername'] = $_POST['benutzername'];
        		$_SESSION['eingeloggt'] = true;
        		echo "<b>einloggen erfolgreich</b>";
        	} else
	        {
    	        echo "<b>ung?ltige Eingabe</b>";
        	    $_SESSION['eingeloggt'] = false;
        	}
        }
    	
		DBLogout($DBLink);
    }
}