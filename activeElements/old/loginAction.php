<?php
include "../../handler/accountHandler.php";

# log in user

$sessionid = AuthenticateUser($login, $password, $DBLink);

if (!sessionid) {
	;
}
$login = LoginUser($sessionId);