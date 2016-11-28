<?php

include './handler/dbHandler.php';
include './handler/accountHandler.php';
$DBLink=DBLogin();
    if (! session_id()) session_start(); 
    
    $_SESSION['benutzername'] = "";
    $_SESSION['eingeloggt'] = "";
    
    if(isset($_POST['button']) && $_POST['button'] == 'einloggen')
    {
        if ( $_POST['benutzername'] != "" && $_POST['kennwort'] != ""  )
        {
        	$login=$_POST['benutzername'];
        	$password=$_POST['kennwort'];
        	#$DBLink=DBLogin();
        	$userStatus=AuthenticateUser($login, $DBLink);
 			while ($row = mysqli_fetch_assoc($userStatus)){
        		if (HashPW($password) == $row['password']){
        			$_SESSION['benutzername'] = $_POST['email'];
        			$_SESSION['eingeloggt'] = true;
        			echo "<b>einloggen erfolgreich</b>";
        		} else {
                echo "<b>ung&uuml;ltige Eingabe</b>";
                $_SESSION['eingeloggt'] = false;
            	}
        	}
    	}
    }
    
    if(isset($_POST['button']) && $_POST['button'] == 'registrieren')
    {
    	if ( $_POST['benutzername'] != "" && $_POST['kennwort'] != ""  )
    	{
    		$emailaddress=$_POST['email'];
    		$password=$_POST['kennwort'];
    		$firstname=$_POST['firstname'];
    		$lastname=$_POST['lastname'];
    		$street=$_POST['street'];
    		$housenumber=$_POST['housenumber'];
    		$city=$_POST['city'];
    		$zipcode=$_POST['zipcode'];
    		
    		#$DBLink=DBLogin();
    		$newUser=AddUser($DBLink, $firstname, $lastname, $password, $street, $housenumber, $city, $zipcode, $emailaddress);
    		# log in the user after they create their account
    		if($newUser){
    			
    				$_SESSION['benutzername'] = $_POST['email'];
    				$_SESSION['eingeloggt'] = true;
    				echo "<b>einloggen erfolgreich</b>";
    				$subject="Ihr Account bei SellMyCar.com";
    				$message="vielen Dank dass sie sich registriert haben. Wir haben bereits für sie ein Account angelegt.\n
    						Sie können sich mit ihrer Emailaddresse und Passwort nun einloggen und Annoncen aufgeben.\n\n
    						
    						Ihr SellMyCar.com Partner";
    				mail($emailaddress, $subject, $message);
    				DBLogout($DBLink);
    			}else{
    				echo "Accounterstellung fehlgeschlagen aufgrund folgende Fehler:\n" . 
      				print_r( mysqli_error_list($DBLink));
    				DBLogout($DBLink);
    			}
    			
    			
    		}
    	
    }
    
    
$titel = "SellMyCar";
include ("headMaster.php");
include ("rubrik_anzeigen.php");
include ("search.php");

    echo "<div style='width:50%;'>"
       . "<form name='search' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' oninput='pricerangeA.value=parseInt(rangeA.value)*500, pricerangeB.value=parseInt(rangeB.value)*500+((rangeA.value)*500)'>"
       . "Rubrik:<br>"
       . "<select class='form-control' name='rubrik'>"
       . "<option value='Alle' selected>Alle</option>";
          rubrik(DBLogin());
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
    search($DBLink, $rubrik, $rangeA, $rangeB);
}
else
{
    $sql = "SELECT a.id, c.name, a.title, a.text, a.pricefromseller, a.createdate, a.duration, a.price, a.days, a.visitors, a.display 
    		FROM advertisement a LEFT JOIN category c ON a.categoryid = c.id";
    $result = mysqli_query($DBLink, $sql);


    while($row = mysqli_fetch_assoc($result)) 
    {
        $annoncenID = $row["id"];
        if($row["timeToDeath"] >= $row["birthdate"] && $row["display"] == 0)
        {
            $display = 1;
            $sqlAnswer = "UPDATE advertisement SET display='$display' WHERE id='$annoncenID'";
            mysqli_query($conn, $sqlAnswer);

            echo "<a href='annoncen_anzeigen.php?annonce=" . $row["id"] . "'><div style='width:66%; border-style: outset;'>" . $row["categoryid"] . "<br>"
               . $row["title"] . "<br>"
               . $row["priceFromSeller"] . "</div></a>";
        }
        elseif($row["timeToDeath"] < $row["birthdate"] && $row["display"] == 1)
        {
            $display = 0;
            $sqlAnswer = "UPDATE advertisement SET display='$display' WHERE id='$annoncenID'";
            mysqli_query($conn, $sqlAnswer);
        }
        elseif($row["display"] == 0 && $row["days"] > 20 )
        {
            $display = 1;
            $sqlAnswer = "UPDATE advertisement SET display='$display' WHERE id='$annoncenID'";
            mysqli_query($conn, $sqlAnswer);
            
            echo "<a href='annoncen_anzeigen.php?annonce=" . $row["id"] . "'><div style='width:66%; border-style: outset;'>" . $row["categoryid"] . "<br>"
               . $row["titel"] . "<br>"
               . $row["priceFromSeller"] . "</div></a>";
        }
        elseif($row["display"] == 1)
        {
            if($row["days"] == 1)
            {
                $days = $row["birthdate"];
                $priceFromSeller = $row['priceFromSeller'];
                $price = $row["price"];
                $sqlAnswer = "SELECT id, @tage := DAY(NOW()) - DAY(a.birthdate), @kosten := a.priceFromSeller * a.price, @endpricevar := @tage * @kosten, endprice FROM advertisement;
                              UPDATE advertisement SET endprice=@endpricevar WHERE id=$annoncenID;";
            }
            echo "<a href='annoncen_anzeigen.php?annonce=" . $row["id"] . "'><div class='col-sm-12 well' style='width:66%; border-style: outset;'>"
               . "<div class='col-sm-6'>" 
                    . $row["categoryid"] . "<br>"
                    . $row["title"] . "<br>"
                    . $row["priceFromSeller"] 
               . "</div>"   
               . "</div></a>";
        }
    }

	DBLogout($DBLink);
}

exit;

include("foodMaster.php");
?>