<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['a'])) {
		$appointmenttoken = $_GET['a'];
		$_SESSION['appointmenttoken'] = $appointmenttoken;
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM appointments WHERE userid = '$userid' AND appointmenttoken = '$appointmenttoken'";
		
		// Termininformationen als Variablen speichern
		foreach ($connection->query($sql_select) as $row) {
		}
		
		// Umleitung, wenn kein Termin gefunden
		if(empty($row['appointmentname'])) {
			header('Location: '.$path.'calendar');
		}
	} elseif (empty($_GET['editappointment'])) {
		header('Location: '.$path.'calendar');
	}
	
	$title = $t_title_edit_appointment[$language];
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
					<h2><?php echo $t_edit_appointment[$language] ?></h2>
					<?php
						if(isset($_GET['editappointment'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
							
							// Werte aus dem Formular als Variablen speichern
							if(empty($_POST['appointmentname'])) {
								$newappointmentname = "";
							} else {
								$newappointmentname = $_POST['appointmentname'];								
							}
							
							if(empty($_POST['date'])) {
								$newdate = "";
							} else {
								$newdate = $_POST['date'];								
							}
							
							if(empty($_POST['time'])) {
								$newtime = "";
							} else {
								$newtime = $_POST['time'];								
							}
							
							if(empty($_POST['location'])) {
								$newlocation = "";
							} else {
								$newlocation = $_POST['location'];								
							}
							
							if(empty($_POST['comment'])) {
								$newcomment = "";
							} else {
								$newcomment = $_POST['comment'];								
							}
														
							// Überprüfung, ob ein Terminname angegeben wurde
							if(empty($newappointmentname)) {
								echo '<div class="alert alert-danger">'.$t_insert_an_appointment_name[$language].'</div>';
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
								echo '<div class="alert alert-danger">'.$t_insert_a_valid_date[$language].'</div>';
								$error = true;
							}
							
							// Überprüfung, ob ein Datum in der Zukunft angegeben wurde
							/*if($date < time()) {
									echo '<div class="alert alert-danger">Geben Sie ein zukünftiges Datum ein</div>';
									$error = true;												
							}*/
								
							// Wenn kein Fehler besteht, dann wird der Termin gespeichert
							if(!$error) {									
								$sql_update = "UPDATE appointments SET appointmentname = '$newappointmentname', date = '$newdate', time = '$newtime', location = '$newlocation', comment = '$newcomment' WHERE userid = '$userid' AND appointmenttoken = '$appointmenttoken'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: '.$path.'calendar');						
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['add']))
					?>
					<form action="?editappointment=1" method="post">
						<div class="day">
							<div class='date outside_calendar'><b><input name="date" class="form-control" id="date" min="<?php echo date("Y-m-d"); ?>" placeholder="<?php echo $t_date[$language] ?>" value="<?php if(isset($row['date'])){echo $row['date'];} else {echo htmlspecialchars($newdate);}?>"></b></div>
							<div class='appointment'>
								<div class='title'><b><input name="appointmentname" type="text" class="form-control" id="appointmentname" placeholder="<?php echo $t_appointment_name[$language] ?>" value="<?php if(isset( $row['appointmentname'])){echo htmlspecialchars($row['appointmentname']);} else {echo htmlspecialchars($newappointmentname);}?>"></b></div>
								<div class='appointmentinformation'>
									<div class='time'><span class='glyphicon glyphicon-time form' style='color:#777'; aria-hidden='true'></span><input name="time" class="form-control with_glyphicon" id="time" placeholder="<?php echo $t_time[$language] ?>" value="<?php if(isset($row['time'])){echo htmlspecialchars($row['time']);} else {echo htmlspecialchars($newtime);}?>"></div>
									<div class='location'><span class='glyphicon glyphicon-map-marker form' style='color:#777'; aria-hidden='true'></span><input name="location" type="text" class="form-control with_glyphicon" id="location" placeholder="<?php echo $t_location[$language] ?>" value="<?php if(isset($row['location'])){echo htmlspecialchars($row['location']);} else{echo htmlspecialchars($newlocation);}?>"></div>
									<div class='comment'><span class='glyphicon glyphicon-info-sign form' style='color:#777'; aria-hidden='true'></span><input name="comment" type="text" class="form-control with_glyphicon" id="comment" placeholder="<?php echo $t_comment[$language] ?>" value="<?php if(isset($row['comment'])){echo htmlspecialchars($row['comment']);} else{echo htmlspecialchars($newcomment);}?>"></div>
								</div>
							</div>
						</div>
						<div class="last_element">
							<button type="submit" class="btn btn-primary"><?php echo $t_save[$language] ?></button>
							<a class="btn btn-primary grey-button" href="<?php echo $path; ?>calendar"><?php echo $t_cancel[$language] ?></a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>