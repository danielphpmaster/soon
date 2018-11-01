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
	
	if(empty($_GET['view'])) {
		$view = 2;
	} else {
		$view = $_GET['view'];
	}
	
	if($view == 1) {
		$other_view = 2;
	} else {
		$other_view = 1;
	}
	
	$timestamp_of_month = strtotime("$year $month");
	
	if($timestamp_of_month < strtotime(date('Y-m-01'))) {
		$year = date('Y');
		$month = date('F');
		header('Location: '.$path.'calendar/'.$year.'/'.$month.'');
	}
	
	if($timestamp_of_month > strtotime(date('2020-12-01'))) {
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
					if($timestamp_of_month < time()) {
						echo "<div class='col-3 col-lg-4'></div>";
					} else {
						echo"<div class='col-3 col-lg-4'>
								<a class='btn btn-light' href='".$path."calendar/".$previous_month_year."/".$previous_month."/".$view."'>
									<i class='fas fa-chevron-left'></i>
								</a>
							</div>";
					}

					echo "<div class='col-6 col-lg-4' style='padding: 0;'>
						<a class='btn btn-light' href='".$path."export_pdf/".$year."/".$month."' target='_blank'>
							<b>
								<i class='fas fa-print'></i> ".$month." ".$year."
							</b>
						</a>
					</div>";

					if($year == '2020' and $month =='December') {
						echo "<div class='col-3 col-lg-4'></div>";
					} else {
					echo"<div class='col-3 col-lg-4'>
							<a class='btn btn-light' href='".$path."calendar/".$next_month_year."/".$next_month."/".$view."'>
								<i class='fas fa-chevron-right'></i>
							</a>
						</div>";
					}
				
					echo"<div class='col-12' style='margin-top: 10px;'>
						<a class='btn btn-light' href='".$path."calendar/".$year."/".$month."/".$other_view."'>";
							if($view == 1) {
								echo "<i class='fas fa-th-large'></i>";
							} else {
								echo "<i class='fas fa-th'></i>";
							}
						echo"</a>
					</div>";
				?>
				
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
		<?php
		if($view == 1) {
			echo "<div class='projects-container'>
			<div class='row projects-cols'>";
		} else {
		echo "<div class='calendar-container'>
			<div class='row calendar-cols'>";
		}
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
						
						// Definierung Datumformat
						$t_day = 't_day_'.date("N", $date);
						
						$t_date_format = array(
							${$t_day}[$language].", ".date("j.", $date), 
							${$t_day}[$language].", ".date(" j", $date)
						);
					
					if($view == 1) {
						// Definierung Datumformat
						$t_date_format = array(
							date("j.", $date),
							date("j", $date)
						);

						// Ausgabe Datum
						echo "<div class='col-md-1'>
							<div class='day'>
								<div class='date'>
									
									<a href='".$path."add.php?date=".date("Y-m-d", $date)."'>
										<button type='button' class='btn btn-light btn-sm'>
											<b><span class='date_output_calendar'>".$t_date_format[$language]."</span></b>
										</button>
									</a>
								</div>";
					} else {
						// Ausgabe Datum
						if($date == time()) {
							$date_output = $t_today[$language];
						} elseif($date == strtotime('+1 day', time())) {
							$date_output = $t_tomorrow[$language];
						} else {
							$date_output = $t_date_format[$language];
						}
						
						echo "<div class='col-md-1'>
							<div class='day'>
								<div class='date'>
									<a class='btn btn-light btn-sm xs-float-right' href='".$path."add.php?date=".date("Y-m-d", $date)."'>
										<b>
											<span class='date_output_calendar'>
												".$date_output."
											</span>
										</b>									
									</a>
								</div>";
					}
						
						// Suche nach einem Termin
						$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", $date));
						$last_timestamp_of_day = strtotime(date("Y-m-d 23:59:59", $date));
						
						$sql_select = "SELECT * FROM appointments WHERE usertoken = '$usertoken' AND timestamp >= '$first_timestamp_of_day' AND timestamp <= '$last_timestamp_of_day' ORDER BY timestamp";
										
						foreach ($connection->query($sql_select) as $row) {
							
							// Entschlüsselung der vom Nutzer angegebenen Informationen
							$appointmentname = openssl_decrypt($row['appointmentname'],"AES-128-ECB",$key);
							$location = openssl_decrypt($row['location'],"AES-128-ECB",$key);
							$comment = openssl_decrypt($row['comment'],"AES-128-ECB",$key);
							
						if($view == 1) {
								echo "<span style='padding: 0 10px'>";
							// Ausgabe Termin Popover
							echo "<span style='font-size: 150%;'>
								<a data-toggle='popover' data-placement='top' data-html='true' title='";
								
							echo "<a href=\"".$path."appointment/".$row['appointmenttoken']."\">".htmlspecialchars($appointmentname)."</a>";
							
							echo"' data-content='";

							echo "Inhalt";

							echo "'>";

							if($row['is_appointment'] == 'true') {
								echo "<i class='far fa-calendar'></i>";
							} else {
								echo "<i class='far fa-clipboard'></i>";
							}
							echo "
								</a>
							</span>";
							echo "</span>";	
						} else {
							
							// Ausgabe Terminname
							echo "<div class='appointment'>
							<a href='".$path."appointment/".$row['appointmenttoken']."'".$appointmentcolor."><div class='title'><b>".htmlspecialchars($appointmentname)."</b></div></a>";
														
							// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist
							if($row['time_set'] == "false" and empty($location) and empty($comment)) {
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
							if(!empty($location)) {
								echo "<div class='location'><i class='fas fa-map-marker-alt'></i> ".htmlspecialchars($location)."</div>";
							}
							
							// Wenn vorhanden: Ausgabe Terminkommentar
							if(!empty($comment)) {
								echo "<div class='comment'><i class='fas fa-comment'></i> ".htmlspecialchars($comment)."</div>";
							}
							
							// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist
							if($row['time_set'] == "false" and empty($location) and empty($comment)) {
								echo "";
							} else {
								echo "</div>"; // Ende <div class='appointmentinformation'>
							}
							
							echo "</div>"; // Ende <div class='appointment'>
						}
						}
															
						echo "</div></div>"; // Ende von .col-md-1 und von .day
						
						$date = strtotime('+1 day', $date);
					} // Ende von while ($date <= $last_day_of_month)
				?>
			</div> <?php // Ende von .row.calendar-cols ?>
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
			<button onclick="topFunction()" id="myBtn">
				<i class='fas fa-chevron-up'></i> 
				<?php echo $t_back_to_top[$language] ?>
			</button> 
		</div> <?php // Ende von .calendar-container ?>
	</body>
</html>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>