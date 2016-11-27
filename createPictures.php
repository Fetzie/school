<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpClass";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Verbindungsfehler: " . mysqli_connect_error());
    }

    // sql to create table
    $sql = "CREATE TABLE pictures (
    pictureID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    annoncenID INT(6) NOT NULL,
    picturename VARCHAR(30) NOT NULL,
    filename VARCHAR(30) NOT NULL
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Tabelle pictures erfolgreich erzeugt";
    } else {
        echo "Fehler bei der Erzeugung der Tabelle: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>