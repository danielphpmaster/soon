<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['a'])) {
		$appointmenttoken = $_GET['a'];
		$_SESSION['appointmenttoken'] = $appointmenttoken;
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM appointments WHERE usertoken = '$usertoken' AND appointmenttoken = '$appointmenttoken'";
		
		// Termininformationen als Variablen speichern
		foreach ($connection->query($sql_select) as $row) {
		}
		
		$appointmentname = $string = openssl_decrypt($row['appointmentname'],"AES-128-ECB",$key);
		$location = $string = openssl_decrypt($row['location'],"AES-128-ECB",$key);
		$comment = $string = openssl_decrypt($row['comment'],"AES-128-ECB",$key);
		
		// Umleitung, wenn kein Termin gefunden
		if(empty($appointmentname)) {
			header('Location: '.$path.'calendar');
		}
	} elseif (empty($_GET['editappointment'])) {
		header('Location: '.$path.'calendar');
	}
	
	$title = $t_title_edit_appointment[$language];
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
					<h2><?php echo $t_edit_appointment[$language] ?></h2>
					<?php
						if(isset($_GET['editappointment'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
							
							// Werte aus dem Formular als Variablen speichern
							if(empty($_POST['appointmentname'])) {
								$newappointmentname = "";
							} else {
								$newappointmentname = $_POST['appointmentname'];								
							}
							
							if(empty($_POST['date'])) {
								$newdate = "";
							} else {
								$newdate = $_POST['date'];								
							}
							
							if(empty($_POST['time'])) {
								$newtime = "12:00:01";
							} else {
								$newtime = $_POST['time'];								
							}
							
							if(empty($_POST['location'])) {
								$newlocation = "";
							} else {
								$newlocation = $_POST['location'];								
							}
							
							if(empty($_POST['comment'])) {
								$newcomment = "";
							} else {
								$newcomment = $_POST['comment'];								
							}
														
							// Überprüfung, ob ein Terminname angegeben wurde
							if(empty($newappointmentname)) {
								echo '<div class="alert alert-danger">'.$t_insert_an_appointment_name[$language].'</div>';
								$error = true;
							}
																
							// Überprüfung, ob ein gültiges Datum angegeben wurde							
							$formats = array("d.m.Y", "Ymd", "Y-m-d");
							$dates = array($newdate);

							foreach ($dates as $input) {
								foreach ($formats as $format) {
									// echo "Applying format $format on date $input...<br>";
									$date2 = DateTime::createFromFormat($format, $input);
									
									if ($date2 == false) {
										// echo "Failed<br>";
									} else {
										// echo "Success<br>";
										$newdate = date("Y-m-d", strtotime($newdate));
									}
								}
							}
							 
							function validateDate($newdate) {
									$d = DateTime::createFromFormat('Y-m-d', $newdate);
									return $d && $d->format('Y-m-d') === $newdate;
								}
								
							if(validateDate($newdate) == '0') {
								echo '<div class="alert alert-danger">'.$t_insert_a_valid_date[$language].'</div>';
								$error = true;
							}
							
							$timestamp = strtotime("$newdate $newtime");
							
							// Prüfung, ob ein zukünftiges Datum angegeben wurde
							if($timestamp < strtotime(date("Y-m-n 00:00:00", time()))) {
									echo '<div class="alert alert-danger">'.$t_insert_a_future_date[$language].'</div>';
									$error = true;												
							}
							
							// Wenn kein Fehler besteht, dann wird der Termin gespeichert
							if(!$error) {
								// Verschlüsselung der Nutzereingaben
								$newappointmentname = openssl_encrypt($newappointmentname,"AES-128-ECB",$key);
								$newlocation = openssl_encrypt($newlocation,"AES-128-ECB",$key);
								$newcomment = openssl_encrypt($newcomment,"AES-128-ECB",$key);
								
								$sql_update = "UPDATE appointments SET appointmentname = '$newappointmentname', timestamp = '$timestamp', location = '$newlocation', comment = '$newcomment' WHERE usertoken = '$usertoken' AND appointmenttoken = '$appointmenttoken'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: '.$path.'calendar');						
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['add']))
					?>
					<form action="?editappointment=1" method="post">
						<div class="day">
							<div class='date outside_calendar'><b><input name="date" class="form-control" id="date" min="<?php echo date("Y-m-d"); ?>" placeholder="<?php echo $t_date[$language] ?>" value="<?php if(isset($row['timestamp'])){echo date("Y-m-d", $row['timestamp']);} else {echo htmlspecialchars($newdate);}?>"></b></div>
							<div class='appointment'>
								<div class='title'><b><input name="appointmentname" type="text" class="form-control" id="appointmentname" placeholder="<?php echo $t_appointment_name[$language] ?>" value="<?php if(isset($appointmentname)){echo htmlspecialchars($appointmentname);} else {echo htmlspecialchars($newappointmentname);}?>"></b></div>
								<div class='appointmentinformation'>
									<div class='time'><span class='glyphicon glyphicon-time form' style='color:#777'; aria-hidden='true'></span><input name="time" class="form-control with_glyphicon" id="time" placeholder="<?php echo $t_time[$language] ?>" value="<?php if(isset($row['timestamp'])){echo date('h:i', $row['timestamp']);} else {echo htmlspecialchars($newtime);}?>"></div>
									<div class='location'><span class='glyphicon glyphicon-map-marker form' style='color:#777'; aria-hidden='true'></span><input name="location" type="text" class="form-control with_glyphicon" id="location" placeholder="<?php echo $t_location[$language] ?>" value="<?php if(isset($location)){echo htmlspecialchars($location);} else{echo htmlspecialchars($newlocation);}?>"></div>
									<div class='comment'><span class='glyphicon glyphicon-info-sign form' style='color:#777'; aria-hidden='true'></span><input name="comment" type="text" class="form-control with_glyphicon" id="comment" placeholder="<?php echo $t_comment[$language] ?>" value="<?php if(isset($comment)){echo htmlspecialchars($comment);} else{echo htmlspecialchars($newcomment);}?>"></div>
								</div>
							</div>
						</div>
						<div class="last_element">
							<button type="submit" class="btn btn-primary"><?php echo $t_save[$language] ?></button>
							<a class="btn btn-primary grey-button" href="<?php echo $path; ?>calendar"><?php echo $t_cancel[$language] ?></a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>