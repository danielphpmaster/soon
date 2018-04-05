<?php
	include 'inlcude_all.php';
	
	// Wenn in angemeldetem Zustand: Umleitung zu calendar.php
	if(isset($_SESSION['userid'])) {
		die(header('Location: '.$path.'calendar'));
	}

	$title = $t_title_index[$language];
?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'head.php';?>
	</head>

	<body>
		<?php include 'navbar.php';?>
		
		<div class="background-image">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-3"></div>
					
					<div class="col-xs-12 col-md-6">
						<div class="index-title"><?php echo $t_headline[$language]; ?></div>
					</div>
					
					<div class="col-xs-12 col-md-3"></div>
				</div> <!-- Ende von .row -->
				
				<div class="row">
					<div class="col-xs-12 col-md-3"></div>
					
					<div class="col-xs-6 col-md-3">
						<a href="<?php echo $path; ?>registration">
							<div class="linkbox registration">
								<?php echo $t_sign_up[$language]; ?>
							</div>
						</a>
					</div>
					
					<div class="col-xs-6 col-md-3 index-margin-bottom">
						<a href="<?php echo $path; ?>login">
							<div class="linkbox login">
								<?php echo $t_log_in[$language]; ?>
							</div>
						</a>
					</div>
					
					<div class="col-xs-12 col-md-3"></div>
					
					<div class="col-xs-12 more-information-button"> 
						<div>
							<a href="#more_information" style="color: white;"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
						</div> 
					</div>
				</div> <?php // Ende von .row ?>
			</div> <?php // Ende von .container ?>
		</div> <?php // Ende von .background-image ?>
		<div id="more_information" class="container" style="height:100vh">
			<div class="row">
				<div class="col-xs-12 col-md-3"></div>
				
				<div class="col-xs-12 col-md-6">
					<h1><span class="glyphicon glyphicon-road" aria-hidden="true"></span> <?php echo $t_your_future[$language]; ?></h1>
					<div class="box">
						<?php echo $t_your_future_text[$language]; ?>
					</div>
					<h1><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> <?php echo $t_for_free[$language]; ?></h1>
					<div class="box">
						<?php echo $t_for_free_text[$language]; ?>
					</div>
					<h1><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> <?php echo $t_everywhere[$language]; ?></h1>
					<div class="box">
						<?php echo $t_everywhere_text[$language]; ?>
					</div>
					<h1><span class="glyphicon glyphicon-sunglasses" aria-hidden="true"></span> <?php echo $t_secure[$language]; ?></h1>
					<div class="box">
						<?php echo $t_secure_text[$language]; ?>
					</div>
				</div>
			
				<div class="col-xs-12 col-md-3 last_element"></div>
				<div class="col-xs-12 more-information-button"> 
						<div>
							<a href="index.php" style="color: black;"><span class="glyphicon glyphicon glyphicon-menu-up" aria-hidden="true"></span></a>
						</div> 
					</div>
			</div>
		</div>
	</body>
</html>

