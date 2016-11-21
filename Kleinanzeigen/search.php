<?php
function search($rubrik, $rangeA, $rangeB)
{
    include ("dbMaster.php");
    
    if($rubrik == 'Alle')
    {
        $sql = "SELECT annoncen.annoncenID, rubrik.rubrik, annoncen.titel, annoncen.priceFromSeller, annoncen.display FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID WHERE annoncen.display='1' AND annoncen.priceFromSeller>='$rangeA' AND annoncen.priceFromSeller<='$rangeB'";
    }
    else
    {
        $sql = "SELECT annoncen.annoncenID, rubrik.rubrik, annoncen.titel, annoncen.priceFromSeller, annoncen.display FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID WHERE annoncen.display='1' AND rubrik.rubrikID='$rubrik' AND annoncen.priceFromSeller>='$rangeA' AND annoncen.priceFromSeller<='$rangeB'";
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