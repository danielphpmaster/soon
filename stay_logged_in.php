<?php
	require_once 'connection.php';

	if(isset($_COOKIE['soonstayloggedin']) and isset($_SESSION['usertoken'])) {
		$sql_select = "SELECT * FROM users WHERE usertoken = '".$_COOKIE['soonstayloggedin']."'";
			
		foreach ($connection->query($sql_select) as $row) {
			$usertoken = $row['usertoken'];
			$_SESSION['usertoken'] = $usertoken;
		}
	}
?>