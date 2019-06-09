<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['a'])) {
		$entryid = $_GET['a'];
		$_SESSION['entryid'] = $entryid;
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM entries WHERE userid = '$userid' AND entryid = '$entryid'";
		
		// Termininformationen als Variablen speichern
		foreach ($connection->query($sql_select) as $row) {
		}
		
		$entryname = $string = openssl_decrypt($row['entryname'],"AES-128-ECB",$key);
		$location = $string = openssl_decrypt($row['location'],"AES-128-ECB",$key);
		$comment = $string = openssl_decrypt($row['comment'],"AES-128-ECB",$key);
		$date = date("Y-m-d", $row['timestamp']);
		if($row ['time_set'] == 'true') {
			$time_set = 'true';
			$time_hour = date("H", $row['timestamp']);
			$time_minute = date("i", $row['timestamp']);
		} else {
			$time_set = 'false';
		}
				
		// Umleitung, wenn kein Termin gefunden
		if(empty($entryname)) {
			header('Location: '.$path.'calendar');
		}
	} elseif (empty($_GET['editappointment'])) {
		header('Location: '.$path.'calendar');
	}
		
	$title = $t_title_edit[$language];
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
					<h2><?php echo $t_edit[$language] ?></h2>
					<?php
						if(isset($_GET['editappointment'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
							
							// Werte aus dem Formular als Variablen speichern
							if(empty($_POST['entryname'])) {
								$newentryname = "";
							} else {
								$newentryname = $_POST['entryname'];								
							}
							
							if(empty($_POST['date'])) {
								$newdate = "";
							} else {
								$newdate = $_POST['date'];								
							}
														
							if(empty($_POST['time'])) {
								$newtime = "00:00:00";
								$time_set = 'false';
							} else {
								$newtime = $_POST['time'];
								$time_set = 'true';
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
							if(empty($newentryname)) {
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
							if($timestamp < strtotime(date("Y-m-d 00:00:00", time()))) {
									echo '<div class="alert alert-danger">'.$t_insert_a_future_date[$language].'</div>';
									$error = true;												
							}
							
							// Wenn kein Fehler besteht, dann wird der Termin gespeichert
							if(!$error) {
								// Verschlüsselung der Nutzereingaben
								$newentryname = openssl_encrypt($newentryname,"AES-128-ECB",$key);
								$newlocation = openssl_encrypt($newlocation,"AES-128-ECB",$key);
								$newcomment = openssl_encrypt($newcomment,"AES-128-ECB",$key);
								
								$sql_update = "UPDATE entries SET entryname = '$newentryname', timestamp = '$timestamp', time_set = '$time_set', location = '$newlocation', comment = '$newcomment' WHERE userid = '$userid' AND entryid = '$entryid'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: '.$path.'entry?entryid='.$entryid.'');						
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['add']))
					?>
					<form action="?editappointment=1" method="post">
						<div class="day">
							<input name="date" type="text" class="form-control datetimepicker-input margin-bottom-10" id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker" placeholder="<?php echo $t_date[$language] ?>">
							<script type="text/javascript">
								$(function () {
									$('#datetimepicker').datetimepicker({
											format: 'L',
											locale: '<?php echo "de"; ?>',
											minDate: '<?php echo date('m/d/Y');?>',
											defaultDate: '<?php echo $date;?>'
									});
								});
							</script>
							<div class='appointment'>
								<div class='title'><input name="entryname" type="text" class="form-control" id="entryname" placeholder="<?php echo $t_name[$language] ?>" value="<?php if(isset($entryname)){echo htmlspecialchars($entryname);} else {echo htmlspecialchars($newentryname);}?>"></div>
								<div class='appointmentinformation'>
									
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class="fas fa-clock"></i>
											</span>
										</div>										
										<input name="time" type="text" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" placeholder="<?php echo $t_time[$language] ?>">
									</div>
									<?php if($time_set == 'true') { ?>
									<script type="text/javascript">
										$(function () {
											$('#datetimepicker5').datetimepicker({
												defaultDate: moment({
													hour: <?php echo $time_hour; ?>,
													minute: <?php echo $time_minute; ?>
												}),
												format: 'LT'
											});
										});
									</script>
									<?php } else { ?>
									<script type="text/javascript">
										$(function () {
											$('#datetimepicker5').datetimepicker({
												format: 'LT'
											});
										});
									</script>
									
									<?php } ?>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class="fas fa-map-marker-alt"></i>
											</span>
										</div>
										<input name="location" type="text" class="form-control" id="location" placeholder="<?php echo $t_location[$language] ?>" value="<?php if(isset($location)){echo htmlspecialchars($location);} else{echo htmlspecialchars($newlocation);}?>">
									</div>
									<div class="margin-bottom-0 input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class="fas fa-comment"></i>
											</span>
										</div>
										<input name="comment" type="text" class="form-control" id="comment" placeholder="<?php echo $t_comment[$language] ?>" value="<?php if(isset($comment)){echo htmlspecialchars($comment);} else{echo htmlspecialchars($newcomment);}?>">
									</div>									
								</div>
							</div>
						</div>
						<div class="margin-bottom-90">
							<button type="submit" class="btn btn-red"><?php echo $t_save[$language] ?></button>
							<a class="btn btn-light" href="<?php echo $path; ?>entry?entryid=<?php echo $entryid; ?>"><?php echo $t_cancel[$language] ?></a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>