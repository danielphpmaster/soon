<?php
	require_once 'session.php';
	require_once 'loginwall.php';
	
	$title = "Registrierung erfolgreich - soon";
?>

<!DOCTYPE html>

<html>
	<head>
		<?php require_once 'head.php';?>
	</head>

	<body>
		<?php require_once 'navbar.php';?>
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-3"></div>
				
				<div class="col-xs-12 col-md-6">
					<div class="box">
						<h2>Registrierung erfolgreich</h2>
						<?php
							echo "<div class='alert alert-success'>","Willkommen bei soon, ".$username."!</div>";
						?>						
						<a href="calendar.php" class="btn btn-info" role="button">Loslegen</a>						
					</div>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>