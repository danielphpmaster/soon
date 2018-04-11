<?php
	include 'inlcude_all.php';

	session_destroy();
	setcookie ("soonstayloggedin", "", time() - (86400 * 365));
	header('Location: '.$path);
?>