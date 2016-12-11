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
      . '<a class="navbar-brand"><span class="glyphicon glyphicon-shopping-cart"></span> SellMyCar.com</a>'
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
                        . '<p>Benutzerdaten</p>'
                    . '</div>'
                    . '<div class="modal-footer">'
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