<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';

	$title = "Termin hinzufügen - soon";
	
	if(isset($_GET['date'])) {
		$date = $_GET['date'];
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
					<h2>Termin hinzufügen</h2>
					<?php
						if(isset($_GET['add'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
							
							// Werte aus dem Formular als Variablen speichern
							$appointmentname = $_POST['appointmentname'];
							$date = $_POST['date'];
							$time = $_POST['time'];
							$location = $_POST['location'];
							$comment = $_POST['comment'];
	
							// Überprüfung, ob ein Terminname angegeben wurde
							if(empty($appointmentname)) {
								echo '<div class="alert alert-danger">Geben Sie einen Terminnamen ein</div>';
								$error = true;
							}
											
							// Überprüfung, ob ein gültiges Datum angegeben wurde							
							$formats = array("d.m.Y", "Ymd", "Y-m-d");
							$dates = array($date);
							
							foreach ($dates as $input) {
								foreach ($formats as $format) {
									// echo "Applying format $format on date $input...<br>";
									$date2 = DateTime::createFromFormat($format, $input);
									
									if ($date2 == false) {
										// echo "Failed<br>";
									} else {
										// echo "Success<br>";
										$date = date("Y-m-d", strtotime($date));
									}
								}
							}
							 
							function validateDate($date) {
								$d = DateTime::createFromFormat('Y-m-d', $date);
								return $d && $d->format('Y-m-d') === $date;
							}
								
							if(validateDate($date) == '0') {
								echo '<div class="alert alert-danger">Geben Sie ein gültiges Datum ein</div>';
								$error = true;									
							}
								
							/* Überprüfung, ob ein Datum in der Zukunft angegeben wurde
							if($date <= time()) {
									echo '<div class="alert alert-danger">Geben Sie ein zukünftiges Datum ein</div>';
									$error = true;												
							}*/
								
							// Wenn kein Fehler besteht, dann wird der Termin gespeichert
							if(!$error) {
								$sql_insert = "INSERT INTO appointments (userid, appointmentname, date, time, location, comment) VALUES ('".$userid."', '".$appointmentname."', '".$date."', '".$time."', '".$location."', '".$comment."')";
								$sql_insert = $connection->query($sql_insert);
								
								header('Location: calendar.php');
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['add']))
					?>
					<form action="?add=1" method="post">
						<div class="day">
							<div class='date outside_calendar'><b><input name="date" class="form-control" id="date" min="<?php echo date("Y-m-d"); ?>" placeholder="Datum" value="<?php if(isset($date)){echo $date;}?>"></b></div>
							<div class='appointment'>
								<div class='title'><b><input name="appointmentname" type="text" class="form-control" id="appointmentname" placeholder="Terminname" value="<?php if(isset($appointmentname)){echo $appointmentname;}?>"></b></div>
								<div class='appointmentinformation'>
									<div class='time'><span class='glyphicon glyphicon-time form' style='color:#777'; aria-hidden='true'></span><input name="time" class="form-control with_glyphicon" id="time" placeholder="Zeit" value="<?php if(isset($time)){echo $time;}?>"></div>
									<div class='location'><span class='glyphicon glyphicon-map-marker form' style='color:#777'; aria-hidden='true'></span><input name="location" type="text" class="form-control with_glyphicon" id="location" placeholder="Ort" value="<?php if(isset($location)){echo $location;}?>"></div>
									<div class='comment'><span class='glyphicon glyphicon-info-sign form' style='color:#777'; aria-hidden='true'></span><input name="comment" type="text" class="form-control with_glyphicon" id="comment" placeholder="Bemerkung" value="<?php if(isset($comment)){echo $comment;}?>"></div>
								</div>
							</div>
						</div>
						<div class="last_element">
							<button type="submit" class="btn btn-primary">Termin erfassen</button>
							<a class="btn btn-primary grey-button" href="calendar.php">Abrrechen</a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>