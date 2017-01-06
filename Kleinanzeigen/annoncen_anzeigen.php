<?php
$titel = "Annoncen_anzeigen";
include ("headMaster.php");
    
include ("dbMaster.php");

$annonce = $_GET["annonce"];

$sql = "SELECT annoncen.annoncenID, rubrik.rubrik, annoncen.titel, annoncen.text, annoncen.priceFromSeller, annoncen.visitors FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID WHERE annoncen.annoncenID='$annonce'";

$result = mysqli_query($conn, $sql);


while($row = mysqli_fetch_assoc($result)) 
{    
    echo "<h2>" . $row["rubrik"] . "</h2>"
       . "<h3>" . $row["titel"] . "</h3>"
       . "<p>" . $row["text"] . "</p>"
       . "<h3><b>" . $row["priceFromSeller"] . " <span class='glyphicon glyphicon-euro'></span></b></h3>";

    
       $sql2 = "SELECT annoncen.annoncenID, pictures.picturename FROM annoncen LEFT JOIN pictures ON annoncen.annoncenID = pictures.annoncenID WHERE annoncen.annoncenID='$annonce'";
       $result2 = mysqli_query($conn, $sql2);
       
       while($row = mysqli_fetch_assoc($result2)) 
       {
            echo "<a href='./pictures/" . $row['picturename'] . "'><img src='./pictures/" . $row['picturename'] . "' style='width:100px;'/></a>";
       }
    
    $visitors = $row["visitors"];
    $visitors++;
    $sqlAnswer = "UPDATE annoncen SET visitors='$visitors' WHERE annoncenID=$annonce";
    mysqli_query($conn, $sqlAnswer);
}

mysqli_close($conn);   

include("foodMaster.php");
?>
