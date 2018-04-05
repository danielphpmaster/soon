<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['a'])) {
		$appointmenttoken = $_GET['a'];
	}

	$sql_delete = "DELETE FROM appointments WHERE appointmenttoken = '$appointmenttoken' and userid = '$userid'";
	$sql_delete = $connection->query($sql_delete);

	header('Location: '.$path.'calendar')
?>