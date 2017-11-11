<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	$title = "Registrierung erfolgreich - soon";
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
					<h2>Registrierung erfolgreich</h2>
					<?php
						echo "<div class='alert alert-success'>","Willkommen bei soon, ".$username."!</div>";
					?>
					<div class="last_element">
						<a href="<?php echo $path; ?>calendar" class="btn btn-primary" role="button">Loslegen</a>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>