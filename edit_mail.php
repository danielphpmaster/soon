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
						E-Mail-Adresse ändern
					</h2>
					<form>
						<div class="form-group">
							<label>Tippen Sie Ihre neue E-Mail-Adresse ein: </label>
							<input type="mail" class="form-control" placeholder="Neue E-Mail-Adresse">
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