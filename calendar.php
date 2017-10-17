<?php
	include 'session.php';
	include 'connection.php';
	include 'loginwall.php';
	
	$title = "".date('M')."  - soon";
?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'head.php';?>
	</head>

	<body>
		<?php include 'navbar.php';?>
				
		<div class="container">
			<div class="row" style="margin-top: 20px;">
				<div class="hidden-xs hidden-sm col-md-3">
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3">
					<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> September 2017</button>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3">
					<button type="button" class="btn btn-default">November 2017 <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
				</div>
				<div class="hidden-xs hidden-sm col-md-3">
				</div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
		
		<div class="calendar-container">
			<div class="row seven-cols">
				
				<?php
				$date = date("Y-m-d");
				$lastday = date("Y-m-t", strtotime($date));
				
				while ($date <= $lastday) {
					
					if($date == date("Y-m-d")) {
						$appointmentcolor = "style='color: #d9534f;'";
					} else {
						$appointmentcolor = "";
					}
					
					if($date == $lastday) {
						$dateclass = "last";
					} else {
						$dateclass = "";
					}
				
					echo "<div class='col-md-1'>
						<div class='day'>
						<div class='date ".$dateclass."'><b>".$date."</b></div>";
					
					$sql = "SELECT * FROM appointments WHERE userid = ".$userid." AND date = '".$date."'";
										
					foreach ($connection->query($sql) as $row) {
					   if($row['appointmentid'] < '1') {
						   echo "<div class='noappointment'>Keine Termine</div>";
					   } else {
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
							
							echo "</div>";
					   }
					}
					
					if (empty($row['appointmentid'])) {
						echo "<div class='noappointment'>Keine Termine</div>";
					} else {
						echo '';
					}
					
					$row['appointmentid'] = '';
								
				echo "</div></div>";
				
				$date++;
				}
				
				?>
			</div> <!-- Ende von .row -->
			<script>
				// When the user scrolls down 20px from the top of the document, show the button
				window.onscroll = function() {scrollFunction()};

				function scrollFunction() {
				    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
				        document.getElementById("myBtn").style.display = "block";
				    } else {
				        document.getElementById("myBtn").style.display = "none";
				    }
				}

				// When the user clicks on the button, scroll to the top of the document
				function topFunction() {
				    document.body.scrollTop = 0; // For Chrome, Safari and Opera 
				    document.documentElement.scrollTop = 0; // For IE and Firefox
				} 
			</script>
			<button onclick="topFunction()" id="myBtn"><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span> Nach oben</button> 
		</div> <!-- Ende von .calendar-container -->
	</body>
</html>