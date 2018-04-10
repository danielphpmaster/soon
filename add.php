<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	$title = $t_title_add[$language];
	
	if(isset($_GET['date'])) {
		$date = $_GET['date'];
	}
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
					<h2><?php echo $t_add_appointment[$language]; ?></h2>
					<?php
						if(isset($_GET['add'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
							
							// Werte aus dem Formular als Variablen speichern
							if(empty($_POST['appointmentname'])) {
								$appointmentname = "";
							} else {
								$appointmentname = $_POST['appointmentname'];								
							}
							
							if(empty($_POST['date'])) {
								$date = "";
							} else {
								$date = $_POST['date'];								
							}
							
							if(empty($_POST['time'])) {
								$time = "00:00:01";
							} else {
								$time = $_POST['time'];								
							}
							if(empty($_POST['location'])) {
								$location = "";
							} else {
								$location = $_POST['location'];								
							}
							
							if(empty($_POST['comment'])) {
								$comment = "";
							} else {
								$comment = $_POST['comment'];								
							}
							
							// Überprüfung, ob ein Terminname angegeben wurde
							if(empty($appointmentname)) {
								echo '<div class="alert alert-danger">'.$t_insert_an_appointment_name[$language].'</div>';
								$error = true;
							}
											
							// Überprüfung, ob ein gültiges Datum angegeben wurde							
							$formats = array("d.m.Y", "Ymd", "Y-m-d");
							$dates = array($date);
							
							foreach ($dates as $input) {
								foreach ($formats as $format) {
									// echo "Applying format $format on date $input...<br>";
									$date2 = DateTime::createFromFormat($format, $input);
									
									if ($date2 == false) {
										// echo "Failed<br>";
									} else {
										// echo "Success<br>";
										$date = date("Y-m-d", strtotime($date));
									}
								}
							}
							 
							function validateDate($date) {
								$d = DateTime::createFromFormat('Y-m-d', $date);
								return $d && $d->format('Y-m-d') === $date;
							}
								
							if(validateDate($date) == '0') {
								echo '<div class="alert alert-danger">'.$t_insert_a_valid_date[$language].'</div>';
								$error = true;									
							}
							
							$timestamp = strtotime("$date $time");
							
							// Prüfung, ob ein zukünftiges Datum angegeben wurde
							if($timestamp < strtotime(date("Y-m-n 00:00:00", time()))) {
									echo '<div class="alert alert-danger">'.$t_insert_a_future_date[$language].'</div>';
									$error = true;												
							}
							
							// Wenn kein Fehler besteht, dann wird der Termin gespeichert
							if(!$error) {
								// Erstellung Termin-Token
								$create_token = '0';
								while ($create_token < '1') {
									$alphabet = "abcdefghijlkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
									$pass = array(); //remember to declare $pass as an array
									$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
									for ($i = 0; $i < 12; $i++) {
										$n = rand(0, $alphaLength);
										$pass[] = $alphabet[$n];
									}
									$appointmenttoken = implode($pass); //turn the array into a string
									
									$sql_select = "SELECT * FROM appointments WHERE appointmenttoken = '$appointmenttoken'";

									$count_result = $connection->prepare($sql_select);
									$count_result->execute();

									$total = $count_result->fetchColumn();
									
									if($total < '1') {
										$create_token = '1';
									}
								}
								
								// Verschlüsselung der Nutzeneingaben
								$appointmentname = openssl_encrypt($appointmentname,"AES-128-ECB",$key);
								$location = openssl_encrypt($location,"AES-128-ECB",$key);
								$comment = openssl_encrypt($comment,"AES-128-ECB",$key);
						
								$sql_insert = "INSERT INTO appointments (appointmenttoken, usertoken, appointmentname, timestamp, location, comment) VALUES ('$appointmenttoken', '$usertoken', '$appointmentname', '$timestamp', '$location', '$comment')";
								$sql_insert = $connection->query($sql_insert);
								
								header('Location: '.$path.'calendar');
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['add']))
					?>
					<form action="?add=1" method="post">
						<div class="day">
							<div class='date outside_calendar'><b><input name="date" class="form-control" id="date" min="<?php echo date("Y-m-d"); ?>" placeholder="<?php echo $t_date[$language] ?>" value="<?php if(isset($date)){echo htmlspecialchars($date);}?>"></b></div>
							<div class='appointment'>
								<div class='title'><b><input name="appointmentname" type="text" class="form-control" id="appointmentname" placeholder="<?php echo $t_appointment_name[$language] ?>" value="<?php if(isset($appointmentname)){echo htmlspecialchars($appointmentname);}?>"></b></div>
								<div class='appointmentinformation'>
									<div class='time'><span class='glyphicon glyphicon-time form' style='color:#777'; aria-hidden='true'></span><input name="time" class="form-control with_glyphicon" id="time" placeholder="<?php echo $t_time[$language] ?>" value="<?php if(isset($time)){echo htmlspecialchars($time);}?>"></div>
									<div class='location'><span class='glyphicon glyphicon-map-marker form' style='color:#777'; aria-hidden='true'></span><input name="location" type="text" class="form-control with_glyphicon" id="location" placeholder="<?php echo $t_location[$language] ?>" value="<?php if(isset($location)){echo htmlspecialchars($location);}?>"></div>
									<div class='comment'><span class='glyphicon glyphicon-info-sign form' style='color:#777'; aria-hidden='true'></span><input name="comment" type="text" class="form-control with_glyphicon" id="comment" placeholder="<?php echo $t_comment[$language] ?>" value="<?php if(isset($comment)){echo htmlspecialchars($comment);}?>"></div>
								</div>
							</div>
						</div>
						<div class="last_element">
							<button type="submit" class="btn btn-primary"><?php echo $t_add_appointment[$language] ?></button>
							<a class="btn btn-primary grey-button" href="<?php echo $path; ?>calendar"><?php echo $t_cancel[$language] ?></a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>