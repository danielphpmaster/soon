<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';

	$title = "Mein Profil - soon";
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
					<div class="box result">
					<?php
						if(isset($_GET['search'])) {
							$searchvalue = $_GET['search'];
							$_SESSION['searchvalue'] = $searchvalue;
														
							$sql = "SELECT * FROM `appointments` WHERE userid = '".$userid."' AND appointmentname LIKE '%".$searchvalue."%'";
							
							echo "<h2>Suchergebnisse zu '".$searchvalue."'</h2></div>";
							
							foreach ($connection->query($sql) as $row) {
							   if($row['appointmentid'] < '1') {
								   echo "<div class='noappointment'>Keine Termine</div>";
							   } else {
								   if ($row['date'] == date("Y-m-d")) {
										$appointmentcolor = "style='color: #d9534f;'";
									} else {
										$appointmentcolor = "";
									}
								
									echo "<div class='day'><div class='date outsidecalendar'><b>".$row['date']."</b></div>";
								   
									echo "<div class='appointment'>
									<a href='appointment.php?a=".$row['appointmentid']."'".$appointmentcolor."><div class='title'><b>".$row['appointmentname']."</b></div></a>";
									
									if($row['time'] == "00:00:00" and empty($row['location']) and empty($row['comment'])) {
										echo "";
									} else {
										echo "<div class='appointmentinformation'>";
									}
									
									if($row['time'] == "00:00:00") {
										echo "";
									} else {
										echo "<div class='time'><span class='glyphicon glyphicon-time' style='color:#777'; aria-hidden='true'></span> ".$row['time']."</div>";
									}
									if(empty($row['location'])) {
										echo "";
									} else {
										echo "<div class='location'><span class='glyphicon glyphicon-map-marker' style='color:#777'; aria-hidden='true'></span> ".$row['location']."</div>";
									}
									if(empty($row['comment'])) {
										echo "";
									} else {
										echo "<div class='comment'><span class='glyphicon glyphicon-info-sign' style='color:#777'; aria-hidden='true'></span> ".$row['comment']."</div>";
									}
																
									if($row['time'] == "00:00:00" and empty($row['location']) and empty($row['comment'])) {
										echo "";
									} else {
										echo "</div>";
									}
									
									echo "</div></div>";
							   }
							}
						}
					?>
						<br>
						<a href="calendar.php" class="result_margin_bottom">Zurück</a>
				</div>
				
				<div class="col-xs-12 col-md-3"></div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
	</body>
</html>