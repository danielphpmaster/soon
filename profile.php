<?php
	include 'session.php';
	include 'loginwall.php';

	$title = "Mein Profil - soon";
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
						<h2>Mein Profil</h2>
						<table class="table table-striped">
							<tbody>
								<tr>
									<td>Benutzername</td>
									<td><?php echo $username;?></td>
									<td><a href="edit_username.php"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a></td>
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
								 <tr>
									<td></td>
									<td></td>
									<td></td>
								 </tr>
							</tbody>
						 </table>				
					</div>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
	</body>
</html>