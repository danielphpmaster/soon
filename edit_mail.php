<?php
	include 'connection.php';
	include 'session.php';
	include 'loginwall.php';
	
	$title = "Oktober 2017 - soon";
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
								$newemail = $_POST['newemail'];
							
								// Überprüfung, ob die angegebene E-Mail-Adresse gültig ist
								if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
									echo '<div class="alert alert-danger">Geben Sie eine gültige E-Mail-Adresse ein</div>';
									$error = true;
									$currentemail = false;
								}
								
								// Überprüfung, ob die E-Mail-Adresse noch nicht angegeben wurde
								if($currentemail){
									if(!$error or $newemail == $email) {
										$statement = $connection->prepare("SELECT * FROM users WHERE email = :email");
										$result = $statement->execute(array('email' => $email));
										$emailcheck = $statement->fetch();

										if($emailcheck !== false) {
											echo '<div class="alert alert-danger">Diese E-Mail-Adresse ist bereits vergeben</div>';
											$error = true;
										}
									}
								}
								
								if(!$error) {
								$sql = "UPDATE users SET email='".$newemail."' WHERE id=".$userid."";
								if ($connection->query($sql)) {
								$_SESSION['email'] = $newemail;
								header('Location: profile.php');
								} else {
									echo "<div class='alert alert-danger'>Die Änderung Ihrer E-Mail-Adresse konnte nicht gespeichert werden.</div>";
								}
								}
							}
						?>
						<form action="?editemail=1" method="post">
							<div class="form-group">
								<label for="newemail">Neue E-Mail-Adresse</label>
								<input name="newemail" type="mail" class="form-control" id="newemail" aria-describedby="emailHelp" placeholder="Neue E-Mail-Adresse" required value="<?php if(isset($_GET['editemail'])){echo $_POST['newemail'];} else {echo $email;}?>">
							</div>
							<button type="submit" class="btn btn-primary">Speichern</button>
							<a href="profile.php">Abrrechen</a>	
						</form>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
	</body>
</html>