<?php
	require_once 'session.php';
	require_once 'connection.php';
	require_once 'loginwall.php';
	
	$title = "Termin löschen - soon";
	
	if(isset($_GET['a'])) {
		$appointmentid = $_GET['a'];
	}	
	
	$sql_select = "SELECT COUNT(appointmentid) FROM appointments WHERE userid = '".$userid."' AND appointmentid = '".$appointmentid."'";
	$count_results = db::$link->query($sql_select);

	$get_total  = $count_results->fetch_row();
	$get_total = $get_total[0];
						
	if($get_total < '1') {
		header('Location: calendar.php');
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
					<h2>Termin löschen</h2>
					<?php						
						echo "<div class='alert alert-success'>Termin löschen?</div>";
					?>
					<div class="last_element">
						<a class="btn btn-primary" href="remove_appointment.php?a=<?php echo $appointmentid ?>">Bestätigen</a>
						<a class="btn btn-primary grey-button" href="calendar.php">Abbrechen</a>
					</div>
				</div> <?php // Ende von .col-xs-12.col-md.6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>