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
						Passwort ändern
					</h2>
					<form>
						<div class="form-group">
							<label>Altes Passwort:</label>
							<input type="password" class="form-control" placeholder="Altes Passwort">
							<label>Neues Passwort:</label>
							<input type="password" class="form-control" placeholder="Neues Passwort">
							<label>Neues Passwort bestätigen:</label>
							<input type="password" class="form-control" placeholder="Neues Passwort bestätigen">
						</div>
						<a href="profile.php" class="btn btn-info grey" role="button" style="background-color:#999; border-color:#999">Abrrechen</a>
						<button type="submit" class="btn btn-primary">Bestätigen</button>		
					</form>
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 