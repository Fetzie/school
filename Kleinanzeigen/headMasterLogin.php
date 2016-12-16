<?php

include ("dbMaster.php");

$sql = "SELECT * from customers where emailaddress = '" . $_SESSION["eingeloggt"] . "';";
$result = mysqli_query($conn, $sql);


echo '<!DOCTYPE html>'
   . '<html lang="de">'
   . '<head>'
        . '<title>' . $titel . '</title>'
        . '<meta charset="utf-8">'
        . '<meta name="viewport" content="width=device-width, initial-scale=1">'
        . "<link rel='shortcut icon' type='image/x-icon' href='car_icon.png' />"
	. "<link rel='stylesheet' href='font-awesome/css/font-awesome.min.css'>"
        . '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">'
        . '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>'
        . '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>'
        . '<script>'
            . 'function logout()'
            . '{'
            . 'document.location.href = "./index.php";'
            . '}'
        . '</script>'
   . '</head>'
   . '<body>'
        
   . '<nav class="navbar navbar-default">'
  . '<div class="container-fluid">'
    . '<div class="navbar-header">'
      . '<a class="navbar-brand" href="./index.php"><span class="glyphicon glyphicon-shopping-cart"></span> SellMyCar.com</a>'
    . '</div>';
        
    echo '<ul class="nav navbar-nav navbar-right">'
            . '<li><a data-toggle="modal" data-target="#userdata"><span class="glyphicon glyphicon-user"></span> Benutzerdaten</a></li>'
            . '<li><a data-toggle="modal" data-target="#logout"><span class="glyphicon glyphicon-log-out"></span> Abmelden</a></li>'
           . '</ul>'
        . '</div>'
        . '</nav>'
        
        . '<div class="container">'
            . '<!-- User Modal start  -->'
            . '<div class="modal fade" id="userdata" role="dialog">'
            . '<div class="modal-dialog">'

                . '<!-- Modal content-->'
                . '<div class="modal-content">'
                    . '<div class="modal-header">'
                        . '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                        . '<h4 class="modal-title">Benutzerdaten</h4>'
                    . '</div>'
                    . '<div class="modal-body">'
                        .'<p>Benutzerdaten</p>' 
                        . "<form name='signin' action='./annoncen_erstellen.php' method='POST' >";
                        while ($row = mysqli_fetch_assoc($result))
                        {
                        	$emailaddress = $row["emailaddress"];
                        	$firstname = $row["firstname"];
                        	$lastname = $row["lastname"];
                        	$housenumber = $row["houseNumber"];
                        	$street = $row["address1"];
                        	$city = $row["city"];
                        	$plz = $row["zipcode"];
                        	
                        }
                        	echo "<label>E-Mail Adresse: $emailaddress</label>"
                        		. "<input type='hidden' class='form-control' name='benutzername' value='$emailaddress' />"
                        		. "<label>Kennwort:</label>"
                        		. "<input type='password' class='form-control' name='kennwort' value='' />"
                        		. "<label>Kennwort wiederholen:</label>"
                        		. "<input type='password' class='form-control' name='kennwortRepeat' value='' />"
                        		. "<label>Vorname:</label>"
                        		. "<input type='text' class='form-control' name='vorname' value='$firstname' />"
                        		. "<label>Nachname:</label>"
                        		. "<input type='text' class='form-control' name='nachname' value='$lastname' />"
                        		. "<label>Stra�e:</label>"
                        		. "<input type='text' class='form-control' name='strasse' value='$street' />"
                        		. "<label>Hausnummer:</label>"
                        		. "<input type='text' class='form-control' name='hausnummer' value='$housenumber' />"
                        		. "<label>PLZ:</label>"
                        		. "<input type='text' class='form-control' name='plz' value='$plz' />"
                        		. "<label>Stadt:</label>"
                        		. "<input type='text' class='form-control' name='stadt' value='$city' />"
                        		. "<input type='hidden' class='form-control' name='controlmethod' value='editUser' />"                        
                    . '</div>'
                    . '<div class="modal-footer">'
                    	. '<input type="Submit" value="editieren" name="buttonEdit" class="btn btn-default" />'
                        . '<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>'
                    . '</div>'
                . '</div>'

            . '</div>'
            . '</div>'
            . '<!-- User Modal ende -->'
    
            . '<!-- Logout Modal start  -->'
            . '<div class="modal fade" id="logout" role="dialog">'
            . '<div class="modal-dialog">'
    
                . '<!-- Modal content-->'
                . '<div class="modal-content">'
                    . '<div class="modal-header">'
                        . '<button type="button" class="close" data-dismiss="modal">&times;</button>'
                        . '<h4 class="modal-title">Abmeldung</h4>'
                    . '</div>'
                    . '<div class="modal-body">'
                        . '<p>Wollen Sie sich wirklich abmelden?</p>'
                    . '</div>'
                    . '<div class="modal-footer">'
                        . '<button type="button" class="btn btn-default" data-dismiss="modal" onclick="logout()">Ja</button>'
                        . '<button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>'
                    . '</div>'
                . '</div>'
      
            . '</div>'
            . '</div>'
            . '<!-- Logout Modal ende -->';