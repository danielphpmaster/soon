<?php
	require_once 'session.php';
	require_once 'connection.php';
	require_once 'loginwall.php';
	
	$title = "Termin erfolgreich gelöscht - soon";
	
	if(isset($_GET['a'])) {
		$appointmentid = $_GET['a'];
	}
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
					<h2>Termin erfolgreich gelöscht</h2>
					<?php						
						$sql_delete = "DELETE FROM appointments WHERE appointmentid = '".$appointmentid."' and userid = '".$userid."'";
						$sql_delete = db::$link->query($sql_delete);
						
						echo "<div class='alert alert-success'>Der Termin wurde erfolgreich gelöscht</div>";
						
						header('Location: calendar.php')
					?>
				</div> <?php // Ende von .col-xs-12.col-md.6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>