<?php
	include 'connection.php';
	include 'session.php';
		
	$title = "Anmelden - soon";

	if(isset($_GET['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$statement = $connection->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();

		// Passwort überprüfen
		if ($user !== false && password_verify($password, $user['password'])) {
			$userid = $user['id'];
			$_SESSION['userid'] = $userid;
			$username = $user['username'];
			$_SESSION['username'] = $username;
			$_SESSION['email'] = $email;
			header('Location: calendar.php');
		} 
		else {
			$errorMessage = "<div class='alert alert-danger'>E-Mail-Adresse oder Passwort ist ungültig</div>";
		}
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
					<div class="box">
						<h2>Anmelden</h2>
						<?php
							if(isset($errorMessage)) {
								echo $errorMessage;
							}
						?>
						<form action="?login=1" method="post">
							<div class="form-group">
								<label for="exampleInputEmail1">E-Mail-Adresse</label>
								<input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-Mail-Adresse">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Passwort</label>
								<input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Passwort">
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input">
									Angemeldet bleiben
								</label>
							</div>
							<button type="submit" class="btn btn-primary">Anmelden</button>
							Noch keinen Account? <a href="registration.php">Registrieren!</a>						
						</form>
					</div>
				</div>
				<div class="col-xs-12 col-md-3"></div>
			</div> <!-- Ende von .row -->
		</div>
	</body>
</html>