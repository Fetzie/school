<?php
    $titel = "Annoncen";
    include ("headMaster.php");
    include ("session.php");
    include ("dbMaster.php");
    include ("price.php");
    include ("rubrik_anzeigen.php");
                    
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
            		                                 
            $sql = "INSERT INTO advertisement (createdate, categoryid, title, text, priceFromSeller, days, price, timeToDeath)
                    VALUES (NOW(), '$rubrik', 'SELECT id from category where name = '$titel'';', '$text', '$priceFromSeller', '$days', '$price', '$timeToDeath')";
		
            if (mysqli_query($conn, $sql)) 
            {
                echo "Neuen Eintrag erfolgreich gespeichert";
            } 
            else 
            {
                echo "Fehler: " . $sql . "<br>" . mysqli_error($conn);
            }
            
            if(!$_FILES["fileToUpload"]["size"]==0)
            {    
                pix();
            }
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
    
    function pix()
    {      
        if (!is_dir("Pictures/")){
        	mkdir("Pictures/");
        }
        $target_dir = "Pictures/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Datei existiert bereits. Verwenden sie eine andere.";
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" )
        {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0)
        {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } 
        else
        {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
            {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            }
            else
            {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        global $conn;
        $last_id = mysqli_insert_id($conn);
        
        //$priceFromSeller = $_POST["priceFromSeller"];
	
        $pictureName = $_FILES['fileToUpload']['name'];
        
        $sql = "INSERT INTO pictures (annoncenID, picturename)
                    VALUES ('$last_id', '$pictureName')";

        if (mysqli_query($conn, $sql)) 
        {
            echo "Neuen Eintrag erfolgreich gespeichert";
        } 
        else 
        {
            echo "Fehler: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
    
    echo "<a href='rubrik.php'>Rubrik erstellen</a>";
    
    echo "<form name='newEintrag' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' enctype='multipart/form-data'>"
       . "Rubrik:<br>"
       . "<select name='rubrik'>";
          rubrik();
    echo "</select><br>"
       . "Titel:<br><input type='text' name='titel'><br>"
       . "Bilder:<br><input type='file' name='fileToUpload' id='fileToUpload'><br><span id='demo'></span><button type='button' onclick='pictureAdder()'>+</button><br>"
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