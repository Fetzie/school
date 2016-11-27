<?php

function addDays($ID)
{
    include("dbMaster.php");
      global $conn;
        
        $annonce = $_GET["annonce"];
        
        $sql = "SELECT annoncenID, timeToDeath FROM annoncen WHERE annoncenID='$annonce'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) 
        {
               $ID = $row["annoncenID"];
               $timeToDeath = $row["timetoDeath"];
               #$row["priceFromSeller"]        
        }

        mysqli_close($conn);   
    $timeToDeath = date('Y-m-d', strtotime('+ 30 days'));
    $priceCalc = array($price, $timeToDeath);
    return $priceCalc;
    exit;
}