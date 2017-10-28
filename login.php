<?php
	require_once 'session.php';
	require_once 'connection.php';
		
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
	} // Ende von if(isset($_GET['login']))
?>

<!DOCTYPE html>
<html>
	<head>
		<?php require_once 'head.php';?>
	</head>
	
	<body>
		<?php require_once 'navbar.php';?>
			
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
								<label for="email">E-Mail-Adresse</label>
								<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" required placeholder="E-Mail-Adresse" value="<?php if(isset($email)){echo $email;}?>">
							</div>
							<div class="form-group">
								<label for="password">Passwort</label>
								<input name="password" type="password" class="form-control" id="password" required placeholder="Passwort">
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
					</div> <?php // Ende von .box ?>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>