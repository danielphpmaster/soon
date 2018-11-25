<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	$title = $t_title_edit_password[$language];
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
					<h2><?php echo $t_change_password[$language] ?></h2>
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
								
								$email = openssl_encrypt($email,"AES-128-ECB",$key_email);
								
								// Überprüfung, dass angebene Passwort mit dem aktuellen Passwort übereinstimmt
								$sql_select = "SELECT * FROM users WHERE email = '$email'";
										
								foreach ($connection->query($sql_select) as $row) {
									$password_check = $row['password'];
								}
								
								if (password_verify($currentpassword, $password_check)) {
									
									if(empty($newpassword) AND empty($newpassword2)) {
										echo '<div class="alert alert-danger">'.$t_please_insert_a_new_password[$language].'</div>';
										$error = true;
									}
									
									// Überprüfung, ob die beiden angegebenen Passwörter übereinstimmen
									if($newpassword == $newpassword2) {
									} else {
										echo '<div class="alert alert-danger">'.$t_the_passwords_must_match[$language].'</div>';
										$error = true;
									}

									// Wenn kein Fehler besteht, dann wird das Passwort geändert
									if(!$error) {
										$newpassword_hash = password_hash($newpassword, PASSWORD_DEFAULT);
										
										$sql_update = "UPDATE users SET password = '$newpassword_hash' WHERE userid = '$userid'";
										$sql_update = $connection->query($sql_update);
										
										$_SESSION['password'] = $newpassword;
										header('Location: '.$path.'profile');
									}
								} else {
									echo '<div class="alert alert-danger">'.$t_the_current_password_is_wrong[$language].'</div>';
									$error = true;
								}
							}
						?>
						<form action="?editpassword=1" method="post">
							<div class="box">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="fas fa-lock"></i>
										</span>
									</div>
									<input name="currentpassword" type="password" class="form-control" id="currentpassword" placeholder="<?php echo $t_current_password[$language] ?>">
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="fas fa-lock"></i>
										</span>
									</div>
									<input name="newpassword" type="password" class="form-control" id="newpassword" placeholder="<?php echo $t_new_password[$language] ?>">
								</div>
								<div class="margin-bottom-0 input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1">
											<i class="fas fa-lock"></i>
										</span>
									</div>
									<input name="newpassword2" type="password" class="form-control" id="newpassword2" placeholder="<?php echo $t_confirm_new_password[$language] ?>">
								</div>							
							</div> <?php // Ende von .box ?>
							<div class="margin-bottom-90">
								<button type="submit" class="btn btn-red"><?php echo $t_save[$language] ?></button>
								<a class="btn btn-light" href="<?php echo $path; ?>profile"><?php echo $t_cancel[$language] ?></a>
							</div>
						</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>				
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>