<?php
	require_once 'session.php';
	require_once 'connection.php';
	require_once 'loginwall.php';

	$title = "Suchergebnisse - soon";
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
					<?php
						if(isset($_GET['search'])) {
							$searchvalue = $_GET['search'];
							
							// Prüfung, ob ein Suchbegriff angegeben wurde
							if(empty($searchvalue)) {
								echo "<h2 class='no_box'>Keine Suchergebnisse</h2>
								<div class='alert alert-danger'>Geben Sie einen Suchbegriff ein</div>";
								$_SESSION['searchvalue'] = '';
							} else {								
								$_SESSION['searchvalue'] = $searchvalue;	
								
								// Ausgabe Titel mit Suchbegriff
								echo "<h2 class='margin-bottom-4px'>Suchergebnisse zu '".$searchvalue."'</h2>";
								
								// Suche nach einem Termin, der im Terminnamen den Suchbegriff enthält und der heute oder in Zukunft stattfindet
								$sql_select = "SELECT * FROM `appointments` WHERE userid = '".$userid."' AND appointmentname LIKE '%".$searchvalue."%' AND date >= '".date("Y-m-d")."' ";
								$sql_select = db::$link->query($sql_select);
								while($row = $sql_select->fetch_array()) {
									
									if (empty($row['appointmentid'])) {
										// Ausgabe, wenn kein Termin an diesem Datum besteht
										echo "<div class='noappointment'>Keine Termine</div>";
									} else {
										echo '';
									}
									
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
						
									// Ausgabe Terminname und Termindatum
									echo "<div class='appointment'>
									<a href='appointment.php?a=".$row['appointmentid']."'".$appointment_color."><div class='title'><b>".$row['appointmentname']."</b></a>
												<span class='date_output'> <span class='glyphicon glyphicon-time'></span> ".$date_output."</span>
												<div class='float_right'>
													<a href='remove.php?a=".$row['appointmentid']."'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></a>
													<a href='edit_appointment.php?a=".$row['appointmentid']."'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>
													<a href=''><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span></button></a>
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
										echo "</div>"; // Ende von .appointmentinformation
									}
									
									echo "</div></div>"; // Ende von .appointment und von .col-md-1
								}
							}
						} // Ende von if(isset($_GET['search']))
					?>
					<div class="last_element">
						<a class="btn btn-primary grey-button" href="calendar.php">Zum Kalender</a>
					</div>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>