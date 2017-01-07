<?php
    include ("session.php");
    $titel = "Annoncen-Bearbeitung";
    include ("headMasterLogin.php");
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
    
    echo "<a href='./annoncen_erstellen.php'><button type='button' class='btn btn-default'>Zur&uuml;ck</button></a>";
    echo "<hr>";
    $annonce= "";
    
    function bearbeitung($ID)
    {
        global $conn;
        
        $annonce = $_GET["annonce"];
        
        $sql = "SELECT annoncenID, rubrik.rubrik, rubrik.rubrikID, titel, text, priceFromSeller, timeToDeath FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID WHERE annoncenID='$annonce'";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) 
        {
            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($row["timeToDeath"]);
            $diff  = date_diff($date1,$date2);
            
            echo "<form name='geaenderterEintrag' method='post' action='annoncen_erstellen.php'>"
               . "<label>Rubrik:</label><select class='form-control' name='rubrik'>";
                 rubrik($row["rubrikID"]);
            echo "</select>"        
               . "<input type='hidden' name='annoncenID' value='" . $row["annoncenID"] . "'>"
               . "<label>Titel:</label><input type='text' class='form-control' name='titel' value='" . $row["titel"] . "'>"
               . "<label>Text:</label><input type='text' class='form-control' name='text' value='" . $row["text"] . "'>"
               . "<label>Preis:</label><input type='text' class='form-control' name='priceFromSeller' value='" . $row["priceFromSeller"] . "'><br>"
               . "<input type='button' name='annoncenID' value='" . $row["timeToDeath"] . "'>"
               . "<input type='submit' class='btn btn-default col-sm-6' name='speichern' value='speichern'><input type='submit' class='btn btn-default col-sm-6' name='entfernen' value='l&ouml;schen'>"
               . "</form>"
               . "<br><br><hr><br>"
               . "<label>Ablaufdatum der Annonce:</label><p class='well' style='text-align:center; font-size:50px;'>"; 
                
            
            if($diff->format("%R%a Tage") > 0 )
            {
                $date = date_create($row["timeToDeath"]);
                echo date_format($date, 'd.m.Y');
            }
            else
            {
                echo "Annonce ist bereits abgelaufen";
            }
            $timeToDeath = $row["timeToDeath"];
            echo "</p>";
        }
    

        mysqli_close($conn);   
    }
    
    bearbeitung($annonce);
    
    include("foodMaster.php");
?>
