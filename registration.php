<?php
	include 'inlcude_all.php';
	
	// Wenn in angemeldetem Zustand: Umleitung zu calendar.php
	if(isset($_SESSION['usertoken'])) {
		die(header('Location: '.$path.'calendar'));
	}
	
	$title = $t_title_registration[$language];
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
					<h2><?php echo $t_sign_up[$language] ?></h2>
					<?php
						$showFormular = true; // Variable, die definiert, ob das Registrierungsformular angezeigt werden soll

						if(isset($_GET['register'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll

							if(empty($_POST['username'])) {
								$username = "";
							} else {
								$username = $_POST['username'];
							}

							if(empty($_POST['email'])) {
								$email = "";
							} else {
								$email = $_POST['email'];
							}

							if(empty($_POST['password'])) {
								$password = "";
							} else {
								$password = $_POST['password'];
							}

							if(empty($_POST['password2'])) {
								$password2 = "";
							} else {
								$password2 = $_POST['password2'];
							}

							$user_language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
							
							// Überprüfung, ob ein Benutzername angegeben wurde
							if(empty($username)) {
								echo '<div class="alert alert-danger">'.$t_please_enter_a_username[$language].'</div>';
								$error = true;
							}

							// Überprüfung, ob die angegebene E-Mail-Adresse gültig ist
							if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								echo '<div class="alert alert-danger">'.$t_please_enter_a_valid_email_address[$language].'</div>';
								$error = true;
							} else {
								$email_check = openssl_encrypt($email,"AES-128-ECB",$key_email);
								$sql_select = "SELECT * FROM users WHERE email = '$email_check'";

								foreach ($connection->query($sql_select) as $row) {
									// Überprüfung, ob die E-Mail-Adresse noch nicht angegeben wurde
									if($row['email'] > '0') {
										echo "<div class='alert alert-danger'>".$this_email_address_is_already_taken[$language]."</div>";
										$error = true;
									}
								}
							}

							// Überprüfung, ob ein Passwort angegeben wurde
							if(strlen($password) == 0) {
								echo '<div class="alert alert-danger">'.$t_please_enter_a_password[$language].'</div>';
								$error = true;
							}

							// Überprüfung, ob die beiden angegebenen Passwörter übereinstimmen
							if($password != $password2) {
								echo '<div class="alert alert-danger">'.$t_the_passwords_must_be_identical[$language].'</div>';
								$error = true;
							}

							// Wenn kein Fehler besteht, dann wird der Benutzer registriert
							if(!$error) {
								
								// Erstellung User-Token
								$create_token = '0';
								while ($create_token < '1') {
									$alphabet = "abcdefghijlkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
									$pass = array(); //remember to declare $pass as an array
									$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
									for ($i = 0; $i < 12; $i++) {
										$n = rand(0, $alphaLength);
										$pass[] = $alphabet[$n];
									}
									$usertoken = implode($pass); //turn the array into a string
									
									$sql_select = "SELECT * FROM users WHERE usertoken = '$usertoken'";

									$count_result = $connection->prepare($sql_select);
									$count_result->execute();

									$total = $count_result->fetchColumn();
									
									if($total < '1') {
										$create_token = '1';
									}
								}
								
								// Erstellung Verifizierungscode
								$numbers = "123456789";
								$pass2 = array(); //remember to declare $pass2 as an array
								$numberLength = strlen($numbers) - 1; //put the length -1 in cache
								for ($i2 = 0; $i2 < 5; $i2++) {
									$n2 = rand(0, $numberLength);
									$pass2[] = $numbers[$n2];
								}
								$verification_code = implode($pass2); //turn the array into a string
								
								// Versenden der E-Mail mit dem Bestätigungscode
								$headers = "From:soon-calendar.ch <termin@soon-calendar.ch>\n";
								$headers .= "MIME-Version: 1.0\n";
								$headers .= "Content-Type: text/html; charset=\"utf-8\"\n";
								
								$subject = "Dein Bestätigungscode für soon";
								$text = "
									<html>
										<head>
											<title>soon Bestätigungscode</title>
										</head>
										
										<body>
											Hey<br><br>
											Bitte nutze den folgenden Code um deine Registrierung bei <a href='https://www.soon-calendar.ch'>soon</a> abzuschliessen:<br><br>
											<h2>".$verification_code."</h2>
										</body>
									</html>
									";

								mail($email, $subject, $text, $headers);
								
								// Erstellung des Registrierungsdatum
								$created = strtotime(date('Y-m-d H:i:s'));
								
								// Speicherung in die Sitzung
								$_SESSION['usertoken'] = $usertoken;
								$_SESSION['username'] = $username;
								$_SESSION['email'] = $email;
								$_SESSION['language'] = $language_array[$user_language];

								// Verschlüsselung der Nutzereingaben
								include 'key.php';
								
								$username = openssl_encrypt($username,"AES-128-ECB",$key);
								$email = openssl_encrypt($email,"AES-128-ECB",$key_email);
								$user_language = openssl_encrypt($user_language,"AES-128-ECB",$key);
								$password_hash = password_hash($password, PASSWORD_DEFAULT);

								$sql_insert = "INSERT INTO users (usertoken, username, email, email_verified, verification_code, password, language, created) VALUES ('$usertoken', '$username', '$email', 'false', '$verification_code', '$password_hash', '$user_language', '$created')";
								$sql_insert = $connection->query($sql_insert);
								
								$_SESSION['email_verified'] = 'false';
								header('Location: '.$path.'verification');
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['register']))
					?>
					<form action="?register=1" method="post">								
						<div class="box">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-user"></i>
									</span>
								</div>
								<input name="username" type="text" class="form-control" id="username" placeholder="<?php echo $t_username[$language] ?>" value="<?php if(isset($username)){echo htmlspecialchars($username);}?>">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-envelope"></i>
									</span>
								</div>
								<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo $t_email[$language] ?>" value="<?php if(isset($email)){echo htmlspecialchars($email);}?>">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-lock"></i>
									</span>
								</div>
								<input name="password" type="password" class="form-control" id="password" placeholder="<?php echo $t_password[$language] ?>">
							</div>
							<div class="margin-bottom-0 input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-lock"></i>
									</span>
								</div>
								<input name="password2" type="password" class="form-control" id="password2" placeholder="<?php echo $t_repeat_password[$language] ?>">
							</div>						
						</div> <?php // Ende von .box ?>
						<div class="last_element">
							<button type="submit" class="btn btn-primary"><?php echo $t_sign_up[$language] ?></button>
							<?php echo $t_already_have_an_account[$language] ?> <a href="login.php"><?php echo $t_log_in[$language] ?>!</a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>

				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>