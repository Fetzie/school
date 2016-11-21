<?php
$titel = "Annoncen_anzeigen";
include ("headMaster.php");
    
include ("dbMaster.php");

$annonce = $_GET["annonce"];

//$sql = "SELECT annoncen.annoncenID, rubrik.rubrik, annoncen.titel, annoncen.text, annoncen.priceFromSeller, annoncen.visitors FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID WHERE annoncenID='$annonce'";
$sql = "SELECT annoncen.annoncenID, rubrik.rubrik, annoncen.titel, annoncen.text, annoncen.priceFromSeller, pictures.picturename, annoncen.visitors FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID LEFT JOIN pictures ON annoncen.annoncenID = pictures.annoncenID WHERE annoncen.annoncenID='$annonce'";
$result = mysqli_query($conn, $sql);


while($row = mysqli_fetch_assoc($result)) 
{    
    echo "<h2>" . $row["rubrik"] . "</h2>"
       . "<h3>" . $row["titel"] . "</h3>"
       . "<p>" . $row["text"] . "</p>"
       . "<h3><b>" . $row["priceFromSeller"] . " <span class='glyphicon glyphicon-euro'></span></b></h3>";

       if(!$row['picturename']==NULL)
           {echo "<img src='./pictures/" . $row['picturename'] . "' style='width:800px;'>";}

    $visitors = $row["visitors"];
    $visitors++;
    $sqlAnswer = "UPDATE annoncen SET visitors='$visitors' WHERE annoncenID=$annonce";
    mysqli_query($conn, $sqlAnswer);
}

mysqli_close($conn);   

include("foodMaster.php");
?>