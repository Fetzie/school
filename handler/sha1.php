<?php
echo '<!DOCTYPE html>'
   . '<html lang="de">'
   . '<head>'
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
       ."<form name='signin' action='./sha1.php' method='POST' >"
       		. "<label>password to convert to sha1:</label>"
            . "<input type='text' class='form-control' name='password2sha' value='' />"
            . '<input type="Submit" value="convert" name="exec" class="btn btn-default" />'
            . "</form>";
		echo sha1($_POST["password2sha"]);            		


   echo '<nav class="navbar navbar-default">'
  . '<div class="container-fluid">'
    . '<div class="navbar-header">'
      . '<a class="navbar-brand" href="./index.php"><span class="glyphicon glyphicon-shopping-cart"></span> SellMyCar.com</a>'
    . '</div>';