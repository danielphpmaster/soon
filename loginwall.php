<?php
	if(isset($_GET['ai']) && $_GET['ai'] == $appointmentid) {
	} else {
		// Prüfung, ob der Benutzer angemeldet ist. Wenn nein: Umleitung zu login.php
		if(!isset($_SESSION['userid'])) {
			die(header('Location: '.$path.'login'));
		}
	}
?>