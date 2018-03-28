<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	$title = $t_title_result[$language];
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
						if(isset($_GET['search'])) {
							$searchvalue = $_GET['search'];
							
							// Prüfung, ob ein Suchbegriff angegeben wurde
							if(empty($searchvalue)) {
								echo "<h2 class='no_box'>".$t_no_search_results[$language]."</h2>
								<div class='alert alert-danger'>".$t_please_enter_a_search_term[$language]."</div>";
								$_SESSION['searchvalue'] = '';
							} else {								
								$_SESSION['searchvalue'] = $searchvalue;	
								
								// Ausgabe Titel mit Suchbegriff
								echo "<h2 class='margin-bottom-4px'>".$t_search_results_for[$language]." '".htmlspecialchars($searchvalue)."'</h2>";
								
								// Suche nach einem Termin, der im Terminnamen den Suchbegriff enthält und der heute oder in Zukunft stattfindet
								$sql_select = "SELECT * FROM `appointments` WHERE userid = '$userid' AND appointmentname LIKE '%$searchvalue%' AND timestamp >= '".strtotime(date("Y-m-d 00:00:00", time()))."' ";
								foreach ($connection->query($sql_select) as $row) {
																		
									if (empty($row['appointmenttoken'])) {
										// Ausgabe, wenn kein Termin an diesem Datum besteht
										echo "<div class='noappointment'>Keine Termine</div>";
									} else {
										echo '';
									}
									
									// Variable, die definiert, welche Farbe der Terminname hat
									$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", $row['timestamp']));
						
									if ($first_timestamp_of_day == strtotime(date("Y-m-d 00:00:00", time()))) {
											$appointment_color = "style='color: #d9534f;'";
									} else {
											$appointment_color = "";
									}
									
									echo "<div class='day'>";
									
									$t_day = 't_day_'.date("N", $row['timestamp']);
									$t_month = 't_month_'.date("n", $row['timestamp']);
									
									$t_date_format = array(
										${$t_day}[$language].", ".date("d. ", $row['timestamp']).${$t_month}[$language], 
										${$t_day}[$language].", ".${$t_month}[$language].date(" d", $row['timestamp'])
									);
						
									if(strtotime(date("Y-m-d 00:00:00", $row['timestamp'])) == strtotime(date("Y-m-d 00:00:00", time()))) {
										$date_output = $t_today[$language].", ".$t_date_format[$language];
									} elseif(strtotime(date("Y-m-d 00:00:00", $row['timestamp'])) == strtotime('+1 day', time())) {
										$date_output = $t_tomorrow[$language].", ".$t_date_format[$language];
									} else {
										$date_output = $t_date_format[$language];
									}
									
									// Ausgabe Terminname und Termindatum
									echo "<div class='appointment'>
									<a href='".$path."appointment?a=".$row['appointmenttoken']."'".$appointment_color."><div class='title'><b>".htmlspecialchars($row['appointmentname'])."</b></a>
												<span class='date_output'> <span class='glyphicon glyphicon-time'></span> ".$date_output."</span>
												<div class='float_right'>
													<a href='".$path."remove?a=".$row['appointmenttoken']."'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></a>
													<a href='".$path."edit_appointment?a=".$row['appointmenttoken']."'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></button></a>
													<a href='".$path."share_appointment?a=".$row['appointmenttoken']."'><button type='button' class='btn btn-default btn-xs'><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span></button></a>
												</div>
											</div>";
									
									// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist
									if(date("h:i:s", $row['timestamp']) == "12:00:01" and empty($row['location']) and empty($row['comment'])) {
										echo "";
									} else {
										echo "<div class='appointmentinformation'>";
									}
									
									// Wenn vorhanden: Ausgabe Terminzeit
									if(date("h:i:s", $row['timestamp']) == "12:00:01") {
										echo "";
									} else {
										echo "<div class='time'><span class='glyphicon glyphicon-time' style='color:#777'; aria-hidden='true'></span> ".htmlspecialchars(date($t_time_format[$language], $row['timestamp']))."</div>";
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
									if(date("h:i:s", $row['timestamp']) == "12:00:01" and empty($row['location']) and empty($row['comment'])) {
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
						<a class="btn btn-primary grey-button" href="<?php echo $path; ?>calendar"><?php echo $t_view_calendar[$language] ?></a>
					</div>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>