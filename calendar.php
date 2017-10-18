<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';
	
	$title = "".date('F')."  - soon";
?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'head.php';?>
	</head>

	<body>
		<?php include 'navbar.php';?>
				
		<div class="container">
			<div class="row" style="margin-top: 20px;">
				<div class="hidden-xs hidden-sm col-md-3">
				</div>
				<?php
				$date = date("Y-m-d");
				$month = date("m",strtotime($date))-'1';
				echo $month;
				
				echo"<div class='col-xs-6 col-sm-6 col-md-3'>
					<button type='button' class='btn btn-default'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span> September 2017</button>
				</div>
				<div class='col-xs-6 col-sm-6 col-md-3'>
					<button type='button' class='btn btn-default'>November 2017 <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></button>
				</div>";
				?>
				<div class="hidden-xs hidden-sm col-md-3">
				</div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
		
		<div class="calendar-container">
			<div class="row seven-cols">
				<?php
					$last_day_of_current_month = date("Y-m-t", strtotime($date));
					
					while ($date <= $last_day_of_current_month) {
						
						// Variable, die definiert, welche Farbe der Terminname hat
						if($date == date("Y-m-d")) {
							$appointmentcolor = "style='color: #d9534f;'";
						} else {
							$appointmentcolor = "";
						}
						
						// Variable, die definiert, ob das ausgegebene Datum einen border: right erhält
						if($date == $last_day_of_current_month) {
							$dateclass = "last";
						} else {
							$dateclass = "";
						}
						
						// Ausgabe Termindatum
						echo "<div class='col-md-1'>
							<div class='day'>
							<div class='date ".$dateclass."'><b>".$date."</b></div>";
						
						// Suche nach einem Termin
						$sql = "SELECT * FROM appointments WHERE userid = ".$userid." AND date = '".$date."'";
										
						foreach ($connection->query($sql) as $row) {						   
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
								echo "</div>"; // Ende <div class='appointmentinformation'>
							}
							
							echo "</div>"; // Ende <div class='appointment'>
						}
												
						if (empty($row['appointmentid'])) {
							// Ausgabe, wenn kein Termin an diesem Datum besteht
							echo "<div class='noappointment'>Keine Termine</div>";
						} else {
							echo '';
						}
						
						// AppointmentID wieder leeren
						$row['appointmentid'] = '';
									
						echo "</div></div>"; // Ende von .col-md-1 und von .day
						
						$date++;
					} // Ende von while ($date <= $last_day_of_current_month)
				?>
			</div> <?php // Ende von .row.seven-cols ?>
			<script>
				// Zeigt "Nach oben"-Button an, wenn ein Benutzer 100 oder mehr Pixel runterscrollt
				window.onscroll = function() {scrollFunction()};

				function scrollFunction() {
					if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
						document.getElementById("myBtn").style.display = "block";
					} else {
					 	document.getElementById("myBtn").style.display = "none";
					}
				}

				// Wenn ein Benutzer auf den Button klickt, landet er zuoberst der Seite
				function topFunction() {
					document.body.scrollTop = 0; // Für Chrome, Safari und Opera 
					document.documentElement.scrollTop = 0; // Für Internet Explorer und Firefox
				} 
			</script>
			<button onclick="topFunction()" id="myBtn"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Nach oben</button> 
		</div> <?php // Ende von .calendar-container ?>
	</body>
</html>