<?php
	// Prüfung, ob der Benutzer angemeldet ist. Wenn nein: Umleitung zu login.php
	if(!isset($_SESSION['userid'])) {
		die(header('Location: login.php'));
	}
?>