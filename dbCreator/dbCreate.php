<?php 

function writeDB($DBLink){

$sql = explode(";",file_get_contents("createDB.sql"));

foreach ($sql as $query)
	mysqli_query($DBLink, $query);
}


?>