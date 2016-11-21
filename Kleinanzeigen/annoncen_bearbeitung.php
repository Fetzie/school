<?php
    $titel = "Annoncen-Bearbeitung";
    include ("headMaster.php");
    include ("session.php");
    include ("dbMaster.php");
                    
    
    function rubrik($rubrikID)
    {
        global $conn;
        
        $sql = "SELECT rubrikID, rubrik FROM rubrik";
        $result = mysqli_query($conn, $sql);
        
        while($row = mysqli_fetch_assoc($result)) 
        {
            if($row["rubrikID"] == $rubrikID) {echo "<option value='" . $row["rubrikID"] . "' selected>" . $row["rubrik"] . "</option>";}
            else {echo "<option value='" . $row["rubrikID"] . "'>" . $row["rubrik"] . "</option>";}
        }
    }


    $annonce= "";
    
    function bearbeitung($ID)
    {
        global $conn;
        
        $annonce = $_GET["annonce"];
        
        $sql = "SELECT annoncenID, rubrik.rubrik, rubrik.rubrikID, titel, text, priceFromSeller FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID WHERE annoncenID='$annonce'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) 
        {
            echo "<form name='geaenderterEintrag' method='post' action='annoncen_erstellen.php'>"
               . "Rubrik: <select name='rubrik'>";
                 rubrik($row["rubrikID"]);
            echo "</select>"        
               . "<input type='hidden' name='annoncenID' value='" . $row["annoncenID"] . "'>"
               . "Titel: <input type='text' name='titel' value='" . $row["titel"] . "'>"
               . "Text: <input type='text' name='text' value='" . $row["text"] . "'>"
               . "Preis: <input type='text' name='priceFromSeller' value='" . $row["priceFromSeller"] . "'>"
               . "<input type='submit' name='speichern' value='speichern'><input type='submit' name='entfernen' value='l&ouml;schen'>"
               . "</form>"
               . "<button type='button' onclick='addDays($ID)'>+30 Tage</button>";
        }

        mysqli_close($conn);   
    }
    
    bearbeitung($annonce);
    
    include("foodMaster.php");
?>