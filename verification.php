<?php
	$site = 'verification';
	
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	$title = $t_title_verification[$language];
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
					<h2><?php echo $t_verify_email_adress[$language] ?></h2>
					<?php							
						if(isset($_GET['verifyemail'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
												
							if(empty($_POST['verification_code'])) {
								$verification_code = "";
							} else {
								$verification_code = $_POST['verification_code'];								
							}
							
							// Überprüfung, ob die E-Mail-Adresse bereits angegeben wurde								
							$sql_select = "SELECT * FROM users WHERE userid = '$userid'";
							
							foreach ($connection->query($sql_select) as $row) {
								if($row['verification_code'] <> $verification_code) {
									$error = true;
								}
							}
							
							// Wenn kein Fehler besteht, dann wird der Verifizierungsstatus geändert
							if(!$error) {
								$sql_update = "UPDATE users SET email_verified= 'true' WHERE userid = '$userid'";
								$sql_update = $connection->query($sql_update);
								
								$_SESSION['email_verified'] = 'true';
								header('Location: '.$path.'confirmation');
							} else {
								echo "<div class='alert alert-danger'>".$t_please_enter_a_username[$language]."</div>";
							}
						} // Ende von if(isset($_GET['editemail']))
					?>
					<form action="?verifyemail=1" method="post">
						<div class="box">
							<div class="form-group margin-bottom-0">
								<span class='glyphicon glyphicon-ok form' style='color:#777'; aria-hidden='true'></span><input name="verification_code" type="text" class="form-control with_glyphicon" id="verification_code" placeholder="<?php echo $t_verification_code[$language] ?>" value="<?php if(isset($_POST['verification_code'])){echo $_POST['verification_code'];}?>">
							</div>
						</div> <?php // Ende von .box ?>
						<div class="last_element">
							<button type="submit" class="btn btn-primary"><?php echo $t_confirm[$language] ?></button>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>