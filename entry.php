<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['entryid'])) {
		$entryid = $_GET['entryid'];
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM entries WHERE userid = '$userid' AND entryid = '$entryid'";			
		
		foreach ($connection->query($sql_select) as $row) {
			// Termininformationen als Variablen speichern
			if ($row['goalid'] !== 'false') {
				$goalid = $row['goalid'];
			} else {
				$goalid = 'false';
			}
			
			if($row['is_appointment'] == 'true') {
				$is_appointment = 'true';
			} else {
				$is_appointment = 'false';
				
				if($row['is_task_done'] == 'true') {
					$is_task_done = 'true';
				} else {
					$is_task_done = 'false';
				}
			}
			
			$entryname = $string = openssl_decrypt($row['entryname'],"AES-128-ECB",$key);
			$date = $row['timestamp'];
			$time = $row['timestamp'];
			$location = openssl_decrypt($row['location'],"AES-128-ECB",$key);
			$comment = openssl_decrypt($row['comment'],"AES-128-ECB",$key);
			$entryid = $row['entryid'];
		}
		
		// Definierung Datumformat
		$t_day = 't_day_'.date("N", $date);
		$t_month = 't_month_'.date("n", $date);
		
		$t_date = array(
			${$t_day}[$language].", ".date("j. ", $date).${$t_month}[$language], 
			${$t_day}[$language].", ".${$t_month}[$language].date(" j", $date)
		);
				
		// Umleitung, wenn kein Termin gefunden
		if(empty($entryname)) {
			header('Location: '.$path.'calendar');
		}
	} else {
		// Umleitung, wenn kein "a"-Wert mitgeschickt wurde
		header('Location: '.$path.'calendar');
	}
			
	$title = "".$entryname." ".$t_title_entry[$language]."";
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
						if(isset($_GET['done'])) {
							if($_GET['done'] == 0) {
								$is_task_done = 'false';
							} else {
								$is_task_done = 'true';
							}
								$sql_update = "UPDATE entries SET is_task_done = '$is_task_done' WHERE userid = '$userid' AND entryid = '$entryid'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: '.$path.'entry.php?entryid='.$entryid.'');
						}
					
						echo "<h2>";
						
							if($is_appointment == 'true') {
								echo $t_appointment[$language];
							} else {
								echo $t_task[$language];								
							}
								
								echo"<a class='float-right btn btn-light width-42' href='".$path."edit?a=".$entryid."'><i class='fas fa-pencil-alt'></i></a>
								<a class='float-right btn btn-light width-42 margin-right-10' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-times'></i></a>
							</h2>";
					
						// Variable, die definiert, welche Farbe der Terminname hat 
						$first_timestamp_of_day = strtotime(date("Y-m-d 00:00:00", $date));
						
						if ($first_timestamp_of_day == strtotime(date("Y-m-d 00:00:00", time()))) {
							$appointment_color = "style='color: #d9534f;'";
						} else {
							$appointment_color = "";
						}
						
						// Ausgabe Termindatum
						if(strtotime(date("Y-m-d 00:00:00", $date)) == strtotime(date("Y-m-d 00:00:00", time()))) {
							$date_output = $t_today[$language].", ".$t_date[$language];
						} elseif(strtotime(date("Y-m-d 00:00:00", $date)) == strtotime('+1 day', strtotime(date("Y-m-d 00:00:00", time())))) {
							$date_output = $t_tomorrow[$language].", ".$t_date[$language];
						} else {
							$date_output = $t_date[$language];
						}
						
						// Ausgabe Terminname
						echo "<div class='appointment' style='margin-top: 0'>
								<div ".$appointment_color." class='title'>
									".htmlspecialchars($entryname)."
								</div>";		
						?>
						
						<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="deleteModalLabel">
											<?php echo $t_delete_appointment[$language]; ?>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												<i class='fas fa-times'></i>
											</span>
										</button>
									</div>
									<div class="modal-body">
										<?php echo $t_do_you_want_to_delete_this_appointment[$language]; ?>
									</div>
									<div class="modal-footer">
										<?php
											echo"<a class='btn btn-red' href='".$path."remove?a=".$entryid."'>".$t_confirm[$language]."</a>";
										?>
										<button type="button" class="btn btn-light" data-dismiss="modal">
											<?php echo $t_cancel[$language]; ?>
										</button>
									</div>
								</div>
							</div>
						</div>
						
						<?php
						
						// Ausgabe der Informationen
						echo "<div class='appointmentinformation'>";
						
						echo "<div class='time'>";
						
						if($row['is_appointment'] == 'true') {
							echo "<i class='far fa-calendar'></i>";
						} else {
							if($row['is_task_done'] == 'false') {
							echo "<i class='far fa-clipboard'></i>";
						} else {
							echo "<i class='fas fa-clipboard-check'></i>";
							}
						}
						
						echo " ".$date_output."</div>";
						
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
						if(empty($location)) {
							echo "";
						} else {
							echo "<div class='location'><i class='fas fa-map-marker-alt'></i> ".htmlspecialchars($location)."</div>";
							echo "<iframe
									width='100%'
									height='250'
									frameborder='0' style='border: 0'
									src='https://www.google.com/maps/embed/v1/place?key=AIzaSyDrsCwHGUhbw2CFT0Iw5JDjAOEDPvjDknw 
									&q=".htmlspecialchars($location)."' allowfullscreen>
								</iframe>";						
						}
						
						// Wenn vorhanden: Ausgabe Terminkommentar
						if(empty($comment)) {
							echo "";
						} else {
							echo "<div class='comment'><i class='fas fa-comment'></i> ".htmlspecialchars($comment)."</div>";
						}
						
						// Prüfung, ob zum Termin eine Uhrzeit, ein Ort oder ein Kommentar vorhanden ist						
						echo "</div>
						</div>"; // Ende .appointmentinformation und .appointment
						
						$month = date("F", $row['timestamp']);
						$year = date("Y", $row['timestamp']);
						
						echo "<div class='margin-bottom-90'>";
								if($is_appointment == 'false') {
									if($is_task_done == 'true') {
										echo "<a class='btn btn-light' href='".$path."entry.php?entryid=".$entryid."&done=0'><i class='fas fa-times'></i> ".$t_mark_as_undone[$language]."</a>";	
									} else {										
										echo "<a class='btn btn-red' href='".$path."entry.php?entryid=".$entryid."&done=1'><i class='fas fa-check'></i> ".$t_mark_as_done[$language]."</a>";	
									}
								}
								echo " <a class='btn btn-light' href='".$path."calendar/".$year."/".$month."'>".$t_view_calendar[$language]."</a>
							</div>";
					?>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>