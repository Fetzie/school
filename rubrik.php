<?php
    $titel = "Rubrik";
    include ("headMaster.php");
    include ("session.php");
    include ("dbMaster.php");
		
                    
    // benötigt Tabelle für Annonce und Bilder
    $rubrik = "";
                
    $rubrikErr = "";
        
        
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['senden']))
        {
            if(empty($_POST["rubrik"]))
            {
                $rubrikErr = "Es wurde keine Rubrik eingetragen!";
            }
            else
            {
                $rubrik = $_POST["rubrik"];
		                                 
                $sql = "INSERT INTO category (name)
                            VALUES ('$rubrik')";

                if (mysqli_query($conn, $sql)) 
                {
                    echo "Neuen Eintrag erfolgreich gespeichert";
                } 
                else 
                {
                    echo "Fehler: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
                    
        elseif(isset($_POST["speichern"]))
        {
            $rubrik = $_POST["rubrik"];
            $rubrikID = $_POST["rubrikID"];
                   
            $sql = "UPDATE category SET name='$rubrik' WHERE id=$rubrikID";
              
            if (mysqli_query($conn, $sql)) 
            {
                echo "Eintrag erfolgreich ge&auml;ndert";
            }
            else
            {
                echo "Fehler bei &Auml;nderung: " . $conn->error;
            }
        }
        else
        {
            $rubrikID = $_POST["rubrikID"];
 
            $sql = "DELETE FROM category WHERE id=$rubrikID";

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
?>

    <form name='newEintrag' method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
	Rubrik:<br>
        <input type='text' name='rubrik'><span class="error"> <?php echo $rubrikErr; ?> </span><br>
        <input type='submit' value='senden' name='senden'><input type='reset' value='zurÃ¼cksetzen'>
    </form>
    <hr/>
    
<?php
    function ausgabe()
    {
        include ("dbMaster.php");

        $sql = "SELECT id, name FROM category";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)) 
        {
            echo "<form name='geaenderterEintrag' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>"
               . "<input type='hidden' name='rubrikID' value='" . $row["id"] . "'>"
               . "<input type='text' name='rubrik' value='" . $row["name"] . "'>"
               . "<input type='submit' name='speichern' value='speichern'><input type='submit' name='entfernen' value='l&ouml;schen'><br>"
               . "</form>";
        }

        mysqli_close($conn);   
    }

    ausgabe();

    include("foodMaster.php");
?>