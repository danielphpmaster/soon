<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(empty($_GET['y'])) {
		$year = date('Y');
	} else {
		$year = $_GET['y'];
	}
	
	if(empty($_GET['mm'])) {
		$month = date('F');
	} else {
		$month = $_GET['mm'];
	}
			
	$timestamp = strtotime("$year $month");
	
	if($timestamp < strtotime(date('Y-m-01'))) {
		$year = date('Y');
		$month = date('F');
		header('Location: '.$path.'calendar/'.$year.'/'.$month.'');
	}
	
	if($timestamp > strtotime(date('2019-12-01'))) {
		$year = date('Y');
		$month = date('F');
		header('Location: '.$path.'calendar/'.$year.'/'.$month.'');
	}
	
	$previous_month_timestamp = strtotime('-1 month', $timestamp);
	$previous_month = date("F", $previous_month_timestamp);
	$previous_month_year = date("Y", $previous_month_timestamp);
	
	$next_month_timestamp = strtotime('+1 month', $timestamp);
	$next_month = date("F", $next_month_timestamp);
	$next_month_year = date("Y", $next_month_timestamp);
	
	$title = "".$month." ".$year."  - soon";
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
				<?php
				
				if($timestamp < time()) {
					echo "<div class='col-xs-6 col-sm-4'></div>";
				} else {
					echo"<div class='col-xs-6 col-sm-4'>
							<a type='button' href='".$path."calendar/".$previous_month_year."/".$previous_month."' class='btn btn-default'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span> ".$previous_month." ".$previous_month_year."</a>
						</div>";
				}
				
				echo "<div class='hidden-xs col-sm-4 calendar_current_month' style='text-align: center;'><b>".$month." ".$year."</b></div>";
				
				if($year == '2019' and $month =='December') {
					echo "<div class='col-xs-6 col-sm-4'></div>";
				} else {
				echo"<div class='col-xs-6 col-sm-4'>
						<a type='button' href='".$path."calendar/".$next_month_year."/".$next_month."' class='btn btn-default'>".$next_month." ".$next_month_year." <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></a>
					</div>";					
				}
				
				echo "<div class='col-xs-12 hidden-sm hidden-md hidden-lg hidden-xl calendar_current_month' style='text-align: center;'><b>".$month." ".$year."</b></div>";
				
				?>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
		<div class="calendar-container">
			<div class="row seven-cols">
				<?php									
					$date = date("Y-m-d", $timestamp);
					
					if($timestamp == strtotime(date('Y-m-01'))) {
						$date = date('Y-m-d');
					}
				
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
						if($date == date("Y-m-d")) {
							$date_output = "heute, ".date("D", strtotime($date)).", ".date("d. M y", strtotime($date))."";
						} elseif($date == date("Y-m-d", strtotime("+1 day"))) {
							$date_output = "morgen, ".date("D", strtotime($date)).", ".date("d. M y", strtotime($date))."";
						} else {
							$date_output = date("D", strtotime($date)).", ".date("d. M y", strtotime($date));
						}						
						
						echo "<div class='col-md-1'>
							<div class='day'>
							<div class='date ".$dateclass."'><b><span class='date_output_calendar'>".$date_output."</span></b><a href='".$path."add?date=".$date."' style='float: right;'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button></a></div>";
						
						// Suche nach einem Termin
						$sql_select = "SELECT * FROM appointments WHERE userid = '$userid' AND date = '$date'";
										
						foreach ($connection->query($sql_select) as $row) {
							// Ausgabe Terminname
							echo "<div class='appointment'>
							<a href='".$path."appointment/".$row['appointmenttoken']."'".$appointmentcolor."><div class='title'><b>".htmlspecialchars($row['appointmentname'])."</b></div></a>";
							
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
								echo "<div class='time'><span class='glyphicon glyphicon-time' style='color:#777'; aria-hidden='true'></span> ".htmlspecialchars($row['time'])."</div>";
							}
							
							// Wenn vorhanden: Ausgabe Terminort
							if(empty($row['location'])) {
								echo "";
							} else {
								echo "<div class='location'><span class='glyphicon glyphicon-map-marker' style='color:#777'; aria-hidden='true'></span> ".htmlspecialchars($row['location'])."</div>";
							}
							
							// Wenn vorhanden: Ausgabe Terminkommentar
							if(empty($row['comment'])) {
								echo "";
							} else {
								echo "<div class='comment'><span class='glyphicon glyphicon-info-sign' style='color:#777'; aria-hidden='true'></span> ".htmlspecialchars($row['comment'])."</div>";
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
							// echo "<div class='noappointment'>Keine Termine</div>";
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