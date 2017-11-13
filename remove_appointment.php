<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	$title = "Termin erfolgreich gelöscht - soon";
	
	if(isset($_GET['a'])) {
		$appointmenttoken = $_GET['a'];
	}
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
					<h2>Termin erfolgreich gelöscht</h2>
					<?php						
						$sql_delete = "DELETE FROM appointments WHERE appointmenttoken = '$appointmenttoken' and userid = '$userid'";
						$sql_delete = $connection->query($sql_delete);
						
						echo "<div class='alert alert-success'>Der Termin wurde erfolgreich gelöscht</div>";
						
						header('Location: '.$path.'calendar')
					?>
				</div> <?php // Ende von .col-xs-12.col-md.6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>