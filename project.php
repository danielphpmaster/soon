<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['projecttoken'])) {
		$projecttoken = $_GET['projecttoken'];
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM projects WHERE usertoken = '$usertoken' AND projecttoken = '$projecttoken'";			
		
		foreach ($connection->query($sql_select) as $row) {
			// Termininformationen als Variablen speichern
			$projectname = $string = openssl_decrypt($row['projectname'],"AES-128-ECB",$key);
			$projecttoken = $row['projecttoken'];
		}
						
		// Umleitung, wenn kein Projekt gefunden
		if(empty($projectname)) {
			header('Location: '.$path.'calendar');
		}
	} else {
		// Umleitung, wenn kein "projecttoken"-Wert mitgeschickt wurde
		header('Location: '.$path.'calendar');
	}
			
	$title = "".$projectname." ".$t_title_project[$language]."";
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
					<?php
						echo "<h2>".$t_project[$language]."</h2>";
						
						echo "<div class='day'>";						
							// Ausgabe Projektname
							echo "<div class='appointment' style='margin-top: 0'>
								<div class='title'><b>".htmlspecialchars($projectname)."</b>";
						
									echo "<div class='float_right'>
										<button type='button' class='btn btn-light btn-sm' data-toggle='modal' data-target='#exampleModal'><i class='fas fa-times'></i></button>
										<a href='".$path."edit_project?p=".$projecttoken."'><button type='button' class='btn btn-light btn-sm'><i class='fas fa-pencil-alt'></i></button></a>
									</div>
								</div>
							</div>
						</div>";
						
						echo "<div class='margin-bottom-90'>
								<a class='btn btn-light' href='".$path."projects'>".$t_view_calendar[$language]."</a>
							</div>";
					?>
					
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">
											<?php echo $t_delete_project[$language]; ?>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												<i class='fas fa-times'></i>
											</span>
										</button>
									</div>
									<div class="modal-body">
										<?php echo $t_do_you_want_to_delete_this_project[$language]; ?>
									</div>
									<div class="modal-footer">
										<?php
											echo"<a class='btn btn-red' href='".$path."remove_project?p=".$projecttoken."'>".$t_confirm[$language]."</a>";
										?>
										<button type="button" class="btn btn-light" data-dismiss="modal">
											<?php echo $t_cancel[$language]; ?>
										</button>
									</div>
								</div>
							</div>
						</div>
						
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>