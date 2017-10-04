<!DOCTYPE html>

<html>

<?php
	$title = "Oktober 2017 - soon";
?>

<head>
	<?php include 'head.php';?>
</head>

<body>
	<?php include 'navbar.php';?>
	
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
						Benutzername: <?php echo $username; ?><a href="index.php/edit.php">Benutzername ändern</a><br>
						</div>
						<div class="edit-line">
						E-Mail: <?php echo $email; ?><a href="index.php/edit.php">E-Mail ändern</a><br>
						</div>
						<div class="edit-line">
						<a href="index.php/edit.php">Passwort ändern</a><br>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 