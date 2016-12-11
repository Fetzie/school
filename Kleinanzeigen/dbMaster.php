<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpclass2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn)
{
    die("Verbindungsfehler: " . mysqli_connect_error());
}