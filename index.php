<?php
	include 'session.php';
	
	// Wenn in angemeldetem Zustand: Umleitung zu calendar.php
	if(isset($_SESSION['userid'])) {
		die(header('Location: calendar.php'));
	}

	$title = "soon - Dein persönlicher Kalender";
?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'head.php';?>
	</head>

	<body>
		<?php include 'navbar.php';?>
		<div class="background-image">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-3"></div>
					
					<div class="col-xs-12 col-md-6">
						<h1>Alle Ihre Termine – immer und überall abrufbar</h1>
					</div>
					
					<div class="col-xs-12 col-md-3"></div>
				</div> <!-- Ende von .row -->
				
				<div class="row">
					<div class="col-xs-12 col-md-3"></div>
					
					<div class="col-xs-6 col-md-3">
						<a href="registration.php">
							<div class="linkbox registration">
								Registrieren
							</div>
						</a>
					</div>
					
					<div class="col-xs-6 col-md-3">
						<a href="login.php">
							<div class="linkbox login">
								Anmelden
							</div>
						</a>
					</div>
					
					<div class="col-xs-12 col-md-3"></div>
				</div> <!-- Ende von .row -->
			</div> <!-- Ende von .container -->
		</div> <!-- Ende von .background-image -->
	</body>
</html>
