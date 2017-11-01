<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';

	if(isset($_GET['a'])) {
		$appointmentid = $_GET['a'];
		$_SESSION['appointmentid'] = $appointmentid;
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM appointments WHERE userid = '".$userid."' AND appointmentid = '".$appointmentid."'";
		
		// Termininformationen als Variablen speichern
		foreach ($connection->query($sql_select) as $row) {
		}
		
		// Umleitung, wenn kein Termin gefunden
		if(empty($row['appointmentname'])) {
			header('Location: calendar.php');
		}
	} elseif (empty($_GET['editappointment'])) {
		header('Location: calendar.php');
	}
	
	$title = "Termin bearbeiten - soon";
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
					<h2>Termin bearbeiten</h2>
					<?php
						if(isset($_GET['editappointment'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
							
							// Werte aus dem Formular als Variablen speichern
							$newappointmentname = $_POST['appointmentname'];
							$newdate = $_POST['date'];
							$newtime = $_POST['time'];
							$newlocation = $_POST['location'];
							$newcomment = $_POST['comment'];
												
							// Überprüfung, ob ein Terminname angegeben wurde
							if(empty($newappointmentname)) {
								echo '<div class="alert alert-danger">Geben Sie einen Terminnamen ein</div>';
								$error = true;
							}
																
							// Überprüfung, ob ein gültiges Datum angegeben wurde							
							$formats = array("d.m.Y", "Ymd", "Y-m-d");
							$dates = array($newdate);

							foreach ($dates as $input) {
								foreach ($formats as $format) {
									// echo "Applying format $format on date $input...<br>";
									$date2 = DateTime::createFromFormat($format, $input);
									
									if ($date2 == false) {
										// echo "Failed<br>";
									} else {
										// echo "Success<br>";
										$newdate = date("Y-m-d", strtotime($newdate));
									}
								}
							}
							 
							function validateDate($newdate) {
									$d = DateTime::createFromFormat('Y-m-d', $newdate);
									return $d && $d->format('Y-m-d') === $newdate;
								}
								
							if(validateDate($newdate) == '0') {
								echo '<div class="alert alert-danger">Geben Sie ein gültiges Datum ein</div>';
								$error = true;									
							}
								
							// Überprüfung, ob ein Datum in der Zukunft angegeben wurde
							/*if($date < time()) {
									echo '<div class="alert alert-danger">Geben Sie ein zukünftiges Datum ein</div>';
									$error = true;												
							}*/
								
							// Wenn kein Fehler besteht, dann wird der Termin gespeichert
							if(!$error) {									
								$sql_update = "UPDATE appointments SET appointmentname = '".$newappointmentname."', date = '".$newdate."', time = '".$newtime."', location = '".$newlocation."', comment = '".$newcomment."' WHERE userid = '".$userid."' AND appointmentid = '".$appointmentid."'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: calendar.php');						
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['add']))
					?>
					<form action="?editappointment=1" method="post">
						<div class="day">
							<div class='date outside_calendar'><b><input name="date" class="form-control" id="date" min="<?php echo date("Y-m-d"); ?>" placeholder="Datum" value="<?php if(isset($row['date'])){echo $row['date'];} else {echo $newdate;}?>"></b></div>
							<div class='appointment'>
								<div class='title'><b><input name="appointmentname" type="text" class="form-control" id="appointmentname" placeholder="Terminname" value="<?php if(isset( $row['appointmentname'])){echo  $row['appointmentname'];} else {echo $newappointmentname;}?>"></b></div>
								<div class='appointmentinformation'>
									<div class='time'><span class='glyphicon glyphicon-time form' style='color:#777'; aria-hidden='true'></span><input name="time" class="form-control with_glyphicon" id="time" placeholder="Zeit" value="<?php if(isset($row['time'])){echo $row['time'];} else {echo $newtime;}?>"></div>
									<div class='location'><span class='glyphicon glyphicon-map-marker form' style='color:#777'; aria-hidden='true'></span><input name="location" type="text" class="form-control with_glyphicon" id="location" placeholder="Ort" value="<?php if(isset($row['location'])){echo $row['location'];} else{echo $newlocation;}?>"></div>
									<div class='comment'><span class='glyphicon glyphicon-info-sign form' style='color:#777'; aria-hidden='true'></span><input name="comment" type="text" class="form-control with_glyphicon" id="comment" placeholder="Bemerkung" value="<?php if(isset($row['comment'])){echo $row['comment'];} else{echo $newcomment;}?>"></div>
								</div>
							</div>
						</div>
						<div class="last_element">
							<button type="submit" class="btn btn-primary">Speichern</button>
							<a class="btn btn-primary grey-button" href="calendar.php">Abrrechen</a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>