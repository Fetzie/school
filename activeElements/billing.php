<?php
include '../handler/accountHandler.php';
include '../handler/advertHandler.php';
include '../handler/dbHandler.php';


function billingAddress($customerid){
$link = DBLogin('localhost', 'root', '', 'phpClass', '3306');


$queryBillAddr = 'SELECT billingaddress FROM customerpaymentmethods where customerid = ' . $customerid . ';';
$address = mysqli_query($link, $queryBillAddr);

$queryCustBill = 'SELECT sum(price) FROM transactions where customerid = ' . $customerid . ';';
$custBill = mysqli_query($link, $queryCustBill);

$queryCustItems = 'SELECT title FROM advertisement where customerid = ' . $customerid . ';';
$custItems = mysqli_query($link, $queryCustItems);



$content = "Your bill\n\n
		Your items: " . $custItems;
$fp = fopen("myText.txt","wb");
fwrite($fp,$content);
fclose($fp);
}?>


