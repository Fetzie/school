<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpClass";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn)
{
    die("Verbindungsfehler: " . mysqli_connect_error());
}