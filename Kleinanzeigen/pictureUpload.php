<?php

function pictureUpload()
{
    include("./dbMaster.php");
    
    global $conn;
    $last_id = mysqli_insert_id($conn);
    
    $anzahl = count($_FILES["fileToUpload"]["name"]);

    for ($i=0; $i < $anzahl; $i++)
    {
        $pictureType = array("image/png", "image/jpeg");

        if($_FILES["fileToUpload"]["size"][$i] > 0)
        {    
            if($_FILES["fileToUpload"]["size"][$i] <= 20000 && in_array($_FILES["fileToUpload"]["type"][$i], $pictureType))
            {
                move_uploaded_file 
                (
                        $_FILES["fileToUpload"]["tmp_name"][$i] ,
                        "Pictures/" . $_FILES["fileToUpload"]["name"][$i]
                );

                $pictureName = $_FILES['fileToUpload']['name'][$i];
                
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
                
                echo "<p>Datei " . $_FILES["fileToUpload"]["name"][$i] . " wurde erfolgreich hochgeladen.</p>";
                //echo "<img src='uploads/" . $_FILES["pictures"]["name"][$i] . "' style='width:100px;'/>";
            }
            else
            {
                echo "<p>Error! Datei ist größer als 20KB oder nicht im Format JPEG oder PNG!</p>";
            }
        }
    }
}