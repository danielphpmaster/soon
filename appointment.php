<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['appointmenttoken'])) {
		$appointmenttoken = $_GET['appointmenttoken'];
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM appointments WHERE usertoken = '$usertoken' AND appointmenttoken = '$appointmenttoken'";			
		
		foreach ($connection->query($sql_select) as $row) {
			// Termininformationen als Variablen speichern
			$appointmentname = $string = openssl_decrypt($row['appointmentname'],"AES-128-ECB",$key);
			$date = $row['timestamp'];
			$time = $row['timestamp'];
			$location = openssl_decrypt($row['location'],"AES-128-ECB",$key);
			$comment = openssl_decrypt($row['comment'],"AES-128-ECB",$key);
			$appointmenttoken = $row['appointmenttoken'];
		}
		
		// Definierung Datumformat
		$t_day = 't_day_'.date("N", $date);
		$t_month = 't_month_'.date("n", $date);
		
		$t_date = array(
			${$t_day}[$language].", ".date("d. ", $date).${$t_month}[$language], 
			${$t_day}[$language].", ".${$t_month}[$language].date(" d", $date)
		);
				
		// Umleitung, wenn kein Termin gefunden
		if(empty($appointmentname)) {
			header('Location: '.$path.'calendar');
		}
	} else {
		// Umleitung, wenn kein "a"-Wert mitgeschickt wurde
		header('Location: '.$path.'calendar');
	}
			
	$title = "".$appointmentname." ".$t_title_appointment[$language]."";
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
					<?php
						echo "<h2>".$t_appointment[$language]."</h2>";
					
						// Variable, die definiert, welche Farbe der Terminname hat 
						$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", $date));
						
						if ($first_timestamp_of_day == strtotime(date("Y-m-d 00:00:00", time()))) {
							$appointment_color = "style='color: #d9534f;'";
						} else {
							$appointment_color = "";
						}
						
						echo "<div class='day'>";
						
						// Ausgabe Termindatum
						if(strtotime(date("Y-m-d 00:00:00", $date)) == strtotime(date("Y-m-d 00:00:00", time()))) {
							$date_output = $t_today[$language].", ".$t_date[$language];
						} elseif(strtotime(date("Y-m-d 00:00:00", $date)) == strtotime('+1 day', strtotime(date("Y-m-d 00:00:00", time())))) {
							$date_output = $t_tomorrow[$language].", ".$t_date[$language];
						} else {
							$date_output = $t_date[$language];
						}
						
						// Ausgabe Terminname
						echo "<div class='appointment' style='margin-top: 0'>
									<div ".$appointment_color." class='title'><b>".htmlspecialchars($appointmentname)."</b>
										<span class='date_output'> <i class='fas fa-calendar'></i> ".$date_output."</span>";
						
						echo "<div class='float_right'>
									
									<button type='button' class='btn btn-light btn-sm' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-times'></i></button>
									<a href='".$path."edit?a=".$appointmenttoken."'><button type='button' class='btn btn-light btn-sm'><i class='fas fa-pencil-alt'></i></button></a>
								</div>
							</div>";
						?>
						
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">
											<?php echo $t_delete_appointment[$language]; ?>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												<i class='fas fa-times'></i>
											</span>
										</button>
									</div>
									<div class="modal-body">
										<?php echo $t_do_you_want_to_delete_this_appointment[$language]; ?>
									</div>
									<div class="modal-footer">
										<?php
											echo"<a class='btn btn-red' href='".$path."remove?a=".$appointmenttoken."'>".$t_confirm[$language]."</a>";
										?>
										<button type="button" class="btn btn-light" data-dismiss="modal">
											<?php echo $t_cancel[$language]; ?>
										</button>
									</div>
								</div>
							</div>
						</div>
						
						<?php
						
						// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist
						if($row['time_set'] == 'false' and empty($location) and empty($comment)) {
							echo "";
						} else {
							echo "<div class='appointmentinformation'>";
						}
						
						// Definierung Zeitformat
						$t_time = array(
							date('G:i', $row['timestamp'])." Uhr",
							date('g.i a', $row['timestamp'])
						);
						
						// Wenn vorhanden: Ausgabe Terminzeit
						if($row['time_set'] == 'true') {
							echo "<div class='time'><i class='fas fa-clock'></i> ".$t_time[$language]."</div>";
						}
						
						// Wenn vorhanden: Ausgabe Terminort
						if(empty($location)) {
							echo "";
						} else {
							echo "<div class='location'><i class='fas fa-map-marker-alt'></i> ".htmlspecialchars($location)."</div>";
							echo "<iframe
									width='100%'
									height='250'
									frameborder='0' style='border:0'
									src='https://www.google.com/maps/embed/v1/place?key=AIzaSyDrsCwHGUhbw2CFT0Iw5JDjAOEDPvjDknw 
									&q=".htmlspecialchars($location)."' allowfullscreen>
								</iframe>";						
						}
						
						// Wenn vorhanden: Ausgabe Terminkommentar
						if(empty($comment)) {
							echo "";
						} else {
							echo "<div class='comment'><i class='fas fa-comment'></i> ".htmlspecialchars($comment)."</div>";
						}
						
						// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist						
						if($row['time_set'] == 'false' and empty($location) and empty($comment)) {
							echo "";
						} else {
							echo "</div>"; // Ende .appointmentinformation
						}
						
						echo "</div></div>"; // Ende .appointment					
						
						$month = date("F", $row['timestamp']);
						$year = date("Y", $row['timestamp']);
						
						echo "<div class='margin-bottom-90'>
								<a class='btn btn-light' href='".$path."calendar/".$year."/".$month."'>".$t_view_calendar[$language]."</a>
							</div>";
					?>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>