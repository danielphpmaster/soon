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
						<h2>Benutzername ändern</h2>
						<?php
							if(isset($_GET['editusername'])) {
								$newusername = $_POST['newusername'];
								$sql = "UPDATE users SET username='".$newusername."' WHERE id=".$userid."";
								if ($connection->query($sql)) {
								$_SESSION['username'] = $newusername;
								header('Location: profile.php');
								} else {
									echo "<div class='alert alert-danger'>Die Änderung Ihres Nutzernamens konnte nicht gespeichert werden.</div>";
								}
							}
						?>
						<form action="?editusername=1" method="post">
							<div class="form-group">
								<label for="newusername">Neuer Benutzername</label>
								<input name="newusername" type="text" class="form-control" id="newusername" placeholder="Neuer Benutzername" value="<?php if(isset($username)){echo $username;}?>">
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