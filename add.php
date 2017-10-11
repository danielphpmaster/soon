<?php
	include 'connection.php';
	include 'session.php';
	include 'loginwall.php';

	$title = "Termin hinzufügen - soon";
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
				<div class="col-xs-12 col-md-3">
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="box">
						<h2>Termin hinzufügen</h2>
						<?php
							if(isset($_GET['add'])) {
								$error = false; // Variable, die definiert, ob eine Fehlermeldung angezeigt werden soll
								$appointmentname = $_POST['appointmentname'];
								$date = $_POST['date'];
								$time = $_POST['time'];
								$location = $_POST['location'];
								$comment = $_POST['comment'];

								// Überprüfung, ob ein Terminname angegeben wurde
								if(empty($appointmentname)) {
									echo '<div class="alert alert-danger">Geben Sie einen Terminnamen ein</div>';
									$error = true;
								}
								
								// Überprüfung, ob ein Datum angegeben wurde
								if(empty($date)) {
									echo '<div class="alert alert-danger">Geben Sie ein Datum ein</div>';
									$error = true;
								}
								
								// Wenn kein Fehler besteht, dann wird der Termin gespeichert
								if(!$error) {
									$statement = $connection->prepare("INSERT INTO appointments (appointmentname, date, time, location, comment) VALUES (:appointmentname, :date, :time, :location, :comment)");
									$result = $statement->execute(array('appointmentname' => $appointmentname, 'time' => $time, 'location' => $location, 'comment' => $location));
										 
									$_SESSION['username'] = $username;
									$_SESSION['email'] = $email;
										 
									if($result) {										 
										$statement = $connection->prepare("SELECT * FROM users WHERE email = :email");
										$result = $statement->execute(array('email' => $email));
										$user = $statement->fetch();

										$userid = $user['id'];
										$_SESSION['userid'] = $userid;
										 
										header('Location: calendar.php');
										$showFormular = false;
									} else {
										echo '<div class="alert alert-danger">Beim Registrieren ist leider ein Fehler aufgetreten</div>';
									}
								} // Ende von if(!$error)
							} // Ende von if(isset($_GET['add']))
						?>
						<form action="?add=1" method="post">
							<div class="form-group">
								<label for="appointmentname">Terminname</label>
								<input name="appointmentname" type="text" class="form-control" id="appointmentname" required placeholder="Terminname" value="<?php if(isset($appointmentname)){echo $appointmentname;}?>">
							</div>
							<div class="form-group">
								<label for="date">Datum</label>
								<input name="date" type="date" class="form-control" id="date" min="2017-10-08" required placeholder="Datum" value="<?php if(isset($date)){echo $date;}?>">
							</div>
							<div class="form-group">
								<label for="time">Zeit</label>
								<input name="time" type="time" class="form-control" id="time" placeholder="Zeit" value="<?php if(isset($time)){echo $time;}?>">
							</div>
							<div class="form-group">
								<label for="location">Ort</label>
								<input name="location" type="text" class="form-control" id="location" placeholder="Ort" value="<?php if(isset($location)){echo $location;}?>">
							</div>
							<div class="form-group">						
								<label for="comment">Bemerkung</label>
								<input name="comment" type="text" class="form-control" id="comment" placeholder="Bemerkung" value="<?php if(isset($comment)){echo $comment;}?>">
							</div>
							<button type="submit" class="btn btn-primary">Termin erfassen</button>
						</form>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
	</body>
</html>