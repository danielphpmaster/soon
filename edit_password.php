<?php
	include 'session.php';
	include 'loginwall.php';
	
	$title = "Oktober 2017 - soon";
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
						<h2>Passwort ändern</h2>
						<form>
							<div class="form-group">
								<p>
									<label>Altes Passwort:</label>
									<input type="password" class="form-control" placeholder="Altes Passwort">
								</p>
								<p>
									<label>Neues Passwort:</label>
									<input type="password" class="form-control" placeholder="Neues Passwort">
								</p>
								<p>
									<label>Neues Passwort bestätigen:</label>
									<input type="password" class="form-control" placeholder="Neues Passwort bestätigen">
								</p>
							</div>
							<button type="submit" class="btn btn-primary">Bestätigen</button>
							<a href="profile.php">Abrrechen</a>
						</form>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>				
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
	</body>
</html> 