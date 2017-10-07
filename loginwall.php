<?php
	if(!isset($_SESSION['userid'])) {
		die(header('Location: login.php'));
	}
?>