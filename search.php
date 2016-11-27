<?php
function search($DBLink, $rubrik, $rangeA, $rangeB)
{

    if($rubrik == 'Alle')
    {
        $sql = "SELECT a.id, c.name, a.title, a.priceFromSeller, a.display FROM advertisement a LEFT JOIN category c ON a.categoryid = c.id WHERE a.display='1' AND a.priceFromSeller BETWEEN $rangeA AND $rangeB";
    }
    else
    {
        $sql = "SELECT a.id, c.name, a.titel, a.priceFromSeller, a.display FROM advertisement a LEFT JOIN category c ON a.categoryid = c.id WHERE a.display='1' AND c.id='$rubrik' AND a.priceFromSeller BETWEEN $rangeA AND $rangeB";
    }
    $conn=DBLogin();
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
        echo "<a href='annoncen_anzeigen.php?annonce=" . $row["id"] . "'><div style='width:66%; border-style: outset;'>" . $row["category"] . "<br>"
               . $row["title"] . "<br>"
               . $row["priceFromSeller"] . "</div></a>";
    }
    
    mysqli_close($conn);
}