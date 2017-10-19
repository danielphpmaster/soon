<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';
	
	$title = "Passwort ändern - soon";
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
						<h2>Passwort ändern</h2>
						<?php
							if(isset($_GET['editpassword'])) {
								$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
								
								// Werte aus dem Formular als Variablen speichern
								$currentpassword = $_POST['currentpassword'];
								$newpassword = $_POST['newpassword'];
								$newpassword2 = $_POST['newpassword2'];
								
								// Überprüfung, dass angebene Passwort mit dem aktuellen Passwort übereinstimmt
								$statement = $connection->prepare("SELECT * FROM users WHERE email = :email");
								$result = $statement->execute(array('email' => $email));
								$user = $statement->fetch();
								
								if ($user !== false && password_verify($currentpassword, $user['password'])) {
								
									// Überprüfung, ob die beiden angegebenen Passwörter übereinstimmen
									if($newpassword == $newpassword2) {
									} else {
									echo '<div class="alert alert-danger">Die neuen Passwörter müssen übereinstimmen</div>';
									$error = true;
									}

									// Wenn kein Fehler besteht, dann wird das Passwort geändert
									if(!$error) {
										$newpassword_hash = password_hash($newpassword, PASSWORD_DEFAULT);
										$sql = "UPDATE users SET password='".$newpassword_hash."' WHERE id=".$userid."";
										
										if ($connection->query($sql)) {
											$_SESSION['password'] = $newpassword;
											header('Location: profile.php');
										} else {
											echo "<div class='alert alert-danger'>Die Änderung Ihres Passwortes konnte nicht gespeichert werden.</div>";
										}
									}
								} else {
										echo '<div class="alert alert-danger">Das aktuelle Passwort muss stimmen</div>';
										$error = true;
									}
							}
						?>
						<form action="?editpassword=1" method="post">
							<div class="form-group">
								<p>
									<label for="currentpassword">Aktuelles Passwort</label>
									<input name="currentpassword" type="password" class="form-control" id="currentpassword" required placeholder="Aktuelles Passwort">
								</p>
								<p>
									<label for="newpassword">Neues Passwort</label>
									<input name="newpassword" type="password" class="form-control" id="newpassword" required placeholder="Neues Passwort">
								</p>
								<p>
									<label for="newpassword2">Neues Passwort bestätigen</label>
									<input name="newpassword2" type="password" class="form-control" id="newpassword2" required placeholder="Neues Passwort bestätigen">
								</p>
							</div>
							<button type="submit" class="btn btn-primary">Speichern</button>
							<a href="profile.php">Abrrechen</a>
						</form>
					</div> <?php // Ende von .box ?>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>				
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>