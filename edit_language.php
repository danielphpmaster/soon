<?php
	include 'inlcude_all.php';
	include 'loginwall.php';
	
	$title = $t_title_edit_language[$language];
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
					<h2><?php echo $t_change_language[$language] ?></h2>
					<?php
						if(isset($_GET['editlanguage'])) {
														
							if(empty($_POST['new_language'])) {
								$new_language = "";
							} else {
								$new_language = $_POST['new_language'];								
							}
							
							// Prüfung, ob ein Nutzername angegeben wurde. Wenn ja, wird dieser gespeichert
							if(empty($new_language)) {
								echo "<div class='alert alert-danger'>".$t_please_enter_a_username[$language]."</div>";
							} else {
								$sql_update = "UPDATE users SET language = '$new_language' WHERE userid = '$userid'";
								$sql_update = $connection->query($sql_update);
								
								$language = $new_language;
								$_SESSION['language'] = $language_array[$language];
								header('Location: '.$path.'profile');
							}
						}
					?>
					<form action="?editlanguage=1" method="post">
						<div class="box">
							<div class="form-group margin-bottom-0">
								<span class='glyphicon glyphicon-globe form' style='color:#777'; aria-hidden='true'></span>
								<select name="new_language" class="dropdown_form">
									<option <?php if($language=='0'){echo "selected";}?>value="de">Deutsch</option>
									<option <?php if($language=='1'){echo "selected";}?> value="en">English</option>
								</select>
							</div>
						</div> <?php // Ende von .box ?>
						<button type="submit" class="btn btn-primary"><?php echo $t_save[$language] ?></button>
						<a class="btn btn-primary grey-button" href="profile"><?php echo $t_cancel[$language] ?></a>
					</form>
				</div> <?php // Ende von .col-xs-12.col-md-6 ?>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <?php // Ende von .row ?>
		</div> <?php // Ende von .container ?>
	</body>
</html> 