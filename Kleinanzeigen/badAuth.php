<?php

$titel = "SellMyCar.com";

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
   . '</head>'
   . '<body>'
        
   . '<nav class="navbar navbar-default">'
  . '<div class="container-fluid">'
    . '<div class="navbar-header">'
      . '<a class="navbar-brand" href="./index.php"><span class="glyphicon glyphicon-shopping-cart"></span> SellMyCar.com</a>'
    . '</div>';
                          
        echo '<ul class="nav navbar-nav navbar-right">'
           . '<li><a data-toggle="modal" data-target="#signup"><span class="glyphicon glyphicon-user"></span> Registrieren</a></li>'
           . '<li><a data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Anmelden</a></li>'
        . '</ul>'
    . '</div>'
    . '</nav>';
    
    echo '<body><p> Sie haben entweder ein ungueltiges Passwort oder Benutzername eingegeben. Bitte klicken Sie auf dem nachfolgenden Button um sich erneut anzumelden.</p>
    		<p><a href="./index.php"><img border="1" alt="SellMyCar" src="./Pictures/back.png" width="100" height="100"></a></p></body></html>';
    
    