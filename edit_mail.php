<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';
	
	$title = "E-Mail-Adresse bearbeiten - soon";
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
						<h2>E-Mail-Adresse ändern</h2>
						<?php							
							if(isset($_GET['editemail'])) {
								$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
								
								$new_email = $_POST['new_email'];
								
								// Überprüfung, ob die angegebene E-Mail-Adresse gültig ist
								if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
									echo '<div class="alert alert-danger">Geben Sie eine gültige E-Mail-Adresse ein</div>';
									$error = true;
								}
								
								// Überprüfung, ob die angegebene E-Mail-Adresse die gleiche ist wie bisher
								if($email == $new_email) {
									$email_change = false;
								} else {
									$email_change = true;
								}
								
								// Überprüfung, ob die E-Mail-Adresse bereits angegeben wurde								
								if($email_change) {
									if(!$error) {
										$sql = "SELECT * FROM users WHERE email = '".$new_email."'";
										
										foreach ($connection->query($sql) as $row) {
											if($row['email'] > '0') {
												echo "<div class='alert alert-danger'>Diese E-Mail-Adresse ist bereits vergeben.</div>";
												$error = true;
											}							
										}
									}
								}
								
								// Wenn kein Fehler besteht, dann wird die E-Mail-Adresse geändert
								if(!$error) {
									$sql = "UPDATE users SET email='".$new_email."' WHERE id=".$userid."";
									
									if ($connection->query($sql)) {
										$_SESSION['email'] = $new_email;
										header('Location: profile.php');
									} else {
										echo "<div class='alert alert-danger'>Die Änderung Ihrer E-Mail-Adresse konnte nicht gespeichert werden.</div>";
									}
								}
							} // Ende von if(isset($_GET['editemail']))
						?>
						<form action="?editemail=1" method="post">
							<div class="form-group">
								<span class='glyphicon glyphicon-envelope form' style='color:#777'; aria-hidden='true'></span><input name="new_email" type="mail" class="form-control with_glyphicon" id="new_email" aria-describedby="emailHelp" placeholder="Neue E-Mail-Adresse" required value="<?php if(isset($_GET['editemail'])){echo $_POST['new_email'];} else {echo $email;}?>">
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