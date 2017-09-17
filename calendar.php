<!DOCTYPE html>

<html>

<?php
	$title = "Oktober 2017 - soon";
?>

<head>
	<?php include 'head.php';?>
</head>

<body>
	<?php include 'navbar.php';?>
	
	<div class="container">
		<div class="row" style="margin-top: 20px;">
			<div class="col-xs-6 col-md-3">
				<select class="form-control">
					<option>Januar</option>
					<option>Februar</option>
					<option>März</option>
					<option>April</option>
					<option>Mai</option>
					<option>Juni</option>
					<option>Juli</option>
					<option>August</option>
					<option>September</option>
					<option>Oktober</option>
					<option>November</option>
					<option>Dezember</option>
				</select>
			</div>
			<div class="col-xs-6 col-md-3">
				<select class="form-control">
					<option>2017</option>
					<option>2018</option>
					<option>2019</option>
				</select>
			</div>
			<div class="col-xs-6 col-md-3">
				<button type="button" class="btn btn-default">Kalender öffnen</button>
			</div>
		</div>
	</div>
	<div class="calendar-container">
		<div class="row">
			<div class="col-xs-12 col-md-4 col-lg-3">
				<div class="day">
					<b>Montag, 18.09.2017</b>
					<div class="appointment" tabindex="1">
						<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
						<div class="time">13:00 - 13:30</div>
						<div class="location">Sitzungszimmer Visp</div>
						<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4 col-lg-3">
				<div class="day">
					<b>Montag, 18.09.2017</b>
					<div class="noappointment">Keine Termine.</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4 col-lg-3">
				<div class="day">
					<b>Montag, 19.09.2017</b>
					<div class="appointment" tabindex="2">
						<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
						<div class="time">13:00 - 13:30</div>
						<div class="location">Sitzungszimmer Visp</div>
						<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
					</div>
					<div class="appointment" tabindex="5">
						<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
						<div class="time">13:00 - 13:30</div>
						<div class="location">Sitzungszimmer Visp</div>
						<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4 col-lg-3">
				<div class="day">
					<b>Montag, 20.09.2017</b>
					<div class="appointment" tabindex="3">
						<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
						<div class="time">13:00 - 13:30</div>
						<div class="location">Sitzungszimmer Visp</div>
						<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-4 col-lg-3">
				<div class="day">
					<b>Montag, 21.09.2017</b>
					<div class="appointment" tabindex="4">
						<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
						<div class="time">13:00 - 13:30</div>
						<div class="location">Sitzungszimmer Visp</div>
						<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html> 