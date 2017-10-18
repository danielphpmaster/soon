<?php
	include 'connection.php';
	include 'session.php';
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
					<div class="box">
						<h2>Benutzername ändern</h2>
						<?php
							if(isset($_GET['editusername'])) {
								$new_username = $_POST['new_username'];
											
								$sql = "UPDATE users SET username='".$new_username."' WHERE id=".$userid."";
								
								if ($connection->query($sql)) {
									$_SESSION['username'] = $new_username;
									header('Location: profile.php');
								} else {
									echo "<div class='alert alert-danger'>Die Änderung Ihres Nutzernamens konnte nicht gespeichert werden.</div>";
								}
							}
						?>
						<form action="?editusername=1" method="post">
							<div class="form-group">
								<label for="new_username">Neuer Benutzername</label>
								<input name="new_username" type="text" class="form-control" id="new_username" placeholder="Neuer Benutzername" value="<?php if(isset($username)){echo $username;}?>">
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