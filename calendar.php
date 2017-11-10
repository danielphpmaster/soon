<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';
	
	$timestamp = time();				
				
						
				if(empty($_GET['m'])) {
					$nm = '0';
				} else {
					if(empty($nm)) {
						$nm = $_GET['m'];
					} else {
						$nm = $nm+$_GET['m'];
					}
				}
				
				$_SESSION['nm'] = $nm;
					
				$month = date("F", strtotime("+ ".$nm." month"));
				$previous_month_nm = $nm-'1';
				$previous_month = date("F", strtotime("+ ".$previous_month_nm." month"));
				$next_month_nm = $nm+'1';
				$next_month = date("F", strtotime("+ ".$next_month_nm." month"));
				
				$year = date("Y", strtotime("+ ".$nm." month"));
				
				if($month == 'January') {
					$previous_year_nm = $nm-'1';
					$previous_year = date("Y", strtotime("+ ".$previous_year_nm." month"));
				} else {
					$previous_year = $year;
				}
				
				if($month == 'December') {
					$next_year_nm = $nm+'1';
					$next_year = date("Y", strtotime("+ ".$next_month_nm." month"));
				} else {
					$next_year = $year;
				}
				
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
				
				if($timestamp >= (date(strtotime("+ ".$nm." month")))) {
					$month = date("F", $timestamp);
					$year = date("Y", $timestamp);
					echo "<div class='col-xs-6 col-sm-4'></div>";
				} else {
					echo"<div class='col-xs-6 col-sm-4'>
							<a type='button' href='?m=-1' class='btn btn-default'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span> ".$previous_month." ".$previous_year."</a>
						</div>";
				}
				
				echo "<div class='hidden-xs col-sm-4 calendar_current_month' style='text-align: center;'><b>".$month." ".$year."</b></div>";
				
				if($year == '2019' and $month =='December') {
					echo "<div class='col-xs-6 col-sm-4'></div>";
				} else {
				echo"<div class='col-xs-6 col-sm-4'>
						<a type='button' href='?m=1' class='btn btn-default'>".$next_month." ".$next_year." <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></a>
					</div>";					
				}
				
				echo "<div class='col-xs-12 hidden-sm hidden-md hidden-lg hidden-xl calendar_current_month' style='text-align: center;'><b>".$month." ".$year."</b></div>";
				?>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
		<div class="calendar-container">
			<div class="row seven-cols">
				<?php
					if($month == date("F", $timestamp) and $year == date("Y", $timestamp)) {
					$date = date("Y-m-d", strtotime("+ ".$nm." month")); } else {
					$date = date("Y-m-01", strtotime("+ ".$nm." month"));
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
							$date_output = "heute, ".date("d. M Y", strtotime($date))."";
						} elseif($date == date("Y-m-d", strtotime("+1 day"))) {
							$date_output = "morgen, ".date("d. M Y", strtotime($date))."";
						} else {
							$date_output = date("d. M Y", strtotime($date));
						}						
						
						echo "<div class='col-md-1'>
							<div class='day'>
							<div class='date ".$dateclass."'><b><span class='date_output_calendar'>".$date_output."</span></b><a href='add.php?date=".$date."' style='float: right;'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button></a></div>";
						
						// Suche nach einem Termin
						$sql_select = "SELECT * FROM appointments WHERE userid = '$userid' AND date = '$date'";
										
						foreach ($connection->query($sql_select) as $row) {
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