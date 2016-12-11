<?php
include("../handler/accountHandler.php");

session_start();

if(isset($_POST['benutzername']))
{
    if( $_POST['benutzername'] == "admin" && $_POST['kennwort'] == "admin")
    {
        $_SESSION["eingeloggt"] = $_POST['benutzername'];
    }
}

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