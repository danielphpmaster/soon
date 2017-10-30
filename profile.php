<?php
	require_once 'session.php';
	require_once 'loginwall.php';

	$title = "Mein Profil - soon";
?>

<!DOCTYPE html>

<html>
	<head>
		<?php require_once 'head.php';?>
	</head>

	<body>
		<?php require_once 'navbar.php';?>
		
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-3"></div>
				
				<div class="col-xs-12 col-md-6">			
					<h2>Mein Profil</h2>
					<div class="box">		
						<table class="table table-striped">
							<tbody>
								<tr>
									<td style="border:0;">Benutzername</td>
									<td style="border:0;"><?php echo $username;?></td>
									<td style="border:0;"><a href="edit_username.php"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a></td>
								</tr>
								<tr>
									<td>E-Mail-Adresse</td>
									<td><?php echo $email;?></td>
									<td><a href="edit_mail.php"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a></td>
								</tr>
								<tr>
									<td>Passwort</td>
									<td><a href="edit_password.php"><button type="button" class="btn btn-default btn-xs">Passwort ändern</button></a></td>
									<td></td>
								</tr>
							</tbody>
						 </table>				
					</div> <?php // Ende von .box ?>
				</div> <?php // Ende von col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>