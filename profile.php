<?php
	include 'session.php';
	include 'loginwall.php';

	$title = "Mein Profil - soon";
?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'head.php';?>
	</head>

	<body>
		<?php include 'navbar.php';?>
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-3"></div>
				
				<div class="col-xs-12 col-md-6">
					<div class="box">
						<h2>Mein Profil</h2>
						
						<p>
							Benutzername: <strong><?php echo $username; ?></strong><a href="edit_username.php"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						</p>
						
						<p>
							E-Mail: <strong><?php echo $email; ?></strong><a href="edit_mail.php"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						</p>
						
						<p>
							<a href="edit_password.php">Passwort ändern</a><br>
						</p>						
					</div>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
	</body>
</html>