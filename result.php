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
								
								// Suche nach einem Termin, der im Terminnamen den Suchbegriff enthält und der heute oder in Zukunft stattfindet
								$sql = "SELECT * FROM `appointments` WHERE userid = '".$userid."' AND appointmentname LIKE '%".$searchvalue."%' AND date >= '".date("Y-m-d")."' ";
								
								// Ausgabe Titel mit Suchbegriff
								echo "<h2 class='no_box'>Suchergebnisse zu '".$searchvalue."'</h2>";
																
								foreach ($connection->query($sql) as $row) {
									
									if (empty($row['appointmentid'])) {
										// Ausgabe, wenn kein Termin an diesem Datum besteht
										echo "<div class='noappointment'>Keine Termine</div>";
									} else {
										echo '';
									}
									
									// Variable, die definiert, welche Farbe der Terminname hat
									if ($row['date'] == date("Y-m-d")) {
											$appointmentcolor = "style='color: #d9534f;'";
									} else {
											$appointmentcolor = "";
									}
									
									// Ausgabe Termindatum
									echo "<div class='day'>
											<div class='date outside_calendar'><b>".$row['date']."</b>
												<div class='float_right'>
													<a href=''><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></a>
													<a href=''><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>
													<a href=''><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span></button></a>
												</div>
											</div>";
									  
									// Ausgabe Terminname
									echo "<div class='appointment'>
									<a href='appointment.php?a=".$row['appointmentid']."'".$appointmentcolor."><div class='title'><b>".$row['appointmentname']."</b></div></a>";
									
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
					<div class="after_appointment">
						<a href="calendar.php">Zurück</a>
					</div>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>