<?php
	require_once 'session.php';
	require_once 'connection.php';
	
	$title = "Abmeldung erfolgreich - soon";
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
					<h2>Abmeldung erfolgreich</h2>
					<?php						
						session_destroy();
						echo "<div class='alert alert-success'>","Auf wiedersehen, ".$username."!</div>";
						header('Location: index.php')
					?>						
					</div> <?php // Ende von .box ?>
				</div> <?php // Ende von .col-xs-12.col-md.6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>