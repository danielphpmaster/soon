<?php
	include 'inlcude_all.php';
	include 'loginwall.php';

	$title = $t_title_goals[$language];
?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'head.php';?>
	</head>

	<body>
		<?php include 'navbar.php';?>

		<div class="container">
			<div class="row margin-top-20 margin-bottom-20">
				<div class="col-12">
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
						<i class="fas fa-plus"></i>
						<?php echo $t_add_goal[$language]; ?>
					</button>
				</div>
				
				<?php
					if(isset($_GET['newgoal'])) {
						if(empty($_POST['new_goal'])) {
							$new_goal = "Neues Projekt";
						} else {
							$new_goal = $_POST['new_goal'];								
						}
							
						// Speicherung des neuen Projektes
						$create_token = '0';
						while ($create_token < '1') {
							$alphabet = "abcdefghijlkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
							$pass = array(); //remember to declare $pass as an array
							$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
							for ($i = 0; $i < 12; $i++) {
								$n = rand(0, $alphaLength);
								$pass[] = $alphabet[$n];
							}
							$goalid = implode($pass); //turn the array into a string

							$sql_select = "SELECT * FROM projetcs WHERE goalid = '$goalid'";

							$count_result = $connection->prepare($sql_select);
							$count_result->execute();

							$total = $count_result->fetchColumn();

							if($total < '1') {
								$create_token = '1';
							}
						}
						
						$new_goal = openssl_encrypt($new_goal,"AES-128-ECB",$key);
						$color = "#333333";
						$sql_insert = "INSERT INTO goals (goalid, userid, belonging_to, goalname) VALUES ('$goalid','$userid','$color', '$new_goal')";
						$sql_insert = $connection->query($sql_insert);
								
						header('Location: '.$path.'goals');
					}
				?>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">
									<?php echo $t_add_goal[$language]; ?>
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							 </div>
					  
							<form action="?newgoal=1" method="post">
								<div class="modal-body">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">
												<i class="fas fa-tasks"></i>
											</span>
										</div>
										<input name="new_goal" type="text" class="form-control" id="new_goal" placeholder="<?php echo $t_goal_name[$language]; ?>">
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-red"><?php echo $t_save[$language] ?></button>
									<button type="button" class="btn btn-light" data-dismiss="modal"><?php echo $t_cancel[$language] ?></button>
								</div>
							</form>
						</div>
					</div>
				</div>				
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->

		<div class='container'>
			<div class='row'>
				<div class='col-12'>
					<?php
						$sql_select = "SELECT * FROM goals WHERE userid = '$userid'";
										
						foreach ($connection->query($sql_select) as $row) {
							
							// Entschlüsselung der vom Nutzer angegebenen Informationen
							$goalname = openssl_decrypt($row['goalname'],"AES-128-ECB",$key);
							$goalid = $row['goalid'];
							
							echo "
								<a class='btn btn-light btn-sm margin-top-10' href='".$path."goal/".$goalid."'>
									".htmlspecialchars($goalname)."
								</a><div>";
										
							$sql_select_appointment = "SELECT * FROM entries WHERE userid = '$userid' AND goalid = '$goalid' ORDER BY timestamp";
										
						foreach ($connection->query($sql_select_appointment) as $row) {
							
							// Entschlüsselung der vom Nutzer angegebenen Informationen
							$appointmentname = openssl_decrypt($row['appointmentname'],"AES-128-ECB",$key);
											
								echo "<span style='padding: 0 5px'>";
								// Ausgabe Termin Popover
								echo "<span style='font-size: 150%;'>
									<a tabindex='0' data-toggle='popover' data-trigger='focus hover' data-placement='top' data-html='true' title='";
									
								echo "<a href=\"".$path."appointment/".$row['entryid']."\">".htmlspecialchars($appointmentname)."</a>";
								
								echo"' data-content='";

								echo "Inhalt";

								echo "'>";

								if($row['is_appointment'] == 'true') {
									echo "<i class='far fa-calendar'></i>";
								} else {
									echo "<i class='far fa-clipboard'></i>";
								}
								echo "
									</a>
								</span>";
								echo "</span>";
						}
						echo "</div>";
						}
					?>	
				</div>				
			</div>			
		</div>
	</body>
</html>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>