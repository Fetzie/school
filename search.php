<?php
function search($rubrik, $rangeA, $rangeB)
{
    include ("dbMaster.php");
    
    if($rubrik == 'Alle')
    {
        $sql = "SELECT a.id, c.name, a.title, a.priceFromSeller, a.display FROM advertisement a LEFT JOIN category c ON a.categoryid = c.id WHERE a.display='1' AND a.priceFromSeller BETWEEN $rangeA AND $rangeB";
    }
    else
    {
        $sql = "SELECT a.id, c.name, a.titel, a.priceFromSeller, a.display FROM advertisement a LEFT JOIN category c ON a.categoryid = c.id WHERE a.display='1' AND c.id='$rubrik' AND a.priceFromSeller BETWEEN $rangeA AND $rangeB";
    }
    
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
        echo "<a href='annoncen_anzeigen.php?annonce=" . $row["annoncenID"] . "'><div style='width:66%; border-style: outset;'>" . $row["rubrik"] . "<br>"
               . $row["titel"] . "<br>"
               . $row["priceFromSeller"] . "</div></a>";
    }
    
    mysqli_close($conn);
}