<?php
	if(isset($_GET['ai']) && $_GET['ai'] == $appointmentid) {
	} else {
		// Prüfung, ob der Benutzer angemeldet ist. Wenn nein: Umleitung zu login.php
		if(!isset($_SESSION['userid'])) {
			die(header('Location: '.$path.'login'));
		}
	}
	
	if(empty($site) OR $site <> 'verification') {
		if ($_SESSION['email_verified'] == 'false') {
			die(header('Location: '.$path.'verification'));
		}
	}
	
	include 'key.php';
?>