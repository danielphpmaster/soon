<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
		
	$title = $t_title_confirmation[$language];
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
					<h2><?php echo $t_welcome_to_soon[$language] .", ".htmlspecialchars($username)?>!</h2>
					<?php
						echo "<div class='alert alert-success'>","".$t_you_have_successfully_registered[$language]."</div>";
					?>
					<div class="margin-bottom-90">
						<a href="<?php echo $path; ?>calendar" class="btn btn-light" role="button"><?php echo $t_getting_started[$language] ?></a>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>