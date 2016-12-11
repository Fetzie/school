<?php
include '../Kleinanzeigen/dbMaster.php';

$users = array();
$userexists = mysqli_query($conn, "SELECT emailaddress from customers;");
for ($i = 0; $i < ($row = mysqli_fetch_row($userexists)); $i++){

	array_push($users, $row[$i]);
}
for ($i = 0; $i < count($users); $i++){
	
	echo $users[$i];
	/* if ($emailaddress == $users[$i]){
			
		$exists = true;
		break;
	} */
}

 

echo "</br></br></br>";
$login="admin@example.com";
$query = "SELECT emailaddress, passcode from customers where emailaddress = " . "'" . $login . "';";
$userdata = array();
$returnedPw = mysqli_query($conn, $query);
// 	for ($i = 0; $i < ($row = mysqli_fetch_row($returnedPw)); $i++)
// 	{
		while ($row = mysqli_fetch_assoc($returnedPw)){
		echo $row['emailaddress']."</br>";
		echo $row['passcode']."</br>";
		$email = $row['emailaddress'];
		$password = $row['passcode'];
		$userdata['username'] = $email;
		$userdata['password'] = $password;
		/*debugging
		 * $password = $row['password'];
		echo $password;
		*/
		}
	
	//}
	
	
