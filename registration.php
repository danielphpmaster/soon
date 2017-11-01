<?php
	include 'session.php';
	include 'connection.php';
	
	$title = "Registrieren - soon";
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
					<h2>Registrieren</h2>
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
							
							$language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

							// Überprüfung, ob ein Benutzername angegeben wurde
							if(empty($username)) {
								echo '<div class="alert alert-danger">Geben Sie einen Benutzernamen ein</div>';
								$error = true;
							}
								
							// Überprüfung, ob die angegebene E-Mail-Adresse gültig ist
							if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
								echo '<div class="alert alert-danger">Geben Sie eine gültige E-Mail-Adresse ein</div>';
								$error = true;
							}
								
							// Überprüfung, ob ein Passwort angegeben wurde
							if(strlen($password) == 0) {
								echo '<div class="alert alert-danger">Geben Sie ein Passwort ein</div>';
								$error = true;
							}
									
							// Überprüfung, ob die beiden angegebenen Passwörter übereinstimmen
							if($password != $password2) {
								echo '<div class="alert alert-danger">Die Passwörter müssen übereinstimmen</div>';
								$error = true;
							}

							// Überprüfung, ob die E-Mail-Adresse noch nicht angegeben wurde
							if(!$error) {
								$sql_select = "SELECT * FROM users WHERE email = '".$email."'";
										
								foreach ($connection->query($sql_select) as $row) {
									if($row['email'] > '0') {
										echo "<div class='alert alert-danger'>Diese E-Mail-Adresse ist bereits vergeben.</div>";
										$error = true;
									}
								}
							}

							// Wenn kein Fehler besteht, dann wird der Benutzer registriert
							if(!$error) {
								$password_hash = password_hash($password, PASSWORD_DEFAULT);

								$sql_insert = "INSERT INTO users (username, email, password, language) VALUES ('".$username."', '".$email."', '".$password_hash."', '".$language."')";
								$sql_insert = $connection->query($sql_insert);
								
								$_SESSION['username'] = $username;
								$_SESSION['email'] = $email;
								
								$sql_select = "SELECT * FROM users WHERE email = '".$email."'";
								foreach ($connection->query($sql_select) as $row) {
									$userid = $row['userid'];
								}
								
								$_SESSION['userid'] = $userid;
								header('Location: confirmation.php');
							} // Ende von if(!$error)
						} // Ende von if(isset($_GET['register']))
					?>
					<form action="?register=1" method="post">								
						<div class="box">
							<div class="form-group">
								<span class='glyphicon glyphicon-user form' style='color:#777'; aria-hidden='true'></span><input name="username" type="text" class="form-control with_glyphicon" id="username" placeholder="Benutzername" value="<?php if(isset($username)){echo $username;}?>">
							</div>
							<div class="form-group">
								<span class='glyphicon glyphicon-envelope form' style='color:#777'; aria-hidden='true'></span><input name="email" type="email" class="form-control with_glyphicon" id="email" aria-describedby="emailHelp" placeholder="E-Mail-Adresse" value="<?php if(isset($email)){echo $email;}?>">
							</div>
							<div class="form-group">
								<span class='glyphicon glyphicon-lock form' style='color:#777'; aria-hidden='true'></span><input name="password" type="password" class="form-control with_glyphicon" id="password" placeholder="Passwort">
							</div>
							<div class="form-group margin-bottom-0">
								<span class='glyphicon glyphicon-lock form' style='color:#777'; aria-hidden='true'></span><input name="password2" type="password" class="form-control with_glyphicon" id="password2" placeholder="Passwort wiederholen">
							</div>
						</div> <?php // Ende von .box ?>
						<div class="last_element">
							<button type="submit" class="btn btn-primary">Registrieren</button>
							Bereits einen Account? <a href="login.php">Anmelden!</a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>