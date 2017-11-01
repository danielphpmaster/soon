<?php
	include 'session.php';
	include 'connection.php';
		
	$title = "Anmelden - soon";

	if(isset($_GET['login'])) {
		
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
		
		$sql_select = "SELECT * FROM users WHERE email = '".$email."'";
		
		foreach ($connection->query($sql_select) as $row) {
			$password_check = $row['password'];
		}

		if(empty($password_check)) {
			$error_message = "<div class='alert alert-danger'>E-Mail-Adresse oder Passwort ist ungültig</div>";
		} elseif (password_verify($password, $password_check)) {
			$userid = $row['userid'];
			$_SESSION['userid'] = $userid;
				
			$username = $row['username'];
			$_SESSION['username'] = $username;
			
			$_SESSION['email'] = $email;
				
			header('Location: calendar.php');
		} else {
			$error_message = "<div class='alert alert-danger'>E-Mail-Adresse oder Passwort ist ungültig</div>";
		}
	} // Ende von if(isset($_GET['login']))
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
					<h2>Anmelden</h2>
					<?php
						if(isset($error_message)) {
							echo $error_message;
						}
					?>
					<form action="?login=1" method="post">
						<div class="box">
							<div class="form-group">
								<span class='glyphicon glyphicon-envelope form' style='color:#777'; aria-hidden='true'></span><input name="email" type="email" class="form-control with_glyphicon" id="email" aria-describedby="emailHelp" placeholder="E-Mail-Adresse" value="<?php if(isset($email)){echo $email;}?>">
							</div>
							<div class="form-group">
								<span class='glyphicon glyphicon-lock form' style='color:#777'; aria-hidden='true'></span><input name="password" type="password" class="form-control with_glyphicon" id="password" placeholder="Passwort">
							</div>
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input">
									Angemeldet bleiben
								</label>
							</div>
						</div> <?php // Ende von .box ?>
						<div class="last_element">	
							<button type="submit" class="btn btn-primary">Anmelden</button>
							Noch keinen Account? <a href="registration.php">Registrieren!</a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>