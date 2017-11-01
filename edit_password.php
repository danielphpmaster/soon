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
					<h2>Passwort ändern</h2>
						<?php
							if(isset($_GET['editpassword'])) {
								$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
									
								// Werte aus dem Formular als Variablen speichern
								if(empty($_POST['newpassword2'])) {
									$newpassword2 = "";
								} else {
									$newpassword2 = $_POST['newpassword2'];
								}
								
								if(empty($_POST['newpassword'])) {
									$newpassword = "";
								} else {
									$newpassword = $_POST['newpassword'];
								}
								
								if(empty($_POST['currentpassword'])) {
									$currentpassword = "";
								} else {
									$currentpassword = $_POST['currentpassword'];									
								}
								
								// Überprüfung, dass angebene Passwort mit dem aktuellen Passwort übereinstimmt
								$sql_select = "SELECT * FROM users WHERE email = '".$email."'";
										
								foreach ($connection->query($sql_select) as $row) {
									$password_check = $row['password'];
								}
								
								if (password_verify($currentpassword, $password_check)) {
									
									if(empty($newpassword) AND empty($newpassword2)) {
										echo '<div class="alert alert-danger">Geben Sie ein neues Passwort ein</div>';
										$error = true;
									}
									
									// Überprüfung, ob die beiden angegebenen Passwörter übereinstimmen
									if($newpassword == $newpassword2) {
									} else {
										echo '<div class="alert alert-danger">Die neuen Passwörter müssen übereinstimmen</div>';
										$error = true;
									}

									// Wenn kein Fehler besteht, dann wird das Passwort geändert
									if(!$error) {
										$newpassword_hash = password_hash($newpassword, PASSWORD_DEFAULT);
										
										$sql_update = "UPDATE users SET password='".$newpassword_hash."' WHERE userid=".$userid."";
										$sql_update = $connection->query($sql_update);
										
										$_SESSION['password'] = $newpassword;
										header('Location: profile.php');
									}
								} else {
									echo '<div class="alert alert-danger">Das aktuelle Passwort muss stimmen</div>';
									$error = true;
								}
							}
						?>
						<form action="?editpassword=1" method="post">
							<div class="box">
								<div class="form-group">
									<span class='glyphicon glyphicon-lock form' style='color:#777'; aria-hidden='true'></span><input name="currentpassword" type="password" class="form-control with_glyphicon" id="currentpassword" placeholder="Aktuelles Passwort">
								</div>
								<div class="form-group">
									<span class='glyphicon glyphicon-lock form' style='color:#777'; aria-hidden='true'></span><input name="newpassword" type="password" class="form-control with_glyphicon" id="newpassword" placeholder="Neues Passwort">
								</div>
								<div class="form-group margin-bottom-0">
									<span class='glyphicon glyphicon-lock form' style='color:#777'; aria-hidden='true'></span><input name="newpassword2" type="password" class="form-control with_glyphicon" id="newpassword2" placeholder="Neues Passwort bestätigen">
								</div>
							</div> <?php // Ende von .box ?>
							<div class="last_element">
								<button type="submit" class="btn btn-primary">Speichern</button>
								<a class="btn btn-primary grey-button" href="profile.php">Abrrechen</a>
							</div>
						</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>				
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>