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
					<div class="box row">
						<div class="col-12 col-md-6 margin-bottom-10">
							<?php echo $t_username[$language] ?>
						</div>
						<div class="col-12 col-md-6 margin-bottom-10">
							<a class="float-right btn btn-light btn-sm" href="<?php echo $path; ?>edit_username">
								<?php echo htmlspecialchars($username);?>
								<i class='float-right margin-top-4 fas fa-pencil-alt'></i>
							</a>
						</div>
						
						<div class="col-12 col-md-6 margin-bottom-10">
							<?php echo $t_email[$language] ?>
						</div>
						<div class="col-12 col-md-6 margin-bottom-10">
							<a class="float-right btn btn-light btn-sm" href="<?php echo $path; ?>edit_email">
								<?php echo $email;?>
								<i class='float-right margin-top-4 fas fa-pencil-alt'></i>
							</a>
						</div>
						
						<div class="col-12 col-md-6 margin-bottom-10">
							<?php echo $t_password[$language] ?>
						</div>
						<div class="col-12 col-md-6 margin-bottom-10">
							<a class="float-right btn btn-light btn-sm" href="<?php echo $path; ?>edit_password">
								•••
								<i class='float-right margin-top-4 fas fa-pencil-alt'></i>
							</a>
						</div>
						
						<div class="col-12 col-md-6 margin-bottom-10">
							<?php echo $t_language[$language] ?>
						</div>
						<div class="col-12 col-md-6">
							<a class="float-right btn btn-light btn-sm" href="<?php echo $path; ?>edit_language">
								<?php
									$language_array_long = array("Deutsch", "English");
									echo $language_array_long[$language];
								?>
								<i class='float-right margin-top-4 fas fa-pencil-alt'></i>
							</a>
						</div>			
					</div> <?php // Ende von .box ?>
				</div> <?php // Ende von col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>		
	</body>
</html>