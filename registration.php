<!DOCTYPE html>

<html>

<?php
	$title = "Registrieren - soon";
	
	include 'connection.php';
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
						Registrieren
					</h2>
					<form action="confirmation.php" method="post">
						<div class="form-group">
							<label for="exampleInputUsername1">Benutzername</label>
							<input name="username" type="text" class="form-control" id="username" placeholder="Benutzername">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">E-Mail-Adresse</label>
							<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-Mail-Adresse">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Passwort</label>
							<input name="password" type="password" class="form-control" id="password" placeholder="Passwort">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Passwort wiederholen</label>
							<input name="password" type="password" class="form-control" id="password" placeholder="Passwort wiederholen">
						</div>
						<button type="submit" class="btn btn-primary">Registrieren</button>
						Bereits einen Account? <a href="login.php">Anmelden!</a>
					</form>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 