<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	$title = $t_title_edit_mail[$language];
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
					<h2><?php echo $t_change_email[$language] ?></h2>
					<?php							
						if(isset($_GET['editemail'])) {
							$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
												
							if(empty($_POST['new_email'])) {
								$new_email = "";
							} else {
							$new_email = $_POST['new_email'];								
							}							
							
							// Überprüfung, ob die angegebene E-Mail-Adresse gültig ist
							if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
								echo '<div class="alert alert-danger">'.$t_please_enter_a_valid_email_address[$language].'</div>';
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
									$sql_select = "SELECT * FROM users WHERE email = '$new_email'";
										
									foreach ($connection->query($sql_select) as $row) {
										if($row['email'] > '0') {
											echo "<div class='alert alert-danger'>".$this_email_address_is_already_taken[$language]."</div>";
											$error = true;
										}							
									}
								}
							}
							
							// Wenn kein Fehler besteht, dann wird die E-Mail-Adresse geändert
							if(!$error) {
								$_SESSION['email'] = $new_email;
								
								$new_email = openssl_encrypt($new_email,"AES-128-ECB",$key_email);
								$sql_update = "UPDATE users SET email= '$new_email' WHERE usertoken = '$usertoken'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: '.$path.'profile');
							}
						} // Ende von if(isset($_GET['editemail']))
					?>
					<form action="?editemail=1" method="post">
						<div class="box">
							<div class="margin-bottom-0 input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-envelope"></i>
									</span>
								</div>
								<input name="new_email" type="mail" class="form-control" id="new_email" aria-describedby="emailHelp" placeholder="<?php echo $t_new_email[$language] ?>" value="<?php if(isset($_POST['new_email'])){echo htmlspecialchars($_POST['new_email']);} else {echo htmlspecialchars($email);}?>">
							</div>
						</div> <?php // Ende von .box ?>
						<div class="last_element">
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