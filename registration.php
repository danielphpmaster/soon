<!DOCTYPE html>

<html>

<?php
	$title = "Registrieren - soon";
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
					<form>
						<div class="form-group">
							<label for="exampleInputUsername1">Benutzername</label>
							<input type="text" class="form-control" id="exampleInputUsername1" placeholder="Benutzername">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">E-Mail-Adresse</label>
							<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Mail-Adresse">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Passwort</label>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Passwort">
						</div>
						<button type="submit" class="btn btn-primary">Registrieren</button>
					</form>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 