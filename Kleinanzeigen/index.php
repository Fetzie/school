<?php
session_start();

session_destroy();
$_SESSION = array();    

    /*if (! session_id()) session_start(); 
    
    $_SESSION['benutzername'] = "";
    $_SESSION['eingeloggt'] = "";
    
    if(isset($_POST['button']) && $_POST['button'] == 'einloggen')
    {
        if ( $_POST['benutzername'] != "" && $_POST['kennwort'] != ""  )
        {
            if 
                 $_POST['benutzername'] == "admin" 
                 AND 
                 $_POST['kennwort'] == "admin"
               )
            {
                $_SESSION['benutzername'] = $_POST['benutzername'];
                $_SESSION['eingeloggt'] = true;
                header('Location: ./annoncen_erstellen.php');
            }
            else
            {
                echo "<b>ung&uuml;ltige Eingabe</b>";
                $_SESSION['eingeloggt'] = false;
            }
        }
    }*/
    
    $titel = "SellMyCar";
    include ("headMaster.php");
    include ("rubrik_anzeigen.php");
    include ("dbMaster.php");
    include ("search.php");

    echo "<div style='width:50%;'>"
       . "<form name='search' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' oninput='pricerangeA.value=parseInt(rangeA.value)*500, pricerangeB.value=parseInt(rangeB.value)*500+((rangeA.value)*500)'>"
       . "Rubrik:<br>"
       . "<select class='form-control' name='rubrik'>"
       . "<option value='Alle' selected>Alle</option>";
          rubrik();
    echo "</select><br>"
       . "0 &euro; <input type='range' id='rangeA' name='rangeA' value='0'>"
       . "<input type='range' id='rangeB' name='rangeB' value='100'> 50.000 &euro;<br>"
       . "<output name='pricerangeA' for='rangeA'>0</output> &euro; - "
       . "<output name='pricerangeB' for='rangeB'>50000</output> &euro;<br>"
       . "<input type='submit' value='suchen' name='search'/>"
       . "</form>"
       . "</div>"
       . "<hr>";
        
       
if(isset($_POST["search"]))
{
    $rubrik = $_POST["rubrik"];
    $rangeA = $_POST["rangeA"]*500;
    $rangeB = $_POST["rangeB"]*500+$rangeA;
    search($rubrik, $rangeA, $rangeB);
}
else
{
    $sql = "SELECT annoncenID, rubrik.rubrik, titel, text, priceFromSeller, birthdate, timeToDeath, price, days, visitors, display FROM annoncen LEFT JOIN rubrik ON annoncen.rubrik = rubrik.rubrikID";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) 
    {
        $annoncenID = $row["annoncenID"];
        
        $date1 = date_create(date('Y-m-d'));
        $date2 = date_create($row["timeToDeath"]);
        $diff  = date_diff($date1,$date2);
        
        if($diff->format("%R%a Tage") > 0 )
        {
           echo "<a href='annoncen_anzeigen.php?annonce=" . $row["annoncenID"] . "'>"
              . "<div class='col-sm-12 well' style='width:66%; border-style: outset;'>"
              . "<div class='col-sm-6'>" 
                    . $row["rubrik"] . "<br>"
                    . $row["titel"] . "<br>"
                    . $row["priceFromSeller"] 
              . "</div>"   
              . "</div>"
              . "</a>";
        }
    }

    mysqli_close($conn);
}

exit;

include("foodMaster.php");
?>
