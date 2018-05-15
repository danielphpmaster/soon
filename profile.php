<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	$title = $t_title_profile[$language];
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
					<h2><?php echo $t_my_profile[$language] ?></h2>
					<div class="box">		
						<table class="margin-bottom-0 table table-striped">
							<tbody>
								<tr>
									<td style="border:0;"><?php echo $t_username[$language] ?></td>
									<td style="border:0;"><?php echo htmlspecialchars($username);?></td>
									<td style="border:0;"><a href="<?php echo $path; ?>edit_username"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a></td>
								</tr>
								<tr>
									<td><?php echo $t_email[$language] ?></td>
									<td><?php echo $email;?></td>
									<td><a href="<?php echo $path; ?>edit_mail"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a></td>
								</tr>
								<tr>
									<td><?php echo $t_password[$language] ?></td>
									<td><a href="<?php echo $path; ?>edit_password"><button type="button" class="btn btn-default btn-xs"><?php echo $t_change_password[$language] ?></button></a></td>
									<td></td>
								</tr>
								<tr>
									<td><?php echo $t_language[$language] ?></td>
									<?php $language_array_long = array("Deutsch", "English"); ?>
									<td><?php echo $language_array_long[$language];?></td>
									<td><a href="<?php echo $path; ?>edit_language"><button type="button" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></a></td>
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