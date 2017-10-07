<!DOCTYPE html>

<html>

<?php

	
	$title = "Oktober 2017 - soon";
?>

<head>
	<?php include 'head.php';?>
</head>

<body>
	<?php include 'navbar.php';
if(!isset($_SESSION['userid'])) {
 die(header('Location: login.php'));
	}?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-3">
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="box">
					<h2>
						Mein Profil
					</h2>
						<div class="edit-line">
						Benutzername: <strong><?php echo $username; ?></strong><a href="edit_username.php"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						</div>
						<div class="edit-line">
						E-Mail: <strong><?php echo $email; ?></strong><a href="edit_mail.php"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
						</div>
						<div class="edit-line">
						<a href="edit_password.php">Passwort ändern</a><br>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 