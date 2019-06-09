<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	$title = $t_title_add[$language];

	if(isset($_GET['date'])) {
		$date = strtotime($_GET['date']);
	}
		
	if(empty($date)) {
		$date = date("Y-m-d");
	} else {
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
					<h2><?php echo $t_add[$language]; ?></h2>
					<?php
						if(isset($_GET['add'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll

							// Werte aus dem Formular als Variablen speichern
							if(empty($_POST['entryname'])) {
								$entryname = "Neuer Termin";
							} else {
								$entryname = $_POST['entryname'];
							}

							if(empty($_POST['date'])) {
								$date = date("Y-m-d");
							} else {
								$date = $_POST['date'];
							}
							
							if(empty($_POST['time'])) {
								$time = "00:00:00";
								$time_set = 'false';
							} else {
								$time = $_POST['time'];
								$time_set = 'true';
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
							if(empty($entryname)) {
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
							if($timestamp < strtotime(date("Y-m-d 00:00:00", time()))) {
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
									$entryid = implode($pass); //turn the array into a string

									// Prüfung, ob die ID bereits besteht
									$sql_select = "SELECT * FROM entries WHERE entryid = '$entryid'";

									$count_result = $connection->prepare($sql_select);
									$count_result->execute();

									$total = $count_result->fetchColumn();

									if($total < '1') {
										$create_token = '1';
									}
								}

								// Verschlüsselung der Nutzeneingaben
								$entryname = openssl_encrypt($entryname,"AES-128-ECB",$key);
								$location = openssl_encrypt($location,"AES-128-ECB",$key);
								$comment = openssl_encrypt($comment,"AES-128-ECB",$key);

								$sql_insert = "INSERT INTO entries (entryid, userid, entryname, timestamp, time_set, location, comment) VALUES ('$entryid', '$userid', '$entryname', '$timestamp', '$time_set', '$location', '$comment')";
								$sql_insert = $connection->query($sql_insert);

								$year = date('Y', strtotime($date));
								$month = date('F', strtotime($date));

								header('Location: '.$path.'entry?entryid='.$entryid.'');
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['add']))
					?>
					<form action="?add=1" method="post">
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
								<div class='title'>
									<input name="entryname" type="text" class="form-control" id="entryname" placeholder="<?php echo $t_name[$language] ?>" value="<?php if(isset($entryname)){echo htmlspecialchars($entryname);}?>" autofocus>
								</div>
								<div class='appointmentinformation'>
																	
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class="fas fa-clock"></i>
											</span>
										</div>										
										<input name="time" type="text" class="form-control datetimepicker-input" id="datetimepicker5" data-toggle="datetimepicker" data-target="#datetimepicker5" placeholder="<?php echo $t_time[$language] ?>">
									</div>
									<script type="text/javascript">
										$(function () {
											$('#datetimepicker5').datetimepicker({
											format: 'LT'
											});
										});
									</script>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class="fas fa-map-marker-alt"></i>
											</span>
										</div>
										<input name="location" type="text" class="form-control" id="location" placeholder="<?php echo $t_location[$language] ?>" value="<?php if(isset($location)){echo htmlspecialchars($location);}?>">
									</div>
									<div class="margin-bottom-0 input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class="fas fa-comment"></i>
											</span>
										</div>
										<input name="comment" type="text" class="form-control" id="comment" placeholder="<?php echo $t_comment[$language] ?>" value="<?php if(isset($comment)){echo htmlspecialchars($comment);}?>">
									</div>
								</div>
							</div>
						</div>
						<div class="margin-bottom-90">
							<button type="submit" class="btn btn-red"><?php echo $t_add[$language] ?></button>
							<a class="btn btn-light" href="<?php echo $path; ?>calendar"><?php echo $t_cancel[$language] ?></a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>

				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>
