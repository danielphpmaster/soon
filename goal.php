<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	if(isset($_GET['goalid'])) {
		$goalid = $_GET['goalid'];
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM goals WHERE userid = '$userid' AND goalid = '$goalid'";			
		
		foreach ($connection->query($sql_select) as $row) {
			// Termininformationen als Variablen speichern
			$goalname = $string = openssl_decrypt($row['goalname'],"AES-128-ECB",$key);
			
			if ($row['description'] !== 'false') {
				$description = $string = openssl_decrypt($row['description'],"AES-128-ECB",$key);
			}
			
			$goalid = $row['goalid'];
		}
						
		// Umleitung, wenn kein Projekt gefunden
		if(empty($goalname)) {
			header('Location: '.$path.'calendar');
		}
	} else {
		// Umleitung, wenn kein "goalid"-Wert mitgeschickt wurde
		header('Location: '.$path.'calendar');
	}
			
	$title = "".$goalname." ".$t_title_goal[$language]."";
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
						echo "<h2>".$t_goal[$language]."						
							<a class='float-right btn btn-light width-42' href='".$path."edit_goal?p=".$goalid."'><i class='fas fa-pencil-alt'></i></a>
							<a class='float-right btn btn-light width-42 margin-right-10' data-toggle='modal' data-target='#deleteModal'><i class='fas fa-times'></i></a>
						</h2>";
											
						// Ausgabe Projektname
						echo "<div class='appointment' style='margin-top: 0'>
							<div class='title'>
								".htmlspecialchars($goalname)."
							</div>";
					?>
					
						<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="deleteModalLabel">
											<?php echo $t_delete_goal[$language]; ?>
										</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">
												<i class='fas fa-times'></i>
											</span>
										</button>
									</div>
									<div class="modal-body">
										<?php echo $t_do_you_want_to_delete_this_goal[$language]; ?>
									</div>
									<div class="modal-footer">
										<?php
											echo"<a class='btn btn-red' href='".$path."remove_goal?p=".$goalid."'>".$t_confirm[$language]."</a>";
										?>
										<button type="button" class="btn btn-light" data-dismiss="modal">
											<?php echo $t_cancel[$language]; ?>
										</button>
									</div>
								</div>
							</div>
						</div>
					
					<?php					
						// Ausgabe der Informationen
						echo "<div class='goalinformation'>";
						
						if(isset($description)) {
							echo"<div class='description'>
								<i class='fas fa-comment'></i>
								".htmlspecialchars($description)."
							</div>";
						}							
						
						echo "</div>
						</div>";
						
						echo "<div class='margin-bottom-90'>
							<a class='btn btn-light' href='".$path."goals'>".$t_view_calendar[$language]."</a>
						</div>";
					?>	
						
						
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html>