<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';

	$title = "Suchergebnisse - soon";
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
					<div class="box result">
					<?php
						if(isset($_GET['search'])) {
							$searchvalue = $_GET['search'];
							
							// Prüfung, ob ein Suchbegriff angegeben wurde
							if(empty($searchvalue)) {
								echo "<h2>Keine Suchergebnisse</h2>
								<div class='alert alert-danger'>Geben Sie einen Suchbegriff ein</div></div>";
								$_SESSION['searchvalue'] = '';
							} else {
								$_SESSION['searchvalue'] = $searchvalue;							
								
								// Suche nach einem Termin, der im Terminnamen den Suchbegriff enthält und der heute oder in Zukunft stattfindet
								$sql = "SELECT * FROM `appointments` WHERE userid = '".$userid."' AND appointmentname LIKE '%".$searchvalue."%' AND date >= '".date("Y-m-d")."' ";
								
								// Ausgabe Titel mit Suchbegriff
								echo "<h2>Suchergebnisse zu '".$searchvalue."'</h2></div>";
																
								foreach ($connection->query($sql) as $row) {
									// Variable, die definiert, welche Farbe der Terminname hat
									if ($row['date'] == date("Y-m-d")) {
											$appointmentcolor = "style='color: #d9534f;'";
									} else {
											$appointmentcolor = "";
									}
									
									// Ausgabe Termindatum
									echo "<div class='day'><div class='date outsidecalendar'><b>".$row['date']."</b></div>";
									  
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
						<a href="calendar.php" class="result_margin">Zurück</a>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>