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
					<div class="col-0 col-lg-3"></div>
					
					<div class="col-12 col-lg-6">
						<h1 id='headline'><?php echo $t_headline[$language]; ?></h1>
					</div>
					
					<div class="col-0 col-lg-3"></div>
					
					<div class="col-0 col-lg-2"></div>
					
					<div class="col-6 col-lg-4">
						<a href="<?php echo $path; ?>registration">
							<div class="linkbox registration">
								<?php echo $t_sign_up[$language]; ?>
							</div>
						</a>
					</div>
					
					<div class="col-6 col-lg-4">
						<a href="<?php echo $path; ?>login">
							<div class="linkbox login">
								<?php echo $t_log_in[$language]; ?>
							</div>
						</a>
					</div>					
					
					<div class="col-0 col-lg-2"></div>
					
					<div class="col-12 more-information-button"> 
						<div style="margin-top: 28px;">
							<a href="#more_information" style="color: white; text-align: center; font-size: 2.5rem;"><i class='fas fa-chevron-down'></i></a>
						</div> 
					</div>
				</div> <?php // Ende von .row ?>
			</div> <?php // Ende von .container ?>
		</div> <?php // Ende von .background-image ?>
		<div id="more_information" class="container" style="height:100vh">
			<div class="row">
				<div class="col-12 col-lg-3"></div>
				
				<div class="col-12 col-lg-6">
					<h1><i class='fas fa-road'></i> <?php echo $t_your_future[$language]; ?></h1>
					<div class="box">
						<?php echo $t_your_future_text[$language]; ?>
					</div>
					<h1><i class='fas fa-gift'></i> <?php echo $t_for_free[$language]; ?></h1>
					<div class="box">
						<?php echo $t_for_free_text[$language]; ?>
					</div>
					<h1><i class='fas fa-globe'></i> <?php echo $t_everywhere[$language]; ?></h1>
					<div class="box">
						<?php echo $t_everywhere_text[$language]; ?>
					</div>
					<h1><i class='fas fa-lock'></i> <?php echo $t_secure[$language]; ?></h1>
					<div class="box">
						<?php echo $t_secure_text[$language]; ?>
					</div>
				</div>
			
				<div class="col-12 col-lg-3 margin-bottom-90"></div>
				<div class="col-12 more-information-button"> 
						<div style="margin-top: 28px;">
							<a href="index.php" style="color: black; text-align: center; font-size: 2.5rem;"><i class='fas fa-chevron-up'></i></a>
						</div> 
					</div>
			</div>
		</div>
	</body>
</html>

