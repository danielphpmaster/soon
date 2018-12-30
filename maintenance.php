<?php
	/* Pfad (lokal = "/soon/", auf dem Server: "/") */
	$path = "/soon/";
	
	$maintenance = 'false';
	
	if($maintenance == 'false') {
		header('Location: '.$path);
	} else {		
		include 'session.php';
		// Wenn in angemeldetem Zustand: Umleitung zu calendar.php
		if(isset($_SESSION['userid'])) {
			session_destroy();
			setcookie ("soonstayloggedin", "", time() - (86400 * 365));
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>soon maintenance</title>
	</head>

	<body>
		<div style="width: 300px; margin: auto; margin-top: 100px; text-align: center;">
			<img src="<?php echo $path; ?>images/logo.svg" height="25px">
			<p style="font-family: sans-serif; font-size: 18pt">
				will be back online soon.
			</p>
		</div>
	</body>
</html>

