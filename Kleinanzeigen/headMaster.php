<?php
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
    . '</nav>'
  
    . '<div class="container">'
    . '<!-- Sign Up Modal start  -->'
    . '<div class="modal fade" id="signup" role="dialog">'
        . '<div class="modal-dialog">'
    
      . '<!-- Modal content-->'
      . '<div class="modal-content">'
        . '<div class="modal-header">'
          . '<button type="button" class="close" data-dismiss="modal">&times;</button>'
          . '<h4 class="modal-title">Sign Up</h4>'
        . '</div>'
        . '<div class="modal-body">'
          . "<form name='signin' action='./annoncen_erstellen.php' method='POST' >"
           . "<label>E-Mail Adresse:</label>"
           . "<input type='text' class='form-control' name='email' value='' />"
           . "<label>Kennwort:</label>"
           . "<input type='password' class='form-control' name='password' value='' />"
        . '</div>'
        . '<div class="modal-footer">'
          . '<input type="Submit" value="einrichten" name="button" class="btn btn-default" />'
          . '</form>'
          . '<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>'
        . '</div>'
      . '</div>'
      
    . '</div>'
  . '</div>'
  . '<!-- Sign Up Modal ende -->'
  
  . '<!-- Modal start  -->'
  . '<div class="modal fade" id="login" role="dialog">'
    . '<div class="modal-dialog">'
    
      . '<!-- Modal content-->'
      . '<div class="modal-content">'
        . '<div class="modal-header">'
          . '<button type="button" class="close" data-dismiss="modal">&times;</button>'
          . '<h4 class="modal-title">Log In</h4>'
        . '</div>'
        . '<div class="modal-body">'
           . "<form name='loggin' action='./annoncen_erstellen.php' method='POST' >"
           . "<label>E-Mail Adresse:</label>"
           . "<input type='text' class='form-control' name='benutzername' value='' />"
           . "<label>Kennwort:</label>"
           . "<input type='password' class='form-control' name='kennwort' value='' />"
        . '</div>'
        . '<div class="modal-footer">'
          . '<input type="Submit" value="einloggen" name="button" class="btn btn-default" />'
          . '</form>'
          . '<button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>'
        . '</div>'
            . '</div>'
      
        . '</div>'
    . '</div>'

    . '<!-- Modal ende -->';