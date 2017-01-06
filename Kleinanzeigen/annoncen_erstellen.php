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
 
            $deletePictures = "DELETE FROM pictures WHERE annoncenID=$annoncenID";
            $deleteAnnoncen = "DELETE FROM annoncen WHERE annoncenID=$annoncenID";

            if (mysqli_query($conn, $deletePictures))
            {
                echo "Bilder von Eintrag Nummer $annoncenID erfolgreich gel&ouml;scht<br>";
            }
            else
            {
                echo "Fehler beim l&ouml;schen: " . mysqli_error($conn);
            }
            if (mysqli_query($conn, $deleteAnnoncen))
            {
                echo "Eintrag Nummer $annoncenID erfolgreich gel&ouml;scht<br>";
            }
            else
            {
                echo "Fehler beim l&ouml;schen: " . mysqli_error($conn);
            }
        }
    }
    
    
    echo "<a href='rubrik.php'>Rubrik erstellen</a>";
    
?>
    <script>
        function addPictureBox()
        {
            var eingabe = document.getElementById("newPictureBox");
            var list = document.getElementById("inputPosition");
            var inhalt = list.innerHTML + "<input type='file' class='btn btn-default' name='fileToUpload[]'/><br>";
            list.innerHTML = inhalt;
        }
    </script>
<?PHP

    echo "<form name='newEintrag' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>"
       . "<fieldset><label>Rubrik:</label>"
       . "<select class='form-control' name='rubrik'>";
          rubrik();
    echo "</select></fieldset>"
       . "<fieldset><label>Titel:</label><input type='text' class='form-control' name='titel' placeholder='Annoncen Titel'/></fieldset>"
       . "<fieldset><label>Bilder:</label><input type='file' class='btn btn-default' name='fileToUpload[]'/></fieldset>"
       . "<span id='inputPosition'></span>"
       . "<button type='button' class='btn btn-default' onclick='addPictureBox();'> + </button>"
       . "<br><br>"
       . "<fieldset><label>Text:</label><textarea class='form-control' rows='5' name='text' placeholder='Beschreibung des Fahrzeugs'></textarea></fieldset>"
       . "<fieldset><label>Preis:</label><input type='text' class='form-control' name='priceFromSeller' placeholder='&euro;'/></fieldset>"
       . "<input type='radio' name='days' value='30' checked> 30 Tage<br>"
       . "<input type='radio' name='days' value='60'> 60 Tage<br>"
       . "<input type='radio' name='days' value='90'> 90 Tage<br>"
       . "<input type='submit' class='btn btn-default col-sm-6' value='Anzeige erstellen' name='senden'/>"
            . "<input type='reset' class='btn btn-default col-sm-6' value='zur&uuml;cksetzen'>"
       . "</form>"
       . "<br><hr>";
    
    
    function ausgabe()
    {
        include ("dbMaster.php");

        $sql = "SELECT annoncenID, rubrik.rubrik, titel, text, priceFromSeller, visitors, birthdate, timeToDeath FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID";
        $result = mysqli_query($conn, $sql);
        $annoncenNumber = 1;
        
        while($row = mysqli_fetch_assoc($result)) 
        {
            $date1 = date_create(date('Y-m-d'));
            $date2 = date_create($row["timeToDeath"]);
            $diff  = date_diff($date1,$date2);
            
            
            echo "<form name='geaenderterEintrag' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>"
               . "<tr>"
               . "<input type='hidden' name='annoncenID' value='" . $row["annoncenID"] . "'>"
               . "<td>" . $annoncenNumber . "</td>"
               . "<td>Rubrik: " . $row["rubrik"] . "</td>"
               . "<td>Titel: " . $row["titel"] . "</td>"
               . "<td>Preis: " . $row["priceFromSeller"] . "</td>"
               . "<td>Verf&uuml;gbarkeit: " . $diff->format("%R%a Tage") . "</td>"
               . "<td>Besucher: " . $row["visitors"] . "</td>" . "&nbsp;"
               . "<td>"
                    . "<a href='annoncen_bearbeitung.php?annonce=" . $row["annoncenID"] . "'>"
                    . "<span class='btn btn-default glyphicon glyphicon-pencil'></span>"
                    . "</a>"
               . "</td>"
               . "</tr>"
                    
               . "</form>";
            $annoncenNumber++;
        }

        mysqli_close($conn);   
    }

    ausgabe();
    
    include("foodMaster.php");
?>
