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
		header('Location: '.$path.'projects/'.$year.'/'.$month.'');
	}
	
	if($timestamp_of_month > strtotime(date('2020-12-01'))) {
		$year = date('Y');
		$month = date('F');
		header('Location: '.$path.'projects/'.$year.'/'.$month.'');
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
						echo "<div class='col-6 col-md-4'></div>";
					} else {
						echo"<div class='col-12 col-md-4' style='margin-bottom: 10px;'>
								<a class='btn btn-light' href='".$path."projects/".$previous_month_year."/".$previous_month."'>
									<i class='fas fa-chevron-left'></i>
									".$previous_month." ".$previous_month_year."
								</a>
							</div>";
					}
					
					echo "<div class='col-md-4' style='text-align: center; margin-bottom: 10px;'>
						<a class='btn btn-light' href='".$path."export_pdf/".$year."/".$month."' target='_blank'>
							<b>
								<i class='fas fa-print'></i> ".$month." ".$year."
							</b>
						</a>
					</div>";
					
					if($year == '2020' and $month =='December') {
						echo "<div class='col-6 col-md-4'></div>";
					} else {
					echo"<div class='col-12 col-md-4'>
							<a class='btn btn-light' href='".$path."projects/".$next_month_year."/".$next_month."'>
								".$next_month." ".$next_month_year."
								<i class='fas fa-chevron-right'></i>
							</a>
						</div>";					
					}
				?>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
		<div class="projects-container">
			<div class="row projects-cols">
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
							date("j.", $date), 
							date("j", $date)
						);
						
						// Ausgabe Datum
						echo "<div class='col-md-1'>
							<div class='day'>
								<div class='date ".$dateclass."'>
									<b><span class='date_output_calendar'>".$t_date_format[$language]."</span></b>
								</div>";
						
						// Suche nach einem Termin
						$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", $date));
						$last_timestamp_of_day = strtotime(date("Y-m-d 23:59:59", $date));
						
						$sql_select = "SELECT * FROM appointments WHERE usertoken = '$usertoken' AND timestamp >= '$first_timestamp_of_day' AND timestamp <= '$last_timestamp_of_day'";
										
						foreach ($connection->query($sql_select) as $row) {
							// Entschlüsselung der vom Nutzer angegebenen Informationen
							$appointmentname = openssl_decrypt($row['appointmentname'],"AES-128-ECB",$key);
							$location = openssl_decrypt($row['location'],"AES-128-ECB",$key);
							$comment = openssl_decrypt($row['comment'],"AES-128-ECB",$key);
							
							
							echo "<span style='padding: 0 10px'>";
							// Ausgabe Termin Popover
							echo "<span style='font-size: 150%;'>
								<a data-toggle='popover' data-placement='top' data-html='true' title='".htmlspecialchars($appointmentname)."' data-content=";
							
							echo "SOS";
							
							echo ">";
							
							if($row['appointment'] == 'true') {									
								echo "<i class='far fa-calendar'></i>";
							} else {
								echo "<i class='far fa-clipboard'></i>";
							}
							echo "	
								</a>
							</span>";
							
							echo "</span>";
							/*
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
							*/
						}
															
						echo "</div></div>"; // Ende von .col-md-1 und von .day
						
						$date = strtotime('+1 day', $date);
					} // Ende von while ($date <= $last_day_of_month)
				?>
			</div> <?php // Ende von .row.projects-cols ?>
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
			<button onclick="topFunction()" id="myBtn"><i class='fas fa-chevron-up'></i> Nach oben</button> 
		</div> <?php // Ende von .projects-container ?>
	</body>
</html>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>