<!DOCTYPE html>

<html>

<?php
	$title = "Registrieren - soon";
	
	include 'connection.php';
?>

<head>
	<?php include 'head.php';?>
</head>

<body>
	<?php include 'navbar.php';?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-3">
			</div>
			<div class="col-xs-12 col-md-6">
				<div class="box">
					<h2>
						Registrierung erfolgreich
					</h2>
					<?php
					

						$username = $_POST["username"];
						$email = $_POST["email"];
						$password = $_POST["password"];
						echo "<div class='alert alert-success'>","Willkommen bei soon, ".$username."</div>";
						
						$sql = "INSERT INTO users (username, email, password)
						VALUES ('".$username."', '".$email."', '".$password."')";
						
						if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}
					?>
					
					
				</div>
			</div>
			<div class="col-xs-12 col-md-3">
			</div>
		</div>
	</div>
</body>

</html> 