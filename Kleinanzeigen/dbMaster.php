<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpclass2";
$port = "3306";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
#echo "connection established";
// Check connection
if (!$conn)
{
    die("Verbindungsfehler: " . mysqli_connect_error());
}