<!DOCTYPE html>

<html>

<?php
	$title = "Anmelden - soon";
	
	include 'connection.php'
	
					/*	VALUES (".$username.", ".$email.", ".$password.")";*/
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
						Anmelden
					</h2>
					<form>
						<div class="form-group">
							<label for="exampleInputEmail1">E-Mail-Adresse</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Mail-Adresse">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Passwort</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Passwort">
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input type="checkbox" class="form-check-input">
								Angemeldet bleiben
							</label>
						</div>
						<button type="submit" class="btn btn-primary">Anmelden</button>
						Noch keinen Account? <a href="registration.php">Registrieren!</a>						
					</form>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 