<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	$show_formular = true;

	if(isset($_GET['a'])) {
		$appointmenttoken = $_GET['a'];
		
		// Suche nach dem Termin		
		$sql_select = "SELECT * FROM appointments WHERE userid = '$userid' AND appointmenttoken = '$appointmenttoken'";
		
		foreach ($connection->query($sql_select) as $row) {
			// Termininformationen als Variablen speichern
			$appointmentname = $row['appointmentname'];
			$appointmentid = $row['appointmentid'];
			$date = $row['date'];
			$time = $row['time'];
			$location = $row['location'];
			$comment = $row['comment'];
		}
				
		// Umleitung, wenn kein Termin gefunden
		if(empty($appointmentname)) {
			//header('Location: '.$path.'calendar');
		}
	} else {
		// Umleitung, wenn kein "a"-Wert mitgeschickt wurde
		//header('Location: '.$path.'calendar');
	}
	
	$title = "Termin teilen - soon";
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
					<h2>Termin teilen</h2>
					<?php
						if(isset($_GET['sharemail'])) {
												
							if(empty($_POST['mail_receiver'])) {
								$mail_receiver = "";
							} else {
								$mail_receiver = $_POST['mail_receiver'];								
							}
												
							if(empty($_POST['mail_message'])) {
								$mail_message_1 = "";
								$mail_message_2 = "";
								$mail_message_3 = "";
							} else {
								$mail_message_1 = "Nachricht von ".$username.": <b>";
								$mail_message_2 = $_POST['mail_message'];
								$mail_message_3 = "</b><br><br>";				
							}
							
							$link = "https://www.soon-calendar.ch/appointment?a=".$appointmenttoken."&ai=".$appointmentid;
							
							// Überprüfung, ob die angegebene E-Mail-Adresse gültig ist
							if(!filter_var($mail_receiver, FILTER_VALIDATE_EMAIL)) {
								echo '<div class="alert alert-danger">Geben Sie eine gültige E-Mail-Adresse ein</div>';
								$error = true;
							}
							
							// Prüfung, ob ein Nutzername angegeben wurde. Wenn ja, wird dieser gespeichert
							if(!$error) {								
								$headers = "From:soon-calendar.ch <termin@soon-calendar.ch>\n";
								$headers .= "MIME-Version: 1.0\n";
								$headers .= "Content-Type: text/html; charset=\"utf-8\"\n";
								
								$subject = $username." hat mit dir einen soon Termin geteilt";
								$text = "
									<html>
										<head>
											<title>soon Termin</title>
										</head>
										
										<body>
											Hallo!<br><br>
											<b>".$username."</b> hat  einen soon Termin mit dir geteilt.<br><br>
											".$mail_message_1."".$mail_message_2."".$mail_message_3."
											<div style='width: 250px; border: 1px solid #e7e7e7;'>
												<div style='background-color: #f8f8f8; border-bottom: 1px solid #e7e7e7; padding: 10px;'>
													".$appointmentname." (".$date.")
												</div>
												<div style='padding: 10px;'>
													🕓 ".$time."
												</div>
												<div style='padding: 0 10px;'>
													🗺 ".$location."
												</div>
												<div style='padding: 10px;'>
													🗨 ".$comment."
												</div>
											</div><br>
											Klicke <a href='".$link."'>hier</a> um den Termin in soon zu öffnen!<br>
										</body>
									</html>
									";

								mail($mail_receiver, $subject, $text, $headers);
							
								echo "<div class='alert alert-success'>Termin erfolgreich mit ".$mail_receiver." geteilt</div>
									<div>
										<a class='btn btn-primary' href='".$path."share_appointment?a=".$appointmenttoken."'>Nochmals teilen</a>
										<a class='btn btn-primary grey-button' href='".$path."calendar'>Zum Kalender</a>
									</div>
								";
								
								$show_formular = false;
							}
						}

					if($show_formular) {
						if(isset($mail_receiver)) {
							$mail_receiver_form = $mail_receiver; 
						} else {
							$mail_receiver_form = "";
						}
						
						if(empty($mail_receiver)) {
							$mail_receiver = "";
						}
						
						if(empty($mail_message_2)) {
							$mail_message_2 = "";
						}
						
						echo "
						<form action='?a=".$appointmenttoken."&sharemail=1' method='post'>
							<div class='box'>
								<div class='form-group'>
									<span class='glyphicon glyphicon-envelope form' style='color:#777'; aria-hidden='true'></span><input name='mail_receiver' type='text' class='form-control with_glyphicon' id='mail_receiver' placeholder='E-Mail Empfänger' value='".$mail_receiver."'>
								</div>
								<div class='form-group margin-bottom-0'>
									<span class='glyphicon glyphicon-comment form' style='color:#777'; aria-hidden='true'></span><input name='mail_message' type='text' class='form-control with_glyphicon' id='mail_message' placeholder='Ihre Nachricht' value='".$mail_message_2."'>
								</div>
							</div> <?php // Ende von .box ?>
							<button type='submit' class='btn btn-primary'>Teilen</button>
							<a class='btn btn-primary grey-button' href='".$path."calendar'>Abrrechen</a>
						</form>";
					}
					?>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html> 