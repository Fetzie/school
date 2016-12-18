<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "phpClass2";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Verbindungsfehler: " . mysqli_connect_error());
    }

    // sql to create table
    $sql = "CREATE TABLE annoncen (
    annoncenID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    birthdate DATE,
    rubrik VARCHAR(30) NOT NULL,
    titel VARCHAR(30) NOT NULL,
    text VARCHAR(1000) NOT NULL,
    pictureBox VARCHAR(30),
    priceFromSeller FLOAT NOT NULL,
    price FLOAT,
    date TIMESTAMP,
    timeToDeath DATE,
    days INT(12),
    visitors INT(12) NOT NULL DEFAULT '0',
    display BOOLEAN NOT NULL
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Tabelle annoncen erfolgreich erzeugt";
    } else {
        echo "Fehler bei der Erzeugung der Tabelle: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>