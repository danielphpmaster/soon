<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';
	
	$title = "Benutzername ändern - soon";
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
					<h2>Benutzername ändern</h2>
					<?php
						if(isset($_GET['editusername'])) {
														
							if(empty($_POST['new_username'])) {
								$new_username = "";
							} else {
								$new_username = $_POST['new_username'];								
							}
							
							// Prüfung, ob ein Nutzername angegeben wurde. Wenn ja, wird dieser gespeichert
							if(empty($new_username)) {
								echo "<div class='alert alert-danger'>Geben Sie einen Benutzernamen an.</div>";
							} else {
								$sql_update = "UPDATE users SET username = '$new_username' WHERE userid = '$userid'";
								$sql_update = $connection->query($sql_update);
								
								$_SESSION['username'] = $new_username;
								header('Location: profile.php');
							}
						}
					?>
					<form action="?editusername=1" method="post">
						<div class="box">
							<div class="form-group margin-bottom-0">
								<span class='glyphicon glyphicon-user form' style='color:#777'; aria-hidden='true'></span><input name="new_username" type="text" class="form-control with_glyphicon" id="new_username" placeholder="Neuer Benutzername" value="<?php if(isset($username)){echo $username;}?>">
							</div>
						</div> <?php // Ende von .box ?>
						<button type="submit" class="btn btn-primary">Speichern</button>
						<a class="btn btn-primary grey-button" href="profile.php">Abrrechen</a>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html> 