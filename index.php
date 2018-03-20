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
						<?php /* Ungenutze Schaltfläche (Pfeil nach unten-Symbol)
						<div>
							<a href="" style="color: white;"><span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
						</div> 
						*/ ?>
					</div>
				</div> <?php // Ende von .row ?>
			</div> <?php // Ende von .container ?>
		</div> <?php // Ende von .background-image ?>
	</body>
</html>