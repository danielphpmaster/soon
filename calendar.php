<?php
	include 'session.php';
	include 'loginwall.php';
	
	$title = "Oktober  - soon";
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
						<option></option>
						<option>2018</option>
						<option>2019</option>
					</select>
				</div>
				<div class="col-xs-6 col-md-3">
					<button type="button" class="btn btn-default">Kalender öffnen</button>
				</div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .container -->
		
		<div class="calendar-container">
			<div class="row seven-cols">
				<div class="col-md-1">
				</div>

				<div class="col-md-1">
				</div>

				<div class="col-md-1">
				</div>


				<div class="col-md-1">
				</div>


				<div class="col-md-1">
				</div>


				<div class="col-md-1">
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>So, 01.10.</b>
						<div class="appointment" tabindex="1">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-1">
					<div class="day">
						<b>Mo, 02.10.</b>
						<div class="noappointment">Keine Termine.</div>
					</div>
				</div>
				
				<div class="col-md-1">
					<div class="day">
						<b>Di, 03.10.</b>
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
				
				<div class="col-md-1">
					<div class="day">
						<b>Mi, 04.10.</b>
						<div class="appointment" tabindex="3">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-1">
					<div class="day">
						<b>Do, 05.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Vorgestern Fr, 06.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Gestern Sa, 07.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b style="color: red;">Heute So, 08.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Morgen Mo, 09.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Übermorgen Di, 10.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Mi, 11.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Do, 12.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Fr, 13.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Sa, 14.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>So, 15.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Mo, 16.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Di, 17.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Mi, 18.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Do, 19.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Fr, 20.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Sa, 21.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>So, 22.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Mo, 23.10.</b>
						<div class="noappointment">Keine Termine.</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Di, 24.10.</b>
						<div class="noappointment">Keine Termine.</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Mi 25.10.</b>
						<div class="noappointment">Keine Termine.</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Do, 26.10.</b>
						<div class="noappointment">Keine Termine.</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Fr, 27.10.</b>
						<div class="noappointment">Keine Termine.</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Sa, 28.10.</b>
						<div class="noappointment">Keine Termine.</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>So, 29.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Mo, 30.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>

				<div class="col-md-1">
					<div class="day">
						<b>Di, 31.10.</b>
						<div class="appointment" tabindex="4">
							<div class="title"><b>Besprechnung Präsentation <span id="edit-icon" style="height: 17px; margin-bottom: 3px;"></span></b></div>
							<div class="time">13:00 - 13:30</div>
							<div class="location">Sitzungszimmer Visp</div>
							<div class="comment">Ausserdem das Dossier zur Abgabe mitnehmen.</div>
						</div>
					</div>
				</div>
			</div> <!-- Ende von .row -->
		</div> <!-- Ende von .calendar-container -->
	</body>
</html>