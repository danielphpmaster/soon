<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	$title = $t_title_edit_username[$language];
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
					<h2><?php echo $t_change_username[$language] ?></h2>
					<?php
						if(isset($_GET['editusername'])) {
														
							if(empty($_POST['new_username'])) {
								$new_username = "";
							} else {
								$new_username = $_POST['new_username'];								
							}
							
							// Prüfung, ob ein Nutzername angegeben wurde. Wenn ja, wird dieser gespeichert
							if(empty($new_username)) {
								echo "<div class='alert alert-danger'>".$t_please_enter_a_username[$language]."</div>";
							} else {
								$_SESSION['username'] = $new_username;
								
								$new_username = openssl_encrypt($new_username,"AES-128-ECB",$key);
								
								$sql_update = "UPDATE users SET username = '$new_username' WHERE userid = '$userid'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: '.$path.'profile');
							}
						}
					?>
					<form action="?editusername=1" method="post">
						<div class="box">
							<div class="margin-bottom-0 input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-user"></i>
									</span>
								</div>
								<input name="new_username" type="text" class="form-control" id="new_username" placeholder="<?php echo $t_new_username[$language] ?>" value="<?php if(isset($username)){echo htmlspecialchars($username);}?>">
							</div>
						</div> <?php // Ende von .box ?>
						<button type="submit" class="btn btn-red"><?php echo $t_save[$language] ?></button>
						<a class="btn btn-light" href="profile"><?php echo $t_cancel[$language] ?></a>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html> 