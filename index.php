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
						<div class="index-title">Alle Ihre Termine – immer und überall abrufbar</div>
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
					
					<div class="col-xs-6 col-md-3 index-margin-bottom">
						<a href="login.php">
							<div class="linkbox login">
								Anmelden
							</div>
						</a>
					</div>
					
					<div class="col-xs-12 col-md-3"></div>
					
					<div class="col-xs-12 more-information-button">
						<a href="" style="color: white;"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
					</div>
				</div> <?php // Ende von .row ?>
			</div> <?php // Ende von .container ?>
		</div> <?php // Ende von .background-image ?>
	</body>
</html>