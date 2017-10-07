<!DOCTYPE html>

<html>

<?php
	$title = "Abmeldung erfolgreich - soon";
	
	include 'connection.php';
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
						Abmeldung erfolgreich
					</h2>
					<?php
					
						session_destroy();
						echo "<div class='alert alert-success'>","Auf wiedersehen, ".$username."!</div>";
						header('Location: index.php')				
					?>	
					
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 