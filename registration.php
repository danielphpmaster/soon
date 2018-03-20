<?php
	include 'inlcude_all.php';
	
	// Wenn in angemeldetem Zustand: Umleitung zu calendar.php
	if(isset($_SESSION['userid'])) {
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
							$_SESSION['language'] = $user_language;
							
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
								$sql_select = "SELECT * FROM users WHERE email = '$email'";

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
									$alphabet = "abcdefghijlkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_.*!?";
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
								
								// Erstellung des Registrierungsdatum
								$created     = strtotime(date('Y-m-d H:i:s'));
								
								$password_hash = password_hash($password, PASSWORD_DEFAULT);

								$sql_insert = "INSERT INTO users (usertoken, username, email, password, language, created) VALUES ('$usertoken', '$username', '$email', '$password_hash', '$user_language', '$created')";
								$sql_insert = $connection->query($sql_insert);

								$_SESSION['username'] = $username;
								$_SESSION['email'] = $email;

								$sql_select = "SELECT * FROM users WHERE email = '$email'";
								foreach ($connection->query($sql_select) as $row) {
									$userid = $row['userid'];
								}

								$_SESSION['userid'] = $userid;
								header('Location: '.$path.'confirmation');
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['register']))
					?>
					<form action="?register=1" method="post">								
						<div class="box">
							<div class="form-group">
								<span class='glyphicon glyphicon-user form' style='color:#777'; aria-hidden='true'></span><input name="username" type="text" class="form-control with_glyphicon" id="username" placeholder="<?php echo $t_username[$language] ?>" value="<?php if(isset($username)){echo $username;}?>">
							</div>
							<div class="form-group">
								<span class='glyphicon glyphicon-envelope form' style='color:#777'; aria-hidden='true'></span><input name="email" type="email" class="form-control with_glyphicon" id="email" aria-describedby="emailHelp" placeholder="<?php echo $t_email[$language] ?>" value="<?php if(isset($email)){echo $email;}?>">
							</div>
							<div class="form-group">
								<span class='glyphicon glyphicon-lock form' style='color:#777'; aria-hidden='true'></span><input name="password" type="password" class="form-control with_glyphicon" id="password" placeholder="<?php echo $t_password[$language] ?>">
							</div>
							<div class="form-group margin-bottom-0">
								<span class='glyphicon glyphicon-lock form' style='color:#777'; aria-hidden='true'></span><input name="password2" type="password" class="form-control with_glyphicon" id="password2" placeholder="<?php echo $t_repeat_password[$language] ?>">
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