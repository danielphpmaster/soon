<?php
	include 'inlcude_all.php';
	
	$title = "Abmeldung erfolgreich - soon";
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
					<h2>Abmeldung erfolgreich</h2>
					<?php						
						session_destroy();
						setcookie ("soonstayloggedin", "", time() - (86400 * 365));
						echo "<div class='alert alert-success'>","Auf wiedersehen, ".$username."!</div>";
						header('Location: '.$path)
					?>						
					</div> <?php // Ende von .box ?>
				</div> <?php // Ende von .col-xs-12.col-md.6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>