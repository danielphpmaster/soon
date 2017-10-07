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
						<h2>E-Mail-Adresse ändern</h2>
						<form>
							<div class="form-group">
								<label>Tippen Sie Ihre neue E-Mail-Adresse ein: </label>
								<input type="mail" class="form-control" placeholder="Neue E-Mail-Adresse">
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