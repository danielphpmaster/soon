<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';
	
	$title = "Termin teilen - soon";
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
					<h2>Termin teilen</h2>
					<?php
						if(isset($_GET['sharemail'])) {
												
							if(empty($_POST['mail_receiver'])) {
								$mail_receiver = "";
							} else {
								$mail_receiver = $_POST['mail_receiver'];								
							}
							
							// Überprüfung, ob die angegebene E-Mail-Adresse gültig ist
							if(!filter_var($mail_receiver, FILTER_VALIDATE_EMAIL)) {
								echo '<div class="alert alert-danger">Geben Sie eine gültige E-Mail-Adresse ein</div>';
								$error = true;
							}
							
							// Prüfung, ob ein Nutzername angegeben wurde. Wenn ja, wird dieser gespeichert
							if(!$error) {
								$receiver = $mail_receiver;
								$subject = $username." hat dir einen soon Termin gesendet";
								$from = "Von: soon calendar <termin@soon-calendar.ch>";
								$text = "Test";
								 
								mail($receiver, $subject, $text, $from);
								
							}
						}
					?>
					<form action="?sharemail=1" method="post">
						<div class="box">
							<div class="form-group">
								<span class='glyphicon glyphicon-envelope form' style='color:#777'; aria-hidden='true'></span><input name="mail_receiver" type="text" class="form-control with_glyphicon" id="mail_receiver" placeholder="E-Mail Empfänger" value="<?php if(isset($mail_receiver)){echo $mail_receiver;}?>">
							</div>
							<div class="form-group margin-bottom-0">
								<span class='glyphicon glyphicon-comment form' style='color:#777'; aria-hidden='true'></span><input name="mail_message" type="text" class="form-control with_glyphicon" id="mail_message" placeholder="Ihre Nachricht" value="<?php if(isset($mail_message)){echo $mail_message;}?>">
							</div>
						</div> <?php // Ende von .box ?>
						<button type="submit" class="btn btn-primary">Teilen</button>
						<a class="btn btn-primary grey-button" href="calendar.php">Abrrechen</a>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html> 