<?php
    include ("session.php");
    $titel = "Annoncen";
    include ("headMasterLogin.php");
    include ("dbMaster.php");
    include ("price.php");
    include ("rubrik_anzeigen.php");
    include ("pictureUpload.php");
                    
    // benötigt Tabelle für Annonce und Bilder
    $rubrik = $titel = $text = $picture = $birthdate = $timeToDeath = $priceFromSeller = $days = $display = "";
                
    $titelErr = $textErr = $pictureErr = $birthdateErr = $priceFromSellerErr = "";
        
        
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        if(isset($_POST['senden']))
        {
            $rubrik = $_POST["rubrik"];
            $titel = $_POST["titel"];
            $text = $_POST["text"];
            $priceFromSeller = $_POST["priceFromSeller"];
            $days = $_POST["days"];
            
            list ($price, $timeToDeath) = priceCalc($days, $priceFromSeller);
            		                                 
            $sql = "INSERT INTO annoncen (birthdate, rubrik, titel, text, priceFromSeller, days, price, timeToDeath)
                    VALUES (NOW(), '$rubrik', '$titel', '$text', '$priceFromSeller', '$days', '$price', '$timeToDeath')";

            if (mysqli_query($conn, $sql)) 
            {
                echo "Neuen Eintrag erfolgreich gespeichert";
            } 
            else 
            {
                echo "Fehler: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            pictureUpload();
        }
        
                 
        elseif(isset($_POST["speichern"]))
        {
            $annoncenID = $_POST["annoncenID"];
            $rubrik = $_POST["rubrik"];
            $titel = $_POST["titel"];
            $text = $_POST["text"];
            $priceFromSeller = $_POST["priceFromSeller"];
            
            
            $sql = "UPDATE annoncen SET rubrik='$rubrik', titel='$titel', text='$text', priceFromSeller='$priceFromSeller' WHERE annoncenID=$annoncenID";
              
            if (mysqli_query($conn, $sql)) 
            {
                echo "Eintrag erfolgreich ge&auml;ndert";
            }
            else
            {
                echo "Fehler bei &Auml;nderung: " . $conn->error;
            }
        }
        elseif(isset($_POST["entfernen"]))
        {
            $annoncenID = $_POST["annoncenID"];
 
            $sql = "DELETE FROM annoncen WHERE annoncenID=$annoncenID";

            if (mysqli_query($conn, $sql))
            {
                echo "Eintrag erfolgreich gel&ouml;scht";
            }
            else
            {
                echo "Fehler beim l&ouml;schen: " . mysqli_error($conn);
            }
        }
    }
    
    
    echo "<a href='rubrik.php'>Rubrik erstellen</a>";
    
    echo "<form name='newEintrag' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>"
       . "Rubrik:<br>"
       . "<select name='rubrik'>";
          rubrik();
    echo "</select><br>"
       . "Titel:<br><input type='text' name='titel'><br>"
       . "Bilder:<br><input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "<input type='file' name='fileToUpload[]'><br>"
       . "Text:<br><textarea name='text'></textarea><br>"
       . "Preis:<br><input type='text' name='priceFromSeller'>&euro;<br>"
       . "<input type='radio' name='days' value='30' checked> 30 Tage<br>"
       . "<input type='radio' name='days' value='60'> 60 Tage<br>"
       . "<input type='radio' name='days' value='90'> 90 Tage<br>"
       . "<input type='submit' value='senden' name='senden'><input type='reset' value='zurÃ¼cksetzen'>"
       . "</form>"
       . "<hr/>";
    
    
    function ausgabe()
    {
        include ("dbMaster.php");

        $sql = "SELECT annoncenID, rubrik.rubrik, titel, text, priceFromSeller, visitors, birthdate, timeToDeath FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID";
        $result = mysqli_query($conn, $sql);
        
        
        while($row = mysqli_fetch_assoc($result)) 
        {
            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($row["timeToDeath"]);
            $diff  = date_diff($date1,$date2);

            echo "<form name='geaenderterEintrag' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>"
               . "<input type='hidden' name='annoncenID' value='" . $row["annoncenID"] . "'>"
               . "Rubrik: " . $row["rubrik"] . " | "
               . "Titel: " . $row["titel"] . " | "
               . "Text: " . $row["text"] . " | "
               . "Preis: " . $row["priceFromSeller"] . " | "
               . "Verf&uuml;gbarkeit: " . $diff->format("%R%a Tage") . " | "
               . "Besucher: " . $row["visitors"] . "&nbsp;"
               . "<a href='annoncen_bearbeitung.php?annonce=" . $row["annoncenID"] . "'><button type='button' >bearbeiten</button></a><br>"
               . "</form>";
        }

        mysqli_close($conn);   
    }

    ausgabe();
    
    include("foodMaster.php");
?>
