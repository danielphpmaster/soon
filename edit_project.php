<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	if(isset($_GET['p'])) {
		$projecttoken = $_GET['p'];
		$_SESSION['projecttoken'] = $projecttoken;
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM projects WHERE usertoken = '$usertoken' AND projecttoken = '$projecttoken'";
		
		// Termininformationen als Variablen speichern
		foreach ($connection->query($sql_select) as $row) {
		}
		
		$projectname = $string = openssl_decrypt($row['projectname'],"AES-128-ECB",$key);
		
		// Umleitung, wenn kein Termin gefunden
		if(empty($projectname)) {
			header('Location: '.$path.'projects');
		}
	}
	
	$title = $t_title_edit_project[$language];
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
					<h2><?php echo $t_change_project[$language] ?></h2>
					<?php
						if(isset($_GET['editproject'])) {
														
							if(empty($_POST['new_project'])) {
								$new_project = "";
							} else {
								$new_project = $_POST['new_project'];								
							}
							
							// Prüfung, ob ein Nutzername angegeben wurde. Wenn ja, wird dieser gespeichert
							if(empty($new_project)) {
								echo "<div class='alert alert-danger'>".$t_please_enter_a_username[$language]."</div>";
							} else {
								$_SESSION['projectname'] = $new_project;
								
								$new_project = openssl_encrypt($new_project,"AES-128-ECB",$key);
								
								$sql_update = "UPDATE projects SET projectname = '$new_project' WHERE usertoken = '$usertoken' AND projecttoken = '$projecttoken'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: '.$path.'project/'.$projecttoken);
							}
						}
					?>
					<form action="?editproject=1" method="post">
						<div class="box">
							<div class="margin-bottom-0 input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-user"></i>
									</span>
								</div>
								<input name="new_project" type="text" class="form-control" id="new_project" placeholder="<?php echo $t_new_project_name[$language] ?>" value="<?php if(isset($projectname)){echo htmlspecialchars($projectname);}?>">
							</div>
						</div> <?php // Ende von .box ?>
						<button type="submit" class="btn btn-red"><?php echo $t_save[$language] ?></button>
						<a class="btn btn-light" href="project<?php echo "/".$projecttoken;?>"><?php echo $t_cancel[$language] ?></a>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html> 