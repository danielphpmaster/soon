<?php
	include 'inlcude_all.php';
	
	$title = $t_title_login[$language];
	
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
		
		$email_check = openssl_encrypt($email,"AES-128-ECB",$key_email);
		$sql_select = "SELECT * FROM users WHERE email = '$email_check'";
		
		foreach ($connection->query($sql_select) as $row) {
			$password_check = $row['password'];
		}

		if(empty($password_check)) {
			$error_message = "<div class='alert alert-danger'>".$t_email_or_password_is_invalid[$language]."</div>";
		} elseif (password_verify($password, $password_check)) {			
			
			/* Wenn die Checkbox "Angemeldet bleiben" aktiv: Cookie wird gesetzt
			if(isset($_POST['stayloggedin'])) {								
				$cookie_name = "soonstayloggedin";
				$cookie_value = $row['userid'];
				setcookie($cookie_name, $cookie_value, time() + (86400 * 365), $path); // 86400 = 1 day
			}
			*/
			
			$userid = $row['userid'];
			$_SESSION['userid'] = $userid;
			
			include 'key.php';
			
			$email_verified = $row['email_verified'];
			$_SESSION['email_verified'] = $email_verified;
			
			$username = openssl_decrypt($row['username'],"AES-128-ECB",$key);
			$_SESSION['username'] = $username;
			
			$language = openssl_decrypt($row['language'],"AES-128-ECB",$key);	
			$language = $language_array[$language];
			$_SESSION['language'] = $language;
			
			$_SESSION['email'] = $email;
				
			header('Location: '.$path.'calendar');
		} else {
			$error_message = "<div class='alert alert-danger'>".$t_email_or_password_is_invalid[$language]."</div>";
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
					<h2><?php echo $t_log_in[$language] ?></h2>
					<?php
						if(isset($error_message)) {
							echo $error_message;
						}
					?>
					<form action="?login=1" method="post">
						<div class="box">
							<!--<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" name="stayloggedin" class="form-check-input">
									<?php echo $t_stay_logged_in[$language] ?>
								</label>
							</div>-->
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-envelope"></i>
									</span>
								</div>
								<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo $t_email[$language] ?>" value="<?php if(isset($email)){echo htmlspecialchars($email);}?>">
							</div>
							<div class="margin-bottom-0 input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-lock"></i>
									</span>
								</div>
								<input name="password" type="password" class="form-control" id="password" placeholder="<?php echo $t_password[$language] ?>">
							</div>
						</div> <?php // Ende von .box ?>
						<div class="margin-bottom-90">	
							<button type="submit" class="btn btn-red"><?php echo $t_log_in[$language] ?></button>
							<?php echo $t_no_account_yet[$language] ?> <a href="<?php echo $path; ?>registration"><?php echo $t_sign_up[$language] ?>!</a>
						</div>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>