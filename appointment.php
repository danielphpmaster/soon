<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['a'])) {
		$appointmentid = $_GET['a'];
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM appointments WHERE userid = '$userid' AND appointmentid = '$appointmentid'";
		
		foreach ($connection->query($sql_select) as $row) {
			// Termininformationen als Variablen speichern
			$appointmentname = $row['appointmentname'];
			$date = $row['date'];
			$time = $row['time'];
			$location = $row['location'];
			$comment = $row['comment'];
		}
				
		// Umleitung, wenn kein Termin gefunden
		if(empty($appointmentname)) {
			header('Location: '.$path.'calendar');
		}
	} else {
		// Umleitung, wenn kein "a"-Wert mitgeschickt wurde
		header('Location: '.$path.'calendar');
	}
	
	$title = "".$appointmentname." - soon";
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
					<h2>Termin</h2>
					<?php
						// Variable, die definiert, welche Farbe der Terminname hat 
						if ($row['date'] == date("Y-m-d")) {
							$appointment_color = "style='color: #d9534f;'";
						} else {
							$appointment_color = "";
						}
						
						echo "<div class='day'>";
						
						if($row['date'] == date("Y-m-d")) {
							$date_output = "heute (".date("d. M", strtotime($row['date'])).")";
						} elseif($row['date'] == date("Y-m-d", strtotime("+1 day"))) {
							$date_output = "morgen (".date("d. M", strtotime($row['date'])).")";
						} else {
							$date_output = date("d. M Y", strtotime($row['date']));
						}
						
						// Ausgabe Terminname
						echo "<div class='appointment' style='margin-top: 0'>
									<div ".$appointment_color." class='title'><b>".$row['appointmentname']."</b>
										<span class='date_output'> <span class='glyphicon glyphicon-time'></span> ".$date_output."</span>
										<div class='float_right'>
											<a href='".$path."remove?a=".$row['appointmentid']."'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></a>
											<a href='".$path."edit_appointment?a=".$row['appointmentid']."'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>
											<a href='".$path."share_appointment'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span></button></a>
										</div>
									</div>";
						
						// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist
						if($row['time'] == "00:00:00" and empty($row['location']) and empty($row['comment'])) {
							echo "";
						} else {
							echo "<div class='appointmentinformation'>";
						}
						
						// Wenn vorhanden: Ausgabe Terminzeit
						if($row['time'] == "00:00:00") {
							echo "";
						} else {
							echo "<div class='time'><span class='glyphicon glyphicon-time' style='color:#777'; aria-hidden='true'></span> ".$row['time']."</div>";
						}
						
						// Wenn vorhanden: Ausgabe Terminort
						if(empty($row['location'])) {
							echo "";
						} else {
							echo "<div class='location'><span class='glyphicon glyphicon-map-marker' style='color:#777'; aria-hidden='true'></span> ".$row['location']."</div>";
						}
						
						// Wenn vorhanden: Ausgabe Terminkommentar
						if(empty($row['comment'])) {
							echo "";
						} else {
							echo "<div class='comment'><span class='glyphicon glyphicon-info-sign' style='color:#777'; aria-hidden='true'></span> ".$row['comment']."</div>";
						}
						
						// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist						
						if($row['time'] == "00:00:00" and empty($row['location']) and empty($row['comment'])) {
							echo "";
						} else {
							echo "</div>"; // Ende .appointmentinformation
						}
						
						echo "</div></div>"; // Ende .appointment					
					?>
					<div class="last_element">
						<a class="btn btn-primary grey-button" href="<?php echo $path; ?>calendar">Zum Kalender</a>
					</div>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>