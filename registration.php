<?php
	include 'connection.php';
	include 'session.php';
	
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
					<div class="box">
						<h2>Registrierung</h2>
						<?php
							$showFormular = true; // Variable, die definiert, ob das Registrierungsformular angezeigt werden soll

							if(isset($_GET['register'])) {
								$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
								$username = $_POST['username'];
								$email = $_POST['email'];
								$password = $_POST['password'];
								$password2 = $_POST['password2'];

								// Überprüfung, ob die angegebene E-Mail-Adresse gültig ist
								if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
									echo '<div class="alert alert-danger">Bitte eine gültige E-Mail-Adresse eingeben</div>';
									$error = true;
								}
									
								// Überprüfung, ob ein Passwort angegeben wurde
								if(strlen($password) == 0) {
									echo '<div class="alert alert-danger">Bitte ein Passwort angeben</div>';
									$error = true;
								}
									
								// Überprüfung, ob die beiden angegebenen Passwörter übereinstimmen
								if($password != $password2) {
									echo '<div class="alert alert-danger">Die Passwörter müssen übereinstimmen</div>';
									$error = true;
								}

								// Überprüfung, ob die E-Mail-Adresse noch nicht angegeben wurde
								if(!$error) {
									$statement = $connection->prepare("SELECT * FROM users WHERE email = :email");
									$result = $statement->execute(array('email' => $email));
									$emailcheck = $statement->fetch();

									if($emailcheck !== false) {
										echo '<div class="alert alert-danger">Diese E-Mail-Adresse ist bereits vergeben</div>';
										$error = true;
									}
								}

								// Wenn kein Fehler besteht, dann wird der Benutzer registriert
								if(!$error) {
									$password_hash = password_hash($password, PASSWORD_DEFAULT);

									$statement = $connection->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
									$result = $statement->execute(array('username' => $username, 'email' => $email, 'password' => $password_hash));
										 
									$_SESSION['username'] = $username;
									$_SESSION['email'] = $email;
										 
									if($result) {										 
										$statement = $connection->prepare("SELECT * FROM users WHERE email = :email");
										$result = $statement->execute(array('email' => $email));
										$user = $statement->fetch();

										$userid = $user['id'];
										$_SESSION['userid'] = $userid;
										 
										header('Location: confirmation.php');
										$showFormular = false;
									} else {
										echo 'Beim Registrieren ist leider ein Fehler aufgetreten<br>';
									}
								} // Ende von if(!$error)
							} // Ende von if(isset($_GET['register']))

							if($showFormular) {
								?>
								<form action="?register=1" method="post">
														<div class="form-group">
															<label for="exampleInputUsername1">Benutzername</label>
															<input name="username" type="text" class="form-control" id="username" placeholder="Benutzername">
														</div>
														<div class="form-group">
															<label for="exampleInputEmail1">E-Mail-Adresse</label>
															<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="E-Mail-Adresse">
														</div>
														<div class="form-group">
															<label for="exampleInputPassword1">Passwort</label>
															<input name="password" type="password" class="form-control" id="password" placeholder="Passwort">
														</div>
														<div class="form-group">
															<label for="exampleInputPassword1">Passwort wiederholen</label>
															<input name="password2" type="password" class="form-control" id="password" placeholder="Passwort wiederholen">
														</div>
								<button type="submit" class="btn btn-primary">Registrieren</button>
														Bereits einen Account? <a href="login.php">Anmelden!</a>
								</form>

								<?php
								} // Ende von if($showFormular)
						?>
					</div> <!-- Ende von .box -->
				</div> <!-- Ende von .col-xs-12.col-md3 -->
				<div class="col-xs-12 col-md-3"></div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
	</body>
</html>