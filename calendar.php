<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(empty($_GET['year'])) {
		$year = date('Y');
	} else {
		$year = $_GET['year'];
	}
	
	if(empty($_GET['month'])) {
		$month = date('F');
	} else {
		$month = $_GET['month'];
	}
			
	$timestamp_of_month = strtotime("$year $month");
	
	if($timestamp_of_month < strtotime(date('Y-m-01'))) {
		$year = date('Y');
		$month = date('F');
		header('Location: '.$path.'calendar/'.$year.'/'.$month.'');
	}
	
	if($timestamp_of_month > strtotime(date('2019-12-01'))) {
		$year = date('Y');
		$month = date('F');
		header('Location: '.$path.'calendar/'.$year.'/'.$month.'');
	}
	
	$previous_month_timestamp = strtotime('-1 month', $timestamp_of_month);
	$previous_month = date("F", $previous_month_timestamp);
	$previous_month_year = date("Y", $previous_month_timestamp);
	
	$next_month_timestamp = strtotime('+1 month', $timestamp_of_month);
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
					echo "<div class='col-xs-12 hidden-sm hidden-md hidden-lg hidden-xl calendar_current_month_mobile' style='text-align: center;'><a type='button' href='".$path."export_pdf/".$year."/".$month."' target='_blank' class='btn btn-default'><b>".$month." ".$year." </b><span class='glyphicon glyphicon glyphicon-print'></span></a></div>";
					
					if($timestamp_of_month < time()) {
						echo "<div class='col-xs-6 col-sm-4'></div>";
					} else {
						echo"<div class='col-xs-6 col-sm-4'>
								<a type='button' href='".$path."calendar/".$previous_month_year."/".$previous_month."' class='btn btn-default'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span> ".$previous_month." ".$previous_month_year."</a>
							</div>";
					}
					
					echo "<div class='hidden-xs col-sm-4 calendar_current_month' style='text-align: center;'><a type='button' href='".$path."export_pdf/".$year."/".$month."' target='_blank' class='btn btn-default'><b>".$month." ".$year." </b><span class='glyphicon glyphicon glyphicon-print'></span></a></div>";
					
					if($year == '2019' and $month =='December') {
						echo "<div class='col-xs-6 col-sm-4'></div>";
					} else {
					echo"<div class='col-xs-6 col-sm-4'>
							<a type='button' href='".$path."calendar/".$next_month_year."/".$next_month."' class='btn btn-default'>".$next_month." ".$next_month_year." <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></a>
						</div>";					
					}
				?>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
		<div class="calendar-container">
			<div class="row seven-cols">
				<?php
					$date = $timestamp_of_month;
					
					// Einstellung, dass beim aktuellen Monat beim aktuellen Tag begonnen wird
					if($timestamp_of_month == strtotime(date('Y-m-01'))) {
						$date = time();
					}
					
					$last_day_of_month = strtotime(date("Y-m-t 24:00", $timestamp_of_month));
										
					while ($date < $last_day_of_month) {
						// Variable, die definiert, welche Farbe der Terminname hat
						if($date == time()) {
							$appointmentcolor = "style='color: #d9534f;'";
						} else {
							$appointmentcolor = "";
						}
						
						// Variable, die definiert, ob das ausgegebene Datum einen border: right erhält
						if($date == $last_day_of_month) {
							$dateclass = "last";
						} else {
							$dateclass = "";
						}
						
						// Definierung Datumformat
						$t_day = 't_day_'.date("N", $date);
						$t_month = 't_month_'.date("n", $date);
					
						$t_date_format = array(
							${$t_day}[$language].", ".date("d. ", $date).${$t_month}[$language], 
							${$t_day}[$language].", ".${$t_month}[$language].date(" d", $date)
						);
						
						// Ausgabe Datum
						if($date == time()) {
							$date_output = $t_today[$language].", ".$t_date_format[$language];
						} elseif($date == strtotime('+1 day', time())) {
							$date_output = $t_tomorrow[$language].", ".$t_date_format[$language];
						} else {
							$date_output = $t_date_format[$language];
						}
						
						echo "<div class='col-md-1'>
							<div class='day'>
							<div class='date ".$dateclass."'><b><span class='date_output_calendar'>".$date_output."</span></b><a href='".$path."add?date=".date("Y-m-d", $date)."' style='float: right;'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button></a></div>";
						
						// Suche nach einem Termin
						$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", $date));
						$last_timestamp_of_day = strtotime(date("Y-m-d 23:59:59", $date));
						
						$sql_select = "SELECT * FROM appointments WHERE usertoken = '$usertoken' AND timestamp >= '$first_timestamp_of_day' AND timestamp <= '$last_timestamp_of_day'";
										
						foreach ($connection->query($sql_select) as $row) {
							// Entschlüsselung der vom Nutzer angegebenen Informationen
							$appointmentname = openssl_decrypt($row['appointmentname'],"AES-128-ECB",$key);
							$location = openssl_decrypt($row['location'],"AES-128-ECB",$key);
							$comment = openssl_decrypt($row['comment'],"AES-128-ECB",$key);
							
							// Ausgabe Terminname
							echo "<div class='appointment'>
							<a href='".$path."appointment/".$row['appointmenttoken']."'".$appointmentcolor."><div class='title'><b>".htmlspecialchars($appointmentname)."</b></div></a>";
														
							// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist
							if(date("h:i:s", $row['timestamp']) == "12:00:01" and empty($location) and empty($comment)) {
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
							if(date("h:i:s", $row['timestamp']) == "12:00:01") {
								echo "";
							} else {
								echo "<div class='time'><span class='glyphicon glyphicon-time' style='color:#777'; aria-hidden='true'></span> ".$t_time[$language]."</div>";
							}
							
							// Wenn vorhanden: Ausgabe Terminort
							if(empty($location)) {
								echo "";
							} else {
								echo "<div class='location'><span class='glyphicon glyphicon-map-marker' style='color:#777'; aria-hidden='true'></span> ".htmlspecialchars($location)."</div>";
							}
							
							// Wenn vorhanden: Ausgabe Terminkommentar
							if(empty($comment)) {
								echo "";
							} else {
								echo "<div class='comment'><span class='glyphicon glyphicon-info-sign' style='color:#777'; aria-hidden='true'></span> ".htmlspecialchars($comment)."</div>";
							}
							
							// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist
							if(date("h:i:s", $row['timestamp']) == "12:00:01" and empty($location) and empty($comment)) {
								echo "";
							} else {
								echo "</div>"; // Ende <div class='appointmentinformation'>
							}
							
							echo "</div>"; // Ende <div class='appointment'>
						}
															
						echo "</div></div>"; // Ende von .col-md-1 und von .day
						
						$date = strtotime('+1 day', $date);
					} // Ende von while ($date <= $last_day_of_month)
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