<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	if(isset($_GET['p'])) {
		$goalid = $_GET['p'];
		$_SESSION['goalid'] = $goalid;
		
		// Suche nach dem Termin
		$sql_select = "SELECT * FROM goals WHERE userid = '$userid' AND goalid = '$goalid'";
		
		// Termininformationen als Variablen speichern
		foreach ($connection->query($sql_select) as $row) {
		}
		
		$goalname = $string = openssl_decrypt($row['goalname'],"AES-128-ECB",$key);
		
		// Umleitung, wenn kein Termin gefunden
		if(empty($goalname)) {
			header('Location: '.$path.'goals');
		}
	}
	
	$title = $t_title_edit_goal[$language];
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
					<h2><?php echo $t_change_goal[$language] ?></h2>
					<?php
						if(isset($_GET['editgoal'])) {
														
							if(empty($_POST['new_goal'])) {
								$new_goal = "";
							} else {
								$new_goal = $_POST['new_goal'];								
							}
							
							// Prüfung, ob ein Nutzername angegeben wurde. Wenn ja, wird dieser gespeichert
							if(empty($new_goal)) {
								echo "<div class='alert alert-danger'>".$t_please_enter_a_username[$language]."</div>";
							} else {
								$_SESSION['goalname'] = $new_goal;
								
								$new_goal = openssl_encrypt($new_goal,"AES-128-ECB",$key);
								
								$sql_update = "UPDATE goals SET goalname = '$new_goal' WHERE userid = '$userid' AND goalid = '$goalid'";
								$sql_update = $connection->query($sql_update);
								
								header('Location: '.$path.'goal/'.$goalid);
							}
						}
					?>
					<form action="?editgoal=1" method="post">
						<div class="box">
							<div class="margin-bottom-0 input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1">
										<i class="fas fa-user"></i>
									</span>
								</div>
								<input name="new_goal" type="text" class="form-control" id="new_goal" placeholder="<?php echo $t_new_goal_name[$language] ?>" value="<?php if(isset($goalname)){echo htmlspecialchars($goalname);}?>">
							</div>
						</div> <?php // Ende von .box ?>
						<button type="submit" class="btn btn-red"><?php echo $t_save[$language] ?></button>
						<a class="btn btn-light" href="goal<?php echo "/".$goalid;?>"><?php echo $t_cancel[$language] ?></a>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html> 