<?php
	require_once 'connection.php';

	if(isset($_COOKIE['soonstayloggedin'])) {
		$sql_select = "SELECT * FROM users WHERE usertoken = '".$_COOKIE['soonstayloggedin']."'";
			
		foreach ($connection->query($sql_select) as $row) {
			$userid = $row['userid'];
			$_SESSION['userid'] = $userid;
				
			$username = $row['username'];
			$_SESSION['username'] = $username;
			
			$email = $row['email'];
			$_SESSION['email'] = $email;
		}
	}
?>